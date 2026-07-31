<div id="search-popup5" class="search-popup5">
	<div class="close-search theme-btn"><span class="fas fa-window-close"></span></div>
	<div class="popup-inner">
		<div class="overlay-layer"></div>
    	<div class="search-form">
        	<form method="post" action="index.html">
            	<div class="form-group">
                	
                      <div class="feature-block-two col-lg-12 col-md-12 col-sm-12 wow fadeInUp" align="center">
                    <div class="inner-box" align="left" >
                        <div class="icon-box"><span class="icon flaticon-lecture"></span></div>
                        <h4><a href="about.html">Partner Preference</a></h4>
                         <div class="text">Looking For: <?php echo $me['Looking'] ;?></div>
						<div class="text">Religion: <?php echo $me['PE_Religion'] ;?></div>
						<div class="text">Occupation: <?php echo $me['PE_Occupation'] ;?></div>
						<div class="text">Country Living In: <?php echo $me['PE_Countrylivingin'] ;?></div>
						<div class="text">Age:  <?php echo $me['PE_FromAge'] ?>&nbsp; To &nbsp; <?php echo $me['PE_ToAge'];?></div>
						<div class="text">Caste: <?php echo $me['PE_Caste'] ;?></div>
						<div class="text">Education: <?php echo $me['PE_Education'] ;?></div>
						<div class="text">State: <?php echo $me['PE_State'] ;?></div>
						<div class="text">Height: 
						<?php  
						$strheight = $me['PE_from_Height'];
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
												 &nbsp;To&nbsp;
												  <?php  
						$strheight = $me['PE_to_Height'];
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
						?></div>
						<div class="text">Complexion: <?php echo $me['PE_Complexion'] ;?></div>
						<div class="text">Resident Status: <?php echo $me['PE_Residentstatus'] ;?></div>
						<div class="text">Expectations: <?php echo $me['PartnerExpectations'] ;?></div>
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