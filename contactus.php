<?php
require_once('includes/bootstrap.php');
$seo = mysqli_query($con, "SELECT * FROM seo WHERE catagory='contact'");
$seof = $seo ? mysqli_fetch_array($seo) : [];
?>
<?php include('header3.php'); ?>

<main id="main">
  <?php $heroHeading='Contact Us';$heroLabel='Contact Us';include('includes/page-hero.php'); ?>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="mvv-contact-grid">
        <div>
          <div class="mvv-contact-card p-4 mb-4">
            <span class="mvv-icon"><i class="bi bi-building"></i></span>
            <h3>Office पत्ता</h3>
            <p>Sky Heights, Office No 202, 2nd Floor,<br>Opp Archie's Gallery, Kalyan Station Road,<br>Kalyan West, Thane - 421 301, Maharashtra, India</p>
          </div>
          <div class="mvv-contact-card p-4 mb-4">
            <span class="mvv-icon"><i class="bi bi-whatsapp"></i></span>
            <h3>WhatsApp मदत</h3>
            <p>Quick registration, profile assistance आणि membership queries साठी आमच्या team सोबत connect करा.</p>
            <a class="mvv-btn primary mt-3" href="https://wa.me/" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp वर बोला</a>
          </div>
          <div class="mvv-contact-card p-4">
            <span class="mvv-icon"><i class="bi bi-clock"></i></span>
            <h3>कामाची वेळ</h3>
            <p>सोमवार - शनिवार<br>10:00 AM - 7:00 PM</p>
          </div>
        </div>

        <form method="post" action="emailsend" id="contact-form" class="mvv-form">
          <div class="mvv-eyebrow">Message पाठवा</div>
          <h2 class="mvv-title" style="font-size:clamp(1.8rem,3vw,2.6rem);">तुमच्या प्रश्नांसाठी आम्ही येथे आहोत</h2>
          <div class="mvv-form-grid">
            <div class="mvv-field">
              <label>तुमचे नाव</label>
              <input type="text" name="name" placeholder="तुमचे नाव टाका" required>
            </div>
            <div class="mvv-field">
              <label>Mobile Number</label>
              <input type="text" name="phone" placeholder="+91 XXXXX XXXXX" required>
            </div>
            <div class="mvv-field">
              <label>तुमचा Email</label>
              <input type="email" name="email" placeholder="your@email.com" required>
            </div>
            <div class="mvv-field">
              <label>विषय</label>
              <input type="text" name="subject" placeholder="आम्ही कशी मदत करू शकतो?" required>
            </div>
            <div class="mvv-field full">
              <label>संदेश</label>
              <textarea name="message" rows="6" placeholder="तुमचा message इथे लिहा..."></textarea>
            </div>
            <div class="full">
              <button type="submit" class="mvv-btn maroon w-100"><i class="bi bi-send-fill"></i> Message पाठवा</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <section class="mvv-section alt">
    <div class="mvv-container">
      <div class="mvv-two-col">
        <div>
          <div class="mvv-eyebrow">संपर्क माहिती</div>
          <h2 class="mvv-title">आमच्या office ला भेट द्या किंवा team ला लिहा</h2>
          <ul class="mvv-feature-list">
            <li><i class="bi bi-geo-alt-fill"></i>Sky Heights, Office No 202, Kalyan West, Thane, Maharashtra</li>
            <li><i class="bi bi-envelope-fill"></i><a href="mailto:info@shivrajmaratha.com">info@shivrajmaratha.com</a></li>
            <li><i class="bi bi-clock-fill"></i>सोमवार - शनिवार, 10:00 AM - 7:00 PM</li>
          </ul>
          <a href="https://www.google.com/maps/place/Weddings+Parampara+Matrimony/@19.2360078,73.1254566,17z" class="mvv-btn primary" target="_blank"><i class="bi bi-map-fill"></i> Directions पहा</a>
        </div>
        <div class="mvv-map">
          <div>
            <i class="bi bi-geo-alt-fill" style="font-size:3rem;color:var(--mvv-gold);"></i>
            <h3 class="mt-3">Google Map</h3>
            <p>Kalyan West, Thane मधील आमचे office location</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
