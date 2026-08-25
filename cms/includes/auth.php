<?php
/**
 * CMS Authentication & Security Middleware
 */

if (session_status() === PHP_SESSION_NONE) {
    // Configure secure session cookie
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
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

// Login verification
function cms_login($username, $password) {
    $users = CMS_DB::get('users', []);
    foreach ($users as &$u) {
        if (strtolower($u['username']) === strtolower(trim($username))) {
            if (password_verify($password, $u['password'])) {
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
                return ['success' => true];
            }
            return ['success' => false, 'error' => 'Incorrect password.'];
        }
    }
    return ['success' => false, 'error' => 'User not found.'];
}

// Logout
function cms_logout() {
    $_SESSION['cms_user'] = null;
    unset($_SESSION['cms_user']);
    session_destroy();
}
