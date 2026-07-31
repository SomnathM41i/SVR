<title>Edit contact</title>
<?php require_once('../sys_dbconnection.php');   
require_once(dirname(__FILE__).'/protect.php');
/*include('../dbconnectadmin.php');*/
$strmid=$_POST['ID']; 
$str_add =mysqli_real_escape_string($con,$_POST['txtAddress']);
$country=mysqli_real_escape_string($con,$_POST['country']);
$state=mysqli_real_escape_string($con,$_POST['state']);
$city=mysqli_real_escape_string($con,$_POST['city']);
$dist=mysqli_real_escape_string($con,$_POST['dist']);
$taluka=mysqli_real_escape_string($con,$_POST['taluka'] ?? '');
$residenceIN=mysqli_real_escape_string($con,$_POST['residence']);
$str_pho = mysqli_real_escape_string($con,$_POST['txtPhone']);
$str_mob = mysqli_real_escape_string($con,$_POST['txtMobile']);
$str_mob2 = mysqli_real_escape_string($con,$_POST['txtMobile2']);
$Pincode=$_POST['Pincode'];
$calling=$_POST['calling'];
$calling_time=$_POST['calling_time'];
$reg=mysqli_query($con,"Select * from register where MatriID='$strmid'");
$regfet=mysqli_fetch_array($reg);
$reg_step=$regfet['reg_step'];
//echo $reg_step;

$work_address = mysqli_real_escape_string($con,$_POST['txtworkAddress']);
$working_country = mysqli_real_escape_string($con,$_POST['working_country']);
$working_state = mysqli_real_escape_string($con,$_POST['working_state']);
$working_dist = mysqli_real_escape_string($con,$_POST['working_dist']);
$working_taluka = mysqli_real_escape_string($con,$_POST['working_taluka'] ?? '');
$working_city = mysqli_real_escape_string($con,$_POST['working_city']);
$work_pincode = mysqli_real_escape_string($con,$_POST['work_pincode']);
$work_residence = mysqli_real_escape_string($con,$_POST['work_residence']);

/*echo $_POST['working_dist']; 
echo $calling_time;

echo $work_address;
echo $working_country;
echo $working_state;
echo $working_dist;
echo $working_city;
echo $work_pincode;
echo $work_residence;*/

if($reg_step<4)
{
$con->query("update register set Address ='$str_add',City='$city',State='$state',Country='$country',Dist='$dist',Taluka='$taluka',Phone='$str_pho', Mobile='$str_mob',Mobile2='$str_mob2',Residencystatus='$residenceIN',Pincode='$Pincode',calling_time='$calling_time', reg_step='4', working_country='$working_country', working_state='$working_state', working_city='$working_city', working_dist='$working_dist', working_taluka='$working_taluka', work_pincode='$work_pincode', work_address='$work_address', work_residence='$work_residence' WHERE MatriID= '$strmid' ") or svr_db_fail($con);

}else{
$con->query("update register set Address ='$str_add',City='$city',State='$state',Country='$country',Dist='$dist',Taluka='$taluka',Phone='$str_pho', Mobile='$str_mob',Mobile2='$str_mob2',Residencystatus='$residenceIN',Pincode='$Pincode',calling_time='$calling_time', working_country='$working_country', working_state='$working_state', working_city='$working_city', working_dist='$working_dist', working_taluka='$working_taluka', work_pincode='$work_pincode', work_address='$work_address', work_residence='$work_residence' WHERE MatriID= '$strmid' ") or svr_db_fail($con);
	
	//echo "update register set Address ='$str_add',City='$city',State='$state',Country='$country',Dist='$dist',Phone='$str_pho', Mobile='$str_mob',Mobile2='$str_mob2',Residencystatus='$residenceIN',Pincode='$Pincode',calling_time='$calling_time', working_country='$working_country', working_state='$working_state', working_city='$working_city', working_dist='$working_dist', work_pincode='$work_pincode', work_address='$work_address', work_residence='$work_residence' WHERE MatriID= '$strmid'";
}
//header('location:profile_view.php?ID='.$strmid);
echo ("<script>location.href='profile_view?flag=5&msg=success&ID=".$strmid."'</script>");
exit;
?>
