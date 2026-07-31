# Rebranding Database Map — Manpasand Jodidar

Companion to `database/rebranding-r5-owner.sql` (the ONLY DB change vehicle; code never applies it).
Rows/columns below were identified from application code, not live DB access — the pack's
**preview SELECTs** return the exact record counts before any UPDATE runs.

## 1. Scope model

| Class | Rule |
|---|---|
| Application-owned config/CMS/SEO text | eligible for scripted REPLACE (pack) |
| User-owned content (profiles, stories, quotes, messages) | NEVER scripted — excluded |
| Credentials/mailbox logins/keys | owner-change only, coordinated with provider |

## 2. Tables affected by the migration (application-owned)

| Table | Row scope (code-observed) | Columns targeted | Expected records |
|---|---|---|---|
| `siteconfig` | single row `ID=1` | `Webname`, `copyright_footer`, `app_name` | 1 |
| `cms` | site-authored pages (`link` values incl. aboutus, contactus, faq's, applink, direction, terms, privacy, refund, disclaimer, reportmisuse, logout_content, copyrights; ~5 literal `link=` filters seen in code, more rows console-managed) | `content` | preview SELECT returns exact count; LIKE-filtered so only rows containing old text change |
| `seo` | one row per `catagory` (11 distinct values in code: aboutus, contact, disclaimer, faq, happy_story, membership, privacy_policy, refund_policy, safe_matrimony, search, term_and_condition) | `title`, `description` (+ optional commented `keywords`) | ≈11 |
| `email_sending` | single row `id=1` (SMTP identity used by `smtp2.php` → PHPMailer From/FromName) | `from_name` only — `username` (SMTP login mailbox) deliberately NOT updated here | 1 |

REPLACE pattern list applied per column (order matters, longest-first per family):
`Shivraj Maratha`, `शिवराज मराठा`, `Weddings Parampara`, plus
`Vadhu Var Suchak Kendra` (footer) and `LAGNAM by Sanskriti Parampara` / `Sanskriti Parampara` / `शुभ विवाह • सुयोग्य जीवनसाथी` (cms).
All UPDATEs are idempotent-safe (re-running changes nothing once values are new).

## 3. Tables verified — application-owned but NO brand text

| Table | Contents (code-observed) | Verdict |
|---|---|---|
| `home_page_video` | `video_url`, `thumbnail`, `status` (asset refs only) | no action |
| `email_sending.username` | SMTP login mailbox | owner change (provider-coordinated), not scripted |
| `siteconfig.owner` | proprietor personal name | intentionally kept (personal name) |

## 4. Values intentionally skipped (with evidence)

| Where | Value | Reason |
|---|---|---|
| Success stories / testimonials tables | quotes naming the old service ("…शिवराज वधू वर चे…") | user voice; rewriting testimonials is misrepresentation |
| `register` + member data tables | names, notes | user data |
| `agents`, `agent_*` | agent business data | user/partner data |
| `siteconfig.owner` | अ‍ॅड.शिवराज जाधव | proprietor's personal name (also shown on about-us) |
| `email_sending.username` | info@shivrajmaratha.com | SMTP login identity; changing before mailbox migration breaks all mail |
| SMS gateway templates (DLT) | "Welcome To Jaipur … Mahadi Group" | DLT-registered text; code mirrors it; must re-register first |

## 5. Manual review items for the owner

1. Run pack STEP 0 previews; screenshot results before UPDATEs.
2. Verify `cms` preview rows are all site-authored boilerplate (spot-read 1–2 rows before applying content REPLACE).
3. Decide mailbox migration (`info@shivrajmaratha.com` 17 code refs + `email_sending.username`); when the new mailbox exists, update `email_sending.username/password` + the 17 code references in one coordinated change.
4. Social profile URLs (`siteconfig`-backed `console/social.php` screen) — current code falls back to placeholder root links (facebook.com/ etc.); set real handles in the console.
5. Contact phone numbers shown are ops numbers (91-9403550087, 9404500378, 9422524060…) — confirm they are the current business numbers.

## 6. Rollback verification

- **Before:** full `mysqldump` (header of pack). Restore = `mysql < backup` — definitive rollback.
- **In-place inverse recipe** (if backup unavailable), replacing new→old on the same four columns is mechanically symmetric; because REPLACEs are literal, restore accuracy is guaranteed for the exact strings the pack's preview SELECTs captured. Recommended: keep pack preview outputs as the rollback reference.
- **Verify-after:** pack STEP 4 queries must return 0 LIKE-matches; app-level runtime shield (`about-us.php` str_ireplace) continues to mask any missed legacy value either way, so rollback urgency is low.
- Git history does NOT track DB — rollback relies on the two mechanisms above only.

## 7. Coverage statement

Every application-owned branding surface discoverable in code (identity row, CMS pages, SEO meta, SMTP display name, cron team name) is covered by the migration or explicitly classified as owner-action. No other first-party table writes were found containing free-text brand identity: console content modules funnel into `cms`/`siteconfig`; `home_page_video` is asset refs; `email_sending` handled; remaining writes are numeric/user data.
