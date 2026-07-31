# REBRANDING_CHANGELOG.md — SVR → Manpasand Jodidar

Reverse-chronological log of the complete rebrand. Each entry lists its phase
report, commits, and stop-for-approval state. Global rules: preserve 100 %
functionality · no business-logic changes · no API contract changes · no DB
schema changes · URLs keep working · user data never rebranded · small audited
commits · PR #1 updated each phase · **never auto-merged**.

---

## Pending

| Item | Status |
|---|---|
| Original attached logo file (lost by workspace upload) — swap per `BRANDING_GUIDE.md` §4 | awaiting file |
| Optional owner-run SQL for DB-stored brand text (`siteconfig`, `cms`) | arrives with Phase R5 |
| New brand domain decision (absolute URLs currently keep production domain; single constant `SVR_BRAND_URL` in `includes/branding.php` flips it) | awaiting decision |

---

## Phase R1 — Brand Foundation ✅ (awaiting approval)

**Report:** `REBRAND_PHASE1_FOUNDATION.md`
**Scope:** assets, design tokens, brand constants, guides. Zero page changes.

Added:
- `branding/` asset family — 24 files (master, 5 logo variants, 9 favicons+ICO,
  2 ornaments, 6 share/email/print images, tokens CSS, webmanifest, rebuild script).
- `branding/branding.css` — full token system (palette sampled from logo:
  `#5E1426` maroon, `#C9556A` rose, `#BA9350` gold, `#F9E7DC` cream) + `.mpj-*`
  namespaced utilities (inert until Phase R3).
- `includes/branding.php` — `MPJ_BRAND_NAME/TAGLINE/…`, `mpj_brand_assets()`,
  `mpj_brand_asset()`, `mpj_brand_asset_url()`, `mpj_brand()`; env-overridable
  `SVR_BRAND_URL`; definitions-only (no output/DB/session).
- `includes/bootstrap.php` — +1 `require_once` line for the helper (and doc lines).
- Docs: `BRANDING_GUIDE.md`, `COLOR_GUIDE.md` (WCAG-measured), `TYPOGRAPHY_GUIDE.md`, `ASSET_GUIDE.md`.

Changed/removed: nothing user-visible; no deletions.

---

## Phase R2 — Brand text & asset wiring ✅ (awaiting approval)

**Report:** `REBRAND_PHASE2_WIRING.md` · **Commits:** `b3e2a0d` lockup asset ·
`c5c22a1`+`e20740c` favicons (166) · `5ecf53c` page logos (72) · `522fa05`
e-mail/push URLs (21) · `5abfeb1` brand strings (172) · `8842b9f` head wiring (205)
· path-fix commit (25).

- 502 `shivraj-logo.png` refs → `branding/` assets (favicons 396, e-mail/push 22,
  page-chrome 71, letterheads 4, vars 6, css 2, loader 1) — **0 remain**.
- “Shivraj Maratha” visible/uppercase strings ×86, Devanagari wordmark ×13,
  monograms ×2, DashboardKit vendor metas ×122, razorpay merchant name/logo, 4 titles.
- Head wiring: apple-touch+manifest+theme-color on 202 legacy pages + template dir;
  `header3.php`: description default + og:site_name/image/title/description +
  twitter card (page-level `$page_og_*` still win).
- **Fixed live bugs:** e-mail logos + FCM images pointed to `localhost` (broken today).
- **Protected (verified):** operations mailbox, testimonials, proprietor name,
  webhook token, production domain, DB `$seof` content. Old asset **files** retire in R5.

---

## Phase R3 — Public UI skin ✅ (awaiting approval)

**Report:** `REBRAND_PHASE3_UI.md` · **Commits:** `95ef3e5` palette+hero ·
`2c73ccf` typography/ornaments/tagline · `9438132` rgba sweep + preloader.

- 913 palette value swaps / 72 files: MVV tokens, template css, premium css,
  and the legacy neon theme (hot-pink/teal/purple/bright-blue) all remapped to
  sampled brand hexes; rgba focus/glow forms included; neon fully eliminated
  from the public layer (0 leftovers).
- **Fixed broken landing hero + login background** with commissioned on-brand
  `maratha-wedding-hero.jpg` (was 404 in production).
- Poppins + Cormorant Garamond wired into all header families next to Playfair
  Display; `branding/branding.css` linked (tokens + utilities now live).
- Landing dividers, footer taglines, preloader bars maroon/rose/gold; legacy
  sub-brand line removed.
- Guardrails held: value-only diffs proven, 0 tokenizer flips, console/agent
  deferred to R4 by scope.

---

## Phase R4 — Admin console + agent panel skin ✅ (awaiting approval)

**Report:** `REBRAND_PHASE4_ADMIN.md` · **Commits:** `c48c413..481190f` (6).

- DashboardKit theme converted to brand: indigo `#7267EF` → maroon `#7A1F39`,
  slate chrome `#1c232f`/`#293240` → burgundy `#3D0C19`/plum `#43303A`
  (981 exact swaps; mechanism: theme's own `.bg-dark`/`.topbar` rules flip the
  global chrome). Tints, rgba alphas, data-URI checkbox marks, dark-theme css,
  unused demo layouts all included; neon stragglers eliminated console-wide.
- New additive `console/assets/css/mpj-brand.css` (gold chrome hairlines,
  emblem medallion ring, auth gold strip) wired into **134/134** theme pages,
  one `<link>` each, all proven outside PHP regions.
- 11 console pages' inline "premium" palettes + `#007bff` buttons → brand
  tokens; agent panel fully skinned (gradient chrome, serif titles, Poppins);
  both login screens polished (burgundy veil, gold strip, serif welcome).
- Customizer logo-swap JS (47 pages) can no longer drop in the old vendor
  logo; dashboard **chart palettes** (8 js configs + 3 pages) indigo/blue →
  maroon/rose/gold; icons8 URL color params follow.
- Held: semantic status colors, vendor lib internals, 404-typo stylesheet
  documented; 0 PHP-logic/logic-path changes; toggle behavior untouched.
- Demo SVG logos/favicons now have **0 references** → R5 retirement list.

## Phase R5 — Emails · PDF/Biodata · API strings · final sweep (planned)

E-mail template redesign, print/biodata letterhead + watermark, SMS/WhatsApp
text, API brand strings only, residual old-brand sweep report, optional
owner-run DB-brand SQL script, old-asset retirement after zero-reference proof,
final validation + deployment notes.
