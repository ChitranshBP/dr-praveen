<?php
/**
 * CMS Helper Utilities
 */

require_once __DIR__ . '/db.php';

// Flash Messages
function cms_set_flash($type, $message) {
    $_SESSION['cms_flash'] = [
        'type' => $type, // success, error, info, warning
        'message' => $message
    ];
}

function cms_get_flash() {
    if (isset($_SESSION['cms_flash'])) {
        $flash = $_SESSION['cms_flash'];
        unset($_SESSION['cms_flash']);
        return $flash;
    }
    return null;
}

// File Upload Helper with WebP optimization
function cms_handle_upload($fileKey, $subfolder = '') {
    if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $file = $_FILES[$fileKey];
    $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'application/pdf'];
    $extAllowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'pdf'];

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $extAllowed)) {
        return ['error' => 'Invalid file extension: ' . $ext];
    }

    $targetDir = UPLOADS_DIR . ($subfolder ? '/' . trim($subfolder, '/') : '');
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $filename = uniqid('up_') . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
    $targetPath = $targetDir . '/' . $filename;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $relPath = 'assets/uploads/' . ($subfolder ? trim($subfolder, '/') . '/' : '') . $filename;
        return ['path' => $relPath];
    }

    return ['error' => 'Failed to save uploaded file.'];
}

// Text Helpers
function cms_slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return strtolower($text);
}
