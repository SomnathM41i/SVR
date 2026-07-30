<?php require_once('../sys_dbconnection.php');  
include('protect.php');
/*include('../dbconnectadmin.php');*/
$strmid=$_POST['ID']; 

$txtHeight = mysqli_real_escape_string($con,$_POST['txtHeight']);
$txtWeight = mysqli_real_escape_string($con,$_POST['txtWeight']);
$txtBlood = mysqli_real_escape_string($con,$_POST['txtBlood']);
$txtBody = mysqli_real_escape_string($con,$_POST['txtBody']);
$txtComplexion = mysqli_real_escape_string($con,$_POST['txtComplexion']);
$txtDiet = mysqli_real_escape_string($con,$_POST['txtDiet']);
$txtSmoke = mysqli_real_escape_string($con,$_POST['txtSmoke']);
$txtDrink = mysqli_real_escape_string($con,$_POST['txtDrink']);
$txtspecialcase = mysqli_real_escape_string($con,$_POST['scases']);
$txtspecialReson= mysqli_real_escape_string($con,$_POST['otherdist']);




$reg=mysqli_query($con,"Select * from register where MatriID='$strmid'");
$regfet=mysqli_fetch_array($reg);
$reg_step=$regfet['reg_step'];
echo $reg_step;

if($reg_step<6)
{
$con->query("update register set Height='$txtHeight',Weight='$txtWeight',BloodGroup='$txtBlood',Bodytype='$txtBody',Complexion='$txtComplexion',Diet='$txtDiet',Smoke='$txtSmoke',Drink='$txtDrink',spe_cases='$txtspecialcase',spe_reason='$txtspecialReson',reg_step='6' WHERE MatriID= '$strmid' ") or die(mysqli_error($con));
}else { 
$con->query("update register set Height='$txtHeight',Weight='$txtWeight',BloodGroup='$txtBlood',Bodytype='$txtBody',Complexion='$txtComplexion',Diet='$txtDiet',Smoke='$txtSmoke',Drink='$txtDrink',spe_cases='$txtspecialcase',spe_reason='$txtspecialReson' WHERE MatriID= '$strmid' ") or die(mysqli_error($con));
}
header('location:profile_view.php?flag=6&msg=success&ID='.$strmid);
exit;
?>