<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
/* SECURITY: admin-only now (C4) and uses a prepared statement (H1).
   Previously any unauthenticated visitor could run an UPDATE with raw
   $_GET['ID'] (unauthenticated SQL injection + unauthorized state change). */
$strmid1 = isset($_GET['ID']) ? trim($_GET['ID']) : '';
if ($strmid1 !== '') {
    $stmt = mysqli_prepare($con, "UPDATE register SET adhar='' WHERE MatriID=?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $strmid1);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
header('location:profile_view?msg=delete2&ID='. urlencode($strmid1) );
exit;
