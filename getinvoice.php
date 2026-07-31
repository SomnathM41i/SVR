<?php 
require_once('includes/bootstrap.php');
error_reporting(0);
$id = $_POST['rowid'];
$configdata1 = mysqli_query($con,"SELECT * FROM siteconfig where id='1'") or svr_db_fail($con); 
$siteinfo1= mysqli_fetch_array($configdata1); 
$mid=$_SESSION['matriid'];
$sqldata=mysqli_query($con,"select * from paiddetails where Pmatriid='$mid' and Paidid='$id'");
$rowdata=mysqli_fetch_array($sqldata); ?>

    <div class="modal-header">
          <h4 class="modal-title">INVOICE</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
		<div class="modal-body ">
	 <div class="news-section py-2">
		   <div class="container py-xl-2 py-lg-2">
			 <div class="col-lg-12 agile-course-main text-left">
					
					<div class="w3ls-cource-first" id="print">
						<div class="col-md-12 col-sm-12 col-lg-12 design">
							<div class="col-md-12">
                            <div class="row">
                            <div class="col-md-7">
						  <img class="img-responsive thumbnail img1" src="branding/logos/logo-horizontal.png" style="margin-top:-8px;">
                         <br>
                                  <?php echo $siteinfo1['address'];?>
                                  
                            </div>
							
							   <div class="col-md-5">
							<table>
						<br>
              <tbody>
                <tr>
                  <td ><strong>Matrimony ID : </strong></td>
                  <td> <?php echo $_SESSION['matriid'];?></td>
                </tr>
                <tr>
                  <td ><strong>Invoice ID  :</strong></td>
                  <td><?php echo $rowdata['Poid'];?></td>
                </tr>
                <tr>
                  <td ><strong>Date :</strong></td>
                  <td><?php $dt=explode("-",$rowdata['Pactivedate']); echo $dt[2]."-".$dt[1]."-".$dt[0]?></td>
                </tr>
		
              </tbody>
            </table>
			 
                            </div>
							</div>			
			</div>
			<br>
			<div class="body table-responsive ">
			<table class="table table-hover table-bordered ">
                    <tbody> 
                        <tr>
		                <td width="110">Bill To</td>
						<td width="113"><?php echo $_SESSION['Smname'];?></td>
					</tr>
					<tr>
						<td>Plan Name</td>
						<td><?php echo $rowdata['Pplan'];?></td>
					</tr>
					<tr>
						<td>Plan Type</td>
						<?php $Pplan= $rowdata['Pplan'];
						      $selectquery="SELECT * FROM membershipplan WHERE plandisplayname='$Pplan'";
						      $selectdata=mysqli_query($con,$selectquery);
						      $selectresult=mysqli_fetch_array($selectdata);
						?>
						<td><?php echo $selectresult['plantype'];?></td>
					</tr>
					
					<tr>
						<td>Payment Mode</td>
						<td><?php echo $rowdata['Ppaymode'];?></td>
					</tr>
        <?php
		  $sqlregister=mysqli_query($con,"select * from register where MatriID='".$_SESSION['matriid']."'");
		 
          $rowregister=mysqli_fetch_array($sqlregister);
		   ?>
          <tr>
            <td>Activation Date</td>
            <td> <?php $explode=explode("-",$rowdata['Pactivedate']);
					echo $explode[2]."-".$explode[1]."-".$explode[0];?></td>
          </tr>
          <tr>
            <td>Plan Duration</td>
            <td><?php echo $rowdata['Pplanduration'];?> Days</td>
          </tr>
          <tr>
            <td>Discount</td>
            						<td><?php  $discountcode = $rowdata['discountcode'];
						        if($discountcode!="")
						        {
						            echo $discountcode."%";
						        }
						        else
						        {
						            echo "NULL";
						        }
						        
						        ?></td>
          </tr>
          <tr>
            <td>Plan Amount</td>
            <td><?php echo $rowdata['Pamount'];?></td>
          </tr>
		   <tr>
            <td>Total Contact </td>
            <td><?php echo $rowdata['Pnocontct'];?></td>
          </tr>
		  <tr>
            <td>Remaining Contact </td>
            <td><?php echo $rowregister['Noofcontacts'];?></td>
          </tr>
		   <tr>
            <td>Expire Date </td>
           
			<td><?php $dat=explode("-",$rowregister['MemshipExpiryDate']); echo $dat[2]."-".$dat[1]."-".$dat[0]?></td>
          </tr>
          <tr>
            <td align="right">Total</td>
            <td><?php echo $rowdata['Pamount'];?></td>
          </tr>
          <tr>
            <td align="right">Amount In Words</td>
            <td><?php  echo  ucwords(todigit($rowdata['Pamount'])." Only"); ?></td>
          </tr>
        </tbody>
      </table>
	    </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                <b>Note:</b>Thank you for your purchase! Please note that all sales are final and non-refundable. For any queries or assistance, kindly reach out to us within 48 hours. We appreciate your understanding and support.   
                </div>
            </div>			
        </div>
	</div>
			<div align="right">
	 <button type="button" class="btn btn-link waves-effect " onClick="print_report()"  style="margin-top:16px;"><i class="fa fa-print" aria-hidden="true"></i></button>
	 </div>
</div>

<?php

function todigit($number)
	{
$no=$number;
  
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  return $result;

	}

?>

<script>
var closebtns = document.getElementsByClassName("close1");
var i;

for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}
</script>
<script>
	function print_report()
{
	var divElements = document.getElementById("print").innerHTML;
	//Get the HTML of whole page
	var oldPage = document.body.innerHTML;
	
	//Reset the page's HTML with div's HTML only
	document.body.innerHTML = 
	  "<html><head><title></title></head><body>" + 
	  divElements + "</body></html>";
	
	
	window.print();
	
	//Restore orignal HTML
	document.body.innerHTML = oldPage;
	location.reload();
	//window.location.assign('tot_stock_shop.php');	
}
</script>


