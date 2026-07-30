<?php
// Include necessary files
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
$limit   = 8;
$offset  = ($page - 1) * $limit;

// Validation
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

/**
 * STEP 1: Get blocked by / blocked profiles
 */
$blockedBy = [];
$q1 = $con->prepare("SELECT matriid FROM block_member WHERE profile_id = ?");
$q1->bind_param("s", $matriId);
$q1->execute();
$res1 = $q1->get_result();
while ($row = $res1->fetch_assoc()) {
    $blockedBy[] = $row['matriid'];
}

$blockedProfiles = [];
$q2 = $con->prepare("SELECT profile_id FROM block_member WHERE matriid = ?");
$q2->bind_param("s", $matriId);
$q2->execute();
$res2 = $q2->get_result();
while ($row = $res2->fetch_assoc()) {
    $blockedProfiles[] = $row['profile_id'];
}

/**
 * STEP 2: Count total accepted express interest requests excluding blocked
 */
$whereNotIn = "";
$params = [$matriId];
$types  = "s";

if (!empty($blockedBy)) {
    $whereNotIn .= " AND eireceiver NOT IN (" . str_repeat('?,', count($blockedBy) - 1) . "?)";
    $params = array_merge($params, $blockedBy);
    $types .= str_repeat("s", count($blockedBy));
}

if (!empty($blockedProfiles)) {
    $whereNotIn .= " AND eireceiver NOT IN (" . str_repeat('?,', count($blockedProfiles) - 1) . "?)";
    $params = array_merge($params, $blockedProfiles);
    $types .= str_repeat("s", count($blockedProfiles));
}

$countSql = "SELECT COUNT(*) as total 
             FROM expressinterest 
             WHERE eisender = ? AND status = 'Accept' AND banstatus != '1' $whereNotIn";

$countQuery = $con->prepare($countSql);
$countQuery->bind_param($types, ...$params);
$countQuery->execute();
$countRes = $countQuery->get_result()->fetch_assoc();
$totalRecords = $countRes['total'] ?? 0;
$totalPages   = ceil($totalRecords / $limit);

/**
 * STEP 3: Fetch accepted express interest requests with pagination
 */
$sql = "SELECT eireceiver, eisentdt 
        FROM expressinterest 
        WHERE eisender = ? AND status = 'Accept' AND banstatus != '1' $whereNotIn 
        ORDER BY eisentdt DESC 
        LIMIT ?, ?";
$params[] = $offset;
$params[] = $limit;
$types   .= "ii";

$stmt = $con->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$profiles = [];
while ($row = $result->fetch_assoc()) {
    $receiverId = $row['eireceiver'];

    // Check if the profile is blocked
    $isBlocked = $con->prepare("SELECT * FROM block_member WHERE matriid = ? AND profile_id = ?");
    $isBlocked->bind_param("ss", $matriId, $receiverId);
    $isBlocked->execute();
    if ($isBlocked->get_result()->num_rows > 0) {
        continue; // Skip blocked profiles
    }

    // Fetch profile details of the receiver
    $pstmt = $con->prepare("SELECT MatriID, Education, Occupation, Age, Height, Photo1, photo_visibility, Photo1Approve 
                            FROM register WHERE MatriID = ?");
    $pstmt->bind_param("s", $receiverId);
    $pstmt->execute();
    $profileData = $pstmt->get_result()->fetch_assoc();

    if ($profileData) {
        $profiles[] = [
            "MatriID"    => $profileData['MatriID'],
            "Education"  => substr($profileData['Education'], 0, 20),
            "Occupation" => substr($profileData['Occupation'], 0, 20),
            "Age"        => $profileData['Age'],
            "Height"     => get_height($profileData['Height']),
            "Photo"      => $profileData['Photo1'],
            "ReceivedOn" => $row['eisentdt']
        ];
    }
}

/**
 * STEP 4: Response
 */
echo json_encode([
    "status" => "success",
    "message" => !empty($profiles) ? "Accepted express interest requests fetched successfully" : "No accepted express interest requests found",
    "pagination" => [
        "current_page" => $page,
        "total_pages"  => $totalPages,
        "total_records"=> $totalRecords,
        "per_page"     => $limit
    ],
    "data" => $profiles
]);

/**
 * Convert height code to readable format
 */
function get_height($strheight) {
    $heights = [
        "1" => "4Ft", "2" => "4Ft 1 inch", "3" => "4Ft 2 inch", "4" => "4Ft 3 inch", "5" => "4Ft 4 inch",
        "6" => "4Ft 5 inch", "7" => "4Ft 6 inch", "8" => "4Ft 7 inch", "9" => "4Ft 8 inch", "10" => "4Ft 9 inch",
        "11" => "4Ft 10 inch", "12" => "4Ft 11 inch", "13" => "5Ft", "14" => "5Ft 1 inch", "15" => "5Ft 2 inch",
        "16" => "5Ft 3 inch", "17" => "5Ft 4 inch", "18" => "5Ft 5 inch", "19" => "5Ft 6 inch", "20" => "5Ft 7 inch",
        "21" => "5Ft 8 inch", "22" => "5Ft 9 inch", "23" => "5Ft 10 inch", "24" => "5Ft 11 inch", "25" => "6Ft",
        "26" => "6Ft 1 inch", "27" => "6Ft 2 inch", "28" => "6Ft 3 inch", "29" => "6Ft 4 inch", "30" => "6Ft 5 inch",
        "31" => "6Ft 6 inch", "32" => "6Ft 7 inch", "33" => "6Ft 8 inch", "34" => "6Ft 9 inch", "35" => "6Ft 10 inch",
        "36" => "6Ft 11 inch", "37" => "7Ft"
    ];
    return $heights[$strheight] ?? "";
}
?>