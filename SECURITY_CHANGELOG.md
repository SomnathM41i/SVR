# Security Remediation — Phase A (Critical + High)

**Branch:** `arena/019fb6b6-svr` · **Base:** `main` @ `efaf8e1` · **Date:** 2026-07-31
**Scope constraint honored:** password storage mechanism is **unchanged** (no hashing,
no migration, no auth-flow changes related to password storage). No database schema
changes. Business logic and user-visible flows preserved.

Every commit is small and individually revertable. Audit references (C1…C10, H1…H15)
match the delivered review report.

---

## Commits (in order)

### 1. `security: externalize secrets via config.php` — C1
- **`config.php` (new):** `svr_config($key, $default)` resolves secrets from
  **environment variable → `config.local.php` (git-ignored) → legacy fallback**.
  Also provides `svr_db_fail()` (see commit 13).
- **`config.sample.local.php` (new):** template for the per-server override file.
- **`sys_dbconnection.php`:** DB host/name/user/pass no longer hard-coded in the
  class; they resolve through `svr_config()` with the previous values as fallbacks.
- **`.gitignore`:** `config.local.php`, `error_log`, `*.log`, `*.bak`, `*.bak2`,
  `*.zip`, and user-content dirs.
- **Ops action:** set env vars (or create `config.local.php`), then ask us to remove
  the fallback defaults, **rotate the DB password**, and it never lives in git again.

### 2. `security: add shared security helper module`
- **`includes/security.php` (new):** `svr_e()` (XSS escaping), CSRF helpers
  (`svr_csrf_token/field/verify`), `svr_throttle()` (file-based rate limiting, no
  schema change), `svr_set_cookie()` (HttpOnly/SameSite/Secure-aware),
  `svr_reset_token_make/verify()` (expiring, single-use HMAC tokens — no password
  storage change), `svr_cron_guard()`, `svr_api_key_guard()`,
  `svr_safe_image_path()` (anti-LFI), `svr_random_bytes()`.

### 3. `security: remove hard-coded master OTP bypass` — C8
- **`verify_otp.php`:** removed the universal `000777` OTP bypass. Only the
  per-session OTP is accepted.

### 4. `security: token-bound password reset + throttling` — C3/H5/H1
- **`forgot_password_submit.php`:** issues a 1-hour, single-use HMAC reset token in
  the emailed link (token is bound to the currently stored password, so it dies the
  moment the password changes); prepared statements; 5-requests/hour throttle;
  CSRF verification (commit 9).
- **`new_pass.php`:** requires a valid token before rendering or processing;
  unknown/expired/forged links redirect to `forgot_password?action=invalidlink`;
  prepared statements; POST throttling; removed the debug echo of the UPDATE query;
  exits after redirects. **Password VALUE storage intentionally unchanged.**
- **`forgot_password.php`:** distinct messages for throttled vs. invalid/expired link.

### 5. `security: fix local file disclosure in image endpoints` — C5
- **`photoprocess.php`, `console/photoprocess.php`, `blur.php`:**
  previously passed `$_GET['image']` straight to the filesystem (arbitrary file
  read / phar:// abuse). Now validated by `svr_safe_image_path()` (no stream
  wrappers, no traversal outside base dir, image extensions only).
  All resize/blur params and output behavior preserved.

### 6. `security: close unauthenticated admin surface` — C4/H1/H5/H11
- **`console/protect.php` (rewritten):** starts the session when needed,
  **exits after redirect** (previously pages kept rendering for unauthenticated
  requests — full auth bypass), returns JSON 401 for AJAX.
- **263 console PHP files** received the guard (`require_once …/protect.php`).
  Excluded: `login.php`, `login_submit.php`, `protect.php`, class files; verified
  no console file is included from outside the admin panel.
- **`console/Delete_idproof.php` (rewritten):** was an unauthenticated GET-driven
  raw-interpolated UPDATE (unauth SQLi). Now admin-only + prepared statement.
- **`console/activity_log.php`, `console/User_Profile.php`:** prepared statements.
- **`console/login_submit.php` (rewritten):** POST-only, throttling (5/10 min),
  prepared statement, `session_regenerate_id(true)`, exits after redirects.
  Password comparison semantics unchanged.
- **Follow-up repairs:** `heart.php`/`heart1.php` (guard placement),
  `edit_edu.php`/`unban_update.php` (protect include had been commented out).

### 7. `security: payment integrity` — C6
- **`contact_paid_success.php` (rewritten):** previously any POST with
  `payment_id`+`oid` recorded a "Paid" purchase with a client-controlled amount.
  Now fetches the payment server-to-server from the Razorpay API, requires
  `captured`/`authorized`, enforces the plan price when known, records the
  API-reported amount. Prepared statements; login session required; broken legacy
  commented blocks removed.
- **`razorpay.php` (rewritten):** key id via config; JS values JSON-encoded;
  removed a trailing broken Instamojo MAC block (dead code); AJAX call now
  forwards `searchid` (previously always empty server-side).
- **`webhook.php` (rewritten):** Instamojo salt via config; `hash_equals` MAC
  comparison; guarded reads; exits after redirects; HTTP 400 on invalid MAC.
- **`payment_success.php`, `membership_choose.php`:** Razorpay key id/secret via
  `svr_config()` (env `SVR_RZP_KEY_ID` / `SVR_RZP_KEY_SECRET`) with the previous
  per-flow values as fallbacks. **The live membership order+signature flow was
  already correct and is unchanged.**
- Verified: `razorpay.php`/`contact_paid_success.php` are a legacy pair with no
  inbound references — removal candidates for the cleanup phase.

### 8. `security: fix SQLi/XSS on unauthenticated + search endpoints` — H1/H2
- **`check_email_exist.php`** (root + console): prepared statement; output escaped
  (closed attribute-breakout XSS); no DB error disclosure.
- **`check_mobile_exist.php`:** prepared statement.
- **`advance_search_result.php`:** new `escFilterList()` escapes every element of
  the ms/religion/caste/education/occupation/country/state/dist/taluka/city filter
  arrays (main query + pagination count query); scalars escaped at assembly;
  session/unserialize taluka fallback escaped. Result sets unchanged.

### 9. `security: CSRF protection on auth-critical forms` — H3
- Session-bound tokens wired into: member login (`login.php`, `login2.php` →
  `login_submit.php`), admin login, change password, forgot password, password
  reset, and OTP verification. Handlers reject forged POSTs via the pages'
  existing error paths; normal flows unchanged.
- **Deferred:** the signup form (its submission chain — post-to-self into
  `register_submit.php` — needs verification before wiring; no victim-side state
  risk since registration is self-regarding).

### 10. `security: session & cookie hardening` — H4/H5/H11
- **`sys_dbconnection.php`:** session cookie HttpOnly + SameSite=Lax (+ Secure
  when HTTPS); strict session mode.
- **`login_submit.php`:** session regeneration on login; remember-me now stores
  **only the username** (the 10-year plaintext password cookie is gone and any
  legacy one is expired); plaintext password no longer copied into `$_SESSION`
  (confirmed unread); login throttled 5/10 min per username+IP; POST-only
  (was `$_REQUEST` — credentials could arrive via GET URLs in logs).
- **`login.php`, `login2.php`:** password field no longer prefilled (username
  prefill kept).

### 11. `security: guard cron endpoints + throttle OTP resend` — H6/H5
- **Cron guard** (`svr_cron_guard()`): `cronbirthdateWish.php`,
  `cron_expireMember.php`, `automailbdaywish.php`, `membershipautomail.php`.
  CLI always allowed; web hits require `?key=SVR_CRON_KEY` once that env var is
  configured (zero behavior change until ops sets it).
- **`asysendotp.php`:** OTP sends throttled to 3/10 min per mobile+IP, placed
  after the `otp_on_off` feature toggle; **`verify_otp.php`:** throttle notice.

### 12. `security: API hardening`
- **22 `apis/*.php` files** shipped with `display_errors`/`E_ALL` enabled —
  debug output disabled (JSON error responses unchanged).
- **Broadcast push endpoints** (`diwali_notification.php`,
  `send_fcm_notification.php`, `send_new_match_notifications.php`,
  `send-test-notification.php`) were callable with a bare POST — added
  `svr_api_key_guard()` (active once ops sets `SVR_API_ADMIN_KEY`).
- Audited all 120 API endpoints for unescaped request-var SQL interpolation:
  none found (inputs go through `setfilter()`/prepared statements).
- **Deferred (needs approval):** the mobile API authenticates by client-supplied
  `MatriID` with no token. Token-based API auth changes the app contract and was
  NOT done here.

### 13. `security: remove fatal legacy mysql_* calls` — H10/H7
- Every `die(mysql*_error())` variant (147 call sites across ~100 files) now calls
  **`svr_db_fail()`** (config.php): logs the real error to `error_log`, returns
  HTTP 500 + a generic message. Success paths unchanged.
- **`biodatadelete.php` (rewritten):** member auth + own-record-only delete
  (was IDOR), mysqli + prepared statement.
- **`education_site.php`**, **`sys_dbconnection.php`**: last live legacy calls fixed.
- Catalogued for cleanup (NOT deleted yet): `Mailer/smtp.php`, `Mailer/smtp2.php`,
  `Mailer/welcome_mail.php`; broken include of non-existent `Mailer/smtp1.php` in
  `payment_success.php`.

### 14. `security: remove source-disclosure artifacts + Apache hardening` — H8/H9/H14
- Deleted after reference-checking: `apis/_apis.zip`,
  `apis/send_fcm_notification.php.zip`, `console/error_log`, `encrypt.php`,
  `decrypt.php`, `example.php`, `sample.php`, `bounce.php`, `photop.php`, and all
  22 `*.php.bak` files.
- Root `.htaccess`: `nosniff`, `X-Frame-Options SAMEORIGIN`,
  `Referrer-Policy`; denies `*.bak/*.zip/*.sql/*.log/*.md/*.sh/*.ini` and `/.git`;
  **commented HTTPS redirect + HSTS template** (enable after confirming prod HTTPS).
- Upload dirs (`adhar/ kundli/ gallary/ uploads/ success/`): script extensions
  blocked via `.htaccess`. `sessions/`: fully denied.

### 15. `security: untrack user PII from version control` — C9
- `git rm --cached` for `adhar/` (Aadhaar scans), `kundli/`, `gallary/`,
  `success/`, `uploads/`, `sessions/` (incl. live session files).
  **Files remain on disk — production untouched.** Copies remain in pre-existing
  git history; history rewrite + force push is a separate coordinated op.

---

## Items explicitly deferred (per rule 8 — need your approval)

1. **Token-based authentication for `apis/`** — changes the mobile app contract.
2. **PHPMailer 5.2.4 → 6.x upgrade** — library API change; current usage passes no
   user input to `setFrom()`, so the known CVE path isn't reachable; still
   recommended for Phase B.
3. **Forced HTTPS redirect + HSTS** — template shipped commented in `.htaccess`;
   confirm the production domain/SSL first.
4. **Aadhaar/ID document broker** — move `adhar/` (and ideally `kundli/`) behind an
   authenticated viewer; needs small template updates in
   `console/id_proof_approval.php`, `console/profile_view(1).php`,
   `upload_idproof*.php`.
5. **DB password + Razorpay/Instamojo credential rotation** — must be done by you
   in the hosting/gateway dashboards; fallbacks in code keep the site running until
   then.
6. **CSRF on the signup form** — flow needs verification first.
7. **Git history purge of PII/secrets** — rewrites hashes (force push); coordinate.

## Verification performed
- Reference scans before every deletion (includes, forms, JS, routes).
- Structural balance check on **all 389 changed PHP files**: every file's
  brace/paren/bracket signature is identical to its pre-change signature (0
  regressions); all fully-rewritten files are individually balanced.
- No PHP runtime is available in this sandbox, so **`php -l` lint + a smoke run on
  staging before deploying is recommended** (all changes are small and mechanical).
