-- ============================================================================
-- MANPASAND JODIDAR REBRAND — OWNER-RUN DATABASE BRAND PACK (Phase R5)
-- ----------------------------------------------------------------------------
-- PURPOSE: rebrand DB-stored APPLICATION/CONFIG text (site name, footer,
-- CMS page boilerplate, SEO meta). Code never touches these values; this
-- script is OPTIONAL and must be run by the site owner in phpMyAdmin/MySQL.
--
-- SAFETY CONTRACT:
--   * BACK UP FIRST:  mysqldump -u USER -p DBNAME > backup-pre-rebrand.sql
--   * Only config/CMS/SEO tables are touched (siteconfig, cms, seo).
--   * USER-OWNED CONTENT IS EXPLICITLY EXCLUDED: success stories, testimonial
--     quotes, member profile data, agent data. Do not run these REPLACEs on
--     those tables — quoted mentions of the old service name are user voice.
--   * about-us already renders rebranded at runtime (str_ireplace shield in
--     about-us.php), so the cms UPDATE below is a cleanliness step, not a fix.
--   * All statements are plain UPDATE..REPLACE — re-running them is harmless.
--   * Column/table names were taken from the application code
--     (siteconfig: ID, Webname, copyright_footer; cms: link, content;
--      seo: catagory, title, description). If a column errors with
--     "unknown column", simply skip that one UPDATE — the app is unaffected.
-- ----------------------------------------------------------------------------
-- STEP 0 — PREVIEW what will change (run these first, expect small counts):
-- ----------------------------------------------------------------------------

SELECT 'siteconfig.webname' AS where_found, ID, Webname AS current_value
  FROM siteconfig
 WHERE Webname LIKE '%Shivraj%' OR Webname LIKE '%शिवराज%' OR Webname LIKE '%Parampara%';

SELECT 'siteconfig.footer' AS where_found, ID, copyright_footer AS current_value
  FROM siteconfig
 WHERE copyright_footer LIKE '%Shivraj%' OR copyright_footer LIKE '%शिवराज%'
    OR copyright_footer LIKE '%Parampara%';

SELECT 'cms.content' AS where_found, link, LEFT(content, 120) AS current_value
  FROM cms
 WHERE content LIKE '%Shivraj%' OR content LIKE '%शिवराज%' OR content LIKE '%Parampara%'
    OR content LIKE '%LAGNAM%' OR content LIKE '%Lagnam%';

SELECT 'seo.meta' AS where_found, catagory, LEFT(CONCAT_WS(' | ', title, description), 160) AS current_value
  FROM seo
 WHERE title LIKE '%Shivraj%' OR title LIKE '%शिवराज%' OR title LIKE '%Parampara%'
    OR description LIKE '%Shivraj%' OR description LIKE '%शिवराज%' OR description LIKE '%Parampara%';

-- ----------------------------------------------------------------------------
-- STEP 1 — siteconfig (site identity row)
-- ----------------------------------------------------------------------------

UPDATE siteconfig
   SET Webname = REPLACE(REPLACE(REPLACE(Webname,
        'Shivraj Maratha',  'Manpasand Jodidar'),
        'शिवराज मराठा',    'मनपसंद जोडीदार'),
        'Weddings Parampara', 'Manpasand Jodidar')
 WHERE ID = 1;

UPDATE siteconfig
   SET copyright_footer = REPLACE(REPLACE(REPLACE(REPLACE(copyright_footer,
        'Shivraj Maratha',        'Manpasand Jodidar'),
        'शिवराज मराठा',          'मनपसंद जोडीदार'),
        'Weddings Parampara',     'Manpasand Jodidar'),
        'Vadhu Var Suchak Kendra','Manpasand Jodidar')
 WHERE ID = 1;

-- ----------------------------------------------------------------------------
-- STEP 2 — CMS pages (site-authored boilerplate, e.g. link='aboutus')
-- ----------------------------------------------------------------------------

UPDATE cms
   SET content = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(content,
        'LAGNAM by Sanskriti Parampara', 'Manpasand Jodidar'),
        'Sanskriti Parampara',           'Manpasand Jodidar'),
        'Shivraj Maratha',               'Manpasand Jodidar'),
        'शिवराज मराठा',                 'मनपसंद जोडीदार'),
        'Weddings Parampara',            'Manpasand Jodidar'),
        'शुभ विवाह • सुयोग्य जीवनसाथी',  'रिश्ता दिल से, साथ ज़िंदगी भर')
 WHERE 1=1;

-- ----------------------------------------------------------------------------
-- STEP 3 — SEO meta (title/description/keywords columns as applicable)
-- ----------------------------------------------------------------------------

UPDATE seo
   SET title = REPLACE(REPLACE(REPLACE(title,
        'Shivraj Maratha',  'Manpasand Jodidar'),
        'शिवराज मराठा',    'मनपसंद जोडीदार'),
        'Weddings Parampara', 'Manpasand Jodidar');

UPDATE seo
   SET description = REPLACE(REPLACE(REPLACE(description,
        'Shivraj Maratha',  'Manpasand Jodidar'),
        'शिवराज मराठा',    'मनपसंद जोडीदार'),
        'Weddings Parampara', 'Manpasand Jodidar');

-- If a keywords column exists in seo, uncomment:
-- UPDATE seo
--    SET keywords = REPLACE(REPLACE(REPLACE(keywords,
--         'Shivraj Maratha',  'Manpasand Jodidar'),
--         'शिवराज मराठा',    'मनपसंद जोडीदार'),
--         'Weddings Parampara', 'Manpasand Jodidar');

-- ----------------------------------------------------------------------------
-- STEP 4 — VERIFY (expect 0 rows):
-- ----------------------------------------------------------------------------

SELECT ID, Webname, copyright_footer FROM siteconfig WHERE ID = 1;
SELECT link FROM cms
 WHERE content LIKE '%Shivraj%' OR content LIKE '%शिवराज%' OR content LIKE '%Parampara%';
SELECT catagory FROM seo
 WHERE title LIKE '%Shivraj%' OR title LIKE '%शिवराज%'
    OR description LIKE '%Shivraj%' OR description LIKE '%शिवराज%';

-- OWNER DECISIONS STILL OPEN (not handled by this pack):
--   * info@shivrajmaratha.com operations mailbox (17 code references) — decide
--     whether to migrate mailboxes, then update code constants in one change.
--   * SMS gateway/DLT templates ('Welcome To Jaipur ... A unit of Mahadi Group')
--     must be re-registered with the operator under the new brand; only then
--     update asysendotp.php / registrationconfirmation.php strings.
--   * WhatsApp webhook verify token may keep any value; change only with a
--     matching Meta console update.
-- ============================================================================
