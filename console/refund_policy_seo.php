<?php
  
  require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
  error_reporting(0);
?>
<?php  
                     
    if(isset($_POST['submit']))
    {
        $catagory=$_GET['catagory'];
        $title = $db->setfilter(trim($_POST["title"]));
        $descript = $db->setfilter(trim($_POST["descript"]));
        $keyword = $db->setfilter(trim($_POST["keyword"]));
        
        $upd_about ="update seo set title = '$title',description='$descript',keyword='$keyword' where catagory='$catagory'";
        
        mysqli_query($con,$upd_about);
                                
    } 
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>SEO Refund Policy</title>
   
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Manpasand Jodidar - Admin Panel"/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="../branding/favicons/favicon.ico" type="image/x-icon">?>
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <!-- MPJ: brand icons -->
    <link rel="apple-touch-icon" href="../branding/favicons/apple-touch-icon.png">
    <link rel="manifest" href="../branding/site.webmanifest">
    <meta name="theme-color" content="#5E1426">
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
function blockSpecialChar(e){ 
var k;
document.all ? k = e.keyCode : k = e.which;
return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
<script type="text/javascript">
 function nospaces(t)
{
if(t.value.match(/ \s/g)){
alert('Sorry,Only one space allowed');
t.value=t.value.replace(/ \s/g,'');
}}
</script>
<script type="text/javascript">
function nospaceses(t)
{
if(t.value.match(/,+/g)){
//alert('Sorry,Only one comma allowed');
t.value=t.value.replace(/,+/g,',');
}
}
</script>
<script type="text/javascript">
function nospaceses1(t)
{
if(t.value.match(/^,/g)){
 alert('Sorry,you cannot enter comma as a first letter');
t.value=t.value.replace(/^,/g,'');
}
}
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
        
        <!-- [ Mobile header ] End -->
        <!-- [ Header ] start -->
        
        <!-- [ Header ] end -->
        <!-- [ navigation menu ] start -->
          <?php include('topheader.php');?>
          <?php include('header.php');?>
        <!-- [ navigation menu ] end -->
        <!-- Modal -->
        <?php include('notification.php');?>
        
        <!-- [ Header ] end -->

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
                        
                            <form action="#" method="post">
                            
                            <div class="form-group">
                            <?php 
                                    $catagory=$_GET['catagory'];
                                    
                                  $qry="select * from seo where catagory='$catagory'";
                                  
                                  $result=mysqli_query($con,$qry);
                                     
                                   $res=mysqli_fetch_array($result);
                                      ?>
                                      <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#!">SEO</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Refund Policy</li>
                            </ol>
                        </nav>
                                <!--<label class="form-label" for="exampleInputPassword1">Description</label>-->
                                <div class="col-sm-12">
                                       
                                           <label class="form-label">Title :</label>
                                           <input type="" class="form-control" name="title" value="<?php echo$res['title']; ?>" placeholder="Enter your website name  Ex: welcome to your domain name " onkeyup="nospaces(this)" maxlength="60">
                                           
                                           
                                 </div><br>
                                 <div class="col-sm-12">
                                       
                                           <label class="form-label">Description :</label>
                                           <textarea class="form-control" name="descript" placeholder="Enter about your company" maxlength="150" onkeyup="nospaces(this)"><?php echo $res['description'];?></textarea>
                                           
                                 </div><br>
                                  <div class="col-sm-12">
                                       
                                           <label class="form-label">Keyword:</label>
                                           <textarea class="form-control" name="keyword" maxlength="80" placeholder="Enter few keywords for finding your website on search result. Ex: Matrimony Site,Hindu Matrimony,Hindu Groom's,etc." onkeyup="nospaces(this);nospaceses(this);nospaceses1(this)"><?php echo$res['keyword'];?></textarea>
                                 </div><br>
                                  
                                   
                            </div>
                            
                            <button type="submit" class="btn btn-primary" id="update" name="submit">Update</button>
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
<?php include('footer.php');?>


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
<?php include('footersection.php');?>
</script>

    <!-- Required Js -->
    
<script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script src="ckeditor/sample.js" type="text/javascript"></script>
<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
     $(window).load(function(){        
       $('#myModal12').modal('show');
        }); 
    </script>
<?php if(isset($_POST['submit'])){ ?>
<div id="myModal12" class="modal " role="dialog" style="margin-top: 100px;">
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
                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Updated Successfully</h2>
                    </div>
                    <div class="swal2-actions">
                       <a href="refund_policy_seo?catagory=refund_policy" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                    </div>
                </div> 
            </div>
        </div>   
    </div>
</div>   
</div>


<?php } ?>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>

<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>


</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>
