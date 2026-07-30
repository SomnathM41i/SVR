<?php
require_once 'sys_dbconnection.php';

mysqli_set_charset($con, 'utf8mb4');

$districts = $_POST['selected'] ?? [];

if (!is_array($districts) || !$districts) {
    exit;
}

$districts = array_values(
    array_filter(
        array_map(
            static fn($district) => trim((string)$district),
            $districts
        )
    )
);

if (!$districts) {
    exit;
}

$placeholders = implode(',', array_fill(0, count($districts), '?'));
$types = str_repeat('s', count($districts));
$statement = mysqli_prepare(
    $con,
    "SELECT DISTINCT taluka
     FROM e_taluka
     WHERE status = 'enable'
       AND dist_ref IN ($placeholders)
     ORDER BY taluka"
);
$references = [];

foreach ($districts as &$district) {
    $references[] = &$district;
}

mysqli_stmt_bind_param($statement, $types, ...$references);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

while ($row = mysqli_fetch_assoc($result)) {
    $taluka = htmlspecialchars($row['taluka'], ENT_QUOTES, 'UTF-8');
    echo '<option value="' . $taluka . '">' . $taluka . '</option>';
}
