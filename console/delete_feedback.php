<?php require_once('../sys_dbconnection.php'); 
    /*include'../dbconnectadmin.php';*/
    $id=$_GET['ID'];
    $rs=mysqli_query($con,"DELETE FROM feedback WHERE id=$id");
    header("location:feedback?msg=delete");
    exit;

?>  