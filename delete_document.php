<?php require_once('sys_dbconnection.php');?>
<?php include_once('memprotect.php');
/*include('dbconnectadmin.php');*/ ?>
<?php
$nm1=$_GET['id']; 
echo $nm1;
$id=$_SESSION['MatriID'];
//$gal=mysqli_query($con,"select * from gallary where photo_id='$nm1'");
//$gall=mysqli_fetch_array($gal);
//$nm=$gall['photo_name'];


$sqlreg=mysqli_query($con,"DELETE FROM document WHERE doc_id='$nm1'");
mysqli_query($con," UPDATE register SET docapprove='No' Where MatriID='$id' ");
header("location:upload_document_proof?flag=9");
//echo "delete from register where MatriID='$id' & adhar='$nm1'";
//$rowreg=mysqli_fetch_array($sqlreg);
$default="";
//echo "DELETE FROM document WHERE doc_id='$nm1'";

/*if($rowreg['Gender']=="Male")
	      $default="nophoto.jpg";
     else
	      $default="nophoto.jpg";

     if($rowreg['Photo1']==$nm)
     {
mysqli_query($con,"delete from gallary where photo_name='$nm'");
mysqli_query($con,"update register set Photo1='$default' where MatriId='$id'");
$myFile = "gallary/".$nm;
unlink("gallary/".$nm);
//header('location:gallary');
}
else
{
mysqli_query($con,"delete from gallary where photo_name='$nm'");
$myFile = "gallary/".$nm;
unlink("gallary/".$nm);
//header('location:gallary');
	
}*/
?>