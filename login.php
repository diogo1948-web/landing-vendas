<?php
// Start session with secure cookie parameters (PHP 7.4-safe)
$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443);
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => $isHttps,
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

// Compute base URL for redirects relative to current directory
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['PHP_SELF'] ?? '/')), '/');
$homeUrl = ($base === '' ? '' : $base) . '/index.php';
$loginUrl = ($base === '' ? '' : $base) . '/login.php';

// If already logged in, go home
if (!empty($_SESSION['logged_in'])) {
    header('Location: ' . $homeUrl);
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $valid = false;
    $file = __DIR__ . '/users.txt';
    if (is_readable($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            // PHP 7.4-safe: check if the line starts with '#'
            if ($line === '' || strncmp($line, '#', 1) === 0) continue;
            $parts = explode(':', $line, 2);
            if (count($parts) !== 2) continue;
            [$u, $p] = $parts;
            $u = trim($u);
            $p = trim($p);
            if (hash_equals($username, $u) && hash_equals($password, $p)) {
                $valid = true;
                break;
            }
        }
    }

    if ($valid) {
        // Prevent session fixation by regenerating the session ID on login
        session_regenerate_id(true);
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        // UX cookie (not used for auth)
        setcookie('mf_session', 'active', [
            'expires' => time() + 60 * 60 * 24 * 7,
            'path' => '/',
            'secure' => $isHttps,
            'httponly' => false,
            'samesite' => 'Lax',
        ]);

        // Use a safe, same-site relative redirect only
        $redirect = $_SESSION['redirect_after_login'] ?? $homeUrl;
        unset($_SESSION['redirect_after_login']);
        if (!is_string($redirect)) { $redirect = $homeUrl; }
        // Disallow header injection and external redirects
        if ($redirect === '' || strpos($redirect, "\n") !== false || strpos($redirect, "\r") !== false) {
            $redirect = $homeUrl;
        }
        if (preg_match('#^[a-z][a-z0-9+\-.]*://#i', $redirect) || strpos($redirect, '//') === 0) {
            $redirect = $homeUrl;
        }
        header('Location: ' . $redirect);
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Men's Force — Login</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
      .auth-wrap { min-height: 100vh; display:flex; align-items:center; justify-content:center; background: #0b0b0b; padding: 2rem; }
      .auth-card { width: 100%; max-width: 420px; background: #111827; border: 1px solid #1f2937; border-radius: 12px; padding: 2rem; color: #e5e7eb; box-shadow: 0 10px 30px rgba(0,0,0,0.4); }
      .brand { text-align:center; margin-bottom: 1.5rem; }
      .brand .mf-line1 { display:block; color:#fff; font-weight:800; letter-spacing:2px; font-size: 1.75rem; }
      .brand .mf-line2 { display:block; color:#dc2626; font-weight:800; letter-spacing:2px; font-size: 1.25rem; margin-top:-4px; font-style: italic; }
      .auth-card h1 { text-align:center; margin: 0 0 0.75rem 0; font-size: 1.5rem; }
      .auth-card p { text-align:center; color:#9ca3af; margin-bottom:1.25rem; }
      .auth-card label { display:block; font-weight:600; margin: 0.75rem 0 0.25rem; }
      .auth-card input { width:100%; padding:0.75rem 0.9rem; background:#0b0f19; color:#e5e7eb; border:1px solid #374151; border-radius:8px; }
      .auth-card .actions { margin-top:1rem; display:flex; justify-content:space-between; align-items:center; }
      .btn-login { background:#dc2626; color:#fff; font-weight:700; border:none; padding:0.8rem 1.1rem; border-radius:8px; cursor:pointer; }
      .error { background:#7f1d1d; color:#fff; padding:0.6rem 0.8rem; border:1px solid #b91c1c; border-radius:8px; margin-bottom:1rem; }
      .hint { color:#9ca3af; font-size:0.85rem; text-align:center; margin-top:0.75rem; }
    </style>
  </head>
  <body>
    <div class="auth-wrap">
      <form class="auth-card" method="post" action="login.php">
        <div class="brand">
          <span class="mf-line1">MEN'S</span>
          <span class="mf-line2">FORCE</span>
        </div>
        <h1>Sign in to access your bonuses</h1>
        <p>Use your provided username and password.</p>
        <?php if (!empty($error)): ?>
          <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" required />
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required />
        <div class="actions">
          <div></div>
          <button class="btn-login" type="submit">Log In</button>
        </div>
      </form>
    </div>
  </body>
</html>
