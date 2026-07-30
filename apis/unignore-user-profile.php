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
    return $db->setfilter(trim($val));
}

// ✅ Collect Inputs
$matriId   = normalizeInput($db, 'MatriID');   // current user (unignorer)
$profileId = normalizeInput($db, 'ProfileID'); // profile to unignore

// ✅ Validation
$errors = [];
if (empty($matriId))   $errors[] = "MatriID is required";
if (empty($profileId)) $errors[] = "ProfileID is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// ✅ Check if record exists
$sqlCheck = "SELECT ignore_id FROM `ignore` WHERE matriid=? AND profile_id=?";
$check = $con->prepare($sqlCheck);

if (!$check) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $con->error, "sql" => $sqlCheck]);
    exit;
}

$check->bind_param("ss", $matriId, $profileId);
$check->execute();
$result = $check->get_result();

if (!$result || $result->num_rows === 0) {
    echo json_encode([
        "status"  => "error",
        "message" => "Profile not found in ignore list"
    ]);
    exit;
}

// ✅ Delete record
$sqlDelete = "DELETE FROM `ignore` WHERE matriid=? AND profile_id=?";
$delete = $con->prepare($sqlDelete);

if (!$delete) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $con->error, "sql" => $sqlDelete]);
    exit;
}

$delete->bind_param("ss", $matriId, $profileId);

if ($delete->execute()) {
    echo json_encode([
        "status"  => "success",
        "message" => "Profile unignored successfully",
        "data"    => [
            "MatriID"   => $matriId,
            "ProfileID" => $profileId
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to unignore profile: " . $delete->error]);
}
?>
