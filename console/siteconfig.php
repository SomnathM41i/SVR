<?php require_once('../sys_dbconnection.php');  
require_once(dirname(__FILE__).'/protect.php');

$rsconfig=$con->query("select * from siteconfig");
$config=$rsconfig->fetch_array(); 
?>