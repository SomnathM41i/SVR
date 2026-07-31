<?php
require_once 'sys_dbconnection.php';

mysqli_set_charset($con, 'utf8mb4');

$district = trim((string)($_GET['q'] ?? ''));

echo '<option value="">Select Taluka</option>';

if ($district === '') {
    exit;
}

$statement = mysqli_prepare(
    $con,
    "SELECT DISTINCT taluka
     FROM e_taluka
     WHERE dist_ref = ?
       AND status = 'enable'
     ORDER BY taluka"
);
mysqli_stmt_bind_param($statement, 's', $district);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

while ($row = mysqli_fetch_assoc($result)) {
    $taluka = htmlspecialchars($row['taluka'], ENT_QUOTES, 'UTF-8');
    echo '<option value="' . $taluka . '">' . $taluka . '</option>';
}

mysqli_stmt_close($statement);
