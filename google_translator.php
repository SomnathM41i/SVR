<style>
.mvv-translate-widget{position:fixed;right:14px;bottom:140px;z-index:1080}.mvv-translate-toggle{width:68px;height:62px;padding:7px 6px;border:0;border-radius:14px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2px;background:linear-gradient(135deg,#BA9350,#f0bd3d);color:#5E1426;box-shadow:0 8px 28px rgba(0,0,0,.2);cursor:pointer}.mvv-translate-toggle:hover{transform:translateY(-3px);box-shadow:0 12px 36px rgba(0,0,0,.3)}.mvv-translate-toggle i{font-size:20px;line-height:1}.mvv-translate-label{font-size:10px;line-height:1.1;font-weight:800;text-transform:uppercase;letter-spacing:.03em}.mvv-translate-menu{position:absolute;right:0;bottom:calc(100% + 9px);width:155px;display:none;padding:7px;border:1px solid #e0d5cb;border-radius:12px;background:#fff;box-shadow:0 14px 38px rgba(58,42,34,.2)}.mvv-translate-widget.open .mvv-translate-menu{display:grid;gap:4px}.mvv-translate-menu button{display:flex;align-items:center;gap:9px;width:100%;padding:9px 10px;border:0;border-radius:8px;background:transparent;color:#49393a;text-align:left;font:inherit;font-size:13px;cursor:pointer}.mvv-translate-menu button:hover{background:#FFFDFB;color:#5E1426}.mvv-translate-menu button span{display:grid;place-items:center;width:25px;height:25px;border-radius:50%;background:#fff0e0;font-size:11px;font-weight:800}#google_translate_element{position:absolute!important;width:1px!important;height:1px!important;overflow:hidden!important;opacity:0!important;pointer-events:none!important}.goog-te-gadget,.goog-logo-link{display:none!important}@media(max-width:700px){.mvv-translate-widget{right:8px;bottom:140px}.mvv-translate-toggle{width:60px;height:58px}}
</style>
<div class="mvv-translate-widget notranslate" id="mvvTranslateWidget" translate="no">
  <button class="mvv-translate-toggle" id="mvvTranslateToggle" type="button" aria-expanded="false" aria-controls="mvvTranslateMenu" aria-label="Translate website">
    <span class="mvv-translate-label">Translate</span>
    <i class="bi bi-translate" aria-hidden="true"></i>
  </button>
  <div class="mvv-translate-menu" id="mvvTranslateMenu" role="menu">
    <button type="button" data-language="en" role="menuitem"><span>EN</span> English</button>
    <button type="button" data-language="mr" role="menuitem"><span>म</span> मराठी</button>
  </div>
  <div id="google_translate_element" aria-hidden="true"></div>
</div>

<script>
function googleTranslateElementInit() {
  if (!window.google || !google.translate || !document.getElementById('google_translate_element')) return;
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    includedLanguages: 'en,mr',
    autoDisplay: false
  }, 'google_translate_element');
}

(function () {
  var widget = document.getElementById('mvvTranslateWidget');
  if (!widget || widget.dataset.ready === '1') return;
  widget.dataset.ready = '1';
  var toggle = document.getElementById('mvvTranslateToggle');
  var menu = document.getElementById('mvvTranslateMenu');

  function closeMenu() {
    widget.classList.remove('open');
    toggle.setAttribute('aria-expanded', 'false');
  }

  function setTranslateCookie(language) {
    if (language === 'en') {
      document.cookie = 'googtrans=;path=/;expires=Thu, 01 Jan 1970 00:00:00 GMT;SameSite=Lax';
      document.cookie = 'googtrans=;path=/;domain=' + location.hostname + ';expires=Thu, 01 Jan 1970 00:00:00 GMT;SameSite=Lax';
      return;
    }
    document.cookie = 'googtrans=/en/mr;path=/;SameSite=Lax';
    document.cookie = 'googtrans=/en/mr;path=/;domain=' + location.hostname + ';SameSite=Lax';
  }

  function selectLanguage(language) {
    setTranslateCookie(language);
    var nativeSelect = document.querySelector('.goog-te-combo');
    if (nativeSelect && language !== 'en') {
      nativeSelect.value = language;
      nativeSelect.dispatchEvent(new Event('change'));
      closeMenu();
      return;
    }
    location.reload();
  }

  toggle.addEventListener('click', function () {
    var open = !widget.classList.contains('open');
    widget.classList.toggle('open', open);
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
  });
  menu.querySelectorAll('[data-language]').forEach(function (button) {
    button.addEventListener('click', function () { selectLanguage(button.dataset.language); });
  });
  document.addEventListener('click', function (event) {
    if (!widget.contains(event.target)) closeMenu();
  });
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') closeMenu();
  });

  if (!document.querySelector('script[data-mvv-google-translate]')) {
    var script = document.createElement('script');
    script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
    script.async = true;
    script.dataset.mvvGoogleTranslate = '1';
    document.body.appendChild(script);
  }
})();
</script>
