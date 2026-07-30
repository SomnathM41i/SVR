<style>

a{
	color: #000000;
}

.font-soc
{
	font-family: revert;
	font-size: 16px;
	color: #373737;
}
@media screen and (max-width: 768px)
{
.prime_Membership
{
	margin-bottom: 390px;
}
}
</style>
<div class="tab" id="tab-3">
	      <?php   
				        /*session_start();
                        include('dbconnectadmin.php');*/
                        require_once('sys_dbconnection.php'); 
					    $login=$_SESSION['MatriID']; //or sender id	
						$searchid=base64_decode( urldecode($_GET['id']) );
						$searchid=base64_decode( urldecode($_GET['id']) );
		                $full_profile=mysqli_query($con,"select * from register where MatriID='$searchid'");	 
                        $full_fetch=mysqli_fetch_array($full_profile);

						//echo $searchid;
						$viewed=mysqli_query($con,"select * from viewedaddress where who1='$login' AND whom1='$searchid'");
					
						if($view=mysqli_fetch_array($viewed))
						{
							
							$viewedmem=  mysqli_query($con,"select * from register where MatriID ='$searchid'"); 
							$viewedmem_rec=mysqli_fetch_array($viewedmem);
							$email2=mysqli_query($con,"select * from emailverify where MatriID ='$searchid' ");
							$emailver=mysqli_fetch_array($email2);
							$doc2=mysqli_query($con,"select * from document where MatriID ='$searchid' ");
							$docver=mysqli_fetch_array($doc2);
							 $mem=  mysqli_query($con,"select * from register where MatriID ='$login'");				 
						     $row=mysqli_fetch_array($mem);
							
							?>
						
						  <div class="schedule-timeline">
               		<div class="auto-container">
						<div class="sec-title text-center">
							<span class="title">Get Contact Detail</span><br><br>
							<div class="btn-box">
						
							<?php
                            $planname=$row['memtype'];
							//echo $planname;
							$memty=mysqli_query($con,"select * from membershipplan where plandisplayname='$planname'");
                            $plannm=mysqli_fetch_array($memty)
							?>
									<a href="#" class="theme-btn btn-style-one"><span class="btn-title">Plan Name- <?php echo $row['memtype'];?></span></a>
									<a href="#" class="theme-btn btn-style-one"><span class="btn-title">Allocate Contact- 
									<?php echo $plannm['plannoofcontacts'];?></span></a>
									<a href="#" class="theme-btn btn-style-one"><span class="btn-title">Remaining Contact- 
									<?php echo $row['Noofcontacts'];?></span></a>
							</div>
						</div>
						
						<div class="pricing-block-three col-lg-12 col-md-12 col-sm-12 wow fadeInUp pricen pricemob" data-wow-delay="400ms">
                                 											
							 
							<div class="inner-box">
							<h5>already viewed this contact</h5><br>
								<div class="title"><?php echo $viewedmem_rec['MatriID'];?></div>
									
								<ul class="features">

								    <li>Name: <?php echo $viewedmem_rec['Name'];?></li>
									  <li>Father Name: <?php echo $viewedmem_rec['Fathername']; ?></li>
									    <li>Mother Name: <?php echo $viewedmem_rec['Mothersname'];?></li>
									<li><?php echo $viewedmem_rec['ConfirmEmail'];?> , <?php echo $viewedmem_rec['Mobile']?> , <?php echo $viewedmem_rec['Mobile2']?></li>
									<li>Date of birth- <?php $explodedate=explode("-",$viewedmem_rec['DOB']);
					                $explodedatedisplay=$explodedate[2]."-".$explodedate[1]."-".$explodedate[0];echo $explodedatedisplay;?>, Place of birth-  <?php echo $viewedmem_rec['POB']?>, Time of birth-  <?php echo $viewedmem_rec['TOB']?></li>
									<li>Address-  <?php echo $viewedmem_rec['Address']?></li>
									<li>Country-  <?php echo $viewedmem_rec['Country']?>,
									State-  <?php echo $viewedmem_rec['State']?>,
									District-  <?php echo $viewedmem_rec['Dist']?>,
									City-  <?php echo $viewedmem_rec['City']?></li>
									<li>Working Address-  <?php echo $viewedmem_rec['work_address']?></li>
									<li>Working Country-  <?php echo $viewedmem_rec['working_country']?>,
									Working State-  <?php echo $viewedmem_rec['working_state']?>,
									Working District-  <?php echo $viewedmem_rec['working_dist']?>,
									Working Taluka- <?php echo $viewedmem_rec['working_taluka'] ?? ''?><br>
									Working City- <?php echo $viewedmem_rec['working_city']?></li>
									<li class="true">Mobile verified <?php if($viewedmem_rec['verifymobile']==1){ ?><i class="fa fa-check-square mr-3"></i><?php } else {?> <i class="fa fa-window-close mr-3"></i><?php } ?>
									ID Proof verified <?php if($viewedmem_rec['idproof_approve']=='Yes') { ?><i class="fa fa-check-square mr-3"></i><?php } else {?> <i class="fa fa-window-close mr-3"></i><?php } ?> 
									Email verified <?php if($emailver['verification']=='Yes'){?> <i class="fa fa-check-square mr-3"></i><?php } else { ?> <i class="fa fa-window-close mr-3"></i><?php } ?>
									Document verified <?php if($docver['docapprove']=='Yes'){?> <i class="fa fa-check-square mr-3"></i><?php } else { ?> <i class="fa fa-window-close mr-3"></i><?php } ?>

									</li>



									<?php if(($viewedmem_rec['HorosApprove']=='Yes')&&($viewedmem_rec['horoscope']!='')) {?>
									<li> 
											Horoscope Details: <img class="ml-1" src="kundli/<?php echo $viewedmem_rec['horoscope'];?>" style="height:20px;width:20px" />
					     				<a href="kundli/<?php echo $viewedmem_rec['horoscope'];?>" style="color:#6f42c1" target="_blank"><span class="ml-1">View<span></a> 
									</li>


									<?php } else { }?>
		<a href="<?php echo $viewedmem_rec['user_facebook'];?> " target="_blank" class="font-soc"><span class="fab fa-facebook-f" ></span> Facebook Profile &nbsp;</a>

		<a href="<?php echo $viewedmem_rec['user_instagram'];?> " target="_blank" class="font-soc"><span class="fab fa-instagram">  </span> Instagram Profile &nbsp;</a>


		<a href="<?php echo $viewedmem_rec['user_youtube'];?> " target="_blank" class="font-soc"><span class="fab fa-youtube">  </span> YouTube Profile &nbsp;</a>

		<a href="<?php echo $viewedmem_rec['user_twitter'];?> " target="_blank" class="font-soc"><span class="fab fa-twitter">  </span> Twitter Profile &nbsp;</a>
	</li>
	
								</ul>
								
							</div>
						</div>
					</div>
		        </div>
			  
					
	     <?php 
		 
		
		 } elseif($full_fetch['phone_visibility']=='paidphone'){
			
			?>
				<?php 

				$login=$_SESSION['MatriID']; //or sender id
				$searchid=base64_decode( urldecode($_GET['id']) );
				  
					
				  $mem=  mysqli_query($con,"select * from register where MatriID ='$login'") ;
						 
						  if($row=mysqli_fetch_array($mem))
						  {
									
									  if($row['memtype']=='Free')
									 {	
									 ?>

				 <div class="alert alert-info prime_Membership" align="center" role="alert"> This feature is available only to Premium membership ! 
				Your Membership must be Upgraded. <u><a href="my_offer" target=_blank>Get Paid</a></u>
				 </div>
				<?php 					
																															
					 }
					 elseif($row['memtype']!='Free' && $row['Noofcontacts']>0 && strtotime($row['MemshipExpiryDate']) > strtotime(date('Y-m-d')))
					 {  ?>

				<div class="sec-title text-center">
				 <span class="title">Get Contact Detail</span>
				 <div class="text">One contact will be reduced from 
					total contacts allotted.</div><br>
				<div class="btn-box">
				<?php       $mem=  mysqli_query($con,"select * from register where MatriID ='$login'") ;
				            $row=mysqli_fetch_array($mem);
                            $planname=$row['memtype'];
							$memty=mysqli_query($con,"select * from   membershipplan where plandisplayname='$planname'");
                            $plannm=mysqli_fetch_array($memty)
							?>
									<a href="#" class="theme-btn btn-style-one"><span class="btn-title">Plan Name- <?php echo $row['memtype'];?></span></a>
									<a href="#" class="theme-btn btn-style-one"><span class="btn-title">Allocate Contact- 
									<?php echo $plannm['plannoofcontacts'];?></span></a>
									<a href="#" class="theme-btn btn-style-one"><span class="btn-title">Remaining Contact- 
									<?php echo $row['Noofcontacts'];?></span></a><br><br>
							
								<div class="btn-box">
		                        <button type="button" class="theme-btn btn-style-three" data-bs-toggle="modal" data-bs-target="#myModalc" data-id="<?php echo $searchid;?>" > <span class="btn-title"> view contact</span></button>
									 </div>					
								</div>
				</div>
					
				
			
				<?php }	else {

						if($row['Noofcontacts']<=0 && strtotime($row['MemshipExpiryDate']) > strtotime(date('Y-m-d')))
						{ 
							 
						?>
						
				 <div class="alert alert-info" align="center" role="alert">Renew Membership 
				Your allowed contacts are finished. please <u><a href="my_offer">subscribe</a></u> plan.<br>
				  </div>
				<?php }	 else {	?>
				 <div class="alert alert-info" align="center" role="alert"> Renew Membership
				Your membership has been expired, please Renew membership now .<br>
				<u><a href="my_offer" target=_blank>Get Paid</a></u>
				 </div>					
				 <?php		 }
				            }
						
			        }
				?>
		
      <?php }  elseif($full_fetch['phone_visibility']=='freephone'){?>
	
	  <?php $viewedit=mysqli_query($con,"select * from viewcontact_details where who='$login' AND whom='$searchid'");
	 // echo "select * from viewcontact_details where who='$login' AND whom='$searchid'";
	  
		$viewedit_ft=mysqli_fetch_array($viewedit);
		if($viewedit_ft['status']=='Pending') { ?>
	   <div class="sec-title text-center">
		 <span class="title">Get Contact Detail</span>
		<br>
		<div class="btn-box">
				<a href="#" class="theme-btn btn-style-one"><span class="btn-title">Request Send</span></a>								
			</div>
		</div>
	
	 <?php } elseif($viewedit_ft['status']=='Accept') { ?>
		     <?php 
			  $mem=  mysqli_query($con,"select * from register where MatriID ='$login'") ;
						  if($row=mysqli_fetch_array($mem))
						  {
									
									  if($row['memtype']=='Free')
									 {	
									 ?>

				 <div class="alert alert-info prime_Membership" align="center" role="alert"> This feature is available only to Premium membership ! 
				Your Membership must be Upgraded. <u><a href="my_offer" target=_blank>Get Paid</a></u>
				 </div>
				<?php 					
																															
					 }
					 elseif($row['memtype']!='Free' && $row['Noofcontacts']>0 && strtotime($row['MemshipExpiryDate']) > strtotime(date('Y-m-d')))
					 {
							
			?>
				<div class="sec-title text-center">
				 <span class="title">Get Contact Detail</span>
				 <div class="text">One contact will be reduced from 
					total contacts allotted.</div><br>
				<div class="btn-box">
				<?php       $mem=  mysqli_query($con,"select * from register where MatriID ='$login'") ;
				            $row=mysqli_fetch_array($mem);
                            $planname=$row['memtype'];
							$memty=mysqli_query($con,"select * from   membershipplan where plandisplayname='$planname'");
                            $plannm=mysqli_fetch_array($memty)
							?>
									<a href="#" class="theme-btn btn-style-one"><span class="btn-title">Plan Name- <?php echo $row['memtype'];?></span></a>
									<a href="#" class="theme-btn btn-style-one"><span class="btn-title">Allocate Contact- 
									<?php echo $plannm['plannoofcontacts'];?></span></a>
									<a href="#" class="theme-btn btn-style-one"><span class="btn-title">Remaining Contact- 
									<?php echo $row['Noofcontacts'];?></span></a><br><br>
					  
					
					<button type="button" class="theme-btn btn-style-three" data-bs-toggle="modal" data-bs-target="#myModalc" data-id="<?php echo $searchid;?>" > <span class="btn-title"> view contact</span></button>					
					</div>
				</div>
						



				
                	
			
				<?php }	else {

						if($row['Noofcontacts']<=0 && strtotime($row['MemshipExpiryDate']) > strtotime(date('Y-m-d')))
						{ 
							 
						?>
						
				 <div class="alert alert-info" align="center" role="alert">Renew Membership 
				Your allowed contacts are finished. please <u><a href="my_offer">subscribe</a></u> plan.<br>
				</div>
				<?php }	 else {	?>
				 <div class="alert alert-info" align="center" role="alert"> Renew Membership
				Your membership has been expired, please Renew membership now .<br>
				<u><a href="my_offer" target=_blank>Get Paid</a></u>
				 </div>					
				 <?php		 }
				            }
						}
			        
				?>
			   <?php } elseif($viewedit_ft['status']=='Decline') { ?>

				
								  <div class="sec-title text-center">
					 <span class="title">Get Contact Detail</span>
					 <div class="text">At Contact, we are committed to protecting your privacy. Whenever you share personal data with us we aim to be clear with you,<br> and not to do anything with your data that you wouldn’t reasonably expect us to do.</div>
										<br><div class="btn-box">
												<a href="#" class="theme-btn btn-style-one"><span class="btn-title">Request Decline</span></a>
												
										</div>
							</div>

				<?php } else {?>
							  <div class="sec-title text-center">
					 <span class="title">Get Contact Detail</span>
					 <div class="text">At Contact, we are committed to protecting your privacy. Whenever you share personal data with us we aim to be clear with you,<br> and not to do anything with your data that you wouldn’t reasonably expect us to do.</div>
										<br><div class="btn-box">
												<a href="#view_contact1" data-bs-toggle="modal" class="theme-btn btn-style-one"><span class="btn-title">Request Contact</span></a>
												
										</div>
							</div>
				<?php   } }?>	 
			 
	
    </div>
		  

<div class="modal fade" id="view_contact1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content" >
	     <div class="modal-header">
          <h4 class="modal-title">View Contact</h4>
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        </div>
		<div class="modal-body">
		
		 <?php 
			   $active=mysqli_query($con,"select * from register where MatriID ='".$_SESSION['matri_login']."'");
			   $activemember=mysqli_fetch_array($active);
			   if($activemember['Status']!='Paid')
			   {?>
				     <p>Enroll Membership... 
                      Subscribe Plan To Use The Facility. <u><a href="my_offer"> Subscribe Now</a></u> <br>
              </p>
			  
			  <?php  } else {?>
            
        <h4 class="modal-title"><?php $nam=explode(" ",$record['Name']); echo $nam[0] ;?>
				 <?php   
				$viewed=mysqli_query($con,"select * from viewcontact_details where who='$strid' AND whom='$searchid'");
				?>
				<h5 class="modalcss1"> For View Contact Details Send Request</h5> <br>
				
				<div class="btn-box">
				<?php $searchid=base64_decode( urldecode($_GET['id']) );?>
			
                  <a href="viewcontactrequest_send.php?searchid=<?php echo $searchid ?>" class="theme-btn btn-style-one modaldesign" ><span class="btn-title">Send Request</span></a>
                 </div></a>			
            <?php }?>
       
		</div>
         <div class="modal-footer" >
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div> 	
		</div>
		</div>
 </div> 
		  

<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>
<div class="modal fade" id="myModalc">
<div class="modal-dialog">
  <div class="modal-content">
</div>	
</div>	
</div>	  
<script>
$(document).ready(function(){
    $('#myModalc').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'contactpopup.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});

</script>
			  
