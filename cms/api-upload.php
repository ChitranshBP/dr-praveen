<?php
/**
 * CMS AJAX Image Upload Endpoint
 * Handles image uploads from Quill WYSIWYG editor
 */
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/json');

if (!cms_is_logged_in()) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$upload = cms_handle_upload('image', 'editor');
if (!$upload) {
    echo json_encode(['error' => 'No image file provided or upload error.']);
    exit;
}

if (isset($upload['error'])) {
    echo json_encode(['error' => $upload['error']]);
    exit;
}

// Return uploaded image URL
$url = '/' . ltrim($upload['path'], '/');
echo json_encode([
    'success' => true,
    'url' => $url,
    'path' => $upload['path']
]);
