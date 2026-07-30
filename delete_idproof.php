<?php require_once('sys_dbconnection.php');?>
<?php include_once('memprotect.php');
/*include('dbconnectadmin.php');*/ ?>
<?php
$nm1=$_GET['id']; 
echo $nm1;
$id=$_SESSION['MatriID'];
$sqlreg=mysqli_query($con,"UPDATE register SET adhar=' ',idproof_approve=' ' WHERE MatriID='$id'");
$default="";
//echo "UPDATE register SET adhar='' WHERE MatriID='$id'";
header("location:upload_id_proof?msg=flag")
?>