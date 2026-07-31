<?php require_once('includes/bootstrap.php');

$login=$_SESSION['MatriID']; //or sender id						
$searchid=$_POST['rowid'];



?>

 <div class="modal-header">
    <h4 class="modal-title">View Contact</h4>
</div>
<link href="css/modalmobile.css" rel="stylesheet">

<div class="modal-body">
 <div class="schedule-timeline ">
               		<div class="auto-container">
						<div class="sec-title text-center">
							<span class="title">Get Contact Detail</span><br><br>
							<div class="btn-box">
							 <?php 
							 $adview = mysqli_query($con,"SELECT MatriID,Noofcontacts,Status FROM register WHERE DATEDIFF( CURRENT_DATE, Memshipexpirydate ) <1 AND Status <> 'InActive' AND Status <> 'Active' AND Noofcontacts >0 AND MatriID ='$login' ");
						 
										 if($row1=mysqli_fetch_array($adview))
										 {
											$strviewdate =  date('d-m-Y');
                             $sqlview=mysqli_query($con,"select * from viewedaddress where who1='$login' and whom1='$searchid' ");
							
							 if(mysqli_num_rows($sqlview)>0)
					          {							 
							  }
							  else 
							  {
								  $insert = mysqli_query($con,"insert into viewedaddress (who1,whom1,when1) values ('$login', '$searchid', '$strviewdate')"); 
								  
								  $qry1=mysqli_query($con,"select * from notification where noti_sender='$login' AND noti_receiver='$searchid' and notification_type='Viewed Contact'");
					
								$row2=mysqli_fetch_array($qry1);
								
								$type=$row2['notification_type']; 
									
								if(mysqli_num_rows($qry1)==0)
								{
								mysqli_query($con,"insert into notification(noti_sender,noti_receiver,notification_type,notification_desc,seen,date_time)values('$login','$searchid','Viewed Contact','Viewed Contact','unseen',NOW())");
								} 							
								$update = mysqli_query($con,"UPDATE register SET Noofcontacts = (Noofcontacts-1) WHERE MatriID ='$login' "); 
								$viewedmem=  mysqli_query($con,"select * from register where MatriID ='$searchid'"); 
								$viewedmem_rec=mysqli_fetch_array($viewedmem);
							 }
				            ?>
					
							<?php
							$viewedmem=  mysqli_query($con,"select * from register where MatriID ='$searchid'");
                           
							$viewedmem_rec=mysqli_fetch_array($viewedmem);
							$email2=mysqli_query($con,"select * from emailverify where MatriID ='$searchid' ");
							$emailver=mysqli_fetch_array($email2);
							$doc2=mysqli_query($con,"select * from document where MatriID ='$searchid' ");
							$docver=mysqli_fetch_array($doc2);
                            $planname=$row['memtype'];
							$memty=mysqli_query($con,"select * from   membershipplan where plandisplayname='$planname'");
                            $plannm=mysqli_fetch_array($memty);
							?>
							</div>
						</div>
						<div class="pricing-block-three col-lg-12 col-md-12 col-sm-12 mt-5  " data-wow-delay="400ms">
							<div class="inner-box">
								<div class="title"><?php echo $viewedmem_rec['MatriID']; ?></div>
								
								<ul class="features">

									<i>
		<a href="<?php echo $viewedmem_rec['user_facebook'];?> " target="_blank" class="font-soc"><span class="fab fa-facebook-f" ></span> Facebook Profile &nbsp;</a></i>

		<i><a href="<?php echo $viewedmem_rec['user_instagram'];?> " target="_blank" class="font-soc"><span class="fab fa-instagram">  </span> Instagram Profile &nbsp;</a></i><br>


		<i><a href="<?php echo $viewedmem_rec['user_youtube'];?> " target="_blank" class="font-soc"><span class="fab fa-youtube">  </span> YouTube Profile &nbsp;</a><i>

		<i><a href="<?php echo $viewedmem_rec['user_twitter'];?> " target="_blank" class="font-soc"><span class="fab fa-twitter">  </span> Twitter Profile &nbsp;</a></i>

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
											IDProof verified<?php if($viewedmem_rec['idproof_approve']=='Yes') { ?><i class="fa fa-check-square mr-3"></i><?php } else {?> <i class="fa fa-window-close mr-3"></i><?php } ?><br>
											Email verified<?php if($emailver['verification']=='Yes'){?> <i class="fa fa-check-square mr-3"></i><?php } else { ?> <i class="fa fa-window-close mr-3"></i><?php } ?>
											Document verified <?php if($docver['docapprove']=='Yes'){?> <i class="fa fa-check-square mr-3"></i><?php } else { ?> <i class="fa fa-window-close mr-3"></i><?php } ?>
									</li>
									<?php if(($viewedmem_rec['HorosApprove']=='Yes')&&($viewedmem_rec['horoscope']!='')) {?>
									<li> 
											Horoscope Details: <img class="ml-1" src="kundli/<?php echo $viewedmem_rec['horoscope'];?>" style="height:20px;width:20px" />
					     				<a href="kundli/<?php echo $viewedmem_rec['horoscope'];?>" style="color:#6f42c1" target="_blank"><span class="ml-1">View<span></a> 
									</li>
									<?php } else { }?>
									<li>
									</li>
								</ul>
								
							</div>
						</div>
					</div>
		        </div>
										
						
						<?php }?>
						
						</div>
              <div class="modal-footer fott" >
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
		
		
		
<script>
var closebtns = document.getElementsByClassName("close1");
var i;

for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}
</script>
