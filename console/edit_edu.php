<?php require_once('../sys_dbconnection.php');
require_once('../includes/annual_income.php');
//include('protect.php');
/*include('../dbconnectadmin.php');*/
$strmid=$_POST['id']; 
$str_edu = $_POST['txtEdu'];
$str_edudet =addslashes( $_POST['txtEdudetails']);
$str_occu =$_POST['txtOccu'];
$str_occu_det=addslashes($_POST['odetails']);
$str_emp = $_POST['txtEmp'];
$str_ai = annual_income_normalize_value($_POST['income'] ?? '');
if (!annual_income_is_valid($str_ai)) {
	header('location:profile_view?flag=2&msg=invalid-income&ID='.$strmid);
	exit;
}
$incometype = 'Rs';
$workinghrs=$_POST['workinghrs'];
$workloc=$_POST['workloc'];
$txtHeight = mysqli_real_escape_string($con,$_POST['txtHeight']);
$txtWeight = mysqli_real_escape_string($con,$_POST['txtWeight']);
$txtComplexion = mysqli_real_escape_string($con,$_POST['txtComplexion']);
$txtspecialcase = mysqli_real_escape_string($con,$_POST['scases']);
$txtspecialReson= mysqli_real_escape_string($con,$_POST['otherdist']);
$BloodGroup= mysqli_real_escape_string($con,$_POST['BloodGroup']);
$chiit=$_POST['iit'];
$instu=mysqli_real_escape_string($con,$_POST['instu']);
$reg=mysqli_query($con,"Select * from register where MatriID='$strmid'");
$regfet=mysqli_fetch_array($reg);
$reg_step=$regfet['reg_step'];
echo $reg_step;

if($reg_step<5)
{
$con->query("update register set Education ='$str_edu',EducationDetails='$str_edudet',Occupation='$str_occu',occu_details='$str_occu_det',Annualincome='$str_ai',Employedin='$str_emp',income_in='$incometype',working_hours='$workinghrs',workinglocation='$workloc',Height='$txtHeight',Weight='$txtWeight',Complexion='$txtComplexion',spe_cases='$txtspecialcase',spe_reason='$txtspecialReson',reg_step='5',BloodGroup='$BloodGroup',iit='$chiit',instu='$instu'  WHERE MatriID= '$strmid'") or die(mysqli_error($con));
//echo "update register set Education ='$str_edu',EducationDetails='$str_edudet',Occupation='$str_occu',occu_details='$str_occu_det',Annualincome='$str_ai',Employedin='$str_emp',income_in='$incometype',working_hours='$workinghrs',workinglocation='$workloc',Height='$txtHeight',Weight='$txtWeight',Complexion='$txtComplexion',spe_cases='$txtspecialcase',spe_reason='$txtspecialReson',reg_step='5',BloodGroup='$BloodGroup' WHERE MatriID= '$strmid'";
 if($chiit!='yes'){
		mysqli_query($con,"update register set instu=''");
	}
}else {
$con->query("update register set Education ='$str_edu',EducationDetails='$str_edudet',Occupation='$str_occu',occu_details='$str_occu_det',Annualincome='$str_ai',Employedin='$str_emp',income_in='$incometype',working_hours='$workinghrs',workinglocation='$workloc',Height='$txtHeight',Weight='$txtWeight',Complexion='$txtComplexion',spe_cases='$txtspecialcase',spe_reason='$txtspecialReson',BloodGroup='$BloodGroup',iit='$chiit',instu='$instu'  WHERE MatriID= '$strmid'") or die(mysqli_error($con));
	//echo "update register set Education ='$str_edu',EducationDetails='$str_edudet',Occupation='$str_occu',occu_details='$str_occu_det',Annualincome='$str_ai',Employedin='$str_emp',income_in='$incometype',working_hours='$workinghrs',workinglocation='$workloc',Height='$txtHeight',Weight='$txtWeight',Complexion='$txtComplexion',spe_cases='$txtspecialcase',spe_reason='$txtspecialReson',BloodGroup='$BloodGroup' WHERE MatriID= '$strmid'";
 if($chiit!='yes'){
		mysqli_query($con,"update register set instu=''");
	}
}	
header('location:profile_view?flag=2&msg=success&ID='.$strmid);
exit;
?>
