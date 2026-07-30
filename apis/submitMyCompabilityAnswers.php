<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php'); 

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Only POST allowed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

try {
    // Get MatriID from POST data
    $matriid = isset($_POST['MatriID']) ? mysqli_real_escape_string($con, $_POST['MatriID']) : '';
    if (empty($matriid)) {
        echo json_encode(["status" => "error", "message" => "MatriID is required"]);
        exit;
    }

    // Validate MatriID exists in the database (using register table)
    $userCheck = mysqli_query($con, "SELECT MatriID FROM register WHERE MatriID='$matriid'");
    if (mysqli_num_rows($userCheck) == 0) {
        echo json_encode(["status" => "error", "message" => "Invalid MatriID"]);
        exit;
    }

    // Get POST data, renamed to match question numbers, preserving duplicates
    $que1 = isset($_POST['que1']) ? mysqli_real_escape_string($con, $_POST['que1']) : '';
    $que2 = isset($_POST['que2']) ? mysqli_real_escape_string($con, $_POST['que2']) : '';
    $que3 = isset($_POST['que3']) ? (is_array($_POST['que3']) ? implode(",", array_map('mysqli_real_escape_string', array_fill(0, count($_POST['que3']), $con), $_POST['que3'])) : mysqli_real_escape_string($con, $_POST['que3'])) : '';
    $que4 = isset($_POST['que4']) ? mysqli_real_escape_string($con, $_POST['que4']) : '';
    $que5 = isset($_POST['que5']) ? mysqli_real_escape_string($con, $_POST['que5']) : '';
    $que6 = isset($_POST['que6']) ? mysqli_real_escape_string($con, $_POST['que6']) : '';
    $que7 = isset($_POST['que7']) ? (is_array($_POST['que7']) ? implode(",", array_map('mysqli_real_escape_string', array_fill(0, count($_POST['que7']), $con), $_POST['que7'])) : mysqli_real_escape_string($con, $_POST['que7'])) : '';
    $que8 = isset($_POST['que8']) ? mysqli_real_escape_string($con, $_POST['que8']) : '';
    $que9 = isset($_POST['que9']) ? mysqli_real_escape_string($con, $_POST['que9']) : '';
    $que10 = isset($_POST['que10']) ? mysqli_real_escape_string($con, $_POST['que10']) : '';

    // Validate required fields
    if (empty($que1) || empty($que2) || empty($que4) || empty($que5) || empty($que6) || empty($que8) || empty($que9) || empty($que10)) {
        echo json_encode(["status" => "error", "message" => "All required fields must be filled"]);
        exit;
    }

    // Check if record exists
    $qry = mysqli_query($con, "SELECT * FROM compatibility WHERE MatriID='$matriid'");
    $rowCheck = mysqli_num_rows($qry);
    $existingData = mysqli_fetch_array($qry);
    $date1 = date('d-m-Y');

    if ($rowCheck > 0) {
        // Check if data has changed, preserving duplicates in comparison
        if (
            $existingData['que1'] == $que1 &&
            $existingData['que2'] == $que2 &&
            $existingData['que3'] == $que3 &&
            $existingData['que4'] == $que4 &&
            $existingData['que5'] == $que5 &&
            $existingData['que6'] == $que6 &&
            $existingData['que7'] == $que7 &&
            $existingData['que8'] == $que8 &&
            $existingData['que9'] == $que9 &&
            $existingData['que10'] == $que10
        ) {
            echo json_encode(["status" => "error", "message" => "No changes detected"]);
            exit;
        } else {
            // Update existing record
            $qry = mysqli_query($con, "UPDATE compatibility SET que1='$que1', que2='$que2', que3='$que3', que4='$que4', que5='$que5', que6='$que6', que7='$que7', que8='$que8', que9='$que9', que10='$que10', date='$date1' WHERE MatriID='$matriid'");
            if (!$qry) {
                echo json_encode(["status" => "error", "message" => "Failed to update compatibility"]);
                exit;
            }
            echo json_encode(["status" => "success", "message" => "Compatibility updated successfully"]);
        }
    } else {
        // Insert new record
        $qry = mysqli_query($con, "INSERT INTO compatibility (que1, que2, que3, que4, que5, que6, que7, que8, que9, que10, MatriID, date) VALUES ('$que1', '$que2', '$que3', '$que4', '$que5', '$que6', '$que7', '$que8', '$que9', '$que10', '$matriid', '$date1')");
        if (!$qry) {
            echo json_encode(["status" => "error", "message" => "Failed to insert compatibility"]);
            exit;
        }
        echo json_encode(["status" => "success", "message" => "Compatibility added successfully"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>