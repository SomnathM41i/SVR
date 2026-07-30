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
        $sql = "SELECT id, family_typ FROM family_type ORDER BY id ASC";
        $result = mysqli_query($con, $sql);
    
        if (!$result) {
            echo json_encode(["status" => "error", "message" => "Database query failed"]);
            exit;
        }
    
        $familyTypes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $familyTypes[] = [
                "id"         => $row['id'],
                "family_typ" => $row['family_typ']
            ];
        }
    
        echo json_encode([
            "status"  => "success",
            "message" => "Family type list fetched successfully",
            "data"    => $familyTypes
        ]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
?>
