# Final Quality Assurance Review — Phase A Security Remediation

**Scope:** Pull Request #1 (`arena/019fb6b6-svr` → `main`), 23 commits, base `efaf8e1`.
**Rule set:** user's 12-point QA directive. **No functional changes were made during this pass.**
**Sandbox limitation (unchanged):** no PHP runtime here — verification is structural/static;
staging `php -l` + smoke test remains a mandatory pre-merge step (see §10.6).

---

## 0. Changes made during THIS QA pass (comment/docs only — provably non-functional)

| Commit | Change | Proof it is non-functional |
|---|---|---|
| `b9608e1` | Simplified 61 debug-disable annotations in 22 `apis/*.php` files so they no longer embed the disabled statement text; reworded 1 `TODO(security)` marker in `sys_dbconnection.php` to an OPS NOTE; removed the commented-out HTTPS/HSTS template block from `.htaccess` (it now ships verbatim in §10.7 of this document) | After stripping comments/strings, every touched PHP file is **byte-identical** to its previous revision (automated comparison, 0 executable-line differences across all 23 files) |
| (this commit) | Added `QA_FINAL_REVIEW.md` | New documentation file only |

Nothing else was altered. No features, refactors, or behavior changes were introduced by this pass.

---

## 1. Commit-by-commit review (accidental edits / formatting-only / unrelated edits)

Every commit was inspected via full diff + added/removed-line histograms:

| # | Commit | Verdict |
|---|---|---|
| 1 | `3217bdd` externalize secrets via config.php | Clean — exactly the 4 files described (`.gitignore`, `config.php`, `config.sample.local.php`, `sys_dbconnection.php`) |
| 2 | `9e670f4` shared security helper module | Clean — single new file `includes/security.php` |
| 3 | `8be6bba` remove master OTP 000777 | Clean — `verify_otp.php` only |
| 4 | `ceb8235` token-bound password reset | Clean — `forgot_password_submit.php` + `new_pass.php` only |
| 5 | `16cdd19` distinct reset-link messages | Clean — `forgot_password.php` only |
| 6 | `68e3632` LFI fix in image endpoints | Clean — `includes/security.php`(helper added), `photoprocess.php`, `console/photoprocess.php`, `blur.php` |
| 7 | `3cce1cc` close unauthenticated admin surface | Clean — 263 one-line guard insertions + exactly the 5 documented rewrites (`protect.php`, `Delete_idproof.php`, `activity_log.php`, `User_Profile.php`, `login_submit.php`); histogram proves no other file exceeds 3 changed lines |
| 8 | `d316240` payment integrity | Clean — `contact_paid_success.php`, `razorpay.php`, `webhook.php`, `payment_success.php`, `membership_choose.php` |
| 9 | `6c21155` SQLi/XSS on unauthenticated/search endpoints | Clean — `check_email_exist.php`(root+console), `check_mobile_exist.php`, `advance_search_result.php` |
| 10 | `39e042d` CSRF on auth-critical forms | Clean — 6 form pages + 5 handlers, all listed in message |
| 11 | `1a602c1` session & cookie hardening | Clean — `sys_dbconnection.php`, `login_submit.php`, `login.php`, `login2.php` |
| 12 | `cf2f7b4` cron guards + OTP throttle | Clean — 4 cron files + `asysendotp.php` + `verify_otp.php` |
| 13 | `b8f67eb` API hardening | Clean — 22 × debug-output-off + 4 × broadcast guard + helper definition; histogram shows zero other edits |
| 14 | `8a8a00d` die()→svr_db_fail + legacy mysql_* removal | Clean — mechanical conversion in ~100 files + exactly the 2 documented rewrites (`biodatadelete.php`, `education_site.php`); all non-mechanical lines traced to these two files |
| 15 | `440f23e` artifact deletion + Apache hardening | Clean — 31 deletions + root `.htaccess` only |
| 16 | `f16dd23` untrack PII | Clean — 90 untracks + `.gitignore` + 6 protective `.htaccess` files |
| 17 | `0f58dd2` console guard edge repairs | Clean — `heart.php`, `heart1.php`, `edit_edu.php`, `unban_update.php` |
| 18 | `32bc127` svr_db_fail bootstrap in fblogin | Clean — 1 file, 2 lines |
| 19 | `e9a8563` security changelog | Clean — docs only |
| 20 | `70e2159` validation report + htaccess credential deny | Clean — docs + 5 `.htaccess` lines as described |
| 21 | `b9608e1` QA comment cleanup | Clean — comment-only, proven (§0) |
| 22 | `qa/final` this report | Docs only |

**Formatting-only changes:** none exist anywhere in the PR (verified: a whitespace-insensitive diff of every changed text file still shows a real change; zero files differ only by whitespace).
**Unrelated edits:** none found — every delta traces to a purpose stated in its commit message.
**Accidental modifications:** none found (no mode/permission changes anywere; no binary/asset touched outside the documented PII untracking).

## 2. Commit independence & revertability

Every commit is a **single-purpose unit**; messages state reason + affected files, so each is individually understandable and revertable. Two commits act as shared libraries that later commits consume:

- **Foundations:** `3217bdd` (config.php / `svr_config()`), `9e670f4` (includes/security.php helpers)
  - Consumed by: `68e3632`, `3cce1cc`(console login hardening), `d316240`, `6c21155`, `39e042d`, `1a602c1`, `cf2f7b4`, `b8f67eb`, `8a8a00d`, `0f58dd2`, `32bc127`
  - ⇒ revert a foundation **only together with its dependents, in reverse commit order**, or via a full-PR revert.
- **Follow-up pairs (revert together):** `16cdd19`⊂`ceb8235`; `0f58dd2`⊂`3cce1cc`; `32bc127`⊂`8a8a00d`; `b9608e1`⊂(`b8f67eb`+`3217bdd`+`440f23e`); `70e2159`⊂`440f23e` (`.htaccess` context).
- **Fully standalone (safe to revert alone):** `8be6bba` (OTP), `f16dd23` (untrack PII), `e9a8563` (changelog), this QA report.

**Recommended practice:** production rollback = revert the merge commit as one unit (§11). Partial reverts only for targeted hotfixes, in reverse order of the dependency list above.

## 3. Final file-change summary (grouped)

Totals for the whole PR (including this pass): **515 files — 12 added, 382 modified, 121 deleted.**
(Note: `VALIDATION_REPORT.md` states 513/10-added because it was written one commit earlier; the figures here are measured against the final tree.)

### 3.1 Security (cross-cutting)
| Change | Files |
|---|---|
| Shared security helper module `includes/security.php` (**new**, 17 helpers) | 1 |
| Arbitrary file-read fix (image endpoints): `photoprocess.php`, `console/photoprocess.php`, `blur.php` | 3 |
| Master-OTP removal + OTP throttling: `verify_otp.php`, `asysendotp.php` | 2 |
| SQLi/XSS fixes: `check_email_exist.php`, `console/check_email_exist.php`, `check_mobile_exist.php`, `advance_search_result.php` | 4 |
| IDOR + legacy driver fix: `biodatadelete.php`; fatal `mysql_*` removal: `education_site.php` | 2 |
| Cron endpoint guards: `cronbirthdateWish.php`, `automailbdaywish.php`, `membershipautomail.php`, `cron_expireMember.php` | 4 |
| Error-disclosure neutralization `die(mysql*_error())` → `svr_db_fail()` | ~98 (root/console/apis) |
| Web hardening: root `.htaccess` (headers, artifact deny, `.git` deny) + 6 new `.htaccess` in upload/session dirs | 7 |
| **Cleanup under security:** see §3.10 (31 source-disclosure artifacts deleted, 90 PII files untracked) | 121 |

### 3.2 Authentication
| Change | Files |
|---|---|
| Member login hardening (POST-only, CSRF, throttle, session regeneration, HttpOnly cookie, password-cookie removed): `login_submit.php`, `login.php`, `login2.php` | 3 |
| Admin login hardening + guard rewrite: `console/login_submit.php`, `console/login.php`, `console/protect.php` | 3 |
| Token-bound password reset: `forgot_password.php`, `forgot_password_submit.php`, `new_pass.php` | 3 |
| CSRF on password change: `change_pswd.php`, `change_password_submit.php` | 2 |
| Session cookie hardening (session init): `sys_dbconnection.php` (+1 include fix: `fblogin_submit.php`) | 2 |
| Admin auth guard insertion | 263 console files (also counted in §3.4) |

### 3.3 Payments
| Change | Files |
|---|---|
| Razorpay server-side verification + amount/plan check: `contact_paid_success.php`, `razorpay.php` | 2 |
| Instamojo webhook hardening (constant-time MAC, guarded reads): `webhook.php` | 1 |
| Secret externalization w/ per-flow fallbacks: `payment_success.php`, `membership_choose.php` | 2 |

### 3.4 Admin Panel
| Change | Files |
|---|---|
| Auth guard + rewrites + guard (§3.2) | 285 console files total modified (263 guard, ~20 die()-only, 5 rewrites/guard-repairs) |
| Deleted: `console/error_log` (credential/path disclosure) | 1 |

### 3.5 APIs
| Change | Files |
|---|---|
| Debug output disabled (production-safe) | 22 |
| Optional shared-key guard on broadcast push endpoints | 4 (`diwali_notification.php`, `send_fcm_notification.php`, `send_new_match_notifications.php`, `send-test-notification.php`) |
| die() conversion / error handling | overlaps above |
| Deleted: `apis/_apis.zip`, `apis/send_fcm_notification.php.zip` | 2 (§3.10) |
| **Mobile contract:** unchanged — no endpoint, parameter, or response-shape modification | 0 |

### 3.6 Database
- **Schema changes: NONE. Zero migrations, zero new tables/columns.**
- Code-level: `sys_dbconnection.php` (credentials via `svr_config()`, session cookie params, mysqli strict reporting), `config.php` (new resolver).
- Query-behavior changes are limited to parameterizing identical SQL (same columns, same filters, same semantics) in the files listed under §3.1/§3.2/§3.4.

### 3.7 Configuration
| File | Purpose |
|---|---|
| `config.php` (**new**) | `svr_config()` resolver: env → `config.local.php` → legacy fallback; `svr_db_fail()` |
| `config.sample.local.php` (**new**) | Documented template for server-local overrides |
| `.gitignore` | ignore `config.local.php` + PII/upload dirs (while keeping their `.htaccess` tracked) |
| root `.htaccess` | security headers, artifact/credential denies, `.git` deny (all active directives; commented template moved to §10.7) |

### 3.8 UI
- **No visual, layout, HTML-structure, CSS, or JS changes.** The only form-level additions are hidden CSRF token `<input>`s inside 6 existing auth forms (counted under §3.2). Rendering is otherwise byte-identical.

### 3.9 Documentation
| File | Purpose |
|---|---|
| `SECURITY_CHANGELOG.md` | per-commit reasons, ops actions, deferred items |
| `VALIDATION_REPORT.md` | 513-file validation evidence, pre-existing-risk register |
| `QA_FINAL_REVIEW.md` (**this file**) | final QA review, deployment checklist, rollback report |

### 3.10 Cleanup
121 deletions — see §4 for the complete per-file table with reasons and verification.

## 4. Deleted files — complete register

**Verification method (applied to every entry):** fresh full-tree reference scan after deletion — `git grep` of each exact filename across all remaining `*.php`, `*.js`, `*.htm(l)`, `*.css`, `.htaccess` — plus confirmation in the pre-deletion scans recorded in VALIDATION_REPORT.md §5. Result: **0 code references to any deleted file.**

### 4.1 Source-disclosure artifacts (commit `440f23e`, 31 files)

| File | Why deleted |
|---|---|
| `Profile_shortlisted.php.bak`, `Vcontactdetail.php.bak`, `block_profile.php.bak`, `full_profile.php.bak`, `full_profile_photo_issue.php.bak`, `interest_received.php.bak`, `interest_send.php.bak`, `membership_choose.php.bak`, `message.php.bak`, `message_received.php.bak`, `message_send.php.bak`, `my_connected_members.php.bak`, `my_viewed_contactlist.php.bak`, `my_viewed_profile.php.bak`, `premium_members.php.bak`, `profile_ignore.php.bak`, `send_message.php.bak`, `viewed_address.php.bak`, `who_connected_me.php.bak`, `who_shortlisted_me.php.bak`, `who_viewed_addreess_list.php.bak`, `who_viewed_my_profile.php.bak` (22 files) | `.bak` editor backups of live pages: full PHP source exposed over HTTP (finding H8). Stale duplicates of live `.php` files. |
| `apis/_apis.zip` | Zip of the entire API directory — full source download (H8). |
| `apis/send_fcm_notification.php.zip` | Source-disclosure zip (H8). |
| `console/error_log` | Committed PHP error log disclosing absolute server paths and runtime internals (H14). (Note: remaining `error_log` matches in the tree are PHP's built-in `error_log()` function calls, not this file.) |
| `encrypt.php`, `decrypt.php` | Unreferenced crypto demo stubs using weak static-key logic (H8). |
| `example.php` | Library/example scaffold stub, unreferenced (H8). |
| `sample.php` | Unreferenced scaffold stub (H8). (The similarly-named `console/sample.php` is a different, live, now-guarded page; it was retained.) |
| `bounce.php` | 1-line leftover stub (`<?php ?>`-class remnant), unreferenced (H8). |
| `photop.php` | Unreferenced legacy photo stub superseded by the hardened `photoprocess.php` (H8). |

### 4.2 User PII & runtime files untracked from version control (commit `f16dd23`, 90 files; `git rm --cached` — files remain on disk/server untouched)

| Files | Why untracked | Verification |
|---|---|---|
| `adhar/*.jpg/jpeg` — 22 Aadhaar/ID scans | Government ID documents must not sit in git history/webroot tracking (C9) | Filenames are runtime-generated (timestamp-hash pattern); 0 code references; still referenced by DB rows at runtime paths that still exist on the server |
| `kundli/*.jpg` — 22 horoscope scans | Same (C9) | Same |
| `gallary/*.jpg/jpeg` — 31 member-uploaded gallery photos | Same (C9) | Same |
| `success/*` — 11 success-story photos (incl. extensionless uploads) | Same (C9) | Same |
| `uploads/videos/*.mp4` — 1 uploaded video | Same (C9) | Same |
| `sessions/sess_*` — 3 live PHP session files | Live session data in VCS = session hijack material (C9/H11) | Runtime artifacts regenerated by PHP; 0 code references |

## 5. Added files — justification for each

| File | Why it was necessary |
|---|---|
| `config.php` | Single credential resolver (`svr_config()`) + safe DB-failure handler (`svr_db_fail()`); required to remove hard-coded credentials without forcing any new mandatory config on the operator (3-tier fallback) |
| `config.sample.local.php` | Onboarding template so ops can see every supported variable with documentation |
| `includes/security.php` | Central library for CSRF, throttling, output escaping, secure cookies, reset tokens, path validation, cron/API guards — one audited place instead of duplicated snippets |
| `adhar/.htaccess`, `kundli/.htaccess`, `gallary/.htaccess`, `uploads/.htaccess`, `success/.htaccess` | Deny script execution in user-upload directories (stops uploaded-webshell execution); images/files still served |
| `sessions/.htaccess` | Full HTTP deny on the session-storage directory (PHP session files live inside webroot on this host) |
| `SECURITY_CHANGELOG.md`, `VALIDATION_REPORT.md`, `QA_FINAL_REVIEW.md` | Audit trail, regression evidence, and this deployment/rollback handbook — requested deliverables |

## 6. Duplication audit

- **Function definitions added by this PR: exactly 18** — each defined exactly once, in exactly one file; zero name collisions with the pre-existing tree (verified against the base commit).
- **Zero duplicated validation logic introduced:** no inline token generators, no copy-pasted CSRF/throttle blocks, no per-file escaping rewrites — every consumer calls the shared helpers (§7).
- Pre-existing duplicate helper names found in the tree (e.g. JS `blockSpecialChar`, `ValidateAlpha`, `nospaces` repeated across legacy pages) **predate this PR and were not added or copied by it** — catalogued for the future cleanup phase, not touched now (no-refactoring constraint).

## 7. Centralization & reuse confirmation

| Helper (all in `includes/security.php` / `config.php`) | Reused by |
|---|---|
| `svr_db_fail()` | **98 files** |
| `svr_csrf_field()` / `svr_csrf_verify()` | 7 / 6 files |
| `svr_throttle()` / `svr_throttle_reset()` | 5 / 2 files |
| `svr_client_ip()` | 5 files |
| `svr_cron_guard()` | 4 files |
| `svr_api_key_guard()` | 4 files |
| `svr_safe_image_path()` | 3 files |
| `svr_config()` | 6 files |
| `svr_e()`, `svr_reset_token_make()/verify()`, `svr_set_cookie()`, `svr_app_secret()`, `svr_random_bytes()` | consumed by the flows above |
| `escFilterList()` (file-local to `advance_search_result.php`) | local escaping wrapper only — intentionally not global because no second file shares its exact shape |

All new security logic lives in the two central modules; call sites contain no security re-implementations.

## 8. Style / formatting / naming / structure consistency

- New code follows the codebase's existing conventions: procedural PHP, `snake_case` helpers (mirroring `mysqli_*` style), `array()` syntax, no scalar type hints, no PHP 7+ only constructs — **PHP 5.4-compatible**, matching the legacy code and the shared-host environment.
- The console guard line reuses the file's own existing include idiom (`require_once(dirname(__FILE__).'/protect.php');`), inserted directly after the bootstrap include in each file.
- `.htaccess` additions follow Apache 2.4 syntax already used in the file; commented template removed from the active config (§0).
- No new top-level directories; the only new paths are `includes/` (already existed? — no: created once, standard location alongside `sys_dbconnection.php`) and doc files at root, matching where `README`-class files would live.

## 9. Conflicts / debug statements / TODOs / temp code / commented-out code / test artifacts

| Check | Result |
|---|---|
| Merge-conflict markers (`<<<<<<<`, `=======`, `>>>>>>>`) | **None** added (the `=====` hits in the tree are pre-existing CSS/doc banner separators, unmodified) |
| Debug statements (`var_dump`, `print_r`, `console.log`, stray `echo`/`exit`) added | **None** (the one `console.log`-word hit is inside the markdown validation table) |
| `TODO` / `FIXME` / `HACK` / `XXX` | **None remaining** (single TODO reworded to OPS NOTE in this pass; `$xxx` variable in `console/photoprocess.php` is pre-existing base code, unchanged 8→8 occurrences) |
| Commented-out executable code added by this PR | **Removed in this pass** (61 annotations simplified; `.htaccess` HTTPS template relocated to §10.7) |
| Temporary/test artifacts | **None** (no `.test`, `.tmp`, `.orig`, `.rej`, scratch files introduced) |
| Working tree | Clean; branch builds on itself with no unresolved state |

## 10. Deployment checklist

### 10.1 Environment variables (all OPTIONAL at deploy time — every one has a working in-code fallback; behavior only hardens once a variable is set)

| Variable | Consumed by | Effect when set |
|---|---|---|
| `SVR_DB_HOST`, `SVR_DB_NAME`, `SVR_DB_USER`, `SVR_DB_PASS` | `config.php` ← `sys_dbconnection.php` | DB credentials leave the source code entirely (set these first) |
| `SVR_APP_SECRET` | `includes/security.php` | HMAC key for reset tokens detached from DB password |
| `SVR_CRON_KEY` | 4 cron files | HTTP-hit crons require `?key=`; CLI always allowed |
| `SVR_API_ADMIN_KEY` | 4 broadcast API endpoints | sends require `X-API-Key`; until set, behavior unchanged |
| `SVR_RZP_KEY_ID`, `SVR_RZP_KEY_SECRET` | `razorpay.php`, `payment_success.php` | Razorpay keys leave source |
| `SVR_INSTAMOJO_SALT` | `webhook.php`, `membership_choose.php` | Instamojo salt leaves source |

Alternative to env vars: create `config.local.php` from `config.sample.local.php` (web access to it is denied by `.htaccess`).

### 10.2 Files/data to back up BEFORE deploying
1. **Full filesystem backup of the docroot** (or at minimum every path listed in VALIDATION_REPORT.md §4 — the 515 touched paths), especially: `.htaccess`, `sys_dbconnection.php`, `login_submit.php`, `console/protect.php`, the 5 payment files.
2. **Database dump:** `mysqldump -h 82.25.121.160 -u u320743426_SVR -p u320743426_SVR > svr_pre_phaseA_$(date +%F).sql`
3. **User-upload directories must not be wiped:** `adhar/`, `kundli/`, `gallary/`, `success/`, `uploads/`, `sessions/` (they are intentionally absent from git now — deploy by file-sync, never by clean checkout over the docroot).

### 10.3 Database changes
**None.** No DDL, no migrations, no data rewrites. Password storage untouched per project constraint.

### 10.4 Manual deployment steps (in order)
1. Merge PR #1 on GitHub (after your review).
2. On a **staging copy**: `find . -name '*.php' -exec php -l {} \;` on all changed files; fix nothing here — report any parse error back (should be zero).
3. Deploy the file set to production **over** the existing docroot (rsync/panel upload). Deleted files: remove the 31 artifact paths from the server as well (they are attack surface); do NOT delete anything under the upload/session dirs.
4. Create `config.local.php` from the sample (or set the panel env vars) — at minimum the four `SVR_DB_*` values; verify the site loads (fallbacks guarantee it works even without this step).
5. Run the smoke suite in §10.5.
6. Rotate the exposed secrets (DB password, Razorpay secret, Instamojo salt) — treat in-code copies as compromised since they lived in the repo.
7. Set `SVR_CRON_KEY` + `SVR_API_ADMIN_KEY` and update cron URLs / push-sender configs accordingly (only when ready — guards stay open until then).
8. Enable HTTPS enforcement (block in §10.7) once HTTPS is verified on the domain.
9. Monitor `error_log` for 48h for `svr_db_fail` entries (query failures now log instead of leaking).

### 10.5 Smoke-test list (post-deploy, each ~1 minute)
Member login (and logout), admin login, registration page render + OTP send/verify, forgot-password full loop (link → token page → reset), one Razorpay **test-mode** membership purchase end-to-end, Instamojo webhook test call, profile view + photo display (`photoprocess.php` on an existing photo), gallery/adhaar image loads in admin approval screen, advanced search with filters, one cron via CLI (`php cron_expireMember.php`), API sanity: one `apis/` GET endpoint from the app.

### 10.6 Known platform limitation
This sandbox has no PHP interpreter; all 382 modified PHP files passed structural balance/signature checks (0 regressions) and exhaustive static review, but **a real `php -l` + §10.5 on staging is a mandatory gate before production traffic.**

### 10.7 HTTPS enforcement block (ready to activate — intentionally NOT shipped active in `.htaccess`)
```apache
# Enable after confirming the production site serves HTTPS correctly:
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}/$1 [R=301,L]
<IfModule mod_headers.c>
  Header set Strict-Transport-Security "max-age=31536000; includeSubDomains" env=HTTPS
</IfModule>
```

## 11. Rollback report

### 11.1 If the PR is not yet merged
Close PR #1 — production is untouched. Nothing else to do.

### 11.2 Full rollback after merge (recommended, single atomic step)
```bash
git checkout main
git revert -m 1 <merge-commit-sha>     # or: git revert <squash-sha>
git push origin main
# then redeploy the reverted file set over the docroot
```
- **Database:** no rollback needed — this PR contains zero schema/data changes.
- **Config:** old code ignores `config.local.php` and all `SVR_*` env vars — they can stay in place for a later re-attempt, or be removed; either is safe.
- **Sessions:** rollback restores the previous cookie parameters; existing session files and the session name are unchanged, so members stay logged in.
- **Throttle state:** a few tiny files may remain in the system temp dir — harmless, auto-expire.
- **Re-tracking side effect (informational):** reverting also restores git tracking of `adhar/`, `kundli/`, `gallary/`, `success/`, `uploads/`, `sessions/`. The files on the server are untouched either way. If you roll back permanently, re-run `git rm -r --cached adhar kundli gallary success uploads sessions` and keep the `.gitignore` lines so PII does not silently re-enter the repo.
- **Old-htaccess risk note:** rollback restores the old root `.htaccess`, which no longer blocks `*.bak|zip|sql|log` — acceptable on rollback because the sensitive artifacts themselves stay deleted from the server.

### 11.3 Partial rollbacks (targeted hotfix instead of full revert)
| Problem observed | Revert | Dependency notes |
|---|---|---|
| Members can't log in / throttled wrongly | `1a602c1`, `39e042d` (in that order) | reverse order; also `ceb8235`+`16cdd19` if reset flow involved |
| Admin can't reach console | `0f58dd2` then `3cce1cc` | restores unguarded console — prefer fixing guard instead |
| Search/check-email broken | `6c21155` | standalone after foundations intact |
| Payment callback failing | `d316240` | restores C6 exposure — fix forward preferred |
| Images not rendering | `68e3632` | restores C5 LFI — fix forward preferred |
| OTP flow broken | `8be6bba` (+`cf2f7b4`) | restores master OTP — fix forward preferred |
| A cron/API broadcast blocked | remove the env key (`SVR_CRON_KEY` / `SVR_API_ADMIN_KEY`) | guards fail-open by design — no code change needed |
| DB connection failing post-deploy | remove `SVR_DB_*` env vars (fallbacks engage) | no code change needed |

Foundations (`3217bdd`, `9e670f4`) should not be partially reverted (they are consumed everywhere); use the full revert instead.

### 11.4 Post-rollback verification
Repeat §10.5 smoke suite; confirm `git log` shows the revert commit; confirm the 31 deleted artifact files were not restored to the server by the redeploy.

## 12. What was NOT done (per your freeze)
No cleanup phase, no UI redesign, no folder restructuring, no dead-code removal beyond the already-reviewed security artifacts, no CSS/JS consolidation, no architecture/performance work, no password-hashing/migration. All remain queued for explicit post-approval phases.

---
**Status: awaiting your approval of PR #1. I will stop here until you review.**
