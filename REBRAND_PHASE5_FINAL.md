# Rebrand Phase R5 — Emails · Print/Biodata · Share Text · Residual Sweep · Final

**Commit range:** `481190f..0950a50` (6 commits) · **50 files, +376/−105**
**Scope:** every outbound email template, member/console print & biodata sheets, invoice print, WhatsApp share text, residual old-brand sweep, 0-reference asset retirement, owner-run DB brand pack, final validation + runbook.

## 1. Rebranding Summary

- **All 18 transactional email templates** now render inside the brand letterhead: cream wrapper → bordered white card → cream header with the `email-logo.png` vertical lockup → 3px gold divider → content cell → burgundy footer with gold-light text and the tagline in gold-bright. System font stacks (Georgia, serif) for mail-client compatibility.
- **Print surfaces** (member biodata print, console biodata print, invoice print) gained a proper brand letterhead (`print-logo.png` + serif tagline + double gold rule) and the 10%-alpha `watermark.png` emblem centered over content.
- **WhatsApp share text** on all 16 share call sites names the brand and the tagline.
- **Residual sweep:** old-name CSS banner comments, mock default title, 404 stylesheet typo link — cleaned; everything else is proven-protected.
- **Vendor demo asset retirement:** 6 indigo DashboardKit SVGs removed with zero-reference proof.
- **DB brand text:** optional owner-run SQL pack shipped (`database/rebranding-r5-owner.sql`); code never applies it.

## 2. Branding Changes (per commit)

| Commit | Change | Proof |
|---|---|---|
| `af50076` | Letterhead wrap on 17 email templates (anchored `<body>` insertions, marker `MPJ-EMAILWRAP` ×2/file) | quote-parity vs HEAD identical in all 17 |
| `d8a73c0` | Corrective: 18th template found inside `full_profile.php` (page-categorized); initial spec bug would have wrapped the **page** `<body>` (occ 0) — caught, reverted via `git checkout`, spec fixed to occ 1, re-applied to the email body only. Also absolute-ized the one relative letterhead URL | dq/sq parity identical; in-phase defect documented |
| `be37772` | Print letterheads + watermark on `profile_print_my.php`, `console/profile_print_my.php`, `getinvoice.php` — **all styling inline by design** because these pages' `print_report()` swaps `document.body.innerHTML` (head `<style>` would not survive into the printed copy) | dq parity green; assets resolve |
| `a2fc761` | WhatsApp share text branded (16 sites, 32 exact swaps) | parity verified post-commit: NONE failed |
| `5d83b9b` | Residual sweep: `Style.css`/`lagnam-design.css` banner comments → Manpasand Jodidar; mock `template/includes/header.php` default title → tagline | global scans: neon hexes 0, old logo URLs 0 |
| `0950a50` | Retire 6 zero-ref vendor demo SVGs (`git rm`); remove 404 `stylnew.css` typo link (never-existed file, zero visual change); add `database/rebranding-r5-owner.sql` | reference proofs in commit message |

**Deliberate no-touch with reasons:**
- **SMS bodies** (`asysendotp.php`, `registrationconfirmation.php`): they mirror DLT-registered gateway templates (`{#var#}` comments). Editing text risks live OTP rejection — owner must re-register templates under the new brand first (listed in the SQL pack footer).
- **API JSON contract** (`apis/`): keys/structure untouched; image URLs inside were already brand absolute.
- **User-content in DB** (success stories, testimonial quotes): explicitly excluded from the SQL pack.
- `info@shivrajmaratha.com` ops mailbox (17 refs), webhook verify token, `readymatrimonial.in` anchor — owner decisions, unchanged.
- `css3/assets/shivraj-logo.png` — kept (0 code refs, but DB/CMS hot-link risk; history-preserving decision deferred to owner after SQL pack).
- `$_SESSION['_shivraj_header_counts']` internal cache key — internal identifier, not visible branding.

## 3. Files Modified / Added / Deleted

- **Added:** `database/rebranding-r5-owner.sql`, this report.
- **Modified (48):** 18 email-template files, 3 print files, 16 share-text files, `css3/Style.css`, `css3/lagnam-design.css`, `template/includes/header.php`, `console/User_Profile.php`, `REBRANDING_CHANGELOG.md`.
- **Deleted (6):** `console/assets/images/{favicon,logo,logo-dark}.svg`, `console/assets/images/pages/{coupon,interview,voucher}.svg` — zero-reference vendor demo marks. Recovery: `git checkout efaf8e1 -- <path>`.

## 4. Screens / Surfaces Updated

Every transactional email (interest accepted, shortlist, OTPS, registration, birthday crons — public & console, personal mail, paid-form approval, payment success, photo-issue, password reset, profile-view), member biodata print, admin biodata print, invoice print, WhatsApp share cards on all match/result pages and the public profile.

## 5. Remaining Branding References (final, all classified)

| Item | Status |
|---|---|
| `Shivraj Maratha` string | only inside `database/rebranding-r5-owner.sql` as REPLACE patterns (intended) |
| Proprietor personal name, testimonial quotes (EN + MR) | **kept** — personal name / user content |
| SMS "Mahadi Group / Welcome To Jaipur" | **kept** — DLT template lock; owner re-registration path documented |
| Ops mailbox, webhook token, agency anchor | owner decisions, documented in SQL pack footer |
| DB `siteconfig`/`cms`/`seo` text | runtime shield active on about-us; SQL pack ready |
| shivraj-logo.png file | kept pending DB-content audit by owner |

## 6. Validation Report (static, no PHP runtime)

1. Phase diff: 50 files, +376/−105, 6 commits.
2. Quote-parity (double & single) vs HEAD **identical on every edited PHP file** (17+1 email, 16 share, 3 print) — no PHP string can have broken.
3. Idempotency markers: 18 templates × 2 `MPJ-EMAILWRAP`.
4. Global scans at completion: old logo URLs 0 · neon hexes 0 · `logo-dark.svg` 0 · old-name strings 0 outside the SQL pack's REPLACE patterns · letterhead/watermark/print-logo/email-logo asset files all resolve.
5. Print styling delivered inline because `print_report()` rebuilds the DOM without head styles (verified in code paths of all 3 print files).
6. Retirement proofs: per-asset `refs(excl self): 0`; the two stray `logo.svg` hits traced to CKEditor's own `img/logo.svg` samples (unrelated vendor tree, kept).

## 7. Deployment Notes & Risk Assessment

- No build step, no code-applied migration. Deploy = push/pull. Emails/prints take effect immediately.
- **Risk: low.** Highest-touch change is the email wrap; HTML is nested-table (mail-client-safe), PHP-string integrity proven by parity scans, but send **one real test mail per template family** on staging (e.g. OTP + interest + birthday cron dry run) before production flip.
- Print: verify one biodata + one invoice with "Background graphics" on/off — watermark uses an `<img>` (prints either way), gold rules are borders (always print).
- SMS: intentionally unchanged; OTP flow safe.
- DB pack is optional and owner-run; the app is fully branded without it thanks to runtime shields.

## 8. Manual Testing Checklist (staging)

- [ ] Trigger OTP email + one interest email: letterhead renders in Gmail/Outlook, footer tagline gold-on-burgundy
- [ ] `php -l` smoke: all 18 email files, 3 print files, 16 share files, `console/User_Profile.php`
- [ ] Print biodata (member + console) → PDF: letterhead visible, watermark faint behind table
- [ ] Invoice print: gold rule under header, watermark behind
- [ ] WhatsApp share from a search result: message text shows brand + tagline
- [ ] Commented/secondary bodies untouched: forgot-password page renders normally (its page `<body>` must NOT carry the letterhead)
- [ ] `console/User_Profile.php` loads identically to before (404 link removal = no visual diff)

## 9. Remaining Debt (final honest list)

1. SMS brand strings (DLT re-registration required first).
2. Ops mailbox migration decision (`info@shivrajmaratha.com`).
3. DB config/CMS/SEO old-name values until owner runs the pack.
4. `shivraj-logo.png` physical file (post-SQL-pack audit).
5. Duplicate `id="main-style-link"` on some console pages (pre-existing markup quirk; cosmetic).
6. Dark-console theme is a warm recolor, not a designed dark brand theme.
7. Parked pre-rebrand modernization roadmap (Phases C–F from the architecture plan) remains available after the rebrand closes.

## 10. Recommendation — Close-out

Open PR #1 review per phase range (R1 `74d673e..030025e`, R2 `030025e..ea5858c`, R3 `ea5858c..c48c413`, R4 `c48c413..481190f`, R5 `481190f..0950a50`), stage, run §8 checklist, then merge. Post-merge: owner items in `database/rebranding-r5-owner.sql` footer (mailbox, DLT, DB pack) at own pace — none block go-live.
