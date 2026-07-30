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

// Utility: normalize input (same as your APIs)
function normalizeInput($db, $key) {
    if (!isset($_POST[$key])) return '';
    $val = $_POST[$key];
    return $db->setfilter(trim($val)); // Sanitize input using sys_dbconnection filter
}

// Collect Inputs
$matriId  = normalizeInput($db, 'MatriID');    // Sender (logged-in user)
$toMatriId = normalizeInput($db, 'SenderID'); // Recipient
$message   = normalizeInput($db, 'Message');    // Message content

// Validation
if (empty($matriId) || empty($toMatriId) || empty($message)) {
    echo json_encode(["status" => "error", "message" => "MatriID, SenderID, and Message are required"]);
    exit;
}

// Validate sender and recipient exist in the register table
$pstmt = $con->prepare("SELECT MatriID FROM register WHERE MatriID = ?");
$pstmt->bind_param("s", $matriId);
$pstmt->execute();
if ($pstmt->get_result()->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Invalid sender MatriID"]);
    exit;
}

$pstmt->bind_param("s", $toMatriId);
$pstmt->execute();
if ($pstmt->get_result()->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Invalid recipient MatriID"]);
    exit;
}

// Check if the recipient is blocked (banstatus = '1')
$checkBan = $con->prepare("SELECT banstatus FROM receivemessage WHERE FromID = ? AND ToID = ? AND banstatus = '1' LIMIT 1");
$checkBan->bind_param("ss", $matriId, $toMatriId);
$checkBan->execute();
if ($checkBan->get_result()->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Cannot send message to this user due to ban"]);
    exit;
}

// Insert the message into receivemessage table
$sendDate = date('Y-m-d H:i:s'); // Current timestamp
$insertSql = "INSERT INTO receivemessage (FromID, ToID, Msg, SendDate, banstatus) VALUES (?, ?, ?, ?, '0')";
$stmt = $con->prepare($insertSql);
$stmt->bind_param("ssss", $matriId, $toMatriId, $message, $sendDate);
$success = $stmt->execute();

if ($success) {
    // Fetch recipient's profile details for response
    $pstmt = $con->prepare("SELECT MatriID, Name, Photo1 FROM register WHERE MatriID = ?");
    $pstmt->bind_param("s", $toMatriId);
    $pstmt->execute();
    $profileData = $pstmt->get_result()->fetch_assoc();

    // Prepare response consistent with your APIs
    $response = [
        "status" => "success",
        "message" => "Message sent successfully",
        "data" => [
            "MatriID" => $matriId,
            "ToMatriID" => $toMatriId,
            "Message" => $message,
            "SendDate" => $sendDate,
            "Recipient" => [
                "MatriID" => $profileData['MatriID'],
                "Name" => explode(" ", $profileData['Name'])[0], // First name only, as in your APIs
                "Photo" => $profileData['Photo1']
            ]
        ]
    ];
} else {
    $response = ["status" => "error", "message" => "Failed to send message"];
}

// Send response
echo json_encode($response);
?>