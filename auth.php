<?php
// Simple session-based auth gate with hardened session cookies
// Configure session cookie params before starting the session (PHP 7.4-safe)
$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443);
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => $isHttps,
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

// If user is not logged in, redirect to login page (relative to current dir)
if (empty($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Persist intended URL for post-login redirect (relative path preferred)
    $self = $_SERVER['PHP_SELF'] ?? 'index.php';
    $req  = $_SERVER['REQUEST_URI'] ?? $self;
    $_SESSION['redirect_after_login'] = $req;

    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['PHP_SELF'] ?? '/')), '/');
    $loginUrl = ($base === '' ? '' : $base) . '/login.php';
    header('Location: ' . $loginUrl);
    exit;
}

// Refresh a lightweight cookie for UX (not used for auth)
setcookie('mf_session', 'active', [
    'expires' => time() + 60 * 60 * 24 * 7,
    'path' => '/',
    'secure' => $isHttps,
    'httponly' => false,
    'samesite' => 'Lax',
]);
?>
