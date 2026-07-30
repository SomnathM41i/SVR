<?php
// echo "hello"; exit;
require_once('../sys_dbconnection.php');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

// Get username and password
$myusername = $db->setfilter($_POST['username'] ?? '');
$mypassword = $db->setfilter($_POST['password'] ?? '');

if (empty($myusername) || empty($mypassword)) {
    echo json_encode(["status" => "error", "message" => "Username and password are required"]);
    exit;
}

$var = base64_encode($mypassword);

$sql = "SELECT * FROM register 
        WHERE (MatriID = ? OR ConfirmEmail = ? OR Mobile = ?)
        AND (ConfirmPassword = ? OR ConfirmPassword = ?)
        LIMIT 1";

$stmt = $con->prepare($sql);
$stmt->bind_param("sssss", $myusername, $myusername, $myusername, $var, $mypassword);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    date_default_timezone_set("Asia/Kolkata");
    $dt = date('Y-m-d');
    $hr = date('h');
    $min = date('i');
    $am = date('a');
    $id = $user['MatriID'];

    $con->query("UPDATE register SET last_seen_date='$dt', last_seen_hour='$hr', last_seen_min='$min', last_seen_am='$am', online_status='Online' WHERE MatriID='$id'");

    echo json_encode([
        "status" => "success",
        "message" => "Login successful",
        "data" => [
            "MatriID" => $user['MatriID'],
            "Mobile" => $user['Mobile'],
            "Name" => $user['Name'],
            "Email" => $user['ConfirmEmail'],
            "password" => $user['ConfirmPassword'],
            "Gender" => $user['Gender'],
            "Status" => $user['Status']
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
}
?>
