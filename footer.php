<?php require_once('includes/bootstrap.php');

//error_reporting(0); 
$login=$_SESSION['MatriID'];
$res=mysqli_query($con,"SELECT * FROM siteconfig");
$row = mysqli_fetch_array($res);
//google translator -->
 $data_config = $db->get_siteconfig();
  $translator_on_off = $data_config-> translator_on_off;
   if( $translator_on_off != 0) { 
  include('google_tran.php');
   } 
   
  // end script-->
?>
    <!-- Main Footer -->
    <!-- <footer class="main-footer style-two">-->
    <!--    <div class="auto-container">-->
            <!-- Footer Content -->
    <!--        <div class="footer-content" style="padding: 25px 0 10px;">-->
    <!--            <div class="footer-logo ftr-dsk-lg"><a href="#"><img src="branding/logos/emblem.png" alt="Site Logo"></a></div>-->
    <!--            <ul class="footer-nav ftr-dsk-mn">-->
				
    <!--                <li><a href="index_dashboard">Home</a></li>-->
    <!--                <li>|</li>-->
				
				<!--   <li><a href="index">Home</a></li>-->
    <!--              <li>|</li>-->
    <!--              <li><a href="signup">SignUp</a></li>-->
    <!--                <li>|</li>-->
				<!--<?php } ?>-->
                    
    <!--                <li><a href="success_story">Happy Story</a></li>-->
    <!--                <li>|</li>-->
    <!-- removed wedding-directory link -->
                    <!--<li>|</li>
					<!--<li><a href="https://readymatrimonial.in/blog/" target=_blank>Blog</a></li>-->
    <!--                <li>|</li>-->
    <!--                <li><a href="contactus">Contact Us</a></li>-->
    <!--            </ul>-->
    <!--             <div class="copyright-text"> &copy; Copyright <?php echo date('Y');?> All Rights Reserved. BY: <a href="#" target="_blank">Manpasand Jodidar</a></div>-->
    <!--            <ul class="social-icon-one">-->
    
    
    
    
    <!--            </ul>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</footer>-->
    <style>
/* ─── FOOTER ─── */
.mvv-footer {
  background: linear-gradient(160deg, #1A0A00 0%, #3D0E0E 50%, #6B1A1A 100%);
  color: #fff;
  position: relative;
  overflow: hidden;
  padding-top: 60px;
}
.mvv-footer::before {
  content: 'ॐ';
  position: absolute;
  left: -40px; bottom: -40px;
  font-size: 260px;
  color: rgba(255,255,255,0.03);
  font-family: 'Noto Sans Devanagari', sans-serif;
  pointer-events: none; line-height: 1;
}
.mvv-footer::after {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--saffron), var(--gold-light), var(--saffron-glow), var(--gold));
}

.footer-brand-logo {
  width: clamp(72px, 7vw, 86px); height: clamp(72px, 7vw, 86px);
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 16px;
}
.footer-brand-logo img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: contain;
}
.footer-brand-name {
  font-family: 'Playfair Display', serif;
  font-size: clamp(1.55rem, 2.2vw, 1.85rem); font-weight: 700;
  color: #fff; margin-bottom: 4px;
}
.footer-brand-sub {
  font-family: 'Noto Sans Devanagari', sans-serif;
  font-size: clamp(.9rem, 1.2vw, 1rem); color: var(--gold-light);
  letter-spacing: 0.06em;
  margin-bottom: 16px;
}
.footer-desc {
  font-size: 0.9rem;
  color: rgba(255,255,255,0.7);
  line-height: 1.75;
  max-width: 360px;
}

.footer-heading {
  font-family: 'Playfair Display', serif;
  font-size: 1.05rem; font-weight: 700;
  color: var(--gold-light);
  margin-bottom: 18px;
  padding-bottom: 8px;
  border-bottom: 1.5px solid rgba(200,130,50,0.3);
}
.footer-links { list-style: none; padding: 0; margin: 0; }
.footer-links li { margin-bottom: 10px; }
.footer-links a {
  color: rgba(255,255,255,0.7);
  text-decoration: none;
  font-size: 0.88rem;
  transition: color 0.2s, padding-left 0.2s;
  display: flex; align-items: center; gap: 8px;
}
.footer-links a::before {
  content: '›';
  color: var(--saffron-light);
  font-size: 1.1rem;
  line-height: 1;
}
.footer-links a:hover { color: var(--gold-light); padding-left: 4px; }

.footer-contact-item {
  display: flex; align-items: flex-start; gap: 12px;
  margin-bottom: 14px;
}
.footer-contact-icon {
  width: 34px; height: 34px; flex-shrink: 0;
  background: rgba(232,97,42,0.18);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  color: var(--saffron-light);
  font-size: 0.85rem;
}
.footer-contact-text {
  font-size: 0.87rem; color: rgba(255,255,255,0.75); line-height: 1.55;
}
.footer-contact-text a { color: rgba(255,255,255,0.75); text-decoration: none; }
.footer-contact-text a:hover { color: var(--gold-light); }

.footer-social { display: flex; gap: 10px; margin-top: 20px; }
.social-btn {
  width: 38px; height: 38px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  color: rgba(255,255,255,0.75);
  font-size: 0.95rem;
  text-decoration: none;
  transition: all 0.25s;
}
.social-btn:hover {
  background: var(--saffron);
  border-color: var(--saffron);
  color: #fff;
  transform: translateY(-3px);
}

.playstore-badge-wrap { margin-top: 20px; }
.playstore-badge { height: 42px; border-radius: 6px; }

.footer-divider {
  border-color: rgba(255,255,255,0.1);
  margin: 40px 0 0;
}
.footer-bottom {
  background: rgba(0,0,0,0.3);
  padding: 16px 0;
}
.footer-bottom-text {
  font-size: 0.82rem;
  color: rgba(255,255,255,0.55);
}
.footer-bottom a {
  color: rgba(255,255,255,0.55);
  text-decoration: none; transition: color 0.2s;
}
.footer-bottom a:hover { color: var(--gold-light); }
</style>

<footer class="mvv-footer">
  <div class="container">
    <div class="row g-5">

      <!-- Brand Col -->
      <div class="col-lg-4 col-md-6">
        <a class="footer-brand-logo" href="index" aria-label="Manpasand Jodidar home">
          <img src="branding/logos/emblem.png" alt="Manpasand Jodidar Logo" width="86" height="86">
        </a>
        <div class="footer-brand-name">Manpasand Jodidar</div>
        <div class="footer-brand-sub">शुभ विवाह • सुयोग्य जीवनसाथी</div>
        <p class="footer-desc">
          Manpasand Jodidar is Maharashtra's most trusted matrimonial platform — 
          connecting verified Manpasand Jodidar families with dignity, tradition, and modern convenience.
        </p>
        <div class="footer-social">
          <a class="social-btn" href="https://www.facebook.com/" target="_blank"><i class="bi bi-facebook"></i></a>
          <a class="social-btn" href="https://www.instagram.com/" target="_blank"><i class="bi bi-instagram"></i></a>
          <a class="social-btn" href="https://www.youtube.com/" target="_blank"><i class="bi bi-youtube"></i></a>
          <a class="social-btn" href="https://twitter.com/" target="_blank"><i class="bi bi-twitter-x"></i></a>
        </div>
        <div class="playstore-badge-wrap">
          <a href="#" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                 alt="Get it on Google Play" class="playstore-badge">
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-2 col-md-6 col-sm-6">
        <h5 class="footer-heading">Quick Links</h5>
        <ul class="footer-links">
          <li><a href="index">Home</a></li>
          <li><a href="about-us">About Us</a></li>
          <li><a href="my_offer">Membership Plans</a></li>
          <li><a href="success_story">Happy Stories</a></li>
          <li><a href="contactus">Contact Us</a></li>
          <li><a href="#">Download App</a></li>
        </ul>
      </div>

      <!-- Legal -->
      <div class="col-lg-2 col-md-6 col-sm-6">
        <h5 class="footer-heading">Legal</h5>
        <ul class="footer-links">
          <li><a href="terms-conditions">Terms of Use</a></li>
          <li><a href="privacy-policy">Privacy Policy</a></li>
          <li><a href="returns-and-cancellation">Refund Policy</a></li>
          <li><a href="disclaimer">Disclaimer</a></li>
          <li><a href="faqs">FAQ's</a></li>
          <li><a href="safematrimony">Safe Matrimony</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="col-lg-4 col-md-6">
        <h5 class="footer-heading">Contact Us</h5>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <div class="footer-contact-text">
            Sky Heights, Office No 202, 2nd Floor,<br>
            Opp Archie's Gallery, Kalyan Station Road,<br>
            Kalyan West, Thane – 421 301, Maharashtra
          </div>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-telephone-fill"></i></div>
          <div class="footer-contact-text">
            <a href="tel:"></a>
          </div>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-envelope-fill"></i></div>
          <div class="footer-contact-text">
            <a href="mailto:info@shivrajmaratha.com">info@shivrajmaratha.com</a>
          </div>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-clock-fill"></i></div>
          <div class="footer-contact-text">Mon – Sat : 10:00 AM – 7:00 PM</div>
        </div>
      </div>

    </div>
  </div>

  <hr class="footer-divider">
  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start">
          <span class="footer-bottom-text">
            Copyright © 2025 <strong style="color:rgba(255,255,255,0.75)">Manpasand Jodidar</strong> · All Rights Reserved
          </span>
        </div>
        <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
          <span class="footer-bottom-text">Powered by <a href="#">Codex Technologies</a></span>
        </div>
      </div>
    </div>
  </div>
</footer>
    <!-- End Footer -->

<script src="css3/assets/js/custom.js"></script>
<link rel="stylesheet" href="css3/searchable-multiselect.css">
<script src="css3/searchable-multiselect.js"></script>
