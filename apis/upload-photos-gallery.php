<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// ✅ Check if file is uploaded
if (!isset($_FILES['photos']['name']) || empty($_FILES['photos']['name'])) {
    echo json_encode(["status" => "error", "message" => "No photo uploaded"]);
    exit;
}

$target_dir = "../gallary/";
$allowed = ["jpg", "jpeg"];
$uploaded = [];
$errors = [];

// ✅ Normalize files (single or multiple)
$files = [];
if (is_array($_FILES['photos']['name'])) {
    // Multiple files
    for ($i = 0; $i < count($_FILES['photos']['name']); $i++) {
        $files[] = [
            "name" => $_FILES['photos']['name'][$i],
            "tmp_name" => $_FILES['photos']['tmp_name'][$i],
            "size" => $_FILES['photos']['size'][$i],
            "error" => $_FILES['photos']['error'][$i]
        ];
    }
} else {
    // Single file
    $files[] = [
        "name" => $_FILES['photos']['name'],
        "tmp_name" => $_FILES['photos']['tmp_name'],
        "size" => $_FILES['photos']['size'],
        "error" => $_FILES['photos']['error']
    ];
}

// ✅ Process each file
foreach ($files as $file) {
    $name = $file['name'];
    $tmp  = $file['tmp_name'];
    $size = $file['size'];
    $error = $file['error'];

    if ($error !== 0 || !$name) {
        $errors[] = "$name upload error";
        continue;
    }

    // Generate safe filename
    $sav = date('Y_m_d_H_i_s') . "_" . preg_replace("/[^a-z0-9_\-\.]/i", '', basename($name));
    $target_file = $target_dir . $sav;
    $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate extension
    if (!in_array($ext, $allowed)) {
        $errors[] = "$name is not a valid format (only JPG/JPEG allowed)";
        continue;
    }
    // Validate size
    if ($size > 8097152) {
        $errors[] = "$name is too large (max 8MB)";
        continue;
    }

    // Save file
    if (move_uploaded_file($tmp, $target_file)) {
        // Insert into DB
        $stmt = $con->prepare("INSERT INTO gallary (photo_name, matri_id, photo_approve) VALUES (?, ?, 'Pending')");
        $stmt->bind_param("ss", $sav, $matriId);
        $stmt->execute();

        $uploaded[] = [
            "file" => $sav,
            "url"  => "gallary/" . $sav,
            "status" => "Pending"
        ];
    } else {
        $errors[] = "$name upload failed";
    }
}

// ✅ API Response
echo json_encode([
    "status" => "success",
    "uploaded" => $uploaded,
    "errors" => $errors
], JSON_PRETTY_PRINT);
?>
