<?php
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
    return $db->setfilter(trim($val));
}

// Collect Inputs
$matriId   = normalizeInput($db, 'MatriID');   // Current user
$profileId = normalizeInput($db, 'ProfileID'); // Profile to remove

// Validation
$errors = [];
if (empty($matriId))   $errors[] = "MatriID is required";
if (empty($profileId)) $errors[] = "ProfileID is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// --- Check if shortlist exists ---
$sqlCheck = "SELECT short_id FROM shortlist_profile WHERE mat_id = ? AND profile_id = ?";
$check = $con->prepare($sqlCheck);

if (!$check) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $con->error]);
    exit;
}

$check->bind_param("ss", $matriId, $profileId);
$check->execute();
$result = $check->get_result();

if (!$result || $result->num_rows == 0) {
    echo json_encode([
        "status"  => "error",
        "message" => "Profile not found in shortlist"
    ]);
    exit;
}

// --- Delete from shortlist ---
$sqlDelete = "DELETE FROM shortlist_profile WHERE mat_id = ? AND profile_id = ?";
$delete = $con->prepare($sqlDelete);

if (!$delete) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $con->error]);
    exit;
}

$delete->bind_param("ss", $matriId, $profileId);

if ($delete->execute()) {

    // --- Optional: Remove related notification ---
    $sqlDeleteNotif = "DELETE FROM notification 
                       WHERE noti_sender = ? 
                       AND noti_receiver = ? 
                       AND notification_type = 'Shortlisted'";
    
    $deleteNotif = $con->prepare($sqlDeleteNotif);
    if ($deleteNotif) {
        $deleteNotif->bind_param("ss", $matriId, $profileId);
        $deleteNotif->execute();
    }

    echo json_encode([
        "status"  => "success",
        "message" => "Profile removed from shortlist successfully",
        "data"    => [
            "MatriID"   => $matriId,
            "ProfileID" => $profileId
        ]
    ]);

} else {
    echo json_encode([
        "status"  => "error",
        "message" => "Failed to remove profile: " . $delete->error
    ]);
}
?>