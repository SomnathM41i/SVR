# Rebrand Phase R4 — Admin Console + Agent Panel Skin

**Commit range:** `c48c413..481190f` (6 commits)
**Scope:** `console/` (322 PHP pages, DashboardKit/Bootstrap 5 admin theme) and `agent/` (agent self-service panel). Cosmetic-only guarantee: no PHP logic, no JS logic, no DB, no URL/behavior changes — colors, one additive stylesheet, one stylesheet `<link>` per page, brand fonts on login/agent surfaces, string literals in two JS config lines.

## 1. Rebranding Summary

The admin console shipped with the unmodified DashboardKit indigo theme (`#7267EF` primary, 400+ occurrences across two 2 MB compiled stylesheets) plus a dark-slate chrome (`#1c232f`/`#293240`) — the "generic Bootstrap admin" look the brief forbids. The agent panel and the two login screens carried an older ad-hoc "premium" palette (`#C9A84C` gold / `#8B1A2F` crimson) that predates the official brand tokens.

R4 converts the entire operator-facing surface to the Manpasand Jodidar palette:

- Theme primary indigo → **maroon family** (`#7A1F39` primary, `#5E1426` hover/dark, `#3D0C19` deepest, rose tints for "light-primary" chips).
- Dark chrome slate → **burgundy/plum** (`#3D0C19` surfaces, `#43303A` ink), so the top bar and horizontal nav became on-brand automatically through the theme's own `.bg-dark`/`.topbar` rules.
- Old ad-hoc premium palettes in 11 console pages + 2 agent files → official brand tokens.
- New additive accent layer `console/assets/css/mpj-brand.css` for the signature maroon+gold chrome (gold hairlines, gold-ring emblem medallion, auth card gold strip).
- Brand typography (Playfair Display / Poppins) on the login screens and the agent panel; the dense 322-page console interior deliberately keeps the vendor font stack (layout stability on data tables).
- Dashboard **chart palettes** (apexcharts/highcharts/chart.js configs) indigo/blue → maroon/rose/gold.

## 2. Branding Changes (all exact-string, enumerated, reconciled)

| Commit | Change | Scale |
|---|---|---|
| `4fc9e7e` | Vendor theme palette remap (8 files): `#7267EF→#7A1F39`, `#5d50ed/#5b52bf→#5E1426`, `#443e8f→#3D0C19`, indigo tints→rose tints (`#F4DEE4/#E9B9C5/#EFCBD4/#FBF0F3`), `#1c232f→#3D0C19`, `#293240→#43303A`, `rgba(114,103,239,*)/rgba(28,35,47,*)` alphas preserved, style-dark deep surfaces warmed, neon `#ec167f` stragglers in console copies→`#C9556A` | 981 swaps, brace balance byte-identical |
| `63d8a1e` | New `console/assets/css/mpj-brand.css` (gold hairline chrome, medallion ring, auth strip, focus utility) wired into **134 pages** (129 `style.css` + 42 `stylenew.css` first-theme-link rule; prefix `../console/` preserved for agent) | +134 lines, 1 link/page, all outside PHP regions |
| `8c5bb7d` | Console inline premium palettes → brand tokens (11 pages incl. dashboard, login, profile_view, agent_common): old gold/crimson/violet-ink/cream families, `#007bff` Browse buttons → `#7A1F39` | 79 swaps |
| `e0ae7cb` | Agent panel skin: remap (17) + `ap_start()` brand typography & chrome (gradient top bar/footer, medallion, serif titles), agent + console login polish (burgundy veil, gold strip, serif headings) | 4 files |
| `c6d382e` | Integrity fixes: URL-encoded `%237267EF` checkbox/radio data-URIs → maroon (5+5); unused `landing.css`/`layout-nested.css` family remap (26); customizer JS `cust-sidebrand` off-branch logo string → emblem (47 pages, 1 each — second branch was already emblem) | 36 + 47 |
| `481190f` | Chart palettes: series `#7267EF→#7A1F39`, `#7759DE/#775DD0→#A63E52`, `#448AFF→#DDB15F`, `#C7D9FF→#F2CFD7` in 8 chart JS configs + 3 chart pages; icons8 URL color params follow | 146 swaps |

**Deliberately retained (documented, not omissions):** semantic status colors — danger `#EA4D4D`, success `#17C666`/`#0e9e4a`/`#3cb87a`, warning `#ffa21d`/`#f0a030`, info `#3ec9d6`, and admin status accents "free `#6C63FF` / expired `#E05C6A` / banned `#4AABB8`" (legibility beats purity for status chips); `apexcharts.min.js` library defaults (vendor lib, overridden by every chart config); popup.css SweetAlert palette (plugin-owned); neutral Bootstrap grays.

## 3. Files Modified / Added / Deleted

- **Added (1):** `console/assets/css/mpj-brand.css`.
- **Modified (154 unique PHP/CSS/JS files):** 8 theme css + 2 demo-layout css (commit 1+5); 131 console pages + 2 agent files wired with brand link (commit 2 — includes agent/common.php & agent/login.php); 11 console pages inline palettes (commit 3); agent/common.php, agent/login.php, console/login.php polish (commit 4); 47 console pages customizer logo string (commit 5); 8 chart js + 3 chart pages (commit 6).
- **Deleted:** none.

## 4. Screens Updated

Admin login (`console/login.php`), admin dashboard (`console/index.php`) and every console page using the shared theme (134), all console list/form/report pages via theme remap, agent login (`agent/login.php`), agent dashboard/customers/commission/withdrawal/profile (`agent/*` via `ap_start()`), chart-bearing screens (dashboard-main/sale/help, religionchart, stacked_bar, profile_view charts).

## 5. Remaining Branding References (known, scoped for R5)

| Item | Where | Disposition |
|---|---|---|
| DashboardKit demo SVGs (indigo) | `console/assets/images/{favicon,logo,logo-dark}.svg`, `images/pages/{coupon,interview,voucher}.svg` | **0 references** after this phase — R5 retirement candidates (kept per uncertainty rule) |
| `apexcharts.min.js` default palette | vendor plugin | Won't fix (library internals; every config overrides) |
| `assets/css/stylnew.css` typo link in `console/User_Profile.php:45` | pre-existing 404, harmless | Documented debt; removing it changes nothing visually — R5 may clean |
| Dark-mode toggle (`#cust-darklayout`) | 47 pages | style-dark.css fully remapped; mild cosmetic risk remains (see risks) |
| DB-stored `siteconfig`/CMS brand text | DB | Owner-run SQL in R5 (never code-applied) |
| Email templates / PDF-biodata / API strings | R5 scope | Not touched in R4 |

## 6. Validation Report (static; no PHP runtime in sandbox)

1. `git diff c48c413..HEAD`: **155 files, +1467/−1278**, 6 commits; every swap logged per-row in driver TSVs and reconciled against git numstat (swap lines ± multiplicity on same-line doubles verified).
2. Residual scans: **0** occurrences of indigo/old-gold/crimson families in `console/`, `agent/` (excluding 0-reference demo SVGs and the vendor lib noted above).
3. Brace/paren balance byte-identical on all edited CSS/JS (style.css `{}` 5146/5146 pre=post, style-dark 5262/5262, chart js spot-checked).
4. Link-wiring: 134/134 pages with a theme stylesheet got exactly 1 `mpj-brand.css` link; insertion points verified outside `<?php…?>` regions for **all 134 files** (tag-balance scan); fragment/submit/popup pages without theme CSS correctly skipped.
5. Asset resolution: `console/assets/css/mpj-brand.css` exists at both referenced prefixes (console doc root + `agent/../console/`); emblem.png, slider bg verified present.
6. No PHP syntax changes were made to any file; changes are CSS values, one HTML link line, two HTML title/style edits, JS string literals only.

## 7. Deployment Notes & Risk Assessment

- Pull branch, no build step, no DB migration; static files + PHP templates already live-serve.
- **Low risk:** all edits are value-for-value string swaps or additive lines; functionality untouched.
- **Watch items on staging:** (a) dark-mode checkbox (`#cust-darklayout`) — style-dark remapped but dark theme is decorative; visual pass advised; (b) any plugin hard-coded inline styles (not discoverable statically) would show as indigo-isolated spots — none found in scans; (c) browser cache: `mpj-brand.css` is a new URL (no cache-bust needed), but `style.css` changed in place — advise a hard refresh / version query if admins report stale indigo.
- **Merge gate (unchanged):** staging `php -l` on the 134 wired pages (a loop over `console/*.php`) + login, dashboard, one list page, agent login/dashboard smoke test.

## 8. Manual Testing Checklist (staging)

- [ ] Admin login renders burgundy/gold, serif "Welcome to Manpasand Jodidar", emblem medal
- [ ] Dashboard: maroon primary buttons/chips, burgundy topbar + gold hairline, charts in maroon/rose/gold
- [ ] One datatable-heavy page (e.g. paid members): buttons, pagination, focus rings on-brand
- [ ] Customizer panel: `cust-sidebrand` toggle no longer swaps in old vendor logo
- [ ] Dark layout toggle: page remains usable, colors warm-dark
- [ ] Agent login + one agent page: gradient top bar, serif title, gold medallion, footer links readable
- [ ] profile_view: Browse buttons maroon; icons8 icons render maroon

## 9. Remaining Debt (honest)

- Console interior typography stays vendor (intentional trade-off for table-layout safety).
- `stylnew.css` typo link (pre-existing 404) left as-is.
- Dark-theme palette is a best-effort warm-dark conversion, not a designed theme.
- Operations mailbox, `readymatrimonial.in` anchor, webhook token, DB CMS strings — owner decisions, R5.

## 10. Next Phase (R5) Recommendations

Emails (letterhead + palette), PDF/biodata + invoice letterheads (`print-logo.png`, `watermark.png`), SMS/WhatsApp share text, residual sweep incl. DB-brand SQL pack for owner, 0-reference old-asset retirement (demo SVGs, `stylnew.css` typo link), final validation + deployment runbook.
