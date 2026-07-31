<?php
require_once('sys_dbconnection.php');
include('memprotect.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Invoice</title>
<link href="css3/Style.css" rel="stylesheet">
<link href="css3/mvv-premium.css" rel="stylesheet">
<link rel="shortcut icon" href="css3/assets/manpasand-logo.png" type="image/x-icon">
<link rel="icon" href="css3/assets/manpasand-logo.png" type="image/x-icon">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<style>
:root{--mvv-maroon:#6B1A1A;--mvv-saffron:#E8612A;--mvv-gold:#C9921A;--mvv-cream:#FFF8F0;--mvv-border:#e0d5cb;--mvv-muted:#888;}
.mvv-btn{display:inline-block;padding:10px 24px;border-radius:8px;font-weight:600;font-size:.9rem;border:none;cursor:pointer;text-decoration:none;transition:.2s;}
.mvv-btn.primary{background:var(--mvv-maroon);color:#fff;}
.mvv-btn.primary:hover{background:#8B1A1A;}
.mvv-table-wrap{overflow-x:auto;}
.mvv-table{width:100%;border-collapse:collapse;border:1px solid var(--mvv-border);border-radius:10px;overflow:hidden;}
.mvv-table th{background:var(--mvv-maroon);color:#fff;padding:12px 16px;text-align:left;font-weight:600;}
.mvv-table td{padding:10px 16px;border-bottom:1px solid var(--mvv-border);}
.mvv-table tr:last-child td{border-bottom:none;}
.mvv-table tr:hover td{background:var(--mvv-cream);}
.modal-content{width:138%;margin-left:-82px;}
@media screen and (max-width:568px){
.modal-content{width:103%;margin-left:-6px;margin-top:-7px;}
.card{width:90%;margin-left:5%;}
.img1{margin-top:26px;}
.design{position:relative;width:105%;min-height:1px;padding-right:16px;padding-left:16px;}
.btn{margin-top:-217px;}
.col-lg-12{position:relative;width:100%;min-height:1px;padding-right:0px;padding-left:0px;}
}
@media only screen and (max-width:768px){
.modal-content{width:103%;margin-left:-6px;margin-top:-7px;}
.card{width:90%;margin-left:5%;}
.img1{margin-top:26px;}
.design{position:relative;width:105%;min-height:1px;padding-right:16px;padding-left:16px;}
.btn{margin-top:-217px;}
.col-lg-12{position:relative;width:100%;min-height:1px;padding-right:0px;padding-left:0px;}
}
</style>
<script>
addEventListener("load", function () {
    setTimeout(hideURLbar, 0);
}, false);
function hideURLbar() {
    window.scrollTo(0, 1);
}
</script>
</head>
<body>

<?php include('header.php');?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Billing</div>
      <h1>Invoice</h1>
      <p>तुमचे बील तपशील</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Invoice</span>
      </nav>
    </div>
  </section>

  <?php $matriid=$_SESSION['MatriID'];
  $sqlmatri=mysqli_query($con,"select * from paiddetails where Pmatriid='$matriid'") or die(mysqli_error($con));?>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if(mysqli_num_rows($sqlmatri)==0){ ?>
      <div style="text-align:center;padding:80px 20px;">
        <div style="font-size:3rem;font-weight:900;color:var(--mvv-maroon);opacity:0.3;margin-bottom:10px;">OOP'S</div>
        <h4 style="color:var(--mvv-muted);">You have not purchased any plan yet</h4>
        <p style="color:#999;">Sorry You are Not selected any plan yet.</p>
        <a href="my_offer" class="mvv-btn primary" style="margin-top:10px;">Get Plan Here.</a>
      </div>
      <?php } else { ?>
      <div class="mvv-table-wrap">
        <table class="mvv-table">
          <thead>
            <tr>
              <th>Plan Name</th>
              <th>Date</th>
              <th>Amount</th>
              <th>Discount</th>
              <th>Invoice</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while($rowmatri=mysqli_fetch_array($sqlmatri)){ ?>
            <tr>
              <td>
                <?php
                if(mysqli_num_rows($sqlmatri)==0){
                  //echo "Free";
                }else{
                  echo $rowmatri['Pplan'];
                }?>
              </td>
              <td><?php $explode=explode("-",$rowmatri['Pactivedate']);
                echo $explode[2]."-".$explode[1]."-".$explode[0];?></td>
              <td><?php echo $rowmatri['Pamount']?></td>
              <td><?php $discountcode=$rowmatri['discountcode'];
                if($discountcode!=""){
                  echo $discountcode."%";
                }else{
                  echo "NULL";
                }?></td>
              <td><span style="font-size:14px;margin-bottom:10px;cursor:pointer;color:#3271a8;" data-toggle="modal" data-target="#myModal1" data-id="<?php echo $rowmatri['Paidid'];?>">Get Invoice</span></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <?php } ?>
    </div>
  </section>
</main>

<div class="modal fade" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content"></div>
  </div>
</div>

<?php include('footer3.php');?>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
$(document).ready(function(){
    $('#myModal1').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'getinvoice.php',
            data : 'rowid='+ rowid,
            success : function(data){
                $('.modal-content').html(data);
            }
        });
    });
});
</script>
</body>
</html>
