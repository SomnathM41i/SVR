<?php
require_once'includes/bootstrap.php';

mysqli_set_charset($con, 'utf8mb4');

$talukas = $_POST['selected'] ?? [];

if (!is_array($talukas) || !$talukas) {
    exit;
}

$talukas = array_values(
    array_filter(
        array_map(
            static fn($taluka) => trim((string)$taluka),
            $talukas
        )
    )
);

if (!$talukas) {
    exit;
}

$placeholders = implode(',', array_fill(0, count($talukas), '?'));
$types = str_repeat('s', count($talukas));
$statement = mysqli_prepare(
    $con,
    "SELECT DISTINCT city
     FROM e_city
     WHERE status = 'enable'
       AND taluka_ref IN ($placeholders)
     ORDER BY city"
);
$references = [];

foreach ($talukas as &$taluka) {
    $references[] = &$taluka;
}

mysqli_stmt_bind_param($statement, $types, ...$references);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

while ($row = mysqli_fetch_assoc($result)) {
    $city = htmlspecialchars($row['city'], ENT_QUOTES, 'UTF-8');
    echo '<option value="' . $city . '">' . $city . '</option>';
}
