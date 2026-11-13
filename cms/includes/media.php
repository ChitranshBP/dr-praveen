<?php
/**
 * Media library helpers (used by cms/media.php and cms/api-media.php).
 *
 * Browsable roots: everything under assets/uploads (writable: upload/delete)
 * plus the legacy image folders shipped with the site (read-only).
 */

require_once __DIR__ . '/db.php';

if (!function_exists('cms_media_roots')) {
    function cms_media_roots() {
        $site = dirname(CMS_ROOT);
        $roots = [];
        $uploads = $site . '/assets/uploads';
        if (is_dir($uploads)) {
            foreach (scandir($uploads) as $d) {
                if ($d[0] === '.' || !is_dir($uploads . '/' . $d) || $d === 'leads') continue;
                $roots['uploads/' . $d] = ['label' => 'Uploads / ' . $d, 'path' => 'assets/uploads/' . $d, 'writable' => true];
            }
        }
        foreach (['awards', 'banner', 'mobile-banner', 'breadcrumbs', 'full-image', 'ggn-nuro-images', 'logo', 'media', 'services', 'webp', 'favicon'] as $d) {
            if (is_dir($site . '/assets/' . $d)) {
                $roots[$d] = ['label' => 'Site images / ' . $d, 'path' => 'assets/' . $d, 'writable' => false];
            }
        }
        // Loose files directly under assets/
        $roots['_root'] = ['label' => 'Site images / (root)', 'path' => 'assets', 'writable' => false, 'shallow' => true];
        return $roots;
    }
}

if (!function_exists('cms_media_is_image')) {
    function cms_media_is_image($file) {
        return (bool)preg_match('/\.(png|jpe?g|webp|gif|svg|ico)$/i', $file);
    }
}

if (!function_exists('cms_media_scan')) {
    /**
     * List image files under one root (recursive unless 'shallow').
     * Returns rows: path (site-relative), name, size, mtime, folder key.
     */
    function cms_media_scan($rootKey) {
        $roots = cms_media_roots();
        if (!isset($roots[$rootKey])) return [];
        $root = $roots[$rootKey];
        $site = dirname(CMS_ROOT);
        $abs = $site . '/' . $root['path'];
        if (!is_dir($abs)) return [];
        $out = [];
        $walk = function ($dir, $rel) use (&$walk, &$out, $root, $rootKey) {
            foreach (scandir($dir) as $f) {
                if ($f[0] === '.') continue;
                $p = $dir . '/' . $f;
                if (is_dir($p)) {
                    if (empty($root['shallow'])) $walk($p, $rel . '/' . $f);
                    continue;
                }
                if (!cms_media_is_image($f)) continue;
                $out[] = [
                    'path' => $root['path'] . $rel . '/' . $f,
                    'name' => $f,
                    'size' => filesize($p),
                    'mtime' => filemtime($p),
                    'folder' => $rootKey,
                    'writable' => !empty($root['writable']),
                ];
            }
        };
        $walk($abs, '');
        usort($out, function ($a, $b) { return $b['mtime'] <=> $a['mtime']; });
        return $out;
    }
}

if (!function_exists('cms_media_reference_blob')) {
    /**
     * All CMS JSON + public PHP templates concatenated, so a path can be
     * checked for references with a plain substring search.
     */
    function cms_media_reference_blob() {
        static $blob = null;
        if ($blob !== null) return $blob;
        $site = dirname(CMS_ROOT);
        $blob = '';
        $files = array_merge(
            glob(DATA_DIR . '/*.json') ?: [],
            glob(DATA_DIR . '/pages/*.json') ?: [],
            glob(DATA_DIR . '/collections/*.json') ?: [],
            glob($site . '/*.php') ?: [],
            glob($site . '/includes/*.php') ?: []
        );
        foreach ($files as $f) {
            $c = @file_get_contents($f);
            if ($c !== false) $blob .= "\n" . str_replace('\\/', '/', $c);
        }
        return $blob;
    }
}

if (!function_exists('cms_media_usage_count')) {
    function cms_media_usage_count($path) {
        $blob = cms_media_reference_blob();
        $needle = ltrim((string)$path, '/');
        return substr_count($blob, $needle);
    }
}

if (!function_exists('cms_media_delete')) {
    /**
     * Delete an uploaded file (only under assets/uploads, only when unused).
     * @return string '' on success, else an error message
     */
    function cms_media_delete($path) {
        $path = ltrim(str_replace(['..', "\0"], '', (string)$path), '/');
        if (strpos($path, 'assets/uploads/') !== 0) {
            return 'Only files in the Uploads folders can be deleted. Built-in site images are protected.';
        }
        $abs = dirname(CMS_ROOT) . '/' . $path;
        if (!is_file($abs)) return 'File not found.';
        $uses = cms_media_usage_count($path);
        if ($uses > 0) {
            return 'This image is still used in ' . $uses . ' place(s). Replace it there first.';
        }
        if (!@unlink($abs)) return 'Could not delete the file (permissions).';
        // Remove a generated .webp sibling as well.
        $webp = preg_replace('/\.(png|jpe?g)$/i', '.webp', $abs);
        if ($webp !== $abs && is_file($webp)) @unlink($webp);
        return '';
    }
}

if (!function_exists('cms_media_dimensions')) {
    function cms_media_dimensions($path) {
        $abs = dirname(CMS_ROOT) . '/' . ltrim($path, '/');
        if (!is_file($abs) || preg_match('/\.(svg|ico)$/i', $abs)) return [0, 0];
        $i = @getimagesize($abs);
        return $i ? [(int)$i[0], (int)$i[1]] : [0, 0];
    }
}
