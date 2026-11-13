<?php
/**
 * Generic template for pages created in the CMS (CMS → All Pages → New page).
 *
 * /some-slug is rewritten here by .htaccess when no some-slug.php exists.
 * The slug must be a CMS-created entry in data/pages_catalog.json; anything
 * else is a 404. Banner copy comes from data/pages/{slug}.json and every
 * section from the page's block flow.
 */
$slug = preg_replace('/[^a-z0-9-]/', '', strtolower((string)($_GET['slug'] ?? '')));

require_once __DIR__ . '/includes/cms-load.php';
$catalogEntry = null;
foreach ((array)cms_json_read(CMS_DATA_DIR . '/pages_catalog.json') as $entry) {
    if (is_array($entry) && ($entry['slug'] ?? '') === $slug && ($entry['file'] ?? '') === 'page.php') {
        $catalogEntry = $entry;
        break;
    }
}
if ($slug === '' || $catalogEntry === null) {
    require __DIR__ . '/404.php';
    exit;
}

$currentPage = $slug;
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero($slug, [
    'hero_badge' => '',
    'hero_title' => (string)($catalogEntry['title'] ?? ''),
    'hero_desc'  => '',
    'hero_bg'    => '',
], ['style' => 'photo', 'icon' => 'fa-file-medical', 'badge_border' => true]);

cms_render_page_flow($slug);

require_once __DIR__ . '/includes/footer.php';
