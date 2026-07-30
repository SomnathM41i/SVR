<?php require_once('sys_dbconnection.php');
//include_once('siteconfig');
//include_once('dbconnectadmin.php');
include_once('memprotect.php');

$from = 0;
$max_results = 50; 
$sender=$_SESSION['matriid'];
$receiver = $_GET['id'];
$sender_sql=mysqli_query($con,"select * from  register where MatriID='$receiver'");
$sender_info=mysqli_fetch_array($sender_sql);

$mem_sql=mysqli_query($con,"select * from  register where MatriID='$sender'");
$mem_info=mysqli_fetch_array($mem_sql);

$strid = $_SESSION['matriid'];
$chat = mysqli_query($con,"SELECT * FROM receivemessage WHERE ToID IN('$strid','$sender') order by rid DESC");
$sqlcnt=mysqli_query($con,"select * from receivemessage where FromID='$receiver' and ToID='$sender'");

date_default_timezone_set("Asia/Kolkata");
$dt=date('Y-m-d');
$hr=date('h');
$min=date('i');
$sec=date('s');
$am=date('a');
?>
			  
					   
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title> Compose Messages</title>

<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/stylenew.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">
<link href="css/pagination.css" rel="stylesheet">
<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<!-- Responsive -->

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<style>
body {
    background: #f3f6fb;
}
.mvv-chat-page {
    background: #f3f6fb;
    padding: 42px 0 55px;
}
.mvv-chat-wrap {
    max-width: 980px;
    margin: 0 auto;
}
.mvv-chat-card {
    background: #ffffff;
    border: 1px solid #e8edf5;
    border-radius: 22px;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
    overflow: hidden;
}
.mvv-chat-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 22px;
    border-bottom: 1px solid #edf1f7;
    background: linear-gradient(135deg, #8f1f2d 0%, #c63728 48%, #f06b2f 100%);
}
.mvv-chat-header img {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ffffff;
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
}
.mvv-chat-title {
    margin: 0;
    color: #ffffff;
    font-size: 19px;
    font-weight: 700;
}
.mvv-chat-subtitle {
    margin: 2px 0 0;
    color: rgba(255,255,255,0.82);
    font-size: 13px;
}
.mvv-chat-body {
    min-height: 420px;
    max-height: 620px;
    overflow-y: auto;
    padding: 24px 22px 12px;
    background:
        radial-gradient(circle at top left, rgba(255, 180, 90, 0.10), transparent 28%),
        linear-gradient(180deg, #fbfdff 0%, #f7f9fd 100%);
}
.mvv-chat-body .comments-area {
    margin-bottom: 14px !important;
}
.mvv-chat-body .comment-box {
    margin: 0;
}
.mvv-chat-body .comment {
    display: flex;
    align-items: flex-end;
    gap: 10px;
    padding: 0;
    max-width: 78%;
    width: fit-content;
}
.mvv-chat-body .author-thumb {
    position: static !important;
    flex: 0 0 34px;
    width: 34px !important;
    height: 34px !important;
    margin: 0 !important;
}
.mvv-chat-body .author-thumb img {
    width: 34px !important;
    height: 34px !important;
    border-radius: 50%;
    object-fit: cover;
}
.mvv-chat-body .mvv-bubble-content {
    max-width: min(560px, 100%);
}
.mvv-chat-body .comment-info {
    margin: 0 0 4px;
    font-size: 12px;
    color: #6b7280;
}
.mvv-chat-body .comment-info .name,
.mvv-chat-body .comment-info .date {
    display: inline;
    color: #6b7280;
    font-size: 12px;
    font-weight: 500;
}
.mvv-chat-body .comment-info a {
    color: inherit;
}
.mvv-chat-body .text {
    display: block;
    min-width: 70px;
    padding: 12px 15px;
    border-radius: 18px;
    font-size: 14px;
    line-height: 1.45;
    color: #111827;
    box-shadow: 0 5px 18px rgba(15, 23, 42, 0.06);
    word-break: break-word;
}
.mvv-message-sent .comment {
    margin-left: auto;
    flex-direction: row-reverse;
}
.mvv-message-sent .mvv-bubble-content {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}
.mvv-message-sent .comment-info {
    text-align: right;
    color: #9a3412;
}
.mvv-message-sent .text {
    background: linear-gradient(135deg, #a2212d 0%, #e45028 100%);
    color: #ffffff;
    border-bottom-right-radius: 5px;
    box-shadow: 0 10px 24px rgba(198, 55, 40, 0.22);
}
.mvv-message-received .comment {
    margin-right: auto;
}
.mvv-message-received .mvv-bubble-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
.mvv-message-received .text {
    background: #fffaf5;
    border: 1px solid #f4dccb;
    border-bottom-left-radius: 5px;
}
.mvv-chat-form {
    padding: 16px 18px 18px;
    border-top: 1px solid #edf1f7;
    background: #ffffff;
}
.mvv-chat-form .form-group,
.mvv-chat-form .row,
.mvv-chat-form .col-lg-12 {
    position: relative;
    margin: 0;
}
.mvv-chat-form input[type="text"] {
    width: 100%;
    height: 54px;
    border: 1px solid #d9e0ea;
    border-radius: 999px;
    padding: 0 66px 0 20px;
    color: #111827;
    background: #f9fbfe;
    outline: none;
    transition: all 0.2s ease;
}
.mvv-chat-form input[type="text"]:focus {
    border-color: #c63728;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(198, 55, 40, 0.10);
}
.mvv-chat-form .theme-btn {
    position: absolute;
    right: 6px;
    top: 6px;
    width: 42px;
    height: 42px;
    min-width: 42px;
    padding: 0;
    border-radius: 50%;
    border: 0;
    line-height: 42px;
    background: linear-gradient(135deg, #f0a21b, #e45028);
    color: #fff;
    box-shadow: 0 8px 20px rgba(228, 80, 40, 0.28);
}
.mvv-chat-alert {
    max-width: 760px;
    margin: 40px auto !important;
    border-radius: 14px;
    border: 0;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
}
@media (max-width: 767px) {
    .mvv-chat-page {
        padding: 20px 0 35px;
    }
    .mvv-chat-wrap {
        padding: 0 12px;
    }
    .mvv-chat-card {
        border-radius: 16px;
    }
    .mvv-chat-body {
        min-height: 360px;
        padding: 18px 14px 8px;
    }
    .mvv-chat-body .comment {
        max-width: 92%;
    }
}
</style>


</head>
<body>

<div class="page-wrapper">

<?php include('header.php')?>
<?php /*<section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1>Message</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Message</li>
            </ul>
        </div>
</section> */ ?>
   
 <div class="mvv-chat-page">
 	  <section class="newsletter-section">
        <div class="auto-container mvv-chat-wrap">
				
            <div class="subscribe-form wow fadeInUp mvv-chat-card" data-wow-delay="500ms">
                <div class="envelope-image"></div>
                <div class="mvv-chat-header">
                    <img src="<?php echo (!empty($sender_info['Photo1']) && $sender_info['Photo1'] != 'nophoto.jpg') ? 'photoprocess.php?image=gallary/'.$sender_info['Photo1'].'&square=200' : 'images/nophoto.jpg'; ?>" onerror="this.onerror=null;this.src='images/nophoto.jpg';" alt="<?php echo $sender_info['Name']; ?>">
                    <div>
                        <h2 class="mvv-chat-title"><?php echo $sender_info['Name']; ?></h2>
                        <p class="mvv-chat-subtitle"><?php echo $receiver; ?> &bull; Private message</p>
                    </div>
                </div>
                <div class="">
                    
	<section class="speakers mt-3">


	<div class="col-md-12">
      <div class="auto-container mvv-chat-body">
	  
       
			  <?php 
					$sender_msg=$_SESSION['matriid'];	
					
					$receiver = $_GET['id'];
                    $receiver_msg=$receiver;
					date_default_timezone_set("Asia/Kolkata");
					$from = 0;
					$max_results = 50; 
					$chat = mysqli_query($con,"SELECT *  FROM receivemessage WHERE ToID IN('$strid','$receiver_msg')  ");
               		$sender = $_GET['id'];
					
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
				
			 
                   <div class="comments-area mb-3 mvv-message mvv-message-sent">
                          
							<?php $usrmsg=mysqli_query($con,"select * from register where MatriID='$sender_msg'") ;
							$fetrecive=mysqli_fetch_array($usrmsg);
							
							?>
								<div class="comment-box">
                                <div class="comment">
                                    <div class="author-thumb"><img src="<?php echo (!empty($fetrecive['Photo1']) && $fetrecive['Photo1'] != 'nophoto.jpg') ? 'photoprocess.php?image=gallary/'.$fetrecive['Photo1'].'&square=200' : 'images/nophoto.jpg'; ?>" onerror="this.onerror=null;this.src='images/nophoto.jpg';" alt=""></div>
                                    <div class="mvv-bubble-content">
                                        <div class="comment-info">
                                            <div class="name">
										    <a href="#"><?php $namepp1=explode(" ",$fetrecive['Name']);if($namepp1!=""){ $namepp1[0];}  echo $namepp1[0];?></a>

										    </div> - <div class="date"><?php echo $fetch['SendDate'];?></div>
                                        </div>
                                        <div class="text"><?php echo $fetch['Msg'];?></div>
                                    </div>
									
                                   					
                               </div>
							   
                            </div> </div>
	                        <?php } else if($fetch['ToID']==$sender_msg and $fetch['FromID']==$receiver_msg) {
							 $usrmsg1=mysqli_query($con,"select * from register where MatriID='$receiver_msg'") ;
							      $fetrecive1=mysqli_fetch_array($usrmsg1);					
							?>
					   <div class="comments-area mb-3 mvv-message mvv-message-received">
							<div class="comment-box">
                                <div class="comment">
                                    <div class="author-thumb"><img src="<?php echo (!empty($fetrecive1['Photo1']) && $fetrecive1['Photo1'] != 'nophoto.jpg') ? 'photoprocess.php?image=gallary/'.$fetrecive1['Photo1'].'&square=200' : 'images/nophoto.jpg'; ?>" onerror="this.onerror=null;this.src='images/nophoto.jpg';" alt=""></div>
                                    <div class="mvv-bubble-content">
                                        <div class="comment-info">
                                            <div class="name"><a href="#"><?php $namepp=explode(" ",$fetrecive1['Name']);if($namepp!=""){ $namepp[0];}  echo $namepp[0];?></a></div>
										    - <div class="date" ><?php echo $fetch['SendDate'];?></div>
									    </div>
                                        <div class="text" onclick=""><?php echo $fetch['Msg'];?></div>
                                    </div>
									
                                  					
                               
							   </div>
                            </div>
						 </div>	
							
								<?php }	} ?>
							
						
                      
					  </div>
					  <form action="submit_message.php" method="post" class="mvv-chat-form">
					  <div class="form-group">
					   <div class="row">

					  <div class="col-lg-12 col-md-12 col-sm-12">
					      <input type="text" name="message" value="" placeholder=" Enter Your Message" required>
                         
						 
							<input name="sender" type="hidden" id="sender" value="<?php echo $sender;?>">
							<input name="receiver" type="hidden" id="receiver" value="<?php echo $strid ;?>">
							
                            <button type="submit" class="theme-btn"  name="submit" id="btnsend" ><span class="fa fa-paper-plane " ></span></button>
                        </div>
                        </div>   
					</div>
                  </form>
				</div>	
				  <?php }	else   {	 ?>
							  <div class="alert alert-info mt-5 mvv-chat-alert" align="center" role="alert" style="margin-bottom: 108px;">
							Your membership Plan has been  expired Please renew to continue!
						</div>
							
						 <?php
						 }
						 }
						 else
						 {
							 ?>
							 <div class="alert alert-info mt-5 mb-5 mvv-chat-alert" align="center" role="alert"> This feature is available only to Premium membership !
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
						<div class="alert alert-info mt-5 mb-5 mvv-chat-alert" align="center" role="alert">
							You have Blocked this Member to messege 
							<?php $receiver = $_GET['id'];?>
								<a href="unblock_message?id=<?php echo $receiver;  ?>">Unblock</a>
						</div>
						
						<?php 
						}
						else
						{
						?>
						
							
							<div class="alert alert-info mt-5 mb-5 mvv-chat-alert" align="center" role="alert">
							You have been Blocked by this Member
							 </div>
						<?php	
						}
					}
					  ?>     
				
                  	</div>
	           </div>
	        </div>
	     </div>
	   </div>
	 </div>
	 </div>
	</section>
    <!-- End Speakers Section -->

 </div><!-- /.page-wrapper -->
    <!-- Main Footer -->
 <?php include('footer.php');?>
<!--End pagewrapper-->
<!--Scroll to top-->
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
<!-- Color Setting -->
<script src="js/color-settings.js"></script>
</body>
</html>
