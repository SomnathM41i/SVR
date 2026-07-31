<?php 
	require_once('includes/bootstrap.php');
	
	include('memprotect.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Settings</title>
  <link rel="icon" type="image/png" sizes="32x32" href="css3/assets/shivraj-logo.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css" />
  <style>
    .mvv-page-hero h1 { text-transform:none; }
    .settings-section li { list-style:none; }
  </style>
</head>
<body>
<?php include('header.php'); ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Settings</div>
      <h1>Settings</h1>
      <p>तुमची सेटिंग्ज</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Settings</span>
      </nav>
      <div class="mvv-dashboard-return-row"><a class="mvv-dashboard-return" href="index_dashboard"><i class="fas fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a></div>
    </div>
  </section>

<?php if(isset($login)&& $regvar=='9') { ?>
  <section class="mvv-section">
    <div class="mvv-container">
      <div style="max-width:600px;">

<?php if($_GET['message']=="success") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Horoscope Settings updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>
<?php if($_GET['message']=="photosucc") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Photo Settings updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>
<?php if($_GET['message']=="phonesucc") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Phone Settings updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>
<?php if($_GET['message']=="default1") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Horoscope Default Settings updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>
<?php if($_GET['message']=="default2") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Photo Settings Default updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>
<?php if($_GET['message']=="default3") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Phone Settings Default updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>

<form method="post" action="horoscope_setting.php" class="register-form pt-md-4">
  <span class="title">Horoscope Setting</span>
  <div class="text">You can have complete privacy by protecting your horoscope from members and you can make it visible only to members you prefer However this service is available only for premium members. 
  </div>
  <div class="comment-box">
    <div class="comment ml-auto">
      <div class="comment-info1">
        <div class="radio-box">
          <input type="radio" style="vertical-align: middle" class="radiostye" name="horoscope" value="paidhoro" <?=$me['horoscope_visibility']=="paidhoro" ? "checked" : ""?> checked>&nbsp; 
          <label style="vertical-align: middle">Make my horoscope  visible only to paid members </label> <cite>  ---- Recommend for better performance.</cite>
        </div>
        <div class="radio-box">
          <input type="radio"  style="vertical-align: middle" class="radiostye" name="horoscope" value="freehoro" <?=$me['horoscope_visibility']=="freehoro" ? "checked" : ""?> >&nbsp; 
          <label style="vertical-align: middle">Make my horoscope  visible to all </label>
        </div>
      </div>
      <button class="theme-btn btn btn-style-one" type="submit" name="submit" style=""><span class="btn-title">Submit</span></button>&nbsp;&nbsp;
      <button class="theme-btn btn btn-style-three" type="submit" name="default1" style=""><span class="btn-title">Default</span></button>
    </div>
  </div>
</form>

<form method="post" action="phone_setting.php" class="register-form pt-md-4 mt-3">
  <span class="title">Phone Setting</span>
  <div class="text">You can have complete privacy by protecting your phone number from members and you can make it visible only to members you prefer. 
  </div>
  <div class="comment-box">
    <div class="comment">
      <div class="comment-info1">
        <div class="radio-box ">
          <input type="radio" style="vertical-align: middle" name="phone" class="radiostye" value="paidphone" <?=$me['phone_visibility']=="paidphone" ? "checked" : ""?> checked>&nbsp; 
          <label style="vertical-align: middle">Show mobile number only to paid members </label>  <cite>  ---- Recommend for better performance.</cite>
        </div>
        <div class="radio-box">
          <input type="radio" name="phone" style="vertical-align: middle" class="radiostye" value="freephone" <?=$me['phone_visibility']=="freephone" ? "checked" : ""?> >&nbsp; 
          <label style="vertical-align: middle">Show mobile number only to whom I grant access to view</label>
        </div>
      </div>
      <button class="theme-btn btn btn-style-one" type="submit" name="submit" style=""><span class="btn-title">Submit</span></button>&nbsp;&nbsp;
      <button class="theme-btn btn btn-style-three" type="submit" name="default2" style=""><span class="btn-title">Default</span></button>
    </div>
  </div>
</form>

<form method="post" action="photo_setting.php" class="register-form pt-md-4 mt-3">
  <span class="title"> Photo Setting</span>
  <div class="text">You can have complete privacy by protecting your photo number from members and you can make it visible only to members you prefer.
  </div>
  <div class="comment-box">
    <div class="comment">
      <div class="comment-info1">
        <div class="radio-box">
          <input type="radio" style="vertical-align: middle" name="photo" class="radiostye" value="paidphoto" <?=$me['photo_visibility']=="paidphoto" ? "checked" : ""?> checked>&nbsp; 
          <label style="vertical-align: middle">Show photo only to  paid members </label>  <cite>  ---- Recommend for better performance.</cite>
        </div>
        <div class="radio-box">
          <input type="radio" name="photo" style="vertical-align: middle" class="radiostye" value="allphoto" <?=$me['photo_visibility']=="allphoto" ? "checked" : ""?> >&nbsp; 
          <label style="vertical-align: middle">View to all</label>
        </div>
      </div>
      <button class="theme-btn btn btn-style-one" type="submit" name="submit" style=""><span class="btn-title">Submit</span></button>&nbsp;&nbsp;
      <button class="theme-btn btn btn-style-three" type="submit" name="default3" style=""><span class="btn-title">Default</span></button>
    </div>
  </div>
</form>

<h5 class="title" style="">Delete Profile</h5>
<?php 
  $is_delete = mysqli_query($con,"select * from delete_request where matriid='".$_SESSION['matriid']."'");
  if(mysqli_num_rows($is_delete)>0){ ?>
  <div class="text mt-3">
    <label>Deletation request send.</label>
  </div>
<?php } else { ?>
  <div class="text mt-3">
    <label>Do you really want to delete profile</label>
  </div>
  <div class="form-group option-box">
    <div class="product-form">
      <a href="delete_profile.php"><button class="theme-btn btn btn-style-one" type="submit" name="default" style=""><span class="btn-title">Click here</span></button></a>
    </div>
  </div>
<?php } ?>
<?php
  
?>

      </div>
    </div>
  </section>
<?php } else {
  $ID=$_SESSION['matriid'];
  $qry=mysqli_query($con,"select * from register where MatriID='$ID'");
  $fetch=mysqli_fetch_array($qry); ?>
  <section class="mvv-section">
    <div class="mvv-container">
      <div style="max-width:600px;">

<?php if($_GET['message']=="success") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Horoscope Settings updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>
<?php if($_GET['message']=="photosucc") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Photo Settings updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>
<?php if($_GET['message']=="phonesucc") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Phone Settings updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>
<?php if($_GET['message']=="default1") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Horoscope Default Settings updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>
<?php if($_GET['message']=="default2") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Photo Settings Default updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>
<?php if($_GET['message']=="default3") { ?>
  <div class="alert alert-info1 col-md-12 " align="center" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Phone Settings Default updated sucessfully.
  </div>
<?php } else { ?>
<?php } ?>

<form method="post" action="horoscope_setting.php" class="register-form pt-md-4">
  <span class="title">Horoscope Setting</span>
  <div class="text">You can have complete privacy by protecting your horoscope from members and you can make it visible only to members you prefer However this service is available only for premium members. 
  </div>
  <div class="comment-box">
    <div class="comment ml-auto">
      <div class="comment-info1">
        <div class="radio-box">
          <input type="radio" style="vertical-align: middle" class="radiostye" name="horoscope" value="paidhoro" <?=$fetch['horoscope_visibility']=="paidhoro" ? "checked" : ""?> checked>&nbsp; 
          <label style="vertical-align: middle">Make my horoscope  visible only to paid members </label> <cite>  ---- Recommend for better performance.</cite>
        </div>
        <div class="radio-box">
          <input type="radio" style="vertical-align: middle" class="radiostye" name="horoscope" value="freehoro" <?=$fetch['horoscope_visibility']=="freehoro" ? "checked" : ""?> >&nbsp; 
          <label style="vertical-align: middle">Make my horoscope  visible to all </label>
        </div>
      </div>
      <button class="theme-btn btn btn-style-one" type="submit" name="submit" style=""><span class="btn-title">Submit</span></button>&nbsp;&nbsp;
      <button class="theme-btn btn btn-style-three" type="submit" name="default1" style=""><span class="btn-title">Default</span></button>
    </div>
  </div>
</form>

<form method="post" action="phone_setting.php" class="register-form pt-md-4">
  <span class="title">Phone Setting</span>
  <div class="text">You can have complete privacy by protecting your phone number from members and you can make it visible only to members you prefer. 
  </div>
  <div class="comment-box">
    <div class="comment">
      <div class="comment-info1">
        <div class="radio-box ">
          <input type="radio" style="vertical-align: middle" name="phone" class="radiostye" value="paidphone" <?=$fetch['phone_visibility']=="paidphone" ? "checked" : ""?> checked>&nbsp; 
          <label style="vertical-align: middle">Show mobile number only to paid members </label>  <cite>  ---- Recommend for better performance.</cite>
        </div>
        <div class="radio-box">
          <input type="radio" style="vertical-align: middle" name="phone" class="radiostye" value="freephone" <?=$fetch['phone_visibility']=="freephone" ? "checked" : ""?> >&nbsp; 
          <label style="vertical-align: middle">Show mobile number only to whom I grant access to view</label>
        </div>
      </div>
      <button class="theme-btn btn btn-style-one" type="submit" name="submit" style=""><span class="btn-title">Submit</span></button>&nbsp;&nbsp;
      <button class="theme-btn btn btn-style-three" type="submit" name="default2" style=""><span class="btn-title">Default</span></button>
    </div>
  </div>
</form>

<form method="post" action="photo_setting.php" class="register-form pt-md-4">
  <span class="title"> Photo Setting</span>
  <div class="text">You can have complete privacy by protecting your photo number from members and you can make it visible only to members you prefer.
  </div>
  <div class="comment-box">
    <div class="comment">
      <div class="comment-info1">
        <div class="radio-box">
          <input type="radio" name="photo" style="vertical-align: middle" class="radiostye" value="paidphoto" <?=$fetch['photo_visibility']=="paidphoto" ? "checked" : ""?> checked>&nbsp; 
          <label style="vertical-align: middle">Show photo only to  paid members </label>  <cite>  ---- Recommend for better performance.</cite>
        </div>
        <div class="radio-box">
          <input type="radio" style="vertical-align: middle" name="photo" class="radiostye" value="allphoto" <?=$fetch['photo_visibility']=="allphoto" ? "checked" : ""?> >&nbsp; 
          <label style="vertical-align: middle">View to all</label>
        </div>
      </div>
      <button class="theme-btn btn-style-one" type="submit" name="submit" style=""><span class="btn-title">Submit</span></button>&nbsp;&nbsp;
      <button class="theme-btn btn btn-style-three" type="submit" name="default3" style=""><span class="btn-title">Default</span></button>
    </div>
  </div>
</form>

<a href="register_success.php?id=<?php echo $fetch['MatriID']?>">
  <button class="theme-btn btn btn-style-two mt-3" type="submit" name="submit"><span class="btn-title">Back To Register</span></button></a>

      </div>
    </div>
  </section>
<?php } ?>

</main>

<?php include('footer3.php'); ?>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
$(document).ready(function() {
  $('.btn').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="fa fa-spinner fa-spin faio "></i><span class="btn-title">Loading</span> ';
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
