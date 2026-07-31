<?php
require_once(dirname(__FILE__).'/protect.php');
	require_once('../includes/annual_income.php');
	$id_temp=$rowC['MatriID'];
	$login=$id;
	$compl = mysqli_query($con,"select* from register where MatriID='$login'");
	$complfet=mysqli_fetch_array($compl);
	$compid = mysqli_query($con,"select* from register where MatriID='$id_temp'");
	$complfetch=mysqli_fetch_array($compid);	
?>
<?php /* 
	$looking="select * from register where MatriID='$id_temp'";
	if($me['Looking']!="" && $me['Looking']!="Any")
	{
		$matching_fet_exp=explode(",", $me['Looking']);
		$matching_fet_term = array();
		foreach($matching_fet_exp as $row => $value){
			$matching_fet_term[] ="'".trim($value)."'"; //"'$value'";
		}
		$matching_fet_re = implode(',', $matching_fet_term);
		$looking.=" and Looking IN($matching_fet_re) ";//full profile marital status
	}
	$lokingcheck=mysqli_query($con,$looking);
	if($tot_count_lok=mysqli_num_rows($lokingcheck)>=1) { 
		 } else {   } 
?>
<?php  
	$lookingage="select * from register where MatriID='".$full_profile_fetch['MatriID']."' and Age Between '".$me['PE_FromAge']."' and '".$me['PE_ToAge']."'";
	$lokingcheckage=mysqli_query($con,$lookingage);
	if($me['PE_FromAge']=="Any" && $me['PE_ToAge']!=="Any")
	{  	} else {   
		if($tot_count_age=mysqli_num_rows($lokingcheckage)>=1) { 
		} else { 
		} 
	}
?>
<?php  
	$lookingheight="select * from register where MatriID='$id_temp' and Height Between '".$me['PE_from_Height']."' and '".$me['PE_to_Height']."'";
	$lokingcheckheight=mysqli_query($con,$lookingheight);
	if($me['PE_from_Height']=="Any" && $me['PE_to_Height']!=="Any")
	{   	} else { 
				if($tot_count_height=mysqli_num_rows($lokingcheckheight)>=1) {    } else {   } 
			}
?>
<?php  
	$looking="select * from register where MatriID='$id_temp'"; 
	if($me['PE_Complexion']!="" && $me['PE_Complexion']!="Any")
	{
		$PE_Complexion_exp=explode(",", $me['PE_Complexion']);
		$PE_Complexion_term = array();
		foreach($PE_Complexion_exp as $row => $value)
		{
			$PE_Complexion_term[] = "'".trim($value)."'";
		}
		$PE_Complexion_re = implode(',', $PE_Complexion_term);
		$looking.=" and PE_Complexion IN($PE_Complexion_re) ";
	}
	$lokingcheck=mysqli_query($con,$looking);
	if($tot_count_comple=mysqli_num_rows($lokingcheck)>=1) { 
?>
<?php  
	}else{ 
?>
<?php  
	}
?>
<!-- end complexion -->
<!-- Religion -->
<?php  
	$looking="select * from register where MatriID='$id_temp'"; 
	if($me['PE_Religion']!="" && $me['PE_Religion']!="Any")
	{
						 	 
		$PE_Religion_exp=explode(",", $me['PE_Religion']);
		$PE_Religion_term = array();
		foreach($PE_Religion_exp as $row => $value){
			$PE_Religion_term[] = "'".trim($value)."'";
		}
		$PE_Religion_re = implode(',', $PE_Religion_term);
		$looking.=" and PE_Religion IN($PE_Religion_re) ";
	}
	
	$lokingcheck=mysqli_query($con,$looking);
	if($tot_count_religion=mysqli_num_rows($lokingcheck)>=1) { 
?>
<?php  
	} else { 
?>
<?php  
	}
?>
<!-- end Religion -->
<!-- caste-->
<?php  
	$looking="select * from register where MatriID='$id_temp'"; 
	if($me['PE_Caste']!="" && $me['PE_Caste']!="Any")
	{
		$PE_Caste_exp=explode(",", $me['PE_Caste']);
		$PE_Caste_term = array();
		foreach($PE_Caste_exp as $row => $value){
			$PE_Caste_term[] = "'".trim($value)."'";
		}
		$PE_Caste_re = implode(',', $PE_Caste_term);
		$looking.=" and PE_Caste IN($PE_Caste_re) ";
	}
	$lokingcheck=mysqli_query($con,$looking);
	if($tot_count_caste=mysqli_num_rows($lokingcheck)>=1) { 
?>
<?php  } else { 
?>
<?php  
	}
?>
<!-- end caste-->
<!-- occupation-->
<?php  
	$looking="select * from register where MatriID='$id_temp'"; 
	if($me['PE_Occupation']!="" && $me['PE_Occupation']!="Any")
	{
		$PE_Occupation_exp=explode(",", $me['PE_Occupation']);
		$PE_Occupation_term = array();
		foreach($PE_Occupation_exp as $row => $value){
			$PE_Occupation_term[] = "'".trim($value)."'";
		}
		$PE_Occupation_re = implode(',', $PE_Occupation_term);
		$looking.=" and PE_Occupation IN($PE_Occupation_re) ";
	}
	$lokingcheck=mysqli_query($con,$looking);
	if($tot_count_occupation=mysqli_num_rows($lokingcheck)>=1) { 
?>
<?php  
	} else { 
?>
<?php  
	}
?>
<!-- end occupation-->
<!-- education-->
<?php  
	$looking="select * from register where MatriID='$id_temp'"; 
	if($me['PE_Education']!="" && $me['PE_Education']!="Any")
		{
			$PE_Education_exp=explode(",", $me['PE_Education']);
			$PE_Education_term = array();
			foreach($PE_Education_exp as $row => $value){
				$PE_Education_term[] = "'".trim($value)."'";
			}
			$PE_Education_re = implode(',', $PE_Education_term);
			$looking.=" and PE_Education IN($PE_Education_re) ";
		}
		$lokingcheck=mysqli_query($con,$looking);
		if($tot_count_education=mysqli_num_rows($lokingcheck)>=1) { 
?>
<?php  } else { 
?>
<?php  
	}
?>
<!-- end education-->
<!-- country-->
<?php  
	$countryqry="select * from register where MatriID='$id_temp'"; 
	if($me['PE_Countrylivingin']!="" && $me['PE_Countrylivingin']!="Any")
	{
		$PE_Country_exp=explode(",", $me['PE_Countrylivingin']);
		$PE_Country_term = array();
		foreach($PE_Country_exp as $row => $value){
			$PE_Country_term[] = "'".trim($value)."'"; 
		}
		$PE_Country_re = implode(',', $PE_Country_term);
		$countryqry.=" and PE_Countrylivingin IN($PE_Country_re) ";
	}
	$lokingcheckcountry=mysqli_query($con,$countryqry);
	if($tot_count_country=mysqli_num_rows($lokingcheckcountry)>=1) { 
?>
<?php  	} else { 
?>
<?php  
		}
?>
<!-- end country-->
<!-- state-->
<?php  
	$looking="select * from register where MatriID='$id_temp'"; 
	if($me['PE_State']!="" && $me['PE_State']!="Any")
	{
		$PE_State_exp=explode(",", $me['PE_State']);
		$PE_State_term = array();
		foreach($PE_State_exp as $row => $value){
			$PE_State_term[] = "'".trim($value)."'";
		}
		$PE_State_re = implode(',', $PE_State_term);
		$looking.=" and PE_State IN($PE_State_re)";
	}
	$lokingcheck=mysqli_query($con,$looking);
	if($tot_count_state=mysqli_num_rows($lokingcheck)>=1) { 
?>
<?php  
	//echo $looking;
	//echo mysqli_num_rows($lokingcheck)
?>
<?php  } else { 
?>
<?php  }
?>
<!-- end state-->
<!-- resident status-->
<?php  
    $looking="select * from register where MatriID='$id_temp'"; 
	if($me['PE_Residentstatus']!="" && $me['PE_Residentstatus']!="Any")
	{
		$PE_Residentstatus_exp=explode(",", $me['PE_Residentstatus']);
		$PE_Residentstatus_term = array();
		foreach($PE_Residentstatus_exp as $row => $value){
			$PE_Residentstatus_term[] = "'".trim($value)."'";
		}
		$PE_Residentstatus_re = implode(',', $PE_Residentstatus_term);
		$looking.=" and PE_Residentstatus IN($PE_Residentstatus_re) ";
	}
	$lokingcheck=mysqli_query($con,$looking);
	if($tot_count_resident=mysqli_num_rows($lokingcheck)>=1) { 
?>
<?php  } else { 
?>
<?php  } ?>
<!-- end resident status-->
<?php  
	if($tot_count_lok!=0) 
	{ $count_lok=1; }				
	if($tot_count_height!=0)
	{ $count_height=1;}
	if($tot_count_religion!=0)
	{ $count_religion=1;}
	if($tot_count_caste!=0)
	{ $count_caste=1;}
	if($tot_count_comple!=0)
	{ $count_comp=1;}
	if($tot_count_country!=0)
	{ $count_country=1;}
	if($tot_count_education!=0)
	{ $count_edu=1;}				
	if($tot_count_occupation!=0)
	{ $count_occu=1;}
	if($tot_count_resident!=0)
	{ $count_resident=1;}
	if($tot_count_state!=0)
	{ $count_state=1;}
	$totcount=$count_lok+$count_height+$count_caste+$count_religion+$count_comp+$count_country+$count_edu+$count_occu+$count_resident+$count_state;
*/?>

<style>
.aligntone {
    margin-left: -2px;
}
p, .text {
    position: relative;
    font-size: 14px;
    line-height: 26px;
    color: black;
    font-weight: 400;
}
</style>
			
<div class="text">
   <span class=" f-w-500 pb-0 aligntone">Religion: </span>
   <span class="pb-0"><?php if($complfet['Religion'] == '') { echo "Not Set"; } ?> <?php echo $complfet['Religion'];?> </span>
</div>
<div class="text">
    <span class=" f-w-500 pb-0 aligntone"> Caste: </span>
    <span class="pb-0"><?php if($complfet['Caste'] == '') { echo "Not Set"; } ?> <?php echo $complfet['Caste'];?></span>
</div>
<div class="text">
    <span class=" f-w-500 pb-0 aligntone"> Height:</span>
    <span class="pb-0"><?php if($complfet['Height'] == '') { echo "Not Set"; } ?>  <?php                                       
										   $strheight = $complfet['Height'];
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
							else if($strheight =="37") { echo "7Ft "; } ?>| <span class=" f-w-500 pb-0 aligntone">Age:</span><?php if($complfet['Age'] == '') { echo "Not Set"; } ?>  <?php echo $complfet['Age'];?> Yrs.

</span></div>
<div class="text">
    <span class=" f-w-500 pb-0 aligntone">B-Group: </span> <?php if($complfet['BloodGroup'] == '') { echo "Not Set"; } ?>  <?php echo $complfet['BloodGroup'];?> | <span class=" f-w-500 pb-0 aligntone">Complexion:</span><?php if($complfet['Complexion'] == '') { echo "Not Set"; } ?>  <?php echo $complfet['Complexion'];?></span>
</div>

<div class="text">
    <span class=" f-w-500 pb-0 aligntone"> Education: </span>
    <span class="pb-0"><?php if($complfet['Education'] == '') { echo "Not Set"; } ?>  <?php echo $complfet['Education'];?>, <?php if($complfet['EducationDetails'] == ''){ echo "Not Set"; } ?><?php echo $complfet['EducationDetails'];?></span>
</div>
<div class="text">
    <span class=" f-w-500 pb-0 aligntone"> Occupation: </span>
    <span class="pb-0"><?php if($complfet['Occupation'] == '') { echo "Not Set"; } ?> <?php echo $complfet['Occupation'];?>, <?php if($complfet['occu_details'] == '') { echo "Not Set"; } ?><?php echo $complfet['occu_details'];?></span>
</div>
<div class="text">
    <span class=" f-w-500 pb-0 aligntone"> Employed In: </span>
    <span class="pb-0"><?php if($complfet['Employedin'] == '') { echo "Not Set"; } ?>  <?php echo $complfet['Employedin'];?></span>
</div>
<div class="text">
    <span class=" f-w-500 pb-0 aligntone"> Working Location: </span>
    <span class="pb-0"><?php if($complfet['workinglocation'] == '') { echo "Not Set"; } ?>  <?php echo $complfet['workinglocation'];?></span>
</div>
<div class="text">
    <span class=" f-w-500 pb-0 aligntone"> Annual Income: </span>
    <span class="pb-0"><?php echo htmlspecialchars(annual_income_format($complfet['Annualincome'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span>
</div>


<div class="text">
    <span class=" f-w-500 pb-0 aligntone"> Country: </span>
    <span class="pb-0"><?php if($complfet['Country'] == '') { echo "Not Set"; } ?><?php echo $complfet['Country'];?>  </span>
</div>
<div class="text">
    <span class=" f-w-500 pb-0 aligntone"> State:</span>
    <span class="pb-0"><?php if($complfet['State'] == '') { echo "Not Set"; } ?><?php echo $complfet['State'];?>  </span>
</div>
<!--<div class="text">
    <span class=" f-w-500 pb-0 aligntone"> Looking For: </span>
    <span class="pb-0" width="30%"> <?php if($complfet['Looking'] == '') { echo "Not Set"; } ?><?php echo $complfet['Looking'];?></span>
</div>-->			 
				
				 
				
				
				
				
				
				
				
			 
