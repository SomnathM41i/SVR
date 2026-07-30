<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php'); 
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Collect Inputs
$matriId         = $db->setfilter($_POST['MatriID'] ?? '');
$address         = $db->setfilter($_POST['address'] ?? '');
$country         = $db->setfilter($_POST['country'] ?? '');
$state           = $db->setfilter($_POST['state'] ?? '');  
$city            = $db->setfilter($_POST['city'] ?? '');
$taluka          = $db->setfilter($_POST['taluka'] ?? '');
$phone           = $db->setfilter($_POST['work_phone'] ?? '');
$dist            = $db->setfilter($_POST['dist'] ?? '');
$residence       = $db->setfilter($_POST['residence'] ?? '');
$mobile2         = $db->setfilter($_POST['mobile2'] ?? '');
$mobile          = $db->setfilter($_POST['mobile'] ?? '');
$pincode         = $db->setfilter($_POST['pincode'] ?? '');
$calling         = $db->setfilter($_POST['calling'] ?? '');
$work_residence  = $db->setfilter($_POST['work_residence'] ?? '');
$work_address    = $db->setfilter($_POST['work_address'] ?? '');
$work_pincode    = $db->setfilter($_POST['work_pincode'] ?? '');
$working_city    = $db->setfilter($_POST['working_city'] ?? '');
$working_dist    = $db->setfilter($_POST['working_dist'] ?? '');
$working_taluka  = $db->setfilter($_POST['working_taluka'] ?? '');
$working_state   = $db->setfilter($_POST['working_state'] ?? '');
$working_country = $db->setfilter($_POST['working_country'] ?? '');

// Auto-fill working details if empty
if (
    empty($working_country) && empty($working_state) && empty($working_dist) && empty($working_taluka) &&
    empty($working_city) && empty($work_pincode) && empty($work_address) && empty($work_residence)
) {
    $working_country = $country;
    $working_state   = $state;
    $working_dist    = $dist;
    $working_taluka  = $taluka;
    $working_city    = $city;
    $work_pincode    = $pincode;
    $work_address    = $address;
    $work_residence  = $residence;
}

// Validation
$errors = [];
if (empty($matriId)) $errors[] = "MatriID is required";
if (empty($address)) $errors[] = "Address is required";
if (empty($country)) $errors[] = "Country is required";
if (empty($state)) $errors[]   = "State is required";
if (empty($city)) $errors[]    = "City is required";
if (empty($mobile)) $errors[]  = "Mobile is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// Update Query
$query = $con->prepare("
    UPDATE register SET 
        Address = ?, Country = ?, State = ?, Dist = ?, Taluka = ?, City = ?, Phone = ?, 
        Residencystatus = ?, Mobile2 = ?, Mobile = ?, calling_time = ?, Pincode = ?, 
        working_country = ?, working_state = ?, working_dist = ?, working_taluka = ?, working_city = ?, 
        work_pincode = ?, work_address = ?, work_residence = ?, reg_step = '4'
    WHERE MatriID = ?
");

$query->bind_param(
    "sssssssssssssssssssss",
    $address, $country, $state, $dist, $taluka, $city, $phone,
    $residence, $mobile2, $mobile, $calling, $pincode,
    $working_country, $working_state, $working_dist, $working_taluka, $working_city,
    $work_pincode, $work_address, $work_residence, $matriId
);

if ($query->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Contact details updated successfully",
        "data" => [
            "MatriID" => $matriId,
            "Address" => $address,
            "Taluka" => $taluka,
            "City" => $city,
            "State" => $state,
            "Country" => $country,
            "Mobile" => $mobile
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Database update failed"]);
}
