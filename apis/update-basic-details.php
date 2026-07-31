<?php
/* SECURITY: verbose error reporting disabled in production. */
/* SECURITY: PHP error display disabled in production. */
/* SECURITY: PHP startup error display disabled in production. */

require_once('../sys_dbconnection.php');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Allow only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Helper function to sanitize input
function safe($db, $key) {
    return isset($_POST[$key]) ? $db->setfilter(trim($_POST[$key])) : '';
}

// Collect inputs
$matriId        = safe($db, 'MatriID');
$name           = safe($db, 'Name');
$dob            = safe($db, 'DOB');
$Height         = safe($db, 'Height');
$email          = safe($db, 'ConfirmEmail');
$gender         = safe($db, 'Gender');
$profileBy      = safe($db, 'Profilecreatedby');
$maritalStatus  = safe($db, 'maritalstatus');
$haveChildren   = safe($db, 'PE_HaveChildren');
$childrenStatus = safe($db, 'childrenlivingstatus');
$childAcceptance = safe($db, 'child_acceptance');
$religion       = safe($db, 'religion');
$caste          = safe($db, 'caste');
$subcaste       = safe($db, 'subcaste');
$countryCode    = safe($db, 'countrycode');
$mobile         = safe($db, 'Mobile');

// New fields
$Weight         = safe($db, 'Weight');
$BloodGroup     = safe($db, 'BloodGroup');
$Complexion     = safe($db, 'Complexion');
$SpecialCases   = safe($db, 'SpecialCases');
$SpecialReason  = safe($db, 'SpecialReason');
$aboutus        = safe($db, 'aboutus');

// Validate required fields
$errors = [];
if (empty($matriId)) $errors[] = "MatriID is required";
if (empty($name)) $errors[] = "Name is required";
if (empty($email)) $errors[] = "Email is required";
if ($childAcceptance !== '' && !in_array($childAcceptance, ['Do Not Accept Children', 'Boy Child', 'Girl Child', 'Both Boy and Girl Child'], true)) {
    $errors[] = "Invalid child acceptance value";
}

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// Calculate age from DOB
$age = null;
if (!empty($dob)) {
    try {
        $birthDate = new DateTime($dob);
        $today = new DateTime('today');
        $age = $birthDate->diff($today)->y;
    } catch (Exception $e) {
        $age = null;
    }
}

// Convert height to cm if in feet.inches format (e.g., 5.7)
if (!empty($Height)) {
    if (strpos($Height, '.') !== false) {
        $parts = explode('.', $Height);
        $feet = (int)$parts[0];
        $inches = (int)$parts[1];
        $Height = ($feet * 30.48) + ($inches * 2.54); // convert to cm
        $Height = round($Height, 2);
    } else {
        $Height = (float)$Height; // assume cm
    }
}

// Prepare SQL statement with new fields
$query = $con->prepare("
    UPDATE register SET
        Name = ?,
        DOB = ?,
        Age = ?,
        Height = ?,
        ConfirmEmail = ?,
        Gender = ?,
        Profilecreatedby = ?,
        maritalstatus = ?,
        PE_HaveChildren = ?,
        childrenlivingstatus = ?,
        child_acceptance = ?,
        religion = ?,
        caste = ?,
        subcaste = ?,
        countrycode = ?,
        Mobile = ?,
        Weight = ?,
        BloodGroup = ?,
        Complexion = ?,
        spe_cases = ?,
        spe_reason = ?,
        aboutus = ?
    WHERE MatriID = ?
");

$query->bind_param(
    "sssssssssssssssssssssss",
    $name, $dob, $age, $Height, $email, $gender, $profileBy,
    $maritalStatus, $haveChildren, $childrenStatus, $childAcceptance,
    $religion, $caste, $subcaste, $countryCode, $mobile,
    $Weight, $BloodGroup, $Complexion, $SpecialCases, $SpecialReason, $aboutus,
    $matriId
);

// Execute and respond
if ($query->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "User details updated successfully",
        "data" => [
            "MatriID" => $matriId,
            "Name" => $name,
            "DOB" => $dob,
            "Age" => $age,
            "Height" => $Height,
            "Email" => $email,
            "Gender" => $gender,
            "Profilecreatedby" => $profileBy,
            "MaritalStatus" => $maritalStatus,
            "NoOfChildren" => $haveChildren,
            "ChildrenStatus" => $childrenStatus,
            "ChildAcceptance" => $childAcceptance,
            "Religion" => $religion,
            "Caste" => $caste,
            "Subcaste" => $subcaste,
            "CountryCode" => $countryCode,
            "Mobile" => $mobile,
            "Weight" => $Weight,
            "BloodGroup" => $BloodGroup,
            "Complexion" => $Complexion,
            "SpecialCases" => $SpecialCases,
            "SpecialReason" => $SpecialReason,
            "aboutus" => $aboutus
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Database update failed"]);
}
?>
