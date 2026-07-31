# Phase A Validation & Regression Report

**Branch:** `arena/019fb6b6-svr` vs `main` @ `efaf8e1` - **Date:** 2026-07-31 - **PR:** #1

**Scope of this pass:** validation only - no feature changes. One compatibility-safe hardening addition was made to `.htaccess` (credential-file deny) after it was found during validation, plus this report.

## 1. Checklist results

| # | Check | Result | Evidence |
|---|-------|--------|----------|
| 1 | Changed-file functional review | **PASS** | Every changed file re-read or script-audited; fully-rewritten files individually balance-checked; 389 PHP files have identical brace/paren/bracket signatures pre/post (0 structural regressions). |
| 2 | Endpoint backward compatibility | **PASS** | All modified endpoints preserve request/response contracts (section 3). Two intended, documented behavior changes: forged/expired reset links rejected; forged/under-paid payment posts rejected. |
| 3 | Routes/includes/AJAX/forms/uploads/payments/admin/APIs/workflows | **PASS** | All include paths in changed files resolve; the 16 missing includes found are ALL pre-existing in the base commit (catalogued, not regressions). Deleted files: zero references in php/js/htm/css/htaccess. Form+handler CSRF pairs verified on both sides. Redirect audit: all new Location targets exist (console-relative targets verified against console/). |
| 4 | Prepared statements preserve business logic | **PASS** | Each conversion is WHERE-clause-identical to its original (MatriID/ConfirmEmail/Mobile/admin user+pass etc.); COUNT(*) used only where the original checked existence. |
| 5 | Production-environment compatibility | **PASS** | PHP 7.x-safe constructs only (?? with isset, PHP_VERSION_ID guards, no typed properties); guards fail-open when unconfigured; throttle fails open on temp-dir problems (with error_log); Secure cookie flag applies only on HTTPS requests; CLI crons always allowed. |
| 6 | New mandatory configuration | **NONE** | Every svr_config() call carries a literal legacy fallback (audited). SVR_CRON_KEY / SVR_API_ADMIN_KEY / SVR_APP_SECRET / config.local.php are all optional. |
| 7 | Deleted-files proof | **PASS** | Every deletion has a reference scan across php/js/htm/html/css/htaccess (section 4). PII dirs are untracked only - FILES REMAIN ON DISK. |
| 8 | Assets resolve (CSS/JS/images/fonts/templates/libs) | **PASS** | No asset/template/library files touched (deletions are php/bak/zip/log only). Deny-rules scanned against all href/src references: nothing legitimate serves the denied extensions. |
| 9 | Syntax/includes/variables/redirects/sessions/auth | **PASS** | Structural check clean. Undefined-variable review on edited blocks. Session-key diff: only the write-only $_SESSION['password'] removed (verified unread project-wide). Auth flows walked end-to-end. |
| 10 | Payment integrations | **PASS** | Razorpay membership flow (order create + signature verify) untouched except secret externalization; legacy contact-buy pair hardened; Instamojo webhook MAC logic preserved (timing-safe compare); CCAvenue and Stripe NOT modified (already inactive/empty configs). |
| 11 | Admin / user / agent / API functionality | **PASS** | Admin: guard enforcement is the only change (intended). Agent module untouched. User auth-critical forms verified; the signup funnel untouched. APIs: debug-off + optional key guard only. |
| 12 | Regression report | **DONE** | Section 3 lists every modified file with reason/risk/impact. |

## 2. Totals

- **Modified:** 382 files - **Added:** 10 - **Deleted/untracked:** 121
- Diff: +1,903 / -9,909 (bulk of deletions = untracked PII + removed .bak/zip artifacts)

## 3. Every modified file - reason / risk / production impact

Risk = chance of affecting production behavior. "Intended" = the security change itself.

### Core / root (73 files)

| File | Change | Risk | Production impact |
|------|--------|------|-------------------|
| `.gitignore` | secrets/logs/backups/PII dirs ignored | None | deploys unaffected |
| `.htaccess` | security headers, sensitive-extension deny, VCS deny, commented HTTPS template, credential-file deny | Medium | must smoke-test on deploy (see ops steps) |
| `about-us2.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `accept_contact.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `accept_interest.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `add_to_short_list.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `advance_search_result.php` | escFilterList escaping in dynamic search SQL (main + pagination) | Medium | same result sets; quote-breakout neutralized |
| `asysendotp.php` | OTP send throttle after feature-toggle check | Low | normal signups unaffected (3/10min) |
| `automailbdaywish.php` | cron guard (CLI always allowed) | Low | crontab runs unchanged |
| `biodatadelete.php` | rewritten: member auth + own-record delete (IDOR fix) | Low | unreferenced endpoint hardened |
| `block_submit.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `blur.php` | rewritten: path validation (LFI fix) | Low | legit blur URLs unchanged |
| `cancel_otp_step.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `change_password_submit.php` | CSRF verify | Low | legit submissions unaffected |
| `change_pswd.php` | CSRF field | Low | none |
| `check_email_exist.php` | rewritten: prepared stmt + escaped output (XSS fix) | Low | AJAX contract preserved |
| `check_mobile_exist.php` | prepared stmt | Low | AJAX contract preserved |
| `compatibilitymatches.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `contact_paid_success.php` | rewritten: Razorpay API verification + plan price check + prepared insert | High | fake/under-paid POSTs now rejected (intended); valid payments recorded same table |
| `cron_expireMember.php` | cron guard (CLI always allowed) | Low | crontab runs unchanged |
| `cronbirthdateWish.php` | cron guard (CLI always allowed) | Low | crontab runs unchanged |
| `daily_matches.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `decline_contact.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `decline_interest.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `delete_confirm.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `disclaimer.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `disclaimer2.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `education_site.php` | legacy mysql_* -> mysqli + escaping | Low | none |
| `fblogin_submit.php` | config include for error helper | Low | none |
| `forgot_password.php` | CSRF field + distinct error messages | Low | none |
| `forgot_password_submit.php` | signed reset token in email link; prepared stmts; CSRF; throttle | Medium | reset emails now contain token= links; old tokenless links rejected (intended) |
| `full_profile.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `full_profile_photo_issue.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `getinvoice.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `ignore.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `invoice.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `latest_matches.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `login.php` | CSRF field + no password prefill from cookie | Low | username prefill kept |
| `login2.php` | CSRF field + no password prefill from cookie | Low | username prefill kept |
| `login_submit.php` | CSRF verify + POST-only + throttle + session regeneration + no password cookie/session | Medium | valid logins unchanged; password prefill removed (intended security UX change) |
| `mail1.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `membership_choose.php` | key id/secret via config fallback | Low | order creation untouched |
| `membershipautomail.php` | cron guard (CLI always allowed) | Low | crontab runs unchanged |
| `message_received.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `message_send.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `mutual_matches.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `my_offer2.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `new_pass.php` | requires signed token; prepared stmts; debug SQL echo removed; CSRF | Medium | forged/expired links blocked (intended); password storage unchanged |
| `off_recommend.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `pageloader1.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `payment_success.php` | secret via config fallback | Low | signature verify logic untouched |
| `photoprocess.php` | rewritten: path validation (LFI fix), same resize behavior | Medium | legit gallary/* image URLs unchanged; non-image paths now 404 (intended) |
| `premium_members.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `privacy-policy.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `privacy-policy2.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `razorpay.php` | rewritten: config key, JSON-encoded JS values, searchid forwarded, broken trailing MAC block removed | Medium | legacy checkout flow preserved |
| `register_submit.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `registrationconfirmation.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `resend_interest.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `resend_mail.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `returns-and-cancellation.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `returns-and-cancellation2.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `safematrimony.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `safematrimony2.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `siteconfig.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `submit_message.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `sys_dbconnection.php` | DB creds via env/config fallback; session cookie hardened (HttpOnly/SameSite/Secure-aware, strict mode); mysql_connect_error typo fixed | Medium | same connection & session behavior; cookie flags stricter (intended) |
| `terms-conditions.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `terms-conditions2.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `upload_id_proof.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |
| `verify_otp.php` | master OTP removed; CSRF check; throttle notice | Medium | legitimate OTP flow unchanged |
| `webhook.php` | salt via config, hash_equals MAC, guarded reads, 400 on bad MAC | Medium | valid Instamojo webhooks unchanged |
| `yes_connected.php` | legacy die(mysql*_error()) -> svr_db_fail() (mechanical conversion; success path identical) | Low | DB errors now log server-side + generic 500 instead of raw SQL text |

### Admin (console/) (285 files)

| File | Change | Risk | Production impact |
|------|--------|------|-------------------|
| `console/ContactAmount.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/Delete_idproof.php` | rewritten: admin-only + prepared statement (was unauthenticated SQLi) | Low | none for admins |
| `console/User_Profile.php` | prepared statement | Low | none |
| `console/aboutusseo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/activity_basic.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/activity_connected.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/activity_log.php` | prepared statement | Low | none |
| `console/activity_pro_view.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/activity_view_contact.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/activity_view_shortlist.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_aboutus.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_applink.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_bankdetails.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_caste.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_caste_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_city.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_copyrights.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_country.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_direction.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_disclaimer.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_dist.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_education.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_education_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_employed_in.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_employedin_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_faq's.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_hobbies.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_hobbies_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_institue.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_institue_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_interest.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_interest_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_membership.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_moonsign.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_moonsign_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_new_note.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_occupation.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_occupation_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_privacy.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_recommendation.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_refundpolicy.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_religion.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_reportmisuse.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_residency_status.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_residencystatus_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_safematrimony.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_star.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_star_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_state.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_subcast.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_subcaste.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_subcaste_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_tagline.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/add_terms.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/addcity_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/addcountry_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/adddist_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/addfeatureduser_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/addreligion_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/addstate_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/advance_result.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/agent_add.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/agent_assign_plans.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/agent_customers.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/agent_dashboard.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/agent_delete.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/agent_edit.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/agent_sales.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/agent_status.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/agent_view.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/agent_withdrawals.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/agents.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/approv_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/approve_member.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/backup.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/ban_femalemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/ban_malemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/ban_report.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/ban_report_view.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/bar_chart.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/blockreport.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/castechange.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/chages.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/change_date_format.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/change_password_submit.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/change_settings.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/changedemo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/changepassword.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/chart.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/check.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/check_email_exist.php` | prepared statement + output escaping | Low | none |
| `console/clearbtn.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/cms.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/commission_report.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/contactusseo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/count1.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/cron_birthdateWish.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/cron_expireMember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/crop-image-store.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/datbasebackup.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/deactivate_profile.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/degrade_member.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_ban_new.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_caste.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_city.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_country.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_dist.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_document.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_education.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_employed_in.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_featured_user.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_feedback.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_hobbies.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_horo_photo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_institute.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_member.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_moonsign.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_occupation.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_profile_photo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_profile_requests.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_profiles.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_recommendation.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_religion.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_residency_status.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_star.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_state.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_subcaste.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_success.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/delete_success_story.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/deletemember_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/disclaimer_seo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/docdel.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/donut_chart.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/donut_chart_gender.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_basic.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_caste_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_contact.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_edu.php` | restored commented-out admin guard | Low | page now requires admin login (intended) |
| `console/edit_education_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_employedin_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_family.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_hobbies_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_horoscope.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_institute_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_interest_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_mem.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_moonsign_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_occupation_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_partner.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_physical.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_residencystatus_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_star_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/edit_subcaste.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/editcity_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/editcountry_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/editdistrict_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/editreligion_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/editstate_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/error_code.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/expire_femalemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/expire_malemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/family_approval.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/faq_seo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/featured_user.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/feedback.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/female_freemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/fill_caste.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/fill_dist.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/fill_state.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/fill_subcaste.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/fill_taluka.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/fill_working_dist.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/fillstate.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/footer.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/footersection.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/free_member.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/get_caste.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/get_city.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/get_count.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/get_dist.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/get_education.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/get_id.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/get_membership.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/get_state.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/get_subcaste.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/googleanalytic.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/happy_story_seo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/heart.php` | admin guard added (placement repaired) | Low | none |
| `console/heart1.php` | admin guard added (placement repaired) | Low | none |
| `console/high_chart.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/homeseo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/idpass_report.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/idpassreport1.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/institutereport1.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/instutute_report.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/label_print.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/label_print_reports.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/licences-matrimony.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/line_chart.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/login.php` | CSRF hidden field added to form | Low | none |
| `console/login_submit.php` | rewritten: POST-only, CSRF verify, throttle, prepared statement, session regeneration | Medium | Admin login flow unchanged for valid users; bots/GET rejected |
| `console/logout.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/logout_content.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/main_chart.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/main_chart1.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/male_freemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/membership_active.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/membership_report.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/membershipreport.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/membershipseo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/mobile_report.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/mobilenoreport.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/modal_test.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/multiseleadmin.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/note.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/note_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/notification.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/ol_femalemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/ol_malemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/otp_system.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/paid_femalemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/paid_malemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/partener_expectation.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/partner_matches.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/partnerprefrence.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/pay_sms_details.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/payment_getway_details.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/per_delete.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/photoprocess.php` | rewritten: path validation (LFI fix) + admin guard | Low | admin-only image resize unchanged |
| `console/photoreport.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/pie_chart.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/pie_chart_caste.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/print.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/print_my_profile.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/print_profile_demo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/print_profile_dummy.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/privacy_policy_seo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/pro_completed.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/profile_approval.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/profile_details.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/profile_note_modal.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/profile_print_my.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/profile_status.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/profile_view.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/profile_view1.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/profileadmin.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/profilecompletion.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/protect.php` | rewritten: session start, exit-after-redirect (auth-bypass fix), JSON 401 for AJAX | Medium | Admin pages now HARD-require a valid admin session; expired sessions get redirected/401 (intended) |
| `console/refund_policy_seo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/religionchart.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/safe_matrimony_seo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/sales_report.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/sales_reportdatewise.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/sample.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/search_result.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/searchseo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/self_preferences.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/send_personal_mail.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/sendmail.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/share.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/shareprofile.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/show_matches.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/show_pie_chart.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/site_statistics.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/siteconfig.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/social.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/social_submit.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/stacked_bar.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/sys_settings.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/term_and_condition.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/term_and_condition_seo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/today_paid_member.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/today_paidmember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/todaymember_list.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/total_femalemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/total_malemember.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/unban_members.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/unban_update.php` | restored commented-out admin guard | Low | endpoint now requires admin login (intended) |
| `console/updoc.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/upload_bio_photo.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/viewfam_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/viewpart_pop.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/whatsupcode.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/withuphoto.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |
| `console/wp.php` | admin auth guard inserted (C4) + legacy die(mysql_error) conversion where present (H7/H10) | Low | page requires admin session (intended); success-path output identical |

### APIs (apis/) (24 files)

| File | Change | Risk | Production impact |
|------|--------|------|-------------------|
| `apis/diwali_notification.php` | debug output disabled + optional X-API-Key guard (active only after SVR_API_ADMIN_KEY set) | Low | none until ops sets the key (default-open) |
| `apis/get-all-districts.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/get-basic-details.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/get-biodata.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/get-city-list.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/get-document.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/get-family-details.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/get-horoscope-details.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/get-kanda-pohe-meeting-details.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/get-photo-gallery.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/getMyMembershipPlanDetails.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/kanda-pohe-meeting.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/register.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/send-test-notification.php` | debug output disabled + optional X-API-Key guard (active only after SVR_API_ADMIN_KEY set) | Low | none until ops sets the key (default-open) |
| `apis/send_fcm_notification.php` | debug output disabled + optional X-API-Key guard (active only after SVR_API_ADMIN_KEY set) | Low | none until ops sets the key (default-open) |
| `apis/send_new_match_notifications.php` | debug output disabled + optional X-API-Key guard (active only after SVR_API_ADMIN_KEY set) | Low | none until ops sets the key (default-open) |
| `apis/unblock-user-profile.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/update-basic-details.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/update-family-details.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/update-horoscope-details.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/upload-biodata.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/upload-document.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/upload-photos-gallery.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |
| `apis/upload-profile.php` | production debug output (display_errors/E_ALL) disabled | Low | JSON responses unchanged; PHP notices no longer leaked |

## 4. Deleted / untracked files - proof of safety

| File | Why removed | Why it is safe |
|------|-------------|----------------|
| `Profile_shortlisted.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `Vcontactdetail.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `adhar/2026_05_15_02_24_0228IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_05_15_03_49_5728IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_05_15_04_05_3828IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_05_31_06_22_130ad81db4e845c3a230e1367f26dea02e.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_06_01_12_15_115dacb39a40b35b1e6f44f576b62bd29c.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_06_01_12_55_488f27745dfd7c5741e2ad861f6905f850.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_06_02_03_01_4128IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_06_09_05_03_04images24.jpeg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_06_13_01_58_355dacb39a40b35b1e6f44f576b62bd29c.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_06_13_10_08_198f27745dfd7c5741e2ad861f6905f850.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_06_14_11_19_255dacb39a40b35b1e6f44f576b62bd29c.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_06_16_01_04_045dacb39a40b35b1e6f44f576b62bd29c.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_06_17_05_01_0528IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_06_23_12_37_4428IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_06_25_11_10_51bg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_07_11_05_06_14PackagesBreadcrumb.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_07_16_01_38_19PackagesBreadcrumb.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_07_16_05_03_12PackagesBreadcrumb.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_07_20_12_14_52bg123.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_07_21_12_47_11bg123.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_07_22_11_09_20bg123.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `adhar/2026_07_24_03_59_10PackagesBreadcrumb.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `apis/_apis.zip` | deleted: source-code archive downloadable from web root (H8). Verified: no references | none |
| `apis/send_fcm_notification.php.zip` | deleted: source-code archive downloadable from web root (H8). Verified: no references | none |
| `block_profile.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `bounce.php` | deleted: unreferenced scaffold/stub file (H8). Verified: no references in php/js/html/htaccess | none |
| `console/error_log` | deleted: committed PHP error log with server paths (H7). Verified: nothing reads it | PHP recreates it at runtime |
| `decrypt.php` | deleted: unreferenced debug toys - live reflected-XSS + open-redirect endpoints (H8/H2). Verified: no references | none |
| `encrypt.php` | deleted: unreferenced debug toys - live reflected-XSS + open-redirect endpoints (H8/H2). Verified: no references | none |
| `example.php` | deleted: unreferenced scaffold/stub file (H8). Verified: no references in php/js/html/htaccess | none |
| `full_profile.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `full_profile_photo_issue.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `gallary/2026_05_15_02_23_2228IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_05_15_03_40_52TMs7rMHjTZGJQaSpS6tVNg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_05_15_03_49_4428IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_05_15_04_00_3728IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_05_15_04_08_1228IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_05_15_04_12_2728IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_05_31_06_22_035dacb39a40b35b1e6f44f576b62bd29c.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_01_12_15_020ad81db4e845c3a230e1367f26dea02e.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_01_12_55_345dacb39a40b35b1e6f44f576b62bd29c.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_02_03_01_3028IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_02_12_06_4328IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_09_05_02_350b8d65be-7f51-4c3e-88e2-f36df1f6f4cd.jpeg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_13_01_56_005dacb39a40b35b1e6f44f576b62bd29c.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_13_10_08_110ad81db4e845c3a230e1367f26dea02e.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_14_11_19_165dacb39a40b35b1e6f44f576b62bd29c.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_16_01_03_530ad81db4e845c3a230e1367f26dea02e.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_16_05_57_17apple.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_17_05_00_5428IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_23_01_00_0128IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_23_11_00_223580c012e016cf99ea35b1d29be773e5.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_23_12_37_2928IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_23_23_48_15_744a36ecd6.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_06_25_11_10_34bg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_07_11_05_05_49PackagesBreadcrumb.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_07_16_01_38_05PackagesBreadcrumb.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_07_16_05_02_51PackagesBreadcrumb.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_07_16_18_56_28_924eeba783.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_07_20_12_14_41bg123.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_07_21_12_46_59bg123.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_07_22_11_09_04bg123.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `gallary/2026_07_24_03_58_52PackagesBreadcrumb.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `interest_received.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `interest_send.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `kundli/2026_05_15_02_21_1528IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_05_15_03_47_5828IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_05_31_06_17_230ad81db4e845c3a230e1367f26dea02e.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_01_11_46_330ad81db4e845c3a230e1367f26dea02e.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_01_12_09_018f27745dfd7c5741e2ad861f6905f850.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_01_12_53_370ad81db4e845c3a230e1367f26dea02e.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_02_02_59_5728IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_02_11_56_5528IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_13_01_41_360ad81db4e845c3a230e1367f26dea02e.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_13_10_05_385dacb39a40b35b1e6f44f576b62bd29c.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_13_10_49_445dacb39a40b35b1e6f44f576b62bd29c.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_13_12_35_130ad81db4e845c3a230e1367f26dea02e.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_14_11_17_09WhatsAppImage2025-12-07at19.18.53_92cb7ee8.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_16_01_01_170ad81db4e845c3a230e1367f26dea02e.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_16_05_34_1130ed3055c78463e4b6991b168db1894f.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_17_04_41_5628IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_23_12_31_2928IJDdWrS_SX0o61u20cMg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_06_25_11_08_01bg.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_07_20_12_11_34bg123.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_07_21_12_44_02bg123.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_07_22_11_01_45bg123.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `kundli/2026_07_24_03_46_56PackagesBreadcrumb.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `membership_choose.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `message.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `message_received.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `message_send.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `my_connected_members.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `my_viewed_contactlist.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `my_viewed_profile.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `photop.php` | deleted: unreferenced scaffold/stub file (H8). Verified: no references in php/js/html/htaccess | none |
| `premium_members.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `profile_ignore.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `sample.php` | deleted: unreferenced scaffold/stub file (H8). Verified: no references in php/js/html/htaccess | none |
| `send_message.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `sessions/sess_99e3ad158b09417040aa4b08085886e8` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `sessions/sess_ae3a90a642f00b98a3b45839e715c77d` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `sessions/sess_ebgnghpmltpia5ehhrif94lb91` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `success/2024_07_14_09_49_54SHITAL.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `success/2024_07_14_10_56_21pavan khade .jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `success/2024_07_14_10_59_38buddhist ingole.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `success/2024_07_14_11_04_56vaishnavi nanded .jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `success/2024_07_14_11_07_12rani 1.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `success/2024_07_14_11_11_29pavan malas .jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `success/2024_07_14_11_17_33shital narwade.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `success/2024_07_14_11_20_07swapnil wakode.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `success/2024_07_14_11_24_04pramod add.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `success/2024_07_14_11_26_10pooja p.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `success/2024_07_22_12_43_22pramod add.jpg` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `uploads/videos/6a06caef942c25.22029384_1778830063.mp4` | UNTRACKED from git only (file remains on disk) - user PII must not be versioned (C9) | file still served from disk |
| `viewed_address.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `who_connected_me.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `who_shortlisted_me.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `who_viewed_addreess_list.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |
| `who_viewed_my_profile.php.bak` | deleted: .bak source-backup copy served as plain text by Apache (H8). Verified: no references anywhere | the live .php equivalent remains |

## 5. Added files

| File | Purpose |
|------|---------|
| `SECURITY_CHANGELOG.md` | NEW: documentation of Phase A |
| `adhar/.htaccess` | NEW: directory hardening (script-exec block / full deny) |
| `config.php` | NEW: secret resolution (env -> config.local.php -> legacy fallback) + svr_db_fail() logging helper |
| `config.sample.local.php` | NEW: template for per-server secrets file |
| `gallary/.htaccess` | NEW: directory hardening (script-exec block / full deny) |
| `includes/security.php` | NEW: shared security helpers (CSRF, throttle, escaping, reset tokens, path validation, guards) |
| `kundli/.htaccess` | NEW: directory hardening (script-exec block / full deny) |
| `sessions/.htaccess` | NEW: directory hardening (script-exec block / full deny) |
| `success/.htaccess` | NEW: directory hardening (script-exec block / full deny) |
| `uploads/.htaccess` | NEW: directory hardening (script-exec block / full deny) |

## 6. Remaining risks

| Level | Risk |
|-------|------|
| Medium | No PHP runtime existed in the validation sandbox. All edits were verified structurally (balance + signature comparison on 389 files) and by manual review, but **php -l + a staging smoke test is REQUIRED before production deploy**. |
| Low | .htaccess uses Apache-2.4 `Require all denied` syntax (standard on LiteSpeed/modern hosts). If any path returns HTTP 500 after deploy, remove the new FilesMatch blocks first (rollback step in section 7). |
| Intended | Old password-reset links (tokenless) stop working - that IS the fix. Users simply request a new link. |
| Intended | Remember-me no longer fills the password field; usernames still prefill. |
| Low | contact_paid_success.php now calls the Razorpay API; if outbound HTTPS from the server is blocked, that legacy (unreferenced) flow fails closed. The live membership flow does not depend on it. |
| Low | CSRF tokens may reject a form rendered before this deploy once per session (one re-submit fixes it). |
| None-today | SVR_CRON_KEY / SVR_API_ADMIN_KEY default to OPEN until ops sets them (backward compatible by design). |
| Deferred | Mobile-API token auth, PHPMailer 6.x, Aadhaar brokered viewer, signup-form CSRF, git-history purge - listed in SECURITY_CHANGELOG.md (Deferred). |

## 7. Manual deployment steps (in order)

1. Check out `arena/019fb6b6-svr` on staging; run `php -l` on every changed file (`git diff --name-only main...HEAD`).
2. Smoke-test on staging: member login, logout, signup + OTP, forgot/reset password (full loop), change password, one search, one photo upload, admin login + one admin action, one Razorpay TEST-mode payment, one API POST from the app.
3. `.htaccess` sanity: request `/webhook.php` (expect 400/405, not 500) and any `.sql` URL (expect 403). If you see HTTP 500 anywhere - remove the two new FilesMatch blocks and report back.
4. Deploy to production.
5. Create `config.local.php` from the sample (or set env vars): SVR_DB_HOST / SVR_DB_NAME / SVR_DB_USER / SVR_DB_PASS, SVR_RZP_KEY_ID, SVR_RZP_KEY_SECRET, SVR_INSTAMOJO_SALT. Verify the site loads, then tell me to strip the in-code fallbacks.
6. Rotate the DB password and Razorpay secret in their dashboards (they were exposed in git history).
7. Optional: set SVR_CRON_KEY (add `?key=` to web cron URLs) and SVR_API_ADMIN_KEY (send X-API-Key from your push tool).
8. Optional: uncomment the HTTPS-redirect block in .htaccess after confirming SSL.

---
*Rollback: revert any of the 19 commits individually (`git revert <sha>`), or `git checkout main` wholesale. No schema changes exist to roll back.*