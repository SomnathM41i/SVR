<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php'); 

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Only GET allowed
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(["status" => "error", "message" => "Only GET requests are allowed"]);
    exit;
}

// Get religion parameter (optional now)
$religion = isset($_GET['religion']) ? trim($_GET['religion']) : '';

// Build base SQL
$sql = "SELECT ID, Caste, Religion 
        FROM caste 
        WHERE status = 'enable'";

// Add condition only if religion is provided
if (!empty($religion)) {
    $religion_safe = mysqli_real_escape_string($con, $religion);
    $sql .= " AND Religion = '$religion_safe'";
}

$sql .= " ORDER BY Caste ASC";

try {
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
        exit;
    }

    $castes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $castes[] = [
            "id"       => $row['ID'],
            "caste"    => $row['Caste'],
            "religion" => $row['Religion']
        ];
    }

    echo json_encode([
        "status" => "success",
        "message" => "Caste list fetched successfully",
        "data" => $castes
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
