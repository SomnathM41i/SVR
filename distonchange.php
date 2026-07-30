<?php
require_once('sys_dbconnection.php');

$selected = array_values(array_filter(array_map('trim', (array)($_POST['selected'] ?? []))));
echo '<option value="Any">Any</option>';
if (!$selected || in_array('Any', $selected, true)) {
    exit;
}

$quoted = array_map(function ($value) use ($con) {
    return "'".mysqli_real_escape_string($con, $value)."'";
}, $selected);
$query = mysqli_query(
    $con,
    "SELECT DISTINCT dist FROM e_dist
     WHERE status='enable' AND sid2 IN (".implode(',', $quoted).")
     ORDER BY dist ASC"
);
while ($query && ($row = mysqli_fetch_assoc($query))) {
    echo '<option value="'.htmlspecialchars($row['dist'], ENT_QUOTES, 'UTF-8').'">'
       .htmlspecialchars($row['dist'], ENT_QUOTES, 'UTF-8').'</option>';
}
