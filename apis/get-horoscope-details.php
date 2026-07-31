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
$matriId = $db->setfilter($_POST['MatriID'] ?? '');

// Validate
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

// Fetch Data
$query = $con->prepare("
    SELECT 
        MatriID, Gothram, Star, Moonsign, charan, Gan, nadi, Horosmatch,
        shani, Manglik, POB, TOB, POC, horodate, kuldivat, devak, navrasnm,
        horoscope, HorosApprove, reg_step
    FROM register
    WHERE MatriID = ?
    LIMIT 1
");
$query->bind_param("s", $matriId);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Build File Path if exists
    $filePath = "";
    if (!empty($row['horoscope'])) {
        $filePath = $row['horoscope'];
        if (file_exists("../kundli/" . $row['horoscope'])) {
            $filePath = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/kundli/" . $row['horoscope'];
        }
    }

    echo json_encode([
        "status" => "success",
        "message" => "Horoscope details fetched successfully",
        "data" => [
            "MatriID"      => $row['MatriID'],
            "Gothra"       => $row['Gothram'],
            "Star"         => $row['Star'],
            "Moonsign"     => $row['Moonsign'],
            "Charan"       => $row['charan'],
            "Gan"          => $row['Gan'],
            "Nadi"         => $row['nadi'],
            "Horosmatch"   => $row['Horosmatch'],
            "Shani"        => $row['shani'],
            "Manglik"      => $row['Manglik'],
            "BirthPlace"   => $row['POB'],
            "BirthTime"    => $row['TOB'],
            "BirthCountry" => $row['POC'],
            "Horodate"     => $row['horodate'],
            "Kuldivat"     => $row['kuldivat'],
            "Devak"        => $row['devak'],
            "Navrasnm"     => $row['navrasnm'],
            "HoroscopeFile"=> $filePath ?: "Not uploaded",
            "HorosApprove" => $row['HorosApprove'],
            "RegStep"      => $row['reg_step']
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No horoscope details found"]);
}
?>
