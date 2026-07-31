<?php require_once('../includes/bootstrap.php'); 
require_once(dirname(__FILE__).'/protect.php');

$strmid1=$_GET['ID']; 

mysqli_query($con,"update register set Photo1='nophoto.jpg' where MatriID='".$_GET['ID']."'");


header("location:profile_view?ID=$strmid1&msg=delete1" );
?>