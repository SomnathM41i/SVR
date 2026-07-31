<?php 
require_once('includes/bootstrap.php');

$contact=mysqli_query($con,"select * from cms where cms_id='9'");
$contactfetch=mysqli_fetch_array($contact);
$site=mysqli_query($con,"select * from siteconfig where ID='1'");
$siteinfo=mysqli_fetch_array($site);

if(isset($_POST['submit']))
{
  

$Name=$_POST['name'];
$Email=$_POST['email'];
$Phone=$_POST['phone'];
$Message=$_POST['message'];
$Subject=$_POST['subject'];
$date=date("Y-m-d");

$site=mysqli_query($con,"insert into feedback (Date,Name,Mobile,email,Subject,Message) values('$date','$Name','$Phone','$Email','$Subject','$Message')");
    
 

 
 header("location:message?msg=feedback");
}?>