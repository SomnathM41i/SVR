<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');

$strmid1=$_GET['ID']; 

echo $strmid1;
mysqli_query($con,"update register set docs='' where MatriID='".$_GET['ID']."'");


header('location:profile_view.php?ID='. $strmid1 );
?>