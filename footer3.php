<style>
/* ══════════════════════════════════════════
   SHIVRAJ MARATHA FOOTER — Template-inspired Design
══════════════════════════════════════════ */
.mvv-footer {
  background: #2a1117;
  color: #d8c5c7;
  position: relative;
  overflow: hidden;
  padding-top: 64px;
}
.mvv-footer::before {
  content: 'ॐ';
  position: absolute;
  left: -40px; bottom: -40px;
  font-size: 280px;
  color: rgba(255,255,255,0.025);
  font-family: 'Noto Sans Devanagari', sans-serif;
  pointer-events: none;
  line-height: 1;
}
.mvv-footer::after {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent, var(--mvv-gold, #C9921A), var(--mvv-gold-light, #F0C04A), var(--mvv-gold, #C9921A), transparent);
}

.mvv-footer .container {
  width: min(1180px, calc(100% - 40px));
  margin-inline: auto;
}

.mvv-footer-grid {
  display: grid;
  grid-template-columns: 1.4fr 1fr 1.2fr;
  gap: 48px;
}

/* ─── Brand ─── */
.mvv-footer-brand {
  display: flex;
  align-items: center;
  gap: 11px;
  text-decoration: none;
  margin-bottom: 14px;
}
.mvv-footer-brand img {
  width: clamp(72px, 7vw, 86px);
  height: clamp(72px, 7vw, 86px);
  object-fit: contain;
}
.mvv-footer-brand span {
  display: flex;
  flex-direction: column;
  line-height: 1.2;
}
.mvv-footer-brand b {
  font-family: 'Noto Sans Devanagari', sans-serif;
  color: #fff;
  font-size: clamp(20px, 2vw, 24px);
}
.mvv-footer-brand small {
  font-size: clamp(11px, 1.1vw, 13px);
  color: #cbb9bb;
  letter-spacing: 0.03em;
}

.mvv-footer-desc {
  max-width: 340px;
  font-size: 14px;
  line-height: 1.7;
  color: #d8c5c7;
  margin: 0 0 18px;
}

.mvv-footer-note {
  display: inline-block;
  font-size: 10px;
  letter-spacing: 0.08em;
  color: var(--mvv-gold-light, #F0C04A);
  border: 1px solid rgba(240,192,74,0.3);
  padding: 5px 9px;
  border-radius: 6px;
  font-weight: 600;
  margin-bottom: 18px;
}

/* ─── Social ─── */
.mvv-footer-social {
  display: flex;
  gap: 10px;
  margin-top: 4px;
}
.mvv-social-btn {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(255,255,255,0.7);
  font-size: 15px;
  text-decoration: none;
  background: rgba(255,255,255,0.07);
  border: 1px solid rgba(255,255,255,0.12);
  transition: all 0.25s;
}
.mvv-social-btn:hover {
  background: var(--mvv-saffron, #E8612A);
  border-color: var(--mvv-saffron, #E8612A);
  color: #fff;
  transform: translateY(-3px);
}

/* ─── Columns ─── */
.mvv-footer h3 {
  color: #fff;
  font-size: 15px;
  margin: 0 0 18px;
  font-family: 'Playfair Display', Georgia, serif;
  position: relative;
  padding-bottom: 8px;
}
.mvv-footer h3::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 30px;
  height: 2px;
  background: var(--mvv-gold, #C9921A);
  border-radius: 2px;
}

.mvv-footer-links {
  display: flex;
  flex-direction: column;
  gap: 0;
}
.mvv-footer-links a {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  padding: 5px 0;
  color: #d8c5c7;
  text-decoration: none;
  transition: color 0.2s, padding-left 0.2s;
}
.mvv-footer-links a::before {
  content: '›';
  color: var(--mvv-saffron, #E8612A);
  font-size: 16px;
  line-height: 1;
  font-weight: 700;
}
.mvv-footer-links a:hover {
  color: var(--mvv-gold-light, #F0C04A);
  padding-left: 4px;
}

/* ─── Contact ─── */
.mvv-footer-contact-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  margin-bottom: 14px;
}
.mvv-footer-contact-icon {
  width: 34px;
  height: 34px;
  flex-shrink: 0;
  background: rgba(232,97,42,0.15);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--mvv-saffron, #E8612A);
  font-size: 14px;
}
.mvv-footer-contact-text {
  font-size: 13px;
  color: #d8c5c7;
  line-height: 1.55;
}
.mvv-footer-contact-text a {
  color: #d8c5c7;
  text-decoration: none;
  transition: color 0.2s;
}
.mvv-footer-contact-text a:hover {
  color: var(--mvv-gold-light, #F0C04A);
}

/* ─── Bottom Bar ─── */
.mvv-footer-bottom {
  border-top: 1px solid rgba(255,255,255,0.08);
  margin-top: 48px;
  padding: 20px 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
  color: rgba(255,255,255,0.5);
}
.mvv-footer-bottom-links {
  display: flex;
  gap: 18px;
}
.mvv-footer-bottom-links a {
  color: rgba(255,255,255,0.5);
  text-decoration: none;
  transition: color 0.2s;
  font-size: 12px;
}
.mvv-footer-bottom-links a:hover {
  color: var(--mvv-gold-light, #F0C04A);
}
.mvv-footer-bottom strong {
  color: rgba(255,255,255,0.65);
}

/* ─── Floating Buttons ─── */
.mvv-whatsapp,
.mvv-back-top,
.mvv-translate-toggle {
  position: fixed;
  right: 22px;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  color: #fff;
  z-index: 50;
  box-shadow: 0 8px 28px rgba(0,0,0,0.2);
  border: none;
  cursor: pointer;
  transition: transform 0.25s, box-shadow 0.25s;
  text-decoration: none;
}
.mvv-whatsapp:hover,
.mvv-back-top:hover,
.mvv-translate-toggle:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 36px rgba(0,0,0,0.3);
}
.mvv-whatsapp {
  bottom: 82px;
  background: #25a75c;
  font-size: 24px;
}
.mvv-back-top {
  bottom: 24px;
  background: var(--mvv-maroon, #6B1A1A);
  font-size: 20px;
}
.mvv-translate-widget {
  position: fixed;
  right: 14px;
  bottom: 140px;
  z-index: 80;
}
.mvv-translate-toggle {
  position: relative;
  right: auto;
  width: 68px;
  height: 62px;
  padding: 7px 6px;
  border-radius: 14px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 2px;
  background: linear-gradient(135deg, var(--mvv-gold, #C9921A), #f0bd3d);
  color: var(--mvv-maroon, #6B1A1A);
}
.mvv-translate-toggle i { font-size: 20px; line-height: 1; }
.mvv-translate-label { font-size: 10px; line-height: 1.1; font-weight: 800; text-transform: uppercase; letter-spacing: .03em; }
.mvv-translate-menu {
  position: absolute;
  right: 0;
  bottom: calc(100% + 9px);
  width: 155px;
  display: none;
  padding: 7px;
  border: 1px solid var(--mvv-border, #e0d5cb);
  border-radius: 12px;
  background: #fff;
  box-shadow: 0 14px 38px rgba(58,42,34,.2);
}
.mvv-translate-widget.open .mvv-translate-menu { display: grid; gap: 4px; }
.mvv-translate-menu button {
  display: flex;
  align-items: center;
  gap: 9px;
  width: 100%;
  padding: 9px 10px;
  border: 0;
  border-radius: 8px;
  background: transparent;
  color: #49393a;
  text-align: left;
  font: inherit;
  font-size: 13px;
  cursor: pointer;
}
.mvv-translate-menu button:hover { background: var(--mvv-cream, #FFF8F0); color: var(--mvv-maroon, #6B1A1A); }
.mvv-translate-menu button span { display: grid; place-items: center; width: 25px; height: 25px; border-radius: 50%; background: #fff0e0; font-size: 11px; font-weight: 800; }
#google_translate_element { position: absolute !important; width: 1px !important; height: 1px !important; overflow: hidden !important; opacity: 0 !important; pointer-events: none !important; }
.goog-te-gadget, .goog-logo-link { display: none !important; }

/* ─── Responsive ─── */
@media (max-width: 1000px) {
  .mvv-footer-grid {
    grid-template-columns: 1fr 1fr;
    gap: 36px;
  }
}

@media (max-width: 700px) {
  .mvv-footer { padding-top: 48px; }
  .mvv-footer-grid {
    grid-template-columns: 1fr;
    gap: 28px;
  }
  .mvv-footer-desc { max-width: 100%; }
  .mvv-footer-bottom {
    flex-direction: column;
    gap: 12px;
    text-align: center;
  }
  .mvv-footer-bottom-links {
    flex-wrap: wrap;
    justify-content: center;
  }
  .mvv-whatsapp,
  .mvv-back-top { right: 14px; }
  .mvv-translate-widget { right: 8px; bottom: 140px; }
  .mvv-translate-toggle { width: 60px; height: 58px; }
}

@media (max-width: 480px) {
  .mvv-footer .container { width: min(100% - 28px, 1180px); }
}
</style>

<footer class="mvv-footer">
  <div class="container">
    <div class="mvv-footer-grid">

      <!-- Brand -->
      <div class="mvv-footer-col">
        <a class="mvv-footer-brand" href="index">
          <img src="<?php echo htmlspecialchars($smLogo ?? 'branding/logos/emblem.png', ENT_QUOTES, 'UTF-8'); ?>" alt="Shivraj Maratha Logo" width="86" height="86">
          <span>
            <b>शिवराज मराठा</b>
            <small>वधू वर सूचक केंद्र ®</small>
          </span>
        </a>
        <p class="mvv-footer-desc">
          मराठा समाजासाठी एक विश्वसनीय विवाह माध्यम. योग्य नात्यांची सन्मानपूर्वक सुरुवात.
        </p>
        <span class="mvv-footer-note"><i class="bi bi-shield-check"></i> THIS IS NOT A DATING WEBSITE</span>
        <div class="mvv-footer-social">
          <a class="mvv-social-btn" href="https://www.facebook.com/" target="_blank" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <a class="mvv-social-btn" href="https://www.instagram.com/" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a class="mvv-social-btn" href="https://www.youtube.com/" target="_blank" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
          <a class="mvv-social-btn" href="https://twitter.com/" target="_blank" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="mvv-footer-col">
        <h3>Quick Links</h3>
        <div class="mvv-footer-links">
          <a href="about-us">About Us</a>
          <a href="signup">Enroll Bio Data</a>
          <a href="success_story">Success Stories</a>
          <a href="contactus">Contact Us</a>
        </div>
      </div>

      <!-- Contact -->
      <div class="mvv-footer-col">
        <h3>Contact Us</h3>
        <div class="mvv-footer-contact-item">
          <div class="mvv-footer-contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <div class="mvv-footer-contact-text">Satara, Maharashtra, India</div>
        </div>
        <div class="mvv-footer-contact-item">
          <div class="mvv-footer-contact-icon"><i class="bi bi-telephone-fill"></i></div>
          <div class="mvv-footer-contact-text">
            <a href="tel:+918793641921">(+91) 8793641921</a><br>
            <a href="tel:+917447573787">(+91) 7447573787</a>
          </div>
        </div>
        <div class="mvv-footer-contact-item">
          <div class="mvv-footer-contact-icon"><i class="bi bi-envelope-fill"></i></div>
          <div class="mvv-footer-contact-text">
            <a href="mailto:info@shivrajmaratha.com">info@shivrajmaratha.com</a>
          </div>
        </div>
      </div>

    </div>

    <div class="mvv-footer-bottom">
      <span>
        Copyright &copy; <?php echo date('Y'); ?> by <strong>Shivraj Maratha</strong> &mdash; सर्व हक्क राखीव
      </span>
      <div class="mvv-footer-bottom-links">
        <a href="privacy-policy">Privacy Policy</a>
        <a href="terms-conditions">Terms of Use</a>
        <a href="disclaimer">Disclaimer</a>
      </div>
    </div>
  </div>
</footer>

<!-- Floating Buttons -->
<?php include_once('google_translator.php'); ?>
<a class="mvv-whatsapp" href="https://wa.me/919403550087" target="_blank" aria-label="Chat on WhatsApp"><i class="bi bi-whatsapp"></i></a>
<button class="mvv-back-top" id="mvvBackTop" aria-label="Back to top"><i class="bi bi-chevron-up"></i></button>

<!-- Bootstrap JS -->
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* ══════════════════════════════════════════
   Shivraj Maratha Header & Footer JavaScript
══════════════════════════════════════════ */
(function() {
  'use strict';

  // ─── Header scroll effect ───
  const header = document.getElementById('mvvHeader');
  const topbar = document.querySelector('.mvv-topbar');
  const syncHeader = function() {
    if (!header) return;
    var isMobile = window.innerWidth <= 1050;
    if (isMobile) {
      // Mobile: CSS handles position:fixed, just toggle visual
      header.classList.toggle('scrolled', window.scrollY > 24);
      return;
    }
    // Desktop: use JS to simulate sticky
    var topbarH = (topbar && !isMobile && topbar.offsetHeight > 0) ? topbar.offsetHeight : 0;
    var isPast = window.scrollY > topbarH;
    header.classList.toggle('mvv-sticky', isPast);
    header.classList.toggle('scrolled', window.scrollY > topbarH + 24);
    document.body.classList.toggle('mvv-padded-header', isPast);
  };
  window.addEventListener('scroll', syncHeader, { passive: true });
  syncHeader();

  // ─── Mobile menu toggle ───
  const toggle = document.querySelector('.mvv-menu-toggle');
  const nav = document.querySelector('#mvvMainNav');
  const backdrop = document.querySelector('.mvv-nav-backdrop');

  const setMenu = function(open) {
    if (toggle) toggle.setAttribute('aria-expanded', String(open));
    if (nav) nav.classList.toggle('open', open);
    if (backdrop) backdrop.classList.toggle('open', open);
    document.body.classList.toggle('menu-open', open);
  };

  if (toggle) {
    toggle.addEventListener('click', function() {
      setMenu(toggle.getAttribute('aria-expanded') !== 'true');
    });
  }
  if (backdrop) {
    backdrop.addEventListener('click', function() { setMenu(false); });
  }

  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') setMenu(false);
  });

  if (nav) {
    nav.querySelectorAll('a').forEach(function(link) {
      link.addEventListener('click', function() { setMenu(false); });
    });
  }

  window.addEventListener('resize', function() {
    if (window.innerWidth > 1050) setMenu(false);
    if (window.innerWidth <= 1050) document.body.classList.remove('mvv-padded-header');
    syncHeader();
  }, { passive: true });

  // ─── Mobile dropdown toggle ───
  document.querySelectorAll('.mvv-nav-dropdown > button').forEach(function(btn) {
    btn.addEventListener('click', function() {
      btn.parentElement.classList.toggle('open');
    });
  });

  // ─── Back to top ───
  var backTop = document.getElementById('mvvBackTop');
  if (backTop) {
    backTop.addEventListener('click', function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ─── Scroll reveal animation ───
  var revealObserver = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('revealed');
      }
    });
  }, { threshold: 0.12 });

  document.querySelectorAll('.reveal').forEach(function(el) {
    revealObserver.observe(el);
  });

})();
</script>
<link rel="stylesheet" href="css3/searchable-multiselect.css">
<script src="css3/searchable-multiselect.js"></script>
<script src="js/whatsapp-share.js?v=2"></script>
</body>
</html>
