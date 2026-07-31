<?php
require_once('sys_dbconnection.php');
include('memprotect.php');
$login=$_SESSION['MatriID'];
$my_profile=mysqli_query($con,"SELECT *,date_format(DOB,'%d-%M-%Y') as DOB FROM register where matriid='$login'");
$me=mysqli_fetch_array($my_profile);
$regvar=$me['reg_step'];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Change Password</title>
  <link rel="icon" type="image/png" sizes="32x32" href="css3/assets/shivraj-logo.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css" />
  <style>
    .mvv-page-hero h1 { text-transform:none; }
  </style>
</head>
<body>
<?php include('header.php'); ?>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
function checkdiv(str)
{
  if (str=='Unmarried')
  {
    $('#noofchild').hide();
    $('#childstatus').hide();
  }
  else
  {
    $('#noofchild').show();
    $('#childstatus').show();
  }
}
function nospaces(t)
{
  if(t.value.match(/\s/g))
  {
    alert('Sorry, you are not allowed to enter any spaces');
    t.value=t.value.replace(/\s/g,'');
  }
}
function CheckLengthPassword(el)
{
  document.getElementById("passeror").style.display = 'none';
  if(el.value.length!=0)
  {
    if (el.value.length < 5 )
    {
      document.getElementById("passeror").style.display = 'block';
      document.getElementById("passeror").style.color = "#ff0000";
      document.getElementById('pass').value="";
      document.getElementById('pass').focus();
      return false;
    }
  }
}
function ValidateAlpha(evt)
{
  var keyCode = (evt.which) ? evt.which : evt.keyCode
  if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
  return false;
  return true;
}
function blockSpecialChar(e)
{
  var k;
  document.all ? k = e.keyCode : k = e.which;
  return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
}
function check_exist123(str)
{
  var xmlhttp;
  if (window.XMLHttpRequest)
  {
    xmlhttp=new XMLHttpRequest();
  }
  else
  {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("emailerror").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","check_email_exist.php?q="+str,true);
  xmlhttp.send();
}
</script>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Account</div>
      <h1>Change Password</h1>
      <p>सुरक्षितता साठी पासवर्ड बदला</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Change Password</span>
      </nav>
      <div class="mvv-dashboard-return-row"><a class="mvv-dashboard-return" href="index_dashboard"><i class="fas fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a></div>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <form method="post" action="change_password_submit" style="max-width:500px;">
        <?php require_once('includes/security.php'); echo svr_csrf_field(); ?>
        <?php if($_GET['message']=="success") { ?>
        <div style="background:rgba(232,97,42,0.1);border:1px solid rgba(232,97,42,0.25);border-radius:8px;padding:12px 18px;margin-bottom:16px;color:var(--mvv-maroon);font-size:0.9rem;">
          Your Password Changed Sucessfully.
        </div>
        <?php } ?>
        <?php if($_GET['message']=="invalid") { ?>
        <div style="background:rgba(232,97,42,0.1);border:1px solid rgba(232,97,42,0.25);border-radius:8px;padding:12px 18px;margin-bottom:16px;color:var(--mvv-maroon);font-size:0.9rem;">
          You must Enter the Same Password Twice in Order to Confirm it.
        </div>
        <?php } ?>
        <?php if($_GET['message']=="invalid1") { ?>
        <div style="background:rgba(232,97,42,0.1);border:1px solid rgba(232,97,42,0.25);border-radius:8px;padding:12px 18px;margin-bottom:16px;color:var(--mvv-maroon);font-size:0.9rem;">
          Your Old Password Is Incorrect.
        </div>
        <?php } ?>
        <?php if($_GET['message']=="error") { ?>
        <div style="background:rgba(232,97,42,0.1);border:1px solid rgba(232,97,42,0.25);border-radius:8px;padding:12px 18px;margin-bottom:16px;color:var(--mvv-maroon);font-size:0.9rem;">
          Password Must Differ From Old Password.
        </div>
        <?php } ?>
        <div class="mvv-field">
          <label>Enter Old Password</label>
          <input type="password" name="txtop" placeholder="Enter Old Password" maxlength="35" id="pass" required tabindex="1">
        </div>
        <div class="mvv-field">
          <label>Enter New Password</label>
          <input type="password" name="txtp" placeholder="Enter New Password" maxlength="35" id="pass1" required tabindex="2">
        </div>
        <div class="mvv-field">
          <label>Confirm Password</label>
          <input type="password" name="txtcp" placeholder="Confirm Password" maxlength="35" id="pass2" required tabindex="3">
        </div>
        <div style="margin-top:20px;">
          <button class="mvv-btn mvv-btn-primary" type="submit" name="submit" style="width:100%;" tabindex="4">Submit</button>
        </div>
      </form>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
<script>
const togglePassword = document.querySelector('#togglePassword');
const togglePassword1 = document.querySelector('#togglePassword1');
const togglePassword2 = document.querySelector('#togglePassword2');

const password = document.querySelector('#pass');
const password1 = document.querySelector('#pass1');
const password2 = document.querySelector('#pass2');

togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

togglePassword1.addEventListener('click', function (e) {
    const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
    password1.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

togglePassword2.addEventListener('click', function (e) {
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

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
});
</script>
</body>
</html>
