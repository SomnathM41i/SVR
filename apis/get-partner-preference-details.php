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

// Utility: normalize input
function normalizeInput($db, $key) {
    if (!isset($_POST[$key])) return '';
    $val = $_POST[$key];
    if (is_array($val)) {
        return $db->setfilter(implode(",", $val));
    }
    return $db->setfilter(trim($val));
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

// Collect Inputs
$matriId = normalizeInput($db, 'MatriID');

// Validation
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

// Fetch details
$query = $con->prepare("
    SELECT 
        Looking, PE_FromAge, PE_ToAge, PartnerExpectations,
        PE_Countrylivingin, PE_from_Height, PE_to_Height, PE_Complexion,
        PE_Education, PE_Religion, PE_Caste, PE_Residentstatus,
        PE_State, PE_District, PE_Taluka, PE_City,
        PE_income_from, PE_income_to, PE_Occupation
    FROM register
    WHERE MatriID = ?
");
$query->bind_param("s", $matriId);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Convert height codes to readable format
    $heightFrom = get_height($row['PE_from_Height']);
    $heightTo = get_height($row['PE_to_Height']);

    echo json_encode([
        "status" => "success",
        "message" => "Partner preferences fetched successfully",
        "data" => [
            "MatriID"     => $matriId,
            "Looking"     => $row['Looking'],
            "FromAge"     => $row['PE_FromAge'],
            "ToAge"       => $row['PE_ToAge'],
            "Expectation" => $row['PartnerExpectations'],
            "Country"     => $row['PE_Countrylivingin'],
            "State"       => $row['PE_State'],
            "District"    => $row['PE_District'],
            "Taluka"      => $row['PE_Taluka'],
            "City"        => $row['PE_City'],
            "Caste"       => $row['PE_Caste'],
            "Religion"    => $row['PE_Religion'],
            "Education"   => $row['PE_Education'],
            "Occupation"  => $row['PE_Occupation'],
            "HeightFrom"  => $heightFrom,
            "HeightTo"    => $heightTo,
            "Complexion"  => $row['PE_Complexion'],
            "IncomeFrom"  => $row['PE_income_from'],
            "IncomeFromLabel" => annual_income_format($row['PE_income_from'], 'Not specified'),
            "IncomeTo"    => $row['PE_income_to'],
            "IncomeToLabel" => annual_income_format($row['PE_income_to'], 'Not specified')
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No partner preferences found"]);
}
?>
