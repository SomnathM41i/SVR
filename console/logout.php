<?php  require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');

unset($_SESSION['admin_id']);
     print "<script>";
     print " self.location='login';"; // Comment this line if you don't want to redirect
     print "</script>";

?>