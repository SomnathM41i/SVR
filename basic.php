<?php
require_once('includes/bootstrap.php');
include('memprotect.php');
$login=$_SESSION['MatriID'];
$my_profile=mysqli_query($con,"SELECT *,date_format(DOB,'%d-%M-%Y') as DOB FROM register where matriid='$login'");
$me=mysqli_fetch_array($my_profile);
$regvar=$me['reg_step'];
?>
<?php $page_title = 'Basic Details - Manpasand Jodidar'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo htmlspecialchars($page_title); ?></title>
  <link rel="icon" type="image/png" sizes="32x32" href="branding/favicons/icon-32.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css" />
  <style>
  .mvv-page-hero h1 { text-transform:none; }
  .mvv-field input[readonly] { background:#f5f0eb; cursor:not-allowed; }
  .mvv-field a.underline { font-size:0.82rem; margin-top:2px; display:inline-block; }
  </style>
</head>
<body>
<?php include('header.php'); ?>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
function nospaces(t){if(t.value.match(/\s/g)){alert('Sorry, you are not allowed to enter any spaces');t.value=t.value.replace(/\s/g,'');}}
</script>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Profile</div>
      <h1>Basic Details</h1>
      <p>तुमची मूलभूत माहिती</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Basic Details</span>
      </nav>
      <div class="mvv-dashboard-return-row"><a class="mvv-dashboard-return" href="index_dashboard"><i class="fas fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a></div>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php
      $sql=mysqli_query($con,"SELECT * FROM cms WHERE link='contact us'");
      while($row=mysqli_fetch_array($sql)) {
      ?>
      <div style="background:rgba(232,97,42,0.1);border:1px solid rgba(232,97,42,0.25);border-radius:8px;padding:12px 18px;margin-bottom:24px;display:flex;align-items:center;gap:10px;color:var(--mvv-maroon);font-size:0.9rem;max-width:800px;">
        <i class="bi bi-info-circle-fill"></i> Note: If you want any changes please contact <?php echo $row['email']; ?>
      </div>
      <?php } ?>

      <?php $names = explode(' ', $me['Name'], 2);
      $first_name = $names[0];
      $last_name = $names[1] ?? '';
      ?>
      <div class="row" style="max-width:800px;">
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Name</label>
            <input type="text" value="<?php echo $first_name; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Surname</label>
            <input type="text" value="<?php echo $last_name; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Email</label>
            <input type="text" value="<?php echo $me['ConfirmEmail']; ?>" readonly>
            <?php
            $rowverify=mysqli_query($con,"select * from emailverify where MatriID='$login'");
            $fetch=mysqli_fetch_array($rowverify);
            $verification=$fetch['verification'];
            if($verification!='Yes'){ ?>
              <a href="verifycode" class="underline">Verify Your Email</a>
            <?php } else { ?>
              <a href="#" class="underline" style="color:var(--mvv-green);">Email Verified</a>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Password</label>
            <input type="password" value="<?php echo $me['ConfirmPassword']; ?>" readonly>
            <a href="change_pswd" class="underline">Change Password</a>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Matrimony Profile By</label>
            <input type="text" value="<?php echo $me['Profilecreatedby']; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Gender</label>
            <input type="text" value="<?php echo $me['Gender']; ?>" readonly>
          </div>
        </div>
        <?php $date = explode('-', $me['DOB']); $dob = $date[0]; $dobMonth = $date[1]; $dobYear = $date[2]; ?>
        <div class="col-lg-3 col-md-3">
          <div class="mvv-field"><label>Date</label>
            <input type="text" value="<?php echo $dob; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="mvv-field"><label>Month</label>
            <input type="text" value="<?php echo $dobMonth; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="mvv-field"><label>Year</label>
            <input type="text" value="<?php echo $dobYear; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="mvv-field"><label>Age</label>
            <input type="text" value="<?php echo $me['Age']; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Marital Status</label>
            <input type="text" value="<?php echo $me['Maritalstatus']; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Religion</label>
            <input type="text" value="<?php echo $me['Religion']; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Caste</label>
            <input type="text" value="<?php echo $me['Caste']; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Subcaste</label>
            <input type="text" value="<?php echo $me['Subcaste']; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Country Code</label>
            <input type="text" value="+<?php echo $me['countrycode']; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Mobile Number</label>
            <input type="text" value="<?php echo $me['Mobile']; ?>" readonly>
            <span style="font-size:0.82rem;color:var(--mvv-muted);">Primary &amp; Verified Number</span>
          </div>
        </div>
        <?php if($me['regno']!='') { ?>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Reg No</label>
            <input type="text" value="<?php echo $me['regno']; ?>" readonly>
          </div>
        </div>
        <?php } ?>
        <?php if($me['signdate']!='') { ?>
        <div class="col-lg-6 col-md-6">
          <div class="mvv-field"><label>Reg Date</label>
            <input type="text" value="<?php echo $me['signdate']; ?>" readonly>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
<script>
$(function () {
  $('#noofbro5, #noofbro4, #noofbro3, #noofbro2, #noofbro1, #noofbrono').hide();
  $("#noofbrom").change(function () {
    var v = $(this).val();
    $('#noofbro6, #noofbro5, #noofbro4, #noofbro3, #noofbro2, #noofbro1, #noofbrono').hide();
    if (v == "No") $('#noofbrono').show();
    else if (v == "1") $('#noofbro1').show();
    else if (v == "2") $('#noofbro2').show();
    else if (v == "3") $('#noofbro3').show();
    else if (v == "4") $('#noofbro4').show();
    else if (v == "5") $('#noofbro5').show();
    else if (v == "5+") $('#noofbro6').show();
  });
  $("#noofsis5, #noofsis4, #noofsis3, #noofsis2, #noofsis1, #noofsisno").hide();
  $("#noofsism").change(function () {
    var v = $(this).val();
    $('#noofsis6, #noofsis5, #noofsis4, #noofsis3, #noofsis2, #noofsis1, #noofsisno').hide();
    if (v == "No") $('#noofsisno').show();
    else if (v == "1") $('#noofsis1').show();
    else if (v == "2") $('#noofsis2').show();
    else if (v == "3") $('#noofsis3').show();
    else if (v == "4") $('#noofsis4').show();
    else if (v == "5") $('#noofsis5').show();
    else if (v == "5+") $('#noofsis6').show();
  });
});
</script>
</body>
</html>
