<?php  


require_once('includes/bootstrap.php');
 //include_once('memprotect.php');?>
<?php  //include_once('siteconfig.php');
$searchid=$_GET['id'];
$strid=$_SESSION['matri_login']; //or sender id
$shortview=mysqli_query($con,"select * from  expressinterest  where eisender='$strid' and eireceiver='$searchid'") ;

if(mysqli_num_rows($shortview)==0)
{
$now=date('d-M-Y');
$shortview=mysqli_query($con,"insert  into  expressinterest(eisender,eireceiver,status) value('$strid','$searchid','No')");
}
$encrypt = urlencode( base64_encode( $searchid ) );
 header("location:full_profile?id=$encrypt"); 
?>
