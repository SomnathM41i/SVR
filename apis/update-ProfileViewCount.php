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
$viewerId  = normalizeInput($db, 'ViewerID');   // Who is viewing (MatriID of current user)
$profileId = normalizeInput($db, 'ProfileID');  // Whose profile is being viewed

// Validation
$errors = [];
if (empty($viewerId))  $errors[] = "ViewerID is required";
if (empty($profileId)) $errors[] = "ProfileID is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// --- 1. Insert Notification if not exists ---
$sqlCheckNoti = "SELECT noti_id FROM notification 
                 WHERE noti_sender=? AND noti_receiver=? AND notification_type='Profile View'";
$checkNoti = $con->prepare($sqlCheckNoti);

if (!$checkNoti) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $con->error]);
    exit;
}

$checkNoti->bind_param("ss", $viewerId, $profileId);
$checkNoti->execute();
$resNoti = $checkNoti->get_result();

if ($resNoti && $resNoti->num_rows == 0) {
    $sqlInsertNoti = "INSERT INTO notification 
        (noti_sender, noti_receiver, notification_type, notification_desc, seen, date_time) 
        VALUES (?, ?, 'Profile View', 'Viewed your profile', 'unseen', NOW())";
    $insertNoti = $con->prepare($sqlInsertNoti);

    if ($insertNoti) {
        $insertNoti->bind_param("ss", $viewerId, $profileId);
        $insertNoti->execute();
    }
}

// --- 2. Insert Profile View if not exists ---
$sqlCheckView = "SELECT view_id FROM profile_views WHERE who=? AND whom=?";
$checkView = $con->prepare($sqlCheckView);

if (!$checkView) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $con->error]);
    exit;
}

$checkView->bind_param("ss", $viewerId, $profileId);
$checkView->execute();
$resView = $checkView->get_result();

if ($resView && $resView->num_rows == 0) {
    $today = date('d-m-Y');
    $sqlInsertView = "INSERT INTO profile_views (who, whom, date) VALUES (?, ?, ?)";
    $insertView = $con->prepare($sqlInsertView);

    if ($insertView) {
        $insertView->bind_param("sss", $viewerId, $profileId, $today);
        $insertView->execute();
    }
}

// --- Success Response ---
echo json_encode([
    "status"  => "success",
    "message" => "Profile view recorded successfully",
    "data"    => [
        "ViewerID"  => $viewerId,
        "ProfileID" => $profileId,
        "ViewedOn"  => date('d-m-Y H:i:s')
    ]
]);
?>
