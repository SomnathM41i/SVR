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
<?php ?>

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
			 
				
				 
				
				
				
				
				
				
				
			 
