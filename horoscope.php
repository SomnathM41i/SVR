<?php
ob_start();
require_once('includes/bootstrap.php');
include('memprotect1.php');
$login=$_SESSION['MatriID'] ?? null;
$mid=$_GET['id'] ?? null;
$var = '';
$memberQuery = $con->prepare("SELECT * FROM register WHERE MatriID=? LIMIT 1");
$memberQuery->bind_param('s', $login);
$memberQuery->execute();
$me = $memberQuery->get_result()->fetch_assoc();
if (!$me) {
  header('Location: login');
  exit;
}
$regvar = $me['reg_step'] ?? '';
$page_title = 'Horoscope - Shivraj Maratha';
include('header3.php');
?>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
function preventBack(){window.history.forward();}
setTimeout("preventBack()",0);
window.onunload=function(){null};
function nospaces(t){if(t.value.match(/\s/g)){alert('Sorry, you are not allowed to enter any spaces');t.value=t.value.replace(/\s/g,'');}}
function ValidateAlpha(evt){var k=(evt.which)?evt.which:evt.keyCode;return!((k<65||k>90)&&(k<97||k>123)&&k!=32);}
function blockSpecialChar(e){var k;document.all?k=e.keyCode:k=e.which;return((k>64&&k<91)||(k>96&&k<123)||k==8||k==32||(k>=48&&k<=57));}
</script>
<style>
.labcss{margin-top:18px;height:37px;font-size:14px;}
.horoTime{min-width:80px;}
@media screen and (max-width:768px){.horoTime{width:100%;min-width:0;}}
</style>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">जन्म कुंडली</div>
      <h1>Horoscope Information</h1>
      <p>तुमची जन्म कुंडली आणि आध्यात्मिक माहिती भरा</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index">Home</a>
        <span>Horoscope</span>
      </nav>
      <?php if (($regvar ?? '') == '9') { ?>
      <div class="mvv-dashboard-return-row"><a class="mvv-dashboard-return" href="index_dashboard"><i class="fas fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a></div>
      <?php } ?>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if(isset($_GET['message']) && $_GET['message']!=''){ ?>
      <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:10px 16px;margin-bottom:20px;">
        <?php
        $msgs = [
          'update1'=>'File is an image',
          'update2'=>'File is not an image',
          'update3'=>'Sorry, file already exists.',
          'update4'=>'Sorry, your file is too large.',
          'update5'=>'Sorry, only JPG, JPEG files are allowed.',
          'update6'=>'Sorry, only JPG, JPEG files are allowed.',
          'update7'=>'Your file And Details Updated Successfully.',
          'update8'=>'Sorry, there was an error uploading your file.',
          'update9'=>'Your Details Updated Successfully.',
          'flag'=>'Please Select Atleast One Value For Upload.'
        ];
        echo isset($msgs[$_GET['message']]) ? $msgs[$_GET['message']] : '';
        ?>
      </div>
      <?php } elseif($me['HorosApprove'] == 'Rejected'){ ?>
      <div style="background:#dc3545;color:#fff;border-radius:8px;padding:10px 16px;margin-bottom:20px;">Your Horoscope Is Rejected By Admin.</div>
      <?php } elseif($me['HorosApprove'] == "Yes"){ ?>
      <div style="background:rgba(46,125,50,0.1);color:var(--mvv-green);border-radius:8px;padding:10px 16px;margin-bottom:20px;">Your Horoscope Is Approved By Admin.</div>
      <?php } ?>

<?php
if(isset($_POST['submit']))
{
	$ID=$_GET['id'];
	$horodate=date('d-m-Y');
	$gothra = $db->setfilter($_POST['gothra']);
	$star = $db->setfilter($_POST['star']);
	$moonsign = $db->setfilter($_POST['moonsign']);
	$charan = $db->setfilter($_POST['charan']);
	$gan = $db->setfilter($_POST['gan']);
	$nadi= $db->setfilter($_POST['nadi']);
	$devak= $db->setfilter($_POST['devak']);
	$hmatch= $db->setfilter($_POST['hmatch']);
	$manglik= $db->setfilter($_POST['manglik']);
	$bcountry= $db->setfilter($_POST['bcountry']);
	$bplace=ucfirst($_POST['bplace']);
	$btime=$_POST['bhour'].":".$_POST['bminute'].":".$_POST['bsecond'].":".$_POST['bampm'];
if(isset($login) && $regvar=='9')
{
	if (isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name']))
	{
		$target_dir = "kundli/";
		$target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload']["name"]));
		$sav=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload']["name"]));
		$UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["fileToUpload"]["name"];
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		mysqli_query($con,"update register set Gothram='$gothra',Star='$star',Moonsign='$moonsign',charan='$charan',Gan='$gan',nadi='$nadi',devak='$devak',Horosmatch='$hmatch',Manglik='$manglik',POB='$bplace',TOB='$btime',POC='$bcountry',horodate='$horodate' where MatriID='$login'");
		if(isset($_POST["submit"])){ $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]); }
		if (file_exists($target_file)) { header('location:horoscope?message=update3'); $uploadOk = 0; }
		if ($_FILES["fileToUpload"]["size"] > 8097152) { header('location:horoscope?message=update4'); $uploadOk = 0; }
		if($imageFileType != "jpg" && $imageFileType != "jpeg" ) { $uploadOk = 0; header('location:horoscope?message=update5'); }
		if ($uploadOk == 0) { header('location:horoscope?message=update6'); }
		else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				mysqli_query($con,"update register set Gothram='$gothra',Star='$star',Moonsign='$moonsign',charan='$charan',Gan='$gan',nadi='$nadi',devak='$devak',Horosmatch='$hmatch',Manglik='$manglik',POB='$bplace',TOB='$btime',POC='$bcountry',horoscope='$sav',HorosApprove='No',horodate='$horodate' where MatriID='$login'");
				header('Location: index_dashboard');
				exit;
			} else { header('location:horoscope?message=update8'); }
		}
	}
	else
	{
		if(( $me['Gothram'] == $gothra ) && ( $me['Star'] == $star ) && ( $me['Moonsign'] == $moonsign ) && ( $me['charan'] == $charan ) && ( $me['Gan'] == $gan ) && ( $me['nadi'] == $nadi ) && ( $me['devak'] == $devak ) && ( $me['Horosmatch'] == $hmatch ) && ( $me['Manglik'] == $manglik ) && ( $me['POB'] == $bplace ) && ( $me['TOB'] == $btime ) && ( $me['POC'] == $bcountry ) && ( $me['horodate'] == $horodate ) )
		{ header('Location: index_dashboard'); exit; }
		else
		{ mysqli_query($con,"update register set Gothram='$gothra',Star='$star',Moonsign='$moonsign',charan='$charan',Gan='$gan',nadi='$nadi',devak='$devak',Horosmatch='$hmatch',Manglik='$manglik',POB='$bplace',TOB='$btime',POC='$bcountry',horodate='$horodate' where MatriID='$login'");
		header('Location: index_dashboard'); exit; }
	}
}
else
{
	if (isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name']))
	{
		$target_dir = "kundli/";
		$target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload']["name"]));
		$sav=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload']["name"]));
		$UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["fileToUpload"]["name"];
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		mysqli_query($con,"update register set Gothram='$gothra',Star='$star',Moonsign='$moonsign',charan='$charan',Gan='$gan',nadi='$nadi',devak='$devak',Horosmatch='$hmatch',Manglik='$manglik',POB='$bplace',TOB='$btime',POC='$bcountry',horodate='$horodate',reg_step='3' where MatriID='$ID'");
		if(isset($_POST["submit"])){ $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]); }
		if (file_exists($target_file)) { header("location:horoscope?id=$ID&message=update3"); $uploadOk = 0; }
		if ($_FILES["fileToUpload"]["size"] > 8097152) { header("location:horoscope?id=$ID&message=update4"); $uploadOk = 0; }
		if($imageFileType != "jpg" && $imageFileType != "jpeg" ) { $uploadOk = 0; header("location:horoscope?id=$ID&message=update5"); }
		if ($uploadOk == 0) { header("location:horoscope?id=$ID&message=update6"); }
		else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				mysqli_query($con,"update register set Gothram='$gothra',Star='$star',Moonsign='$moonsign',charan='$charan',Gan='$gan',nadi='$nadi',devak='$devak',Horosmatch='$hmatch',Manglik='$manglik',POB='$bplace',TOB='$btime',POC='$bcountry',reg_step='3',horoscope='$sav',HorosApprove='No',horodate='$horodate' where MatriID='$ID'");
				header('location:contact?id='.$ID);
			} else { header("location:horoscope?id=$ID&message=update8"); }
		}
	}
	else
	{
		mysqli_query($con,"update register set Gothram='$gothra',Star='$star',Moonsign='$moonsign',charan='$charan',Gan='$gan',nadi='$nadi',devak='$devak',Horosmatch='$hmatch',Manglik='$manglik',POB='$bplace',TOB='$btime',POC='$bcountry',reg_step='3',horodate='$horodate' where MatriID='$ID'");
		header('Location: contact?id='.$ID);
	}
}
}
?>

      <div class="mvv-form">
        <div class="mvv-eyebrow">Horoscope Details</div>
        <h2 class="mvv-title" style="font-size:clamp(1.4rem,2.5vw,2rem);">तुमची जन्म कुंडली माहिती</h2>

<?php if(isset($login) && $regvar=='9'){ ?>
        <form method="post" action="#" enctype="multipart/form-data">
          <div class="mvv-form-grid">
            <div class="mvv-field"><label>Moonsign</label>
              <select name="moonsign" tabindex="1">
                <?php if($me['Moonsign']==""){ ?><option value="">Select Moonsign</option>
                <?php }else{ ?><option value="<?php echo $me['Moonsign']?>" selected><?php echo $me['Moonsign']?></option><?php } ?>
                <?php $nakshatrasql=mysqli_query($con,"select * from moon_sign where status='enable'");
                while($nakshatrarow=mysqli_fetch_array($nakshatrasql)){ ?>
                <option value="<?php echo $nakshatrarow['Moon_Sign'];?>"><?php echo $nakshatrarow['Moon_Sign'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Nakshatra</label>
              <select name="star" tabindex="2">
                <?php if($me['Star']==""){ ?><option value="">Select Nakshatra</option>
                <?php }else{ ?><option value="<?php echo $me['Star']?>" selected><?php echo $me['Star']?></option><?php } ?>
                <?php $nakshatrasql=mysqli_query($con,"select * from nakshatra where status='enable'");
                while($nakshatrarow=mysqli_fetch_array($nakshatrasql)){ ?>
                <option value="<?php echo $nakshatrarow['Nakshatra'];?>"><?php echo $nakshatrarow['Nakshatra'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Gothra</label>
              <input type="text" placeholder="Gothra" name="gothra" maxlength="20" onKeyPress="return ValidateAlpha(event);" tabindex="3" value="<?php echo $me['Gothram']?>">
            </div>
            <div class="mvv-field"><label>Manglik</label>
              <select name="manglik" tabindex="4">
                <?php if($me['Manglik']==""){ ?><option value="">Select Manglik</option>
                <?php }else{ ?><option value="<?php echo $me['Manglik']?>" selected><?php echo $me['Manglik']?></option><?php } ?>
                <?php $manglik=mysqli_query($con,"select * from manglik where type!='".$row['Manglik']."'");
                while($fect=mysqli_fetch_array($manglik)){ ?>
                <option value="<?php echo $fect['type']?>"><?php echo $fect['type']?></option><?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Nadi</label>
              <select name="nadi" tabindex="5">
                <option value="">Select Nadi</option>
                <?php foreach (['Aadi', 'Madhya', 'Antya'] as $nadiOption) { ?>
                <option value="<?php echo $nadiOption; ?>"<?php echo ($me['nadi'] ?? '') === $nadiOption ? ' selected' : ''; ?>><?php echo $nadiOption; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Devak</label>
              <input class="preserve-text" type="text" name="devak" tabindex="6" maxlength="100" placeholder="Enter Devak" value="<?php echo htmlspecialchars($me['devak'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="mvv-field"><label>Horoscope Match</label>
              <select name="hmatch" tabindex="7">
                <?php if($me['Horosmatch']==""){ ?><option value="">Select Horoscope Match</option>
                <?php }else{ ?><option value="<?php echo $me['Horosmatch']?>" selected><?php echo $me['Horosmatch']?></option><?php } ?>
                <?php $horoscopeMatches=mysqli_query($con,"select * from horoscope_match where type!='".$row['Horosmatch']."'");
                while($fect=mysqli_fetch_array($horoscopeMatches)){ ?>
                <option value="<?php echo $fect['type']?>"><?php echo $fect['type']?></option><?php } ?>
              </select>
            </div>
            <?php $tm1="ok"; if($me['TOB']!="") $tm=explode(":",$me['TOB']); else $tm1=""; ?>
            <div class="mvv-field"><label>Birth Hour</label>
              <select name="bhour" tabindex="7">
                <?php if(($tm1=="")||($tm[0]=="")){ ?><option value="">Hours</option><?php } else { ?><option selected value="<?php echo $tm[0];?>"><?php echo $tm[0];?></option><?php } ?>
                <?php for($i=1;$i<=12;$i++){ ?><option value="<?php echo $i?>"><?php echo $i?></option><?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Birth Minute</label>
              <select name="bminute" tabindex="8">
                <?php if(($tm1=="")||($tm[1]=="")){ ?><option value="">Minutes</option><?php } else { ?><option selected value="<?php echo $tm[1];?>"><?php echo $tm[1];?></option><?php } ?>
                <?php for($i=1;$i<=59;$i++){ ?><option value="<?php echo $i?>"><?php echo $i?></option><?php } ?>
                <option value="00">00</option>
              </select>
            </div>
            <div class="mvv-field"><label>Birth Second</label>
              <select name="bsecond" tabindex="9">
                <?php if(($tm1=="")||($tm[2]=="")){ ?><option value="">Seconds</option><?php } else { ?><option selected value="<?php echo $tm[2];?>"><?php echo $tm[2];?></option><?php } ?>
                <?php for($i=1;$i<=59;$i++){ ?><option value="<?php echo $i?>"><?php echo $i?></option><?php } ?>
                <option value="00">00</option>
              </select>
            </div>
            <div class="mvv-field"><label>AM/PM</label>
              <select name="bampm" tabindex="10">
                <?php if($tm[3]==""){ ?><option value="">AM/PM</option><?php } else { ?><option value="<?php echo $tm[3];?>" selected><?php echo $tm[3];?></option><?php } ?>
                <?php $birthampm=mysqli_query($con,"select * from brithampm where birthampm!='".$tm[3]."'");
                while($ampm=mysqli_fetch_array($birthampm)){ ?>
                <option value="<?php echo $ampm['birthampm']?>"><?php echo $ampm['birthampm']?></option><?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Place of Birth</label>
              <input type="text" tabindex="11" maxlength="30" placeholder="Enter Place of Birth" name="bplace" onKeyPress="return ValidateAlpha(event);" value="<?php echo $me['POB']?>">
            </div>
            <div class="mvv-field"><label>Country</label>
              <input type="text" tabindex="12" maxlength="30" placeholder="Enter Country" name="bcountry" onKeyPress="return ValidateAlpha(event);" value="<?php echo $me['POC']?>">
            </div>
            <div class="mvv-field" style="border:none;background:transparent;box-shadow:none;padding:0;">
              <?php if($me['horoscope']!=''){ ?>
              <label>Uploaded Horoscope</label>
              <div style="display:flex;align-items:center;gap:10px;">
                <img src="kundli/<?php echo $me['horoscope'];?>" style="height:50px;width:50px;border-radius:8px;object-fit:cover;">
                <a href="kundli/<?php echo $me['horoscope'];?>" target="_blank" style="color:var(--mvv-maroon);">View</a> |
                <a href="horodelete.php?id=<?php echo $me['MatriID'];?>" onclick="return confirm('Are You Really Want To Delete?')" style="color:#dc3545;">Delete</a>
              </div>
              <?php } else { ?>
              <label>Upload Horoscope</label>
              <input name="fileToUpload" id="upload1" type="file" tabindex="13">
              <span style="font-size:0.8rem;color:var(--mvv-muted);">Upload Your Horoscope Photograph</span>
              <?php } ?>
            </div>
            <div class="full">
              <button class="mvv-btn maroon w-100" type="submit" name="submit" tabindex="14"><i class="bi bi-check-circle-fill"></i> Update</button>
            </div>
          </div>
        </form>

<?php } else { ?>
        <form method="post" action="#" enctype="multipart/form-data">
          <div class="mvv-form-grid">
            <div class="mvv-field"><label>Moonsign</label>
              <select name="moonsign" autofocus tabindex="1">
                <?php if($me['Moonsign']==""){ ?><option value="">Select Moonsign</option>
                <?php }else{ ?><option value="<?php echo $me['Moonsign']?>" selected><?php echo $me['Moonsign']?></option><?php } ?>
                <?php $nakshatrasql=mysqli_query($con,"select * from moon_sign where status='enable'");
                while($nakshatrarow=mysqli_fetch_array($nakshatrasql)){ ?>
                <option value="<?php echo $nakshatrarow['Moon_Sign'];?>"><?php echo $nakshatrarow['Moon_Sign'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Nakshatra</label>
              <select name="star" tabindex="2">
                <?php if($me['Star']==""){ ?><option value="">Select Nakshatra</option>
                <?php }else{ ?><option value="<?php echo $me['Star']?>" selected><?php echo $me['Star']?></option><?php } ?>
                <?php $nakshatrasql=mysqli_query($con,"select * from nakshatra where status='enable'");
                while($nakshatrarow=mysqli_fetch_array($nakshatrasql)){ ?>
                <option value="<?php echo $nakshatrarow['Nakshatra'];?>"><?php echo $nakshatrarow['Nakshatra'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Gothra</label>
              <input type="text" placeholder="Enter Gothra" maxlength="20" name="gothra" onKeyPress="return ValidateAlpha(event);" tabindex="3" value="<?php echo $me['Gothram']?>">
            </div>
            <div class="mvv-field"><label>Manglik</label>
              <select name="manglik" tabindex="4">
                <?php if($me['Manglik']==""){ ?><option value="">Select Manglik</option>
                <?php }else{ ?><option value="<?php echo $me['Manglik']?>" selected><?php echo $me['Manglik']?></option><?php } ?>
                <?php $manglik=mysqli_query($con,"select * from manglik where type!='".$row['Manglik']."'");
                while($fect=mysqli_fetch_array($manglik)){ ?>
                <option value="<?php echo $fect['type']?>"><?php echo $fect['type']?></option><?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Nadi</label>
              <select name="nadi" tabindex="5">
                <option value="">Select Nadi</option>
                <?php foreach (['Aadi', 'Madhya', 'Antya'] as $nadiOption) { ?>
                <option value="<?php echo $nadiOption; ?>"<?php echo ($me['nadi'] ?? '') === $nadiOption ? ' selected' : ''; ?>><?php echo $nadiOption; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Devak</label>
              <input class="preserve-text" type="text" name="devak" tabindex="6" maxlength="100" placeholder="Enter Devak" value="<?php echo htmlspecialchars($me['devak'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="mvv-field"><label>Horoscope Match</label>
              <select name="hmatch" tabindex="7">
                <?php if($me['Horosmatch']==""){ ?><option value="">Select Horoscope Match</option>
                <?php }else{ ?><option value="<?php echo $me['Horosmatch']?>" selected><?php echo $me['Horosmatch']?></option><?php } ?>
                <?php $horoscopeMatches=mysqli_query($con,"select * from horoscope_match where type!='".$row['Horosmatch']."'");
                while($fect=mysqli_fetch_array($horoscopeMatches)){ ?>
                <option value="<?php echo $fect['type']?>"><?php echo $fect['type']?></option><?php } ?>
              </select>
            </div>
            <?php $tm1="ok"; if($me['TOB']!="") $tm=explode(":",$me['TOB']); else $tm1=""; ?>
            <div class="mvv-field"><label>Birth Hour</label>
              <select name="bhour" tabindex="7">
                <?php if($tm1==""){ ?><option value="">Hours</option><?php } else { ?><option selected value="<?php echo $tm[0];?>"><?php echo $tm[0];?></option><?php } ?>
                <?php for($i=1;$i<=12;$i++){ ?><option value="<?php echo $i?>"><?php echo $i?></option><?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Birth Minute</label>
              <select name="bminute" tabindex="8">
                <?php if($tm1==""){ ?><option value="">Minutes</option><?php } else { ?><option selected value="<?php echo $tm[1];?>"><?php echo $tm[1];?></option><?php } ?>
                <?php for($i=1;$i<=59;$i++){ ?><option value="<?php echo $i?>"><?php echo $i?></option><?php } ?>
                <option value="00">00</option>
              </select>
            </div>
            <div class="mvv-field"><label>Birth Second</label>
              <select name="bsecond" tabindex="9">
                <?php if($tm1==""){ ?><option value="">Seconds</option><?php } else { ?><option selected value="<?php echo $tm[2];?>"><?php echo $tm[2];?></option><?php } ?>
                <?php for($i=1;$i<=59;$i++){ ?><option value="<?php echo $i?>"><?php echo $i?></option><?php } ?>
                <option value="00">00</option>
              </select>
            </div>
            <div class="mvv-field"><label>AM/PM</label>
              <select name="bampm" tabindex="10">
                <?php if($tm[3]==""){ ?><option value="">AM/PM</option><?php } else { ?><option value="<?php echo $tm[3];?>" selected><?php echo $tm[3];?></option><?php } ?>
                <?php $birthampm=mysqli_query($con,"select * from brithampm where birthampm!='".$tm[3]."'");
                while($ampm=mysqli_fetch_array($birthampm)){ ?>
                <option value="<?php echo $ampm['birthampm']?>"><?php echo $ampm['birthampm']?></option><?php } ?>
              </select>
            </div>
            <div class="mvv-field"><label>Place of Birth</label>
              <input type="text" tabindex="11" maxlength="30" placeholder="Enter Place of Birth" name="bplace" onKeyPress="return ValidateAlpha(event);" value="<?php echo $me['POB']?>">
            </div>
            <div class="mvv-field"><label>Country</label>
              <input type="text" tabindex="12" maxlength="30" placeholder="Enter Country" name="bcountry" onKeyPress="return ValidateAlpha(event);" value="<?php echo $me['POC']?>">
            </div>
            <div class="mvv-field" style="border:none;background:transparent;box-shadow:none;padding:0;">
              <label>Upload Horoscope</label>
              <input name="fileToUpload" id="upload1" type="file" tabindex="13">
              <span style="font-size:0.8rem;color:var(--mvv-muted);">Upload Your Horoscope Photograph</span>
            </div>
            <div class="full">
              <button class="mvv-btn maroon w-100" type="submit" name="submit" tabindex="14"><i class="bi bi-check-circle-fill"></i> Submit Now</button>
            </div>
          </div>
        </form>
<?php } ?>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
<script>
$('input:not(.preserve-text)').on('input', function(){ this.value = this.value.replace(/[^\w]/g,""); });
</script>
