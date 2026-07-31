<?php ob_start();
require_once('sys_dbconnection.php');
include('memprotect1.php');

$profile_id=$_GET['id'];

$hiddenregstep=mysqli_query($con,"select * from register where MatriID='$profile_id'");
$hiddenfetch=mysqli_fetch_array($hiddenregstep);

if (isset($_FILES['fileToUpload1']['name']) && !empty($_FILES['fileToUpload1']['name'])){
$target_dir = "gallary/";
$watermarkImagePath = 'images/watermark.png';
$target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload1']["name"]));
$sav=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload1']["name"]));
$UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["fileToUpload1"]["name"];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$upload_msg = '';
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload1"]["tmp_name"]);
    if($check !== false) {
        $upload_msg = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $upload_msg = "File is not an image.";
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    $upload_msg = "Sorry, file already exists.";
    $uploadOk = 0;
}
if ($_FILES["fileToUpload1"]["size"] > 8097152) {
    $upload_msg = "Sorry, your file is too large.";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "jpeg" ) {
    $upload_msg = "Sorry, only JPG, JPEG files are allowed.";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    /* message already set above */
} else {
    if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file)) {
        mysqli_query($con,"Update register set Photo1='$sav',reg_step='7' where MatriID='$profile_id'");
        mysqli_query($con,"insert into gallary(photo_name,matri_id) values('$sav','$profile_id')");
        header('location:upload_idproof?id='.$profile_id); exit;
    } else {
        $upload_msg = "Sorry, there was an error uploading your file.";
    }
}
}

$siteconfig = $db->get_siteconfig();
?>
<?php $page_title = 'Upload Photo - Shivraj Maratha'; include('header3.php'); ?>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
function showMyImage(fileInput) {
    var oFile = document.getElementById("upload1").files[0];
    if (oFile.size > 3145728) {
        document.getElementById('thumbnil1').style.display='block';
        return;
    }
    document.getElementById('thumbnil').style.display='block';
    document.getElementById('continue123').style.display='block';
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /image.*/;
        if (!file.type.match(imageType)) {
            document.getElementById('thumbnil1').style.display='block';
            document.getElementById('thumbnil').style.display='none';
            continue;
        }
        var img=document.getElementById("thumbnil");
        img.file = file;
        var reader = new FileReader();
        reader.onload = (function(aImg) {
            return function(e) { aImg.src = e.target.result; };
        })(img);
        reader.readAsDataURL(file);
    }
}
function preventBack() { window.history.forward(); }
setTimeout("preventBack()", 0);
window.onunload = function() { null };
</script>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Upload Photo</div>
      <h1>तुमचा फोटो अपलोड करा</h1>
      <p>तुमच्या प्रोफाइलसाठी एक फोटो अपलोड करा</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index">Home</a>
        <span>Upload Photo</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="mvv-form" style="max-width:600px;margin:0 auto;">
        <div class="mvv-eyebox">Photo Upload</div>
        <h2 class="mvv-title" style="font-size:clamp(1.3rem,2.2vw,1.8rem);text-align:center;">तुमचा फोटो अपलोड करा</h2>

        <div style="background:var(--mvv-cream);border:1px solid var(--mvv-border);border-radius:8px;padding:16px;margin-bottom:20px;font-size:0.9rem;color:var(--mvv-muted);">
          <p style="margin:0 0 6px;"><i class="bi bi-check-square-fill" style="color:var(--mvv-gold);margin-right:6px;"></i> All photos uploaded are screened as per Photo Guidelines and 98% of those get activated within an hour.</p>
          <p style="margin:0;"><i class="bi bi-check-square-fill" style="color:var(--mvv-gold);margin-right:6px;"></i> Other ways to upload your photos. E-mail your photos to <?php echo $siteconfig->FeedbackEmail ?? 'info@shivrajmaratha.com'; ?> Mention your Profile ID and Name in the mail.</p>
        </div>

        <?php if ($upload_msg) { ?>
        <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:12px 18px;margin-bottom:20px;text-align:center;">
          <?php echo $upload_msg; ?>
        </div>
        <?php } ?>

        <form method="post" action="#" enctype="multipart/form-data" style="text-align:center;">
          <img src="" style="display:none;border-radius:12px;margin-bottom:20px;max-width:300px;max-height:200px;object-fit:cover;" id="thumbnil">

          <div style="margin-bottom:20px;">
            <label for="upload1" class="mvv-btn mvv-btn-primary" style="display:inline-flex;cursor:pointer;gap:8px;">
              <i class="bi bi-image"></i> Select From Your Device
            </label>
            <input name="fileToUpload1" style="display:none;" id="upload1" type="file" onchange="showMyImage(this);">
          </div>

          <div id="continue123" style="display:none;margin-bottom:16px;">
            <button class="mvv-btn mvv-btn-primary" type="submit" name="submit" style="width:100%;">Continue</button>
          </div>

          <p style="color:#dc3545;font-weight:600;font-size:0.9rem;">Photo Required *</p>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
