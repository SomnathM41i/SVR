<?php
require_once('../sys_dbconnection.php'); 

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Allow only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Only POST requests are allowed"
    ]);
    exit;
}

// Collect Inputs
$matriId        = $db->setfilter($_POST['MatriID'] ?? '');
$notificationId = $db->setfilter($_POST['NotificationID'] ?? '');

// Validation
if (empty($matriId) || empty($notificationId)) {
    echo json_encode([
        "status" => "error",
        "message" => "MatriID and NotificationID are required"
    ]);
    exit;
}

// Update notification as seen
$updateQuery = $con->prepare("
    UPDATE notifications
    SET notification_seen = 1
    WHERE notification_id = ? AND notification_profile_id = ?
");
$updateQuery->bind_param("is", $notificationId, $matriId);
$updateQuery->execute();

if ($updateQuery->affected_rows > 0) {
    echo json_encode([
        "status"  => "success",
        "message" => "Notification marked as seen successfully"
    ]);
} else {
    echo json_encode([
        "status"  => "error",
        "message" => "No matching notification found or already marked as seen"
    ]);
}
?>
