<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Utility: normalize input
function normalizeInput($db, $key) {
    if (!isset($_POST[$key])) return '';
    $val = $_POST[$key];
    return $db->setfilter(trim($val)); // Sanitize input using sys_dbconnection filter
}

// Collect Inputs
$matriId = normalizeInput($db, 'MatriID'); // Current logged-in user
$searchId = normalizeInput($db, 'ProfileID'); // Profile ID to view contact details

// Validation
if (empty($matriId)) {
    echo json_encode(["status" => "error", "message" => "MatriID is required"]);
    exit;
}
if (empty($searchId)) {
    echo json_encode(["status" => "error", "message" => "ProfileID is required"]);
    exit;
}

try {
    /**
     * STEP 1: Check if user has valid membership and contact view limit
     */
    $adviewStmt = $con->prepare("SELECT MatriID, Noofcontacts, Status 
                                 FROM register 
                                 WHERE DATEDIFF(CURRENT_DATE, Memshipexpirydate) < 1 
                                 AND Status NOT IN ('InActive', 'Active') 
                                 AND Noofcontacts > 0 
                                 AND MatriID = ?");
    $adviewStmt->bind_param("s", $matriId);
    $adviewStmt->execute();
    $adviewRes = $adviewStmt->get_result();
    $userData = $adviewRes->fetch_assoc();

    if (!$userData) {
        echo json_encode(["status" => "error", "message" => "User does not have a valid membership or sufficient contact view limit"]);
        exit;
    }

    /**
     * STEP 2: Check if contact has already been viewed
     */
    $viewCheckStmt = $con->prepare("SELECT * FROM viewedaddress WHERE who1 = ? AND whom1 = ?");
    $viewCheckStmt->bind_param("ss", $matriId, $searchId);
    $viewCheckStmt->execute();
    $viewCheckRes = $viewCheckStmt->get_result();

    if ($viewCheckRes->num_rows === 0) {
        // Log new view
        $viewDate = date('d-m-Y');
        $insertStmt = $con->prepare("INSERT INTO viewedaddress (who1, whom1, when1) VALUES (?, ?, ?)");
        $insertStmt->bind_param("sss", $matriId, $searchId, $viewDate);
        $insertStmt->execute();

        // Check if notification exists
        $notiCheckStmt = $con->prepare("SELECT * FROM notification 
                                        WHERE noti_sender = ? 
                                        AND noti_receiver = ? 
                                        AND notification_type = 'Viewed Contact'");
        $notiCheckStmt->bind_param("ss", $matriId, $searchId);
        $notiCheckStmt->execute();
        $notiCheckRes = $notiCheckStmt->get_result();

        if ($notiCheckRes->num_rows === 0) {
            // Insert notification
            $notiStmt = $con->prepare("INSERT INTO notification 
                                       (noti_sender, noti_receiver, notification_type, notification_desc, seen, date_time) 
                                       VALUES (?, ?, 'Viewed Contact', 'Viewed Contact', 'unseen', NOW())");
            $notiStmt->bind_param("ss", $matriId, $searchId);
            $notiStmt->execute();
        }

        // Decrease contact view limit
        $updateStmt = $con->prepare("UPDATE register SET Noofcontacts = Noofcontacts - 1 WHERE MatriID = ?");
        $updateStmt->bind_param("s", $matriId);
        $updateStmt->execute();
    }

    /**
     * STEP 3: Fetch contact details
     */
    $profileStmt = $con->prepare("SELECT MatriID, Name, Fathername, Mothersname, ConfirmEmail, Mobile, Mobile2, 
                                         DOB, POB, TOB, Address, Country, State, Dist, Taluka, City, 
                                         work_address, working_country, working_state, working_dist, working_taluka, working_city, 
                                         verifymobile, idproof_approve, horoscope, HorosApprove, Biodata 
                                  FROM register WHERE MatriID = ?");
    $profileStmt->bind_param("s", $searchId);
    $profileStmt->execute();
    $profileData = $profileStmt->get_result()->fetch_assoc();

    if (!$profileData) {
        echo json_encode(["status" => "error", "message" => "Profile not found"]);
        exit;
    }

    // Fetch email verification
    $emailStmt = $con->prepare("SELECT verification FROM emailverify WHERE MatriID = ?");
    $emailStmt->bind_param("s", $searchId);
    $emailStmt->execute();
    $emailData = $emailStmt->get_result()->fetch_assoc();
    $emailVerified = $emailData['verification'] ?? 'No';

    // Fetch document verification
    $docStmt = $con->prepare("SELECT docapprove FROM document WHERE MatriID = ?");
    $docStmt->bind_param("s", $searchId);
    $docStmt->execute();
    $docData = $docStmt->get_result()->fetch_assoc();
    $docVerified = $docData['docapprove'] ?? 'No';

    // Format DOB
    $dob = '';
    if (!empty($profileData['DOB'])) {
        $explodedate = explode("-", $profileData['DOB']);
        $dob = $explodedate[2] . "-" . $explodedate[1] . "-" . $explodedate[0];
    }

    // Prepare response data
    $contactDetails = [
        "MatriID"     => $profileData['MatriID'],
        "Name"        => $profileData['Name'],
        "FatherName"  => $profileData['Fathername'],
        "MotherName"  => $profileData['Mothersname'],
        "Email"       => $profileData['ConfirmEmail'],
        "Mobile"      => $profileData['Mobile'],
        "Mobile2"     => $profileData['Mobile2'],
        "DOB"         => $dob,
        "PlaceOfBirth"=> $profileData['POB'],
        "TimeOfBirth" => $profileData['TOB'],
        "Address"     => $profileData['Address'],
        "Country"     => $profileData['Country'],
        "State"       => $profileData['State'],
        "District"    => $profileData['Dist'],
        "Taluka"      => $profileData['Taluka'],
        "City"        => $profileData['City'],
        "WorkAddress" => $profileData['work_address'],
        "WorkCountry" => $profileData['working_country'],
        "WorkState"   => $profileData['working_state'],
        "WorkDistrict"=> $profileData['working_dist'],
        "WorkTaluka"  => $profileData['working_taluka'],
        "WorkCity"    => $profileData['working_city'],
        "MobileVerified" => $profileData['verifymobile'] == 1 ? "Yes" : "No",
        "IDProofVerified" => $profileData['idproof_approve'],
        "EmailVerified"   => $emailVerified,
        "DocumentVerified"=> $docVerified
    ];

    // Add biodata if available
    if (!empty($profileData['Biodata'])) {
        $contactDetails["Biodata"] = "biodata/" . $profileData['Biodata'];
    }

    // Add horoscope if approved and available
    if ($profileData['HorosApprove'] == 'Yes' && !empty($profileData['horoscope'])) {
        $contactDetails["Horoscope"] = "kundli/" . $profileData['horoscope'];
    }

    /**
     * STEP 4: Response
     */
    echo json_encode([
        "status" => "success",
        "message" => "Contact details fetched successfully",
        "data" => $contactDetails
    ]);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
