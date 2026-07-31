<?php require_once('../sys_dbconnection.php'); 
require_once(dirname(__FILE__).'/protect.php');
/*include('../dbconnectadmin.php');*/
//include('../dbconnectadmin.php');
date_default_timezone_set('Asia/Kolkata');
//include('smtp.php');
session_start();
$mail_delete=$_GET['matriid'];

// Delete Mail Starts

$query="SELECT * FROM siteconfig where ID='1'";
$configdata=mysqli_query($con,$query); 
$info=mysqli_fetch_array($configdata);
	   	
		//$mememail=$_POST['user'];
		$query1="SELECT * FROM register where MatriID='$mail_delete'";
		$forpass=mysqli_query($con,$query1) or die(mysqli_error()); 
		$forpass1=mysqli_fetch_array($forpass);
		


//Delete Mail Ends
//echo $mail_delete;
$id=$_GET['matriid'];

$result =mysqli_query($con,"SELECT * FROM register where MatriID='$id'");
while($row = mysqli_fetch_array($result))
{


$ID_reg=$row['ID'];
 $MatriID=$row['MatriID'];
 $Prefix=$row['Prefix'];
 $Termsofservice=$row['Termsofservice']; 
 $ConfirmEmail=$row['ConfirmEmail']; 
 $ConfirmPassword=$row['ConfirmPassword']; 
  $Profilecreatedby=$row['Profilecreatedby'];
 $Referenceby=$row['Referenceby'];  
 $Name=$row['Name']; 
 $Gender=$row['Gender'];
   $DOB=$row['DOB']; 
   $Age=$row['Age'];
    $TOB=$row['TOB']; 
	 $POB=$row['POB'];  
	$Maritalstatus=$row['Maritalstatus'];
	$childrenlivingstatus=$row['childrenlivingstatus'];
	$Education=$row['Education'];
		$EducationDetails=$row['EducationDetails']; 
	$Occupation=$row['Occupation']; 	
	$Employedin=$row['Employedin'];
	$Annualincome=$row['Annualincome']; 
		$Religion=$row['Religion']; 
		$Caste=$row['Caste']; 
		$Subcaste=$row['Subcaste']; 
		$Gothram=$row['Gothram']; 
		$Language=$row['Language']; 
		$Star=$row['Star'];
		$Moonsign=$row['Moonsign'];
		$Horosmatch=$row['Horosmatch'];
		$Manglik=$row['Manglik'];

			$Height=$row['Height'];
			$Weight=$row['Weight'];
			$BloodGroup=$row['BloodGroup'];
			$Bodytype=$row['Bodytype'];
			$spe_cases=$row['spe_cases'];
			$Complexion=$row['Complexion'];
			$Diet=$row['Diet'];
			$Smoke=$row['Smoke'];
			$Drink=$row['Drink'];
			$Address=$row['Address'];
			$City=$row['City'];
			$Dist=$row['Dist'];
			$State=$row['State'];
			$Country=$row['Country'];
			$Pincode=$row['Pincode'];
			$Phone=$row['Phone'];
			$Mobile=$row['Mobile'];
			$Residencystatus=$row['Residencystatus'];
			$Fathername=$row['Fathername'];
			$Mothersname=$row['Mothersname'];
			$Fatherlivingstatus=$row['Fatherlivingstatus'];
			$Motherlivingstatus=$row['Motherlivingstatus'];
			$Fathersoccupation=$row['Fathersoccupation'];
			
			$Mothersoccupation=$row['Mothersoccupation'];
			$Profile=$row['Profile'];
			$Profile_new=$row['Profile_new'];
			$profile_approve=$row['profile_approve'];
			$par_profile=$row['par_profile'];
			$Looking=$row['Looking'];
			$FamilyDetails=$row['FamilyDetails'];
			$FamilyDetails_new=$row['FamilyDetails_new'];
			$FamilyDetails_approve=$row['FamilyDetails_approve'];
			
			$Familyvalues=$row['Familyvalues'];
			$FamilyType=$row['FamilyType'];
			$FamilyStatus=$row['FamilyStatus'];
			$FamilyOrigin=$row['FamilyOrigin'];
			$noofbrothers=$row['noofbrothers'];
			$noofsisters=$row['noofsisters'];
			$nbm=$row['nbm'];
			$nsm=$row['nsm'];
			$PE_FromAge=$row['PE_FromAge'];
			$PE_ToAge=$row['PE_ToAge'];
			$PE_HaveChildren=$row['PE_HaveChildren'];
			$PE_from_Height=$row['PE_from_Height'];
			$PE_to_Height=$row['PE_to_Height'];
			$PE_Complexion=$row['PE_Complexion'];
			$PE_MotherTongue=$row['PE_MotherTongue'];
			$PartnerExpectations=$row['PartnerExpectations'];
			$PartnerExpectations_new=$row['PartnerExpectations_new'];
			$PartnerExpectations_approve=$row['PartnerExpectations_approve'];
			$PE_Religion=$row['PE_Religion'];
			$PE_Caste=$row['PE_Caste'];
			$PE_Education=$row['PE_Education'];
			
			
			$PE_Countrylivingin=$row['PE_Countrylivingin'];
			$PE_Residentstatus=$row['PE_Residentstatus'];
			$Hobbies=$row['Hobbies'];
			$OtherHobbies=$row['OtherHobbies'];
			$Interests=$row['Interests'];
			$OtherInterests=$row['OtherInterests'];
			$Status=$row['Status'];
			$memtype=$row['memtype'];
			$Regdate=$row['Regdate'];
			
			$last_seen_hour=$row['last_seen_hour'];
			$IP=$row['IP'];
			$Ref=$row['Ref'];
			$Agent=$row['Agent'];
			$DeleteAction=$row['DeleteAction'];
			$MemshipExpiryDate=$row['MemshipExpiryDate'];
			$expdays=$row['expdays'];
			$Horoscheck=$row['Horoscheck'];
			$HorosApprove=$row['HorosApprove'];
			$horoscope_visibility=$row['horoscope_visibility'];
			$PhotoProtect=$row['PhotoProtect'];
			$PhotoprotectPassword=$row['PhotoprotectPassword'];
			$Video=$row['Video'];
			$Videocheck=$row['Videocheck'];
			$Noofcontacts=$row['Noofcontacts'];
			$photocheck=$row['photocheck'];
			$photochecklist=$row['photochecklist'];
			
			
			
			$videochecklist=$row['videochecklist'];
			$Horoschecklist=$row['Horoschecklist'];
			$DOBday=$row['DOBday'];
			$DOBmonth=$row['DOBmonth'];
			$DOByear=$row['DOByear'];
			$Orderstatus=$row['Orderstatus'];
			$Photo1=$row['Photo1'];
			$Photo1Approve=$row['Photo1Approve'];
			$Photo2=$row['Photo2'];
			$Photo2Approve=$row['Photo2Approve'];
			$Photo3=$row['Photo3'];
			$Photo3Approve=$row['Photo3Approve'];
			$Logincount=$row['Logincount'];
			$Lastlogin=$row['Lastlogin'];
			$Thislogin=$row['Thislogin'];
			$dumprofile=$row['dumprofile'];
			$pagecount=$row['pagecount'];
			$noyusisters=$row['noyusisters'];
			$noyubrothers=$row['noyubrothers'];
			$crop=$row['crop'];
			$PE_Height2=$row['PE_Height2'];
			
			
			$horos_status=$row['horos_status'];
			$g1=$row['g1'];  
			$g2=$row['g2'];
			$g3=$row['g3'];
			$g4=$row['g4'];
			$g5=$row['g5'];
			$g6=$row['g6'];
			$g7=$row['g7'];
			$g8=$row['g8'];
			$g9=$row['g9'];
			$g10=$row['g10'];
			$g11=$row['g11'];
			$g12=$row['g12'];
			$a1=$row['a1'];
			$a2=$row['a2'];
			$a3=$row['a3'];
			$a4=$row['a4'];
			
			
			
			$a5=$row['a5'];
			$a6=$row['a6'];
			$a7=$row['a7'];
			$a8=$row['a8'];
			$a9=$row['a9'];
			$a10=$row['a10'];
			$a11=$row['a11'];
			$a12=$row['a12'];
			$thosam=$row['thosam'];
			$horosother=$row['horosother'];
			$dummy=$row['dummy'];
			$dasatype=$row['dasatype'];
			$dasayear=$row['dasayear'];
			
			$dasamonth=$row['dasamonth'];
			$dasadate=$row['dasadate'];
			$featured=$row['featured'];
			$certificate1=$row['certificate1'];
			$aboutcertificate1=$row['aboutcertificate1'];
			$certificate2=$row['certificate2'];
			$aboutcertificate2=$row['aboutcertificate2'];
			$certificate3=$row['certificate3'];
			$aboutcertificate3=$row['aboutcertificate3'];
			$workin=$row['workin'];
			$mrandom=$row['mrandom'];
			$verifymobile=$row['verifymobile'];
			$middlename=$row['middlename'];
			$lastname=$row['lastname'];
			
			$fathermiddle=$row['fathermiddle'];
			$fatherLast=$row['fatherLast'];
			$mothermiddle=$row['mothermiddle'];
			$motherlast=$row['motherlast'];
			$charan=$row['charan'];
			$Gan=$row['Gan'];
			$nadi=$row['nadi'];
			$reference=$row['reference'];
			$franch_pay=$row['franch_pay'];
			$Handicapt_status=$row['Handicapt_status'];
			$Handicapt_reson=$row['Handicapt_reson'];
			$occu_details=$row['occu_details'];
			$branch_state=$row['branch_state'];
			
			$branch_name=$row['branch_name'];
			$theme=$row['theme'];
			$otp=$row['otp'];
			$online_status=$row['online_status'];
			$sun=$row['sun'];
			$moon=$row['moon'];
			$mars=$row['mars'];
			$mercury=$row['mercury'];
			$jupiter=$row['jupiter'];
			$venus=$row['venus'];
			$saturn=$row['saturn'];
			$rahu=$row['rahu'];
			$ketu=$row['ketu'];
			$gulikan=$row['gulikan'];
			$lagna=$row['lagna'];
			$place=$row['place'];
			$last_seen_date=$row['last_seen_date'];
			$last_seen_min=$row['last_seen_min'];
			
			$last_seen_am=$row['last_seen_am'];
			$last_seen_min=$row['last_seen_hour'];
			$visibility=$row['visibility'];
			$follow=$row['follow'];
			$Biodata=$row['Biodata'];
			$Biodata_approve=$row['Biodata_approve'];
				$village=$row['village'];
					$shani=$row['shani']; 
						$Logintype=$row['Logintype'];
			


//$sql=$con->query("insert into deleted_profile(`MatriID`)values('$MatriID')");

$sql=mysqli_query($con,"insert into deleted_profile(`MatriID`,`ID_reg`, `Prefix`, `Termsofservice`, `ConfirmEmail`, `ConfirmPassword`, `Profilecreatedby`, `Referenceby`, `Name`, `Gender`, `DOB`, `Age`, `TOB`, `POB`, `Maritalstatus`, `childrenlivingstatus`, `Education`, `EducationDetails`, `Occupation`, `Employedin`, `Annualincome`, `Religion`, `Caste`, `Subcaste`, `Gothram`, `Language`, `Star`, `Moonsign`, `Horosmatch`, `Manglik`, `Height`, `Weight`, `BloodGroup`, `Bodytype`, `spe_cases`, `Complexion`, `Diet`, `Smoke`, `Drink`, `Address`, `City`, `Dist`, `State`, `Country`, `Pincode`, `Phone`, `Mobile`, `Residencystatus`, `Fathername`, `Mothersname`, `Fatherlivingstatus`, `Motherlivingstatus`, `Fathersoccupation`, `Mothersoccupation`, `Profile`, `Profile_new`, `profile_approve`, `par_profile`, `Looking`, `FamilyDetails`, `FamilyDetails_new`, `FamilyDetails_approve`, `Familyvalues`, `FamilyType`, `FamilyStatus`, `FamilyOrigin`, `noofbrothers`, `noofsisters`, `nbm`, `nsm`, `PE_FromAge`, `PE_ToAge`, `PE_HaveChildren`, 
`PE_from_Height`, `PE_to_Height`, `PE_Complexion`, `PE_MotherTongue`, `PartnerExpectations`, `PartnerExpectations_new`, `PartnerExpectations_approve`, `PE_Religion`, `PE_Caste`, `PE_Education`, `PE_Countrylivingin`, `PE_Residentstatus`, `Hobbies`, `OtherHobbies`, `Interests`, `OtherInterests`, `Status`, `memtype`, `Regdate`, `IP`, `Ref`, `Agent`, `DeleteAction`, `MemshipExpiryDate`, `expdays`, `Horoscheck`, `HorosApprove`, `horoscope_visibility`, `PhotoProtect`, `PhotoprotectPassword`, `Video`, `Videocheck`, `Noofcontacts`, `photocheck`, `photochecklist`, `videochecklist`, `Horoschecklist`, `DOBday`, `DOBmonth`, `DOByear`, `Orderstatus`, `Photo1`, `Photo1Approve`, `Photo2`, `Photo2Approve`, `Photo3`, `Photo3Approve`, `Logincount`, `Lastlogin`, `Thislogin`, `dumprofile`, `pagecount`, `noyusisters`, `noyubrothers`, `crop`, `PE_Height2`, `horos_status`, `g1`, `g2`, `g3`, `g4`, `g5`, `g6`, `g7`, `g8`, `g9`, `g10`, `g11`, `g12`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `thosam`, `horosother`, `dummy`, `dasatype`, `dasayear`, `dasamonth`, `dasadate`, `featured`, `certificate1`, `aboutcertificate1`, `certificate2`, `aboutcertificate2`, `certificate3`, `aboutcertificate3`, `workin`, `mrandom`, `verifymobile`, `middlename`, `lastname`, `fathermiddle`, `fatherLast`, `mothermiddle`, `motherlast`, `charan`, `Gan`, `nadi`, `reference`, `franch_pay`, `Handicapt_status`, `Handicapt_reson`, `occu_details`, `branch_state`, `branch_name`, `theme`, `otp`, `online_status`, `sun`, `moon`, `mars`, `mercury`, `jupiter`, `venus`, `saturn`, `rahu`, `ketu`, `gulikan`, `lagna`, `place`, `last_seen_date`, `last_seen_min`, `last_seen_am`, `last_seen_hour`, `visibility`, `follow`, `Biodata`, `Biodata_approve`,`village`,`shani`,`Logintype`,`delete_date`)
values('$MatriID','$ID_reg', '$Prefix', '$Termsofservice', '$ConfirmEmail', '$ConfirmPassword', '$Profilecreatedby', '$Referenceby', '$Name', 
'$Gender', '$DOB', '$Age', '$TOB', '$POB','$Maritalstatus', '$childrenlivingstatus', 
'$Education', '$EducationDetails', '$Occupation', '$Employedin', '$Annualincome', '$Religion',
 '$Caste','$Subcaste','$Gothram','$Language', '$Star', '$Moonsign', '$Horosmatch', '$Manglik',
  '$Height', '$Weight', '$BloodGroup', '$Bodytype', '$spe_cases', '$Complexion', '$Diet', 
    '$Smoke', '$Drink', '$Address', '$City', '$Dist', '$State', '$Country', '$Pincode', 
  '$Phone', '$Mobile', '$Residencystatus', '$Fathername', '$Mothersname', '$Fatherlivingstatus',
   '$Motherlivingstatus', '$Fathersoccupation', '$Mothersoccupation', '$Profile', '$Profile_new',
    '$profile_approve', '$par_profile', '$Looking', '$FamilyDetails', '$FamilyDetails_new',
	 '$FamilyDetails_approve', '$Familyvalues', '$FamilyType', '$FamilyStatus', '$FamilyOrigin',
	  '$noofbrothers', '$noofsisters', '$nbm', '$nsm', '$PE_FromAge', '$PE_ToAge', 
	  '$PE_HaveChildren', '$PE_from_Height', '$PE_to_Height', '$PE_Complexion',
	   '$PE_MotherTongue', '$PartnerExpectations', '$PartnerExpectations_new', '$PartnerExpectations_approve',
	    '$PE_Religion', '$PE_Caste','$PE_Education', '$PE_Countrylivingin', '$PE_Residentstatus',
		 '$Hobbies', '$OtherHobbies', '$Interests', '$OtherInterests', '$Status', '$memtype', 
		 '$Regdate', '$IP', '$Ref', '$Agent', '$DeleteAction', '$MemshipExpiryDate', '$expdays', 
		 '$Horoscheck', '$HorosApprove', '$horoscope_visibility', '$PhotoProtect',
		  '$PhotoprotectPassword', '$Video', '$Videocheck', '$Noofcontacts', '$photocheck', 
		'$photochecklist', '$videochecklist', '$Horoschecklist', '$DOBday', '$DOBmonth', '$DOByear',
		 '$Orderstatus', '$Photo1', '$Photo1Approve', '$Photo2', '$Photo2Approve', '$Photo3', 
		 '$Photo3Approve', '$Logincount', '$Lastlogin', '$Thislogin', '$dumprofile','$pagecount',
		  '$noyusisters', '$noyubrothers', '$crop', '$PE_Height2', '$horos_status', '$g1', '$g2',
	 '$g3','$g4', '$g5', '$g6', '$g7', '$g8', '$g9', '$g10', '$g11', '$g12', '$a1', '$a2', 
	 '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9', '$a10', '$a11', '$a12', '$thosam',
	  '$horosother', '$dummy', '$dasatype', '$dasayear', '$dasamonth', '$dasadate', 
	  '$featured', '$certificate1', '$aboutcertificate1', '$certificate2', '$aboutcertificate2',
	  '$certificate3', '$aboutcertificate3', '$workin', '$mrandom', '$verifymobile', '$middlename',
	   '$lastname', '$fathermiddle', '$fatherLast', '$mothermiddle', '$motherlast', '$charan',
	   '$Gan', '$nadi', '$reference', '$franch_pay', '$Handicapt_status', '$Handicapt_reson', 
	   '$occu_details', '$branch_state', '$branch_name', '$theme', '$otp', '$online_status',
	    '$sun', '$moon', '$mars', '$mercury', '$jupiter', '$venus', '$saturn', '$rahu',
		 '$ketu', '$gulikan', '$lagna', '$place', '$last_seen_date', '$last_seen_min',
		  '$last_seen_am', '$last_seen_hour', '$visibility', '$follow', '$Biodata',
		   '$Biodata_approve','$village','$shani','$Logintype',NOW())");


}


mysqli_query($con,"delete from register where MatriID='$id' ");
//echo"reg";
// delete from activity
mysqli_query($con,"delete from activity where matri_id='$id' ");

// delete from birthday
mysqli_query($con,"delete from birthday where matriid='$id' OR wisher_id='$id'");

// delete from block_member
mysqli_query($con,"delete from block_member where matriid='$id' OR profile_id='$id'");

// delete from delete_request
mysqli_query($con,"delete from delete_request where matriid='$id' ");

// delete from expressinterest
mysqli_query($con,"delete from expressinterest where eisender='$id' OR eireceiver 	='$id'");

// delete from followers
mysqli_query($con,"delete from followers where profile_id='$id' OR follower_id 	='$id'");

// delete from my_matches
mysqli_query($con,"delete from my_matches where myid='$id' OR partner_id 	='$id'");

// delete from notification
mysqli_query($con,"delete from notification where noti_sender='$id' OR noti_receiver 	='$id'");

// delete from photoprotectrequesters
mysqli_query($con,"delete from photoprotectrequesters where RequesterID ='$id' OR ReceiverID 	 	='$id'");

// delete from profile_views
mysqli_query($con,"delete from profile_views where who ='$id' OR whom 	 	='$id'");

// delete from receivemessage
mysqli_query($con,"delete from receivemessage where ToID ='$id' OR FromID 	 	='$id'");

// delete from shortlist_profile
mysqli_query($con,"delete from shortlist_profile where mat_id ='$id' OR profile_id 	 	='$id'");

// delete from viewedaddress
mysqli_query($con,"delete from viewedaddress where who1 ='$id' OR whom1='$id'");


mysqli_query($con,"delete from delete_request where matriid='".$_GET['matriid']."'");

mysqli_query($con,"delete from gallary where matri_id='".$_GET['matriid']."'");

header("location:index?msg=success");
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/maint-maintance.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:55:51 GMT -->
<head>
    <title>Profile Delete</title>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">?>
    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">

</head>
<!-- [ offline-ui ] start -->
<div class="auth-wrapper maintance">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <img src="assets/images/maintance/delete-account.png" alt="" class="img-fluid">
                    <h5 class="text-muted my-4">Member Deleted Successfully</h5>
                    <form action="index">
                        <button class="btn  btn-primary mb-4">ok</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ offline-ui ] end -->
<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<div class="pct-customizer">
    <div class="pct-c-btn">
        <button class="btn btn-light-danger" id="pct-toggler">
            <i data-feather="settings"></i>
        </button>
        <button class="btn btn-light-primary" data-bs-toggle="tooltip" title="Document" data-placement="left">
            <i data-feather="book"></i>
        </button>
        <button class="btn btn-light-success" data-bs-toggle="tooltip" title="Buy Now" data-placement="left">
            <i data-feather="shopping-bag"></i>
        </button>
        <button class="btn btn-light-info" data-bs-toggle="tooltip" title="Support" data-placement="left">
            <i data-feather="headphones"></i>
        </button>
    </div>
    <div class="pct-c-content ">
        <div class="pct-header bg-primary">
            <h5 class="mb-0 text-white f-w-500">DashboardKit Customizer</h5>
        </div>
        <div class="pct-body">
            <h6 class="mt-2"><i data-feather="credit-card" class="me-2"></i>Header settings</h6>
            <hr class="my-2">
            <div class="theme-color header-color">
                <a href="#!" class="" data-value="bg-default"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-primary"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
            </div>
            <h6 class="mt-4"><i data-feather="layout" class="me-2"></i>Sidebar settings</h6>
            <hr class="my-2">
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="cust-sidebar">
                <label class="form-check-label f-w-600 pl-1" for="cust-sidebar">Light Sidebar</label>
            </div>
            <div class="form-check form-switch mt-2">
                <input type="checkbox" class="form-check-input" id="cust-sidebrand">
                <label class="form-check-label f-w-600 pl-1" for="cust-sidebrand">Color Brand</label>
            </div>
            <div class="theme-color brand-color d-none">
                <a href="#!" class="active" data-value="bg-primary"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
            </div>
            <h6 class="mt-4"><i data-feather="sun" class="me-2"></i>Layout settings</h6>
            <hr class="my-2">
            <div class="form-check form-switch mt-2">
                <input type="checkbox" class="form-check-input" id="cust-darklayout">
                <label class="form-check-label f-w-600 pl-1" for="cust-darklayout">Dark Layout</label>
            </div>
        </div>
    </div>
</div>

<script>
    $('#pct-toggler').on('click', function() {
        $('.pct-customizer').toggleClass('active');
    });
    $('#cust-sidebrand').change(function() {
        if ($(this).is(":checked")) {
            $('.theme-color.brand-color').removeClass('d-none');
            $('.m-header').addClass('bg-dark');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
            $('.theme-color.brand-color').addClass('d-none');
        }
    });
    $('.brand-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        if (temp == "bg-default") {
            $('.m-header').removeClassPrefix('bg-');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', 'http://localhost/SVR/css3/assets/shivraj-logo.png');
            $('.m-header').addClass(temp);
        }
    });
    $('.header-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        if (temp == "bg-default") {
            $('.pc-header').removeClassPrefix('bg-');
        } else {
            $('.pc-header').removeClassPrefix('bg-');
            $('.pc-header').addClass(temp);
        }
    });
    $('#cust-sidebar').change(function() {
        if ($(this).is(":checked")) {
            $('.pc-sidebar').addClass('light-sidebar');
            $('.pc-horizontal .topbar').addClass('light-sidebar');
        } else {
            $('.pc-sidebar').removeClass('light-sidebar');
            $('.pc-horizontal .topbar').removeClass('light-sidebar');
        }
    });
    $('#cust-darklayout').change(function() {
        if ($(this).is(":checked")) {
            $("#main-style-link").attr("href", "assets/css/style-dark.css");
        } else {
            $("#main-style-link").attr("href", "assets/css/style.css");
        }
    });
    $.fn.removeClassPrefix = function(prefix) {
        this.each(function(i, it) {
            var classes = it.className.split(" ").map(function(item) {
                return item.indexOf(prefix) === 0 ? "" : item;
            });
            it.className = classes.join(" ");
        });
        return this;
    };
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-Q8H86P6FK7');
</script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>

</body>

<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/maint-maintance.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:55:52 GMT -->
</html>
