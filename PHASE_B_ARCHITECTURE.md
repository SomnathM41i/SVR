# Phase B — Architecture Refactoring Report

**Scope:** architecture improvements **without functionality changes**, following the audit's entry plan.
**Baseline:** Phase-2 end (`d3065dc` area) → HEAD. **3 logical commit groups**, each self-contained.
**Invariant enforced everywhere:** identical runtime behavior unless a change *restores* a clearly-intended, previously-broken behavior (each such case is listed explicitly in §3).

---

## 1. Summary

| Batch | Commit | What it does | Files |
|---|---|---|---|
| B2 — Include hierarchy | `23580ae` | New `includes/bootstrap.php` (config → db/session → security, single `__DIR__`-safe include-point); **485 pages** converted from `require(_once)['('](../)sys_dbconnection.php` to the depth-correct bootstrap path | 1 added, 485 modified (1 line each) |
| B1 — Audit-surfaced repairs | `c9c877d` | Adds the missing **`payment_failed_handler.php`** the live Razorpay checkout always called; restores silently-failed guards on `banned_member.php` / `photo.php` / `add_successstory.php`; repairs 35+ broken asset refs on those live pages | 1 added, 3 modified |
| B3 — Shared handler extraction | `b5f6422` | New `console/inc/console_lib.php` (`svr_console_cms_save_content`) replacing the verbatim CMS-save block in **8** console handlers (SQL byte-identical) | 1 added, 8 modified |

**Totals:** 3 files added, 488 modified (net ~+315 lines including docs), 0 deleted.

## 2. Files Modified / Added / Deleted
- **Added:** `includes/bootstrap.php`, `console/inc/console_lib.php`, `payment_failed_handler.php` (+ this report).
- **Modified:** 485 include-line conversions (root/console/agent/firebase/template), `banned_member.php`, `photo.php`, `add_successstory.php`, 8 console CMS handlers.
- **Deleted:** none.
- **Explicitly not converted:** `apis/` (mobile contract), `agent/common.php` (own bootstrap), `database/migrate_taluka.php` (CLI), all vendor packages.

## 3. Reason for Every Change
1. **Bootstrap include-point:** one audited door for config+session+security (removes 5 different include spellings scattered across 488 files; makes future services loadable in one place). *Risk-free:* per-file diff = exactly 1 line; load-time side effects proven identical.
2. **`payment_failed_handler.php`:** the checkout JS has always `fetch()`ed this URL; it 404'd. Mirrors `payment_success.php`'s own failure branch exactly (`transactions.status='Failed'` + `updated_at`, member-only, JSON, **Pending-only guard** so settled orders can never flip). Success path untouched.
3. **Guard restorations (the Phase-B headline risk find):** `banned_member.php` (ban members) and `photo.php` (approve gallery photos + write files) are **admin actions** whose only protection was `include('protect.php')` — a file that never existed at their location, so the guard failed silently for years. Both now require the real admin guard; raw GET/POST values interpolated into their UPDATEs are escaped. `add_successstory.php` (member story form) got the member gate the same broken include promised, plus dead-include removal.
   *These three change behavior in one deliberate way: anonymous requests that previously executed are now redirected to login. Logged-in admins/members see zero difference.*
4. **Asset-ref repairs:** the two pages were built for the DashboardKit theme but referenced `assets/...` from webroot; the files live only under `console/assets/`. 35 refs repointed (+ `style.css`→`css/style.css`, `../images/bannermobile.jpg`→`images/bannermobile.jpg`). Broken-image noise on live pages eliminated without touching markup.
5. **CMS-save extraction:** 8 handlers had a byte-identical 3-line block; now one function (SQL string verified byte-identical per cms_id). 8 siblings deliberately skipped — their save logic genuinely differs.

## 4. Risk Assessment
| Change | Risk | Mitigation |
|---|---|---|
| 485-line include swap | Very low (mechanical) | per-file line-diff=1 + path-resolution check (485/485 pass, 0 exceptions) |
| Bootstrap load order | Low | bootstrap requires the same files in the same order; `require_once` idempotency proven; security.php has no side effects beyond sys_dbconnection's own |
| Guard restorations (3 pages) | Behavioral by design | anonymous abuse closed; logged-in flows unchanged; trivially revertable per-file; flagged for owner in §7 |
| payment_failed_handler | Low | mirrors existing failure semantics; no schema write beyond the same `UPDATE transactions` the success file already performs; Pending-only guard |
| CMS extraction | Very low | reverse-simulation byte-proof ×8; SQL string equality proof per id |
| `gallary/` write path in `photo.php` | **Left untouched on purpose** (cwd-dependent legacy) | documented in debt §7 |

## 5. Validation Results
| Check | Result |
|---|---|
| Brace/paren/bracket balance across all 488 modified PHP files | ✅ 0 flips |
| Include conversion line-diff (485 files) | ✅ exactly 1 line each, all paths resolve to `includes/bootstrap.php` |
| Missing includes (comment-stripped, whole tree) | ✅ **10 → 5** (all 5 remaining are context-dependent legacy cases, documented) |
| Broken asset refs on repaired pages | ✅ `photo.php` 12 → **0**; `add_successstory.php` 29 → **8** (rest = `ckeditor/sample.css`, `bootstrap-switch-master/*`, front-theme refs — see debt) |
| Executable-content audit | ✅ only intended edits exist (line-swap ×485, 3 repair files hand-audited, 8 CMS files reverse-simulation-proven) |
| APIs | ✅ 0 files touched |
| Console guards | ✅ 254+ `protect.php` guard lines intact; 2 additional admin actions now actually guarded |
| New include targets exist | ✅ `includes/bootstrap.php`, `console/inc/console_lib.php` resolve from every converted file |
| Conflict markers / TODO / debug added | ✅ none |
| `php -l` on staging | ⚠️ mandatory gate (no runtime in sandbox) |

## 6. Manual Testing Checklist (staging)
1. `find . -name '*.php' -exec php -l {} \;` → 0 errors.
2. Member login → dashboard renders (bootstrap path exercised by ~200 pages).
3. Admin login → open 2-3 console pages incl. one CMS edit (e.g. Privacy Policy): save content → renders + persists.
4. Success-story page as member (form + assets load, no broken images); same URL logged-out → redirects to login (new gate).
5. Admin: profile_view → Ban action works (banned_member now executes under guard); crop/approve page guarded.
6. Razorpay test-payment **failure** path: abandon checkout → redirect to `payment_failed.php`, and `transactions.status` shows `Failed` (handler working).
7. One cron via CLI; one app API call.

## 7. Remaining Technical Debt
- `photo.php` writes cropped files to `../gallary/` (cwd-dependent; resolves above-webroot in some contexts). Needs an owner decision (move into `console/` or fix path) — **functionality deliberately left as-is.**
- `add_successstory.php`: 8 asset refs remain unresolvable (`ckeditor/sample.css`, `bootstrap-switch-master/**` vendor package never committed). Needs vendor-file decision.
- `console/gal_photo_approve.php` (`meta.php`/`main_style.php` includes) + console cron `smtp2.php` web-context + root `smtp.php` context paths — all pre-existing, behavior-neutral in production contexts; left untouched.
- 8 console CMS siblings not unified (differing save semantics) — Phase E candidates after flow review.
- The 62 remaining zero-ref orphan pages + JS helper variants (5–8 per family) are unchanged from audit — gated on owner confirmation / Phase D.

## 8. Recommendations for Phase C (Performance)
1. **`siteconfig.php` per-request `UPDATE register SET last_seen`** → move to guarded/throttled write (e.g. once per session per N minutes).
2. **Login full-table scan** (`select * from register` + PHP loop) → direct WHERE lookup (biggest single perf win; keep comparison semantics per password freeze).
3. `SELECT *` on the hot pages (index/search/profile/dashboard first family) → explicit column lists **page-family by page-family** with template-consumption diffing.
4. N+1 in list pages (membership/status lookups per row) → JOIN or IN() batching, individually proven.
5. Asset pipeline quick wins: consolidate the 3-5 always-loaded first-party css/js bundles per theme family + defer/async where order-safe (no minification tooling yet).
6. Add `?v=` fingerprinting strategy + long-cache headers for hashed assets (builds on the `.htaccess` cache block already present).

---
⛔ **Stopped — awaiting your approval before Phase C.**
