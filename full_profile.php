<?php require_once('includes/bootstrap.php');
require_once('includes/partner_match.php');
require_once('includes/annual_income.php');
include_once('memprotect.php');
include('disable_inspect.php');
include 'check_session.php';
$idurl=base64_decode( urldecode($_GET['id']) );
$bann=mysqli_query($con,"select * from register where MatriID='$idurl'");
$ban=mysqli_fetch_array($bann);
$baned=$ban['Status'];
if($baned == "Banned")
{
	header("location:banprofile.php");
} 
$data_config = $db->get_siteconfig();
    //print_r($data_config); 
$on_off = $data_config-> is_smtp_set;

?>
<?php //include_once('dbconnectadmin.php');
$idurl=base64_decode( urldecode($_GET['id']) );
$search_id = $idurl;
//error_reporting(0);
$id= $idurl;
//echo $id;
$login=$_SESSION['MatriID'];
$full_profile=mysqli_query($con,"select * from register where MatriID='$search_id'");
$full_profile_fetch=mysqli_fetch_array($full_profile);
$fetchphoto=mysqli_query($con,"select * from register where MatriID='$login'");
//echo "select * from register where MatriID='$login'";
$photofet=mysqli_fetch_array($fetchphoto);
$me=$photofet ?: [];
$partnerScore=partner_match_score($me,$full_profile_fetch ?: []);
//$search_id = $id;?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Full Profile — Manpasand Jodidar</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css?v=352421.2" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/stylenew.css?v=352421.2" rel="stylesheet">
<link href="css/fullprofile.css?v=352421.2" rel="stylesheet">
<link href="css3/mvv-premium.css" rel="stylesheet">
<link href="css3/Style.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">
<link rel="shortcut icon" href="branding/favicons/favicon.ico" type="image/x-icon">
<link rel="icon" href="branding/favicons/favicon.ico" type="image/x-icon">
<!-- MPJ: brand icons -->
<link rel="apple-touch-icon" href="branding/favicons/apple-touch-icon.png">
<link rel="manifest" href="branding/site.webmanifest">
<meta name="theme-color" content="#5E1426">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="css/myfullprofile.css" rel="stylesheet" >
<style>
  :root {
    --mvv-maroon: #7A0E1A;
    --mvv-maroon-2: #4E0710;
    --mvv-gold: #D4A437;
    --mvv-cream: #FFF8F0;
    --mvv-accent: #F4E7DA;
    --mvv-text: #3A2A22;
    --mvv-muted: #7B6256;
    --mvv-green: #2E7D32;
    --mvv-white: #FFFFFF;
    --mvv-border: rgba(122, 14, 26, 0.14);
    --mvv-shadow: 0 18px 44px rgba(58, 42, 34, 0.12);
    --font-display: 'Playfair Display', Georgia, serif;
    --font-body: 'Raleway', sans-serif;
  }
  .mvv-profile-page { background: var(--mvv-cream); padding: 40px 0 80px; }
  
  /* ── Tabs ── */
  .schedule-tabs .tab-buttons { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 32px; padding:0; text-align:left; }
  .schedule-tabs .tab-buttons li.tab-btn { height:auto !important; width:auto !important; padding:10px 24px !important; background:var(--mvv-white) !important; border:1px solid var(--mvv-border) !important; color:var(--mvv-muted) !important; font-family:var(--font-body); font-weight:600; font-size:0.85rem; cursor:pointer; transition:all 0.25s ease; border-radius:999px !important; display:inline-block; margin:0 !important; text-align:center; line-height:1.4; box-shadow:none !important; letter-spacing:0.3px; }
  .schedule-tabs .tab-buttons li.tab-btn:hover { border-color:var(--mvv-gold) !important; color:var(--mvv-maroon) !important; background:var(--mvv-white) !important; transform:translateY(-1px); }
  .schedule-tabs .tab-buttons li.tab-btn.active-btn { background:linear-gradient(135deg, var(--mvv-maroon), var(--mvv-maroon-2)) !important; color:var(--mvv-white) !important; border-color:var(--mvv-maroon) !important; box-shadow:0 6px 20px rgba(122,14,26,0.22) !important; }
  
  /* ── Photo Card ── */
  .mvv-photo-card { background:var(--mvv-white); border:1px solid var(--mvv-border); box-shadow:var(--mvv-shadow); padding:28px; text-align:center; position:relative; }
  .mvv-photo-card .photo-wrap { position:relative; display:inline-block; }
  .mvv-photo-card .photo-wrap img { width:200px; height:200px; object-fit:cover; border-radius:50%; border:4px solid var(--mvv-accent); box-shadow:0 8px 28px rgba(212,164,55,0.2); }
  .mvv-photo-card .photo-wrap .online-dot { position:absolute; bottom:12px; right:12px; width:18px; height:18px; border-radius:50%; background:#2ecc71; border:3px solid var(--mvv-white); box-shadow:0 2px 8px rgba(0,0,0,0.15); }
  .mvv-photo-card .member-id { display:inline-block; margin-top:14px; padding:5px 18px; border-radius:999px; font-size:0.8rem; font-weight:700; background:var(--mvv-accent); color:var(--mvv-maroon); letter-spacing:0.5px; }
  .mvv-photo-card .member-name { font-family:var(--font-display); color:var(--mvv-maroon-2); font-size:1.4rem; margin:8px 0 2px; }
  .mvv-photo-card .member-meta { color:var(--mvv-muted); font-size:0.92rem; }
  .partner-score-card{margin-top:18px;padding:15px;border:1px solid var(--mvv-border);background:#fffaf3;text-align:left}.partner-score-head{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:10px}.partner-score-head strong{color:var(--mvv-maroon);font-size:1rem}.partner-score-percent{color:var(--mvv-saffron);font-size:1.35rem;font-weight:800}.partner-score-bar{height:8px;overflow:hidden;border-radius:20px;background:#eadfd6}.partner-score-bar span{display:block;height:100%;background:linear-gradient(90deg,var(--mvv-saffron),var(--mvv-gold))}.partner-score-points{display:grid;grid-template-columns:1fr 1fr;gap:6px 12px;margin-top:12px;font-size:.78rem}.partner-score-points .matched{color:#28733f}.partner-score-points .missing{color:#99615b}
  
  /* ── Action Bar ── */
  .mvv-action-bar { display:flex; flex-wrap:wrap; gap:10px; align-items:center; }
  .mvv-action-bar .mvv-btn { min-height:42px; padding:10px 22px; font-size:0.88rem; border-radius:999px; font-weight:700; letter-spacing:0.3px; }
  .mvv-action-bar .mvv-btn:hover { transform:translateY(-2px); }
  .mvv-action-bar .interest-label { font-family:var(--font-display); color:var(--mvv-maroon); font-size:1.15rem; font-weight:600; }
  
  /* ── Profile Cards ── */
  .mvv-profile-card { background:var(--mvv-white); border:1px solid var(--mvv-border); margin-bottom:24px; transition:all 0.3s ease; }
  .mvv-profile-card:hover { box-shadow:var(--mvv-shadow); transform:translateY(-2px); }
  .mvv-profile-card .card-header { background:linear-gradient(135deg, var(--mvv-maroon), var(--mvv-maroon-2)); color:var(--mvv-white); padding:14px 24px; display:flex; align-items:center; gap:12px; font-family:var(--font-display); font-size:1.05rem; letter-spacing:0.4px; }
  .mvv-profile-card .card-header img { width:26px; height:26px; filter:brightness(0) invert(1); }
  .mvv-profile-card .card-body { padding:18px 24px; }
  .mvv-profile-card .card-body a { color:var(--mvv-text); text-decoration:none; }
  .mvv-profile-card .card-body a:hover { color:var(--mvv-gold); }
  .info-row { display:flex; padding:7px 0; border-bottom:1px solid var(--mvv-border); font-size:0.95rem; }
  .info-row:last-child { border-bottom:none; }
  .info-row .info-label { width:170px; min-width:150px; color:var(--mvv-muted); font-weight:700; font-size:0.78rem; text-transform:uppercase; letter-spacing:0.6px; }
  .info-row .info-value { color:var(--mvv-text); font-weight:500; flex:1; }
  
  /* ── Gallery ── */
  .mvv-gallery-img { width:100%; height:170px; object-fit:cover; border:2px solid var(--mvv-accent); transition:all 0.3s ease; }
  .mvv-gallery-img:hover { transform:scale(1.04); border-color:var(--mvv-gold); box-shadow:0 8px 24px rgba(212,164,55,0.2); }
  
  /* ── Alert ── */
  .mvv-alert { padding:14px 20px; font-size:0.9rem; font-weight:600; margin-bottom:16px; display:flex; align-items:center; justify-content:space-between; border-left:4px solid var(--mvv-gold); background:var(--mvv-accent); color:var(--mvv-maroon-2); }
  .mvv-alert .close { background:none; border:none; font-size:1.3rem; cursor:pointer; color:inherit; opacity:0.6; padding:0; line-height:1; }
  .mvv-alert .close:hover { opacity:1; }
  
  /* ── Dropdown ── */
  .mvv-action-bar .dropdown-menu { border:1px solid var(--mvv-border); border-radius:12px; box-shadow:var(--mvv-shadow); padding:8px; margin-top:6px !important; }
  .mvv-action-bar .dropdown-menu .dropdown-item { border-radius:8px; padding:8px 14px; font-size:0.88rem; color:var(--mvv-text); transition:all 0.2s; }
  .mvv-action-bar .dropdown-menu .dropdown-item:hover { background:var(--mvv-accent); color:var(--mvv-maroon); }
  
  /* ── Modal ── */
  .modal-content { border-radius:16px; border:1px solid var(--mvv-border); box-shadow:var(--mvv-shadow); }
  .modal-header { background:linear-gradient(135deg, var(--mvv-maroon), var(--mvv-maroon-2)); color:var(--mvv-white); border-radius:16px 16px 0 0; padding:16px 20px; }
  
  /* ── Responsive ── */
  @media (max-width: 768px) { 
    .schedule-tabs .tab-buttons li.tab-btn { font-size:0.78rem !important; padding:7px 16px !important; border-radius:999px !important; }
    .info-row { flex-direction:column; padding:8px 0; } 
    .info-row .info-label { width:100%; margin-bottom:2px; } 
    .mvv-photo-card .photo-wrap img { width:140px; height:140px; } 
    .mvv-action-bar { flex-direction:column; align-items:stretch; }
    .mvv-action-bar .mvv-btn { text-align:center; }
  }
  @media (max-width: 480px) { 
    .mvv-profile-card .card-body { padding:14px 16px; } 
    .mvv-section { padding:24px 0 40px; }
  }
  .page-wrapper { overflow: visible !important; }
  .preloader { display: none !important; }
  nav.navbar { overflow: visible !important; }
  .mvv-profile-page .schedule-block {
    margin-bottom: 24px !important;
  }
  .mvv-profile-page .tabs-content,
  .mvv-profile-page .tabs-content .tab,
  .mvv-profile-page .schedule-timeline {
    width: 100%;
    clear: both;
  }
  .mvv-profile-page .tabs-content .tab.active-tab {
    display: block;
    min-height: 220px;
  }
  .mvv-profile-page #tab-4 .schedule-block,
  .mvv-profile-page #tab-4 .schedule-block .inner-box,
  .mvv-profile-page #tab-4 .schedule-block .inner {
    min-height: 180px;
  }
  .profile_footer {
    clear: both;
    display: block;
    width: 100vw;
    margin-left: calc(50% - 50vw);
    position: relative;
    z-index: 1;
  }
  /* Fix header dropdown clipped by myfullprofile.css top:-127px */
  .navbar-outer .dropdown-menu {
    top: 100% !important; left: 0 !important;
    position: absolute !important;
    z-index: 9999 !important;
  }
</style>
</head>
<body>
 <div class="page-wrapper">
 	
    <!-- Main Header-->
 <?php include('header.php')?>

    <!-- schedule Section -->
    <section class="mvv-section mvv-profile-page">
       <div class="mvv-container">
           <div class="schedule-tabs tabs-box mb-5">
                <div class="btns-box">
				
				<?php  
		$qry1=mysqli_query($con,"select * from notification where noti_sender='$login' AND noti_receiver='$search_id' and notification_type='Profile View'");
		 
		$row2=mysqli_fetch_array($qry1);
		$type=$row2['notification_type']; 
		    
			if(mysqli_num_rows($qry1)==0)
			{
			$profileid=$Follow['profile_id'];
			
			mysqli_query($con,"insert into notification(noti_sender,noti_receiver,notification_type,notification_desc,seen,date_time)values('$login','$search_id','Profile View','Viewed your profile','unseen',NOW())");
			
	        } 
	// check already viewed
		
	$profile_views=mysqli_query($con,"select * from profile_views where who='$login' AND whom='$idurl' ") or svr_db_fail($con);
		

	if(mysqli_num_rows($profile_views)==0)
	{
	// ----------------------add to profile views -------------------------------------------------
    $date = date('d-m-Y');
	mysqli_query($con,"insert into profile_views(who, whom,date)values('$login','$idurl','$date')");
	
	$na=mysqli_query($con,"select * from register where MatriID='".$_SESSION['matriid']."'");
	$na1=mysqli_fetch_array($na);
	$sql=mysqli_query($con,"select * from  register WHERE MatriID='$search_id'");
	$row=mysqli_fetch_array($sql);
	$nm=$row['Name'];
	$id=$row['MatriID'];
	$pass=$row['ConfirmPassword'];

	$sql2=mysqli_query($con,"select * from  register WHERE MatriID='$login'");
	$row1=mysqli_fetch_array($sql2);
	 $sendernm=explode(" ",$row1['Name']);
	$photo=$row1['photo1'];
	//$sendernm=$row1['Name'];
	$photo1=$row1['Photo1'];
	$age=$row1['Age'];
	//$height=$row1['Height'];
	$city=$row1['City'];
	//$height=$row1['Height'];
	//$reli=$row1['Religion'];
	$mother_tongue=$row1['mother_tounge'];
	$edu=$row1['Education'];
	$occu=$row1['Occupation'];
	$send=$row1['ConfirmEmail'];
	$encrypt_sender=base64_encode($login);		
	$height = get_height($row1['Height']);

	$emailsql=mysqli_query($con,"select * from  email_sending WHERE id='1'");
	$mailinfo =mysqli_fetch_array($emailsql);

	$websql=mysqli_query($con,"select * from siteconfig WHERE ID='1'");
	$webinfo=mysqli_fetch_array($websql);
	$logo =$webinfo['Weblogopath'];
		$site_name=$webinfo['Webname'];
		$webname=$webinfo['WebFriendlyname'];
		$dates=date('d-m-Y');
		$qry="select * from cms where cms_id='9'";
		$qry1=mysqli_query($con,$qry);
		$row3=mysqli_fetch_array($qry1);






		$check_email = mysqli_query($con,"SELECT * FROM emailverify where MatriID='$idurl' ");
		/*echo "SELECT * FROM emailverify where MatriID='$idurl'".'<br>';
		echo $on_off.'<br>';*/
		$fetch_email = mysqli_fetch_array($check_email);
		/*echo $fetch_email['verification'].'<br>';*/
		
		
		if( (int)$on_off === 1 && $fetch_email['verification'] == 'Yes' )
		{
			/*echo "1";*/
			
		include('smtp2.php');
		$mail->Subject="Profile view by someone ";
		$mail->Body="<!doctype html>
		<html>
		<head>
		<meta charset='utf-8'>
		<title>Profile view by someone</title>

		</head>

		<body>
		<table width='467' border='0' style='font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif' cellpadding='0' cellspacing='0'>
		  <tr>
			<td width='222'><img src='branding/images/logo-horizontal.png' width='250' height='74'  alt=''/></td>
			<td colspan='2' align='center' valign='middle'>Date: $dates</td>
		  </tr>
		  <tr>
			
		  </tr>
		  <tr>
		   
			<td colspan='3'>
			Dear  ".$nm." ,<br>
			Your Profile view by someone: ".$sendernm[0]." </td>
		  </tr>
		  <tr>
			
		  </tr>
		  <tr>
			<td><img src='https://www.weddingsparampara.com/gallary/".$row1['Photo1']."' width='250' height='64'  alt=''/></td>
			<td width='221' valign='top'><p>Name: ".$sendernm[0]."</p>
			<p>Age: $age Years</p>
			<p>Height: $height Inch</p>
			<p>City: $city</p>
			<p>Occupation: $occu</p>
			<p>Education: $edu </p>
		   </td>
			<td width='24'>&nbsp;</td>
		  </tr>
		  <tr>
			<td>ID:<a href='https://www.weddingsparampara.com/full_profile?id=".$login."'> ".$login." View Profile</a></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>
		</body>
		</html>
		";

		$mail->AddAddress($row['ConfirmEmail'], $row['Name']);

		if(!$mail->Send()) 
		{
		  //echo "Mailer Error: " . $mail->ErrorInfo;
		} else
		{
		//  echo "Message sent!";
		}

 
	} } ?>
     <?php include('notification.php')?>
				<?php if($_GET['msg']=='reqsend') { ?>
					<div class="mvv-alert success"><span>Contact request sent successfully.</span><button type="button" class="close" data-dismiss="alert">&times;</button></div>
				<?php } ?>
				<?php if($_GET['msg']=='success') { ?>
					<div class="mvv-alert success"><span>Profile Shortlisted</span><button type="button" class="close" data-dismiss="alert">&times;</button></div>
				<?php } ?>
				<?php if($_GET['msg']=='blocksuccess') { ?>
					<div class="mvv-alert success"><span>Profile Blocked</span><button type="button" class="close" data-dismiss="alert">&times;</button></div>
				<?php } ?>
				<?php if($_GET['msg']=='ignored') { ?>
					<div class="mvv-alert success"><span>Profile ignored</span><button type="button" class="close" data-dismiss="alert">&times;</button></div>
				<?php } ?>
				<?php if($_GET['msg']=='interestsuccess') { ?>
					<div class="mvv-alert success"><span>Interest sent successfully</span><button type="button" class="close" data-dismiss="alert">&times;</button></div>
				<?php } ?>
				<?php if($_GET['msg']=='contacten') { ?>
					<div class="mvv-alert success"><span>Interest Accepted successfully</span><button type="button" class="close" data-dismiss="alert">&times;</button></div>
				<?php } ?>
				<?php if($_GET['msg']=='acceptco') { ?>
					<div class="mvv-alert success"><span>Contact request accepted successfully</span><button type="button" class="close" data-dismiss="alert">&times;</button></div>
				<?php } ?>
				
                    <!--Tabs Box-->
                    <ul class="tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1" id="full_Profile">Full Profile</li>
						<li class="tab-btn" data-tab="#tab-2" id="send_Message">Send Message</li>
                        <li class="tab-btn" data-tab="#tab-3" id="contact_Details">Contact Detail</li>
                        <li class="tab-btn" data-tab="#tab-4" id="compatibilityTab">Compatibility</li>
						<li class="tab-btn" data-tab="#tab-5" id="profile_Match">Profile Match</li>
                    </ul>
                </div>                         
                <div class="tabs-content"><!--Tab-->
                    <div class="tab active-tab" id="tab-1">
						<?php $is_block = mysqli_query($con,"select * from block_member where matriid ='".$login."' AND profile_id = '".$search_id."' OR matriid='".$search_id."' and profile_id='".$login."'");
							$blocked = mysqli_num_rows($is_block);
							$is_ignore = mysqli_query($con,"select * from `ignore` where matriid ='".$login."' AND profile_id = '".$search_id."' OR matriid='".$search_id."' and profile_id='".$login."'");
							$ignorefetch = mysqli_num_rows($is_ignore);
						?>
						
						<!-- Photo & Action Bar -->
						<div class="row mb-4">
							<div class="col-lg-5 col-xl-4 mb-3 mb-lg-0">
								<div class="mvv-photo-card">
									<div class="photo-wrap">
									<?php
										$photoSrc = "images/nophoto.jpg";
										if($full_profile_fetch['photo_visibility']=="paidphoto" && $full_profile_fetch['Photo1Approve']=='Yes' && $me['Status']=='Paid' && $full_profile_fetch['Photo1']!='nophoto.jpg')
											$photoSrc = "photoprocess.php?image=gallary/".$full_profile_fetch['Photo1']."&square=500";
										elseif($full_profile_fetch['photo_visibility']=='allphoto' && $full_profile_fetch['Photo1Approve']=='Yes' && $full_profile_fetch['Photo1']!='nophoto.jpg')
											$photoSrc = "photoprocess.php?image=gallary/".$full_profile_fetch['Photo1']."&square=500";
									?>
										<img src="<?php echo $photoSrc; ?>" alt="Profile Photo" onerror="this.onerror=null;this.src='images/nophoto.jpg';">
										<span class="online-dot"></span>
									</div>
									<div class="member-name"><?php echo $full_profile_fetch['Name'] ?: "Member"; ?></div>
									<div class="member-meta"><?php echo htmlspecialchars(implode(', ', array_filter([$full_profile_fetch['City'] ?? '', $full_profile_fetch['Taluka'] ?? '', $full_profile_fetch['Dist'] ?? ''])), ENT_QUOTES, 'UTF-8'); ?><?php echo $full_profile_fetch['Age'] ? ", ".$full_profile_fetch['Age']." yrs" : ""; ?></div>
									<div class="member-id"><?php echo $full_profile_fetch['MatriID']; ?></div>
									<div class="partner-score-card">
										<div class="partner-score-head"><strong>Preferences Match</strong><span class="partner-score-percent"><?php echo $partnerScore['percentage']; ?>%</span></div>
										<div class="partner-score-bar"><span style="width:<?php echo $partnerScore['percentage']; ?>%"></span></div>
										<div class="partner-score-points"><?php foreach($partnerScore['points'] as $pointLabel=>$pointMatched){ ?><span class="<?php echo $pointMatched?'matched':'missing'; ?>"><?php echo $pointMatched?'✓':'✕'; ?> <?php echo htmlspecialchars($pointLabel); ?></span><?php } ?></div>
									</div>
								</div>
							</div>
							<div class="col-lg-7 col-xl-8 d-flex align-items-center">
								<div class="mvv-action-bar">
								<?php
									$interestaccept=mysqli_query($con,"select * from expressinterest where eisender='$search_id' and eireceiver='$login' and status='Accept'");
									$interestaccept_fetch=mysqli_fetch_array($interestaccept);
									$declinerequest=mysqli_query($con,"select * from expressinterest where eisender='$search_id' and eireceiver='$login' and status='Decline'");
									$declinerequest_fetch=mysqli_fetch_array($declinerequest);
									$notinterested=mysqli_query($con,"select * from expressinterest where eisender='$login' and eireceiver='$search_id' and status='No'");
									$notinterested_fetch=mysqli_fetch_array($notinterested);
									$notification=mysqli_query($con,"select * from expressinterest where eisender='$search_id' and eireceiver='$login' and status='Pending'");
									$notification_fetch=mysqli_fetch_array($notification);
									$is_already_send="SELECT * FROM expressinterest WHERE eisender= '$login' and eireceiver='$search_id'";
									$is_yes=mysqli_query($con,$is_already_send);
									$expressinterestfetch=mysqli_fetch_array($is_yes);
									
									$mvvPrimary = "background:linear-gradient(135deg,var(--mvv-gold),#F1D17A);color:var(--mvv-maroon-2);box-shadow:0 8px 24px rgba(212,164,55,0.3)";
									$mvvMaroon = "background:linear-gradient(135deg,var(--mvv-maroon),var(--mvv-maroon-2));color:#fff;box-shadow:0 8px 24px rgba(122,14,26,0.2)";
									$mvvGhost = "background:var(--mvv-white);color:var(--mvv-muted);border-color:var(--mvv-border)";
									
									if($expressinterestfetch['status']=='Pending') { ?>
										<a href="yes_connected?id=<?php echo $idurl?>"><button class="mvv-btn" style="<?php echo $mvvMaroon; ?>">Interest Sent</button></a>
									<?php } elseif($notification_fetch['status']=="Pending") { ?>
										<button class="mvv-btn" style="<?php echo $mvvGhost; ?>" disabled>Waiting</button>
									<?php } elseif($interestaccept_fetch['status']=="Accept" || $expressinterestfetch['status']=="Accept") { ?>
										<button class="mvv-btn" style="<?php echo $mvvMaroon; ?>" disabled>Accepted</button>
									<?php } elseif($declinerequest_fetch['status']=="Decline" || $expressinterestfetch['status']=="Decline") { ?>
										<button class="mvv-btn" style="<?php echo $mvvGhost; ?>" disabled>Declined</button>
									<?php } elseif($notinterested_fetch['status']=="No") { ?>
									<?php } else { ?>
										<span class="interest-label">Interested <?php if($full_profile_fetch['Gender']=='Female'){?>in Her?<?php }else{?>in Him?<?php }?></span>
										<a href="yes_connected?id=<?php echo $idurl?>"><button class="mvv-btn" style="<?php echo $mvvPrimary; ?>">Yes</button></a>
										<a href="no_connected?id=<?php echo $idurl?>"><button class="mvv-btn" style="<?php echo $mvvMaroon; ?>">No</button></a>
									<?php } ?>
									
									<div class="dropdown">
										<button class="mvv-btn" style="<?php echo $mvvGhost; ?>" data-bs-toggle="dropdown"><i class="fa fa-chevron-down"></i> More</button>
										<div class="dropdown-menu dropdown-menu-right">
											<?php $short=mysqli_query($con,"select * from shortlist_profile where mat_id='$login' AND profile_id='$search_id'");
											if(mysqli_num_rows($short)>0) { ?>
												<a class="dropdown-item" href="#">Profile Shortlisted</a>
											<?php } else { ?>
												<a class="dropdown-item" href="add_to_short_list?id=<?php echo $idurl?>">Shortlist Profile</a>
											<?php } ?>
											<?php if($ignorefetch>0){ ?>
												<a class="dropdown-item" href="ignored?id=<?php echo $idurl?>">Ignored</a>
											<?php } else { ?>
												<a class="dropdown-item" href="ignore?id=<?php echo $idurl?>">Ignore</a>
											<?php } ?>
											<?php if($blocked>0){ ?>
												<a class="dropdown-item" href="unblock_submit?id=<?php echo $idurl?>">Unblock</a>
											<?php } else { ?>
												<a class="dropdown-item" href="block_submit?id=<?php echo $idurl?>">Block</a>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Basic & Lifestyle Card -->
						<div class="mvv-profile-card">
							<div class="card-header"><img src="icon/basic.png" alt=""> Basic &amp; Lifestyle</div>
							<div class="card-body">
								<?php if($full_profile_fetch['profile_approve']=='Yes') { ?>
								<div class="info-row"><span class="info-label">About Me</span><span class="info-value"><?php echo substr($full_profile_fetch['aboutus'],0,80);?>.. <a href="#" data-bs-toggle="modal" data-bs-target="#myModal4" data-id="<?php echo $full_profile_fetch['MatriID'];?>" style="color:var(--gold);font-weight:600;">Read More</a></span></div>
								<?php } ?>
								<div class="info-row"><span class="info-label">Name</span><span class="info-value"><?php echo $full_profile_fetch['Name'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Matri ID</span><span class="info-value"><?php echo $full_profile_fetch['MatriID'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">DOB</span><span class="info-value"><?php $explodedate=explode("-",$full_profile_fetch['DOB']); $dob=$explodedate[2]."-".$explodedate[1]."-".$explodedate[0]; echo $dob ?: "Null"; ?> (Age: <?php $diff=date_diff(date_create($dob),date_create(date("Y-m-d"))); echo $diff->format('%y'); ?>)</span></div>
								<div class="info-row"><span class="info-label">Religion</span><span class="info-value"><?php echo $full_profile_fetch['Religion'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Caste / Subcaste</span><span class="info-value"><?php echo $full_profile_fetch['Caste'] ?: "Null"; ?> / <?php echo $full_profile_fetch['Subcaste'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Marital Status</span><span class="info-value"><?php echo $full_profile_fetch['Maritalstatus'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Working City</span><span class="info-value"><?php echo $full_profile_fetch['workinglocation'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Height / Weight</span><span class="info-value"><?php $h=str_replace("inch","''",str_replace("Ft","'",get_height($full_profile_fetch['Height']))); echo $h ?: "Null"; ?> / <?php echo $full_profile_fetch['Weight'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Body Type</span><span class="info-value"><?php echo $full_profile_fetch['Bodytype'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Complexion</span><span class="info-value"><?php echo $full_profile_fetch['Complexion'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Diet / Drink</span><span class="info-value"><?php echo $full_profile_fetch['Diet'] ?: "Null"; ?> / <?php echo $full_profile_fetch['Drink'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Blood Group</span><span class="info-value"><?php echo $full_profile_fetch['BloodGroup'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Spectacles</span><span class="info-value"><?php echo $full_profile_fetch['Spectacles'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Special Cases</span><span class="info-value"><?php echo $full_profile_fetch['spe_cases'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Special Reason</span><span class="info-value"><?php echo $full_profile_fetch['spe_reason'] ?: "Null"; ?></span></div>
							</div>
						</div>
						
						<!-- Education & Career Card -->
						<div class="mvv-profile-card">
							<div class="card-header"><img src="icon/education.png" alt=""> Education &amp; Career</div>
							<div class="card-body">
								<div class="info-row"><span class="info-label">Education</span><span class="info-value"><?php echo $full_profile_fetch['Education'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Occupation</span><span class="info-value"><?php echo $full_profile_fetch['Occupation'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">IIT/IIM/NIT</span><span class="info-value"><?php echo $full_profile_fetch['iit'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Institute</span><span class="info-value"><?php echo $full_profile_fetch['instu'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Annual Income</span><span class="info-value"><?php echo htmlspecialchars(annual_income_format($full_profile_fetch['Annualincome'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span></div>
								<div class="info-row"><span class="info-label">Other Income</span><span class="info-value"><?php echo $full_profile_fetch['anyotherincome'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Working Hours</span><span class="info-value"><?php echo $full_profile_fetch['working_hours'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Working Location</span><span class="info-value"><?php echo $full_profile_fetch['workinglocation'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Working Taluka</span><span class="info-value"><?php echo $full_profile_fetch['working_taluka'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Education Details</span><span class="info-value"><?php echo $full_profile_fetch['EducationDetails'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Occupation Details</span><span class="info-value"><?php echo $full_profile_fetch['occu_details'] ?: "Null"; ?></span></div>
							</div>
						</div>
						
						<!-- Family Details Card -->
						<div class="mvv-profile-card">
							<div class="card-header"><img src="icon/family.png" alt=""> Family Details</div>
							<div class="card-body">
								<div class="info-row"><span class="info-label">Family Values</span><span class="info-value"><?php echo $full_profile_fetch['Familyvalues'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Family Status</span><span class="info-value"><?php echo $full_profile_fetch['FamilyStatus'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Family Type</span><span class="info-value"><?php echo $full_profile_fetch['FamilyType'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Mother Tongue</span><span class="info-value"><?php echo $full_profile_fetch['mother_tounge'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Brothers</span><span class="info-value"><?php echo $full_profile_fetch['noofbrothers'] ?: "0"; ?> (Married: <?php echo $full_profile_fetch['nbm'] ?: "0"; ?>)</span></div>
								<div class="info-row"><span class="info-label">Sisters</span><span class="info-value"><?php echo $full_profile_fetch['noofsisters'] ?: "0"; ?> (Married: <?php echo $full_profile_fetch['nsm'] ?: "0"; ?>)</span></div>
								<div class="info-row"><span class="info-label">Father</span><span class="info-value"><?php echo $full_profile_fetch['Fathername'] ?: "Null"; ?> (<?php echo $full_profile_fetch['Fathersoccupation'] ?: "Null"; ?>)</span></div>
								<div class="info-row"><span class="info-label">Mother</span><span class="info-value"><?php echo $full_profile_fetch['Mothersname'] ?: "Null"; ?> (<?php echo $full_profile_fetch['Mothersoccupation'] ?: "Null"; ?>)</span></div>
								<div class="info-row"><span class="info-label">Family Wealth</span><span class="info-value"><?php echo $full_profile_fetch['family_wealth'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Relative Info</span><span class="info-value"><?php echo $full_profile_fetch['relatives'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">About Family</span><span class="info-value"><?php echo $full_profile_fetch['FamilyDetails'] ?: "Null"; ?></span></div>
							</div>
						</div>
						
						<!-- Horoscope Details Card -->
						<div class="mvv-profile-card">
							<div class="card-header"><img src="icon/horocope.png" alt=""> Horoscope Details</div>
							<div class="card-body">
								<div class="info-row"><span class="info-label">Moonsign</span><span class="info-value"><?php echo $full_profile_fetch['Moonsign'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Manglik</span><span class="info-value"><?php echo $full_profile_fetch['Manglik'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Horoscope Match</span><span class="info-value"><?php echo $full_profile_fetch['Horosmatch'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Star / Gotra</span><span class="info-value"><?php echo $full_profile_fetch['Star'] ?: "Null"; ?> / <?php echo $full_profile_fetch['Gothram'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Charan / Nadi</span><span class="info-value"><?php echo $full_profile_fetch['charan'] ?: "Null"; ?> / <?php echo $full_profile_fetch['nadi'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Devak</span><span class="info-value"><?php echo $full_profile_fetch['devak'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Gan</span><span class="info-value"><?php echo $full_profile_fetch['Gan'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Birth Date / Time</span><span class="info-value"><?php echo $full_profile_fetch['DOB'] ?: "Null"; ?> / <?php echo $full_profile_fetch['TOB'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Place of Birth</span><span class="info-value"><?php echo $full_profile_fetch['POB'] ?: "Null"; ?></span></div>
								<div class="info-row"><span class="info-label">Country</span><span class="info-value"><?php echo $full_profile_fetch['POC'] ?: "Null"; ?></span></div>
							</div>
						</div>
						
						<?php $queryG = mysqli_query($con,"SELECT * from gallary where matri_id='$idurl' order by photo_id desc");
						if(mysqli_num_rows($queryG) > 0) { ?>
						<!-- Gallery -->
						<div class="mvv-profile-card">
							<div class="card-header"><img src="icon/heart.png" alt=""> Photo Gallery</div>
							<div class="card-body">
								<div class="row">
								<?php while($photo=mysqli_fetch_array($queryG)){ ?>
									<div class="col-lg-3 col-md-4 col-sm-6 mb-3">
										<a href="gallary/<?php echo $photo['photo_name'];?>" data-fancybox='gallery'>
											<img src="gallary/<?php echo $photo['photo_name'];?>" class="mvv-gallery-img" onerror="this.onerror=null;this.src='images/nophoto.jpg';">
										</a>
									</div>
								<?php } ?>
								</div>
							</div>
						</div>
						<?php } ?>
						
                    </div>
					 <!--Tab-->
					
					<?php include('sendmessage.php');?>
					<!--Tab-->
					<?php include('get_contactdetails.php')?>
					<?php include('compabilityfull.php')?>
					<?php include('partnermatches.php')?>

				</div>	
            </div>
          </div>
		</div>
 
    </section>
    <!--End schedule Section -->

<section style="padding:20px 0;text-align:center;border-top:1px solid var(--border);">
    <div class="mvv-container">
        <a href="disclaimer" target="_blank" style="color:var(--text-muted);font-size:0.85rem;text-decoration:underline;margin:0 8px;">Disclaimer</a>
        <span style="color:var(--border);">|</span>
        <a href="safematrimony" target="_blank" style="color:var(--text-muted);font-size:0.85rem;text-decoration:underline;margin:0 8px;">Safe-Matrimony</a>
    </div>
</section>
    
    
 
 
 
 <div class="profile_footer">
<?php include('footer.php')?>
</div>
    <!-- End Footer -->


<?php 
function get_height($strheight)
{
	if($strheight =="1") { return "4Ft"; }
	else if($strheight =="") { return "Null"; }
	else if($strheight =="2") { return "4Ft 1''"; }
	else if($strheight =="3") { return "4Ft 2''"; }
	else if($strheight =="4") { return "4Ft 3''"; }
	else if($strheight =="5") { return "4Ft 4''"; }
	else if($strheight =="6") { return "4Ft 5''"; }
	else if($strheight =="7") { return "4Ft 6''"; }
	else if($strheight =="8") { return "4Ft 7''"; }
	else if($strheight =="9") { return "4Ft 8''"; }
	else if($strheight =="10") { return "4Ft 9''"; }
	else if($strheight =="11") { return "4Ft 10''"; }
	else if($strheight =="12") { return "4Ft 11''"; }
	else if($strheight =="13") { return "5Ft"; }
	else if($strheight =="14") { return "5Ft 1''"; }
	else if($strheight =="15") { return "5Ft 2''"; }
	else if($strheight =="16") { return "5Ft 3''"; }
	else if($strheight =="17") { return "5Ft 4''"; }
	else if($strheight =="18") { return "5Ft 5''"; }
	else if($strheight =="19") { return "5Ft 6''"; }
	else if($strheight =="20") { return "5Ft 7''"; }
	else if($strheight =="21") { return "5Ft 8''"; }
	else if($strheight =="22") { return "5Ft 9''"; }
	else if($strheight =="23") { return "5Ft 10''"; }
	else if($strheight =="24") { return "5Ft 11''"; }
	else if($strheight =="25") { return "6Ft"; }
	else if($strheight =="26") { return "6Ft 1''"; }
	else if($strheight =="27") { return "6Ft 2''"; }
	else if($strheight =="28") { return "6Ft 3''"; }
	else if($strheight =="29") { return "6Ft 4''"; }
	else if($strheight =="30") { return "6Ft 5''"; }
	else if($strheight =="31") { return "6Ft 6''"; }
	else if($strheight =="32") { return "6Ft 7''"; }
	else if($strheight =="33") { return "6Ft 8''"; }
	else if($strheight =="34") { return "6Ft 9''"; }
	else if($strheight =="35") { return "6Ft 10''"; }
	else if($strheight =="36") { return "6Ft 11''"; }
	else if($strheight =="37") { return "7Ft"; }
	return "Null";
}
?>
<!--Scroll to top-->
<script src="js/jquery.js"></script>
<script src="js/jquery.fancybox.js"></script>

<script>
$(document).ready(function() {
  $('.btn').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="fa fa-spinner fa-spin fas"></i><span class="btn-title">Loading</span> ';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 500);
  });
})
</script>
<div class="modal fade" id="myModal4">
    <div class="modal-dialog">
      <div class="modal-content"></div>
    </div>
  </div>
<script>
$(document).ready(function(){
    $('#myModal4').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'about_profile.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});

</script>
</body>
</html>
