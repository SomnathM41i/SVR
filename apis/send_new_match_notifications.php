<?php
require_once('../sys_dbconnection.php');
require_once('../firebase/fcm_functions.php'); // <-- Your FCM send function

header("Content-Type: application/json");

// Get new registered MatriID
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "POST required"]);
    exit;
}

$MatriID = mysqli_real_escape_string($con, $_POST['MatriID'] ?? '');
if (empty($MatriID)) {
    echo json_encode(["status" => "error", "message" => "MatriID missing"]);
    exit;
}

// 1️⃣ Get newly registered profile
$newProfileRes = mysqli_query($con, "SELECT * FROM register WHERE MatriID='$MatriID'");
if (!$newProfileRes || mysqli_num_rows($newProfileRes) == 0) {
    echo json_encode(["status" => "error", "message" => "Profile not found"]);
    exit;
}
$newProfile = mysqli_fetch_assoc($newProfileRes);

// 2️⃣ Determine opposite gender for matches
$match_gender = ($newProfile['Gender'] === 'Male') ? 'Female' : 'Male';

// 3️⃣ Build matching SQL (simplified for notification purpose)
$sql = "
    SELECT MatriID, Name, fcm_token
    FROM register
    WHERE 
        Gender = '$match_gender'
        AND Religion = '{$newProfile['Religion']}'
        AND Caste = '{$newProfile['Caste']}'
        AND Age BETWEEN " . ($newProfile['PE_FromAge'] ?? 18) . " AND " . ($newProfile['PE_ToAge'] ?? 60) . "
        AND Visibility NOT LIKE 'hidden'
        AND Status NOT LIKE 'Banned'
";

// 4️⃣ Fetch matching users
$result = mysqli_query($con, $sql);
if (!$result) {
    echo json_encode(["status" => "error", "message" => "Query error: " . mysqli_error($con)]);
    exit;
}

$notified = 0;

// 5️⃣ Loop through matches and send FCM notification
while ($match = mysqli_fetch_assoc($result)) {
    if (!empty($match['fcm_token'])) {
        $title = "🎉 New Match Found!";
        $body = "Hi {$match['Name']}, you’ve got a new match – {$newProfile['Name']}!";
        $image = "https://dishavadhuvar.com/gallary/" . ($newProfile['Photo1'] ?? 'nophoto.jpg');
        $link = "https://dishavadhuvar.com/full_profile?id=" . urlencode(base64_encode($MatriID));

        // FCM Function: sendNotification($token, $title, $body, $image, $link)
        sendNotification($match['fcm_token'], $title, $body, [
            'image' => $image,
            'click_action' => $link,
            'MatriID' => $MatriID
        ]);

        $notified++;
    }
}

// 6️⃣ Response
echo json_encode([
    "status" => "success",
    "message" => "Notification sent to $notified matched users.",
    "matches_found" => $notified
]);

mysqli_close($con);
?>
