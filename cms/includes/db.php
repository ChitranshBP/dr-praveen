<?php
/**
 * CMS Data Layer - Dr. Praveen Gupta Website CMS
 * High-performance JSON Document Engine with atomic writes and auto-seeding
 */

if (!defined('CMS_ROOT')) {
    define('CMS_ROOT', dirname(__DIR__));
}

define('DATA_DIR', dirname(CMS_ROOT) . '/data');
define('UPLOADS_DIR', dirname(CMS_ROOT) . '/assets/uploads');

if (!is_dir(DATA_DIR)) {
    @mkdir(DATA_DIR, 0755, true);
}
if (!is_dir(UPLOADS_DIR)) {
    @mkdir(UPLOADS_DIR, 0755, true);
}

if (!file_exists(DATA_DIR . '/.htaccess')) {
    @file_put_contents(DATA_DIR . '/.htaccess',
        "<IfModule mod_authz_core.c>\n    Require all denied\n</IfModule>\n<IfModule !mod_authz_core.c>\n    Order allow,deny\n    Deny from all\n</IfModule>\n");
}
if (!file_exists(DATA_DIR . '/index.php')) {
    @file_put_contents(DATA_DIR . '/index.php', "<?php http_response_code(403); exit('Access Denied'); ?>");
}

class CMS_DB {
    private static function getFilePath($collection) {
        $clean = preg_replace('/[^a-zA-Z0-9_-]/', '', $collection);
        return DATA_DIR . '/' . $clean . '.json';
    }

    public static function get($collection, $default = []) {
        $file = self::getFilePath($collection);
        if (!file_exists($file)) {
            return $default;
        }
        $raw = file_get_contents($file);
        $data = json_decode($raw, true);
        return is_array($data) ? $data : $default;
    }

    public static function set($collection, $data) {
        $file = self::getFilePath($collection);
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        
        $tempFile = $file . '.tmp.' . uniqid();
        if (file_put_contents($tempFile, $json, LOCK_EX) !== false) {
            rename($tempFile, $file);
            return true;
        }
        return false;
    }

    public static function getSetting($key, $default = null) {
        $settings = self::get('settings', []);
        return $settings[$key] ?? $default;
    }

    public static function setSetting($key, $value) {
        $settings = self::get('settings', []);
        $settings[$key] = $value;
        return self::set('settings', $settings);
    }

    public static function setMultipleSettings($data) {
        $settings = self::get('settings', []);
        foreach ($data as $k => $v) {
            $settings[$k] = $v;
        }
        return self::set('settings', $settings);
    }

    public static function generateId() {
        return bin2hex(random_bytes(8));
    }
}

function cms_init_seed() {
    // 1. Users (Default Admin)
    $users = CMS_DB::get('users', []);
    if (empty($users)) {
        $users = [
            [
                'id' => CMS_DB::generateId(),
                'username' => 'Admin@Dr-Praveen',
                'name' => 'Dr. Praveen Gupta Admin',
                'email' => 'contact@drpraveengupta.com',
                'password' => password_hash('@Praveen@123', PASSWORD_BCRYPT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'last_login' => null
            ]
        ];
        CMS_DB::set('users', $users);
    }

    // 2. Settings
    $settings = CMS_DB::get('settings', []);
    if (empty($settings)) {
        $settings = [
            'site_name' => 'Dr. Praveen Gupta',
            'site_tagline' => 'Excellence in Healthcare',
            'site_url' => 'https://drpraveengupta.com',
            'phone' => '+91-87969-77903',
            'stroke_helpline' => '1800-309-0247',
            'email' => 'contact@drpraveengupta.com',
            'address' => 'Marengo Asia Hospitals, Shushant Lok 2, Sector 56, Gurugram, Ghata, Haryana 122011',
            'whatsapp' => '918796977903',
            'whatsapp_message' => 'Hello, I would like to book an appointment with Dr. Praveen Gupta.',
            'social_facebook' => 'https://facebook.com/drpraveengupta',
            'social_instagram' => 'https://instagram.com/neuro_doc1',
            'social_twitter' => 'https://twitter.com/drpraveengupta',
            'social_youtube' => 'https://youtube.com/c/DrPraveenGupta',
            'social_linkedin' => 'https://linkedin.com/in/drpraveengupta',
            'gtm_id' => 'GTM-TF2TXQLK',
            'ga4_id' => '',
            'meta_pixel_id' => '',
            'custom_head_scripts' => '',
            'custom_body_scripts' => '',
            'working_hours_weekdays' => 'Mon - Sat: 9 AM - 7 PM',
            'working_hours_sunday' => 'Sunday: Closed',
            'stats_patients' => '3,00,000+',
            'stats_awards' => '50+',
            'stats_rating' => '4.9',
            'stats_experience' => '20+ Years',
            'logo_path' => 'assets/logo/NeuroDoc-final-logo.png',
            'favicon_path' => 'assets/favicon/favicon.png'
        ];
        CMS_DB::set('settings', $settings);
    }

    // 3. Banners
    $banners = CMS_DB::get('banners', []);
    if (empty($banners)) {
        $banners = [
            [
                'id' => 'banner-stroke',
                'title' => "Stroke Doesn't Wait. Neither Should You.",
                'subtitle' => 'Expert Care. Every Minute Matters. Time is Brain.',
                'desktop_image' => 'assets/banner/dr-praveen-banner-desktop/stroke-care.jpeg',
                'mobile_image' => 'assets/banner/dr-praveen-banner-mobile/stroke-care-mobile.jpeg',
                'alt_text' => "Stroke Doesn't Wait. Neither Should You - Emergency Stroke Care by Dr. Praveen Gupta",
                'cta_text' => 'Emergency Stroke Care',
                'cta_link' => 'stroke',
                'is_active' => true,
                'order' => 1
            ],
            [
                'id' => 'banner-epilepsy',
                'title' => "Don't Let Seizures Control Your Life",
                'subtitle' => 'Expert diagnosis & personalised advanced epilepsy care',
                'desktop_image' => 'assets/banner/dr-praveen-banner-desktop/epilepsy-care.jpeg',
                'mobile_image' => 'assets/banner/dr-praveen-banner-mobile/epilepsy-care-mobile.jpeg',
                'alt_text' => "Don't Let Seizures Control Your Life - Advanced Epilepsy Care by Dr. Praveen Gupta",
                'cta_text' => 'Consult for Epilepsy',
                'cta_link' => 'epilepsy',
                'is_active' => true,
                'order' => 2
            ],
            [
                'id' => 'banner-migraine',
                'title' => "It's More Than 'Just a Headache.'",
                'subtitle' => 'Expert care for migraine & recurring headaches.',
                'desktop_image' => 'assets/banner/dr-praveen-banner-desktop/migraine-care.jpeg',
                'mobile_image' => 'assets/banner/dr-praveen-banner-mobile/migraine-care-mobile.jpeg',
                'alt_text' => "It's More Than Just a Headache - Expert Migraine Care by Dr. Praveen Gupta",
                'cta_text' => 'Consult for Migraine',
                'cta_link' => 'migraine',
                'is_active' => true,
                'order' => 3
            ],
            [
                'id' => 'banner-parkinsons',
                'title' => "Move With Confidence. Live With Freedom.",
                'subtitle' => "Expert care for Parkinson's, tremors & movement disorders.",
                'desktop_image' => 'assets/banner/dr-praveen-banner-desktop/parkinsons-care-male.jpeg',
                'mobile_image' => 'assets/banner/dr-praveen-banner-mobile/parkinsons-care-male-mobile.jpeg',
                'alt_text' => "Move With Confidence. Live With Freedom - Parkinson's Treatment by Dr. Praveen Gupta",
                'cta_text' => "Consult for Parkinson's",
                'cta_link' => 'parkinsons',
                'is_active' => true,
                'order' => 4
            ]
        ];
        CMS_DB::set('banners', $banners);
    }

    // 4. Seed Doctors
    $doctors = CMS_DB::get('doctors', []);
    if (empty($doctors)) {
        $jsonPath = dirname(CMS_ROOT) . '/assets/doctors_full.json';
        if (file_exists($jsonPath)) {
            $imported = json_decode(file_get_contents($jsonPath), true);
            if (is_array($imported)) {
                $doctors = [];
                foreach ($imported as $doc) {
                    $doc['id'] = CMS_DB::generateId();
                    $doctors[] = $doc;
                }
                CMS_DB::set('doctors', $doctors);
            }
        }
    }

    // 5. Testimonials
    $testimonials = CMS_DB::get('testimonials', []);
    if (empty($testimonials)) {
        $testimonials = [
            [
                'id' => CMS_DB::generateId(),
                'name' => 'Atul Saxena',
                'role' => "Patient's Son",
                'rating' => 5,
                'condition' => 'Neuropathy',
                'message' => "I would like to express my heartfelt gratitude to Dr. Praveen Gupta and his outstanding team for the exceptional care during my mother's treatment for acute neuropathy. Dr. Gupta's clinical expertise, calm approach, and ability to explain every aspect of the treatment gave our family immense confidence.",
                'video_id' => '',
                'featured' => true,
                'date' => date('Y-m-d')
            ],
            [
                'id' => CMS_DB::generateId(),
                'name' => 'Yashu Jindal',
                'role' => "Patient's Son",
                'rating' => 5,
                'condition' => 'Brain Stroke',
                'message' => "We are extremely grateful to Dr. Praveen Gupta for the exceptional care and treatment provided to my father during his brain stroke surgery. From the very beginning, Dr. Gupta guided us with confidence, clarity, and compassion during a very difficult time for our family.",
                'video_id' => 'kEwXD0aT_rQ',
                'featured' => true,
                'date' => date('Y-m-d')
            ],
            [
                'id' => CMS_DB::generateId(),
                'name' => 'Dheeraj Tiwari',
                'role' => 'Patient',
                'rating' => 5,
                'condition' => 'Vertigo & Balance',
                'message' => "Really good experience at Dr. Praveen Gupta's clinic. My vertigo and dizziness improved a lot. My condition was explained in a way I could easily understand. I felt much better after following the treatment. Highly recommended.",
                'video_id' => '',
                'featured' => true,
                'date' => date('Y-m-d')
            ],
            [
                'id' => CMS_DB::generateId(),
                'name' => 'Syed Mazhar Kandhlavi',
                'role' => 'Patient',
                'rating' => 5,
                'condition' => 'Neurological Disorder',
                'message' => "Dr. Praveen Gupta is a brilliant, empathetic, and very supportive physician. I struggled with a neurological disorder for a decade, but under his care, I was completely cured in 10 days. He is genuinely an embodiment of compassion and healing.",
                'video_id' => 'jg4e8bjYl-A',
                'featured' => true,
                'date' => date('Y-m-d')
            ]
        ];
        CMS_DB::set('testimonials', $testimonials);
    }

    // 6. Services
    $services = CMS_DB::get('services', []);
    if (empty($services)) {
        $services = [
            [
                'id' => CMS_DB::generateId(),
                'title' => 'Stroke & Neurocritical Care Unit',
                'slug' => 'neurocritical-acute-stroke-care',
                'icon' => 'heart-pulse',
                'short_description' => 'Comprehensive emergency stroke management, thrombolysis, mechanical thrombectomy, and 24/7 dedicated neuro-ICU care.',
                'features' => ['Thrombolytic therapy', 'Mechanical thrombectomy', '24/7 stroke protocol', 'Neurorehabilitation services'],
                'image' => 'assets/services/stroke.png',
                'is_active' => true,
                'order' => 1
            ],
            [
                'id' => CMS_DB::generateId(),
                'title' => 'Epilepsy & Seizure Clinic',
                'slug' => 'epilepsy',
                'icon' => 'bolt',
                'short_description' => 'Advanced epilepsy monitoring, long-term video EEG, drug-resistant epilepsy management, and DBS brain pacemaker implantation.',
                'features' => ['Video EEG Monitoring', 'Brain Pacemaker / DBS', 'Pediatric & Adult Epilepsy', 'Medication Optimization'],
                'image' => 'assets/services/epilepsy.png',
                'is_active' => true,
                'order' => 2
            ],
            [
                'id' => CMS_DB::generateId(),
                'title' => 'Brain Tumor Surgery',
                'slug' => 'brain-tumor-surgery',
                'icon' => 'brain',
                'short_description' => 'Precision neurosurgical resection using intraoperative neuro-navigation, awake craniotomy, and minimally invasive techniques.',
                'features' => ['Intraoperative Navigation', 'Awake Craniotomy', 'Pituitary & Skull Base', 'Multidisciplinary Oncology'],
                'image' => 'assets/services/brain-tumor.png',
                'is_active' => true,
                'order' => 3
            ],
            [
                'id' => CMS_DB::generateId(),
                'title' => 'Spine Surgery',
                'slug' => 'spine-surgery',
                'icon' => 'person-walking',
                'short_description' => 'Minimally invasive spine surgery, endoscopic discectomy, spinal fusion, and artificial disc replacement for back and neck pain.',
                'features' => ['Endoscopic Discectomy', 'Spinal Fusion & Decompression', 'Disc Replacement', 'Non-Surgical Pain Management'],
                'image' => 'assets/services/spine.png',
                'is_active' => true,
                'order' => 4
            ],
            [
                'id' => CMS_DB::generateId(),
                'title' => 'Headache & Migraine Clinic',
                'slug' => 'migraine',
                'icon' => 'head-side-virus',
                'short_description' => 'Targeted therapies for chronic migraine, Botox injections, CGRP monoclonal antibodies, and nerve blocks.',
                'features' => ['Botox for Migraine', 'CGRP Antibody Therapy', 'Cluster Headache Care', 'Trigger Point Injections'],
                'image' => 'assets/services/headache.png',
                'is_active' => true,
                'order' => 5
            ],
            [
                'id' => CMS_DB::generateId(),
                'title' => 'Functional Neurosurgery & DBS',
                'slug' => 'functional-neurosurgery',
                'icon' => 'bolt',
                'short_description' => 'Pioneering Deep Brain Stimulation for Parkinson’s disease, essential tremor, dystonia, and neuropsychiatric disorders.',
                'features' => ['Parkinson’s DBS', 'Dystonia Management', 'Tremor Control', 'Post-Op Programming'],
                'image' => 'assets/services/functional.png',
                'is_active' => true,
                'order' => 6
            ]
        ];
        CMS_DB::set('services', $services);
    }

    // 7. Blogs
    $blogs = CMS_DB::get('blogs', []);
    if (empty($blogs)) {
        $blogs = [
            [
                'id' => CMS_DB::generateId(),
                'title' => 'Understanding Parkinson’s Disease: Early Warning Signs & Modern Treatments',
                'slug' => 'understanding-parkinsons-disease',
                'excerpt' => 'From Deep Brain Stimulation to lifestyle strategies, explore how patients manage Parkinson disease with high quality of life.',
                'content' => '<p>Parkinson’s disease is a progressive neurodegenerative disorder that predominantly affects dopamine-producing neurons in a specific area of the brain called substantia nigra.</p><p>With modern advancements such as Deep Brain Stimulation (DBS) and targeted medical management, patients can experience significant symptomatic relief and lead active, fulfilling lives.</p>',
                'author' => 'Dr. Praveen Gupta',
                'category' => 'Movement Disorders',
                'image' => 'assets/banner/1.png',
                'date' => date('Y-m-d'),
                'status' => 'published',
                'views' => 142
            ],
            [
                'id' => CMS_DB::generateId(),
                'title' => 'Emergency Stroke Care: Recognizing the F.A.S.T. Signs',
                'slug' => 'emergency-stroke-care-fast-signs',
                'excerpt' => 'Time is brain in acute stroke care. Learn the critical symptoms and why reaching a stroke-ready hospital within the golden hour saves lives.',
                'content' => '<p>During an acute ischemic stroke, approximately 1.9 million brain cells die every minute that treatment is delayed. Recognizing Face drooping, Arm weakness, and Speech difficulty means it is Time to call emergency care immediately.</p>',
                'author' => 'Dr. Praveen Gupta',
                'category' => 'Stroke Care',
                'image' => 'assets/banner/2.png',
                'date' => date('Y-m-d'),
                'status' => 'published',
                'views' => 289
            ]
        ];
        CMS_DB::set('blogs', $blogs);
    }
}

cms_init_seed();
