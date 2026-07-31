<?php require_once('includes/bootstrap.php');
include_once('memprotect.php');

/* SECURITY: member login required (memprotect); a member may only delete
   their OWN biodata (previously any MatriID passed via GET was accepted -
   IDOR), legacy mysql_query() call replaced (fatal on modern PHP), and the
   query is parameterized. */
$id = isset($_SESSION['MatriID']) ? $_SESSION['MatriID'] : (isset($_SESSION['matriid']) ? $_SESSION['matriid'] : '');
if ($id !== '') {
    $stmt = mysqli_prepare($con, "update register set Biodata='' where MatriID=?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
header('location:uploadbiodata');
exit;
