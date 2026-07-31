<?php
/* SECURITY: verbose error reporting disabled in production. */
/* SECURITY: PHP error display disabled in production. */

require_once('../sys_dbconnection.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// ✅ Allow only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests allowed"]);
    exit;
}

// ✅ Get MatriID
$matriId = $_POST['MatriID'] ?? '';
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

// ✅ Fetch biodata details
$stmt = $con->prepare("SELECT Biodata, Biodata_approve FROM register WHERE MatriID = ?");
$stmt->bind_param("s", $matriId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "status" => "error",
        "message" => "No record found for given MatriID"
    ], JSON_PRETTY_PRINT);
    exit;
}

$row = $result->fetch_assoc();

// ✅ If biodata exists
if (!empty($row['Biodata'])) {
    echo json_encode([
        "status" => "success",
        "MatriID" => $matriId,
        "biodata" => [
            "file"   => $row['Biodata'],
            "url"    => "biodata/" . $row['Biodata'],
            "status" => $row['Biodata_approve'] ?? "Pending"
        ]
    ], JSON_PRETTY_PRINT);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No biodata uploaded"
    ], JSON_PRETTY_PRINT);
}
?>
