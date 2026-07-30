<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// --- Utility: normalize input ---
function normalizeInput($db, $key) {
    if (!isset($_POST[$key])) return '';
    $val = $_POST[$key];
    return $db->setfilter(trim($val)); // uses sys_dbconnection filter
}

// Collect Inputs
$matriId   = normalizeInput($db, 'MatriID');   // Current user (shortlister)
$profileId = normalizeInput($db, 'ProfileID'); // Profile to shortlist

// Validation
$errors = [];
if (empty($matriId))   $errors[] = "MatriID is required";
if (empty($profileId)) $errors[] = "ProfileID is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// --- Check if already shortlisted ---
$sqlCheck = "SELECT short_id FROM shortlist_profile WHERE mat_id = ? AND profile_id = ?";
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
        "message" => "Profile already shortlisted",
        "data"    => [
            "MatriID"   => $matriId,
            "ProfileID" => $profileId
        ]
    ]);
    exit;
}

// --- Insert notification ---
$now = date('d-m-Y');
$sqlNotif = "INSERT INTO notification (noti_sender, noti_receiver, notification_type, notification_desc, seen, date_time) 
             VALUES (?, ?, 'Shortlisted', 'Shortlisted Profile', 'unseen', NOW())";
$notif = $con->prepare($sqlNotif);

if (!$notif) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $con->error, "sql" => $sqlNotif]);
    exit;
}

$notif->bind_param("ss", $matriId, $profileId);
$notif->execute();

// --- Insert new shortlist ---
$sqlInsert = "INSERT INTO shortlist_profile (mat_id, profile_id, when1) VALUES (?, ?, ?)";
$insert = $con->prepare($sqlInsert);

if (!$insert) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $con->error, "sql" => $sqlInsert]);
    exit;
}

$insert->bind_param("sss", $matriId, $profileId, $now);

if ($insert->execute()) {
    echo json_encode([
        "status"  => "success",
        "message" => "Profile shortlisted successfully",
        "data"    => [
            "MatriID"   => $matriId,
            "ProfileID" => $profileId,
            "ShortlistedOn" => $now
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to shortlist profile: " . $insert->error]);
}
?>