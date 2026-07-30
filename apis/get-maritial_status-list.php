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

try {
    $sql = "SELECT id, status, category_id 
            FROM maritial_status 
            ORDER BY id ASC";

    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $maritialStatuses = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $maritialStatuses[] = [
            "id" => $row['id'],
            "status" => $row['status'],
            "category_id" => $row['category_id']
        ];
    }

    echo json_encode([
        "status" => "success",
        "message" => "Maritial status list fetched successfully",
        "data" => $maritialStatuses
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
