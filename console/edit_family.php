<?php require_once('../sys_dbconnection.php');   
include('protect.php');

$strmid=$_POST['id']; 

$txtFD = mysqli_real_escape_string($con,$_POST['txtFD']);
$txtFV = mysqli_real_escape_string($con,$_POST['txtFV']);
$txtFT= mysqli_real_escape_string($con,$_POST['txtFT']);
$txtFS = mysqli_real_escape_string($con,$_POST['txtFS']);

$txtFANAME=mysqli_real_escape_string($con,$_POST['txtFANAME']);
$txtFFO = mysqli_real_escape_string($con,$_POST['txtFFO']);
$txtMONAME=mysqli_real_escape_string($con,$_POST['txtMONAME']);
$txtFMO=mysqli_real_escape_string($con,$_POST['txtFMO']);
$txtFS1 = $_POST['txtFS1'];
$txtFS2=$_POST['txtFS2'];

$txtmotnertoung =mysqli_real_escape_string($con,$_POST['mother_tounge']);
$txtlivingstatus =mysqli_real_escape_string($con,$_POST['living_status']);
$family_wealth =implode(",", $_POST['family_wealth']);
$txtrelativCast =mysqli_real_escape_string($con,$_POST['village']);
$txtAbout= ltrim(mysqli_real_escape_string($con,$_POST['txtAboutfamily']));
$SOB=$_POST['SOB'];

$relatives =mysqli_real_escape_string($con,$_POST['relatives']);
if($txtFS1=='No')
{
	$txtnoBrotherMarr=$_POST['bmarriedno'];
}
if($txtFS1=='1')
{
	$txtnoBrotherMarr=$_POST['bmarried1'];
}
if($txtFS1=='2')
{
	$txtnoBrotherMarr=$_POST['bmarried2'];
}
if($txtFS1=='3')
{
	$txtnoBrotherMarr=$_POST['bmarried3'];
}
if($txtFS1=='4')
{
	$txtnoBrotherMarr=$_POST['bmarried4'];
}
if($txtFS1=='5')
{
	$txtnoBrotherMarr=$_POST['bmarried5'];
}
if($txtFS1=='5+')
{
	$txtnoBrotherMarr=$_POST['bmarried6'];
}

if($txtFS2=='No')
{
	$txtNoSisterMarr=$_POST['smarriedno'];
}
if($txtFS2=='1')
{
	$txtNoSisterMarr=$_POST['smarried1'];
}
if($txtFS2=='2')
{
	$txtNoSisterMarr=$_POST['smarried2'];
}
if($txtFS2=='3')
{
	$txtNoSisterMarr=$_POST['smarried3'];
}
if($txtFS2=='4')
{
	$txtNoSisterMarr=$_POST['smarried4'];
}
if($txtFS2=='5')
{
	$txtNoSisterMarr=$_POST['smarried5'];
}
if($txtFS2=='5+')
{
	$txtNoSisterMarr=$_POST['smarried6'];
}
$reg=mysqli_query($con,"Select * from register where MatriID='$strmid'");
$regfet=mysqli_fetch_array($reg);
$reg_step=$regfet['reg_step'];


if($reg_step<6)
{
$con->query("update register set FamilyDetails='$txtFD',Familyvalues='$txtFV',FamilyType='$txtFT',FamilyStatus	='$txtFS',noofbrothers='$txtFS1',noofsisters='$txtFS2',Fathername='$txtFANAME',Mothersname='$txtMONAME', Fathersoccupation='$txtFFO', Mothersoccupation='$txtFMO',mother_tounge='$txtmotnertoung',relatives='$relatives',nbm='$txtnoBrotherMarr',nsm='$txtNoSisterMarr',FamilyDetails='$txtAbout',parents_stay='$txtlivingstatus',family_wealth='$family_wealth',reg_step='6' WHERE MatriID= '$strmid' ") or svr_db_fail($con);
}else {
$con->query("update register set FamilyDetails='$txtFD',Familyvalues='$txtFV',FamilyType='$txtFT',FamilyStatus	='$txtFS',noofbrothers='$txtFS1',noofsisters='$txtFS2',Fathername='$txtFANAME',Mothersname='$txtMONAME', Fathersoccupation='$txtFFO', Mothersoccupation='$txtFMO',mother_tounge='$txtmotnertoung',relatives='$relatives',nbm='$txtnoBrotherMarr',nsm='$txtNoSisterMarr',FamilyDetails='$txtAbout',parents_stay='$txtlivingstatus',family_wealth='$family_wealth' WHERE MatriID= '$strmid' ") or svr_db_fail($con);
}	

header('location:profile_view?flag=4&msg=success&ID='.$strmid);
exit;
?>