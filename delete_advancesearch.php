<?php require_once('includes/bootstrap.php');

mysqli_query($con,"delete from advance_saveandsearch where id='".$_GET['id']."'");


header('location:save_search?msg=delete'); 
?>