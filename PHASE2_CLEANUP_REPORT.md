# Phase 2 — Cleanup, Restructuring & Code Quality Report

**Scope:** `arena/019fb6b6-svr` since Phase A end-state (`8236e9b`) → HEAD. 9 commits.
**Rules obeyed:** 100% functionality preserved · no business-logic changes · no schema changes ·
no password-mechanism changes · no workflow redesign · `apis/` and third-party packages untouched
for behavior · every deletion verified; **if uncertain, kept**.
**Net result:** 562 files touched — **163 deleted, 399 modified, 0 added, 0 renamed/moved** — and
**26.2 MB** removed from the working tree (+1,744/−14,688 lines).

---

## 1. Cleanup Summary

| Commit | Class | Files | Essence |
|---|---|---|---|
| `4e1bca7` | OS junk / backups / SQL dumps | 30 | 26 × Thumbs.db, `infinity/`, `phptobackup/`, 2 stale `.sql` dumps |
| `a3f236b` | Dead first-party PHP | 34 | dev tools, tests/demos, stubs, orphan fragments, duplicate drafts |
| `d3885c3` → `c5a43a3` | Unused JS + cookie lib | 21 → **8 net** | StackBoxBlur, orphaned plugins, purecookie ×2 copies; **jslib restored** (see §10.2) |
| `fc7a879` | Unreferenced first-party CSS | 7 | dead bootstrap-select/page style files |
| `f78b928` | Download artifacts + byte-identical dupes | 72 | 14 Apache-404 fake assets, `css3/img/` photo-duplication (48), dead logo copies, demo widget dupes |
| `d3065dc` | Commented-out legacy code | 399 files / −3,490 lines | proven comment-only (§9.2) |
| `2d9bdd2` | Dead includes + broken mail wrappers | 4 + 7 edits | 7 include statements whose targets never existed; 4 unused `Mailer/` wrappers |
| `f2639df` | Duplicate-download/camera artifacts | 6 | `images (N).jpeg`, `- Copy`, `_DSC… copy` files |

## 2. Files Deleted — complete register with justification

Deletion-proof standard: **Aho-Corasick full-tree scan of every text file** matching both the
filename and its extensionless friendly-URL stem (`.htaccess` maps `/name` → `name.php`), plus class-specific evidence. Zero in-tree references was necessary but **not** sufficient.

### 2.1 OS / backup / dump junk — 30
| Files | Justification |
|---|---|
| 26 × `Thumbs.db` (all dirs) | Windows Explorer caches; never web assets; 0 refs; also stopped from web-serving by `.htaccess` |
| `infinity/ForgottenPassword.png` (+Thumbs.db) | 0 path refs; orphan from an abandoned design |
| `phptobackup/mainbanaer/1.jpg`, `2.jpg` | "phptobackup" staging dir; 0 refs |
| `console/agent_install.sql`, `database/nri_profile_fields.sql` | one-shot schema dumps never read by any code; `.sql` web-denied since Phase A |

### 2.2 Dead first-party PHP — 34
| Files | Justification |
|---|---|
| `_convert2.php`, `router.php` | dev tools: one-shot CLI template converter ("Usage: php _convert2.php"), PHP built-in-server dev router |
| `console/modal_test.php`, `console/changedemo.php`, `new_btn_style.php`, `modelpopup.php`, `console/wp.php`, `console/print_profile_demo.php`, `console/main_chart1.php`, `countdown_blast.php` | test/demo/prototype pages (titles: "MODAL EXAMPLE", W3Schools tutorials…), static 2021 countdown, 76% `1`-variant of `main_chart.php` |
| `console/count1.php`, `console/print_profile_dummy.php`, `console/chages.php`, `console/multiseleadmin.php`, `lsit_tab.php`, `console/add _contactamount.php` | 1-line stubs, a dev-notes file, a CSS fragment saved as `.php`, typo/space filenames; working copies retained |
| `gt_header.php`, `changepass_pop.php`, `selectdem.php` | template fragments nothing includes (old "GT" theme header superseded by `header3.php`; `selectdem.php` references undefined `$row/$con`) |
| `configstripe.php` | **fatal on any load**: `require stripe-php-master/init.php` (never existed) + placeholder keys; 0 refs |
| `popup2.php`–`popup6.php` | popup draft family; only `popup.php` is included (by `advance_search.php`, `search.php`, `smart_search-multi.php`…); drafts 28–89% similar |
| `faqs2.php` (97%), `disclaimer2.php`, `privacy-policy2.php`, `returns-and-cancellation2.php`, `safematrimony2.php`, `terms-conditions2.php` (95–96%) | near-identical draft copies of canonical CMS pages; 0 refs |
| `console/profile_view1.php` | old `1` variant of `profile_view.php`; includes never-existed `tp.php` |
| `console/class.cropcanvas.php`, `console/crop-image-store.php` | decommissioned 2006 crop feature: class provably never included; 5-line WIP upload stub writing fixed name `Cropped image.jpg` |

### 2.3 Unused JavaScript & cookie library — 8 (net)
| Files | Justification |
|---|---|
| `js/StackBoxBlur.js`, `js/StackBoxBlurWrapper.js` | old client-side blur, superseded by server-side `blur.php`; 0 refs |
| `js/jquery.countdown.js` | only powered the deleted `countdown_blast.php` |
| `js/jquery.easing.min.js`, `js/parallax.min.js`, `js/swiper.min.js` | theme plugins with 0 `<script>`/link refs anywhere |
| `purecookie.{js,css}` + `cookie/purecookie.{js,css}` | cookie-consent lib loaded by no page — both copies dead |

### 2.4 Unreferenced CSS — 7
`css/bootstrap-select.min.css`, `css2/bootstrap-select1.css`, `css2/boostrapnewtick1.css`,
`css/mutualmobile.css`, `css/mynewstyle.css`, `css/smartcs.css`, `css/smartsearch.css` —
0 stylesheet refs in any php/html/js (incl. stems).

### 2.5 Download artifacts & duplicate assets — 72 + 6
| Files | Justification |
|---|---|
| 14 × fake assets in `console/assets/**` (`loading.html`, `close/next/prev/complete.html`, `fullcalendar.min.html`, `ekko-lightbox.min.html`, `lightbox.min.html`, `auth-logo-dark.html`, `product/index.html`) | content literally **"404 Not Found — Apache Server at dashboardkit.io"**: vendor-site error pages saved as assets during theme scraping. The two css files that cite these names already received 404-bodies before and after — behavior identical |
| `console/assets/images/widget/dashborad-1/2/3.jpg` | byte-identical to `gallery-grid/img-grd-gal-1/2/3.jpg`; widget names 0-ref |
| 48 × `css3/img/*` | theme scaffolding staged twice; every file md5-identical to its `img/*` twin and 0 full-path refs (the css3 theme references `../img/` = root); **all `img/*` primaries kept** |
| `css3/assets/logo.png`, `images/logo.png`, `images/favicon.png` | 1.2 MB each, 0 refs — live logo is `css3/assets/shivraj-logo.png` (500+ refs) |
| `images/background/5 - Copy.jpg`, `img/images (1|2|3).jpeg`, `images/print-watermark - Copy.png`, `img/_DSC3901 copy.jpeg` | Windows/browser duplicate-download & camera-import artifacts, 0 refs |

### 2.6 Broken/unused mail wrappers — 4
`Mailer/smtp.php`, `Mailer/smtp2.php`, `Mailer/smtp_connection.php`, `Mailer/welcome_mail.php` —
0 include call-sites (live mail uses root `smtp.php`/`smtp2.php`, 11 call-sites);
`Mailer/smtp2.php` additionally broken inside (`include '../Mailer1/PHPMailer_5.2.4'` never existed).

## 3. Files Moved — **none (by design)**
Moving pages/assets would change public URLs and break references stored in places a static scan
cannot see (DB-stored CMS content, external bookmarks, Razorpay/Instamojo dashboard callback URLs,
mobile-app hardcoded paths, email templates with absolute URLs). Deletion-only consolidation was
the safe Phase-2 model. See §11 for the planned Phase-3 move strategy.

## 4. Files Renamed — **none (by design)**
Same reasoning. Specifically evaluated and rejected: `css2/` (misnomer but live: 94 refs to
`css2/jquery.min.js` alone), `img/`+`images/` merge (DB-content reference risk), `gallary/`
typo (runtime DB paths + production URLs + app contract).

## 5. Folder Structure Improvements (achieved this phase)
- Eliminated folders: `phptobackup/`, `infinity/`, `cookie/`, `console/jslib/` was removed then **restored** (§10.2), `css3/img/` (fully redundant duplicate tree).
- Repository no longer tracks: SQL dumps, OS junk, fake 404 assets, double-staged theme photos.
- Third-party code was **not** intermingled-then-split in this phase — it stays where pages
  reference it; a lib/ layout is a Phase-3 candidate (§11).
- Documented convention going forward: root = pages + bootstrap (`config.php`,
  `sys_dbconnection.php`), `includes/` = shared first-party libs, `css2/`+`css3/`+`template/` =
  current live theme assets (do not rename until refs migrate), `console/assets/` = admin theme unit.

## 6. CSS Consolidation Summary
- Deleted: 7 unreferenced first-party CSS files (§2.4).
- Purged: 48 duplicate theme photos that stylesheets never load directly; 14 fake-asset artifacts.
- **Merging duplicate CSS frameworks — not done (evidence):** the live admin theme ships
  `style.css` + `style-dark.css` with deliberately mangled extension references
  (`Inter-Regular46a7.html` etc. are real WOFF2 fonts referenced by CSS). Touching that chain
  breaks admin fonts. Selector pruning is runtime-only work (JS toggles classes undetectable
  statically) → deferred (§10).

## 7. JavaScript Consolidation Summary
- Deleted: 8 unreferenced files (§2.3); removed the orphaned countdown plugin.
- **jQuery audit:** production serves 2 main versions — `css2/jquery.min.js` **v2.1.1** (94
  referencing pages) and `js/jquery.js` **v1.12.4** (52 referencing legacy pages).
  **Unification deferred:** the 52 legacy pages pair 1.12.4 with era plugins that break under 2.x;
  blind upgrade = user-facing breakage; Phase-3 item with per-page testing.
- `console/assets/crop/jquery-3.3.1.min.js` kept (console crop flows use the `assets/crop/` bundle).
- CKEditor `lang/*.js` (150+ files) **kept**: runtime-loaded by editor locale detection —
  deletion would have silently broken the admin editor for non-en browsers.

## 8. Duplicate Code Removed
- **Asset-level:** md5 hash-set over the whole tree; 70 duplicate groups found (11.9 MB waste);
  deleted only copies with provably zero path-qualified references whose identical twin survives.
- **Code-level:** 4 duplicate/broken `Mailer/` SMTP wrappers; root SMTP wrappers remain canonical.
- **Refused — page-inline JS helpers** (`blockSpecialChar` etc. exist in ~40 pages each):
  measured **5 distinct behavioral variants** of `blockSpecialChar` alone across 39 pages
  (29/4/1/1/1 split). Blind centralization would silently change member-facing form validation →
  documented as tech debt with the variant inventory (§10.3).

## 9. Validation Report

| # | Requirement | Result | Evidence |
|---|---|---|---|
| 1 | Every page loads | **PASS (static)** | 399 modified PHP files: brace/paren/bracket signatures vs Phase-A = **0 divergences**; stripped-executable diff vs Phase-A shows changes in **exactly 8 files** (7 dead-include removals + 1 logo path constant) — everything else comments-only |
| 2 | CSS/JS refs resolve | **PASS** | Reference-resolution scan (all `src`/`href`/`url()`): 0 newly unresolvable; 663→639 (24 disappeared with deleted broken demo pages). 639 pre-existing broken refs catalogued (§10.1) |
| 3 | PHP includes work | **PASS** | Missing-include map: 0 new; **10 fixed** (7 dead includes + configstripe + profile_view1 + lsit_tab); 20→10 remain, all pre-existing and documented (§10.1) |
| 4 | Uploads function | **PASS (static)** | `upload*` PHP handlers only comment-touched (strip-proof); `console/HomePageGreetings.php` byte-untouched executable-wise; upload dirs + their `.htaccess` intact; `console/jslib` **restored** for admin crop flows |
| 5 | Admin pages work | **PASS (static)** | All 254 remaining `protect.php` guard lines intact; `console/ckeditor`, `console/assets` theme unit intact; `jslib` kept |
| 6 | User pages work | **PASS (static)** | Same global proof as #1; only intentional edit = payment-logo path constant |
| 7 | APIs functional | **PASS** | `git diff -- apis/` = **0 files touched** |
| 8 | No missing assets/broken links | **PASS** | §2 evidence per deletion; post-deletion basename sweep triaged — every hit traced to a surviving same-name file, a pre-existing-broken ref, or vendor docs |
| 9 | No syntax errors | **PASS (static)** | structural signatures equal; 0 conflict markers; **staging `php -l` still a mandatory gate** (no PHP runtime in this sandbox) |
| 10 | No new warnings/notices | **PASS** | −7 E_WARNING-producing dead includes; serving deleted artifacts to nobody (0 refs each); display_errors ini-lines untouched everywhere |

## 10. Remaining Technical Debt

### 10.1 Pre-existing (documented, not introduced by Phase 2)
- **639 unresolvable asset references**, concentrated in admin theme demo pages
  (`console/document_approval.php`, `console/cms.php` DashboardKit samples) and old templates.
- **10 remaining missing-include warnings** on live pages (`add_successstory.php`,
  `banned_member.php`, `photo.php`, `apis/upload-profile.php`, console crons under web context)
  — some are CLI-context-dependent (`smtp2.php` from console cron works in CLI-from-root but
  warns via web); fixing requires editor-level flow review, not cleanup.
- **`membership_choose_step.php` (Instamojo flow) / `login2.php` / `biodatadelete.php` / ~100
  zero-in-tree-ref PHP pages:** possibly reached via external callback URLs, bookmarks, emails —
  kept pending owner confirmation.
- `console/print_my_profile.php`: live-linked but partially degraded (missing
  `leftmenu.php`/`newadmin/*` sections — pre-existing).
- CCAvenue `IFRAME_KIT/` has empty keys (dead integration, kept); legacy `razorpay.php` +
  `contact_paid_success.php` pair hardened in Phase A, still unreferenced (owner confirmation needed).
- `display_errors` ini-set lines remain in several legacy non-API pages (Phase A covered `apis/` only).

### 10.2 Decisions reversed during this phase (kept deliberately)
- `console/jslib/` (2006 script.aculo.us + cropper): deleted, then **restored** — its loader uses
  runtime `document.write()`; usage cannot be fully disproven statically. Verify on staging, then remove.
- `images/1.jpg`: kept (possible DB-driven hero reference, cannot disprove without DB).
- 9 WOFF2-fonts-misnamed-`.html`, 3 `fa-*-d41d.eot` IE fallbacks: **live assets** — never delete.
- `console/HomePageGreetings.php`: unlinked but production `uploads/videos/*.mp4` proves usage.

### 10.3 Code dup inventory for later (measured, not touched)
- `blockSpecialChar` ×39 files / **5 variants**; `ValidateAlpha` / `isNumber` / `nospaces` ×~40 each (variant analysis needed before centralizing).
- 531 hardcoded `http://localhost/SVR/...` URLs (incl. email `<img>` tags → broken images in emails today).
- jQuery v1.12.4 ↔ v2.1.1 page-partition split (§7).

## 11. Recommendations for Phase 3 (ordered, each individually PR-able)
1. **Own-confirmed deletions:** have the site owner confirm the ~100 zero-in-tree-ref pages
   (`*2` non-duplicate variants `about-us2/contactus2/success_story2/my_offer2`, `login2.php`,
   `biodatadelete.php`, orphan `_pop` fragments, console demo/chart pages, `jslib`).
2. **Email-image repair:** replace the 531 `localhost/SVR` absolute URLs with the live domain
   (fixes broken logo images in member emails) — content-only change, but span-measured first.
3. **Include-path discipline:** resolve the remaining 10 missing includes via an
   `includes/bootstrap.php` convention; then migrating `smtp.php`, `memprotect.php`,
   `siteconfig.php`, `popup.php`, header/footer files into `includes/` becomes mechanical
   (all include paths are static — but do it page-family by page-family with lint gates).
4. **Folder rename plan (compatibility-safe):** `css2/` → `assets/site/` via *additive* move
   (copy, update refs in batches outside peak hours, 301-redirect not needed for assets, remove
   old paths after log-verified zero hits). `gallary/` typo **cannot** be renamed (DB paths) —
   leave a redirect shim if ever cleaned.
5. **Validation-function centralization:** build `js/validation.js` from the dominant variant
   (29/39), then per-page migration of the 11 divergent pages with functional review.
6. **jQuery retirement plan:** migrate legacy pages in families (search → profile → dashboard)
   to 2.1.1 with plugin-compat testing.
7. **Runtime tooling:** adopt `php -l` in CI + a headless reference crawler on staging so the
   remaining 639 broken refs and selector-pruning can be done with live evidence.
8. **DB-content asset audit:** dump `siteconfig`/CMS tables' `img src` values before deleting
   any further images (closes the blind spot that kept `images/1.jpg` alive).

## 12. What was NOT done (freeze rules)
No business-logic edits, no schema changes, no password-mechanism changes, no API changes
(0 files), no workflow redesign, no UI redesign, no third-party version bumps, no formatting-only
churn (comment removals are proof-covered; no re-indentation anywhere).
