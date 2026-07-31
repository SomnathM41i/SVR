<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
require_once('../includes/annual_income.php');
include('siteconfig.php');
 $id=$_GET['ID'];
 //echo  $id;
$profile=mysqli_query($con,"select * from register where MatriID='$id'");
$fetch=mysqli_fetch_array($profile);
$photo_approve = mysqli_fetch_array(mysqli_query($con,"select a.PhotoProtect,b.photo_approve from register a,gallary b where b.matri_id='".$id."' AND a.Photo1=b.photo_name;"));?>
<!doctype html>
<html>
<head>
<!--<link href="stylesheets/style-print.css" rel="stylesheet" type="text/css">-->
<style type="text/css" media="print">
@page {
	size: auto;   /* auto is the initial value */
	margin: 2mm;  /* this affects the margin in the printer settings */
	margin-left: 15mm;
}
</style>
<style>
.maincontent {
	margin-right: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	color: #36F;
	background-color: #D2F0FF;
}
.maincontent1 {
	margin-right: 10px;
	font-family: Verdana;
	font-size: 16px;
	color: #033;
}
</style>
<style>
@media print {
  #printPageButton {
    display: none;
  }
}
</style>
</style>
</style>
</style>
<script type="text/javascript">
function print_report()
{
var divElements = document.getElementById('print').innerHTML;
var oldPage = document.body.innerHTML;

document.body.innerHTML ="<html><head><title>Report</title> </head><body>"+divElements+"</body></html>" ;

window.print();

document.body.innerHTML = oldPage;
}
</script>
<meta charset="utf-8">
<title>Profile Print :<?php echo $fetch['MatriID'] ?></title>
</head>

<body bgcolor="#FFFFFF" onload="Export()">
<div id="print">
    <h1><a href="profile_view?ID=<?php echo $id; ?>">Back</a></h1>
  <table width="1000" height="398" border="0" class="maincontent1" cellpadding="3"  bgcolor="#FFFFFF" cellspacing="1" id="tblCustomers">
    <tr>
      <td colspan="5"><table width="991" height="44" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top"><table width="991" height="309" border="0" align="left">
              <tr>
                <td colspan="6" align="center"><img src="http://localhost/SVR/css3/assets/shivraj-logo.png" alt=""/><br>
                  <span style="font-size:14px; color:#000 "><strong>Address:</strong> <?php echo $config['address'] ?> <br>
                  <strong>Contact: </strong>+91-<?php echo $config['contactusmobile1']?>, +91-<?php echo $config['smsmobile'] ?></span><br>
                  <strong> Web: </strong>www.<?php echo $config['Webname'] ?> | <strong> Email: </strong><?php echo $config['ContactEmail'] ?></span></td>
              </tr>
              <tr>
                <td colspan="4" class="maincontent"><strong>BASIC INFORMATION</strong>
				<?php /*
				<?php if($fetch['memtype']=="Renew Member")
                { ?><?php $sqlpaid=mysqli_query($con,"select * from paiddetails where Pmatriid='".$fetch['MatriID']."' order by Paidid desc limit 1");
                $sqlfetch=mysqli_fetch_array($sqlpaid);
                ?>&nbsp; Registration Date:
				<?php $gtactivedate=explode("-",$sqlfetch['Pactivedate']); echo $gtactivedate[2]."-".$gtactivedate[1]."-".$gtactivedate[0]?><?php }else{?>&nbsp; Registration Date:<?php $gt=explode("-",$fetch['Regdate']); echo $gt[2]."-".$gt[1]."-".$gt[0]; }?>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
				<?php if($fetch['MemshipExpiryDate']!=""){ ?>
				Expiry Date:<?php $gt=explode("-",$fetch['MemshipExpiryDate']); echo $gt[2]."-".$gt[1]."-".$gt[0]?> <?php } ?> */?></td>
                <td width="206" colspan="2" rowspan="9" align="center" valign="top">
				  <?php if($fetch['Photo1']=="no-photo.gif") { ?>
                  <img src="../gallary/no-photo.gif" width="200" height="250"  alt=""/>
                  <?php } else {?>
                  <img src="../gallary/<?php echo $fetch['Photo1'] ?>" width="200" height="250"  alt=""/>
                  <?php } ?></td>
              </tr>
                <tr bgcolor="#DFDFDF">
                <td width="171">ID:</td>
                <td width="209"><span ><?php echo $fetch['MatriID'] ?></span></td>
                <td valign="top">Registration Date: </td><td><u><strong><?php $gt=explode("-",$fetch['Regdate']); echo $gt[2]."-".$gt[1]."-".$gt[0];?></strong></u></td>
                </tr>
                <tr>
                 <?php /* 
				 <td>Marital Status: </td>
                <td><?php echo $fetch['Maritalstatus'] ?>
				  </td>
				  
               <td width="201"><?php if($fetch['Maritalstatus']!='Unmarried') {  ?>Children's Living Status: <?php }?></td>
                <td width="178"><?php if($fetch['Maritalstatus']!='Unmarried') {  ?><?php echo $fetch['childrenlivingstatus'] ?><?php }?></td>
				
  function age($birthday){
 list($day, $month, $year) = explode("-", $birthday);
 $year_diff  = date("Y") - $year;
 $month_diff = date("m") - $month;
 $day_diff   = date("d") - $day;
 if ($day_diff < 0 && $month_diff==0) $year_diff--;
 if ($day_diff < 0 && $month_diff < 0) $year_diff--;
 return $year_diff;
} */
?>
                 <td valign="top">Name:</td>
				 <td valign="top"><?php echo $fetch['Name']; ?> </td>
                
                    <?php // $dob=$date[2]."-".$date[1]."-".$date[0] ?>
               <!-- <td colspan="2">Age:<?php //echo age($dob);?></td> -->
			    <td valign="top">Expiry Date: <u><strong></td>
				<td valign="top"><?php if($fetch['MemshipExpiryDate']!=""){
					$gt=explode("-",$fetch['MemshipExpiryDate']); echo $gt[2]."-".$gt[1]."-".$gt[0];?>
				<?php } else { echo"no membership";}?></strong></u></td>

                </tr>
                  <tr bgcolor="#DFDFDF">
	            <td valign="top">Date of Birth:</td>
                <td valign="top"><?php $date=explode("-",$fetch['DOB']);
					echo $date[2]."-".$date[1]."-".$date[0] ?></td>
					 <?php
                        	$que = mysqli_query($con, "SELECT * FROM compatibility WHERE MatriID='$id'");
                        	if( $que )
                        	{
                        ?>
                <td valign="top">Compatibility Update</td>
                 <td valign="top"> Yes</td>
							<?php } else { ?>
 <td valign="top">Compatibility Update</td>
                 <td valign="top"> No</td>
							<?php } ?>
				
             </tr>
              <tr>
                <td valign="top">Email: </td>
                <td valign="top"><?php echo $fetch['ConfirmEmail'] ?></td>
                 <td valign="top">ID Proof</td>
                 <td valign="top">
				 <?php 
                        	if( $fetch['idproof_approve'] == "" )
                        	{
                        		echo "No";
                        	}
                        	else
                        	{
                        		echo "Yes";
                        	}
                        	

                        ?>
                        
				 </td>
              </tr>
              <tr bgcolor="#DFDFDF">

                <td valign="top">Religion:</td>
                <td valign="top"><?php echo $fetch['Religion'] ?></td>
               <td valign="top">Document Proof</td>
                 <td valign="top">
				 <?php 
                        	if( $fetch['docapprove'] == "" )
                        	{
                        		echo "No";
                        	}
                        	else
                        	{
                        		echo "Yes";
                        	}
                        	

                        ?>
                        
				 </td>
              </tr>
              <tr>
                <td valign="top">Caste: </td>
                <td valign="top"><?php echo $fetch['Caste'] ?>
				<?php if($fetch['Subcaste']!=""){?>
                - <?php echo $fetch['Subcaste'] ?><?php } ?></td>
				 <td valign="top">Height:</td>
                 <td valign="top"> <?php                                       
										   $strheight = $fetch['Height'];
										   if($strheight =="1") { echo "4Ft "; }
										   else if($strheight =="") { echo "Null"; }
										   else if($strheight =="2") { echo "4Ft 1 inch "; }
										   else if($strheight =="3") { echo "4Ft 2 inch "; }
										   else if($strheight =="4") { echo "4Ft 3 inch "; }
										   else if($strheight =="5") { echo "4Ft 4 inch "; }
										   else if($strheight =="6") { echo "4Ft 5 inch "; }
										   else if($strheight =="7") { echo "4Ft 6 inch "; }
										   else if($strheight =="8") { echo "4Ft 7 inch "; }
										   else if($strheight =="9") { echo "4Ft 8 inch "; }
										   else if($strheight =="10") { echo "4Ft 9 inch ";}
										   else if($strheight =="11") { echo "4Ft 10 inch ";}
										   else if($strheight =="12") { echo "4Ft 11 inch ";}
										   else if($strheight =="13") { echo "5Ft "; }
										   else if($strheight =="14") { echo "5Ft 1 inch "; }
										   else if($strheight =="15") { echo "5Ft 2 inch "; }
										   else if($strheight =="16") { echo "5Ft 3 inch "; }
										   else if($strheight =="17") { echo "5Ft 4 inch "; }
										   else if($strheight =="18") { echo "5Ft 5 inch "; }
										   else if($strheight =="19") { echo "5Ft 6 inch "; }
										   else if($strheight =="20") { echo "5Ft 7 inch "; }
										   else if($strheight =="21") { echo "5Ft 8 inch "; }
										   else if($strheight =="22") { echo "5Ft 9 inch "; }
										   else if($strheight =="23") { echo "5Ft 10 inch "; }
										   else if($strheight =="24") { echo "5Ft 11 inch "; }
										   else if($strheight =="25") { echo "6Ft "; }
										   else if($strheight =="26") { echo "6Ft 1 inch "; }
										   else if($strheight =="27") { echo "6Ft 2 inch "; }
										   else if($strheight =="28") { echo "6Ft 3 inch "; }
										   else if($strheight =="29") { echo "6Ft 4 inch "; }
										   else if($strheight =="30") { echo "6Ft 5 inch "; }
										   else if($strheight =="31") { echo "6Ft 6 inch "; }
										   else if($strheight =="32") { echo "6Ft 7 inch "; }
										   else if($strheight =="33") { echo "6Ft 8 inch "; }
										   else if($strheight =="34") { echo "6Ft 9 inch "; }
										   else if($strheight =="35") { echo "6Ft 10 inch "; }
										   else if($strheight =="36") { echo "6Ft 11 inch "; }
										   else if($strheight =="37") { echo "7Ft "; } ?>
					 </td
              
                </tr>
               <tr bgcolor="#DFDFDF">
                 <td valign="top">Residency Status</td>
                 <td valign="top"><?php echo $fetch['Residencystatus'] ?></td>
				<td valign="top">Email Verified</td>
                 <td valign="top">
				 <?php 
				   $email1=mysqli_query($con,"SELECT * FROM emailverify where MatriID='$id'");
				   $email12= mysqli_fetch_array($email1);
                   echo $email12['verification']; ?>
                        
				 </td>
               </tr>
			   
			   <tr>
			  <td valign="top">Time To Call</td>
                 <td valign="top"> <?php echo $fetch['calling_time'] ;?></td>
				 <?php
                        	if($fetch['verifymobile']){
                        ?>
                 <td valign="top">Mobile Verified</td>
                 <td valign="top"> Yes</td>
							<?php } else { ?>
                 <td valign="top">Mobile Verified</td>
                 <td valign="top"> No</td>
							<?php } ?>
				</tr>
	
              <tr bgcolor="#DFDFDF">
			   <td >Marital Status: </td>
                <td><?php echo $fetch['Maritalstatus'] ?>
				  </td>
				  
               <td valign="top"><?php if($fetch['Maritalstatus']!='Unmarried') {  ?>Children's Living Status: <?php }?></td>
                <td valign="top"><?php if($fetch['Maritalstatus']!='Unmarried') {  ?><?php echo $fetch['childrenlivingstatus'] ?><?php }?></td>
			  </tr>
			  <!--<tr >

                <td colspan="2" valign="top"><strong>Permanent Address:</strong> <?php echo $fetch['Address'] ?><br>
                  <strong>City:</strong> <?php echo $fetch['City'] ?>, <strong>Taluka:</strong> <?php echo $fetch['Taluka'] ?? '' ?>, <strong>District:</strong> <?php echo $fetch['Dist']."-".$fetch['Pincode'] ?> <br> <strong>State:</strong> <?php echo $fetch['State'] ?> ,<strong>Country:</strong> <?php echo $fetch['Country'] ?></td>
                <td colspan="2" valign="top"><strong>Temporary Address:</strong> <?php echo $fetch['temp_address'] ?><br>
                  <strong>City:</strong> <?php echo $fetch['temp_city'] ?>, <strong>District:</strong> <?php echo $fetch['temp_dist']."-".$fetch['temp_pincode'] ?> <br> <strong>State:</strong> <?php echo $fetch['temp_state'] ?> ,<strong>Country:</strong> <?php echo $fetch['temp_country'] ?></td>
                </tr>
               <tr bgcolor="#DFDFDF">
                 <td valign="top">House you Stay in:</td>
                 <td valign="top"><?php echo $fetch['housestayedin'] ?></td>
                 <td valign="top">House you Stay in:</td>
                 <td valign="top"><?php echo $fetch['temp_housestayed'] ?></td>
                 <td colspan="2" align="center" valign="top">&nbsp;</td>
               </tr>
               <tr >
                 <td valign="top">Type of House:</td>
                 <td valign="top"><?php echo $fetch['typeofhouse'] ?></td>
                 <td valign="top">Type of House:</td>
                 <td valign="top"><?php echo $fetch['temp_typehouse'] ?></td>
                 <td colspan="2" align="center" valign="top">&nbsp;</td>
               </tr>
               <tr bgcolor="#DFDFDF">
                 <td valign="top">Phone Nos.</td>
                 <td valign="top"><?php echo $fetch['Phone'] ?></td>
                 <td valign="top">Phone Nos.</td>
                 <td valign="top"><?php echo $fetch['temp_phonno'] ?></td>
                 <td colspan="2" align="center" valign="top">&nbsp;</td>
               </tr> -->
            </table></td>
          </tr>
        </table></td>
    </tr>
  
    <tr>
      <td colspan="2" class="maincontent"><strong>HOROSCOPE INFORMATION</strong></td>
      <td width="1">&nbsp;</td>
      <td colspan="2" class="maincontent"><strong>EDUCATIONAL / PROFESSIONAL</strong></td>
    </tr>
    <tr bgcolor="#DFDFDF">
      <td width="190">Moonsign</td>
      <td width="252"><?php echo $fetch['Moonsign'] ?></td>
      <td>&nbsp;</td>
      <td width="225">Education</td>
      <td width="293"><?php echo $fetch['Education'].", ".$fetch['education_sub'] ?></td>
    </tr>
    <tr>
      <td>Star</td>
      <td><?php echo $fetch['Star'] ?></td>
      <td>&nbsp;</td>
      <td>Occupation</td>
      <td><?php echo $fetch['Occupation'] ?></td>
    </tr>
    <tr bgcolor="#DFDFDF">
      <td>Horoscope Match</td>
      <td><?php echo $fetch['Horosmatch'] ?></td>
      <td>&nbsp;</td>
      <td>Eduction Details</td>
      <td><?php echo $fetch['EducationDetails'] ?></td>
    </tr>
    <tr>
      <td>Manglik</td>
      <td><?php echo $fetch['Manglik'] ?></td>
      <td>&nbsp;</td>
      <td>Occupation Details</td>
      <td><?php echo $fetch['occu_details'] ?></td>
    </tr>
	 <tr bgcolor="#DFDFDF">
      <td >Shani</td>
      <td><?php echo $fetch['shani'] ?></td>
                <td>&nbsp;</td>

      <td>Employed In</td>
      <td><?php echo $fetch['Employedin'] ?></td>
    </tr>
    <tr >
      <td>Time of Birth</td>
      <td><?php echo $fetch['TOB'] ?></td>
      <td>&nbsp;</td>
      <td>Annual Income</td>
      <td><?php echo htmlspecialchars(annual_income_format($fetch['Annualincome'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
    </tr>
	 <tr bgcolor="#DFDFDF">
      <td>Gotra</td>
      <td><?php echo $fetch['Gothram'] ?></td>
      <td>&nbsp;</td>
      <td>Working Hours</td>
      <td><?php echo $fetch['working_hours'] ?></td>
    </tr>
    <tr>
      <td>Place of Birth</td>
      <td>City: <?php echo $fetch['POB'] ?></td>
      <td>&nbsp;</td>

      <td>Working Location/City</td>
      <td><?php echo $fetch['workinglocation'];?></td>
    </tr>
	<tr bgcolor="#DFDFDF">
      <td>Place of Country</td>
      <td><?php echo $fetch['POC'] ?></td>
      <td>&nbsp;</td>

      <td>Special Cases</td>
      <td><?php echo $fetch['spe_cases'] ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
		<?php
            if($fetch['spe_cases']!='None')
        { ?>
      <td>Special Reason</td>
      <td><?php echo $fetch['spe_reason'];?></td>
		<?php } ?>
    </tr>
    <tr bgcolor="#DFDFDF">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
		
      <td>Complexion</td>
      <td><?php echo $fetch['Complexion'];?></td>
		
    </tr>
    
    <!--<tr>
      <td colspan="5" class="maincontent"><strong>PHYSICAL INFORMATION</strong></td>
    </tr>
       <tr bgcolor="#DFDFDF">
      <td>Height</td>
      <td><?php  
				   $strheight = $fetch['Height'];
if($strheight =="1") { echo "4Ft "; }
else if($strheight =="2") { echo "4Ft 1 inch "; }
else if($strheight =="3") { echo "4Ft 2 inch "; }
else if($strheight =="4") { echo "4Ft 3 inch "; }
else if($strheight =="5") { echo "4Ft 4 inch "; }
else if($strheight =="6") { echo "4Ft 5 inch "; }
else if($strheight =="7") { echo "4Ft 6 inch "; }
else if($strheight =="8") { echo "4Ft 7 inch "; }
else if($strheight =="9") { echo "4Ft 8 inch "; }
else if($strheight =="10") { echo "4Ft 9 inch "; }
else if($strheight =="11") { echo "4Ft 10 inch "; }
else if($strheight =="12") { echo "4Ft 11 inch "; }
else if($strheight =="13") { echo "5Ft "; }
else if($strheight =="14") { echo "5Ft 1 inch "; }
else if($strheight =="15") { echo "5Ft 2 inch "; }
else if($strheight =="16") { echo "5Ft 3 inch "; }
else if($strheight =="17") { echo "5Ft 4 inch "; }
else if($strheight =="18") { echo "5Ft 5 inch "; }
else if($strheight =="19") { echo "5Ft 6 inch "; }
else if($strheight =="20") { echo "5Ft 7 inch "; }
else if($strheight =="21") { echo "5Ft 8 inch "; }
else if($strheight =="22") { echo "5Ft 9 inch "; }
else if($strheight =="23") { echo "5Ft 10 inch "; }
else if($strheight =="24") { echo "5Ft 11 inch "; }
else if($strheight =="25") { echo "6Ft "; }
else if($strheight =="26") { echo "6Ft 1 inch "; }
else if($strheight =="27") { echo "6Ft 2 inch "; }
else if($strheight =="28") { echo "6Ft 3 inch "; }
else if($strheight =="29") { echo "6Ft 4 inch "; }
else if($strheight =="30") { echo "6Ft 5 inch "; }
else if($strheight =="31") { echo "6Ft 6 inch "; }
else if($strheight =="32") { echo "6Ft 7 inch "; }
else if($strheight =="33") { echo "6Ft 8 inch "; }
else if($strheight =="34") { echo "6Ft 9 inch "; }
else if($strheight =="35") { echo "6Ft 10 inch "; }
else if($strheight =="36") { echo "6Ft 11 inch "; }
else if($strheight =="37") { echo "7Ft "; }
else if($strheight =="Does not Matter") { echo "Does not Matter"; }
?></td>
      <td>&nbsp;</td>
      <td>Diet</td>
      <td><?php echo $fetch['Diet'] ?></td>
    </tr>
    <tr>
      <td>Weight</td>
      <td><?php 
	$che=explode(" ",$fetch['Weight']);
	$wihgh=$che[1];
	if(isset($wihgh)) {
		echo $fetch['Weight'];
	}
	else
	{
		echo $fetch['Weight']." kg";
	} //echo $fetch['Weight'] ?></td>
      <td>&nbsp;</td>
      <td>Special Cases</td>
      <td><?php echo $fetch['spe_cases'] ?></td>
    </tr>-->
    <tr>
      <td colspan="5" class="maincontent"><strong>FAMILY INFORMATION</strong></td>
    </tr>
	<tr bgcolor="#DFDFDF">
      <td>Family Values</td>
      <td><?php echo $fetch['Familyvalues'] ?></td>
      <td>&nbsp;</td>
      <td>Family Status</td>
      <td><?php echo $fetch['FamilyStatus'] ?></td>
    </tr>
    <tr >
      <td>No. Of Brothers</td>
      <td><?php echo $fetch['noofbrothers'] ?></td>
      <td>&nbsp;</td>
      <td>Married Brothers</td>
      <td><?php echo $fetch['nbm'] ?></td>
    </tr>
    <tr bgcolor="#DFDFDF">
      <td>No. Of Sisters</td>
      <td><?php echo $fetch['noofsisters'] ?></td>
      <td>&nbsp;</td>
      <td>Married Sisters</td>
      <td ><?php echo $fetch['nsm'] ?></td>
    </tr>
    <tr bgcolor="">
      <td>Brother Details</td>
      <td><?php echo $fetch['brotherdetails'] ?></td>
      <td>&nbsp;</td>
      <td>Sisters Details</td>
      <td ><?php echo $fetch['sistersdetails'] ?></td>
    </tr>
	 <tr bgcolor="#DFDFDF">
      <td>Mother Tounge</td>
      <td><?php echo $fetch['mother_tounge'] ?></td>
      <td>&nbsp;</td>
      <td>Family Type</td>
      <td><?php echo $fetch['FamilyType'] ?></td>
    </tr>
    <tr bgcolor="">
      <td>Father's  Name</td>
      <td><?php echo $fetch['Fathername'] ?></td>
      <td>&nbsp;</td>
      <td>Father Occupation</td>
      <td><?php echo $fetch['Fathersoccupation'] ?></td>
    </tr>
    <tr bgcolor="#DFDFDF">
      <td>Mother Name</td>
      <td><?php echo $fetch['Mothersname'] ?></td>
      <td>&nbsp;</td>
      <td >Mother Occupation</td>
      <td ><?php echo $fetch['Mothersoccupation'] ?></td>
    </tr>
    <tr bgcolor="">
      <td>Family Wealth</td>
      <td><?php echo $fetch['family_wealth'] ?></td>
      <td>&nbsp;</td>
      <td>Parents Stay</td>
	  <?php if($me['parents_stay']!="Dont wish to specify")
							{
						?>
      <td><?php echo $fetch['parents_stay'] ?></td>
							<?php } ?>
    </tr>
   <!-- <tr>
      <td>Mother's Profession</td>
      <td><?php echo $fetch['Mothersoccupation'] ?></td>
      <td>&nbsp;</td>
      <td >Mobile</td>
      <td ><?php echo $fetch['mother_mobilenumber'] ?></td>
    </tr>
     <tr bgcolor="#DFDFDF">
      <td colspan="5">Mosal Name (Maternal Name):<? echo $fetch['maternalname'] ?></td>
    </tr>-->
     <tr>
       <td colspan="5" class="maincontent"><strong>PARTNER PREFERENCE</strong></td>
     </tr>
    <tr>
      <td>Looking For</td>
      <td><?php echo $fetch['Looking'] ?></td>
      <td>&nbsp;</td>
	  <td>Religion</td>
      <td><?php echo $fetch['PE_Religion'] ?></td>
	  
    </tr>
    <tr bgcolor="#DFDFDF">
      <td>Age</td>
      <td><?php echo $fetch['PE_FromAge']." To ".$fetch['PE_ToAge']; ?></td>
	  <td>&nbsp;</td>
	  <td>Caste</td>
      <td><?php echo $fetch['PE_Caste'] ?></td>
    </tr>
    <tr>
      <td>Height</td>
      <td><?php  
				   $strheight = $fetch['PE_from_Height'];
if($strheight =="1") { echo "4Ft "; }
else if($strheight =="2") { echo "4Ft 1 inch "; }
else if($strheight =="3") { echo "4Ft 2 inch "; }
else if($strheight =="4") { echo "4Ft 3 inch "; }
else if($strheight =="5") { echo "4Ft 4 inch "; }
else if($strheight =="6") { echo "4Ft 5 inch "; }
else if($strheight =="7") { echo "4Ft 6 inch "; }
else if($strheight =="8") { echo "4Ft 7 inch "; }
else if($strheight =="9") { echo "4Ft 8 inch "; }
else if($strheight =="10") { echo "4Ft 9 inch "; }
else if($strheight =="11") { echo "4Ft 10 inch "; }
else if($strheight =="12") { echo "4Ft 11 inch "; }
else if($strheight =="13") { echo "5Ft "; }
else if($strheight =="14") { echo "5Ft 1 inch "; }
else if($strheight =="15") { echo "5Ft 2 inch "; }
else if($strheight =="16") { echo "5Ft 3 inch "; }
else if($strheight =="17") { echo "5Ft 4 inch "; }
else if($strheight =="18") { echo "5Ft 5 inch "; }
else if($strheight =="19") { echo "5Ft 6 inch "; }
else if($strheight =="20") { echo "5Ft 7 inch "; }
else if($strheight =="21") { echo "5Ft 8 inch "; }
else if($strheight =="22") { echo "5Ft 9 inch "; }
else if($strheight =="23") { echo "5Ft 10 inch "; }
else if($strheight =="24") { echo "5Ft 11 inch "; }
else if($strheight =="25") { echo "6Ft "; }
else if($strheight =="26") { echo "6Ft 1 inch "; }
else if($strheight =="27") { echo "6Ft 2 inch "; }
else if($strheight =="28") { echo "6Ft 3 inch "; }
else if($strheight =="29") { echo "6Ft 4 inch "; }
else if($strheight =="30") { echo "6Ft 5 inch "; }
else if($strheight =="31") { echo "6Ft 6 inch "; }
else if($strheight =="32") { echo "6Ft 7 inch "; }
else if($strheight =="33") { echo "6Ft 8 inch "; }
else if($strheight =="34") { echo "6Ft 9 inch "; }
else if($strheight =="35") { echo "6Ft 10 inch "; }
else if($strheight =="36") { echo "6Ft 11 inch "; }
else if($strheight =="37") { echo "7Ft "; }
else if($strheight =="Does not Matter") { echo "Does not Matter"; }
?>
        To
      <?php  
$strheight = $fetch['PE_to_Height'];
if($strheight =="1") { echo "4Ft "; }
else if($strheight =="2") { echo "4Ft 1 inch "; }
else if($strheight =="3") { echo "4Ft 2 inch "; }
else if($strheight =="4") { echo "4Ft 3 inch "; }
else if($strheight =="5") { echo "4Ft 4 inch "; }
else if($strheight =="6") { echo "4Ft 5 inch "; }
else if($strheight =="7") { echo "4Ft 6 inch "; }
else if($strheight =="8") { echo "4Ft 7 inch "; }
else if($strheight =="9") { echo "4Ft 8 inch "; }
else if($strheight =="10") { echo "4Ft 9 inch "; }
else if($strheight =="11") { echo "4Ft 10 inch "; }
else if($strheight =="12") { echo "4Ft 11 inch "; }
else if($strheight =="13") { echo "5Ft "; }
else if($strheight =="14") { echo "5Ft 1 inch "; }
else if($strheight =="15") { echo "5Ft 2 inch "; }
else if($strheight =="16") { echo "5Ft 3 inch "; }
else if($strheight =="17") { echo "5Ft 4 inch "; }
else if($strheight =="18") { echo "5Ft 5 inch "; }
else if($strheight =="19") { echo "5Ft 6 inch "; }
else if($strheight =="20") { echo "5Ft 7 inch "; }
else if($strheight =="21") { echo "5Ft 8 inch "; }
else if($strheight =="22") { echo "5Ft 9 inch "; }
else if($strheight =="23") { echo "5Ft 10 inch "; }
else if($strheight =="24") { echo "5Ft 11 inch "; }
else if($strheight =="25") { echo "6Ft "; }
else if($strheight =="26") { echo "6Ft 1 inch "; }
else if($strheight =="27") { echo "6Ft 2 inch "; }
else if($strheight =="28") { echo "6Ft 3 inch "; }
else if($strheight =="29") { echo "6Ft 4 inch "; }
else if($strheight =="30") { echo "6Ft 5 inch "; }
else if($strheight =="31") { echo "6Ft 6 inch "; }
else if($strheight =="32") { echo "6Ft 7 inch "; }
else if($strheight =="33") { echo "6Ft 8 inch "; }
else if($strheight =="34") { echo "6Ft 9 inch "; }
else if($strheight =="35") { echo "6Ft 10 inch "; }
else if($strheight =="36") { echo "6Ft 11 inch "; }
else if($strheight =="37") { echo "7Ft "; }
else if($strheight =="Does not Matter") { echo "Does not Matter"; }
?></td>
<td>&nbsp;</td>
	  <td>Country Living In</td>
      <td><? echo $fetch['PE_Countrylivingin'] ?></td>
    </tr>
   
    <tr bgcolor="#DFDFDF">
      <td>Occupation</td>
      <td><?php echo $fetch['PE_Occupation'] ?></td>
	  <td>&nbsp;</td>
	  <td>Education</td>
      <td><?php echo $fetch['PE_Education'] ?></td>

    </tr>
   
	<tr>
      <td>State</td>
      <td><?php echo $fetch['PE_State'] ?></td>
	   <td>&nbsp;</td>
<td>Complexion</td>
      <td><?php echo $fetch['PE_Complexion'] ?></td>
</tr>
    

    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>
  </table>
</div>
<br>
<input type="button"  id="printPageButton" onClick="print_report()" value="Print Full Profile">
&nbsp; 
 <input type="button" id="btnExport" value="Export" onclick="Export()" />
<!-- <a href="print_img1.php?id=<?php echo $_GET['MatriID']?>"><input type="button" value="Download Word File"></a>-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        function Export() {
            html2canvas(document.getElementById('tblCustomers'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                    window.location= "profile_view?ID="+mid;
                    
                }
            });
        }
    </script>
</body>
</html>
