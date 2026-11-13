<?php
/**
 * Logout — POST only (with the CSRF token), so a crafted link or image tag
 * cannot log the editor out.
 */
require_once __DIR__ . '/includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}
cms_verify_csrf();
cms_logout();
header('Location: login.php');
exit;
