<?php require_once('sys_dbconnection.php');
/*include('dbconnect.php');*/
$id=$_GET['id'];
mysql_query("update register set Biodata='' where MatriID='$id'");
header('location:uploadbiodata'); ?>