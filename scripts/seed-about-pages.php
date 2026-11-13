<?php
/**
 * One-time: move the About, Why Choose, Team and Awards page sections into
 * data/page-blocks.json (ordered flow) with the copy that was hard-coded in
 * the templates, and seed breadcrumb labels / hero icons / hero CTA.
 *
 *   php scripts/seed-about-pages.php --write
 */
$root = dirname(__DIR__);
$write = in_array('--write', $argv, true);
$blocksFile = $root . '/data/page-blocks.json';
$all = json_decode(file_get_contents($blocksFile), true);
$settings = json_decode(@file_get_contents($root . '/data/settings.json'), true) ?: [];

// Use a {stats_*} token when the page literal equals the Settings value, so
// one central edit updates every page; otherwise keep the page's own number.
$stat = function ($literal, $tokenKey) use ($settings) {
    return (isset($settings[$tokenKey]) && trim((string)$settings[$tokenKey]) === $literal) ? '{' . $tokenKey . '}' : $literal;
};

$pages = [];

/* ------------------------------------------------------------------ about */
$pages['about'] = [
    '_flow' => true,
    'hero-roles' => [
        'type' => 'hero-list', 'label' => 'Banner designation lines', 'placement' => 'hero',
        'items' => [
            ['icon' => 'fa-award', 'color' => 'cyan-accent', 'text' => 'Chairman MAIINS (Marengo Asia International Institute of Neuro & Spine), MAH Gurgaon'],
            ['icon' => 'fa-user-md', 'color' => 'cyan-accent', 'text' => 'Chief Clinical Strategy, Growth and Innovation, North India'],
            ['icon' => 'fa-lightbulb', 'color' => 'cyan-accent', 'text' => 'Chief Mentor for Start-up and Clinical Innovation for Neurosciences, Mental Health and Neuro Rehab Programs'],
        ],
    ],
    'bio' => [
        'type' => 'text-media', 'label' => 'About / biography',
        'badge' => 'About',
        'title' => 'Pioneering the Future of <span class="gradient-text">Neurology in India</span>',
        'image' => 'assets/awards/AWARD-PRAVEEN.webp', 'image_alt' => 'Dr. Praveen Gupta Award Recognition',
        'text' => "Driven by passion and precision, Dr. Gupta has played a pioneering role in shaping the future of neurology in India. He established <strong class=\"text-deep-indigo\">Gurgaon's first dedicated stroke centre</strong> and became the first neurologist to perform solo mechanical thrombolysis in the region.\n\nHis groundbreaking achievements include conducting the <strong class=\"text-deep-indigo\">first Deep Brain Stimulation (DBS) procedure in Gurugram</strong> and performing the <strong class=\"text-deep-indigo\">first epileptic DBS in Asia</strong> — setting new benchmarks for neurological innovation.",
        'items' => [
            ['icon' => 'fa-bolt', 'color' => 'electric-blue', 'title' => 'Pioneer of Stroke Care', 'text' => "Gurgaon's 1st stroke centre"],
            ['icon' => 'fa-brain', 'color' => 'electric-blue', 'title' => 'First DBS, Gurugram', 'text' => 'Deep brain stimulation'],
            ['icon' => 'fa-globe-asia', 'color' => 'electric-blue', 'title' => 'First Epileptic DBS, Asia', 'text' => 'Continental benchmark'],
            ['icon' => 'fa-stethoscope', 'color' => 'electric-blue', 'title' => '20+ Years of Practice', 'text' => 'Neurology expertise'],
        ],
        'options' => ['title_html' => true, 'header_style' => 'line', 'items_style' => 'tiles', 'image_side' => 'left', 'image_aspect' => 'aspect-[3/4]', 'container' => 'max-w-6xl'],
        'wrap' => ['bg' => 'bg-white', 'padding' => 'py-14 lg:py-20', 'class' => 'overflow-hidden'],
    ],
    'stats' => [
        'type' => 'stats', 'label' => 'Numbers strip', 'variant' => 'strip',
        'items' => [
            ['icon' => 'none', 'title' => $stat('20+', 'stats_experience'), 'subtitle' => 'Years'],
            ['icon' => 'none', 'title' => $stat('500K+', 'stats_patients'), 'subtitle' => 'Patients'],
            ['icon' => 'none', 'title' => '70+', 'subtitle' => 'Publications'],
            ['icon' => 'none', 'title' => $stat('4.9', 'stats_rating'), 'subtitle' => 'Rating'],
        ],
    ],
    'expertise' => [
        'type' => 'cards', 'label' => 'Areas of Expertise',
        'badge' => 'Clinical Excellence',
        'title' => 'Areas of <span class="gradient-text">Expertise</span>',
        'description' => 'A deep commitment to patient-centric care and innovation has shaped comprehensive stroke, epilepsy, and movement disorder programs — setting new benchmarks in neurology.',
        'items' => [
            ['icon' => 'fa-heartbeat', 'color' => 'electric-blue', 'image' => 'assets/services/stroke.png', 'image_alt' => 'Stroke & Vascular Neurology', 'title' => 'Stroke & Vascular', 'text' => "Pioneer of Gurgaon's first dedicated stroke centre with advanced management protocols."],
            ['icon' => 'fa-bolt', 'color' => 'electric-blue', 'image' => 'assets/services/epilepsy.png', 'image_alt' => 'Epilepsy & Seizure Management', 'title' => 'Epilepsy & Seizures', 'text' => 'Performed the first epileptic DBS in Asia — redefining advanced epilepsy treatment.'],
            ['icon' => 'fa-walking', 'color' => 'electric-blue', 'image' => 'assets/services/parkinsons.png', 'image_alt' => "Movement Disorders & Parkinson's", 'title' => 'Movement Disorders', 'text' => 'Conducted the first Deep Brain Stimulation (DBS) procedure in Gurugram.'],
            ['icon' => 'fa-head-side-virus', 'color' => 'electric-blue', 'image' => 'assets/services/headache.png', 'image_alt' => 'Headache & Migraine', 'title' => 'Headache & Migraine', 'text' => 'Comprehensive therapeutic approaches for chronic and complex headache disorders.'],
            ['icon' => 'fa-ribbon', 'color' => 'electric-blue', 'image' => 'assets/services/ms.png', 'image_alt' => 'Multiple Sclerosis', 'title' => 'Multiple Sclerosis', 'text' => 'Advanced immunomodulatory therapies and tailored symptom management.'],
            ['icon' => 'fa-hand-holding-medical', 'color' => 'electric-blue', 'image' => 'assets/services/neuropathy.png', 'image_alt' => 'Peripheral Neuropathy', 'title' => 'Peripheral Neuropathy', 'text' => 'Expert diagnosis and targeted treatments for nerve damage and neurodegenerative conditions.'],
        ],
        'options' => [
            'title_html' => true, 'header_style' => 'line', 'header_margin' => 'mb-10',
            'grid' => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6',
            'card_class' => 'group bg-white rounded-2xl overflow-hidden border border-silver-grey/50 hover:shadow-xl transition-all duration-500',
            'item_image_class' => 'relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey',
            'item_body_class' => 'p-6',
            'item_icon_class' => 'w-9 h-9 rounded-full border border-electric-blue/30 flex items-center justify-center mb-3',
            'item_title_class' => 'text-base font-semibold text-deep-indigo mb-2',
            'item_text_class' => 'text-sm text-dark-grey/60 leading-relaxed',
        ],
        'wrap' => ['id' => 'specializations', 'bg' => 'bg-soft-cyan/30', 'padding' => 'py-14 lg:py-20', 'class' => 'relative overflow-hidden', 'container' => 'max-w-6xl'],
    ],
    'firsts' => [
        'type' => 'text-media', 'label' => 'Achievements — A Career of Firsts',
        'badge' => 'Achievements',
        'title' => 'A Career of <span class="gradient-text">Firsts</span>',
        'image' => 'assets/full-image/dpg-award.webp', 'image_alt' => 'Dr. Praveen Gupta - Award Recognition',
        'text' => 'A career decorated with honors, awards, and milestones that reflect a relentless pursuit of medical excellence and innovation in Indian neurology.',
        'items' => [
            ['icon' => 'fa-check', 'color' => 'electric-blue', 'title' => 'First Dedicated Stroke Centre in Gurgaon', 'text' => 'Established pioneering stroke protocols for the region'],
            ['icon' => 'fa-check', 'color' => 'electric-blue', 'title' => 'First Solo Mechanical Thrombolysis in the Region', 'text' => 'A breakthrough in advanced stroke intervention'],
            ['icon' => 'fa-check', 'color' => 'electric-blue', 'title' => 'First Deep Brain Stimulation in Gurugram', 'text' => 'Transforming treatment for movement disorders'],
            ['icon' => 'fa-check', 'color' => 'electric-blue', 'title' => 'First Epileptic DBS in Asia', 'text' => 'Setting a continental benchmark in epilepsy care'],
        ],
        'options' => [
            'title_html' => true, 'header_style' => 'line', 'items_style' => 'list', 'image_side' => 'left', 'image_aspect' => 'aspect-[3/4]', 'container' => 'max-w-6xl',
            'title_class' => 'text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-5 leading-tight',
            'accent_images' => [['image' => 'assets/awards/1.jpg', 'alt' => 'Award'], ['image' => 'assets/awards/3.jpg', 'alt' => 'Award']],
        ],
        'wrap' => ['bg' => 'bg-white', 'padding' => 'py-14 lg:py-20', 'class' => 'overflow-hidden'],
    ],
    'awards-gallery' => [
        'type' => 'collection-grid', 'label' => 'Awards gallery', 'collection' => 'awards', 'variant' => 'awards-tiles',
        'badge' => 'Gallery',
        'title' => 'Moments of <span class="gradient-text">Recognition</span>',
        'description' => 'A curated glimpse into the awards, honors, and milestones that have shaped a career dedicated to neurological excellence.',
        'button_text' => 'View All Recognitions', 'button_url' => 'awards-and-recognition',
        'options' => ['title_html' => true],
    ],
    'vision' => [
        'type' => 'quote', 'label' => 'Vision quote',
        'badge' => 'Vision',
        'title' => 'Technology with <span class="gradient-text">Empathy</span>',
        'text' => 'Integrating technology with empathy — ensuring every patient receives personalized, evidence-based treatment aimed at improving quality of life.',
        'description' => "As one of India's leading neurologists, Dr. Gupta's vision extends beyond treatment — focusing on awareness, prevention, and rehabilitation to make advanced neurological therapies more accessible and affordable.",
        'options' => ['title_html' => true],
    ],
    'testimonials' => [
        'type' => 'testimonials', 'label' => 'Patient testimonials slider', 'variant' => 'slider',
        'badge' => 'Testimonials',
        'title' => 'What Patients <span class="gradient-text">Say</span>',
        'options' => ['title_html' => true],
    ],
    'main-body' => ['type' => 'intro', 'label' => 'Main Body Section Content', 'options' => ['layout' => 'split']],
];

/* ------------------------------------------------ why-choose-dr-praveen-gupta */
$pages['why-choose-dr-praveen-gupta'] = [
    '_flow' => true,
    'leadership' => [
        'type' => 'stats', 'label' => 'Clinical Leadership & Experience', 'variant' => 'split',
        'badge' => 'Clinical Excellence',
        'title' => 'Pioneering Neurological Treatments with a Human Touch',
        'description' => 'Dr. Praveen Gupta is recognized as a leader in neurology, serving as the Chairman of Marengo Asia Neuro & Spine Institute. He is widely praised for his diagnostic precision and comprehensive treatment planning.',
        'bullets' => [
            '<strong class="text-deep-indigo">Advanced Stroke Management:</strong> First to offer mechanical thrombectomy services in Gurgaon, ensuring life-saving intervention.',
            '<strong class="text-deep-indigo">Comprehensive Specialty Care:</strong> Deep expertise across epilepsy, movement disorders, multiple sclerosis, and neuropathic pain management.',
            '<strong class="text-deep-indigo">Holistic Rehabilitation:</strong> Combines medical treatment with physical, speech, and occupational therapies to achieve outstanding recovery rates.',
        ],
        'items' => [
            ['icon' => 'none', 'title' => $stat('20+', 'stats_experience'), 'subtitle' => 'Years of Experience', 'text' => 'Providing expert medical diagnosis and advanced neurological care.'],
            ['icon' => 'none', 'title' => $stat('500K+', 'stats_patients'), 'subtitle' => 'Patients Served', 'text' => 'Trusted by half a million patients whose lives and health are our priority.'],
            ['icon' => 'none', 'title' => '1st', 'subtitle' => 'DBS in Gurugram', 'text' => "Pioneered Deep Brain Stimulation for Parkinson's disease in the region."],
            ['icon' => 'none', 'title' => '70+', 'subtitle' => 'Publications', 'text' => 'Actively contributing to global medical research with published papers.'],
        ],
    ],
    'milestones' => [
        'type' => 'cards', 'label' => 'Key Clinical Milestones',
        'badge' => 'Milestones',
        'title' => 'Pioneering Milestones & Leadership',
        'description' => 'A legacy of innovation, clinical execution, and dedication to pushing boundaries in medical science.',
        'items' => [
            ['icon' => 'fa-brain', 'color' => 'electric-blue', 'title' => 'First DBS in Gurgaon', 'text' => "Successfully introduced Deep Brain Stimulation (DBS) to Gurugram, offering dramatic symptomatic relief for advanced Parkinson's disease."],
            ['icon' => 'fa-heartbeat', 'color' => 'cyan-accent', 'title' => '24/7 Stroke Protocols', 'text' => 'Developed unified stroke codes and rapid response protocols that have saved thousands of patients during the critical golden hour of brain stroke.'],
            ['icon' => 'fa-microscope', 'color' => 'deep-indigo', 'title' => 'Clinical Research Hub', 'text' => 'Over 70 peer-reviewed articles and clinical trials published globally in standard neurology literature, advancing neurology diagnostics.'],
        ],
        'options' => [
            'header_margin' => 'mb-12', 'badge_class' => 'text-cyan-accent font-bold text-xs uppercase tracking-wider',
            'grid' => 'grid md:grid-cols-3 gap-8',
            'card_class' => 'bg-white p-8 rounded-3xl shadow-sm border border-silver-grey/30 space-y-4',
            'item_title_class' => 'text-lg font-bold text-deep-indigo',
            'item_text_class' => 'text-xs text-dark-grey/65 leading-relaxed',
        ],
        'wrap' => ['bg' => 'bg-slate-50', 'padding' => 'py-16', 'class' => 'border-t border-b border-silver-grey/40'],
    ],
    'philosophy' => [
        'type' => 'split-panel', 'label' => 'Patient-First Philosophy + Quick Appointment card',
        'badge' => 'Patient Care Philosophy',
        'title' => 'Treating the Person, Not Just the Symptoms',
        'text' => "We believe that successful treatment starts with listening, empathy, and transparent communication. Every neurological condition affects people differently, which is why we build tailored care plans designed around each patient's unique lifestyle and diagnostic profile.",
        'items' => [
            ['title' => 'Tailored Treatment Plans', 'text' => 'No generic prescriptions. We analyze your genetic background, daily activities, and rehabilitation limits.'],
            ['title' => 'Accessible Communication', 'text' => 'Clear terminology, thorough breakdowns of test results, and clear guidance for caregivers.'],
            ['title' => 'Multidisciplinary Support', 'text' => 'Seamless integration with occupational therapists, dietitians, and pain management experts.'],
            ['title' => 'Dedicated Follow-up', 'text' => 'Continuous post-consultation care and monitoring to adapt plans as healing progresses.'],
        ],
        'panel_title' => 'Quick Appointment',
        'panel_text' => 'Schedule a clinical consultation with Dr. Praveen Gupta. Outstation and international cases are fast-tracked for prompt diagnostic evaluations.',
        'button_text' => 'Book Appointment Online', 'button_url' => 'contact-us-top-neurologist-delhi-ncr',
        'options' => ['show_phone' => true, 'show_email' => true, 'title_class' => 'text-3xl font-bold text-deep-indigo font-serif'],
    ],
    'main-body' => ['type' => 'intro', 'label' => 'Main Body Section Content', 'options' => ['layout' => 'split']],
];

/* ------------------------------------------------------------------- team */
$pages['team'] = [
    '_flow' => true,
    'leadership' => [
        'type' => 'team-grid', 'label' => 'Clinical Director', 'variant' => 'leader',
        'badge' => 'Leadership', 'title' => 'Clinical Director',
        'button_text' => 'Why Choose Dr. Praveen', 'button_url' => 'why-choose-dr-praveen-gupta',
    ],
    'specialists' => [
        'type' => 'team-grid', 'label' => 'Specialty & Rehabilitation Team', 'variant' => 'grid',
        'badge' => 'Associate Specialists', 'title' => 'Specialty & Rehabilitation Team',
        'description' => 'Our specialists provide dedicated diagnostics, care, and recovery assistance.',
    ],
    'coordination' => [
        'type' => 'split-panel', 'label' => 'Patient coordination + contact card',
        'badge' => 'Patient Coordination',
        'title' => 'Seamless Patient Experience Support',
        'text' => 'Our patient coordinators are dedicated to easing your journey, managing schedules, coordinating diagnostic tests, handling outstation or international cases, and providing emergency helpline coordination.',
        'items' => [
            ['title' => 'Appointment Scheduling', 'text' => 'Assists with booking slots for in-person, online, and emergency evaluations.'],
            ['title' => 'Emergency Coordination', 'text' => 'Helps dispatch stroke ambulance codes and coordinates with emergency ICU teams.'],
        ],
        'panel_title' => 'Contact Coordination',
        'panel_text' => 'Have questions about consultation slots, documentation, or outstation visits? Get in touch with our team.',
        'options' => ['show_phone' => true, 'point_text_class' => 'text-sm text-dark-grey/65 leading-relaxed', 'panel_text_class' => 'text-sm text-white/80 leading-relaxed'],
    ],
    'main-body' => ['type' => 'intro', 'label' => 'Main Body Section Content', 'options' => ['layout' => 'split']],
];

/* ------------------------------------------------- awards-and-recognition */
$pages['awards-and-recognition'] = [
    '_flow' => true,
    'gallery' => [
        'type' => 'collection-grid', 'label' => 'Honors gallery', 'collection' => 'awards', 'variant' => 'cards',
        'badge' => 'Honors Gallery',
        'title' => 'Clinical Milestones & Awards',
        'description' => 'A visual showcase of awards, academic commendations, and recognitions received by Dr. Praveen Gupta.',
        'options' => ['header_style' => 'plain'],
        'wrap' => ['padding' => 'py-16'],
    ],
    'accreditations' => [
        'type' => 'split-panel', 'label' => 'Certifications & Accreditations + credentials card',
        'badge' => 'Professional Status',
        'title' => 'Certifications & Accreditations',
        'text' => 'Over his distinguished career, Dr. Praveen Gupta has established high clinical standards in neurology, leading specialized care initiatives at premier hospitals across India.',
        'items' => [
            ['title' => 'Director of Neurology:', 'text' => 'Chairman position leading critical care neuro services.'],
            ['title' => 'National Board Certified:', 'text' => 'Board certified specialist with credentials matching global care indices.'],
        ],
        'panel_title' => 'Clinical Credentials',
        'panel_text' => 'For detailed reviews of published research, clinical cases, or academic lectures, please consult our dedicated medical resources hubs.',
        'button_text' => 'Book Consultation', 'button_url' => 'contact-us-top-neurologist-delhi-ncr',
        'options' => ['point_style' => 'check', 'title_class' => 'text-3xl font-bold text-deep-indigo font-serif'],
        'wrap' => ['bg' => 'bg-slate-50', 'class' => 'border-t border-b border-silver-grey/40'],
    ],
];

/* --------------------------------------------- page JSON: breadcrumbs, icons */
$pageMeta = [
    'about' => ['breadcrumb_label' => 'About', 'hero_icon' => ''],
    'why-choose-dr-praveen-gupta' => ['breadcrumb_label' => 'Why Choose Us', 'hero_icon' => 'fa-award'],
    'team' => ['breadcrumb_label' => 'Our Team', 'hero_icon' => 'fa-users'],
    'awards-and-recognition' => ['breadcrumb_label' => 'Awards & Recognition', 'hero_icon' => 'fa-award'],
];

foreach ($pages as $slug => $def) {
    echo $slug . ': ' . implode(' → ', array_keys(array_filter($def, function ($v, $k) { return $k[0] !== '_'; }, ARRAY_FILTER_USE_BOTH))) . "\n";
}

if (!$write) {
    echo "(dry run)\n";
    exit;
}

foreach ($pages as $slug => $def) {
    $all[$slug] = $def;
}
file_put_contents($blocksFile, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");

foreach ($pageMeta as $slug => $meta) {
    $file = $root . '/data/pages/' . $slug . '.json';
    $page = is_file($file) ? (json_decode(file_get_contents($file), true) ?: []) : ['slug' => $slug];
    foreach ($meta as $k => $v) {
        if (trim((string)($page[$k] ?? '')) === '' && $v !== '') {
            $page[$k] = $v;
        }
    }
    file_put_contents($file, json_encode($page, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
}

// Why-choose hero button → CMS "Buttons" (page-ctas registry per-page default).
$ctasFile = $root . '/data/page-ctas.json';
$ctas = json_decode(file_get_contents($ctasFile), true);
if (!isset($ctas['pages']['why-choose-dr-praveen-gupta']['hero-primary'])) {
    $ctas['pages']['why-choose-dr-praveen-gupta']['hero-primary'] = ['text' => 'Book a Consultation', 'url' => 'contact-us-top-neurologist-delhi-ncr'];
    file_put_contents($ctasFile, json_encode($ctas, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
}
echo "written\n";
