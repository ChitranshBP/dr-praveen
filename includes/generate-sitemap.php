<?php
/**
 * XML Sitemap Generator - Dr. Praveen Gupta
 * Builds sitemap.xml from the CMS page catalog (data/pages_catalog.json) plus
 * every published blog post. Pages marked "noindex" in CMS → All Pages are
 * left out. Regenerated automatically when a page or blog post is saved.
 */

if (!defined('SITE_URL')) {
    $settingsFile = dirname(__DIR__) . '/data/settings.json';
    $siteSettings = is_file($settingsFile) ? (json_decode((string)file_get_contents($settingsFile), true) ?: []) : [];
    define('SITE_URL', trim((string)($siteSettings['site_url'] ?? '')) !== '' ? $siteSettings['site_url'] : 'https://drpraveengupta.com');
}

function generate_sitemap_xml() {
    $rootDir = dirname(__DIR__);
    $dataDir = $rootDir . '/data';
    $sitemapFile = $rootDir . '/sitemap.xml';

    $baseUrl = rtrim(SITE_URL, '/');
    $today = date('Y-m-d');

    // Category → default priority / change frequency
    $categoryDefaults = [
        'Services'       => ['0.9', 'monthly'],
        'Conditions'     => ['0.9', 'weekly'],
        'About Doctor'   => ['0.8', 'monthly'],
        'Patient Info'   => ['0.8', 'monthly'],
        'Media & Blog'   => ['0.8', 'weekly'],
        'Contact & Legal'=> ['0.6', 'monthly'],
        'General'        => ['0.5', 'monthly'],
    ];
    // Pages that must never be listed
    $skipSlugs = ['thank-you', 'blog-post', '404'];
    $legalSlugs = ['privacy-policy', 'terms-of-service'];

    $readJson = function ($file) {
        if (!is_file($file)) return null;
        $d = json_decode((string)file_get_contents($file), true);
        return is_array($d) ? $d : null;
    };

    $catalog = $readJson($dataDir . '/pages_catalog.json') ?: [];
    $entries = [];

    // Homepage first
    $entries[] = ['loc' => $baseUrl . '/', 'lastmod' => $today, 'changefreq' => 'daily', 'priority' => '1.0'];
    // Landing page (served from /LP via .htaccess)
    if (is_file($rootDir . '/LP/index.php')) {
        $entries[] = ['loc' => $baseUrl . '/enquire', 'lastmod' => $today, 'changefreq' => 'weekly', 'priority' => '0.9'];
    }

    foreach ($catalog as $page) {
        $slug = trim((string)($page['slug'] ?? ''));
        if ($slug === '' || $slug === 'index' || in_array($slug, $skipSlugs, true)) continue;
        $pageData = $readJson($dataDir . '/pages/' . preg_replace('/[^a-zA-Z0-9_-]/', '', $slug) . '.json') ?: [];
        if (!empty($pageData['robots_noindex'])) continue;
        [$priority, $freq] = $categoryDefaults[$page['category'] ?? ''] ?? ['0.7', 'monthly'];
        if (in_array($slug, $legalSlugs, true)) { $priority = '0.5'; $freq = 'yearly'; }
        if (!empty($pageData['sitemap_priority']) && is_numeric($pageData['sitemap_priority'])) {
            $priority = number_format(max(0, min(1, (float)$pageData['sitemap_priority'])), 1);
        }
        $lastmod = $today;
        $pf = $dataDir . '/pages/' . $slug . '.json';
        if (is_file($pf)) $lastmod = date('Y-m-d', filemtime($pf));
        $entries[] = ['loc' => $baseUrl . '/' . $slug, 'lastmod' => $lastmod, 'changefreq' => $freq, 'priority' => $priority];
    }

    // Published blog articles → /blog/<slug>
    foreach ($readJson($dataDir . '/blogs.json') ?: [] as $b) {
        if (($b['status'] ?? 'published') !== 'published') continue;
        $slug = trim((string)($b['slug'] ?? ''));
        if ($slug === '') continue;
        $date = !empty($b['date']) ? date('Y-m-d', strtotime($b['date'])) : $today;
        $entries[] = ['loc' => $baseUrl . '/blog/' . $slug, 'lastmod' => $date, 'changefreq' => 'weekly', 'priority' => '0.8'];
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
    $xml .= '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
    $xml .= '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
    $added = [];
    foreach ($entries as $e) {
        if (isset($added[$e['loc']])) continue;
        $added[$e['loc']] = true;
        $xml .= "    <url>\n";
        $xml .= "        <loc>" . htmlspecialchars($e['loc'], ENT_XML1) . "</loc>\n";
        $xml .= "        <lastmod>" . htmlspecialchars($e['lastmod'], ENT_XML1) . "</lastmod>\n";
        $xml .= "        <changefreq>" . htmlspecialchars($e['changefreq'], ENT_XML1) . "</changefreq>\n";
        $xml .= "        <priority>" . htmlspecialchars($e['priority'], ENT_XML1) . "</priority>\n";
        $xml .= "    </url>\n";
    }
    $xml .= '</urlset>' . "\n";

    $written = @file_put_contents($sitemapFile, $xml, LOCK_EX);
    return ($written !== false);
}

// Allow CLI execution directly
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    $ok = generate_sitemap_xml();
    echo $ok ? "Sitemap successfully generated at sitemap.xml\n" : "Failed to generate sitemap.\n";
}
