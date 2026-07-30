<div id="search-popup3" class="search-popup3">
	<div class="close-search theme-btn"><span class="fas fa-window-close"></span></div>
	<div class="popup-inner">
		<div class="overlay-layer"></div>
    	<div class="search-form">
        	<form method="post" action="index.html">
            	<div class="form-group">
                	
                      <div class="feature-block-two col-lg-12 col-md-12 col-sm-12 wow fadeInUp" align="center">
                    <div class="inner-box" align="left" >
                        <div class="icon-box"><span class="icon flaticon-lecture"></span></div>
                         <?php
                            $DOB = $me['DOB'];
                            $newDOB = date("d-m-Y", strtotime($DOB));
                        ?>
                        <h4><a href="about.html">Your Details</a></h4>
                        <div class="text">Profile ID: <?php echo $me['MatriID'] ;?></div>
                        <div class="text">Name: <?php echo $me['Name'] ;?></div>
                        <div class="text">Gender: <?php echo $me['Gender'] ;?></div>
                        <div class="text">DOB: <?php echo $newDOB ;?></div>
                        <div class="text">Profile Created By: <?php echo $me['Profilecreatedby'] ;?></div>
                        <div class="text">Religion: <?php echo $me['Religion'] ;?></div>
                        <div class="text">Caste: <?php echo $me['Caste'] ;?></div>
                        <div class="text">Mobile No: <?php echo $me['Mobile'] ;?></div>
                        <div class="text">Alternate No: <?php echo $me['Mobile2'] ;?></div>
                        <div class="text">Residency Status: <?php echo $me['Residencystatus'] ;?></div>
                        <div class="text">Time To Call: <?php echo $me['calling_time'] ;?></div>
                        <div class="text">ID Proof: 
                        <?php 
                            if( $me['idproof_approve'] == ' ' )
                            {
                                echo "No";
                            }
                            else
                            {
                                echo $me['idproof_approve'];
                            }
                            

                        ?>
                        </div>
                        <?php
                            if( $me['docapprove'] == '')
                            { }else{

                        ?>
                        <div class="text">Document Proof: 
                        <?php 
                            echo $me['docapprove'] ;    
                        ?>
                            
                        </div>
                        <?php
                            }
                        ?>
                        
                        <?php
                        	$que = mysqli_query($con, "SELECT * FROM compatibility WHERE MatriID='$login'");
                        	if($que > 0)
                        	{
                        ?>
                        <div class="text">Compatibility Update: Yes</div>
                        <?php
                        	}
                        	else
                        	{
                        ?>
                        <div class="text">Compatibility Update: No</div>
                        <?php
                        	}
                        ?>
                        <div class="text">Email ID: <?php echo $me['ConfirmEmail'] ;?></div>
                        <div class="text">Permanent Address: </div>
						<div class="text">Country: <?php echo $me['Country'] ;?></div>
						<div class="text">State: <?php echo $me['State'] ;?></div>
						<div class="text">District: <?php echo $me['Dist'] ;?></div>
						<div class="text">City: <?php echo $me['City'] ;?></div>
						<div class="text">Residence In: <?php echo $me['Residencystatus'] ;?></div>
						<div class="text">Address: <?php echo $me['Address'] ;?>, <?php echo $me['Pincode']?></div>
						<div class="text">Working Address: </div>
						<div class="text">Country: <?php echo $me['working_country'];?> </div>
						<div class="text">State: <?php echo $me['working_state'] ;?></div>
						<div class="text">District: <?php echo $me['working_dist'] ;?></div>
						<div class="text">City: <?php echo $me['working_city'] ;?></div>
						<div class="text">Residence In: <?php echo $me['work_residence'] ;?></div>
						<div class="text">Address: <?php echo $me['work_address'] ;?>, <?php echo $me['Pincode']?></div>
						

						
							
												
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