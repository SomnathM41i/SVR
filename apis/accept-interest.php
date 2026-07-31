<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php');
require_once('../firebase/fcm_functions.php'); // contains getAccessToken() and sendFCMNotification()
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Utility: normalize input
function normalizeInput($db, $key) {
    if (!isset($_POST[$key])) return '';
    $val = $_POST[$key];
    return $db->setfilter(trim($val)); // Sanitize input using sys_dbconnection filter
}

// Collect Inputs
$matriId   = normalizeInput($db, 'MatriID');   // Current user (receiver)
$senderId  = normalizeInput($db, 'SenderID');   // Profile that sent the interest

// Validation
$errors = [];
if (empty($matriId))   $errors[] = "MatriID is required";
if (empty($senderId))  $errors[] = "SenderID is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

try {
    /**
     * STEP 1: Update express interest status to 'Accept'
     */
    $updateStmt = $con->prepare("UPDATE expressinterest SET status = 'Accept' WHERE eireceiver = ? AND eisender = ?");
    $updateStmt->bind_param("ss", $matriId, $senderId);
    $updateSuccess = $updateStmt->execute();

    if (!$updateSuccess || $updateStmt->affected_rows === 0) {
        echo json_encode(["status" => "error", "message" => "No matching express interest found or update failed"]);
        exit;
    }

    /**
     * STEP 2: Fetch sender and receiver details for email
     */
    $senderStmt = $con->prepare("SELECT Name, ConfirmEmail, Photo1 FROM register WHERE MatriID = ?");
    $senderStmt->bind_param("s", $senderId);
    $senderStmt->execute();
    $senderData = $senderStmt->get_result()->fetch_assoc();

    $receiverStmt = $con->prepare("SELECT Name, Photo1, Age, Height, Religion, mother_tounge, Education, Occupation, ConfirmEmail, City 
                                   FROM register WHERE MatriID = ?");
    $receiverStmt->bind_param("s", $matriId);
    $receiverStmt->execute();
    $receiverData = $receiverStmt->get_result()->fetch_assoc();

    if (!$senderData || !$receiverData) {
        echo json_encode(["status" => "error", "message" => "Sender or receiver profile not found"]);
        exit;
    }

    /**
     * STEP 3: Check SMTP and email verification
     */
    $data_config = $db->get_siteconfig();
    $on_off = $data_config->is_smtp_set;

    $emailStmt = $con->prepare("SELECT verification FROM emailverify WHERE MatriID = ?");
    $emailStmt->bind_param("s", $senderId);
    $emailStmt->execute();
    $emailData = $emailStmt->get_result()->fetch_assoc();
    $emailVerified = $emailData['verification'] ?? 'No';

    $responseData = [
        "MatriID"    => $matriId,
        "SenderID"   => $senderId,
        "AcceptedOn" => date('d-m-Y')
    ];
    
    /**
     * STEP 4.5: Send FCM Push Notification (Interest Accepted)
     */
    
    $projectId = 'dishavadhuvar-4c458';
    $accessToken = getAccessToken('../firebase/firebase-service-account.json');
    
    // Get latest FCM token of INTEREST SENDER (who should be notified)
    $fcmStmt = $con->prepare("
        SELECT token 
        FROM fcm_tokens 
        WHERE MatriID = ? 
        ORDER BY created_at DESC 
        LIMIT 1
    ");
    $fcmStmt->bind_param("s", $senderId);
    $fcmStmt->execute();
    $fcmStmt->bind_result($targetToken);
    $fcmStmt->fetch();
    $fcmStmt->close();
    
    if (!empty($targetToken)) {
    
        $receiverName = explode(" ", $receiverData['Name'])[0];
    
        $notificationMessage = "$receiverName has accepted your interest 💖";
    
        $payload = [
            'message' => [
                'token' => $targetToken,
                'notification' => [
                    'title' => 'Interest Accepted 🎉',
                    'body'  => $notificationMessage
                ],
                'data' => [
                    'type' => 'INTEREST_ACCEPTED',
                    'sender_id' => $matriId,   // who accepted
                    'receiver_id' => $senderId
                ]
            ]
        ];
    
        sendFCMNotification($projectId, $accessToken, $payload);
    
        // Save notification in DB
        saveNotification($con, [
            'notification_title' => 'Interest Accepted 🎉',
            'notification_text'  => $notificationMessage,
            'notification_type'  => 'INTEREST_ACCEPTED',
            'notification_profile_id' => $senderId, // notified user
            'notification_matching_id' => $matriId  // accepter
        ]);
    }


    /**
     * STEP 4: Send email using mail() if SMTP is enabled and email is verified
     */
    if ((int)$on_off === 1 && $emailVerified === 'Yes') {
        $height = get_height($receiverData['Height']);
        $receiverName = explode(" ", $receiverData['Name'])[0];
        $siteStmt = $con->prepare("SELECT Weblogopath, Webname, WebFriendlyname FROM siteconfig WHERE ID = '1'");
        $siteStmt->execute();
        $siteData = $siteStmt->get_result()->fetch_assoc();
        $logo = $siteData['Weblogopath'] ?? '';
        $site_name = $siteData['Webname'] ?? '';
        $webname = $siteData['WebFriendlyname'] ?? '';

        $subject = "Interest Accepted";
        $message = "<!doctype html>
            <html>
            <head>
                <meta charset='utf-8'>
                <title>Interest Accepted by Someone</title>
            </head>
            <body>
                <table width='467' border='0' style='font-family:\"Lucida Grande\", \"Lucida Sans Unicode\", \"Lucida Sans\", \"DejaVu Sans\", Verdana, sans-serif' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td width='222'><img src='https://weddingsparampara.com/branding/logos/logo-horizontal.png' width='168' height='50' alt=''/></td>
                        <td colspan='2' align='center' valign='middle'>Date: " . date('d-m-Y') . "</td>
                    </tr>
                    <tr>
                        <td colspan='3'>
                            Dear {$senderData['Name']},<br>
                            Interest Accepted by Someone: {$receiverName}
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>-------------------------------------------------------------------------------</td>
                    </tr>
                    <tr>
                        <td><img src='https://www.dishavadhuvar.com/gallary/{$receiverData['Photo1']}' width='209' height='232' alt=''/></td>
                        <td width='221' valign='top'>
                            <p>Name: {$receiverName}</p>
                            <p>Age: {$receiverData['Age']} Years</p>
                            <p>Height: {$height}</p>
                            <p>City: {$receiverData['City']}</p>
                            <p>Occupation: {$receiverData['Occupation']}</p>
                            <p>Education: {$receiverData['Education']}</p>
                        </td>
                        <td width='24'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>ID: <a href='https://www.dishavadhuvar.com/full_profile?id=" . urlencode(base64_encode($matriId)) . "'>{$matriId} View Profile</a></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </body>
            </html>";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: Dishavadhuvar <no-reply@dishavadhuvar.com>\r\n";
        $headers .= "Reply-To: no-reply@dishavadhuvar.com\r\n";

        if (mail($senderData['ConfirmEmail'], $subject, $message, $headers)) {
            $responseData["email_status"] = "Email sent successfully";
        } else {
            $responseData["email_status"] = "Failed to send email";
        }
    }

    /**
     * STEP 5: Response
     */
    echo json_encode([
        "status"  => "success",
        "message" => "Express interest accepted successfully",
        "data"    => $responseData
    ]);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

/**
 * Convert height code to readable format
 */
function get_height($strheight)
{
    $heights = [
        "1" => "4ft", "2" => "4Ft 1 inch", "3" => "4Ft 2 inch", "4" => "4Ft 3 inch", "5" => "4Ft 4 inch",
        "6" => "4Ft 5 inch", "7" => "4Ft 6 inch", "8" => "4Ft 7 inch", "9" => "4Ft 8 inch", "10" => "4Ft 9 inch",
        "11" => "4Ft 10 inch", "12" => "4Ft 11 inch", "13" => "5Ft", "14" => "5Ft 1 inch", "15" => "5Ft 2 inch",
        "16" => "5Ft 3 inch", "17" => "5Ft 4 inch", "18" => "5Ft 5 inch", "19" => "5Ft 6 inch", "20" => "5Ft 7 inch",
        "21" => "5Ft 8 inch", "22" => "5Ft 9 inch", "23" => "5Ft 10 inch", "24" => "5Ft 11 inch", "25" => "6Ft",
        "26" => "6Ft 1 inch", "27" => "6Ft 2 inch", "28" => "6Ft 3 inch", "29" => "6Ft 4 inch", "30" => "6Ft 5 inch",
        "31" => "6Ft 6 inch", "32" => "6Ft 7 inch", "33" => "6Ft 8 inch", "34" => "6Ft 9 inch", "35" => "6Ft 10 inch",
        "36" => "6Ft 11 inch", "37" => "7Ft"
    ];
    return $heights[$strheight] ?? "Null";
}
?>