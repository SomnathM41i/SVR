<?php require_once('../sys_dbconnection.php');  
/*include('../dbconnectadmin.php');*/
$rsconfig=$con->query("select * from siteconfig");
$config=$rsconfig->fetch_array(); 
?>