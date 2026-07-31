<?php require_once('../sys_dbconnection.php');   
include('protect.php');
/*include('../dbconnectadmin.php');*/
$pid=$_GET['id'];
$Strid = $_GET['matriid']; 

$con->query("update gallary set photo_approve='Yes' where photo_id='$pid'");
$con->query("update register set Photo1Approve='Yes' where MatriID='$Strid'");

//echo "update register set Photo1Approve='Yes' where MatriID='$Strid'";
$sql = $con->query("SELECT a.*,b.* FROM register a,gallary b WHERE a.photo1=b.photo_name and b.photo_approve='Pending' order by id desc"); 

$rsapp=$con->query("select * from gallary where photo_id='$pid'");  
$rowapp=$rsapp->fetch_array();
$pname=$rowapp['photo_name'];
//echo $pname;
$con->query("update activity set act_approve='Yes' where act_pic='$pname'");
header('location:photo_approve?msg=success'); 
?>
