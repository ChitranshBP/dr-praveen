<?php
/**
 * CMS Data Loaders — safe readers for /data/*.json written by the /cms admin panel.
 * Every loader degrades gracefully (empty array / null / fallback file) so public
 * pages never fatal if a JSON file is missing or corrupt.
 */

if (!defined('CMS_DATA_DIR')) {
    define('CMS_DATA_DIR', dirname(__DIR__) . '/data');
}

/**
 * Read + decode a JSON file. Returns null when missing/corrupt.
 */
function cms_json_read($file) {
    if (!is_string($file) || !is_file($file)) {
        return null;
    }
    $raw = @file_get_contents($file);
    if ($raw === false || trim($raw) === '') {
        return null;
    }
    $data = json_decode($raw, true);
    return is_array($data) ? $data : null;
}

/**
 * Page content helper (canonical version lives in config.php as get_page_content).
 */

/**
 * All blog posts (any status), newest date first.
 */
function cms_blogs_all() {
    $blogs = cms_json_read(CMS_DATA_DIR . '/blogs.json');
    if (!is_array($blogs)) {
        return [];
    }
    usort($blogs, function ($a, $b) {
        return strcmp((string)($b['date'] ?? ''), (string)($a['date'] ?? ''));
    });
    return $blogs;
}

/**
 * Published blog posts only.
 */
function cms_blogs_published() {
    return array_values(array_filter(cms_blogs_all(), function ($b) {
        return ($b['status'] ?? 'published') === 'published';
    }));
}

/**
 * Find one published post by slug.
 */
function cms_blog_find_by_slug($slug) {
    foreach (cms_blogs_published() as $b) {
        if (($b['slug'] ?? '') === $slug) {
            return $b;
        }
    }
    return null;
}

/**
 * Distinct categories from published posts with counts, sorted by count desc.
 */
function cms_blog_categories() {
    $counts = [];
    foreach (cms_blogs_published() as $b) {
        $cat = trim((string)($b['category'] ?? '')) ?: 'General';
        $counts[$cat] = ($counts[$cat] ?? 0) + 1;
    }
    arsort($counts);
    return $counts;
}

/**
 * Patient testimonials from the CMS.
 * Returns a normalized array, or null when no valid CMS data exists
 * so callers can fall back to their built-in defaults.
 *
 * Normalized keys: name, role, message, rating, condition, video_id, featured, date
 */
function cms_testimonials() {
    $raw = cms_json_read(CMS_DATA_DIR . '/testimonials.json');
    if (!is_array($raw) || empty($raw)) {
        return null;
    }
    $out = [];
    foreach ($raw as $t) {
        if (!is_array($t) || trim((string)($t['name'] ?? '')) === '') {
            continue;
        }
        $message = trim((string)($t['message'] ?? ''));
        if ($message === '') {
            continue;
        }
        $out[] = [
            'name'      => (string)$t['name'],
            'role'      => trim((string)($t['role'] ?? '')) ?: 'Patient',
            'message'   => $message,
            'rating'    => max(1, min(5, (int)($t['rating'] ?? 5))),
            'condition' => trim((string)($t['condition'] ?? '')),
            'video_id'  => trim((string)($t['video_id'] ?? '')),
            'featured'  => !empty($t['featured']),
            'date'      => (string)($t['date'] ?? ''),
        ];
    }
    return empty($out) ? null : $out;
}

/**
 * Video testimonials from the CMS (entries that carry a YouTube video id).
 * Returns null when none exist so callers can fall back.
 */
function cms_video_testimonials() {
    $all = cms_testimonials();
    if ($all === null) {
        return null;
    }
    $videos = array_values(array_filter($all, function ($t) {
        return $t['video_id'] !== '';
    }));
    return empty($videos) ? null : $videos;
}

/**
 * Doctor profiles. Prefers the CMS-managed data/doctors.json and falls back to
 * the original static export (assets/doctors_full.json).
 */
function cms_doctors() {
    $doctors = cms_json_read(CMS_DATA_DIR . '/doctors.json');
    if (is_array($doctors) && !empty($doctors)) {
        return $doctors;
    }
    $fallback = cms_json_read(dirname(__DIR__) . '/assets/doctors_full.json');
    return is_array($fallback) ? $fallback : [];
}

/**
 * Landing page (/LP) settings. Returns [] when not customized.
 */
function cms_lp_settings() {
    $lp = cms_json_read(CMS_DATA_DIR . '/lp.json');
    return is_array($lp) ? $lp : [];
}
