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
    
    try {
        $sql = "SELECT id, family_values FROM family_values ORDER BY id ASC";
        $result = mysqli_query($con, $sql);
    
        if (!$result) {
            echo json_encode(["status" => "error", "message" => "Database query failed"]);
            exit;
        }
    
        $values = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $values[] = [
                "id"            => $row['id'],
                "family_values" => $row['family_values']
            ];
        }
    
        echo json_encode([
            "status"  => "success",
            "message" => "Family values list fetched successfully",
            "data"    => $values
        ]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
?>
