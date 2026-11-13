<?php
/**
 * Media library JSON API (session + CSRF protected).
 *
 *  GET  ?action=list&folder=<key>&q=<search>&page=<n>   → {folders, items, total, page, pages}
 *  POST action=upload, folder=<uploads subfolder>, file   → {success, item}
 *  POST action=delete, path=<site-relative path>          → {success} | {error}
 */
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/media.php';

header('Content-Type: application/json; charset=utf-8');

if (!cms_is_logged_in()) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$action = $_GET['action'] ?? $_POST['action'] ?? 'list';

if ($action === 'list') {
    $roots = cms_media_roots();
    $folder = (string)($_GET['folder'] ?? '');
    $q = strtolower(trim((string)($_GET['q'] ?? '')));
    $page = max(1, (int)($_GET['page'] ?? 1));
    $per = 60;

    $items = [];
    if ($folder !== '' && isset($roots[$folder])) {
        $items = cms_media_scan($folder);
    } else {
        foreach (array_keys($roots) as $k) {
            foreach (cms_media_scan($k) as $row) $items[] = $row;
        }
        usort($items, function ($a, $b) { return $b['mtime'] <=> $a['mtime']; });
    }
    if ($q !== '') {
        $items = array_values(array_filter($items, function ($r) use ($q) {
            return strpos(strtolower($r['path']), $q) !== false;
        }));
    }
    $total = count($items);
    $pages = max(1, (int)ceil($total / $per));
    $slice = array_slice($items, ($page - 1) * $per, $per);
    $withUsage = !empty($_GET['usage']);
    foreach ($slice as &$row) {
        $row['url'] = '../' . $row['path'];
        if ($withUsage) {
            $row['uses'] = cms_media_usage_count($row['path']);
            [$row['w'], $row['h']] = cms_media_dimensions($row['path']);
        }
    }
    unset($row);
    $folderList = [];
    foreach ($roots as $k => $r) {
        $folderList[] = ['key' => $k, 'label' => $r['label'], 'writable' => !empty($r['writable'])];
    }
    echo json_encode(['folders' => $folderList, 'items' => $slice, 'total' => $total, 'page' => $page, 'pages' => $pages]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}
$token = $_POST['csrf_token'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
if (empty($token) || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
    http_response_code(403);
    echo json_encode(['error' => 'Security token expired. Please reload the page.']);
    exit;
}

if ($action === 'upload') {
    $folder = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)($_POST['folder'] ?? 'library'));
    if ($folder === '' || $folder === 'leads') $folder = 'library';
    $up = cms_handle_upload('file', $folder);
    if (!is_array($up)) {
        echo json_encode(['error' => 'No file received.']);
        exit;
    }
    if (isset($up['error'])) {
        echo json_encode(['error' => $up['error']]);
        exit;
    }
    $abs = dirname(CMS_ROOT) . '/' . $up['path'];
    echo json_encode(['success' => true, 'item' => [
        'path' => $up['path'],
        'url' => '../' . $up['path'],
        'name' => basename($up['path']),
        'size' => is_file($abs) ? filesize($abs) : 0,
        'folder' => 'uploads/' . $folder,
        'writable' => true,
    ]]);
    exit;
}

if ($action === 'delete') {
    $err = cms_media_delete((string)($_POST['path'] ?? ''));
    echo json_encode($err === '' ? ['success' => true] : ['error' => $err]);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Unknown action']);
