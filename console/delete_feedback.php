<?php require_once('../includes/bootstrap.php'); 
require_once(dirname(__FILE__).'/protect.php');
    
    $id=$_GET['ID'];
    $rs=mysqli_query($con,"DELETE FROM feedback WHERE id=$id");
    header("location:feedback?msg=delete");
    exit;

?>  