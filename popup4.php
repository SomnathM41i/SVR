<div id="search-popup4" class="search-popup4">
	<div class="close-search theme-btn"><span class="fas fa-window-close"></span></div>
	<div class="popup-inner">
		<div class="overlay-layer"></div>
    	<div class="search-form">
        	<form method="post" action="index.html">
            	<div class="form-group">
                	
                      <div class="feature-block-two col-lg-12 col-md-12 col-sm-12 wow fadeInUp" align="center">
                    <div class="inner-box" align="left" >
                        <div class="icon-box"><span class="icon flaticon-lecture"></span></div>
                        <h4><a href="about.html">Family Details</a></h4>
                       <div class="text">Family Values: <?php echo $me['Familyvalues'] ;?></div>
						<div class="text">Family Status: <?php echo $me['FamilyStatus'] ;?></div>
						<div class="text">No.of Brothers: <?php echo $me['noofbrothers'] ;?></div>
						<div class="text">No.of Brothers Married: <?php echo $me['nbm'] ;?></div>
						<div class="text">No.of Sisters: <?php echo $me['noofsisters'] ;?></div>
						<div class="text">No.of Sisters Married: <?php echo $me['nsm'] ;?></div>
						<div class="text">Mother Tounge : <?php echo $me['mother_tounge'] ;?></div>
						<div class="text">Family Type: <?php echo $me['FamilyType'] ;?></div>
						<div class="text">Father Name: <?php echo $me['Fathername'] ;?></div>
						<div class="text">Father Occupation: <?php echo $me['Fathersoccupation'] ;?></div>
						<div class="text">Mother Name: <?php echo $me['Mothersname'] ;?></div>
					    <div class="text">Mother Occupation: <?php echo $me['Mothersoccupation'] ;?></div>
						<div class="text">Family Wealth: <?php echo $me['family_wealth'] ;?></div>
						<div class="text">Relative Info: <?php echo $me['relatives'] ;?> </div>
						<div class="text">About Family: <?php echo $me['FamilyDetails'] ;?></div>
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