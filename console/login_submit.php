<?php require_once('../sys_dbconnection.php');
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'security.php');

/* SECURITY hardening of the admin login:
   - POST only (credentials must never arrive via GET)
   - per-username+IP throttling against brute force (H5)
   - prepared statement (H1). NOTE: password storage/comparison semantics are
     intentionally unchanged (project constraint: no password migration).
   - session id regenerated on successful login (H11). */

if ($_SERVER['REQUEST_METHOD'] !== 'POST'
    || !svr_csrf_verify(isset($_POST['svr_csrf']) ? $_POST['svr_csrf'] : '')) {
    header('location:login');
    exit;
}

$uid = isset($_POST['userid']) ? trim($_POST['userid']) : '';
$pwd = isset($_POST['password']) ? $_POST['password'] : '';

if (!svr_throttle('adminlogin:' . strtolower($uid) . ':' . svr_client_ip(), 5, 600)) {
    header('location:login?err=Too+many+attempts.+Try+again+later');
    exit;
}

$row = null;
$stmt = mysqli_prepare($con, "SELECT * FROM adminlogin WHERE adminusername=? AND adminpassword=? LIMIT 1");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $uid, $pwd);
    mysqli_stmt_execute($stmt);
    $rs = mysqli_stmt_get_result($stmt);
    $row = $rs ? mysqli_fetch_array($rs) : null;
    mysqli_stmt_close($stmt);
}

if ($row)
{
	if($row['adminpassword'] === $pwd)
	{
		session_regenerate_id(true);
		$_SESSION['admin_id'] = $row['adminusername'];
		$_SESSION['id'] = $row['id'];
		svr_throttle_reset('adminlogin:' . strtolower($uid) . ':' . svr_client_ip());
		$last = mysqli_query($con, "update siteconfig set lastlogin=now()");
		header("location:index");
		exit;
	}
	else
	{
		header("location:login?err=Invalid Password");
		exit;
	}
}
else
{
	header("location:login?err=No Such User");
	exit;
}
?>
