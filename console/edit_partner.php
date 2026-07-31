<?php require_once('../sys_dbconnection.php'); 
include('protect.php');

$strmid=$_POST['ID']; 

$str_fage= mysqli_real_escape_string($con,strip_tags($_POST['fromage']));  
$str_tage= mysqli_real_escape_string($con,strip_tags($_POST['toage'])); 
$str_fhei= mysqli_real_escape_string($con,strip_tags($_POST['txtfHeight']));
$str_thei= mysqli_real_escape_string($con,strip_tags($_POST['txttHeight']));

if(isset($_POST['txtPComplexion'])){
$str_com=ltrim(implode(",",$_POST['txtPComplexion']));
}else{
$str_com="";
} 

if(isset($_POST['religion'])){
$str_rel=ltrim(implode(",",$_POST['religion']));
}else{
$str_rel="";
} 
if(isset($_POST['caste'])){
$str_cas=ltrim(implode(",",$_POST['caste']));
}else{
$str_cas="";
} 


if(isset($_POST['txtPEdu'])){
$str_edu=ltrim(implode(",",$_POST['txtPEdu']));
}else{
$str_edu="";
}

if(isset($_POST['txtPcountry'])){
$str_cou=ltrim(implode(",",$_POST['txtPcountry']));
}else{
$str_cou="";
}

if(isset($_POST['cbostate123'])){
$str_state=ltrim(implode(",",$_POST['cbostate123']));
}else{
$str_state="";
}

if(isset($_POST['txtPReS'])){
$str_res=ltrim(implode(",",$_POST['txtPReS']));
}else{
$str_res="";
}

if(isset($_POST['txtLooking'])){
$txtLooking=ltrim(implode(",",$_POST['txtLooking']));
}else{
$txtLooking="";
}

if(isset($_POST['pe_occu'])){
$pe_occu=ltrim(implode(",",$_POST['pe_occu']));
}else{
$pe_occu="";
}


$str_patEXp = ltrim(mysqli_real_escape_string($con,$_POST['txtPartnerExpectations']));



$reg=mysqli_query($con,"Select * from register where MatriID='$strmid'");
$regfet=mysqli_fetch_array($reg);
$reg_step=$regfet['reg_step'];


if($reg_step<9)
{
$con->query("update register set  
PE_FromAge ='$str_fage',             
PE_ToAge  ='$str_tage',              
PE_from_Height  ='$str_fhei',      
PE_to_Height  ='$str_thei',              
PE_Complexion  ='$str_com',               
PE_Religion ='$str_rel',             
PE_Caste    ='$str_cas',            
PE_Education  ='$str_edu',            
PE_Countrylivingin  ='$str_cou',               
PE_Residentstatus ='$str_res',
Looking = '$txtLooking',
PE_income_from = '$str_incomefrom',
PE_income_to = '$str_incomeTO',
pe_subcaste_marry ='$str_marry',
PartnerExpectations ='$str_patEXp',PE_subcaste='$str_subcas',PE_MotherTongue='$mother_tongue', PE_Occupation='$pe_occu',PE_State='$str_state',PE_City='$cbocity'
,reg_step='9' WHERE  MatriID='$strmid' ") or svr_db_fail($con);
}else {
$con->query("update register set  
PE_FromAge ='$str_fage',             
PE_ToAge  ='$str_tage',              
PE_from_Height  ='$str_fhei',      
PE_to_Height  ='$str_thei',              
PE_Complexion  ='$str_com',               
PE_Religion ='$str_rel',             
PE_Caste    ='$str_cas',            
PE_Education  ='$str_edu',            
PE_Countrylivingin  ='$str_cou',               
PE_Residentstatus ='$str_res',
Looking = '$txtLooking',
PE_income_from = '$str_incomefrom',
PE_income_to = '$str_incomeTO',
pe_subcaste_marry ='$str_marry',
PartnerExpectations ='$str_patEXp',PE_subcaste='$str_subcas',PE_MotherTongue='$mother_tongue', PE_Occupation='$pe_occu',PE_State='$str_state',PE_City='$cbocity'
WHERE  MatriID='$strmid' ") or svr_db_fail($con);
}	

header('location:profile_view?flag=3&msg=success&ID='.$strmid);
exit;
?>