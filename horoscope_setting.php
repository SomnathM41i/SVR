<?php require_once('sys_dbconnection.php');
/*include('dbconnectadmin.php');
session_start();*/
error_reporting(0);
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
$horoscope = $_POST['horoscope'];
$strid = $_SESSION['matriid'];


if(isset($login)&& $regvar=='9')
{
$hide_rs = mysqli_query($con,"update register set horoscope_visibility ='$horoscope' where MatriID='$strid'");


}
else
{
	$hide_rs = mysqli_query($con,"update register set horoscope_visibility ='$horoscope' where MatriID='$strid'");
    
}
header('location:settings?message=success');
}
else
{
if(isset($_POST['default1']))
{
$horoscope = "paidhoro";
$strid = $_SESSION['matriid'];


if(isset($login)&& $regvar=='9')
{
$hide_rs = mysqli_query($con,"update register set horoscope_visibility ='$horoscope' where MatriID='$strid'");

}
else
{
	$hide_rs = mysqli_query($con,"update register set horoscope_visibility ='$horoscope' where MatriID='$strid'");
}
}
header('location:settings?message=default1');
}


?>