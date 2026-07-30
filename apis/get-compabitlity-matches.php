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
    // Get logged-in user ID
    $login = isset($_POST['MatriID']) ? mysqli_real_escape_string($con, $_POST['MatriID']) : '';
    if (empty($login)) {
        echo json_encode(["status" => "error", "message" => "MatriID is required"]);
        exit;
    }

    // Validate logged-in user exists
    $my_profile = mysqli_query($con, "SELECT * FROM register WHERE MatriID='$login'");
    if (mysqli_num_rows($my_profile) == 0) {
        echo json_encode(["status" => "error", "message" => "Invalid logged-in user"]);
        exit;
    }
    $me = mysqli_fetch_array($my_profile);

    // Get logged-in user compatibility answers
    $myCompat = mysqli_query($con, "SELECT * FROM compatibility WHERE MatriID='$login'");
    if (mysqli_num_rows($myCompat) == 0) {
        echo json_encode(["status" => "error", "message" => "No compatibility answers found"]);
        exit;
    }
    $myCompatAnswers = mysqli_fetch_array($myCompat);

    // Pagination parameters
    $page = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;
    $setLimit = isset($_POST['limit']) ? intval($_POST['limit']) : 8;
    $pageLimit = ($page * $setLimit) - $setLimit;

    // Get blocked members
    $checkBlocked = mysqli_query($con, "SELECT matriid FROM block_member WHERE profile_id='$login'");
    $blockedMembers = [];
    while ($blockedRow = mysqli_fetch_array($checkBlocked)) {
        $blockedMembers[] = $blockedRow['matriid'];
    }
    $blockedMembersStr = !empty($blockedMembers) ? "'" . implode("','", $blockedMembers) . "'" : "";

    $checkBlockedBy = mysqli_query($con, "SELECT profile_id FROM block_member WHERE matriid='$login'");
    $blockedByMembers = [];
    while ($blockedByRow = mysqli_fetch_array($checkBlockedBy)) {
        $blockedByMembers[] = $blockedByRow['profile_id'];
    }
    $blockedByMembersStr = !empty($blockedByMembers) ? "'" . implode("','", $blockedByMembers) . "'" : "";

    // Build base query for compatibility matches
    $match_qry = "SELECT r.*, c.* 
                  FROM register r
                  JOIN compatibility c ON r.MatriID = c.member_id
                  WHERE r.visibility NOT LIKE 'hidden'
                    AND r.Status NOT LIKE 'Banned'
                    AND r.VIP_profile NOT LIKE 'Yes'
                    AND r.MatriID NOT LIKE '$login'";

    // Add blocking filters
    if (!empty($blockedByMembersStr)) {
        $match_qry .= " AND r.MatriID NOT IN ($blockedByMembersStr)";
    }
    if (!empty($blockedMembersStr)) {
        $match_qry .= " AND r.MatriID NOT IN ($blockedMembersStr)";
    }

    $match_qry .= " ORDER BY r.Regdate DESC LIMIT $pageLimit, $setLimit";

    // Execute search query
    $sqlmatch = mysqli_query($con, $match_qry);

    // Get total count for pagination
    $countSql = "SELECT COUNT(*) as totalCount
                 FROM register r
                 JOIN compatibility c ON r.MatriID = c.MatriID
                 WHERE r.visibility NOT LIKE 'hidden'
                   AND r.Status NOT LIKE 'Banned'
                   AND r.VIP_profile NOT LIKE 'Yes'
                   AND r.MatriID NOT LIKE '$login'";
    if (!empty($blockedByMembersStr)) {
        $countSql .= " AND r.MatriID NOT IN ($blockedByMembersStr)";
    }
    if (!empty($blockedMembersStr)) {
        $countSql .= " AND r.MatriID NOT IN ($blockedMembersStr)";
    }
    $countResult = mysqli_query($con, $countSql);
    $totalCount = mysqli_fetch_array($countResult)['totalCount'];
    $totalPages = ceil($totalCount / $setLimit);

    $results = [];
    if (mysqli_num_rows($sqlmatch) > 0) {
        while ($fetch = mysqli_fetch_array($sqlmatch)) {
            // Calculate compatibility score
            $matchCount = 0;
            for ($i = 1; $i <= 10; $i++) {
                $q = "que$i";
                if (isset($myCompatAnswers[$q]) && isset($fetch[$q]) && $myCompatAnswers[$q] == $fetch[$q]) {
                    $matchCount++;
                }
            }

            // Only include if at least 5 matches
            if ($matchCount < 5) {
                continue;
            }

            // Prepare profile data
            $profileData = [
                'MatriID' => $fetch['MatriID'],
                'Name' => $fetch['Name'],
                'Gender' => $fetch['Gender'],
                'Age' => $fetch['Age'] ?: 'Not Set',
                'Height' => get_height($fetch['Height']),
                'Education' => strlen($fetch['Education']) > 20 ? substr($fetch['Education'], 0, 20) . '...' : ($fetch['Education'] ?: 'Not Set'),
                'Occupation' => strlen($fetch['Occupation']) > 20 ? substr($fetch['Occupation'], 0, 20) . '...' : ($fetch['Occupation'] ?: 'Not Set'),
                'Religion' => $fetch['Religion'] ?: 'Not Set',
                'Caste' => $fetch['Caste'] ?: 'Not Set',
                'City' => $fetch['City'] ?: 'Not Set',
                'Taluka' => $fetch['Taluka'] ?: 'Not Set',
                'District' => $fetch['Dist'] ?: 'Not Set',
                'workinglocation' => $fetch['workinglocation'] ? 'Working City: ' . $fetch['workinglocation'] : 'Not Set',
                'Maritalstatus' => $fetch['Maritalstatus'] ?: 'Not Set',
                'Annualincome' => 'Annual Income: ' . annual_income_format($fetch['Annualincome'] ?? ''),
                'Complexion' => $fetch['Complexion'] ?: 'Not Set',
                'Star' => $fetch['Star'] ?: 'Not Set',
                'Residencystatus' => $fetch['Residencystatus'] ?: 'Not Set',
                'Country' => $row['Country'] ?: 'Not Set',
                'State' => $row['State'] ?: 'Not Set',
                'District' => $row['Dist'] ?: 'Not Set',
                'City' => $row['City'] ?: 'Not Set',
                'photo_visibility' => $fetch['photo_visibility'],
                'Photo1Approve' => $fetch['Photo1Approve'],
                'Photo1' => $fetch['Photo1'],
                'Status' => $fetch['Status'],
                'compatibility_score' => $matchCount
            ];

            // Handle photo display logic
            $photoUrl = 'images/nophoto.jpg';
            $isBlurred = true;
            if ($fetch['Photo1'] != 'nophoto.jpg' && $fetch['Photo1Approve'] == 'Yes') {
                if ($fetch['photo_visibility'] == 'paidphoto') {
                    if ($me['Status'] == 'Paid') {
                        $photoUrl = "photoprocess.php?image=gallary/" . $fetch['Photo1'] . "&square=500";
                        $isBlurred = false;
                    } else {
                        $photoUrl = "blur.php?image=gallary/" . $fetch['Photo1'];
                        $isBlurred = true;
                    }
                } elseif ($fetch['photo_visibility'] == 'allphoto') {
                    $photoUrl = "photoprocess.php?image=gallary/" . $fetch['Photo1'] . "&square=500";
                    $isBlurred = false;
                }
            } elseif ($fetch['Photo1'] != 'nophoto.jpg') {
                $photoUrl = "blur.php?image=gallary/" . $fetch['Photo1'];
                $isBlurred = true;
            }
            $profileData['photo_url'] = $photoUrl;
            $profileData['is_blurred'] = $isBlurred;
            $profileData['watermark'] = $isBlurred ? null : 'dishavadhuvar.com';

            // Encrypt MatriID for profile link
            $encrypt = urlencode(base64_encode($fetch['MatriID']));
            $profileData['profile_link'] = "full_profile?id=" . $encrypt;

            $results[] = $profileData;
        }

        // Pagination info
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
            "message" => "Compatibility matches found",
            "search_criteria" => "Profiles with minimum 5 matching answers",
            "pagination" => $pagination,
            "results" => $results
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "No compatibility matches found",
            "search_criteria" => "Profiles with minimum 5 matching answers",
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
