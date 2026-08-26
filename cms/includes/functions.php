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
    $extAllowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'pdf'];

    // Size cap: 8 MB
    if (($file['size'] ?? 0) > 8 * 1024 * 1024) {
        return ['error' => 'File is too large (max 8 MB).'];
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $extAllowed, true)) {
        return ['error' => 'Invalid file extension: ' . $ext];
    }

    // Server-side MIME validation (extension alone can be spoofed)
    $mimeToExt = [
        'image/jpeg'      => ['jpg', 'jpeg'],
        'image/png'       => ['png'],
        'image/webp'      => ['webp'],
        'image/gif'       => ['gif'],
        'application/pdf' => ['pdf'],
    ];
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = $finfo ? finfo_file($finfo, $file['tmp_name']) : '';
        if ($finfo) {
            finfo_close($finfo);
        }
        $okMime = false;
        foreach ($mimeToExt as $mimeAllowed => $exts) {
            if ($mime === $mimeAllowed && in_array($ext, $exts, true)) {
                $okMime = true;
                break;
            }
        }
        if (!$okMime) {
            return ['error' => 'File content does not match its extension.'];
        }
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
