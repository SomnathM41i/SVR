<?php require_once('../sys_dbconnection.php');   
include('protect.php');


$pid=$_GET['id'];
$matriid = $_GET['matid'];

$con->query("delete from gallary where photo_id='$pid'"); 
$sql = $con->query("SELECT a.*,b.* FROM register a,gallary b where a.matriid=b.matri_id and a.Photo1<>b.photo_name  and b.photo_approve='Pending'"); 

mysqli_query($con,"update register set Photo2Approve='Rejected' where MatriID='$matriid'");
header("location:gal_photo_approve?msg=delete");
?>
