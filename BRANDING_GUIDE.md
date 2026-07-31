# BRANDING_GUIDE.md — Manpasand Jodidar

> Phase R1 (Brand Foundation) deliverable — rebranding of the SVR matrimonial platform.
> This guide is the single reference for **what the brand is** and **how its assets may be used**.
> Technical inventory lives in `ASSET_GUIDE.md`; colors in `COLOR_GUIDE.md`; type in `TYPOGRAPHY_GUIDE.md`.

---

## 1. Identity

| Element          | Value |
|------------------|-------|
| Brand name       | **Manpasand Jodidar** |
| Tagline          | **Rishta Dil Se, Saath Zindagi Bhar** |
| Tagline (upper)  | `RISHTA DIL SE, SAATH ZINDAGI BHAR` |
| Logo master      | `branding/logos/manpasand-jodidar-logo.png` (1024×1024, on cream `#F9E7DC`) |
| Personality      | Premium · Elegant · Traditional · Trustworthy · Emotional · Family-oriented · Indian Wedding |
| Voice            | Warm, respectful, celebratory. Hindi-English (“Hinglish”) warmth is welcome; formal English for legal/transactional content. |

The logo composition: groom (deep maroon) and bride (rose pink) profiles facing
each other inside a two-stroke heart, enclosed by an antique-gold ring crowned
with a lotus-heart ornament; “Manpasand” in deep-maroon classic serif,
“Jodidar” in rose calligraphic script, gold heart-flourish divider, tagline in
letterspaced maroon caps — on soft cream.

## 2. Logo usage rules

**Which file where** (full inventory: `ASSET_GUIDE.md`):

| Context | File |
|---|---|
| Website header / navbar | `branding/logos/emblem.png` + wordmark as live text *or* `logo-full.png` |
| Dark / maroon backgrounds (footer, maroon hero) | `branding/logos/logo-badge.png` (logo pre-mounted on cream rounded card) |
| Login / register / splash / loading | `branding/images/splash-logo.jpg` |
| E-mail headers | `branding/images/email-logo.png` (640 px, display ≈ 300 px) |
| PDF / biodata letterhead | `branding/images/print-logo.png` |
| PDF watermark | `branding/images/watermark.png` (10 % emblem) |
| Favicons / touch icons | `branding/favicons/*` (`favicon.ico`, `icon-32.png`, `apple-touch-icon.png`, `icon-192/512.png`) |
| Open Graph / Twitter / WhatsApp preview | `branding/images/og-image.jpg`, `whatsapp-share.jpg` (1200×630) |
| On-image overlay, tinted backgrounds | `branding/logos/logo-full-transparent.png` / `emblem-transparent.png` |
| Section ornament | `branding/icons/divider.png` (or `.mpj-divider` in `branding.css`) |

**Do**
- Keep the cream background versions on light/cream/white surfaces.
- Keep clear space ≥ the height of the gold ring’s lotus ornament on all sides.
- Minimum sizes: full logo ≥ 110 px wide; emblem ≥ 28 px; favicon files are pre-sized.

**Don’t**
- Don’t recolor, stretch, crop, or add effects (shadows/outlines/gradients) to the artwork.
- Don’t place the maroon wordmark variant directly on maroon (use `logo-badge.png` instead).
- Don’t set old-brand logos as fallbacks anywhere.
- Don’t use the script “Jodidar” mark for body text or at unreadable sizes.

## 3. Old brand → new brand

| Old (to be retired in Phases R2–R5) | New |
|---|---|
| “Shivraj Maratha” (visible brand, footers/copyrights) | **Manpasand Jodidar** |
| `css3/assets/shivraj-logo.png` (260 file refs) | `branding/` asset family |
| Legacy “Weddings Parampara” strings (~29 files) | **Manpasand Jodidar** |
| No tagline | *Rishta Dil Se, Saath Zindagi Bhar* |
| Old favicons/touch icons | `branding/favicons/*` |

Database-stored brand text (`siteconfig` row id 1, `cms` pages) is **not**
changed by code phases; an optional, owner-run SQL script will be provided in
Phase R5. User-generated content is never rebranded.

## 4. Artwork provenance & master swap (important)

The attached master logo could not be persisted in the build workspace (upload
attachment was lost twice by the workspace environment). The current master is a
**faithful high-resolution recreation** of the attached logo, verified visually
against it element-by-element (emblem, typography, divider, tagline, colors).

To substitute the original artwork later — zero redesign required:

```bash
cp <original-logo.png> branding/logos/manpasand-jodidar-logo.png   # 1024² cream layout
branding/tools/rebuild-assets.sh                                    # regenerates all 20+ derivatives
```

Every derivative (favicons, OG, email, print, watermark, badge, splash,
divider, heart) is produced by that one script from that one file
(see `ASSET_GUIDE.md` §4). Current master SHA-256:
`dcf5a891d70232049af5299b741fee3295c4e2e778c1688ed5f694a9ff5e24c6`.

## 5. Rebrand phase map

| Phase | Scope | Stop for approval |
|---|---|---|
| **R1** | Brand foundation: assets, tokens, constants, guides | ✅ this phase |
| R2 | Brand text & asset wiring (titles/metas/OG/copyrights/email logos/260 refs) | yes |
| R3 | Public UI skin (landing, auth, search, profile, membership, payment, misc pages) | yes |
| R4 | Admin console + agent panel skin | yes |
| R5 | Emails, PDF/biodata, API brand strings, residual sweep, optional DB-brand SQL, final validation | yes |

Rules carried through every phase: 100 % functionality preserved, no business
logic changes, no API contract changes, no DB schema changes, URLs keep
working, small audited commits, PR updated each phase, **never auto-merged**.
