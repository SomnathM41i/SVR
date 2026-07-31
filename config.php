<?php
/**
 * config.php — Centralized runtime configuration and secret resolution.
 *
 * Secrets are resolved in this order:
 *   1. Environment variable       (preferred for production; set in the web server / FPM pool config)
 *   2. config.local.php           (per-server override file, git-ignored — see config.sample.local.php)
 *   3. Legacy fallback default    (kept ONLY for backward compatibility during the transition;
 *                                  remove the fallback values once env vars are configured on the server)
 *
 * Reason for change: production credentials were hard-coded in source (critical finding C1).
 * This file centralizes them so they can be moved out of version control without breaking production.
 */
/**
 * svr_db_fail() — safe uniform failure for DB errors.
 * Logs the real error server-side and emits a generic message, replacing the
 * legacy `or svr_db_fail($con)` pattern that disclosed SQL errors to users
 * (finding H7). Only invoked on query failure paths.
 */
if (!function_exists('svr_db_fail')) {
    function svr_db_fail($con = null) {
        $err = ($con instanceof mysqli) ? mysqli_error($con) : 'database error';
        error_log('SVR DB failure: ' . $err . ' in ' . (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : 'cli'));
        if (!headers_sent()) {
            http_response_code(500);
        }
        exit('A database error occurred. Please try again later.');
    }
}

if (!function_exists('svr_config')) {
    function svr_config($key, $default = null) {
        static $local = null;
        $env = getenv($key);
        if ($env !== false && $env !== '') {
            return $env;
        }
        if ($local === null) {
            $local = array();
            $localFile = __DIR__ . DIRECTORY_SEPARATOR . 'config.local.php';
            if (is_file($localFile)) {
                $loaded = include $localFile;
                if (is_array($loaded)) {
                    $local = $loaded;
                }
            }
        }
        if (isset($local[$key]) && $local[$key] !== '') {
            return $local[$key];
        }
        return $default;
    }
}
