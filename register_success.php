<?php 
require_once('sys_dbconnection.php');
include('memprotect1.php');
$mid=trim((string)($_GET['id'] ?? ''));
if ($mid === '') {
    header('Location: step2?msg=Registration profile was not found');
    exit;
}
if(isset($_POST['submit']))
{
    $update = $con->prepare("UPDATE register SET reg_step='2' WHERE MatriID=?");
    $update->bind_param('s', $mid);
    $update->execute();
	header('location:horoscope?id='.urlencode($mid));
    exit;
}
if(isset($_POST['default']))
{
	header('location:upload_document?id='.urlencode($mid));
    exit;
}

$memberQuery = $con->prepare("SELECT MatriID, Name FROM register WHERE MatriID=? LIMIT 1");
$memberQuery->bind_param('s', $mid);
$memberQuery->execute();
$fetrow = $memberQuery->get_result()->fetch_assoc();
if (!$fetrow) {
    header('Location: step2?msg=Registration profile was not found');
    exit;
}

$page_title = 'Register Success - Shivraj Maratha';
include('header3.php');
?>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
function preventBack() { window.history.forward(); }
setTimeout("preventBack()", 0);
window.onunload = function() { null };
</script>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">नोंदणी यशस्वी</div>
      <h1>तुमचे स्वागत आहे!</h1>
      <p>तुमची प्रोफाइल यशस्वीरीत्या तयार झाली आहे</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index">Home</a>
        <span>Register Success</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="mvv-two-col">
        <div>
          <?php if(empty($_GET['msg'])){ ?>
          <!-- <div style="background:rgba(46,125,50,0.1);color:var(--mvv-green);border-radius:8px;padding:10px 16px;margin-bottom:20px;display:flex;align-items:center;gap:8px;">
            <i class="bi bi-check-circle-fill"></i> OTP Step Verified
          </div> -->
          <?php } ?>
          <div class="mvv-eyebrow">Welcome</div>
          <h2 class="mvv-title"><?php echo $fetrow['MatriID'];?>, <?php echo $fetrow['Name'];?></h2>
          <p class="mvv-subtitle">तुमची प्रोफाइल आता आमच्या टीमद्वारे व्हेरिफाय केली जाईल. कृपया पुढील स्टेप्स पूर्ण करा.</p>
          <div style="background:rgba(212,164,55,0.1);border:1px solid var(--mvv-gold);border-radius:12px;padding:16px;margin:20px 0;">
            <p style="margin:0;"><b>Important:</b> None of the uploaded documents will be visible to your prospects, except for your salary slip that is visible only to Paid members.</p>
          </div>
        </div>

        <div>
          <div style="display:flex;gap:12px;margin-top:24px;flex-wrap:wrap;">
            <form method="post" action="#" style="display:flex;gap:12px;flex-wrap:wrap;width:100%;">
              <!-- <button class="mvv-btn maroon" type="submit" name="default" style="flex:1;"><i class="bi bi-upload"></i> Submit Now</button> -->
              <button class="mvv-btn primary" type="submit" name="submit" style="flex:1;"><i class="bi bi-arrow-right"></i> NEXT</button>
            </form>
          </div>
        </div>
      </div>
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
