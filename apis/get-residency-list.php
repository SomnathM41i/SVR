<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php'); 

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Only GET allowed
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(["status" => "error", "message" => "Only GET requests are allowed"]);
    exit;
}

try {
    $sql = "SELECT id, residency_status, status 
            FROM residency_status 
            WHERE status = 'enable' 
            ORDER BY residency_status ASC";
            
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $residencies = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $residencies[] = [
            "id"               => $row['id'],
            "residency_status" => $row['residency_status'],
            "status"           => $row['status']
        ];
    }

    echo json_encode([
        "status"  => "success",
        "message" => "Residency status list fetched successfully",
        "data"    => $residencies
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
