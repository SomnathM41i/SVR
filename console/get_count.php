<?php 
require_once(dirname(__FILE__).'/protect.php');
$hobbies=explode(",",$me['Looking']);
//$mother=implode(",",$me['PE_MotherTongue']);
$pe_from_height = $me['PE_from_Height'];
$pe_to_height = $me['PE_to_Height'];
$pe_toage = $me['PE_ToAge'];
$pe_fromage = $me['PE_FromAge'];
$PE_Complexion=$me['PE_Complexion'];
$PE_Education=$me['PE_Education'];
$PE_star=$me['PE_star'];
$Residencystatus=$me['Residencystatus'];
$pe_religion=$me['PE_Religion'];
$Country=$me['Country'];	
$pe_caste = $me['PE_Caste'];
$PE_subcaste=$me['PE_subcaste'];
//$religion=$me['Religion'];
//$caste=$me['Caste'];
//$Subcaste=$me['Subcaste'];
if($me['Gender']=='Male')
	$match_sex = "Female";
if($me['Gender']=='Female')
	$match_sex = "Male"; 
$check=mysqli_query($con,"select matriid from block_member where profile_id='$id'"); 
$data1=array();
while($check1=mysqli_fetch_array($check))
{
	$data1[]=$check1['matriid'];
}
$matriid=implode("','",$data1);

$check2=mysqli_query($con,"select profile_id from block_member where matriid='$id'"); 
$data = array();
while($check3=mysqli_fetch_array($check2))
{
	$data[] = $check3['profile_id'];
}
$profile=implode("','", $data);

$match_qry_count="select COUNT(*) as totalCount from register where visibility NOT LIKE 'hidden' AND MatriID NOT LIKE '$id' AND ";
if($profile!="")
{
	$match_qry_count.=" MatriID NOT IN ('$profile') and "; 
}
if($matriid!="")
{
	$match_qry_count.=" MatriID NOT IN ('$matriid') and ";  
}
if($me['Looking']!="" && $me['Looking']!="Any")
{
	$PE_Religion_look=explode(" , ", $me['Looking']);
	$PE_Religion_look1 = array();
	foreach($PE_Religion_look as $row => $value){
	$PE_Religion_look1[] = "'$value'";
}
$PE_Religion_look12 = implode(',', $PE_Religion_look1);
$match_qry_count.="Maritalstatus IN($PE_Religion_look12) AND";
}

$match_qry_count.=" Gender='$match_sex' AND ";
$match_qry_count.=" Height BETWEEN '$pe_from_height'AND'$pe_to_height' AND ";
$match_qry_count.="
Age BETWEEN '$pe_fromage' AND '$pe_toage'";


if($me['PE_MotherTongue']!="" && $me['PE_MotherTongue']!="Any")
{
$PE_mother=explode(",", $me['PE_MotherTongue']);
$terms = array();
foreach($PE_mother as $row => $value){
$terms[] = "'$value'";
}
$term_str = implode(',', $terms);

$mother_a=explode(",", $me['mother_tounge']);
$terms_a = array();
foreach($mother_a as $row => $value){
$terms_a[] = "'$value'";
}
$match_qry_count.=" and '$terms_a' IN($term_str)";
} 

if($me['PE_star']!="" && $me['PE_star']!="Any")
{ 
	$PE_star_exp=explode(",", $me['PE_star']);
	$PE_star_term = array();
	foreach($PE_star_exp as $row => $value){
	$PE_star_term[] = "'$value'";
}
$PE_star_re = implode(',', $PE_star_term);
$match_qry_count.=" and Star IN($PE_star_re) ";
}

if($me['PE_Complexion']!="" && $me['PE_Complexion']!="Any")
{ 
	$PE_Complexion_exp=explode(",", $me['PE_Complexion']);
	$PE_Complexion_term = array();
	foreach($PE_Complexion_exp as $row => $value){
	$PE_Complexion_term[] = "'$value'";
}
$PE_Complexion_re = implode(',', $PE_Complexion_term);
$match_qry_count.=" and Complexion IN($PE_Complexion_re) ";
}
/*
if($religion!="")
{
	$match_qry_count.=" and  Religion='$religion' AND ";  
}
if($caste!="")
{
	$match_qry_count.=" Caste='$caste' and ";  
}
if($Subcaste!="")
{
	$match_qry_count.=" Subcaste='$Subcaste' ";  
}
*/


if($me['PE_Residentstatus']!="" && $me['PE_Residentstatus']!="Any")
{
$PE_Residentstatus_exp=explode(",",$me['PE_Residentstatus']);
$PE_Residentstatus_term=array();
foreach($PE_Residentstatus_exp as $row=>$value)
{
$PE_Residentstatus_term[]="'$value'";
}
$PE_Residentstatus_re=implode(',',$PE_Residentstatus_term);
$match_qry_count.=" and Residencystatus IN($PE_Residentstatus_re)";
}

if($me['PE_Religion']!="" && $me['PE_Religion']!="Any")
{
$PE_Religion_exp=explode(",",$me['PE_Religion']);
$PE_Religion_term=array();
foreach($PE_Religion_exp as $row=>$value)
{
	$PE_Religion_term[]="'$value'";
}
$PE_Religion_re=implode(',',$PE_Religion_term);
$match_qry_count.=" and Religion IN($PE_Religion_re)";	
}
if($me['PE_Caste']!="" && $me['PE_Caste']!="Any")
{
$PE_Caste_exp=explode(",",$me['PE_Caste']);
$PE_Caste_term=array();
foreach($PE_Caste_exp as $row=>$value)
{
	$PE_Caste_term[]="'$value'";
}
$PE_Caste_re=implode(',',$PE_Caste_term);
$match_qry_count.=" and Caste IN($PE_Caste_re)";	
}

if($me['PE_Countrylivingin']!="" && $me['PE_Countrylivingin']!="Any")
{
$PE_Countrylivingin_exp=explode(",",$me['PE_Countrylivingin']);
$PE_Countrylivingin_term=array();
foreach($PE_Countrylivingin_exp as $row=>$value)
{
	$PE_Countrylivingin_term[]="'$value'";
}
$PE_Countrylivingin_re=implode(',',$PE_Countrylivingin_term);
$match_qry_count.=" and Country IN($PE_Countrylivingin_re)";
}
if($me['PE_State']!="" && $me['PE_State']!="Any")
{
$PE_State_exp=explode(",",$me['PE_State']);
$PE_State_term=array();
foreach($PE_State_exp as $row=>$value)
{
	$PE_State_term[]="'$value'";
}
$PE_State_re=implode(',',$PE_State_term);
$match_qry_count.=" and State IN($PE_State_re)";	
}
if($me['PE_Occupation']!="" && $me['PE_Occupation']!="Any")
{
$PE_occu_exp=explode(",",$me['PE_Occupation']);
$PE_occu_term=array();
foreach($PE_occu_exp as $row=>$value)
{
	$PE_occu_term[]="'$value'";
}
$PE_occu_re=implode(',',$PE_occu_term);
$match_qry_count.=" and Occupation IN($PE_occu_re)";	
}
if($me['PE_Education']!="" && $me['PE_Education']!="Any")
{
$PE_Education_exp=explode(",",$me['PE_Education']);
$PE_Education_term=array();
foreach($PE_Education_exp as $row=>$value)
{
	$PE_Education_term[]="'$value'";
}
$PE_Education_re=implode(',',$PE_Education_term);
$match_qry_count.=" and Education IN($PE_Education_re)";	
}
$match_qry_count.="and  Status Not LIKE'Banned' ORDER BY Regdate DESC";
$match_querysql=mysqli_query($con,$match_qry_count);
$match_queryfetch=mysqli_fetch_array($match_querysql);
?>