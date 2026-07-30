<?php
require_once('../sys_dbconnection.php');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Only POST requests allowed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Utility: Convert height number to readable string
function get_height($h) {
    if (!is_numeric($h) || $h < 1) return "Not Set";
    $ft = 4 + floor(($h - 1) / 12);
    $inch = ($h - 1) % 12;
    return $ft . "Ft" . ($inch > 0 ? " $inch inch" : "");
}

// Escape and format array for SQL IN clause
function formatInClause($arr, $con) {
    return "'" . implode("','", array_map(fn($v) => mysqli_real_escape_string($con, trim($v)), $arr)) . "'";
}

try {
    // Get logged-in user
    $login = isset($_POST['MatriID']) ? mysqli_real_escape_string($con, trim($_POST['MatriID'])) : '';
    if (empty($login)) throw new Exception("MatriID is required");

    $res = mysqli_query($con, "SELECT * FROM register WHERE MatriID='$login'");
    if (mysqli_num_rows($res) == 0) throw new Exception("Invalid logged-in user");
    $me = mysqli_fetch_assoc($res);

    // Determine match gender
    $match_sex = ($me['Gender'] === 'Male') ? 'Female' : 'Male';

    // Preferences with defaults
    $prefs = [
        'from_height' => intval($me['PE_from_Height'] ?? 4),
        'to_height' => intval($me['PE_to_Height'] ?? 30),
        'from_age' => intval($me['PE_FromAge'] ?? 18),
        'to_age' => intval($me['PE_ToAge'] ?? 60),
        'religion' => ($me['PE_Religion'] && $me['PE_Religion'] != 'Any') ? explode(',', $me['PE_Religion']) : [],
        'caste' => ($me['PE_Caste'] && $me['PE_Caste'] != 'Any') ? explode(',', $me['PE_Caste']) : [],
        'education' => ($me['PE_Education'] && $me['PE_Education'] != 'Any') ? explode(',', $me['PE_Education']) : [],
        'occupation' => ($me['PE_Occupation'] && $me['PE_Occupation'] != 'Any') ? explode(',', $me['PE_Occupation']) : [],
        'complexion' => ($me['PE_Complexion'] && $me['PE_Complexion'] != 'Any') ? explode(',', $me['PE_Complexion']) : [],
        'star' => ($me['PE_star'] && $me['PE_star'] != 'Any') ? explode(',', $me['PE_star']) : [],
        'residencystatus' => ($me['PE_Residentstatus'] && $me['PE_Residentstatus'] != 'Any') ? explode(',', $me['PE_Residentstatus']) : [],
        'country' => ($me['PE_Countrylivingin'] && $me['PE_Countrylivingin'] != 'Any') ? explode(',', $me['PE_Countrylivingin']) : [],
        'state' => ($me['PE_State'] && $me['PE_State'] != 'Any') ? explode(',', $me['PE_State']) : [],
        'mothertongue' => ($me['PE_MotherTongue'] && $me['PE_MotherTongue'] != 'Any') ? explode(',', $me['PE_MotherTongue']) : [],
        'marital_status' => ($me['Looking'] && $me['Looking'] != 'Any') ? explode(',', $me['Looking']) : []
    ];

    // Additional filters from POST (optional, for extensibility)
    $additional_filters = [
        'city' => isset($_POST['city']) && $_POST['city'] != 'Any' ? explode(',', trim($_POST['city'])) : [],
        'district' => isset($_POST['district']) && $_POST['district'] != 'Any' ? explode(',', trim($_POST['district'])) : []
    ];

    // Pagination
    $page = max(1, intval($_POST['page'] ?? 1));
    $limit = max(1, min(100, intval($_POST['limit'] ?? 8))); // Limit between 1 and 100
    $offset = ($page - 1) * $limit;

    // Blocked members
    $blocked = [];
    $blockedRes = mysqli_query($con, "SELECT matriid FROM block_member WHERE profile_id='$login'");
    while ($row = mysqli_fetch_assoc($blockedRes)) $blocked[] = $row['matriid'];

    $blockedBy = [];
    $blockedByRes = mysqli_query($con, "SELECT profile_id FROM block_member WHERE matriid='$login'");
    while ($row = mysqli_fetch_assoc($blockedByRes)) $blockedBy[] = $row['profile_id'];

    // Base AND filters
    $where = [
        "visibility NOT LIKE 'hidden'",
        "Status NOT LIKE 'Banned'",
        "VIP_profile NOT LIKE 'Yes'",
        "MatriID != '$login'",
        "Gender = '$match_sex'",
        "Height BETWEEN {$prefs['from_height']} AND {$prefs['to_height']}",
        "Age BETWEEN {$prefs['from_age']} AND {$prefs['to_age']}"
    ];

    if (!empty($blocked)) $where[] = "MatriID NOT IN ('" . implode("','", array_map(fn($v) => mysqli_real_escape_string($con, $v), $blocked)) . "')";
    if (!empty($blockedBy)) $where[] = "MatriID NOT IN ('" . implode("','", array_map(fn($v) => mysqli_real_escape_string($con, $v), $blockedBy)) . "')";

    // Mandatory AND filters for Religion and Caste
    if (!empty($prefs['religion'])) $where[] = "Religion IN (" . formatInClause($prefs['religion'], $con) . ")";
    if (!empty($prefs['caste'])) $where[] = "Caste IN (" . formatInClause($prefs['caste'], $con) . ")";

    // Additional AND filters from POST
    if (!empty($additional_filters['city'])) $where[] = "City IN (" . formatInClause($additional_filters['city'], $con) . ")";
    if (!empty($additional_filters['district'])) $where[] = "Dist IN (" . formatInClause($additional_filters['district'], $con) . ")";

    // Multi-value fields combined with OR
    $multiValueFields = [
        'Education' => $prefs['education'],
        'Occupation' => $prefs['occupation'],
        'Complexion' => $prefs['complexion'],
        'Residencystatus' => $prefs['residencystatus'],
        'Country' => $prefs['country'],
        'State' => $prefs['state'],
        'Maritalstatus' => $prefs['marital_status'],
        'mother_tounge' => $prefs['mothertongue'],
        'Star' => $prefs['star']
    ];

    $orGroups = [];
    foreach ($multiValueFields as $column => $values) {
        if (!empty($values)) {
            $orGroups[] = "$column IN (" . formatInClause($values, $con) . ")";
        }
    }

    if (!empty($orGroups)) {
        $where[] = "(" . implode(" AND ", $orGroups) . ")";
    }

    // // Final SQL
    // $sql = "SELECT * FROM register WHERE " . implode(' AND ', $where) . " ORDER BY Regdate DESC LIMIT $offset, $limit";
    $sql = "
        SELECT * FROM register 
        WHERE " . implode(' AND ', $where) . " 
        ORDER BY 
            CASE 
                WHEN status = 'Paid' THEN 1 
                ELSE 2 
            END,
            Regdate DESC 
        LIMIT $offset, $limit
    ";
// print_r($sql); exit;
    $result = mysqli_query($con, $sql);
    if (!$result) throw new Exception("Database query failed: " . mysqli_error($con));

    // Total count for pagination
    $countSql = "SELECT COUNT(*) as total FROM register WHERE " . implode(' AND ', $where);
    $countRes = mysqli_query($con, $countSql);
    if (!$countRes) throw new Exception("Count query failed: " . mysqli_error($con));
    $totalCount = intval(mysqli_fetch_assoc($countRes)['total']);
    $totalPages = ceil($totalCount / $limit);

    $results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $photoUrl = 'https://weddingsparampara.com/gallary/nophoto.jpg';
        $isBlurred = true;

        if ($row['Photo1'] != 'nophoto.jpg' && $row['Photo1Approve'] == 'Yes') {
            if ($row['photo_visibility'] === 'paidphoto') {
                if ($me['Status'] === 'Paid') {
                    $photoUrl = "https://weddingsparampara.com/photoprocess.php?image=gallary/{$row['Photo1']}&square=500";
                    $isBlurred = false;
                } else {
                    $photoUrl = "https://weddingsparampara.com/blur.php?image=gallary/{$row['Photo1']}";
                }
            } elseif ($row['photo_visibility'] === 'allphoto') {
                $photoUrl = "https://weddingsparampara.com/photoprocess.php?image=gallary/{$row['Photo1']}&square=500";
                $isBlurred = false;
            }
        } elseif ($row['Photo1'] != 'nophoto.jpg') {
            $photoUrl = "https://weddingsparampara.com/blur.php?image=gallary/{$row['Photo1']}";
        }


        $results[] = [
            'MatriID' => $row['MatriID'],
            'Name' => $row['Name'] ?? 'Not Set',
            'Gender' => $row['Gender'] ?? 'Not Set',
            'Age' => $row['Age'] ?? 'Not Set',
            'Height' => get_height($row['Height']),
            'Education' => $row['Education'] ?? 'Not Set',
            'Occupation' => $row['Occupation'] ?? 'Not Set',
            'Religion' => $row['Religion'] ?? 'Not Set',
            'Caste' => $row['Caste'] ?? 'Not Set',
            'Maritalstatus' => $row['Maritalstatus'] ?? 'Not Set',
            'Complexion' => $row['Complexion'] ?? 'Not Set',
            'Star' => $row['Star'] ?? 'Not Set',
            'Residencystatus' => $row['Residencystatus'] ?? 'Not Set',
            'Country' => $row['Country'] ?? 'Not Set',
            'State' => $row['State'] ?? 'Not Set',
            'District' => $row['Dist'] ?? 'Not Set',
            'City' => $row['City'] ?? 'Not Set',
            'Photo1' => $row['Photo1'],
            'photo_url' => $photoUrl,
            'VIP_profile' => $row['VIP_profile'],
            'Status' => $row['Status'],
            'is_blurred' => $isBlurred,
            'watermark' => $isBlurred ? null : 'dishavadhuvar.com',
            'profile_link' => "full_profile?id=" . urlencode(base64_encode($row['MatriID']))
        ];
    }

    echo json_encode([
        "status" => $results ? "success" : "error",
        "message" => $results ? "Latest Matches found" : "No Latest Matches found",
        "pagination" => [
            'current_page' => $page,
            'total_pages' => $totalPages,
            'total_results' => $totalCount,
            'per_page' => $limit,
            'has_next' => $page < $totalPages,
            'has_previous' => $page > 1
        ],
        "results" => $results
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => $e->getMessage()], JSON_PRETTY_PRINT);
} finally {
    mysqli_close($con);
}
?>