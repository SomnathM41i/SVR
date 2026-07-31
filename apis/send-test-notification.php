<?php
/* SECURITY: debug output disabled in production - error_reporting(E_ALL); */
/* SECURITY: debug output disabled in production - ini_set('display_errors', 1); */
/* SECURITY: debug output disabled in production - ini_set('display_startup_errors', 1); */

require_once '../sys_dbconnection.php';
require_once '../includes/security.php'; svr_api_key_guard(); /* SECURITY (H6): broadcast endpoint - optional X-API-Key guard (active once SVR_API_ADMIN_KEY is configured). */
require_once '../firebase/fcm_functions.php';

// 1️⃣ Get MatriID from POST
$matriID = $_POST['MatriID'] ?? null;
if (!$matriID) {
    echo json_encode(['status' => false, 'message' => 'MatriID is required']);
    exit;
}

// 2️⃣ Fetch FCM token from DB
$stmt = $con->prepare("SELECT token FROM fcm_tokens WHERE MatriID = ? ORDER BY created_at DESC LIMIT 1");
$stmt->bind_param("s", $matriID);
$stmt->execute();
$stmt->bind_result($deviceToken);
$stmt->fetch();
$stmt->close();

if (!$deviceToken) {
    echo json_encode(['status' => false, 'message' => 'No FCM token found for this MatriID']);
    exit;
}

// 3️⃣ Get Firebase access token
$accessToken = getAccessToken('../firebase/firebase-service-account.json'); // adjust path
$projectId = 'dishavadhuvar-4c458'; // replace with your Firebase project ID
// print_r($accessToken); exit;
if (!$accessToken) {
    echo json_encode(['status'=>false,'message'=>'Failed to get Firebase access token']);
    exit;
}

// 4️⃣ Prepare notification payload
$payload = [
    'message' => [
        'token' => $deviceToken,
        'notification' => [
            'title' => 'Test Notification 🎉',
            'body' => 'Hello! This is a test message from your PHP backend.',
            'image' => 'https://dishavadhuvar.thebankingservices.com/photoprocess.php?image=gallary/2025_10_15_15_57_36_0ad81db4e845c3a230e1367f26dea02e.jpg&square=500'
        ],
        'data' => [
            'screen' => 'HomeScreen'
        ]
    ]
];

// 5️⃣ Send notification
$ch = curl_init("https://fcm.googleapis.com/v1/projects/$projectId/messages:send");
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

// 6️⃣ Return response
echo json_encode([
    'status' => $http_code === 200,
    'http_code' => $http_code,
    'MatriID' => $matriID,
    'token' => $deviceToken,
    'response' => json_decode($response, true)
]);
