<?php
require_once('../sys_dbconnection.php');
require_once '../includes/security.php'; svr_api_key_guard(); /* SECURITY (H6): broadcast endpoint - optional X-API-Key guard (active once SVR_API_ADMIN_KEY is configured). */
require_once('../firebase/fcm_functions.php');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

function clean($value) {
    return trim($value ?? '');
}

$title            = clean($_POST['title']);
$body             = clean($_POST['body']);
$image            = clean($_POST['image']);
$recipientTarget  = clean($_POST['recipient_target']);
$profileTarget    = clean($_POST['profile_target']);
$recipientMatriIds = $_POST['recipient_matriid'] ?? [];
$profileMatriIds   = $_POST['profile_matriid'] ?? [];

// Convert to array if it's a comma-separated string
if (!is_array($recipientMatriIds)) {
    $recipientMatriIds = array_filter(array_map('trim', explode(',', $recipientMatriIds)));
} else {
    $recipientMatriIds = array_filter(array_map('trim', $recipientMatriIds));
}

if (!is_array($profileMatriIds)) {
    $profileMatriIds = array_filter(array_map('trim', explode(',', $profileMatriIds)));
} else {
    $profileMatriIds = array_filter(array_map('trim', $profileMatriIds));
}

// Validation
$errors = [];

if (empty($title))  $errors[] = "Title is required";
if (empty($body))   $errors[] = "Body is required";
if (empty($recipientTarget)) $errors[] = "Recipient target is required";
if (empty($profileTarget)) $errors[] = "Profile target is required";

if (empty($recipientMatriIds)) {
    $errors[] = "At least one recipient MatriID is required";
}

// if (empty($profileMatriIds)) {
//     $errors[] = "At least one profile MatriID is required";
// }

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

try {

    $projectId   = 'dishavadhuvar-4c458';
    $accessToken = getAccessToken('../firebase/firebase-service-account.json');

    // Build SQL query to get recipients with FCM tokens
    $sql = "
        SELECT r.MatriID, r.Name, t.token
        FROM register r
        INNER JOIN fcm_tokens t ON r.MatriID = t.MatriID
        WHERE t.token IS NOT NULL AND t.token != ''
    ";

    // Add recipient MatriID filter
    $placeholders = implode(',', array_fill(0, count($recipientMatriIds), '?'));
    $sql .= " AND r.MatriID IN ($placeholders)";
    
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        throw new Exception("Query preparation failed: " . $con->error);
    }

    // Bind parameters
    $types = str_repeat('s', count($recipientMatriIds));
    $stmt->bind_param($types, ...$recipientMatriIds);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode([
            "status" => "error", 
            "message" => "No recipients found with valid FCM tokens for the provided MatriIDs"
        ]);
        exit;
    }

    $sent = 0;
    $failed = 0;
    $failedDetails = [];

    // Prepare the profile data string for the notification payload
    $profileDataString = implode(',', $profileMatriIds);

    while ($row = $result->fetch_assoc()) {

        $payload = [
            'message' => [
                'token' => $row['token'],
                'notification' => [
                    'title' => $title,
                    'body'  => $body,
                    'image' => !empty($image)
                        ? $image
                        : 'https://weddingsparampara.com/branding/images/logo-horizontal.png'
                ],
                'data' => [
                    'type'          => 'PERSONALIZED_NOTIFICATION',
                    'matriids'      => $profileDataString,  // Profile MatriIDs for app to process
                ]
            ]
        ];

        $response = sendFCMNotification($projectId, $accessToken, $payload);

        if ($response) {

            $sent++;

            // Save notification to database
            saveNotification($con, [
                'notification_title'       => $title,
                'notification_text'        => $body,
                'notification_type'        => 'PERSONALIZED_NOTIFICATION',
                'notification_profile_id'  => $row['MatriID'],
                'notification_matching_id' => NULL
            ]);

        } else {
            $failed++;
            $failedDetails[] = $row['MatriID'] . ' (' . $row['Name'] . ')';
        }
    }

    $responseData = [
        "status"  => "success",
        "message" => "Notification sent successfully",
        "data"    => [
            "Total"        => $result->num_rows,
            "Sent"         => $sent,
            "Failed"       => $failed,
            "ProfileCount" => count($profileMatriIds)
        ]
    ];

    // Add failed details if any
    if ($failed > 0 && count($failedDetails) > 0) {
        $responseData['data']['FailedUsers'] = $failedDetails;
    }

    echo json_encode($responseData);

} catch (Exception $e) {

    echo json_encode([
        "status"  => "error",
        "message" => "Error: " . $e->getMessage()
    ]);
    
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
}
?>