<?php
/**
 * Site Configuration
 * Dr. Praveen Gupta - Official Website
 */

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
define('SOCIAL_FACEBOOK', $cmsSettings['social_facebook'] ?? 'https://facebook.com/drpraveengupta');
define('SOCIAL_INSTAGRAM', $cmsSettings['social_instagram'] ?? 'https://instagram.com/neuro_doc1');
define('SOCIAL_TWITTER', $cmsSettings['social_twitter'] ?? 'https://twitter.com/drpraveengupta');
define('SOCIAL_YOUTUBE', $cmsSettings['social_youtube'] ?? 'https://youtube.com/c/DrPraveenGupta');
define('SOCIAL_LINKEDIN', $cmsSettings['social_linkedin'] ?? 'https://linkedin.com/in/drpraveengupta');
define('GTM_ID', $cmsSettings['gtm_id'] ?? 'GTM-TF2TXQLK');

// Navigation
$navItems = [
    ['name' => 'Home', 'url' => 'index'],
    ['name' => 'About', 'url' => '#', 'children' => [
        ['name' => 'About Dr Praveen', 'url' => 'about'],
        ['name' => 'Why Choose Us', 'url' => 'why-choose-dr-praveen-gupta'],
        ['name' => 'Our Team', 'url' => 'team'],
        ['name' => 'Awards & Honors', 'url' => 'awards-and-recognition'],
    ]],
    // 'viewAll' => true renders the item as a highlighted link pinned to the
    // bottom of the dropdown, separated from the list above it.
    ['name' => 'Services', 'url' => '#', 'children' => [
        ['name' => 'Brain Tumor Surgery', 'url' => 'brain-tumor-surgery'],
        ['name' => 'Spine Surgery', 'url' => 'spine-surgery'],
        ['name' => 'Functional Neurosurgery', 'url' => 'functional-neurosurgery'],
        ['name' => 'Neurovascular Surgery', 'url' => 'neurovascular-surgery'],
        ['name' => 'Memory Clinic', 'url' => 'memory-clinic'],
        ['name' => 'Rehabilitation Hub', 'url' => 'neuro-rehabilitation-center'],
        ['name' => 'Brain Health Hub', 'url' => 'brain-health-center'],
        ['name' => 'Neurocritical Care', 'url' => 'neurocritical-acute-stroke-care'],
        ['name' => 'rTMS Therapy', 'url' => 'rtms-therapy'],
        ['name' => 'View All Services', 'url' => 'services', 'viewAll' => true],
    ]],
    ['name' => 'Conditions', 'url' => '#', 'children' => [
        ['name' => 'Epilepsy', 'url' => 'epilepsy'],
        ['name' => 'Headache', 'url' => 'headache'],
        ['name' => 'Migraine', 'url' => 'migraine'],
        ['name' => 'Stroke', 'url' => 'stroke'],
        ['name' => 'Vertigo', 'url' => 'vertigo'],
        ['name' => 'Parkinson\'s Disease', 'url' => 'parkinsons'],
        ['name' => 'Multiple Sclerosis', 'url' => 'ms'],
        ['name' => 'Movement Disorders', 'url' => 'movement'],
        ['name' => 'Peripheral Neuropathy', 'url' => 'neuropathy'],
        ['name' => 'View All Conditions', 'url' => 'neurological-conditions', 'viewAll' => true],
    ]],
    ['name' => 'Patient Info', 'url' => '#', 'children' => [
        ['name' => 'Patient Info', 'url' => 'patient-info'],
        ['name' => 'Consultation Guide', 'url' => 'neurology-consultation'],
        ['name' => 'Online Consultation', 'url' => 'online-neurologist-consultation'],
        ['name' => 'Second Opinion', 'url' => 'neurology-second-opinion'],
        ['name' => 'Emergency Care', 'url' => 'emergency-neurology-care'],
        ['name' => 'Stroke Helpline', 'url' => 'brain-stroke-helpline'],
        ['name' => 'Patient Testimonials', 'url' => 'neurology-patient-testimonials'],
        ['name' => 'Success Stories', 'url' => 'patient-success-stories'],
        ['name' => 'Case Studies', 'url' => 'case-studies'],
        ['name' => 'Google Reviews', 'url' => 'patient-reviews'],
        ['name' => 'FAQs', 'url' => 'neurology-faqs'],
    ]],
    ['name' => 'Media', 'url' => '#', 'children' => [
        ['name' => 'Videos Hub', 'url' => 'videos'],
        ['name' => 'Education Videos', 'url' => 'neurology-video-library'],
        ['name' => 'Video Testimonials', 'url' => 'video-testimonials'],
        ['name' => 'Media Coverage', 'url' => 'media-coverage'],
        ['name' => 'Photo Gallery', 'url' => 'gallery'],
    ]],
    ['name' => 'Blog', 'url' => 'dr-praveen-gupta-blog'],
];

// Services - Loaded from CMS data if available
$cmsServicesFile = dirname(__DIR__) . '/data/services.json';
if (file_exists($cmsServicesFile)) {
    $rawServices = json_decode(file_get_contents($cmsServicesFile), true);
    if (!empty($rawServices) && is_array($rawServices)) {
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
                    $desc .= '        <div class="flex items-center space-x-1.5"><i class="fas fa-check text-[8px] text-electric-blue"></i> <span>' . htmlspecialchars($feat) . '</span></div>' . "\n";
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
                'link' => $s['link'] ?? 'services'
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

// Stats
$stats = [
    [
        'number' => '3,00,000+',
        'label' => 'Patients Treated',
        'icon' => 'fas fa-user-group',
        'description' => 'We take pride in the trust of over 300,000 patients whose health and recovery remain our top priorities.'
    ],
    [
        'number' => '1,00,000+',
        'label' => 'Success Stories',
        'icon' => 'fas fa-face-smile',
        'description' => 'Documenting over 100,000 patient success stories driven by advanced neuro-clinical treatments.'
    ],
    [
        'number' => '50+',
        'label' => 'Global Awards',
        'icon' => 'fas fa-award',
        'description' => 'Recognized globally with prestigious awards for pioneering achievements in neurosciences.'
    ],
    [
        'number' => '20+',
        'label' => 'Years of Experience',
        'icon' => 'fas fa-user-doctor',
        'description' => 'Providing over two decades of expert clinical diagnosis, treatment, and neurological care.'
    ],
];

// Testimonials
$testimonials = [
    [
        'name' => 'Atul Saxena',
        'role' => 'Patient\'s Son',
        'message' => 'I would like to express my heartfelt gratitude to Dr. Praveen Gupta and his outstanding team for the exceptional care during my mother\'s treatment for acute neuropathy. Dr. Gupta\'s clinical expertise, calm approach, and ability to explain every aspect of the treatment gave our family immense confidence. I would also like to make a special mention of Dr. Piyush Ojha, whose prompt assessment and accurate initial diagnosis played a crucial role.',
        'rating' => 5
    ],
    [
        'name' => 'Yashu Jindal',
        'role' => 'Patient\'s Son',
        'message' => 'We are extremely grateful to Dr. Praveen Gupta for the exceptional care and treatment provided to my father during his brain stroke surgery. From the very beginning, Dr. Gupta guided us with confidence, clarity, and compassion during a very difficult time for our family. It has now been 6 months, and we have seen continuous improvement and a smooth recovery.',
        'rating' => 5
    ],
    [
        'name' => 'Dheeraj Tiwari',
        'role' => 'Patient',
        'message' => 'Really good experience at Dr. Praveen Gupta\'s clinic. My vertigo and dizziness improved a lot. My condition was explained in a way I could easily understand. I felt much better after following the treatment. A very neat and well-maintained clinic. Highly recommended.',
        'rating' => 5
    ],
    [
        'name' => 'Jyoti Singh',
        'role' => 'Patient\'s Family',
        'message' => 'My family member was admitted under Dr. Praveen Gupta and we are very thankful for the excellent treatment and attention provided throughout the stay. The doctor regularly monitored the patient\'s condition, explained progress clearly, and addressed all our concerns with patience and professionalism. Outstanding IPD care.',
        'rating' => 5
    ],
    [
        'name' => 'Syed Mazhar Kandhlavi',
        'role' => 'Patient',
        'message' => 'Dr. Praveen Gupta is a brilliant, empathetic, and very supportive physician. I struggled with a neurological disorder for a decade, but under his care, I was completely cured in 10 days. He is genuinely an embodiment of compassion and healing.',
        'rating' => 5
    ],
    [
        'name' => 'Vandana Gera',
        'role' => 'Patient',
        'message' => 'I am extremely grateful to Dr. Praveen Gupta for the exceptional care and attention throughout my treatment. The diagnosis was made after thorough and well-planned investigations, and treatment was started at the right time, making a significant difference. The empathy, responsiveness, and genuine effort were deeply reassuring.',
        'rating' => 5
    ],
    [
        'name' => 'Anjali Tanwar',
        'role' => 'Patient',
        'message' => 'My heartfelt thanks to Dr. Praveen Gupta and his entire team for the exceptional care and treatment I received after my blackout episode. Every test and evaluation was conducted promptly and thoroughly to identify the root cause, and I was guided through each step with patience, reassurance, and compassion.',
        'rating' => 5
    ],
    [
        'name' => 'Pragya Chaudhary',
        'role' => 'Patient',
        'message' => 'I had been battling a severe fever, and the toll was becoming overwhelming. From my very first consultation, Dr. Gupta demonstrated a remarkable blend of medical expertise and genuine compassion. He listened carefully, answered concerns, and explained the rationale behind the prescription. I highly recommend him.',
        'rating' => 5
    ],
    [
        'name' => 'Manjit Singh',
        'role' => 'Patient',
        'message' => 'I would like to express my heartfelt gratitude to Dr. Praveen Gupta for his exceptional care and dedication. His vast knowledge, calm nature, and ability to patiently listen give immense confidence. One of the most remarkable things is that he is always reachable and responds on time when needed.',
        'rating' => 5
    ],
    [
        'name' => 'Seema Saini',
        'role' => 'Patient\'s Wife',
        'message' => 'My husband had been suffering from epilepsy for the last 3 years. Dr. Praveen Gupta told me in our very first meeting that my husband would get well, and the results are better now. My husband is doing well. Thank you, Sir.',
        'rating' => 5
    ],
];

// Blog Posts
$blogs = [
    [
        'title'    => 'Understanding Migraine: Causes & Modern Treatments',
        'excerpt'  => 'Migraines are more than headaches. Learn the neurological triggers and the latest preventive therapies available today.',
        'category' => 'Migraine',
        'date'     => 'Jun 10, 2025',
        'image'    => 'assets/services/migraine.png',
        'url'      => 'blog'
    ],
    [
        'title'    => 'Stroke Awareness: Act FAST to Save Lives',
        'excerpt'  => 'Recognising stroke symptoms early can prevent permanent damage. Know the FAST signs and when to call for emergency help.',
        'category' => 'Stroke',
        'date'     => 'May 28, 2025',
        'image'    => 'assets/services/stroke.png',
        'url'      => 'blog'
    ],
    [
        'title'    => 'Living with Parkinson\'s Disease: A Patient\'s Guide',
        'excerpt'  => 'From Deep Brain Stimulation to lifestyle strategies â€” explore how patients manage Parkinson\'s disease with quality of life.',
        'category' => 'Parkinson\'s',
        'date'     => 'May 14, 2025',
        'image'    => 'assets/services/parkinsons.png',
        'url'      => 'blog'
    ],
];

// Video Testimonials (YouTube Shorts IDs)
$videoTestimonials = [
    [
        'id' => 'QhoPKOgHrwY',
        'title' => 'Patient Recovery Story 1'
    ],
    [
        'id' => 'kEwXD0aT_rQ',
        'title' => 'Patient Recovery Story 2'
    ],
    [
        'id' => 'jg4e8bjYl-A',
        'title' => 'Patient Recovery Story 3'
    ],
    [
        'id' => 'LNxm9G-IYZE',
        'title' => 'Patient Recovery Story 4'
    ],
    [
        'id' => '6UCSDoYncK8',
        'title' => 'Patient Recovery Story 5'
    ],
    [
        'id' => 'qj3Z1NhVxqU',
        'title' => 'Patient Recovery Story 6'
    ]
];

// Instagram Reels â€” shortcodes from the reel URL: instagram.com/reel/<shortcode>/
// Add or reorder entries here; the homepage section renders them automatically.
$instagramHandle  = 'neuro_doc1';
$instagramProfile = 'https://www.instagram.com/neuro_doc1/';
$instagramReels = [
    ['id' => 'DbYcwZOBfSK'],
    ['id' => 'DbPwCw0O5J8'],
    ['id' => 'DbBREsghH7A'],
];

/**
 * Topic map: which education videos belong on which condition / service page.
 *
 * Keys are page filenames, values are video IDs drawn from $educationVideos above.
 * Order matters â€” the most directly relevant video should come first.
 * A page with no entry here simply renders no related-videos section.
 * Rendered by includes/related-videos.
 */
$pageVideos = [

    // â”€â”€ Condition pages â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    'epilepsy' => [
        'HCBSttaqm08', // Understanding Epilepsy and Seizures
        'e-totg4fbAQ', // Epilepsy First Aid: What to Do
        'VA0iTziT-yU', // Living Safely with Epilepsy
        'JO9eGHAPOp4', // Pediatric Epilepsy and Seizure Control
        '9vE_Cofbayk', // Epilepsy Management During Pregnancy
    ],
    'migraine' => [
        'jdDJjHKXOuE', // Preventative Tips for Migraine Patients
        'K8Ct06if4Bc', // Migraine Triggers and Food Habits
        'bffAUpfcr1E', // How to Manage Chronic Headaches
        '7OdQGLg_NIQ', // Tackling Anxiety-Induced Headaches
        'iBvkymzjMWE', // How Stress Affects Your Brain
    ],
    'headache' => [
        'bffAUpfcr1E', // How to Manage Chronic Headaches
        '7OdQGLg_NIQ', // Tackling Anxiety-Induced Headaches
        'KijjPIG3mtA', // Managing Trigeminal Neuralgia Pain
        'jdDJjHKXOuE', // Preventative Tips for Migraine Patients
        'ox84BTy70gE', // Preventing Chronic Brain Fatigue
    ],
    'stroke' => [
        '19eYLaT95jo', // Stroke Warning Signs & FAST Protocol
        'LcBJlz040YY', // Recognizing Early Stroke Symptoms
        'yWkceIAx0I4', // Understanding TIA (Transient Ischemic Attack)
        'nVAhwpuwuFY', // Stroke Recovery: The Critical First Month
        'BdBsAkCpQtg', // Spasticity Treatment After Stroke
        '-3tAktnWlq8', // Post-Stroke Depression & Recovery Support
        'WAbz6l4zm7c', // Healthy Diet Tips for Stroke Prevention
        'p8q2ORXW5ts', // Preventing Brain Stroke Risks In Summers
    ],
    'parkinsons' => [
        'wzoHirIE8og', // Demystifying Parkinson's Disease & DBS
        'vU-KYEswDZ0', // Treatment for Tremors & Parkinson's
        'jp68Y0bYfuo', // DBS Surgery Candidate Selection
        'e2jhqLMxrg8', // Advanced Neuro-Rehabilitation Therapy
    ],
    'movement' => [
        'vU-KYEswDZ0', // Treatment for Tremors & Parkinson's
        'wzoHirIE8og', // Demystifying Parkinson's Disease & DBS
        'CLfWvubTAO0', // Restless Legs Syndrome Diagnosis
        'jp68Y0bYfuo', // DBS Surgery Candidate Selection
        '97iJMOfzbQ0', // Motor Neuron Disease (MND) Care Protocols
    ],
    'vertigo' => [
        'HHV_qGv5wCM', // Vertigo and Balance Disorders: Cure Without Pills
        'sXl0eyou7EU', // Vertigo: Relieved Without Pills!
        'x0PfxhAcnQ4', // Dizziness vs. Vertigo: Understanding Differences
    ],
    'ms' => [
        'dbJjk1_Y9Dw', // Managing Multiple Sclerosis Symptoms
        'DIdecCaF2Js', // Myasthenia Gravis: Diagnostic and Care Paths
        '479zCN2vdBQ', // Guillain-BarrÃ© Syndrome (GBS) Recovery
        'e2jhqLMxrg8', // Advanced Neuro-Rehabilitation Therapy
    ],
    'neuropathy' => [
        'gngiRwzLH20', // Nerve Pain and Neuropathy Treatment Options
        't8KS0TEkgl0', // Understanding Nerve Conduction Studies
        'pSLVKT1W93Q', // Understanding Neuromuscular Disorders
        '479zCN2vdBQ', // Guillain-BarrÃ© Syndrome (GBS) Recovery
        'bqibQJelNmU', // Dealing with Chronic Neurological Pain
        'KijjPIG3mtA', // Managing Trigeminal Neuralgia Pain
    ],

    // â”€â”€ Service pages â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    'brain-tumor-surgery' => [
        'wiaiEgD_dtw', // Understanding Brain Tumors: Types & Stages
        'ohTGrS92kiE', // Management of Brain Infections
        '9AuZuZyI-Io', // Preventing Traumatic Brain Injury Complications
        'e2jhqLMxrg8', // Advanced Neuro-Rehabilitation Therapy
    ],
    'spine-surgery' => [
        'SfDdMcUCsBM', // Treating Cervical Spondylosis & Neck Pain
        'og9VMNrE7yk', // Management of Sciatica & Lower Back Pain
        'linE3GzsOYk', // Understanding Spinal Cord Injuries
        'r_FCRgtGl9Q', // Physical Therapy for Spinal Stenosis
        'zqOCl_r92kA', // Quick Tips for Back Pain Relief
    ],
    'functional-neurosurgery' => [
        'jp68Y0bYfuo', // DBS Surgery Candidate Selection
        'wzoHirIE8og', // Demystifying Parkinson's Disease & DBS
        'vU-KYEswDZ0', // Treatment for Tremors & Parkinson's
        '1lMG9FIfyR8', // rTMS Therapy for Brain Rehabilitation
    ],
    'neurovascular-surgery' => [
        'gns03zl4k7o', // Aneurysms and Neurovascular Care
        'yWkceIAx0I4', // Understanding TIA (Transient Ischemic Attack)
        '19eYLaT95jo', // Stroke Warning Signs & FAST Protocol
        'AomViYJ5yms', // Therapy Advancements in Neurocritical Care
    ],
    'memory-clinic' => [
        'gJuWUl08Urk', // Managing Dementia & Alzheimer's Care
        '3yhvFSFuPW4', // Alzheimer's Disease: Early Diagnostic Clues
        'nlZjfIk9Jws', // Prevention of Memory Loss & Dementia
        'VizML8pOj3g', // Protecting Memory as You Age
        '3TvNGdpDchU', // Cognitive Assessments in Elderly Patients
        'NZraszbqrt4', // Dementia Caregiver Survival Guide
        'RPrRp9h20kA', // Geriatric Neurology Care Guides
    ],
    'brain-health-center' => [
        'NFqg7wsC-sg', // Preventative Neurology & Healthy Brain Habits
        'iBvkymzjMWE', // How Stress Affects Your Brain
        'Yby46JYGC_0', // Management of Sleep Disorders
        'ox84BTy70gE', // Preventing Chronic Brain Fatigue
        'VizML8pOj3g', // Protecting Memory as You Age
    ],
    'neuro-rehabilitation-center' => [
        'e2jhqLMxrg8', // Advanced Neuro-Rehabilitation Therapy
        'BdBsAkCpQtg', // Spasticity Treatment After Stroke
        'nVAhwpuwuFY', // Stroke Recovery: The Critical First Month
        '1lMG9FIfyR8', // rTMS Therapy for Brain Rehabilitation
        'r_FCRgtGl9Q', // Physical Therapy for Spinal Stenosis
    ],
    'neurocritical-acute-stroke-care' => [
        'AomViYJ5yms', // Therapy Advancements in Neurocritical Care
        '19eYLaT95jo', // Stroke Warning Signs & FAST Protocol
        'QSVHJtC_Guc', // Brain Stroke Helpline & Emergency Response
        'nVAhwpuwuFY', // Stroke Recovery: The Critical First Month
    ],
    'brain-stroke-helpline' => [
        'QSVHJtC_Guc', // Brain Stroke Helpline & Emergency Response
        '19eYLaT95jo', // Stroke Warning Signs & FAST Protocol
        'LcBJlz040YY', // Recognizing Early Stroke Symptoms
        'yWkceIAx0I4', // Understanding TIA (Transient Ischemic Attack)
    ],
    'emergency-neurology-care' => [
        'QSVHJtC_Guc', // Brain Stroke Helpline & Emergency Response
        'e-totg4fbAQ', // Epilepsy First Aid: What to Do
        'AomViYJ5yms', // Therapy Advancements in Neurocritical Care
        '9AuZuZyI-Io', // Preventing Traumatic Brain Injury Complications
    ],
    'rtms-therapy' => [
        '1lMG9FIfyR8', // rTMS Therapy for Brain Rehabilitation
        'e2jhqLMxrg8', // Advanced Neuro-Rehabilitation Therapy
        '-3tAktnWlq8', // Post-Stroke Depression & Recovery Support
    ],
];

// Awards & Recognition
$awards = [
    [
        'title' => 'Honours & Recognition - Image 9',
        'image' => 'assets/awards/9.jpg',
        'webp' => 'assets/webp/awards/9.webp',
    ],
    [
        'title' => 'Honours & Recognition - Image 8',
        'image' => 'assets/awards/8.jpg',
        'webp' => 'assets/webp/awards/8.webp',
    ],
    [
        'title' => 'Honours & Recognition - Image 7',
        'image' => 'assets/awards/7.jpg',
        'webp' => 'assets/webp/awards/7.webp',
    ],
    [
        'title' => 'Honours & Recognition - Image 6',
        'image' => 'assets/awards/6.jpg',
        'webp' => 'assets/webp/awards/6.webp',
    ],
    [
        'title' => 'Honours & Recognition - Image 5',
        'image' => 'assets/awards/5.jpg',
        'webp' => 'assets/webp/awards/5.webp',
    ],
    [
        'title' => 'Honours & Recognition - Image 4',
        'image' => 'assets/awards/4.jpg',
        'webp' => 'assets/webp/awards/4.webp',
    ],
    [
        'title' => 'Honours & Recognition - Image 3',
        'image' => 'assets/awards/3.jpg',
        'webp' => 'assets/webp/awards/3.webp',
    ],
    [
        'title' => 'Honours & Recognition - Image 2',
        'image' => 'assets/awards/2.jpg',
        'webp' => 'assets/webp/awards/2.webp',
    ],
    [
        'title' => 'Honours & Recognition - Image 1',
        'image' => 'assets/awards/1.jpg',
        'webp' => 'assets/webp/awards/1.webp',
    ],
    [
        'title' => 'Honours & Recognition - Image 15',
        'image' => 'assets/awards/15.jpg',
        'webp' => 'assets/webp/awards/15.webp',
    ],
];

// Education / Knowledge Videos (YouTube Video IDs)
$educationVideos = [
    [
        'id'    => 'HCBSttaqm08',
        'title' => 'Understanding Epilepsy and Seizures',
        'desc'  => 'An in-depth explanation of seizure disorders, diagnostic procedures, and advanced clinical care plans.',
    ],
    [
        'id'    => '19eYLaT95jo',
        'title' => 'Stroke Warning Signs & FAST Protocol',
        'desc'  => 'Dr. Praveen Gupta highlights how to spot early signs of a brain stroke and act FAST to save lives.',
    ],
    [
        'id'    => 'jdDJjHKXOuE',
        'title' => 'Preventative Tips for Migraine Patients',
        'desc'  => 'Useful guidelines and preventative lifestyle measures to reduce the frequency and severity of migraines.',
    ],
    [
        'id'    => 'bffAUpfcr1E',
        'title' => 'How to Manage Chronic Headaches',
        'desc'  => 'Dr. Praveen Gupta details medical management and triggers for tension headaches and chronic migraines.',
    ],
    [
        'id'    => 'wzoHirIE8og',
        'title' => 'Demystifying Parkinson\'s Disease & DBS',
        'desc'  => 'A complete guide on Parkinson\'s treatment progression, medical therapies, and Deep Brain Stimulation.',
    ],
    [
        'id'    => 'gJuWUl08Urk',
        'title' => 'Managing Dementia & Alzheimer\'s Care',
        'desc'  => 'Expert advice on early diagnosis of dementia and caring for patients with progressive memory loss.',
    ],
    [
        'id'    => 'LcBJlz040YY',
        'title' => 'Recognizing Early Stroke Symptoms',
        'desc'  => 'A quick guide on emergency signs of an acute stroke that require immediate hospitalization.',
    ],
    [
        'id'    => 'gngiRwzLH20',
        'title' => 'Nerve Pain and Neuropathy Treatment Options',
        'desc'  => 'Clinical options for managing neuropathic pain, diabetic nerve damage, and burning feet syndrome.',
    ],
    [
        'id'    => 'HHV_qGv5wCM',
        'title' => 'Vertigo and Balance Disorders: Cure Without Pills',
        'desc'  => 'How vestibular rehabilitation and balance exercises help resolve vertigo without daily medication.',
    ],
    [
        'id'    => 'NFqg7wsC-sg',
        'title' => 'Preventative Neurology & Healthy Brain Habits',
        'desc'  => 'Lifestyle modifications, exercises, and dietary habits that promote lifelong cognitive strength.',
    ],
    [
        'id'    => 'Yby46JYGC_0',
        'title' => 'Management of Sleep Disorders',
        'desc'  => 'A clinical overview of insomnia, sleep apnea, and sleep hygiene practices to protect brain health.',
    ],
    [
        'id'    => 'SfDdMcUCsBM',
        'title' => 'Treating Cervical Spondylosis & Neck Pain',
        'desc'  => 'Dr. Praveen Gupta explains non-surgical treatments and physical therapy for neck and spine compression.',
    ],
    [
        'id'    => 'zqOCl_r92kA',
        'title' => 'Quick Tips for Back Pain Relief',
        'desc'  => 'Easy habits and posture corrections to prevent chronic lower back pain and spinal issues.',
    ],
    [
        'id'    => 'iBvkymzjMWE',
        'title' => 'How Stress Affects Your Brain',
        'desc'  => 'A quick review of how chronic stress alters brain chemistry and leads to chronic headaches.',
    ],
    [
        'id'    => 'VizML8pOj3g',
        'title' => 'Protecting Memory as You Age',
        'desc'  => 'Practical exercises and cognitive training recommendations to keep your mind sharp as you grow older.',
    ],
    [
        'id'    => 'dbJjk1_Y9Dw',
        'title' => 'Managing Multiple Sclerosis Symptoms',
        'desc'  => 'Latest clinical advancements and immunotherapies to control Multiple Sclerosis flare-ups and relapses.',
    ],
    [
        'id'    => 'e-totg4fbAQ',
        'title' => 'Epilepsy First Aid: What to Do',
        'desc'  => 'Crucial steps to follow when someone nearby is experiencing an active epileptic fit.',
    ],
    [
        'id'    => 'wiaiEgD_dtw',
        'title' => 'Understanding Brain Tumors: Types & Stages',
        'desc'  => 'Dr. Praveen Gupta details benign and malignant brain tumors, diagnostic scans, and care paths.',
    ],
    [
        'id'    => 'e2jhqLMxrg8',
        'title' => 'Advanced Neuro-Rehabilitation Therapy',
        'desc'  => 'How occupational and physical therapy modules speed up stroke recovery and motor restoration.',
    ],
    [
        'id'    => 'JO9eGHAPOp4',
        'title' => 'Pediatric Epilepsy and Seizure Control',
        'desc'  => 'A guide for parents on childhood epilepsy, medication management, and specialized diagnostic EEG.',
    ],
    [
        'id'    => 'vU-KYEswDZ0',
        'title' => 'Treatment for Tremors & Parkinson\'s',
        'desc'  => 'Evaluating therapeutic approaches and lifestyle adjustments for managing daily tremors.',
    ],
    [
        'id'    => 'nVAhwpuwuFY',
        'title' => 'Stroke Recovery: The Critical First Month',
        'desc'  => 'Rehabilitation timelines, physical exercises, and medical follow-up guidelines for stroke survivors.',
    ],
    [
        'id'    => 'bqibQJelNmU',
        'title' => 'Dealing with Chronic Neurological Pain',
        'desc'  => 'Clinical strategies for chronic headache, neuralgia, and peripheral neuropathic pain relief.',
    ],
    [
        'id'    => 'K8Ct06if4Bc',
        'title' => 'Migraine Triggers and Food Habits',
        'desc'  => 'Identifying common dietary and environmental triggers that spark severe migraine attacks.',
    ],
    [
        'id'    => 'gns03zl4k7o',
        'title' => 'Aneurysms and Neurovascular Care',
        'desc'  => 'How vascular abnormalities are diagnosed, monitored, and treated using micro-neurosurgery.',
    ],
    [
        'id'    => 'nlZjfIk9Jws',
        'title' => 'Prevention of Memory Loss & Dementia',
        'desc'  => 'Dr. Praveen Gupta discusses active mental exercises and diet charts that promote cognitive reserve.',
    ],
    [
        'id'    => 'RPrRp9h20kA',
        'title' => 'Geriatric Neurology Care Guides',
        'desc'  => 'Addressing common neurological conditions in elderly patients, from tremors to cognitive decline.',
    ],
    [
        'id'    => 'DIdecCaF2Js',
        'title' => 'Myasthenia Gravis: Diagnostic and Care Paths',
        'desc'  => 'Clinical breakdown of neuromuscular transmission issues, diagnosis, and medical protocols.',
    ],
    [
        'id'    => 'p8q2ORXW5ts',
        'title' => 'Preventing Brain Stroke Risks In Summers',
        'desc'  => 'Essential summer advice to stay hydrated and prevent blood pressure fluctuations that lead to stroke.',
    ],
    [
        'id'    => 'AomViYJ5yms',
        'title' => 'Therapy Advancements in Neurocritical Care',
        'desc'  => 'How specialized intensive care units improve clinical outcomes in comatose or head trauma patients.',
    ],
    [
        'id'    => 'og9VMNrE7yk',
        'title' => 'Management of Sciatica & Lower Back Pain',
        'desc'  => 'Dr. Praveen Gupta explains physical therapy, posture management, and non-surgical nerve decompression.',
    ],
    [
        'id'    => 'linE3GzsOYk',
        'title' => 'Understanding Spinal Cord Injuries',
        'desc'  => 'Clinical diagnostic paths, stabilization procedures, and long-term motor rehabilitation protocols.',
    ],
    [
        'id'    => '1lMG9FIfyR8',
        'title' => 'rTMS Therapy for Brain Rehabilitation',
        'desc'  => 'Clinical applications of Repetitive Transcranial Magnetic Stimulation in neurology patients.',
    ],
    [
        'id'    => 'BdBsAkCpQtg',
        'title' => 'Spasticity Treatment After Stroke',
        'desc'  => 'Medical management and rehabilitation tips to resolve muscle stiffness and spasticity post-stroke.',
    ],
    [
        'id'    => 'CLfWvubTAO0',
        'title' => 'Restless Legs Syndrome Diagnosis',
        'desc'  => 'Addressing sleep disturbances and sensory issues associated with Restless Legs Syndrome (RLS).',
    ],
    [
        'id'    => 'ohTGrS92kiE',
        'title' => 'Management of Brain Infections',
        'desc'  => 'Diagnostic procedures and emergency clinical guidelines for Encephalitis and Meningitis.',
    ],
    [
        'id'    => 'QSVHJtC_Guc',
        'title' => 'Brain Stroke Helpline & Emergency Response',
        'desc'  => 'Understanding stroke protocols and our 24/7 helpline structure for rapid hospital transfers.',
    ],
    [
        'id'    => '9vE_Cofbayk',
        'title' => 'Epilepsy Management During Pregnancy',
        'desc'  => 'Specialized medical guidance for female epilepsy patients planning pregnancy and family care.',
    ],
    [
        'id'    => '7OdQGLg_NIQ',
        'title' => 'Tackling Anxiety-Induced Headaches',
        'desc'  => 'Clinical tips on separating neurological chronic headaches from stress-induced tension pain.',
    ],
    [
        'id'    => 't8KS0TEkgl0',
        'title' => 'Understanding Nerve Conduction Studies',
        'desc'  => 'What to expect during EEG, EMG, and nerve conduction recording sessions in our neuro-lab.',
    ],
    [
        'id'    => '3TvNGdpDchU',
        'title' => 'Cognitive Assessments in Elderly Patients',
        'desc'  => 'Standard clinical questionnaires and memory exercises used to diagnose cognitive decline.',
    ],
    [
        'id'    => '9AuZuZyI-Io',
        'title' => 'Preventing Traumatic Brain Injury Complications',
        'desc'  => 'Protocols for treating concussions, head trauma, and preventing chronic neurological issues.',
    ],
    [
        'id'    => 'jp68Y0bYfuo',
        'title' => 'DBS Surgery Candidate Selection',
        'desc'  => 'Detailed criteria used to identify if a Parkinson\'s patient is suitable for Deep Brain Stimulation.',
    ],
    [
        'id'    => 'pSLVKT1W93Q',
        'title' => 'Understanding Neuromuscular Disorders',
        'desc'  => 'Clinical symptoms, nerve-muscle biopsy diagnostics, and therapy guidelines.',
    ],
    [
        'id'    => '3yhvFSFuPW4',
        'title' => 'Alzheimer\'s Disease: Early Diagnostic Clues',
        'desc'  => 'Dr. Praveen Gupta shares crucial early behavioral markers that point to Alzheimer\'s onset.',
    ],
    [
        'id'    => '97iJMOfzbQ0',
        'title' => 'Motor Neuron Disease (MND) Care Protocols',
        'desc'  => 'Symptom relief plans, supportive physical exercises, and clinical care paths for MND patients.',
    ],
    [
        'id'    => '479zCN2vdBQ',
        'title' => 'Guillain-BarrÃ© Syndrome (GBS) Recovery',
        'desc'  => 'Clinical diagnostics, immunoglobulin therapy, and neurological ICU pathways for GBS.',
    ],
    [
        'id'    => 'x0PfxhAcnQ4',
        'title' => 'Dizziness vs. Vertigo: Understanding Differences',
        'desc'  => 'Dr. Praveen Gupta explains balance systems to help patients distinguish vertigo from general dizziness.',
    ],
    [
        'id'    => 'VA0iTziT-yU',
        'title' => 'Living Safely with Epilepsy',
        'desc'  => 'Lifestyle modifications, safety proofing your home, and driving rules for epilepsy patients.',
    ],
    [
        'id'    => '-3tAktnWlq8',
        'title' => 'Post-Stroke Depression & Recovery Support',
        'desc'  => 'Addressing mood shifts and psychological support systems vital during stroke recovery.',
    ],
    [
        'id'    => 'r_FCRgtGl9Q',
        'title' => 'Physical Therapy for Spinal Stenosis',
        'desc'  => 'Exercises and clinical decompression therapies that relieve pressure on the spinal cord.',
    ],
    [
        'id'    => 'WAbz6l4zm7c',
        'title' => 'Healthy Diet Tips for Stroke Prevention',
        'desc'  => 'Cardiovascular nutrition advice to lower cholesterol and prevent artery blockages.',
    ],
    [
        'id'    => 'yWkceIAx0I4',
        'title' => 'Understanding TIA (Transient Ischemic Attack)',
        'desc'  => 'Why "mini-strokes" are serious warnings that require immediate medical attention.',
    ],
    [
        'id'    => 'NZraszbqrt4',
        'title' => 'Dementia Caregiver Survival Guide',
        'desc'  => 'Helpful tips for caregivers managing behavioral changes and emotional fatigue.',
    ],
    [
        'id'    => 'sXl0eyou7EU',
        'title' => 'Vertigo: Relieved Without Pills!',
        'desc'  => 'Learn how vertigo can be relieved effectively without medication from Dr. Praveen Gupta.',
    ],
    [
        'id'    => 'KijjPIG3mtA',
        'title' => 'Managing Trigeminal Neuralgia Pain',
        'desc'  => 'Clinical medication paths and surgical nerve decompression options for facial pain.',
    ],
    [
        'id'    => 'ox84BTy70gE',
        'title' => 'Preventing Chronic Brain Fatigue',
        'desc'  => 'Tips to improve sleep cycles, reduce screen strain, and support cognitive performance.',
    ],
];

// Link mapping helper for service details pages
/**
 * Tags an education video into a filter category from its title.
 * Shared by videos and neurology-video-library so both pages
 * bucket the library identically â€” keep the filter buttons on those
 * pages in sync with the categories returned here.
 */
function getVideoCategory($title) {
    $t = strtolower($title);
    if (strpos($t, 'stroke') !== false || strpos($t, 'tia') !== false) return 'stroke';
    if (strpos($t, 'epilepsy') !== false || strpos($t, 'seizure') !== false) return 'epilepsy';
    if (strpos($t, 'headache') !== false || strpos($t, 'migraine') !== false) return 'headache';
    if (strpos($t, 'dementia') !== false || strpos($t, 'alzheimer') !== false || strpos($t, 'memory') !== false) return 'dementia';
    if (strpos($t, 'spine') !== false || strpos($t, 'spinal') !== false || strpos($t, 'back pain') !== false || strpos($t, 'neck pain') !== false || strpos($t, 'spondylosis') !== false || strpos($t, 'nerve') !== false || strpos($t, 'neuropathy') !== false || strpos($t, 'sciatica') !== false) return 'spine';
    if (strpos($t, 'rehab') !== false || strpos($t, 'physiotherapy') !== false || strpos($t, 'physical therapy') !== false || strpos($t, 'spasticity') !== false || strpos($t, 'rtms') !== false || strpos($t, 'recovery') !== false) return 'rehab';
    return 'wellness';
}

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
            return array_merge($defaults, $data);
        }
    }
    return $defaults;
}

