<?php  require_once('../sys_dbconnection.php'); 
/*include_once('../dbconnectadmin.php');*/
include('protect.php');
$ID=$_POST['ID'];
$horoscope = $_POST['horoscope'];
$phone = $_POST['phone'];	
$photo = $_POST['photo'];
$strid = $_SESSION['matriid'];
$hide_rs = mysqli_query($con,"update register set horoscope_visibility='$horoscope',phone_visibility='$phone',photo_visibility ='$photo' where MatriID='$ID'");


header('location:profile_view?msg=success&flag=16&ID='.$ID);
?>