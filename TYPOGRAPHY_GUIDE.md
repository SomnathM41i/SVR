# TYPOGRAPHY_GUIDE.md — Manpasand Jodidar

Type system chosen to mirror the logo: **elegant serif** (the “Manpasand”
wordmark) for display, **flowing warmth** for accents (echoing the script
“Jodidar”), **clean geometric sans** for UI body text.

## 1. Families & roles

| Role | Family | CSS var | Fallback stack (no network) |
|---|---|---|---|
| Display / headings | **Playfair Display** (600, 700; ital) | `--mpj-font-display` | Georgia, "Times New Roman", serif |
| Body / UI | **Poppins** (400, 500, 600) | `--mpj-font-body` | "Segoe UI", "Helvetica Neue", Arial, sans-serif |
| Accent / pull-quotes | **Cormorant Garamond** (italic 500) | `--mpj-font-accent` | Georgia, serif |

- Headings: Playfair Display, `color: var(--mpj-maroon)`, tight line-height 1.15.
- Body/forms/tables/buttons: Poppins, `color: var(--mpj-ink)`.
- Cormorant Garamond italic: success-story quotes, ceremony flourishes, email salutations.
- Never use script/calligraphy fonts for paragraph text; the script “Jodidar” exists only inside the artwork.

## 2. Scale (rem, 16 px root)

| Token | Size | Use |
|---|---|---|
| `--mpj-fs-48` | 3.00 rem | Hero display (desktop) |
| `--mpj-fs-38` | 2.375 rem | Page titles, hero (mobile) |
| `--mpj-fs-30` | 1.875 rem | Section titles |
| `--mpj-fs-24` | 1.5 rem | Card titles, sub-sections |
| `--mpj-fs-20` | 1.25 rem | Lead-ins, prices |
| `--mpj-fs-18` | 1.125 rem | `.mpj-lead` intro text |
| `--mpj-fs-16` | 1 rem | Body |
| `--mpj-fs-14` | 0.875 rem | Labels, table secondary |
| `--mpj-fs-12` | 0.75 rem | Badges, eyebrows, captions |

Eyebrow style (`--mpj-fs-12`, 600, `letter-spacing:.18em`, uppercase, `gold-dark`)
mirrors the logo’s letterspaced tagline.

## 3. Wire-up (applied in Phases R3/R4 — not live yet)

Add once to each template family’s `<head>` (public: `template/includes/header.php`,
`header.php`/`header3.php` family; console: its header include; agent: `agent/common.php`):

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Poppins:wght@400;500;600&family=Cormorant+Garamond:ital,wght@1,500&display=swap" rel="stylesheet">
<link href="branding/branding.css" rel="stylesheet"> <!-- depth-adjusted href -->
```

Graceful degradation: if Google Fonts is unreachable (offline dev,
blocked CDN), the fallback stacks render Georgia/system sans — pages keep
working, layout shifts minimal (`display=swap`).

## 4. E-mail / PDF stacks (Phase R5)

E-mail clients that ignore webfonts get a safe analogue, already covered by the
fallback stacks above; e-mail templates set fonts inline:
- Headings: `Georgia, 'Times New Roman', serif`
- Body: `'Segoe UI', Arial, sans-serif`

PDF/biodata generators use the same stacks; the brand feel comes from
maroon/gold rules, `print-logo.png` letterhead, and `watermark.png`.

## 5. Rules

- Use tokens; never raw `font-family` literals in new markup.
- Headings never in all-caps except eyebrow/tagline-style elements.
- Numeric data (counts, prices) uses Poppins — tabular-friendly; prices get
  `--mpj-fs-20`+ and maroon weight 600.
- Line-length guard: prose containers max ~68ch via layout, not type size.
