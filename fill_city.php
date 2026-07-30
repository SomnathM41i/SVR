<?php
require_once('sys_dbconnection.php');

$taluka = trim((string)($_GET['taluka'] ?? $_GET['q'] ?? ''));
$district = trim((string)($_GET['district'] ?? $_GET['q'] ?? ''));
echo '<option value="">Select City</option>';
if ($taluka === '' && $district === '') {
    exit;
}

$statement = mysqli_prepare(
    $con,
    "SELECT DISTINCT city
     FROM e_city
     WHERE status = 'enable'
       AND (
           taluka_ref = ?
           OR (taluka_ref = '' AND dist_ref = ?)
       )
     ORDER BY city"
);
mysqli_stmt_bind_param($statement, 'ss', $taluka, $district);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
while ($data = mysqli_fetch_assoc($result)) {
    echo '<option value="'.htmlspecialchars($data['city'], ENT_QUOTES, 'UTF-8').'">'
       .htmlspecialchars($data['city'], ENT_QUOTES, 'UTF-8').'</option>';
}
mysqli_stmt_close($statement);
