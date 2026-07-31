<?php require_once('sys_dbconnection.php');

include('memprotect.php');
mysqli_query($con,"delete from basic_saveandsearch where id='".$_GET['id']."'");


header('location:save_search?msg=delete'); 
?>