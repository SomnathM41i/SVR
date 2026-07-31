<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
//include'../dbconnectadmin.php';
$msg="";
	if(isset($_POST['submit']))
	{
		
		$state=mysqli_real_escape_string($con,$_POST['Name']);  
		//echo $state;
	
		$country=mysqli_real_escape_string($con,$_POST['country']);
		//echo $country;
		$q="select * from e_state where state='$state'";
		//echo "select * from e_state where state='$state'";
		//exit;
		$rs=mysqli_query($con,$q);
		$num=mysqli_num_rows($rs);
		if($num>0)
		{
			$msg="State already Exist!!";
		}
		else
		{
				$q="insert into e_state(state,cid,status) values('$state','$country','enable')";
				$rs=mysqli_query($con,$q) or svr_db_fail($con);  
				if($rs>0)
				{
								$msg="State added Successfully!!";
				}
		}
}
       if(isset($_POST['Update']))
	{
		$id=$_POST['id'];
			//echo $id;
		$state=$_POST['Name'];
		//echo $state;
		//exit;
		$q="select * from e_state where state='$state'";
		//echo "select * from e_state where state='$state'";
		$rs=mysqli_query($con,$q);
	
		$num=mysqli_num_rows($rs);
		//echo $num;
		if($num>0)
		{
			$msg="State already Exist!!";
		}
		else
		{
				$q="update  e_state set state='$state' where id='$id'";
			    //echo "update  e_state set state='$state' where id='$id'";
				$rs=mysqli_query($con,$q) or svr_db_fail($con);
				if($rs>0)
				{
								$msg="State Updated Successfully!!";
								//echo $msg;
				}
		}
}

		$q="select * from e_country";
		$rs=mysqli_query($con,$q);
		$num=mysqli_num_rows($rs);

?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/hospital-doctor.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:53 GMT -->
<head>
    <title>Add state</title>
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
	<script language="javascript">
function get_state(id)
{
	var xmlhttp;
if (id=="")
  {
  document.getElementById("content").innerHTML="";
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
    document.getElementById("content").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","get_state.php?id="+id,true);
xmlhttp.send();
}


</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	 $(window).load(function(){        
	   $('#myModal1').modal('show');
		}); 
	</script>
	

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
							  <h3>Add State </h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <button class="btn btn-success btn-sm mb-3 btn-round" data-bs-toggle="modal" data-bs-target="#modal-report" data-id="1"><i class="feather icon-plus"></i> Add State</button>
                            </div>
							<div class="col-sm-12 ">
						    <form  name="country" id="country" method="post" action="add_state.php">
							 <select  class="mb-3 form-control"  name="country" type="select" id="country"  required="required" onChange="get_state(this.value);">
                                    <div align="center" class="smalltextgrey"> <?php  echo $msg; 
									$_SESSION['country']=$_POST['country']; ?> </div>
				              <?php   if($_POST['country']==""){ ?>
						         <option value=""> Select  Country</option>
                              <?php   } else { ?>
                                <!--<label class="form-label" for="Name">Enter Country</label>-->
									  <option value="<?php echo $_SESSION['country']; ?>"><?php echo $_SESSION['country']; ?></option>
								<?php   } ?>
								<?php  
               
			                   $i=0;
														while($data=mysqli_fetch_assoc($rs) and $i< $num)
													  {
										 
																		  
														  ?>
															  <option value="<?php  echo $data['country']; ?>"><?php  echo $data['country']; ?></option>
															  <?php  
														  $i++;
													  }
													  ?>
                                  </select>
								 </form>
                            </div>
                        </div>
						<div class="table-responsive"  id="content"> 
						
						</div>
                   </div>
                </div>
            </div>
            <!-- customar project  end -->
        </div>
        <!-- [ Main Content ] end -->
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
</script>
<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
           
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#modal-report').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'addstate_pop', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});
</script>
<div class="modal fade" id="modal-report2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
           
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#modal-report2').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'editstate_pop', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});
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
<?php if($_GET['msg']=='success'){ ?>
<div id="myModal1" class="modal " role="dialog" style="margin-top: 100px;">
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
	                    <h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo $msg; ?></h2>
	                </div>
	                <div class="swal2-actions">
	                   <a href="add_state" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                    </div>
                </div> 
            </div>
        </div>   
    </div>
</div>



<?php } ?>
<?php if($_GET['msg']=='edit'){ ?>
<div id="myModal1" class="modal " role="dialog" style="margin-top: 100px;">
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
	                    <h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo $msg; ?></h2>
	                </div>
	                <div class="swal2-actions">
	                   <a href="add_state" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
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
        $check=$_GET['flag'];
        
?>
<div id="myModal1" class="modal " role="dialog" style="margin-top: 100px;">
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
                            if($check==1)
                            {
                        ?>
	                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">State Inactivated Successfully</h2>
	                    <?php
                            }
                            else
                            {
                        ?>
                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">State Activated Successfully</h2>
	                    <?php
                            }
                        ?>
                    </div>
	                <div class="swal2-actions">
	                   <a href="add_state" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                    </div>
                </div> 
            </div>
        </div>   
    </div>
</div>
<?php } ?>
</div>
<?php include('footer.php');?>
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


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/hospital-doctor.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:53 GMT -->
</html>
