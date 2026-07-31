<?php require_once('../includes/bootstrap.php'); 
include('protect.php');

$photo = $_GET['photo'];
$mat=$_GET['id'];
$query=mysqli_query($con,"update register set Photo1='$photo' where MatriID='$mat'");

header('location:profile_view?msg=success&flag=19&ID='.$mat);
?>