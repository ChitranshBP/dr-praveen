<?php
/**
 * Site Configuration
 * Dr. Praveen Gupta - Official Website
 */

// Safe JSON readers for everything the /cms admin panel writes
require_once __DIR__ . '/cms-load.php';

// Editable page blocks (Techniques / What to Expect / etc.)
require_once __DIR__ . '/page-blocks.php';

// Editable CTA buttons (hero / diagnosis / final CTA / emergency …)
require_once __DIR__ . '/page-ctas.php';

// Hero breadcrumb trail (labels/parents from each page's SEO card)
require_once __DIR__ . '/breadcrumb.php';


// Load dynamic settings from CMS if present
$cmsSettingsFile = dirname(__DIR__) . '/data/settings.json';
$cmsSettings = [];
if (file_exists($cmsSettingsFile)) {
    $cmsSettings = json_decode(file_get_contents($cmsSettingsFile), true) ?: [];
}

// Site Information
define('SITE_NAME', $cmsSettings['site_name'] ?? 'Dr. Praveen Gupta');
define('SITE_TAGLINE', $cmsSettings['site_tagline'] ?? 'Excellence in Healthcare');
define('SITE_URL', $cmsSettings['site_url'] ?? 'https://drpraveengupta.com');
define('SITE_PHONE', $cmsSettings['phone'] ?? '+91-87969-77903');
define('STROKE_HELPLINE', $cmsSettings['stroke_helpline'] ?? '1800-309-0247');
define('SITE_EMAIL', $cmsSettings['email'] ?? 'contact@drpraveengupta.com');
define('SITE_ADDRESS', $cmsSettings['address'] ?? 'Marengo Asia Hospitals, Shushant Lok 2, Sector 56, Gurugram, Ghata, Haryana 122011');

// WhatsApp — digits only, country code first, no '+', spaces or dashes (wa.me format)
define('SITE_WHATSAPP', $cmsSettings['whatsapp'] ?? '918796977903');
define('WHATSAPP_MESSAGE', $cmsSettings['whatsapp_message'] ?? 'Hello, I would like to book an appointment with Dr. Praveen Gupta.');

// Social Media
define('SOCIAL_FACEBOOK', $cmsSettings['social_facebook'] ?? 'https://www.facebook.com/share/19sqHsTVmK/');
define('SOCIAL_INSTAGRAM', $cmsSettings['social_instagram'] ?? 'https://www.instagram.com/neurodocpg/');
define('SOCIAL_TWITTER', $cmsSettings['social_twitter'] ?? 'https://twitter.com/drpraveengupta');
define('SOCIAL_YOUTUBE', $cmsSettings['social_youtube'] ?? 'https://youtube.com/@neuro_doc');
define('SOCIAL_LINKEDIN', $cmsSettings['social_linkedin'] ?? 'https://www.linkedin.com/in/dr-praveen-gupta-635b9317');
define('GTM_ID', $cmsSettings['gtm_id'] ?? 'GTM-TF2TXQLK');

// Opening hours (CMS → Settings / Phone & Contact)
define('WORKING_HOURS_WEEKDAYS', trim((string)($cmsSettings['working_hours_weekdays'] ?? '')) !== '' ? $cmsSettings['working_hours_weekdays'] : 'Mon - Sat: 9 AM - 7 PM');
define('WORKING_HOURS_SUNDAY', trim((string)($cmsSettings['working_hours_sunday'] ?? '')) !== '' ? $cmsSettings['working_hours_sunday'] : 'Sunday: Closed');

// Navigation menus live in data/navigation.json (CMS → Navigation); see cms_navigation().

// Services - Loaded from CMS data if available
$cmsServicesFile = dirname(__DIR__) . '/data/services.json';
if (file_exists($cmsServicesFile)) {
    $rawServices = json_decode(file_get_contents($cmsServicesFile), true);
    if (!empty($rawServices) && is_array($rawServices)) {
        // Honour the display order chosen in CMS → Brain & Spine Cards.
        usort($rawServices, function ($a, $b) {
            return ((int)($a['order'] ?? 999)) <=> ((int)($b['order'] ?? 999));
        });
        $services = [];
        foreach ($rawServices as $s) {
            if (isset($s['is_active']) && !$s['is_active']) continue;
            
            $desc = $s['short_description'] ?? '';
            if (!empty($s['features']) && is_array($s['features'])) {
                $desc .= "\n" . '<details class="group mt-3" onclick="event.stopPropagation();">' . "\n";
                $desc .= '    <summary class="text-xs text-electric-blue font-bold cursor-pointer focus:outline-none select-none flex items-center space-x-1 hover:underline list-none [&::-webkit-details-marker]:hidden" onclick="event.stopPropagation();">' . "\n";
                $desc .= '        <span>Read More</span>' . "\n";
                $desc .= '        <i class="fas fa-chevron-down text-[9px] transition-transform duration-300 group-open:rotate-180"></i>' . "\n";
                $desc .= '    </summary>' . "\n";
                $desc .= '    <div class="mt-3 grid grid-cols-1 gap-y-1 text-xs text-dark-grey/70 border-t border-silver-grey/40 pt-3">' . "\n";
                foreach ($s['features'] as $feat) {
                    $desc .= '        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>' . htmlspecialchars(strip_tags((string)$feat)) . '</span></div>' . "\n";
                }
                $desc .= '    </div>' . "\n";
                $desc .= '</details>';
            }

            $services[] = [
                'title' => $s['title'] ?? '',
                'description' => $desc,
                'bullet' => $s['bullet'] ?? '',
                'image' => $s['image'] ?? 'assets/services/stroke-care.png',
                'webp' => $s['webp'] ?? '',
                'link' => $s['link'] ?? 'services',
                'alt' => $s['image_alt'] ?? $s['alt'] ?? ($s['title'] ?? 'Neurology Service'),
                'image_alt' => $s['image_alt'] ?? $s['alt'] ?? ($s['title'] ?? 'Neurology Service')
            ];
        }
    }
}

if (!isset($services)) {
    $services = [
    [
        'title' => 'Stroke & Neurocritical Care Unit',
        'description' => 'Advanced Stroke Care in Gurgaon.
<details class="group mt-3" onclick="event.stopPropagation();">
    <summary class="text-xs text-electric-blue font-bold cursor-pointer focus:outline-none select-none flex items-center space-x-1 hover:underline list-none [&::-webkit-details-marker]:hidden" onclick="event.stopPropagation();">
        <span>Read More</span>
        <i class="fas fa-chevron-down text-[9px] transition-transform duration-300 group-open:rotate-180"></i>
    </summary>
    <div class="mt-3 grid grid-cols-1 gap-y-1 text-xs text-dark-grey/70 border-t border-silver-grey/40 pt-3">
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Thrombolytic therapy</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Mechanical thrombectomy</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>24/7 stroke protocol</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Neurorehabilitation services</span></div>
    </div>
</details>',
        'bullet' => '',
        'image' => 'assets/services/stroke-care.png',
        'webp' => 'assets/webp/services/stroke-care.webp',
        'link' => 'brain-stroke-helpline'
    ],
    [
        'title' => 'Epilepsy & Seizure Clinic',
        'description' => 'Comprehensive seizure diagnosis and treatment.
<details class="group mt-3" onclick="event.stopPropagation();">
    <summary class="text-xs text-electric-blue font-bold cursor-pointer focus:outline-none select-none flex items-center space-x-1 hover:underline list-none [&::-webkit-details-marker]:hidden" onclick="event.stopPropagation();">
        <span>Read More</span>
        <i class="fas fa-chevron-down text-[9px] transition-transform duration-300 group-open:rotate-180"></i>
    </summary>
    <div class="mt-3 grid grid-cols-1 gap-y-1 text-xs text-dark-grey/70 border-t border-silver-grey/40 pt-3">
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Video EEG monitoring</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>24-hour ambulatory EEG</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Interictal and ictal SPECT</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Neuropsychological testing</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Epilepsy surgery evaluation</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Anti-seizure medication management</span></div>
    </div>
</details>',
        'bullet' => 'Video EEG monitoring',
        'image' => 'assets/services/epilepsy.png',
        'webp' => 'assets/webp/services/epilepsy.webp',
        'link' => 'epilepsy'
    ],
    [
        'title' => 'Brain Tumor Surgery',
        'description' => 'Precision neurosurgery using advanced imaging.
<details class="group mt-3" onclick="event.stopPropagation();">
    <summary class="text-xs text-electric-blue font-bold cursor-pointer focus:outline-none select-none flex items-center space-x-1 hover:underline list-none [&::-webkit-details-marker]:hidden" onclick="event.stopPropagation();">
        <span>Read More</span>
        <i class="fas fa-chevron-down text-[9px] transition-transform duration-300 group-open:rotate-180"></i>
    </summary>
    <div class="mt-3 grid grid-cols-1 gap-y-1 text-xs text-dark-grey/70 border-t border-silver-grey/40 pt-3">
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Minimally invasive tumor removal</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Intraoperative neuromonitoring</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Awake craniotomy</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Brain mapping technology</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Gamma Knife radiosurgery</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Oncology collaboration</span></div>
    </div>
</details>',
        'bullet' => 'Minimally invasive tumor removal',
        'image' => 'assets/services/brain-tumor.png',
        'webp' => 'assets/webp/services/brain-tumor.webp',
        'link' => 'brain-tumor-surgery'
    ],
    [
        'title' => 'Spine Surgery',
        'description' => 'Comprehensive care for spinal conditions.
<details class="group mt-3" onclick="event.stopPropagation();">
    <summary class="text-xs text-electric-blue font-bold cursor-pointer focus:outline-none select-none flex items-center space-x-1 hover:underline list-none [&::-webkit-details-marker]:hidden" onclick="event.stopPropagation();">
        <span>Read More</span>
        <i class="fas fa-chevron-down text-[9px] transition-transform duration-300 group-open:rotate-180"></i>
    </summary>
    <div class="mt-3 grid grid-cols-1 gap-y-1 text-xs text-dark-grey/70 border-t border-silver-grey/40 pt-3">
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Minimally invasive spine surgery</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Disc herniation treatment</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Spinal fusion procedures</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Vertebroplasty</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Endoscopic spine surgery</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Decompression surgery</span></div>
    </div>
</details>',
        'bullet' => 'Minimally invasive spine surgery',
        'image' => 'assets/services/spine-surgery.png',
        'webp' => 'assets/webp/services/spine-surgery.webp',
        'link' => 'spine-surgery'
    ],
    [
        'title' => 'Headache & Pain Clinic',
        'description' => 'Targeted care for migraines and chronic headaches.
<details class="group mt-3" onclick="event.stopPropagation();">
    <summary class="text-xs text-electric-blue font-bold cursor-pointer focus:outline-none select-none flex items-center space-x-1 hover:underline list-none [&::-webkit-details-marker]:hidden" onclick="event.stopPropagation();">
        <span>Read More</span>
        <i class="fas fa-chevron-down text-[9px] transition-transform duration-300 group-open:rotate-180"></i>
    </summary>
    <div class="mt-3 grid grid-cols-1 gap-y-1 text-xs text-dark-grey/70 border-t border-silver-grey/40 pt-3">
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Preventive therapies</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Botulinum toxin therapy</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Monoclonal antibody therapy</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Occipital nerve blocks</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>CGRP receptor antagonists</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Trigger point injections</span></div>
    </div>
</details>',
        'bullet' => 'Preventive therapies',
        'image' => 'assets/services/headache.png',
        'webp' => 'assets/webp/services/headache.webp',
        'link' => 'headache'
    ],
    [
        'title' => 'Functional Neurosurgery',
        'description' => 'Advanced surgical treatment for movement disorders.
<details class="group mt-3" onclick="event.stopPropagation();">
    <summary class="text-xs text-electric-blue font-bold cursor-pointer focus:outline-none select-none flex items-center space-x-1 hover:underline list-none [&::-webkit-details-marker]:hidden" onclick="event.stopPropagation();">
        <span>Read More</span>
        <i class="fas fa-chevron-down text-[9px] transition-transform duration-300 group-open:rotate-180"></i>
    </summary>
    <div class="mt-3 grid grid-cols-1 gap-y-1 text-xs text-dark-grey/70 border-t border-silver-grey/40 pt-3">
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Deep Brain Stimulation (DBS) for Parkinson\'s</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Tremor management</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Rigidity and bradykinesia treatment</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>DBS programming and adjustment</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Essential tremor surgery</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Dystonia treatment</span></div>
    </div>
</details>',
        'bullet' => 'Deep Brain Stimulation (DBS) for Parkinson\'s',
        'image' => 'assets/services/functional-neuro.png',
        'webp' => 'assets/webp/services/functional-neuro.webp',
        'link' => 'functional-neurosurgery'
    ],
    [
        'title' => 'Neurovascular Surgery',
        'description' => 'Treatment of complex vascular conditions.
<details class="group mt-3" onclick="event.stopPropagation();">
    <summary class="text-xs text-electric-blue font-bold cursor-pointer focus:outline-none select-none flex items-center space-x-1 hover:underline list-none [&::-webkit-details-marker]:hidden" onclick="event.stopPropagation();">
        <span>Read More</span>
        <i class="fas fa-chevron-down text-[9px] transition-transform duration-300 group-open:rotate-180"></i>
    </summary>
    <div class="mt-3 grid grid-cols-1 gap-y-1 text-xs text-dark-grey/70 border-t border-silver-grey/40 pt-3">
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Aneurysm clipping</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Aneurysm coiling</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>AVM (arteriovenous malformation) treatment</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Cavernous angioma surgery</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Intracranial stenting</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Endovascular procedures</span></div>
    </div>
</details>',
        'bullet' => 'Aneurysm clipping',
        'image' => 'assets/services/neurovascular.png',
        'webp' => 'assets/webp/services/neurovascular.webp',
        'link' => 'neurovascular-surgery'
    ],
    [
        'title' => 'Geriatric & Dementia Clinic',
        'description' => 'Care for dementia, Alzheimer\'s, and memory disorders.
<details class="group mt-3" onclick="event.stopPropagation();">
    <summary class="text-xs text-electric-blue font-bold cursor-pointer focus:outline-none select-none flex items-center space-x-1 hover:underline list-none [&::-webkit-details-marker]:hidden" onclick="event.stopPropagation();">
        <span>Read More</span>
        <i class="fas fa-chevron-down text-[9px] transition-transform duration-300 group-open:rotate-180"></i>
    </summary>
    <div class="mt-3 grid grid-cols-1 gap-y-1 text-xs text-dark-grey/70 border-t border-silver-grey/40 pt-3">
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Neuropsychological testing</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Cognitive screening and assessment</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Alzheimer\'s disease management</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Vascular dementia treatment</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Parkinson\'s dementia care</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Caregiver support programs</span></div>
    </div>
</details>',
        'bullet' => 'Neuropsychological testing',
        'image' => 'assets/services/memory-clinic.png',
        'webp' => 'assets/webp/services/memory-clinic.webp',
        'link' => 'memory-clinic'
    ],
    [
        'title' => 'Neuro-Rehabilitation Centre',
        'description' => 'Structured recovery programs after stroke, injury and surgery.
<details class="group mt-3" onclick="event.stopPropagation();">
    <summary class="text-xs text-electric-blue font-bold cursor-pointer focus:outline-none select-none flex items-center space-x-1 hover:underline list-none [&::-webkit-details-marker]:hidden" onclick="event.stopPropagation();">
        <span>Read More</span>
        <i class="fas fa-chevron-down text-[9px] transition-transform duration-300 group-open:rotate-180"></i>
    </summary>
    <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-x-3 gap-y-1 text-xs text-dark-grey/70 border-t border-silver-grey/40 pt-3">
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Neurological Physiotherapy</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Occupational Therapy</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Speech & Swallow Therapy</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Cognitive Rehabilitation</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>Psychological Support</span></div>
        <div class="col-span-1 sm:col-span-2 font-bold text-deep-indigo mt-2 text-[10px] uppercase tracking-wider">Advanced Technologies:</div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-circle text-[5px] text-cyan-accent"></i> <span>Robotic Rehabilitation</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-circle text-[5px] text-cyan-accent"></i> <span>rTMS Therapy</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-circle text-[5px] text-cyan-accent"></i> <span>VR Rehabilitation</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-circle text-[5px] text-cyan-accent"></i> <span>FES & EMG Biofeedback</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-circle text-[5px] text-cyan-accent"></i> <span>Mirror Therapy</span></div>
        <div class="flex items-center space-x-1.5"><i class="fas fa-circle text-[5px] text-cyan-accent"></i> <span>CIMT</span></div>
    </div>
</details>',
        'bullet' => 'Physiotherapy, speech and cognitive therapy',
        'image' => 'assets/services/rehab.png',
        'webp' => 'assets/webp/services/rehab.webp',
        'link' => 'neuro-rehabilitation-center'
    ]
];
}


// Prefer CMS-managed testimonials; fall back to the built-in list above.
// "Featured" reviews are listed first (stable: original order kept otherwise).
$cmsTestimonials = cms_testimonials();
$testimonials = $cmsTestimonials !== null ? $cmsTestimonials : [];
if (is_array($testimonials)) {
    $featuredFirst = [];
    $rest = [];
    foreach ($testimonials as $t) {
        if (!empty($t['featured'])) {
            $featuredFirst[] = $t;
        } else {
            $rest[] = $t;
        }
    }
    $testimonials = array_merge($featuredFirst, $rest);
}

// Prefer CMS-managed posts so the homepage shows what the admin wrote.
$cmsBlogPosts = cms_blogs_published();
if (!empty($cmsBlogPosts)) {
    $blogs = [];
    foreach ($cmsBlogPosts as $bp) {
        $bpDate = (string)($bp['date'] ?? '');
        $blogs[] = [
            'title'    => $bp['title'] ?? '',
            'excerpt'  => $bp['excerpt'] ?? '',
            'category' => $bp['category'] ?? 'Neurology',
            'date'     => $bpDate !== '' ? date('M j, Y', strtotime($bpDate)) : '',
            'image'    => $bp['image'] ?? 'assets/services/migraine.png',
            'url'      => 'blog/' . urlencode($bp['slug'] ?? ''),
            'slug'     => $bp['slug'] ?? '',
            'author'   => $bp['author'] ?? 'Dr. Praveen Gupta',
        ];
    }
} else {
    $blogs = [];
}

// CMS video testimonials (from /cms/testimonials.php) replace the fallback list
// as soon as at least one review carries a YouTube id.
$cmsVideos = cms_video_testimonials();
if ($cmsVideos !== null) {
    $videoTestimonials = [];
    foreach ($cmsVideos as $cv) {
        $videoTestimonials[] = [
            'id'    => $cv['video_id'],
            'title' => trim($cv['name'] . ($cv['condition'] !== '' ? ' — ' . $cv['condition'] : '')),
        ];
    }
} else {
    $videoTestimonials = [];
}

// Link mapping helper for service details pages
function getServicePageLink($title) {
    $titleLower = strtolower($title);
    if (strpos($titleLower, 'tumor') !== false) {
        return 'brain-tumor-surgery';
    } elseif (strpos($titleLower, 'spine') !== false) {
        return 'spine-surgery';
    } elseif (strpos($titleLower, 'functional') !== false) {
        return 'functional-neurosurgery';
    } elseif (strpos($titleLower, 'neurovascular') !== false) {
        return 'neurovascular-surgery';
    } elseif (strpos($titleLower, 'geriatric') !== false || strpos($titleLower, 'dementia') !== false || strpos($titleLower, 'memory') !== false) {
        return 'memory-clinic';
    } elseif (strpos($titleLower, 'epilepsy') !== false) {
        return 'epilepsy';
    } elseif (strpos($titleLower, 'headache') !== false) {
        return 'headache';
    } elseif (strpos($titleLower, 'migraine') !== false) {
        return 'migraine';
    } elseif (strpos($titleLower, 'stroke') !== false || strpos($titleLower, 'neurocritical') !== false) {
        return 'brain-stroke-helpline';
    } elseif (strpos($titleLower, 'rehabilitation') !== false) {
        return 'neuro-rehabilitation-center';
    } elseif (strpos($titleLower, 'rtms') !== false) {
        return 'rtms-therapy';
    } elseif (strpos($titleLower, 'vertigo') !== false) {
        return 'vertigo';
    } elseif (strpos($titleLower, 'parkinson') !== false) {
        return 'parkinsons';
    } elseif (strpos($titleLower, 'multiple sclerosis') !== false || $titleLower === 'ms') {
        return 'ms';
    } elseif (strpos($titleLower, 'movement') !== false) {
        return 'movement';
    } elseif (strpos($titleLower, 'neuropathy') !== false) {
        return 'neuropathy';
    }
    return 'services';
}

/**
 * CMS Page Content Helper
 * Dynamically loads customized page text, headings, and images from data/pages/{slug}.json
 */
function get_page_content($slug, $defaults = []) {
    $cleanSlug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
    $dataFile = dirname(__DIR__) . '/data/pages/' . $cleanSlug . '.json';
    if (file_exists($dataFile)) {
        $data = json_decode(file_get_contents($dataFile), true);
        if (is_array($data)) {
            // The catalog auto-seeded generic eyebrow labels such as
            // "Conditions Guide" onto every page. Fall back to the template's
            // own label instead of printing those placeholders on the site.
            $genericBadges = [
                'General Guide', 'Conditions Guide', 'Services Guide',
                'Patient Info Guide', 'About Doctor Guide', 'Media & Blog Guide',
                'Media Guide', 'Blog Guide', 'Contact & Legal Guide',
            ];
            if (
                isset($data['hero_badge'])
                && array_key_exists('hero_badge', $defaults)
                && in_array(trim((string)$data['hero_badge']), $genericBadges, true)
            ) {
                unset($data['hero_badge']);
            }
            return array_merge($defaults, $data);
        }
    }
    return $defaults;
}

/**
 * CMS Content & Hyperlink Renderer
 * Converts markdown links [Anchor Text](/url) and preserves safe HTML tags (<a>, <strong>, <em>, <span>, etc.)
 */
function cms_render_html($content) {
    if ($content === null || $content === '') {
        return '';
    }
    
    // 1. Convert markdown-style links: [Link Text](url) or [Link Text](url "title")
    $content = preg_replace_callback(
        '/\[([^\]]+)\]\((https?:\/\/[^\s\)\"]+|\/[^\s\)\"]+|tel:[^\s\)\"]+|mailto:[^\s\)\"]+)(?:\s+\"([^\"]+)\")?\)/i',
        function ($matches) {
            $text = $matches[1];
            $url  = $matches[2];
            $title = !empty($matches[3]) ? ' title="' . htmlspecialchars($matches[3], ENT_QUOTES) . '"' : '';
            $isExternal = preg_match('/^https?:\/\//i', $url) && strpos($url, 'drpraveengupta.com') === false;
            $targetRel = $isExternal ? ' target="_blank" rel="noopener noreferrer"' : '';
            return '<a href="' . htmlspecialchars($url, ENT_QUOTES) . '" class="text-electric-blue hover:text-cyan-accent underline decoration-cyan-accent/50 hover:decoration-cyan-accent transition-colors font-medium"' . $title . $targetRel . '>' . $text . '</a>';
        },
        $content
    );

    // 2. Add smooth default styles to standard <a ...> tags if class is missing
    $content = preg_replace_callback('/<a\s+(?!.*?class=)([^>]+)>(.*?)<\/a>/is', function($matches) {
        $attrs = $matches[1];
        $text  = $matches[2];
        $isExternal = (stripos($attrs, 'http://') !== false || stripos($attrs, 'https://') !== false) && stripos($attrs, 'drpraveengupta.com') === false;
        $targetRel = $isExternal && stripos($attrs, 'target=') === false ? ' target="_blank" rel="noopener noreferrer"' : '';
        return '<a class="text-electric-blue hover:text-cyan-accent underline decoration-cyan-accent/50 hover:decoration-cyan-accent transition-colors font-medium" ' . trim($attrs) . $targetRel . '>' . $text . '</a>';
    }, $content);

    // 3. Convert Quill alignment classes to Tailwind text alignment
    $content = str_replace(
        ['class="ql-align-center"', 'class="ql-align-right"', 'class="ql-align-justify"'],
        ['class="text-center"', 'class="text-right"', 'class="text-justify"'],
        $content
    );

    // 4. Style Quill video embeds and images
    $content = preg_replace_callback('/<iframe([^>]+src=["\']([^"\']+)["\'][^>]*)><\/iframe>/is', function($matches) {
        $attrs = $matches[1];
        return '<div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-lg my-6 bg-slate-900"><iframe class="absolute inset-0 w-full h-full border-0" ' . trim($attrs) . ' allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
    }, $content);

    $content = preg_replace_callback('/<img\s+([^>]+)>/is', function($matches) {
        $attrs = $matches[1];
        if (stripos($attrs, 'class=') === false) {
            return '<img class="rounded-2xl max-w-full h-auto my-4 shadow-md border border-slate-100" ' . trim($attrs) . '>';
        }
        return '<img ' . trim($attrs) . '>';
    }, $content);

    // 5. Allow safe rich formatting tags
    $allowedTags = '<a><span><strong><b><em><i><br><p><mark><ul><ol><li><u><s><del><div><small><h2><h3><h4><h5><h6><blockquote><iframe><video><source><img><pre><code><hr>';
    $sanitized = strip_tags($content, $allowedTags);

    // 6. If content is plain text without HTML block tags, convert newlines to <br>
    if (strpos($sanitized, '<p>') === false && strpos($sanitized, '<br') === false && strpos($sanitized, '<div') === false && strpos($sanitized, '<h') === false && strpos($sanitized, '<ul') === false) {
        $sanitized = nl2br($sanitized);
    }

    return $sanitized;
}

/**
 * Resolve a public asset path, returning the fallback when the file is missing.
 * Handles URL-encoded paths (e.g. "My%20Image.png") without changing the URL
 * that is eventually printed into the page.
 */
function cms_media_path($path, $fallback = '') {
    $root = dirname(__DIR__);

    $resolve = static function ($value) use ($root) {
        $value = trim((string)$value);
        if ($value === '') {
            return '';
        }
        if (preg_match('#^(https?:)?//#i', $value) || strpos($value, 'data:') === 0) {
            return $value;
        }

        $relative = ltrim(preg_replace('#^/+#', '', $value), '/');
        if (strpos($relative, '..') !== false) {
            return '';
        }

        foreach (array_unique([$relative, rawurldecode($relative)]) as $candidate) {
            $check = preg_split('/[?#]/', $candidate, 2)[0];
            if ($check !== '' && is_file($root . '/' . $check)) {
                return $value;
            }
        }
        return '';
    };

    $resolved = $resolve($path);
    return $resolved !== '' ? $resolved : $resolve($fallback);
}

/**
 * Site logo chosen in CMS → Settings, with the built-in NeuroDoc logo as the
 * fallback. Returns ['path' => ..., 'webp' => ...] where webp is '' when no
 * matching .webp sibling exists next to the chosen file.
 */
function cms_site_logo() {
    static $logo = null;
    if ($logo !== null) {
        return $logo;
    }
    global $cmsSettings;
    $path = cms_media_path($cmsSettings['logo_path'] ?? '', 'assets/logo/NeuroDoc-final-logo.png');
    if ($path === '') {
        $path = 'assets/logo/NeuroDoc-final-logo.png';
    }
    $webp = '';
    if (!preg_match('#^(https?:)?//#i', $path)) {
        $candidate = preg_replace('/\.(png|jpe?g)$/i', '.webp', $path);
        if ($candidate !== $path && is_file(dirname(__DIR__) . '/' . ltrim($candidate, '/'))) {
            $webp = $candidate;
        }
    }
    $logo = ['path' => $path, 'webp' => $webp];
    return $logo;
}

/**
 * Resolve the CMS "Main Body Section" fields for a page.
 *
 * The catalog generator used to seed every page with placeholder copy such as
 * "Expert Clinical Approach to ...". Those values must not replace the real
 * section that is hard-coded in a template, otherwise every page turns into
 * generic boilerplate. A field is used only once an editor has changed it.
 */
function get_page_section($pageContent, $defaults = [], $markUsed = true) {
    if ($markUsed) {
        // Lets includes/footer.php know this template already rendered its own
        // body section, so it must not print the generic CMS section again.
        $GLOBALS['cms_page_section_used'] = true;
    }

    $resolved = cms_section_resolve(is_array($pageContent) ? $pageContent : [], $defaults);

    return [
        'badge' => $resolved['badge'],
        'title' => $resolved['title'],
        'text' => $resolved['text'],
        'image' => cms_media_path($resolved['image'], $defaults['image'] ?? ''),
        'image_alt' => $resolved['image_alt'],
    ];
}

/**
 * Render the paragraphs of a CMS section. Plain text is split on blank lines
 * and wrapped in the standard body-paragraph classes; rich HTML is passed
 * through the normal CMS renderer unchanged.
 */
function cms_section_paragraphs($text, $class = 'text-dark-grey/70 leading-relaxed', $lastMargin = 'mb-8') {
    $text = trim((string)$text);
    if ($text === '') {
        return '';
    }

    if (preg_match('/<(p|div|h[1-6]|ul|ol|blockquote)\b/i', $text)) {
        return cms_render_html($text);
    }

    $paras = preg_split('/\n\s*\n/', $text);
    $paras = array_values(array_filter($paras, function ($p) {
        return trim($p) !== '';
    }));

    $out = '';
    $count = count($paras);
    foreach ($paras as $i => $para) {
        $margin = ($i === $count - 1) ? $lastMargin : 'mb-6';
        $out .= '<p class="' . htmlspecialchars(trim($class . ' ' . $margin), ENT_QUOTES) . '">'
              . cms_render_html($para) . '</p>' . "
";
    }
    return $out;
}


