# Rebranding Validation Report — Manpasand Jodidar (Final, Pre-Merge)

**Date:** 2026-07-31 · **Branch:** `arena/019fb6b6-svr` · **Scope of audit:** entire repository (all extensions, code + docs separated) · **Method:** static scanning (no PHP runtime in sandbox) + this session's phase-reported tallies · **Audit remediation commits:** `09c2627` (3 live references fixed, string-safe, documented) — no feature changes made, PR **not merged**.

Verdict up front: **all application-owned surfaces are fully branded.** Remaining old-brand material is a fully-enumerated set of (a) owner-decision items (mailbox, domain, SMS-DLT, third-domain legacy inside `apis/`), (b) intentionally preserved user/personal content, (c) inert on-disk files with zero references, (d) mock-fixture content in the unused `template/` directory, (e) DB values handled by the ready owner SQL pack.

---

## 1. Complete Brand Audit

Whole-repo scans (`--exclude-dir=.git`; code excludes `*.md`,`*.sql`; docs listed separately as intentional history).

| Category | Result | Evidence |
|---|---|---|
| Company name (Shivraj Maratha / शिवराज मराठा) | **0 in code** (only inside the SQL pack's REPLACE patterns + docs) | grep both scripts |
| Project name ("SVR") | internal-only: env/constants `SVR_DB_*`, `SVR_API_ADMIN_KEY`, `SVR_CRON_KEY`, `SVR_RZP_*`, `SVR_BRAND_URL` (8) — config identifiers, never rendered; `SVR_BRAND_URL`/`MPJ_BRAND_URL` are the rebrand's own central URL config | `SV R_*` census |
| Old logo names / URLs | **0 code references** (`shivraj-logo`, `logo.svg`, `logo-2.png`, `rd-logo.webp`, ckeditor-resolved local `img/logo*` excluded) | per-file ref proof |
| Old favicon | **0 refs** to `css3/assets/favicon_io/*` | ref scan |
| Old domain names | `weddingsparampara.com` = **kept production domain** (39 files; centralized override `SVR_BRAND_URL`) — decision item, not a defect. `dishavadhuvar.com` / `dishavadhuvar.thebankingservices.com` = **third legacy brand found in `apis/`** → see box below | domain census |
| Old email addresses | `info@shivrajmaratha.com` ×17 (SMTP identity, owner decision); `support@weddingsparampara.com` ×2 (`admin_mail.php:80`, `mail.php:54` From headers — kept domain, old identity); `no-reply@/info@dishavadhuvar.com` in apis | sender census |
| Old phone numbers | only ops numbers present (91-9403550087 ×4, 9404500378, 9422524060, 919422524060) — same business, verify currency (manual item); DLT SMS contains "Welcome To Jaipur" + "Mahadi Group" (locked) | phone/DLT scan |
| Old social media links | **none old-brand**; footers carry placeholder root links (facebook.com/, twitter.com/, instagram.com/, youtube.com/ ×2 families) | footer.php:206-209, footer3.php:370-373 |
| Old copyright text | **0 hardcoded**; footer text is DB-driven (`copyright_footer`) → SQL pack | scan |
| Old meta titles / descriptions | **0** (2 stray `<title>weddingsparampara.com</title>` inside email heads fixed in `09c2627`); `$page_title`/`$page_description` overrides = Manpasand Jodidar | scan |
| Old Open Graph / Twitter Card | **0 old**; full OG+Twitter defaults live in `header3.php` (9 og tags incl. og-image.jpg) | header3 wiring |
| Old SEO keywords | DB `seo` table → pack; no hardcoded old keywords in code | scan |
| Old watermarks | **0** old watermarks; print uses new `watermark.png` | prints R5 |
| Old PDF branding | no PDF engine exists (prints are HTML→browser PDF) — prints rebranded | lib scan (0 tcpdf/dompdf/mpdf/fpdf) |
| Old biodata branding | both biodata prints rebranded (letterhead + watermark) | R5 |
| Old email branding | 18/18 templates wrapped (MPJ-EMAILWRAP), letterhead absolute URLs | R5 |
| Old WhatsApp branding | 16/16 share sites branded; no old text | R5 |
| Old invoice branding | invoice prints + Razorpay dialog branded (09c2627 closed the last gap) | audit fix |
| Old loading/splash screens | pageloader uses `branding/images/splash-logo.jpg`; preloader.svg recolored | R3 |
| Old browser titles | **0** (post audit fix) | scan |
| Old admin branding | console + agent fully reskinned (R4); login medallions present | R4 |
| Old CMS content | DB-side → SQL pack; `about-us.php` runtime shield active | §2 |
| Old configuration values | DB config → pack; code config constants are non-branded internal names | §2 |
| Old environment variables | env names are internal `SVR_*` (not rendered) — classified internal, kept for backward compatibility | census |
| Old constants | same class as env names | census |
| Old asset filenames | on-disk keep-list = inert (0 refs) → `REBRANDING_ASSET_MAP.md §6` | asset audit |
| Old CSS class names containing old brand | `mvv-` prefix family in 73 files (legacy "Maratha Vadhu Var" design-system prefix from the pre-rebrand MVV css layer); `svr_`/ internal helpers. **Not user-visible text** → technical-debt item (§8), renaming = large refactor risk for zero user benefit | prefix census |
| Old JavaScript variables containing old brand | `$_SESSION['_shivraj_header_counts']` ×5 in `header.php` (session cache key, invisible) — kept, renaming only invalidates sessions | census |

### ⚠ Discovery item (owner decision required): `apis/` = "Dishavadhuvar" legacy layer
The mobile API layer still carries the **older "Disha Vadhu Var" product identity** (this codebase's upstream). 18 files, ~29 occurrences in four classes:
1. **FCM project id** `'dishavadhuvar-4c458'` ×6 — Firebase console identity; changing it breaks push until re-registered.
2. **FROM identity** `Dishavadhuvar <no-reply@dishavadhuvar.com>` / `info@dishavadhuvar.com` (accept-interest, send-interest, forgot-password) + push text "Team Dishavadhuvar!" (diwali_notification).
3. **Absolute URLs in API-driven emails/notifications** pointing at `www.dishavadhuvar.com` (photo + view-profile links ×6) and `dishavadhuvar.thebankingservices.com` (forgot-password reset link, test sample).
4. **JSON field value** `'watermark' => 'dishavadhuvar.com'` ×10 in the search/get endpoints — visible inside the mobile app.
These were deliberately NOT edited (API contract + external service identities). Recommended owner change-set is listed in §7.

## 2. Database Verification

Full companion: **`REBRANDING_DATABASE_MAP.md`** (tables, columns, expected records, skips, rollback). Coverage was re-verified end-to-end during this audit and the pack was **extended** with two newly-confirmed application-owned branding surfaces found by the audit:

| Table.column | Why included | Pack status |
|---|---|---|
| `siteconfig.app_name` | used as sender/team name in both birthday-cron emails (`$siteinfo['app_name']`) | **added** (UPDATE + preview) |
| `email_sending.from_name` | SMTP display name rendered in every PHPMailer message (`smtp2.php`) | **added** (UPDATE + preview; `username` mailbox explicitly protected) |

Previously covered: `siteconfig.Webname`, `siteconfig.copyright_footer`, `cms.content`, `seo.title`, `seo.description` (+commented keywords), previews + verify queries. **Record counts:** retrievable only on the live DB — pack STEP-0 previews return them; code-observed expectations: siteconfig 1, email_sending 1, seo ≈11, cms = LIKE-filtered subset. **Manual review + skip list + rollback recipe:** DB map §5–§6.

## 3. Asset Audit — see `REBRANDING_ASSET_MAP.md`

✅ One active logo family ✅ one active favicon family ✅ no duplicates ✅ no orphans ✅ no page references deleted assets (post-retirement scan = 0; CKEditor hits are its own vendor tree).

## 4. UI Audit (major screens)

| Screen | State | Evidence |
|---|---|---|
| Home (`index.php`) | ✅ brand head (icons/OG/theme-color), hero illustration, palette, ornaments, tagline footer | R2/R3 |
| Login (`login.php`) | ✅ header3 family, OG, brand palette | R2/R3 |
| Registration (`signup.php`) | ✅ header3 family | grep + R2 head wiring |
| Member Dashboard (`index_dashboard.php`) | ✅ header.php family — R3 palette css + R2 icons; private screen (no OG needed) | family check |
| Profile (`public_profile.php`, full pages) | ✅ per-profile OG preserved + OG defaults | R2 |
| Search (all result pages) | ✅ palette, share text branded | R3/R5 |
| Membership (`membership_choose.php`) | ✅ palette + **checkout logo fixed (audit)** | 09c2627 |
| Payments (Razorpay dialog, `payment_success.php` page + email) | ✅ emblem dialog; payment email letterhead | R5/audit |
| Contact (`contactus.php`) | ✅ header3 family | R2/R3 |
| Admin Dashboard + 322 console pages | ✅ burgundy chrome, gold hairline, charts branded | R4 |
| Admin Login (`console/login.php`) | ✅ serif welcome, medallion, brand head | R4 |
| Emails (18 templates) | ✅ letterhead + footer tagline | R5 |
| PDFs | n/a — no PDF engine; browser prints | audit |
| Biodata (member + console) | ✅ letterhead + watermark inline | R5 |
| WhatsApp Share | ✅ brand + tagline at all 16 sites | R5 |
| Error Pages (`404.php`) | ✅ branded title/meta (Manpasand Jodidar) | R2 + scan |

## 5. SEO Audit

| Item | State |
|---|---|
| Title tags | ✅ clean (0 old-brand); per-page `$page_title` + defaults |
| Meta descriptions | ✅ header3 default + `$page_description` override; header.php-family pages keep their own (member screens) |
| Open Graph | ✅ all 28 header3-family public pages (site_name/image/title/description, og-image.jpg) |
| Twitter Cards | ✅ summary card via header3 defaults |
| Structured Data (JSON-LD) | ⚠ **absent repo-wide** — roadmap item (Organization schema) |
| Canonical URLs | ⚠ **absent repo-wide** — roadmap item |
| Sitemap | ⚠ **none** (`sitemap.xml` does not exist) — roadmap item |
| Robots | `robots.txt` = allow-all, no sitemap directive (valid; add sitemap line when sitemap exists) |
| SEO meta table content | DB → SQL pack (seo.title/description) |

The three ⚠ items are pre-existing SEO gaps, not old-brand residue; adding them is a feature decision flagged for the roadmap (not done in this audit per "no feature changes").

## 6. Documentation generated (this audit)

- `REBRANDING_VALIDATION_REPORT.md` (this file)
- `REBRANDING_ASSET_MAP.md`
- `REBRANDING_DATABASE_MAP.md`
- `database/rebranding-r5-owner.sql` **extended** (app_name + email_sending.from_name + previews/verifies)

## 7. Remaining Manual Tasks (owner — none block go-live except #1 if you choose the new domain)

| # | Task | Where/how |
|---|---|---|
| 1 | **Swap in the original production logo file** (AI-recreated master is in place now) | replace `branding/logos/manpasand-jodidar-logo.png`, run `branding/tools/rebuild-assets.sh` (regenerates every derivative incl. favicons) — guide §4 |
| 2 | **Run the SQL migration** on a backed-up DB (previews → updates → verify) | `database/rebranding-r5-owner.sql` |
| 3 | **Production env values** — only if the site moves to a new domain: set `SVR_BRAND_URL` (one constant; 39 code refs follow automatically) | `includes/branding.php` |
| 4 | **DLT-approved SMS templates**: re-register "Manpasand Jodidar" templates, then update `asysendotp.php` + `registrationconfirmation.php` texts | §1 table |
| 5 | **Email sender addresses / mailbox**: migrate `info@shivrajmaratha.com` (17 code refs + `email_sending.username`), revisit `support@weddingsparampara.com` From headers (2), then update all in one coordinated change | DB map §5.3 |
| 6 | **apis/ "dishavadhuvar" legacy** — with Firebase + app-team coordination: new FCM project id (6), FROM name (3 files + 1 push text), URLs (8), JSON watermark value (10 search endpoints) | §1 box |
| 7 | **Social media links**: set real profile URLs (console social screen / siteconfig) — currently placeholder root links | footers |
| 8 | **Payment gateway branding**: Razorpay dashboard logo/colors are dashboard-side (code now sends emblem) | Razorpay console |
| 9 | **Favicon regeneration**: automatic via rebuild script after task #1 — no separate work | tools |
| 10 | **CDN edge cache**: purge `/branding/*`, css/js, and any cached HTML after deploy | hosting panel |
| 11 | **Browser cache**: `style.css`/`mpj-brand.css` changed in place — consider a version query (`?v=`) on first deploy or advise hard-refresh; CSS is not fingerprinted in this codebase | note |
| 12 | Optional SEO roadmap: canonical tags, JSON-LD Organization schema, `sitemap.xml` + robots sitemap line, OG for `forgot_password.php` | §5 |

## 8. Final Repository Health Report

**Whole PR #1 vs base `efaf8e1`** (security + cleanup + audit + architecture + rebrand):
`968 files changed, +11,164 / −28,033` (A 58 · M 620 · D 290)

**Rebrand subset R1–R5 + audit (vs `b5f6422`, parent of first R1 commit):**
`377 files changed, +5,665 / −2,919` (A 41 · M 330 · D 6)

| Metric | Value |
|---|---|
| Files modified (rebrand) | 330 |
| Files added (rebrand) | 41 (brand kit, guides, mpj-brand.css, SQL pack, reports) |
| Files deleted (rebrand) | 6 (zero-ref vendor demo SVGs) |
| Total branding references replaced | ≈ **3,150 exact-string replacements** — R2 713 (502 URLs + 211 strings), R3 913, R4 1,435 (theme/inline/charts/wiring actions), R5 ~80 (wraps/share/sweep), audit 3 — plus 205 head-wiring lines and 134 console link insertions |
| Remaining branding references | 0 defects open. 31 owner-decision endpoints (17 mailbox + 2 From + ~29 apis legacy incl. multi-line) + kept user/personal content + inert files — all enumerated above |
| Technical debt remaining | `mvv-` css prefix family (73 files, internal), `SVR_*` internal env/constant names, `$_SESSION['_shivraj_header_counts']`, `template/` mock fixture old-content (incl. one decorative `content:'शिवराज'` css watermark — unused dir; one-line fix documented), two design-system generations (header.php/header3 families), console dark theme = recolor not designed theme |
| Deployment checklist | 1) staging `php -l` loop over edited files 2) smoke: home/login/signup/dashboard/search/membership/checkout 3) send one email per template family 4) print biodata + invoice 5) WhatsApp share 6) admin login/dashboard/agent 7) merge PR 8) purge CDN/browser caches 9) owner runs SQL pack 10) execute §7 items at own pace |
| Rollback checklist | 1) code: `git revert` the merge (or per-phase ranges — each is a clean band) 2) DB: `mysql < backup-pre-rebrand.sql` (pack header) 3) assets: deleted SVGs recover via `git checkout efaf8e1 -- <path>` 4) runtime shield keeps about-us branded regardless 5) no session/secret changes exist in the rebrand work — no key rotation needed |

---

**Merge instruction (unchanged): PR #1 stays OPEN until your explicit approval.**
