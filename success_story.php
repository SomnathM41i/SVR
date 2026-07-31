<?php
require_once('includes/bootstrap.php');
$limit = 6;
$page = isset($_GET["page"]) ? max(1, (int)$_GET["page"]) : 1;
$start_from = ($page - 1) * $limit;
$seo = mysqli_query($con, "SELECT * FROM seo WHERE catagory='happy_story'");
$seof = $seo ? mysqli_fetch_array($seo) : [];
?>
<?php include('header3.php'); ?>

<main id="main">
  <?php $heroHeading='Success Stories';$heroLabel='Success Stories';include('includes/page-hero.php'); ?>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="text-center mb-5">
        <div class="mvv-eyebrow">आनंदी जोडपी</div>
        <h2 class="mvv-title">Manpasand Jodidar families च्या खऱ्या stories</h2>
        <p class="mvv-subtitle">First introduction पासून wedding blessings पर्यंत, या journeys नवीन families ना confidence सोबत पुढे जाण्यास inspire करतात.</p>
      </div>

      <?php
      $sql12 = "SELECT * FROM successstory WHERE approve='Yes' ORDER BY id DESC LIMIT $start_from, $limit";
      $sql1 = "SELECT COUNT(*) FROM successstory WHERE approve='Yes'";
      $rs_result1 = mysqli_query($con, $sql1);
      $row_count = $rs_result1 ? mysqli_fetch_row($rs_result1) : [0];
      $total_records = (int)$row_count[0];
      $total_pages = (int)ceil($total_records / $limit);
      $result1 = mysqli_query($con, $sql12);

      if ($result1 && mysqli_num_rows($result1) > 0) {
      ?>
        <div class="mvv-story-grid">
          <?php while ($aboutfetch = mysqli_fetch_array($result1)) { ?>
            <article class="mvv-story">
              <img src="photoprocess.php?image=success/<?php echo htmlspecialchars($aboutfetch['weddingphoto']); ?>&square=300" alt="<?php echo htmlspecialchars($aboutfetch['bridename']); ?> and <?php echo htmlspecialchars($aboutfetch['groomname']); ?>">
              <div class="mvv-story-body">
                <span class="mvv-tag"><i class="bi bi-calendar-heart-fill"></i><?php echo date('d F Y', strtotime($aboutfetch['marriagedate'])); ?></span>
                <h3><?php echo htmlspecialchars($aboutfetch['bridename']); ?> &amp; <?php echo htmlspecialchars($aboutfetch['groomname']); ?></h3>
                <p>Trusted matrimonial journey मधून दोन families एकत्र आल्या.</p>
                <button type="button" class="mvv-btn maroon mt-3" data-bs-toggle="modal" data-bs-target="#storyModal" data-id="<?php echo htmlspecialchars($aboutfetch['ID']); ?>">
                  <i class="bi bi-heart-eyes"></i> त्यांची Story वाचा
                </button>
              </div>
            </article>
          <?php } ?>
        </div>

        <?php if ($limit < $total_records) { ?>
          <div class="d-flex justify-content-center gap-2 flex-wrap mt-5">
            <?php if ($page > 1) { ?><a href="success_story?page=<?php echo $page - 1; ?>" class="mvv-btn maroon"><i class="bi bi-chevron-left"></i></a><?php } ?>
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
              <a href="success_story?page=<?php echo $i; ?>" class="mvv-btn <?php echo ($i == $page) ? 'primary' : 'maroon'; ?>"><?php echo $i; ?></a>
            <?php } ?>
            <?php if ($page < $total_pages) { ?><a href="success_story?page=<?php echo $page + 1; ?>" class="mvv-btn maroon"><i class="bi bi-chevron-right"></i></a><?php } ?>
          </div>
        <?php } ?>
      <?php } else { ?>
        <div class="mvv-card text-center">
          <span class="mvv-icon"><i class="bi bi-hearts"></i></span>
          <h3>Stories लवकरच येत आहेत</h3>
          <p class="mb-4">आमच्या happy couples च्या stories लवकरच येथे share होतील. आमच्या वाढत्या community चा भाग बना.</p>
          <a href="signup" class="mvv-btn primary"><i class="bi bi-person-plus-fill"></i> तुमचा Profile तयार करा</a>
        </div>
      <?php } ?>
    </div>
  </section>

  <section class="mvv-section alt">
    <div class="mvv-container">
      <div class="mvv-two-col">
        <div>
          <div class="mvv-eyebrow">Family अनुभव</div>
          <h2 class="mvv-title">Meaningful introductions साठी trusted space</h2>
          <p class="mvv-subtitle" style="margin:0; max-width:none;">Families Manpasand Jodidar निवडतात कारण हा experience secure, graceful आणि serious marriage decisions शी well-aligned आहे.</p>
        </div>
        <div class="mvv-card">
          <span class="mvv-icon"><i class="bi bi-chat-heart"></i></span>
          <p>"या platform मुळे आमचा genuine family सोबत contact झाला. Profile details, privacy आणि support मुळे संपूर्ण process सर्वांसाठी सुलभ आणि विश्वासार्ह झाला."</p>
          <h3 class="mt-3">एक आनंदी Member Family</h3>
        </div>
      </div>
    </div>
  </section>
</main>

<div class="modal fade" id="storyModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" id="storyModalContent" style="border-radius:0; overflow:hidden; border:none;">
      <div style="padding:30px; text-align:center; color:var(--mvv-muted);">Story load होत आहे...</div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById('storyModal');
  if (modal) {
    modal.addEventListener('show.bs.modal', function(e) {
      var btn = e.relatedTarget;
      var id = btn.getAttribute('data-id');
      var content = document.getElementById('storyModalContent');
      content.innerHTML = '<div style="padding:40px; text-align:center; color:var(--mvv-muted)"><i class="bi bi-hearts" style="font-size:2rem; color:var(--mvv-gold);"></i><br><br>त्यांची सुंदर story load होत आहे...</div>';
      fetch('modalup_readmore.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'rowid=' + encodeURIComponent(id)
      }).then(function(r) { return r.text(); }).then(function(d) { content.innerHTML = d; });
    });
  }
});
</script>

<?php include('footer3.php'); ?>
