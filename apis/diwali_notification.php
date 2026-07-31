<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php');
require_once('../firebase/fcm_functions.php'); // contains getAccessToken() and sendFCMNotification()

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Only POST allowed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Project and Firebase setup
$projectId = 'dishavadhuvar-4c458';
$accessToken = getAccessToken('../firebase/firebase-service-account.json');

// Prepare Notification Content
$title = "🎆 Happy Diwali from Team Dishavadhuvar!";
$body = "May this Diwali bring joy, love, and success to your life. Stay safe and keep smiling! 🌟";

// Fetch all tokens
$query = "
    SELECT r.MatriID, r.Name, t.token 
    FROM register r 
    INNER JOIN fcm_tokens t ON r.MatriID = t.MatriID
    WHERE t.token IS NOT NULL AND t.token != ''
    GROUP BY t.MatriID
";
$result = $con->query($query);

if ($result->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "No users found with valid FCM tokens"]);
    exit;
}

// Send notifications
$sentCount = 0;
$failedCount = 0;
while ($row = $result->fetch_assoc()) {
    $matriId = $row['MatriID'];
    $userName = $row['Name'];
    $token = $row['token'];

    $personalMessage = "Dear $userName,\n" . $body;

    $payload = [
        'message' => [
            'token' => $token,
            'notification' => [
                'title' => $title,
                'body' => $personalMessage,
                'image' => 'http://localhost/SVR/css3/assets/manpasand-logo.png'
            ]
        ]
    ];

    $response = sendFCMNotification($projectId, $accessToken, $payload);
    if ($response['status']) {
        $sentCount++;
    } else {
        $failedCount++;
    }
}

// Final response
echo json_encode([
    "status" => "success",
    "message" => "Diwali notifications sent successfully!",
    "data" => [
        "Total_Users" => $result->num_rows,
        "Sent" => $sentCount,
        "Failed" => $failedCount,
        "Title" => $title,
        "Body" => $body
    ]
]);
?>
