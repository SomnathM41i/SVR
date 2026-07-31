<?php require_once('../includes/bootstrap.php'); 
require_once('../includes/annual_income.php');
include('protect.php');
/*include('../dbconnectadmin.php');*/
 //session_start();
$strmid=$_GET['ID']; 
$id = $_GET['ID'];
$my_profile = mysqli_query($con,"SELECT *,date_format(DOB,'%d-%M-%Y') as DOB FROM register where matriid='$id'");
$me = mysqli_fetch_array($my_profile);
include 'get_count.php'; 
$result =mysqli_query($con,"SELECT * FROM register where MatriID='$strmid'");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile View</title>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="Manpasand Jodidar - Admin Panel"/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit"/>

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <!-- MPJ: brand icons -->
    <link rel="apple-touch-icon" href="../branding/favicons/apple-touch-icon.png">
    <link rel="manifest" href="../branding/site.webmanifest">
    <meta name="theme-color" content="#5E1426">
    <link href="ckeditor/sample.css" rel="stylesheet" type="text/css" />
	<!--<link rel="stylesheet" href="assets/css/plugins/select2.min.css">-->
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/mpj-brand.css">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
	<link rel="stylesheet" href="assets/css/newcss.css">
    <link rel="stylesheet" href="assets/css/popup.css">
    <link rel="stylesheet" href="assets/css/newchanges.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script type="text/javascript">
     $(window).load(function(){        
       $('#myModal').modal('show');
        }); 
    </script>
    

<style>
:root { --gold: #C9A84C; --crimson: #8B1A2B; --surface: #FDFAF5; }
body { background:var(--surface); font-family:'DM Sans',sans-serif; }
.admin-profile-container { padding-top:36px; }
.admin-profile-container .pc-container { max-width:100%; width:100%; margin-left:auto !important; margin-right:auto !important; padding-left:0; padding-right:0; }
.pc-horizontal .pc-container .pcoded-content { padding-left:0; padding-right:0; }
.pc-horizontal .pc-container .pcoded-content .page-header { padding-top:0; padding-bottom:18px; }
.pc-horizontal .pc-container .pcoded-content .page-header + .row { margin-top:0; }
.page-header { padding:12px 0; }
.card { border:none; box-shadow:0 2px 12px rgba(0,0,0,0.06); border-radius:10px; margin-bottom:20px; }
.card-header { background:#fff; border-bottom:1px solid #eee; padding:16px 22px; border-radius:10px 10px 0 0; }
.card-header h5 { font-size:15px; font-weight:600; color:#333; margin:0; }
.card-body { padding:16px 22px; }
.form-control { border-radius:6px; border:1px solid #ddd; padding:8px 14px; font-size:13px; }
.form-control:focus { border-color:var(--gold); box-shadow:0 0 0 2px rgba(201,168,76,0.15); }
.form-label { font-size:12px; font-weight:600; color:#555; margin-bottom:4px; }
.table-borderless td { padding:6px 8px; font-size:13px; border:none; }
.table-borderless td:first-child { font-weight:600; color:#555; min-width:120px; }
.table-borderless td:nth-child(2) { color:#999; width:16px; }
.table-borderless td:last-child { color:#222; }
.user-card-1 { border-radius:10px; overflow:hidden; }
.user-card-1 .card-body.pb-0 { padding-bottom:0; }
.img-radius { border-radius:50%; object-fit:cover; }
.wid-80 { width:70px; height:70px; }
.badge { padding:5px 12px; font-size:11px; font-weight:600; border-radius:20px; }
.btn { font-size:13px; border-radius:6px; padding:7px 18px; font-weight:500; }
.btn-warning { background:linear-gradient(135deg,#f0a030,#e08900); border:none; color:#fff; }
.btn-secondary { background:linear-gradient(135deg,#6c757d,#545b62); border:none; color:#fff; }
.btn-success { background:linear-gradient(135deg,#28a745,#1e7e34); border:none; color:#fff; }
.btn-danger { background:linear-gradient(135deg,#dc3545,#b02a37); border:none; color:#fff; }
.btn-primary { background:linear-gradient(135deg,var(--crimson),#6e1422); border:none; }
.dropdown-menu { border:none; box-shadow:0 4px 16px rgba(0,0,0,0.12); border-radius:8px; }
.dropdown-item { font-size:13px; padding:8px 18px; }
.dropdown-menu-dark { background:#2D1F3D; }
.dropdown-menu-dark .dropdown-item { color:rgba(255,255,255,0.85); }
.dropdown-menu-dark .dropdown-item:hover { background:rgba(201,168,76,0.15); color:#fff; }
.list-pills .nav-link { border-radius:0; padding:12px 18px; font-size:13px; border-left:3px solid transparent; transition:all 0.2s; }
.list-pills .nav-link.active { background:#f5efe6; border-left-color:var(--gold); color:var(--crimson); font-weight:600; }
.list-pills .nav-link:hover { background:#faf5ee; }
.personal-result { font-weight:500; }
.alert { border:none; border-radius:8px; padding:14px 18px; }
.alert h5 { font-size:13px; }
.alert .btn-close { font-size:12px; }
.col-md-3.carddp { padding:6px; text-align:center; }
.col-md-3.carddp img { border-radius:6px; object-fit:cover; }
.col-md-3.carddp a { font-size:11px; color:var(--crimson); margin:0 3px; }
.select2-container .select2-selection--multiple { min-height:62px; max-width:322px; }
@media (max-width:768px) {
  .admin-profile-container { padding-top:24px; }
  .user-card-1 .col-lg-4 { padding:0; }
  .table-borderless td:first-child { min-width:80px; }
}
@media (min-width:769px) and (max-width:1599.98px) {
  .admin-profile-container .pc-container { width:100%; }
}
</style>


<script>

function checkdiv(str)
{

    if (str == 'None')
    {
        $('#otherdist').hide();
    }
    else
    {
        $('#otherdist').show();
    }
}    
function showMyImage2(fileInput) {
	var oFile = document.getElementById("upload_photo").files[0];
            if (oFile.size > 3145728 ) // 3 mb for bytes.
            {
                document.getElementById('thumbnil1').style.display='block'; 
                return;
            }
	
	  document.getElementById('thumbnil').style.display='block';
	  document.getElementById('continue123').style.display='block';
	
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
				document.getElementById('thumbnil1').style.display='block';
				document.getElementById('thumbnil').style.display='none';
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
	
</script>
<script>
function showMyImage(fileInput) {
	var oFile = document.getElementById("upload1").files[0];
            if (oFile.size > 3145728 ) // 3 mb for bytes.
            {
                document.getElementById('thumbnil1').style.display='block'; 
                return;
            }
	
	  document.getElementById('thumbnil4').style.display='block';
	  document.getElementById('continue1234').style.display='block';
	
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
				document.getElementById('thumbnil1').style.display='block';
				document.getElementById('thumbnil4').style.display='none';
                continue;
            }           
            var img=document.getElementById("thumbnil4");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
	
</script>
<script type="text/javascript">
    function ShowHideDiv(iit) {
        var instu = document.getElementById("instu");
        instu.style.display = iit.checked ? "block" : "none";
    }
</script>
<script>
$(document).ready(function() {
    if ($('#iit').is(':checked')) {
        $('#instu').show();
    } else {
        $('#instu').hide();
    }
});
</script>
<script>
function showMyImage3(fileInput) {
	var oFile = document.getElementById("horoscope").files[0];
            if (oFile.size > 3145728 ) // 3 mb for bytes.
            {
                document.getElementById('thumbnil1').style.display='block'; 
                return;
            }
	
	  document.getElementById('thumbnil5').style.display='block';
	  document.getElementById('continue1235').style.display='block';
	
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
				document.getElementById('thumbnil1').style.display='block';
				document.getElementById('thumbnil5').style.display='none';
                continue;
            }           
            var img=document.getElementById("thumbnil5");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }

//FOR PERMAN ADDRESS
function checkstate(str)
{

  if (str=='Out of India')
  {
    $('#state_div').hide();
    $('#city_div').hide();
    $('#dist_div').hide();
    $('#pin_div').hide();
    }
  else
  {
    $('#state_div').show();
    $('#city_div').show();
      $('#dist_div').show();
      $('#pin_div').show();
      $('#add_div').show();
    
  }

  if( str=='India')
  {
    $('#state_div').show();
    $('#city_div').show();
      $('#dist_div').show();
      $('#pin_div').show();
      $('#add_div').show();

  }
  else
  {
    $('#state_div').hide();
    $('#city_div').hide();
    $('#dist_div').hide();
    $('#pin_div').hide();

  }
}
//FOR WORKING ADDRESS
function checkworkstate(str)
{

  if (str=='Out of India')
  {
    $('#working_state_div').hide();
    $('#working_city_div').hide();
    $('#working_dist_div').hide();
    $('#work_pin_div').hide();
    }
  else
  {
    $('#working_state_div').show();
    $('#working_city_div').show();
      $('#working_dist_div').show();
      $('#work_pin_div').show();
     
    
  }

  if( str=='India')
  {
    $('#working_state_div').show();
    $('#working_city_div').show();
      $('#working_dist_div').show();
      $('#work__pin_div').show();
     

  }
  else
  {
    $('#working_state_div').hide();
    $('#workng_city_div').hide();
    $('#working_dist_div').hide();
    $('#work_pin_div').hide();

  }
}
	
</script>
</head>

<body class="pc-horizontal">
	<div class="container-fluid px-0">
		<!-- [ Pre-loader ] start -->
		<div class="loader-bg">
			<div class="loader-track">
				<div class="loader-fill"></div>
			</div>
		</div>
		<!-- [ Pre-loader ] End -->
		<!-- [ Mobile header ] start -->
		
		<!-- [ Mobile header ] End -->
		  <?php include('topheader.php');?>
		  <?php include('header.php');?>
		<!-- [ navigation menu ] end -->
		<!-- Modal -->
		<?php include('notification.php');?>


<!-- [ Main Content ] start -->
<div class="container admin-profile-container">
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                   
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-lg-4">
                <div class="card user-card user-card-1">
                    <div class="card-body pb-0">
                        <div class="float-end">
						<?php if($row['Status']=="Expired") {?>
                            <span class="badge bg-light-danger "><?php echo $row['Status']?></span>
						<?php }else {?>
								 <span class="badge bg-light-success"><?php echo $row['Status']?></span>
						<?php }?>
                        </div>
                        <div class="media user-about-block align-items-center mt-0 mb-3">
                            <div class="position-relative d-inline-block">
							<?php if($row['Photo1']=='nophoto.jpg'){?>
							<img class="img-radius img-fluid wid-80" height="20" width="20" src="../images/<?php echo $row['Photo1']?>" alt="User image">
							<?php } else { ?>
                                <img class="img-radius img-fluid wid-80" height="20" width="20" src="../photoprocess.php?image=gallary/<?php echo $row['Photo1']?>&square=250" alt="User image">
							<?php } ?>
								<div class="certificated-badge">
                                    <i class="fas fa-certificate text-primary bg-icon"></i>
                                    <i class="fas fa-check front-icon text-white"></i>
                                </div>
                            </div>
							
							
							
                            <div class="media-body ms-3">
                                <h6 class="mb-1"><?php echo $row['Name']?></h6>
                                <p class="mb-0 text-muted"><?php echo $row['MatriID']?></p>
                            </div>
                        </div>
				</div>
			   <?php 
				  $martid=$row['MatriID'];
				  $fetch=mysqli_query($con,"select * from gallary where matri_id='$martid'");?>
				<div class="row">
                <?php while($rowview=mysqli_fetch_array($fetch)) { ?>     
              <div class="col-md-3 carddp">

            <a href="../gallary/<?php echo $rowview['photo_name'];?>" target=_blank>
			<img src="../photoprocess.php?image=gallary/<?php echo $rowview['photo_name'];?>&square=100" height="30" width="30"  border="0"/></a><br>
           
           <?php 
        
           if($rowview['photo_name']==$row['Photo1']){?>
           
           <a href="setdp.php?photo=<?php echo $rowview['photo_name'];?>&id=<?php echo $row['MatriID']?>">set</a>

              <?php } else { ?>
             <a href="setdp.php?photo=<?php echo $rowview['photo_name'];?>&id=<?php echo $row['MatriID']?>">DP</a>
              <?php } ?>
           <?php   $id=$rowview['photo_id']; ?>
           <a href="deletemphoto.php?id=<?php echo $id; ?>"><i class="feather icon-trash-2" aria-hidden="true"></i></a> 
          </div>
           <?php } ?>
             </div>
						
                    <div class="card-body">
                       <div class="col-md-12">
				<div class="">
				
					<div class="row">
					
					<div class="card-body">
						<div class="btn-group mb-2 me-2">
							<button class="btn  btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status</button>
							<div class="dropdown-menu dropdown-menu-dark">
                            <?php 
                                if( $row['auto_approve'] == 0)
                                {
                            ?>
                            <a href="approve_member?ID=<?php echo $row['MatriID'];?>" class="dropdown-item">Approve Member</a>
                            <?php
                                }
                            ?>  
															
								 <?php if($row['Status']=='Active')
																	{?>
						 <a href="approve_paid_form?matriid=<?php echo $row['MatriID'];?>" class="dropdown-item">Approve To Paid</a> 
                        
						  <?php  } else  if($row['Status']=='Paid')
																	{?>
						   <a href="degrade_member?matriid=<?php echo $row['MatriID'];?>" onclick="return confirm('Are You Really Want To Degrade Member..?  Click OK To Confirm...?')" class="dropdown-item" >
						   Degrade Membership </a>
                          
						  <?php  } 	else  if($row['Status']=='Expired')	
																	{?>
						  <!-- <a href="approve_paid_form?matriid=<?php echo $row['MatriID'];?>" class="dropdown-item">Renew Membership </a> -->
                         <a href="approve_paid_form?matriid=<?php echo $row['MatriID'];?>" class="dropdown-item">Renew Membership </a>
						   <?php } ?>
						<?php  if($row['Status']=='Banned'){	?>
						    <a href="unbanned_member?matriid=<?php echo $row['MatriID'];?>" class="dropdown-item">Unban Member</a>
                            

						<?php } else { ?>
						 <a href="banned_member?matriid=<?php echo $row['MatriID'];?>" class="dropdown-item">Ban Member</a>
                          

						<?php }?>
							</div>
						</div>
						<div class="btn-group mb-2 me-2">
						<button class="btn  btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
						<div class="dropdown-menu dropdown-menu-dark">
						 <a class="dropdown-item" href="sendmail?matriid=<?php echo $row['MatriID']; ?>&Email=<?php echo $row['ConfirmEmail'];?>" >Send Mail</a>
						 <!--<a class="dropdown-item" href="delete_member?matriid=<?php echo $row['MatriID'];?>" onclick="return confirm('Are You Really Want To Delete This Profile...?  Click OK To Confirm...?')">Remove Member</a>-->
						<?php  
						 if($row['Status']=='Banned')
						 {	
						 ?>
						    <a class="dropdown-item" href="reactivate_member?matriid=<?php echo $row['MatriID'];?>">Reactivate</a>
						<?php 
						 }
						else
						{
						?>
						 <a class="dropdown-item" href="deactivate_member?matriid=<?php echo $row['MatriID'];?>">Deactivate</a>
						<?php
						}
						?>
						
						 
						 
							<a class="dropdown-item" href="print_my_profile?ID=<?PHP echo $row['MatriID']; ?>">Print This Profile</a>
							</div>
						</div>
						<div class="btn-group mb-2 me-2">
    						<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-report" data-id="<?php echo $row['MatriID'] ?>">Note</button>
                        </div>
                        <div class="btn-group mb-2 me-2">
                            <a href='activity_log?id=<?php echo $row['MatriID'] ?>' target=_blank><button class="btn btn-danger">Log</button></a>
                        </div>
					</div>
					
				  </div>
				  
				</div>
				<?php include('profile_note_modal.php'); ?>
			</div>
                    </div>
                    <div class="nav flex-column nav-pills list-group list-group-flush list-pills" id="user-set-tab" role="tablist" aria-orientation="vertical">
                        <?php
                            $check=$_GET['flag'];
                            if($check=='')
                            {
                        ?>
                        <a class="nav-link list-group-item list-group-item-action active" id="user-set-profile-tab" data-bs-toggle="pill" href="#user-set-profile" role="tab" aria-controls="user-set-profile" aria-selected="true">
                            <span class="f-w-500"><i class="feather icon-user m-r-10 h5 "></i>Profile Overview</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>
                        <?php 
                            }
                            else
                            {
                        ?>
                        <a class="nav-link list-group-item list-group-item-action " id="user-set-profile-tab" data-bs-toggle="pill" href="#user-set-profile" role="tab" aria-controls="user-set-profile" aria-selected="true">
                            <span class="f-w-500"><i class="feather icon-user m-r-10 h5 "></i>Profile Overview</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>
						<?PHP
                            }
							if($row['Status'] !='Active')
							{
						?>
						<a class="nav-link list-group-item list-group-item-action" id="membership-tab" data-bs-toggle="pill" href="#membership" role="tab" aria-controls="membership" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-file-text m-r-10 h5 "></i>Membership Details</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>
						<?php
							}
                        ?>
						<?php
                            if($check==1)
                            {
                        ?>
                        <a class="nav-link list-group-item list-group-item-action active" id="user-set-information-tab" data-bs-toggle="pill" href="#user-set-information" role="tab" aria-controls="user-set-information" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-file-text m-r-10 h5 "></i>Basic Information</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>
                        <?php
                            }else
                            {
                        ?>
                        <a class="nav-link list-group-item list-group-item-action" id="user-set-information-tab" data-bs-toggle="pill" href="#user-set-information" role="tab" aria-controls="user-set-information" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-file-text m-r-10 h5 "></i>Basic Information</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>
                        <?php
                            }
                        ?>
                        <a class="nav-link list-group-item list-group-item-action" id="user-set-education-tab" data-bs-toggle="pill" href="#user-set-education" role="tab" aria-controls="user-set-education" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Education Details</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>
						 <a class="nav-link list-group-item list-group-item-action" id="user-set-partner-tab" data-bs-toggle="pill" href="#user-set-partner" role="tab" aria-controls="user-set-partner" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Partner Preference</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>
						 <a class="nav-link list-group-item list-group-item-action" id="user-set-family-tab" data-bs-toggle="pill" href="#user-set-family" role="tab" aria-controls="user-set-family" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Family Details</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>					
                        </a> 
						<a class="nav-link list-group-item list-group-item-action" id="user-set-contact-tab" data-bs-toggle="pill" href="#user-set-contact" role="tab" aria-controls="user-set-contact" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Contact Information</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>							
                        </a> 
						<?Php /*<a class="nav-link list-group-item list-group-item-action" id="user-set-Basics-tab" data-bs-toggle="pill" href="#user-set-Basics" role="tab" aria-controls="user-set-Basics" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Basics and Lifestyle</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>   */ ?>
                        <a class="nav-link list-group-item list-group-item-action" id="user-set-Horoscope-tab" data-bs-toggle="pill" href="#user-set-Horoscope" role="tab" aria-controls="user-set-Horoscope" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Horoscope Information</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>
						
						<a class="nav-link list-group-item list-group-item-action" id="user-set-photo-tab" data-bs-toggle="pill" href="#user-set-photo" role="tab" aria-controls="user-set-photo" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Upload Photo</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a> 
						 
						 <a class="nav-link list-group-item list-group-item-action" id="user-set-Idproof-tab" data-bs-toggle="pill" href="#user-set-Idproof" role="tab" aria-controls="user-set-Idproof" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Upload ID Proof</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a> 
						 <a class="nav-link list-group-item list-group-item-action" id="user-set-UpHoroscope-tab" data-bs-toggle="pill" href="#user-set-UpHoroscope" role="tab" aria-controls="user-set-UpHoroscope" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Upload Horoscope</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a> 
                         <a class="nav-link list-group-item list-group-item-action" id="user-set-Document-tab" data-bs-toggle="pill" href="#user-set-Document" role="tab" aria-controls="user-set-Document" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-file-text m-r-10 h5 "></i>Upload Document</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a> 
                         
                        <a class="nav-link list-group-item list-group-item-action" id="user-set-email-tab" data-bs-toggle="pill" href="#user-set-email" role="tab" aria-controls="user-set-email" aria-selected="false">
                            <span class="f-w-500"><i class="material-icons-two-tone   m-r-9" style="font-size: 20px;    margin-right: 4px;">settings</i> Profile settings</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>						
                    </div> 	
                </div>
              
            </div>
            <div class="col-lg-8">
                <div class="tab-content" id="user-set-tabContent">
                   <?php if( $check == "" || $check == "11"  || $check == "12" || $check == "13" || $check == "14" || $check == "17" || $check == "18" || $check == "19" || $check == "22" || $check == "23" || $check == "24" || $check == "25" || $check == "26") {

                    ?>
                    <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel" aria-labelledby="user-set-profile-tab">
                    <?php }else
                    {
                    ?>
                    <div class="tab-pane fade" id="user-set-profile" role="tabpanel" aria-labelledby="user-set-profile-tab">
                    <?php
                    }
                    ?>

                   
                    <?php 
                                $login=$_GET['ID']; 
                                $rowverify=mysqli_query($con,"select * from emailverify where MatriID='$login'");
                                $fetch=mysqli_fetch_array($rowverify);
                                $verification=$fetch['verification'];
                                if($verification!='Yes'){?>

								
							<div class="col-sm-12">
                            <div class="alert alert-info alert-dismissible" role="alert">
							
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
							
                            <h5 class="alert-heading mb-0" style="color:Blue"><i class="feather icon-heart me-2"></i> 
                                 <?php if($match_queryfetch['totalCount']>0){ ?>
                                <a href="show_matches?ID=<?php echo $row['MatriID'] ?>" target='_blank'>We Found <u><?php echo $match_queryfetch['totalCount'];?></u> Mutual Matches For this Profile.</a></h5>
								 <?php } else { ?>
								  <a href="#">We Found <u><?php echo $match_queryfetch['totalCount'];?></u> Mutual Matches For this Profile.</a></h5>
								 <?php } ?>
								 </div>
								 </div>
								 
								 <div class="col-sm-12 ">
								 <div class="alert alert-danger alert-dismissible" role="alert">
								 
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
									<h5 class="alert-heading mb-0"><i class="feather icon-alert-circle me-2"></i> 
                                Your email is not confirmed. </h5>
								 </div>
                                  </div>

								<?php  if(($me['Photo1Approve']=='No')&&($me['Photo1']!='nophoto.jpg')) { ?>  
						<div class="col-sm-12">
								 <div class="alert alert-primary alert-dismissible" role="alert">
								 
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
									</button>
									<h5 class="alert-heading mb-0"><i class="feather icon-alert-octagon me-2"></i> 
									
									    Profile Photo Approval is Pending.
									
										</h5>
								 </div>
                              </div>
							  <?php } ?>
								
                                <?php } else { ?>
								
							<div class="col-sm-12">
                                <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
							
                            <h5 class="alert-heading mb-0" style="color:Blue"><i class="feather icon-heart me-2"></i>
                      
                                 <?php if($match_queryfetch['totalCount']>0){ ?>
                                <a href="show_matches?ID=<?php echo $row['MatriID'] ?>" target='_blank'>We Found <u><?php echo $match_queryfetch['totalCount'];?></u> Mutual Matches For this Profile.</a></h5>
								 <?php } else { ?>
								  <a href="#">We Found <u><?php echo $match_queryfetch['totalCount'];?></u> Mutual Matches For this Profile.</a></h5>
								 <?php } ?>
                               
                               </div>
							   </div>
							   <div class="col-sm-12">
							    <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                            <h5 class="alert-heading mb-0"><i class="feather icon-alert-circle me-2"></i> 
                                Email Verification Done Successfully </h5>
                               
                               </div>
							   </div>
							   <?php if(($me['Photo1Approve']=='No')&&($me['Photo1']!='nophoto.jpg')) { ?>
                                  <div class="col-sm-12">
								 <div class="alert alert-primary alert-dismissible" role="alert">
								  
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
									</button>
									<h5 class="alert-heading mb-0"><i class="feather icon-alert-octagon me-2"></i>
									
									    Profile Photo Approval is Pending.
									
									     
										</h5>
								 </div>
                              </div>
							  <?php } ?>
			
                               <?php } ?>
                            <!--   <div class="col-sm-12 ">-->
                            <!--    <div class="alert alert-dark alert-dismissible" role="alert">-->
                            <!--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
                            <!--        <h5 class="alert-heading mb-0"><i class="feather icon-alert-triangle me-2"></i>-->
                            <!--            <a href="view_recommendation?id=<?php echo $row['MatriID'] ?>" class="change-color" target="_blank">-->
                            <!--                Recommendation-->
                            <!--            </a>-->
                            <!--        </h5>-->
                            <!--    </div>-->
                            <!--</div>-->
                       
						
						
                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Personal Details</span></h5>
                            </div>
                            <div class="card-body">
                                <p>
								<?php if($row['profile_approve']=='Yes') { ?>
                                    <?php echo $row['aboutus'];?> <!--<a href="profile_view?flag=6"><button class="btn btn-primary" >Edit</button>-->
                                <?php } ?>
								</p>
								<!-- <h5 class="mt-5 mb-3">Personal Details</h5> -->
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="">Full Name</td>
                                            <td class="">:</td>
                                            <td class="personal-result"><?php echo $row['Name']?></td>
                                        </tr>
                                        <tr>
                                            <td class="">Gender</td>
                                            <td class="">:</td>
                                            <td class="personal-result"><?php echo $row['Gender']?></td>
                                        </tr>
										 <tr>
                                        <td class="">Date of Birth</td>
                                            <td class="">:</td>
                                            <td class="personal-result"><?php $explodedate=explode("-",$row['DOB']);
										echo $explodedatedisplay=$explodedate[2]."-".$explodedate[1]."-".$explodedate[0];?></td>
                                        </tr>
										<tr>
                                            <td class="">Reg No.</td>
                                            <td class="">:</td>
                                            <td class="personal-result"><b><?php echo $row['regno']?></b></td>
                                        </tr>
										                                        <tr>
                                            <td class="">Reg Date</td>
                                            <td class="">:</td>
                                            <td class="personal-result"><b><?php echo $row['signdate']?></b></td>
                                        </tr>
                                        <tr>
                                            <td class="">Religion</td>
                                            <td class="">:</td>
                                            <td class="personal-result"><?php echo $row['Religion']?></td>
                                        </tr>
                                        <tr>
                                            <td class="">Caste</td>
                                            <td class="">:</td>
                                            <td class="personal-result"><?php echo $row['Caste']?></td>
                                        </tr>
                                        <tr>
                                            <td class="">Subcaste</td>
                                            <td class="">:</td>
                                            <td class="personal-result"><?php echo $row['Subcaste']?></td>
                                        </tr>
                                        <tr>
                                            <td class="">Email</td>
                                            <td class="">:</td>
                                            <td  class="personal-result"><?php echo $row['ConfirmEmail']?></td>
                                        </tr>
										<tr>
                                            <td class="">Password</td>
                                            <td class="">:</td>
                                            <td class="personal-result">
                                                <input type="password" class="hide-passbox" id="myInput" value = "<?php echo $row['ConfirmPassword']?>"><i class="bi bi-eye" id="showpass" onclick="myFunction()" ></i><i id="hidepass" onclick="myFunction()" class="bi bi-eye-slash"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="" >Mobile</td>
                                            <td class="">:</td>
                                            <td class="personal-result"><?php echo $row['Mobile']?>,<?php echo $row['Mobile2']?></td>
                                        </tr>

                                        <tr class="bg-franchise">
                                            <td class="">Franchise ID</td>
                                            <td class="">:</td>
                                            <td class="">
                                            <?php
                                                if($row['franchise_id'] != '') 
                                                {
                                                    echo $row['franchise_id'];
                                                }
                                                else
                                                {
                                                    include('siteconfig.php');
                                                    echo $config['copyright_footer'];
                                                }
                                            ?>
                                                
                                            </td>
                                        </tr>
                                                                                
																				

                                    </tbody>
                                </table>                  
                                <!-- <div class="card-header">
                                    <span class="p-l-5">Franchise ID:</span>
                                </div>  -->      
                            </div>
                        </div>
                    </div>
                    

					<!-- -->
                    <?php if($check == "15"){?>
					<div class="tab-pane fade show active" id="membership" role="tabpanel" aria-labelledby="membership-tab">
                    <?php 
                    }
                    else
                    {
                    ?>
                    <div class="tab-pane fade" id="membership" role="tabpanel" aria-labelledby="membership-tab">
                    <?php
                    }
                    ?>

					  <form action="edit_mem" method="post">
                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Membership Details</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
							
                                    	
                                   	
									<div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <input type="text" class="form-control"   readonly value="<?php echo $row['Status']; ?>" placeholder="">
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Membership Plan</label>
                                            <input type="text" class="form-control"   readonly value="<?php echo $row['memtype']; ?>" placeholder="">
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                         <div class="form-group">
                                            <label class="form-label"> No of Contacts <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" maxlength="4" id="txtNo" name="txtName"  onkeypress="return isNumber(event)"value="<?php echo $row['Noofcontacts']; ?>" placeholder="Contacts">
										    
											 <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                         <div class="form-group">
                                            <label class="form-label">Membership Expiry Date <span class="text-danger">*</span></label>
											<?php 
                                                $orgDate = $row['MemshipExpiryDate'];
                                                $newDate = date("d/m/Y", strtotime($orgDate));  
                                            //$explodedate=explode('-',$row['MemshipExpiryDate']);
											//$explodedatedisplay=$explodedate[2].'/'.$explodedate[1].'/'.$explodedate[0];?>
                                            <input type="date" class="form-control"  id="txtName" name="date"  onkeypress="return isNumber(event)" value="<?php echo $row['MemshipExpiryDate']?>" placeholder="Membership Expiry Date (DD-MM-YYYY)">
										    
											
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                          
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <!--<button class="btn btn-outline-dark ms-2">Clear</button>-->
                            </div>
                        </div>
						</form>
                    </div>
						<!-- Basic Details -->
                        <?php
                            if($check == 1)
                            {
                         ?>
                        <div class="tab-pane fade show active" id="user-set-information" role="tabpanel" aria-labelledby="user-set-information-tab">
                        <?php       
                            }
                            else
                            {
                        ?>
                        <div class="tab-pane fade" id="user-set-information" role="tabpanel" aria-labelledby="user-set-information-tab">
                        <?php
                            }
                        ?>
                     
					  <form action="edit_basic.php" method="post">
                        
                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Basic Information</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
							
                                    <div class="col-sm-6">
                                        <div class="form-group">
										  <label class="form-label">Profile Created By</label><br>
                                            <select class="custom-select-box form-control" name="created_by" tabindex="1">
											<?php if($row['Profilecreatedby']!='') {?>
											<option value="<?php echo $row['Profilecreatedby']; ?>" selected><?php echo $row['Profilecreatedby']; ?></option>
											<?php } else { ?>
												  <option value="" selected>Profile Created By</option>
											<?php } ?>
												  <option value="Self">Self</option>
												  <option value="Father">Father</option>
												  <option value="Mother">Mother</option>
												  <option value="Brother">Brother</option>
												  <option value="Sister">Sister</option>
												  <option value="Friend">Friend</option>
												  <option value="Son">Son</option>
												  <option value="Daughter">Daughter</option>
												  <option value="Others">Others</option>
										    </select>
                                        </div>
                                    </div>	
                                   <div class="col-sm-6">
                                         <div class="form-group">
                                            <label class="form-label"> Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" tabindex="2" maxlength="40" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" id="txtName" name="txtName"  value="<?php echo $row['Name']; ?>" placeholder="Name">
										    <input type="hidden" name="id" value="<?php  echo $_GET['ID'];?>">
                                        </div>
                                    </div>										
                                    <div class="col-sm-6">
                                        <div class="form-group" >
                                            <label class="form-label">Gender</label><br>
                                            <select class="custom-select-box form-control" name="gender" tabindex="3">
                                               <?php if($row['Gender']=="Male") { ?>
												<option value="<?php echo $row['Gender']; ?>" selected><?php echo $row['Gender']; ?></option>
												<option value="Female" >Female</option>
												<?php } else { ?>
												<option value="<?php echo $row['Gender']; ?>" selected><?php echo $row['Gender']; ?></option>
												<option value="Male" >Male</option>
												 <?php }?>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Age</label>
                                            <input type="text" class="form-control" tabindex="4"  readonly value="<?php echo $row['Age']; ?>" placeholder="Enter Age">
                                        </div>
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" tabindex="5" maxlength="40" onBlur="check_exist123(this.value);"value="<?php echo $row['ConfirmEmail']; ?>" placeholder="Enter Email ID">
                                        </div>
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input type="text" class="form-control"  name="password"  tabindex="6" maxlength="20" value="<?php echo $row['ConfirmPassword']; ?>" placeholder="Enter Password">
                                        </div>
                                    </div>
								  <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Religion</label><br>
                                            <select class="custom-select-box form-control" id="religion" name="religion" tabindex="7" onChange="fillcaste(this.value)">
											 <?php if($row['Religion']!='') { ?>
                                               <option value="<?php echo $row['Religion']; ?>" selected><?php echo $row['Religion']; ?></option>
											 <?php }else { ?>
											 <option value="" selected>Select Religion</option>
											 <?php } ?>
												<?php $rrs=mysqli_query($con,"select * from religion where status='enable'");
													while($rrow=mysqli_fetch_assoc($rrs))
													{ ?>
												<option value="<?php echo $rrow['Religion'];?>"><?php echo $rrow['Religion'];?></option>
												<?php	}	?>
                                            </select>
                                        </div>
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Caste</label><br>
                                            <select class="custom-select-box form-control" name="caste" tabindex="8" id="caste_dropdown"> 
                                              <?php if($row['Caste']!='') { ?>
                                               <option value="<?php echo $row['Caste']; ?>" selected ><?php echo $row['Caste']; ?></option>
											 <?php }else { ?>
											 <option value="" selected>Select Caste</option>
											 <?php } ?>
											   <?php $qry=mysqli_query($con,"select * from caste where status='enable'");
												while($rowC=mysqli_fetch_array($qry))
												{  echo"<option value='".$rowC[2]."'>".$rowC[2]."</option>"; }?>
                                            </select>
                                        </div>
                                    </div>
									  <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Subcaste <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="subcaste" maxlength="30" name="subcaste"  value="<?php echo $row['Subcaste']; ?>" placeholder="Enter Subcaste">
                                        </div>
                                    </div>	
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Marital Status</label><br>
                                            <select class="custom-select-box form-control" id="mstatus" name="mstatus" >	<?php if($row['Maritalstatus']!='') { ?>
                                               <option value="<?php echo $row['Maritalstatus']; ?>" selected><?php echo $row['Maritalstatus']; ?></option>
											 <?php }else { ?>
											 <option value="" selected>Select Maritalstatus</option>
											 <?php } ?>
											  <option value="Unmarried">Unmarried</option>
											  <option value="Divorced">Divorced</option>
											  <option value="Widower">Widower</option>
											  <option value="Widowed">Widowed</option>
											  <option value="Seperated">Separated</option>
											  <option value="Awaiting Divorce">Awaiting Divorce</option>
                                            </select>
                                        </div>
                                    </div>
									
									 <div class="col-sm-6" id="child">									 
                                        <div class="form-group">
                                            <label class="form-label"> Select No Of Childerns</label><br>
                                            <select class="custom-select-box form-control" name="noc" id="chidN">
                                               <?php if($row['PE_HaveChildren']!="") { ?>
												 <option value="<?php  echo $row['PE_HaveChildren']; ?>"><?PHP  echo $row['PE_HaveChildren']; ?></option> <?php  } else { ?>
												  <option value=""> No of Children</option>
												 <?php } ?>
												  <option value="None">None</option>
												  <option value="1">1</option>
												  <option value="2">2</option>
												  <option value="3">3</option>
												  <option value="4 & Above">4 & Above</option>
                                            </select>
                                        </div>
                                    </div>
									
									
									 <div class="col-sm-6" id="child1">
                                        <div class="form-group">
                                            <label class="form-label"> Children Living Status</label><br>
                                            <select class="custom-select-box form-control" name="childstatus">
                                             <?php if($row['childrenlivingstatus']!="") { ?>
											 <option value="<?PHP  echo $row['childrenlivingstatus']; ?>" selected><?PHP  echo $row['childrenlivingstatus']; ?></option> <?php  } else { ?>
											  <option value="" selected>Select</option>
											  <?php } ?>
											  <option value="Living with me">Living with me</option>
											  <option value="Not living with me">Not living with me</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="child_acceptance_field">
                                        <div class="form-group">
                                            <label class="form-label">Child Acceptance</label><br>
                                            <select class="custom-select-box form-control" name="child_acceptance">
                                                <option value="">Select Child Acceptance</option>
                                                <?php foreach (['Do Not Accept Children', 'Boy Child', 'Girl Child', 'Both Boy and Girl Child'] as $childAcceptanceOption) { ?>
                                                <option value="<?php echo $childAcceptanceOption; ?>" <?php echo (($row['child_acceptance'] ?? '') === $childAcceptanceOption) ? 'selected' : ''; ?>><?php echo $childAcceptanceOption; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
								
								<div class="col-sm-6">
								<?php  // Delimiters may be slash, dot, or hyphen
								$date = $row['DOB']; 								
								list($year,$month,$day) = preg_split("/[\/\.-]+/", $date);								
								
								?>
                                   
										<div class="form-group">
                                            <label class="form-label">Day</label><br>
                                              <select name="dobDay" class="skill-mlt-select form-control"  name="dobDay" >
											 <option value="<?php  echo $day; ?>" selected="selected"><?php  echo $day; ?></option>
											 

												<option value="01">1</option>
												<option value="02">2</option>
												<option value="03">3</option>
												<option value="04">4</option>
												<option value="05">5</option>
												<option value="06">6</option>
												<option value="07">7</option>
												<option value="08">8</option>
												<option value="09">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option> 
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>
											  </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
									   <div class="form-group">
                                            <label class="form-label">Month</label><br>
                                              <select name="dobMonth" class="skill-mlt-select form-control"  name="dobMonth" >
												 <option value="<?php  echo $month; ?>" selected="selected"><?php  echo $month; ?></option>

												<option value="01">January</option>
												<option value="02">February</option>
												<option value="03">March</option>
												<option value="04">April</option>
												<option value="05">May</option>
												<option value="06">June</option>
												<option value="07">July</option>
												<option value="08">August</option>
												<option value="09">September</option>
												<option value="10">October</option>
												<option value="11">November</option>
												<option value="12">December</option>
											  </select>
                                        </div>  
                                    </div>
									<div class="col-sm-6" >
									     <div class="form-group" >
                                            <label class="form-label">Year</label>
                                              <br><select name="dobYear"   class="skill-mlt-select selectd form-control"  name="dobDay" >
												 <?php  if($year=="") { ?>
												<option value="" selected >Year</option>
												<?php  } else { ?>
												<option value="<?php  echo $year; ?>" selected="selected"><?php  echo $year; ?></option>
												<?php  }?>
												<?php  $year_fe=$con->query("select * from year order by id desc");
												while($year_gt=$year_fe->fetch_array()) { ?>
												<option value="<?php  echo $year_gt['year']; ?>"><?php  echo $year_gt['year']; ?></option>
												<?php  }?>
											  </select>
                                        </div>
                                    </div>

									<?php /*<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Reg Date</label>
											<?php $expdate=explode("-",$row['signdate']);
											$date1=$expdate[0]."-".$expdate[1]."-".$expdate[2];
											echo $row['signdate'];?>
                                            <input type="date" class="form-control" name="signdate" value="<?php echo $date1; ?>">
                                        </div>
                                    </div> */ ?>
									
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label class="form-label">About Us<span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="aboutus" type="text" value="<?php  echo $row['aboutus']; ?>"  maxlength="450"  rows="5" placeholder="Enter few lines about yourself"><?php  echo $row['aboutus']; ?></textarea>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                          
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <!--<button class="btn btn-outline-dark ms-2">Clear</button>-->
                            </div>
                        </div>
						</form>
                    </div>
					<!-- Education Details -->
                    <?php
                        if($check == 2)
                        {
                    ?>
                    <div class="tab-pane fade show active" id="user-set-education" role="tabpanel" aria-labelledby="user-set-education-tab">
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="tab-pane fade" id="user-set-education" role="tabpanel" aria-labelledby="user-set-education-tab">
                    <?php
                        }
                    ?>
					
					  <form action="edit_edu.php" method="post">
                        <div class="card">
                            <div class="card-header">
                                <h5><!-- i data-feather="user" class="icon-svg-primary wid-20"></i> -->
                                <img src="https://img.icons8.com/material/24/7267EF/student-center.png"/>
                                <span class="p-l-5">Education Details</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">  
                                <div class="col-sm-6">
                                        <div class="form-group mt-2">
											<?php if($row['iit']=='yes') { ?>
													 <input type="checkbox" name="iit" id="iit" value="yes" style="vertical-align: middle" onclick="ShowHideDiv(this)" checked>&nbsp; &nbsp;<label for="looking"  style="vertical-align: middle"> Are you from IIT/IIM/NIT ?</label>
												   <?php } else { ?>
													  <input type="checkbox" name="iit" id="iit" value="yes" style="vertical-align: middle" onclick="ShowHideDiv(this)">&nbsp;<label for="looking"  style="vertical-align: middle"> Are you from IIT/IIM/NIT ?</label>
										<?php } ?>
										</div>
								</div>
								<div class="col-sm-6">
                                        <div class="form-group">
										 <!--<label class="form-label">Institute</label><br>-->
						      <select class="skill-mlt-select form-control"  style="display:none" name="instu" id="instu" tabindex="1">
						        <?php  
							     if($row['instu']==''){ ?>
								   <option value="">Select Institute</option>
								   <?php  } else { ?>
								   <option value="<?php  echo $row['instu']?>" selected><?php  echo $row['instu']?></option>
								   <?php } ?>
								   <option value="">Select Institute</option>
								  <?php  $inst1=mysqli_query($con,"select * from  iit where status='enable'");
								        while($inst=mysqli_fetch_array($inst1))
										{ ?>
											<option value="<?php echo $inst['Inst_nm'];?>"> <?php echo $inst['Inst_nm'] ;?></option>
										<?php } ?>
						  </select>
										</div>
								</div>								
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Education</label><br>
											<input type="hidden" name="id" value="<?php  echo $_GET['ID'];?>">
                                            <select class="skill-mlt-select form-control" name="txtEdu" id="txtEdu">
												<?php if($row['Education']!='') { ?>
												   <option value="<?php echo $row['Education']; ?>" selected><?php echo $row['Education']; ?></option>
												<?php }else { ?>
												   <option value="" selected>Select Education</option>
												<?php } ?>
													
                                               <?php  
												$edusql=mysqli_query($con,"select * from education where status='enable'");
												while($edurow=mysqli_fetch_array($edusql))
												{
													if($edurow['edu']==$row['Education'] && $edurow['edu']!="")
													{
													 ?>
														  <option value="<?php  echo $edurow['edu']; ?>" selected><?php  echo $edurow['edu']; ?></option>
														  <?php  
													}else
													{
														$str="";
														if($edurow['status']=='disabled')
														{
														$str="disabled";	
														}
													?>
														  <option value="<?php  echo $edurow['edu']; ?>" <?php  echo $str; ?>><?php  echo $edurow['edu']; ?></option>
														  <?php  
													}
												}
												?>
                                            </select>
                                        </div>
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                           <label class="form-label">Occupation</label><br>
                                           <select class="skill-mlt-select form-control" name="txtOccu" id="txtOccu">
										   <?php if($row['Occupation']!='') { ?>
												   <option value="<?php echo $row['Occupation']; ?>" selected><?php echo $row['Occupation']; ?></option>
												<?php }else { ?>
												   <option value="" selected>Select Occupation</option>
												<?php } ?>
											 
                                               <?php  
												$occsql=mysqli_query($con,"select * from occupation  where status='enable' order by occu asc");
												while($occrow=mysqli_fetch_array($occsql))
												{
													if($occrow['occu']==$row['Occupation'])
													{
													 ?>
														<option value="<?php  echo $occrow['occu']; ?>" selected><?php  echo $occrow['occu']; ?></option>
														<?php  
													}else
													{					
													?>
														<option value="<?php  echo $occrow['occu']; ?>" ><?php  echo $occrow['occu']; ?></option>
														<?php  
													}
												}
												?>
                                            </select>
                                        </div>
                                    </div>
                                 
								    <div class="col-sm-6" >
                                        <div class="form-group">
                                            <label class="form-label">Education Details<span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="txtEdudetails" placeholder="Enter Education Details"   value="<?php  echo $row['EducationDetails']; ?>"  maxlength="450"  rows="5"><?php  echo $row['EducationDetails']; ?></textarea>
                                        </div>
                                    </div>
								  <div class="col-sm-6" >
									<div class="form-group">
										<label class="form-label">Occupation Details<span class="text-danger">*</span></label>
										<textarea class="form-control" name="odetails" placeholder="Enter Occupation Details"  value="<?php  echo $row['occu_details']; ?>"  maxlength="450"  rows="5"><?php  echo $row['occu_details']; ?></textarea>
									</div>
								</div>
								  
								  	 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Employed in</label><br>
                                            <select class="skill-mlt-select form-control" name="txtEmp" id="txtEmp">
											<?php if($row['Employedin']!='') { ?>
										   <option value="<?php echo $row['Employedin']; ?>" selected><?php echo $row['Employedin']; ?></option>
										<?php }else { ?>
										  <option value="" selected>Select Employedin</option>
										<?php } ?>
										<?php  
												$occsql1=mysqli_query($con,"select * from employed_in  where status='enable'");
												while($occrow1=mysqli_fetch_array($occsql1))
												{
													if($occrow1['employed']==$row['Employedin'])
													{
													 ?>
														<option value="<?php  echo $occrow1['employed']; ?>" selected><?php  echo $occrow1['employed']; ?></option>
														<?php  
													}else
													{					
													?>
														<option value="<?php  echo $occrow1['employed']; ?>" ><?php  echo $occrow1['employed']; ?></option>
														<?php  
													}
												}
												?>
										
											<?php /*<option value="Business">Business</option>
											<option value="Defence">Defence</option>
											<option value="Government">Government</option>
											<option value="Not Employed in">Not Employed in</option>
											<option value="Private">Private</option>
											<option value="Others">Others</option> */ ?>

                                            </select>
                                        </div>
                                    </div>
									  <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Income <span class="text-danger">*</span></label>
                                            <select class="form-control" id="income" name="income" required>
                                                <option value="">Select Annual Income</option>
                                                <?php echo annual_income_select_options($row['Annualincome'] ?? ''); ?>
                                            </select>
                                        </div>  
                                  </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Income Type</label><br>
                                            <select class="skill-mlt-select form-control" name="inr" id="inr">
												<?php  if($row['income_in']=="")
												{?>
												<option value="" selected>Select </option>
												<?php  } else { ?>
												<option value="<?php  echo $row['income_in']?>" selected><?php  echo $row['income_in']?></option>
												<?php  } ?>
												<option value="Rs">Rs</option>

												<option value="Dollar">Dollar</option>
												<option value="VRO">VRO</option>
						 
                                            </select>
                                        </div>
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Working Hours</label><br>
                                            <select class="skill-mlt-select form-control" name="workinghrs" id="workinghrs">
										<?php if($row['working_hours']=="")
										{?>
										<option value="" selected>Select </option>
										<?php } else { ?>
										<option value="<?php echo $row['working_hours']?>"><?php echo $row['working_hours']?></option>
										<?php } ?>
										<?php 
										$occsql=mysqli_query($con,"select * from  working_hours");
										while($occrow=mysqli_fetch_array($occsql))
										{
										if($occrow['hours']==$rowfetch['working_hours'] )
										{
										?>
										<option value="<?php echo $occrow['hours']; ?>" selected><?php echo $occrow['hours']; ?></option>
										<?php
										}else
										{					
										?>
										<option value="<?php echo $occrow['hours']; ?>" ><?php echo $occrow['hours']; ?></option>
										<?php
										}
										}
										?>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Working Location/City</label><br>
                                            <input type="text" class="form-control" maxlength="40" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" id="workloc" name="workloc"  value="<?php echo $row['workinglocation']?>" placeholder="Name">
                                            <?php /*
                                            <select class="skill-mlt-select" name="workloc" id="workloc">
											<?php if($row['workinglocation']=="")
										{?>
										<option value="" selected>Select </option>
										<?php } else { ?>
										<option value="<?php echo $row['workinglocation']?>"><?php echo $row['workinglocation']?></option>
										<?php } ?>
												 <?php  
												  $occsql=mysqli_query($con,"select * from e_dist");
												  while($occrow=mysqli_fetch_array($occsql))
												  {
												  				
												  ?>
														 <option value="<?php  echo $occrow['dist']; ?>" ><?php  echo $occrow['dist']; ?></option>
														 <?php  
												 
											   }
											 ?>
                                            </select> */ ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        
                                            <div class="form-group">
                                                <label class="form-label">Height  <span class="text-danger">*</span></label><br>
                                                <select class="skill-mlt-select form-control" name="txtHeight" >
                                        
                                                <?php  if($row['Height']==""){?>
                                                <option value=""  selected>Height</option>
                                                <br>
                                                <?php  } else {?>
                                                <option value="<?php  echo $row['Height']; ?>" selected>
                                                <?php   get_height($row['Height']);?>
                                                <?php  } ?>
                                                <option value="1" >4Ft </option>
                                                <option value="2" >4Ft 1 inch </option>
                                                <option value="3" >4Ft 2 inch </option>
                                                <option value="4" >4Ft 3 inch </option>
                                                <option value="5" >4Ft 4 inch </option>
                                                <option value="6" >4Ft 5 inch </option>
                                                <option value="7" >4Ft 6 inch </option>
                                                <option value="8" >4Ft 7 inch </option>
                                                <option value="9" >4Ft 8 inch </option>
                                                <option value="10" >4Ft 9 inch </option>
                                                <option value="11" >4Ft 10 inch </option>
                                                <option value="12" >4Ft 11 inch </option>
                                                <option value="13" >5Ft </option>
                                                <option value="14" >5Ft 1 inch </option>
                                                <option value="15" >5Ft 2 inch </option>
                                                <option value="16" >5Ft 3 inch </option>
                                                <option value="17" >5Ft 4 inch </option>
                                                <option value="18" >5Ft 5 inch </option>
                                                <option value="19" >5Ft 6 inch </option>
                                                <option value="20" >5Ft 7 inch </option>
                                                <option value="21" >5Ft 8 inch </option>
                                                <option value="22" >5Ft 9 inch </option>
                                                <option value="23" >5Ft 10 inch </option>
                                                <option value="24" >5Ft 11 inch </option>
                                                <option value="25" >6Ft </option>
                                                <option value="26" >6Ft 1 inch </option>
                                                <option value="27" >6Ft 2 inch </option>
                                                <option value="28" >6Ft 3 inch </option>
                                                <option value="29" >6Ft 4 inch </option>
                                                <option value="30" >6Ft 5 inch </option>
                                                <option value="31" >6Ft 6 inch </option>
                                                <option value="32" >6Ft 7 inch </option>
                                                <option value="33" >6Ft 8 inch </option>
                                                <option value="34" >6Ft 9 inch </option>
                                                <option value="35" >6Ft 10 inch </option>
                                                <option value="36" >6Ft 11 inch </option>
                                                <option value="37" >7Ft </option>
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Weight  <span class="text-danger">*</span></label><br>
                                                
                                               <select class="skill-mlt-select form-control" name="txtWeight" tabindex="10">
                                                <?php
                                                    if($row['Weight'] == '')
                                                    {
                                                ?>
                                                <option value="" selected>Select Weight</option> 
                                                <?php
                                                    }
                                                    else
                                                    {
                                                ?>
                                                <option value="<?php echo $row['Weight']?>" selected><?php echo $row['Weight'];?> <?php echo " "; echo "kg"; ?> </option> 
                                                <?php
                                                    }
                                                ?>
                                              
                               <?php
                              $default="";
                              for($i=40;$i<=150;$i++)
                              {
                                if($row['Weight']==$i)
                                  $default="";
                                else
                                  $default="";
                                ?>
                                <option value="<?php echo $i;?>" <?php echo $default?>><?php echo $i." kg" ?></option>
                                <?php
                              }
                              ?>
                              </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Blood Group  <span class="text-danger">*</span></label><br>
                                                <select class="skill-mlt-select form-control"    name="BloodGroup">
                                                <?php  if($row['BloodGroup']==""){?>
                                                <option value=""  selected>Blood Group</option>
                                                <br>
                                              <?php  } else {?>
                                              <option value="<?php  echo $row['BloodGroup']; ?>" selected><?php  echo $row['BloodGroup']; ?></option>
                                              <?php  } ?>
                                        
                                                    <option>A+</option>
                                                    <option>A-</option>
                                                    <option>AB+</option>
                                                    <option>AB-</option>
                                                    <option>B+</option>
                                                    <option>B-</option>
                                                    <option>O+</option>
                                                    <option>O-</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label"> Complexion<span class="text-danger">*</span></label><br>
                                                <select class="skill-mlt-select form-control"  name="txtComplexion">
                                                <?php  if($row['Complexion']==""){?>
                                                <option value=""  selected>Complexion</option>
                                                <br>
                                                <?php  } else {?>
                                                <option value="<?php  echo $row['Complexion']; ?>"><?php  echo $row['Complexion']; ?></option>
                                                <?php  } ?>
                                                <option value="Only Fair">Only Fair</option>
                                                <option value="Very Fair">Very Fair</option>
                                                <option value="Wheatish Brown">Wheatish Brown</option>
                                                <option value="Dark">Dark</option>
                                                </select>
                                            </div>
                                        </div>


                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label"> Special Cases<span class="text-danger">*</span></label><br>
                                                <select class="skill-mlt-select form-control" name="scases" onChange="checkdiv(this.value);">
                                                
                                                <?php  if($row['spe_cases']=="") { ?>
                                                <option value="" selected >Select</option>
                                                <?php  } else { ?>
                                                <option value="<?php  echo $row['spe_cases'];?>" selected><?php  echo $row['spe_cases'];?></option>
                                                <?php  } ?>
                                                <option value="None">None</option>
                                                <option value="Physically Challenged From Birth">Physically Challenged From Birth</option>
                                                <option value="Physically Challenged due to Accident">Physically Challenged due to Accident</option>
                                                <option value="Mentally Challenged from Birth">Mentally Challenged from Birth</option>
                                                <option value="Physically Abnormality Affecting only looks">Physically Abnormality Affecting only looks</option>
                                                <option value="Physically Abnormality Affecting bodily Functions">Physically Abnormality Affecting bodily Functions</option>
                                                <option value="Physically &amp; Mentally Challenged">Physically &amp; Mentally Challenged</option>
                                                </select>
                                            </div>
                                        </div>


                                        <?php
                                            if( $row['spe_cases'] != 'None')
                                            {
                                        ?>
                                        <div class="col-sm-12" id="otherdist">
                                            <div class="form-group">

                                                <label class="form-label">Special Reason <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="otherdist"  maxlength="60" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" class="form-control" placeholder="Please Specify" ><?php  echo $row['spe_reason'];?></textarea>
                                            </div>
                                        </div>

                                        <?PHP

                                            }
                                            else
                                            {
                                        ?>     
                                        <div class="col-sm-12" id="otherdist" style="display: none;">
                                            <div class="form-group">

                                                <label class="form-label">Special Reason <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="otherdist"  maxlength="60" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" class="form-control" placeholder="Please Specify" ><?php  echo $row['spe_reason'];?></textarea>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        
                                    
							 </div>	
								
                            </div>
                          
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <!--<button class="btn btn-outline-dark ms-2">Clear</button>-->
                            </div>
                        </div>
						</form>
                    </div>
					
				 <!--Partner Preference-->
                    <?php
                        if($check == 3)
                        {
                    ?>
                    <div class="tab-pane fade show active" id="user-set-partner" role="tabpanel" aria-labelledby="user-set-partner-tab">
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="tab-pane fade" id="user-set-partner" role="tabpanel" aria-labelledby="user-set-partner-tab">
                    <?php
                        }

                    ?>
					 
					  <form action="edit_partner.php" method="post">
                        <div class="card">
                            <div class="card-header">
                                <h5><!-- <i data-feather="user" class="icon-svg-primary wid-20"></i> -->
                                    <img src="https://img.icons8.com/ios-filled/24/7267EF/date.png"/>
                                    <span class="p-l-5">Partner Preference</span></h5>
                            </div>
                            <div class="card-body">
							<?php include ('partnerprefrence.php') ?>
                            
								</form>
                            </div>
                          
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <!--<button class="btn btn-outline-dark ms-2">Clear</button>-->
                            </div>
                        </div>
                    </div>
					<?php
                        if($check == 4)
                        {
                    ?>
                    <div class="tab-pane fade show active" id="user-set-family" role="tabpanel" aria-labelledby="user-set-family-tab">
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="tab-pane fade" id="user-set-family" role="tabpanel" aria-labelledby="user-set-family-tab">
                    <?php
                        }
                    ?>
					 
					  <form action="edit_family.php" method="post">
                        <div class="card">
                            <div class="card-header">
                                <h5><!-- <i data-feather="user" class="icon-svg-primary wid-20"></i> -->
                                    <img src="https://img.icons8.com/windows/24/7267EF/defend-family--v3.png"/>
                                    <span class="p-l-5">Family Details</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
								 <div class="col-sm-6">
                                        <div class="form-group">
										<input type="hidden"  name="id" value="<?php  echo $_GET['ID'];?>">
                                            <label class="form-label">Family Values</label><br>								
                                            <select class="skill-mlt-select form-control"  name="txtFV" >
											<?php if($row['Familyvalues']!='') { ?>
										  <option value="<?php  echo $row['Familyvalues']; ?>" selected  >
											<?php  echo $row['Familyvalues']; ?></option>
											<?php }else { ?>
											   <option value="" selected>Select Family Values</option>
											<?php } ?>
											
											<option value="Traditional">Traditional</option>
											<option value="Orthodox">Orthodox</option>
											<option value="Liberal">Liberal</option>
											<option value="Moderate">Moderate</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Family Type</label><br>								
                                            <select class="skill-mlt-select form-control"  name="txtFT" >
											<?php if($row['FamilyType']!='') { ?>
										    <option value="<?php  echo $row['FamilyType']; ?>" selected  >
											<?php  echo $row['FamilyType']; ?></option>
											<?php }else { ?>
											   <option value="" selected>Select Family Type</option>
											<?php } ?>
											
											<option value="Nuclear Family">Nuclear Family</option>
											<option value="Joint Family" >Joint Family</option>
                                              </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Family Status</label><br>								
                                            <select class="skill-mlt-select form-control"  name="txtFS" >
											<?php if($row['FamilyStatus']!='') { ?>
										    <option value="<?php  echo $row['FamilyStatus']; ?>" selected  >
											<?php  echo $row['FamilyStatus']; ?></option>
											<?php }else { ?>
											   <option value="" selected>Select Family Status</option>
											   <?php } ?>
   										    <option value="Rich">Rich</option>
											<option value="High Class">High Class</option>
											<option value="Upper Middle Class">Upper Middle Class</option>
											<option value="Middle Class">Middle Class</option>
											<option value="Do not want to tell at this time">Do not want to tell at this time</option>
                                              </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Mother Tounge</label><br>								
                                            <select class="skill-mlt-select form-control"  name="mother_tounge" >
											<?php if($row['mother_tounge']!='') { ?>
										    <option value="<?php  echo $row['mother_tounge']; ?>" selected  >
											<?php  echo $row['mother_tounge']; ?></option>
											<?php }else { ?>	
                                            <option value="" selected>Select Mother Tounge</option>
											<?php } ?>											
   										    <option value="Assamese">Assamese </option>
											<option value="Bengali">Bengali</option>
											<option value="Bodo">Bodo</option>
											<option value="Dogri">Dogri</option>
											<option value="Gujarati">Gujarati</option>
											<option value="Hindi">Hindi</option>
											<option value="Kannada">Kannada</option>
											<option value="Kashmiri">Kashmiri</option>
											<option value="Konkani">Konkani</option>
											<option value="Maithili">Maithili</option>
											<option value="Malayalam">Malayalam</option>
											<option value="Manipuri">Manipuri</option>
											<option value="Marathi">Marathi</option>
											<option value="Nepali">Nepali</option>
											<option value="Odia">Odia</option>
											<option value="Punjabi">Punjabi</option>
											<option value="Sanskrit">Sanskrit</option>
											<option value="Santali">Santali</option>
											<option value="Sindhi">Sindhi</option>
											<option value="Tamil">Tamil</option>
											<option value="Telugu">Telugu</option>
											<option value="Urdu">Urdu</option>
                                              </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">No Of Brothers</label><br>							
                                            <select class="skill-mlt-select form-control"  name="txtFS1" id="noofbrom">
											<?php if($row['noofbrothers']!='') { ?>
										    <option value="<?php  echo $row['noofbrothers']; ?>" selected  >
											<?php  echo $row['noofbrothers']; ?></option>
											<?php }else { ?>
                                            <option value="" selected> No Of Brothers</option>
											<?php } ?>		
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="5+">5+</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">No Of Sisters</label><br>							
                                            <select class="skill-mlt-select form-control"  name="txtFS2" id="noofsism">.
											<?php if($row['noofsisters']!='') { ?>
										    <option value="<?php  echo $row['noofsisters']; ?>" selected  >
											<?php  echo $row['noofsisters']; ?></option>
											<?php }else { ?>
                                            <option value="" selected> No Of Sisters</option>
											<?php } ?>												
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="5+">5+</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6" id="noofbro6">
                                        <div class="form-group">
                                            <label class="form-label">No. Of Brothers Married</label><br>
                                            <select class="skill-mlt-select form-control"  name="bmarried6" >
											<?php  if($row['nbm']!=""){ ?>
											<option value="<?php  echo $row['nbm']; ?>" selected> <?php  echo $row['nbm']; ?></option>
											<?php }else { ?>
                                            <option value="" selected> No Of Brothers Married</option>
											<?php } ?>	
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="5+">5+</option>
                                            </select>
                                        </div>
                                    </div>
									
									<div class="col-sm-6" id="noofbro5">
                                        <div class="form-group">
                                            <label class="form-label">No. Of Brothers Married</label><br>					
                                            <select class="skill-mlt-select form-control"  name="bmarried5" >
											<?php  if($row['nbm']!=""){ ?>
											<option value="<?php  echo $row['nbm']; ?>" selected> <?php  echo $row['nbm']; ?></option>
											<?php  } ?>
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6" id="noofbro4">
                                       <div class="form-group">
                                            <label class="form-label">No. Of Brothers Married</label><br>					
                                            <select class="skill-mlt-select form-control"  name="bmarried4" >
											<?php  if($row['nbm']!=""){ ?>
											<option value="<?php  echo $row['nbm']; ?>" selected> <?php  echo $row['nbm']; ?></option>
											<?php  } ?>
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>											
                                            </select>
                                        </div>
									</div>
									<div class="col-sm-6" id="noofbro3">									
										 <div class="form-group">
                                            <label class="form-label">No. Of Brothers Married</label><br>					
                                            <select class="skill-mlt-select form-control"  name="bmarried3" >
											<?php  if($row['nbm']!=""){ ?>
											<option value="<?php  echo $row['nbm']; ?>" selected> <?php  echo $row['nbm']; ?></option>
											<?php  } ?>
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
																					
                                            </select>
                                        </div>
										</div>
										<div class="col-sm-6" id="noofbro2">									
										 <div class="form-group">
                                            <label class="form-label">No. Of Brothers Married</label><br>					
                                            <select class="skill-mlt-select form-control"  name="bmarried2" >
											<?php  if($row['nbm']!=""){ ?>
											<option value="<?php  echo $row['nbm']; ?>" selected> <?php  echo $row['nbm']; ?></option>
											<?php  } ?>
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>
											
																					
                                            </select>
                                        </div>
										</div>
										<div class="col-sm-6" id="noofbro1">									
										 <div class="form-group">
                                            <label class="form-label">No. Of Brothers Married</label><br>					
                                            <select class="skill-mlt-select form-control"  name="bmarried2" >
											<?php  if($row['nbm']!=""){ ?>
											<option value="<?php  echo $row['nbm']; ?>" selected> <?php  echo $row['nbm']; ?></option>
											<?php  } ?>
   										    <option value="No">No</option>
											<option value="1">1</option>		
                                            </select>
                                        </div>
										</div>
										<div class="col-sm-6" id="noofbrono">									
										 <div class="form-group">
                                            <label class="form-label">No. Of Brothers Married</label><br>					
                                            <select class="skill-mlt-select form-control"  name="bmarriedno" >
											<?php  if($row['nbm']!=""){ ?>
											<option value="<?php  echo $row['nbm']; ?>" selected> <?php  echo $row['nbm']; ?></option>
											<?php  } ?>
   										    <option value="No">No</option>												
                                            </select>
                                        </div>
										</div>
										
										<div class="col-sm-6" id="noofsis6">
                                        <div class="form-group">
                                            <label class="form-label">No Of Sisters Married</label><br>						
                                            <select class="skill-mlt-select form-control"  name="smarried6">
											 <?php  if($row['nsm']!="") { ?>
												<option value="<?php  echo $row['nsm']; ?>" selected> <?php  echo $row['nsm']; ?></option>
												<?php  } else {?>
												 <option value="" selected>No Of Sisters Married</option>
												<?php } ?>
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="5+">5+</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6" id="noofsis5">
                                        <div class="form-group">
                                            <label class="form-label">No Of Sisters Married</label><br>							
                                            <select class="skill-mlt-select form-control" name="smarried5">
											 <?php  if($row['nsm']!="") { ?>
												<option value="<?php  echo $row['nsm']; ?>" selected> <?php  echo $row['nsm']; ?></option>
												<?php  } ?>
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6" id="noofsis4">
                                        <div class="form-group">
                                            <label class="form-label">No Of Sisters Married</label><br>							
                                            <select class="skill-mlt-select form-control"  name="smarried4">
											 <?php  if($row['nsm']!="") { ?>
												<option value="<?php  echo $row['nsm']; ?>" selected> <?php  echo $row['nsm']; ?></option>
												<?php  } ?>
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6" id="noofsis3">
                                        <div class="form-group">
                                            <label class="form-label">No Of Sisters Married</label><br>							
                                            <select class="skill-mlt-select form-control"  name="smarried3">
											 <?php  if($row['nsm']!="") { ?>
												<option value="<?php  echo $row['nsm']; ?>" selected> <?php  echo $row['nsm']; ?></option>
												<?php  } ?>
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6" id="noofsis2">
                                        <div class="form-group">
                                            <label class="form-label">No Of Sisters Married</label><br>							
                                            <select class="skill-mlt-select form-control" name="smarried2">
											   <?php  if($row['nsm']!="") { ?>
												<option value="<?php  echo $row['nsm']; ?>" selected> <?php  echo $row['nsm']; ?></option>
												<?php  } ?>
   										    <option value="No">No</option>
											<option value="1">1</option>
											<option value="2">2</option>											
                                            </select>
                                        </div>
                                    </div>
										<div class="col-sm-6" id="noofsis1">
                                        <div class="form-group">
                                            <label class="form-label">No Of Sisters Married</label><br>							
                                            <select class="skill-mlt-select form-control"  name="smarried1">
											<option value="<?php  echo $row['nsm']; ?>" selected  >
											<?php  echo $row['nsm']; ?></option>
   										    <option value="No">No</option>
											<option value="1">1</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6" id="noofsisno">
                                        <div class="form-group">
                                            <label class="form-label">No Of Sisters Married</label><br>							
                                            <select class="skill-mlt-select form-control"  name="smarriedno">
											<option value="<?php  echo $row['nsm']; ?>" selected  >
											<?php  echo $row['nsm']; ?></option>
   										    <option value="No">No</option>
											</select>
                                        </div>
                                    </div>
										
                                   
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Father Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" maxlength="60" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" value="<?php  echo $row['Fathername']; ?>" onkeypress="return blockSpecialChar(event)" name="txtFANAME" id="txtFANAME" placeholder="Father Name">
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Father Occupation <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" maxlength="30"  value="<?php  echo $row['Fathersoccupation']; ?>" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" onkeypress="return blockSpecialChar(event)" name="txtFFO" id="txtFFO" placeholder="Father Occupation">
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Mother Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" maxlength="60" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" value="<?php  echo $row['Mothersname']; ?>" onkeypress="return blockSpecialChar(event)" name="txtMONAME" id="txtMONAME" placeholder="Mother Name">
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Mother Occupation<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" maxlength="30" value="<?php  echo $row['Mothersoccupation']; ?>" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" onkeypress="return blockSpecialChar(event)" name="txtFMO" id="txtFMO" placeholder="Mother Occupation">
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <div class="form-group">
										<?php  if($row['parents_stay']=="My parents will stay with me after marriage") { ?>
										<input type="radio" name="living_status"  value="My parents will stay with me after marriage"  tabindex="13" checked > <label class="form-label"> My parents will stay with me after marriage</label>
										<?php  } else {?>
										<input type="radio" name="living_status"  value="My parents will stay with me after marriage"  tabindex="13"> <label class="form-label "> My parents will stay with me after marriage</label>
										<?php  } ?>

										<br>
										<?php  if($row['parents_stay']=="My parents will not stay with me after marriage") { ?>
										<input type="radio" name="living_status"  value="My parents will not stay with me after marriage" tabindex="14" checked> <label class="form-label radio-align"> My parents will not stay with me after marriage</label>
										<?php  } else { ?>
										<input type="radio" name="living_status"  value="My parents will not stay with me after marriage" tabindex="14"> <label class="form-label radio-align"> My parents will not stay with me after marriage</label>
										<?php  } ?>
										<br>
										<?php  if($row['parents_stay']=="Dont wish to specify") { ?>
										<input type="radio" name="living_status" value="Dont wish to specify"  tabindex="15" checked><label class="form-label"> Don't wish to specify</label>
										<?php  } else { ?>
										<input type="radio" name="living_status" value="Dont wish to specify"  tabindex="15"> <label class="form-label"> Don't wish to specify</label>
										<?php  } ?>
										<br>
                                        </div>
                                    </div>
								
									<div class="col-sm-6" id="noofsis2">
                                        <div class="form-group">
                                            <label class="form-label">Family Wealth</label><br>							
                                            <select class="form-control" name="family_wealth[]" id="family_wealth" multiple="multiple">
											<?php if($row['family_wealth']!='') { ?>
										    <option value="<?php  echo $row['family_wealth']; ?>" selected  >
											<?php  echo $row['family_wealth']; ?></option>
											<?php }else { ?>
                                          <option value="" selected> Family Wealth</option>
											<?php } ?>
											 
											<?php  $family_wealth=mysqli_query($con,"select * from family_wealth ");
											while($family_we=mysqli_fetch_array($family_wealth)) { ?>
											 <option value="<?php  echo $family_we['wealth'];?>" ><?php  echo $family_we['wealth'];?></option>
												   <?php  }  ?>											
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Relatives Information<span class="text-danger">*</span></label>											
											<textarea  name="relatives" type="text" class="form-control" id="relatives" value="<?php echo $row['relatives']; ?>" size="40" maxlength="450" placeholder="Enter Relatives Information"><?php  echo $row['relatives']; ?></textarea>
                                          
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">About Family<span class="text-danger">*</span></label>											
											<textarea  name="txtAboutfamily" type="text" class="form-control" id="txtAboutfamily" value="<?php  echo $row['FamilyDetails']; ?>" size="40" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" maxlength="450" placeholder="About family"><?php  echo $row['FamilyDetails']; ?></textarea>
                                          
                                        </div>
                                    </div>
									 </div>
									<div class="card-footer text-end">
                                		<button class="btn btn-primary">Update Profile</button>
                                		<!--<button class="btn btn-outline-dark ms-2">Clear</button>-->
                            		</div>
                                </div>
                            </div>
                            
                   
                            
							</form>
                        </div>
                    <?php

                        if($check == 5)
                        {
                    ?>
                    <div class="tab-pane fade show active" id="user-set-contact" role="tabpanel" aria-labelledby="user-set-contact-tab">
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="tab-pane fade" id="user-set-contact" role="tabpanel" aria-labelledby="user-set-contact-tab">
                    <?php

                        }



                    ?>
					
                        <form action="edit_contact.php" method="post" >

                        <div class="card">
                            <div class="card-header">
                                <h5><!-- <i data-feather="user" class="icon-svg-primary wid-20"></i> -->
                                    <img src="https://img.icons8.com/ios-glyphs/24/7267EF/contact-card.png"/>
                                    <span class="p-l-5">Contact Information</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                 <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Address </label>
                                            <textarea name="txtAddress" id="txtAddress" maxlength="250" class="form-control" placeholder="Enter Address"><?php echo $row['Address']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Country</label> <span class="text-danger">*</span><br>
                                            <select class="skill-mlt-select form-control"  onchange="checkstate(this.value);"  name="country">
                                            <?php   /*$crs=$con->query("select * from e_country order by id ASC");?>
                                              <?php  if($row['Country']=="") { ?>
                                                 <option value="India" selected>India</option>
                                                <?php  } else { ?>
                                                <option value="<?php  echo $row['Country'];?>" selected><?php  echo $row['Country'];?></option>
                                                <?php  } while($crow=$crs->fetch_assoc()) { ?>
                                                <option value="<?php  echo $crow['country'];?>"><?php  echo $crow['country'];?></option>
                                                <?php   }   */?>
                                                <?php
                                                    if($row['Country']=="")
                                                    {
                                                ?>
                                                <option value="">Select Country</option>
                                                <option value="India">India</option>
                                                <option value="Out of India">Out of India </option>
                                                <?php
                                                    }
                                                    else
                                                    {
                                                ?>
                                                <option value="<?php  echo $row['Country'];?>"><?php  echo $row['Country'];?></option>
                                                <option value="India">India</option>
                                                <option value="Out of India">Out of India </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                        if($row['Country']=='India')
                                        {
                                    ?>
                                       <div class="col-sm-6" id="state_div" >
                                        <div class="form-group">
                                            <label class="form-label">State</label> <span class="text-danger">*</span><br>
                                            <select class="skill-mlt-select form-control"  id="state" onChange="filldist2(this.value)"  name="state">
                                            <?php  if($row['State']=="") { ?>
                                          <option value="" selected>Select State</option>
                                          <?php  } else { ?>
                                          <option value="<?php  echo $row['State'];?>" selected><?php  echo $row['State'];?></option>
                                          <?php  } ?>
                                          <?php  
                                            $rrs=mysqli_query($con,"select * from e_state where cid='India' ORDER BY state ASC");
                                            while($rrow=mysqli_fetch_array($rrs))
                                            {
                                            
                                                if($rrow['state']==$row['state'])
                                                {
                                                    ?>
                                          <option value="<?php  echo $rrow['State'];?>" selected><?php  echo $rrow['State'];?></option>
                                          <?php  
                                                }
                                                else
                                                {?>
                                          <option value="<?php  echo $rrow['state'];?>"><?php  echo $rrow['state'];?></option>
                                          <?php      } }?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                      <div class="col-sm-6" id="dist_div" >
                                        <div class="form-group">
                                            <label class="form-label">District</label> <span class="text-danger">*</span><br>
                                            <select class="skill-mlt-select form-control"  id="dist2"  name="dist">
                                              <?php  if($row['Dist']=="")   { ?>
                                        <option value="" selected>Select District</option>
                                        <?php  } else  { ?>
                                        <option value="<?php  echo $row['Dist'];?>" selected><?php  echo $row['Dist'];?></option>
                                        <?php  } ?>
                                        <?php  
                                            $rrs=mysqli_query($con,"select * from e_dist ");
                                            while($rrow=mysqli_fetch_array($rrs))
                                            {
                                                ?>
                                        <option value="<?php  echo $rrow['dist'];?>"><?php  echo $rrow['dist'];?></option>
                                        <?php       
                                          }
                                            ?>
                                         </select>
                                        </div>
                                     </div>
                                     <div class="col-sm-6" id="taluka_div">
                                        <div class="form-group">
                                            <label class="form-label">Taluka</label>
                                            <input name="taluka" type="text" class="form-control" value="<?php echo htmlspecialchars($row['Taluka'] ?? '', ENT_QUOTES); ?>" placeholder="Enter Taluka" maxlength="80" onKeyPress="return ValidateAlpha(event);">
                                        </div>
                                    </div>
                                     <div class="col-sm-6" id="city_div" >
                                        <div class="form-group">
                                            <label class="form-label">City</label>
                                          
                                            <input name="city" type="text" class="form-control" id="txtPhone"  value="<?php  echo $row['City']; ?>" placeholder="Enter City" maxlength="35"onKeyPress="return ValidateAlpha(event);">
                                        </div>
                                    </div>
                                     <div class="col-sm-6" id="pin_div" >
                                        <div class="form-group">
                                            <label class="form-label">Pincode</label>
                                          <input name="Pincode" type="text" maxlength="6" onkeypress="return isNumber(event)" class="form-control" value="<?php  echo $row['Pincode']; ?>" placeholder="Enter Country Code"  >
                                        </div>
                                    </div>
                                    <?php /*<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Alternate Phone  <span class="text-danger">*</span></label>
                                          <input name="txtPhone" type="text" class="form-control" id="txtPhone"  maxlength="10" onkeypress="return isNumber(event)" value="<?php  echo $row['Phone']; ?>"   onKeyUp="check_phone('txtPhone')" placeholder="Enter Phone No." oninput="maxLengthCheck(this)" maxlength="14" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>*/ ?>
                                    <?php
                                        }
                                    ?>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Residence</label><br>
                                         <select class="skill-mlt-select form-control"    name="residence">
                                            <?php  if($row['Residencystatus']==""){?>
                                              <option value="Citizen"  selected>Citizen</option>
                                              <br>
                                              <?php  } else {?>
                                              <option value="<?php   echo $row['Residencystatus']; ?>" selected><?php   echo $row['Residencystatus']; ?></option>
                                              <?php  } ?>
                                               <?php  $ch=mysqli_query($con,"select * from residency_status where residency_status!='".$row['Residencystatus']."'");
                                            while($fhh=mysqli_fetch_array($ch)) { ?>
                                            <option value="<?php  echo $fhh['residency_status'] ?>"><?php  echo $fhh['residency_status'] ?></option>
                                            <?php  }?>
                                            </select>
                                        </div>
                                    </div>
                                        
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Working Address </label>
                                            <textarea name="txtworkAddress" id="txtworkAddress" maxlength="250" class="form-control" placeholder="Enter Address"><?php echo $row['work_address']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-6" id="working_country_div">
                                        <div class="form-group">
                                            <label class="form-label">Working Country</label><br>
                                            <select class="skill-mlt-select form-control"  onchange="checkworkstate(this.value);"  name="working_country" >
                                            
                                                <?php
                                                    if( $row['working_country'] == "" )
                                                    {
                                                ?>
                                                <option value="">Select Country</option>
                                                <option value="India">India</option>
                                                <option value="Out of India">Out of India </option>
                                                <?php
                                                    }
                                                    else
                                                    {
                                                ?>
                                                <option value="<?php echo $row['working_country'] ?>" selected><?php echo $row['working_country'] ?> </option>
                                                <option value="India">India</option> 
                                                <option value="Out of India">Out of India </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6" id="working_state_div" >
                                        <div class="form-group">
                                            <label class="form-label">State</label><br>
                                            <select class="skill-mlt-select form-control"  id="working_state" onchange="filldist(this.value)"  name="working_state">
                                            <?php  if($row['working_state']=="") { ?>
                                          <option value="" selected>Select State</option>
                                          <?php  } else { ?>
                                          <option value="<?php  echo $row['working_state'];?>" selected><?php  echo $row['working_state'];?></option>
                                          <?php  } ?>
                                          <?php  
                                            $rrs=mysqli_query($con,"select * from e_state where cid='India' ORDER BY state ASC");
                                            while($rrow=mysqli_fetch_array($rrs))
                                            {
                                            
                                                if($rrow['state']==$row['state'])
                                                {
                                                    ?>
                                          <option value="<?php  echo $rrow['State'];?>" selected><?php  echo $rrow['State'];?></option>
                                          <?php  
                                                }
                                                else
                                                {?>
                                          <option value="<?php  echo $rrow['state'];?>"><?php  echo $rrow['state'];?></option>
                                          <?php      } }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6" id="working_dist_div" >
                                        <div class="form-group">
                                            <label class="form-label">District</label><br>
                                            <select class="skill-mlt-select form-control"  id="working_dist"  name="working_dist">
                                              <?php  if($row['working_dist']=="")   { ?>
                                        <option value="" selected>Select District</option>
                                        <?php  } else  { ?>
                                        <option value="<?php  echo $row['working_dist'];?>" selected><?php  echo $row['working_dist'];?></option>
                                        <?php  } ?>
                                        <?php  
                                           $rrs=mysqli_query($con,"select * from e_dist ");
                                            while($rrow=mysqli_fetch_array($rrs))
                                            {
                                                ?>
                                        <option value="<?php  echo $rrow['dist'];?>"><?php  echo $rrow['dist'];?></option>
                                        <?php       
                                          }
                                            ?>
                                         </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="working_taluka_div">
                                        <div class="form-group">
                                            <label class="form-label">Working Taluka</label>
                                            <input name="working_taluka" type="text" class="form-control" value="<?php echo htmlspecialchars($row['working_taluka'] ?? '', ENT_QUOTES); ?>" placeholder="Enter Working Taluka" maxlength="80" onKeyPress="return ValidateAlpha(event);">
                                        </div>
                                    </div>
                                     <div class="col-sm-6" id="working_city_div" >
                                        <div class="form-group">
                                            <label class="form-label">City <span class="text-danger">*</span></label>
                                          
                                            <input name="working_city" type="text" class="form-control" id="txtworkingcity" value="<?php echo htmlspecialchars($row['working_city'] ?? '', ENT_QUOTES); ?>" placeholder="Enter City" maxlength="35" onKeyPress="return ValidateAlpha(event);">
                                        </div>
                                    </div>

                                    <div class="col-sm-6" id="work_pin_div" >
                                        <div class="form-group">
                                            <label class="form-label">Pincode <span class="text-danger">*</span></label>
                                          <input name="work_pincode" type="text" maxlength="6" onkeypress="return isNumber(event)" class="form-control" value="<?php  echo $row['work_pincode']; ?>" placeholder="Enter Country Code"  >
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Residence<span class="text-danger">*</span></label><br>
                                         <select class="skill-mlt-select form-control" name="work_residence">
                                            <?php  if($row['work_residence']==""){?>
                                              <option value="Citizen"  selected>Citizen</option>
                                              <br>
                                              <?php  } else {?>
                                              <option value="<?php   echo $row['work_residence']; ?>" selected><?php   echo $row['work_residence']; ?></option>
                                              <?php  } ?>
                                               <?php  $ch=mysqli_query($con,"select * from residency_status where residency_status!='".$row['work_residence']."'");
                                            while($fhh=mysqli_fetch_array($ch)) { ?>
                                            <option value="<?php  echo $fhh['residency_status'] ?>"><?php  echo $fhh['residency_status'] ?></option>
                                            <?php  }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Mobile  <span class="text-danger">*</span></label>
                                          <input name="txtMobile" type="text" class="form-control" id="txtMobile"  maxlength="10" onkeypress="return isNumber(event)"value="<?php  echo $row['Mobile']; ?>" onBlur="ValidateNo()" placeholder="Enter Mobile No." oninput="maxLengthCheck(this)" maxlength="10" required onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Whatsapp No.  <span class="text-danger">*</span></label>
                                         <input name="txtMobile2" type="text" class="form-control" id="txtMobile1"  maxlength="10" onkeypress="return isNumber(event)" value="<?php  echo $row['Mobile2']; ?>"   onBlur="ValidateNo1()" placeholder="Enter Whtsapp No." oninput="maxLengthCheck(this)" maxlength="14" onkeypress="return isNumber(event)">
                                        </div>
                                        
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Convenient Time to Call <span class="text-danger">*</span></label><br>
                                            <select class="skill-mlt-select form-control" name="calling_time">
                                            <?php
                                                if($row['calling_time'] == '')
                                                {
                                            ?>
                                            <option value="">Select Convenient Time to Call</option>
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <option value="<?php echo $row['calling_time']; ?>"><?php echo $row['calling_time']; ?> </option>

                                            <?php
                                                }
                                            ?>
                                            

                                                <option value="Morning">Morning</option>
                                                <option value="Afternoon">Afternoon</option>
                                                <option value="Evening">Evening</option>
                                                <option value="Any time of day">Any time of day</option>
                                                <option value="Only on Sat/Sun & Holidays">Only on Sat/Sun & Holidays</option>
                                            </select>
                                        </div>
                                    </div>


                                    <?php
                                        /*if( ( ($row['Country']) == ($row['working_country']) ) && 
                                            ( ($row['State']) == ($row['working_state']) ) &&  
                                            ( ($row['Dist']) == ($row['working_dist']) ) &&
                                            ( ($row['City']) == ($row['working_city']) ) &&
                                            ( ($row['Address']) == ($row['work_address']) ) &&
                                            ( ($row['Residencystatus']) == ($row['work_residence']) ) &&
                                           ( ($row['Pincode']) == ($row['work_pincode']) ) 
                                          )
                                        {
                                            echo "1";
                                        }
                                        else
                                        {
                                            echo "0";
                                        }*/
                                    ?>
                                    
                                </div>
                            </div>
                          
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <!--<button class="btn btn-outline-dark ms-2">Clear</button>-->
                            </div>
                        </div>
                      </form>
                    </div>
					
					<div class="tab-pane fade" id="user-set-Basics" role="tabpanel" aria-labelledby="user-set-Basics-tab">
					      <form action="edit_physical.php" method="post">

                        <div class="card">
						
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Basics and Lifestyle</span></h5>
                            </div>
							
                            <div class="card-body">
                                <div class="row">
								    <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">

                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label class="form-label">Height  <span class="text-danger">*</span></label><br>
                                         <select class="skill-mlt-select form-control"    name="txtHeight" id="txtHeight">
										
                                             <?php  if($row['Height']==""){?>
											  <option value=""  selected>Height</option>
											  <br>
											  <?php  } else {?>
											  <option value="<?php  echo $row['Height']; ?>" selected>
										        <?php   get_height($row['Height']);?>
											  <?php  } ?>
										<option value="1" >4Ft </option>
											<option value="2" >4Ft 1 inch </option>
											<option value="3" >4Ft 2 inch </option>
											<option value="4" >4Ft 3 inch </option>
											<option value="5" >4Ft 4 inch </option>
											<option value="6" >4Ft 5 inch </option>
											<option value="7" >4Ft 6 inch </option>
											<option value="8" >4Ft 7 inch </option>
											<option value="9" >4Ft 8 inch </option>
											<option value="10" >4Ft 9 inch </option>
											<option value="11" >4Ft 10 inch </option>
											<option value="12" >4Ft 11 inch </option>
											<option value="13" >5Ft </option>
											<option value="14" >5Ft 1 inch </option>
											<option value="15" >5Ft 2 inch </option>
											<option value="16" >5Ft 3 inch </option>
											<option value="17" >5Ft 4 inch </option>
											<option value="18" >5Ft 5 inch </option>
											<option value="19" >5Ft 6 inch </option>
											<option value="20" >5Ft 7 inch </option>
											<option value="21" >5Ft 8 inch </option>
											<option value="22" >5Ft 9 inch </option>
											<option value="23" >5Ft 10 inch </option>
											<option value="24" >5Ft 11 inch </option>
											<option value="25" >6Ft </option>
											<option value="26" >6Ft 1 inch </option>
											<option value="27" >6Ft 2 inch </option>
											<option value="28" >6Ft 3 inch </option>
											<option value="29" >6Ft 4 inch </option>
											<option value="30" >6Ft 5 inch </option>
											<option value="31" >6Ft 6 inch </option>
											<option value="32" >6Ft 7 inch </option>
											<option value="33" >6Ft 8 inch </option>
											<option value="34" >6Ft 9 inch </option>
											<option value="35" >6Ft 10 inch </option>
											<option value="36" >6Ft 11 inch </option>
											<option value="37" >7Ft </option>
                                            </select>
                                        </div>
                                    </div>
									
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Weight  <span class="text-danger">*</span></label><br>
                                         <select class="skill-mlt-select form-control"    name="txtWeight">
										      <?php  if($row['Height']==""){?>
											  <option value=""  selected>Weight</option>
											  <br>
											  <?php  } else {?>
											  <option value="<?php  echo $row['Weight']; ?>" selected><?php  echo $row['Weight']; ?></option>
											  <?php  } ?>
											<option value="41 kg">41 kg</option>
											<option value="42 kg">42 kg</option>
											<option value="43 kg">43 kg</option>
											<option value="44 kg">44 kg</option>
											<option value="45 kg">45 kg</option>
											<option value="46 kg">46 kg</option>
											<option value="47 kg">47 kg</option>
											<option value="48 kg">48 kg</option>
											<option value="49 kg">49 kg</option>
											<option value="50 kg">50 kg</option>
											<option value="51 kg">51 kg</option>
											<option value="52 kg">52 kg</option>
											<option value="53 kg">53 kg</option>
											<option value="54 kg">54 kg</option>
											<option value="55 kg">55 kg</option>
											<option value="56 kg">56 kg</option>
											<option value="57 kg">57 kg</option>
											<option value="58 kg">58 kg</option>
											<option value="59 kg">59 kg</option>
											<option value="60 kg">60 kg</option>
											<option value="61 kg">61 kg</option>
											<option value="62 kg">62 kg</option>
											<option value="63 kg">63 kg</option>
											<option value="64 kg">64 kg</option>
											<option value="65 kg">65 kg</option>
											<option value="66 kg">66 kg</option>
											<option value="67 kg">67 kg</option>
											<option value="68 kg">68 kg</option>
											<option value="69 kg">69 kg</option>
											<option value="70 kg">70 kg</option>
											<option value="71 kg">71 kg</option>
											<option value="72 kg">72 kg</option>
											<option value="73 kg">73 kg</option>
											<option value="74 kg">74 kg</option>
											<option value="75 kg">75 kg</option>
											<option value="76 kg">76 kg</option>
											<option value="77 kg">77 kg</option>
											<option value="78 kg">78 kg</option>
											<option value="79 kg">79 kg</option>
											<option value="80 kg">80 kg</option>
											<option value="81 kg">81 kg</option>
											<option value="82 kg">82 kg</option>
											<option value="83 kg">83 kg</option>
											<option value="84 kg">84 kg</option>
											<option value="85 kg">85 kg</option>
											<option value="86 kg">86 kg</option>
											<option value="87 kg">87 kg</option>
											<option value="88 kg">88 kg</option>
											<option value="89 kg">89 kg</option>
											<option value="90 kg">90 kg</option>
											<option value="91 kg">91 kg</option>
											<option value="92 kg">92 kg</option>
											<option value="93 kg">93 kg</option>
											<option value="94 kg">94 kg</option>
											<option value="95 kg">95 kg</option>
											<option value="96 kg">96 kg</option>
											<option value="97 kg">97 kg</option>
											<option value="98 kg">98 kg</option>
											<option value="99 kg">99 kg</option>
											<option value="100 kg">100 kg</option>
											<option value="101 kg">101 kg</option>
											<option value="102 kg">102 kg</option>
											<option value="103 kg">103 kg</option>
											<option value="104 kg">104 kg</option>
											<option value="105 kg">105 kg</option>
											<option value="106 kg">106 kg</option>
											<option value="107 kg">107 kg</option>
											<option value="108 kg">108 kg</option>
											<option value="109 kg">109 kg</option>
											<option value="110 kg">110 kg</option>
											<option value="111 kg">111 kg</option>
											<option value="112 kg">112 kg</option>
											<option value="113 kg">113 kg</option>
											<option value="114 kg">114 kg</option>
											<option value="115 kg">115 kg</option>
											<option value="116 kg">116 kg</option>
											<option value="117 kg">117 kg</option>
											<option value="118 kg">118 kg</option>
											<option value="119 kg">119 kg</option>
											<option value="120 kg">120 kg</option>
											<option value="121 kg">121 kg</option>
											<option value="122 kg">122 kg</option>
											<option value="123 kg">123 kg</option>
											<option value="124 kg">124 kg</option>
											<option value="125 kg">125 kg</option>
											<option value="126 kg">126 kg</option>
											<option value="127 kg">127 kg</option>
											<option value="128 kg">128 kg</option>
											<option value="129 kg">129 kg</option>
											<option value="130 kg">139 kg</option>
											<option value="132 kg">130 kg</option>
											<option value="131 kg">131 kg</option>
											<option value="132 kg">132 kg</option>
											<option value="133 kg">133 kg</option>
											<option value="134 kg">134 kg</option>
											<option value="135 kg">135 kg</option>
											<option value="136 kg">136 kg</option>
											<option value="137 kg">137 kg</option>
											<option value="138 kg">138 kg</option>
											<option value="139 kg">139 kg</option>
											<option value="140 kg">140 kg</option>
                                            </select>
                                        </div>
										 </div>
										<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Blood Group  <span class="text-danger">*</span></label><br>
                                         <select class="skill-mlt-select form-control"    name="txtBlood">
										  <?php  if($row['BloodGroup']==""){?>
											  <option value=""  selected>Blood Group</option>
											  <br>
											  <?php  } else {?>
											  <option value="<?php  echo $row['BloodGroup']; ?>" selected><?php  echo $row['BloodGroup']; ?></option>
											  <?php  } ?>
										
													<option>A+</option>
													<option>A-</option>
													<option>AB+</option>
													<option>AB-</option>
													<option>B+</option>
													<option>B-</option>
													<option>O+</option>
													<option>O-</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Body Type<span class="text-danger">*</span></label><br>
                                         <select class="skill-mlt-select form-control"    name="txtBody">							  
										     <?php  if($row['Bodytype']==""){?>
											  <option value=""  selected>Body Type</option>
											  <br>
											  <?php  } else {?>
											 <option value="<?php  echo $row['Bodytype']; ?>"><?php  echo $row['Bodytype']; ?></option>
											  <?php  } ?>
												<option value="Slim">Slim</option>
												<option value="Average">Average</option>
												<option value="Heavy">Heavy</option>
												<option value="Athletic">Athletic</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Complexion<span class="text-danger">*</span></label><br>
                                         <select class="skill-mlt-select form-control"    name="txtComplexion">
										  <?php  if($row['Complexion']==""){?>
											  <option value=""  selected>Complexion</option>
											  <br>
											  <?php  } else {?>
											 <option value="<?php  echo $row['Complexion']; ?>"><?php  echo $row['Complexion']; ?></option>
											  <?php  } ?>
											<option value="Only Fair">Only Fair</option>
											<option value="Very Fair">Very Fair</option>
											<option value="Wheatish Brown">Wheatish Brown</option>
											<option value="Dark">Dark</option>
											 </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Diet<span class="text-danger">*</span></label><br>
										  <select class="skill-mlt-select form-control"    name="txtDiet">
										    <?php  if($row['Diet']==""){ ?>
											  <option value=""  selected>Diet</option>
											  <br>
											  <?php  } else {?>
											 <option value="<?php  echo $row['Diet']; ?>"><?php  echo $row['Diet']; ?></option>
											  <?php  } ?>
                                          <option value="<?php  echo $row['Diet']; ?>"><?php  echo $row['Diet']; ?></option>
										  <option value="Veg">Veg</option>
										  <option value="Eggetarian">Eggetarian</option>
										  <option value="Occasionally Non-Veg">Occasionally Non-Veg</option>
										  <option value="Non-Veg">Non-Veg</option>
										  <option value="Jain">Jain</option>
										  <option value="Vegan">Vegan</option>
										  </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Smoke<span class="text-danger">*</span></label><br>
										  <select class="skill-mlt-select form-control"    name="txtSmoke">
										   <?php  if($row['Smoke']==""){ ?>
											  <option value=""  selected>Smoke</option>
											  <br>
											  <?php  } else {?>
											 <option value="<?php  echo $row['Smoke']; ?>"><?php  echo $row['Smoke']; ?></option>
											  <?php  } ?>
										    <option value="Yes">Yes</option>
											<option value="No">No</option>
											<option value="Occasionally">Occasionally</option>
										  </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Drink<span class="text-danger">*</span></label><br>
										  <select class="skill-mlt-select form-control"    name="txtDrink">
										  <?php  if($row['Drink']==""){ ?>
											  <option value=""  selected>Drink</option>
											  <br>
											  <?php  } else {?>
											 <option value="<?php  echo $row['Drink']; ?>"><?php  echo $row['Drink']; ?></option>
											  <?php  } ?>
                                            
										    <option value="Yes">Yes</option>
											<option value="No">No</option>
											<option value="Occasionally">Occasionally</option>
										  </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Special Cases<span class="text-danger">*</span></label><br>
										  <select class="skill-mlt-select form-control"   name="scases" id="scases" size="1" class="form-control" onChange="showotherdist(this.value);" >
										  <?php  if($row['spe_cases']=="") { ?>
										  <option value="" selected >Select</option>
										  <?php  } else { ?>
										  <option value="<?php  echo $row['spe_cases'];?>" selected><?php  echo $row['spe_cases'];?></option>
										  <?php  } ?>
										  <option value="None">None</option>
										  <option value="Physically Challenged From Birth">Physically Challenged From Birth</option>
										  <option value="Physically Challenged due to Accident">Physically Challenged due to Accident</option>
										  <option value="Mentally Challenged from Birth">Mentally Challenged from Birth</option>
										  <option value="Physically Abnormality Affecting only looks">Physically Abnormality Affecting only looks</option>
										  <option value="Physically Abnormality Affecting bodily Functions">Physically Abnormality Affecting bodily Functions</option>
										  <option value="Physically &amp; Mentally Challenged">Physically &amp; Mentally Challenged</option>
										  </select>
                                        </div>
                                    </div>
													
								
								 <div class="col-sm-6" id="otherdist">
                                        <div class="form-group">

                                            <label class="form-label">Special Reason <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="otherdist"  maxlength="60" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" class="form-control" placeholder="Please Specify" ><?php  echo $row['spe_reason'];?></textarea>
                                        </div>
                                    </div>
                            </div>
                          </div>
                     
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <!--<button class="btn btn-outline-dark ms-2">Clear</button>-->
                            </div>
                        </div>
					</form>
				  </div>
					<?php

                        if($check == 7)
                        {
                    ?>
                    <div class="tab-pane fade show active" id="user-set-Horoscope" role="tabpanel" aria-labelledby="user-set-Horoscope-tab">
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="tab-pane fade" id="user-set-Horoscope" role="tabpanel" aria-labelledby="user-set-Horoscope-tab">
                    <?php
                        }

                    ?>
				
					      <form action="edit_horoscope.php" method="post">

                        <div class="card">
                            <div class="card-header">
                                <h5><!-- <i data-feather="user" class="icon-svg-primary wid-20"></i> -->
                                    <img src="https://img.icons8.com/external-vitaliy-gorbachev-fill-vitaly-gorbachev/24/7267EF/external-horoscope-chinese-new-year-vitaliy-gorbachev-fill-vitaly-gorbachev.png"/>
                                    <span class="p-l-5">Horoscope Information</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
								 <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">

								<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Moonsign<span class="text-danger">*</span> </label><br>
										  <select class="skill-mlt-select form-control"    name="txtMoon">
										  <?php  if($row['Moonsign']=="")
											{?>
											<option value="" selected>Select Moonsign </option>
											<?php  } else { ?>
											<option value="<?php  echo $row['Moonsign']?>" selected><?php  echo $row['Moonsign']?></option>
											<?php  } ?> 
											<?php  $nakshatrasql=$con->query("select * from moon_sign where status='enable'");
											while($nakshatrarow=$nakshatrasql->fetch_array())
											{
											?>
											<option value="<?php  echo $nakshatrarow['Moon_Sign'];?>" ><?php  echo $nakshatrarow['Moon_Sign'];?></option>
											<?php  	
											}
											?>
										  </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Star<span class="text-danger">*</span> </label><br>
										  <select class="skill-mlt-select form-control"    name="txtStar">
										   <?php  if($row['Star']=="")
											{?>
											<option value="" selected>Select Star</option>
											<?php  } else { ?>
											<option value="<?php  echo $row['Star']?>" selected><?php  echo $row['Star']?></option>
											<?php  } ?> 
											
										   <?php       $nakshatrasql=$con->query("select * from nakshatra where status='enable'");
												while($nakshatrarow=$nakshatrasql->fetch_array())
												{?>
												<option value="<?php  echo $nakshatrarow['Nakshatra'];?>" ><?php  echo $nakshatrarow['Nakshatra'];?></option>
												<?php  	
												} ?>
										  </select>
                                        </div>
                                    </div>							
								
								
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Gotra </label>
                                            <input type="text" class="form-control"  maxlength="20" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" name="txtGothra" value="<?php  echo $row['Gothram']; ?>" placeholder="Enter Gotra">
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Manglik </label><br>
										  <select class="skill-mlt-select form-control"    name="txtManglik">
										  <?php  if($row['Manglik']=="")
											{?>
											<option value="" selected>Select Manglik</option>
											<?php  } else { ?>
											<option value="<?php  echo $row['Manglik']?>" selected><?php  echo $row['Manglik']?></option>
											<?php  } ?> 
											<option value="No">No</option>
											<option value="Yes">Yes</option>
											<option value="Do not know">Do not know</option>
											<option value="Not applicable">Not applicable</option>
										  </select>
                                        </div>
                                    </div>	
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Shani </label><br>
										  <select class="skill-mlt-select form-control"    name="shani">
											<?php  if($row['shani']=="")
											{?>
											<option value="" selected>Select Shani</option>
											<?php  } else { ?>
											<option value="<?php  echo $row['shani']?>" selected><?php  echo $row['shani']?></option>
											<?php  } ?> 
											<?php  
											$shani=mysqli_query($con,"select * from shani where type!='".$row1['shani']."'");
											while($fect=mysqli_fetch_array($shani))
											{	?>
											<option value="<?php  echo $fect['type'] ?>"><?php  echo $fect['type'] ?></option>
											<?php  }?>
											</select>
                                        </div>
                                    </div>	
                                 
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Horoscope Match </label><br>
										  <select class="skill-mlt-select form-control"   name="txtHorosMatch">
											  <?php  if($row['Horosmatch']=="")
											{?>
											<option value="" selected>Horoscope Match</option>
											<?php  } else { ?>
											<option value="<?php  echo $row['Horosmatch']?>" selected><?php  echo $row['Horosmatch']?></option>
											<?php  } ?> 
											
											<option value="No">No</option>
											<option value="Yes">Yes</option>
											<option value="Does not matter">Does not matter</option>
										  </select>
                                        </div>
                                    </div>	
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Place Of Birth  </label>
                                            <input type="text" class="form-control"  name="bplace" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" maxlength="30" value="<?php  echo $row['POB'];?>" placeholder="Enter Place Of Birth " >
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Place Of Country  </label>
                                            <input type="text" class="form-control"  maxlength="30" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" name="cplace" value="<?php  echo $row['POC'];?>" placeholder="Enter Place Of Country " >
                                        </div>
                                    </div>
                                   
								   <?php  
										$tm1="ok";
										if($row['TOB']!="")
										$tm=explode(":",$row['TOB']);
										else
										$tm1="";
										?>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Time Of Birth </label><br>
										  <select class="skill-mlt-select form-control" name="bhour">
										     
											   <?php  
								   if(($tm1=="")||($tm[0]==""))
								   {
								   ?>
											<option  value="" selected>Hours</option>
											<?php  
								   }
								   else
								   {
								   ?>
											<option  value="<?php  echo $tm[0];?>" selected><?php  echo $tm[0];?></option>
											<?php  
								   }
								   ?>
											
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										  </select>
                                        </div>
                                    </div>	
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Minute </label><br>
										  <select class="skill-mlt-select form-control" name="bminute">
											   <?php  
								   if(($tm1=="")||($tm[1]==""))
								   {
								   ?>
											<option selected="selected" value="">Minute</option>
											<?php  
								   }
								   else
								   {
								   ?>
											<option selected="selected" value="<?php  echo $tm[1];?>"><?php  echo $tm[1];?></option>
											<?php  
								   }
								   ?>
											
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
											<option value="31">31</option>
											<option value="32">32</option>
											<option value="33">33</option>
											<option value="34">34</option>
											<option value="35">35</option>
											<option value="36">36</option>
											<option value="37">37</option>
											<option value="38">38</option>
											<option value="37">37</option>
											<option value="38">38</option>
											<option value="39">39</option>
											<option value="40">40</option>
											<option value="41">41</option>
											<option value="42">42</option>
											<option value="43">43</option>
											<option value="44">44</option>
											<option value="45">45</option>
											<option value="46">46</option>
											<option value="47">47</option>
											<option value="48">48</option>
											<option value="49">49</option>
											<option value="50">50</option>
											<option value="51">51</option>
											<option value="52">52</option>
											<option value="53">53</option>
											<option value="54">54</option>
											<option value="55">55</option>
											<option value="56">56</option>
											<option value="57">57</option>
											<option value="58">58</option>
											<option value="59">59</option>
											<option  value="00" >00</option>
										  </select>
                                        </div>
                                    </div>	
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Second</label><br>
										  <select class="skill-mlt-select form-control" name="bsecond">
											     <?php  
								   if(($tm1=="")||($tm[2]==""))
								   {
								   ?>
											<option selected="selected" value="">second</option>
											<?php  
								   }
								   else
								   {
								   ?>
											<option selected="selected" value="<?php  echo $tm[2];?>"><?php  echo $tm[2];?></option>
											<?php  
								   }
								   ?>
														
														<option value="01">01</option>
														<option value="02">02</option>
														<option value="03">03</option>
														<option value="04">04</option>
														<option value="05">05</option>
														<option value="06">06</option>
														<option value="07">07</option>
														<option value="08">08</option>
														<option value="09">09</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
														<option value="13">13</option>
														<option value="14">14</option>
														<option value="15">15</option>
														<option value="16">16</option>
														<option value="17">17</option>
														<option value="18">18</option>
														<option value="19">19</option>
														<option value="20">20</option>
														<option value="21">21</option>
														<option value="22">22</option>
														<option value="23">23</option>
														<option value="24">24</option>
														<option value="25">25</option>
														<option value="26">26</option>
														<option value="27">27</option>
														<option value="28">28</option>
														<option value="29">29</option>
														<option value="30">30</option>
														<option value="31">31</option>
														<option value="32">32</option>
														<option value="33">33</option>
														<option value="34">34</option>
														<option value="35">35</option>
														<option value="36">36</option>
														<option value="37">37</option>
														<option value="38">38</option>
														<option value="37">37</option>
														<option value="38">38</option>
														<option value="39">39</option>
														<option value="40">40</option>
														<option value="41">41</option>
														<option value="42">42</option>
														<option value="43">43</option>
														<option value="44">44</option>
														<option value="45">45</option>
														<option value="46">46</option>
														<option value="47">47</option>
														<option value="48">48</option>
														<option value="49">49</option>
														<option value="50">50</option>
														<option value="51">51</option>
														<option value="52">52</option>
														<option value="53">53</option>
														<option value="54">54</option>
														<option value="55">55</option>
														<option value="56">56</option>
														<option value="57">57</option>
														<option value="58">58</option>
														<option value="59">59</option>
														<option  value="00" >00</option>
													 </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> AM/PM </label><br>
										  <select class="skill-mlt-select form-control" name="bampm">
											  <?php  
											   if(($tm1=="")||($tm[3]==""))
											   {
											   ?>
														<option selected="selected" value="">bampm</option>
														<?php  
											   }
											   else
											   {
											   ?>
														<option selected="selected" value="<?php  echo $tm[3];?>"><?php  echo $tm[3];?></option>
														<?php  
											   }
											   ?>
													
													<option value="AM">AM</option>
													<option value="PM">PM</option>
										  </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Charan </label><br>
                                          <select name="charan" class="skill-mlt-select form-control" >
                                            <?PHP 
                                                if( $row['charan'] != "")
                                                {
                                            ?>
                                            <option value="<?php echo $row['charan']?>" selected><?php echo $row['charan']?></option>
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <option value="" selected>Select Charan</option>
                                            <?php
                                                }
                                            ?>
                                            
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="I dont Know">I don't Know</option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Nadi </label><br>
                                          <select name="nadi" class="skill-mlt-select form-control" tabindex="">
                                            <?PHP 
                                                if( $row['nadi'] != "")
                                                {
                                            ?>
                                            <option value="<?php echo $row['nadi']?>" selected><?php echo $row['nadi']?></option>
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <option value="" selected>Select Nadi</option>
                                            <?php
                                                }
                                            ?>
                                            
                                            <option value="Adya">Adya</option>
                                            <option value="Antya">Antya</option>
                                            <option value="Madhya">Madhya</option>
                                            <option value="I dont Know">I don't Know</option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label"> Gan </label><br>
                                          <select name="gan" class="skill-mlt-select form-control" tabindex="">
                                            <?PHP 
                                                if( $row['Gan'] != "")
                                                {
                                            ?>
                                            <option value="<?php echo $row['Gan']?>" selected><?php echo $row['Gan']?></option>
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <option value="" selected>Select Gan</option>
                                            <?php
                                                }
                                            ?>
                                            
                                           <option value="Dev">Dev</option>
                                            <option value="Manushya">Manushya</option>
                                            <option value="Rakshas">Rakshas</option>
                                            <option value="I dont Know">I don't Know</option>
                                        </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                          
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <!--<button class="btn btn-outline-dark ms-2">Clear</button>-->
                            </div>
                        </div>
						</form>
                    </div>

					<!--Upload Photo  -->
                    <?php
                        if($check == 8 )
                        {
                    ?>
                    <div class="tab-pane fade show active" id="user-set-photo" role="tabpanel" aria-labelledby="user-set-photo-tab">
                    <?php 
                        }
                        else
                        {
                    ?>
                    <div class="tab-pane fade" id="user-set-photo" role="tabpanel" aria-labelledby="user-set-photo-tab">
                    <?php
                        }
                    ?>
					
					  <form action="#" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h5><!-- <i data-feather="user" class="icon-svg-primary wid-20"></i> -->
                                    <img src="https://img.icons8.com/ios-filled/24/7267EF/camera--v2.png"/>
                                    <span class="p-l-5">Upload Photo</span></h5>
                            </div>
                            <div class="card-body">
							
								<?php if (isset($_FILES['fileToUpload3']['name']) && !empty($_FILES['fileToUpload3']['name'])){
											
										
										$old='../'.$_POST['old'];
											$filename3 =date('Y_m_d_h_i_s').basename($_FILES['fileToUpload3']['name']);
											 $ext3= substr($filename, strrpos($filename, '.') + 1);
											  if (($ext == "jpg"||"jpeg") && ($_FILES["fileToUpload3"]["name"] == "image/jpeg") && ($_FILES["fileToUpload3"]["size"] <  450000)) {
											//Determine the path to which we want to save this file
											$targetPath = "../gallary/".$filename3;
											if(file_exists($targetPath))
											{
												unlink($targetPath);
											}else if(file_exists($old))
											{
												unlink($old);
											  } }
										$target_dir = "../gallary/";
										$watermarkImagePath = '../images/watermark.png'; 

										$target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload3']["name"]));
										$sav3=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload3']["name"]));
										$UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["fileToUpload3"]["name"];
										$uploadOk = 1;
										$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
										// Check if image file is a actual image or fake image

										if(isset($_POST["submit"]))
											{
												
										$check = getimagesize($_FILES["fileToUpload3"]["tmp_name"]);
										if($check !== false) {
											
										define("success3","Photo File is an image - " . $check["mime"] . ".");

										$uploadOk = 1;
										} else {
										define("success3","Your Photo is not an image.");
										$uploadOk = 0;
										}
										}
										// Check if file already exists
										if (file_exists($target_file)) {
										define("success3","Sorry, This Photo already exists.");
										$uploadOk = 0;
										}
										// Check file size
										if ($_FILES["fileToUpload3"]["size"] > 8097152) {
										define("success3","Sorry, Your photo size is too large.");
										$uploadOk = 0;
										}
                                        else
                                        {
                                            // Allow certain file formats
										if($imageFileType != "jpg" && $imageFileType != "jpeg" ) {
										define("success3","Sorry, Photos  are  allow only JPG, JPEG Format.");
										$uploadOk = 0;
										}
										// Check if $uploadOk is set to 0 by an error
										if ($uploadOk == 0) {
										define("success3","Sorry, your photo was not uploaded.");
										// if everything is ok, try to upload file
										} else {
										if (move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"], $target_file)) {
											/*$allowTypes = array('jpg','png','jpeg'); 
										if(in_array($imageFileType, $allowTypes)){ 
											// Upload file to the server 
										  
												// Load the stamp and the photo to apply the watermark to 
												$watermarkImg = imagecreatefrompng($watermarkImagePath); 
												switch($imageFileType)
                                                { 
													case 'jpg': 
														$im = imagecreatefromjpeg($target_file); 
														break; 
													case 'jpeg': 
														$im = imagecreatefromjpeg($target_file); 
														break; 
													case 'png': 
														$im = imagecreatefrompng($target_file); 
														break; 
													default: 
														$im = imagecreatefromjpeg($target_file); 
												} 
												 
												// Set the margins for the watermark 
												$marge_right = 50; 
												$marge_bottom = 45; 
												 
												// Get the height/width of the watermark image 
												$sx = imagesx($watermarkImg); 
												$sy = imagesy($watermarkImg); 
												 
												// Copy the watermark image onto our photo using the margin offsets and  
												// the photo width to calculate the positioning of the watermark. 
												imagecopy($im, $watermarkImg, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($watermarkImg), imagesy($watermarkImg)); 
												 
												// Save image and free memory 
												imagejpeg($im, $target_file); 
												imagedestroy($im);*/ 
											//$strmid=$_GET['ID']; 
										$reg12=mysqli_query($con,"Select * from register where MatriID='$strmid'");
			
										$regfet=mysqli_fetch_array($reg12);
										$reg_step=$regfet['reg_step'];
										//echo $reg_step;

										if($reg_step<7)
										{
										mysqli_query($con,"update register set Photo1='$sav3',Photo1Approve='Yes',reg_step='7' where MatriID='$strmid'");
											
										}
										else 
										{
										 mysqli_query($con,"update register set Photo1='$sav3',Photo1Approve='Yes' where MatriID='$strmid'");
										 
										}
                                         mysqli_query($con,"insert into gallary(photo_name,matri_id,photo_approve) values('$sav3','$strmid','Yes')")or svr_db_fail($con);
										
										
										define("success3","Your Photo Uploaded Successfully.");
										
										header('location:profile_view?ID='.$strmid);	
										} 
										else {
										define("success3","Sorry, there was an error uploading your photo.");

										}
										
                                            
                                        }
										}

										}
										else
										{
											define("success3","Please select the file.");
											
										}
										?>
											<?php $result4=mysqli_query($con,"SELECT * FROM register where MatriID='$strmid'");
												 $row4 = mysqli_fetch_assoc($result4);?>
										<div class="col-sm-12">
											<?php if(($row4['Photo1']!="")&&($row4['Photo1']!="nophoto.jpg")){ ?>
												<img src="../photoprocess.php?image=gallary/<?php echo $row4['Photo1']?>&square=500" />
										  
											<?php } else { ?>
											 
											 <img src="" style="display:none"  id="thumbnil">
											<div class=" " align="center" id="continue123" style="display:none">  </div>
											<br><br>
											
										 <br>
											<h4 align="center"><label for="upload_photo" class="btn btn-primary" style="background:#007bff">Browse</label></h4>
                                            <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">  
              			                <input name="fileToUpload3" style="visibility:hidden;" id="upload_photo" type="file" onchange="showMyImage2(this);" />
									<?php } ?>
								   
							      
                         </div>
                   
                            <div class="card-footer text-end">
							<?php if($row4['Photo1']!="" && $row4['Photo1']!="nophoto.jpg"){ ?>
							<a class="btn btn-outline-dark ms-2" href="delete_profile_photo?ID=<?php echo $strmid; ?>" onclick="return confirm('Are You Really Want To Delete This Photo...?  Click OK To Confirm...?')">Delete</a>
							<?php }else 
                                { 
                            ?> 
								<a href="profile_view?ID=<?php  echo $strmid?>"><input type="button" value="Back" class="btn btn-primary"></a>
								<button class="btn btn-outline-dark ms-2" name="sub3" type="submit">Submit</button>
                            <?php 
                                } 
                            ?>
                            </div>
								</div>
						</form>
                    </div>
					 </div>	
					
					<!--Upload ID Proof  -->
                    <?php
                        if( $check == 9)
                        {
                    ?>
                    <div class="tab-pane fade show active" id="user-set-Idproof" role="tabpanel" aria-labelledby="user-set-Idproof-tab">
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="tab-pane fade" id="user-set-Idproof" role="tabpanel" aria-labelledby="user-set-Idproof-tab">
                    <?php
                        }

                    ?>
					
					  <form action="#" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h5><!-- <i data-feather="user" class="icon-svg-primary wid-20"></i> -->
                                    <img src="https://img.icons8.com/ios-filled/28/7267EF/name-tag-woman.png"/>
                                    <span class="p-l-5">Upload ID Proof</span></h5>
                            </div>
                            <div class="card-body">
							
								<?php if (isset($_FILES['fileToUpload1']['name']) && !empty($_FILES['fileToUpload1']['name']))
								{

										$old='../'.$_POST['old'];
											$filename =date('Y_m_d_h_i_s').basename($_FILES['fileToUpload1']['name']);
											 $ext = substr($filename, strrpos($filename, '.') + 1);
											  if (($ext == "jpg"||"jpeg") && ($_FILES["fileToUpload1"]["name"] == "image/jpeg") && ($_FILES["fileToUpload1"]["size"] < 450000)) 
											  {
                                                if(file_exists($targetPath))
											{
												unlink($targetPath);
											}else if(file_exists($old))
											{
												unlink($old);
											  } 
										 }
										$target_dir = "../adhar/";
										$target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload1']["name"]));
										$sav6=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload1']["name"]));
										$UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["fileToUpload1"]["name"];
										$uploadOk = 1;
										$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
										// Check if image file is a actual image or fake image

										if(isset($_POST["submit"]))
											{
												
										$check = getimagesize($_FILES["fileToUpload1"]["tmp_name"]);
										if($check !== false) {
											
										define("success2","ID Proof File is an image - " . $check["mime"] . ".");

										$uploadOk = 1;
										} else {
										define("success2","ID Proof File is not an image.");
										$uploadOk = 0;
										}
										}
										// Check if file already exists
										if (file_exists($target_file)) {
										define("success2","Sorry, ID Proof file already exists.");
										$uploadOk = 0;
										}
										// Check file size
										if ($_FILES["fileToUpload1"]["size"] > 8097152) {
										define("success2","Sorry, ID Proof file is too large.");
										$uploadOk = 0;
										}
										// Allow certain file formats
										if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "pdf" ) {
										define("success2","Sorry, ID Proof file is allow  only JPG, JPEG Format.");
										$uploadOk = 0;
										}
										// Check if $uploadOk is set to 0 by an error
										if ($uploadOk == 0) {
										define("success2","Sorry, your ID Proof file was not uploaded.");
										// if everything is ok, try to upload file
										} else {
										if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file)) {
											$strmid=$_GET['ID']; 
										$reg=mysqli_query($con,"Select * from register where MatriID='$strmid'");
										$regfet=mysqli_fetch_array($reg);
										$reg_step=$regfet['reg_step'];
										echo $reg_step;

										if($reg_step<8)
										{
										 mysqli_query($con,"update register set adhar='$sav6',idproof_approve='Yes',reg_step='8' where MatriID='$strmid'");
										}else {
										mysqli_query($con,"update register set adhar='$sav6',idproof_approve='Yes' where MatriID='$strmid'");
										}
										define("success2","Your ID Proof File Uploaded Successfully.");
										//header('location:profile_view?ID='.$strmid);	
										} 
										else {
										define("success2","Sorry, there was an error uploading your ID Proof file.");

										}
										}

										} 
										else
										{
											define("success2","Please select the file.");
										}?>
									<?php
										
										$result3 =mysqli_query($con,"SELECT * FROM register where MatriID='$strmid' ");
										//echo "SELECT * FROM register where MatriID='$strmid'";
										$row3 = mysqli_fetch_assoc($result3);
										 ?>
										 
									 <div class="col-sm-12">
											<?php if($row3['adhar']!=""){ ?>
                                          <?php  $ext=".pdf";

									function endsWith($img, $ext){
									$extLength = strlen($ext);
									if(substr($img, -$extLength) == $ext){
										return true;
									}
									return false;
									} 
									If(endsWith($row3['adhar'], ".pdf")){ //executes if return is true
										//echo $row['adhar'];
										//echo '<img src="http://example.com/image.png" /></a><p>';?>
										<iframe src="../adhar/<?php echo $row3['adhar'];?>"></iframe><p>
									<?php }
									else
									{   //executes if return is false
										echo '<figure class="image"> <a href="../adhar/'.$row3['adhar'].'"> <img src="../adhar/'.$row3['adhar'].'" ;/></a></figure>';

										} ?>
										
										
										  <!--<img src="../adhar/<?php //echo $row3['adhar']?>" />-->
										  
											<?php } else { ?>
											 
											 <img src="" style="display:none" id="thumbnil4">
											<div class=" " align="center" id="continue1234" style="display:none"></div>
											 <br><br>
											
										<!--<select class="form-control selcs" name="document" style="max-width:64%" align="center">
												<option value="Aadhaar Card" selected="selected">Aadhaar Card</option>
												<option value="Voting Card">Voting Card</option>
												<option value="Driving License">Driving License</option>
												<option value="Passport" >Passport</option>
											</select>--> <br>
											<h4 align="center"><label for="upload1" class="btn btn-primary" style="background:#007bff">Browse</label></h4>
                                            <input type="hidden" name="ID" value="<?php echo $_GET['ID'];?>">  
              			                <input name="fileToUpload1" style="visibility:hidden;" id="upload1" type="file" onchange="showMyImage(this);" />
									<?php } ?>
								   
							      
                         </div>
                   
                            <div class="card-footer text-end">
							<?php if($row3['adhar']!=""){ ?>
							<a class="btn btn-outline-dark ms-2" href="Delete_idproof?ID=<?php echo $strmid; ?>" onclick="return confirm('Are You Really Want To Delete This ID Proof...?  Click OK To Confirm...?')">Delete</a>
							<?php }else{ ?> 
								
								<a href="profile_view?ID=<?php  echo $strmid?>"><input type="button" value="Back" class="btn btn-primary"></a>
								<button class="btn btn-outline-dark ms-2" name="sub2" type="submit">Submit</button>
                            <?php } ?>
                            </div>
					

                        </div>
						</form>
                    </div>
					 </div>
					 
					 <!--Upload horoscope -->
                     <?php
                        if($check == 10)
                        {
                    ?>
                    <div class="tab-pane fade show active" id="user-set-UpHoroscope" role="tabpanel" aria-labelledby="user-set-UpHoroscope-tab">
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="tab-pane fade" id="user-set-UpHoroscope" role="tabpanel" aria-labelledby="user-set-UpHoroscope-tab">
                    <?php
                        }

                    ?>

					
					  <form action="#" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h5><!-- <i data-feather="user" class="icon-svg-primary wid-20"></i> -->
                                     <img src="https://img.icons8.com/external-vitaliy-gorbachev-fill-vitaly-gorbachev/24/7267EF/external-horoscope-chinese-new-year-vitaliy-gorbachev-fill-vitaly-gorbachev.png"/>
                                     <span class="p-l-5">Upload Horoscope</span></h5>
                            </div>
                            <div class="card-body">
							
								<?php if (isset($_FILES['fileToUpload4']['name']) && !empty($_FILES['fileToUpload4']['name'])){

										$old='../'.$_POST['old'];
											$filename3 =date('Y_m_d_h_i_s').basename($_FILES['fileToUpload4']['name']);
											 $ext3= substr($filename, strrpos($filename, '.') + 1);
											  if (($ext == "jpg"||"jpeg") && ($_FILES["fileToUpload4"]["name"] == "image/jpeg") && ($_FILES["fileToUpload4"]["size"] <  450000)) {
													$targetPath = "../kundli/".$filename3;
											if(file_exists($targetPath))
											{
												unlink($targetPath);
											}else if(file_exists($old))
											{
												unlink($old);
											  } }
										$target_dir = "../kundli/";
										$target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload4']["name"]));
										$sav4=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload4']["name"]));
										$UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["fileToUpload4"]["name"];
										$uploadOk = 1;
										$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
										// Check if image file is a actual image or fake image

										if(isset($_POST["sub5"]))
											{
												
										$check = getimagesize($_FILES["fileToUpload4"]["tmp_name"]);
										if($check !== false) {
											
										//define("success10","Photo File is an image - " . $check["mime"] . ".");

										$uploadOk = 1;
										} else {
										define("success10","Your Photo is not an image.");
										$uploadOk = 0;
										}
										}
										// Check if file already exists
										if (file_exists($target_file)) {
										define("success10","Sorry, This Photo already exists.");
										$uploadOk = 0;
										}
										// Check file size
										if ($_FILES["fileToUpload4"]["size"] > 8097152) {
										//define("success10","Sorry, Your photo size is too large.");
										$uploadOk = 0;
										}
										// Allow certain file formats
										if($imageFileType != "jpg" && $imageFileType != "jpeg" ) {
										define("success10","Sorry, Photos  are  allow only JPG, JPEG Format.");
										$uploadOk = 0;
										}
										// Check if $uploadOk is set to 0 by an error
										if ($uploadOk == 0) {
										define("success10","Sorry, your photo was not uploaded.");
										// if everything is ok, try to upload file
										} else {
										if (move_uploaded_file($_FILES["fileToUpload4"]["tmp_name"], $target_file)) {
										mysqli_query($con,"update register set horoscope='$sav4',HorosApprove='Yes' where MatriID='$strmid'");
                                        //echo "update register set horoscope='$sav4',HorosApprove='Yes' where MatriID='$strmid'";
										//echo "update register set Photo1='$sav3',Photo1Approve='Yes' where MatriID='$strmid'";
										define("success10","Your Horosope Uploaded Successfully.");
										//header('location:profile_view?ID='.$strmid);	
										} 
										else {
										define("success10","Sorry, there was an error uploading your photo.");

										}
										}

										}
										else
										{
											define("success10","Please select the file.");
										}?>
                              <?php $result11=mysqli_query($con,"SELECT * FROM register where MatriID='$strmid'");
							        //echo "SELECT * FROM register where MatriID='$strmid'";
                                       $row11 = mysqli_fetch_assoc($result11);?>
								   <div class="col-sm-12">
											<?php if($row11['horoscope']!=""){ ?>
												<img src="../kundli/<?php echo $row11['horoscope']?>" />
										  
											<?php } else { ?>
											 
											 <img src="" style="display:none"  id="thumbnil5">
											<div class=" " align="center" id="continue1235" style="display:none"></div>
											<br><br>
											
										 <br>
											<h4 align="center"><label for="horoscope" class="btn btn-primary" style="background:#007bff">Browse</label></h4>
                                            <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">  
              			                <input name="fileToUpload4" style="visibility:hidden;" id="horoscope" type="file" onchange="showMyImage3(this);" />
									<?php } ?>
								   
							      
                         </div>
                   
                            <div class="card-footer text-end">
							<?php if($row11['horoscope']!="" ){ ?>
							 <a class="btn btn-outline-dark ms-2" href="delete_horo_photo?ID=<?php echo $strmid; ?>" onclick="return confirm('Are You Really Want To Delete This Horoscope...?  Click OK To Confirm...?')">Delete</a>
                            
							<?php }else { ?> 
								
								<a href="profile_view?ID=<?php  echo $strmid?>"><input type="button" value="Back" class="btn btn-primary"></a>
								<button class="btn btn-outline-dark ms-2" name="sub5" type="submit">Submit</button>
                            <?php } ?>
                            </div>
					

                        </div>
						</form>
                    </div>
					 </div>	
					
					<!--Upload Document Proof  -->
                    <?php
                        if($check == 20)
                        {
                    ?>
                    <div class="tab-pane fade show active" id="user-set-Document" role="tabpanel" aria-labelledby="user-set-Document-tab">
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="tab-pane fade" id="user-set-Document" role="tabpanel" aria-labelledby="user-set-Document-tab">
                    <?php
                        }
                    ?>
					
					  <!-- <form action="updoc.php" method="post" enctype="multipart/form-data"> -->
                        <form action="updoc.php" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h5><!-- <i data-feather="user" class="icon-svg-primary wid-20"></i> -->
                                    <img src="https://img.icons8.com/ios-filled/24/7267EF/upload-document.png"/>
                                    <span class="p-l-5">Upload Document</span></h5>
                            </div>
						<div class="card-body">
						<?php $result4=mysqli_query($con,"SELECT * FROM `document` where MatriID='$strmid' and type='0'");
										//echo "SELECT * FROM `document` where MatriID='$strmid' where type='0'";
										$row4 = mysqli_fetch_assoc($result4);
										 ?>
						      
						<div class="col-xl-12 col-md-12 ">
							
                     		    <div class="input-group mb-2 mt-4 col-md-12">
								    <div class="input-group-text" id="btnGroupAddon2"><b>Employee</b></div>
									<?php if($row4['type']=="0") {?>
								    <input type="text" class="form-control wid12"  name="doc[]"  placeholder=" Your Salary Slip"  style="width:57%">
									<input name="uploaded_file1[]" type="file" class="form-control ifile" hidden multiple>

									<?php }else { ?>
									 <input type="text" class="form-control wid12"  name="doc[]"  placeholder="Upload Your Salary Slip"   style="width:57%">
									<input name="uploaded_file1[]" type="file" class="form-control ifile" multiple>
									<?php } ?>
								 
							    </div> 
								   
									<span class="mb-2" style="float:right">
									<?php if($row4['type']!="") {?>
										<a href="../document/<?php echo $row4['Name'] ?>" target="_blank" class="m-r-5" style="color:#4b8204">View </a> 
										 <a href="docdel?ID=<?php echo $strmid;?>&type=<?php echo $row4['type']?>" class="m-r-5" style="color:red" onclick="return confirm('Are You Really Want To Delete This Document...?  Click OK To Confirm...?')">Delete </a>
                                        
								
									<?php } ?>
									</span>
									
							                     
                            </div>
						<div class="col-xl-12 col-md-12 ">
							<?php $result5=mysqli_query($con,"SELECT * FROM `document` where MatriID='$strmid' and type='1'");
										//echo "SELECT * FROM `document` where MatriID='$strmid' where type='1'";
										$row5 = mysqli_fetch_assoc($result5);
										 ?>
                     		    <div class="input-group mb-2 mt-4 col-md-12">
								    <div class="input-group-text" id="btnGroupAddon2"><b>Business</b> </div>
									<?php if($row5['type']=="1") {?>
								    <input type="text" class="form-control wid12" name="doc[]"  placeholder=" Your Last Year Income Tax Returns"   style="width:58%" >
									<input name="uploaded_file1[]" type="file" class="form-control ifile" hidden multiple>

									<?php }else { ?>
									<input type="text" class="form-control wid12" name="doc[]"  placeholder="Upload Your Last Year Income Tax Returns"  style="width:58%" >
									<input name="uploaded_file1[]" type="file" class="form-control ifile" multiple>
									<?php }?>
								  
							    </div> 
									<span class="mb-2 " style="float:right">
									<?php if($row5['type']!="") {?>
										<a href="../document/<?php echo $row5['Name'] ?>" target="_blank" class="m-r-5" style="color:#4b8204">View</a> 
										<a href="docdel?ID=<?php echo $strmid; ?>&type=<?php echo $row5['type']?>" class="m-r-5" style="color:red" onclick="return confirm('Are You Really Want To Delete This Document...?  Click OK To Confirm...?')">Delete </a>
									
										<?php } ?>
									</span>
								
						                     
                            </div>
							<div class="col-xl-12 col-md-12 ">
							<?php $result6=mysqli_query($con,"SELECT * FROM `document` where MatriID='$strmid' and type='2'");
										//echo "SELECT * FROM `document` where MatriID='$strmid' where type='2'";
										$row6 = mysqli_fetch_assoc($result6);
										 ?>
                     		    <div class="input-group mb-2 mt-4 col-md-12">
								    <div class="input-group-text" id="btnGroupAddon2"> <b>Graduation</b> </div>
									<?php if($row6['type']=="2") {?>
									<input type="text" class="form-control wid12" name="doc[]"  placeholder="  Graduation Certificate" style="width:56%" >
									<input name="uploaded_file1[]" type="file" class="form-control ifile" hidden multiple>

									<?php }else { ?>
								    <input type="text" class="form-control wid12" name="doc[]"  placeholder="Upload Your Graduation Certificate" style="width:56%" >
									<input name="uploaded_file1[]" type="file" class="form-control ifile"  multiple>
									<?php } ?> 

								  
							    </div>
									<span class="mb-2 " style="float:right">
									<?php if($row6['type']!="") { ?>
										<a href="../document/<?php echo $row6['Name'] ?>" target="_blank" class="m-r-5" style="color:#4b8204">View </a> 
										<a href="docdel?ID=<?php echo $strmid; ?>&type=<?php echo $row6['type']?>" class="m-r-5" style="color:red" onclick="return confirm('Are You Really Want To Delete This Document...?  Click OK To Confirm...?')">Delete </a>
										
											<?php } ?> 
									</span>
							                      
                            </div>
							<div class="col-xl-12 col-md-12 ">
							<?php $result7=mysqli_query($con,"SELECT * FROM `document` where MatriID='$strmid' and type='3'");
										//echo "SELECT * FROM `document` where MatriID='$strmid' where type='3'";
										$row7 = mysqli_fetch_assoc($result7);
										 ?>
                     		    <div class="input-group mb-2 mt-4 col-md-12">
								    <div class="input-group-text" id="btnGroupAddon2"><b>Post Graduation</b></div>
									<?php if($row7['type']=="3") {?>
									 <input type="text" class="form-control wid12" name="doc[]"  placeholder=" Your Post Graduation Certificate" style="width:51%" >
									<input name="uploaded_file1[]" type="file" class="form-control ifile" hidden multiple>

									<?php }else { ?>
								    <input type="text" class="form-control wid12" name="doc[]"  placeholder="Upload Your Post Graduation Certificate" style="width:51%" >
									<input name="uploaded_file1[]" type="file" class="form-control ifile" multiple>
									<?php } ?>
								   
							    </div>
									<span class="mb-2 " style="float:right">
									<?php if($row7['type']!="") { ?>
										<a href="../document/<?php echo $row7['Name'] ?>" target="_blank" class="m-r-5" style="color:#4b8204">View</a> 
										<a href="docdel?ID=<?php echo $strmid; ?>&type=<?php echo $row7['type']?>" class="m-r-5" style="color:red" onclick="return confirm('Are You Really Want To Delete This Document...?  Click OK To Confirm...?')">Delete </a>
								<?php } ?>
									</span>
							                      
                            </div>
							<div class="col-xl-12 col-md-12 ">
							<?php $result18=mysqli_query($con,"SELECT * FROM `document` where MatriID='$strmid' and type='4'");
									//echo "SELECT * FROM `document` where MatriID='$strmid' where type='4'";
										$row18=mysqli_fetch_assoc($result18);
										 ?>
                     		    <div class="input-group mb-2 mt-4 col-md-12">
								    <div class="input-group-text" id="btnGroupAddon2"> <b>Any Other Degree</b> </div>
									<?php if($row18['type']=="4") {?>
									 <input type="text" class="form-control wid12" name="doc[]"  placeholder=" Your Any Other Degree Certificate"  style="width:49%" >
									 <input name="uploaded_file1[]" type="file" class="form-control ifile" hidden multiple>

									<?php }else { ?>
							      <input type="text" class="form-control wid12" name="doc[]"  placeholder="Upload Your Any Other Degree Certificate"  style="width:49%" >
									 <input name="uploaded_file1[]" type="file" class="form-control ifile" multiple> 
									<?php } ?>
								  
							    </div>
									<span class="mb-2 " style="float:right">
									<?php if($row18['type']!="") {?>
										<a href="../document/<?php echo $row18['Name'] ?>" target="_blank" class="m-r-5" style="color:#4b8204">View </a> 
										<a href="docdel?ID=<?php echo $strmid; ?>&type=<?php echo $row18['type']?>" class="m-r-5" style="color:red" onclick="return confirm('Are You Really Want To Delete This Document...?  Click OK To Confirm...?')">Delete </a>
										
											<?php } ?>
									</span><br>
							                     
                            </div>
							
							<div class="col-xl-12 col-md-12 text-end mt-4 mb-4">
								
									<button type="submit" name="submit" class="btn btn-primary"> Submit </button>
									<input name="matid" type="hidden" id="id1"  required="required" value="<?php echo $strmid ?>"></td>
									
							</div>
							
							</form>
							
								
                    </div>
					 </div>
					 

					</div>
                    <?php
                        if($check == 16){
                    ?>
                    <div class="tab-pane fade show active" id="user-set-email" role="tabpanel" aria-labelledby="user-set-email-tab">
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="tab-pane fade" id="user-set-email" role="tabpanel" aria-labelledby="user-set-email-tab">
                    <?php
                        }
                    ?>					                  
                    
                       <!-- <form method="post" action="settings.php" > -->
					   <form method="post" action="settings.php" >
						<div class="card">
                            <div class="card-header">
                                <h5><!-- <i data-feather="at-sign" class="icon-svg-primary wid-20"></i> -->
                                    <img src="https://img.icons8.com/external-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto/24/7267EF/external-setting-home-screen-app-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto.png"/>
                                    <span class="p-l-5"> Profile Settings</span></h5>
                            </div>
							<input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item py-4">
                                    <h5 class="mb-3">Horoscope Setting</h5>
                                    <div class="m-l-40">
									
                                        <div class="form-check form-switch">
                                            <input class="" type="radio"  name="horoscope" style="vertical-align: middle" id="customSwitchemlnot1" value="paidhoro" <?=$row['horoscope_visibility']=="paidhoro" ? "checked" : ""?> checked>
                                            <label class="form-check-label radio-align" for="customSwitchemlnot1" style="vertical-align: middle">Horoscope visible only to paid members ---- Recommend for better performance.</label>
                                        </div>
									
									
                                        <div class="form-check form-switch">
                                            <input class="" type="radio" name="horoscope" id="customSwitchemlnot" style="vertical-align: middle" value="freehoro" <?=$row['horoscope_visibility']=="freehoro" ? "checked" : ""?> >
                                            <label class="form-check-label" for="customSwitchemlnot2" style="vertical-align: middle">Horoscope visible to all</label>
                                        </div>
                                
                                    </div>
                                </li>
                                <li class="list-group-item py-4">
                                    <h5 class="mb-3">Phone Setting</h5>
                                    <div class="m-l-40">
									
                                     
                                        <div class="form-check form-switch">
                                            <input class="" type="radio"  name="phone"  id="customSwitchemlnot1" style="vertical-align: middle"  value="paidphone" <?=$row['phone_visibility']=="paidphone" ? "checked" : ""?> checked>
                                            <label class="form-check-label radio-align" for="customSwitchemlnot1" style="vertical-align: middle">Show mobile number only to paid members ---- Recommend for better performance.</label>
                                        </div>
									 
									
                                        <div class="form-check form-switch">
                                            <input class="" type="radio"  name="phone"  id="customSwitchemlnot2" style="vertical-align: middle" value="freephone" <?=$row['phone_visibility']=="freephone" ? "checked" : ""?> >
                                            <label class="form-check-label radio-align" for="customSwitchemlnot2" style="vertical-align: middle">Show mobile number only to whom I grant access to view</label>
                                        </div>
								   

                                    </div>
                                </li>
								 <li class="list-group-item py-4">
                                    <h5 class="mb-3">Photo Setting</h5>
                                    <div class="m-l-40">
									
                                        <div class="form-check form-switch">
                                            <input class="" name="photo" type="radio" id="customSwitchemlnot1" style="vertical-align: middle" value="paidphoto" <?=$row['photo_visibility']=="paidphoto" ? "checked" : ""?> checked>
                                            <label class="form-check-label radio-align" for="customSwitchemlnot1" style="vertical-align: middle">Show photo only to paid members ---- Recommend for better performance.</label>
                                        </div>
									
									 <?php
                                     //if($row['photo_visibility']=='freephoto'){?>
                                        <!--<div class="form-check form-switch">
                                            <input class="form-check-input" name="photo" type="checkbox" id="customSwitchemlnot2" value="freephoto" checked>
                                            <label class="form-check-label" for="customSwitchemlnot2">Show photo only to whom I grant access to view</label>
                                        </div>
									 <?php //} else {?>
									  <div class="form-check form-switch">
                                            <input class="form-check-input" name="photo" type="checkbox" id="customSwitchemlnot2" value="freephoto">
                                            <label class="form-check-label" for="customSwitchemlnot2">Show photo only to whom I grant access to view</label>
                                        </div>-->
									 <?php //}  ?>
									 
										<div class="form-check form-switch">
                                            <input class="" name="photo" type="radio" id="customSwitchemlnot2" style="vertical-align: middle" value="allphoto" <?=$row['photo_visibility']=="allphoto" ? "checked" : ""?>>
                                            <label class="form-check-label" for="customSwitchemlnot2" style="vertical-align: middle">View to all</label>
                                        </div>
									
                                    </div>
                                </li>
                            </ul>
                            <div class="card-footer text-end">
                                <button class="btn btn-warning">Update Change</button>
                                <!--<button class="btn btn-outline-dark ms-2">Clear</button>-->
                            </div>
						  </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
</div>
</div>
<?php include('footer.php') ?>
    <!-- Warning Section Ends -->
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

<script src="assets/js/plugins/trumbowyg.min.js"></script>

<script src="assets/js/plugins/select2.full.min.js"></script>
<script>
    $(function() {
        $(".skill-mlt-select").select2();
    });

    function check_exist123(str)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("emailerror").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","check_email_exist?q="+str,true);
xmlhttp.send();
} 
</script>

<script>

function ValidateAlpha(evt)
{
    var keyCode = (evt.which) ? evt.which : evt.keyCode
    if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
    return false;
    return true;
}
function blockSpecialChar(e)
{ 
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
}
function isNumber(evt) 
{
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) 
    {
        return false;
    }
    return true;
}
</script>
<?php 
    if($_GET['msg']=='success')
    {
        $check=$_GET['flag']; 
        //echo $check;

?>



<div id="myModal" class="modal " role="dialog" style="margin-top: 100px;">
  	<div class="modal-dialog">
		<div class="modal-content">     
     		<div class="modal-body modalb">    
         		<div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
					<div class="swal2-header">
						<div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
							<div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
      						<span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
      						<div class="swal2-success-ring"></div> 
      						<div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
      						<div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
    					</div>
    <?php
            switch($check)
            {

                case 1:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Basic Information Updated Successfully</h2>
    <?php
                        break;
                case 2:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Education Details Updated Successfully</h2>
    <?php
                        break;
                case 3:

    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Partner Preference Details Updated Successfully</h2>
    <?php
                        break;
                case 4:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Family Details Updated Successfully</h2>
    <?php
                        break;
                case 5:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Contact Information Updated Successfully</h2>
    <?php
                        break;
                case 6:

    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Basic And Lifestyle Details Updated Successfully</h2>
    <?php
                        break;
                case 7:

    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Horoscope Information Updated Successfully</h2>
    <?php
                        break;
                case 8:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Photo Uploaded Successfully</h2>
    <?php
                        break;
                case 9:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php if(isset($_POST['sub2']))echo constant('success2') ?> </h2>
    <?php
                        break;
                case 10:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Document Uploaded Successfully</h2>
    <?php
                        break;
                case 11:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Member Approved To Paid Successfully</h2>
    <?PHP
                        break;
                case 12:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Member Degraded Successfully</h2>
    <?php
                        break;
                case 13:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Member Banned Successfully</h2>
    <?php
                        break;
                case 14:

    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Member Unbanned Successfully</h2>
    <?php
                        break;
				case 15:
	?>
	<h2 class="swal2-title" id="swal2-title" style="display: flex;">Membership Details Updated Successfully</h2>
	<?php
						break;
                case 16:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Profile Settings Changed Successfully</h2>
    <?php
                        break;
                case 17:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Mail Send Successfully</h2>
    <?php
                        break;
                case 18:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Photo Deleted Successfully</h2>
    <?php
                        break;
                case 19:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Profile Photo Set Successfully</h2>
    <?Php
                        break;
                case 23: 
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Note Added Successfully</h2>
    <?php
                        break;
                case 22:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Permission Restricted. Reason:Demo </h2>
    <?php
                        break;
                case 24:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Permission Restricted. Reason:Demo </h2>
    <?php
                        break;
                case 25:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Member Deactivate Successfully</h2>
    <?php
                        break;
                case 26:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Member Reactivate Successfully</h2>
    <?php
                        break;
                default:
    ?>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Something Went Wrong!!</h2>
    
    <?php                    
            }
    ?>
    </div>

    <div class="swal2-actions">
    
    <a href="profile_view?flag=<?php echo $check; ?>&ID=<?php echo $strmid; ?>" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
      </div>
    </div> 
			</div>
			
</div>
</div>   
</div>
<?php } ?>




<div class="pct-customizer">
    <div class="pct-c-btn">
        <button class="btn btn-light-danger" id="pct-toggler">
            <i data-feather="settings"></i>
        </button>
        <button class="btn btn-light-primary" data-bs-toggle="tooltip" title="Document" data-placement="left">
            <i data-feather="book"></i>
        </button>
        <button class="btn btn-light-success" data-bs-toggle="tooltip" title="Buy Now" data-placement="left">
            <i data-feather="shopping-bag"></i>
        </button>
        <button class="btn btn-light-info" data-bs-toggle="tooltip" title="Support" data-placement="left">
            <i data-feather="headphones"></i>
        </button>
    </div>
    <div class="pct-c-content ">
        <div class="pct-header bg-primary">
            <h5 class="mb-0 text-white f-w-500">DashboardKit Customizer</h5>
        </div>
        <div class="pct-body">
            <h6 class="mt-2"><i data-feather="credit-card" class="me-2"></i>Header settings</h6>
            <hr class="my-2">
            <div class="theme-color header-color">
                <a href="#!" class="" data-value="bg-default"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-primary"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
            </div>
            <h6 class="mt-4"><i data-feather="layout" class="me-2"></i>Sidebar settings</h6>
            <hr class="my-2">
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="cust-sidebar">
                <label class="form-check-label f-w-600 pl-1" for="cust-sidebar">Light Sidebar</label>
            </div>
            <div class="form-check form-switch mt-2">
                <input type="checkbox" class="form-check-input" id="cust-sidebrand">
                <label class="form-check-label f-w-600 pl-1" for="cust-sidebrand">Color Brand</label>
            </div>
            <div class="theme-color brand-color d-none">
                <a href="#!" class="active" data-value="bg-primary"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
            </div>
            <h6 class="mt-4"><i data-feather="sun" class="me-2"></i>Layout settings</h6>
            <hr class="my-2">
            <div class="form-check form-switch mt-2">
                <input type="checkbox" class="form-check-input" id="cust-darklayout">
                <label class="form-check-label f-w-600 pl-1" for="cust-darklayout">Dark Layout</label>
            </div>
        </div>
    </div>
</div>


<script>
    $('#pct-toggler').on('click', function() {
        $('.pct-customizer').toggleClass('active');
    });
    $('#cust-sidebrand').change(function() {
        if ($(this).is(":checked")) {
            $('.theme-color.brand-color').removeClass('d-none');
            $('.m-header').addClass('bg-dark');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
            $('.theme-color.brand-color').addClass('d-none');
        }
    });
    $('.brand-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        if (temp == "bg-default") {
            $('.m-header').removeClassPrefix('bg-');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', '../branding/logos/emblem.png');
            $('.m-header').addClass(temp);
        }
    });
    $('.header-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        if (temp == "bg-default") {
            $('.pc-header').removeClassPrefix('bg-');
        } else {
            $('.pc-header').removeClassPrefix('bg-');
            $('.pc-header').addClass(temp);
        }
    });
    $('#cust-sidebar').change(function() {
        if ($(this).is(":checked")) {
            $('.pc-sidebar').addClass('light-sidebar');
            $('.pc-horizontal .topbar').addClass('light-sidebar');
        } else {
            $('.pc-sidebar').removeClass('light-sidebar');
            $('.pc-horizontal .topbar').removeClass('light-sidebar');
        }
    });
    $('#cust-darklayout').change(function() {
        if ($(this).is(":checked")) {
            $("#main-style-link").attr("href", "assets/css/style-dark.css");
        } else {
            $("#main-style-link").attr("href", "assets/css/style.css");
        }
    });
    $.fn.removeClassPrefix = function(prefix) {
        this.each(function(i, it) {
            var classes = it.className.split(" ").map(function(item) {
                return item.indexOf(prefix) === 0 ? "" : item;
            });
            it.className = classes.join(" ");
        });
        return this;
    };
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->




<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-Q8H86P6FK7');
</script>
<script>
		$(function () {
			$("#datepicker,#datepicker1,#datepicker2,#datepicker3").datepicker();
		});
	</script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<script type="text/javascript">
    $(function () {
        $("#mstatus").change(function () {
            if ($(this).val() == "Unmarried") {
              
				 $("#child").hide();
            } else {
                 $("#child").show();
            }
        });
    });
	 $(function () {
        $("#mstatus").change(function () {
            if ($(this).val() == "Unmarried") {
              
				 $("#child1").hide();
            } else {
                 $("#child1").show();
            }
        });
    });
	 $(function () {
        $("#mstatus").change(function () {
            if ($(this).val() == "Unmarried") {   
              
				 $("#child1").hide();
            } else {
                 $("#child1").show();
            }
        });
    });
	 $(function () {
        $("#chidN").change(function () {
            if ($(this).val() == "None") {
              
				 $("#child1").hide();
            } else {
                 $("#child1").show();
            }
        });
    });
	$(function () {
		 $("#noofbro5").hide();
		 $("#noofbro4").hide();
		 $("#noofbro3").hide();
		 $("#noofbro2").hide();
		 $("#noofbro1").hide();
		 $("#noofbrono").hide();
        $("#noofbrom").change(function () {
            if ($(this).val() == "No") {
				$("#noofbrono").show();
				$("#noofbro6").hide();
				 $("#noofbro5").hide();
		 	     $("#noofbro4").hide();
		         $("#noofbro3").hide();
		         $("#noofbro2").hide();
		         $("#noofbro1").hide();
            }
			if($(this).val() == "1") {
				$("#noofbro1").show();
				$("#noofbro6").hide();
				$("#noofbro5").hide();
		 	     $("#noofbro4").hide();
		         $("#noofbro3").hide();
		         $("#noofbro2").hide();
				 $("#noofbrono").hide();
			}
			if($(this).val() == "2") {
				 $("#noofbro2").show();
				 $("#noofbro6").hide();
				 $("#noofbro5").hide();
		 	     $("#noofbro4").hide();
		         $("#noofbro3").hide();
		         $("#noofbro1").hide();
				 $("#noofbrono").hide();
			}
			if($(this).val() == "3") {
				 $("#noofbro3").show();
				 $("#noofbro6").hide();
				 $("#noofbro5").hide();
		 	     $("#noofbro4").hide();
		         $("#noofbro2").hide();
		         $("#noofbro1").hide();
				 $("#noofbrono").hide();
			}
			if($(this).val() == "4") {
				 $("#noofbro4").show();
				 $("#noofbro6").hide();
				 $("#noofbro5").hide();
		         $("#noofbro3").hide();
		         $("#noofbro2").hide();
		         $("#noofbro1").hide();
				 $("#noofbrono").hide();
			}
			if($(this).val() == "5") {
				 $("#noofbro5").show();
				 $("#noofbro6").hide();
		 	     $("#noofbro4").hide();
		         $("#noofbro3").hide();
		         $("#noofbro2").hide();
		         $("#noofbro1").hide();
				 $("#noofbrono").hide();
			}
			if($(this).val() == "5+") {
				 $("#noofbro6").show();
				 $("#noofbro5").hide();
		 	     $("#noofbro4").hide();
		         $("#noofbro3").hide();
		         $("#noofbro2").hide();
		         $("#noofbro1").hide();
				 $("#noofbrono").hide();
			}
        });
    });
	
	$(function () {
		 $("#noofsis5").hide();
		 $("#noofsis4").hide();
		 $("#noofsis3").hide();
		 $("#noofsis2").hide();
		 $("#noofsis1").hide();
		 $("#noofsisno").hide();
        $("#noofsism").change(function () {
            if ($(this).val() == "No") {
				$("#noofsisno").show();
				$("#noofsis6").hide();
				 $("#noofsis5").hide();
		 	     $("#noofsis4").hide();
		         $("#noofsis3").hide();
		         $("#noofsis2").hide();
		         $("#noofsis1").hide();
            }
			if($(this).val() == "1") {
				$("#noofsis1").show();
				$("#noofsis6").hide();
				$("#noofsis5").hide();
		 	     $("#noofsis4").hide();
		         $("#noofsis3").hide();
		         $("#noofsis2").hide();
				 $("#noofsisno").hide();
			}
			if($(this).val() == "2") {
				 $("#noofsis2").show();
				 $("#noofsis6").hide();
				 $("#noofsis5").hide();
		 	     $("#noofsis4").hide();
		         $("#noofsis3").hide();
		         $("#noofsis1").hide();
				 $("#noofsisno").hide();
			}
			if($(this).val() == "3") {
				 $("#noofsis3").show();
				 $("#noofsis6").hide();
				 $("#noofsis5").hide();
		 	     $("#noofsis4").hide();
		         $("#noofsis2").hide();
		         $("#noofsis1").hide();
				 $("#noofsisno").hide();
			}
			if($(this).val() == "4") {
				 $("#noofsis4").show();
				 $("#noofsis6").hide();
				 $("#noofsis5").hide();
		         $("#noofsis3").hide();
		         $("#noofsis2").hide();
		         $("#noofsis1").hide();
				 $("#noofsisno").hide();
			}
			if($(this).val() == "5") {
				 $("#noofsis5").show();
				 $("#noofsis6").hide();
		 	     $("#noofsis4").hide();
		         $("#noofsis3").hide();
		         $("#noofsis2").hide();
		         $("#noofsis1").hide();
				 $("#noofsisno").hide();
			}
			if($(this).val() == "5+") {
				 $("#noofsis6").show();
				 $("#noofsis5").hide();
		 	     $("#noofsis4").hide();
		         $("#noofsis3").hide();
		         $("#noofsis2").hide();
		         $("#noofsis1").hide();
				 $("#noofsisno").hide();
			}
        });
    }); 
	
	
	function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
		
        }
	function TextLimit(){
    var text = document.getElementById('mytext');
    if (text.value.length >= 10 ){
        alert('Only 10 Characters are allowed');
    }
}  
function fillstate2(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("state").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("state").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fill_state?q="+str,true);
xmlhttp.send();
}

function filldist2(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("dist2").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("dist2").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fill_dist?q="+str,true);
xmlhttp.send();
}

function filldist(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("working_dist").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("working_dist").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fill_dist?q="+str,true);
xmlhttp.send();
}




function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function maxLengthCheck(object)
  {
    if (object.value.length > object.maxLength)
      object.value = object.value.slice(0, object.maxLength)
  }
  
  function showotherdist()
	{
					
		if(document.getElementById("scases").value=="None")
		{
		document.getElementById("otherdist").style.visibility="hidden";
		
		}
		else
		{
			document.getElementById("otherdist").style.visibility="visible";
		}
		
	}
  
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
</script>
  <?php if(isset($_GET['msg1'])){ ?>
<div id="myModal" class="modal " role="dialog" style="margin-top: 100px;">
	<div class="modal-dialog">
		<div class="modal-content">     
     		<div class="modal-body modalb"> 
				<div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
					<div class="swal2-header">
						<div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
							<div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
      						<span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
      						<div class="swal2-success-ring"></div> 
	  						<div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
      						<div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
    					</div>
						<?php if($_GET['msg1']=='suc1') {?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Document File is an image ";?></h2>
						<?php }?>
						<?php if($_GET['msg1']=='suc2') {?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Document File is not an image.";?></h2>
						<?php }?>
						<?php if($_GET['msg1']=='suc3') {?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Sorry,Document  file already exists."?></h2>
						<?php }?>
						<?php if($_GET['msg1']=='suc4') {?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Sorry, Document file is allow only JPG, JPEG , PDF and DOCX/DOC  files."?></h2>
						<?php }?>
						<?php if($_GET['msg1']=='suc5') {?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Your Document File is Successfully Uploaded."?></h2>
						<?php }?>
						<?php if($_GET['msg1']=='suc6') {?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Sorry, there was an error uploading your file."?></h2>
						<?php }?>
						<?php if($_GET['msg1']=='suc7') {?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Sorry, your file is too large.."?></h2>
						<?php }?>
						<?php if($_GET['msg1']=='suc8') {?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Please Select the File."?></h2>
						<?php }?>
						</div>
						<div class="swal2-actions">
	
							<a href="profile_view?flag=20&ID=<?php echo $strmid; ?>"  data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
      					</div>
    			</div>
			</div>
		</div>   
	</div>
</div>
<?php } ?>


 <?php if($_GET['msg']!=''){ ?>
<div id="myModal" class="modal " role="dialog" style="margin-top: 100px;">
 	<div class="modal-dialog">
    	<div class="modal-content">     
     		<div class="modal-body modalb">      
				<div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
					<div class="swal2-header">
						<div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
								<div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
      							<span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
      							<div class="swal2-success-ring"></div> 
	  							<div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
      							<div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
    					</div>
						<?php if($_GET['msg']=="delete1"){ 
                                $flag=8;
                        ?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;">Photo deleted successfully</h2>
						<?php }?>
						<?php if($_GET['msg']=="delete2"){ 
                                $flag=9;
                        ?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;">ID Proof File Deleted Successfully</h2>
						<?php }?>
						<?php if($_GET['msg']=="delete3"){ 
                                $flag=20;
                        ?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;">Document File deleted successfully</h2>
						<?php }?>
						<?php if($_GET['msg']=="delete11"){ 
                            $flag=10;
                        ?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;">Horoscope File deleted successfully</h2>
						<?php }?>
					</div>
					<div class="swal2-actions">
						<a href="profile_view?flag=<?php echo $flag; ?>&ID=<?PHP echo $strmid; ?>"   data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
      				</div>
    			</div> 
			</div>
		</div>   
	</div>
</div>
	
<?php } ?>

<?php if(isset($_POST['sub5'])){ ?>
<div id="myModal" class="modal " role="dialog" style="margin-top: 100px;">
	<div class="modal-dialog">
        <div class="modal-content">     
     		<div class="modal-body modalb"> 
				<div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
					<div class="swal2-header">
						<div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
							<div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
      						<span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
      						<div class="swal2-success-ring"></div> 
	  						<div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
      						<div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
    					</div>
						<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo constant('success10'); ?> </h2>
					</div>
					<div class="swal2-actions">
						<a href="profile_view?flag=10&ID=<?php echo $strmid;?>"   data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
      				</div>
    			</div> 
			</div>
		</div>   
	</div>
</div>
<?php } ?>

<?php if(isset($_POST['sub2'])){ ?>
<div id="myModal" class="modal " role="dialog" style="margin-top: 100px;">
 	<div class="modal-dialog">
		<div class="modal-content">     
     		<div class="modal-body modalb"> 
        		<div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
					<div class="swal2-header">	
						<div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
							<div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
      							<span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>	
      							<div class="swal2-success-ring"></div> 
	  							<div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
      							<div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
    					</div>
						<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo constant('success2'); ?> </h2>
					</div>
					<div class="swal2-actions">
						<a href="profile_view?flag=9&ID=<?php echo $strmid;?>"   data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
      				</div>
    			</div> 
			</div>
		</div>   
	</div>
</div>
<?php } ?>

<?php if(isset($_POST['sub3'])){ ?>
<div id="myModal" class="modal " role="dialog" style="margin-top: 100px;">
	<div class="modal-dialog">
        <div class="modal-content">     
     		<div class="modal-body modalb">  
				<div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
					<div class="swal2-header">
						<div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
							<div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
      						<span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
      						<div class="swal2-success-ring"></div> 
	  						<div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
      						<div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
    					</div>
						<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo constant('success3'); ?> </h2>
					</div>
					<div class="swal2-actions">
						<a href="profile_view?flag=8&ID=<?php echo $strmid; ?>"   data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
      				</div>
    			</div> 
			</div>
		</div>   
	</div>
</div>
<?php } ?>
<!---single onchange-->
<script>
function fillcaste(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("caste_dropdown").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("caste_dropdown").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fill_caste.php?q="+str,true);
xmlhttp.send();
}
</script>

<!-- plugin-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="../css2/bootstrap.bundle.min.js"></script>
<script src="../css/bootstrap.css"></script>

<!-- Include Twitter Bootstrap and jQuery: -->
<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Include the plugin's CSS and JS: -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.css" type="text/css"/>
<script>
$(document).ready(function(){

 $('#family_wealth').multiselect({
  nonSelectedText:'Select Family Wealth',
  buttonWidth:'332px',
  
 });
});
</script>
<script>
    function myFunction() {
  var x = document.getElementById("myInput");
  var showpass = document.getElementById('showpass');
  var hidepass = document.getElementById('hidepass');
  if (x.type === "password") {
    x.type = "text";
    showpass.style.display = "none";
    hidepass.style.display = "inline-block";
  } else {
    x.type = "password";
    showpass.style.display = "inline-block";
    hidepass.style.display = "none";
  }
}
</script>


</body>

</html>
