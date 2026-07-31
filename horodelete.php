<?php 
require_once('includes/bootstrap.php');
$id=$_GET['id'];
mysqli_query($con,"update register set horoscope='' where MatriID='$id'");
header('location:horoscope.php'); ?>