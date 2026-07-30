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
    $sql = "SELECT Relation_id, Relation FROM profile ORDER BY Relation ASC";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $relations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $relations[] = [
            "id" => $row['Relation_id'],
            "relation" => $row['Relation']
        ];
    }

    echo json_encode([
        "status" => "success",
        "message" => "Relation list fetched successfully",
        "data" => $relations
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
