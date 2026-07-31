<?php require_once('../sys_dbconnection.php');   
include('protect.php');


$pid=$_GET['id'];
$matri=$_GET['matriid'];
$gch=$con->query("select * from gallary where photo_id='$pid'");

$fetch=$gch->fetch_array();

$gch1=$con->query("select * from register where MatriID='$matri'");

$fetch1=$gch1->fetch_array();
$gend=$fetch1['Gender'];
$con->query("delete from gallary where photo_id='$pid'"); 

$con->query("update register set Photo1='nophoto.jpg',Photo1Approve='Rejected' where MatriID='$matri'");



$sql = $con->query("SELECT a.*,b.* FROM register a,gallary b WHERE a.photo1=b.photo_name and b.photo_approve='Pending' order by id desc");  

$stroldphoto1 = $fetch1['Photo1'];
$myFile = "../gallary/".$stroldphoto1;
unlink($myFile); 
header('location:photo_approve?msg=delete'); 

?>

<?php
 ?>