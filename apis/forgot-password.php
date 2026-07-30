<?php
require_once('../sys_dbconnection.php');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

$email = trim($_POST['email'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "$email is not a valid email address"]);
    exit;
}

// Get site config
$query = "SELECT * FROM siteconfig WHERE ID='1'";
$configdata = mysqli_query($con, $query);
$info = mysqli_fetch_assoc($configdata);

// Check banned
$stmtBanned = $con->prepare("SELECT * FROM register WHERE ConfirmEmail=? AND Status='Banned'");
$stmtBanned->bind_param("s", $email);
$stmtBanned->execute();
if ($stmtBanned->get_result()->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Your account has been blocked."]);
    exit;
}

// Check user
$stmtUser = $con->prepare("SELECT * FROM register WHERE ConfirmEmail=?");
$stmtUser->bind_param("s", $email);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();

if ($resultUser->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "No account found with that email."]);
    exit;
}

$user = $resultUser->fetch_assoc();
$MatriID = $user['MatriID'];
$site_name = $info['Webname'];
$reset_link = "https://dishavadhuvar.thebankingservices.com/new_pass.php?ID=$MatriID";

$subject = "Reset Password Request";
$message = "
<html>
<head><meta charset='utf-8'><title>Forgot Password</title></head>
<body>
<p>Dear {$user['Name']},</p>
<p>We have received your forgot password request.</p>
<p>Your Matrimony ID: <strong>{$user['MatriID']}</strong></p>
<p>Use the link to recover your password: <a href='$reset_link'>Click Here</a></p>
<p>Warm Regards,<br>Team: $site_name</p>
</body>
</html>
";

// Headers for HTML email
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: $site_name <info@dishavadhuvar.com>\r\n";

if (mail($email, $subject, $message, $headers)) {
    echo json_encode([
        "status" => "success",
        "message" => "Reset instructions have been mailed to: $email"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to send reset email."
    ]);
}
?>
