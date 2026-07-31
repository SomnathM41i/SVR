<?php require_once('includes/annual_income.php'); ?>
<div id="search-popup2" class="search-popup2">
	<div class="close-search theme-btn"><span class="fas fa-window-close"></span></div>
	<div class="popup-inner">
		<div class="overlay-layer"></div>
    	<div class="search-form">
        	<form method="post" action="index.html">
            	<div class="form-group">
                	
                      <div class="feature-block-two col-lg-12 col-md-12 col-sm-12 wow fadeInUp" align="center">
                    <div class="inner-box" align="left" >
                        <div class="icon-box"><span class="icon flaticon-lecture"></span></div>
                        <h4><a href="about.html">Education Details</a></h4>
                        <div class="text">Education: <?php echo $me['Education'] ;?></div>
						<div class="text">Are You From IIT/IIM/NIT -<?php echo $me['iit']; ?></div>
						<div class="text">Institute Name -<?php echo $me['instu']; ?> </div>
						<div class="text">Occupation: <?php echo $me['Occupation'] ;?></div>
						<div class="text">Eduction Details: <?php echo $me['EducationDetails'] ;?></div>
						<div class="text">Occupation Details: <?php echo $me['occu_details'] ;?></div>
						<div class="text">Employed In: <?php echo $me['Employedin'] ;?></div>
						<div class="text">Annual Income: <?php echo htmlspecialchars(annual_income_format($me['Annualincome'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></div>
						<div class="text">Working Hours: <?php echo $me['working_hours'] ;?></div>
						<div class="text">Working Location/City: <?php echo $me['working_hours'] ;?></div>	
                        <div class="text">Height: <?php                                       
                                           $strheight = $me['Height'];
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
                                           else if($strheight =="37") { echo "7Ft "; } ?></div>
                        <div class="text">Weight: <?php echo $me['Weight'] ;?> <?Php echo "Kg";?></div>
                        <div class="text">Blood Group: <?php echo $me['BloodGroup'] ;?></div>
                        <div class="text">Special Cases: <?php echo $me['spe_cases'] ;?></div>
                        <?php
                            if($me['spe_cases']!='None')
                            {
                        ?>
                        <div class="text">Special Reason: <?php echo $me['spe_reason'] ;?></div>
                        <?php }?>
                        <div class="text">Complexion: <?php echo $me['Complexion'] ;?></div>			
						</div>
						</div> 
                    </div>
                </div>
            </div>
      </form>
    
</div>


   
<style>
.search-popup .search-form {
    position: relative;
    padding: 0px 15px 0px;
    max-width: 1024px;
    margin: 0 auto;
    margin-top: 150px;
}
</style>
