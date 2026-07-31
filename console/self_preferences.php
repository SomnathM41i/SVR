<?php
require_once(dirname(__FILE__).'/protect.php');
	$id_temp=$rowC['MatriID'];
	$login=$id;
	$compl = mysqli_query($con,"select* from register where MatriID='$login'");
	$complfet=mysqli_fetch_array($compl);
	$compid = mysqli_query($con,"select* from register where MatriID='$id_temp'");
	$complfetch=mysqli_fetch_array($compid);	
?>
<?php  
	$looking="select * from register where MatriID='$id_temp'";
	if($me['Looking']!="" && $me['Looking']!="Any")
	{
		$matching_fet_exp=explode(",", $me['Looking']);
		$matching_fet_term = array();
		foreach($matching_fet_exp as $row => $value){
			$matching_fet_term[] ="'".trim($value)."'"; 
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
	/**/
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
?>

				
<tr>
    <td class="pl-0 f-w-500 pb-0 aligntone"> Looking For: </td>
    <td class="pb-0" width="30%"> <?php if($complfet['Looking'] == '') { echo "Not Set"; } ?><?php echo substr($complfet['Looking'],0,10);?></td>
</tr>
<tr>
    <td class="pl-0 f-w-500 pb-0 aligntone"> Religion: </td>
    <td class="pb-0"><?php if($complfet['PE_Religion'] == '') { echo "Not Set"; } ?> <?php echo substr($complfet['PE_Religion'],0,10);?></td>
</tr>
<tr>
    <td class="pl-0 f-w-500 pb-0 aligntone"> Caste: </td>
    <td class="pb-0"><?php if($complfet['PE_Caste'] == '') { echo "Not Set"; } ?> <?php echo substr($complfet['PE_Caste'],0,10);?></td>
</tr>
<tr>
    <td class="pl-0 f-w-500 pb-0 aligntone"> Complexion: </td>
    <td class="pb-0"><?php if($complfet['PE_Complexion'] == '') { echo "Not Set"; } ?>  <?php echo substr($complfet['PE_Complexion'],0,10);?></td>
</tr>
<tr>
    <td class="pl-0 f-w-500 pb-0 aligntone"> Residency Status: </td>
    <td class="pb-0"><?php if($complfet['PE_Residentstatus'] == '') { echo "Not Set"; } ?>  <?php echo substr($complfet['PE_Residentstatus'],0,10);?></td>
</tr>
<tr>
    <td class="pl-0 f-w-500 pb-0 aligntone"> Eduaction: </td>
    <td class="pb-0"><?php if($complfet['PE_Education'] == '') { echo "Not Set"; } ?>  <?php echo substr($complfet['PE_Education'],0,10);?></td>
</tr>
<tr>
    <td class="pl-0 f-w-500 pb-0 aligntone"> Occupation: </td>
    <td class="pb-0"><?php if($complfet['PE_Occupation'] == '') { echo "Not Set"; } ?>  <?php echo substr($complfet['PE_Occupation'],0,10);?></td>
</tr>
<tr>
    <td class="pl-0 f-w-500 pb-0 aligntone"> Country:  </td>
    <td class="pb-0"><?php if($complfet['PE_Countrylivingin'] == '') { echo "Not Set"; } ?><?php echo substr($complfet['PE_Countrylivingin'],0,10);?>  </td>
</tr>
<tr>
    <td class="pl-0 f-w-500 pb-0 aligntone"> State:</td>
    <td class="pb-0"><?php if($complfet['PE_State'] == '') { echo "Not Set"; } ?><?php echo substr($complfet['PE_State'],0,10);?>  </td>
</tr>
				 
				
				 
				
				
				
				
				
				
				
			 