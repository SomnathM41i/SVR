<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'sys_dbconnection.php';

mysqli_set_charset($con, 'utf8mb4');

function locationColumnExists(
    mysqli $connection,
    string $table,
    string $column
): bool {
    $statement = mysqli_prepare(
        $connection,
        "SELECT COUNT(*) AS total
         FROM information_schema.COLUMNS
         WHERE TABLE_SCHEMA = DATABASE()
           AND TABLE_NAME = ?
           AND COLUMN_NAME = ?"
    );
    mysqli_stmt_bind_param($statement, 'ss', $table, $column);
    mysqli_stmt_execute($statement);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($statement));
    mysqli_stmt_close($statement);

    return (int)($row['total'] ?? 0) > 0;
}

function addLocationColumn(
    mysqli $connection,
    string $table,
    string $column,
    string $definition
): void {
    if (locationColumnExists($connection, $table, $column)) {
        return;
    }

    mysqli_query(
        $connection,
        "ALTER TABLE `$table` ADD COLUMN `$column` $definition"
    );
}

mysqli_query(
    $con,
    "CREATE TABLE IF NOT EXISTS e_taluka (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        taluka VARCHAR(120) NOT NULL,
        dist_ref VARCHAR(120) NOT NULL,
        state_ref VARCHAR(100) NOT NULL DEFAULT 'Maharashtra',
        status VARCHAR(20) NOT NULL DEFAULT 'enable',
        PRIMARY KEY (id),
        UNIQUE KEY uq_taluka_location (state_ref, dist_ref, taluka),
        KEY idx_taluka_district (dist_ref),
        KEY idx_taluka_name (taluka)
    ) ENGINE=InnoDB
      DEFAULT CHARSET=utf8mb4
      COLLATE=utf8mb4_unicode_ci"
);

addLocationColumn(
    $con,
    'e_city',
    'taluka_ref',
    "VARCHAR(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
     NOT NULL DEFAULT '' AFTER dist_ref"
);
addLocationColumn(
    $con,
    'register',
    'Taluka',
    "VARCHAR(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
     NULL DEFAULT NULL AFTER Dist"
);
addLocationColumn(
    $con,
    'register',
    'working_taluka',
    "VARCHAR(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
     NOT NULL DEFAULT '' AFTER working_dist"
);
addLocationColumn(
    $con,
    'register',
    'PE_Taluka',
    "TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
     NULL AFTER PE_District"
);
addLocationColumn(
    $con,
    'advance_saveandsearch',
    'taluka',
    "TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
     NULL AFTER district"
);

$jsonPath = __DIR__ . DIRECTORY_SEPARATOR . 'maharashtra_talukas.json';
$talukaData = json_decode((string)file_get_contents($jsonPath), true);

if (!is_array($talukaData)) {
    throw new RuntimeException('Maharashtra taluka seed data is invalid.');
}

$districtAliases = [
    'Ahmednagar' => ['Ahilyanagar', 'Ahmednagar'],
    'Aurangabad' => [
        'Chhatrapati Sambhajinagar',
        'Aurangabad',
        'Sambhajinagar (aurangabadh)'
    ],
    'Mumbai Suburban' => ['Mumbai Suburban', 'Bandra'],
    'Osmanabad' => [
        'Dharashiv',
        'Osmanabad',
        'Dharashiv (Osmanabadh)',
        'Dharashib (Osmanabadh)'
    ],
    'Sindhudurg' => ['Sindhudurg', 'Sindudurg'],
    'Solapur' => ['Solapur', 'Sholapur']
];

$districtExistsStatement = mysqli_prepare(
    $con,
    "SELECT id
     FROM e_dist
     WHERE LOWER(TRIM(dist)) = LOWER(TRIM(?))
       AND LOWER(TRIM(sid2)) = 'maharashtra'
     LIMIT 1"
);
$districtInsertStatement = mysqli_prepare(
    $con,
    "INSERT INTO e_dist (dist, sid2, sid, status)
     VALUES (?, 'Maharashtra', 1347, 'enable')"
);
$talukaInsertStatement = mysqli_prepare(
    $con,
    "INSERT INTO e_taluka (taluka, dist_ref, state_ref, status)
     VALUES (?, ?, 'Maharashtra', 'enable')
     ON DUPLICATE KEY UPDATE status = 'enable'"
);

$seededDistricts = [];
$seededTalukas = 0;

foreach ($talukaData as $sourceDistrict => $talukas) {
    $targetDistricts = $districtAliases[$sourceDistrict] ?? [$sourceDistrict];

    foreach ($targetDistricts as $district) {
        mysqli_stmt_bind_param(
            $districtExistsStatement,
            's',
            $district
        );
        mysqli_stmt_execute($districtExistsStatement);
        $districtExists = mysqli_fetch_assoc(
            mysqli_stmt_get_result($districtExistsStatement)
        );

        if (!$districtExists) {
            mysqli_stmt_bind_param(
                $districtInsertStatement,
                's',
                $district
            );
            mysqli_stmt_execute($districtInsertStatement);
        }

        $seededDistricts[$district] = true;

        foreach ($talukas as $taluka) {
            mysqli_stmt_bind_param(
                $talukaInsertStatement,
                'ss',
                $taluka,
                $district
            );
            mysqli_stmt_execute($talukaInsertStatement);
            $seededTalukas++;
        }
    }
}

mysqli_stmt_close($districtExistsStatement);
mysqli_stmt_close($districtInsertStatement);
mysqli_stmt_close($talukaInsertStatement);

mysqli_query(
    $con,
    "UPDATE e_city c
     INNER JOIN e_taluka t
        ON LOWER(TRIM(CONVERT(c.city USING utf8mb4)))
           = LOWER(TRIM(t.taluka))
       AND LOWER(TRIM(CONVERT(c.dist_ref USING utf8mb4)))
           = LOWER(TRIM(t.dist_ref))
     SET c.taluka_ref = t.taluka
     WHERE c.taluka_ref = ''"
);

$officialTalukaCount = array_sum(array_map('count', $talukaData));
$storedTalukaResult = mysqli_query(
    $con,
    "SELECT COUNT(*) AS total FROM e_taluka"
);
$storedTalukaRow = mysqli_fetch_assoc($storedTalukaResult);

echo json_encode(
    [
        'official_district_groups' => count($talukaData),
        'official_talukas' => $officialTalukaCount,
        'supported_district_names' => count($seededDistricts),
        'seed_operations' => $seededTalukas,
        'stored_taluka_rows' => (int)($storedTalukaRow['total'] ?? 0)
    ],
    JSON_PRETTY_PRINT
);
