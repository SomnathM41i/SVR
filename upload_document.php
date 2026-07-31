<?php ob_start();
require_once('sys_dbconnection.php');
include('memprotect1.php');
error_reporting(0);
$login=$_SESSION['MatriID'] ?? null;
$r = mysqli_query($con, "SELECT * FROM register WHERE MatriID='$login'");
$me = mysqli_fetch_array($r);
$regvar = $me['reg_step'];
?>
<?php $page_title = 'Upload Document - Shivraj Maratha'; include('header3.php'); ?>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
function showMyImage(fileInput) {
	var oFile = document.getElementById("upload1").files[0];
	if (oFile.size > 3145728) { document.getElementById('thumbnil1').style.display='block'; return; }
	document.getElementById('thumbnil').style.display='block';
	document.getElementById('continue123').style.display='block';
	document.getElementById('skip1').style.display='none';
	var files = fileInput.files;
	for (var i = 0; i < files.length; i++) {
		var file = files[i];
		var imageType = /image.*/;
		if (!file.type.match(imageType)) { document.getElementById('thumbnil1').style.display='block'; document.getElementById('thumbnil').style.display='none'; continue; }
		var img=document.getElementById("thumbnil");
		img.file = file;
		var reader = new FileReader();
		reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
		reader.readAsDataURL(file);
	}
}
function preventBack() { window.history.forward(); }
setTimeout("preventBack()", 0);
window.onunload = function() { null };
</script>
<style>
.ifile { display:block; width:100%; max-width:100%; padding:10px 0; }
</style>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Document Upload</div>
      <h1>तुमची कागदपत्रे अपलोड करा</h1>
      <p>तुमच्या प्रोफाइलसाठी आवश्यक कागदपत्रे</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index">Home</a>
        <span>Upload Document</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
<?php if(isset($login) && $regvar!='9'){ ?>
      <?php
      $check = $_GET['flag'];
      $msgs = [1=>'File is an image',2=>'File is not an image.',3=>'Sorry, file already exists.',4=>'Sorry, your file is too large.',5=>'Sorry, only JPG, JPEG, PDF and DOC/DOCX files are allowed.',7=>'Sorry, there was an error uploading your file.',8=>'Please Select at Least One Document For Upload.'];
      if(isset($msgs[$check])){
      ?>
      <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:10px 16px;margin-bottom:20px;"><?php echo $msgs[$check]; ?></div>
      <?php } ?>

      <div class="mvv-form">
        <div class="mvv-eyebrow">Upload Documents</div>
        <h2 class="mvv-title" style="font-size:clamp(1.4rem,2.5vw,2rem);">तुमची कागदपत्रे अपलोड करा</h2>
        <p class="mvv-subtitle" style="margin-bottom:24px;">तुमची प्रोफाइल व्हेरिफाय करण्यासाठी खालील कागदपत्रे अपलोड करा</p>

        <form method="post" action="up_doc" enctype="multipart/form-data">
          <div id="thumbnil1" style="display:none;background:rgba(220,53,69,0.1);border:1px solid #dc3545;border-radius:8px;padding:10px;margin-bottom:16px;color:#dc3545;">File size exceeds 3MB limit</div>
          <img src="" style="display:none" id="thumbnil" width="300" height="200" class="mb-3" style="border-radius:8px;">

          <div style="margin-bottom:20px;">
            <span style="font-weight:700;color:var(--mvv-maroon);">Employee</span> — Upload Your Salary Slip
            <input name="uploaded_file1[]" multiple id="upload1" type="file" class="ifile" style="margin-top:6px;">
          </div>

          <div style="margin-bottom:20px;">
            <span style="font-weight:700;color:var(--mvv-maroon);">Business</span> — Upload Your Last Year Income Tax Returns
            <input name="uploaded_file1[]" multiple type="file" class="ifile" style="margin-top:6px;">
          </div>

          <div style="margin-bottom:20px;">
            <span style="font-weight:700;color:var(--mvv-maroon);">Graduation</span> — Upload Your Graduation Certificate
            <input name="uploaded_file1[]" multiple type="file" class="ifile" style="margin-top:6px;">
          </div>

          <div style="margin-bottom:20px;">
            <span style="font-weight:700;color:var(--mvv-maroon);">Post Graduation</span> — Upload Your Post Graduation Certificate
            <input name="uploaded_file1[]" multiple type="file" class="ifile" style="margin-top:6px;">
          </div>

          <div style="margin-bottom:20px;">
            <span style="font-weight:700;color:var(--mvv-maroon);">Any Other Degree</span> — Upload Any Other Degree Certificate
            <input name="uploaded_file1[]" multiple type="file" class="ifile" style="margin-top:6px;">
          </div>

          <input name="matid" type="hidden" value="<?php echo $_GET['id'] ?>">

          <button class="mvv-btn maroon w-100 mt-3" type="submit" name="Continue"><i class="bi bi-upload"></i> Continue</button>
        </form>
      </div>
<?php } else { ?>
      <div style="text-align:center;padding:60px 20px;">
        <i class="bi bi-shield-check" style="font-size:4rem;color:var(--mvv-gold);"></i>
        <h2 class="mvv-title mt-4">Already Completed</h2>
        <p class="mvv-subtitle">तुमची कागदपत्रे आधीच अपलोड झाली आहेत</p>
        <a class="mvv-btn primary mt-4" href="index_dashboard"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
      </div>
<?php } ?>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
<script>
$(document).ready(function() {
  $('.mvv-btn').on('click', function() {
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
