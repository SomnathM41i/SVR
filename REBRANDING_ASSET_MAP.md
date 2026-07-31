# Rebranding Asset Map — Manpasand Jodidar

Authoritative inventory of every branding-relevant asset family: what is active,
what each file is for, where it is referenced, and what old assets remain on disk
(kept deliberately, with zero code references).

Master source of identity: `branding/logos/manpasand-jodidar-logo.png`
(SHA-256 `dcf5a891…5e24c6`; regenerate everything via `branding/tools/rebuild-assets.sh`).

## 1. Active logo family (single family — branding/logos/)

| File | Role | Live refs (code) |
|---|---|---|
| `manpasand-jodidar-logo.png` | master (675×842) | pipeline source |
| `logo-full.png` / `logo-full-transparent.png` | full vertical lockup | docs/branding kit |
| `emblem.png` | emblem slot, page chrome, admin/agent headers, **Razorpay checkout** | 69 files |
| `emblem-transparent.png` | emblem on colored backgrounds | 1 |
| `logo-horizontal.png` | 168×50-slot lockup, email rows, print rows | 26 |
| `logo-badge.png` | rounded card for dark surfaces | 1 |

Verified: **no second active logo family exists.** Razorpay checkout was the last
stray (`images/logo-2.png`) — fixed in `09c2627`.

## 2. Active favicon family (single family — branding/favicons/)

| File | Served via |
|---|---|
| `favicon.ico` (16/32/48) | `<link rel="shortcut icon">` on 216 pages |
| `apple-touch-icon.png` (180) | 216 pages |
| `icon-16/32/48/64/180.png` | direct links (icon-32 on 26) |
| `icon-192.png`, `icon-512.png` | `branding/site.webmanifest` (PWA) |

`favicon.ico` appeared in the retired DashboardKit set; no page references any old
favicon path (`css3/assets/favicon_io/*` = 0 code refs).

## 3. Supporting brand images (branding/images + branding/icons)

| File | Purpose | Refs |
|---|---|---|
| `email-logo.png` | email letterhead lockup | 19 (incl. SQL/doc adjacency: 18 templates + emails) |
| `print-logo.png` | print/biodata letterhead | 2 print pages |
| `watermark.png` | 10%-alpha print watermark | 7 (3 print pages + kit) |
| `og-image.jpg`, `whatsapp-share.jpg` | social cards | header3 og:image + share kit |
| `splash-logo.jpg` | pageloader splash | pageloader1.php |
| `icons/divider.png`, `icons/heart.png` | landing ornaments | 1 + 3 |

## 4. Orphan audit

Every file under `branding/` has ≥1 live referrer (code page, webmanifest, or the
rebuild pipeline/manual). **No orphaned branding assets remain.** Specifically the
`icon-*` sizes referenced by `site.webmanifest` are alive through the manifest link
present on 216 pages.

## 5. Deleted assets → broken-reference audit

`git rm`'d in R5: `console/assets/images/{favicon,logo,logo-dark}.svg`,
`console/assets/images/pages/{coupon,interview,voucher}.svg`.
Post-deletion scan (non-doc files): **0 references to any deleted asset.** The two
`logo.svg` text hits belong to CKEditor's own `samples/img/logo.svg` (vendor tree).
> No page references deleted assets. ✔

## 6. Old-brand assets still on disk (deliberately kept — zero code refs)

| File | Why kept |
|---|---|
| `css3/assets/shivraj-logo.png` | old master mark; DB/CMS content may hot-link it; retiring after owner's DB audit |
| `css3/assets/logo.svg`, `css3/assets/rd-logo.webp` | old/partner marks; 0 refs; same retirement review |
| `css3/assets/favicon_io/` (3) | old favicon set; 0 refs since R2 |
| `images/logo-2.png` | former Razorpay logo; 0 refs since `09c2627` |
| `img/logo.png`, `img/logo1.png` | legacy marks; 0 live refs (ckeditor refs resolve inside its own tree) |

These are inert (nothing loads them). Owner may delete after confirming no
DB-stored content references them — recovery is one `git checkout` away.

## 7. Vendor assets (out of brand scope, kept)

PHPMailer docs favicon, CKEditor sample logos, jasmine test favicon — vendor
library internals, never rendered to end users.

## 8. Duplication check

- One logo family (§1), one favicon family (§2). No duplicate active variants.
- Legacy `stylenew.css`/`stylnew.css` 404 link removed in R5; theme css is single-sourced per page.
