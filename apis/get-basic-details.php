<?php
/* SECURITY: verbose error reporting disabled in production. */
/* SECURITY: PHP error display disabled in production. */
/* SECURITY: PHP startup error display disabled in production. */
require_once('../sys_dbconnection.php');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Helper to convert height code to readable format
function get_height($h) {
    $ft = 4 + floor(($h - 1) / 12);
    $inch = ($h - 1) % 12;
    return $ft . "Ft" . ($inch > 0 ? " $inch inch" : "");
}

// Collect Inputs
$matriId = $db->setfilter($_POST['MatriID'] ?? '');

if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

// Fetch Data
$query = $con->prepare("
    SELECT
        Name, DOB, ConfirmEmail, MatriID, Height, Weight, BloodGroup, Complexion, spe_cases, spe_reason, Gender, Age,
        Profilecreatedby, maritalstatus, PE_HaveChildren, childrenlivingstatus, child_acceptance,
        religion, caste, subcaste, countrycode, Mobile, aboutus
    FROM register
    WHERE MatriID = ?
    LIMIT 1
");
$query->bind_param("s", $matriId);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Convert height code to readable format
    $HeightCode = (int)$row['Height'];
    $HeightFormatted = get_height($HeightCode);

    echo json_encode([
        "status" => "success",
        "message" => "User details fetched successfully",
        "data" => [
            "MatriID" => $row['MatriID'],
            "Name" => $row['Name'],
            "DOB" => $row['DOB'],
            "Height" => $HeightFormatted,
            "Weight" => $row['Weight'],
            "BloodGroup" => $row['BloodGroup'],
            "Complexion" => $row['Complexion'],
            "SpecialCases" => $row['spe_cases'],
            "SpecialReason" => $row['spe_reason'],
            "Email" => $row['ConfirmEmail'],
            "Gender" => $row['Gender'],
            "Age" => $row['Age'],
            "Profilecreatedby" => $row['Profilecreatedby'],
            "MaritalStatus" => $row['maritalstatus'],
            "NoOfChildren" => $row['PE_HaveChildren'],
            "ChildrenStatus" => $row['childrenlivingstatus'],
            "ChildAcceptance" => $row['child_acceptance'],
            "Religion" => $row['religion'],
            "Caste" => $row['caste'],
            "Subcaste" => $row['subcaste'],
            "CountryCode" => $row['countrycode'],
            "Mobile" => $row['Mobile'],
            "AboutUs" => $row['aboutus']
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No user details found"]);
}
?>
