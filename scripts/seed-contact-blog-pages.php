<?php
/**
 * One-time: services, contact, thank-you and blog listing pages onto the
 * ordered block flow; blank banner buttons for pages that never had them;
 * SEO titles for the blog listings.
 *
 *   php scripts/seed-contact-blog-pages.php --write
 */
$root = dirname(__DIR__);
$write = in_array('--write', $argv, true);
$blocksFile = $root . '/data/page-blocks.json';
$all = json_decode(file_get_contents($blocksFile), true);

$pages = [
    'services' => [
        '_flow' => true,
        'services' => ['type' => 'services-grid', 'label' => 'Services card grid', 'options' => ['layout' => 'grid']],
        'video-testimonials' => ['type' => 'video-testimonials', 'label' => 'Video Testimonials'],
    ],
    'contact-us-top-neurologist-delhi-ncr' => [
        '_flow' => true,
        'contact' => [
            'type' => 'contact-form', 'label' => 'Contact details + enquiry form',
            'badge' => 'Contact Details', 'title' => 'How to Reach Us',
            'text' => 'For emergencies, please call our 24/7 helpline immediately. For regular consultations, please fill out the form or use our direct clinic lines.',
            'items' => [
                ['icon' => 'fa-phone-alt', 'color' => 'electric-blue', 'title' => 'Call Us', 'text' => '{phone}', 'subtitle' => '{hours_weekdays}'],
                ['icon' => 'fa-envelope', 'color' => 'cyan-accent', 'title' => 'Email Us', 'text' => '{email}', 'subtitle' => 'We reply within 24 business hours'],
                ['icon' => 'fa-map-marker-alt', 'color' => 'deep-indigo', 'title' => 'OPD Clinic Location', 'text' => '', 'subtitle' => '{address}'],
            ],
            'panel_title' => 'Send Us a Message',
            'panel_text' => 'Fill out the form below, and our coordinator will connect with you shortly.',
            'bullets' => ['Appointment|Schedule Appointment', 'Second Opinion|Second Opinion Consultation', 'General Query|General Inquiry', 'Feedback|Feedback / Testimonials'],
            'button_text' => 'Send Message',
            'options' => ['form_type' => 'Main Contact Form', 'show_upload' => true],
        ],
        'map' => ['type' => 'map', 'label' => 'Google Map', 'badge' => 'Hospital Location', 'title' => 'Find Us on the Map'],
        'faq' => ['type' => 'faq', 'label' => 'FAQ Section'],
    ],
    'thank-you' => [
        '_flow' => true,
        'message' => [
            'type' => 'message-hero', 'label' => 'Thank-you message',
            'badge_icon' => 'fa-check',
            'title' => 'Thank <span class="text-cyan-accent">You!</span>',
            'description' => 'Your Submission has been Received',
            'text' => "Thank you for contacting Dr. Praveen Gupta's clinical team. We have successfully received your inquiry and our patient coordinator will review the details and reach back to you shortly.",
            'items' => [
                ['icon' => 'fa-home', 'color' => 'cyan-accent', 'title' => 'Return Home', 'text' => 'Go back to the homepage to read about services.', 'url' => '/'],
                ['icon' => 'fa-phone-alt', 'color' => 'red', 'title' => 'Emergency Desk', 'text' => 'Call 24x7 helpline for urgent medical help.', 'url' => '{stroke-helpline}'],
            ],
            'button_text' => 'Back to main website', 'button_url' => '/',
            'options' => ['title_html' => true],
        ],
    ],
    'blog' => [
        '_flow' => true,
        'articles' => [
            'type' => 'blog-grid', 'label' => 'All articles', 'variant' => 'all',
            'badge' => 'Blogs', 'badge_icon' => 'fa-newspaper',
            'title' => 'Latest <span class="gradient-text">Articles</span>',
            'description' => 'Guidance on neurological conditions, treatments and recovery — written for patients and their families.',
            'options' => ['title_html' => true],
        ],
    ],
    'dr-praveen-gupta-blog' => [
        '_flow' => true,
        'articles' => [
            'type' => 'blog-grid', 'label' => 'Article list + sidebar', 'variant' => 'list',
            'panel_title' => 'Subscribe to Newsletter',
            'panel_text' => 'Stay updated with healthy brain guidelines and latest clinical updates.',
            'button_text' => 'Subscribe',
            'options' => ['categories_heading' => 'Blog Categories', 'form_type' => 'Blog Newsletter Subscription'],
        ],
    ],
];
foreach ($pages as $slug => $def) {
    $def['main-body'] = ['type' => 'intro', 'label' => 'Main Body Section Content', 'options' => ['layout' => 'split']];
    $pages[$slug] = $def;
    echo $slug . ': ' . implode(' → ', array_keys(array_filter($def, function ($v, $k) { return $k[0] !== '_'; }, ARRAY_FILTER_USE_BOTH))) . "\n";
}

// Page JSON: breadcrumbs, hero icons, SEO titles; hero copy that was hard-coded.
$pageMeta = [
    'services' => ['breadcrumb_label' => 'Services', 'hero_icon' => 'fa-stethoscope text-white'],
    'contact-us-top-neurologist-delhi-ncr' => ['breadcrumb_label' => 'Contact Us', 'hero_icon' => 'fa-location-dot text-white'],
    'thank-you' => ['breadcrumb_label' => 'Thank You', 'robots_noindex' => true],
    'blog' => ['breadcrumb_label' => 'Blog', 'meta_title' => 'Blog - Dr. Praveen Gupta, Neurologist', 'meta_description' => "Articles and health guides on stroke, epilepsy, migraine, Parkinson's disease and brain health by Dr. Praveen Gupta."],
    'dr-praveen-gupta-blog' => ['breadcrumb_label' => 'Blog', 'hero_icon' => 'fa-book-open text-white', 'meta_title' => 'Neurology Blog - Dr. Praveen Gupta', 'meta_description' => 'Expert guides, healthy lifestyle tips, and detailed neuro-health columns curated directly by Dr. Praveen Gupta.'],
];
// The blog hub banner ignored the page JSON until now: keep the live wording.
$pageForce = [
    'dr-praveen-gupta-blog' => ['hero_badge' => 'Healthy Brain Guides & Articles', 'hero_title' => 'The Neurology <span class="text-white font-normal">Blog</span>', 'hero_bg' => ''],
];

// Banner buttons: services keeps its two; pages that never had banner buttons get blank defaults.
$heroCtas = [
    'services' => ['hero-primary' => ['text' => 'Book Appointment', 'url' => 'contact-us-top-neurologist-delhi-ncr'], 'hero-secondary' => ['text' => 'Call Now', 'url' => '{phone}']],
];
foreach (['about', 'team', 'awards-and-recognition', 'gallery', 'media-coverage', 'videos', 'neurology-video-library', 'video-testimonials', 'patient-reviews', 'neurology-patient-testimonials', 'patient-success-stories', 'case-studies', 'contact-us-top-neurologist-delhi-ncr', 'dr-praveen-gupta-blog', 'blog', 'thank-you'] as $s) {
    $heroCtas[$s] = ['hero-primary' => ['text' => '', 'url' => ''], 'hero-secondary' => ['text' => '', 'url' => '']];
}

if (!$write) { echo "(dry run)\n"; exit; }

foreach ($pages as $slug => $def) $all[$slug] = $def;
file_put_contents($blocksFile, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");

foreach ($pageMeta as $slug => $meta) {
    $file = $root . '/data/pages/' . $slug . '.json';
    $page = is_file($file) ? (json_decode(file_get_contents($file), true) ?: []) : ['slug' => $slug];
    foreach ($meta as $k => $v) {
        if (is_bool($v)) { $page[$k] = $v; continue; }
        if (trim((string)($page[$k] ?? '')) === '' && $v !== '') $page[$k] = $v;
    }
    foreach ($pageForce[$slug] ?? [] as $k => $v) $page[$k] = $v;
    file_put_contents($file, json_encode($page, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
}

$ctasFile = $root . '/data/page-ctas.json';
$ctas = json_decode(file_get_contents($ctasFile), true);
foreach ($heroCtas as $slug => $keys) {
    foreach ($keys as $k => $v) {
        if (!isset($ctas['pages'][$slug][$k])) $ctas['pages'][$slug][$k] = $v;
    }
}
file_put_contents($ctasFile, json_encode($ctas, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
echo "written\n";
