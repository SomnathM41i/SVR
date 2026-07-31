<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');

$id = $_GET['id'];
$status = $_GET['status'];
$result = mysqli_query($con,"update membershipplan set plan_status='$status' where planid='$id'  ");


if($status=='Active'){
header('location:membership?msg=active');
}else { 
header('location:membership?msg=inactive');
}
 ?>