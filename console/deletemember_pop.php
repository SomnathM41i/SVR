<?php require_once('../sys_dbconnection.php');   
/*include'../dbconnectadmin.php';*/

$id=explode(",",$_GET['id']);
$val= implode("','",$id);
$result =mysqli_query($con,"SELECT * FROM register where MatriID IN('".$val."')");
 
//echo "SELECT * FROM register where MatriID IN('".$val."')";
$numbers = '1,2,3';

$array=explode(",",$_GET['id']);

foreach ($array as $ids) {
   $result =mysqli_query($con,"SELECT * FROM register where MatriID='$ids'");
  // echo "SELECT * FROM register where MatriID='$ids'";




//$result =mysqli_query($con,"SELECT * FROM register where MatriID='$id'");
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

//echo $sql;
mysqli_query($con,"delete from register where MatriID='$ids' ");
//echo "delete from register where MatriID='$ids'";
//echo"reg";
// delete from activity
mysqli_query($con,"delete from activity where matri_id='$ids' ");

// delete from birthday
mysqli_query($con,"delete from birthday where matriid='$ids' OR wisher_id='$ids'");

// delete from block_member
mysqli_query($con,"delete from block_member where matriid='$ids' OR profile_id='$ids'");

// delete from delete_request
mysqli_query($con,"delete from delete_request where matriid='$ids' ");

// delete from expressinterest
mysqli_query($con,"delete from expressinterest where eisender='$ids' OR eireceiver 	='$ids'");

// delete from followers
mysqli_query($con,"delete from followers where profile_id='$ids' OR follower_id ='$ids'");

// delete from my_matches
mysqli_query($con,"delete from my_matches where myid='$ids' OR partner_id 	='$ids'");

// delete from notification
mysqli_query($con,"delete from notification where noti_sender='$ids' OR noti_receiver 	='$ids'");

// delete from photoprotectrequesters
mysqli_query($con,"delete from photoprotectrequesters where RequesterID ='$ids' OR ReceiverID ='$ids'");

// delete from profile_views
mysqli_query($con,"delete from profile_views where who ='$ids' OR whom ='$ids'");

// delete from receivemessage
mysqli_query($con,"delete from receivemessage where ToID ='$ids' OR FromID	='$ids'");

// delete from shortlist_profile
mysqli_query($con,"delete from shortlist_profile where mat_id ='$ids' OR profile_id ='$ids'");

// delete from viewedaddress
mysqli_query($con,"delete from viewedaddress where who1 ='$ids' OR whom1 ='$ids'");


mysqli_query($con,"delete from delete_request where matriid='".$_GET['matriid']."'");
}
header('location:delete_profile_requests?msg=delete');

?>

 
 