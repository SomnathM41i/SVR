<?php
/**
 * includes/bootstrap.php — single include-point for first-party pages.
 *
 * Replaces the scattered `require_once('sys_dbconnection.php')` /
 * `require_once('../sys_dbconnection.php')` lines with one context-independent
 * bootstrap that pulls, in order and idempotently (require_once everywhere):
 *
 *   1. config.php            — svr_config() env resolution + svr_db_fail()
 *   2. sys_dbconnection.php  — session bootstrap (hardened cookie params) + $con + $db
 *   3. includes/security.php — shared svr_* helper library (definitions only)
 *   4. includes/branding.php — Manpasand Jodidar brand constants (definitions only)
 *
 * Behavior note: pages that previously included only sys_dbconnection.php gain
 * nothing but the security helper definitions (that file performs no extra
 * side effects beyond what sys_dbconnection.php already does), so this swap is
 * side-effect equivalent everywhere.
 */

require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php');
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'sys_dbconnection.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'security.php');
// Definitions-only brand constants (no output, no DB, no session side effects):
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'branding.php');
