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
$matriId     = $db->setfilter($_POST['MatriID'] ?? '');
$gothra      = $db->setfilter($_POST['gothra'] ?? '');
$star        = $db->setfilter($_POST['star'] ?? '');
$moonsign    = $db->setfilter($_POST['moonsign'] ?? '');
$charan      = $db->setfilter($_POST['charan'] ?? '');
$gan         = $db->setfilter($_POST['gan'] ?? '');
$nadi        = $db->setfilter($_POST['nadi'] ?? '');
$hmatch      = $db->setfilter($_POST['hmatch'] ?? '');
$shani       = $db->setfilter($_POST['shani'] ?? '');
$manglik     = $db->setfilter($_POST['manglik'] ?? '');
$bcountry    = $db->setfilter($_POST['bcountry'] ?? '');
$bplace      = ucfirst($_POST['bplace'] ?? '');
$devak       = $db->setfilter($_POST['devak'] ?? '');
$kuldivat    = $db->setfilter($_POST['kuldivat'] ?? '');
$navrasnm    = $db->setfilter($_POST['navrasnm'] ?? '');
$btime       = ($_POST['bhour'] ?? '') . ":" . ($_POST['bminute'] ?? '') . ":" . ($_POST['bsecond'] ?? '') . " " . ($_POST['bampm'] ?? '');

$horodate = date('Y-m-d');

// Validate
$errors = [];
if (empty($matriId)) $errors[] = "MatriID is required";
// if (empty($gothra)) $errors[]  = "Gothra is required";
// if (empty($star)) $errors[]    = "Star is required";
// if (empty($moonsign)) $errors[]= "Moonsign is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// File upload
$sav = "";
if (isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name'])) {
    $target_dir = "../kundli/";
    $sav = date('Y_m_d_H_i_s') . preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload']["name"]));
    $target_file = $target_dir . $sav;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($_FILES["fileToUpload"]["size"] > 8097152) {
        echo json_encode(["status" => "error", "message" => "File is too large (max 8MB)."]);
        exit;
    }
    if (!in_array($imageFileType, ["jpg", "jpeg"])) {
        echo json_encode(["status" => "error", "message" => "Only JPG, JPEG files are allowed."]);
        exit;
    }
    if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo json_encode(["status" => "error", "message" => "File upload failed."]);
        exit;
    }
}

// Update DB
$query = $con->prepare("
    UPDATE register SET
        Gothram = ?, Star = ?, Moonsign = ?, charan = ?, Gan = ?, nadi = ?, Horosmatch = ?, 
        shani = ?, Manglik = ?, POB = ?, TOB = ?, POC = ?, horodate = ?, kuldivat = ?, devak = ?, navrasnm = ?,
        reg_step = '3', HorosApprove = 'No'" . (!empty($sav) ? ", horoscope = ?" : "") . "
    WHERE MatriID = ?
");

if (!empty($sav)) {
    // With file → 18 variables → need 18 "s"
    $query->bind_param(
        "ssssssssssssssssss",
        $gothra, $star, $moonsign, $charan, $gan, $nadi, $hmatch,
        $shani, $manglik, $bplace, $btime, $bcountry, $horodate, 
        $kuldivat, $devak, $navrasnm, $sav, $matriId
    );
} else {
    // Without file → 17 variables → need 17 "s"
    $query->bind_param(
        "sssssssssssssssss",
        $gothra, $star, $moonsign, $charan, $gan, $nadi, $hmatch,
        $shani, $manglik, $bplace, $btime, $bcountry, $horodate, 
        $kuldivat, $devak, $navrasnm, $matriId
    );
}

if ($query->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Horoscope updated successfully",
        "data" => [
            "MatriID" => $matriId,
            "Gothra" => $gothra,
            "Star" => $star,
            "Moonsign" => $moonsign,
            "HoroscopeFile" => $sav ?: "Not uploaded"
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Database update failed"]);
}
?>
