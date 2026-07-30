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
    $sql = "SELECT ID, Moon_Sign 
            FROM moon_sign 
            WHERE status = 'enable' 
            ORDER BY ID ASC";

    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $moonSigns = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $moonSigns[] = [
            "id" => $row['ID'],
            "moon_sign" => $row['Moon_Sign']
        ];
    }

    echo json_encode([
        "status" => "success",
        "message" => "Moon sign list fetched successfully",
        "data" => $moonSigns
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
