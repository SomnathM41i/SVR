<style>
/* ══════════════════════════════════════════
   MANPASAND JODIDAR — Footer
═══════════════════════════════════════════ */
.mj-footer {
  background: linear-gradient(160deg, #1A0510 0%, #2D0A1F 40%, #3D1028 100%);
  color: rgba(255,255,255,0.75);
  position: relative;
  overflow: hidden;
  padding-top: 60px;
}

.mj-footer::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent, var(--mj-accent), var(--mj-secondary), var(--mj-accent), transparent);
}

.mj-footer::after {
  content: '';
  position: absolute;
  right: -60px; bottom: -60px;
  width: 300px; height: 300px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(233,78,119,0.08), transparent 70%);
  pointer-events: none;
}

.mj-footer .container {
  width: min(1200px, calc(100% - 40px));
  margin-inline: auto;
}

.mj-footer-grid {
  display: grid;
  grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
  gap: 44px;
}

/* ─── Brand ─── */
.mj-footer-brand {
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
  margin-bottom: 16px;
}

.mj-footer-brand img {
  width: 64px;
  height: 64px;
  object-fit: contain;
  border-radius: 12px;
}

.mj-footer-brand span {
  display: flex;
  flex-direction: column;
  line-height: 1.2;
}

.mj-footer-brand b {
  font-family: var(--mj-font-heading);
  color: #fff;
  font-size: 18px;
  font-weight: 800;
}

.mj-footer-brand small {
  font-family: var(--mj-font-devanagari);
  font-size: 11px;
  color: var(--mj-accent-light);
  letter-spacing: 0.04em;
  font-weight: 500;
}

.mj-footer-desc {
  max-width: 340px;
  font-size: 0.88rem;
  line-height: 1.75;
  color: rgba(255,255,255,0.65);
  margin: 0 0 18px;
}

.mj-footer-note {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 0.68rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--mj-accent-light);
  border: 1px solid rgba(200,155,60,0.3);
  padding: 5px 12px;
  border-radius: var(--mj-radius-pill);
  font-weight: 700;
  margin-bottom: 18px;
  background: rgba(200,155,60,0.08);
}

/* ─── Social ─── */
.mj-footer-social {
  display: flex;
  gap: 10px;
  margin-top: 16px;
}

.mj-social-btn {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(255,255,255,0.65);
  font-size: 15px;
  text-decoration: none;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.1);
  transition: all 0.3s var(--mj-ease);
}

.mj-social-btn:hover {
  background: var(--mj-secondary);
  border-color: var(--mj-secondary);
  color: #fff;
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(233,78,119,0.3);
}

/* ─── Columns ─── */
.mj-footer h4 {
  font-family: var(--mj-font-heading);
  color: #fff;
  font-size: 0.92rem;
  margin: 0 0 18px;
  font-weight: 700;
  position: relative;
  padding-bottom: 10px;
}

.mj-footer h4::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 30px;
  height: 2px;
  background: linear-gradient(90deg, var(--mj-secondary), var(--mj-accent));
  border-radius: 2px;
}

.mj-footer-links {
  display: flex;
  flex-direction: column;
  gap: 0;
}

.mj-footer-links a {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.85rem;
  padding: 6px 0;
  color: rgba(255,255,255,0.65);
  text-decoration: none;
  transition: all 0.2s;
}

.mj-footer-links a::before {
  content: '›';
  color: var(--mj-secondary);
  font-size: 16px;
  line-height: 1;
  font-weight: 700;
}

.mj-footer-links a:hover {
  color: var(--mj-accent-light);
  padding-left: 4px;
}

/* ─── Contact ─── */
.mj-footer-contact-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  margin-bottom: 14px;
}

.mj-footer-contact-icon {
  width: 34px;
  height: 34px;
  flex-shrink: 0;
  background: rgba(233,78,119,0.12);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--mj-secondary-light);
  font-size: 14px;
}

.mj-footer-contact-text {
  font-size: 0.85rem;
  color: rgba(255,255,255,0.65);
  line-height: 1.6;
}

.mj-footer-contact-text a {
  color: rgba(255,255,255,0.65);
  text-decoration: none;
  transition: color 0.2s;
}

.mj-footer-contact-text a:hover {
  color: var(--mj-accent-light);
}

/* ─── Newsletter ─── */
.mj-footer-newsletter {
  margin-top: 16px;
}

.mj-footer-newsletter-form {
  display: flex;
  gap: 8px;
}

.mj-footer-newsletter-form input {
  flex: 1;
  padding: 10px 14px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: var(--mj-radius-sm);
  color: #fff;
  font-size: 0.85rem;
  font-family: var(--mj-font);
  outline: none;
  transition: all 0.2s;
}

.mj-footer-newsletter-form input::placeholder {
  color: rgba(255,255,255,0.4);
}

.mj-footer-newsletter-form input:focus {
  border-color: var(--mj-secondary);
  background: rgba(255,255,255,0.12);
}

.mj-footer-newsletter-form button {
  padding: 10px 18px;
  background: linear-gradient(135deg, var(--mj-secondary), var(--mj-primary));
  color: #fff;
  border: none;
  border-radius: var(--mj-radius-sm);
  font-size: 0.85rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
}

.mj-footer-newsletter-form button:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 16px rgba(233,78,119,0.3);
}

/* ─── Bottom Bar ─── */
.mj-footer-bottom {
  border-top: 1px solid rgba(255,255,255,0.06);
  margin-top: 48px;
  padding: 18px 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.78rem;
  color: rgba(255,255,255,0.4);
}

.mj-footer-bottom-links {
  display: flex;
  gap: 18px;
}

.mj-footer-bottom-links a {
  color: rgba(255,255,255,0.4);
  text-decoration: none;
  transition: color 0.2s;
  font-size: 0.78rem;
}

.mj-footer-bottom-links a:hover {
  color: var(--mj-accent-light);
}

.mj-footer-bottom strong {
  color: rgba(255,255,255,0.6);
}

/* ─── Floating Buttons ─── */
.mj-whatsapp,
.mj-back-top {
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
  transition: all 0.3s var(--mj-ease);
  text-decoration: none;
}

.mj-whatsapp:hover,
.mj-back-top:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 36px rgba(0,0,0,0.3);
}

.mj-whatsapp {
  bottom: 82px;
  background: #25a75c;
  font-size: 24px;
}

.mj-back-top {
  bottom: 24px;
  background: linear-gradient(135deg, var(--mj-primary), var(--mj-primary-light));
  font-size: 20px;
}

.mj-translate-widget {
  position: fixed;
  right: 14px;
  bottom: 140px;
  z-index: 80;
}

.mj-translate-toggle {
  position: relative;
  right: auto;
  width: 64px;
  height: 58px;
  padding: 6px;
  border-radius: var(--mj-radius);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 2px;
  background: linear-gradient(135deg, var(--mj-accent), var(--mj-accent-light));
  color: var(--mj-primary-dark);
  border: none;
  cursor: pointer;
  box-shadow: 0 4px 16px rgba(200,155,60,0.3);
  transition: all 0.3s var(--mj-ease);
}

.mj-translate-toggle:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(200,155,60,0.4); }
.mj-translate-toggle i { font-size: 18px; line-height: 1; }
.mj-translate-label { font-size: 9px; line-height: 1.1; font-weight: 800; text-transform: uppercase; letter-spacing: .03em; }

.mj-translate-menu {
  position: absolute;
  right: 0;
  bottom: calc(100% + 9px);
  width: 155px;
  display: none;
  padding: 7px;
  border: 1px solid var(--mj-border);
  border-radius: var(--mj-radius);
  background: #fff;
  box-shadow: 0 14px 38px rgba(106,16,55,0.18);
}

.mj-translate-widget.open .mj-translate-menu { display: grid; gap: 4px; }

.mj-translate-menu button {
  display: flex;
  align-items: center;
  gap: 9px;
  width: 100%;
  padding: 9px 10px;
  border: 0;
  border-radius: var(--mj-radius-sm);
  background: transparent;
  color: var(--mj-text);
  text-align: left;
  font: inherit;
  font-size: 0.82rem;
  cursor: pointer;
}

.mj-translate-menu button:hover { background: var(--mj-cream); color: var(--mj-primary); }
.mj-translate-menu button span { display: grid; place-items: center; width: 25px; height: 25px; border-radius: 50%; background: var(--mj-secondary-pale); font-size: 11px; font-weight: 800; }

#google_translate_element { position: absolute !important; width: 1px !important; height: 1px !important; overflow: hidden !important; opacity: 0 !important; pointer-events: none !important; }
.goog-te-gadget, .goog-logo-link { display: none !important; }

/* ─── Responsive ─── */
@media (max-width: 1000px) {
  .mj-footer-grid {
    grid-template-columns: 1fr 1fr;
    gap: 32px;
  }
}

@media (max-width: 700px) {
  .mj-footer { padding-top: 44px; }
  .mj-footer-grid {
    grid-template-columns: 1fr;
    gap: 28px;
  }
  .mj-footer-desc { max-width: 100%; }
  .mj-footer-bottom {
    flex-direction: column;
    gap: 12px;
    text-align: center;
  }
  .mj-footer-bottom-links { flex-wrap: wrap; justify-content: center; }
  .mj-whatsapp, .mj-back-top { right: 14px; }
  .mj-translate-widget { right: 8px; bottom: 140px; }
  .mj-translate-toggle { width: 56px; height: 52px; }
}

@media (max-width: 480px) {
  .mj-footer .container { width: min(100% - 28px, 1200px); }
}
</style>

<footer class="mj-footer">
  <div class="container">
    <div class="mj-footer-grid">

      <!-- Brand -->
      <div class="mj-footer-col">
        <a class="mj-footer-brand" href="index">
          <img src="<?php echo htmlspecialchars($smLogo ?? 'css3/assets/manpasand-logo.png', ENT_QUOTES, 'UTF-8'); ?>" alt="Manpasand Jodidar Logo" width="64" height="64">
          <span>
            <b>Manpasand Jodidar</b>
            <small>मनपसंद जोडीदार · वधू वर सूचक केंद्र</small>
          </span>
        </a>
        <p class="mj-footer-desc">
          Manpasand Jodidar is a trusted matrimonial platform connecting families with dignity, tradition, and modern convenience. Find your perfect life partner today.
        </p>
        <span class="mj-footer-note"><i class="bi bi-shield-check"></i> Verified & Trusted Platform</span>
        <div class="mj-footer-social">
          <a class="mj-social-btn" href="https://www.facebook.com/" target="_blank" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <a class="mj-social-btn" href="https://www.instagram.com/" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a class="mj-social-btn" href="https://www.youtube.com/" target="_blank" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
          <a class="mj-social-btn" href="https://twitter.com/" target="_blank" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="mj-footer-col">
        <h4>Quick Links</h4>
        <div class="mj-footer-links">
          <a href="index">Home</a>
          <a href="about-us">About Us</a>
          <a href="signup">Register Free</a>
          <a href="my_offer">Membership Plans</a>
          <a href="success_story">Success Stories</a>
          <a href="contactus">Contact Us</a>
        </div>
      </div>

      <!-- Legal -->
      <div class="mj-footer-col">
        <h4>Legal</h4>
        <div class="mj-footer-links">
          <a href="terms-conditions">Terms of Use</a>
          <a href="privacy-policy">Privacy Policy</a>
          <a href="returns-and-cancellation">Refund Policy</a>
          <a href="disclaimer">Disclaimer</a>
          <a href="faqs">FAQ's</a>
          <a href="safematrimony">Safe Matrimony</a>
        </div>
      </div>

      <!-- Contact -->
      <div class="mj-footer-col">
        <h4>Contact Us</h4>
        <div class="mj-footer-contact-item">
          <div class="mj-footer-contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <div class="mj-footer-contact-text">Satara, Maharashtra, India</div>
        </div>
        <div class="mj-footer-contact-item">
          <div class="mj-footer-contact-icon"><i class="bi bi-telephone-fill"></i></div>
          <div class="mj-footer-contact-text">
            <a href="tel:+919403550087">(+91) 94035 50087</a><br>
            <a href="tel:+917447573787">(+91) 74475 73787</a>
          </div>
        </div>
        <div class="mj-footer-contact-item">
          <div class="mj-footer-contact-icon"><i class="bi bi-envelope-fill"></i></div>
          <div class="mj-footer-contact-text">
            <a href="mailto:info@manpasandjodidar.com">info@manpasandjodidar.com</a>
          </div>
        </div>
        <div class="mj-footer-newsletter">
          <h4 style="margin-top:8px;">Newsletter</h4>
          <div class="mj-footer-newsletter-form">
            <input type="email" placeholder="Your email">
            <button type="submit"><i class="bi bi-send"></i></button>
          </div>
        </div>
      </div>

    </div>

    <div class="mj-footer-bottom">
      <span>
        Copyright &copy; <?php echo date('Y'); ?> <strong>Manpasand Jodidar</strong> &mdash; All Rights Reserved
      </span>
      <div class="mj-footer-bottom-links">
        <a href="privacy-policy">Privacy</a>
        <a href="terms-conditions">Terms</a>
        <a href="disclaimer">Disclaimer</a>
      </div>
    </div>
  </div>
</footer>

<!-- Floating Buttons -->
<?php include_once('google_translator.php'); ?>
<a class="mj-whatsapp" href="https://wa.me/919403550087" target="_blank" aria-label="Chat on WhatsApp"><i class="bi bi-whatsapp"></i></a>
<button class="mj-back-top" id="mjBackTop" aria-label="Back to top"><i class="bi bi-chevron-up"></i></button>

<!-- Bootstrap JS -->
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* ══════════════════════════════════════════
   Manpasand Jodidar — Header & Footer JS
══════════════════════════════════════════ */
(function() {
  'use strict';

  // ─── Header scroll effect ───
  var header = document.getElementById('mjHeader');
  var topbar = document.querySelector('.mj-topbar');
  var syncHeader = function() {
    if (!header) return;
    var isMobile = window.innerWidth <= 1050;
    if (isMobile) {
      header.classList.toggle('scrolled', window.scrollY > 24);
      return;
    }
    var topbarH = (topbar && !isMobile && topbar.offsetHeight > 0) ? topbar.offsetHeight : 0;
    var isPast = window.scrollY > topbarH;
    header.classList.toggle('mvj-sticky', isPast);
    header.classList.toggle('scrolled', window.scrollY > topbarH + 24);
    document.body.classList.toggle('mj-padded-header', isPast);
  };
  window.addEventListener('scroll', syncHeader, { passive: true });
  syncHeader();

  // ─── Mobile menu toggle ───
  var toggle = document.querySelector('.mj-menu-toggle');
  var nav = document.querySelector('#mjMainNav');
  var backdrop = document.querySelector('.mj-nav-backdrop');

  var setMenu = function(open) {
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
    if (window.innerWidth <= 1050) document.body.classList.remove('mj-padded-header');
    syncHeader();
  }, { passive: true });

  // ─── Mobile dropdown toggle ───
  document.querySelectorAll('.mj-nav-dropdown > button').forEach(function(btn) {
    btn.addEventListener('click', function() {
      if (window.innerWidth <= 1050) {
        btn.parentElement.classList.toggle('open');
      }
    });
  });

  // ─── Back to top ───
  var backTop = document.getElementById('mjBackTop');
  if (backTop) {
    backTop.addEventListener('click', function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ─── Scroll reveal animation ───
  var revealObserver = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('mj-revealed');
      }
    });
  }, { threshold: 0.12 });

  document.querySelectorAll('.mj-reveal, .mj-stagger').forEach(function(el) {
    revealObserver.observe(el);
  });

  // ─── Button ripple effect ───
  document.querySelectorAll('.mj-btn, .mj-nav-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      var ripple = document.createElement('span');
      ripple.classList.add('mj-btn-ripple');
      var rect = btn.getBoundingClientRect();
      var size = Math.max(rect.width, rect.height);
      ripple.style.width = ripple.style.height = size + 'px';
      ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
      ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
      btn.appendChild(ripple);
      setTimeout(function() { ripple.remove(); }, 600);
    });
  });

})();
</script>
<link rel="stylesheet" href="css3/searchable-multiselect.css">
<script src="css3/searchable-multiselect.js"></script>
<script src="js/whatsapp-share.js?v=2"></script>
</body>
</html>
