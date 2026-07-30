(function () {
  'use strict';
  var s = document.createElement('style');
  s.textContent =
    '.wa-share-btn{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border:none;border-radius:8px;background:#25D366;color:#fff!important;font-size:.82rem;font-weight:700;cursor:pointer;transition:background .2s,transform .2s;text-decoration:none;font-family:inherit;line-height:1;white-space:nowrap}' +
    '.wa-share-btn:hover{background:#1da851;transform:translateY(-1px);color:#fff!important}' +
    '.wa-share-btn i{font-size:1.05em}' +
    '.wa-share-btn-sm{padding:5px 10px;font-size:.78rem}';
  document.head.appendChild(s);
})();
