<?php require_once('../sys_dbconnection.php');    
require_once(dirname(__FILE__).'/protect.php');
date_default_timezone_set('Asia/Kolkata');

$strmid=$_POST['id'];

$str_name =mysqli_real_escape_string($con, $_POST['txtName']);
$sDay =mysqli_real_escape_string($con,$_POST['dobDay']);
$sMonth = mysqli_real_escape_string($con,$_POST['dobMonth']);
$syear = mysqli_real_escape_string($con,$_POST['dobYear']);
$str_rel= mysqli_real_escape_string($con,$_POST['religion']);  
$str_cas=mysqli_real_escape_string($con,$_POST['caste']);
$str_subcas= mysqli_real_escape_string($con,$_POST['subcaste']);
$str_email= mysqli_real_escape_string($con,$_POST['email']);
$str_password= mysqli_real_escape_string($con,$_POST['password']);
$str_about= ltrim(mysqli_real_escape_string($con,$_POST['aboutus']));
$noc=mysqli_real_escape_string($con,$_POST['noc']);
$regno=mysqli_real_escape_string($con,$_POST['regno']);
$mstatus=mysqli_real_escape_string($con,$_POST['mstatus']);
$childstatus=mysqli_real_escape_string($con,$_POST['childstatus']);
$child_acceptance=mysqli_real_escape_string($con,$_POST['child_acceptance'] ?? '');
$gender=mysqli_real_escape_string($con,$_POST['gender']);
$slash = "-"; 	
$str_DOB = $syear.$slash.$sMonth.$slash.$sDay;
$birthdate = new DateTime($str_DOB);
$today = new DateTime('today');
$age = $birthdate->diff($today)->y;
$created_by=mysqli_real_escape_string($con,$_POST['created_by']);


$query = $con->query("update register set Name='$str_name',DOB='$str_DOB',Gender='$gender',ConfirmEmail='$str_email',ConfirmPassword='$str_password',Age='$age',Religion='$str_rel',Caste='$str_cas',Subcaste='$str_subcas',aboutus='$str_about',
childrenlivingstatus='$child_status',PE_HaveChildren='$noc',Maritalstatus='$mstatus',childrenlivingstatus='$childstatus',child_acceptance='$child_acceptance',Profilecreatedby='$created_by',regno='$regno' where MatriID='$strmid' ") or svr_db_fail($con);   


header('location:profile_view?flag=1&msg=success&action&ID='.$strmid);
exit;
?>
