<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php');
require_once('../includes/annual_income.php');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Only GET allowed
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(["status" => "error", "message" => "Only GET requests are allowed"]);
    exit;
}

try {
    $incomes = [];

    foreach (annual_income_options() as $value => $label) {
        $incomes[] = [
            "id" => (string)$value,
            "value" => (string)$value,
            "income" => $label
        ];
    }

    echo json_encode([
        "status"  => "success",
        "message" => "Income list fetched successfully",
        "data"    => $incomes
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
