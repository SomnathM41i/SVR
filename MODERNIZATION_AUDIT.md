# Modernization Phase A — Final Repository Audit

**Type:** audit only — **no code, asset, or structural changes were made** (this document is the only added file).
**Baseline:** current HEAD of `arena/019fb6b6-svr` (= Phase 1 Security + Phase 2 Cleanup merged state).
**Method:** full-tree Aho-Corasick reference scans, include/asset/AJAX resolution scans, hash-based
dup detection, function-variant hashing — all static (no PHP runtime in sandbox).

---

## 1. Repository Health Report

| Surface | State | Health |
|---|---|---|
| Working tree | 2,244 tracked files, 131 MB (`.git` itself 85 MB — bloated, purge candidate) | 🟡 |
| PHP code | 324 console + 239 root + 120 apis + 10 agent + 87 razorpay-php + 47 Mailer + 13 template + 4 includes | 🟢 (structure map now stable) |
| Security posture (post-Phase-1) | 0 SQLi in unauth surface, 320/324 console files guarded, CSRF on auth forms, tokenized reset, payments verified server-side | 🟢 for legacy baseline |
| Console (admin) panel | 324 PHP, 320 with `protect.php` guard; DashboardKit theme intact; CKEditor 4.x runtime assets intact | 🟢 |
| User panel | 89 files behind `memprotect.php`; session-cookie hardened (HttpOnly/SameSite) | 🟢 |
| Agent panel | 10 files, clean layout (`common.php` shared; password_hash already used there) | 🟢 |
| APIs (mobile app) | 120 endpoints; identity = client-posted MatriID (**accepted risk**, app-contract); debug output off; broadcast endpoints key-guarded (open until key set) | 🟡 |
| Payments | Razorpay membership flow (HMAC-verified) = healthy; Instamojo live; **legacy pair + 2 broken refs remain (§6)**; CCAvenue kit present with empty keys (dead) | 🟡 |
| Sessions | `sessions/` inside webroot but **HTTP-denied** via `.htaccess`; session files untracked; `session_regenerate_id` on login | 🟢 |
| Configuration | 10 env vars via `svr_config()` with in-code fallbacks; `config.local.php` template; secrets out of VCS | 🟢 |
| Asset integrity | **726 unresolved static refs (197 files)** — concentrated in a few live pages (§6) | 🔴 (pre-existing) |
| Includes | **10 missing include targets left → 3 live member pages render with warnings** | 🟡 |
| DB usage | 204 distinct tables referenced; god-table `register` in 333 files; 1,019 `SELECT *`; per-request `last_seen` UPDATE on every page (Phase-1 catalog) | 🔴 (Phase C target) |
| Dependencies | PHPMailer 5.2.4 (EOL), jQuery 1.12.4 (52 pages) + 2.1.1 (94 pages), CKEditor 4.x, razorpay-php ~2.x, Bootstrap 3+4+5 mixed | 🟡 |

**Overall: 6.5/10** (was ~2.6 at first audit). Biggest drags: broken asset refs on 3 live pages, god-table/SELECT-\* debt, legacy template duplication.

## 2. Dependency Map

### 2.1 Runtime module graph (first-party)
```
                        ┌────────────────┐
                        │  .htaccess     │ friendly-URL: /name → name.php
                        └──────┬─────────┘
        ┌──────────────────────┼─────────────────────────────┐
        ▼                      ▼                             ▼
  PUBLIC PAGES          MEMBER PAGES (memprotect.php)   console/* (protect.php)
 (index, search,              │                             │
  CMS, signup)                ▼                             ▼
        │              DASHBOARD/PROFILE/etc         ADMIN pages (320/324 guarded)
        ▼                      │                    - CKEditor, DashboardKit
  sys_dbconnection.php ◄── all panels ──► console/../sys_dbconnection.php
        │                                            │
        ▼                                            ▼
  config.php (10 SVR_* env vars → config.local.php → legacy fallback)
        │
        ▼
  includes/security.php (17 helpers; svr_db_fail ×94 files, CSRF ×7, throttle ×5,
  cron/API guards ×4+4)
  ─────────────────────────────────────────────────────────────────────
  Mail path: root smtp.php / smtp2.php (11 call-sites) → Mailer/PHPMailer_5.2.4
  Payments: membership_choose.php → Razorpay order/verify → payment_success.php
            membership_choose_step.php → src/instamojo.php → webhook.php (HASH-checked)
            [legacy] razorpay.php → contact_paid_success.php (hardened, 0 refs)
            [dead config] IFRAME_KIT (CCAvenue, empty keys); Stripe (removed Phase 2)
  Push: firebase/fcm.php ← apis broadcast endpoints (SVR_API_ADMIN_KEY-guarded, open-by-default)
  Crons: 4 root crons + 2 console crons (svr_cron_guard; CLI always allowed)
  Agent: agent/* (own auth via password_hash; commission lib agent_commission_lib.php)
```

### 2.2 Vendor dependency inventory
| Package | Version | Where | Notes |
|---|---|---|---|
| PHPMailer | **5.2.4 (EOL)** | `Mailer/` | used via root smtp wrappers; upgrade deferred (Phase-1 constraint) |
| razorpay-php | 2.x (composer.lock present) | `razorpay-php/` | membership verify flow |
| CKEditor | 4.x | `console/ckeditor/` | runtime lang/skin loading — do not prune |
| Admin theme "DashboardKit" | Bootstrap-5 family | `console/assets/` | broken-scrape artifacts purgeable only w/ runtime tests |
| jQuery | 1.12.4 (52 pages) / 2.1.1 (94) / 3.3.1 (console crop) / 2.1.3 (404) / 1.7.2 (CCAvenue) | css2, js, console | unification plan needed |
| Instamojo PHP | vendored snippet | `src/instamojo.php` | live |
| Firebase FCM | custom wrapper | `firebase/` | service-account json gitignored |

## 3. Remaining Technical Debt (prioritized)
1. 🔴 3 live member pages with broken assets/includes: `add_successstory.php` (29 broken refs + 3 missing includes), `photo.php` (12 refs + 1 include), `console/gal_photo_approve.php` (2 includes) — visible warnings/missing images **today**.
2. 🔴 `payment_failed_handler.php` **fetch()ed by live Razorpay checkout (`membership_choose.php:299`) but does not exist** — failed-payment telemetry 404s (success path unaffected).
3. 🔴 `register` god-table in 333 files; 1,019 `SELECT *`; per-page `last_seen` write; login full-table scan (Phase-C targets).
4. 🟡 442 hardcoded `http://localhost/SVR/...` URLs (incl. member-email `<img>` → broken images in emails today).
5. 🟡 Password storage still legacy plaintext/Base64 mix (frozen per owner; re-approve path exists for Phase E).
6. 🟡 API auth model: client-posted MatriID (app contract) — needs token migration w/ app release.
7. 🟡 `display_errors` ini-set in 4 non-API files; master-OTP removed but `resend_otp.php` unthrottled (deliberate, low risk).
8. 🟡 70 zero-in-tree-ref PHP pages (§4) — owner-confirmation gate before deletion.
9. 🟡 JS helper families with 5–8 behavioral variants each (§5).
10. 🟡 `.git` 85 MB (history purge incl. Phase-1 PII blobs — coordinated force-push op).

## 4. Remaining Dead Code (verified zero in-tree refs — **kept**, pending owner confirm)
- **Root pages (≈40):** `about-us2`, `contactus2`, `success_story2`, `my_offer2` (differ ≥93% from canonical — *not* duplicates), `login2.php`, `biodatadelete.php`, `backsign.php`, `checkban.php`, `compatibilitymatches.php`, `education_site.php`, `daily_matches.php`, `front_search_result.php`, `new-groom-bride.php`, `smart_search-multi.php`, photo-upload quartet (`photo_update`/`uplaod_photo`/`uploadmyphotos`/`uploadidproof`) + ID-proof trio variants, `notibell.php`, `modal_notification.php`, `check_modal_condition.php`, crons (externally invoked — **must stay**), `membership_choose_step.php` (Instamojo external callback — **must stay**).
- **Console (≈28):** chart/report family (`bar/line/donut/pie/high/main_chart`, `religionchart`, `site_statistics`), `HomePageGreetings.php` (production uploads prove usage), `googleanalytic.php`, `licences-matrimony.php`, `label_print.php`, AJAX-fragment family (`error_code`, `fill_subcaste`, `get_education`, `photo_approve1`, `pro_completed`, `profile_status`, `profilecompletion`, reports…).
- **Orphan CSS/JS:** admin theme demo styles (`landing.css` 121 KB, `layout-nested.css` 158 KB), `console/jslib` suite (runtime-loader uncertainty).
Full list: 70 files in audit artifact (regenerate: `/tmp/zero_ref_php.txt` snapshot method in Phase-2 report).

## 5. Remaining Duplicate Code
| Duplicate | Instances | Variants | Action |
|---|---|---|---|
| `blockSpecialChar()` inline JS | 39 files | **5** | hold (behavior risk) |
| `ValidateAlpha()` | 41 | **5** (33 majority) | hold |
| `isNumber()` | 40 | **8** (29 majority) | hold |
| `nospaces()` | 38 | **6** (two ×16 co-dominant!) | hold |
| CMS page families (`header/footer/popup` inline markup) | pervasive | — | Phase D componentization |
| Console form-generator pages (add_*/edit_*) | ~40 files | heavy near-dupe structure | Phase B candidate (template method) |

## 6. Remaining Broken References
- **Assets:** 726 unresolved refs / 197 files (live worst: `add_successstory.php` 29, `photo.php` 12, `template/includes/header.php`/`footer.php` 9 each — the new template's loose includes refs!). **0 introduced since Phase A (net − since Phase 2).**
- **Includes:** 10 targets missing (§1); 3 live pages affected.
- **AJAX:** 69 distinct JS endpoints, **2 unresolvable**: `payment_failed_handler.php` (LIVE payment telemetry — §3#2) and `/pages/test/` (vendor demo string).
- **Routes:** `.htaccess` friendly-URL is the only router; extensionless links in nav verified during Phase 2 (0 broken route refs); 404.php handles the rest.

## 7. Remaining Duplicate Assets (identical bytes, both copies live-referenced or blind-spot)
| Files | Why kept |
|---|---|
| `images/1.jpg` ⇆ `images/main-slider/1.jpg` (219 KB) | DB-content blind spot on hero/slider |
| `fa-{solid-900,brands-400,regular-400}d41d.eot` (3) | IE `<9` fallbacks referenced by live `fontawesome.css` |
| ckeditor `icons_hidpi.png` in plugins/ + skins/ (38 KB) | runtime path convention |
Total redundant bytes kept deliberately: **0.6 MB**.

## 8. High-Risk Areas (change-management notes for Phases B–F)
1. **Payments:** only small additive fixes (missing `payment_failed_handler.php` stub must be added *with owner approval* since it touches live checkout telemetry).
2. **Auth/password storage:** frozen unless owner re-approves.
3. **`god-table register` + `SELECT *`:** Phase-C must be column-explicit only where provably safe (a missing column in a row consumed by `mysqli_fetch_assoc`+template echo is invisible statically → page-family batching).
4. **APIs:** any change = mobile-app regression risk; only additive, contract-preserving edits.
5. **Sessions dir in webroot:** HTTP-denied today; any `.htaccess` regression re-exposes live sessions — treat `.htaccess` as load-bearing.
6. **Upload dirs (`adhar/ kundli/ gallary/ success/ uploads/`)**: runtime-generated names — moves prohibited.
7. **Console `.htaccess`-free zone:** console security rests solely on `protect.php` guards — guard integrity must be re-verified after any console refactor.
8. **Email layer:** PHPMailer 5.2.4 + 442 localhost URLs; inline-HTML email bodies in ~15 files — template extraction is Phase E, URL fix needs owner domain decision.
9. **`add_successstory.php` / `photo.php`:** live pages shipping warnings + broken images today — quick-win repairs should be first Phase-B/C batch (with staging visual check).

## 9. Change Summary (this phase)
| Type | Files |
|---|---|
| Added | `MODERNIZATION_AUDIT.md` (this document) |
| Modified / Deleted | **none** |

**Reason for every change:** the audit document itself is the deliverable; no other change was made.
**Risk assessment:** none — repository content is byte-identical to the previous commit except this file.

## 10. Validation Results
- All scan data above was gathered read-only against the committed tree; totals cross-checked in two independent scanners where applicable (asset refs: 726 occurrences / 639 unique file→target pairs — same findings).
- Since no executable file changed, the Phase-2 validation evidence (0 executable regressions, 0 broken includes added, 0 broken assets added) carries over unchanged.

## 11. Manual Testing Checklist (for reviewer, on staging)
1. `php -l` spot-check not required here (no PHP changes) — but confirm the repo checkout matches PR.
2. Confirm `MODERNIZATION_AUDIT.md` renders on GitHub.
3. (General gate that still stands for every future phase): `php -l` whole tree, smoke: member login, admin login, OTP, password reset, Razorpay test payment, Instamojo webhook test, photo upload, admin photo approval, one cron via CLI, one app API call.

## 12. Recommendations → Phase B (Architecture Refactoring) entry plan
1. **Start with the two quick-repair batches the audit surfaced (owner-visible):**
   a. restore/repair asset refs on `add_successstory.php`, `photo.php`, `template/includes/*`;
   b. add the missing `payment_failed_handler.php` (pending your explicit OK — touches live payment page telemetry).
2. Bootstrap layer: introduce `includes/bootstrap.php` that centralizes `sys_dbconnection` + `security` + `config` (additive; pages opt-in in batches — include hierarchy refactor target).
3. Console add_*/edit_* near-duplicate form handlers → shared handler pattern (mechanical, ~40 files, biggest single dedupe win, zero behavior change).
4. Shared model helpers for the `register` table reads that repeat verbatim (prepares Phase-C SELECT-* work).
5. Keep every batch below review size; apply the same stripped-executable equality proof per batch.

---
**⛔ STOP — awaiting your approval to begin Phase B.**
