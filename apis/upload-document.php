<?php
/* SECURITY: debug output disabled in production - error_reporting(E_ALL); */
/* SECURITY: debug output disabled in production - ini_set('display_errors', 1); */
/* SECURITY: debug output disabled in production - ini_set('display_startup_errors', 1); */

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
$docType  = isset($_POST['doc_type']) ? trim($_POST['doc_type']) : '';

// Validate
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}
if ($docType === '') {
    echo json_encode(["status" => "error", "message" => "Document type is required"]);
    exit;
}
if (!isset($_FILES['uploaded_file']['name']) || empty($_FILES['uploaded_file']['name'])) {
    echo json_encode(["status" => "error", "message" => "No file uploaded"]);
    exit;
}
// print_r($docType); exit;
// File Upload Handling
$target_dir = "../document/";
$sav = date('Y_m_d_H_i_s') . preg_replace("/[^a-z0-9_\-\.]/i", '', basename($_FILES['uploaded_file']["name"]));
$target_file = $target_dir . $sav;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Allowed types
$allowed = ["jpg", "jpeg", "pdf", "doc", "docx"];
if (!in_array($imageFileType, $allowed)) {
    echo json_encode(["status" => "error", "message" => "Invalid file type. Allowed: JPG, JPEG, PDF, DOC, DOCX"]);
    exit;
}

// File size check (max 8 MB)
if ($_FILES["uploaded_file"]["size"] > 8097152) {
    echo json_encode(["status" => "error", "message" => "File is too large (max 8MB)."]);
    exit;
}

// Upload
if (!move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_file)) {
    echo json_encode(["status" => "error", "message" => "File upload failed"]);
    exit;
}

// Save to DB
$date = date('Y-m-d');
$con->query("UPDATE register SET docapprove='No' WHERE MatriID='$matriId'");
$stmt = $con->prepare("INSERT INTO document (Name, MatriID, Date, type, docapprove) VALUES (?, ?, ?, ?, 'No')");
$stmt->bind_param("ssss", $sav, $matriId, $date, $docType);
$stmt->execute();

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
    "message" => "Document uploaded successfully",
    "uploaded" => [
        "file" => $sav,
        "type" => $docType
    ],
    "documents" => $documents
], JSON_PRETTY_PRINT);

?>