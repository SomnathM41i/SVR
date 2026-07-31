<?php require_once('sys_dbconnection.php');?>
<?php include_once('memprotect.php');
 ?>
<?php
$nm1=$_GET['id']; 
$id=$_SESSION['matriid'];
$gal=mysqli_query($con,"select * from gallary where photo_id='$nm1'");
$gall=mysqli_fetch_array($gal);
$nm=$gall['photo_name'];


$sqlreg=mysqli_query($con,"select * from register where MatriId='$id'");
$rowreg=mysqli_fetch_array($sqlreg);
$default="";
if($rowreg['Gender']=="Male")
	      $default="nophoto.jpg";
     else
	      $default="nophoto.jpg";

     if($rowreg['Photo1']==$nm)
     {
mysqli_query($con,"delete from gallary where photo_name='$nm'");
mysqli_query($con,"update register set Photo1='$default' where MatriId='$id'");
$myFile = "gallary/".$nm;
unlink("gallary/".$nm);

}
else
{
mysqli_query($con,"delete from gallary where photo_name='$nm'");
$myFile = "gallary/".$nm;
unlink("gallary/".$nm);
header('location:upload_photo_gallary?msg=flag');
	
}
?>