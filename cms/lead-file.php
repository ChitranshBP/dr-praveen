<?php
/**
 * Authenticated download of a patient report attached to a lead.
 * Files live in data/lead-uploads/ (blocked from direct web access).
 */
require_once __DIR__ . '/includes/auth.php';
cms_require_auth();

$name = basename((string)($_GET['f'] ?? ''));
if ($name === '' || !preg_match('/^[a-zA-Z0-9._-]+$/', $name)) {
    http_response_code(400);
    exit('Invalid file');
}
$path = DATA_DIR . '/lead-uploads/' . $name;
if (!is_file($path)) {
    http_response_code(404);
    exit('File not found');
}
$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
$types = ['pdf' => 'application/pdf', 'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'doc' => 'application/msword', 'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
header('Content-Type: ' . ($types[$ext] ?? 'application/octet-stream'));
header('Content-Length: ' . filesize($path));
header('Content-Disposition: attachment; filename="' . $name . '"');
header('X-Content-Type-Options: nosniff');
readfile($path);
