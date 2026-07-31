
<?php require_once('sys_dbconnection.php');
//include_once('memprotect');
//include_once('siteconfig');

$from = 0;
$max_results = 50; 
$sender=$_SESSION['matriid'];
$receiver = base64_decode( urldecode($_GET['id']) );

$sender_sql=mysqli_query($con,"select * from  register where MatriID='$receiver'");
$sender_info=mysqli_fetch_array($sender_sql);

$mem_sql=mysqli_query($con,"select * from  register where MatriID='$sender'");
$mem_info=mysqli_fetch_array($mem_sql);

$strid = $_SESSION['matriid'];
$chat = mysqli_query($con,"SELECT * FROM receivemessage WHERE ToID IN('$strid','$sender') order by rid DESC  ");
$sqlcnt=mysqli_query($con,"select * from receivemessage where FromID='$receiver' and ToID='$sender'");
$site1 = mysqli_query($con,"SELECT * FROM siteconfig WHERE ID='1'");
$site2=mysqli_fetch_array($site1);
?>
<style>
.alert-info {
    color: #fff;
    background: linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);
    border-color: #fff;
	font-size: 17px;
	margin-left:51px;
}
a{
	color: #fff;
}
.subscribe-form .form-group input[type="text"] {
    border: 1px solid #168e1d;
	width:115%;
	}
	.subscribe-form .form-group input[type="submit"], .subscribe-form .form-group button {
    position: absolute;
    right: -67px;
    top: 1px;
    height: 58px;
    width: 48px;
	}
@media screen and (max-width: 768px)
{
	.messege_Section
	{
		padding: 0px 0px 63px;
	}
}
</style>
<link href="css/stylenew.css" rel="stylesheet">

<div class="tab" id="tab-2">
	 <div class="auto-container">
 	  <section class="newsletter-section messege_Section">
        <div class="auto-container">
				
            <div class="subscribe-form wow fadeInUp" data-wow-delay="500ms">
                <div class="envelope-image"></div>
                <div class="form-inner">
                    <div class="upper-box">
                        <div class="sec-title text-center">
                            <h2>Send Message</h2>
                            <div class="text">The safety and security of you and your messages matter to us.<br> We want you to know about the tools and features we've designed to help you stay safe while using <?php echo $site2['copyright_footer'] ?>.</div>
                        </div>
                    </div>
					<?php 
					$sender_msg=$_SESSION['matriid'];	
					
					$receiver = base64_decode( urldecode($_GET['id']) );
                    $receiver_msg=$receiver;
					date_default_timezone_set("Asia/Kolkata");
					$from = 0;
					$max_results = 50; 
					$chat = mysqli_query($con,"SELECT *  FROM receivemessage WHERE ToID IN('$strid','$receiver_msg') ");
               		$sender = base64_decode( urldecode($_GET['id']) );
					
					$sqlblk=mysqli_query($con,"select * from block_member where matriid='$strid' and profile_id='$sender'") ;
                  	$sqlblk1=mysqli_query($con,"select * from block_member where matriid='$sender' and profile_id='$strid'") ;
					//echo "select * from block_member where matriid='$strid' and profile_id='$sender'";
					if(mysqli_num_rows($sqlblk)==0 && mysqli_num_rows($sqlblk1)==0)
					{
					if($mem_info['Status']=='Paid')
					{
					if( strtotime($mem_info['MemshipExpiryDate']) > strtotime(date('Y-m-d')) && $mem_info['Noofcontacts']>0 )
					{
					?>				
					<?php
					
					
					while($fetch=mysqli_fetch_array($chat))
					{
					if($fetch['ToID']==$receiver_msg and $fetch['FromID']==$sender_msg)
					{
					?>
				
	               <div class="comments-area " style="margin-bottom: 27px;">
                          
							<?php $usrmsg=mysqli_query($con,"select * from register where MatriID='$sender_msg'") ;
							$fetrecive=mysqli_fetch_array($usrmsg);
							
							?>
								<div class="comment-box">
                                <div class="comment auto-container">
                                    <div class="author-thumb"><img src="photoprocess.php?image=gallary/<?php echo $fetrecive['Photo1'];?>&square=200" alt=""></div> 
                                    <div class="comment-info">
                                        <div class="name"><?php echo $fetrecive['Name'];?></div><br>
                                    </div>
                                    <div class="text"><?php echo $fetch['Msg'];?></div>										
									<div class="text"><?php echo $fetch['SendDate'];?></div>
                                   	<div class="text"><?php
										if($fetch['seen']!="")
										echo " Seen :".$fetch['seen'];?></p>										
									</div>						
                               </div>
							   
                            </div> </div>
	                        <?php } else if($fetch['ToID']==$sender_msg and $fetch['FromID']==$receiver_msg) {
							 $usrmsg1=mysqli_query($con,"select * from register where MatriID='$receiver_msg'") ;
							      $fetrecive1=mysqli_fetch_array($usrmsg1);					
							?>
					   <div class="comments-area " style="margin-bottom: 27px;">
							<div class="comment-box">
                                <div class="comment auto-container">
                                    <div class="author-thumb"><img src="photoprocess.php?image=gallary/<?php echo $fetrecive1['Photo1'];?>&square=200" alt=""></div> 
                                    <div class="comment-info">
                                        <div class="name"><?php echo $fetrecive1['Name'];?></div><br>
                                    </div>
                                    <div class="text"><?php echo $fetch['Msg'];?></div>										
									<div class="text"><?php echo $fetch['SendDate'];?></div>
                                   	<div class="text"><?php
										if($fetch['seen']!="")
										echo " Seen :".$fetch['seen'];?></p>										
									</div>						
                               
							   </div>
                            </div>
						 </div>	
							
								<?php }		} ?>
				  <form action="submit_message.php" method="post">
					  <div class="form-group">.
					  <div class="col-lg-12 col-md-12 col-sm-12">
					      <input type="text" name="message" value="" placeholder=" Enter Your Message" required>

							<input name="sender" type="hidden" id="sender" value="<?php echo $sender;?>">
							<input name="receiver" type="hidden" id="receiver" value="<?php echo $strid ;?>">
                            <button type="submit" class="theme-btn"  name="submit" id="btnsend" ><span class="fa fa-paper-plane" ></span></button>
                        </div>
						</div>
                  </form>
				  </div>     
			     </div>
            </div> 
       
		 <?php }	else   {	 ?>
							  <div class="alert alert-info" align="center" role="alert">
							Your membership Plan has been  expired Please renew to continue!
						</div>
							
						 <?php
						 }
						 }
						 else
						 {
							 ?>
							 <div class="alert alert-info" align="center" role="alert"> This feature is available only to Premium membership ! 
				Your Membership must be Upgraded. <u><a href="my_offer" target=_blank>Get Paid</a></u>
				 </div>
						
						 <?php
						 }
					 }
					 else
					 {
						if(mysqli_num_rows($sqlblk)>0)
						{
						?>
						<div class="alert alert-info" align="center" role="alert">
							You have Blocked this Member to messege 
								<a href="unblock_message?id=<?php echo $receiver ?>">Unblock</a>
						</div>
						
						<?php 
						}
						else
						{
						?>
						
							
							<div class="alert alert-info" align="center" role="alert">
							You have been Blocked by this Member
							 </div>
						<?php	
						}
					}
					  ?>     
    </section>
	 </div>
	</div>
		
                
