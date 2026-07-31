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
    "SELECT DISTINCT state FROM e_state
     WHERE status='enable' AND cid IN (".implode(',', $quoted).")
     ORDER BY state ASC"
);
while ($query && ($row = mysqli_fetch_assoc($query))) {
    echo '<option value="'.htmlspecialchars($row['state'], ENT_QUOTES, 'UTF-8').'">'
       .htmlspecialchars($row['state'], ENT_QUOTES, 'UTF-8').'</option>';
}
