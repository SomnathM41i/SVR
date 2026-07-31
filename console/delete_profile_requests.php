<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');

?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/hospital-doctor.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:53 GMT -->
<head>
    <title>Delete Profile Request</title>
    
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

    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/mpj-brand.css">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="assets/css/popup.css">


    
    <script>
    $(document).ready(function() {
        $("button").click(function(){
            
            var favorite = [];
            var atLeastOneIsChecked = $('input[name="sport"]:checked').length > 0;
            if(atLeastOneIsChecked==0){
                alert("Please Select At Least One Profile");
            
            }else{
                $.each($("input[name='sport']:checked"), function(){            
                favorite.push($(this).val());
            });
            
           // alert("My favourite sports are: " + favorite.join(", "));
           
            window.location.href = 'deletemember_pop?id='+ favorite.join(",");   
            }

        });
    });
    
</script>
    <script language="javascript">
function goDel() 
{ 
    var recslen =  document.forms[0].length; 
    var checkboxes="" 
    for(i=0;i<recslen;i++) 
    { 
        if(document.forms[0].elements[i].checked==true) 
        checkboxes+= " " + document.forms[0].elements[i].name 
    } 
    
    if(checkboxes.length=="checked") 
    { 
        var con=confirm("Are you sure you want to delete. \n\n Once Delete you can not retrieve again.\n\n Backup your Database first then do delete."); 
        if(con) 
        { 
            var mySplitResult = checkboxes.split(",");
            
            document.forms[0].action="delete_ban.php?recsno="+mySplitResult[0]
            
            document.forms[0].submit() 
            
            
        } 
    } 
    else 
    { 
        alert("No profile is selected.") 
    } 
} 

</script>
 <style>
 .row {
    --bs-gutter-x: -0.5rem;
    }
 .btnma
 {
     margin-left:65px;
 }
 </style>

</head>
<body class="pc-horizontal">
    <div class="">
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

<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- customar project  start -->
             <div class="card">
                <div class="card-header">
                        <h5>Profile Delete  Request</h5>
                </div>
              <div class="card-body">
            <div class="col-sm-12">
               
                   
                      
                        <div class="table-responsive">
                            <table id="report-table" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                      <td><b>PROFILE ID</b></td>
                                        <td><b>REASON</b></td>
                                        
                                        <td><b>REQUEST DATE</b></td>
                                        <td width="100px"><b>ACTION</b></td>
                                          
                                    </tr>
                                </thead>
                                <tbody>
                                <?php  
                                            $result=$con->query("select *,date_format(rec_date,'%d-%m-%Y') as rec_date from delete_request");

                                            while($row=$result->fetch_array())
                                            {
                                                $MatriID=$row['matriid'];
                                                $reason=$row['reason']; 
                                                $recdat=$row['rec_date'];

                                            ?>
                                            <tr>
                                                <td ><?php  echo $MatriID;?></td>
                                                <td ><?php  echo $reason; ?></td>
                                                <td ><?php  echo $recdat;?></td>
                                                <td ><input type="checkbox" class="form-check-input" name="sport" value="<?php echo $MatriID;?>"></td>
                                                
                                              </tr>
                                            <?php  
                                          $i++;
                                          }
                                          ?>
                                    
                                </tbody>
                            </table>

                        </div>
                        
                    </div>
                    <br>
                      <div class="row">
                       <div class="col-md-2">
                       <button type="button" class="btn btn-warning btn-sm">Delete Permanently</button>
                           </div>
                            <?php /* <div class="col-md-2">
                   <button type="button" class="btn btn-warning btn-sm ml-5">Delete Permanently</button>
                    </div> */?>
                </div>
                </div>
            </div>

            <!-- customar project  end -->
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

<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script>
    // DataTable start
    $('#report-table').DataTable();
    // DataTable end
</script>
</script>
<?php include('footersection.php');?>
<?php include('footer.php');?>
</script>




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
            $('.m-header > .b-brand > .logo-lg').attr('src', '../branding/logos/emblem.png');
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
     $(window).load(function(){        
       $('#myModal13').modal('show');
        }); 
    </script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<?php if($_GET['msg']!=''){ ?>
<div id="myModal13" class="modal " role="dialog" style="margin-top: 100px;">
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
                        <?php if($_GET['msg']=='delete'){ ?>
                        <h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Profile Deleted Successfully" ?> </h2>
                        <?php } if($_GET['msg']=='warn'){ ?>
                        <h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Please select at least one profile" ?> </h2>
                        <?php } ?>
                    </div>
                    <div class="swal2-actions">
                        <a href="delete_profile_requests" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<?php } ?>
</body>
</html>
