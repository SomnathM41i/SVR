<?php require_once('sys_dbconnection.php'); 

$message="";
$flag="";
$matriid=$_SESSION['matriid'];
$otp=array($_POST['otp'],$_POST['otp1'],$_POST['otp2'],$_POST['otp3'],$_POST['otp4'],$_POST['otp5']);

$ot=implode($otp);
$code="000777";

if($ot!=NULL && !empty($ot))
{
	if($_SESSION['otp']==$ot || $ot==$code)
	{
		$sql = mysqli_query($con,"SELECT ConfirmEmail FROM register where ConfirmEmail='".$_SESSION['emailtemp']."'");
		if(mysqli_num_rows($sql)==0)
		{
			$sqlmob=mysqli_query($con,"select Mobile FROM register where Mobile='".$_SESSION['mobile']."'");

			if(mysqli_num_rows($sqlmob)==0)
    		{   
				if(mysqli_query($con,$_SESSION['querystr'])!=0)
		    	{
					$lastid=mysqli_insert_id($con);
					mysqli_query($con,$_SESSION['querystr2']);
				    $sql = "SELECT MAX(id) AS max from register";
					$result = mysqli_query($con,$sql) or die(mysqli_error());
					$row = mysqli_fetch_assoc($result);

					$RID = $lastid;

					$respre=mysqli_query($con,'select * from siteconfig');
					$rowpre=mysqli_fetch_array($respre);

					$ch123=$rowpre['prefix'].$RID;
 
					$ch=mysqli_query($con,"select * from deleted_profile where MatriID='$ch123'");

					if(mysqli_num_rows($ch)==0)
					{
    					$rand1=rand(11111,99999);
						if($_SESSION['Gender']=='Male')
						{
						 $mid=$rowpre['prefix'].$rand1;
						}
						else if($_SESSION['Gender']=='Female')
						{
							$mid=$rowpre['prefix'].$rand1;
						}
					}
					else
					{   
					    $rand2=rand(11111,99999);
						$mysqk=mysqli_query($con,"select MAX(id) AS max from deleted_profile");
						$mysqk1=mysqli_fetch_array($mysqk);
						$chek=$mysqk1['max'];
						$new=mysqli_query($con,"select * from deleted_profile where ID='$chek'");
						$new1=mysqli_fetch_array($new);
						$new_id=$new1['ID_reg']+1;
						
						if($_SESSION['Gender']=='Male')
						{
						 $mid=$rowpre['prefix'].$rand2;
						}
						else if($_SESSION['Gender']=='Female')
						{
							$mid=$rowpre['prefix'].$rand2;
						}
					}
				}
				$check=mysqli_query($con,"select * from register where MatriID='$mid'");
			    $check_fetch=mysqli_fetch_array($check);
			    $numrows=mysqli_num_rows($check);
			    if($numrows>0)
			    {
				    $rand2=rand(11111,99999);
				    $mid=$rowpre['prefix'].$rand2; 
				    mysqli_query($con,"update register set MatriID='$mid',Age=DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE,DOB)),'%y') where ID='$lastid'") or die(mysql_error($con));
				}
				else
				{
   					mysqli_query($con,"update register set MatriID='$mid',Age=DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE,DOB)),'%y') where ID='$lastid'") or die(mysql_error($con));
	  			}
				
				$_SESSION['tempid']=$mid;
		        $_SESSION['matriid']=$mid;
$_SESSION['MatriID']=$mid;
				print "<script>";
				print " self.location='admin_mail?id=$mid';";
				print "</script>";
				exit;  
			}
			else
			{
				$url1="signup?mobile=The Mobile Number is already Exists";
		        header('Location:'.$url1);
			}
		}
		else
		{
				$url="signup?error=The email address is already registered";
		        header('Location:'.$url);
		}
	}
	else
	{
		header('Location:verify_otp?msg=flag');
		$message="You have entered Wrong otp. please try again";
	}
}
?>
<?php $page_title = 'OTP Verification - Manpasand Jodidar'; include('header3.php'); ?>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<style>
.digit-group{display:flex;gap:10px;justify-content:center;flex-wrap:wrap;}
.otp{width:52px;height:56px;text-align:center;font-size:24px;font-weight:700;border:2px solid var(--mvv-border);border-radius:10px;background:#fff;color:var(--mvv-text);transition:all 0.22s;}
.otp:focus{border-color:var(--mvv-gold);box-shadow:0 0 0 4px rgba(212,164,55,0.14);outline:none;}
@media (max-width:480px){
  .digit-group{gap:6px;flex-wrap:nowrap;}
  .otp{width:clamp(36px,12vw,46px);min-width:0;height:52px;flex:0 1 46px;}
}
</style>
<script>
function preventBack(){window.history.forward();}
setTimeout("preventBack()",0);
window.onunload=function(){null};
if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}
function isNumber(evt){evt=evt||window.event;var c=evt.which||evt.keyCode;return!(c>31&&(c<48||c>57));}
</script>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Verification</div>
      <h1>OTP Verification</h1>
      <p>कृपया तुमच्या Registered मोबाईल किंवा Email वर पाठवलेला OTP एंटर करा</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index">Home</a>
        <span>OTP Verification</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if($_GET['msg']=="flag"){ ?>
      <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:10px 16px;margin-bottom:20px;text-align:center;">
        Please Enter Correct OTP.
      </div>
      <?php } ?>

      <div style="max-width:560px;margin:0 auto;">
        <div class="mvv-form" style="text-align:center;">
          <div class="mvv-eyebrow">Verify OTP</div>
          <h2 class="mvv-title" style="font-size:clamp(1.4rem,2.5vw,2rem);">One Time Password</h2>
          <p style="margin-bottom:24px;">
            Please Check Your Registered Mail ID: <strong><?php echo $_SESSION['emailtemp'];?></strong><br>
            <strong>(OR)</strong> Mobile Number: <strong><?php echo $_SESSION['mobile'];?></strong><br>
            <span style="font-size:0.85rem;color:var(--mvv-muted);">(Please Hold 5 Minutes.)</span>
          </p>

          <form method="post" action="#" data-group-name="digits" data-autosubmit="false" autocomplete="off">
            <div class="digit-group">
              <input type="password" id="digit-1" name="otp" autofocus data-next="digit-2" class="otp" onkeypress="return isNumber(event)" maxlength="1" required>
              <input type="password" id="digit-2" name="otp1" data-next="digit-3" data-previous="digit-1" class="otp" onkeypress="return isNumber(event)" maxlength="1" required>
              <input type="password" id="digit-3" name="otp2" data-next="digit-4" data-previous="digit-2" class="otp" onkeypress="return isNumber(event)" maxlength="1" required>
              <input type="password" id="digit-4" name="otp3" data-next="digit-5" data-previous="digit-3" class="otp" onkeypress="return isNumber(event)" maxlength="1" required>
              <input type="password" id="digit-5" name="otp4" data-next="digit-6" data-previous="digit-4" class="otp" onkeypress="return isNumber(event)" maxlength="1" required>
              <input type="password" id="digit-6" name="otp5" data-previous="digit-5" class="otp" onkeypress="return isNumber(event)" maxlength="1" required>
            </div>

            <div style="margin-top:24px;">
              <button class="mvv-btn primary w-100" type="submit" name="submit" value="submit"><i class="bi bi-shield-check"></i> Verify OTP</button>
            </div>

            <p style="margin-top:20px;font-size:0.9rem;">
              If You Not Received OTP Then Click On <a href="resend_otp" style="color:var(--mvv-maroon);font-weight:600;">Resend OTP</a>.
            </p>
            <p style="font-size:0.8rem;color:var(--mvv-muted);">
              If you not received, use this Code for OTP: <strong style="color:var(--mvv-gold);">000777</strong>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
<script>
$('.digit-group').find('input').each(function() {
	$(this).attr('maxlength', 1);
	$(this).on('keyup', function(e) {
		var parent = $($(this).parent());
		if(e.keyCode === 8 || e.keyCode === 37) {
			var prev = parent.find('input#' + $(this).data('previous'));
			if(prev.length) { $(prev).select(); }
		} else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
			var next = parent.find('input#' + $(this).data('next'));
			if(next.length) { $(next).select(); }
			else { if(parent.data('autosubmit')) { parent.submit(); } }
		}
	});
});
</script>
