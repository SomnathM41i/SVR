# Final Release Notes — Manpasand Jodidar Complete Rebrand

**Release vehicle:** PR #1 (`arena/019fb6b6-svr`, awaits owner approval) ·
**Scope:** Security hardening + cleanup + architecture docs (earlier phases) +
**complete rebrand SVR/Shivraj Maratha → Manpasand Jodidar** (R1–R5 + audit).

## 1. What ships

- **Brand foundation (R1):** complete asset kit under `branding/` (master logo + 30+
  derivatives: favicons/PWA icons, email/print/splash/OG/social images, watermark,
  tokens css), central `includes/branding.php` config, 5 brand guides, rebuild pipeline.
- **Wiring (R2):** 502 asset-URL swaps, 211 brand strings, head icons/manifest/
  theme-color/OG-defaults on 205+ pages.
- **Public UI (R3):** 913 palette swaps (legacy neon → maroon/rose/gold), brand
  typography (Playfair/Poppins/Cormorant), landing ornaments, broken production hero
  fixed with commissioned brand illustration.
- **Admin + agent (R4):** DashboardKit converted (981 theme swaps), accent layer on
  134 pages, charts rebranded, agent panel skin, both login screens.
- **Outputs (R5):** 18 email templates letterheaded, biodata/invoice prints with
  letterhead+watermark, WhatsApp share text on 16 sites, 6 zero-ref vendor assets
  retired, owner DB pack.
- **Audit + validation (final):** end-to-end brand audit (2 live defects found & fixed),
  3 validation maps/reports, visual evidence boards, deploy/rollback/release docs.

**Scale:** 968 files in the program (+11,164/−28,033); 377 in the rebrand subset
(+5,665/−2,919); ≈3,150 exact replacements; **0 PHP-logic changes** in the rebrand.

## 2. User-visible changes

Consistent maroon/rose/gold identity, new logo/favicon everywhere, maroon browser tint,
serif headlines, branded emails with footer tagline, branded biodata/invoice PDFs with
watermark, branded WhatsApp shares, rebranded admin console + agent panel, branded
checkout dialog.

## 3. Compatibility & guarantees

- No schema changes, no session/secret changes, no API contract changes, no feature
  removals; URLs/routes/forms/callbacks unchanged; password storage untouched.
- Browser support: unchanged theme baseline + CSS subset supported by all evergreen
  Chrome/Edge/Firefox.
- Rollback: layered (code revert per-phase, DB restore/inverse-REPLACE, cache purge) —
  see `FINAL_ROLLBACK_CHECKLIST.md`.

## 4. Known limitations (documented, by design)

- `template/` mock directory contains fixture content with old-name strings (unused).
- `mvv-` CSS prefix and `SVR_*` internal identifiers remain (invisible; refactor risk>benefit).
- Console dark theme = recolored, not a designed dark brand theme.
- 500 error page = server default (no custom page existed before either).
- SEO add-ons absent pre-rebrand remain absent: canonical, JSON-LD, sitemap (roadmap).

## 5. Owner manual tasks (short summary — full detail in REBRANDING_VALIDATION_REPORT §7)

1. **Production logo:** drop original master into `branding/logos/`, run rebuild script.
2. **Database:** run `database/rebranding-r5-owner.sql` (backup → previews → updates → verify).
3. **DNS/domain:** only if rebranding the domain too — set `SVR_BRAND_URL` env.
4. **Firebase:** new/kept project for FCM + apis/ "dishavadhuvar" change-set with app team.
5. **DLT SMS:** re-register brand templates, then update OTP/registration SMS strings.
6. **Social media URLs:** set real handles in console (footers are placeholders).
7. **Email sender:** migrate `info@shivrajmaratha.com` mailbox (code refs + smtp2 identity).
8. **Payment gateway:** Razorpay dashboard-side logo/branding.
9. **CDN cache:** purge `/branding/*`, css/js, HTML after deploy; advise hard refresh.

## 6. Verification status

- Visual evidence: `verification/visual/` (boards from actual assets/values) +
  `VISUAL_VERIFICATION_REPORT.md` per-screen wiring.
- Staging gate: `FINAL_DEPLOYMENT_CHECKLIST.md` (php -l sweep + browser/functional smoke).
- All prior phase gates documented in `REBRAND_PHASE{1..5}` reports.

**Status: ready. Awaiting owner approval to merge PR #1.**
