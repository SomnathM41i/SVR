<?php
//session_start();
//include('dbconnectadmin.php'); 

require_once('sys_dbconnection.php');
include('auto_approve.php');
/*echo $auto_approve;*/
/*echo $auto_on_off;*/
/*exit;*/
$fname="";       		$fname_error="";
$lname=""; 				$lname_error="";
$created_by="";			$created_by_error="";
$maritial_status="";    $maritial_status_error="";
$gender="";				$gender_error="";
$dob="";				$dob_error="";
$email="";				$email_error="";
$mobile="";				$mobile_error="";
$pass="";				$pass_error="";
$religion=""; 			$religion_error="";
$caste="";				$caste_error="";
$subcaste="";			$subcaste_error="";
$profile_location_type="Indian Resident";
$profile_location_type_error="";
$capctha_error="";
$franchise_id = $_GET['token'] ?? '';

if(isset($_POST['submit']))
 {
	
//$email=mysqli_real_escape_string($con,$_POST['email']);
//Modified By: santy Date:13-07-2021
$email = $db->setfilter($_POST['email']);
//echo $email;

//$pass=base64_encode($_POST['pass']);
$pass=$db->setfilter($_POST['pass']);
//$created_by=mysqli_real_escape_string($con,$_POST['created_by']); 
$gender=$db->setfilter($_POST['gender']);
$profile_location_type = trim((string)($_POST['profile_location_type'] ?? ''));
 //echo $gender;
 $regno=$db->setfilter($_POST['regno']);
$sDay =$db->setfilter($_POST['dob']);
$sMonth =$db->setfilter($_POST['dobMonth']);
$syear =$db->setfilter($_POST['dobYear']);
$slash = "-"; 	
$dob=$syear.$slash.$sMonth.$slash.$sDay;	

$sigdat= $db->setfilter($_POST['regdate1']);
$date12=explode("-",$sigdat);
 $signdate=$date12['2']."-".$date12['1']."-".$date12['0'];

//echo $dob;
//exit;
$fname=$db->setfilter($_POST['fname']);
$lname=$db->setfilter($_POST['lname']);
$name=ucfirst($fname)." ".ucfirst($lname);
//$sub_caste=mysqli_real_escape_string($con,$_POST['subcaste']);
$sub_caste =!empty($db->setfilter($_POST['subcaste'])) ? "'".$db->setfilter($_POST['subcaste'])."'" : "NULL";
//echo $sub_caste;

$religion=$db->setfilter($_POST['religion']);
$caste=$db->setfilter($_POST['caste']);

$maritial_status=$db->setfilter($_POST['maritial_status']);
//$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
//$countrycode=mysqli_real_escape_string($con,$_POST['countrycode']);
//$aboutus=addslashes($_POST['aboutus']);
//$term=mysql_real_escape_string($_POST['checkbox']);
//$child_status=$_POST['childrenstatus'];
//$noc=$_POST['noofchildren'];
$error=0;
if (!in_array($profile_location_type, ['Indian Resident', 'NRI'], true)) {
  $profile_location_type_error="Please select profile location";
  $error=1;
}
// if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
// //your site secret key
  
//   $secret = '6LdeqCYTAAAAAOzIGNs6dLbxoSllsg6Cy_l1OrdV';
// //get verify response data
//    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
//    $responseData = json_decode($verifyResponse);
// else:
//    $capctha_error = 'Please click on the reCAPTCHA box.';
//     $error=1;
// endif;
  
if($fname=="")
{
  $fname_error="Please Enter First Name"; 
   $error=1;
}
elseif (preg_match('/^[A-Za-z ]+$/', $fname) && trim($fname) !== '') {
       // echo "The string $testcase consists of all letters.\n";
 } else {
       $fname_error="Please Enter only Text"; 
 $error=1;
 }
if($lname=="")
{
$lname_error="Please Enter Last Name";  
 $error=1;
}
elseif (ctype_alpha($lname)) {
       // echo "The string $testcase consists of all letters.\n";
    } else {
       $lname_error="Please Enter only Text"; 
 $error=1;
 } 

$len = strlen($pass);
if($pass=="")
{
$pass_error="Please Enter password";  
 $error=1;
}
 elseif($len < 4){
    
        //return "Field Name is too short, minimum is $min characters ($max max)".
    $pass_error="Password is too weak"; 
 $error=1;
    }
    elseif($len > 35){
    //$len = strlen($pwd);
        //return "Field Name is too long, maximum is $max characters ($min min).";
    $pass_error="Password is too long"; 
 $error=1;
    }
$em="select ConfirmEmail from register";
$result1=array();
$result1=mysqli_query($con,$em);
	
if($email=="")
  {
    $email_error="Please Enter email";	
    $error=1;
  }
else if(isset($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_error="Invalid email format"; 
    $error=1;
}else
{
	//To check exisisting email by Pradnya
$sql = mysqli_query($con,"SELECT ConfirmEmail FROM register where ConfirmEmail='".$_POST['email']."'");

while($row=mysqli_fetch_array($sql))
{
if(in_array($email,$row)===false)
{
    // no match .... continue
}
else
{
 $email_error="The email address is already registered";	
 $error=1;
}
}
}


if($dob=="")
{
$dob_error="Please select DOB"; 
 $error=1;
}

$name=ucfirst($fname)." ".ucfirst($lname);
if($error==0)
{



$sql = "SELECT MAX(id) AS max from register";
$result = mysqli_query($con,$sql) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);
$RID = $row['max'] + 1;

$respre=mysqli_query($con,'select * from siteconfig');
$rowpre=mysqli_fetch_array($respre);

/*$mid=$rowpre['prefix'].strtoupper(substr($fname,0,1)).strtoupper(substr($lname,0,1)).$RID;*/
$prefix=$rowpre['prefix'];
$mid=$prefix.$RID; 
 $datearr=explode("-",$bdate);
 $newdate=$datearr['2']."-".$datearr['1']."-".$datearr['0'];
 
 
$query="insert into register(Name,DOB,ConfirmEmail,ConfirmPassword,MatriID,Status,otp,Regdate,Termsofservice,Photo1,theme,visibility,follow,horoscope_visibility,franchise_id,franch_pay,reg_step,photo_visibility,phone_visibility,profile_approve,Gender,memtype,auto_approve,regno,signdate,Relation_id) values
('$name','$dob','$email','$pass','$mid','Active','yes',now(),'I Agree T&c','nophoto.jpg','9','Yes','visible','paidhoro','$franchise_id','NotPaid','1','allphoto','paidphone','No','$gender','Free','$auto_on_off','$regno','$signdate','0')";
//echo "insert into register(Name,DOB,ConfirmEmail,ConfirmPassword,MatriID,Status,otp,Regdate,Termsofservice,Photo1,theme,visibility,follow,horoscope_visibility,franchise_id,franch_pay,reg_step,photo_visibility,phone_visibility,profile_approve,Gender) values
//('$name','$dob','$email','$pass','$mid','Active','yes',now(),'I Agree T&c','nophoto.jpg','9','Yes','visible','paidhoro','$franchise_id','NotPaid','1','allphoto','paidphone','No','$gender')";

$_SESSION['mobile']=$mobile;
$_SESSION['emailtemp']=$email;
$_SESSION['tempid']=$mid;
$_SESSION['MatriID']=$mid;
$_SESSION['matriid']=$mid;
$_SESSION['regno']=$regno;
$_SESSION['regdate1']=$signdate;
$_SESSION['Name']=$name;
$_SESSION['pwd']=$pass;
$_SESSION['caste']=$caste;
$_SESSION['maritial_status']=$maritial_status;
$_SESSION['name']=$name;
$_SESSION['Gender']=$gender;
$_SESSION['registration_profile_type']=$profile_location_type;
unset($_SESSION['nri_registration_data']);
$_SESSION['querystr']=$query;
header('Location: '.($profile_location_type === 'NRI' ? 'nri_registration' : 'step2'));
exit;
}
} 
?>
