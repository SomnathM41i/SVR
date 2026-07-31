<?php require_once('../sys_dbconnection.php'); 
/*include('../dbconnectadmin.php');
session_start();*/
$user=$_SESSION['uid'];
$cupass=mysqli_real_escape_string($con,$_POST['cupass']);
$newpwd=mysqli_real_escape_string($con,$_POST['newpwd']);
$confirmpwd=mysqli_real_escape_string($con,$_POST['confirmpwd']);
$pwd1=mysqli_query($con,"select * from adminlogin where adminusername='".$user."'");
$fec=mysqli_fetch_array($pwd1);
$gt=$fec['adminpassword'];

if($cupass==$gt){
	
if($gt!=$newpwd)
{
	
	
if($newpwd == $confirmpwd)
{
	$rec=mysqli_query($con,"update adminlogin set adminpassword='$confirmpwd' where adminusername='".$user."'") or mysqli_error($con,error());
	

	if($rec>0)
		header('location:changepassword?msg=success1');

}
else
{
	header('location:changepassword?msg=success2');
	
}
}
else{

 header('location:changepassword?msg=success3');
}
}
else {

header('location:changepassword?msg=success4');
}


?> 

