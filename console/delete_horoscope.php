<?php require_once('../sys_dbconnection.php');   
$id=$_GET['matriid'];
/*include('../dbconnectadmin.php');*/
include('protect.php');
mysqli_query($con,"update register set HorosApprove='Rejected',horoscope='' where MatriID='".$_GET['matriid']."'");
header("location:horoscope_approval?ID=$id&msg=delete"); 
?>