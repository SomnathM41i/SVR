<?php
/* SECURITY: debug output disabled in production - error_reporting(E_ALL); */
/* SECURITY: debug output disabled in production - ini_set('display_errors', 1); */

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

// ✅ Validate file input
if (!isset($_FILES['biodata']['name']) || empty($_FILES['biodata']['name'])) {
    echo json_encode(["status" => "error", "message" => "No biodata file uploaded"]);
    exit;
}

$target_dir = "../biodata/";
$allowed = ["jpg", "jpeg", "pdf"];
$errors = [];
$uploaded = [];

// ✅ Handle single or multiple uploads
$files = [];
if (is_array($_FILES['biodata']['name'])) {
    // Multiple files (but usually only one biodata)
    for ($i = 0; $i < count($_FILES['biodata']['name']); $i++) {
        $files[] = [
            "name" => $_FILES['biodata']['name'][$i],
            "tmp_name" => $_FILES['biodata']['tmp_name'][$i],
            "size" => $_FILES['biodata']['size'][$i],
            "error" => $_FILES['biodata']['error'][$i]
        ];
    }
} else {
    // Single file
    $files[] = [
        "name" => $_FILES['biodata']['name'],
        "tmp_name" => $_FILES['biodata']['tmp_name'],
        "size" => $_FILES['biodata']['size'],
        "error" => $_FILES['biodata']['error']
    ];
}

// ✅ Process each file
foreach ($files as $file) {
    $name  = $file['name'];
    $tmp   = $file['tmp_name'];
    $size  = $file['size'];
    $error = $file['error'];

    if ($error !== 0 || !$name) {
        $errors[] = "$name upload error";
        continue;
    }

    $sav = date('Y_m_d_H_i_s') . "_" . preg_replace("/[^a-z0-9_\-\.]/i", '', basename($name));
    $target_file = $target_dir . $sav;
    $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate file extension
    if (!in_array($ext, $allowed)) {
        $errors[] = "$name is not a valid format (only JPG, JPEG, PDF allowed)";
        continue;
    }
    // Validate size (8MB max)
    if ($size > 8097152) {
        $errors[] = "$name is too large (max 8MB)";
        continue;
    }

    // Save file
    if (move_uploaded_file($tmp, $target_file)) {
        // ✅ Update biodata in register table
        $stmt = $con->prepare("UPDATE register SET Biodata = ?, Biodata_approve = '' WHERE MatriID = ?");
        $stmt->bind_param("ss", $sav, $matriId);
        $stmt->execute();

        $uploaded[] = [
            "file" => $sav,
            "url"  => "biodata/" . $sav,
            "status" => "Pending"
        ];
    } else {
        $errors[] = "$name upload failed";
    }
}

// ✅ Response
if (!empty($uploaded)) {
    echo json_encode([
        "status" => "success",
        "message" => "Biodata uploaded successfully",
        "uploaded" => $uploaded,
        "errors" => $errors
    ], JSON_PRETTY_PRINT);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No biodata uploaded",
        "errors" => $errors
    ], JSON_PRETTY_PRINT);
}
?>
