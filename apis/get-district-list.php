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

// Check if state id param exists
if (empty($_GET['state'])) {
    echo json_encode(["status" => "error", "message" => "state parameter is required"]);
    exit;
}

$stateId = mysqli_real_escape_string($con, $_GET['state']);

try {
    $sql = "SELECT id, dist 
            FROM e_dist 
            WHERE sid2 = '$stateId' 
              AND status = 'enable' 
            ORDER BY dist ASC";

    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $districts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $districts[] = [
            "id"   => $row['id'],
            "dist" => $row['dist']
        ];
    }

    echo json_encode([
        "status" => "success",
        "message" => "District list fetched successfully",
        "state_id" => $stateId,
        "data" => $districts
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
