<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Utility: normalize input
function normalizeInput($db, $key) {
    if (!isset($_POST[$key])) return '';
    $val = $_POST[$key];
    return $db->setfilter(trim($val)); // Sanitize input using sys_dbconnection filter
}

// Collect Inputs
$matriId   = normalizeInput($db, 'MatriID');   // Current user (sender)
$receiverId = normalizeInput($db, 'ReceiverID'); // Profile to send interest to

// Validation
$errors = [];
if (empty($matriId))   $errors[] = "MatriID is required";
if (empty($receiverId)) $errors[] = "ReceiverID is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

try {
    /**
     * STEP 1: Check if interest already sent
     */
    $checkStmt = $con->prepare("SELECT * FROM expressinterest WHERE eisender = ? AND eireceiver = ?");
    $checkStmt->bind_param("ss", $matriId, $receiverId);
    $checkStmt->execute();
    $checkRes = $checkStmt->get_result();

    if ($checkRes->num_rows > 0) {
        echo json_encode([
            "status"  => "success",
            "message" => "Interest already sent to this profile",
            "data"    => [
                "MatriID"    => $matriId,
                "ReceiverID" => $receiverId
            ]
        ]);
        exit;
    }

    /**
     * STEP 2: Insert new express interest
     */
    $eisentdt = date('d-M-Y');
    $status = 'No';
    $insertStmt = $con->prepare("INSERT INTO expressinterest (eisender, eireceiver, status, eisentdt) 
                                 VALUES (?, ?, ?, ?)");
    $insertStmt->bind_param("ssss", $matriId, $receiverId, $status, $eisentdt);
    $insertSuccess = $insertStmt->execute();

    if (!$insertSuccess) {
        echo json_encode(["status" => "error", "message" => "Failed to send express interest: " . $insertStmt->error]);
        exit;
    }

    /**
     * STEP 3: Response
     */
    echo json_encode([
        "status"  => "success",
        "message" => "Express interest sent successfully",
        "data"    => [
            "MatriID"    => $matriId,
            "ReceiverID" => $receiverId,
            "SentOn"     => $eisentdt
        ]
    ]);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>