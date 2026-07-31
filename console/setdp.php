<?php require_once('../sys_dbconnection.php'); 
include('protect.php');
/*include('../dbconnectadmin.php');*/
$photo = $_GET['photo'];
$mat=$_GET['id'];
$query=mysqli_query($con,"update register set Photo1='$photo' where MatriID='$mat'");
//echo "update register set Photo1='$photo'";
header('location:profile_view?msg=success&flag=19&ID='.$mat);
?>