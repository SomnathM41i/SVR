<?php require_once('includes/bootstrap.php');?>
<?php include_once('memprotect.php');
 ?>
<?php
$nm1=$_GET['id']; 
echo $nm1;
$id=$_SESSION['MatriID'];
$sqlreg=mysqli_query($con,"UPDATE register SET adhar=' ',idproof_approve=' ' WHERE MatriID='$id'");
$default="";

header("location:upload_id_proof?msg=flag")
?>