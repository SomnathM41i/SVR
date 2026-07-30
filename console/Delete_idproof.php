<?php require_once('../sys_dbconnection.php'); 
/*include'../dbconnectadmin.php';*/
$strmid1=$_GET['ID']; 
echo $strmid1;
mysqli_query($con,"update register set adhar='' where MatriID='".$_GET['ID']."'");
//echo "update register set adhar='' where MatriID='".$_GET['ID']."'";
//exit;
header('location:profile_view?msg=delete2&ID='. $strmid1 );
?>