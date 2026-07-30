<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once('../sys_dbconnection.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// ✅ Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// --- Utility: normalize input ---
function normalizeInput($db, $key) {
    if (!isset($_POST[$key])) return '';
    $val = $_POST[$key];
    return $db->setfilter(trim($val)); // uses your sys_dbconnection filter
}

// ✅ Collect Inputs
$matriId   = normalizeInput($db, 'MatriID');   // current user (ignorer)
$profileId = normalizeInput($db, 'ProfileID'); // profile to ignore

// ✅ Validation
$errors = [];
if (empty($matriId))   $errors[] = "MatriID is required";
if (empty($profileId)) $errors[] = "ProfileID is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// ✅ Check if already ignored
$sqlCheck = "SELECT ignore_id FROM `ignore` WHERE matriid=? AND profile_id=?";
$check = $con->prepare($sqlCheck);

if (!$check) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $con->error, "sql" => $sqlCheck]);
    exit;
}

$check->bind_param("ss", $matriId, $profileId);
$check->execute();
$result = $check->get_result();

if ($result && $result->num_rows > 0) {
    echo json_encode([
        "status"  => "success",
        "message" => "Profile already ignored",
        "data"    => [
            "MatriID"   => $matriId,
            "ProfileID" => $profileId
        ]
    ]);
    exit;
}

// ✅ Insert new ignore record
$now = date('d-m-Y');
$sqlInsert = "INSERT INTO `ignore` (matriid, profile_id, when1) VALUES (?, ?, ?)";
$insert = $con->prepare($sqlInsert);

if (!$insert) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $con->error, "sql" => $sqlInsert]);
    exit;
}

$insert->bind_param("sss", $matriId, $profileId, $now);

if ($insert->execute()) {
    echo json_encode([
        "status"  => "success",
        "message" => "Profile ignored successfully",
        "data"    => [
            "MatriID"   => $matriId,
            "ProfileID" => $profileId,
            "IgnoredOn" => $now
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to ignore profile: " . $insert->error]);
}
?>
