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
    $sql = "SELECT id, fromage FROM fromage ORDER BY id ASC";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $fromage_list = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $fromage_list[] = [
            "id"      => $row['id'],
            "fromage" => $row['fromage']
        ];
    }

    echo json_encode([
        "status"  => "success",
        "message" => "Fromage list fetched successfully",
        "data"    => $fromage_list
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
