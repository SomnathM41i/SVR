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

$districtId = trim((string)($_GET['district'] ?? ''));
$taluka = trim((string)($_GET['taluka'] ?? ''));

if ($districtId === '' && $taluka === '') {
    echo json_encode(["status" => "error", "message" => "district or taluka parameter is required"]);
    exit;
}

try {
    $statement = mysqli_prepare(
        $con,
        "SELECT id, city
         FROM e_city
         WHERE status = 'enable'
           AND (
               taluka_ref = ?
               OR (taluka_ref = '' AND dist_ref = ?)
           )
         ORDER BY city"
    );
    mysqli_stmt_bind_param($statement, 'ss', $taluka, $districtId);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $cities = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $cities[] = [
            "id"   => $row['id'],
            "city" => $row['city']
        ];
    }

    echo json_encode([
        "status" => "success",
        "message" => "City list fetched successfully",
        "district_id" => $districtId,
        "taluka" => $taluka,
        "data" => $cities
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
