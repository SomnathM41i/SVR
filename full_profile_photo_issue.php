<?php include_once('sys_dbconnection.php');?>
<?php include_once('memprotect.php');
require_once('includes/annual_income.php');
//include_once('siteconfig.php');
include_once('dbconnectadmin.php');
$idurl=base64_decode( urldecode($_GET['id']) );
$bann=mysqli_query($con,"select * from register where MatriID='$idurl'");
$ban=mysqli_fetch_array($bann);
$baned=$ban['Status'];
if($baned == "Banned")
{
	header("location:banprofile.php");
} 

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
$me=mysqli_fetch_array($fetchphoto);
//$search_id = $id;?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Full Profile</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/stylenew.css" rel="stylesheet">

<link href="css/fullprofile.css" rel="stylesheet">

<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">
<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/manpasand-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/manpasand-logo.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

</head>

<body>

<div class="page-wrapper">
 	
    <!-- Preloader 
    <div class="preloader"></div>-->
 	<!-- Header span -->

    <!-- Header Span -->
    <span class="header-span"></span>
	
    <!-- Main Header-->
 <?php include('header.php')?>

    <!--End Main Header -->

    <!--Page Title-->
  
    <!--End Page Title-->
	
    <!-- schedule Section -->
    <section class="schedule-section">
	
        <div class="anim-icons">
		
            <span class="icon icon-circle-4 wow zoomIn"></span>
			
            <span class="icon icon-circle-3 wow zoomIn"></span>
			
        </div>

        <div class="auto-container">
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
		
	$profile_views=mysqli_query($con,"select * from profile_views where who='$login' AND whom='$idurl' ") or die(mysql_error());
		

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


	$emailsql=mysqli_query($con,"select * from  email_sending WHERE id='1' ");
	$mailinfo =mysqli_fetch_array($emailsql);

	$websql=mysqli_query($con,"select * from siteconfig WHERE ID='1' ");
	$webinfo=mysqli_fetch_array($websql);
	$logo =$webinfo['Weblogopath'];
		$site_name=$webinfo['Webname'];
		$webname=$webinfo['WebFriendlyname'];
		$dates=date('d-m-Y');
		$qry="select * from cms where cms_id='9'";
		$qry1=mysqli_query($con,$qry);
		$row3=mysqli_fetch_array($qry1);
    
	                                $strheight = $row1['Height'];
									if($strheight =="1") { $height= "4ft"; }
									else if($strheight =="") { $height= "Null"; }
									else if($strheight =="2") { $height= "4Ft 1 inch"; }
									else if($strheight =="3") { $height= "4Ft 2 inch"; }
									else if($strheight =="4") { $height= "4Ft 3 inch"; }
									else if($strheight =="5") { $height= "4Ft 4 inch"; }
									else if($strheight =="6") { $height= "4Ft 5 inch"; }
									else if($strheight =="7") { $height= "4Ft 6 inch"; }
									else if($strheight =="8") { $height= "4Ft 7 inch"; }
									else if($strheight =="9") { $height= "4Ft 8 inch"; }
									else if($strheight =="10") { $height= "4Ft 9 inch"; }
									else if($strheight =="11") { $height= "4Ft 10 inch"; }
									else if($strheight =="12") { $height= "4Ft 11 inch"; }
									else if($strheight =="13") { $height= "5Ft"; }
									else if($strheight =="14") { $height= "5Ft 1 inch"; }
									else if($strheight =="15") { $height= "5Ft 2 inch"; }
									else if($strheight =="16") { $height= "5Ft 3 inch"; }
									else if($strheight =="17") { $height= "5Ft 4 inch"; }
									else if($strheight =="18") { $height= "5Ft 5 inch"; }
									else if($strheight =="19") { $height= "5Ft 6 inch"; }
									else if($strheight =="20") { $height= "5Ft 7 inch"; }
									else if($strheight =="21") { $height= "5Ft 8 inch"; }
									else if($strheight =="22") { $height= "5Ft 9 inch"; }
									else if($strheight =="23") { $height= "5Ft 10 inch"; }
									else if($strheight =="24") { $height= "5Ft 11 inch"; }
									else if($strheight =="25") { $height= "6Ft"; }
									else if($strheight =="26") { $height= "6Ft 1 inch "; }
									else if($strheight =="27") { $height= "6Ft 2 inch"; }
									else if($strheight =="28") { $height= "6Ft 3 inch"; }
									else if($strheight =="29") { $height= "6Ft 4 inch"; }
									else if($strheight =="30") { $height= "6Ft 5 inch"; }
									else if($strheight =="31") { $height= "6Ft 6 inch"; }
									else if($strheight =="32") { $height= "6Ft 7 inch"; }
									else if($strheight =="33") { $height= "6Ft 8 inch"; }
									else if($strheight =="34") { $height= "6Ft 9 inch"; }
									else if($strheight =="35") { $height= "6Ft 10 inch"; }
									else if($strheight =="36") { $height= "6Ft 11 inch"; }
									else if($strheight =="37") { $height= "7Ft"; }
			
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
			<td width='222'><img src='http://localhost/SVR/css3/assets/manpasand-logo.png' width='168' height='50'  alt=''/></td>
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
			<td><img src='https://www.weddingsparampara.com/gallary/".$row1['Photo1']."' width='209' height='232'  alt=''/></td>
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

 
	} ?>
     <?php include('notification.php')?>
				<?php if($_GET['msg']=='reqsend')
			 { ?>
		               <div class="alert alert-info" align="center" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <?php set_time_limit(10);
								   echo " Contact request send successfully. ";?>
						</div>
	   
	        	<?php } ?>
				
				<?php if($_GET['msg']=='success')
			{ ?>
		               <div class="alert alert-info" align="center" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <?php set_time_limit(10);
								   echo " Profile Shortlisted ";?>
						</div>
	   
	        	<?php } ?>
				<?php if($_GET['msg']=='blocksuccess')
				{ ?>
		               <div class="alert alert-info" align="center" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <?php set_time_limit(10);
								   echo " Profile Blocked ";?>
						</div>
	   
	        	<?php } ?>
				<?php if($_GET['msg']=='ignored')
					{ ?>
		               <div class="alert alert-info" align="center" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <?php set_time_limit(10);
								   echo "  Profile ignored ";?>
						</div>
	   
	        	<?php } ?>
				<?php if($_GET['msg']=='interestsuccess') { ?>
		               <div class="alert alert-info" align="center" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <?php set_time_limit(10);
								   echo "  Interest send successfully ";?>
						</div>
	   
	        	<?php } ?>
				<?php if($_GET['msg']=='contacten') { ?>
		               <div class="alert alert-info" align="center" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <?php set_time_limit(10);
								   echo "  Interest Accepted successfully ";?>
						</div>
	   
	        	<?php } ?>
				<?php if($_GET['msg']=='acceptco') { ?>
		               <div class="alert alert-info" align="center" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <?php set_time_limit(10);
								   echo "Contact request accepted successfully ";?>
						</div>
	   
	        	<?php } ?>
				
                    <!--Tabs Box-->
                    <ul class="tab-buttons mobtab clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1">
                            <span class="day">Full Profile</span>
							<span class="image1"><img src="icon/fullprofileicon.png" ></span>
							
                        </li>
								
						<li class="tab-btn " data-tab="#tab-2">
                            <span class="day">Send Message</span>
                            <span class="image1"><img src="icon/msg.png"></span>
                        </li>

                        <li class="tab-btn" data-tab="#tab-3">
                            <span class="day">Contact Details</span>
                           <span class="image1"><img src="icon/connect.png"></span>
                        </li>

                        <li class="tab-btn" data-tab="#tab-4">
                            <span class="day">Compatibility</span>
                            <span class="image1"><img src="icon/compatibility.png"></span>
                        </li>
						 <li class="tab-btn" data-tab="#tab-5">
                            <span class="day">Profile Match</span>
                              <span class="image1"><img src="icon/matches.png"></span>
                        </li>
                    </ul>
                </div>                         
                <div class="tabs-content"><!--Tab-->
                    <div class="tab active-tab" id="tab-1">
                        <div class="schedule-timeline">
                            <!-- schedule Block -->
                            <div class="schedule-block">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date"><figure class="thumb"><img src="icon/basic.png" alt=""></figure></div>
                                        <div class="speaker-info1">
                                            <h5 class="name">Basic Details</h5>
                                            <span class="designation">Last Updated on <?php $formedu1 = date('d F Y', strtotime($full_profile_fetch['edudate'])); echo $formedu1;?></span>
                                        </div>
                                         <div class="text" >
										   <aside class="sidebar1">
                                          <div class="sidebar1-widget popular-tags1">
										  <?php if($full_profile_fetch['profile_approve']=='Yes') { ?>
										    About Me-<?php echo substr($full_profile_fetch['aboutus'],0,30);?> ..<a href="#" data-toggle="modal" data-target="#myModal4" data-id="<?php echo $full_profile_fetch['MatriID'];?>" >Read More </a><br>
											<?php }?>
											Name -<a href="#"><?php $explodename=explode(" ",$full_profile_fetch['Name']);if($explodename!=""){echo $explodename[0];}else{ echo"Null"; }?> <?php echo $full_profile_fetch['MatriID'];?></a> 
											DOB -<a href="#"> <?php $explodedate=explode("-",$full_profile_fetch['DOB']);
											$explodedatedisplay=$explodedate[2]."-".$explodedate[1]."-".$explodedate[0];if($explodedatedisplay!=""){echo $explodedatedisplay;}else{echo"Null";}?>
											<?php $dateOfBirth = $explodedatedisplay;$today = date("Y-m-d");
											$diff = date_diff(date_create($dateOfBirth), date_create($today));?></a>
											
											Age -<a href="#"><?php echo $diff->format('%y'); ?> </a> 
											
											Religion In - <a href="#"><?php if($full_profile_fetch['Religion']!=""){echo $full_profile_fetch['Religion'];}else{ echo"Null";}?> </a>
											
											Caste - <a href="#"><?php if($full_profile_fetch['Caste']!=""){echo $full_profile_fetch['Caste'];}else{ echo"Null";}?> </a> 
											Working city  -<a href="#"> <?php if($full_profile_fetch['workinglocation']!=""){echo $full_profile_fetch['workinglocation'];}else{ echo"Null"; }?> </a>
											
											Status - <a href="#"><?php if($full_profile_fetch['Maritalstatus']!=""){echo $full_profile_fetch['Maritalstatus'];}else{ echo"Null";}?> </a>
											 <?php if($full_profile_fetch['profile_approve']=="Yes"){ ?>
											
											  <?php } ?>
											Subcaste - <a href="#"><?php if($full_profile_fetch['Subcaste']!=""){echo $full_profile_fetch['Subcaste'];}else{ echo"Null";}?></a>
											
											Height - <a href="#"><?php                                       
												$strheight = $full_profile_fetch['Height'];
											   if($strheight =="1") { echo "4Ft "; }
											   else if($strheight =="") { echo "Null"; }
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
											   else if($strheight =="37") { echo "7Ft "; } ?></a>
											 
											  Complexion -<a href="#"> <?php if($full_profile_fetch['Complexion']!=""){ echo $full_profile_fetch['Complexion']; }else { echo "Null";}?> </a>
											  Weight - <a href="#"> <?php if($full_profile_fetch['Weight']!=""){echo $full_profile_fetch['Weight'];}else { echo "Null";}?> </a> 
											  Blood Group -<a href="#"> <?php if($full_profile_fetch['BloodGroup']!=""){ echo $full_profile_fetch['BloodGroup'];}else { echo "Null";}?> </a>
											  Special Cases-<a href="#"> <?php if($full_profile_fetch['spe_cases']!=""){echo $full_profile_fetch['spe_cases'];}else{ echo"Null"; }?></a>
											  Special Reason-<a href="#">  <?php if($full_profile_fetch['spe_reason']!=""){echo $full_profile_fetch['spe_reason'] ;}else{ echo"Null";}?></a><br>
											 
											</div>
		                                </div>
                                      </aside>
                                       
                                    </div>
                                </div>
                            </div>

                             <!-- schedule Block -->
							    
								<?php $is_block = mysqli_query($con,"select * from block_member where matriid ='".$login."' AND profile_id = '".$search_id."' OR matriid='".$search_id."' and profile_id='".$login."'");
									$blocked = mysqli_num_rows($is_block);

									$is_ignore = mysqli_query($con,"select * from `ignore` where matriid ='".$login."' AND profile_id = '".$search_id."' OR matriid='".$search_id."' and profile_id='".$login."'");
									$ignorefetch = mysqli_num_rows($is_ignore);
									//echo "select * from `ignore` where matriid ='".$login."' AND profile_id = '".$search_id."' OR matriid='".$search_id."' and profile_id='".$login."'";
							   ?>
						 <?php	// echo "SELECT * from gallary where matri_id='$id'";?>	   
					<div class="col-md-12">
					<div class="row">
					
					 <?php
							//paid member photo 
							 if($full_profile_fetch['photo_visibility']=="paidphoto") { ?>
									   
								   <?php if($full_profile_fetch['Photo1Approve']=='Yes'&& $me['Status']=='Paid'){ 
									if($full_profile_fetch['Photo1']!='nophoto.jpg' ) { ?>			
								 <div class="gallery-item col-lg-4 col-md-6 col-sm-12 wow fadeIn">
							   <div class="image-box ">
								<figure class="image">
									
								<img src="photoprocess.php?image=gallary/<?php echo $full_profile_fetch['Photo1'];?>&square=500" alt="" class="img-thumbnail rounded-circle imgfull "></figure>
								<?php /*$query =mysqli_query($con,"SELECT * from gallary where matri_id='$id' order by photo_id desc");?>
								<?php while($photo=mysqli_fetch_array($query)){*/?>
								 <div class="overlay-box">
								<a href="gallary/<?php echo $full_profile_fetch['Photo1'];?>" class="lightbox-image" data-fancybox='gallery'>
								<span class="icon fa fa-expand-arrows-alt"></span></a>
								</div>
								<?php //} ?>
						
					              </div>
                                </div>
								 <?php  } else   {   ?>
								<div class="gallery-item col-lg-4 col-md-6 col-sm-12 wow fadeIn">
							   <div class="image-box ">
								<figure class="image">
									<?php echo "2"; ?>
								<img src="blur.php?image=gallary/<?php echo $full_profile_fetch['Photo1'];?>" class="img-thumbnail rounded-circle imgfull">  </figure>
								</div>
								</div>
							<?php } } else { ?>
								<div class="gallery-item col-lg-4 col-md-6 col-sm-12 wow fadeIn">
							   <div class="image-box ">
								<figure class="image">
									<?php echo "3"; ?>
								<img src="blur.php?image=gallary/<?php echo $full_profile_fetch['Photo1'];?>" class="img-thumbnail rounded-circle imgfull">  </figure>
								</div>
								</div>
										 
							<?php  } }  elseif($full_profile_fetch['photo_visibility']=='allphoto' && $full_profile_fetch['Photo1Approve']=='Yes' ) 
								{ 
									if($full_profile_fetch['Photo1']!='nophoto.jpg' )
									{

							?>
										
								<div class="gallery-item col-lg-4 col-md-6 col-sm-12 wow fadeIn">
							   <div class="image-box ">
								<figure class="image">
									<?php //echo "4"; ?>
								<img src="photoprocess.php?image=gallary/<?php echo $full_profile_fetch['Photo1'];?>&square=500" alt="" class="img-thumbnail rounded-circle imgfull "></figure>
								<?php /*$query =mysqli_query($con,"SELECT * from gallary where matri_id='$id' order by photo_id desc");?>
								<?php while($photo=mysqli_fetch_array($query)){*/?>
								 <div class="overlay-box">
								<a href="gallary/<?php echo $full_profile_fetch['Photo1'];?>" class="lightbox-image" data-fancybox='gallery'>
								
								<span class="icon fa fa-expand-arrows-alt"></span></a>
								</div>
								<?php //} ?>
						
					              </div>
                                </div>
								<?php 
										}
										else
										{
								?>
									<div class="gallery-item col-lg-4 col-md-6 col-sm-12 wow fadeIn">
							   <div class="image-box ">
								<figure class="image">
								<?php echo "5"; ?>
								<img src="gallary/<?php echo $full_profile_fetch['Photo1'];?>" alt="" class="img-thumbnail rounded-circle imgfull "></figure>
								<?php $query =mysqli_query($con,"SELECT * from gallary where matri_id='$id' order by photo_id desc");?>
								<?php while($photo=mysqli_fetch_array($query)){?>
								 <div class="overlay-box">
								<a href="gallary/<?php echo $photo['photo_name'];?>" class="lightbox-image" data-fancybox='gallery'>
								
								<span class="icon fa fa-expand-arrows-alt"></span></a>
								</div>
								<?php } ?>
						
					              </div>
                                </div>

								<?php
										}
									} 
									else 
									{ 
								?>
											 		
								<div class="gallery-item col-lg-4 col-md-6 col-sm-12 wow fadeIn">
							   <div class="image-box ">
								<figure class="image">
								<img src="images/nophoto.jpg"  class="img-thumbnail rounded-circle imgfull"> </figure>
								</div>
								</div>
							<?php } ?>
						</a>
							 
			  <?php $interestaccept=mysqli_query($con,"select * from expressinterest where eisender='$search_id' and eireceiver='$login' and status='Accept'");
				  $interestaccept_fetch=mysqli_fetch_array($interestaccept);
				  $declinerequest=mysqli_query($con,"select * from expressinterest where eisender='$search_id' and eireceiver='$login' and status='Decline'");
				  $declinerequest_fetch=mysqli_fetch_array($declinerequest);
				  $notinterested=mysqli_query($con,"select * from expressinterest where eisender='$login' and eireceiver='$search_id' and status='No'");
				  $notinterested_fetch=mysqli_fetch_array($notinterested);
				  $notification=mysqli_query($con,"select * from expressinterest where eisender='$search_id' and eireceiver='$login' and status='Pending'");
                  $notification_fetch=mysqli_fetch_array($notification);				
				  $is_already_send="SELECT * FROM expressinterest  WHERE eisender= '$login' and eireceiver='$search_id'";
				  $is_yes=mysqli_query($con,$is_already_send);	
				  $expressinterestfetch=mysqli_fetch_array($is_yes);	
				  if($expressinterestfetch['status']=='Pending') { ?>
					<div class="col-md-3 imgmiddle mr-3">
					<br>					
			   <a href="yes_connected?id=<?php echo $idurl?>"><button type="button" class="btn btn-success btns ">Interest Sent</button> </a>
					</div>
				<?php  }
				 elseif($notification_fetch['status']=="Pending"){?>
				<div class="col-md-3 imgmiddle">
                <br>
				<button type="button" class="btn btn btn-success bts "> Waiting</button> 
				</div>
				<?php  }
				  elseif($interestaccept_fetch['status']=="Accept"){?>
				<div class="col-md-3 imgmiddle">
                <br>
				<button type="button" class="btn btn btn-success bts "> Accept</button> 
				</div>	
                 <?php  }
			    elseif($declinerequest_fetch['status']=="Decline"){ ?>
				<div class="col-md-3 imgmiddle">
                <br>
				<button type="button" class="btn  btn  btn-success bts "> Decline</button> 
				</div>	
                 <?php  }
				elseif($expressinterestfetch['status']=="Accept")
				{?>
				<div class="col-md-3 imgmiddle">
                <br>
				<button type="button" class="btn btn btn-success bts "> Accepted</button> 
				</div>	
                <?php  }
				elseif($expressinterestfetch['status']=="Decline")
				{?>
				<div class="col-md-3 imgmiddle">
                <br>
				<button type="button" class="btn btn btn-success bts "> Decline</button> 
				</div>	 
                 <?php  }
				elseif($notinterested_fetch['status']=="No") { ?>
				
				<div class="col-md-3 imgmiddle mr-3">
					<span class="txt">Resend Interest</span><br>

				<a href="resend_interest?id=<?php  echo $idurl ?>"><button type="button" class="btn btn-success "> Resend </button> </a>				

				 </div>	   				
				<?php } else { ?>
					<div class="col-md-3 imgmiddle mr-3">

					<span class="txt">Interested  <?php if($full_profile_fetch['Gender']=='Female'){?>Her?<?php }else{?>His?<?php }?></span><br>
					<a href="yes_connected?id=<?php echo $idurl?>"><button type="button" class="btn btn btn-success btnn ">Yes</button> </a>
					<a href="no_connected?id=<?php  echo $idurl?>"><button type="button" class="btn btn btn-warning ">No</button></a>
					</div>
				<?php } ?>
				   <div class="col-md-1  ">
						<div class="navigation ">
						<nav class="navbar">
						<button type="button" class="btnss btn-info imgsm " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  ><i class="fa fa-chevron-down " style="content:#f078;color: #ffa600;" aria-hidden="true"></i>
						</button> 
		          <div class="dropdown-menu dropdownimg ">
					<?php  $short=mysqli_query($con,"select * from shortlist_profile where mat_id='$login' AND profile_id='$search_id'")or die(mysqli_error());
					if(mysqli_num_rows($short)>0) { ?>				  
                    <a class="dropdown-item" href="#"> Profile Shortlisted</a>	
				    <?php } else  { ?>
					<a class="dropdown-item" href="add_to_short_list?id=<?php echo $idurl?>">Shortlist Profile</a>	
                    <?php }?>
					<?php  if($ignorefetch>0){?>
					<a class="dropdown-item" href="ignored?id=<?php echo $idurl?>">Ignored	</a>
					<?php } else { ?>
					<a class="dropdown-item" href="ignore?id=<?php echo $idurl?>">Ignore </a>
					<?php } ?>
					<?php if($blocked>0){ ?>
					<a class="dropdown-item" href="unblock_submit?id=<?php echo $idurl?>">Unblock</a>
					<?php } else {?>			
					 <a class="dropdown-item" href="block_submit?id=<?php echo $idurl?>">Block</a>
					<?php } ?>
				 </div>
				</nav>
			  </div>
			 </div>
                 </div>
           </div>								  
			
		 			    <div class="schedule-block even">
                                <div class="inner-box edus">
                                    <div class="inner edu" >
                                        <div class="date"><figure class="thumb"><img src="icon/education.png" alt=""></figure> </div>
                                        <div class="speaker-info1">
                                            
                                            <h5 class="name">Education  Detail</h5>
                                            <span class="designation">Last Updated on <?php $formedu = date('d F Y', strtotime($full_profile_fetch['edudate']));echo $formedu;?></span>
                                        
										</div>
                                        <div class="text">
										 <aside class="sidebar2">
                                          <div class="sidebar2-widget popular-tags2">
											Education -<a href="#"><?php if($full_profile_fetch['Education']!=""){ echo $full_profile_fetch['Education']; } else { echo "Null"; }?></a> 
											Occupation -<a href="#"><?php if($full_profile_fetch['Occupation']!=""){ echo $full_profile_fetch['Occupation'];}else{ echo "Null"; }?> </a> 
											Employed In -<a href="#"><?php if($full_profile_fetch['Education']!=""){echo $full_profile_fetch['Education'];}else{ echo "Null" ;}?> </a>
											Annual Income - <a href="#"><?php echo htmlspecialchars(annual_income_format($full_profile_fetch['Annualincome'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></a> 
											Working Hours -<a href="#"><?php if($full_profile_fetch['working_hours']!=""){ echo $full_profile_fetch['working_hours'];}else{ echo "Null"; } ?> </a>
											Working Location/City-<a href="#"> <?php if($full_profile_fetch['workinglocation']!=""){ echo $full_profile_fetch['workinglocation'];}else{ echo "Null"; }?> </a>
											Eduction Details -<a href="#"><?php if($full_profile_fetch['EducationDetails']!=""){echo $full_profile_fetch['EducationDetails']; }else{ echo "Null"; }?></a>
											Occupation Details-<a href="#"><?php if($full_profile_fetch['occu_details']!=""){ echo $full_profile_fetch['occu_details'];}else{ echo "Null"; }?></a>
									
										  </div>
		                                 </div>
                                      </aside>
                                        
                                    </div>
                                </div>
                            </div>


                             <!-- schedule Block -->
                            <div class="schedule-block">
                                <div class="inner-box">
                                    <div class="inner" style="margin-top:44px;">
                                        <div class="date"><figure class="thumb"><img src="icon/family.png" alt=""></figure></div>
                                        <div class="speaker-info1">
                                            <h5 class="name">Family Details</h5>
                                            <span class="designation">Last Updated on <?php $formfam = date('d F Y', strtotime($full_profile_fetch['famdate']));echo $formfam;?></span>
                                        </div>
                                        <div class="text">
										<aside class="sidebar4">  
                                          <div class="sidebar4-widget popular-tags4">
											Family Values -<a href="#"> <?php if($full_profile_fetch['Familyvalues']!=""){echo $full_profile_fetch['Familyvalues'];}else{ echo"Null";} ?></a> 
											Family Status -<a href="#"> <?php if($full_profile_fetch['FamilyStatus']!=""){echo $full_profile_fetch['FamilyStatus'];}else{echo"Null";}?></a> 
											Family Type -<a href="#"> <?php if($full_profile_fetch['FamilyType']!=""){echo $full_profile_fetch['FamilyType'];}else{ echo"Null";}?> </a>
											Mother Tounge - <a href="#"> <?php if($full_profile_fetch['mother_tounge']!=""){echo $full_profile_fetch['mother_tounge'];}else{ echo"Null";}?> </a> 
											No. of Brothers -<a href="#">  <?php if($full_profile_fetch['noofbrothers']!=""){echo $full_profile_fetch['noofbrothers'];}else{ echo"Null"; }?> </a>
											No. of Brothers Married -<a href="#"> <?php if($full_profile_fetch['nbm']!=""){echo $full_profile_fetch['nbm'] ;}else{ echo"Null";}?></a>
											No. of Sister -<a href="#"> <?php if($full_profile_fetch['noofsisters']!=""){echo $full_profile_fetch['noofsisters'];}else{ echo"Null";}?> </a>
											No. of Sisters Married-<a href="#"> <?php if($full_profile_fetch['nsm']!=""){echo $full_profile_fetch['nsm'];}else{ echo"Null";}?></a>
											Father Name-<a href="#">  <?php if($full_profile_fetch['Fathername']!=""){echo $full_profile_fetch['Fathername'];}else{ echo("Null");}?></a>
											Father Occupation-<a href="#">  <?php if($full_profile_fetch['Fathersoccupation']!=""){echo $full_profile_fetch['Fathersoccupation'];}else{echo"Null";}?></a>
											Mother Name -<a href="#"> <?php if($full_profile_fetch['Mothersname']!=""){echo $full_profile_fetch['Mothersname'];}else{ echo"Null"; }?>  </a>
											Mother Occupation -<a href="#"><?php if($full_profile_fetch['Mothersoccupation']!=""){echo $full_profile_fetch['Mothersoccupation'];}else{ echo"Null";}?> </a>
											Family Wealth-<a href="#"><?php if($full_profile_fetch['family_wealth']!=""){echo $full_profile_fetch['family_wealth'];}else{ echo"Null"; }?></a>
											Relative Info -<a href="#"><?php if($full_profile_fetch['relatives']!=""){ echo $full_profile_fetch['relatives'];}else{ echo"Null";}?></a>
											About Family -<a href="#"><?php if($full_profile_fetch['FamilyDetails']!=""){echo $full_profile_fetch['FamilyDetails'] ;}else{ echo"Null";}?></a>
											
											</div>
									  </aside>
		                                </div>                             
										
                                    </div>
                                </div>
                            </div>
							
							 <div class="schedule-block even">
                                <div class="inner-box horop">
                                    <div class="inner" >
                                        <div class="date"><figure class="thumb"><img src="icon/horocope.png" alt=""></figure></div>
                                        <div class="speaker-info1">
                                            <h5 class="name">Horoscope Details</h5>
                                            <span class="designation">Last Updated on <?php $formhoro = date('d F Y', strtotime($full_profile_fetch['horodate'])); echo $formhoro ;?></span>
                                        </div>
                                        <div class="text">
										  <aside class="sidebar5">
                                          <div class="sidebar5-widget popular-tags5">
											Moonsign -<a href="#"><?php if($full_profile_fetch['Moonsign']!=""){echo $full_profile_fetch['Moonsign'];}else{ echo"Null";}?></a> 
											Manglik -<a href="#"> <?php if($full_profile_fetch['Manglik']!=""){echo $full_profile_fetch['Manglik'];}else{echo"Null";}?></a> 
											Shani -<a href="#"> <?php if($full_profile_fetch['shani']!=""){echo $full_profile_fetch['shani'];}else{ echo"Null"; }?></a>
											Horoscope Match -<a href="#"><?php if($full_profile_fetch['Horosmatch']!=""){echo $full_profile_fetch['Horosmatch'];}else{ echo"Null";}?></a>
											Star -<a href="#"> <?php if($full_profile_fetch['FamilyDetails']!=""){echo $full_profile_fetch['FamilyDetails'];} else { echo"Null";}?></a> 
											Gotra -<a href="#"> <?php if($full_profile_fetch['Gothram']!=""){echo $full_profile_fetch['Gothram'];}else{ echo"Null";}?></a>
											Birth time -<a href="#">  <img src="images/blurimage.gif"></a>
											Place of Country - <a href="#"> <img src="images/blurimage.gif"> </a> 
											Place of Birth -<a href="#">  <img src="images/blurimage.gif"> </a>										
										   </div>
		                                </div>
                                      </aside>
										
                                    </div>
                                </div>
                            </div>
					
						</div>
						
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
    
    <!-- Newsletter Section -->


<?php include('footer.php')?>
    <!-- End Footer -->


<?php 
function get_height($strheight)
{
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
}
?>
<!--Scroll to top-->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

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
      <div class="modal-content">
  
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
