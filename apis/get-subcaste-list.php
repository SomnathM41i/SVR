<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php'); 

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Allow only GET requests
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(["status" => "error", "message" => "Only GET requests are allowed"]);
    exit;
}

// Get caste parameter if provided
$caste = isset($_GET['caste']) ? trim($_GET['caste']) : '';

// Build SQL query
$sql = "SELECT id, subcast, caste, religion 
        FROM subcaste 
        WHERE status = 'enable'";

if (!empty($caste)) {
    $caste_safe = mysqli_real_escape_string($con, $caste);
    $sql .= " AND caste = '$caste_safe'";
}

$sql .= " ORDER BY subcast ASC";

try {
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $subcastes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $subcastes[] = [
            "id" => $row['id'],
            "subcast" => $row['subcast'],
            "caste" => $row['caste'],
            "religion" => $row['religion']
        ];
    }

    echo json_encode([
        "status" => "success",
        "message" => "Subcaste list fetched successfully",
        "data" => $subcastes
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
