<?php
/* SECURITY: debug output disabled in production - error_reporting(E_ALL); */
/* SECURITY: debug output disabled in production - ini_set('display_errors', 1); */

require_once('../sys_dbconnection.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests allowed"]);
    exit;
}

$matriId = $_POST['MatriID'] ?? '';
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

$docs = $con->prepare("SELECT * FROM gallary WHERE matri_id = ?");
$docs->bind_param("s", $matriId);
$docs->execute();
$result = $docs->get_result();

$photos = [];
while ($row = $result->fetch_assoc()) {
    $photos[] = [
        "id" => $row['photo_id'],
        "name" => $row['photo_name'],
        "status" => $row['photo_approve'],
        "url" => "https://weddingsparampara.com/gallary/" . $row['photo_name']
    ];
}

echo json_encode([
    "status" => "success",
    "message" => count($photos) ? "Gallery fetched" : "No photos found",
    "gallery" => $photos
], JSON_PRETTY_PRINT);
?>