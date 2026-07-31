 <?php include('../dbconnectadmin.php');
require_once(dirname(__FILE__).'/protect.php');
require_once('../includes/annual_income.php');
 //session_start();
$strmid=$_GET['ID']; 
$result =mysqli_query($con,"SELECT * FROM register where MatriID='$strmid' ");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/user-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:36 GMT -->
<head>
    <title>Profile View</title>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/plugins/select2.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
        <link rel="stylesheet" href="assets/css/newcss.css">
<script>
        
</script>
<script>
function showMyImage(fileInput) {
    var oFile = document.getElementById("upload1").files[0];
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
function showMyImage1(fileInput) {
    var oFile = document.getElementById("upload2").files[0];
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
<style>
.selectd
{
    padding-right: 203px;   
}
.card-body {
    flex: 1 1 auto;
    padding: 8px 22px;
}
img, svg {
   
    max-width: 100%;
}
.selcs
{
    margin-left:48px;
}
.carddp{
    padding: 0px 22px;
}
</style>

<style>


/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 5px;
  width: 5px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>

</head>
<body class="pc-horizontal">
    <div class="container">
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->
        <!-- [ Mobile header ] start -->
        <div class="pc-mob-header pc-header">
            <div class="pcm-logo">
                <img src="http://localhost/SVR/css3/assets/shivraj-logo.png" alt="" class="logo logo-lg">
            </div>
            <div class="pcm-toolbar">
                <a href="#!" class="pc-head-link" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <a href="#!" class="pc-head-link" id="headerdrp-collapse">
                    <i data-feather="align-right"></i>
                </a>
                <a href="#!" class="pc-head-link" id="header-collapse">
                    <i data-feather="more-vertical"></i>
                </a>
            </div>
        </div>
        <!-- [ Mobile header ] End -->
          <?php include('topheader.php');?>
          <?php include('header.php');?>
        <!-- [ navigation menu ] end -->
        <!-- Modal -->
        <?php include('notification.php');?>

<!-- [ Main Content ] start -->
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
                            <span class="badge bg-light-danger"><?php echo $row['memtype']?></span>
                        </div>
                        <div class="media user-about-block align-items-center mt-0 mb-3">

                            <div class="position-relative d-inline-block">
                               
                            <?PHP include 'tp.php' ?>
<?php /* ?>
                                <img class="img-radius img-fluid wid-80" src="../gallary/<?php echo $row['Photo1']?>" alt="User image">
                                <div class="certificated-badge">
                                    <i class="fas fa-certificate text-primary bg-icon"></i>
                                    <i class="fas fa-check front-icon text-white"></i>
                                </div>
                                <?php */ ?>
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

            <a href="../gallary/<?php echo $rowview['photo_name'];?>" target=_blank><img src="photoprocess.php?image=../gallary/<?php echo $rowview['photo_name'];?>&maxim_size=50"  border="0"/></a><br>
            <?php   $id=$rowview['photo_id']; ?>
           <a href="deletemphoto.php?id=<?php echo $id; ?>"><i class="feather icon-trash-2" aria-hidden="true"></i></a> 
           <?php 
        
           if($rowview['photo_name']==$row['Photo1']){?>
           
           <a href="setdp.php?photo=<?php echo $rowview['photo_name'];?>&id=<?php echo $row['MatriID']?>">set</a>

              <?php } else { ?>
             <a href="setdp.php?photo=<?php echo $rowview['photo_name'];?>&id=<?php echo $row['MatriID']?>">DP</a>
              <?php } ?>

          </div>
           <?php } ?>
             </div>
                            
                    <div class="card-body">
                       <div class="col-md-12">
                <div class="card">
                    <div class="row">
                    <div class="card-body">
                        <div class="btn-group mb-2 me-2">
                            <button class="btn  btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acition</button>
                            <div class="dropdown-menu dropdown-menu-dark">
                                                            
                                 <?php if($row['Status']=='Active')
                                                                    {?>
                         <a href="approve_paid_form.php?matriid=<?php echo $row['MatriID'];?>" class="dropdown-item">Approve To Paid</a>
                          <?php  } else  if($row['Status']=='Paid')
                                                                    {?>
                           <a href="degrade_member.php?matriid=<?php echo $row['MatriID'];?>" onclick="return confirm('Are You Really Want To Degrade Member..?  Click OK To Confirm...?')" class="dropdown-item" >
                           Degrade Membership </a>
                          <?php  }  else  if($row['Status']=='Expired') 
                                                                    {?>
                          <a href="approve_paid_form.php?matriid=<?php echo $row['MatriID'];?>" class="dropdown-item">Renew Membership </a>
                           <?php } ?>
                        <?php  if($row['Status']=='Banned'){    ?>
                           <a href="unbanned_member.php?matriid=<?php echo $row['MatriID'];?>" class="dropdown-item">Unbaned Member</a>

                        <?php } else{ ?>
                         <a href="banned_member.php?matriid=<?php echo $row['MatriID'];?>" class="dropdown-item">Baned Member</a>

                        <?php }?>
                            </div>
                        </div>
                        <div class="btn-group mb-2 me-2">
                        <button class="btn  btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Member Action</button>
                        <div class="dropdown-menu dropdown-menu-dark">
                         <a class="dropdown-item" href="send_mail.php">Send Mail</a>
                         <a class="dropdown-item" href="delete_member.php?matriid=<?php echo $_SESSION['id']?>" onclick="return confirm('Are You Really Want To Delete This Profile...?  Click OK To Confirm...?')">Remove Member</a>
                            <a class="dropdown-item" href="print_my_profile.php">Print This Profile<a>
                            </div>
                        </div>
                        
                        
                    </div>
                  </div>
                </div>
            </div>
                    </div>
                    <div class="nav flex-column nav-pills list-group list-group-flush list-pills" id="user-set-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link list-group-item list-group-item-action active" id="user-set-profile-tab" data-bs-toggle="pill" href="#user-set-profile" role="tab" aria-controls="user-set-profile" aria-selected="true">
                            <span class="f-w-500"><i class="feather icon-user m-r-10 h5 "></i>Profile Overview</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>
                        <a class="nav-link list-group-item list-group-item-action" id="user-set-information-tab" data-bs-toggle="pill" href="#user-set-information" role="tab" aria-controls="user-set-information" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-file-text m-r-10 h5 "></i>Basic Information</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>
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
                        <a class="nav-link list-group-item list-group-item-action" id="user-set-Basics-tab" data-bs-toggle="pill" href="#user-set-Basics" role="tab" aria-controls="user-set-Basics" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Basics and Lifestyle</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>   
                        <a class="nav-link list-group-item list-group-item-action" id="user-set-Horoscope-tab" data-bs-toggle="pill" href="#user-set-Horoscope" role="tab" aria-controls="user-set-Horoscope" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Horoscope Information</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a>                        
                       
                         <a class="nav-link list-group-item list-group-item-action" id="user-set-Idproof-tab" data-bs-toggle="pill" href="#user-set-Idproof" role="tab" aria-controls="user-set-Idproof" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Upload Idproof</span>
                            <span class="float-end"><i class="feather icon-chevron-right"></i></span>
                        </a> 
                         <a class="nav-link list-group-item list-group-item-action" id="user-set-Document-tab" data-bs-toggle="pill" href="#user-set-Document" role="tab" aria-controls="user-set-Document" aria-selected="false">
                            <span class="f-w-500"><i class="feather icon-book m-r-10 h5 "></i>Upload Document Proof</span>
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
                    <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel" aria-labelledby="user-set-profile-tab">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                            <h5 class="alert-heading"><i class="feather icon-alert-circle me-2"></i> Email Verification</h5>
                            <p class="mb-0">Your email is not confirmed. Please check your inbox. <a href="#!" class="text-danger"> Resend confirmation</a></p>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">About me</span></h5>
                            </div>
                            <div class="card-body">
                                <p>
                                    <?php echo $row['aboutus']?>
                                </p>
                                <h5 class="mt-5 mb-3">Personal Details</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="">Full Name</td>
                                            <td class="">:</td>
                                            <td class=""><?php echo $row['Name']?></td>
                                        </tr>
                                        <tr>
                                            <td class="">Gender</td>
                                            <td class="">:</td>
                                            <td class=""><?php echo $row['Gender']?></td>
                                        </tr>
                                          <tr>
                                        <td class="">Date of Birth</td>
                                            <td class="">:</td>
                                            <td class=""><?php $explodedate=explode("-",$row['DOB']);
                                            echo $explodedatedisplay=$explodedate[2]."-".$explodedate[1]."-".$explodedate[0];?></td>
                                        </tr>
                                        <tr>
                                            <td class="">Religion</td>
                                            <td class="">:</td>
                                            <td class=""><?php echo $row['Religion']?></td>
                                        </tr>
                                        <tr>
                                            <td class="">Caste</td>
                                            <td class="">:</td>
                                            <td class=""><?php echo $row['Caste']?></td>
                                        </tr>
                                        <tr>
                                            <td class="">Subcaste</td>
                                            <td class="">:</td>
                                            <td class=""><?php echo $row['Subcaste']?></td>
                                        </tr>
                                        <tr>
                                            <td class="">Email</td>
                                            <td class="">:</td>
                                            <td class=""><?php echo $row['ConfirmEmail']?></td>
                                        </tr>
                                        <tr>
                                            <td class="">Password</td>
                                            <td class="">:</td>
                                            <td class=""><?php echo $row['ConfirmPassword']?></td>
                                        </tr>
                                        <tr>
                                            <td class="">Mobile</td>
                                            <td class="">:</td>
                                            <td class=""><?php echo $row['Mobile']?>,<?php echo $row['Mobile2']?></td>
                                        </tr>

                                    </tbody>
                                </table>                               
                            </div>
                        </div>
                    </div>
                        <!-- Basic Details -->
                    <div class="tab-pane fade" id="user-set-information" role="tabpanel" aria-labelledby="user-set-information-tab">
                      <form action="edit_basic.php" method="post">
                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Basic Information</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                            
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="form-label">Profile Created By</label>
                                            <select class="skill-mlt-select" name="created_by" >
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
                                            <input type="text" class="form-control" id="txtName" name="txtName"  value="<?php echo $row['Name']; ?>" placeholder="Name">
                                            <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">
                                        </div>
                                    </div>                                      
                                    <div class="col-sm-6">
                                        <div class="form-group" >
                                            <label class="form-label">Gender</label>
                                            <select class="skill-mlt-select" name="gender">
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
                                            <input type="text" class="form-control"   readonly value="<?php echo $row['Age']; ?>" placeholder="Enter Age">
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email"   value="<?php echo $row['ConfirmEmail']; ?>" placeholder="Enter Email ID">
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input type="text" class="form-control"  name="password"  value="<?php echo $row['ConfirmPassword']; ?>" placeholder="Enter Password">
                                        </div>
                                    </div>
                                  <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Religion</label>
                                            <select class="skill-mlt-select" id="religion" name="religion">
                                             <?php if($row['Religion']!='') { ?>
                                               <option value="<?php echo $row['Religion']; ?>" selected><?php echo $row['Religion']; ?></option>
                                             <?php }else { ?>
                                             <option value="" selected>Select Religion</option>
                                             <?php } ?>
                                                <?php $rrs=mysqli_query($con,"select * from religion");
                                                    while($rrow=mysqli_fetch_assoc($rrs))
                                                    { ?>
                                                <option value="<?php echo $rrow['Religion'];?>"><?php echo $rrow['Religion'];?></option>
                                                <?php   }   ?>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Caste</label>
                                            <select class="skill-mlt-select" name="caste" id="caste_dropdown"> 
                                              <?php if($row['Caste']!='') { ?>
                                               <option value="<?php echo $row['Caste']; ?>" selected><?php echo $row['Caste']; ?></option>
                                             <?php }else { ?>
                                             <option value="" selected>Select Caste</option>
                                             <?php } ?>
                                               <?php $qry=mysqli_query($con,"select * from caste");
                                                while($rowC=mysqli_fetch_array($qry))
                                                {  echo"<option value='".$rowC[2]."'>".$rowC[2]."</option>"; }?>
                                            </select>
                                        </div>
                                    </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Subcaste <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="subcaste" name="subcaste"  value="<?php echo $row['Subcaste']; ?>" placeholder="Enter Subcaste">
                                        </div>
                                    </div>  
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Marital Status</label>
                                            <select class="skill-mlt-select" id="mstatus" name="mstatus" >  <?php if($row['Maritalstatus']!='') { ?>
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
                                            <label class="form-label"> Select No Of Childerns</label>
                                            <select class="skill-mlt-select" name="noc">
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
                                            <label class="form-label"> Children Living Status</label>
                                            <select class="skill-mlt-select" name="childstatus">
                                             <?php if($row['childrenlivingstatus']!="") { ?>
                                             <option value="<?PHP  echo $row['childrenlivingstatus']; ?>" selected><?PHP  echo $row['childrenlivingstatus']; ?></option> <?php  } else { ?>
                                              <option value="" selected>Select</option>
                                              <?php } ?>
                                              <option value="Living with me">Living with me</option>
                                              <option value="Not living with me">Not living with me</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                <div class="col-sm-6">
                                <?php  // Delimiters may be slash, dot, or hyphen
                                $date = $row['DOB'];                                
                                list($year,$month,$day) = preg_split("/[\/\.-]+/", $date);                              
                                
                                ?>
                                   
                                        <div class="form-group">
                                            <label class="form-label">Day</label>
                                              <select name="dobDay" class="skill-mlt-select "  name="dobDay" >
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
                                            <label class="form-label">Month</label>
                                              <select name="dobMonth" class="skill-mlt-select "  name="dobMonth" >
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
                                              <select name="dobYear"   class="skill-mlt-select selectd "  name="dobDay" >
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
                                 
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label class="form-label">About Us <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="aboutus" type="text" value="<?php  echo $row['Profile_new']; ?>"  maxlength="450"  rows="5" placeholder="Enter few lines about yourself"> <?php  echo $row['aboutus']; ?></textarea>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                          
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <button class="btn btn-outline-dark ms-2">Clear</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- Education Details -->
                    <div class="tab-pane fade" id="user-set-education" role="tabpanel" aria-labelledby="user-set-education-tab">
                      <form action="edit_edu.php" method="post">
                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Education Details</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Education</label>
                                            <input type="hidden" name="id" value="<?php  echo $_GET['ID'];?>">
                                            <select class="skill-mlt-select" name="txtEdu" id="txtEdu">
                                                <?php if($row['Education']!='') { ?>
                                                   <option value="<?php echo $row['Education']; ?>" selected><?php echo $row['Education']; ?></option>
                                                <?php }else { ?>
                                                   <option value="" selected>Select Education</option>
                                                <?php } ?>

                                               <?php  
                                                $edusql=mysqli_query($con,"select * from education ");
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
                                           <label class="form-label">Occupation</label>
                                           <select class="skill-mlt-select" name="txtOccu" id="txtOccu">
                                           <?php if($row['Occupation']!='') { ?>
                                                   <option value="<?php echo $row['Occupation']; ?>" selected><?php echo $row['Occupation']; ?></option>
                                                <?php }else { ?>
                                                   <option value="" selected>Select Occupation</option>
                                                <?php } ?>
                                             
                                               <?php  
                                                $occsql=mysqli_query($con,"select * from occupation  order by occu asc");
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
                                            <label class="form-label">Employed in</label>
                                            <select class="skill-mlt-select" name="txtEmp" id="txtEmp">
                                            <?php if($row['Employedin']!='') { ?>
                                           <option value="<?php echo $row['Employedin']; ?>" selected><?php echo $row['Employedin']; ?></option>
                                        <?php }else { ?>
                                           <option value="" selected>Select Employedin</option>
                                        <?php } ?>
                                            <option value="Business">Business</option>
                                            <option value="Defence">Defence</option>
                                            <option value="Government">Government</option>
                                            <option value="Not Employed in">Not Employed in</option>
                                            <option value="Private">Private</option>
                                            <option value="Others">Others</option>
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
                                            <label class="form-label">Income Type</label>
                                            <select class="skill-mlt-select" name="inr" id="inr">
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
                                            <label class="form-label">Working Hours</label>
                                            <select class="skill-mlt-select" name="workinghrs" id="workinghrs">
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Working Location/City</label><br>
                                            <select class="skill-mlt-select" name="workloc" id="workloc">
                                            <?php  if($row['workinglocation']=="")
                                                        { ?>
                                                    <option value="" selected>Select </option>
                                                        <?php  } else { ?>
                                                            <option value="<?php  echo $row['workinglocation']?>"><?php  echo $row['workinglocation']?></option>
                                                        <?php  } ?>
                                                 <?php  
                                                  $occsql=mysqli_query($con,"select * from e_dist");
                                                  while($occrow=mysqli_fetch_array($occsql))
                                                  {
                                                  if($occrow['dist']==$row['workinglocation'] )
                                                  {
                                                  ?>
                                                          <option value="<?php  echo $occrow['dist']; ?>" selected><?php  echo $occrow['dist']; ?></option>
                                                          <?php  
                                                  }else
                                                  {                 
                                                  ?>
                                                         <option value="<?php  echo $occrow['dist']; ?>" ><?php  echo $occrow['dist']; ?></option>
                                                         <?php  
                                                  }
                                               }
                                             ?>
                                            </select>
                                        </div>
                                    </div>
                             </div> 
                                
                            </div>
                          
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <button class="btn btn-outline-dark ms-2">Clear</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                 <!--Partner Preference-->
                     <div class="tab-pane fade" id="user-set-partner" role="tabpanel" aria-labelledby="user-set-partner-tab">
                      <form action="edit_partner.php" method="post">
                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Partner Preference</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Looking For</label><br>

                                            <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">
                                            <select class="skill-mlt-select "  name="txtLooking[]" multiple>
                                            <?php if($row['Looking']!='') { ?>
                                               <option value="<?php echo $row['Looking']; ?>" selected><?php echo $row['Looking']; ?></option>
                                            <?php }else { ?>
                                               <option value="" selected>Select Looking</option>
                                            <?php } ?>
                                            <option value="<?php  echo $row['Looking']; ?>" selected  >
                                            <?php  echo $row['Looking']; ?></option>
                                            <option value="Unmarried">Unmarried</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Widower">Widower</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Seperated">Separated</option>
                                            <option value="Awaiting Divorce">Awaiting Divorce</option>
                                            </select>
                                        </div>
                                    </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Complexion</label><br>
                                            <select class="skill-mlt-select "  name="txtPComplexion[]" multiple>
                                            <?php  if($row['PE_Complexion']=="") { ?>
                                           <option value="Any" selected>Select Complexion </option>
                                          <?php  } else {?>
                                          <option value="Any">Any</option>
                                              <option value="<?php  echo $row['PE_Complexion'];?>"selected><?php  echo $row['PE_Complexion']; ?></option>
                                              <?php  }?>
                                               <?php  
                                                $complexion=$con->query("select * from complexion where complexion!='".$row['PE_Complexion']."'");
                                                while($edurow=$complexion->fetch_array())
                                                {?>
                                            <option value="<?php  echo $edurow['complexion'] ?>"><?php  echo $edurow['complexion'] ?></option>
                                            <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">From Age</label><br>
                                            <select class="skill-mlt-select "  name="fromage" >
                                             <?php  if($row['PE_FromAge']==""){ ?>
                                            <option value="22"  selected>22</option>
                                            <?php  } else  {?>
                                            <option value="<?php  echo $row['PE_FromAge']; ?>" selected><?php  echo $row['PE_FromAge']; ?></option>
                                            <?php  } ?>
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
                                            <option value="60">60</option>
                                            <option value="61">61</option>
                                            <option value="62">62</option>
                                            <option value="63">63</option>
                                            <option value="64">64</option>
                                            <option value="65">65</option>
                                            </select>
                                        </div>
                                    </div>
                                 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">To Age</label><br>
                                            <select class="skill-mlt-select "  name="toage" >
                                             <?php  if($row['PE_ToAge']==""){ ?>
                                            <option value="22"  selected>22</option>
                                            <?php  } else  {?>
                                            <option value="<?php  echo $row['PE_ToAge']; ?>" selected><?php  echo $row['PE_ToAge']; ?></option>
                                            <?php  } ?>
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
                                            <option value="60">60</option>
                                            <option value="61">61</option>
                                            <option value="62">62</option>
                                            <option value="63">63</option>
                                            <option value="64">64</option>
                                            <option value="65">65</option>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">From Height</label><br>
                                          <select class="skill-mlt-select "  name="txtfHeight" >
                                          <?php if($row['PE_from_Height']!='') { ?>
                                         <option value="<?php  echo $row['PE_from_Height']; ?>" selected="selected"><?php  get_height($row['PE_from_Height']); ?></option>
                                          <?php }else { ?>
                                           <option value="" selected>Select Height</option>
                                          <?php } ?>
                                            
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
                                            <label class="form-label">To Height</label><br>
                                         <select class="skill-mlt-select "  name="txttHeight" >
                                     <?php if($row['PE_to_Height']!='') { ?>
                                         <option value="<?php  echo $row['PE_to_Height']; ?>" selected="selected"><?php  get_height($row['PE_to_Height']); ?></option>
                                        <?php }else { ?>
                                           <option value="" selected>Select Height</option>
                                        <?php } ?>
                                           
                                      </option>
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
                                            <label class="form-label">Education</label><br>
                                            <select class="skill-mlt-select "  name="txtPEdu[]" multiple>
                                            <?php  if($row['PE_Education']=="") { ?>
                                              <option value="Any" selected>Select Education</option>
                                              <?php  } else {?>
                                              <option value="Any">Any</option>
                                              <option value="<?php  echo $row['PE_Education']; ?>"selected><?php  echo $row['PE_Education']; ?></option>
                                              <?php  }?>
                                              <?php  
                                                $edusql=$con->query("select * from education");
                                                while($edurow=$edusql->fetch_array())
                                                {
                                                if($edurow['edu']==$row['Education'] && $edurow['edu']!="")
                                                {
                                                 ?>
                                                <option value="<?php  echo $edurow['edu']; ?>"><?php  echo $edurow['edu']; ?></option>
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
                                            <select class="skill-mlt-select "  name="pe_occu[]" multiple>
                                            <?php  if($row['PE_occu']=="") { ?>
                                                <option value="Any" selected> Select Occupation</option>
                                                <?php  } else {?>
                                                <option value="Any">Any</option>
                                                <option value="<?php  echo $row['PE_occu']; ?>"selected><?php  echo $row['PE_occu']; ?></option>
                                                <?php  }?>
                                                <?php  
                                                $edusql=$con->query("select * from occupation ");
                                                while($edurow=$edusql->fetch_array())
                                                {?>
                                                <option value="<?php  echo $edurow['occu']; ?>" <?php  echo $str; ?>><?php  echo $edurow['occu']; ?></option>
                                                <?php  
                                                }
                                                ?>
                                                <option value="<?php  echo $edurow['edu']; ?>" <?php  echo $str; ?>><?php  echo $edurow['edu']; ?></option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Religion</label><br>
                                            <select class="skill-mlt-select "  name="religion[]" multiple>
                                              <?php  if($row['PE_Religion']=="") { ?>
                                                <option value="Any" selected>Select Religion</option>
                                                <?php  } else {?>
                                                <option value="Any">Any</option>
                                                <option value="<?php  echo $row['PE_Religion']; ?>" selected><?php  echo $row['PE_Religion']; ?></option>
                                                <?php  }?>
                                                <?php  
                                                $rrs=$con->query("select * from religion");
                                                while($rrow=$rrs->fetch_assoc())
                                                {
                                                ?>
                                                <option value="<?php  echo $rrow['Religion'];?>"><?php  echo $rrow['Religion'];?></option>
                                                <?php  
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Caste</label><br>
                                            <select class="skill-mlt-select "  name="caste[]" multiple >
                                             <?php  if($row['PE_Caste']=="") { ?>
                                            <option value="Any" selected>Select Caste</option>
                                            <?php  } else {?>
                                            <option value="Any">Any</option>
                                            <option value="<?php  echo $row['PE_Caste'];?>" selected><?php  echo $row['PE_Caste'];?></option>
                                            <?php  }?>
                                            <?php  $qry=mysqli_query($con,"select * from caste");
                                            while($rowC=mysqli_fetch_array($qry))
                                            {
                                            echo"<option value='".$rowC[2]."'>".$rowC[2]."</option>";
                                            }?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Country Living in </label><br>
                                             <select class="skill-mlt-select "  name="txtPcountry[]" multiple onChange="fillstate1(this.value)">
                                            <option value="Any">Any</option>
                                            <option value="India" selected>India</option>
                                            
                                            <?php  
                                        $edusql=$con->query("select * from e_country");
                                        while($edurow=$edusql->fetch_array())
                                        {
                                            if($edurow['country']==$row['PE_Countrylivingin'] && $edurow['PE_Countrylivingin']!="")
                                            {
                                             ?>
                                            <option value="<?php  echo $edurow['country']; ?>" selected><?php  echo $edurow['country']; ?></option>
                                            <?php  
                                            }else
                                            {
                                                $str="";
                                                if($edurow['status']=='disabled')
                                                {
                                                $str="disabled";    
                                                }
                                            ?>
                                            <option value="<?php  echo $edurow['country']; ?>" <?php  echo $str; ?>><?php  echo $edurow['country']; ?></option>
                                            <?php  
                                            }
                                        }
                                        ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">State</label><br>
                                            <select class="skill-mlt-select "  name="cbostate123[]" multiple onChange="filldist1(this.value)" id="cbostate123" value="<?php echo $row['PE_State']; ?>"> 
                                             <?php if($row['PE_State']=="") { ?>
                                                <option value="Any" selected>Select State</option>
                                                <?php }else{?>
                                                 <option value="Any">Any</option>
                                                <option value="<?php echo $row['PE_State']; ?>" selected><?php echo $row['PE_State']; ?></option>
                                                <?php }?>
                                                <?php 
                                            $edusql=mysqli_query($con,"select * from e_state where cid='".$row['PE_Countrylivingin']."'  ");
                                            while($edurow=mysqli_fetch_array($edusql))
                                            {
                                                if($edurow['state']==$row['PE_State'] && $edurow['state']!="")
                                                {
                                                 ?>
                                                <option value="<?php echo $row['PE_State']; ?>"><?php echo $row['PE_State']; ?></option>
                                                <?php
                                                }else
                                                {
                                                    $str="";
                                                    if($edurow['state']=='disabled')
                                                    {
                                                    $str="disabled";    
                                                    }
                                                ?>
                                                <option value="<?php echo $edurow['state']; ?>" <?php echo $str; ?>><?php echo $edurow['state']; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">City</label><br>
                                            <select class="skill-mlt-select "  name="cbocity[]" multiple id="cbocity"  > 
                                                                                    
                                          <?php  if($row['PE_City']=="") { ?>
                                        <option value="Any" selected>Select City</option>
                                        <?php  }else{?>
                                         <option value="Any">Any</option>
                                        <option value="<?php  echo $row['PE_City']; ?>" selected><?php  echo $row['PE_City']; ?></option>
                                        <?php  }?>
                                        <?php  
                                    $edusql=mysqli_query($con,"select * from e_dist " );
                                    while($edurow=mysqli_fetch_array($edusql))
                                    {
                                        if($edurow['dist']==$row['PE_City'] && $edurow['dist']!="")
                                        {
                                         ?>
                                        <option value="<?php  echo $row['PE_City']; ?>"><?php  echo $row['PE_City']; ?></option>
                                        <?php  
                                        }else
                                        {
                                            $str="";
                                            if($edurow['dist']=='disabled')
                                            {
                                            $str="disabled";    
                                            }
                                        ?>
                                        <option value="<?php  echo $edurow['dist']; ?>" <?php  echo $str; ?>><?php  echo $edurow['dist']; ?></option>
                                        <?php  
                                        }
                                    }
                                    ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                        
                                            <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Resident Status</label><br>
                                            <select class="skill-mlt-select "  name="txtPReS[]" multiple id="cbocity123"  > 
                                                                                    
                                         <?php  if($row['PE_Residentstatus']=="") { ?>
                                       <option value="Any" selected>Any</option>
                                      <?php  } else {?>
                                       <option value="Any">Any</option>
                                          <option value="<?php  echo $row['PE_Residentstatus']; ?>" selected><?php  echo $row['PE_Residentstatus']; ?></option>
                                          <?php  }?>
                                          <?php  
                                    $edusql=$con->query("select * from  residency_status where residency_status!='".$row['residency_status']."'");
                                    while($edurow=$edusql->fetch_array())
                                    {?>
                                        <option value="<?php  echo $edurow['residency_status'] ?>"><?php  echo $edurow['residency_status'] ?></option>
                                    
                                    <?php   } ?>
                                                                        
                                         </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Partner Expectations<span class="text-danger">*</span></label>                                            
                                            <textarea  name="txtPartnerExpectations" type="text" class="form-control" id="txtPartnerExpectations" value="<?php  echo $row['PartnerExpectations']; ?>" size="40" maxlength="450" placeholder="Enter Partner Expectations"><?php  echo $row['PartnerExpectations']; ?></textarea>
                                          
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                          
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <button class="btn btn-outline-dark ms-2">Clear</button>
                            </div>
                        </div>
                    </div>
                    
                     <div class="tab-pane fade" id="user-set-family" role="tabpanel" aria-labelledby="user-set-family-tab">
                      <form action="edit_family.php" method="post">
                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Family Details</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                 <div class="col-sm-6">
                                        <div class="form-group">
                                        <input type="hidden"  name="id" value="<?php  echo $_GET['ID'];?>">
                                            <label class="form-label">Family Values</label><br>                             
                                            <select class="skill-mlt-select "  name="txtFV" >
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
                                            <select class="skill-mlt-select "  name="txtFT" >
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
                                            <select class="skill-mlt-select "  name="txtFS" >
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
                                            <select class="skill-mlt-select "  name="mother_tounge" >
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
                                            <select class="skill-mlt-select "  name="txtFS1" id="noofbrom">
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
                                            <select class="skill-mlt-select "  name="txtFS2" id="noofsism">.
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
                                            <select class="skill-mlt-select "  name="bmarried6" >
                                            <?php  if($row['nbm']!=""){ ?>
                                            <option value="<?php  echo $row['nbm']; ?>" selected> <?php  echo $row['nbm']; ?></option>
                                            <?php  } ?>
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
                                            <select class="skill-mlt-select "  name="bmarried5" >
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
                                            <select class="skill-mlt-select "  name="bmarried4" >
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
                                            <select class="skill-mlt-select "  name="bmarried3" >
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
                                            <select class="skill-mlt-select "  name="bmarried2" >
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
                                            <select class="skill-mlt-select "  name="bmarried2" >
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
                                            <select class="skill-mlt-select "  name="bmarriedno" >
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
                                            <select class="skill-mlt-select "  name="smarried6">
                                             <?php  if($row['nsm']!="") { ?>
                                                <option value="<?php  echo $row['nsm']; ?>" selected> <?php  echo $row['nsm']; ?></option>
                                                <?php  } ?>
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
                                            <select class="skill-mlt-select " name="smarried5">
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
                                            <select class="skill-mlt-select "  name="smarried4">
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
                                            <select class="skill-mlt-select "  name="smarried3">
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
                                            <select class="skill-mlt-select " name="smarried2">
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
                                            <select class="skill-mlt-select "  name="smarried1">
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
                                            <select class="skill-mlt-select "  name="smarriedno">
                                            <option value="<?php  echo $row['nsm']; ?>" selected  >
                                            <?php  echo $row['nsm']; ?></option>
                                            <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                        
                                   
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Father Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="<?php  echo $row['Fathername']; ?>" onkeypress="return blockSpecialChar(event)" name="txtFANAME" id="txtFANAME" placeholder="Father Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Father Occupation <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="<?php  echo $row['Fathersoccupation']; ?>" onkeypress="return blockSpecialChar(event)" name="txtFFO" id="txtFFO" placeholder="Father Occupation">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Mother Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="<?php  echo $row['Mothersname']; ?>" onkeypress="return blockSpecialChar(event)" name="txtMONAME" id="txtMONAME" placeholder="Mother Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Mother Occupation<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="<?php  echo $row['Mothersoccupation']; ?>" onkeypress="return blockSpecialChar(event)" name="txtFMO" id="txtFMO" placeholder="Mother Occupation">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <?php  if($row['parents_stay']=="My parents will stay with me after marriage") { ?>
                                        <input type="radio" name="living_status"  value="My parents will stay with me after marriage" required tabindex="13" checked > <label class="form-label"> My parents will stay with me after marriage</label>
                                        <?php  } else {?>
                                        <input type="radio" name="living_status"  value="My parents will stay with me after marriage" required tabindex="13"> <label class="form-label"> My parents will stay with me after marriage</label>
                                        <?php  } ?>

                                        <br>
                                        <?php  if($row['parents_stay']=="My parents will not stay with me after marriage") { ?>
                                        <input type="radio" name="living_status"  value="My parents will not stay with me after marriage" tabindex="14" checked> <label class="form-label"> My parents will not stay with me after marriage</label>
                                        <?php  } else { ?>
                                        <input type="radio" name="living_status"  value="My parents will not stay with me after marriage" tabindex="14"> <label class="form-label"> My parents will not stay with me after marriage</label>
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
                                            <select class="skill-mlt-select "  name="family_wealth[]" id="family_wealth" multiple>
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
                                            <textarea  name="txtAboutfamily" type="text" class="form-control" id="txtAboutfamily" value="<?php  echo $row['FamilyDetails_new']; ?>" size="40" maxlength="450" placeholder="About family"><?php  echo $row['FamilyDetails_new']; ?></textarea>
                                          
                                        </div>
                                    </div>
                                     </div>
                                </div>
                            </div>
                            
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <button class="btn btn-outline-dark ms-2">Clear</button>
                            </div>
                            </form>
                        </div>
                    
                    <div class="tab-pane fade" id="user-set-contact" role="tabpanel" aria-labelledby="user-set-contact-tab">
                        <form action="edit_contact.php" method="post" >

                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Contact Information</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                 <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Address <span class="text-danger">*</span></label>
                                            <textarea name="txtAddress" id="txtAddress" class="form-control" placeholder="Enter Address"><?php echo $row['Address']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Country</label>
                                            <select class="skill-mlt-select"  onChange="fillstate2(this.value);"  name="country">
                                            <?php   $crs=$con->query("select * from e_country order by id ASC");?>
                                              <?php  if($row['Country']=="") { ?>
                                                 <option value="India" selected>India</option>
                                                <?php  } else { ?>
                                                <option value="<?php  echo $row['Country'];?>" selected><?php  echo $row['Country'];?></option>
                                                <?php  } while($crow=$crs->fetch_assoc()) { ?>
                                                <option value="<?php  echo $crow['country'];?>"><?php  echo $crow['country'];?></option>
                                                <?php   }   ?>
                                            </select>
                                        </div>
                                    </div>
                                  
                                       <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">State</label>
                                            <select class="skill-mlt-select"  id="state" onChange="filldist2(this.value)"  name="state">
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
                                    
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Districts</label>
                                            <select class="skill-mlt-select"  id="dist2" onChange="fillcity2(this.value)"  name="dist">
                                              <?php  if($row['Dist']=="")   { ?>
                                        <option value="" selected>Select District</option>
                                        <?php  } else  { ?>
                                        <option value="<?php  echo $row['Dist'];?>" selected><?php  echo $row['Dist'];?></option>
                                        <?php  } ?>
                                        <?php  
                                            $rrs=mysqli_query($con,"select * from e_dist ");
                                            while($rrow=mysqli_fetch_array($rrs))
                                            {
                                                $_SESSION['dist']=$rrow['dist'];
                                                if($rrow['dist']==$row['dist'])
                                                {
                                                    ?>
                                        <option value="<?php  echo $rrow['Dist'];?>" selected><?php  echo $rrow['Dist'];?></option>
                                        <?php  }else {?>
                                        <option value="<?php  echo $rrow['dist'];?>"><?php  echo $rrow['dist'];?></option>
                                        <?php           }
                                          }
                                            ?>
                                         </select>
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">City <span class="text-danger">*</span></label>
                                          
                                            <input name="city" type="text" class="form-control" id="txtPhone"  value="<?php  echo $row['City']; ?>" placeholder="Enter City" onKeyPress="return ValidateAlpha(event);">
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Pincode <span class="text-danger">*</span></label>
                                          <input name="Pincode" type="text" class="form-control" value="<?php  echo $row['Pincode']; ?>" placeholder="Enter Country Code"  >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Alternate Phone  <span class="text-danger">*</span></label>
                                          <input name="txtPhone" type="text" class="form-control" id="txtPhone"  value="<?php  echo $row['Phone']; ?>"   onKeyUp="check_phone('txtPhone')" placeholder="Enter Phone No." oninput="maxLengthCheck(this)" maxlength="14" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Mobile  <span class="text-danger">*</span></label>
                                          <input name="txtMobile" type="text" class="form-control" id="txtMobile"  value="<?php  echo $row['Mobile']; ?>" onBlur="ValidateNo()" placeholder="Enter Mobile No." oninput="maxLengthCheck(this)" maxlength="10" required onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Whtsapp No.  <span class="text-danger">*</span></label>
                                         <input name="txtMobile2" type="text" class="form-control" id="txtMobile1"  value="<?php  echo $row['Mobile2']; ?>"   onBlur="ValidateNo1()" placeholder="Enter Whtsapp No." oninput="maxLengthCheck(this)" maxlength="14" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Residence  <span class="text-danger">*</span></label><br>
                                         <select class="skill-mlt-select"    name="residence">
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
                                </div>
                            </div>
                          
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <button class="btn btn-outline-dark ms-2">Clear</button>
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
                                         <select class="skill-mlt-select"    name="txtHeight" id="txtHeight">
                                        
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
                                         <select class="skill-mlt-select"    name="txtWeight">
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
                                         <select class="skill-mlt-select"    name="txtBlood">
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
                                         <select class="skill-mlt-select"    name="txtBody">                              
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
                                         <select class="skill-mlt-select"    name="txtComplexion">
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
                                          <select class="skill-mlt-select"    name="txtDiet">
                                            <?php  if($row['Complexion']==""){ ?>
                                              <option value=""  selected>Complexion</option>
                                              <br>
                                              <?php  } else {?>
                                             <option value="<?php  echo $row['Complexion']; ?>"><?php  echo $row['Complexion']; ?></option>
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
                                          <select class="skill-mlt-select"    name="txtSmoke">
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
                                          <select class="skill-mlt-select"    name="txtDrink">
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
                                          <select class="skill-mlt-select"   name="scases" id="scases" size="1" class="form-control" onChange="showotherdist(this.value);" >
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
                                            <textarea class="form-control" name="otherdist"  class="form-control" placeholder="Please Specify" ><?php  echo $row['spe_reason'];?></textarea>
                                        </div>
                                    </div>
                            </div>
                          </div>
                     
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <button class="btn btn-outline-dark ms-2">Clear</button>
                            </div>
                        </div>
                    </form>
                  </div>
                    
                <div class="tab-pane fade" id="user-set-Horoscope" role="tabpanel" aria-labelledby="user-set-Horoscope-tab">
                          <form action="edit_horoscope.php" method="post">

                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Horoscope Information</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                 <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">

                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Moonsign<span class="text-danger">*</span> </label><br>
                                          <select class="skill-mlt-select"    name="txtMoon">
                                          <?php  if($row['Moonsign']=="")
                                            {?>
                                            <option value="" selected>Select Moonsign </option>
                                            <?php  } else { ?>
                                            <option value="<?php  echo $row['Moonsign']?>" selected><?php  echo $row['Moonsign']?></option>
                                            <?php  } ?> 
                                            <?php  $nakshatrasql=$con->query("select * from moon_sign");
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
                                          <select class="skill-mlt-select"    name="txtStar">
                                           <?php  if($row['Star']=="")
                                            {?>
                                            <option value="" selected>Select Star</option>
                                            <?php  } else { ?>
                                            <option value="<?php  echo $row['Star']?>" selected><?php  echo $row['Star']?></option>
                                            <?php  } ?> 
                                            
                                           <?php       $nakshatrasql=$con->query("select * from nakshatra");
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
                                            <input type="text" class="form-control"  name="txtGothra" value="<?php  echo $row['Gothram']; ?>" placeholder="Enter Gotra">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Manglik </label><br>
                                          <select class="skill-mlt-select"    name="txtManglik">
                                          <?php  if($row['Manglik']=="")
                                            {?>
                                            <option value="" selected>Select Star</option>
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
                                          <select class="skill-mlt-select"    name="shani">
                                            <?php  if($row['shani']=="")
                                            {?>
                                            <option value="" selected>Select </option>
                                            <?php  } else { ?>
                                            <option value="<?php  echo $row['shani']?>" selected><?php  echo $row['shani']?></option>
                                            <?php  } ?> 
                                            <?php  
                                            $shani=mysqli_query($con,"select * from shani where type!='".$row1['shani']."'");
                                            while($fect=mysqli_fetch_array($shani))
                                            {   ?>
                                            <option value="<?php  echo $fect['type'] ?>"><?php  echo $fect['type'] ?></option>
                                            <?php  }?>
                                            </select>
                                        </div>
                                    </div>  
                                 
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"> Horoscope Match </label><br>
                                          <select class="skill-mlt-select"    name="txtHorosMatch">
                                              <?php  if($row['Horosmatch']=="")
                                            {?>
                                            <option value="" selected>Select Star</option>
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
                                            <input type="text" class="form-control"  name="bplace" value="<?php  echo $row['POB'];?>" placeholder="Enter Place Of Birth " >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Place Of Country  </label>
                                            <input type="text" class="form-control"  name="cplace" value="<?php  echo $row['POC'];?>" placeholder="Enter Place Of Country " >
                                        </div>
                                    </div>
                                   
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Time Of Birth </label><br>
                                          <select class="skill-mlt-select"    name="bhour">
                                             <?php  
                                        $tm1="ok";
                                        if($row['TOB']!="")
                                        $tm=explode(":",$row['TOB']);
                                        else
                                        $tm1="";
                                        ?>
                                               <?php  
                                   if($tm1=="")
                                   {
                                   ?>
                                            <!--<option value=""  selected>Hours</option>-->
                                            <option selected="selected" value="Hours">Hr</option>
                                            <?php  
                                   }
                                   else
                                   {
                                   ?>
                                            <option selected="selected" value="<?php  echo $tm[0];?>"><?php  echo $tm[0];?></option>
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
                                          <select class="skill-mlt-select"    name="bminute">
                                            <?php  
                                   if($tm1=="")
                                   {
                                   ?>
                                            <option selected="selected" value="">Min</option>
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
                                          <select class="skill-mlt-select"    name="bsecond">
                                              <?php  
                                               if($tm1=="")
                                               {
                                               ?>
                                                        <option selected="selected" value="">Sec</option>
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
                                          <select class="skill-mlt-select"    name="bampm">
                                              <?php  
                                               if($tm1=="")
                                               {
                                               ?>
                                                        <option selected="selected" value="AM">bampm</option>
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
                                </div>
                            </div>
                          
                   
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                                <button class="btn btn-outline-dark ms-2">Clear</button>
                            </div>
                        </div>
                        </form>
                    </div>  
                    
                    <!--Upload ID Proof  -->
                    <div class="tab-pane fade" id="user-set-Idproof" role="tabpanel" aria-labelledby="user-set-Idproof-tab">
                      <form action="#" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Upload ID Proof</span></h5>
                            </div>
                            <div class="card-body">
                            
                                <?php if((!empty($_FILES["fileToUpload1"])) && ($_FILES['fileToUpload1']['error'] == 0)) {
                                    
                                  //Check if the file is JPEG image and it's size is less than 350Kb
                                  $old='../'.$_POST['old'];
                                  $filename =date('Y_m_d_h_i_s').basename($_FILES['fileToUpload1']['name']);
                                  $ext = substr($filename, strrpos($filename, '.') + 1);
                                  if (($ext == "jpg"||"png"||"gif"||"jpeg") && ($_FILES["fileToUpload1"]["type"] == "image/jpeg") && ($_FILES["fileToUpload1"]["size"] < 450000)) {
                                    //Determine the path to which we want to save this file
                                        $targetPath = "../adhar/".$filename;
                                     if(file_exists($targetPath))
                                        {
                                            unlink($targetPath);
                                        }else if(file_exists($old))
                                        {
                                            unlink($old);
                                        }
                                      $newname ='../adhar/'.$filename;
                                      //$_SESSION['adhar']=$newname;
                                      //Check if the file with the same name is already exists on the server
                                      if (!file_exists($newname)) {
                                          //Attempt to move the uploaded file to it's new place
                                        if ((move_uploaded_file($_FILES['fileToUpload1']['tmp_name'],$newname))) {
                                                    
                                             $adhar="update register set adhar='$newname',idproof_approve='Yes',idproof_type='".$_POST['document']."' where MatriID='$strmid'";
                                           //echo "update register set adhar='$newname',idproof_approve='Yes',idproof_type='".$_POST['document']."' where MatriID='$strmid'";

                                            
                                             mysqli_query($con,$adhar);

                                          $error= " Upload Successfully ";
                                        } else {
                                           $error="Error: A problem occurred during file upload!";
                                        }
                                      } else {
                                        $error= "Error: File ".$_FILES["fileToUpload1"]["name"]." already exists";
                                      }
                                  } else {
                                    $error= "Error: Only .jpg, .png, .gif, .jpeg images under 350Kb are accepted for upload";
                                  }
                                }?>
                              <?php $result1 =mysqli_query($con,"SELECT * FROM register where MatriID='$strmid' ");
                                       $row1 = mysqli_fetch_assoc($result1);?>
                                         
                                    
                                    <div class="col-sm-12">
                                            <?php if($row1['adhar']!=""){ ?>
                                           <img src="<?php echo $row1['adhar']?>" />
                                          
                                            <?php } else { ?>
                                             
                                             <img src="" style="display:none"  id="thumbnil">
                                            <div class=" " align="center" id="continue123" style="display:none">  </div>
                                            <?php// echo "No Photo"?> <br><br>
                                            
                                        <!--<select class="form-control selcs" name="document" style="max-width:64%" align="center">
                                                <option value="Aadhaar Card" selected="selected">Aadhaar Card</option>
                                                <option value="Voting Card">Voting Card</option>
                                                <option value="Driving License">Driving License</option>
                                                <option value="Passport" >Passport</option>
                                            </select>--> <br>
                                            <h4 align="center"><label for="upload1" class="btn btn-primary" style="background:#007bff">Browse</label></h4>
                                            <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">  
                                        <input name="fileToUpload1" style="visibility:hidden;" id="upload1" type="file" onchange="showMyImage(this);" />
                                    <?php } ?>
                                   
                                  
                         </div>
                   
                            <div class="card-footer text-end">
                            <?php if($row1['adhar']!=""){ ?>
                            <a class="btn btn-outline-dark ms-2" href="Delete_idproof.php?ID=<?php echo $strmid; ?>" onclick="return confirm('Are You Really Want To Delete This ID Proof...?  Click OK To Confirm...?')">Delete</a>
                            <?php }else{ ?> 
                                <button class="btn btn-outline-dark ms-2" name="" type="submit">Submit</button>
                                <a href="profile_view.php?ID=<?php  echo $strmid?>"><input type="button" value="Back" class="btn btn-primary"></a>
                            <?php } ?>
                            </div>
                    

                        </div>
                        </form>
                    </div>
                     </div>
                    <!--Upload Document Proof  -->
                    <div class="tab-pane fade" id="user-set-Document" role="tabpanel" aria-labelledby="user-set-Document-tab">
                      <form action="#" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Upload Document Proof</span></h5>
                            </div>
                            <div class="card-body">
                             
                            <?php if((!empty($_FILES["fileToUpload2"])) && ($_FILES['fileToUpload2']['error'] == 0)) {
                                //$strmid=$_GET['ID']; 
                              // echo "hello";
                              //Check if the file is JPEG image and it's size is less than 350Kb
                              $old='../'.$_POST['old'];
                              $filename =date('Y_m_d_h_i_s').basename($_FILES['fileToUpload2']['name']);
                              $ext = substr($filename, strrpos($filename, '.') + 1);
                              
                              if (($ext == "jpg"||"png"||"gif"||"jpeg") && ($_FILES["fileToUpload2"]["type"] == "image/jpeg") &&($_FILES["fileToUpload2"]["size"] < 950000)) {
                                //Determine the path to which we want to save this file
                                
                                $targetPath = "../document/".$filename;
                                 if(file_exists($targetPath))
                                    {
                                        unlink($targetPath);
                                    }else if(file_exists($old))
                                    {
                                        unlink($old);                                   }
                                    
                                 
                                  $newname1 ='../document/'.$filename;
                                 
                                  //Check if the file with the same name is already exists on the server
                                  if (!file_exists($newname1)) {
                                      //Attempt to move the uploaded file to it's new place
                                    if ((move_uploaded_file($_FILES['fileToUpload2']['tmp_name'],$newname1))) {
                                                
                                         $docs="update register set docs='$newname1' where MatriID='$strmid'";
                                        
                                         // echo "update register set docs='$newname1' where MatriID='$strmid'";
                                         mysqli_query($con,$docs);
                                         //exit;

                                      $error= " Upload Successfully ";
                                    } else {
                                       $error="Error: A problem occurred during file upload!";
                                    }
                                  } else {
                                    $error= "Error: File ".$_FILES["fileToUpload2"]["name"]." already exists";
                                  }
                              } else {
                                $error= "Error: Only .jpg, .png, .gif, .jpeg images under 800Kb are accepted for upload";
                              }
                            }
                            
                            ?>
                                <?php $result2=mysqli_query($con,"SELECT * FROM register where MatriID='$strmid' ");
                                //echo "SELECT * FROM register where MatriID='$strmid'";
                                       $row2= mysqli_fetch_assoc($result2);
                                       
                                       ?>
                         
                                         
                                <div class="col-sm-12">
                                
                                
                                            <?php if($row2['docs']!=""){ ?>
                                           <img src="<?php echo $row2['docs']?>" />
                                          
                                            <?php } else { ?>
                                             
                                             <img src="" style="display:none"  id="thumbnil">
                                            <div class=" " align="center" id="continue123" style="display:none">  </div>
                                            <?php// echo "No Photo"?> <br><br>
                                            
                                        <br>
                                            <h4 align="center"><label for="upload2" class="btn btn-primary" style="background:#007bff">Browse</label></h4>
                                            <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">  
                                        <input name="fileToUpload2" style="visibility:hidden;" id="upload2" type="file" onchange="showMyImage1(this);" />
                                    <?php } ?>
                                   
                                  
                         </div>
                   
                            <div class="card-footer text-end">
                            <?php if($row2['docs']!=""){ ?>
                            <a class="btn btn-outline-dark ms-2" href="delete_document.php?ID=<?php echo $strmid;?>" onclick="return confirm('Are You Really Want To Delete This ID Proof...?  Click OK To Confirm...?')">Delete</a>
                            <?php }else{ ?> 
                                <button class="btn btn-outline-dark ms-2" name="" type="submit">Submit</button>
                                <a href="profile_view.php?ID=<?php  echo $strmid?>"><input type="button" value="Back" class="btn btn-primary"></a>
                            <?php } ?>
                            </div>
                    

                        </div>
                        </form>
                    </div>
                     </div>
                    
                                      
                    <div class="tab-pane fade" id="user-set-email" role="tabpanel" aria-labelledby="user-set-email-tab">
                       <form method="post" action="settings.php" >
                       
                        <div class="card">
                            <div class="card-header">
                                <h5><i data-feather="at-sign" class="icon-svg-primary wid-20"></i><span class="p-l-5"> User Settings</span></h5>
                               
                            </div>
                            <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item py-4">
                                    <h5 class="mb-3">Horoscope  Setting</h5>
                                    <div class="m-l-40">
                                    <?php
                                     if($row['horoscope_visibility']=='paidhoro'){?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"  name="horoscope" id="customSwitchemlnot1" value="paidhoro" checked>
                                            <label class="form-check-label" for="customSwitchemlnot1">horoscope visible only to paid members ---- Recommend for better performance.</label>
                                        </div>
                                    <?php }  else { ?>
                                    <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"  name="horoscope" id="customSwitchemlnot1" value="paidhoro"  >
                                            <label class="form-check-label" for="customSwitchemlnot1">horoscope visible only to paid members ---- Recommend for better performance.</label>
                                        </div>
                                    <?php } ?> 
                                    <?php
                                     if($row['horoscope_visibility']=='freehoro'){?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="horoscope" id="customSwitchemlnot" value="freehoro" checked>
                                            <label class="form-check-label" for="customSwitchemlnot2">  horoscope visible to all</label>
                                        </div>
                                 <?php }  else { ?>
                                      <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="horoscope" id="customSwitchemlnot" value="freehoro" >
                                            <label class="form-check-label" for="customSwitchemlnot2">  horoscope visible to all</label>
                                        </div>
                                 <?php } ?>
                                    </div>
                                </li>
                                <li class="list-group-item py-4">
                                    <h5 class="mb-3">Phone Setting</h5>
                                    <div class="m-l-40">
                                    <?php
                                     if($row['phone_visibility']=='paidphone'){?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"  name="phone"  id="customSwitchemlnot1" checked value="paidphone">
                                            <label class="form-check-label" for="customSwitchemlnot1">  Show mobile number only to paid members ---- Recommend for better performance.</label>
                                        </div>
                                     <?php } else { ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="phone"  id="customSwitchemlnot1" value="paidphone">
                                            <label class="form-check-label" for="customSwitchemlnot1">  Show mobile number only to paid members ---- Recommend for better performance.</label>
                                        </div>
                                     <?php } ?>
                                     <?php
                                     if($row['phone_visibility']=='freephone'){?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"  name="phone"  id="customSwitchemlnot2" value="freephone"checked>
                                            <label class="form-check-label" for="customSwitchemlnot2">    Show mobile number only to whom I grant access to view</label>
                                        </div>
                                   <?php } else { ?>
                                    <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"  name="phone"  id="customSwitchemlnot2" value="freephone">
                                            <label class="form-check-label" for="customSwitchemlnot2">    Show mobile number only to whom I grant access to view</label>
                                        </div>
                                   <?php } ?>

                                    </div>
                                </li>
                                 <li class="list-group-item py-4">
                                    <h5 class="mb-3">Photo Setting</h5>
                                    <div class="m-l-40">
                                    <?php
                                     if($row['photo_visibility']=='paidphoto'){?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="photo" type="checkbox" id="customSwitchemlnot1" value="paidphoto" checked>
                                            <label class="form-check-label" for="customSwitchemlnot1">Show photo only to paid members ---- Recommend for better performance.</label>
                                        </div>
                                     <?php } else {?>
                                      <div class="form-check form-switch">
                                            <input class="form-check-input" name="photo" type="checkbox" id="customSwitchemlnot1" value="paidphoto" >
                                            <label class="form-check-label" for="customSwitchemlnot1">Show photo only to paid members ---- Recommend for better performance.</label>
                                        </div>
                                     <?php } ?>
                                     <?php
                                     if($row['photo_visibility']=='freephoto'){?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="photo" type="checkbox" id="customSwitchemlnot2" value="freephoto" checked>
                                            <label class="form-check-label" for="customSwitchemlnot2">Show photo only to whom I grant access to view</label>
                                        </div>
                                     <?php } else {?>
                                      <div class="form-check form-switch">
                                            <input class="form-check-input" name="photo" type="checkbox" id="customSwitchemlnot2" value="freephoto">
                                            <label class="form-check-label" for="customSwitchemlnot2">Show photo only to whom I grant access to view</label>
                                        </div>
                                     <?php } ?>
                                      <?php
                                     if($row['photo_visibility']=='allphoto'){?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="photo" type="checkbox" id="customSwitchemlnot2" checked value="allphoto">
                                            <label class="form-check-label" for="customSwitchemlnot2">View to all</label>
                                        </div>
                                     <?php } else {?>
                                      <div class="form-check form-switch">
                                            <input class="form-check-input" name="photo" type="checkbox" id="customSwitchemlnot2" value="allphoto">
                                            <label class="form-check-label" for="customSwitchemlnot2">View to all</label>
                                      </div>
                                    <?php } ?>  
                                    </div>
                                </li>
                                
                            </ul>
                            <div class="card-footer text-end">
                                <button class="btn btn-warning">Update Change</button>
                                <button class="btn btn-outline-dark ms-2">Clear</button>
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

    <!-- Warning Section Ends -->
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

<script src="assets/js/plugins/select2.full.min.js"></script>
<script>
    $(function() {
        $(".skill-mlt-select").select2();
    });
</script>
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
            $('.m-header > .b-brand > .logo-lg').attr('src', 'http://localhost/SVR/css3/assets/shivraj-logo.png');
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
xmlhttp.open("GET","fill_state.php?q="+str,true);
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
xmlhttp.open("GET","fill_dist.php?q="+str,true);
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
</body>
</html>
