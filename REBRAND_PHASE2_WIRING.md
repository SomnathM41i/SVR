# REBRAND PHASE 2 (R2) — BRAND TEXT & ASSET WIRING — REPORT

**Branch:** `arena/019fb6b6-svr` · **PR:** #1 (updated; **not merged**)
**Scope:** rewire every old-brand asset reference and visible brand string to
**Manpasand Jodidar**; wire favicons/touch icons/manifest/theme-color/OG
defaults; console+agent titles. First phase with user-visible changes.

---

## 1. Rebranding Summary

| Workstream | Scale | Result |
|---|---|---|
| `shivraj-logo.png` URL references | **502 swaps / 259 files** (440 `http://localhost/SVR/…`, 61 relative, 4 console-relative; categories: 396 favicon links, 20 e-mail slots + 2 push payloads, 71 page-chrome, 4 letterheads, 6 PHP logo vars, 2 CSS, 1 loader) | **0 remain** |
| Visible brand name | 83 × “Shivraj Maratha” + 3 × banner-comment uppercase + 13 × Devanagari wordmark + 2 × emblem monograms → new brand | **0 remain** |
| Vendor/junk metas | 122 DashboardKit store-bought meta descriptions (+1 success-story page) → brand metas | **0 remain** |
| Head wiring | 202 legacy pages + `header3.php` family (28 pages) + template dir: apple-touch-icon, manifest, theme-color; `header3.php` adds default meta description + full OG/Twitter fallback set | live |
| Titles | homepage default, admin dashboard, admin login, 404 | rebranded |
| Broken-in-production fix | e-mail logo `<img>` + FCM push images pointed at `http://localhost/SVR/…` today → absolute production URLs | **fixed** |

## 2. Branding Changes (decisions & rationale)

| Decision | Rationale |
|---|---|
| Favicon `<link>`s → `branding/favicons/favicon.ico` (16/32/48 multilayer); `type="image/png"` lines → `icon-32.png` | 1:1 mechanical swap, MIME stays correct |
| Page-chrome `<img>` (navbars, sidebars, auth, footers, theme JS `.attr('src')`) → `logos/emblem.png` | square roundel matches 50–100 px slots, no layout shift |
| E-mail slots (`width='168'…`, automails, API-sent mails) → absolute `…/logos/logo-horizontal.png` | 3.36:1 lockup preserves exact 168×50 geometry; brand type cropped from master (never re-typeset) |
| Print letterheads (getinvoice, profile_print_my ×2, full_profile) → horizontal lockup; full_profile slot `250×64 → 250×74` | aspect-correct, single documented attr edit |
| `pageloader1.php` (unused) → `images/splash-logo.jpg`; razorpay checkout logo → `emblem.png`; merchant name → brand | completeness |
| Legacy pages (body-included headers) get icon/manifest/theme-color per-page; `header3.php` family gets description+OG centrally | header.php is included after `<body>` — cannot host `<head>` tags (proven: daily_matches.php:513→521) |
| OG/Twitter fallbacks emit only when `$page_og_*` unset | public_profile.php’s per-profile OG keeps winning; no duplicate tags |
| **Protected, unchanged:** `info@shivrajmaratha.com` (17 refs — live operations mailbox), testimonials quoting the old name (2), proprietor signatory name (2), WhatsApp verify token, `weddingsparampara.com` domain as URL base, DB `$seof` SEO content | functionality & user data outrank string purity; mailbox needs owner decision; DB → R5 optional SQL |

## 3. Files Modified (unique: 466 + 3 shared-header families)

- 259 asset-URL swap files; 172 string files; 202 wiring inserts + header3.php + template/includes/header.php + 25 path-fix files (§5 fix #2).
- `includes/branding.php`: +`logo_horizontal` key. `branding/tools/rebuild-assets.sh`: +section 13.

## 4. Files Added

`branding/logos/logo-horizontal.png` (1008×300, PNG8/128, 72 KB) — landscape lockup. Report + changelog updates.

## 5. Files Deleted

**None.** Old assets (e.g. `css3/assets/shivraj-logo.png`, `images/logo-2.png`) retire in R5
after zero-reference proof. Two defects caught & fixed inside the phase:

1. **xargs quoting** — `console/add_faq's.php` broke the first favicon commit;
   remainder (141 files) landed in addendum commit `e20740c` with explanation.
2. **Path typo** — e-mail/letterhead refs initially pointed to
   `branding/images/logo-horizontal.png` while the file lives in
   `branding/logos/` — caught by the mandatory asset-resolution sweep;
   25 files re-pointed, sweep re-run green.

## 6. Screens Updated (user-visible)

All public pages (favicons/title suffixes/meta), member pages incl. profile
prints & invoice, e-mail headers (interest/shortlist/registration/forgot/
birthday/membership/payment/admin mails), FCM push images, admin console
(meta+titles+sidebar logo, 122 files), agent panel (logo+footer), 404 page,
landing family via `header3.php` (icons, description, OG/Twitter, manifest).

## 7. Remaining Branding References (deliberate — owner/deferred)

| Reference | Why it stays | Gate |
|---|---|---|
| `info@shivrajmaratha.com` (17 refs) | live operations mailbox | owner confirms/creates new mailbox |
| `weddingsparampara.com` (36+13 URL refs) | current production domain | domain decision → `SVR_BRAND_URL` flip |
| DB-driven SEO/CMS (`$seof['description']`, cms pages, `siteconfig` row) | live data | optional owner-run SQL (R5) |
| Testimonials / proprietor name | user & personal content | never change (policy) |
| `webhook/whatsapp.php` verify token; `readymatrimonial.in` anchor href in 1 approval e-mail | functional secret / third-party link | owner |
| `about-us.php` `$legacyByline = 'Sanskriti Parampara'` (unused mock page) | legacy sample byline | R5 sweep list |
| Old logo **files** on disk (`css3/assets/shivraj-logo.png`, `images/logo-2.png`, `img/logo*.png`, …) | zero-ref proof before deletion | R5 retirement |
| `git` history / prior phase reports mention old strings | historical record | intentionally kept |

## 8. Validation Report (executed)

| Check | Result |
|---|---|
| Old `shivraj-logo` refs (php/css/html/js) | ✅ 0 |
| Old brand strings in PHP (4 patterns + DashboardKit meta) | ✅ 0; “Manpasand Jodidar” now 214 occurrences |
| Asset-resolution sweep (every `branding/` href/src/url incl. absolute) | ✅ all resolve (final re-run after §5 fix #2) |
| Per-file diff reconciliation vs driver maps | ✅ swap: 259/259 files, adds==dels==expected per file; strings: 172/172; inserts: exactly +808/−0 |
| Suspect-line scan (added lines not containing brand tokens) | ✅ 0 |
| Tokenizer signature (strings-first) across 287 changed PHP files | ✅ 6 apparent flips fully diff-proven intended-only (`<?php //link` comment lines + theme JS hook + meta swap) |
| Skip-list proofs | ✅ mailbox 17/17 intact, testimonials 2/2, proprietor 2/2, webhook token 1/1 |
| OG duplication analysis | ✅ page-level + fallback conditionals mutually exclusive |
| Sample renders eyeballed | ✅ legacy head (daily_matches), header3 head+OG, e-mail slot, console head |
| Sandbox limits | ⚠️ no PHP runtime → staging `php -l` + smoke remains the merge gate |

## 9. Risk Assessment

| Risk | Level | Mitigation |
|---|---|---|
| E-mail clients cache/block absolute images occasionally | Low | standard practice; URLs verified live-domain; alt text preserved |
| `info@shivrajmaratha.com` still visible next to new logo | Cosmetic | flagged for owner (mailbox creation) |
| OG defaults subtle vs old blank behavior | Low | only adds tags; page-level overrides unchanged |
| 466-file diff review burden | Med | all changes 100% mechanical + machine-reconciled; category commits |

Functionality/business logic/API contract/schema: **untouched** (verified by
tokenizer + diff reconciliation + category counts).

## 10. Manual Testing Checklist (staging)

- [ ] Home + a member page + search result: favicon shows heart emblem; `<title>` ends “- Manpasand Jodidar”.
- [ ] View-source home: meta description, og:site_name/image, twitter card present; manifest link 200s.
- [ ] Trigger “send interest” on staging: e-mail shows horizontal logo banner (not broken).
- [ ] Admin console: login page title/logo, dashboard sidebar logo, meta.
- [ ] Razorpay checkout modal: merchant name “Manpasand Jodidar”, emblem logo.
- [ ] Share any page to WhatsApp/validator: og:image renders the gold-framed card.
- [ ] `php -l` on header3.php + a sample of touched files.

## 11. Remaining Technical Debt

Carried from R1/current: §7 rows (mailbox, domain, DB SEO text, old files),
439 `localhost/SVR` non-logo URLs still open (outside brand scope), `$seof`
DB content, template/ mock family (unused), `--mvv-*` legacy design tokens
(R3 re-skins via token remap).

## 12. Recommendations for Next Phase (R3 — Public UI skin)

1. Re-skin `--mvv-*` variable block to MPJ palette in `header.php`/`header3.php`/`css3/mvv-premium.css` + link `branding/branding.css` + Google Fonts per `TYPOGRAPHY_GUIDE.md` §3.
2. Landing/hero polish (logo-badge on maroon footer, `.mpj-divider`, splash art), standardized buttons/forms/cards via tokens.
3. Login/register/search/profile/membership page families; responsive verify (mobile/tablet/desktop).
4. Same guardrails: small commits, mechanical proofs, stop after phase.

**Stopping here for approval, per the phase protocol.**
