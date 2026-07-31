<?php require_once('../sys_dbconnection.php');  
require_once(dirname(__FILE__).'/protect.php');
/*include('../dbconnectadmin.php');
session_start();*/
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