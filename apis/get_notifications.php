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
$matriId = $db->setfilter($_POST['MatriID'] ?? '');
$page    = isset($_POST['page']) ? (int)$_POST['page'] : 1;

$limit  = 10;
$offset = ($page - 1) * $limit;

// Validation
if (empty($matriId)) {
    echo json_encode([
        "status" => "error",
        "message" => "MatriID is required"
    ]);
    exit;
}

// Count total notifications
$countQuery = $con->prepare("
    SELECT COUNT(*) AS total 
    FROM notifications 
    WHERE notification_profile_id = ?
");
$countQuery->bind_param("s", $matriId);
$countQuery->execute();
$countRes = $countQuery->get_result()->fetch_assoc();

$totalRecords = $countRes['total'] ?? 0;
$totalPages   = ceil($totalRecords / $limit);

// Fetch notifications
$sql = $con->prepare("
    SELECT 
        notification_id,
        notification_title,
        notification_text,
        notification_type,
        notification_profile_id,
        notification_matching_id,
        notification_timestamp,
        notification_seen
    FROM notifications
    WHERE notification_profile_id = ?
    ORDER BY notification_timestamp DESC
    LIMIT ?, ?
");
$sql->bind_param("sii", $matriId, $offset, $limit);
$sql->execute();
$result = $sql->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = [
        "NotificationID"   => $row['notification_id'],
        "Title"            => $row['notification_title'],
        "Message"          => $row['notification_text'],
        "Type"             => $row['notification_type'],
        "ProfileID"        => $row['notification_profile_id'],
        "MatchingID"       => $row['notification_matching_id'],
        "Timestamp"        => $row['notification_timestamp'],
        "TimeAgo"          => timeAgo($row['notification_timestamp']),
        "notification_status" => $row['notification_seen']
    ];
}

// Output
if (!empty($notifications)) {
    echo json_encode([
        "status" => "success",
        "message" => "Notifications fetched successfully",
        "pagination" => [
            "current_page"  => $page,
            "total_pages"   => $totalPages,
            "total_records" => $totalRecords,
            "per_page"      => $limit
        ],
        "data" => $notifications
    ]);
} else {
    echo json_encode([
        "status" => "success",
        "message" => "No notifications found",
        "pagination" => [
            "current_page"  => $page,
            "total_pages"   => $totalPages,
            "total_records" => $totalRecords,
            "per_page"      => $limit
        ],
        "data" => []
    ]);
}

// -------- Helper: Time Ago ----------
function timeAgo($datetime)
{
    $time = strtotime($datetime);
    $diff = time() - $time;

    if ($diff < 60) return $diff . " sec ago";
    if ($diff < 3600) return floor($diff / 60) . " min ago";
    if ($diff < 86400) return floor($diff / 3600) . " hrs ago";
    if ($diff < 604800) return floor($diff / 86400) . " days ago";

    return date("d M Y", $time);
}
?>
