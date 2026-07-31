<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
  //include '../dbconnectadmin.php';
  //error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Profile Completion Report</title>
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
    <meta name="description" content="Manpasand Jodidar - Admin Panel"/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="../branding/favicons/favicon.ico" type="image/x-icon">?>
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/plugins/select2.min.css">
    <!-- data tables css -->
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
	 <link rel="stylesheet" href="assets/css/newcss.css">
	<style>
	.incs{
		height:33px;
		margin-left:10px;
	}
	.stcs{
		margin-left:10px;
	}
	.row {
    --bs-gutter-x: -0.5rem;
	}
	
	</style>
	<script type="text/javascript">
function print_report()
{
	 var divElements = document.getElementById('print').innerHTML;
            var oldPage = document.body.innerHTML;

            document.body.innerHTML ="<html><head><title>Report</title> </head><body>"+divElements+"</body></html>" ;

            window.print();

            document.body.innerHTML = oldPage;
}
</script>
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

<section class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- Zero config table start -->
            <div class="col-sm-12">
                <div class="card">
				<div class="card-body">
					<form action="membership_report" method="post">
					   <div class="row align-items-center m-l-0">
                            <div class="col-sm-6">
							  <h3>Profile Completion Report</h3>
                            </div>
                          
                        </form> 
						
						   <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-striped table-bordered nowrap">
							
                                <thead>
                                    <tr>
											 <th> PROFILE ID </th>
												<th>NAME</th>
												<th>MOBILE NO. </th>
												 <th>EMAIL ID   </th>
												<th>COMPLETION STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
								
                               <?php 
													$relsql=mysqli_query($con,"select * from register");
													while($relrow =mysqli_fetch_array($relsql))
													
													{
													$id=$relrow['MatriID'];
													$name=$relrow['Name'];
													$mobile=$relrow['Mobile'];
													$email=$relrow['ConfirmEmail'];		   
													$strid=$relrow['MatriID'];
											

												$cmp=mysqli_query($con,"SELECT COUNT(*) AS Columns FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'weddingsparampara.com' AND table_name = 'register'");
											 $cmp1=mysqli_query($con,"SELECT Name,DOB,ConfirmEmail,ConfirmPassword,Gender,Profilecreatedby,Maritalstatus,PE_HaveChildren,childrenlivingstatus,Religion,Caste,Subcaste,countrycode,Mobile,aboutus,Gothram,Star,Moonsign,charan,Gan,nadi,Horosmatch,shani,Manglik,POB,TOB,POC,horoscope,Address,Country,dist,State,City,Phone,Residencystatus,Mobile2,calling_time,Pincode,Mobile,Education,EducationDetails,Annualincome,income_in,Occupation,occu_details,Employedin,working_hours,workinglocation,Height,Weight,BloodGroup,Complexion,Bodytype,spe_cases,Diet,Smoke,Drink,OtherHobbies,Spectacles,Familyvalues,FamilyType,FamilyStatus,noofbrothers,noofsisters,nbm,nsm,Fathername,Fathersoccupation,Mothersname,Mothersoccupation,mother_tounge,relatives,parents_stay,FamilyDetails,family_wealth,Looking,PE_FromAge,PE_ToAge,PartnerExpectations,PE_Countrylivingin,PE_from_Height,PE_to_Height,PE_Complexion,PE_Education,PE_Religion,PE_Caste,PE_Residentstatus,PE_State,PE_income_from,PE_income_to,PE_Occupation FROM `register` where MatriID='$id'");
											 
											  $ecmp=mysqli_fetch_assoc($cmp1);
											  
											  $tot=mysqli_num_fields($cmp1);
											 // $tot=mysqli_num_fields($cmp);		  
											  
												$COUNT=0;
											   $sql="SHOW COLUMNS FROM register where Field IN ('Name','DOB','ConfirmEmail','ConfirmPassword','Gender','Profilecreatedby','Maritalstatus','PE_HaveChildren','childrenlivingstatus','Religion','Caste','Subcaste','countrycode','Mobile','aboutus','Gothrm','Star','Moonsign','charan','Gan','nadi','Horosmatch','shani','Manglik','POB','TOB','POC','horoscope','Address','Country','dist','State','City','Phone','Residencystatus','Mobile2','calling_time','Pincode','Mobile','Education','EducationDetails','Annualincome','income_in','Occupation','occu_details','Employedin','working_hours','workinglocation','Height','Weight','BloodGroup','Complexion','Bodytype','spe_cases','Diet','Smoke','Drink','OtherHobbies','Spectacles','Familyvalues','FamilyType','FamilyStatus','noofbrothers','noofsisters','nbm','nsm','Fathername','Fathersoccupation','Mothersname','Mothersoccupation','mother_tounge','relatives','parents_stay','FamilyDetails','family_wealth','Looking','PE_FromAge','PE_ToAge','PartnerExpectations','PE_Countrylivingin','PE_from_Height','PE_to_Height','PE_Complexion','PE_Education','PE_Religion','PE_Caste','PE_Residentstatus','PE_State','PE_income_from','PE_income_to','PE_Occupation')";

												
												$result = mysqli_query($con,$sql);
												while($row = mysqli_fetch_array($result))
												{
													//echo "hello";
												$row1=$row['Field'];
												//echo $row1;
												$sql= " SELECT  COUNT(Name) from register WHERE $row1!='' AND MatriID='$strid' ";
											//	echo  "SELECT  COUNT(Name) from register WHERE $row1 !='' AND MatriID='$strid'";
												
												 $res = mysqli_query($con,$sql);
												$cnt= mysqli_fetch_array($res); 			
												$val = $cnt['COUNT(Name)']."<br>";
												$COUNT=$COUNT+$cnt['COUNT(Name)'];

												}
												$total=$tot-$COUNT;
												$cmpfield=number_format((($tot-$total)/$tot)*100);
												//echo $cmpfield;
												$_SESSION['profile_complite']=$cmpfield;
											 
													
													?>
														<td><a href="profile_view.php?ID=<?php  echo $relrow['MatriID'];?>"><?php echo $id ?></a></td>
														<td><?php echo $name?></td>
														<td><?php echo $mobile?></td>
														<td><?php echo $email?></td>
														<td><?php echo $cmpfield?></td>
														</tr>
												<?php  } ?>
									</tbody>  
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
			</div>
			</div>
			</section>
    <!-- Warning Section Ends -->
    <!-- Required Js -->
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->
<!-- datatable Js -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/pages/data-basic-custom.js"></script>

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
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-Q8H86P6FK7');
</script>

</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>
 