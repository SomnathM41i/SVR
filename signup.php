<?php 
ob_start();
require_once('includes/bootstrap.php');
include('register_submit.php');
?>
<?php $page_title = 'Free Register - Manpasand Jodidar'; include('header3.php'); ?>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
function checkdiv(str) {
  if (str=='Unmarried') { $('#noofchild').hide(); $('#childstatus').hide(); }
  else { $('#noofchild').show(); $('#childstatus').show(); }
}
function nospaces(t) {
  if(t.value.match(/\s/g)){ alert('Sorry, you are not allowed to enter any spaces'); t.value=t.value.replace(/\s/g,''); }
}
function fillday(str) {
  var xmlhttp;
  if (str=="") { document.getElementById("day").innerHTML=""; return; }
  if (window.XMLHttpRequest) xmlhttp=new XMLHttpRequest(); else xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) document.getElementById("day").innerHTML=xmlhttp.responseText;
  };
  xmlhttp.open("GET","fillday.php?q="+str,true);
  xmlhttp.send();
}
function CheckLengthPassword(el) {
  document.getElementById("passeror").style.display='none';
  if(el.value.length!=0) {
    if(el.value.length<5) {
      document.getElementById("passeror").style.display='block';
      document.getElementById("passeror").style.color="#ff0000";
      document.getElementById('pass').value="";
      document.getElementById('pass').focus();
      return false;
    }
  }
}
function ValidateAlpha(evt) {
  var keyCode=(evt.which)?evt.which:evt.keyCode;
  if((keyCode<65||keyCode>90)&&(keyCode<97||keyCode>123)&&keyCode!=32) return false;
  return true;
}
function blockSpecialChar(e) {
  var k; document.all?k=e.keyCode:k=e.which;
  return((k>64&&k<91)||(k>96&&k<123)||k==8||k==32||(k>=48&&k<=57));
}
function check_exist123(str) {
  var xmlhttp;
  if (window.XMLHttpRequest) xmlhttp=new XMLHttpRequest(); else xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) document.getElementById("emailerror").innerHTML=xmlhttp.responseText;
  };
  xmlhttp.open("GET","check_email_exist.php?q="+str,true);
  xmlhttp.send();
}
function getage() {
  var year=document.getElementById("year").value;
  var month=document.getElementById("month").value;
  var day=document.getElementById("day").value;
  if((month=="02"&&day=="30")||(month=="02"&&day=="31")||(month=="04"&&day=="31")||(month=="06"&&day=="31")||(month=="11"&&day=="31")||(month=="09"&&day=="31")) {
    document.getElementById("doberror").style.display='block';
    document.getElementById("year").value='';
    document.getElementById("month").value='';
    document.getElementById("day").value='';
    document.getElementById("day").focus();
    return false;
  }
  if(year!=""&&month!=""&&day!="") {
    document.getElementById("doberror").style.display='none';
    document.getElementById("doberror1").style.display='none';
    document.getElementById("doberror2").style.display='none';
    var today=new Date();
    var birthDate=new Date();
    birthDate.setYear(year);
    birthDate.setMonth(month);
    birthDate.setDate(day);
    var age=today.getFullYear()-birthDate.getFullYear();
    var m=today.getMonth()-birthDate.getMonth();
    var d=today.getDate()-birthDate.getDate();
    if(m<0) { age--; m=12+m; }
    if(d<0) { d=30+d; }
    var page="",pmonth="",pday="";
    page=(age>1)?age+" Years ":age+" Year ";
    pmonth=(m>1)?m+" Months ":m+" Month ";
    pday=(d>1)?d+" Days ":d+" Day ";
    document.getElementById('age').value=page+pmonth+pday;
    document.getElementById('age1').value=age;
    if(document.getElementById('age1').value<21&&matri.gender[0].checked) {
      alert("Your age must be over 21 to register");
      document.getElementById("year").value='';
      document.getElementById("month").value='';
      document.getElementById("day").value='';
      return false;
    } else if(document.getElementById('age1').value<18&&matri.gender[1].checked) {
      alert("Your age must be over 18 to register");
      document.getElementById("year").value='';
      document.getElementById("month").value='';
      document.getElementById("day").value='';
      return false;
    }
    return true;
  }
}
function preventBack() { window.history.forward(); }
setTimeout("preventBack()",0);
window.onunload=function(){null};
<?php if(isset($_GET['error'])): ?>
alert("<?php echo $_GET['error']; ?>");
<?php endif; ?>
<?php if(isset($_GET['mobile'])): ?>
alert("<?php echo $_GET['mobile']; ?>");
<?php endif; ?>
</script>
<style>
:root {
  --mvv-maroon: var(--maroon, #7A1F39);
  --mvv-gold: var(--gold, #BA9350);
}
</style>
<style>
main.mvv-signup-page {
  background:
    radial-gradient(circle at top left, rgba(240,192,74,0.16), transparent 28%),
    linear-gradient(180deg, #FFFDFB 0%, #fff 48%, #FFFDFB 100%);
  color: var(--text-main, #2C1810);
}
main.mvv-signup-page .mvv-container {
  width: min(1140px, calc(100% - 32px));
  margin: 0 auto;
}
main.mvv-signup-page .mvv-page-hero {
  padding: 58px 0 42px !important;
  min-height: auto !important;
  background:
    linear-gradient(135deg, rgba(94,20,38,0.92), rgba(139,34,48,0.88), rgba(201, 85, 106,0.86)),
    radial-gradient(circle at top right, rgba(240,192,74,0.35), transparent 30%);
  color: #fff;
  position: relative;
  overflow: hidden;
}
main.mvv-signup-page .mvv-page-hero::after {
  content: 'ॐ';
  position: absolute;
  right: 7%;
  top: 8px;
  font-family: 'Noto Sans Devanagari', sans-serif;
  font-size: 118px;
  line-height: 1;
  color: rgba(255,255,255,0.06);
  pointer-events: none;
}
main.mvv-signup-page .mvv-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 10px;
  color: var(--gold-light, #DDB15F);
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.11em;
  text-transform: uppercase;
}
main.mvv-signup-page .mvv-page-hero h1 {
  max-width: 850px;
  margin: 0 0 12px;
  color: #fff;
  font-family: 'Noto Sans Devanagari', 'Raleway', sans-serif;
  font-size: clamp(2rem, 4.2vw, 4rem);
  font-weight: 700;
  line-height: 1.15;
}
main.mvv-signup-page .mvv-page-hero p {
  margin: 0 0 22px;
  color: rgba(255,255,255,0.84);
  font-size: 1.02rem;
}
main.mvv-signup-page .mvv-breadcrumb {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 9px 15px !important;
  border-radius: 999px;
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.18);
  color: rgba(255,255,255,0.86);
}
main.mvv-signup-page .mvv-breadcrumb a {
  color: #fff;
  text-decoration: none;
  font-weight: 700;
}
main.mvv-signup-page .mvv-section {
  padding: 46px 0 58px;
}
main.mvv-signup-page .mvv-form {
  max-width: 880px;
  margin: 0 auto;
  padding: 34px;
  border: 1px solid rgba(186,147,80,0.22);
  border-radius: 24px;
  background: rgba(255,255,255,0.92);
  box-shadow: 0 20px 60px rgba(94,20,38,0.13);
}
main.mvv-signup-page .mvv-title {
  margin: 0 0 24px;
  color: var(--deep-maroon, #5E1426);
  font-family: 'Noto Sans Devanagari', 'Raleway', sans-serif;
  font-weight: 700;
  line-height: 1.2;
}
main.mvv-signup-page .mvv-form-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 18px;
}
main.mvv-signup-page .mvv-field,
main.mvv-signup-page .full {
  min-width: 0;
}
main.mvv-signup-page .mvv-field.full,
main.mvv-signup-page .full {
  grid-column: 1 / -1;
}
main.mvv-signup-page .mvv-field {
  padding: 16px;
  border: 1px solid rgba(200,130,50,0.22);
  border-radius: 16px;
  background: #FFFDFB;
  box-shadow: 0 5px 22px rgba(94,20,38,0.05);
}
main.mvv-signup-page .mvv-terms-field {
  padding: 18px 20px;
}
main.mvv-signup-page .mvv-terms-label {
  display: flex !important;
  align-items: flex-start !important;
  gap: 10px !important;
  margin: 0 !important;
  color: var(--text-muted, #7A6570);
  font-weight: 500 !important;
  line-height: 1.5;
  cursor: pointer;
}
main.mvv-signup-page .mvv-terms-label input {
  flex: 0 0 18px;
  margin-top: 3px;
}
main.mvv-signup-page .mvv-terms-text {
  display: block;
  max-width: 100%;
}
main.mvv-signup-page .mvv-terms-text a {
  color: var(--mvv-maroon);
  text-decoration: underline;
  font-weight: 700;
  white-space: nowrap;
}
main.mvv-signup-page .mvv-field label {
  display: block;
  margin: 0 0 7px;
  color: var(--text-muted, #7A6570);
  font-size: 0.9rem;
  font-weight: 700;
}
main.mvv-signup-page .mvv-field input:not([type="radio"]):not([type="checkbox"]),
main.mvv-signup-page .mvv-field select {
  width: 100%;
  height: 46px;
  padding: 0 14px;
  border: 1px solid rgba(122,92,74,0.25);
  border-radius: 11px;
  background: #fff;
  color: var(--text-main, #2C1810);
  font-size: 0.96rem;
  outline: none;
  box-shadow: none;
}
main.mvv-signup-page .mvv-field input:focus,
main.mvv-signup-page .mvv-field select:focus {
  border-color: var(--gold, #BA9350);
  box-shadow: 0 0 0 4px rgba(186,147,80,0.14);
}
main.mvv-signup-page input[type="radio"],
main.mvv-signup-page input[type="checkbox"] {
  accent-color: var(--gold, #BA9350);
}
main.mvv-signup-page .mvv-btn.primary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  width: 100%;
  min-height: 52px;
  border: 0;
  border-radius: 14px;
  background: linear-gradient(135deg, var(--gold, #BA9350), var(--saffron, #C9556A));
  color: #fff;
  font-weight: 800;
  font-size: 1rem;
  box-shadow: 0 12px 30px rgba(201, 85, 106,0.25);
}
main.mvv-signup-page .mvv-btn.primary:hover {
  transform: translateY(-1px);
  box-shadow: 0 16px 36px rgba(201, 85, 106,0.32);
}
@media (max-width: 767px) {
  main.mvv-signup-page .mvv-page-hero {
    padding: 40px 0 30px !important;
  }
  main.mvv-signup-page .mvv-section {
    padding: 28px 0 40px;
  }
  main.mvv-signup-page .mvv-form {
    padding: 22px;
    border-radius: 18px;
  }
  main.mvv-signup-page .mvv-form-grid {
    grid-template-columns: 1fr;
  }
  main.mvv-signup-page .mvv-terms-label {
    font-size: 0.92rem;
  }
}

/* Light breadcrumb banner shared with Membership and Step 2. */
main.mvv-signup-page .mvv-page-hero.mvv-form-hero {
  min-height: auto !important;
  padding: clamp(50px, 6vw, 72px) 0 !important;
  color: #3A2530 !important;
  background: radial-gradient(circle at 80% 30%, rgba(201,85,106,.14), transparent 30%), #FFFDFB !important;
  border-bottom: 1px solid rgba(94,20,38,.12) !important;
}
main.mvv-signup-page .mvv-page-hero.mvv-form-hero::before,
main.mvv-signup-page .mvv-page-hero.mvv-form-hero::after {
  display: none !important;
  content: none !important;
}
main.mvv-signup-page .mvv-page-hero.mvv-form-hero .mvv-container {
  padding-right: 24px !important;
}
main.mvv-signup-page .mvv-page-hero.mvv-form-hero h1 {
  color: #5E1426 !important;
}
main.mvv-signup-page .mvv-page-hero.mvv-form-hero p {
  color: #7A6570 !important;
}
main.mvv-signup-page .mvv-page-hero.mvv-form-hero .mvv-breadcrumb {
  padding: 0 !important;
  background: transparent !important;
  border: 0 !important;
  border-radius: 0 !important;
  color: #7A6570 !important;
  backdrop-filter: none !important;
  font-weight: 500 !important;
}
main.mvv-signup-page .mvv-page-hero.mvv-form-hero .mvv-breadcrumb a {
  color: #C9556A !important;
}
main.mvv-signup-page .mvv-page-hero.mvv-form-hero .mvv-breadcrumb span {
  color: #7A6570 !important;
}
main.mvv-signup-page .mvv-page-hero.mvv-form-hero .mvv-breadcrumb span::before {
  content: "›" !important;
  color: #7A6570 !important;
}

main.mvv-signup-page .mvv-section.mvv-auth-visual {
  padding: 64px 0 76px;
  background:
    linear-gradient(90deg, rgba(255,249,240,.99) 0%, rgba(255,249,240,.96) 50%, rgba(255,249,240,.42) 70%, rgba(255,249,240,.06) 100%),
    url('template/assets/images/maratha-wedding-hero.jpg') 68% center / cover no-repeat;
}
main.mvv-signup-page .mvv-auth-visual > .mvv-container {
  width:100%;
  max-width:none;
  padding-left:clamp(12px, 2vw, 32px);
  padding-right:clamp(12px, 2vw, 32px);
}
main.mvv-signup-page .mvv-auth-visual .mvv-form {
  width: min(720px, 66%);
  max-width:720px;
  margin:0 auto 0 0;
  background:rgba(255,255,255,.96);
  box-shadow:0 24px 70px rgba(79,35,25,.16);
  backdrop-filter:blur(10px);
}
@media (max-width: 900px) {
  main.mvv-signup-page .mvv-section.mvv-auth-visual {
    background:
      linear-gradient(rgba(255,249,240,.9), rgba(255,249,240,.97)),
      url('template/assets/images/maratha-wedding-hero.jpg') 72% center / cover no-repeat;
  }
  main.mvv-signup-page .mvv-auth-visual .mvv-form {
    width:100%;
    max-width:720px;
    margin:0 auto;
  }
}
</style>

<main class="mvv-page mvv-signup-page">
  <section class="mvv-section mvv-auth-visual">
    <div class="mvv-container">
      <div id="doberror" class="mvv-field full" style="display:none"><div class="alert" style="background:#dc3545;color:#fff;border-radius:8px;padding:10px 16px;">Select valid Birth Date</div></div>
      <div id="doberror1" class="mvv-field full" style="display:none"></div>
      <div id="doberror2" class="mvv-field full" style="display:none"></div>

      <form method="post" action="#" name="matri" onsubmit="return getage()" class="mvv-form">
        <div class="mvv-eyebrow">Start your journey</div>
        <h2 class="mvv-title" style="font-size:clamp(1.6rem,2.8vw,2.4rem);">तुमची बेसिक माहिती भरा</h2>
        <input type="hidden" name="regno" value="">
        <input type="hidden" name="regdate1" value="<?php echo date('d-m-Y'); ?>">
        <input type="hidden" name="religion" value="">
        <input type="hidden" name="caste" value="">
        <input type="hidden" name="subcaste" value="">
        <input type="hidden" name="maritial_status" value="">

        <div class="mvv-form-grid">
          <div class="mvv-field" style="display:flex;flex-direction:row;align-items:center;gap:16px;border:none;background:transparent;padding:0;margin:0;box-shadow:none;">
            <label style="margin:0;white-space:nowrap;">I'm</label>
            <label class="radio-label" style="margin:0;display:flex;align-items:center;gap:5px;font-weight:500;cursor:pointer;">
              <input type="radio" name="gender" value="Male" tabindex="1" <?php echo ($gender!='Female')?'checked':''; ?>> Man
            </label>
            <label class="radio-label" style="margin:0;display:flex;align-items:center;gap:5px;font-weight:500;cursor:pointer;">
              <input type="radio" name="gender" value="Female" tabindex="2" <?php echo ($gender=='Female')?'checked':''; ?>> Woman
            </label>
          </div>

          <div class="mvv-field">
            <label for="profile_location_type">Profile Location</label>
            <select name="profile_location_type" id="profile_location_type" required tabindex="3">
              <option value="Indian Resident" <?php echo ($profile_location_type ?? 'Indian Resident') === 'Indian Resident' ? 'selected' : ''; ?>>Indian Resident</option>
              <option value="NRI" <?php echo ($profile_location_type ?? '') === 'NRI' ? 'selected' : ''; ?>>NRI / Overseas Profile</option>
            </select>
            <div style="color:var(--mvv-maroon);font-size:0.85rem;margin-top:4px;"><?php echo $profile_location_type_error ?? ''; ?></div>
          </div>

          <div class="mvv-field full" id="emailerror">
            <label>Email Address</label>
            <input type="email" autofocus name="email" placeholder="your@email.com" onBlur="check_exist123(this.value);" value="<?php echo $email;?>" required tabindex="3" maxlength="45" onkeyup="nospaces(this)">
            <div style="color:var(--mvv-maroon);font-size:0.85rem;margin-top:4px;"><?php echo $email_error;?></div>
          </div>

          <div class="mvv-field full">
            <label>Set New Password</label>
            <input type="password" name="pass" placeholder="Minimum 5 characters" maxlength="35" onblur="CheckLengthPassword(this)" id="pass" tabindex="4" value="<?php echo $pass;?>" required>
            <div style="color:var(--mvv-maroon);font-size:0.85rem;margin-top:4px;"><?php echo $pass_error;?></div>
            <div id="passeror" style="display:none;color:#dc3545;font-size:0.85rem;margin-top:4px;">Password is too weak</div>
          </div>

          <div class="mvv-field">
            <label>Candidate Name</label>
            <input type="text" name="fname" placeholder="First & Middle Name" tabindex="5" onKeyPress="return ValidateAlpha(event);" maxlength="35" value="<?php echo $fname;?>" required>
            <div style="color:var(--mvv-maroon);font-size:0.85rem;margin-top:4px;"><?php echo $fname_error;?></div>
          </div>

          <div class="mvv-field">
            <label>Surname</label>
            <input type="text" name="lname" placeholder="Your Surname" tabindex="6" onKeyPress="return ValidateAlpha(event);" maxlength="35" onkeyup="nospaces(this)" value="<?php echo $lname;?>" required>
            <div style="color:var(--mvv-maroon);font-size:0.85rem;margin-top:4px;"><?php echo $lname_error;?></div>
          </div>

          <div class="mvv-field">
            <label>Birth Month</label>
            <select name="dobMonth" tabindex="7" required id="month">
              <?php if(isset($_POST['dobMonth'])){ ?>
              <option value="<?php echo $sMonth;?>" selected><?php echo $sMonth;?></option>
              <?php } ?>
              <option value="">Month</option>
              <option value="1">January</option>
              <option value="2">February</option>
              <option value="3">March</option>
              <option value="4">April</option>
              <option value="5">May</option>
              <option value="6">Jun</option>
              <option value="7">July</option>
              <option value="8">August</option>
              <option value="9">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
            </select>
          </div>

          <div class="mvv-field">
            <label>Birth Day</label>
            <select name="dob" tabindex="8" required id="day">
              <?php if(isset($_POST['dob'])){ ?>
              <option value="<?php echo $sDay;?>" selected><?php echo $sDay;?></option>
              <?php } ?>
              <option value="">Day</option>
              <?php for($d=1;$d<=31;$d++){ ?>
              <option value="<?php echo $d;?>"><?php echo $d;?></option>
              <?php } ?>
            </select>
          </div>

          <div class="mvv-field">
            <label>Birth Year</label>
            <select name="dobYear" tabindex="9" required id="year">
              <?php if(isset($_POST['dobYear'])){ ?>
              <option value="<?php echo $syear;?>" selected><?php echo $syear;?></option>
              <?php } ?>
              <option value="">Year</option>
              <?php $result=mysqli_query($con,"select * from year order by year desc");
              while($row=mysqli_fetch_array($result)){ ?>
              <option value="<?php echo $row['year']?>"><?php echo $row['year']?></option>
              <?php } ?>
            </select>
            <input type="hidden" name="age" id="age" size="25" readonly>
            <input type="hidden" size="4" id="age1" name="age1">
            <div style="color:var(--mvv-maroon);font-size:0.85rem;margin-top:4px;"><?php echo $dob_error;?></div>
          </div>

          <div class="mvv-field full mvv-terms-field">
            <label class="mvv-terms-label">
              <input type="checkbox" name="terms_accepted" value="1" checked required tabindex="10" style="width:18px;height:18px;accent-color:var(--mvv-gold);">
              <span class="mvv-terms-text">By creating an account, you confirm that you have read, understood, and agree to our <a href="terms-conditions" target="_blank" rel="noopener noreferrer">Terms &amp; Conditions</a> and <a href="privacy-policy" target="_blank" rel="noopener noreferrer">Privacy Policy</a>.</span>
            </label>
          </div>

          <div class="full">
            <button class="mvv-btn primary w-100" type="submit" name="submit" tabindex="11"><i class="bi bi-person-plus-fill"></i> Submit Now</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</main>

<script>
$(document).ready(function() {
  $('.mvv-form button[type="submit"]').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="bi bi-arrow-repeat spin"></i> Processing...';
    if ($this.html() !== loadingText) {
      $this.data('original-text', $this.html());
      $this.html(loadingText);
    }
    setTimeout(function() { $this.html($this.data('original-text')); }, 3000);
  });
});
</script>
<?php include('footer3.php'); ?>
