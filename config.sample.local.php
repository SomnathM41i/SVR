<?php
/**
 * config.sample.local.php — Template for config.local.php (per-server secrets).
 *
 * Copy this file to "config.local.php" on the server and fill in real values.
 * config.local.php is git-ignored and must never be committed.
 * Alternatively, define the same names as environment variables and skip this file.
 */
return array(
    'SVR_DB_HOST'          => 'your-db-host',
    'SVR_DB_NAME'          => 'your-db-name',
    'SVR_DB_USER'          => 'your-db-user',
    'SVR_DB_PASS'          => 'your-db-password',
    'SVR_RZP_KEY_ID'       => 'your-razorpay-key-id',
    'SVR_RZP_KEY_SECRET'   => 'your-razorpay-key-secret',
    'SVR_INSTAMOJO_SALT'   => 'your-instamojo-salt',
    'SVR_CRON_KEY'         => '', // set a long random string to protect cron URLs; empty = legacy open access
);
