<?php
require_once '../sys_dbconnection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
mysqli_set_charset($con, 'utf8mb4');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Only GET requests are allowed'
    ]);
    exit;
}

$district = trim((string)($_GET['district'] ?? ''));

if ($district === '') {
    http_response_code(422);
    echo json_encode([
        'status' => 'error',
        'message' => 'district parameter is required'
    ]);
    exit;
}

$statement = mysqli_prepare(
    $con,
    "SELECT id, taluka
     FROM e_taluka
     WHERE dist_ref = ?
       AND status = 'enable'
     ORDER BY taluka"
);
mysqli_stmt_bind_param($statement, 's', $district);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$talukas = [];

while ($row = mysqli_fetch_assoc($result)) {
    $talukas[] = [
        'id' => (int)$row['id'],
        'taluka' => $row['taluka']
    ];
}

echo json_encode([
    'status' => 'success',
    'district' => $district,
    'count' => count($talukas),
    'data' => $talukas
], JSON_UNESCAPED_UNICODE);
