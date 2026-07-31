# ASSET_GUIDE.md — Manpasand Jodidar

Everything in `branding/` is generated from **one master file** by **one script**.
Nothing here is referenced by any page yet — wiring happens in Phases R2–R5.

## 1. Directory tree (verified inventory, Phase R1)

```
branding/
├── logos/
│   ├── manpasand-jodidar-logo.png   1024×1024  991 KB  MASTER (cream bg) — sha256 dcf5a891…e24c6
│   ├── logo-full.png                  675×842   601 KB  Tight-trimmed full logo, cream bg
│   ├── logo-full-transparent.png      673×840   301 KB  Transparent outside; interior intact
│   ├── logo-badge.png                 675×842   686 KB  Logo on rounded cream card — for dark bgs
│   ├── emblem.png                     458×488   264 KB  Heart/couple/ring/ornament only
│   ├── emblem-transparent.png         458×487   167 KB  Emblem, transparent outside
│   └── logo-horizontal.png           1008×300    72 KB  Landscape lockup (emblem+wordmark) — 168×50 e-mail slots, letterheads
├── favicons/
│   ├── favicon.ico                      multi    15 KB  16+32+48 multi-size ICO
│   ├── icon-16.png / icon-32.png / icon-48.png / icon-64.png
│   ├── icon-180.png  (= apple-touch-icon.png)    42 KB
│   ├── apple-touch-icon.png           180×180
│   ├── icon-192.png                   192×192    46 KB  (webmanifest)
│   └── icon-512.png                   512×512   253 KB  (webmanifest)
├── icons/
│   ├── divider.png                    330×47      8 KB  Gold-leaf heart divider (transparent)
│   └── heart.png                       36×32      2 KB  Rose heart glyph (transparent)
├── images/
│   ├── og-image.jpg                  1200×630    60 KB  Open Graph / Twitter share card
│   ├── whatsapp-share.jpg            1200×630    60 KB  WhatsApp link preview
│   ├── splash-logo.jpg              1200×1200    91 KB  Loading / splash screen art
│   ├── email-logo.png                 513×640    92 KB  E-mail header (display ≈300 px, 2× retina)
│   ├── print-logo.png                 389×480   217 KB  PDF/biodata letterhead (warm white pad)
│   └── watermark.png                  451×480   193 KB  10 %-alpha emblem — PDF watermark
├── branding.css                          8.2 KB  Design tokens + .mpj-* utilities (Phase R3 wire-up)
├── site.webmanifest                     441 B   name/theme #5E1426/bg #F9E7DC + 192/512 icons
└── tools/
    └── rebuild-assets.sh                        Full regeneration pipeline (ImageMagick 6+)
```

## 2. Usage map

| Asset | Used by | Phase wired |
|---|---|---|
| `favicons/favicon.ico`, `icon-32`, `apple-touch` | every `<head>` (public + console + agent) | R2 |
| `icon-192/512`, `site.webmanifest` | mobile/PWA icon refs | R2 |
| `emblem.png` / `logo-full.png` | website header/navbar/footer | R3 |
| `logo-badge.png` | maroon footer & dark hero panels | R3 |
| `splash-logo.jpg` | page-loader / approval-wait screens | R3 |
| `og-image.jpg`, `whatsapp-share.jpg` | `og:image`, `twitter:image`, WhatsApp previews | R2 |
| `email-logo.png` | all outgoing HTML e-mail headers (incl. API-triggered mails) | R5 |
| `print-logo.png`, `watermark.png` | biodata/PDF generators, print stylesheets | R5 |
| `divider.png`, `heart.png` | section ornaments, ordered-list markers, emails | R3/R5 |
| `branding.css` | every rebranded page family | R3 (public), R4 (console/agent) |
| `logo-full-transparent`/`emblem-transparent` | overlays on tinted photography | R3+ as needed |

## 3. Integrity & provenance

- Master SHA-256: `dcf5a891d70232049af5299b741fee3295c4e2e778c1688ed5f694a9ff5e24c6` (1024×1024 PNG).
- Master is a faithful recreation of the client-attached logo (the upload could
  not be persisted by the workspace; verified element-by-element against the
  attachment). See `BRANDING_GUIDE.md` §4 for the swap procedure.
- Reproducibility: delete everything except the master + script and run
  `branding/tools/rebuild-assets.sh` — the tree regenerates byte-equivalently
  (same ImageMagick version).

## 4. Regeneration pipeline (`tools/rebuild-assets.sh`)

- Input: `branding/logos/manpasand-jodidar-logo.png` (override: pass any path as `$1`).
- Trim: `-fuzz 3% -trim`.
- Transparency: corner floodfill `-fuzz 8%` on exterior cream only — the
  interior negative space (faces/ring inside) is untouched by design, verified
  visually on gray.
- Crop windows (px @1024² master): emblem `560×510+232+70`; divider
  `336×48+344+841` (measured row-band y 843–886, x-runs 437–477 / 494–529 /
  546–587); heart `48×48+490+840`.
- Optimization policy: share/splash images → JPEG q88 progressive, `-strip`;
  e-mail logo → PNG8/128 (flat palette); favicons from `-resize 620` emblem
  base squared on cream; ICO = 16/32/48 layers.
- Safe to run anytime; touches only `branding/` image files — no PHP, no DB.

## 5. Adding/replacing assets

1. Never hand-edit derivatives — change the master (or the script) and re-run.
2. Keep new imagery on-brand: Indian wedding illustrations, family themes,
   gold accents, heart motifs; palette from `COLOR_GUIDE.md`.
3. Name files `kebab-case`, keep them inside `branding/…`, and record them in
   this guide + `mpj_brand_assets()` (`includes/branding.php`) if templates
   will reference them by key.
4. Old-brand image removal happens only at end of Phase R5, after the
   zero-reference sweep proves each file is unused (per project rule:
   “if there is any uncertainty, do not delete”).
