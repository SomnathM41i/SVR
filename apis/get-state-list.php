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

// Check if country param exists
if (empty($_GET['country'])) {
    echo json_encode(["status" => "error", "message" => "Country parameter is required"]);
    exit;
}

$country = mysqli_real_escape_string($con, $_GET['country']);

try {
    $sql = "SELECT id, state 
            FROM e_state 
            WHERE cid = '$country' 
              AND status = 'enable' 
            ORDER BY state ASC";

    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $states = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $states[] = [
            "id"    => $row['id'],
            "state" => $row['state']
        ];
    }

    echo json_encode([
        "status" => "success",
        "message" => "State list fetched successfully",
        "country" => $country,
        "data" => $states
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
