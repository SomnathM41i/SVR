<?php
/**
 * includes/security.php — Shared security helpers (PHP 7.x compatible, no dependencies).
 *
 * Added during the security remediation phase. All functions are prefixed svr_
 * and guarded with function_exists() so this file can be included safely from
 * root pages, console/ and apis/ without collisions.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php');

/* ---------------------------------------------------------------------------
 * Output escaping
 * ------------------------------------------------------------------------- */
if (!function_exists('svr_e')) {
    /** Escape a value for safe HTML output (XSS prevention). */
    function svr_e($value) {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

/* ---------------------------------------------------------------------------
 * CSRF protection (per-session token; stable for the session so multi-tab
 * forms keep working; the token is session-bound so it cannot be forged
 * cross-site).
 * ------------------------------------------------------------------------- */
if (!function_exists('svr_csrf_token')) {
    function svr_csrf_token() {
        if (empty($_SESSION['svr_csrf'])) {
            $_SESSION['svr_csrf'] = bin2hex(svr_random_bytes(32));
        }
        return $_SESSION['svr_csrf'];
    }
}
if (!function_exists('svr_csrf_field')) {
    /** Hidden input to drop into forms. */
    function svr_csrf_field() {
        return '<input type="hidden" name="svr_csrf" value="' . svr_csrf_token() . '">';
    }
}
if (!function_exists('svr_csrf_verify')) {
    /** True when the submitted token matches the session token. */
    function svr_csrf_verify($token) {
        $sessionToken = isset($_SESSION['svr_csrf']) ? $_SESSION['svr_csrf'] : '';
        if ($sessionToken === '' || !is_string($token) || $token === '') {
            return false;
        }
        return hash_equals($sessionToken, $token);
    }
}

/* ---------------------------------------------------------------------------
 * Secure random helpers
 * ------------------------------------------------------------------------- */
if (!function_exists('svr_random_bytes')) {
    function svr_random_bytes($length) {
        if (function_exists('random_bytes')) {
            return random_bytes($length);
        }
        if (function_exists('openssl_random_pseudo_bytes')) {
            return openssl_random_pseudo_bytes($length);
        }
        // Last-resort fallback (PHP < 7 without openssl); never used on supported stacks.
        $bytes = '';
        for ($i = 0; $i < $length; $i++) {
            $bytes .= chr(mt_rand(0, 255));
        }
        return $bytes;
    }
}

/* ---------------------------------------------------------------------------
 * Rate limiting (file-based, works without any schema change).
 * Stores counters in the system temp dir as sha1-hashed bucket files.
 * ------------------------------------------------------------------------- */
if (!function_exists('svr_throttle')) {
    /**
     * Returns true if the action is allowed (and records the hit),
     * false when $max hits were already reached inside $windowSeconds.
     *
     * @param string $bucket        logical bucket, e.g. 'login:'.$username.':'.ip
     * @param int    $max           max hits allowed inside the window
     * @param int    $windowSeconds sliding window length
     */
    function svr_throttle($bucket, $max = 5, $windowSeconds = 600) {
        $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'svr_throttle';
        if (!is_dir($dir)) {
            @mkdir($dir, 0700, true);
        }
        $file = $dir . DIRECTORY_SEPARATOR . sha1($bucket) . '.json';
        $now = time();
        $data = array('start' => $now, 'count' => 0);
        $fh = @fopen($file, 'c+');
        if ($fh) {
            flock($fh, LOCK_EX);
            $raw = stream_get_contents($fh);
            if ($raw) {
                $decoded = json_decode($raw, true);
                if (is_array($decoded) && isset($decoded['start'], $decoded['count'])) {
                    $data = $decoded;
                }
            }
            if (($now - (int)$data['start']) >= $windowSeconds) {
                $data = array('start' => $now, 'count' => 0); // window expired
            }
            $allowed = ($data['count'] < $max);
            if ($allowed) {
                $data['count']++;
            }
            ftruncate($fh, 0);
            rewind($fh);
            fwrite($fh, json_encode($data));
            fflush($fh);
            flock($fh, LOCK_UN);
            fclose($fh);
            return $allowed;
        }
        // If the throttle store is unavailable, fail open for availability
        // but log it so ops can fix temp-dir permissions.
        error_log('svr_throttle: store unavailable for bucket ' . $bucket);
        return true;
    }
}
if (!function_exists('svr_throttle_reset')) {
    function svr_throttle_reset($bucket) {
        $file = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'svr_throttle' . DIRECTORY_SEPARATOR . sha1($bucket) . '.json';
        if (is_file($file)) {
            @unlink($file);
        }
    }
}
if (!function_exists('svr_client_ip')) {
    function svr_client_ip() {
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'cli';
    }
}

/* ---------------------------------------------------------------------------
 * Secure cookie helper (HttpOnly + SameSite=Lax, Secure when on HTTPS)
 * ------------------------------------------------------------------------- */
if (!function_exists('svr_set_cookie')) {
    function svr_set_cookie($name, $value, $expires = 0, $path = '/') {
        $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
        if (PHP_VERSION_ID >= 70300) {
            return setcookie($name, $value, array(
                'expires'  => $expires,
                'path'     => $path,
                'secure'   => $secure,
                'httponly' => true,
                'samesite' => 'Lax',
            ));
        }
        // PHP < 7.3 has no native SameSite support; use the path hack.
        return setcookie($name, $value, $expires, $path . '; samesite=Lax', '', $secure, true);
    }
}

/* ---------------------------------------------------------------------------
 * Password-reset tokens — no schema change required.
 * Token = base64url( MatriID | expiry | HMAC( MatriID|expiry|currentStoredPassword, appSecret ) )
 * - Single use: the token is bound to the CURRENT stored password, so it is
 *   invalidated automatically once the password is changed.
 * - Expiring: the expiry timestamp is inside the signed payload.
 * NOTE: this does not change the existing password storage mechanism.
 * ------------------------------------------------------------------------- */
if (!function_exists('svr_app_secret')) {
    function svr_app_secret() {
        // Prefer a dedicated env secret; fall back to the DB password (already
        // server-side secret material) so no new config is required to deploy.
        return svr_config('SVR_APP_SECRET', svr_config('SVR_DB_PASS', 'svr-fallback-secret'));
    }
}
if (!function_exists('svr_reset_token_make')) {
    function svr_reset_token_make($matriId, $storedPassword, $ttlSeconds = 3600) {
        $expiry = time() + $ttlSeconds;
        $payload = $matriId . '|' . $expiry;
        $sig = hash_hmac('sha256', $payload . '|' . (string)$storedPassword, svr_app_secret());
        return rtrim(strtr(base64_encode($payload . '|' . $sig), '+/', '-_'), '=');
    }
}
if (!function_exists('svr_reset_token_verify')) {
    function svr_reset_token_verify($token, $matriId, $storedPassword) {
        $decoded = base64_decode(strtr((string)$token, '-_', '+/'));
        if (!$decoded) {
            return false;
        }
        $parts = explode('|', $decoded);
        if (count($parts) !== 3) {
            return false;
        }
        list($id, $expiry, $sig) = $parts;
        if ($id !== (string)$matriId || (int)$expiry < time()) {
            return false;
        }
        $expected = hash_hmac('sha256', $id . '|' . $expiry . '|' . (string)$storedPassword, svr_app_secret());
        return hash_equals($expected, $sig);
    }
}

/* ---------------------------------------------------------------------------
 * Cron endpoint guard.
 * - CLI usage (crontab: php cronfile.php) is always allowed.
 * - If SVR_CRON_KEY is configured, web hits must pass ?key=<value>.
 * - If not configured, legacy open access is preserved (documented; set the
 *   key on the server to close the endpoint).
 * ------------------------------------------------------------------------- */
if (!function_exists('svr_cron_guard')) {
    function svr_cron_guard() {
        if (PHP_SAPI === 'cli') {
            return;
        }
        $key = svr_config('SVR_CRON_KEY', '');
        if ($key === '') {
            return; // legacy behavior until ops configures SVR_CRON_KEY
        }
        $provided = isset($_REQUEST['key']) ? (string)$_REQUEST['key'] : '';
        if (!hash_equals($key, $provided)) {
            http_response_code(403);
            exit('Forbidden');
        }
    }
}
