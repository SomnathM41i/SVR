<?php require_once('../includes/bootstrap.php'); 
require_once(dirname(__FILE__).'/protect.php');

$strmid1=$_GET['ID']; 

echo $strmid1;
mysqli_query($con,"update register set horoscope='' where MatriID='".$_GET['ID']."'");


header("location:profile_view?ID=$strmid1&msg=delete11" );
?>