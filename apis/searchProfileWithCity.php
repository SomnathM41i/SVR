<?php
require_once('../sys_dbconnection.php');
require_once('../includes/annual_income.php');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

try {
    // ✅ Only allow POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
        exit;
    }

    // Get logged-in user ID
    $logged_in_user = isset($_POST['logged_user']) ? mysqli_real_escape_string($con, $_POST['logged_user']) : '';
    if (empty($logged_in_user)) {
        echo json_encode(["status" => "error", "message" => "logged_user is required"]);
        exit;
    }

    // Validate logged-in user exists
    $userCheck = mysqli_query($con, "SELECT MatriID, Gender, Status FROM register WHERE MatriID='$logged_in_user'");
    if (mysqli_num_rows($userCheck) == 0) {
        echo json_encode(["status" => "error", "message" => "Invalid logged-in user"]);
        exit;
    }
    $loggedUserData = mysqli_fetch_array($userCheck);

    // Get search parameters (POST only)
    $txtgender = isset($_POST['gender']) ? mysqli_real_escape_string($con, $_POST['gender']) : '';
    $from_age  = isset($_POST['StartAge']) ? intval($_POST['StartAge']) : '';
    $to_age    = isset($_POST['EndAge']) ? intval($_POST['EndAge']) : '';
    $religion  = isset($_POST['religion']) ? $_POST['religion'] : '';
    $looking   = isset($_POST['looking']) ? $_POST['looking'] : '';
    $city      = isset($_POST['city']) ? $_POST['city'] : '';

    // Handle array parameters (multiple selections)
    $religions = is_array($religion) ? $religion : (!empty($religion) ? [$religion] : []);
    $lookings  = is_array($looking) ? $looking : (!empty($looking) ? [$looking] : []);
    $cities    = is_array($city) ? $city : (!empty($city) ? [$city] : []);

    // Pagination parameters
    $page = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;
    $setLimit = 24;
    $pageLimit = ($page * $setLimit) - $setLimit;

    // Validate required parameters
    if (empty($txtgender)) {
        echo json_encode(["status" => "error", "message" => "Gender is required"]);
        exit;
    }
    if (!empty($from_age) && !empty($to_age) && $from_age > $to_age) {
        echo json_encode(["status" => "error", "message" => "From age cannot be greater than to age"]);
        exit;
    }

    // Get blocked members logic
    $checkBlocked = mysqli_query($con, "SELECT matriid FROM block_member WHERE profile_id='$logged_in_user'");
    $blockedMembers = [];
    while ($blockedRow = mysqli_fetch_array($checkBlocked)) {
        $blockedMembers[] = $blockedRow['matriid'];
    }
    $blockedMembersStr = !empty($blockedMembers) ? "'" . implode("','", $blockedMembers) . "'" : "";

    $checkBlockedBy = mysqli_query($con, "SELECT profile_id FROM block_member WHERE matriid='$logged_in_user'");
    $blockedByMembers = [];
    while ($blockedByRow = mysqli_fetch_array($checkBlockedBy)) {
        $blockedByMembers[] = $blockedByRow['profile_id'];
    }
    $blockedByMembersStr = !empty($blockedByMembers) ? "'" . implode("','", $blockedByMembers) . "'" : "";

    // Build base query
    $sql = "SELECT * FROM register WHERE Gender='$txtgender'";

    // Add age filter if provided
    if (!empty($from_age) && !empty($to_age)) {
        $sql .= " AND Age BETWEEN '$from_age' AND '$to_age'";
    }

    // Add blocking filters
    if (!empty($blockedByMembersStr)) {
        $sql .= " AND MatriID NOT IN ($blockedByMembersStr)";
    }
    if (!empty($blockedMembersStr)) {
        $sql .= " AND MatriID NOT IN ($blockedMembersStr)";
    }

    // Add religion filter
    if (!empty($religions)) {
        $religionStr = "'" . implode("','", array_map(function($rel) use ($con) {
            return mysqli_real_escape_string($con, $rel);
        }, $religions)) . "'";
        $sql .= " AND Religion IN ($religionStr)";
    }

    // Add marital status filter
    if (!empty($lookings)) {
        $lookingStr = "'" . implode("','", array_map(function($look) use ($con) {
            return mysqli_real_escape_string($con, $look);
        }, $lookings)) . "'";
        $sql .= " AND Maritalstatus IN ($lookingStr)";
    }

    // Add city filter
    if (!empty($cities)) {
        $cityStr = "'" . implode("','", array_map(function($cit) use ($con) {
            return mysqli_real_escape_string($con, $cit);
        }, $cities)) . "'";
        $sql .= " AND workinglocation IN ($cityStr)";
    }

    // Add common filters
    $sql .= " AND visibility NOT LIKE 'hidden' 
              AND Status <> 'Banned' 
              AND VIP_profile NOT LIKE 'Yes' 
              AND Status NOT LIKE 'InActive' 
              AND MatriID NOT LIKE '$logged_in_user'";
    $sql .= " ORDER BY Regdate DESC LIMIT $pageLimit, $setLimit";

    // Execute search query
    $rs_result = mysqli_query($con, $sql);

    // Get total count for pagination
    $countSql = "SELECT COUNT(*) as totalCount FROM register WHERE Gender='$txtgender'";
    if (!empty($from_age) && !empty($to_age)) {
        $countSql .= " AND Age BETWEEN '$from_age' AND '$to_age'";
    }
    if (!empty($blockedByMembersStr)) {
        $countSql .= " AND MatriID NOT IN ($blockedByMembersStr)";
    }
    if (!empty($blockedMembersStr)) {
        $countSql .= " AND MatriID NOT IN ($blockedMembersStr)";
    }
    if (!empty($religions)) {
        $countSql .= " AND Religion IN ($religionStr)";
    }
    if (!empty($lookings)) {
        $countSql .= " AND Maritalstatus IN ($lookingStr)";
    }
    if (!empty($cities)) {
        $countSql .= " AND workinglocation IN ($cityStr)";
    }
    $countSql .= " AND visibility NOT LIKE 'hidden' 
                   AND Status <> 'Banned' 
                   AND VIP_profile NOT LIKE 'Yes' 
                   AND Status NOT LIKE 'InActive' 
                   AND MatriID NOT LIKE '$logged_in_user'";

    $countResult = mysqli_query($con, $countSql);
    $totalCount = mysqli_fetch_array($countResult)['totalCount'];
    $totalPages = ceil($totalCount / $setLimit);

    $results = [];
    if (mysqli_num_rows($rs_result) > 0) {
        while ($row = mysqli_fetch_array($rs_result)) {
            $profileData = [
                'MatriID' => $row['MatriID'],
                'Name' => $row['Name'],
                'Gender' => $row['Gender'],
                'Age' => $row['Age'] ?: 'Not Set',
                'Height' => get_height($row['Height']),
                'Education' => strlen($row['Education']) > 20 ? substr($row['Education'], 0, 20) . '...' : ($row['Education'] ?: 'Not Set'),
                'Occupation' => strlen($row['Occupation']) > 20 ? substr($row['Occupation'], 0, 20) . '...' : ($row['Occupation'] ?: 'Not Set'),
                'Religion' => $row['Religion'] ?: 'Not Set',
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

            // Handle photo display logic
            $photoUrl = 'images/nophoto.jpg';
            $isBlurred = true;

            if ($row['Photo1'] != 'nophoto.jpg' && $row['Photo1Approve'] == 'Yes') {
                if ($row['photo_visibility'] == 'paidphoto') {
                    if ($loggedUserData['Status'] == 'Paid') {
                        $photoUrl = "photoprocess.php?image=gallary/" . $row['Photo1'] . "&square=500";
                        $isBlurred = false;
                    } else {
                        $photoUrl = "blur.php?image=gallary/" . $row['Photo1'];
                        $isBlurred = true;
                    }
                } elseif ($row['photo_visibility'] == 'allphoto') {
                    $photoUrl = "photoprocess.php?image=gallary/" . $row['Photo1'] . "&square=500";
                    $isBlurred = false;
                }
            } elseif ($row['Photo1'] != 'nophoto.jpg') {
                $photoUrl = "blur.php?image=gallary/" . $row['Photo1'];
                $isBlurred = true;
            }

            $profileData['photo_url'] = $photoUrl;
            $profileData['is_blurred'] = $isBlurred;
            $profileData['watermark'] = $isBlurred ? null : 'dishavadhuvar.com';

            // Encrypt MatriID for profile link
            $encrypt = urlencode(base64_encode($row['MatriID']));
            $profileData['profile_link'] = "full_profile?id=" . $encrypt;

            $results[] = $profileData;
        }

        echo json_encode([
            "status" => "success",
            "message" => "Smart search results found",
            "search_criteria" => [
                "gender" => $txtgender,
                "age_range" => [empty($from_age) ? null : $from_age, empty($to_age) ? null : $to_age],
                "religion" => $religions,
                "marital_status" => $lookings,
                "city" => $cities
            ],
            "pagination" => [
                "current_page" => $page,
                "total_pages" => $totalPages,
                "total_results" => intval($totalCount),
                "per_page" => $setLimit,
                "has_next" => $page < $totalPages,
                "has_previous" => $page > 1,
                "next_page" => $page < $totalPages ? $page + 1 : null,
                "previous_page" => $page > 1 ? $page - 1 : null
            ],
            "results" => $results
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "No results found",
            "search_criteria" => [
                "gender" => $txtgender,
                "age_range" => [empty($from_age) ? null : $from_age, empty($to_age) ? null : $to_age],
                "religion" => $religions,
                "marital_status" => $lookings,
                "city" => $cities
            ],
            "pagination" => [
                "current_page" => $page,
                "total_pages" => 0,
                "total_results" => 0,
                "per_page" => $setLimit,
                "has_next" => false,
                "has_previous" => false
            ],
            "results" => []
        ]);
    }

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

mysqli_close($con);

// Height conversion function
function get_height($strheight) {
    $map = [
        "1" => "4Ft", "2" => "4Ft 1 inch", "3" => "4Ft 2 inch", "4" => "4Ft 3 inch",
        "5" => "4Ft 4 inch", "6" => "4Ft 5 inch", "7" => "4Ft 6 inch", "8" => "4Ft 7 inch",
        "9" => "4Ft 8 inch", "10" => "4Ft 9 inch", "11" => "4Ft 10 inch", "12" => "4Ft 11 inch",
        "13" => "5Ft", "14" => "5Ft 1 inch", "15" => "5Ft 2 inch", "16" => "5Ft 3 inch",
        "17" => "5Ft 4 inch", "18" => "5Ft 5 inch", "19" => "5Ft 6 inch", "20" => "5Ft 7 inch",
        "21" => "5Ft 8 inch", "22" => "5Ft 9 inch", "23" => "5Ft 10 inch", "24" => "5Ft 11 inch",
        "25" => "6Ft", "26" => "6Ft 1 inch", "27" => "6Ft 2 inch", "28" => "6Ft 3 inch",
        "29" => "6Ft 4 inch", "30" => "6Ft 5 inch", "31" => "6Ft 6 inch", "32" => "6Ft 7 inch",
        "33" => "6Ft 8 inch", "34" => "6Ft 9 inch", "35" => "6Ft 10 inch", "36" => "6Ft 11 inch",
        "37" => "7Ft"
    ];
    return isset($map[$strheight]) ? $map[$strheight] : ($strheight ?: "Not Set");
}
?>
