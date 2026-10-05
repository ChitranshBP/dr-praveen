<?php
/**
 * XML Sitemap Generator - Dr. Praveen Gupta
 * Generates a fully compliant, W3C/Sitemaps.org standard sitemap.xml
 * Includes all core pages, services, conditions, patient resources, landing pages, and published blogs.
 */

if (!defined('SITE_URL')) {
    define('SITE_URL', 'https://drpraveengupta.com');
}

function generate_sitemap_xml() {
    $rootDir = dirname(__DIR__);
    $dataDir = $rootDir . '/data';
    $sitemapFile = $rootDir . '/sitemap.xml';

    // Base URL
    $baseUrl = rtrim(SITE_URL, '/');
    $today = date('Y-m-d');

    // Static core pages with priorities and change frequencies
    $staticPages = [
        // Homepage
        ['path' => '', 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => $today],

        // Landing Page
        ['path' => 'enquire', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],

        // Core About & Doctor Profile
        ['path' => 'about', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'why-choose-dr-praveen-gupta', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'team', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'awards-and-recognition', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'contact-us-top-neurologist-delhi-ncr', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],

        // Services Hub & Procedures
        ['path' => 'services', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'brain-tumor-surgery', 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'spine-surgery', 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'functional-neurosurgery', 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'neurovascular-surgery', 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'memory-clinic', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'neuro-rehabilitation-center', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'brain-health-center', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'neurocritical-acute-stroke-care', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'rtms-therapy', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'neurology-procedures', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],

        // Conditions Hub & Specific Conditions
        ['path' => 'neurological-conditions', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'epilepsy', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'headache', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'migraine', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'stroke', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'vertigo', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'parkinsons', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'ms', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'movement', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'neuropathy', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'neurological-symptoms', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],

        // Patient Care & Consultations
        ['path' => 'patient-info', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'neurology-consultation', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'online-neurologist-consultation', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'neurology-second-opinion', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'emergency-neurology-care', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'brain-stroke-helpline', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],

        // Testimonials, Reviews & FAQs
        ['path' => 'neurology-patient-testimonials', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'patient-success-stories', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'case-studies', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'patient-reviews', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'neurology-faqs', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'faqs-neurologist-near-me', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],

        // Media & Videos
        ['path' => 'videos', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'neurology-video-library', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'video-testimonials', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'media-coverage', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
        ['path' => 'gallery', 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => $today],

        // Blog Hub
        ['path' => 'dr-praveen-gupta-blog', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $today],
        ['path' => 'blog', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $today],

        // Legal
        ['path' => 'privacy-policy', 'priority' => '0.5', 'changefreq' => 'yearly', 'lastmod' => $today],
        ['path' => 'terms-of-service', 'priority' => '0.5', 'changefreq' => 'yearly', 'lastmod' => $today],
    ];

    // Load blogs from data/blogs.json
    $blogs = [];
    $blogsFile = $dataDir . '/blogs.json';
    if (file_exists($blogsFile)) {
        $raw = file_get_contents($blogsFile);
        $decoded = json_decode($raw, true);
        if (is_array($decoded)) {
            $blogs = $decoded;
        }
    }

    // Build XML string
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
    $xml .= '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
    $xml .= '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

    // Track added URLs to prevent any accidental duplicates
    $addedUrls = [];

    // Add static pages
    foreach ($staticPages as $page) {
        $path = trim($page['path'], '/');
        $loc = $path === '' ? $baseUrl . '/' : $baseUrl . '/' . $path;

        if (isset($addedUrls[$loc])) continue;
        $addedUrls[$loc] = true;

        $xml .= "    <url>\n";
        $xml .= "        <loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
        $xml .= "        <lastmod>" . htmlspecialchars($page['lastmod'], ENT_XML1) . "</lastmod>\n";
        $xml .= "        <changefreq>" . htmlspecialchars($page['changefreq'], ENT_XML1) . "</changefreq>\n";
        $xml .= "        <priority>" . htmlspecialchars($page['priority'], ENT_XML1) . "</priority>\n";
        $xml .= "    </url>\n";
    }

    // Add published blog articles with clean static URL structure /blog/<slug>
    foreach ($blogs as $b) {
        if (($b['status'] ?? 'published') !== 'published') continue;
        $slug = trim($b['slug'] ?? '');
        if ($slug === '') continue;

        $loc = $baseUrl . '/blog/' . $slug;
        if (isset($addedUrls[$loc])) continue;
        $addedUrls[$loc] = true;

        $date = !empty($b['date']) ? date('Y-m-d', strtotime($b['date'])) : $today;

        $xml .= "    <url>\n";
        $xml .= "        <loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
        $xml .= "        <lastmod>" . htmlspecialchars($date, ENT_XML1) . "</lastmod>\n";
        $xml .= "        <changefreq>weekly</changefreq>\n";
        $xml .= "        <priority>0.8</priority>\n";
        $xml .= "    </url>\n";
    }

    $xml .= '</urlset>' . "\n";

    // Save to sitemap.xml
    $written = @file_put_contents($sitemapFile, $xml, LOCK_EX);
    return ($written !== false);
}

// Allow CLI execution directly
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    $ok = generate_sitemap_xml();
    echo $ok ? "Sitemap successfully generated at sitemap.xml\n" : "Failed to generate sitemap.\n";
}
