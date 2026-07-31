<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Allow only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Collect Input
$matriId = $db->setfilter($_POST['MatriID'] ?? '');

// Validation
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

// Fetch family details
$query = $con->prepare("
    SELECT 
        Familyvalues, FamilyType, FamilyStatus, noofbrothers, noofsisters, 
        nbm, nsm, Fathername, Fathersoccupation, Mothersname, Mothersoccupation, 
        mother_tounge, relatives, property, parents_stay, FamilyDetails, 
        family_wealth, famdate, unclecity, unclename, reg_step 
    FROM register 
    WHERE MatriID = ?
");
$query->bind_param("s", $matriId);
$query->execute();
$result = $query->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        "status" => "success",
        "message" => "Family details fetched successfully",
        "data" => [
            "MatriID"        => $matriId,
            "FamilyValues"   => $row['Familyvalues'],
            "FamilyType"     => $row['FamilyType'],
            "FamilyStatus"   => $row['FamilyStatus'],
            "Brothers"       => $row['noofbrothers'],
            "BrothersMarried"=> $row['nbm'],
            "Sisters"        => $row['noofsisters'],
            "SistersMarried" => $row['nsm'],
            "Father"         => $row['Fathername'],
            "FatherOccupation"=> $row['Fathersoccupation'],
            "Mother"         => $row['Mothersname'],
            "MotherOccupation"=> $row['Mothersoccupation'],
            "MotherTongue"   => $row['mother_tounge'],
            "Relatives"      => $row['relatives'],
            "Property"       => $row['property'],
            "LivingStatus"   => $row['parents_stay'],
            "AboutFamily"    => $row['FamilyDetails'],
            "FamilyWealth"   => $row['family_wealth'],
            "Uncle"          => $row['unclename'],
            "unclecity"      => $row['unclecity'],
            "FamilyDate"     => $row['famdate'],
            "RegStep"        => $row['reg_step']
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No record found for this MatriID"]);
}
?>
