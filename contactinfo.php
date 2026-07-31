<?php
require_once('includes/bootstrap.php');
include_once('memprotect.php');

$result=mysqli_query($con,"SELECT * FROM cms where cms_id='9'");
$rowdata=mysqli_fetch_array($result);?>
<div class="mvv-contact-card">
  <div class="mvv-contact-card-body">
    <h5 style="font-family:'Playfair Display',serif;font-weight:700;color:var(--deep-maroon);margin-bottom:18px;font-size:1.1rem;">
      <i class="bi bi-telephone-fill" style="color:var(--saffron);margin-right:8px;"></i> Contact Us
    </h5>
    <ul style="list-style:none;padding:0;margin:0;">
      <li style="display:flex;gap:12px;margin-bottom:14px;">
        <span style="width:34px;height:34px;flex-shrink:0;background:rgba(201, 85, 106,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--saffron);font-size:0.85rem;">
          <i class="bi bi-telephone-fill"></i>
        </span>
        <div style="font-size:0.9rem;color:var(--text-muted);line-height:1.55;">
          <strong style="color:var(--text-main);display:block;">Call Us</strong>
          <?php echo $rowdata['mobile']; ?><br><?php echo $rowdata['whatsapp']; ?>
        </div>
      </li>
      <li style="display:flex;gap:12px;margin-bottom:14px;">
        <span style="width:34px;height:34px;flex-shrink:0;background:rgba(201, 85, 106,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--saffron);font-size:0.85rem;">
          <i class="bi bi-envelope-fill"></i>
        </span>
        <div style="font-size:0.9rem;color:var(--text-muted);line-height:1.55;">
          <strong style="color:var(--text-main);display:block;">Mail Us</strong>
          <?php echo $rowdata['email']; ?>
        </div>
      </li>
      <li style="display:flex;gap:12px;margin-bottom:14px;">
        <span style="width:34px;height:34px;flex-shrink:0;background:rgba(201, 85, 106,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--saffron);font-size:0.85rem;">
          <i class="bi bi-clock-fill"></i>
        </span>
        <div style="font-size:0.9rem;color:var(--text-muted);line-height:1.55;">
          <strong style="color:var(--text-main);display:block;">Office Time</strong>
          <?php echo $rowdata['officetime']; ?>
        </div>
      </li>
    </ul>
  </div>
</div>
<style>
.mvv-contact-card {
  background: var(--gradient-card);
  border: 1px solid var(--border-warm);
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: var(--shadow-card);
  margin-bottom: 20px;
}
.mvv-contact-card-body {
  padding:0;
}
@media (max-width: 991.98px) {
  .mvv-contact-card { margin-top: 24px; }
}
</style>
