# REBRAND PHASE 3 (R3) — PUBLIC UI SKIN — REPORT

**Branch:** `arena/019fb6b6-svr` · **PR:** #1 (updated; **not merged**)
**Scope:** public-site visual layer — global palette remap, typography wire-up,
landing ornaments, loading art. **No markup restructuring** of legacy pages;
all changes are value-level (CSS) or additive (ornaments/links).

---

## 1. Rebranding Summary

The public site now renders in the Manpasand Jodidar visual language end-to-end:

1. **Palette remap — 913 value swaps across 72 files:**
   - MVV design tokens (`header.php`, `header3.php`, `css3/mvv-premium.css` + 14 page-level `:root` copies): saffron `#E8612A`→rose `#C9556A`, maroon `#6B1A1A`→`#5E1426`, gold `#C9921A`→`#BA9350`, cream `#FFF8F0`→`#FFFDFB`, ink/muted → brand neutrals.
   - Template stylesheet family (`template/assets/css/style.css`): its own saffron/maroon var set + gradients → brand equivalents.
   - **Legacy neon theme eliminated** (the gaudy matrimonial-script palette the brief forbids): hot-pink `#ec167f` ×119 → rose, teal `#40cbb4` ×66 → antique gold, purple `#4c35a9` ×41 → brand plum, bright blue `#1d95d2` ×36 → maroon-700, neon `#f70068/#e1137b/#e6275a` ×158 → rose/rose-dark, yellow `#ffc20b` ×32 → gold-bright, navy `#233145` ×24 → burgundy.
   - rgba() shadow/focus/glow forms remapped in the second sweep (63 more).
2. **Landing hero FIXED** — `template/assets/images/maratha-wedding-hero.jpg` did not exist (broken hero + login background in production today). Commissioned an on-brand illustration (Maharashtrian couple, maroon sherwani / rose nauvari, gold mandap arch, cream field with left negative space for text).
3. **Typography** — Playfair Display (already loaded) + **Poppins** + **Cormorant Garamond** added to the Google Fonts URL of all 3 header families; `branding/branding.css` (tokens + `.mpj-*` utilities) now linked last = foundation for all future component work.
4. **Ornaments** — gold-leaf divider under the 4 landing section titles; official tagline in both footers' brand blocks; legacy sub-brand remnant “शुभ विवाह • सुयोग्य जीवनसाथी” replaced by the tagline; preloader equalizer bars recolored maroon/rose/gold.
5. **Bridge tokens** added to `branding.css`: `--mpj-maroon-600`, `--mpj-rose-400`, `--mpj-gold-bright`, `--mpj-plum`.

## 2. Branding Changes

| Decision | Rationale |
|---|---|
| Token remap over markup edits | one `:root`/stylesheet change cascades over 200+ heterogeneous legacy pages with zero structural risk |
| Secondary accent teal→gold, blue→maroon-700, purple→plum | brand family set in COLOR_GUIDE §3; no bright blue anywhere |
| Hero generated (not stock) | brief: Indian-wedding illustration style consistent with logo; exact referenced filename ⇒ zero markup change, instant prod fix |
| Poppins loaded alongside DM Sans | TYPOGRAPHY_GUIDE body face; DM Sans retained so existing components keep their metrics |
| `.mpj-divider` via `url("icons/divider.png")` inside branding.css | CSS-relative → correct from every page depth |
| Footer sub-brand → tagline | only ONE public sub-line may exist, per brand identity |

## 3. Files Modified (74)

- 49 palette-remap files (headers, mvv/premium/template css, page-level `:root`s incl. dashboards, signup, login, search, prints)  
- 23 rgba-sweep files (focus rings/glows/tinted alerts)  
- 7 wiring/ornament files (header.php, header3.php, footer.php, footer3.php, index.php, template/includes/header.php, branding/branding.css)  
- `css2/multiselect.css`, `images/icons/preloader.svg`  
(overlaps deduplicated; console/agent/apis untouched — R4/R5 scope)

## 4. Files Added

`template/assets/images/maratha-wedding-hero.jpg` (1200×896, 204 KB, hero/login art). No deletions.

## 5. Screens Updated

Landing (hero art, maroon navbar, rose CTAs, gold kickers, cream sections, dividers), member login (bg art + maroon card), registration wizard (gold/rose CTAs), member dashboards & list/profile pages (theme buttons/links now rose/maroon instead of hot-pink/blue), order-review/payment page (theme-btn family), order of magnitude of pages via shared `:root`s, 404 (rose accent), preloader animation, both footer variants (tagline + recolored blocks).

## 6. Remaining Branding References / Debt

- Console + agent visuals unchanged by design (**R4**).
- Legacy pages' **markup** is old-theme (Bootstrap 3 era) — colors/type now branded, but component modernization page-by-page is future phased work (documented, not silently half-done).
- `$seof` DB SEO text, mailbox, old asset **files** — R5 track (unchanged from R2 register).
- Icons: Font Awesome 6 + Bootstrap Icons + legacy flaticons coexist — icon-family consolidation flagged for a later phase (risk deferred; no duplicate-removal done without breakage proof).
- `css2/`, `css3/` legacy sheets remain (renaming = destructive; kept).

## 7. Validation Report

| Check | Result |
|---|---|
| Value-only diffs (palette commits) | ✅ every changed line contains only hex/rgba value changes (760/760 + 63/63) |
| Tokenizer (strings-first) over all touched php/css | ✅ 0 structural flips (49 + 26 files) |
| Old-palette leftovers repo-wide (public layer) | ✅ 0 (css2/multiselect + preloader.svg caught & fixed in-phase) |
| Asset refs (branding.css links x3 depths, divider, hero) | ✅ resolve; template-header depth verified against document URL (false-alarm documented) |
| Hero art | ✅ reviewed visually (on-brand, text-safe left space); 204 KB; 1-year `.htaccess` cache applies |
| Responsive | ⚠️ no structural markup changed → media-query behavior unchanged by definition; hero image has dedicated mobile variant rules already in header3 (601/640) — **visual QA on staging required (no browser in sandbox)** |
| Neon/blue palette eliminated | ✅ census proof §1 |

## 8. Risk Assessment

| Risk | Level | Mitigation |
|---|---|---|
| AI illustration ≠ photography style elsewhere | Low | illustration style mandated by brief; single hero slot |
| Remapped secondaries (teal→gold) shift semantic feel on a few legacy widgets | Low | same contrast family; staging eyeball checklist §9 |
| Google Fonts adds ~2 families of weight | Low | `display=swap`, graceful fallbacks documented |
| .mpj-divider on legacy (branding.css not linked there) | None | dividers only inserted on index.php which loads branding.css via header3 |

## 9. Manual Testing Checklist (staging)

- [ ] Home: hero shows couple illustration; navbar/topbar maroon; CTAs rose/pill; gold kickers; divider ornaments under section titles; footer tagline visible.
- [ ] Mobile (360px) + tablet (768px): hero mobile variant art loads; no horizontal scroll; nav drawer fine.
- [ ] Member login: background art + maroon login button; focus ring rose.
- [ ] Membership/order-review: buttons maroon/rose (not blue/pink); Pay flow untouched.
- [ ] A legacy list page (e.g., latest matches): links/buttons rose, no hot-pink/blue leftovers; preloader bars maroon/rose/gold.
- [ ] 404 page: rose accent; 404 copy branded (R2).

## 10. Recommendations for Next Phase (R4 — Admin & Agent skin)

1. Console (DashboardKit): retheme its SCSS-vars/bootstrap css toward palette via scoped `branding.css`-style override for console only; login page already emblem-branded — extend to sidebar accents, table headers, badges, buttons; keep all ids/hooks.
2. Agent `common.php` inline theme → token remap + emblem already present.
3. Same guardrails; stop after phase.

**Stopping here for approval, per the phase protocol.**
