<?php  require_once('../sys_dbconnection.php');
//session_start();
unset($_SESSION['admin_id']);
     print "<script>";
     print " self.location='login';"; // Comment this line if you don't want to redirect
     print "</script>";

?>