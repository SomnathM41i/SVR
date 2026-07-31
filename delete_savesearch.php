<?php require_once('sys_dbconnection.php');
/*include('dbconnectadmin.php');*/
include('memprotect.php');
mysqli_query($con,"delete from basic_saveandsearch where id='".$_GET['id']."'");
//echo "delete from basic_saveandsearch where id='".$_GET['id']."";
//exit;
header('location:save_search?msg=delete'); 
?>