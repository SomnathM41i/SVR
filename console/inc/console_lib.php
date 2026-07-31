<?php
/**
 * console/inc/console_lib.php — small shared helpers for console handlers.
 *
 * Extracted during architecture refactoring (Phase B). Each helper reproduces,
 * statement for statement, a code block that previously lived inline in many
 * console pages, so future hardening/maintenance happens in exactly one place.
 * No behavior change: the SQL string produced is byte-identical to the inline
 * versions it replaces.
 */

/**
 * Save CMS page content (used by the add_* CMS-page handlers).
 * Reproduces the legacy inline block per cms_id:
 *   $content = $db->setfilter($_POST["Message"]);
 *   $upd_about = "update cms set content = '$content' where cms_id='<id>'";
 *   mysqli_query($con, $upd_about);
 */
function svr_console_cms_save_content($con, $db, $cmsId) {
    $content = $db->setfilter($_POST["Message"]);
    $upd_about = "update cms set content = '$content' where cms_id='" . $cmsId . "'";
    mysqli_query($con, $upd_about);
}
