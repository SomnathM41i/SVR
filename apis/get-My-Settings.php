<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php'); 

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

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

    // Validate MatriID exists in the database
    $userQuery = mysqli_query($con, "SELECT horoscope_visibility, phone_visibility, photo_visibility FROM register WHERE MatriID='$matriid'");
    
    if (mysqli_num_rows($userQuery) == 0) {
        echo json_encode(["status" => "error", "message" => "Invalid MatriID"]);
        exit;
    }

    // Fetch user settings
    $userData = mysqli_fetch_array($userQuery);
    
    // Prepare response
    $response = [
        "status" => "success",
        "message" => "Settings retrieved successfully",
        "settings" => [
            "horoscope_visibility" => $userData['horoscope_visibility'] ?: "paidhoro",
            "phone_visibility" => $userData['phone_visibility'] ?: "paidphone",
            "photo_visibility" => $userData['photo_visibility'] ?: "paidphoto"
        ]
    ];
    
    echo json_encode($response);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

// Close database connection
mysqli_close($con);
?>