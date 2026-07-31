<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

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
    // Query all enabled districts
    $sql = "SELECT id, dist, sid2, status 
            FROM e_dist 
            WHERE status = 'enable' 
            ORDER BY dist ASC";

    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $districts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $districts[] = [
            "id"     => $row['id'],
            "dist"   => $row['dist'],
            "state"  => $row['sid2'],
            "status" => $row['status']
        ];
    }

    echo json_encode([
        "status"  => "success",
        "message" => "District list fetched successfully",
        "count"   => count($districts),
        "data"    => $districts
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
