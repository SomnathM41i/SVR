<?php
/* SECURITY: debug output disabled in production - error_reporting(E_ALL); */
/* SECURITY: debug output disabled in production - ini_set('display_errors', 1); */
/* SECURITY: debug output disabled in production - ini_set('display_startup_errors', 1); */

require_once('../sys_dbconnection.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Allow only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Collect Inputs
$matriId        = $db->setfilter($_POST['MatriID'] ?? '');
$fvalues        = $db->setfilter($_POST['fvalues'] ?? '');
$ftype          = $db->setfilter($_POST['ftype'] ?? '');
$fstatus        = $db->setfilter($_POST['fstatus'] ?? '');
$relative       = $db->setfilter($_POST['relative'] ?? '');
$mother_tongue  = $db->setfilter($_POST['mother_tounge'] ?? '');
$brothers       = $db->setfilter($_POST['brothers'] ?? '');
$sisters        = $db->setfilter($_POST['sisters'] ?? '');
$bmarried       = $db->setfilter($_POST['bmarried'] ?? '');
$smarried       = $db->setfilter($_POST['smarried'] ?? '');
$father         = $db->setfilter($_POST['father'] ?? '');
$fatherOcc      = $db->setfilter($_POST['fatherOccupation'] ?? '');
$mother         = $db->setfilter($_POST['mother'] ?? '');
$motherOcc      = $db->setfilter($_POST['motheroccupation'] ?? '');
$property       = $db->setfilter($_POST['property'] ?? '');
$living_status  = $db->setfilter($_POST['living_status'] ?? '');
$aboutfamily    = $db->setfilter($_POST['aboufamily'] ?? '');
$uncleName      = $db->setfilter($_POST['unclename'] ?? '');
$uncleCity      = $db->setfilter($_POST['unclecity'] ?? '');
if (isset($_POST['family_wealth'])) {
    if (is_array($_POST['family_wealth'])) {
        $family_wealth = implode(", ", $_POST['family_wealth']);
    } else {
        $family_wealth = $db->setfilter($_POST['family_wealth']);
    }
} else {
    $family_wealth = '';
}

$famdate        = date('d-m-Y');

// Validation
$errors = [];
// if (empty($matriId))   $errors[] = "MatriID is required";
// if (empty($fvalues))   $errors[] = "Family values is required";
// if (empty($ftype))     $errors[] = "Family type is required";
// if (empty($fstatus))   $errors[] = "Family status is required";
// if (empty($father))    $errors[] = "Father name is required";
// if (empty($mother))    $errors[] = "Mother name is required";

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    exit;
}

// Check reg_step and upgrade if necessary
$check = $con->prepare("SELECT reg_step FROM register WHERE MatriID = ?");
$check->bind_param("s", $matriId);
$check->execute();
$result = $check->get_result();
$row = $result->fetch_assoc();

if ($row && $row['reg_step'] == "4") {
    $con->query("UPDATE register SET reg_step='5' WHERE MatriID='$matriId'");
}

// Update query
$query = $con->prepare("
    UPDATE register SET 
        Familyvalues = ?, FamilyType = ?, FamilyStatus = ?, noofbrothers = ?, noofsisters = ?, 
        nbm = ?, nsm = ?, Fathername = ?, Fathersoccupation = ?, Mothersname = ?, Mothersoccupation = ?, 
        mother_tounge = ?, relatives = ?, property = ?, parents_stay = ?, FamilyDetails = ?, 
        family_wealth = ?, FamilyDetails_approve = 'No', famdate = ?, unclecity = ?, unclename = ?, 
        reg_step = '6'
    WHERE MatriID = ?
");

$query->bind_param(
    "sssssssssssssssssssss",   // 21 params
    $fvalues, $ftype, $fstatus, $brothers, $sisters,
    $bmarried, $smarried, $father, $fatherOcc, $mother, $motherOcc,
    $mother_tongue, $relative, $property, $living_status, $aboutfamily,
    $family_wealth, $famdate, $uncleCity, $uncleName, $matriId
);

// Execute update
if ($query->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Family details updated successfully",
        "data" => [
            "MatriID"       => $matriId,
            "FamilyValues"  => $fvalues,
            "FamilyType"    => $ftype,
            "FamilyStatus"  => $fstatus,
            "Brothers"      => $brothers,
            "Sisters"       => $sisters,
            "Father"        => $father,
            "Mother"        => $mother,
            "FamilyWealth"  => $family_wealth,
            "Uncle"         => $uncleName . " (" . $uncleCity . ")"
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Database update failed"]);
}
?>
