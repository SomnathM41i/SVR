<?php
// Uncomment these during development if needed
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php');
require_once('../includes/annual_income.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Collect Inputs
$matriId     = $db->setfilter($_POST['MatriID'] ?? '');
$education   = $db->setfilter($_POST['education'] ?? '');
$edetails    = $db->setfilter(ucfirst($_POST['edetails'] ?? ''));
$income = annual_income_normalize_value($_POST['Annualincome'] ?? '');
$inr = 'Rs';
$occupation  = $db->setfilter(ucfirst($_POST['occupation'] ?? ''));
$odetails    = $db->setfilter(ucfirst($_POST['odetails'] ?? ''));
$employedin  = $db->setfilter($_POST['employedin'] ?? '');
$workloc     = $db->setfilter($_POST['workloc'] ?? '');
$workinghrs  = $db->setfilter($_POST['workinghrs'] ?? '');
$iit         = $db->setfilter($_POST['iit'] ?? '');
$instu       = $db->setfilter($_POST['instu'] ?? '');
$edudate     = date('d-m-Y');

// Validation
$errors = [];
if (empty($matriId))    $errors[] = "MatriID is required";
if (empty($education))  $errors[] = "Education is required";
if (!annual_income_is_valid($income)) $errors[] = "Please select a valid annual income";
if (empty($occupation)) $errors[] = "Occupation is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// Check current registration step
$check = $con->prepare("SELECT reg_step FROM register WHERE MatriID = ?");
$check->bind_param("s", $matriId);
$check->execute();
$result = $check->get_result();
$row = $result->fetch_assoc();

if ($row && $row['reg_step'] == "3") {
    $con->query("UPDATE register SET reg_step='4' WHERE MatriID='$matriId'");
}

// Update education & career details
$query = $con->prepare("
    UPDATE register SET 
        Education = ?, 
        EducationDetails = ?, 
        Annualincome = ?, 
        income_in = ?, 
        Occupation = ?, 
        occu_details = ?, 
        Employedin = ?, 
        working_hours = ?, 
        workinglocation = ?, 
        edudate = ?, 
        iit = ?, 
        instu = ?, 
        reg_step = '5'
    WHERE MatriID = ?
");

$query->bind_param(
    "sssssssssssss",
    $education, $edetails, $income, $inr,
    $occupation, $odetails, $employedin, $workinghrs, $workloc,
    $edudate, $iit, $instu, $matriId
);

// Execute update
if ($query->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Education & career details updated successfully",
        "data" => [
            "MatriID"    => $matriId,
            "Education"  => $education,
            "Occupation" => $occupation,
            "Income"     => $income . " " . $inr,
            "Work"       => $workloc
        ]
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Database update failed",
        "error"   => $query->error // helpful for debugging
    ]);
}
?>
