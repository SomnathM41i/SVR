<?php require_once('sys_dbconnection.php');/*include('dbconnectadmin.php');
session_start();
error_reporting(0);*/
 ?>
	<!-- //header -->
    <!-- navigation -->
    <?php if(isset($login))
       {
		include('menu.php');
	   } 
	   else
	   {
	   }
if(isset($_POST['submit']))
{
$phone = $_POST['phone'];
$strid = $_SESSION['matriid'];


if(isset($login)&& $regvar=='9')
{
$hide_rs = mysqli_query($con,"update register set phone_visibility ='$phone' where MatriID='$strid'");
//echo "update register set phone_visibility ='$phone' where MatriID='$strid'";

}
else
{
	$hide_rs = mysqli_query($con,"update register set phone_visibility ='$phone' where MatriID='$strid'");
   // echo "update register set phone_visibility ='$phone' where MatriID='$strid'";
}
header('location:settings?message=phonesucc');

}
else
{
if(isset($_POST['default3']))
{
$phone = "paidphone";
$strid = $_SESSION['matriid'];


if(isset($login)&& $regvar=='9')
{
$hide_rs = mysqli_query($con,"update register set phone_visibility ='$phone' where MatriID='$strid'");
//echo "update register set phone_visibility ='$phone' where MatriID='$strid'";

}
else
{
	$hide_rs = mysqli_query($con,"update register set phone_visibility ='$phone' where MatriID='$strid'");
	//echo "update register set phone_visibility ='$phone' where MatriID='$strid'";
}
}
header('location:settings?message=default3');

}
?>