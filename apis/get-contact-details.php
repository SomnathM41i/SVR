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
$matriId = $db->setfilter($_POST['MatriID'] ?? '');

// Validate
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

// Fetch Data
$query = $con->prepare("
    SELECT 
        MatriID, Address, Country, State, Dist, Taluka, City, Phone, 
        Residencystatus, Mobile2, Mobile, calling_time, Pincode,
        working_country, working_state, working_dist, working_taluka, working_city,
        work_pincode, work_address, work_residence, reg_step
    FROM register
    WHERE MatriID = ?
    LIMIT 1
");
$query->bind_param("s", $matriId);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    echo json_encode([
        "status" => "success",
        "message" => "Contact details fetched successfully",
        "data" => [
            "MatriID"          => $row['MatriID'],
            "Address"          => $row['Address'],
            "Country"          => $row['Country'],
            "State"            => $row['State'],
            "District"         => $row['Dist'],
            "Taluka"           => $row['Taluka'],
            "City"             => $row['City'],
            "Phone"            => $row['Phone'],
            "ResidenceStatus"  => $row['Residencystatus'],
            "Mobile"           => $row['Mobile'],
            "Mobile2"          => $row['Mobile2'],
            "CallingTime"      => $row['calling_time'],
            "Pincode"          => $row['Pincode'],
            "WorkingCountry"   => $row['working_country'],
            "WorkingState"     => $row['working_state'],
            "WorkingDistrict"  => $row['working_dist'],
            "WorkingTaluka"    => $row['working_taluka'],
            "WorkingCity"      => $row['working_city'],
            "WorkPincode"      => $row['work_pincode'],
            "WorkAddress"      => $row['work_address'],
            "WorkResidence"    => $row['work_residence'],
            "RegStep"          => $row['reg_step']
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No contact details found"]);
}
?>
