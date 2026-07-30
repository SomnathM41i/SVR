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
$matriId   = normalizeInput($db, 'MatriID');   // Current user (receiver)
$senderId  = normalizeInput($db, 'SenderID');   // Profile that sent the interest

// Validation
$errors = [];
if (empty($matriId))   $errors[] = "MatriID is required";
if (empty($senderId))  $errors[] = "SenderID is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

try {
    /**
     * STEP 1: Update express interest status to 'Decline'
     */
    $updateStmt = $con->prepare("UPDATE expressinterest SET status = 'Decline' WHERE eireceiver = ? AND eisender = ?");
    $updateStmt->bind_param("ss", $matriId, $senderId);
    $updateSuccess = $updateStmt->execute();

    if (!$updateSuccess || $updateStmt->affected_rows === 0) {
        echo json_encode(["status" => "error", "message" => "No matching express interest found or update failed"]);
        exit;
    }

    /**
     * STEP 2: Response
     */
    echo json_encode([
        "status"  => "success",
        "message" => "Express interest declined successfully",
        "data"    => [
            "MatriID"    => $matriId,
            "SenderID"   => $senderId,
            "DeclinedOn" => date('d-m-Y')
        ]
    ]);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>