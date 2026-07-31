<?php
/**
 * console/protect.php — Admin authorization guard.
 *
 * Include at the top of every admin page. Hardened during the security phase:
 * - starts the session when needed (previously assumed it already existed),
 * - terminates execution after the redirect (previously the protected page
 *   kept rendering even after the Location header was sent),
 * - returns HTTP 401 for AJAX/JSON callers instead of an HTML redirect.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin_id'])) {
    $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    $acceptsJson = (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);
    if ($isAjax || $acceptsJson) {
        if (!headers_sent()) {
            http_response_code(401);
            header('Content-Type: application/json');
        }
        exit(json_encode(array('status' => 'error', 'message' => 'Unauthorized')));
    }
    if (!headers_sent()) {
        header('Location: login');
    }
    exit('Unauthorized');
}
