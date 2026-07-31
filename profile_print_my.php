<?php error_reporting(0);
include('siteconfig.php');
include('dbconnectadmin.php');
require_once('includes/annual_income.php');

$profile=mysqli_query($con,"select * from register where MatriID='$id'");

$fetch=mysqli_fetch_array($profile);
$photo_approve = mysqli_fetch_array(mysqli_query($con,"select a.PhotoProtect,b.photo_approve from register a,gallary b where b.matri_id='".$id."' AND a.Photo1=b.photo_name;"));
?>
<!doctype html>
<html><head>
<!--<link href="stylesheets/style-print.css" rel="stylesheet" type="text/css">-->
<style>
.maincontent{
margin-right:10px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:15px;
color:#36F;
font-weight:bold;
background-color:#D2F0FF;
}

.maincontent1{
margin-right:10px;
font-family:Verdana;
font-size:14px;
color:#033;
}

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
<title>print my profile</title>
</head>

<body bgcolor="#000000">
<div id="print">
<table width="1000" height="398" border="0" class="maincontent1" cellpadding="4"  bgcolor="#FFFFFF">
  <tr>
    <td colspan="5"><table width="989" border="0">
      <tr> 
        <td width="307" align="center">
        <?php if($photo_approve['photo_approve']=='Yes') { ?><img src="gallary/<?php echo $fetch['Photo1'] ?>" width="307" height="307"  alt=""/><?php }elseif($fetch['Photo1']=="no-photo.gif") { ?>
		<img src="gallary/no-photo.gif" width="307" height="307"  alt=""/>
		<?php } elseif($fetch['Photo1']=="no-photo.gif"){?>
        <img src="gallary/no-photo.gif" width="307" height="307"  alt=""/><?php } else { ?><img src="gallary/no-photo.gif" width="307" height="307"  alt=""/><?php }?></td>
        <td width="672" valign="top"><table width="670"  border="0"  class="maincontent1">
          <tr  class="maincontent">
            <td colspan="4">BASIC DETAILS</td>
            </tr>
          <tr >
            <td width="120" bgcolor="#DFDFDF">Name</td>
            <td width="217" bgcolor="#DFDFDF"><?php echo $fetch['Name']; ?></td>
            <td colspan="2" rowspan="5" align="left" valign="top" >Address :<br><?php echo $fetch['Address'] ?></td>
            </tr>
          <tr>
            <td>Matrimony ID</td>
            <td><?php echo $fetch['MatriID'] ?></td>
            </tr>
          <tr bgcolor="#DFDFDF">
            <td>Date of Birth</td>
            <td><?php $date=explode("-",$fetch['DOB']);
			         echo $date[2]."-".$date[1]."-".$date[0] ?></td>
            </tr>
          <tr>
            <td>Age</td>
            <td><?php echo $fetch['Age'] ?></td>
            </tr>
          <tr bgcolor="#DFDFDF">
            <td>Mother Tongue</td>
            <td><?php echo $fetch['mother_tounge'] ?></td>
            </tr>
          <tr>
            <td>Religion</td>
            <td><?php echo $fetch['Religion'] ?></td>
            <td width="83" >&nbsp;</td>
            <td width="232" >&nbsp;</td>
          </tr>
          <tr bgcolor="#DFDFDF">
            <td>Caste</td>
            <td><?php echo $fetch['Caste'] ?></td>
            <td >Mobile No.</td>
            <td ><?php echo $fetch['Mobile']?></td>
          </tr>
          <tr>
            <td>Marital Status</td>
            <td><?php echo $fetch['Maritalstatus'] ?> </td>
            <td>Phone No.</td>
            <td><?php echo $fetch['Phone'] ?></td>
          </tr>
          <tr bgcolor="#DFDFDF">
            <td>No. of Childern</td>
            <td><?php echo $fetch['PE_HaveChildren'] ?> </td>
            <td>Email ID</td>
            <td><?php echo $fetch['ConfirmEmail'] ?></td>
          </tr>
          <tr>
            <td>Children Living Status</td>
            <td><?php echo $fetch['childrenlivingstatus'] ?> </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>  
          </tr>
          <tr >
            <td bgcolor="#DFDFDF">About Us</td>
            <td bgcolor="#DFDFDF" colspan="3"> <?php echo $fetch['aboutus'] ?></td>
          </tr>
         
          </table></td>
      </tr>
      </table></td>
    </tr>
  <tr>
    <td colspan="2" class="maincontent">PHYSICAL INFORMATION</td>
    <td width="8">&nbsp;</td>
    <td colspan="2" class="maincontent">EDUCATIONAL / CAREER INFORMATION</td>
    </tr>
          <tr bgcolor="#DFDFDF">
    <td width="129">Height</td>
    <td width="167"><?php  
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
    <td width="146">Annual Income</td>
    <td width="194"><?php echo htmlspecialchars(annual_income_format($fetch['Annualincome'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
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
										}
	
	
    <td>&nbsp;</td>
    <td>Occupation</td>
    <td><?php echo $fetch['Occupation'] ?></td>
  </tr>
          <tr bgcolor="#DFDFDF">
    <td>Blood Group</td>
    <td><?php echo $fetch['BloodGroup'] ?></td>
    <td>&nbsp;</td>
    <td>Occupation Details</td>
    <td><?php echo $fetch['occu_details'] ?></td>
  </tr>
  <tr>
    <td>Complexion</td>
    <td><?php echo $fetch['Complexion'] ?></td>
    <td>&nbsp;</td>
    <td>Employed In</td>
    <td><?php echo $fetch['Employedin'] ?></td>
  </tr>
  <tr bgcolor="#DFDFDF">
   <td>Body Type</td>
    <td><?php echo $fetch['Bodytype'] ?></td>
    <td>&nbsp;</td>
    <td>Education</td>
    <td><?php echo $fetch['Education'] ?></td>
  </tr>
  <tr>
     <td>Diet</td>
    <td><?php echo $fetch['Diet'] ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
          <tr bgcolor="#DFDFDF">
    <td>Smoke</td>
    <td><?php echo $fetch['Smoke'] ?></td>
    <td>&nbsp;</td>
    <td>Education Details</td>
    <td><?php echo $fetch['EducationDetails'] ?></td>
  </tr>
          <tr >
           <td>Drink</td>
    <td><?php echo $fetch['Drink'] ?></td>
            <td>&nbsp;</td>
            <td colspan="2"></td>
          </tr>
          <tr bgcolor="#DFDFDF">
    <td>Special Cases</td>
    <td><?php echo $fetch['spe_cases'] ?></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="maincontent">FAMILY INFORMATION</td>
    <td>&nbsp;</td>
    <td colspan="2" class="maincontent">HOBBIES INFORMATION</td>
    </tr>
          <tr bgcolor="#DFDFDF">
          <td>Family Values</td>
    <td><?php echo $fetch['Familyvalues'] ?></td>
    <td>&nbsp;</td>
   <td>Hobby</td>
    <td><?php echo $fetch['Hobbies'] ?></td></td>
    
    
  </tr>
  <tr>
    <td>Family Type</td>
    <td><?php echo $fetch['FamilyType'] ?></td></td>
    <td>&nbsp;</td>
   <td>Other Hobby</td>
    <td><?php echo $fetch['OtherHobbies'] ?></td>
  </tr>
          <tr bgcolor="#DFDFDF">
    <td>Family Status</td>
    <td><?php echo $fetch['FamilyStatus'] ?></td>
    <td>&nbsp;</td>
   <td>Interests</td>
    <td><?php echo $fetch['Interests'] ?></td>
  </tr>
  <tr>
     <td>No. Of Brothers</td>
    <td><?php echo $fetch['noofbrothers'] ?></td>
    <td>&nbsp;</td>
      <td>Other Interests</td>
            <td><?php echo $fetch['OtherInterests'] ?></td>
  </tr>
          <tr bgcolor="#DFDFDF">
   
    <td>No. Of Sisters</td>
    <td><?php echo $fetch['noofsisters'] ?></td>
     <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <td>Father Name</td>
    <td><?php echo $fetch['Fathername'].' '.$fetch['fathermiddle'].' '.$fetch['fatherLast']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    
  </tr>
          <tr bgcolor="#DFDFDF">
    <td>Father Occupation</td>
    <td><?php echo $fetch['Fathersoccupation'] ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Mother Name</td>
    <td><?php echo $fetch['Mothersname'].' '.$fetch['mothermiddle'].' '.$fetch['motherlast']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
          <tr bgcolor="#DFDFDF">
          <td>Mother Occupation</td>
    <td><?php echo $fetch['Mothersoccupation'] ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>About Family</strong></td>
    <td colspan="4"><?php echo $fetch['FamilyDetails'] ?></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="maincontent">PARTNER PREFERENCE</td>
    <td>&nbsp;</td>
   <?php /*?> <td colspan="2" class="maincontent">HOBBIES INFORMATION</td><?php */?>
    </tr>
          <tr bgcolor="#DFDFDF">
    <td>Looking For</td>
    <td><?php echo $fetch['Looking'] ?> </td>
   <?php ?>
  </tr>
  <tr>
    <td>Age</td>
    <td><?php echo $fetch['PE_FromAge']." To ".$fetch['PE_ToAge']; ?></td>
    <?php ?>
  </tr>
          <tr bgcolor="#DFDFDF">
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
    <?php ?>
  </tr>
    <tr>
            <td>Complexion</td>
            <td><?php echo $fetch['PE_Complexion'] ?></td>
            <?php ?>
    </tr>
          <tr >
            <td bgcolor="#DFDFDF">Education</td>
            <td bgcolor="#DFDFDF"><?php echo $fetch['PE_Education'] ?></td>
            <td>&nbsp;</td>
            <td colspan="2" rowspan="3" align="center"><img src="branding/images/logo-horizontal.png" alt="Shivraj Maratha Logo"/></td>
    </tr>
    <tr>
            <td>Country</td>
            <td><?php echo $fetch['PE_Countrylivingin'] ?></td>
            <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#DFDFDF">Resident Status</td>
      <td bgcolor="#DFDFDF"><?php echo $fetch['PE_Residentstatus'] ?></td>
      <td>&nbsp;</td>
    </tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <?php $sitename=mysqli_query($con,"select * from siteconfig");
	    $fetch=mysqli_fetch_array($sitename) ?>
      <td colspan="2" align="center"><?php echo $fetch['WebFriendlyname'];?> </td>
    </tr>
</table>

</div><br>

<input type="button" onClick="print_report()" value="Print Full Profile">
 <a href="print_img1?id=<?php echo $_GET['MatriID']?>"><input type="button" value="Download Word File"></a>
 

</body>
</html>
