<?php
require_once('includes/bootstrap.php');

$state = trim((string)($_GET['q'] ?? ''));
echo '<option value="">Select District</option>';
if ($state === '') {
    exit;
}

$statement = mysqli_prepare($con, "SELECT DISTINCT dist FROM e_dist WHERE sid2=? AND status='enable' ORDER BY dist ASC");
mysqli_stmt_bind_param($statement, 's', $state);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
while ($data = mysqli_fetch_assoc($result)) {
    echo '<option value="'.htmlspecialchars($data['dist'], ENT_QUOTES, 'UTF-8').'">'
       .htmlspecialchars($data['dist'], ENT_QUOTES, 'UTF-8').'</option>';
}
mysqli_stmt_close($statement);
