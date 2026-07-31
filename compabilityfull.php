<div class="tab" id="tab-4">
<div class="schedule-timeline">
<!-- schedule Block -->
 <!-- schedule Block -->
<div class="col-md-12">
<div class="schedule-block even">
	<div class="inner-box">
	
		<div class="inner inners" >
 <?php
							//paid member photo 
							 if($full_profile_fetch['photo_visibility']=="paidphoto")
								   { ?>
									   
								   <?php if($full_profile_fetch['Photo1Approve']=='Yes'&& $me['Status']=='Paid')
													 {
								   if($full_profile_fetch['Photo1']!='nophoto.jpg' ) {
														 ?>			
								 <div class="date">
				                 <img src="photoprocess.php?image=gallary/<?php echo   $full_profile_fetch['Photo1'];?>&square=200" class="img-thumbnail rounded-circle imgcom " onerror="this.onerror=null;this.src='images/nophoto.jpg';"  >  
				                   </div>
								 <?php  } else   {   ?>
								  <div class="date">
								<img src="images/nophoto.jpg"  class="img-thumbnail rounded-circle imgcom "> 
								</div>
										  <?php } } else { ?>
										   <div class="date">
								<img src="images/nophoto.jpg" class="img-thumbnail rounded-circle imgcom "  > 
                                         </div>
										 
										 <?php  } } 
		 
							   elseif($full_profile_fetch['photo_visibility']=='allphoto' && $full_profile_fetch['Photo1Approve']=='Yes' ) 
							   	{ 
							   		if($full_profile_fetch['Photo1']!='nophoto.jpg' )
							   		{

							   	?>
										
								<div class="date">
									<img src="photoprocess.php?image=gallary/<?php echo   $full_profile_fetch['Photo1'];?>&square=200" class="img-thumbnail rounded-circle imgcom " onerror="this.onerror=null;this.src='images/nophoto.jpg';" >  
						
								</div>
								<?php
									}
									else
									{
								?>
								<div class="date">
									<img src="gallary/<?php echo   $full_profile_fetch['Photo1'];?>" class="img-thumbnail rounded-circle imgcom " onerror="this.onerror=null;this.src='images/nophoto.jpg';" >  
						
								</div>

								<?php
									} 
								} 
								else 
								{
								?>
										 <div class="date"> 
									<img src="images/nophoto.jpg" class="img-thumbnail rounded-circle imgcom "  > 
									</div>
										   <?php }?>
															</a>
				<?php
	$id=base64_decode( urldecode($_GET['id']) );
	$login=$_SESSION['MatriID'];
	
	$compl=mysqli_query($con,"select* from compatibility where MatriID='$login'");
	//echo "select* from compatibility where MatriID='$login'";
	$complfet=mysqli_fetch_array($compl);
	$compid=mysqli_query($con,"select* from compatibility where MatriID='$id'");
	//echo "select* from compatibility where MatriID='$id'";
	$complfetch=mysqli_fetch_array($compid);								
	?>			 
			<div class="speaker-info">
				<figure class="thumb"><img src="icon/compatibility.png" alt=""></figure>
				<h5 class="name">Compatibility Matches <i class="fal fa-chevron-double-left"></i></h5>
				<span class="designation"><?php if($complfetch['MatriID']==$id){ ?>Last Updated on <?php
				$formatted = date('d F Y', strtotime($complfetch['date']));	echo $formatted;} else { echo "Compatibility not updated yet"; }?> </span>
			</div><br>
			<?php
			if(mysqli_num_rows($compl)==0)
			{?>
				
				<span class="name"> <a href="compability.php"><u>Click Here To Update Your Compatibility</u></a> </span>
					
			<?php } elseif(mysqli_num_rows($compid)==0)
			{?>
					<span class="name"> Sorry <?php echo "$id"; ?> <u>Not Updated Compatibility</u></span>
		<?php	} ?>
			
			
			
			
			<?php if(mysqli_num_rows($compl)==1 && mysqli_num_rows($compid)==1)
			{ ?>
			
		 <div class="text">
			 <aside class="sidebar2">
			   <div class="sidebar2-widget popular-tags2">
		   	   <span class="coltex"> How often do you go out</span><br>
				<?php if($complfet['que1']=='1'&&$complfetch['que1']=='1'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Twice a week or more than that</span> <i class="far fa-check-circle tick"></i> <br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i>Twice a week or more than that <br>
				<?php } ?>
				<?php if($complfet['que1']=='2'&&$complfetch['que1']=='2'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Once a week</span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Once a week<br>
				<?php } ?>
				<?php if($complfet['que1']=='3'&&$complfetch['que1']=='3'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Twice in a month</span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Twice in a month<br>
				<?php } ?>
				<?php if($complfet['que1']=='4'&&$complfetch['que1']=='4'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Once a month or less</span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Once a month or less<br>
				<?php } ?>
				<br>
				  <span class="coltex"><i class="fas fa-chevron-double-left"></i>How would you describe your clothes</span><br>
				<?php if($complfet['que2']=='5'&& $complfetch['que2']=='5'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Only of foreign or big brands</span> <i class="far fa-check-circle tick"></i> <br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Only of foreign or big brands <br>
				<?php } ?>
				<?php if($complfet['que2']=='6'&& $complfetch['que2']=='6'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Mostly all foreign brands</span> <i class="far fa-check-circle tick"></i><br>
				<?php } else {?>
				<i class="fas fa-circle sqr"></i> Mostly all foreign brands</a><br>
				<?php } ?>
				<?php if($complfet['que2']=='7'&& $complfetch['que2']=='7'){?>											
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Mostly all of local brands</span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Mostly all of local brands<br>
				<?php } ?>
				<?php if($complfet['que2']=='8'&& $complfetch['que2']=='8'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> All of local brands</span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> All of local brands<br>
				<?php } ?>
				
				<br>
				  <span class="coltex">How do you spend your free time </span><br>
				<?php 
					$looking=explode(",",$complfet['que3']);
                    $look=explode(",",$complfetch['que3']);
					?>
					<?php 
					if(in_array("9",$looking)&&in_array("9",$look))
					{
                     ?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Meditation, Satsang etc</span> <i class="far fa-check-circle tick"></i> <br>
					<?php } else { ?>
					<i class="fas fa-circle sqr"></i> Meditation, Satsang etc<br>
					<?php } ?>
				<?php 
					if(in_array("10",$looking)&&in_array("10",$look))
					{
                     ?>	
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Family </span> <i class="far fa-check-circle tick"></i><br>
					<?php }  else { ?>
					<i class="fas fa-circle sqr"></i> Family <br>
					<?php } ?>
				<?php 
					if(in_array("11",$looking)&&in_array("11",$look))
					{
                     ?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Hobbies/ recreational activities </span> <i class="far fa-check-circle tick"></i><br>
				<?php }  else { ?>
					<i class="fas fa-circle sqr"></i> Hobbies/ recreational activities <br>
					<?php } ?>
					<?php 
					if(in_array("12",$looking)&&in_array("12",$look))
					{
                     ?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Friends  </span> <i class="far fa-check-circle tick"></i><br>
				<?php }  else { ?>
					<i class="fas fa-circle sqr"></i> Friends  <br>
					<?php } ?>
				
				<br>
				  <span class="coltex">How many times do you visit salon/beauty parlour  </span><br>
                <?php if($complfet['que4']=='13'&&$complfetch['que4']=='13'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Weekly once</span> <i class="far fa-check-circle tick"></i> <br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Weekly once <br>
				<?php } ?>
				<?php if($complfet['que4']=='14'&&$complfetch['que4']=='14'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Twice in a month</span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Twice in a month<br>
				<?php } ?>
				<?php if($complfet['que4']=='15'&&$complfetch['que4']=='15'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Once in a month </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Once in a month<br>
				<?php } ?>
				<?php if($complfet['que4']=='16'&&$complfetch['que4']=='16'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Once in a while</span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Once in a while<br>
				<?php }?>
				
				<br>
				  <span class="coltex">How many times do you go out drinking/ in a pub </span><br>
				<?php if($complfet['que5']=='17'&&$complfetch['que5']=='17'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Once a week or more</span> <i class="far fa-check-circle tick"></i> <br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Once a week or more <br>
				<?php }?>
				<?php if($complfet['que5']=='18'&&$complfetch['que5']=='18'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Once/twice in a month</span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Once/twice in a month<br>
				<?php }?>
				<?php if($complfet['que5']=='19'&&$complfetch['que5']=='19'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Rarely </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Rarely<br>
				<?php }?>
				<?php if($complfet['que5']=='20'&&$complfetch['que5']=='20'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Never </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Never <br>
				<?php }?>
				<br>
				  <span class="coltex">What would you choose for a romantic date with your partner  </span><br>
				<?php if($complfet['que6']=='21'&&$complfetch['que6']=='21'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Candle light dinner at home </span> <i class="far fa-check-circle tick"></i> <br>
				<?php } else {?>
				<i class="fas fa-circle sqr"></i> Candle light dinner at home  <br>
				<?php }	?>
				<?php if($complfet['que6']=='22'&&$complfetch['que6']=='22'){?>				
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Lunch/dinner in a deluxe hotel  </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Lunch/dinner in a deluxe hotel  <br>
				<?php } ?>
				<?php if($complfet['que6']=='23'&&$complfetch['que6']=='23'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Long drive   </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Long drive  <br>
				<?php }?>
				<?php if($complfet['que6']=='24'&&$complfetch['que6']=='24'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Tea and snacks at a street vendor </span> <i class="far fa-check-circle tick"></i><br>
				<?php }  else { ?>
				<i class="fas fa-circle sqr"></i> Tea and snacks at a street vendor <br>
				<?php } ?>
			   
				<br>
				  <span class="coltex">Which social platform do you use Most </span><br>
				<?php 
					$arrlooking=explode(",",$complfet['que7']);
                    $arrlook=explode(",",$complfetch['que7']);
					?>
					<?php 
					if(in_array("25",$arrlooking)&&in_array("25",$arrlook))
					{
                     ?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Facebook </span> <i class="far fa-check-circle tick"></i> <br>
					<?php } else { ?>
					<i class="fas fa-circle sqr"></i> Facebook  <br>
					<?php } ?>
				<?php 
					if(in_array("26",$arrlooking)&&in_array("26",$arrlook))
					{
                     ?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> What'sapp  </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> What'sapp  <br>
				<?php } ?>
				<?php 
				if(in_array("27",$arrlooking)&&in_array("27",$arrlook))
				{ ?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Instagram  </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
                  <i class="fas fa-circle sqr"></i> Instagram  <br>
				  <?php } ?>
				  
				  
				  <?php 
				if(in_array("28",$arrlooking)&&in_array("28",$arrlook))
				{ ?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Twitter   </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Twitter   <br>
				  <?php } ?>
				  
                 <br>
				  <span class="coltex">Do you like shopping  </span><br>
				<?php if($complfet['que8']=='29'&&$complfetch['que8']=='29'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Yes  </span> <i class="far fa-check-circle tick"></i> <br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Yes   <br>
				<?php } ?>
				<?php if($complfet['que8']=='30'&&$complfetch['que8']=='30'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Sometimes   </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				 <i class="fas fa-circle sqr"></i>Sometimes  <br>
				<?php } ?>
				<?php if($complfet['que8']=='31'&&$complfetch['que8']=='31'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Only when it’s needed   </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Only when it’s needed   <br>
				<?php } ?>
				<?php if($complfet['que8']=='32'&&$complfetch['que8']=='32'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> No  </span><i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> No  <br>
				<?php } ?>
				
                 <br>
				  <span class="coltex">Preferences while traveling  </span><br>
				<?php if($complfet['que9']=='33'&&$complfetch['que9']=='33'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> No problem wherever or whenever  </span> <i class="far fa-check-circle tick"></i> <br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> No problem wherever or whenever   <br>
				<?php } ?>
				<?php if($complfet['que9']=='34'&&$complfetch['que9']=='34'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Trekking/ adventurous activities    </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Trekking/ adventurous activities <br>
				<?php } ?>
				<?php if($complfet['que9']=='35'&&$complfetch['que9']=='35'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Serene, places close to nature   </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Serene, places close to nature  <br>
				<?php } ?>
				<?php if($complfet['que9']=='36'&&$complfetch['que9']=='36'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Don’t like to travel  </span> <i class="far fa-check-circle tick"></i><br>				
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Don’t like to travel <br>
				<?php } ?>
				
				 <br>
				  <span class="coltex">Which personality are you</span><br>
				<?php if($complfet['que10']=='37'&&$complfetch['que10']=='37'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> I like to spend a lot,on luxury products </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> I like to spend a lot,on luxury products </a> <br>
				<?php } ?>
				<?php if($complfet['que10']=='38'&&$complfetch['que10']=='38'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> I like luxury products sometimes  </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> I like luxury products sometimes  <br>
				<?php } ?>
				<?php if($complfet['que10']=='39'&&$complfetch['que10']=='39'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Not for luxury, but prefer to spend for convenience  </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>
				<i class="fas fa-circle sqr"></i> Not for luxury, but prefer to spend for convenience  <br>
				<?php } ?>
				<?php if($complfet['que10']=='40'&&$complfetch['que10']=='40'){?>
				<span class="gretxt"><i class="fas fa-circle sqr"></i> Tendency for low cost and economical choices    </span> <i class="far fa-check-circle tick"></i><br>
				<?php } else { ?>.
				<i class="fas fa-circle sqr"></i> Tendency for low cost and economical choices    <br>
				<?php } ?>

				
			   
			  
				
				                  </div>
			                  </div>   		
			<?php }?>							  
					      </aside>				
					   </div>
				     </div>
			       </div>
                 </div>
               </div>	
            </div>