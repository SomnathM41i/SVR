<?php require_once('../includes/bootstrap.php');
include('protect.php');



 if(isset($_GET["page"]))
    $page = (int)$_GET["page"];
    else
    $page = 1;
    $setLimit = 8;
    $pageLimit = ($page * $setLimit) - $setLimit;
    
$result=mysqli_query($con,"SELECT a.*,b.* FROM register a,gallary b where a.matriid=b.matri_id and a.Photo1<>b.photo_name  and b.photo_approve='Pending' ORDER BY id DESC LIMIT ".$pageLimit." , ".$setLimit);

function displayPaginationBelow($con,$per_page,$page){
$page_url="?";
$sql1 = mysqli_query($con,"SELECT COUNT(*)  as totalCount FROM register a,gallary b where a.matriid=b.matri_id and a.Photo1<>b.photo_name  and b.photo_approve='Pending'");
    
        
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
    <head>
        <script type="text/javascript">
            function approve(id)
            {
                //alert(id);
                var xmlhttp;    
                if (window.XMLHttpRequest) 
                {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
                } 
                else 
                {
            // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() 
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                    {
                        document.getElementById("data").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","gal_approve.php?id="+id,true);
                xmlhttp.send();
            }
            
            function unapprove(id)
            {
                
                //alert(id);
                var xmlhttp;    
                if (window.XMLHttpRequest) 
                {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } 
                else 
                {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() 
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                    {
                        document.getElementById("data").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","gal_unapprove.php?id="+id,true);
                xmlhttp.send();
            }
        
            function MM_openBrWindow(theURL,winName,features) 
            { //v2.0
                window.open(theURL,winName,features);
            }   

        </script>
    <title>Gallary Photo Approval</title>
    <?php  include('meta.php')?>
    <?php  include('main_style.php');?>
   
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
        <link rel="stylesheet" href="assets/css/stylnew.css" id="main-style-link">

    <style type="text/css">

        
    </style>
    <link rel="stylesheet" href="assets/css/popup.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
     $(window).load(function(){        
       $('#residencyModal').modal('show');
        }); 
    </script>
<style>
.page-item {
    padding: 3px 9px;
}
.img-fluid {
   width: 106%;
    height: 183px;
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
            <div class="card">
                <div class="card-header">
                    <h5>Gallary Photo Approval</h5>
                </div>
                <div class="col-12">
                    <div class="card-body">
                        <div class="grid row">
                            <?php  
                                   while($row = mysqli_fetch_assoc($result) ){ 
                                    $i=0;
                            ?>
                            <div class="col-xl-3 col-md-4 col-sm-6 element-item graphic">
                               <br>  
                                <a href="profile_view?ID=<?php  echo $row['MatriID']?>" class="text-primary h5"><?php  echo $row['MatriID']?></a> 
                                <img  class="img-fluid img-thumbnail mb-3" src="../photoprocess.php?image=gallary/<?php  echo $row['photo_name']?>&square=700" alt="Card image" border="0"/>

                                
                                <a href="gal_approve?matid=<?php echo $row['MatriID']?>&id=<?php echo $row['photo_id'];?>" class="btn btn-icon btn-outline-success"><i class="fa fa-check" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                    
                                <a class="btn btn-icon btn-outline-secondary" onClick="MM_openBrWindow('gallary_crop?matid=<?php   echo $row['MatriID']?>&Choice=1&op=<?php  echo $row['photo_name'] ?>&photoid=<?php  echo $row['photo_id'] ?>','editphotosize','scrollbars=yes,resizable=yes,width=550,height=600')"><i class="fa fa-crop" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                    
                                <a href="gal_unapprove?matid=<?php echo $row['MatriID']?>&id=<?php echo $row['photo_id'];?>" class="btn btn-icon btn-outline-danger" onclick="return confirm('Are You Really Want To Delete This Photo..?  Click OK To Confirm...?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                  <br>
                            </div>
                            <?php 
                                }
                            ?> 

                        </div>
                    </div>
                </div>
                <div  class="col-lg-12 ml-5">
                    <?php echo displayPaginationBelow($con,$setLimit,$page);?>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>

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
            <h5 class="mb-0 text-white f-w-500">Gallary Photo Approval</h5>
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
</div>

<?php if($_GET['msg']=='success'){ ?>
<div id="residencyModal" class="modal" role="dialog" style="margin-top: 100px;">
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
                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Photo Approved Successfully </h2>
                    </div>
                    <div class="swal2-actions">
                        <a href="gal_photo_approve" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                    </div>
                </div> 
            </div>
        </div>   
    </div>
</div>
<?php } ?>

<?php 
    if($_GET['msg']=='delete')
    { 
        
?>
<div id="residencyModal" class="modal " role="dialog" style="margin-top: 100px;">
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
                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Photo Deleted Successfully</h2>
                        <div class="swal2-actions">
                            <a href="gal_photo_approve" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                        </div>
                    </div> 
                </div>
            </div>   
        </div>
    </div>
</div>
<?php } ?>


<?php include('footer.php');?>
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
