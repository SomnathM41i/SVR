<?php
    require_once('sys_dbconnection.php');
    include('memprotect.php');
    /*include ('dbconnectadmin.php');*/
    //session_start();

    $id = $_SESSION['matriid'];
    //FOR CHNAGINF STATUS
    $check_new = mysqli_query($con,"SELECT * FROM recommendation WHERE MatriID='$id' and added_status='New'");
    $count = mysqli_num_rows($check_new);
    if($count != 0){
        while( $row = mysqli_fetch_array($check_new) ){
            $row_id = $row['id'];
            mysqli_query($con,"UPDATE recommendation SET added_status='old' WHERE id= '$row_id' ");
        }
    }
    
    if(isset($_POST['submit']))
    {
		$id1=$_POST['postId'];
		//echo $_POST['postId'];
        $reply=mysqli_real_escape_string($con,addslashes($_POST['reply']));
		//echo $reply;
		
        //$q="select * from recommendation where id='$id1'";
       
       
	   $q="update recommendation set reply='$reply' where id='$id1'";
	   //echo "update set reply='$reply' where id='$id1'";
	   //exit;
            $rs=mysqli_query($con,$q) or die(mysqli_error());  
           
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Office Recommendation</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css?v=202020.1" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">
<link href="css/stylenew.css" rel="stylesheet">

<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<style>
    .change-font-fas{
            font-size: 20px;
            margin-left: -20px;
            transform: rotate(180deg);
        }
 .alert-info1 {
    color: #fff;
    background: linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);
    border-color: #fff;
    font-size: 17px;
    margin-left: 10px;
}
.replybt
{
    color:black !important;
    font-size: 14px;
    border: 2px solid blue;
    padding: 4px 19px;
   border-radius: 10px;
}
.yesbt
{
   
    font-size: 14px;
    border: 2px solid #e83e8c;
    padding: 4px 19px;
	background-color:white;
    border-radius: 10px;
}
.nobt
{
   
    font-size: 14px;
    border: 2px solid #dc3545;
    padding: 4px 19px;
	background-color:white;
    border-radius: 10px;

}
.close
{
  color: #fff;
  opacity: 20;
}


</style>
<style>
@media screen and (max-width: 768px) {
	.replybt{
		 padding: 4px 8px;
	}
	.nobt{
		 padding: 4px 8px;
	}
	.yesbt{
		 padding: 4px 8px;
	}
}
@media screen and (max-width: 568px) {
	.replybt{
		 padding: 4px 8px;
	}
	.nobt{
		 padding: 4px 8px;
	}
	.yesbt{
		 padding: 4px 8px;
	}
}
</style>
<script>
$("button").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/pages/test/",
        data: { 
            id: $(this).val(), // < note use of 'this' here
            access_token: $("#access_token").val() 
        },
        success: function(result) {
            alert('ok');
        },
        error: function(result) {
            alert('error');
        }
    });
});
</script>

<script>
function deletephoto(id)
{  
    var xmlhttp;
if (id=="")
  {
  
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
   // document.getElementById("delete").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","delete_document.php?id="+id,true);
xmlhttp.send();
window.location='upload_document_proof?flag=9';}



/*function dp(id)
{   
    var xmlhttp;
if (id=="")
  {
  
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
   document.getElementById("dpchange"+id).innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","setdp.php?id="+id,true);
xmlhttp.send();
window.location='gallary.php';
 
}*/
</script>
<style>
/* Add a right margin to each icon */
.faio {
  margin-left: -12px;
  margin-right: 8px;
}
.about-section {
    position: relative;
    padding: 0px 0 30px !important;
}

label{
	margin-left:0px !important;
}
</style>
<style>
.prod-likes {
    position: relative;
    padding: 0;
}
.form-check {
    display: block;
    min-height: 1.3125rem;
    padding-left: 1.75em;
    margin-bottom: 0.125rem;
}
svg.feather:not([class*='hei-']) {
    height: 20px;
}

svg.feather:not([class*='wid-']) {
    width: 20px;
}
.prod-likes .prod-likes-icon {
    stroke: rgba(41, 50, 64, 0.5);
    fill: rgba(41, 50, 64, 0.2);
    z-index: 3;
}
.feather {
    font-family: 'feather' !important;
    speak: none;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.prod-likes .form-check-input {
    width: 20px;
    height: 20px;
    margin: 0;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    z-index: 5;
    cursor: pointer;
}
.form-check-input[type="checkbox"] {
    border-radius: 0.25em;
}
.form-check .form-check-input {
   float: left;
    margin-left: 1.25em;
}
.form-check-input {
    width: 1.25em;
    height: 1.25em;
    margin-top: 0.125em;
    vertical-align: top;
    background-color: #ffffff;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    border: 1px solid rgba(0, 0, 0, 0.25);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    -webkit-print-color-adjust: exact;
    color-adjust: exact;
    transition: background-color 0.15s ease-in-out, background-position 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.prod-likes .form-check-input:checked + .prod-likes-icon {
    stroke: #EA4D4D;
    fill: rgba(234, 77, 77, 0.8);
    -webkit-animation: _26Tc6u 0.2s ease 0.3s forwards;
    animation: _26Tc6u 0.2s ease 0.3s forwards;
}
</style>
<script>
    function check(id,flag){
       /* var checkBox = document.getElementById("");
        console.log(id);*/
         var data = 'id='+ id;
        if(flag == 1){
            jQuery.ajax({
                url:'update_status?flag=1',
                type:'post',
                data:data,
                success: function(result){

                } 
            });
        }else{
            jQuery.ajax({
                url:'update_status',
                type:'post',
                data:data,
                success: function(result){

                } 
            });

        }
        //if (checkBox.checked == true){
            
        /*} else {
            jQuery.ajax({
                url:'update_status',
                type:'post',
                data:data,
                success: function(result){

                } 
            });
        }*/
    }
</script>
<script type="text/javascript">
 
function myShow(id) {
   //var x = document.getElementById("retxt");

  if (x.style.display === "none") {
	  console.log('hello world');
    x.style.display = "block";
  } else {
	  console.log('hello india');
    x.style.display = "none";
  }
};
    
</script>


</head>
<script type="text/javascript" src ="js/hide.js"></script>
<body>

<div class="page-wrapper">
    
    <!-- Preloader -->
    <div class="preloader"></div>
    <!-- Header span -->

    <!-- Header Span -->
    <span class="header-span"></span>

    <!-- Main Header-->
   <?php include ('header.php') ?>
    <!--End Main Header -->

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">Recommendation</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Recommendation</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
 <?php
 $limit = 4; 

 if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;
 
$id = $_SESSION['matriid'];
$sql12 ="select * from recommendation where MatriID='$id' order by id DESC LIMIT $start_from, $limit";

$sql1 =  "select count(*) from recommendation where MatriID='$id'";

//CHECKING STATUS OF DOC
		$rs_result1 = mysqli_query($con,$sql1);  
		$row1 = mysqli_fetch_row($rs_result1);  
		$total_records = $row1[0];  
		$total_pages = ceil($total_records / $limit);
          $result1=mysqli_query($con,$sql12);
           if(mysqli_num_rows($result1)>0)
	             { ?>

    <!-- About Section -->
     
         <!-- Content Column -->
      
    <section class="about-section">
        <div class="auto-container"><br>
            <div class="alertmes">
                <?php if($_GET['flag']== 1) { ?>
                <div class="alert alert-info1" align="center" role="alert">
                    Your Reply Send Successfully.
                </div>
                <?php } ?>
            </div>
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <section class="newsletter-section">
                                <div class="auto-container">
                                    <div class="subscribe-form wow fadeInUp" data-wow-delay="500ms">
                                        <div class="envelope-image"></div>
                                        <div class="card-body">
                                            <form method="post" action="#"  enctype="multipart/form-data">
                                                <div class="row ">
                                                    <?php  
                                                        while($row = mysqli_fetch_array($result1))
                                                        {    
                        							       $dtexp=explode("-",$row['date']);
                        								   $dtexp1=$dtexp[2]."-".$dtexp[1]."-".$dtexp[0];
                        							
                        							$i=0;
                                                    ?>
														 <div class="card col-lg-6 col-md-6 col-sm-6 mt-2 mb-2" style="">
														 <div class="card-header mt-2"> 
														 
														 <span  style="color:blue">  
															   <?php $expdt= explode("-",$row['date']);
																$expdt1=$expdt[2]."-".$expdt[1]."-".$expdt[0];
															   echo $expdt1;?>
														</span>  
														<span style="float:right">
                                           
											<?php if($row['status']=="liked"){ ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#EA4D4D" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart prod-likes-icon"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>                       
                                            <?php } else if($row['status']=="disliked") { ?>
                                            <!-- <label style="color: red;">Disliked </label> -->
                                            <i class="far fa-thumbs-up change-font-fas"></i>
                                                    

                                            
                                            <?php } else{
                                            ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="lightgrey" stroke="#6c757d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart prod-likes-icon"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg> 

                                            <?php

                                            } ?>
											</span>
										
															</div> 
															 
															   
								<div class="col-xl-12 col-md-12 col-sm-12 card-body mt-0">
									<div class="row">
                                        <?php if ($row['biodata1'] != ""){ ?>
                                            <div class="col-lg-6 col-md-6 col-sm-6 mt-2" align="" >
                                                         <span class=""><label>Biodata</label> </span> <br>
                                                      
													
                                                               
																
                                                                    <a href="recommendation/<?php echo $row['biodata1']; ?>" data-sub-html="Demo Description" style="color:green" target="_blank"> 
																		<img src="photoprocess.php?image=recommendation/<?php echo $row['biodata1']; ?>&square=200" >
																	</a> 
                                                                    
                                                           </div>
                                                        <?PHP } ?>

                     
                              
						<?php
									if ($row['photo'] != "") { ?>
											 <div class="col-lg-6 col-md-6 col-sm-6  mt-2" >
                                                        <span class=""><label>Photo</label> </span> <br>
                                                        
                                                            
                                                          
                                                                <a href="recommendation/<?php echo $row['photo']; ?>" data-sub-html="Demo Description" style="color:green" target="_blank">
																 <img src="photoprocess.php?image=recommendation/<?php echo $row['photo']; ?>&square=200">
																</a>
                                           
                                                            
                                                          </div> 
														
										<?PHP  } ?>
                                <!-- -->
                                </div>
                               
                                    <?php if ($row['description'] != "") {?>
                     
                     
                                                       <div class="row mt-3">
                                                        <div class="col-lg-12 col-md-12 col-sm-12  mb-2 ">
														<span class="mt-2"><label>Description</label> > 
                                                            <!--</div>-->
														   
														      <!--<div class="col-lg-9 col-md-9 col-sm-9  mb-2 " >-->
                                                             <?php echo $row['description']; ?>  </span>
                                                              
                                                        </div>
														
														</div>
                                                        <?php } ?>
													
														<div class="col-lg-12 col-md-12 col-sm-12 mt-3 mb-2 row ">
														<span><label>Do You Like This?</label></span>
                            <?php /*if( ($row['status'] == NULL ) ){?>
                              <button class="yesbt btn  ml-2" onclick="check('<?php echo $row['id']; ?>')" id="Yes"> Yes </button>
                              <button class=" nobt ml-2" onclick="check('<?php echo $row['id']; ?>',1)" id="No"> No </button>
                            <?php }*/ ?> 
                            <span>
                            <?php if( ($row['status'] == "disliked") || ($row['status'] == NULL )  ){?>
														<button class="yesbt btn  ml-2" onclick="check('<?php echo $row['id']; ?>')" id="Yes"> Yes </button> 
													  <?php } if( ($row['status'] == "liked") || ($row['status'] == NULL ) ){?>
														<button class="nobt btn ml-2" onclick="check('<?php echo $row['id']; ?>',1)" id="No"> No </button>
														<?php } 
                                                        if( isset($page) ){
                                                            $page = $_REQUEST['page'];
                                                        ?>
                                                        <a class="replybt ml-2" data-toggle="modal" data-target="#myModal12" data-id="<?php echo $row['id'];?>&flag=<?php echo $page;?>"  id="Reply">Reply</a>
                                                        <?php     
                                                            }
                                                            else{
                                                        ?>
                                                         <a class="replybt ml-2" data-toggle="modal" data-target="#myModal12" data-id="<?php echo $row['id'];?>"  id="Reply">Reply</a>
                                                        <?php
                                                            }
                                                        ?>
														
                                                   </span>

												   </div>
													
													
                                                        
																</div>
														 </div>
														  
                               
                                                  <?php  $i++; } ?>
                    
                                            </form>
                                       
										</div>
						
                                    </div>
                                </div> 
				<?php if($limit<$total_records) { ?>  

						<div align="center" class="col-lg-12 mb-2">
							<ul class='styled-pagination' id="pagination" >
							<?php if($page > 1){ 
								$prev = ($page - 1); ?>
								<li id="<?php echo $i;?>"></li>
							<?php }         ?>
							 <li class='setPage'>Page <?php echo $page?> of <?php echo $total_pages?></li>
							<?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
										if($i == $_GET['page']):?>
									   <li class='active' id="<?php echo $i;?>"><a  class='active' href='off_recommend?page=<?php echo $i;?>' ><?php echo $i;?></a></li> 
										
										<?php else:?>
										<li id="<?php echo $i;?>" ><a href='off_recommend?page=<?php echo $i;?>' ><?php echo $i;?></a></li>
										
										
									<?php endif;?>  
								  
							<?php endfor;?>
							  <?php // Build Next Link 
							if($page < $total_pages){ 
								$next = ($page + 1); 
								?>
								
								<li id="<?php echo $i;?>"><a href='off_recommend?page=<?php echo $next;?>'><span class="icon fa fa-angle-right"></span></a></li>
							</a></li>
							<?php }         ?><?php endif;?> 
							 </ul>
							 </div>
							 </div>
							 <?php } ?> 
                                <?php //echo displayPaginationBelow($con,$setLimit,$page);?>
                            </div>
                    </section>
				 <?php } else { ?>
				 
				 <section class="error-section">
					<div class="anim-icons full-width">
						<span class="icon icon-circle-blue wow fadeIn"></span>
						<span class="icon icon-dots wow fadeInleft"></span>
						<span class="icon icon-line-1 wow zoomIn"></span>
						<span class="icon icon-circle-1 wow zoomIn"></span>
					</div>

					<div class="auto-container">
						<div class="error-title">OOP'S</div>
						<h4>Sorry Result Not Found</h4>
						<div class="text">Not recommend any profile from recommend panel yet.</div>
						<!--<a href="smart_search" class="theme-btn btn-style-three"><span class="btn-title">Search</span></a>-->
						<!--<a href="contact.html" class="theme-btn btn-style-two"><span class="btn-title">Contact Us</span></a>-->
					</div>
				</section>
				 
				 
				 
				 
				<?php 
				 }?>
				 
                  </div>
              </div>
            </div>                               
        </div>
    </div>
</section>
</div>
    



    <!--End About Section -->
   <!-- Main Footer -->
    
  <?php include ('footer.php'); ?>
<!--End pagewrapper-->
<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>


<div class="modal fade" id="myModal12">
    <div class="modal-dialog">
      <div class="modal-content">
  
    </div>
<script>
$(document).ready(function(){
    $('#myModal12').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'replyrec.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});

</script>
<!-- Color Setting -->
<script src="js/color-settings.js"></script>
<!--Google Map APi Key-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPH8h1UpcK01BdcvoZeOzq-_wJqRxN1Pc"></script>
<script src="js/map-script.js"></script>
<!--End Google Map APi-->
<script>
$(document).ready(function() {
  $('.btn').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="fa fa-spinner fa-spin  faio"></i><span class="btn-title">Loading</span> ';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 500);
  });
})
</script>
</body>
</html>
