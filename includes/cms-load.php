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
 * FAQ pages and items — managed in CMS (/cms/faqs.php).
 *
 * data/faqs.json is keyed by page slug. Each entry holds the section header
 * (badge/title/description), a layout and an ordered list of items.
 */
function cms_faqs_all() {
    $faqs = cms_json_read(CMS_DATA_DIR . '/faqs.json');
    return is_array($faqs) ? $faqs : [];
}

function cms_faq_page($slug) {
    $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);
    if ($slug === '') {
        return null;
    }
    $all = cms_faqs_all();
    if (!isset($all[$slug]) || !is_array($all[$slug])) {
        return null;
    }
    $page = $all[$slug];
    $items = [];
    foreach (($page['items'] ?? []) as $item) {
        if (!is_array($item)) {
            continue;
        }
        if (isset($item['is_active']) && !$item['is_active']) {
            continue;
        }
        $question = trim((string)($item['question'] ?? ''));
        if ($question === '') {
            continue;
        }
        $items[] = [
            'id' => (string)($item['id'] ?? ''),
            'question' => $question,
            'answer' => (string)($item['answer'] ?? ''),
            'category' => trim((string)($item['category'] ?? '')),
            'order' => (int)($item['order'] ?? 999),
            'is_active' => true,
        ];
    }
    usort($items, function ($a, $b) {
        return $a['order'] <=> $b['order'];
    });
    if (empty($items)) {
        return null;
    }
    return [
        'badge' => (string)($page['badge'] ?? 'FAQ'),
        'title' => (string)($page['title'] ?? 'Frequently Asked Questions'),
        'description' => (string)($page['description'] ?? ''),
        'layout' => (string)($page['layout'] ?? 'split'),
        'items' => $items,
    ];
}

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
function cms_testimonials($type = 'review') {
    $raw = cms_json_read(CMS_DATA_DIR . '/testimonials.json');
    if (!is_array($raw) || empty($raw)) {
        return null;
    }
    // "review" (default) = short quotes used in sliders and review grids;
    // "story" = long-form success stories with a title and city; "all" = both.
    if ($type !== 'all') {
        $raw = array_filter($raw, function ($t) use ($type) {
            $tt = is_array($t) ? (string)($t['type'] ?? 'review') : '';
            return $tt === $type;
        });
    }
    // Honour the display order chosen in CMS → Testimonials.
    $raw = array_values(array_filter($raw, 'is_array'));
    usort($raw, function ($a, $b) {
        return ((int)($a['order'] ?? 999)) <=> ((int)($b['order'] ?? 999));
    });
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
            'type'      => (string)($t['type'] ?? 'review'),
            'title'     => trim((string)($t['title'] ?? '')),
            'city'      => trim((string)($t['city'] ?? '')),
        ];
    }
    return empty($out) ? null : $out;
}

/**
 * Parse a "key|Label" per-line list setting into [key => label], falling
 * back to $defaults when the setting is empty. Used for gallery / video
 * filter chips (CMS → Settings → Lists & Categories).
 */
function cms_setting_options($key, array $defaults = []) {
    global $cmsSettings;
    $raw = trim((string)($cmsSettings[$key] ?? ''));
    if ($raw === '') {
        return $defaults;
    }
    $opts = [];
    foreach (preg_split('/\r\n|\r|\n/', $raw) as $line) {
        $line = trim($line);
        if ($line === '') {
            continue;
        }
        if (strpos($line, '|') !== false) {
            [$k, $l] = array_map('trim', explode('|', $line, 2));
        } else {
            $l = $line;
            $k = trim(strtolower(preg_replace('/[^a-z0-9]+/i', '-', $line)), '-');
        }
        if ($k !== '') {
            $opts[$k] = $l;
        }
    }
    return $opts ?: $defaults;
}

/**
 * Education videos for a page's "Watch & Learn" section.
 * Uses the explicit list saved on the page (data/pages/{slug}.json →
 * related_videos, in order) and otherwise every video tagged with the page
 * in CMS → Education Videos.
 */
function cms_videos_for_page($slug) {
    $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);
    $videos = cms_collection('videos');
    if ($slug === '' || empty($videos)) {
        return [];
    }
    $byId = [];
    foreach ($videos as $v) {
        if (!empty($v['youtube_id'])) {
            $byId[$v['youtube_id']] = $v;
        }
    }
    $page = function_exists('get_page_content') ? get_page_content($slug, []) : [];
    $explicit = isset($page['related_videos']) && is_array($page['related_videos']) ? $page['related_videos'] : null;
    $out = [];
    if ($explicit !== null) {
        foreach ($explicit as $vid) {
            if (isset($byId[$vid])) {
                $out[] = $byId[$vid];
            }
        }
        return $out;
    }
    foreach ($videos as $v) {
        if (!empty($v['related_pages']) && is_array($v['related_pages']) && in_array($slug, $v['related_pages'], true)) {
            $out[] = $v;
        }
    }
    return $out;
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
 * Generic CMS collection (data/collections/{name}.json), sorted by "order".
 * Items flagged inactive are dropped unless $onlyActive is false.
 * Managed in CMS → the collection's own screen (cms/collection.php?c=name).
 */
function cms_collection($name, $onlyActive = true) {
    static $cache = [];
    $name = preg_replace('/[^a-z0-9_]/', '', (string)$name);
    if ($name === '') {
        return [];
    }
    if (!isset($cache[$name])) {
        $items = cms_json_read(CMS_DATA_DIR . '/collections/' . $name . '.json');
        $items = is_array($items) ? array_values(array_filter($items, 'is_array')) : [];
        usort($items, function ($a, $b) {
            return ((int)($a['order'] ?? 0)) <=> ((int)($b['order'] ?? 0));
        });
        $cache[$name] = $items;
    }
    if (!$onlyActive) {
        return $cache[$name];
    }
    return array_values(array_filter($cache[$name], function ($it) {
        return !array_key_exists('active', $it) || !empty($it['active']);
    }));
}

/**
 * Site navigation (CMS → Navigation, data/navigation.json).
 * Keys: main[] {label,url,children[],view_all}, header_cta {label,url},
 * footer_quick_links[], footer_legal_links[], mobile_bar[] {label,url,icon,style},
 * not_found_links[]. URL tokens {phone} {stroke-helpline} {whatsapp} are
 * resolved by cms_nav_href().
 */
function cms_navigation() {
    static $nav = null;
    if ($nav !== null) {
        return $nav;
    }
    $nav = cms_json_read(CMS_DATA_DIR . '/navigation.json');
    if (!is_array($nav)) {
        $nav = [];
    }
    foreach (['main', 'footer_quick_links', 'footer_legal_links', 'mobile_bar', 'not_found_links'] as $k) {
        if (!isset($nav[$k]) || !is_array($nav[$k])) {
            $nav[$k] = [];
        }
        $nav[$k] = array_values(array_filter($nav[$k], function ($it) {
            return is_array($it) && trim((string)($it['label'] ?? '')) !== '';
        }));
    }
    foreach ($nav['main'] as &$item) {
        $item['children'] = isset($item['children']) && is_array($item['children'])
            ? array_values(array_filter($item['children'], function ($c) { return is_array($c) && trim((string)($c['label'] ?? '')) !== ''; }))
            : [];
    }
    unset($item);
    if (!isset($nav['header_cta']) || !is_array($nav['header_cta'])) {
        $nav['header_cta'] = ['label' => 'Book Appointment', 'url' => 'contact-us-top-neurologist-delhi-ncr'];
    }
    return $nav;
}

/**
 * Resolve a navigation URL: {phone} / {stroke-helpline} become tel: links,
 * {whatsapp} becomes the wa.me link, everything else passes through.
 */
function cms_nav_href($url) {
    $url = trim((string)$url);
    if ($url === '' || $url === '#') {
        return '#';
    }
    if (stripos($url, '{phone}') !== false) {
        return 'tel:' . (defined('SITE_PHONE') ? SITE_PHONE : '');
    }
    if (stripos($url, '{stroke-helpline}') !== false) {
        return 'tel:' . (defined('STROKE_HELPLINE') ? STROKE_HELPLINE : '');
    }
    if (stripos($url, '{whatsapp}') !== false) {
        return 'https://wa.me/' . (defined('SITE_WHATSAPP') ? SITE_WHATSAPP : '') . '?text=' . rawurlencode(defined('WHATSAPP_MESSAGE') ? WHATSAPP_MESSAGE : '');
    }
    return $url;
}

/**
 * Editable copy for the header, footer and shared sections (CMS → Site Text).
 * Each entry: key => [group, label, default, type]. Values live in
 * data/settings.json under the same key; cms_text() returns the saved value
 * or the default.
 */
function cms_site_text_fields() {
    static $fields = null;
    if ($fields !== null) {
        return $fields;
    }
    $fields = [
        // Footer call-to-action band (every page)
        'footer_cta_title'       => ['Footer CTA band', 'Heading', 'Need Personalized Advice?', 'text'],
        'footer_cta_text'        => ['Footer CTA band', 'Paragraph', 'Consult with Dr. Praveen Gupta to get an accurate diagnosis and custom treatment plan for your neurological health. We are here to support your journey back to wellness.', 'textarea'],
        'footer_cta_primary_label' => ['Footer CTA band', 'Primary button text', 'Book Appointment', 'text'],
        'footer_cta_primary_url' => ['Footer CTA band', 'Primary button link', 'contact-us-top-neurologist-delhi-ncr', 'url'],
        'footer_cta_secondary_label' => ['Footer CTA band', 'Secondary button text', 'Call Now', 'text'],
        'footer_cta_secondary_url' => ['Footer CTA band', 'Secondary button link ({phone} dials the clinic)', '{phone}', 'url'],
        // Footer columns
        'footer_about_text'      => ['Footer', 'About blurb under the logo', 'Providing exceptional medical care with compassion and expertise for over 20 years. Your trusted partner in health and wellness journey.', 'textarea'],
        'footer_stat_patients_label' => ['Footer', 'Stat label 1 (patients)', 'Patients', 'text'],
        'footer_stat_awards_label'   => ['Footer', 'Stat label 2 (awards)', 'Awards', 'text'],
        'footer_stat_rating_label'   => ['Footer', 'Stat label 3 (rating)', 'Rating', 'text'],
        'footer_follow_label'    => ['Footer', '"Follow Us" label', 'Follow Us', 'text'],
        'footer_quick_links_heading' => ['Footer', 'Quick links column heading', 'Quick Links', 'text'],
        'footer_services_heading'=> ['Footer', 'Services column heading', 'Our Services', 'text'],
        'footer_contact_heading' => ['Footer', 'Contact column heading', 'Get In Touch', 'text'],
        'footer_location_label'  => ['Footer', 'Location row label', 'Our Location', 'text'],
        'footer_maps_label'      => ['Footer', 'Maps link text', 'View on Google Maps', 'text'],
        'footer_phone_label'     => ['Footer', 'Phone row label', 'Call Us', 'text'],
        'footer_email_label'     => ['Footer', 'Email row label', 'Email Us', 'text'],
        'footer_hours_label'     => ['Footer', 'Hours row label', 'Working Hours', 'text'],
        'footer_copyright'       => ['Footer', 'Copyright line ({year} and {site} are replaced)', '© {year} {site}. All rights reserved.', 'text'],
        // Floating buttons
        'float_whatsapp_label'   => ['Floating buttons', 'WhatsApp hover label', 'Chat on WhatsApp', 'text'],
        'float_helpline_label'   => ['Floating buttons', 'Stroke helpline hover label ({stroke-helpline} prints the number)', '24x7 Stroke Helpline: {stroke-helpline}', 'text'],
        // Shared video testimonials slider
        'vt_eyebrow'             => ['Video testimonials section', 'Eyebrow label', 'Video Testimonials', 'text'],
        'vt_heading'             => ['Video testimonials section', 'Heading (HTML allowed)', 'Hear It From Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-200 to-cyan-accent">Patients</span>', 'text'],
        'vt_intro'               => ['Video testimonials section', 'Intro paragraph', 'Watch patients share their recovery journeys with Dr. Praveen Gupta in their own words.', 'textarea'],
        'vt_caption'             => ['Video testimonials section', 'Caption under each video', 'Patient Testimonial', 'text'],
        'vt_button_label'        => ['Video testimonials section', 'Button text', 'Watch All Video Testimonials', 'text'],
        'vt_button_url'          => ['Video testimonials section', 'Button link', 'video-testimonials', 'url'],
        // Shared related videos ("Watch & Learn")
        'rv_eyebrow'             => ['Watch & Learn section', 'Eyebrow label', 'Video Guides', 'text'],
        'rv_heading'             => ['Watch & Learn section', 'Heading (HTML allowed)', 'Watch & <span class="gradient-text">Learn</span>', 'text'],
        'rv_intro'               => ['Watch & Learn section', 'Intro paragraph', 'Dr. Praveen Gupta explains the essentials in plain language — what to look out for, the treatment options available, and what to expect.', 'textarea'],
        'rv_button_label'        => ['Watch & Learn section', 'Button text', 'Browse the Full Video Library', 'text'],
        'rv_button_url'          => ['Watch & Learn section', 'Button link', 'neurology-video-library', 'url'],
        // FAQ section defaults
        'faq_default_badge'      => ['FAQ sections', 'Default badge when a page FAQ has none', 'FAQ', 'text'],
        'faq_default_title'      => ['FAQ sections', 'Default heading when a page FAQ has none', 'Frequently Asked Questions', 'text'],
        'faq_categories_label'   => ['FAQ sections', '"FAQ Categories" label (categories layout)', 'FAQ Categories', 'text'],
        'faq_general_group'      => ['FAQ sections', 'Group name for questions without a category', 'General', 'text'],
        'faq_hub_label'          => ['FAQ sections', 'Homepage FAQ link 1 text', 'View Full FAQs Hub', 'text'],
        'faq_hub_url'            => ['FAQ sections', 'Homepage FAQ link 1 URL', 'neurology-faqs', 'url'],
        'faq_contact_label'      => ['FAQ sections', 'Homepage FAQ link 2 text', 'Contact Our Patient Care Team', 'text'],
        'faq_contact_url'        => ['FAQ sections', 'Homepage FAQ link 2 URL', 'contact-us-top-neurologist-delhi-ncr', 'url'],
        // 404 page
        'nf_badge'               => ['404 page', 'Badge', 'Error 404', 'text'],
        'nf_title'               => ['404 page', 'Heading', 'Page Not Found', 'text'],
        'nf_text'                => ['404 page', 'Paragraph', 'The page you are looking for might have been relocated, renamed, or is temporarily unavailable. Let us help you get back on track.', 'textarea'],
        'nf_links_heading'       => ['404 page', 'Quick links heading', 'Popular Quick Links', 'text'],
        // Global SEO
        'meta_keywords'          => ['SEO defaults', 'Default meta keywords (comma separated)', 'Dr Praveen Gupta, healthcare, medical services, doctor, clinic', 'text'],
        'meta_author'            => ['SEO defaults', 'Meta author', 'Dr. Praveen Gupta', 'text'],
    ];
    return $fields;
}

/**
 * Saved value of a site-text key, or its default.
 */
function cms_text($key, $default = null) {
    global $cmsSettings;
    $fields = cms_site_text_fields();
    if ($default === null) {
        $default = $fields[$key][2] ?? '';
    }
    $v = isset($cmsSettings[$key]) ? trim((string)$cmsSettings[$key]) : '';
    $v = $v !== '' ? $v : (string)$default;
    // Live tokens (URL fields keep their {phone} / {stroke-helpline} tokens so
    // cms_nav_href() can turn them into tel: links)
    if (($fields[$key][3] ?? 'text') !== 'url' && strpos($v, '{') !== false) {
        $v = str_replace(
            ['{phone}', '{stroke-helpline}', '{year}', '{site}'],
            [defined('SITE_PHONE') ? SITE_PHONE : '', defined('STROKE_HELPLINE') ? STROKE_HELPLINE : '', date('Y'), defined('SITE_NAME') ? SITE_NAME : ''],
            $v
        );
    }
    return $v;
}

/**
 * Breadcrumb trail for a page: Home → (parent) → page. Labels and the parent
 * come from the page's SEO card (breadcrumb_label / breadcrumb_parent in
 * data/pages/{slug}.json); the catalog title is the fallback label.
 * Returns a list of ['label' => ..., 'slug' => ...], the current page last.
 */
function cms_breadcrumbs($slug, $fallbackLabel = '') {
    $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);
    if ($slug === '' || $slug === 'index') {
        return [];
    }
    $catalog = cms_json_read(CMS_DATA_DIR . '/pages_catalog.json') ?: [];
    $titles = [];
    foreach ($catalog as $p) {
        if (!empty($p['slug'])) {
            $titles[$p['slug']] = (string)($p['title'] ?? $p['slug']);
        }
    }
    $labelFor = function ($s) use ($titles) {
        $page = function_exists('get_page_content') ? get_page_content($s, []) : [];
        $label = trim((string)($page['breadcrumb_label'] ?? ''));
        if ($label === '') {
            $label = trim(strip_tags((string)($page['hero_title'] ?? '')));
        }
        if ($label === '') {
            $label = $titles[$s] ?? ucwords(str_replace('-', ' ', $s));
        }
        return $label;
    };
    $trail = [['label' => 'Home', 'slug' => 'index']];
    $page = function_exists('get_page_content') ? get_page_content($slug, []) : [];
    $parent = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)($page['breadcrumb_parent'] ?? ''));
    if ($parent !== '' && $parent !== 'index' && $parent !== $slug) {
        $trail[] = ['label' => $labelFor($parent), 'slug' => $parent];
    }
    $own = trim((string)($page['breadcrumb_label'] ?? ''));
    $trail[] = ['label' => $own !== '' ? $own : ($fallbackLabel !== '' && !isset($titles[$slug]) ? $fallbackLabel : $labelFor($slug)), 'slug' => $slug];
    return $trail;
}

/**
 * Landing page (/LP) settings. Returns [] when not customized.
 */
function cms_lp_settings() {
    $lp = cms_json_read(CMS_DATA_DIR . '/lp.json');
    return is_array($lp) ? $lp : [];
}
