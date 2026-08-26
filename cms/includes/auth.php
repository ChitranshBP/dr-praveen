<?php
/**
 * CMS Authentication & Security Middleware
 */

if (session_status() === PHP_SESSION_NONE) {
    // Configure secure session cookie
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_samesite', 'Lax');
    if ((
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (int)($_SERVER['SERVER_PORT'] ?? 0) === 443
    )) {
        ini_set('session.cookie_secure', 1);
    }
    session_start();
}

require_once __DIR__ . '/db.php';

// Auth Helper Functions
function cms_is_logged_in() {
    return isset($_SESSION['cms_user']) && !empty($_SESSION['cms_user']['id']);
}

function cms_current_user() {
    return $_SESSION['cms_user'] ?? null;
}

function cms_require_auth() {
    if (!cms_is_logged_in()) {
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
        exit;
    }
}

// CSRF Token Protection
function cms_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function cms_csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(cms_csrf_token()) . '">';
}

function cms_verify_csrf() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        if (empty($token) || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            http_response_code(403);
            die('CSRF validation failed. Please refresh the page and try again.');
        }
    }
}

// ---- Brute-force protection (per browser session) ---------------------------
define('CMS_MAX_LOGIN_ATTEMPTS', 5);
define('CMS_LOCKOUT_SECONDS', 300);

function cms_login_locked_remaining() {
    $lockedUntil = $_SESSION['login_locked_until'] ?? 0;
    return max(0, (int)$lockedUntil - time());
}

function cms_login_record_failure() {
    $_SESSION['login_failures'] = ($_SESSION['login_failures'] ?? 0) + 1;
    if ($_SESSION['login_failures'] >= CMS_MAX_LOGIN_ATTEMPTS) {
        $_SESSION['login_locked_until'] = time() + CMS_LOCKOUT_SECONDS;
        $_SESSION['login_failures'] = 0;
    }
    // Slow down online guessing a little
    usleep(random_int(150000, 400000));
}

function cms_login_clear_failures() {
    unset($_SESSION['login_failures'], $_SESSION['login_locked_until']);
}

// Login verification
function cms_login($username, $password) {
    $remaining = cms_login_locked_remaining();
    if ($remaining > 0) {
        return ['success' => false, 'error' => 'Too many failed attempts. Try again in ' . ceil($remaining / 60) . ' minute(s).'];
    }

    $users = CMS_DB::get('users', []);
    foreach ($users as &$u) {
        if (strtolower($u['username']) === strtolower(trim($username))) {
            if (password_verify($password, $u['password'])) {
                // Prevent session fixation
                session_regenerate_id(true);

                // Update last login
                $u['last_login'] = date('Y-m-d H:i:s');
                CMS_DB::set('users', $users);

                // Set session
                $_SESSION['cms_user'] = [
                    'id' => $u['id'],
                    'username' => $u['username'],
                    'name' => $u['name'],
                    'email' => $u['email'],
                    'role' => $u['role']
                ];
                cms_login_clear_failures();
                return ['success' => true];
            }

            cms_login_record_failure();
            $remaining = cms_login_locked_remaining();
            if ($remaining > 0) {
                return ['success' => false, 'error' => 'Too many failed attempts. Locked for ' . ceil($remaining / 60) . ' minute(s).'];
            }
            return ['success' => false, 'error' => 'Incorrect password.'];
        }
    }
    cms_login_record_failure();
    return ['success' => false, 'error' => 'User not found.'];
}

// Logout
function cms_logout() {
    $_SESSION['cms_user'] = null;
    unset($_SESSION['cms_user']);
    session_destroy();
}
