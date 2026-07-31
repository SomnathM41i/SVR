# COLOR_GUIDE.md — Manpasand Jodidar

Canonical palette **sampled from the official logo** (`branding/logos/manpasand-jodidar-logo.png`,
ImageMagick histogram + targeted pixel probes; derivation rows are marked).
All values are exposed as CSS custom properties in `branding/branding.css` (`--mpj-*`)
and in PHP via `mpj_brand()` for e-mail/PDF inline styles.

## 1. Core palette

| Token | Hex | Sampled from | Role |
|---|---|---|---|
| `--mpj-maroon` | `#5E1426` | groom silhouette, “Manpasand” (94,20,38) | **Primary** — headings, navbar accents, primary buttons, footer |
| `--mpj-burgundy` | `#3D0C19` | derived shade of maroon | Deepest surfaces (footer bg), gradient anchor |
| `--mpj-rose` | `#C9556A` | bride silhouette, “Jodidar” (201,85,106) | **Accent** — highlights, icons, hovers, ornament |
| `--mpj-rose-dark` | `#A63E52` | derived shade of rose | Text-safe rose links/labels on light bg |
| `--mpj-gold` | `#BA9350` | ring, ornament, divider (186,147,80) | Ornaments, dividers, premium tags, frames |
| `--mpj-gold-dark` | `#8F6E2E` | derived shade of gold | Small gold text/eyebrows on light bg |
| `--mpj-cream` | `#F9E7DC` | logo background (249,231,220) | Page tints, hero fills, email canvas |
| `--mpj-cream-50` | `#FFFDFB` | derived (warm near-white) | Cards, inputs, email body |
| `--mpj-cream-200` | `#F3D9C7` | derived | Subtle fills / hover surface |

## 2. Supporting tones (sampled from logo histogram)

| Token | Hex | Count rank | Use |
|---|---|---|---|
| `--mpj-maroon-700` | `#773C47` | 5th | Maroon mid — borders, secondary text on cream |
| `--mpj-rose-light` | `#ECBDC0` | 9th | Chips, badge fills, soft highlights |
| `--mpj-gold-light` | `#E3CBB2` | 4th | Hairline fills, table striping on cream |
| `--mpj-bronze` | `#A25C3B` | 12th | Rare warm accent ( earring tone ) |

Text neutrals (derived): `--mpj-ink` `#3A2530` (body), `--mpj-ink-muted` `#7A6570` (secondary),
`--mpj-ink-on-maroon` `#F9E7DC` (text on dark).

## 3. Semantic feedback colors

Bootstrap-era semantic concepts stay, recolored into the brand family
(**no bright blue anywhere**):

| Role | Hex | Notes |
|---|---|---|
| success | `#2F7D5B` | muted Indian-wedding green (approved, verified) |
| warning | `#B07A2A` | warm amber-gold (pending review) |
| danger  | `#B03A4E` | rose-maroon red (errors, declines) — not neon red |
| info    | `#6C5A78` | desaturated plum — replaces Bootstrap bright blue |

## 4. Accessibility — measured WCAG contrast

| Pair | Ratio | Verdict |
|---|---|---|
| maroon on cream | 10.91 : 1 | AAA — headings/body |
| maroon on white | 13.09 : 1 | AAA |
| burgundy on cream | 13.83 : 1 | AAA |
| ink on white / cream | 14.12 / 11.76 : 1 | AAA |
| ink-muted on white | 5.35 : 1 | AA |
| rose on white | 4.21 : 1 | AA *large text only* — use rose-dark for body |
| **rose-dark on white** | **6.12 : 1** | **AA — links/labels** |
| gold on white | 2.85 : 1 | decorative only |
| gold-dark on white | 4.73 : 1 | AA |
| cream on maroon | 10.91 : 1 | AAA — dark surfaces |
| gold on maroon | 4.60 : 1 | AA large — ornaments/headings on dark |

## 5. Do / Avoid

- Gradients permitted only: `maroon→burgundy` (dark surfaces, primary buttons), `rose→rose-dark` (CTAs), `gold` flat ornaments.
- White = warm white `#FFFDFB`, not clinical `#FFFFFF`, for large surfaces.
- **Avoid**: bright blue (`#0d6efd` family), neon/saturated primaries, generic Bootstrap default palette as-is — all get brand overrides in Phases R3/R4, never new raw values.
- Always reference tokens (`var(--mpj-…)`), never paste raw hex into templates.
