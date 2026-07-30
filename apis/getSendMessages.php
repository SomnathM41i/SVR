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

// Utility: normalize input
function normalizeInput($db, $key) {
    if (!isset($_POST[$key])) return '';
    $val = $_POST[$key];
    return $db->setfilter(trim($val)); // Sanitize input using sys_dbconnection filter
}

// Collect Inputs
$matriId = normalizeInput($db, 'MatriID'); // Current logged-in user (sender)
$page    = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit   = 10;
$offset  = ($page - 1) * $limit;

// Validation
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

/**
 * STEP 1: Fetch sent messages by the user
 */
$sql = "SELECT ToID, Msg, SendDate, rid 
        FROM receivemessage 
        WHERE FromID = ? AND banstatus != '1' 
        ORDER BY rid DESC 
        LIMIT ?, ?";
$params = [$matriId, $offset, $limit];
$types  = "sii";

$stmt = $con->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$conversations = [];
$userIds = [];
while ($row = $result->fetch_assoc()) {
    $userIds[] = $row['ToID']; // Collect recipient IDs
}

// Get unique recipients
$userIds = array_unique($userIds);

/**
 * STEP 2: Count total unique recipients
 */
$countSql = "SELECT COUNT(DISTINCT ToID) as total 
             FROM receivemessage 
             WHERE FromID = ? AND banstatus != '1'";
$countQuery = $con->prepare($countSql);
$countQuery->bind_param("s", $matriId);
$countQuery->execute();
$countRes = $countQuery->get_result()->fetch_assoc();
$totalRecords = $countRes['total'] ?? 0;
$totalPages   = ceil($totalRecords / $limit);

/**
 * STEP 3: Fetch profile details and last message for each recipient
 */
$profiles = [];
foreach ($userIds as $userId) {
    // Fetch profile details of the recipient
    $pstmt = $con->prepare("SELECT MatriID, Name, Photo1 
                            FROM register WHERE MatriID = ?");
    $pstmt->bind_param("s", $userId);
    $pstmt->execute();
    $profileData = $pstmt->get_result()->fetch_assoc();

    if ($profileData) {
        // Fetch the latest message sent to this recipient
        $mstmt = $con->prepare("SELECT LEFT(Msg, 100) as text, SendDate 
                                FROM receivemessage 
                                WHERE FromID = ? AND ToID = ? AND banstatus != '1' 
                                ORDER BY rid DESC 
                                LIMIT 1");
        $mstmt->bind_param("ss", $matriId, $userId);
        $mstmt->execute();
        $messageData = $mstmt->get_result()->fetch_assoc();

        // Count total messages sent to this recipient
        $cstmt = $con->prepare("SELECT COUNT(*) as message_count 
                                FROM receivemessage 
                                WHERE FromID = ? AND ToID = ? AND banstatus != '1'");
        $cstmt->bind_param("ss", $matriId, $userId);
        $cstmt->execute();
        $countData = $cstmt->get_result()->fetch_assoc();
        $messageCount = $countData['message_count'] ?? 0;

        $profiles[] = [
            "MatriID"    => $profileData['MatriID'],
            "Name"       => explode(" ", $profileData['Name'])[0], // First name only
            "Photo"      => $profileData['Photo1'],
            "LastMessage"=> $messageData['text'] ?? "",
            "SendDate"   => $messageData['SendDate'] ?? "",
            "MessageCount"=> $messageCount
        ];
    }
}

/**
 * STEP 4: Response
 */
echo json_encode([
    "status" => "success",
    "message" => !empty($profiles) ? "Sent messages fetched successfully" : "No sent messages found",
    "pagination" => [
        "current_page" => $page,
        "total_pages"  => $totalPages,
        "total_records"=> $totalRecords,
        "per_page"     => $limit
    ],
    "data" => $profiles
]);
?>