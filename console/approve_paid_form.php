<?php require_once('../sys_dbconnection.php'); 
include('protect.php');
include_once('agent_common.php');
/*include('../dbconnectadmin.php');*/

$matriid=$_GET['matriid']; 
$presult = $con->query("SELECT * FROM register where MatriID='$matriid'");
$memberForAgent = $con->query("SELECT * FROM register where MatriID='$matriid' LIMIT 1");
$linkedAgentId = 0;
$linkedAgentName = '';
if ($memberForAgent && ($memberForAgentRow = $memberForAgent->fetch_assoc())) {
	$linkedAgentCustomer = agent_find_agent_customer_for_user(
		$con,
		(int)($memberForAgentRow['ID'] ?? 0),
		$memberForAgentRow['MatriID'] ?? $matriid,
		$memberForAgentRow['Mobile'] ?? '',
		$memberForAgentRow['ConfirmEmail'] ?? ''
	);
	if ($linkedAgentCustomer) {
		$linkedAgentId = (int)$linkedAgentCustomer['agent_id'];
		$agentNameResult = $con->query("SELECT full_name, mobile FROM agents WHERE agent_id=$linkedAgentId LIMIT 1");
		if ($agentNameResult && ($agentNameRow = $agentNameResult->fetch_assoc())) {
			$linkedAgentName = trim($agentNameRow['full_name'] . ' - ' . $agentNameRow['mobile']);
		}
	}
}
$plan = $con->query("SELECT * from membershipplan WHERE plan_status='active' ");
function orderid() {
    $chars = "0123456789";
    srand((double)microtime()*1000000000);
    $i = 0;
    $pass = '' ;

    while ($i <= 20) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }

    return $pass;

}
$strinv = "AMAT";
$strorderid = $strinv.orderid();
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Approve Paid</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">?>
    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script language='JavaScript'>
		function Validate()
			{
						if (document.form1.txtplan1.value=="Select")
						{
							alert("Select Plan");
							document.form1.txtplan1.focus( );
							return false;
						}
			}
        function get_plan(a)
		{
		var mySplitResult = a.split(",");		
		document.form_paid.txtplan.value=mySplitResult[0]
		document.form_paid.duration.value=mySplitResult[1]
		document.form_paid.contacts.value=mySplitResult[2]
		//document.form_paid.discount.value=mySplitResult[3]
		document.form_paid.amount.value=mySplitResult[3]
		document.form_paid.amount1.value=mySplitResult[3]
		
		document.form_paid.txtplanname.value=mySplitResult[4]		
		}
		
		
// 		 function updateInput(){
//     //get the current amount from the 'discount' field
//     var discountcode = document.getElementsByName("discountcode")[0].value;
//     //get the current amount from the 'price' field
//     var currentPrice = document.getElementsByName("amount")[0].value;
//     //new price should be "old price" - "discount%" * "old price"
//     document.getElementsByName("amount")[0].value =  parseFloat(currentPrice - ((discountcode/100) * currentPrice)).toFixed(0);
// }  
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

<!-- [ Main Content ] start -->
        <div class="pc-container">
            <div class="pcoded-content">
                <!-- [ breadcrumb ] start -->
                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                <div class="row">
                    <div class="col-sm-12">
                    <?php
                        if( isset( $_POST['upload'] ) )
                        {
                    ?>
			        <div class="alert alert-warning" role="alert">
                        <h5 class="alert-heading"><i class="feather icon-alert-circle me-2"></i><?php echo $error ?> </h5>  
                    </div>
                    <?php
                        }
                    ?>
			            <div class="card">
                            <div class="card-body">
                                <div class="container">
                                   <form role="form" method="post" action="approve_paid_form_submit" name="form_paid" id="form_paid" onsubmit="return Validate()">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="box-body">
												<?php 
												if(mysqli_num_rows($presult))
												{
												while($presult_row = $presult->fetch_assoc())
												{
												?>
												<input type="hidden" name="oid" value="<?php echo $strorderid ?>" />
                                                    <div class="form-group">
                                                        <label class="form-label">Matri ID : </label>
                                                        <input type="text" class="form-control" id="matriid" name="matriid" readonly value="<?php echo $presult_row['MatriID']; ?>"  tabindex=1>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Name : </label>
                                                        <input type="text" class="form-control" id="franch_mobile"  readonly name="franch_mobile"  value="<?php echo $presult_row['Name']; ?>"  required tabindex=3>
                                                    <input type="hidden" class="form-control" name="name" value="<?php echo $presult_row['Name']?>" />
												   <input type="hidden" class="form-control" name="email" value="<?php echo $presult_row['ConfirmEmail']?>" />
													<input type="hidden" name="address" value="<?php echo $presult_row['Address']?>" />

												   </div>

                                                    <div class="form-group">
                                                     <label class="form-label">Payment Mode</label>
													  <select name="mode" class="form-control" id="mode">
														  <option value="Cash">Cash</option>
														  <option value="Cheque">Cheque</option>
														  <option value="Credit Card">Credit Card</option>
														  <option value="DD">DD</option>
														  <option value="Money Order">Money Order</option>
														  <option value="Funds Transfer">Funds Transfer</option>
														  <option value="Other">Other</option>
														</select>                                                   
													</div>
													<div class="form-group">
													  <label>Activation Date :</label>
													   <input type="text" name="activation_date" class="form-control"  value="<?php echo date("d-m-Y",strtotime ('now'));?>" readonly/>
													</div>
                                                  
													<div class="form-group">
														<label>Plan</label>
														<input name="txtplan" type="hidden" class="forminput" id="txtplan" />
														<input name="txtplanname" type="hidden" class="forminput" id="txtplanname" />
														<?php
																		$plan = $con->query("SELECT * from membershipplan WHERE plan_status='active' ");
																		echo( '<select name="txtplan1" class="form-control" onchange="get_plan(this.value)">' ); 
																		echo  '<option value="Select">Select</option>';
																		while($row = $plan->fetch_assoc())
																		{ 
																		echo  '<option value='.$row['plandisplayname'].",".$row['planduration'].",".$row['plannoofcontacts'].",".$row['planamount'].",".$row['planname'].'>'.$row['plandisplayname'].'</option>';		
																		} 
																		echo '</select>';  
																		?>
													</div>
													<div class="form-group">
													  <label>Duration : </label>
													  <input type="text" class="form-control" name="duration"  required readonly/>
													</div>
													<div class="form-group">
													  <label>Discount : </label>
													  <select name="discountcode" id="chDiscount" class="form-control" onchange="updateInput()">
													      <option value="0" selected>Select</option>
													      <?php $query="SELECT * FROM discount ORDER BY code ASC;";
													      $data=mysqli_query($con,$query);
													      while($result=mysqli_fetch_array($data))
													      {
													      ?>
													      <option value="<?php echo trim($result['discount'],"%"); ?>"><?php echo $result['discount']; ?></option>
													      <?php
													      }
													      ?>
													  </select>
													  
													</div>
													<div class="form-group">
													   <label>No of Contacts : </label>
													   <input type="text" class="form-control" name="contacts"  required readonly />
													</div>
													<div class="form-group">
													<label>Amount : </label>
													   <input type="hidden" name="amount" id="cBalance" >
								   <input type="text" class="form-control" name="amount1" id="result"  required />
													</div>
													<div class="form-group">
														<label>Referred Agent :</label>
														<select name="agent_id" class="form-control">
															<option value="">No Agent</option>
															<?php foreach (agent_active_options($con) as $agentOption) { ?>
															<option value="<?php echo (int)$agentOption['agent_id']; ?>" <?php echo $linkedAgentId === (int)$agentOption['agent_id'] ? 'selected' : ''; ?>><?php echo agent_h($agentOption['full_name'] . ' - ' . $agentOption['mobile']); ?></option>
															<?php } ?>
														</select>
														<?php if ($linkedAgentId > 0) { ?>
														<small class="text-success">Auto selected linked agent: <?php echo agent_h($linkedAgentName); ?></small>
														<?php } ?>
													</div>
													<div class="form-group">
													<label>Bank Details : </label>
													   <textarea class="form-control" name="bank_details" rows="3"  required ></textarea>
													</div>
													
													</div>
                                            </div>

                                       
                                        </div>   

                                    <button type="submit" class="btn btn-primary" id="update" name="upload" >Approve</button>
                                     <?php }}?>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>

<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<script>
$(document).on("change keyup blur", "#chDiscount", function() {
var main = $('#cBalance').val();
var disc = $('#chDiscount').val();
var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
var mult = main * dec; // gives the value for subtract from main value
var discont = main - mult;
$('#result').val(discont);
});
</script>

</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>

