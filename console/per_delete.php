<?php  require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');

$id=$_GET['ID'];
mysqli_query($con,"delete from deleted_profile where MatriID='$id'");


header("location:delete_profiles.php"); ?>