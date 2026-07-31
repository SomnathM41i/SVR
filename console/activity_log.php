<?php require_once('../includes/bootstrap.php'); 
require_once(dirname(__FILE__).'/protect.php');
$id = isset($_REQUEST['id']) ? trim($_REQUEST['id']) : '';
/* SECURITY (H1): prepared statement instead of raw interpolation. */
$stmt = mysqli_prepare($con, "SELECT * FROM register WHERE MatriID=? LIMIT 1");
$fetch_data = null;
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $reg_data = mysqli_stmt_get_result($stmt);
    $fetch_data = $reg_data ? mysqli_fetch_array($reg_data) : null;
    mysqli_stmt_close($stmt);
}
$new_reg_Date = date("d-m-Y", strtotime($fetch_data['Regdate']));
$new_memdate = date( "d-m-Y", strtotime($fetch_data['MemshipExpiryDate'])) ;
if($fetch_data['Lastlogin'] == NULL)
{
   $new_last_login = $new_reg_Date; 

}
else{
    $new_last_login = date( "d-m-Y", strtotime($fetch_data['Lastlogin'])) ;
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/hospital-doctor.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:53 GMT -->
<head>
    <title>Activity Log</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            var count = 5; 
            
            $("button").click(function(){

                count  = count + 5;
                $("#comments").load("load_activity.php",{
                    commentCount: count
                    /*id: id*/

                });

            });
        }); 
    </script>
    <script type="text/javascript">
        let basic = document.getElementById('basic');
        function view_profile_view(){
           let link = document.querySelector('#user-set-profile');
            if (link) {
                link.removeAttribute('hidden');
               document.querySelector('#user-set-profile1').setAttribute('hidden','#user-set-profile1');
               document.querySelector('#user-set-profile2').setAttribute('hidden','#user-set-profile2');
               document.querySelector('#user-set-profile3').setAttribute('hidden','#user-set-profile3');
               document.querySelector('#basic').setAttribute('hidden','#basic');
            }
        }  
        function view_interest(){
           let link = document.querySelector('#user-set-profile1');
            if (link) {
                link.removeAttribute('hidden');
               document.querySelector('#user-set-profile').setAttribute('hidden','#user-set-profile');
               document.querySelector('#user-set-profile2').setAttribute('hidden','#user-set-profile2');
               document.querySelector('#user-set-profile3').setAttribute('hidden','#user-set-profile3');
                document.querySelector('#basic').setAttribute('hidden','#basic');
            }
        }
        function view_req(){
           let link = document.querySelector('#user-set-profile2');
            if (link) {
                link.removeAttribute('hidden');
               document.querySelector('#user-set-profile').setAttribute('hidden','#user-set-profile');
               document.querySelector('#user-set-profile1').setAttribute('hidden','#user-set-profile1');
               document.querySelector('#user-set-profile3').setAttribute('hidden','#user-set-profile3');
                document.querySelector('#basic').setAttribute('hidden','#basic');
            }
        }
        function view_shortlist(){
           let link = document.querySelector('#user-set-profile3');
            if (link) {
                link.removeAttribute('hidden');
               document.querySelector('#user-set-profile').setAttribute('hidden','#user-set-profile');
               document.querySelector('#user-set-profile1').setAttribute('hidden','#user-set-profile1');
               document.querySelector('#user-set-profile2').setAttribute('hidden','#user-set-profile2');
                document.querySelector('#basic').setAttribute('hidden','#basic');
            }
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />
    <!-- Favicon icon -->
    <?php //<link rel="icon" href="../branding/favicons/favicon.ico" type="image/x-icon">?>
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
    <link rel="stylesheet" href="assets/css/popup.css">
    <style>
        .row {
        --bs-gutter-x: -0.5rem;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="pc-horizontal">
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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6">
                                    <h3> Activity Log</h3>
                                </div>
                                <hr/>
                            </div>
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-2">
                                    <h4><b>Choose Activity</b></h4>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-success" onclick="view_profile_view();">
                                        Profile Viewed
                                    </button>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-success" onclick="view_interest();">
                                        Viewed Contact
                                    </button>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-success" onclick="view_req();">
                                        Request Accepted
                                    </button>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-success" onclick="view_shortlist();">
                                        Shortlisted
                                    </button>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="container" id="basic">
                                                <?php include 'activity_basic.php';?>
                                            </div>
                                            <div class="container" id="user-set-profile" hidden>
                                                <?php include 'activity_pro_view.php';?>
                                            </div>
                                            <div class="container" id="user-set-profile1" hidden>
                                            <?php include 'activity_view_contact.php';?>
                                            </div>
                                            <div class="container" id="user-set-profile2" hidden >
                                                <?php include 'activity_connected.php';?>
                                            </div>
                                            <div class="container" id="user-set-profile3" hidden >
                                                <?php include 'activity_view_shortlist.php';?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
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

    <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>

    <!-- Apex Chart -->
    <script src="assets/js/plugins/apexcharts.min.js"></script>
    <script>
        //DataTable start
        //$('#report-table').DataTable();
        // DataTable end
    </script>
    <script>
        $(document).ready(function () {
            $('#report-table').DataTable({
                 "order": [[ 1, "desc" ]],
                 "columnDefs": [ { type: 'date', 'targets': [1] } ]
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
    <?php include('footersection.php'); ?>
    </script>
    <div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
               
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-report1" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
               
            </div>
        </div>
    </div>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-Q8H86P6FK7');
    </script>
    <script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>





<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/hospital-doctor.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:53 GMT -->
</html>
