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
    // Get logged-in user ID (required for blocking logic)
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

    // Get search parameters with defaults
    $txtgender = isset($_POST['gender']) ? mysqli_real_escape_string($con, $_POST['gender']) : '';
    $from_age = isset($_POST['StartAge']) ? intval($_POST['StartAge']) : 18;
    $to_age = isset($_POST['EndAge']) ? intval($_POST['EndAge']) : 60;
    $religion = isset($_POST['religion']) ? $_POST['religion'] : 'Any';
    $caste = isset($_POST['caste']) ? $_POST['caste'] : 'Any';
    $education = isset($_POST['edu']) ? $_POST['edu'] : 'Any';
    $occupation = isset($_POST['occu']) ? $_POST['occu'] : 'Any';
    $income = isset($_POST['income']) ? $_POST['income'] : 'Any';
    $workinglocation = isset($_POST['workinglocation']) ? $_POST['workinglocation'] : 'Any';
    $city = isset($_POST['city']) ? $_POST['city'] : 'Any';
    $district = isset($_POST['district']) ? $_POST['district'] : 'Any';
    $districts = is_array($district) ? $district : [$district];
    $taluka = isset($_POST['taluka']) ? $_POST['taluka'] : 'Any';
    $talukas = is_array($taluka) ? $taluka : [$taluka];
    $looking = isset($_POST['looking']) ? $_POST['looking'] : 'Any';
    $height1 = isset($_POST['StartHeight']) ? intval($_POST['StartHeight']) : '';
    $height2 = isset($_POST['EndHeight']) ? intval($_POST['EndHeight']) : '';
    $with_photo = isset($_POST['with_photo']) ? mysqli_real_escape_string($con, $_POST['with_photo']) : 'Any';

    // Handle array parameters (multiple selections)
    $religions = is_array($religion) ? $religion : [$religion];
    $castes = is_array($caste) ? $caste : [$caste];
    $educations = is_array($education) ? $education : [$education];
    $occupations = is_array($occupation) ? $occupation : [$occupation];
    $incomes = is_array($income) ? $income : [$income];
    $incomes = array_map('annual_income_normalize_value', $incomes);
    $workinglocations = is_array($workinglocation) ? $workinglocation : [$workinglocation];
    $cities = is_array($city) ? $city : [$city];
    $lookings = is_array($looking) ? $looking : [$looking];

    // Pagination parameters
    $page = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;
    $setLimit = isset($_POST['limit']) ? intval($_POST['limit']) : 24;
    $pageLimit = ($page * $setLimit) - $setLimit;

    // Validate required parameters
    if (empty($txtgender)) {
        echo json_encode(["status" => "error", "message" => "Gender is required"]);
        exit;
    }
    if ($from_age > $to_age) {
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
    $sql = "SELECT * FROM register WHERE Gender='$txtgender' AND Age BETWEEN '$from_age' AND '$to_age'";

    // Add blocking filters
    if (!empty($blockedByMembersStr)) {
        $sql .= " AND MatriID NOT IN ($blockedByMembersStr)";
    }
    if (!empty($blockedMembersStr)) {
        $sql .= " AND MatriID NOT IN ($blockedMembersStr)";
    }

    // Add filters for additional parameters
    if ($religion != 'Any' && !empty($religion)) {
        $religionStr = "'" . implode("','", array_map(function($rel) use ($con) {
            return mysqli_real_escape_string($con, $rel);
        }, $religions)) . "'";
        $sql .= " AND Religion IN ($religionStr)";
    }
    if ($caste != 'Any' && !empty($caste)) {
        $casteStr = "'" . implode("','", array_map(function($cas) use ($con) {
            return mysqli_real_escape_string($con, $cas);
        }, $castes)) . "'";
        $sql .= " AND Caste IN ($casteStr)";
    }
    if ($education != 'Any' && !empty($education)) {
        $educationStr = "'" . implode("','", array_map(function($edu) use ($con) {
            return mysqli_real_escape_string($con, $edu);
        }, $educations)) . "'";
        $sql .= " AND Education IN ($educationStr)";
    }
    if ($occupation != 'Any' && !empty($occupation)) {
        $occupationStr = "'" . implode("','", array_map(function($occ) use ($con) {
            return mysqli_real_escape_string($con, $occ);
        }, $occupations)) . "'";
        $sql .= " AND Occupation IN ($occupationStr)";
    }
    if ($income != 'Any' && !empty($income)) {
        $incomeStr = "'" . implode("','", array_map(function($inc) use ($con) {
            return mysqli_real_escape_string($con, $inc);
        }, $incomes)) . "'";
        $sql .= " AND Annualincome IN ($incomeStr)";
    }
    if ($workinglocation != 'Any' && !empty($workinglocation)) {
        $workinglocationStr = "'" . implode("','", array_map(function($wl) use ($con) {
            return mysqli_real_escape_string($con, $wl);
        }, $workinglocations)) . "'";
        $sql .= " AND workinglocation IN ($workinglocationStr)";
    }
    if ($city != 'Any' && !empty($city)) {
        $cityStr = "'" . implode("','", array_map(function($cit) use ($con) {
            return mysqli_real_escape_string($con, $cit);
        }, $cities)) . "'";
        $sql .= " AND City IN ($cityStr)";
    }
    
    if ($district != 'Any' && !empty($district)) {
        $districtStr = "'" . implode("','", array_map(function($dist) use ($con) {
            return mysqli_real_escape_string($con, $dist);
        }, $districts)) . "'";
        $sql .= " AND Dist IN ($districtStr)";
    }
    if ($taluka != 'Any' && !empty($taluka)) {
        $talukaStr = "'" . implode("','", array_map(function($item) use ($con) {
            return mysqli_real_escape_string($con, $item);
        }, $talukas)) . "'";
        $sql .= " AND Taluka IN ($talukaStr)";
    }

    if ($looking != 'Any' && !empty($looking)) {
        $lookingStr = "'" . implode("','", array_map(function($look) use ($con) {
            return mysqli_real_escape_string($con, $look);
        }, $lookings)) . "'";
        $sql .= " AND Maritalstatus IN ($lookingStr)";
    }
    if ($height1 != '' && $height2 != '') {
        $sql .= " AND Height BETWEEN '$height1' AND '$height2'";
    }
    if ($with_photo != 'Any' && $with_photo != 'withoutphoto') {
        $sql .= " AND Photo1 NOT LIKE 'nophoto.jpg' AND Photo1Approve='Yes'";
    } elseif ($with_photo == 'withoutphoto') {
        $sql .= " AND Photo1 LIKE 'nophoto.jpg'";
    }

    // Add common filters
    $sql .= " AND visibility NOT LIKE 'hidden' AND Status <> 'Banned' AND VIP_profile NOT LIKE 'Yes' AND Status NOT LIKE 'InActive' AND MatriID NOT LIKE '$logged_in_user'";
    $sql .= " ORDER BY Regdate DESC LIMIT $pageLimit, $setLimit";

    // Execute search query
    $rs_result = mysqli_query($con, $sql);

    // Get total count for pagination
    $countSql = "SELECT COUNT(*) as totalCount FROM register WHERE Gender='$txtgender' AND Age BETWEEN '$from_age' AND '$to_age'";
    if (!empty($blockedByMembersStr)) {
        $countSql .= " AND MatriID NOT IN ($blockedByMembersStr)";
    }
    if (!empty($blockedMembersStr)) {
        $countSql .= " AND MatriID NOT IN ($blockedMembersStr)";
    }
    if ($religion != 'Any' && !empty($religion)) {
        $countSql .= " AND Religion IN ($religionStr)";
    }
    if ($caste != 'Any' && !empty($caste)) {
        $countSql .= " AND Caste IN ($casteStr)";
    }
    if ($education != 'Any' && !empty($education)) {
        $countSql .= " AND Education IN ($educationStr)";
    }
    if ($occupation != 'Any' && !empty($occupation)) {
        $countSql .= " AND Occupation IN ($occupationStr)";
    }
    if ($income != 'Any' && !empty($income)) {
        $countSql .= " AND Annualincome IN ($incomeStr)";
    }
    if ($workinglocation != 'Any' && !empty($workinglocation)) {
        $countSql .= " AND workinglocation IN ($workinglocationStr)";
    }
    if ($city != 'Any' && !empty($city)) {
        $countSql .= " AND City IN ($cityStr)";
    }
    
    if ($district != 'Any' && !empty($district)) {
        $districtStr = "'" . implode("','", array_map(function($dist) use ($con) {
            return mysqli_real_escape_string($con, $dist);
        }, $districts)) . "'";
        $countSql .= " AND Dist IN ($districtStr)";
    }
    if ($taluka != 'Any' && !empty($taluka)) {
        $countSql .= " AND Taluka IN ($talukaStr)";
    }
    
    if ($looking != 'Any' && !empty($looking)) {
        $countSql .= " AND Maritalstatus IN ($lookingStr)";
    }
    if ($height1 != '' && $height2 != '') {
        $countSql .= " AND Height BETWEEN '$height1' AND '$height2'";
    }
    if ($with_photo != 'Any' && $with_photo != 'withoutphoto') {
        $countSql .= " AND Photo1 NOT LIKE 'nophoto.jpg' AND Photo1Approve='Yes'";
    } elseif ($with_photo == 'withoutphoto') {
        $countSql .= " AND Photo1 LIKE 'nophoto.jpg'";
    }
    $countSql .= " AND visibility NOT LIKE 'hidden' AND Status <> 'Banned' AND VIP_profile NOT LIKE 'Yes' AND Status NOT LIKE 'InActive' AND MatriID NOT LIKE '$logged_in_user'";
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

            // Handle photo display logic
            $photoUrl = 'https://weddingsparampara.com/gallary/nophoto.jpg';
            $isBlurred = true;
            if ($row['Photo1'] != 'nophoto.jpg' && $row['Photo1Approve'] == 'Yes') {
                if ($row['photo_visibility'] == 'paidphoto') {
                    if ($loggedUserData['Status'] == 'Paid') {
                        $photoUrl = "https://weddingsparampara.com/photoprocess.php?image=gallary/" . $row['Photo1'];
                        $isBlurred = false;
                    } else {
                        $photoUrl = "blur.php?image=gallary/" . $row['Photo1'];
                        $isBlurred = true;
                    }
                } elseif ($row['photo_visibility'] == 'allphoto') {
                    if ($row['Photo1'] != 'nophoto.jpg') {
                        $photoUrl = "https://weddingsparampara.com/photoprocess.php?image=gallary/" . $row['Photo1'];
                    } else {
                        $photoUrl = "https://weddingsparampara.com/gallary/" . $row['Photo1'];
                    }
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

        // Calculate pagination info
        $pagination = [
            'current_page' => $page,
            'total_pages' => $totalPages,
            'total_results' => intval($totalCount),
            'per_page' => $setLimit,
            'has_next' => $page < $totalPages,
            'has_previous' => $page > 1,
            'next_page' => $page < $totalPages ? $page + 1 : null,
            'previous_page' => $page > 1 ? $page - 1 : null
        ];

        echo json_encode([
            "status" => "success",
            "message" => "Search results found",
            "search_criteria" => [
                "gender" => $txtgender,
                "age_range" => [$from_age, $to_age],
                "religion" => $religions,
                "caste" => $castes,
                "education" => $educations,
                "occupation" => $occupations,
                "income" => $incomes,
                "workinglocation" => $workinglocations,
                "city" => $cities,
                "district" => $districts,
                "taluka" => $talukas,
                "marital_status" => $lookings,
                "height_range" => [$height1, $height2],
                "with_photo" => $with_photo
            ],
            "pagination" => $pagination,
            "results" => $results
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "No results found",
            "search_criteria" => [
                "gender" => $txtgender,
                "age_range" => [$from_age, $to_age],
                "religion" => $religions,
                "caste" => $castes,
                "education" => $educations,
                "occupation" => $occupations,
                "income" => $incomes,
                "workinglocation" => $workinglocations,
                "city" => $cities,
                "district" => $districts,
                "marital_status" => $lookings,
                "height_range" => [$height1, $height2],
                "with_photo" => $with_photo
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

// Close database connection
mysqli_close($con);

// Height conversion function
function get_height($strheight) {
    if ($strheight == "1") return "4Ft";
    else if ($strheight == "2") return "4Ft 1 inch";
    else if ($strheight == "3") return "4Ft 2 inch";
    else if ($strheight == "4") return "4Ft 3 inch";
    else if ($strheight == "5") return "4Ft 4 inch";
    else if ($strheight == "6") return "4Ft 5 inch";
    else if ($strheight == "7") return "4Ft 6 inch";
    else if ($strheight == "8") return "4Ft 7 inch";
    else if ($strheight == "9") return "4Ft 8 inch";
    else if ($strheight == "10") return "4Ft 9 inch";
    else if ($strheight == "11") return "4Ft 10 inch";
    else if ($strheight == "12") return "4Ft 11 inch";
    else if ($strheight == "13") return "5Ft";
    else if ($strheight == "14") return "5Ft 1 inch";
    else if ($strheight == "15") return "5Ft 2 inch";
    else if ($strheight == "16") return "5Ft 3 inch";
    else if ($strheight == "17") return "5Ft 4 inch";
    else if ($strheight == "18") return "5Ft 5 inch";
    else if ($strheight == "19") return "5Ft 6 inch";
    else if ($strheight == "20") return "5Ft 7 inch";
    else if ($strheight == "21") return "5Ft 8 inch";
    else if ($strheight == "22") return "5Ft 9 inch";
    else if ($strheight == "23") return "5Ft 10 inch";
    else if ($strheight == "24") return "5Ft 11 inch";
    else if ($strheight == "25") return "6Ft";
    else if ($strheight == "26") return "6Ft 1 inch";
    else if ($strheight == "27") return "6Ft 2 inch";
    else if ($strheight == "28") return "6Ft 3 inch";
    else if ($strheight == "29") return "6Ft 4 inch";
    else if ($strheight == "30") return "6Ft 5 inch";
    else if ($strheight == "31") return "6Ft 6 inch";
    else if ($strheight == "32") return "6Ft 7 inch";
    else if ($strheight == "33") return "6Ft 8 inch";
    else if ($strheight == "34") return "6Ft 9 inch";
    else if ($strheight == "35") return "6Ft 10 inch";
    else if ($strheight == "36") return "6Ft 11 inch";
    else if ($strheight == "37") return "7Ft";
    else return $strheight ?: "Not Set";
}
?>
