<?php require_once('includes/bootstrap.php');

error_reporting(0);
 ?>
	<!-- //header -->
    <!-- navigation -->
    <?php if(isset($login))
       {
/* removed dead include: include('menu.php'); - include target never existed in this tree */
	   } 
	   else
	   {
	   }
if(isset($_POST['submit']))
{
$photo = $_POST['photo'];
$strid = $_SESSION['matriid'];


if(isset($login)&& $regvar=='9')
{
$hide_rs = mysqli_query($con,"update register set photo_visibility ='$photo' where MatriID='$strid'");

}
else
{
  $hide_rs = mysqli_query($con,"update register set photo_visibility ='$photo' where MatriID='$strid'");
	
}
header('location:settings?message=photosucc');
}
else
{
if(isset($_POST['default2']))
{
$photo = "paidphoto";
$strid = $_SESSION['matriid'];

if(isset($login)&& $regvar=='9')
{
$hide_rs = mysqli_query($con,"update register set photo_visibility ='$photo' where MatriID='$strid'");


}
else
{
	$hide_rs = mysqli_query($con,"update register set photo_visibility ='$photo' where MatriID='$strid'");
	
}
}
header('location:settings?message=default2');
}

?>