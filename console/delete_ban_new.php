<?php require_once('../sys_dbconnection.php');   
require_once(dirname(__FILE__).'/protect.php');
/*include'../dbconnectadmin.php';*/
$id = $_POST['rowid'];
$table="register";
$table1="deleted_profile";
$result = $con->query("SELECT * FROM register where MatriID='$id'");
while($row = $result->fetch_array())
{
//$id=$row['ID'];
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



//$sql=$con->query("insert into deleted_ban(`MatriID`)values('$MatriID')");



$sql=$con->query("insert into deleted_ban(`MatriID`, `Prefix`, `Termsofservice`, `ConfirmEmail`, `ConfirmPassword`, `Profilecreatedby`, `Referenceby`, `Name`, `Gender`, `DOB`, `Age`, `TOB`, `POB`, `Maritalstatus`, `childrenlivingstatus`, `Education`, `EducationDetails`, `Occupation`, `Employedin`, `Annualincome`, `Religion`, `Caste`, `Subcaste`, `Gothram`, `Language`, `Star`, `Moonsign`, `Horosmatch`, `Manglik`, `Height`, `Weight`, `BloodGroup`, `Bodytype`, `spe_cases`, `Complexion`, `Diet`, `Smoke`, `Drink`, `Address`, `City`, `Dist`, `State`, `Country`, `Pincode`, `Phone`, `Mobile`, `Residencystatus`, `Fathername`, `Mothersname`, `Fatherlivingstatus`, `Motherlivingstatus`, `Fathersoccupation`, `Mothersoccupation`, `Profile`, `Profile_new`, `profile_approve`, `par_profile`, `Looking`, `FamilyDetails`, `FamilyDetails_new`, `FamilyDetails_approve`, `Familyvalues`, `FamilyType`, `FamilyStatus`, `FamilyOrigin`, `noofbrothers`, `noofsisters`, `nbm`, `nsm`, `PE_FromAge`, `PE_ToAge`, `PE_HaveChildren`, 
`PE_from_Height`, `PE_to_Height`, `PE_Complexion`, `PE_MotherTongue`, `PartnerExpectations`, `PartnerExpectations_new`, `PartnerExpectations_approve`, `PE_Religion`, `PE_Caste`, `PE_Education`, `PE_Countrylivingin`, `PE_Residentstatus`, `Hobbies`, `OtherHobbies`, `Interests`, `OtherInterests`, `Status`, `memtype`, `Regdate`, `IP`, `Ref`, `Agent`, `DeleteAction`, `MemshipExpiryDate`, `expdays`, `Horoscheck`, `HorosApprove`, `horoscope_visibility`, `PhotoProtect`, `PhotoprotectPassword`, `Video`, `Videocheck`, `Noofcontacts`, `photocheck`, `photochecklist`, `videochecklist`, `Horoschecklist`, `DOBday`, `DOBmonth`, `DOByear`, `Orderstatus`, `Photo1`, `Photo1Approve`, `Photo2`, `Photo2Approve`, `Photo3`, `Photo3Approve`, `Logincount`, `Lastlogin`, `Thislogin`, `dumprofile`, `pagecount`, `noyusisters`, `noyubrothers`, `crop`, `PE_Height2`, `horos_status`, `g1`, `g2`, `g3`, `g4`, `g5`, `g6`, `g7`, `g8`, `g9`, `g10`, `g11`, `g12`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `thosam`, `horosother`, `dummy`, `dasatype`, `dasayear`, `dasamonth`, `dasadate`, `featured`, `certificate1`, `aboutcertificate1`, `certificate2`, `aboutcertificate2`, `certificate3`, `aboutcertificate3`, `workin`, `mrandom`, `verifymobile`, `middlename`, `lastname`, `fathermiddle`, `fatherLast`, `mothermiddle`, `motherlast`, `charan`, `Gan`, `nadi`, `reference`, `franch_pay`, `Handicapt_status`, `Handicapt_reson`, `occu_details`, `branch_state`, `branch_name`, `theme`, `otp`, `online_status`, `sun`, `moon`, `mars`, `mercury`, `jupiter`, `venus`, `saturn`, `rahu`, `ketu`, `gulikan`, `lagna`, `place`, `last_seen_date`, `last_seen_min`, `last_seen_am`, `last_seen_hour`, `visibility`, `follow`, `Biodata`, `Biodata_approve`,`village`,`shani`,`Logintype`)
values('$MatriID', '$Prefix', '$Termsofservice', '$ConfirmEmail', '$ConfirmPassword', '$Profilecreatedby', '$Referenceby', '$Name', 
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
		   '$Biodata_approve','$village','$shani','$Logintype')");
}
//$result=mysqli_query($con,"SELECT * FROM register where MatriID='$id'");
/*$num_fields = mysqli_num_fields($result);
$return="";
//$arr=implode(" ",$result);

//$sql=$con->query("insert into deleted_profile(MatriID,ConfirmEmail,ConfirmPassword,");
//$query="insert into register(Name,Profilecreatedby,Maritalstatus,Gender,DOB,ConfirmEmail,ConfirmPassword,Mobile,MatriID,Photo1,Status,otp,village,Religion,ban) values('$name','$createdfor','$status' ,'$gender','$dob','$email','$pwd','$mobile','$mid','$pic','Active','yes','$village','$relision','No')"; 


for ($i = 0; $i < $num_fields; $i++) 
{
	while($row = mysqli_fetch_row($result))
	{
   			$return.= 'INSERT INTO '.$table1.' VALUES(';
				 for($j=0; $j<$num_fields; $j++)
				 {
				   $row[$j] = addslashes($row[$j]);
				   $row[$j] = str_replace("\n","\\n",$row[$j]);
				   if (isset($row[$j]))
				    { 
				   $return.= '"'.$row[$j].'"' ; 
				   	} 
				   else
				    { 
					$return.= '""';
				    }
				   if ($j<($num_fields-1)) 
				   { 
				   $return.= ',';
				   }
				}
   $return.= ");\n";
   //ini_set('max_execution_time',60);
   
  }
}
$return.="\n\n";
$con->query($return) or die(mysqli_error());*/
// delete from register

$con->query("delete from register where MatriID='$id' ");

// delete from activity
$con->query("delete from activity where matri_id='$id' ");

// delete from birthday
$con->query("delete from birthday where matriid='$id' OR wisher_id='$id'");

// delete from block_member
$con->query("delete from block_member where matriid='$id' OR profile_id='$id'");

// delete from delete_request
$con->query("delete from delete_request where matriid='$id' ");

// delete from expressinterest
$con->query("delete from expressinterest where eisender='$id' OR eireceiver='$id'");

// delete from followers
$con->query("delete from followers where profile_id='$id' OR follower_id ='$id'");

// delete from my_matches
$con->query("delete from my_matches where myid='$id' OR partner_id ='$id'");

// delete from notification
$con->query("delete from notification where noti_sender='$id' OR noti_receiver ='$id'");

// delete from photoprotectrequesters
$con->query("delete from photoprotectrequesters where RequesterID ='$id' OR ReceiverID='$id'");

// delete from profile_views
$con->query("delete from profile_views where who ='$id' OR whom='$id'");

// delete from receivemessage
$con->query("delete from receivemessage where ToID ='$id' OR FromID='$id'");

// delete from shortlist_profile
$con->query("delete from shortlist_profile where mat_id ='$id' OR profile_id 	 	='$id'");

// delete from viewedaddress
$con->query("delete from viewedaddress where who1 ='$id' OR whom1 	 	 	='$id'");



 ?>
 <style>
 .btcs
 {
	     margin-left: 165px;
 }
 </style>
 <div class="modal-header">
                <h5 class="modal-title">Delete Ban New</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="ban_report_view" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
						           <h2 class="text-green" align="center">Member Deleted Successfully</h2>
                                <!--<label class="form-label" for="Name">Enter Country</label>-->	
                            </div>
					   </div>
                       
                        <div class="col-sm-12">
                            <button class="btn btn-primary btcs" type="submit" name="submit">OK</button>
                            <!--<button class="btn btn-danger">Clear</button>-->
                        </div>
                    </div>
                </form>
            </div>
    
            <div class="modal-body modalb">     
                <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                    <div class="swal2-header">
                        <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                            <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                            <div class="swal2-success-ring"></div> 
	                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                        </div>
	                    <h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo $msg; ?></h2>
	                </div>
	                <div class="swal2-actions">
	                   <a href="ban_report_view" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                    </div>
                </div> 
            </div>
        