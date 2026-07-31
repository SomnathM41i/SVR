<?php
/* SECURITY: verbose error reporting disabled in production. */
/* SECURITY: PHP error display disabled in production. */
/* SECURITY: PHP startup error display disabled in production. */

require_once('../sys_dbconnection.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Collect Inputs
$matriId  = $db->setfilter($_POST['MatriID'] ?? '');

// Validate
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

// Fetch all documents for this user
$docs = $con->prepare("SELECT * FROM document WHERE MatriID = ?");
$docs->bind_param("s", $matriId);
$docs->execute();
$result = $docs->get_result();

$documents = [];
while ($doc = $result->fetch_assoc()) {
    $documents[] = [
        "id" => $doc['doc_id'],
        "name" => $doc['Name'],
        "type" => $doc['type'],
        "date" => $doc['Date'],
        "status" => $doc['docapprove'],
        "url" => "document/" . $doc['Name']
    ];
}

// ✅ API Response
echo json_encode([
    "status" => "success",
    "message" => count($documents) ? "Documents fetched successfully" : "No documents found",
    "documents" => $documents
], JSON_PRETTY_PRINT);

?>
