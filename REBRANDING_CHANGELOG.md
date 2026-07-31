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

## Phase R2 — Brand text & asset wiring (planned)

Titles, meta/OG/Twitter, copyright footers, console+agent titles; swap
`shivraj-logo.png` refs (260 files incl. e-mail/API e-mail templates) to
`branding/` assets; fix `localhost`-broken logo URLs; sitemap/robots branding.

## Phase R3 — Public UI skin (planned)

Landing/hero, header/footer, login, register, search, profile, dashboard,
membership, payment, contact, success/error pages; token-driven component
standardization via `branding.css`; fonts wire-up; responsive verification.

## Phase R4 — Admin console + agent panel skin (planned)

Console login/sidebar/topbar/tables/forms + agent panel; CSS + brand assets only.

## Phase R5 — Emails · PDF/Biodata · API strings · final sweep (planned)

E-mail template redesign, print/biodata letterhead + watermark, SMS/WhatsApp
text, API brand strings only, residual old-brand sweep report, optional
owner-run DB-brand SQL script, old-asset retirement after zero-reference proof,
final validation + deployment notes.
