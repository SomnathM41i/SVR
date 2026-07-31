# Final Deployment Checklist — Manpasand Jodidar Release

Owner-run, in order. Estimated total: ~60–90 minutes + owner tasks.

## A. Pre-deploy (day 0)

- [ ] Confirm PR #1 review is complete (per-phase ranges in its body).
- [ ] **Full DB backup:** `mysqldump -u <user> -p <db> > backup-pre-rebrand-$(date +%F).sql`
- [ ] **Full file backup** of the production web root (or confirm host snapshot).
- [ ] (Recommended) Swap in the original logo master first:
      `branding/logos/manpasand-jodidar-logo.png` → then `bash branding/tools/rebuild-assets.sh`
      → commit → the PR updates itself. Skip if approving with the recreated master.
- [ ] (If new domain) export `SVR_BRAND_URL=https://<new-domain>` in the host environment —
      one constant; all 39 hardcoded references resolve through `includes/branding.php`.

## B. Merge & code deploy

- [ ] Merge PR #1 (GitHub) or `git merge arena/019fb6b6-svr` on the host's main branch.
- [ ] `git pull` on the production checkout.
- [ ] Syntax sweep: `find . -maxdepth 2 -name '*.php' -print0 | xargs -0 -n1 php -l | grep -v 'No syntax errors'` → expect empty.
- [ ] Asset smoke (HTTP 200s): `/branding/logos/emblem.png`,
      `/branding/favicons/favicon.ico`, `/branding/images/email-logo.png`,
      `/branding/images/print-logo.png`, `/console/assets/css/mpj-brand.css`,
      `/branding/branding.css`.
- [ ] Deleted-assets 404 expectation: previously 404 demo SVGs remain 404 (nothing links them).

## C. Database brand update (optional-but-recommended, code-independent)

- [ ] Open `database/rebranding-r5-owner.sql`; run STEP 0 preview SELECTs; eyeball rows.
- [ ] Run UPDATEs; run STEP 4 verify SELECTs (expect 0 LIKE matches).
- [ ] Keep preview outputs (they are the rollback reference).

## D. Post-deploy verification (~30 min, from VISUAL_VERIFICATION_REPORT §4–6)

- [ ] Public: home, login, signup, search, results, public profile, membership, contact, about, 404.
- [ ] Checkout: Razorpay dialog shows the new emblem; complete one TEST payment; callback OK; success page + payment email arrive with letterhead.
- [ ] Member: dashboard, edit profile save, photo upload, biodata print (letterhead+watermark), invoice print.
- [ ] Emails: trigger OTP + one interest mail; view in Gmail **and** Outlook web.
- [ ] WhatsApp share from a result row: message shows brand + tagline.
- [ ] Admin: login, dashboard charts colors, member list, one CMS save (cms writes are unchanged code), agent login.
- [ ] Mobile API: one authenticated endpoint from the app (keys/payloads unchanged).
- [ ] Cross-browser: Chrome, Edge, Firefox per §5 matrix.
- [ ] Mobile viewport 375px spot-check: home, search results, checkout.

## E. Cache & delivery

- [ ] Purge CDN/host cache for `/branding/*`, `*.css`, `*.js`, and HTML.
- [ ] Advise first-visit hard refresh (Ctrl+F5) OR temporarily append `?v=20260801` to
      `style.css`/`mpj-brand.css` links if stale-indigo reports appear.
- [ ] Verify `theme-color` tint on Android Chrome (tab bar should be maroon).

## F. Owner tasks (not part of code deploy — track separately)

1. DLT SMS template re-registration → then update `asysendotp.php` / `registrationconfirmation.php`.
2. Mailbox migration (`info@shivrajmaratha.com` → new) → update `email_sending.username` + 17 code refs together.
3. apis/ "dishavadhuvar" change-set (Firebase project, FROM names, URLs, JSON watermark) — coordinate with app release.
4. Social profile URLs in console (footer placeholders currently).
5. Razorpay dashboard-side logo/brand color.
6. Optional: canonical tags, JSON-LD Organization, `sitemap.xml` + robots sitemap line.
7. Optional: delete inert old-brand asset files after DB-content audit (`REBRANDING_ASSET_MAP.md §6`).

## G. Done

- [ ] Tag the release: `git tag rebrand-manpasand-jodidar <merge-sha>` (optional).
- [ ] Archive this PR; keep `backup-pre-rebrand-*.sql` for ≥30 days.
