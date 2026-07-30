<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php'); 
require_once('../agent_commission_lib.php');
include('../auto_approve.php');       

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Collect inputs
$fname    = $db->setfilter($_POST['fname'] ?? '');
$lname    = $db->setfilter($_POST['lname'] ?? '');
$email    = $db->setfilter($_POST['email'] ?? '');
$pass     = $db->setfilter($_POST['pass'] ?? '');
$gender   = $db->setfilter($_POST['gender'] ?? '');
$dobDay   = $db->setfilter($_POST['dob'] ?? '');
$dobMonth = $db->setfilter($_POST['dobMonth'] ?? '');
$dobYear  = $db->setfilter($_POST['dobYear'] ?? '');

// New params
$Profilecreatedby     = $db->setfilter($_POST['Profilecreatedby'] ?? '');
$maritalstatus  = $db->setfilter($_POST['maritalstatus'] ?? '');
$noofchildren   = $db->setfilter($_POST['noofchildren'] ?? '');
$childrenstatus = $db->setfilter($_POST['childrenstatus'] ?? '');
$childAcceptance = $db->setfilter($_POST['child_acceptance'] ?? '');
$religion       = $db->setfilter($_POST['religion'] ?? '');
$caste          = $db->setfilter($_POST['caste'] ?? '');
$subcaste       = $db->setfilter($_POST['subcaste'] ?? '');
$countrycode    = $db->setfilter($_POST['countrycode'] ?? '');
// $district    = $db->setfilter($_POST['district'] ?? '');
$mobile         = $db->setfilter($_POST['mobile'] ?? '');
$aboutus        = $db->setfilter($_POST['aboutus'] ?? '');

// Build DOB
$dob = "$dobYear-$dobMonth-$dobDay";

// Validate inputs
$errors = [];
if (empty($fname)) $errors[] = "First name is required";
if (empty($lname)) $errors[] = "Last name is required";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
if (empty($pass) || strlen($pass) < 4) $errors[] = "Password must be at least 4 characters";
if (empty($dobYear) || empty($dobMonth) || empty($dobDay)) $errors[] = "Date of Birth is required";
if (empty($gender)) $errors[] = "Gender is required";
if (empty($mobile)) $errors[] = "Mobile number is required";
if ($childAcceptance !== '' && !in_array($childAcceptance, ['Do Not Accept Children', 'Boy Child', 'Girl Child', 'Both Boy and Girl Child'], true)) {
    $errors[] = "Invalid child acceptance value";
}

// Check duplicate email
if (empty($errors)) {
    $emailCheck = $con->prepare("SELECT ConfirmEmail FROM register WHERE ConfirmEmail = ?");
    $emailCheck->bind_param("s", $email);
    $emailCheck->execute();
    if ($emailCheck->get_result()->num_rows > 0) {
        $errors[] = "Email already registered";
    }
}

if (empty($errors)) {
    $mobileCheck = $con->prepare("SELECT Mobile FROM register WHERE Mobile = ?");
    $mobileCheck->bind_param("s", $mobile);
    $mobileCheck->execute();
    if ($mobileCheck->get_result()->num_rows > 0) {
        $errors[] = "Mobile number already registered";
    }
}

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// Calculate Age
try {
    $dobDate = new DateTime($dob);
    $today   = new DateTime();
    $diff    = $today->diff($dobDate);

    $age  = $diff->y . " Years " . $diff->m . " Months " . $diff->d . " Days";
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Invalid DOB"]);
    exit;
}

// Generate MatriID
$resMax = mysqli_query($con, "SELECT MAX(id) AS max FROM register");
$rowMax = mysqli_fetch_assoc($resMax);
$RID = $rowMax['max'] + 1;

$resSite = mysqli_query($con, "SELECT prefix FROM siteconfig");
$rowSite = mysqli_fetch_assoc($resSite);
$prefix = $rowSite['prefix'];
$matriId = $prefix . $RID;

$checkQuery = mysqli_query(
    $con,
    "SELECT 1 FROM register WHERE MatriID = '" . mysqli_real_escape_string($con, $matriId) . "' LIMIT 1"
);

if (mysqli_num_rows($checkQuery) > 0) {
    // MatriID already exists → generate new one using timestamp
    $matriId = $prefix . time();

}

$name = ucfirst($fname) . " " . ucfirst($lname);
$auto_approve = 1;
// Insert record
$query = $con->prepare("
    INSERT INTO register 
    (Name, DOB, ConfirmEmail, ConfirmPassword, MatriID, Gender, Age,
     Profilecreatedby, maritalstatus, PE_HaveChildren, childrenlivingstatus, child_acceptance, religion, caste, subcaste,
     countrycode, Mobile, aboutus,
     Status, otp, Regdate, Termsofservice, Photo1, theme, visibility, follow,
     horoscope_visibility, memtype, auto_approve, profile_approve, franch_pay, reg_step, photo_visibility, phone_visibility) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?,
            'Active', 'yes', NOW(), 'I Agree T&c', 'nophoto.jpg', '9', 'Yes',
            'visible', 'paidhoro', 'Free', ?, 'No', 'NotPaid', '1', 'allphoto', 'paidphone')
");

// $query->bind_param(
//     "ssssssssssssssssssi",
//     $name, $dob, $email, $pass, $matriId, $gender, $age,
//     $Profilecreatedby, $maritalstatus, $noofchildren, $childrenstatus, $religion, $caste, $subcaste,
//     $countrycode, $mobile, $aboutus,
//     $auto_on_off, $auto_approve
// );

$auto_approve = 1;

$query->bind_param(
    "ssssssssssssssssssi",
    $name,
    $dob,
    $email,
    $pass,
    $matriId,
    $gender,
    $age,
    $Profilecreatedby,
    $maritalstatus,
    $noofchildren,
    $childrenstatus,
    $childAcceptance,
    $religion,
    $caste,
    $subcaste,
    $countrycode,
    $mobile,
    $aboutus,
    $auto_approve
);

if ($query->execute()) {
    agent_link_registered_customer($con, mysqli_insert_id($con), $matriId, $mobile, $email);
    echo json_encode([
        "status" => "success",
        "message" => "Registration successful",
        "data" => [
            "MatriID" => $matriId,
            "Name"    => $name,
            "Email"   => $email,
            "Gender"  => $gender,
            "Mobile"  => $mobile,
            "password"  => $pass,
            "Age"     => $age
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Registration failed. Please try again."]);
}
?>
