<?php require_once('../includes/bootstrap.php');  
require_once(dirname(__FILE__).'/protect.php');

$cupass=mysqli_real_escape_string($con,$_POST['cupass']);
$newpwd=mysqli_real_escape_string($con,$_POST['newpwd']);

$confirmpwd=mysqli_real_escape_string($con,$_POST['confirmpwd']);
if($cupass!=""||$newpwd!=""|| $confirmpwd!="")
{
        $cupass="";
        $newpwd="";
        $confirmpwd="";
}
header('location:changepassword');
?>