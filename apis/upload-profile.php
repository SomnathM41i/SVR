<?php
/* SECURITY: verbose error reporting disabled in production. */
/* SECURITY: PHP error display disabled in production. */

require_once('../sys_dbconnection.php');
// include('memprotect1.php');

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


if (!isset($_FILES['profile']['name']) || empty($_FILES['profile']['name'])) {
    echo json_encode(["status" => "error", "message" => "No profile uploaded"]);
    exit;
}

$target_dir = "../gallary/";
$allowed = ["jpg", "jpeg", "png"];
$max_size = 8097152; // 8MB

$file = $_FILES['profile'];
$name = $file['name'];
$tmp  = $file['tmp_name'];
$size = $file['size'];
$error = $file['error'];

if ($error !== 0 || !$name) {
    echo json_encode(["status" => "error", "message" => "$name upload error"]);
    exit;
}


$sav = date('Y_m_d_H_i_s') . "_" . preg_replace("/[^a-z0-9_\-\.]/i", '', basename($name));
$target_file = $target_dir . $sav;
$ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


if (!in_array($ext, $allowed)) {
    echo json_encode(["status" => "error", "message" => "$name is not a valid format (only JPG/JPEG allowed)"]);
    exit;
}


if ($size > $max_size) {
    echo json_encode(["status" => "error", "message" => "$name is too large (max 8MB)"]);
    exit;
}


if (move_uploaded_file($tmp, $target_file)) {
    
    mysqli_query($con, "UPDATE register SET Photo1='$sav' WHERE MatriID='$matriId'");
    mysqli_query($con, "INSERT INTO gallary(photo_name, matri_id) VALUES('$sav', '$matriId')") or svr_db_fail($con);

    echo json_encode([
        "status" => "success",
        "uploaded" => [
            "file" => $sav,
            "url"  => $target_dir . $sav,
            "status" => "Pending"
        ]
    ], JSON_PRETTY_PRINT);
} else {
    echo json_encode(["status" => "error", "message" => "Error uploading $name"]);
}
?>
