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
    $sql = "SELECT planid, plandisplayname, planamount, planduration, plannoofcontacts, 
                   description1, description2, description3, description4, description5, description6, description7 
            FROM membershipplan WHERE plan_status = 'Active' ORDER BY planid ASC";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Prepare failed: " . $con->error, "sql" => $sql]);
        exit;
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $plans = [];
    while ($row = $result->fetch_assoc()) {
        $plan = [
            "planid" => $row['planid'],
            "plandisplayname" => $row['plandisplayname'],
            "planamount" => $row['planamount'],
            "planduration" => $row['planduration'],
            "plannoofcontacts" => $row['plannoofcontacts']
        ];
        // Add descriptions only if they exist
        $descriptions = [];
        for ($i = 1; $i <= 7; $i++) {
            if (!empty($row["description$i"])) {
                $descriptions[] = $row["description$i"];
            }
        }
        if (!empty($descriptions)) {
            $plan["descriptions"] = $descriptions;
        }
        $plans[] = $plan;
    }

    echo json_encode([
        "status"  => "success",
        "message" => !empty($plans) ? "Membership plans fetched successfully" : "No active membership plans found",
        "data"    => $plans
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>