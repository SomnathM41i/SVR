<?php  require_once('../includes/bootstrap.php');
include('protect.php');




$profile_approve = mysqli_query($con,"SELECT * FROM register where HorosApprove='No' and  horoscope!='' order by id DESC");

if(isset($_GET["page"]))
    $page = (int)$_GET["page"];
    else
    $page = 1;
    $setLimit =8;
    $pageLimit = ($page * $setLimit) - $setLimit;
    
$profile_approve = mysqli_query($con,"SELECT * FROM register where HorosApprove='No' and  horoscope!='' order by id DESC LIMIT ".$pageLimit." , ".$setLimit);
    
function displayPaginationBelow($con,$per_page,$page){
$page_url="?";
$sql1 = mysqli_query($con,"SELECT COUNT(*) as totalCount FROM register where HorosApprove='No' and  horoscope!='' order by id DESC");
    
        
        $rec = mysqli_fetch_array($sql1);
        $total = $rec['totalCount'];
        $adjacents = "2"; 

        $page = ($page == 0 ? 1 : $page);  
        $start = ($page - 1) * $per_page;                               
        
        $prev = $page - 1;                          
        $next = $page + 1;
        $setLastpage = ceil($total/$per_page);
        $lpm1 = $setLastpage - 1;
        
        $setPaginate = "";
        if($setLastpage > 1)
        {   
            $setPaginate .= "<ul class='pagination  Paginations' align='Center'>"; 
            $setPaginate .= "<li class='page-item mt-1 mr-5'>Page $page of $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2))
            {   
                for ($counter = 1; $counter <= $setLastpage; $counter++)
                {
                    if ($counter == $page)
                        $setPaginate.= "<li><a class='page-link active'>$counter</a></li>";
                    else
                        $setPaginate.= "<li><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";                    
                }
            }
            elseif($setLastpage > 5 + ($adjacents * 2))
            {
                if($page < 1 + ($adjacents * 2))        
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='page-link active'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";                    
                    }
                    $setPaginate.= "<li class='dot'>...</li>";
                    $setPaginate.= "<li><a class='page-link' href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                    $setPaginate.= "<li><a class='page-link' href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";        
                }
                elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
                    $setPaginate.= "<li><a class='page-link' href='{$page_url}page=1'>1</a></li>";
                    $setPaginate.= "<li><a class='page-link' href='{$page_url}page=2'>2</a></li>";
                    $setPaginate.= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='page-link active'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";                    
                    }
                    $setPaginate.= "<li class='dot'>..</li>";
                    $setPaginate.= "<li><a class='page-link' href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                    $setPaginate.= "<li><a class='page-link' href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";        
                }
                else
                {
                    $setPaginate.= "<li><a class='page-link' href='{$page_url}page=1'>1</a></li>";
                    $setPaginate.= "<li><a class='page-link' href='{$page_url}page=2'>2</a></li>";
                    $setPaginate.= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
                    {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='page-link active'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";                    
                    }
                }
            }
            
            if ($page < $counter - 1){ 
                $setPaginate.= "<li><a  class='page-link' href='{$page_url}page=$next'><b>Next</b></a></li>";
            }else{
                $setPaginate.= "<li><a class='page-link  active'><b>Next</b></a></li>";
            }

            $setPaginate.= "</ul>\n";       
        }
    
    
        return $setPaginate;
    }


?>






<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/gallery-masonry.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:55:54 GMT -->
<head>
    <title>Horoscope Approval</title>
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
    <?php //<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">?>
    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
    <link rel="stylesheet" href="assets/css/popup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
     $(window).load(function(){        
       $('#horoscopeModal3').modal('show');
        }); 
    </script>
    <style type="text/css">
    .img-fluid {
   width: 106%;
    height: 183px;
}
    </style>
    <style>
.page-item {
    padding: 3px 9px;
}

</style>


    <script type="text/javascript">
        
        function MM_openBrWindow(theURL,winName,features) 
            { //v2.0
                window.open(theURL,winName,features);
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
<section class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Horoscope Approval</h5>
                    </div>
                    <div class="card-body">
                        <div class="grid row">
                           
                            <?php  
                                if(mysqli_num_rows($profile_approve))
                                {
                                    while($profile_approve_row = mysqli_fetch_assoc($profile_approve))
                                    {
                        ?>
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item graphic">
                               
                                <br>  
                                <a href="profile_view?ID=<?php  echo $profile_approve_row['MatriID']; ?>"><?php  echo $profile_approve_row['MatriID'];?></a>

                                <img src="../kundli/<?php  echo $profile_approve_row['horoscope'] ?>" class="img-fluid img-thumbnail mb-3">

                                <a href="approve_horoscope?matriid=<?php  echo $profile_approve_row['MatriID'];?>" class="btn btn-icon btn-outline-success"><i class="fa fa-check" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                
                               <?php  ?>
                                    
                                <a href="delete_horoscope?matriid=<?php  echo $profile_approve_row['MatriID'];?>" onclick="return confirm('Are You Really Want To Delete This Horoscope..?  Click OK To Confirm...?')"  class="btn btn-icon btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                  <br>

                                <?php /* ?>
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/img-grd-gal-1.jpg" alt="Card image">
                                <?php */ ?>
                            </div>
                            <?php 
                                    $i=$i+1;
                                    
                                }
                            }
                            ?> 

                                                      
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item animation">
                                <?php /* ?>
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/img-grd-gal-3.jpg" alt="Card image">
                                <?php */ ?>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item uiux">
                                <?php /* ?>
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/img-grd-gal-4.jpg" alt="Card image">
                                <?php */ ?>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item product">
                                <?php /* ?>
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/img-grd-gal-5.jpg" alt="Card image">
                                <?php */ ?>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item web">
                                <?php /* ?>
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/img-grd-gal-6.jpg" alt="Card image">
                                <?php */ ?>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item graphic">
                                <?php /* ?>
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/img-grd-gal-1.jpg" alt="Card image">
                                <?php */ ?>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item animation">
                                <?php /* ?>
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/img-grd-gal-2.jpg" alt="Card image">
                                <?php */ ?>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item uiux">
                                <?php /* ?>
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/img-grd-gal-3.jpg" alt="Card image">
                                <?php */ ?>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item product">
                                <?php /* ?>
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/img-grd-gal-4.jpg" alt="Card image">
                                <?php */ ?>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item web">
                                <?php /* ?>
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/img-grd-gal-5.jpg" alt="Card image">
                                <?php */ ?>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item graphic">
                                <?php /* ?>
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/img-grd-gal-6.jpg" alt="Card image">
                                <?php */ ?>
                            </div>
                        </div>
                    </div>
                    <div  class="col-lg-12 ml-5">
             
                         <?php echo displayPaginationBelow($con,$setLimit,$page);?>
            
                     </div>
                </div>
                <?php /* ?> 
                <div class="card">
                    <div class="card-header">
                        <h5>Gallary</h5>
                    </div>
                    <div class="card-body">
                        <div class="grid-masonry row">
                            <div class="masonry-item col-xl-3 col-md-4 col-sm-6">
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/masonry-1.jpg" alt="Card image">
                            </div>
                            <div class="masonry-item col-xl-3 col-md-4 col-sm-6">
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/masonry-2.jpg" alt="Card image">
                            </div>
                            <div class="masonry-item col-xl-3 col-md-4 col-sm-6">
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/masonry-8.jpg" alt="Card image">
                            </div>
                            <div class="masonry-item col-xl-3 col-md-4 col-sm-6">
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/masonry-3.jpg" alt="Card image">
                            </div>
                            <div class="masonry-item col-xl-3 col-md-4 col-sm-6">
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/masonry-4.jpg" alt="Card image">
                            </div>
                            <div class="masonry-item col-xl-3 col-md-4 col-sm-6">
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/masonry-5.jpg" alt="Card image">
                            </div>
                            <div class="masonry-item col-xl-3 col-md-4 col-sm-6">
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/masonry-6.jpg" alt="Card image">
                            </div>
                            <div class="masonry-item col-xl-3 col-md-4 col-sm-6">
                                <img class="img-fluid img-thumbnail mb-3" src="assets/images/gallery-grid/masonry-7.jpg" alt="Card image">
                            </div>
                        </div>
                    </div>
                </div>
                <?php */ ?>
            </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>
<?php include('footer.php');?>
<!-- [ Main Content ] end -->
    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

<script src="assets/js/plugins/isotope.pkgd.min.js"></script>
<script>
    $(window).on('load', function() {
        setTimeout(function() {
            $(function() {
                var $grid = $('.grid').isotope({
                    itemSelector: '.element-item',
                    layoutMode: 'fitRows'
                });
                var filterFns = {
                    numberGreaterThan50: function() {
                        var number = $(this).find('.number').text();
                        return parseInt(number, 10) > 50;
                    },
                    ium: function() {
                        var name = $(this).find('.name').text();
                        return name.match(/ium$/);
                    }
                };
                $('#filters').on('click', 'button', function() {
                    var filterValue = $(this).attr('data-filter');
                    filterValue = filterFns[filterValue] || filterValue;
                    $grid.isotope({
                        filter: filterValue
                    });
                });
                $('.btn-filter').each(function(i, buttonGroup) {
                    var $buttonGroup = $(buttonGroup);
                    $buttonGroup.on('click', 'button', function() {
                        $buttonGroup.find('.active').removeClass('active');
                        $(this).addClass('active');
                    });
                });
            });
            $(function() {
                var $grid = $('.grid-masonry').isotope({
                    itemSelector: '.masonry-item',
                    masonry: {
                        columnWidth: 1
                    }
                });
            });
        }, 1000);
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
            <h5 class="mb-0 text-white f-w-500">Photo Approval</h5>
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

<?php if($_GET['msg']=='success'){ ?>
<div id="horoscopeModal3" class="modal " role="dialog" style="margin-top: 100px;">
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
                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Horscope Approved Sucessfully</h2>
                    </div>
                    <div class="swal2-actions">
                        <a href="horoscope_approval" data-target="" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                    </div>
                </div> 
            </div>
        </div>   
    </div>
</div>
<?php } ?>


<?php if($_GET['msg']=='delete'){ ?>
<div id="horoscopeModal3" class="modal " role="dialog" style="margin-top: 100px;">
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
                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Horoscope Deleted Successfully</h2>
                    </div>
                    <div class="swal2-actions">
    
                        <a href="horoscope_approval" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                    </div>
                </div> 
            </div>
        </div>   
    </div>
</div>
<?php } ?>

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
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>

</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/gallery-masonry.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:55:56 GMT -->
</html>
