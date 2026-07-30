<?php
require_once('../sys_dbconnection.php');
require_once('../includes/annual_income.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Allow only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Utility: normalize input (handles string or array)
function normalizeInput($db, $key) {
    if (!isset($_POST[$key])) return '';
    $val = $_POST[$key];
    if (is_array($val)) {
        return $db->setfilter(implode(",", $val));
    }
    return $db->setfilter(trim($val));
}

// Collect Inputs
$matriId     = normalizeInput($db, 'MatriID');
$looking     = normalizeInput($db, 'looking');
$fromage     = normalizeInput($db, 'fromage');
$toage       = normalizeInput($db, 'toage');
$expectation = normalizeInput($db, 'expectation');
$heightfrom  = normalizeInput($db, 'heightfrom');
$heightto    = normalizeInput($db, 'heightto');
$caste       = normalizeInput($db, 'caste1') ?: normalizeInput($db, 'caste');
$religion    = normalizeInput($db, 'religion1') ?: normalizeInput($db, 'religion');
$complexion  = normalizeInput($db, 'complexion1') ?: normalizeInput($db, 'complexion');
$rstatus     = normalizeInput($db, 'rstatus1') ?: normalizeInput($db, 'rstatus');
$country     = normalizeInput($db, 'country1') ?: normalizeInput($db, 'country');
$pestate     = normalizeInput($db, 'state1') ?: normalizeInput($db, 'cbostate');
$pedistrict  = normalizeInput($db, 'district');
$petaluka    = normalizeInput($db, 'taluka');
$pecity      = normalizeInput($db, 'city');
$education   = normalizeInput($db, 'education1') ?: normalizeInput($db, 'education');
$occupation  = normalizeInput($db, 'occupation1') ?: normalizeInput($db, 'Occupation');
$income_from = normalizeInput($db, 'income_from');
$income_to   = normalizeInput($db, 'income_to');

// Validation
$errors = [];
if (empty($matriId)) $errors[] = "MatriID is required";
if (empty($looking)) $errors[] = "Looking is required";
if (empty($fromage)) $errors[] = "From age is required";
if (empty($toage))   $errors[] = "To age is required";
if (!annual_income_is_valid($income_from, true)) $errors[] = "A valid minimum annual income is required";
if (!annual_income_is_valid($income_to, true)) $errors[] = "A valid maximum annual income is required";
if (annual_income_is_valid($income_from, true) && annual_income_is_valid($income_to, true) && (int)$income_from > (int)$income_to) {
    $errors[] = "Minimum annual income cannot exceed maximum annual income";
}

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// Update Query
$query = $con->prepare("
    UPDATE register SET
        Looking = ?, 
        PE_FromAge = ?, 
        PE_ToAge = ?, 
        PartnerExpectations = ?, 
        PE_Countrylivingin = ?, 
        PE_from_Height = ?, 
        PE_to_Height = ?, 
        PE_Complexion = ?, 
        PE_Education = ?, 
        PE_Religion = ?, 
        PE_Caste = ?, 
        PE_Residentstatus = ?, 
        PE_State = ?, 
        PE_District = ?,
        PE_Taluka = ?,
        PE_City = ?,
        PE_income_from = ?, 
        PE_income_to = ?, 
        PE_Occupation = ?, 
        reg_step = '9',
        PartnerExpectations_approve = 'No'
    WHERE MatriID = ?
");

$query->bind_param(
    "ssssssssssssssssssss",
    $looking, $fromage, $toage, $expectation, $country,
    $heightfrom, $heightto, $complexion, $education, $religion,
    $caste, $rstatus, $pestate, $pedistrict, $petaluka, $pecity, $income_from, $income_to,
    $occupation, $matriId
);

if ($query->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Partner preferences updated successfully",
        "data" => [
            "MatriID"     => $matriId,
            "Looking"     => $looking,
            "FromAge"     => $fromage,
            "ToAge"       => $toage,
            "Expectation" => $expectation,
            "Country"     => $country,
            "State"       => $pestate,
            "District"    => $pedistrict,
            "Taluka"      => $petaluka,
            "City"        => $pecity,
            "Caste"       => $caste,
            "Religion"    => $religion,
            "Education"   => $education,
            "Occupation"  => $occupation
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Database update failed"]);
}
?>
