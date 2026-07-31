<?php
require_once('includes/bootstrap.php');

$matriid = $_SESSION['MatriID'] ?? $_SESSION['matriid'] ?? $_SESSION['matri_login'] ?? '';

if ($matriid !== '') {
    $statement = mysqli_prepare($con, "UPDATE register SET online_status='Offline' WHERE MatriID=?");
    if ($statement) {
        mysqli_stmt_bind_param($statement, 's', $matriid);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
    }
}

// Remove every login-related value, including legacy lowercase session keys.
$_SESSION = [];

// Invalidate the PHP session cookie in the browser.
if (ini_get('session.use_cookies')) {
    $cookie = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $cookie['path'],
        $cookie['domain'],
        $cookie['secure'],
        $cookie['httponly']
    );
}

session_destroy();

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Location: logout1');
exit;
