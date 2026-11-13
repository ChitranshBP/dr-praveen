<?php
/**
 * One-time: move the gallery, media, video, testimonial and case-study pages
 * onto the ordered block flow with the copy that was hard-coded in the
 * templates; seed breadcrumb labels and hero icons.
 *
 *   php scripts/seed-media-pages.php --write
 */
$root = dirname(__DIR__);
$write = in_array('--write', $argv, true);
$blocksFile = $root . '/data/page-blocks.json';
$all = json_decode(file_get_contents($blocksFile), true);
$settings = json_decode(@file_get_contents($root . '/data/settings.json'), true) ?: [];
$stat = function ($literal, $tokenKey) use ($settings) {
    return (isset($settings[$tokenKey]) && trim((string)$settings[$tokenKey]) === $literal) ? '{' . $tokenKey . '}' : $literal;
};

$pages = [
    'gallery' => [
        '_flow' => true,
        'photos' => ['type' => 'collection-grid', 'label' => 'Photo gallery (filterable)', 'collection' => 'gallery', 'variant' => 'gallery-filter', 'options' => ['all_label' => 'All Photos']],
    ],
    'media-coverage' => [
        '_flow' => true,
        'press' => ['type' => 'collection-grid', 'label' => 'Press & TV coverage cards', 'collection' => 'media_coverage', 'variant' => 'press'],
    ],
    'videos' => [
        '_flow' => true,
        'player' => ['type' => 'collection-grid', 'label' => 'Featured video player', 'collection' => 'videos', 'variant' => 'video-player', 'badge' => 'Now Playing', 'button_text' => 'Subscribe on YouTube', 'button_url' => '{youtube}'],
        'library' => ['type' => 'collection-grid', 'label' => 'Video library (search, filters, pages)', 'collection' => 'videos', 'variant' => 'video-library', 'badge' => 'Video Library', 'title' => 'All Patient Awareness Videos', 'options' => ['mode' => 'player', 'per_page' => 12, 'columns' => 4]],
    ],
    'neurology-video-library' => [
        '_flow' => true,
        'library' => ['type' => 'collection-grid', 'label' => 'Video library (search, filters, pages)', 'collection' => 'videos', 'variant' => 'video-library', 'options' => ['mode' => 'inline', 'per_page' => 8, 'columns' => 2]],
    ],
    'video-testimonials' => [
        '_flow' => true,
        'videos' => ['type' => 'testimonials', 'label' => 'Video testimonials grid', 'variant' => 'video-grid', 'badge' => 'Patient Recovery Clips', 'title' => 'Verified Patient Video Stories', 'description' => 'Click play to watch their experiences and health transformations.'],
    ],
    'patient-reviews' => [
        '_flow' => true,
        'rating' => ['type' => 'stats', 'label' => 'Rating box', 'variant' => 'box', 'items' => [
            ['icon' => 'stars', 'title' => $stat('4.9', 'stats_rating'), 'subtitle' => 'Average Rating'],
            ['icon' => 'none', 'title' => '1K+', 'subtitle' => 'Verified Reviews'],
            ['icon' => 'none', 'title' => '100%', 'subtitle' => 'Patient Care Guarantee'],
        ], 'wrap' => ['bg' => 'bg-white', 'padding' => 'py-12', 'class' => '']],
        'reviews' => ['type' => 'testimonials', 'label' => 'Review cards', 'variant' => 'cards'],
        'cta' => ['type' => 'cta-simple', 'label' => 'Call to action', 'title' => 'Consult with Dr. Praveen Gupta', 'description' => 'Experience the standard of clinical excellence and patient care praised by thousands of families.', 'button_text' => 'Request Appointment', 'button_url' => 'contact-us-top-neurologist-delhi-ncr', 'wrap' => ['class' => 'border-t border-b border-silver-grey/40 mt-12']],
    ],
    'neurology-patient-testimonials' => [
        '_flow' => true,
        'stats' => ['type' => 'stats', 'label' => 'Numbers strip', 'variant' => 'plain', 'items' => [
            ['icon' => 'none', 'color' => 'electric-blue', 'title' => '{stats_experience}', 'subtitle' => 'Years of Excellence'],
            ['icon' => 'none', 'color' => 'cyan-accent', 'title' => '{stats_patients}', 'subtitle' => 'Patients Treated'],
            ['icon' => 'none', 'color' => 'deep-indigo', 'title' => '{stats_rating}/5', 'subtitle' => 'Google Rating'],
            ['icon' => 'none', 'color' => 'emerald', 'title' => '98%', 'subtitle' => 'Stroke Recovery Rate'],
        ], 'wrap' => ['bg' => 'bg-slate-50', 'padding' => 'py-6', 'class' => 'border-b border-slate-200/50']],
        'reviews' => ['type' => 'testimonials', 'label' => 'Review grid', 'variant' => 'grid'],
        'cta' => ['type' => 'cta-simple', 'label' => 'Share your story', 'title' => 'Share Your Recovery Story', 'description' => 'Your journey can inspire others going through similar neurological challenges. If you have been treated by Dr. Praveen Gupta, we would love to hear your feedback.', 'button_text' => 'Submit Feedback', 'button_url' => 'contact-us-top-neurologist-delhi-ncr', 'button2_text' => 'Review on Google', 'button2_url' => 'https://g.page/r/dr-praveen-gupta-neurologist/review', 'options' => ['style' => 'gradient', 'button2_icon' => 'fab fa-google text-red-500']],
    ],
    'patient-success-stories' => [
        '_flow' => true,
        'stories' => ['type' => 'testimonials', 'label' => 'Success stories', 'variant' => 'stories'],
        'video-testimonials' => ['type' => 'video-testimonials', 'label' => 'Video Testimonials', 'badge' => 'Video Stories', 'title' => 'Recovery Stories on <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-200 to-cyan-accent">Video</span>', 'description' => 'Hear these journeys first hand — patients describing their diagnosis, treatment and recovery in their own words.'],
        'cta' => ['type' => 'cta-simple', 'label' => 'Share your story', 'title' => 'Share Your Recovery Story', 'description' => 'Your recovery path can inspire others undergoing difficult diagnoses. Let us know how your health has improved.', 'button_text' => 'Book a Consultation', 'button_url' => 'contact-us-top-neurologist-delhi-ncr'],
    ],
    'case-studies' => [
        '_flow' => true,
        'cases' => ['type' => 'collection-grid', 'label' => 'Clinical case reports', 'collection' => 'case_studies', 'variant' => 'case-studies', 'badge' => 'Clinical Portals', 'title' => 'Clinical Recovery Reports', 'description' => 'Detailed reviews of patient cases, clinical decisions, and outcomes under Dr. Praveen Gupta.'],
        'cta' => ['type' => 'cta-simple', 'label' => 'Call to action', 'title' => 'Have a Complex Neurological Case?', 'description' => 'Get an expert clinical evaluation, record review, or second opinion of your diagnosis and current treatments.', 'button_text' => 'Book a Consultation', 'button_url' => 'contact-us-top-neurologist-delhi-ncr'],
    ],
];

$pageMeta = [
    'gallery' => ['breadcrumb_label' => 'Gallery', 'hero_icon' => 'fa-images'],
    'media-coverage' => ['breadcrumb_label' => 'Media Coverage', 'hero_icon' => 'fa-tv'],
    'videos' => ['breadcrumb_label' => 'Videos Hub', 'hero_icon' => 'fab fa-youtube text-red-500'],
    'neurology-video-library' => ['breadcrumb_label' => 'Video Library', 'hero_icon' => 'fa-video'],
    'video-testimonials' => ['breadcrumb_label' => 'Video Testimonials', 'hero_icon' => 'fa-video'],
    'patient-reviews' => ['breadcrumb_label' => 'Reviews', 'hero_icon' => 'fa-star text-yellow-400'],
    'neurology-patient-testimonials' => ['breadcrumb_label' => 'Testimonials', 'hero_icon' => 'fa-star text-amber-400'],
    'patient-success-stories' => ['breadcrumb_label' => 'Success Stories', 'hero_icon' => 'fa-notes-medical'],
    'case-studies' => ['breadcrumb_label' => 'Case Studies', 'hero_icon' => 'fa-microscope'],
];

foreach ($pages as $slug => $def) {
    $def['main-body'] = true;
    echo $slug . ': ' . implode(' → ', array_keys(array_filter($def, function ($v, $k) { return $k[0] !== '_'; }, ARRAY_FILTER_USE_BOTH))) . "\n";
}
if (!$write) { echo "(dry run)\n"; exit; }

foreach ($pages as $slug => $def) {
    $def['main-body'] = ['type' => 'intro', 'label' => 'Main Body Section Content', 'options' => ['layout' => 'split']];
    $all[$slug] = $def;
}
file_put_contents($blocksFile, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");

foreach ($pageMeta as $slug => $meta) {
    $file = $root . '/data/pages/' . $slug . '.json';
    $page = is_file($file) ? (json_decode(file_get_contents($file), true) ?: []) : ['slug' => $slug];
    foreach ($meta as $k => $v) {
        if (trim((string)($page[$k] ?? '')) === '' && $v !== '') $page[$k] = $v;
    }
    file_put_contents($file, json_encode($page, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
}
echo "written\n";
