<?php require_once('../includes/bootstrap.php');   
include('protect.php');

$pid=$_GET['id'];
$id=$_GET['matid'];

$con->query("update gallary set photo_approve='Yes' where photo_id='$pid'");
$con->query("update register set Photo2Approve='Yes' where MatriID='$id'");


$sql = $con->query("SELECT a.*,b.* FROM register a,gallary b where a.matriid=b.matri_id and a.Photo1<>b.photo_name  and b.photo_approve='Pending'");


$rsapp=$con->query("select * from gallary where photo_id='$pid'");	

$rowapp=$rsapp->fetch_array();
$pname=$rowapp['photo_name'];

$con->query("update activity set act_approve='Yes' where act_pic='$pname'");

header('location:gal_photo_approve?msg=success');


?>
<?PHP 
