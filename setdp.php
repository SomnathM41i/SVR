<?php require_once('includes/bootstrap.php');
//include_once('memprotect.php');?>
<?php //include_once('siteconfig.php');
/*include_once('dbconnectadmin.php');*/
?>


<?php 
$nm1=$_GET['id']; 
$id=$_SESSION['matriid'];
$gal=mysqli_query($con,"select * from gallary where photo_id='$nm1'");
$gall=mysqli_fetch_array($gal);
$nm=$gall['photo_name'];
$sqlreg=mysqli_query($con,"select * from register where MatriId='$id'");
$rowreg=mysqli_fetch_array($sqlreg);
$image=$rowreg['Photo1'];

$sql=mysqli_query($con,"update register set Photo1='$nm' ,Photo1Approve='No' where MatriID='$id'");

header("location:upload_photo_gallary?msg=set");
?>
 <button type="button" id="dp" onclick="window.location='gallary?id=<?php echo $row['photo_id']?>'" class="btn btn-default pull-left disabled" style="box-shadow:none; color:green"> <i class="material-icons"></i></button>