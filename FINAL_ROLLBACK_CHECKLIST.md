# Final Rollback Checklist — Manpasand Jodidar Release

Rollback is designed to be boring: the rebrand touches no schema, no sessions, no
secrets, and no business logic. Three independent layers, each reversible alone.

## 0. Decide the layer (most incidents need only ONE)

| Symptom | Layer to roll back |
|---|---|
| Visual/branding regression on web | Code (§1) only |
| Emails/prints look wrong | Code (§1) only |
| DB-CMS/SEO text wrong after SQL pack | Database (§2) only |
| Cache-served stale/mixed branding | Cache (§3) only |

## 1. Code rollback

**Full rollback (emergency):**
```bash
# on the host checkout
git revert -m 1 <merge-commit-sha>      # or: git reset --hard <pre-merge-sha>
git pull   # confirm files restored
```
**Nuclear alternative:** redeploy the last file backup taken in Deploy §A.

**Partial rollback (surgical):** each phase is a clean commit band — revert only
what misbehaves:
- Emails/prints/share/SQL-doc pack: `git revert 481190f..cdfa636`
- Admin/agent skin: `git revert c48c413..481190f`
- Public UI: `git revert ea5858c..c48c413`
- Head wiring + strings: `git revert 030025e..ea5858c`
- Brand kit foundation (keep!): `74d673e..030025e` — reverting this breaks later bands;
  revert R5→R2 first if you must reach R1.

After any code revert: `php -l` sweep + purge caches (§3) + spot-check the reverted flow.

## 2. Database rollback

- [ ] `mysql -u <user> -p <db> < backup-pre-rebrand-<date>.sql` (definitive).
- [ ] Or apply the **inverse** of the pack: every UPDATE in
      `database/rebranding-r5-owner.sql` is a literal `REPLACE(col,'OLD','NEW')`;
      swapping the two string arguments restores prior text exactly for values the
      STEP-0 previews captured. Keep those previews — they are the reference.
- [ ] Verify: STEP 4 queries now show original values; site renders old/new text
      per code shields (`about-us.php` shield renders Manpasand Jodidar either way —
      expected, harmless).

## 3. Cache rollback / stabilization

- [ ] Purge CDN/host cache again after any revert (mixed old/new edge copies are the
      most common "rollback didn't work" cause).
- [ ] If users report stale branding after rollback without a revert: it's cache —
      purge + hard-refresh guidance; optionally bump `?v=` on css links.
- [ ] Razorpay dashboard logo (if changed) — revert inside Razorpay console.

## 4. Post-rollback verification

- [ ] Home/login/signup render old branding consistently.
- [ ] One transactional email renders old layout.
- [ ] Admin console usable (old theme restored).
- [ ] Confirm DB values match code (avoid mixed new-code/old-DB or vice versa > 24h).
- [ ] Log the incident + decide re-merge plan with fixes.

## 5. What rollback can NOT / need NOT touch

- Sessions/cookies: unchanged by the rebrand — users stay logged in regardless.
- `branding/` asset files: if deleted locally, restore via
  `git checkout <pre-rebrand-sha> -- <path>`; deleted vendor demo SVGs recover via
  `git checkout efaf8e1 -- console/assets/images/<file>`.
- `email_sending.username` / gateways / Firebase: untouched by this release —
  no credential rollback possible or needed.

## 6. Contacts & artifacts

- Release artifacts on PR #1 (per-phase diffs + this checklist).
- DB backups: `backup-pre-rebrand-*.sql` (retain ≥30 days).
- Rebuild any brand asset: `branding/tools/rebuild-assets.sh` (idempotent).
