<?php
require_once('../sys_dbconnection.php');
require_once('../includes/annual_income.php');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Only POST allowed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

try {
    // Single search parameter
    $search = isset($_POST['search']) ? trim($_POST['search']) : '';
    $logged_in_user = isset($_POST['logged_user']) ? trim($_POST['logged_user']) : '';

    if (empty($search)) {
        echo json_encode(["status" => "error", "message" => "Search value is required"]);
        exit;
    }

    $isLoggedIn = !empty($logged_in_user);
    if ($isLoggedIn) $logged_in_user = mysqli_real_escape_string($con, $logged_in_user);

    // Determine if the search is a valid MatriID (exact match)
    $search_safe = mysqli_real_escape_string($con, $search);
    $exactCheck = mysqli_query($con, "SELECT MatriID FROM register WHERE MatriID='$search_safe'");
    $isExactMatch = mysqli_num_rows($exactCheck) > 0;

    // Start building query
    $queryString = "SELECT * FROM register WHERE Status NOT LIKE 'InActive' 
                    AND visibility NOT LIKE 'hidden' 
                    AND Status NOT LIKE 'Banned' 
                    AND VIP_profile NOT LIKE 'Yes'";

    // Logged-in filters
    if ($isLoggedIn) {
        $userQuery = mysqli_query($con, "SELECT Gender FROM register WHERE MatriID='$logged_in_user'");
        if (mysqli_num_rows($userQuery) == 0) {
            echo json_encode(["status" => "error", "message" => "Invalid logged-in user"]);
            exit;
        }
        $userData = mysqli_fetch_array($userQuery);
        $preferredGender = ($userData['Gender'] == 'Male') ? 'Female' : 'Male';
        $queryString .= " AND Gender='$preferredGender' AND MatriID != '$logged_in_user'";

        // Blocked users
        $blocked = [];
        $blockedBy = [];
        $checkBlocked = mysqli_query($con, "SELECT matriid FROM block_member WHERE profile_id='$logged_in_user'");
        while ($row = mysqli_fetch_array($checkBlocked)) $blocked[] = $row['matriid'];
        $checkBlockedBy = mysqli_query($con, "SELECT profile_id FROM block_member WHERE matriid='$logged_in_user'");
        while ($row = mysqli_fetch_array($checkBlockedBy)) $blockedBy[] = $row['profile_id'];

        if (!empty($blocked)) $queryString .= " AND MatriID NOT IN ('" . implode("','", $blocked) . "')";
        if (!empty($blockedBy)) $queryString .= " AND MatriID NOT IN ('" . implode("','", $blockedBy) . "')";
    }

    // Apply search: exact MatriID or Name
    if ($isExactMatch) {
        $queryString .= " AND MatriID='$search_safe'";
    } else {
        $queryString .= " AND Name LIKE '%$search_safe%'";
    }

    // Execute query
    $resultQuery = mysqli_query($con, $queryString);
    $results = [];

    if (mysqli_num_rows($resultQuery) > 0) {
        while ($row = mysqli_fetch_array($resultQuery)) {
            $profileData = [
                'MatriID' => $row['MatriID'],
                'Name' => $row['Name'],
                'Gender' => $row['Gender'],
                'Age' => $row['Age'] ?: 'Null',
                'Height' => get_height($row['Height']),
                'Education' => strlen($row['Education']) > 20 ? substr($row['Education'], 0, 20) . '...' : ($row['Education'] ?: 'Null'),
                'Occupation' => strlen($row['Occupation']) > 20 ? substr($row['Occupation'], 0, 20) . '...' : ($row['Occupation'] ?: 'Null'),
                'Religion' => $row['Religion'] ?: 'Not Set',
                'Caste' => $row['Caste'] ?: 'Not Set',
                'City' => $row['City'] ?: 'Not Set',
                'Taluka' => $row['Taluka'] ?: 'Not Set',
                'District' => $row['Dist'] ?: 'Not Set',
                'workinglocation' => $row['workinglocation'] ? 'Working City: ' . $row['workinglocation'] : 'Not Set',
                'Maritalstatus' => $row['Maritalstatus'] ?: 'Not Set',
                'Annualincome' => 'Annual Income: ' . annual_income_format($row['Annualincome'] ?? ''),
                'photo_visibility' => $row['photo_visibility'],
                'Photo1Approve' => $row['Photo1Approve'],
                'Photo1' => $row['Photo1'],
                'Status' => $row['Status']
            ];

            // Photo handling
            $photoUrl = 'https://weddingsparampara.com/images/nophoto.jpg';
            if ($row['Photo1'] != 'nophoto.jpg' && $row['Photo1Approve'] == 'Yes') {
                if ($row['photo_visibility'] == 'paidphoto') {
                    $photoUrl = ($isLoggedIn && isset($_POST['user_status']) && $_POST['user_status'] == 'Paid') 
                        ? "https://weddingsparampara.com/gallary/" . $row['Photo1'] 
                        : "https://weddingsparampara.com/blur.php?image=gallary/" . $row['Photo1'];
                } elseif ($row['photo_visibility'] == 'allphoto') {
                    $photoUrl = "https://weddingsparampara.com/gallary/" . $row['Photo1'];
                }
            }
            $profileData['photo_url'] = $photoUrl;
            $profileData['is_blurred'] = strpos($photoUrl, 'blur.php') !== false || $photoUrl == 'images/nophoto.jpg';

            // Encrypted profile link
            $encrypt = urlencode(base64_encode($row['MatriID']));
            $profileData['profile_link'] = $isLoggedIn ? "full_profile?id=" . $encrypt : "login";

            $results[] = $profileData;
        }

        echo json_encode([
            "status" => "success",
            "message" => "Search results found",
            "total_results" => count($results),
            "is_exact_match" => $isExactMatch,
            "logged_in" => $isLoggedIn,
            "results" => $results
        ]);

    } else {
        echo json_encode([
            "status" => "error",
            "message" => "No results found",
            "total_results" => 0,
            "is_exact_match" => $isExactMatch,
            "logged_in" => $isLoggedIn,
            "results" => []
        ]);
    }

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

mysqli_close($con);

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
