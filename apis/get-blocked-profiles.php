<?php
require_once('../sys_dbconnection.php'); 
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Collect Inputs
$matriId = $db->setfilter($_POST['MatriID'] ?? '');
$page    = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit   = 8;
$offset  = ($page - 1) * $limit;

// Validation
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

// Count total
$countQuery = $con->prepare("SELECT COUNT(*) as total FROM block_member WHERE matriid = ?");
$countQuery->bind_param("s", $matriId);
$countQuery->execute();
$countRes = $countQuery->get_result()->fetch_assoc();
$totalRecords = $countRes['total'] ?? 0;
$totalPages = ceil($totalRecords / $limit);

// Fetch blocked profiles
$sql = $con->prepare("
    SELECT b.profile_id, b.when1, r.MatriID, r.Education, r.Occupation, r.Age, r.Height, 
           r.Photo1, r.photo_visibility, r.Photo1Approve 
    FROM block_member b
    INNER JOIN register r ON r.MatriID = b.profile_id
    WHERE b.matriid = ?
    ORDER BY b.when1 DESC
    LIMIT ?, ?
");
$sql->bind_param("sii", $matriId, $offset, $limit);
$sql->execute();
$result = $sql->get_result();

$profiles = [];
while ($row = $result->fetch_assoc()) {
    $profiles[] = [
        "MatriID"    => $row['MatriID'],
        "Education"  => $row['Education'],
        "Occupation" => $row['Occupation'],
        "Age"        => $row['Age'],
        "Height"     => get_height($row['Height']),
        "Photo"      => $row['Photo1'],  // raw photo name, can enhance later
        "BlockedOn"  => $row['when1']
    ];
}

// Output
if (!empty($profiles)) {
    echo json_encode([
        "status" => "success",
        "message" => "Blocked profiles fetched successfully",
        "pagination" => [
            "current_page" => $page,
            "total_pages"  => $totalPages,
            "total_records"=> $totalRecords,
            "per_page"     => $limit
        ],
        "data" => $profiles
    ]);
} else {
    echo json_encode([
        "status" => "success",
        "message" => "No blocked profiles found",
        "pagination" => [
            "current_page" => $page,
            "total_pages"  => $totalPages,
            "total_records"=> $totalRecords,
            "per_page"     => $limit
        ],
        "data" => []
    ]);
}

// height conversion
function get_height($strheight)
{
    $heights = [
        "1"=>"4Ft","2"=>"4Ft 1 inch","3"=>"4Ft 2 inch","4"=>"4Ft 3 inch","5"=>"4Ft 4 inch",
        "6"=>"4Ft 5 inch","7"=>"4Ft 6 inch","8"=>"4Ft 7 inch","9"=>"4Ft 8 inch","10"=>"4Ft 9 inch",
        "11"=>"4Ft 10 inch","12"=>"4Ft 11 inch","13"=>"5Ft","14"=>"5Ft 1 inch","15"=>"5Ft 2 inch",
        "16"=>"5Ft 3 inch","17"=>"5Ft 4 inch","18"=>"5Ft 5 inch","19"=>"5Ft 6 inch","20"=>"5Ft 7 inch",
        "21"=>"5Ft 8 inch","22"=>"5Ft 9 inch","23"=>"5Ft 10 inch","24"=>"5Ft 11 inch","25"=>"6Ft",
        "26"=>"6Ft 1 inch","27"=>"6Ft 2 inch","28"=>"6Ft 3 inch","29"=>"6Ft 4 inch","30"=>"6Ft 5 inch",
        "31"=>"6Ft 6 inch","32"=>"6Ft 7 inch","33"=>"6Ft 8 inch","34"=>"6Ft 9 inch","35"=>"6Ft 10 inch",
        "36"=>"6Ft 11 inch","37"=>"7Ft"
    ];
    return $heights[$strheight] ?? "";
}
?>
