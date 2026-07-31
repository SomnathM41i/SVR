<?php
require_once('includes/bootstrap.php');

$country = trim((string)($_GET['q'] ?? ''));
echo '<option value="">Select State</option>';
if ($country === '') {
    exit;
}

$statement = mysqli_prepare($con, "SELECT DISTINCT state FROM e_state WHERE cid=? AND status='enable' ORDER BY state ASC");
mysqli_stmt_bind_param($statement, 's', $country);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
while ($data = mysqli_fetch_assoc($result)) {
    echo '<option value="'.htmlspecialchars($data['state'], ENT_QUOTES, 'UTF-8').'">'
       .htmlspecialchars($data['state'], ENT_QUOTES, 'UTF-8').'</option>';
}
mysqli_stmt_close($statement);
