<?php
require_once 'fcm_functions.php';
require_once'../includes/bootstrap.php'; // adjust path if needed

$deviceToken = "DEVICE_FCM_TOKEN"; // fetch from DB
$accessToken = getAccessToken('firebase/firebase-service-account.json');
$projectId = 'YOUR_PROJECT_ID';

if (!$accessToken) {
    die(json_encode(['status' => false, 'message' => 'Failed to get access token']));
}

$payload = [
    'message' => [
        'token' => $deviceToken,
        'notification' => [
            'title' => 'Happy Diwali 🎆',
            'body' => 'Wishing you and your family a prosperous Diwali!'
        ],
        'data' => ['screen' => 'HomeScreen']
    ]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/$projectId/messages:send");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $accessToken",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo json_encode([
    'status' => $http_code === 200,
    'http_code' => $http_code,
    'response' => json_decode($response, true)
]);
