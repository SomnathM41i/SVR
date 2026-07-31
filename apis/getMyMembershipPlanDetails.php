<?php
// Enable PHP errors
/* SECURITY: debug output disabled in production - error_reporting(E_ALL); */
/* SECURITY: debug output disabled in production - ini_set('display_errors', 1); */
/* SECURITY: debug output disabled in production - ini_set('display_startup_errors', 1); */

// Database connection
require_once('../sys_dbconnection.php'); 

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Only POST allowed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Validate input
if (!isset($_POST['MatriID']) || empty($_POST['MatriID'])) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}

$mid = $_POST['MatriID'];

try {
    // Fetch latest membership plan
    $planQuery = $con->prepare("SELECT * FROM paiddetails WHERE Pmatriid = ? ORDER BY Pactivedate DESC LIMIT 1");
    if (!$planQuery) {
        throw new Exception("Plan query prepare failed: " . $con->error);
    }
    $planQuery->bind_param("s", $mid);
    $planQuery->execute();
    $planData = $planQuery->get_result()->fetch_assoc();

    if (!$planData) {
        echo json_encode(["status" => "error", "message" => "No membership plan found for this user"]);
        exit;
    }

    // Fetch user details
    $userQuery = $con->prepare("SELECT Noofcontacts, MemshipExpiryDate, Name FROM register WHERE MatriID = ?");
    if (!$userQuery) {
        throw new Exception("User query prepare failed: " . $con->error);
    }
    $userQuery->bind_param("s", $mid);
    $userQuery->execute();
    $userData = $userQuery->get_result()->fetch_assoc();

    // Function to convert number to words
    function amountToWords($number) {
        $words = array('0'=>'zero','1'=>'one','2'=>'two','3'=>'three','4'=>'four','5'=>'five',
                       '6'=>'six','7'=>'seven','8'=>'eight','9'=>'nine','10'=>'ten','11'=>'eleven',
                       '12'=>'twelve','13'=>'thirteen','14'=>'fourteen','15'=>'fifteen','16'=>'sixteen',
                       '17'=>'seventeen','18'=>'eighteen','19'=>'nineteen','20'=>'twenty',
                       '30'=>'thirty','40'=>'forty','50'=>'fifty','60'=>'sixty','70'=>'seventy',
                       '80'=>'eighty','90'=>'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');

        $no = $number;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $counter = count($str);
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number]." ".$digits[$counter]." ".$hundred
                    : $words[floor($number / 10)*10]." ".$words[$number % 10]." ".$digits[$counter]." ".$hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        return ucwords(implode('', $str));
    }

    // Build API response
    $response = [
        "status" => "success",
        "message" => "Membership details fetched successfully",
        "data" => [
            "user_info" => [
                "matri_id" => $mid,
                "name" => $userData['Name'] ?? null
            ],
            "plan_info" => [
                "invoice_id" => $planData['Poid'],
                "plan_name" => $planData['Pplan'],
                "payment_mode" => $planData['Ppaymode'],
                "activation_date" => $planData['Pactivedate'],
                "plan_duration_days" => $planData['Pplanduration'],
                "plan_amount" => $planData['Pamount'],
                "amount_in_words" => amountToWords($planData['Pamount'])." Only",
                "total_contacts" => $planData['Pnocontct'],
                "remaining_contacts" => $userData['Noofcontacts'] ?? null,
                "expiry_date" => $userData['MemshipExpiryDate'] ?? null
            ]
        ]
    ];

    echo json_encode($response);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
