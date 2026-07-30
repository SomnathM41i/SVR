<?php
require_once('../sys_dbconnection.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

try {
    $page = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;
    $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 4;
    $offset = ($page - 1) * $limit;

    $genders = ['Male', 'Female'];
    $results = [];

    foreach ($genders as $gender) {
        $sql = "SELECT * FROM register WHERE Photo1 NOT LIKE 'nophoto.jpg' AND Gender='$gender' AND Photo1Approve='Yes' ORDER BY ID DESC LIMIT $offset, $limit";
        $qry = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($qry)) {
            $height = get_height($row['Height']);
            $photoUrl = 'images/nophoto.jpg';
            $isBlurred = true;

            if ($row['Photo1'] != 'nophoto.jpg' && $row['Photo1Approve'] == 'Yes') {
                $photoUrl = "photoprocess.php?image=gallary/" . $row['Photo1'] . "&square=500";
                $isBlurred = false;
            }

            $encrypt = urlencode(base64_encode($row['MatriID']));

            $results[$gender][] = [
                'MatriID' => $row['MatriID'],
                'Name' => $row['Name'],
                'Gender' => $row['Gender'],
                'Age' => $row['Age'] ?: 'Not Set',
                'Height' => $height,
                'Occupation' => $row['Occupation'] ?: 'Not Set',
                'PhotoURL' => $photoUrl,
                'IsBlurred' => $isBlurred,
                'ProfileLink' => "full_profile?id=" . $encrypt
            ];
        }
    }

    echo json_encode([
        "status" => "success",
        "message" => "Latest groom & bride profiles",
        "pagination" => [
            'current_page' => $page,
            'per_page' => $limit
        ],
        "results" => $results
    ]);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

mysqli_close($con);

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
    return $map[$strheight] ?? "Not Set";
}
?>
