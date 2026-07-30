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
    $sql = "SELECT wealth FROM family_wealth ORDER BY wealth ASC";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $wealthList = [];
    $id = 1; // Since no id column exists, generate sequential IDs
    while ($row = mysqli_fetch_assoc($result)) {
        $wealthList[] = [
            "id"     => $id,
            "wealth" => $row['wealth']
        ];
        $id++;
    }

    echo json_encode([
        "status"  => "success",
        "message" => "Family wealth list fetched successfully",
        "data"    => $wealthList
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
