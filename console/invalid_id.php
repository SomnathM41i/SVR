<?php require_once('../includes/bootstrap.php');
include('protect.php'); 
?>



<!DOCTYPE html>
<html lang="en">


<head>
    <title>Invalid Profile ID</title>
   
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">?>
    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
    
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">
    <link rel="stylesheet" href="assets/css/stylnew.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/advance.css" id="main-style-link">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
    <link href="../css/style.css?v=505020.0" rel="stylesheet">
 
  <style>
  
  .input-group .btn {
      margin-left: -14px;
  }
  .faic {
    margin-left: -3px;
    margin-right: -4px;
 }
  .mt-3 {
    margin-top: 2rem !important;
}
  .alert-info {
    color: #257980;
    background-color: #dce9ff;
    border-color: #dce9ff;
}
  .card {
    box-shadow: 0 2px 6px -1px rgb(16 16 16 / 23%);
    margin-bottom: 24px;
    transition: box-shadow 0.2s ease-in-out;
    }
  .card1 {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #dce9ff;
    background-clip: border-box;
    border: 0px solid rgba(0, 0, 0, 0.125);
    border-radius: 4px;
}
* {
    margin: 0px;
    padding: 0px;
    border: none;
    outline: none;
}
  
  .fa-check-circle:before {
    content: "\f058";
}
  .gallery-item1 {
    position: relative;
    /* margin-bottom: 30px; */
}
  .fancybox-navigation .fancybox-button--arrow_right {
    display: none;
}
.fancybox-navigation .fancybox-button--arrow_left {
    display: none;
}
.fancybox-is-sliding
{
    display:none;
}
.card-body {
    flex: 1 1 auto;
    padding: 24px 17px;
}
.gallery-item1 .overlay-box {
    position: absolute;
    left: 0;
    top: 0;
    height: 99%;
    width: 39%;
    text-align: center;
    content: "";
    opacity: 0;
    background-color: transparent;
    margin-left: 14%;
}


.gallery-item1 .overlay-box a {
    position: absolute;
    left: 8%;
    top: 161px;
    margin-top: -15px;
    margin-left: 84px;
}
.gallery-item1 .image-box .image img {
    display: block;
    width: 100%;
    height: 459px;
}
a {
    text-decoration: none;
    cursor: pointer;
    color: #f20487;
}

a {
    color: #007bff;
    text-decoration: none;
    background-color: transparent;
    -webkit-text-decoration-skip: objects;

}
.search-popup1 {
    position: fixed;
    left: 0px;
    bottom: -100%;
    width: 100%;
    height: 100%;
    z-index: 9999;
    visibility: hidden;
    opacity: 0;
    overflow: auto;
    background: rgba(0,0,0,0.80);
    transition: all 700ms ease;
    -moz-transition: all 700ms ease;
    -webkit-transition: all 700ms ease;
    -ms-transition: all 700ms ease;
    -o-transition: all 700ms ease;
}
* {
    margin: 0px;
    padding: 0px;
    border: none;
    outline: none;
}

  </style>
  <style>
  .ticks{
    font-size: 16px;
    line-height: 30px;
     color: #777777;
}
  .table.table-xs td, .table.table-xs th {
    padding: 0.1rem 0.1rem;
}
.tick {
    font-size: 16px;
    line-height: 30px;
    color: #2bd40f;
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
    
        
        <?php include('topheader.php');?>
        <?php include('header.php');?>
        
        <?php include('notification.php');?>


<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
       
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ task-board-left ] start -->
            <div class="col-xl-12 col-md-12 ">
                <div class="alert alert-danger alert-dismissible" role="alert" >
                    <h5 class="alert-heading" style="color:Black">
                        <i class="feather icon-alert-circle me-2"></i> 
                        <b>Please Enter Existing Profile ID.</b>
                    </h5>                                
                 </div>
            </div>
            <div class="col-xl-12 col-md-12 ">
                <form action="get_id" method="POST" >
                    <div class="input-group mb-4 mt-4 col-md-12">
                        <div class="input-group-text" id="btnGroupAddon2"> <b>Enter  Profile ID</b> 
                        </div>
                        <input type="text" class="form-control" placeholder="Enter Existing Profile ID" aria-label="Input group example" aria-describedby="btnGroupAddon2" name="search" id ="search" required="" maxlength="10" />
                        <button type="submit" class="btn  btn-icon btn-secondary" name="submit" ><i class="fas fa-search faic"></i>
                        </button>
                    </div>
                </form>                      
            </div>
            <!-- [ task-board-left ] end -->
            
            <!-- [ task-board-right ] start -->
           
            
            
        </div>

    </div>
</div>
      
</div>

<script>
    
    
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<?php include('footer.php')?>


</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/ecom-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:55:05 GMT -->
</html>
