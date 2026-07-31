<?php
/* SECURITY: verbose error reporting disabled in production. */
/* SECURITY: PHP error display disabled in production. */
/* SECURITY: PHP startup error display disabled in production. */

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

// Collect Inputs
$matriId             = $db->setfilter($_POST['MatriID'] ?? '');
$profile_id          = $db->setfilter($_POST['profile_id'] ?? '');
$preferred_date      = $db->setfilter($_POST['preferred_date'] ?? '');
$preferred_time      = $db->setfilter($_POST['preferred_time'] ?? '');
$preferred_location  = $db->setfilter($_POST['preferred_location'] ?? '');
$notes               = $db->setfilter($_POST['notes'] ?? '');
$created_at          = date('Y-m-d H:i:s');

$errors = [];
if (empty($matriId)) $errors[] = "MatriID is required";
if (empty($profile_id)) $errors[] = "ProfileID is required";
if (empty($preferred_date)) $errors[] = "Preferred date is required";
if (empty($preferred_time)) $errors[] = "Preferred time is required";
if (empty($preferred_location)) $errors[] = "Preferred location is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// Helpers
function convertTo24Hour($time_am_pm) {
    return empty($time_am_pm) ? null : date("H:i:s", strtotime($time_am_pm));
}
function formatTimeAMPM($time) {
    return empty($time) ? "" : date("h:i A", strtotime($time));
}

// Convert time for DB
$preferred_time_db = convertTo24Hour($preferred_time);

// Check if a pending request exists
$check = $con->prepare("SELECT id FROM kanda_pohe_meeting_requests WHERE user_id=? AND status IN ('Pending','Approved')");
$check->bind_param("s",$matriId);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    // Update existing request
    $update = $con->prepare("
        UPDATE kanda_pohe_meeting_requests 
        SET profile_id=?, preferred_date=?, preferred_time=?, preferred_location=?, notes=?, updated_at=NOW()
        WHERE user_id=? AND status IN ('Pending','Approved')
    ");
    $update->bind_param("ssssss",$profile_id,$preferred_date,$preferred_time_db,$preferred_location,$notes,$matriId);
    $update->execute();
    $message = "Meeting request updated successfully";
} else {
    // Insert new request
    $insert = $con->prepare("
        INSERT INTO kanda_pohe_meeting_requests 
        (profile_id,user_id,preferred_date,preferred_time,preferred_location,notes,status,created_at)
        VALUES (?,?,?,?,?,?,'Pending',?)
    ");
    $insert->bind_param("sssssss",$profile_id,$matriId,$preferred_date,$preferred_time_db,$preferred_location,$notes,$created_at);
    $insert->execute();
    $message = "Meeting request submitted successfully";
}

// Fetch names
$stmt = $con->prepare("SELECT Name FROM register WHERE MatriID=? LIMIT 1");
$stmt->bind_param("s",$matriId);
$stmt->execute();
$stmt->bind_result($userName);
$stmt->fetch();
$stmt->close();

$stmt = $con->prepare("SELECT Name FROM register WHERE MatriID=? LIMIT 1");
$stmt->bind_param("s",$profile_id);
$stmt->execute();
$stmt->bind_result($profileName);
$stmt->fetch();
$stmt->close();

// Send notification to recipient
$projectId = 'dishavadhuvar-4c458';
$accessToken = getAccessToken('../firebase/firebase-service-account.json');

$stmt = $con->prepare("SELECT token FROM fcm_tokens WHERE MatriID=? ORDER BY created_at DESC LIMIT 1");
$stmt->bind_param("s",$profile_id);
$stmt->execute();
$stmt->bind_result($targetToken);
$stmt->fetch();
$stmt->close();

if ($targetToken) {
    $notificationMessage = "You have received a meeting request from $userName.\n";
    $notificationMessage .= "Date: $preferred_date\n";
    $notificationMessage .= "Time: ".formatTimeAMPM($preferred_time_db)."\n";
    $notificationMessage .= "Location: $preferred_location\n";
    $notificationMessage .= "Our team will get in touch with you shortly to schedule your meeting. Kindly wait for confirmation from our admin.";

    $payload = [
        'message'=>[
            'token'=>$targetToken,
            'notification'=>[
                'title'=>'New Meeting Request 📅',
                'body'=>$notificationMessage
            ]
        ]
    ];
    sendFCMNotification($projectId, $accessToken, $payload);
    
    saveNotification($con, [
        'notification_title' => 'New Meeting Request 📅',
        'notification_text'  => $notificationMessage,
        'notification_type'  => 'PERSONALIZED_NOTIFICATION',
        'notification_profile_id' => $profile_id,   // receiver
        'notification_matching_id' => $matriId      // sender
    ]);
}

// Response
echo json_encode([
    "status"=>"success",
    "message"=>$message,
    "data"=>[
        "MatriID"=>$matriId,
        "ProfileID"=>$profile_id,
        "PreferredDate"=>$preferred_date,
        "PreferredTime"=>formatTimeAMPM($preferred_time_db),
        "PreferredLocation"=>$preferred_location,
        "Role"=>"user",
        "Status"=>"Pending"
    ]
]);
?>
