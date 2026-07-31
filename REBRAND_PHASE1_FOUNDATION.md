# REBRAND PHASE 1 (R1) — BRAND FOUNDATION — REPORT

**Project:** Complete rebranding of the SVR matrimonial platform → **Manpasand Jodidar**
(*Rishta Dil Se, Saath Zindagi Bhar*)
**Branch:** `arena/019fb6b6-svr` · **PR:** #1 (updated per phase, **not merged**)
**Phase scope:** brand assets + design tokens + brand constants + guides.
**Deliberately NO visual/page changes in this phase** — foundation only.

---

## 1. Rebranding Summary

Phase R1 created the complete foundation every later phase builds on:

1. **Asset family** — the attached logo became a full `branding/` tree: master,
   trimmed/transparent/badge variants, emblem, favicon set + multi-size ICO,
   apple-touch + Android icons, Open Graph/Twitter card, WhatsApp preview,
   splash art, e-mail header, PDF letterhead, PDF watermark, gold-leaf divider,
   heart glyph, web manifest.
2. **Regeneration pipeline** — `branding/tools/rebuild-assets.sh` rebuilds all
   20+ derivatives from the single master (documented swap-in procedure for the
   original artwork, `BRANDING_GUIDE.md` §4).
3. **Design tokens** — palette *sampled from the logo* (maroon `#5E1426`,
   rose `#C9556A`, gold `#BA9350`, cream `#F9E7DC` …) + typography + shape
   tokens in `branding/branding.css`; inert `.mpj-*` utilities ready for R3/R4.
4. **PHP brand constants** — `includes/branding.php` (`MPJ_BRAND_NAME`,
   `MPJ_BRAND_TAGLINE`, `mpj_brand_assets()`, `mpj_brand_asset[_url]()`,
   `mpj_brand()`), loaded once by the single include-point `includes/bootstrap.php`.
5. **Guides** — `BRANDING_GUIDE.md`, `COLOR_GUIDE.md` (measured WCAG),
   `TYPOGRAPHY_GUIDE.md`, `ASSET_GUIDE.md`, `REBRANDING_CHANGELOG.md`.

## 2. Branding Changes

| Decision | Value | Rationale |
|---|---|---|
| Brand name | Manpasand Jodidar | per brief |
| Tagline | Rishta Dil Se, Saath Zindagi Bhar | per brief / logo |
| Palette | sampled from logo pixels (histogram + probes) | logo is the single visual source |
| Type | Playfair Display (display) · Poppins (body) · Cormorant Garamond (accent) | mirrors logo serif + script feel; brief's examples |
| Icons family | existing Font Awesome kept; brand glyphs added (`heart.png`, `divider.png`) | consolidation, if any, is a separate later decision to avoid breaking 100s of pages |
| Absolute brand URLs | production domain `weddingsparampara.com` behind ONE constant `SVR_BRAND_URL` | default since no new domain was specified; future switch = one env var / config line |
| Master artwork | faithful recreation of attached logo (see §7 Risk) | workspace lost the upload twice; swap documented |

## 3. Files Modified (1)

| File | Change | Why |
|---|---|---|
| `includes/bootstrap.php` | +1 `require_once` (branding.php) + 2 doc lines | single include-point already feeds all 485 converted pages; helper must load everywhere |

Diff proof: diff is exactly those additive lines; brace/paren balance unchanged
(before = after = 0); no line of existing code re-touched.

## 4. Files Added (30)

**Code:** `includes/branding.php` (definitions-only: no output, no DB, no session — tokenizer-verified).
**Assets:** `branding/` — 24 files (see `ASSET_GUIDE.md` §1 for the measured inventory with sizes/dimensions).
**Docs:** `BRANDING_GUIDE.md`, `COLOR_GUIDE.md`, `TYPOGRAPHY_GUIDE.md`, `ASSET_GUIDE.md`, `REBRANDING_CHANGELOG.md`, this report.

Every file's purpose and audience is documented in `ASSET_GUIDE.md` (assets)
and the guides (tokens/type/rules). No orphans: every asset has a named
consumer phase in the usage map (`ASSET_GUIDE.md` §2).

## 5. Files Deleted

**None.** Old-brand assets retire only at end of Phase R5, after the
zero-reference sweep proves each one unused (project rule: *“if there is any
uncertainty, do not delete”*).

## 6. Screens Updated

**None — by design.** No page, template, e-mail, or admin screen references
`branding/` yet (verified: 0 PHP files outside the helper mention `branding/`).
Visual rollout begins R2 (wiring) and R3/R4 (skins). Site renders exactly as before.

## 7. Remaining Branding References (old brand — the full R2+ work queue, measured)

| Reference | Extent | Retires in |
|---|---|---|
| `css3/assets/shivraj-logo.png` refs | **262 files** (favicons, navbars, e-mail & API e-mail templates) | R2 (swap) → R5 (asset removal) |
| “Shivraj Maratha” visible strings | **84 occurrences / 47 files** (copyrights, titles, meta) | R2 |
| “weddings/parampara” legacy strings+domains | **33 files** | R2/R5 (strings) — domain stays as URL base until domain decision |
| `http://localhost/SVR/…` hardcoded URLs | **439 occurrences / 213 PHP files** (incl. broken e-mail logo `<img>` today) | R2 (brand-asset subset) → later phases (rest) |
| DB-stored brand text (`siteconfig` id 1, `cms` pages) | live data | optional owner-run SQL in R5 — never touched by code |
| User-generated content (profiles, stories, photos) | live data | **never rebranded** (rule) |

## 8. Validation Report (all executed, results recorded)

| Check | Result |
|---|---|
| Git delta scope | ✅ only `includes/bootstrap.php` modified + new files; zero other tracked files touched |
| Bootstrap diff | ✅ purely additive lines; brace count unchanged |
| `includes/branding.php` static parse | ✅ tokenizer-verified: parens 0, braces 0, no top-level `echo/print`, no `session_*`, no `mysqli_*`, define-guard present |
| Asset key ↔ file existence | ✅ all 21 `mpj_brand_assets()` keys resolve to existing files |
| Raster integrity | ✅ `identify` passes on all 22 image files |
| Page references to `branding/` | ✅ 0 → zero regression surface this phase |
| CSS sanity | ✅ braces balanced; every used `var(--mpj-*)` defined; `url(icons/divider.png)` resolves; 19 defined-but-unused tokens are intentional forward-stock for R3/R4 (documented) |
| Web manifest | ✅ valid JSON, icons present |
| Derivative geometry | ✅ emblem/divider/heart crops verified visually (divider band y 843–886 measured by pixel profile; x-runs 437–477/494–529/546–587); transparency containment verified on gray |
| Design QA | ✅ sampled palette matches master visually; OG card, splash, favicons, badge, watermark previewed |
| Accessibility | ✅ key pairs measured: maroon/cream 10.91 (AAA), ink/white 14.12, rose-dark/white 6.12 (AA) — table in `COLOR_GUIDE.md` |
| Performance | ✅ share/splash images JPEG-q88 progressive (60–93 KB), e-mail PNG8 (92 KB), favicon ICO multi-size; `.htaccess` already serves images with 1-year cache |
| Sandbox limits | ⚠️ no PHP runtime here → staging `php -l` + smoke suite remains the merge gate (unchanged project rule) |

## 9. Risk Assessment

| Risk | Level | Mitigation |
|---|---|---|
| Master is a recreation, not the original file | Low (visual), Medium (identity fidelity) | verified element-by-element; **one-file swap + one script run** replaces everything (`BRANDING_GUIDE.md` §4); derivatives regenerate identically |
| Future absolute URLs baked to `weddingsparampara.com` | Low | single constant `SVR_BRAND_URL` (env/config override, no code edits) |
| Tokens/fonts unused until R3 | None | CSS is inert; no page loads it |
| Bootstrap include | Trivial | definitions-only helper; all 485 consumers load it via existing `require_once`; no behavior change proven by diff + static checks |

No functionality, business logic, API contract, URL, or DB schema touched. Zero.

## 10. Manual Testing Checklist (staging, before any R2 merge)

- [ ] Any public page + admin agent page loads unchanged (foundation must be invisible).
- [ ] `php -l includes/branding.php includes/bootstrap.php` clean.
- [ ] Browse `/branding/logos/manpasand-jodidar-logo.png` etc. — 200s.
- [ ] Review the four guides; approve palette/type (see swatches in `COLOR_GUIDE.md`).
- [ ] (When original artwork available) run swap procedure once and eyeball favicon/OG diffs.

## 11. Remaining Technical Debt (carried, unchanged by this phase)

- Old-brand references listed in §7 (R2/R5 queue).
- 439 hardcoded `localhost/SVR` URLs (pre-existing; brand-logo subset fixed in R2).
- DB-stored brand text; password-storage freeze; PHPMailer 5.2.4; API posted-ID auth — all still tracked from earlier phases (`PHASE_B_ARCHITECTURE.md` §7, `MODERNIZATION_AUDIT.md` §10).

## 12. Recommendations for Next Phase (R2 — Brand Text & Asset Wiring)

1. Swap all 262 `shivraj-logo.png` references → correct `branding/` asset per context (favicon links ↔ `favicons/`, navbar `<img>` ↔ `emblem/full`, e-mail `<img>` ↔ absolute `email_logo` URL via `mpj_brand_asset_url()`), fixing the localhost-broken e-mail logos as part of the same audited pass.
2. Replace 84 “Shivraj Maratha” + 33 parampara-file strings with brand constants where feasible (printf-safe), else literals.
3. Wire `<title>`, meta description, OG/Twitter tags (+ `og-image.jpg`), webmanifest link, apple-touch icons into the shared public header + console/agent headers.
4. Sitemap/robots brand strings; browser titles for console (“Matrimony Admin” → brand admin) and agent panel.
5. Same guardrails: per-file 1-concern diffs, template-consumption verification, asset-resolution sweep proving 0 broken refs at the end.

**Stopping here for approval, per the phase protocol.**
