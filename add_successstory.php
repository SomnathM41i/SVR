<?php

    error_reporting(0);
    include('protect.php'); 
    require_once('sys_dbconnection.php');
    /*include'../dbconnectadmin.php';*/
    if(isset($_POST['upload']))
    {
        
        $gname=$_POST['groomname'];
        $bname=$_POST['bridename'];
        $success_msg=$_POST['story'];
        $date=$_POST['date'];
        $msg="";
        $newname="";
        $error="";
        $success="";
        $adhar="";
        
        $que =  mysqli_query($con,"SELECT MatriID FROM register where Name='$gname' ");
        $row =  mysqli_fetch_array($que);
        $val =  $row['MatriID']; 

        $que1 = mysqli_query($con,"SELECT MatriID FROM register where Name='$bname'");
        $row1 = mysqli_fetch_array($que1);
        $val1 = $row1['MatriID'];


        //?heck that we have a file
        if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) 
        {
    
            //Check if the file is JPEG image and it's size is less than 350Kb
            $old='../'.$_POST['old'];
            $filename =date('Y_m_d_h_i_s').basename($_FILES['uploaded_file']['name']);
            $ext = substr($filename, strrpos($filename, '.') + 1);
            if (($ext == "jpg"||"png"||"gif"||"jpeg") && ($_FILES["uploaded_file"]["type"] == "image/jpeg") && 
                ($_FILES["uploaded_file"]["size"] < 2000000)) 
            {
                //Determine the path to which we want to save this file
                $targetPath = "../success/".$filename;
                if(file_exists($targetPath))
                {
                    unlink($targetPath);
                }
                else if(file_exists($old))
                {
                    unlink($old);
                }
                $newname1 =$filename;
                $newname ='../success/'.$filename;
                //$_SESSION['adhar']=$newname;
                //Check if the file with the same name is already exists on the server
                if (!file_exists($newname)) 
                { 
                    //Attempt to move the uploaded file to it's new place
                    if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) 
                    {
                        $sucess="insert into successstory (weddingphoto,bridename,groomname,successmessage,approve,marriagedate,brideid,groomid) values('$newname1','$bname','$gname','$success_msg','Yes','$date','$val1','$val')";
                        mysqli_query($con,$sucess);
                        $error= " Upload Successfully ";
                    } 
                    else 
                    {
                        $error="Error: A problem occurred during file upload!";
                    }
                } 
                else 
                {
                    $error= "Error: File ".$_FILES["uploaded_file"]["name"]." already exists";
                }
            } 
            else 
            {
                $error= "Error: Only .jpg, .png, .gif, .jpeg images under 2Mb are accepted for upload";
            }
        }  
    }
    //echo $error;

?>


<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Add Success Story</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
	<link href="ckeditor/sample.css" rel="stylesheet" type="text/css" />
	<link href="bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
	 
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/stylenew.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
	 <link rel="stylesheet" href="assets/css/popup.css">
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
<style type="text/css">
    
    .col-sm-6 
    {
        padding-right: 100px;
        padding-left: 0px;
        float:left;
        flex: 0 0 auto;
        width: 45%;
    }
     
   .col-sm-2
   {    
        left: 10px;
        position: relative;
        float:left;
        align-content: center;
        flex: 0 0 auto;
        width: 15%;
        height: 80px;
        padding-left: 65px;
        padding-top:  5px;
        justify-content: center;
        align-items: center;
    }
    
    .background
    {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	 $(window).load(function(){        
	   $('#myModal4').modal('show');
		}); 
	</script>

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
        <!-- [ Header ] start -->
        
        <!-- [ Header ] end -->
        <!-- [ navigation menu ] start -->
          <?php include('topheader.php');?>
          <?php include('header.php');?>
        <!-- [ navigation menu ] end -->
        <!-- Modal -->
        <?php include('notification.php');?>

<!-- [ Main Content ] start -->

        <div class="pc-container">
            <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
                <div class="row">
                    <div class="col-sm-12">
                    
			            <div class="card">
                            <div class="card-body">
                                <div class="container">
                                    <div class="form-group">
                                        <form action="#" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                            <?php  
                                                $qry="select * from cms where cms_id='9'";
	                                            $result=mysqli_query($con,$qry);
	                                           $res=mysqli_fetch_array($result);
                                            ?>
                                                <div class="col-md-12">
                                                    <div class="box-body">
                                                        <div class="col-sm-12">
                                                            <label class="form-label">Upload Marriage Photo: <b>( Width: 300px & Height: 220px)</b></label><br>
                                                            <input name="uploaded_file" type="file" class="form-control"required> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-md-5 pt-3">
                                                    <div class="box-body">    
								                        <div class="col-sm-12">
                                                            <label class="form-label">Groom Name </label>
                                                                <input type="text" class="form-control" name="groomname"  onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" placeholder="Enter Groom Name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <?php include('heart1.php'); ?>
                                                </div>
                                                <div class="col-md-5 pt-3">
                                                    <div class="box-body">
                                                        <div class="col-sm-12">
                                                            <label class="form-label">Bride Name </label>
                                                            <input type="text" class="form-control" name="bridename" placeholder="Enter Bride Name"  onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-3">
                                                <label class="form-label">Date</label>
                                                <input type="date" name="date" class="form-control" required/>
                                            </div><br>
                                            <div class="col-sm-12">
                                                <label class="form-label">Success Story Message</label>
                                                <textarea class="form-control" name="story" row=5  required> </textarea>
                                            </div><br>
								            <br>
							                 <button type="submit" class="btn btn-primary" id="update" name="upload">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <!-- [ Main Content ] end -->
                </div>
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

<!-- Apex Chart -->
<!-- trumbowyg editor -->
<script src="assets/js/plugins/trumbowyg.min.js"></script>

<script type="text/javascript">
    // tinymce editor
    $(window).on('load', function() {
        $('#tinymce-editor').trumbowyg({
            svgPath: 'assets/css/plugins/icons.svg',
            btns: [
                ['viewHTML'],
                ['undo', 'redo'],
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                ['link'],
                ['insertImage'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ]
        });
    });
</script>
    

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->
<script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script src="ckeditor/sample.js" type="text/javascript"></script>
<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>

<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
    
<?php include('footersection.php');?>
<?php include('footer.php');?>
</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>
