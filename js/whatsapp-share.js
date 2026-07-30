(function () {
  'use strict';
  var s = document.createElement('style');
  s.textContent =
    '.wa-share-btn{display:inline-flex!important;align-items:center!important;gap:6px!important;padding:7px 14px!important;border:none!important;border-radius:8px!important;background:#25D366!important;color:#fff!important;font-size:.82rem!important;font-weight:700!important;cursor:pointer!important;transition:background .2s,transform .2s;text-decoration:none!important;font-family:inherit!important;line-height:1!important;white-space:nowrap!important;width:auto!important;height:auto!important}' +
    '.wa-share-btn:hover{background:#1da851!important;transform:translateY(-1px);color:#fff!important}' +
    '.wa-share-btn i{font-size:1.05em!important}' +
    '.wa-share-btn-sm{padding:5px 10px!important;font-size:.78rem!important}';
  document.head.appendChild(s);
})();
