<?php require_once('includes/bootstrap.php');?>
<?php include_once('memprotect.php');
 ?>
<?php
$nm1=$_GET['id']; 
echo $nm1;
$id=$_SESSION['MatriID'];





$sqlreg=mysqli_query($con,"DELETE FROM document WHERE doc_id='$nm1'");
mysqli_query($con," UPDATE register SET docapprove='No' Where MatriID='$id' ");
header("location:upload_document_proof?flag=9");


$default="";



?>