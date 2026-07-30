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
        $sql = "SELECT id, city, taluka_ref, dist_ref, status FROM e_city WHERE status = 'enable' ORDER BY id ASC";
        $result = mysqli_query($con, $sql);
    
        if (!$result) {
            echo json_encode(["status" => "error", "message" => "Database query failed"]);
            exit;
        }
    
        $cities = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $cities[] = [
                "id"     => $row['id'],
                "city"   => $row['city'],
                "taluka" => $row['taluka_ref'],
                "district" => $row['dist_ref'],
                "status" => $row['status']
            ];
        }
    
        echo json_encode([
            "status"  => "success",
            "message" => "Enabled city list fetched successfully",
            "data"    => $cities
        ]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
?>
