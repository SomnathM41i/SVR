<?php
require_once '../sys_dbconnection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
mysqli_set_charset($con, 'utf8mb4');

$result = mysqli_query(
    $con,
    "SELECT id, taluka, dist_ref, state_ref, status
     FROM e_taluka
     WHERE status = 'enable'
     ORDER BY state_ref, dist_ref, taluka"
);
$talukas = [];

while ($row = mysqli_fetch_assoc($result)) {
    $talukas[] = [
        'id' => (int)$row['id'],
        'taluka' => $row['taluka'],
        'district' => $row['dist_ref'],
        'state' => $row['state_ref'],
        'status' => $row['status']
    ];
}

echo json_encode([
    'status' => 'success',
    'count' => count($talukas),
    'data' => $talukas
], JSON_UNESCAPED_UNICODE);
