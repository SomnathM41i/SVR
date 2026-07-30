<?php
require_once('../sys_dbconnection.php');
require_once('../includes/annual_income.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");

// Accept POST or GET for fetching
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(["status" => "error", "message" => "Only POST/GET requests are allowed"]);
    exit;
}

// Collect Inputs
$matriId = $db->setfilter($_REQUEST['MatriID'] ?? '');

// Validation
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

// Fetch data
$query = $con->prepare("
    SELECT MatriID, Education, EducationDetails, Annualincome, income_in, Occupation, occu_details, 
           Employedin, working_hours, workinglocation, Height, Weight, BloodGroup, Complexion, 
           spe_cases, spe_reason, aboutus, edudate, iit, instu, reg_step
    FROM register 
    WHERE MatriID = ?
");
$query->bind_param("s", $matriId);
$query->execute();
$result = $query->get_result();

if ($row = $result->fetch_assoc()) {

    // Convert height code to readable format
    $readableHeight = get_height($row['Height']);

    echo json_encode([
        "status" => "success",
        "message" => "Education & career details fetched successfully",
        "data" => [
            "MatriID"          => $row['MatriID'],
            "Education"        => $row['Education'],
            "EducationDetails" => $row['EducationDetails'],
            "Annualincome"     => $row['Annualincome'],
            "AnnualincomeLabel" => annual_income_format($row['Annualincome']),
            "Income_in"        => $row['income_in'],
            "Occupation"       => $row['Occupation'],
            "OccuDetails"      => $row['occu_details'],
            "Employedin"       => $row['Employedin'],
            "WorkingHours"     => $row['working_hours'],
            "WorkingLocation"  => $row['workinglocation'],
            "Height"           => $readableHeight,
            "Weight"           => $row['Weight'],
            "BloodGroup"       => $row['BloodGroup'],
            "Complexion"       => $row['Complexion'],
            "SpecialCases"     => $row['spe_cases'],
            "SpecialReason"    => $row['spe_reason'],
            "AboutUs"          => $row['aboutus'],
            "EduDate"          => $row['edudate'],
            "IIT"              => $row['iit'],
            "Institute"        => $row['instu'],
            "RegStep"          => $row['reg_step']
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No record found for MatriID: $matriId"]);
}

// Height conversion function
function get_height($strheight) {
    $heights = [
        "1"=>"4Ft","2"=>"4Ft 1 inch","3"=>"4Ft 2 inch","4"=>"4Ft 3 inch","5"=>"4Ft 4 inch",
        "6"=>"4Ft 5 inch","7"=>"4Ft 6 inch","8"=>"4Ft 7 inch","9"=>"4Ft 8 inch","10"=>"4Ft 9 inch",
        "11"=>"4Ft 10 inch","12"=>"4Ft 11 inch","13"=>"5Ft","14"=>"5Ft 1 inch","15"=>"5Ft 2 inch",
        "16"=>"5Ft 3 inch","17"=>"5Ft 4 inch","18"=>"5Ft 5 inch","19"=>"5Ft 6 inch","20"=>"5Ft 7 inch",
        "21"=>"5Ft 8 inch","22"=>"5Ft 9 inch","23"=>"5Ft 10 inch","24"=>"5Ft 11 inch","25"=>"6Ft",
        "26"=>"6Ft 1 inch","27"=>"6Ft 2 inch","28"=>"6Ft 3 inch","29"=>"6Ft 4 inch","30"=>"6Ft 5 inch",
        "31"=>"6Ft 6 inch","32"=>"6Ft 7 inch","33"=>"6Ft 8 inch","34"=>"6Ft 9 inch","35"=>"6Ft 10 inch",
        "36"=>"6Ft 11 inch","37"=>"7Ft"
    ];
    return $heights[$strheight] ?? ($strheight ?: "Not Set");
}
?>
