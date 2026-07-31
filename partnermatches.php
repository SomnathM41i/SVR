		<style>
			@media screen and (max-width: 768px)
			{
				.schedule-block .inner-box
				{
					margin-top: 30px;
				}
			}
		</style>

		<div class="tab" id="tab-5">
			<div class="schedule-timeline">
			<!-- schedule Block -->
			 <!-- schedule Block -->
			<?php
					$id=base64_decode( urldecode($_GET['id']) );
					$login=$_SESSION['MatriID'];
					$compl=mysqli_query($con,"select* from register where MatriID='$login'");
					
					$complfet=mysqli_fetch_array($compl);
					$compid=mysqli_query($con,"select* from register where MatriID='$id'");
					
					$complfetch=mysqli_fetch_array($compid);								
			?>
			
		
		<div class="schedule-block even" >
		<div class="inner-box">
        <?php  
			 $looking="select * from register where MatriID='".$full_profile_fetch['MatriID']."'";
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
					if($tot_count_lok=mysqli_num_rows($lokingcheck)>=1) { ?>
				<?php  } else { ?>
				<?php  } ?>
			  <!-- end looking-->
			  <!--age -->
			 <?php  $lookingage="select * from register where MatriID='".$full_profile_fetch['MatriID']."' and Age Between '".$me['PE_FromAge']."' and '".$me['PE_ToAge']."'";
				   $lokingcheckage=mysqli_query($con,$lookingage);
					if($me['PE_FromAge']=="Any" && $me['PE_ToAge']!=="Any")
					{ ?>
					<?php  	} else { ?>
					<?php  
					if($tot_count_age=mysqli_num_rows($lokingcheckage)>=1) { ?>
					<?php   } else { ?>
					<?php  } }?>
			   <!-- end age-->
			   <!-- height-->
			<?php  $lookingheight="select * from register where MatriID='".$full_profile_fetch['MatriID']."' and Height Between '".$me['PE_from_Height']."' and '".$me['PE_to_Height']."'";
					$lokingcheckheight=mysqli_query($con,$lookingheight);
					if($me['PE_from_Height']=="Any" && $me['PE_to_Height']!=="Any")
					{ ?><?php  	} else { ?>
			<?php  
				if($tot_count_height=mysqli_num_rows($lokingcheckheight)>=1) { ?>
																		
				   <?php   } else { ?>
																		   
							<?php  } }?>
	            <!-- end height-->
	            <!-- complexion -->
						<?php  
						$looking="select * from register where MatriID='".$full_profile_fetch['MatriID']."'"; 
						if($me['PE_Complexion']!="" && $me['PE_Complexion']!="Any")
						{
							$PE_Complexion_exp=explode(",", $me['PE_Complexion']);
							$PE_Complexion_term = array();
							foreach($PE_Complexion_exp as $row => $value){
							$PE_Complexion_term[] = "'".trim($value)."'";
						}
						$PE_Complexion_re = implode(',', $PE_Complexion_term);
						$looking.=" and PE_Complexion IN($PE_Complexion_re) ";
						}
						$lokingcheck=mysqli_query($con,$looking);
						if($tot_count_comple=mysqli_num_rows($lokingcheck)>=1) { ?>
					   
									<?php  } else { ?>
							   <?php  }?>
					    <!-- end complexion -->
						<!-- Religion -->
						 <?php  
				$looking="select * from register where MatriID='".$full_profile_fetch['MatriID']."'"; 
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
						if($tot_count_religion=mysqli_num_rows($lokingcheck)>=1) { ?>
					  
						<?php  } else { ?>
							  <?php  }?>
						<!-- end Religion -->
						<!-- caste-->
				<?php  
				$looking="select * from register where MatriID='".$full_profile_fetch['MatriID']."'"; 
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
						if($tot_count_caste=mysqli_num_rows($lokingcheck)>=1) { ?>
					  
						<?php  } else { ?>
						
						<?php  }?>
						<!-- end caste-->
						<!-- occupation-->
				<?php  
				$looking="select * from register where MatriID='".$full_profile_fetch['MatriID']."'"; 
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
						if($tot_count_occupation=mysqli_num_rows($lokingcheck)>=1) { ?>
					   
						<?php  } else { ?>
					   
						<?php  }?>
                        <!-- end occupation-->
                        <!-- education-->
				<?php  
				$looking="select * from register where MatriID='".$full_profile_fetch['MatriID']."'"; 
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
						if($tot_count_education=mysqli_num_rows($lokingcheck)>=1) { ?>
					   
						<?php  } else { ?>
					   
						<?php  }?>
						 <!-- end education-->
                          <!-- country-->
				<?php  
				$countryqry="select * from register where MatriID='".$full_profile_fetch['MatriID']."'"; 
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
						if($tot_count_country=mysqli_num_rows($lokingcheckcountry)>=1) { ?>
					   
						<?php  } else { ?>
					   
						<?php  }?>
                         <!-- end country-->
                          <!-- state-->
					<?php  
					$looking="select * from register where MatriID='".$full_profile_fetch['MatriID']."'"; 
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
						if($tot_count_state=mysqli_num_rows($lokingcheck)>=1) { ?>
					<?php  
					
					
					?>
						<?php  } else { ?>
						
						<?php  }?>
						 <!-- end state-->
                         <!-- resident status-->

              <?php  
               $looking="select * from register where MatriID='".$full_profile_fetch['MatriID']."'"; 
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
						if($tot_count_resident=mysqli_num_rows($lokingcheck)>=1) { ?>
					   
						<?php  } else { ?>
						
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
			
				$totcount=$count_lok+$count_height+$count_caste+$count_religion+$count_comp+$count_country+$count_edu+$count_occu+$count_resident+$count_state;?>


		<div class=" innerss" >
			
			<div class="speaker-info">
                    <?php
							//paid member photo 
							 if($full_profile_fetch['photo_visibility']=="paidphoto")
								   { ?>
									   
								   <?php if($full_profile_fetch['Photo1Approve']=='Yes'&& $me['Status']=='Paid')
													 {
								   if($full_profile_fetch['Photo1']!='nophoto.jpg' ) {
														 ?>			
								<figure class="thumb"><img src="photoprocess.php?image=gallary/<?php echo $complfetch['Photo1'];?>&square=200"  class="img-thumbnail1 rounded-circle " alt="" onerror="this.onerror=null;this.src='images/nophoto.jpg';"></figure>

								 <?php  } else   {   ?>
								<figure class="thumb"><img src="images/nophoto.jpg"  class="img-thumbnail1 rounded-circle " alt=""></figure>
										  <?php } } else { ?>
								<figure class="thumb"><img src="images/nophoto.jpg"  class="img-thumbnail1 rounded-circle " alt=""></figure>
										 
										 <?php  } } 
		 
							   elseif($full_profile_fetch['photo_visibility']=='allphoto' && $full_profile_fetch['Photo1Approve']=='Yes' ) 
							   	{ 
							   		if($full_profile_fetch['Photo1']!='nophoto.jpg' )
							   		{
							   ?>
										
								<figure class="thumb"><img src="photoprocess.php?image=gallary/<?php echo $complfetch['Photo1'];?>&square=200"  class="img-thumbnail1 rounded-circle " alt="" onerror="this.onerror=null;this.src='images/nophoto.jpg';"></figure>

								<?php
									}
									else
									{
								?>
								<figure class="thumb"><img src="gallary/<?php echo $complfetch['Photo1'];?>"  class="img-thumbnail1 rounded-circle " alt="" onerror="this.onerror=null;this.src='images/nophoto.jpg';"></figure>
								<?php
									} 
								} 
								else 
								{
								?>
								 <figure class="thumb"><img src="images/nophoto.jpg"  class="img-thumbnail1 rounded-circle " alt=""></figure>
										
										   <?php }?>
															</a>
															
								<?php $namep=explode(" ",$complfetch['Name']);if($namep!=""){ $namep[0];}?>
							 	<h5 class="name"><?php echo $namep[0];?> <?php echo $complfetch['MatriID'];?></h5>
				
				
				Looking For: <span class="texts"><?php echo $complfetch['Looking'];?>
				<?php if($count_lok!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Height: <span class="texts"><?php get_height($complfetch['PE_from_Height']);?>	To <?php get_height($complfetch['PE_to_Height']);?>
				<?php if($count_height!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Religion: <span class="texts"><?php echo $complfetch['PE_Religion'];?>
				<?php if($count_religion!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
			
    			Caste: <span class="texts"> <?php echo $complfetch['PE_Caste'];?>
               <?php if($count_caste!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?>	</span><br>			
				
				Complexion: <span class="texts"><?php echo $complfetch['PE_Complexion'];?>
				<?php if($count_comp!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Residency Status:<span class="texts"> <?php echo $complfetch['PE_Residentstatus'];?>
				<?php if($count_resident!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Eduaction:<span class="texts"> <?php echo $complfetch['PE_Education'];?>
				<?php if($count_edu!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Occupation: <span class="texts"><?php echo $complfetch['PE_Occupation'];?>
				<?php if($count_occu!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Country: <span class="texts"><?php echo $complfetch['PE_Countrylivingin'];?>
				<?php if($count_country!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				State: <span class="texts"><?php echo $complfetch['PE_State'];?>
				<?php if($count_state!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
			  </div>
		
			  </div>   									 
						
			</div>
			</div>
			
			 <div class="schedule-block" style="margin-top:-461px;">
				<div class="inner-box " >
				<div class="inner" >
				<div class="date" >
				<h5 class="name"><?php  echo $totcount; ?>/10</h5>
				</div>
				<div class="speaker-info pricing-block-two">
					<figure class="thumb"><img src="photoprocess.php?image=gallary/<?php echo $complfet['Photo1'];?>&square=200"  class="img-thumbnail1 rounded-circle " alt="" onerror="this.onerror=null;this.src='images/nophoto.jpg';"></figure>
					
					<?php $namepp=explode(" ",$complfet['Name']);if($namepp!=""){ $namepp[0];}?>
					<h5 class="name"><?php echo $namepp[0];?> <?php echo $complfet['MatriID'];?></h5>
					Looking For: <span class="texts"><?php echo $complfet['Looking'];?>
				<?php if($count_lok!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Height: <span class="texts"><?php get_height($complfet['PE_from_Height']);?>	To <?php get_height($complfet['PE_to_Height']);?>
				<?php if($count_height!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Religion: <span class="texts"><?php echo $complfet['PE_Religion'];?>
				<?php if($count_religion!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
			
    			Caste: <span class="texts"> <?php echo $complfet['PE_Caste'];?>
               <?php if($count_caste!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?>	</span><br>			
				
				Complexion: <span class="texts"><?php echo $complfet['PE_Complexion'];?>
				<?php if($count_comp!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Residency Status:<span class="texts"> <?php echo $complfet['PE_Residentstatus'];?>
				<?php if($count_resident!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Eduaction:<span class="texts"> <?php echo $complfet['PE_Education'];?>
				<?php if($count_edu!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Occupation: <span class="texts"><?php echo $complfet['PE_Occupation'];?>
				<?php if($count_occu!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				Country: <span class="texts"><?php echo $complfet['PE_Countrylivingin'];?>
				<?php if($count_country!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
				
				State: <span class="texts"><?php echo $complfet['PE_State'];?>
				<?php if($count_state!='1'){?> <i class="far fa-check-circle ticks"></i> <?php } else {?> <i class="far fa-check-circle tick"></i> <?php }?></span><br>
			  </div>
				                      
						</div>   									 
					 </div>
				   </div>
				  </div>
                 </div>