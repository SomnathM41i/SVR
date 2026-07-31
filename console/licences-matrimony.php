<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
  error_reporting(0);
$data_config = $db->get_siteconfig();
$domain_name = $data_config -> WebFriendlyname;

?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Purcahse licences 7.0 Script</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="php matrimony script purchase licences"/>
    <meta name="keywords" content="licences matrimony, purcahse matrimony script "/>
    <meta name="author" content="DashboardKit" />
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <!-- MPJ: brand icons -->
    <link rel="apple-touch-icon" href="../branding/favicons/apple-touch-icon.png">
    <link rel="manifest" href="../branding/site.webmanifest">
    <meta name="theme-color" content="#5E1426">
	<link href="ckeditor/sample.css" rel="stylesheet" type="text/css" />
	<link href="bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/mpj-brand.css">
	<link rel="stylesheet" href="assets/css/stylenew.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
	<link rel="stylesheet" href="assets/css/popup.css">
	<style>
		body {
			background: #FDFAF5;
		}
		.license-page-container {
			padding-top: 36px;
		}
		.license-page-container .pc-container,
		.license-page-container .pcoded-content {
			margin-top: 0 !important;
			padding-top: 0 !important;
		}
		.license-page-container .card {
			border: 1px solid rgba(201,168,76,0.25);
			border-radius: 14px;
			box-shadow: 0 2px 20px rgba(45,31,61,0.08);
			overflow: hidden;
		}
		.license-page-container .card-body {
			padding: 22px;
		}
		.license-page-container .license-copy {
			color: #2D1F3D;
			font-size: 14px;
			line-height: 1.75;
		}
		@media (max-width: 991px) {
			.license-page-container {
				padding-top: 24px;
			}
		}
	</style>

	<script type="text/JavaScript">

	function disableselect(e) {
	return false
	}

	function reEnable() {
	return true
	}

	document.onselectstart = new Function ("return false")

	if (window.sidebar) {
	document.onmousedown = disableselect
	document.onclick = reEnable
	}
	</script>


</head>
<body class="pc-horizontal">
		<div class="loader-bg">
			<div class="loader-track">
				<div class="loader-fill"></div>
			</div>
		</div>
		  <?php include('topheader.php');?>
		  <?php include('header.php');?>
		  <?php include('notification.php');?>
		  
<div class="container license-page-container">
<div class="pc-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="license-copy">
                            <form action="#" method="post">
                            <div class="form-group">
							<?php  $qry="select * from cms where cms_id='22'";
	                              $result=mysqli_query($con,$qry);
	                                  
                                   $res=mysqli_fetch_array($result);
                                      ?>
                               
                                 <Div> <p align="justify" style="font-family: unset; font-weight: 400;">This Services Agreement (“Agreement”) is made
Between.... INFINITY SYSTEMS (“Contractor”) <br>
And............ <?php echo $domain_name;?>(“Matrimony Firm”). <br>
DOMIN NAME: <?php echo $data_config -> Webname; ?> (“Matrimony Firm”).<br> 
<br>
The Matrimony Firm desires to retain Contractor as an independent contractor to perform consulting services for the Matrimony Firm, and Contractor is willing to perform such services, on terms set forth more fully below. In consideration of the mutual promises contained herein, the parties agree as follows: <br>
<strong>1. Services. </strong><br>
A. Contractor agrees to perform for the Matrimony Firm those services described in Exhibit A incorporated herein by reference (the “Services”). The parties may delete, add or substitute Services, extend the Term, or alter the terms of compensation by amending Exhibit A, provided that such amendment shall be signed by an authorized representative of both parties and shall indicate whether it is to replace or alter the then existing Exhibit A. 
B. Contractor is authorized to perform the Services under this Agreement only upon the request or at the direction of, and shall report solely to the Matrimony Firm.<br>
<strong>2. Compensation.</strong> <br>
A. The Matrimony Firm agrees to pay Contractor the compensation set forth in Exhibit A for the performance of the Services (“Fixed Compensation”). Such Fixed Compensation shall be payable on the schedule set forth in Exhibit A. 
B. In exchange for providing the Services, the Matrimony Firm agrees to compensate the Contractor with a non-refundable single payment of ₹45,000 Indian Rupee The Contractor recognizes that the Matrimony Firm may be required the laws of the State of Maharashtra to deduct any applicable fees or remittances from the Contractor's compensation. The Contractor understands that the above described compensation is to be the sole and exclusive compensation, and that no additional compensation will be provided for the Services.<br>
<strong>3. Intellectual property ownership. </strong><br>
A. To the extent that the work performed by the Contractor under this Agreement (“Contractor’s Work”) includes any work of authorship entitled to protection under copyright laws, the parties agree to the following provisions. 
1. Contractor’s Work has been specially ordered and commissioned by Matrimony Firm as a contribution to a collective work, a supplementary work, or other category of work eligible to be treated as a work made for hire under the Indian Copyright Act. <br>
2. Contractor’s Work shall be deemed a commissioned work and a work made for hire to the greatest extent permitted by law.
B. To the extent that Contractor’s Work is not properly characterized as a work made for hire, Contractor grants to Matrimony Firm all right, title, and interest in Contractor’s Work, including all copyright rights, in perpetuity and throughout the world. <br>
C. Contractor agrees to require any employees or contract personnel Contractor uses to perform services under this Agreement to assign in writing to Contractor all copyright and other intellectual property rights they may have in their work product. Contractor shall provide Matrimony Firm with a signed copy of each such assignment. 
D. All of the provisions of this Section 3 shall be effective only upon full payment of all Fixed Compensation due pursuant to Section 2 and Exhibit A.<br>
<strong>4. Originality and No infringement.</strong> <br>
A. Contractor represents and warrants that the Work Product and all materials and Services provided by Contractor here under will be original with Contractor or its employees or contract personnel, or shall be in the public domain, and that the use thereof by Matrimony Firm or its customers, representatives, distributors, or dealers will not knowingly infringe any patent, copyright, trade secret or other intellectual property right of any third party. Contractor agrees to indemnify and hold Matrimony Firm harmless against any liability, loss, cost, damage, claims, demands, or expenses (including reasonable outside attorney’s fees) of Matrimony Firm or its customers, representatives, distributors, or dealers arising out of any breach of this paragraph.<br>
B. Matrimony Firm represents and warrants that all materials provided to Contractor hereunder will be original with Matrimony Firm or its employees or contract personnel, or is properly licensed for use as described in Exhibit A, or shall be in the public domain, and that the use thereof by Contractor will not knowingly infringe any patent, copyright, trade secret or other intellectual property right of any third party. Matrimony Firm agrees to indemnify and hold Contractor harmless against any liability, loss, cost, damage, claims, demands, or expenses (including reasonable outside attorney’s fees) of Contractor arising out of any breach of this paragraph.<br>
<strong>5. Confidentiality.</strong> <br>
A. “Confidential Information” means the Work Product and any Matrimony Firm proprietary information, technical data, trade secrets or know-how, including, but not limited to, research, product plans, products, services, Matrimony Firms, software, developments & design inventions, processes, formulas, drawings, business information disclosed by Matrimony Firm either directly or indirectly in writing, orally or by drawings or inspection of parts or equipment.
B. Contractor and its employees and consultants shall hold all Confidential Information in the strictest confidence and shall not, during or subsequent to the term of this Agreement, use Matrimony Firm’s Confidential Information for any purpose whatsoever other than the performance of the Services on behalf of Matrimony Firm. Confidential Information does not include information that (i) is known to Contractor at the time of disclosure to Contractor by Matrimony Firm as evidenced by written records of Contractor, (ii) has become publicly known and made generally available through no wrongful act of Contractor, or (iii) has been rightfully received by Contractor from a third party who is authorized to make such disclosure. Without Matrimony Firm’s prior written approval, Contractor shall not directly or indirectly disclose to anyone the terms and conditions of this Agreement. Contractor may disclose that it is “working with” Matrimony Firm, but shall not otherwise characterize the nature or scope of the Services. <br>
C. Contractor agrees that it will not, during the term of this Agreement, improperly use or disclose any trade secrets of any former or current employer or other person or entity with which Contractor has an agreement or duty to keep in confidence information acquired by Contractor in confidence, if any, and that Contractor shall not bring onto the premises of Matrimony Firm any unpublished document or proprietary information belonging to such employer, person, or entity unless consented to in writing by such employer, person, or entity. <br>
D. Matrimony Firm agrees that it will not, during the term of this Agreement and subsequently, improperly use, make the copies or adaption, illegal sale of the Matrimony Script provided by the Contractor without the prior permission of the Contractor under the Section 52 of Indian Copyright Act, 1957. <br>
E. Contractor recognizes that Matrimony Firm has received and in the future will receive from third parties their confidential or proprietary information subject to a duty on Matrimony Firm’s part to maintain the confidentiality of such information and to use it only for certain limited purposes. Contractor agrees that Contractor owes Matrimony Firm and such third parties, during the term of this Agreement and thereafter, a duty to hold all such confidential or proprietary information in the strictest confidence and not to disclose it to any person, firm, or corporation or to use it except as necessary in carrying out the Services for Matrimony Firm consistent with Matrimony Firm’s agreement with such third party.
F. Upon the termination of this Agreement, or upon Matrimony Firm’s earlier request, Contractor shall deliver to Matrimony Firm all of Matrimony Firm’s property and Confidential Information in tangible form that Contractor may have in Contractor’s possession or control.<br>
<strong>6. Conflicting obligations.</strong><br>
Contractor certifies that Contractor has no outstanding agreement or obligation that is in conflict with any of the provisions of this Agreement, or that would preclude Contractor from complying with the provisions hereof and further certifies that Contractor will not enter into any such conflicting agreement during the term of this Agreement.

<br>
<strong>7. Assignment.</strong> <br>
Contractor acknowledges that the consulting services to be performed hereunder are of a special and unique nature. Neither this Agreement nor any right hereunder nor may interest herein be assigned or delegated by Contractor without the express written consent of Matrimony Firm. Any such attempted assignment shall be void.<br>
<strong>8. Independent contractor. </strong><br>
Contractor shall perform the Services hereunder as an independent consultant. Nothing in this Agreement shall in any way be construed to constitute Contractor as an agent, employee, or representative of Matrimony Firm. Since Contractor is not an employee of Matrimony Firm, it is understood that neither Contractor nor any of its employees is entitled to any employee benefits during the Term. Contractor shall pay all necessary local, state, or federal taxes, including but not limited to withholding taxes, workers’ compensation, FICA, and unemployment taxes for Contractor and its employees. Contractor acknowledges and agrees that Contractor is obligated to report as income all compensation received by Contractor pursuant to this Agreement, and Contractor agrees to indemnify Matrimony Firm and hold it harmless to the extent of any obligation imposed on Matrimony Firm (i) to pay withholding taxes or similar items or (ii) resulting from Contractor’s being determined not to be an independent contractor. In the performance of all Services hereunder, Contractor shall comply with all applicable laws and regulations.<br>
<strong>9. Equitable relief.</strong> <br>
Contractor agrees that it would be impossible or inadequate to measure and calculate Matrimony Firm’s damages from any breach of the covenants set forth in Sections 3, 5, or 6 herein. Accordingly, Contractor agrees that in the event of such breach, Matrimony Firm will have, in addition to any other right or remedy available, the right to seek to obtain from any court of competent jurisdiction an injunction restraining such breach or threatened breach and specific performance of any such provision.<br>
<strong>10. Miscellaneous.</strong><br>
 This is the entire agreement between the parties relating to the subject matter hereof and no waiver or modification of the Agreement shall be valid unless in writing signed by each party. The waiver of a breach of any term hereof shall in no way be construed as a waiver of any other term or breach hereof. If any provision of this Agreement shall be held by a court of competent jurisdiction to be contrary to law, the remaining provisions of this Agreement shall remain in full force and effect. Neither party shall have any liability for its failure to perform its obligations hereunder when due to circumstances beyond its reasonable control. This Agreement shall inure to the benefit of and be binding upon each party’s successors and assigns. This Agreement is governed by the laws of the STATE OF MAHARASHTRA without reference to conflict of laws principles. All disputes arising out of this Agreement shall be subject to the exclusive jurisdiction of the state and federal courts located in INDIA, and the parties agree and submit to the personal and exclusive jurisdiction and venue of these courts.<br>
In witness whereof, the parties hereto have executed this Agreement as of the day and year first written above.<br> <br>

For Matrimony Firm: <br> 
<strong>Company name:</strong> <?php echo $domain_name; ?><br>
<strong>Owner name: </strong> <?php echo $data_config -> owner;?> <br>
<strong>Date: </strong>04 Augest, 2021 <br>
<strong>Domain name:</strong> <?php echo $data_config -> Webname;?><br>
<strong>PAN:</strong> not updated<br>
<strong>Aadhar No: </strong>566894715591<br>
<strong>Address: </strong>not updated, maharashtra, INDIA<br>
<strong>Authorized signature</strong> ................<br> 
<br> 
For Contractor: <br>
<strong>Company name:</strong> Infinity Systems <br>
<strong>Owner name: </strong>Mr. Rajesh A. Patil <br>
<strong>Date: </strong>04 Augest, 2021 <br>
<strong>Domain name.</strong> infinitysystems.info<br>
<strong>PAN:</strong> BVMPP5780Q<br>
<strong>Aadhar No: </strong>4584 0193 5148<br>
<strong>Address</strong>T3B, Matoshree Apartment, Vijaynagar, Sangli 416416, Maharashtra, INDIA<br>
<strong>Authorized signature</strong> ................<br> 
<img src="assets/images/user/sign.png">
<br> 
<br>


</p></Div>

                            </div>
							
                            <button type="" class="btn btn-primary" id="update" name="">I agreed and purchased</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="assets/js/plugins/trumbowyg.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	 $(window).load(function(){        
	   $('#myModal11').modal('show');
		}); 
	</script>
<?php if(isset($_POST['submit'])) { ?>
<div id="myModal11" class="modal " role="dialog" style="margin-top: 100px;">
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
	                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Bank Details Updated Successfully</h2>
	                </div>
	                <div class="swal2-actions">
	                   <a href="add_bankdetails.php" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                    </div>
                </div> 
            </div>
        </div>   
    </div>
</div>   
<?php } ?>
<script type="text/javascript">
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
<?php include('footer.php');?>
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script src="ckeditor/sample.js" type="text/javascript"></script>
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<script src="assets/js/pages/dashboard-sale.js"></script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
</body>
</html>
