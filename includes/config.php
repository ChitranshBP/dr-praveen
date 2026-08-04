<?php
/**
 * Site Configuration
 * Dr. Praveen Gupta - Official Website
 */

// Site Information
define('SITE_NAME', 'Dr. Praveen Gupta');
define('SITE_TAGLINE', 'Excellence in Healthcare');
define('SITE_URL', 'https://drpraveengupta.com');
define('SITE_PHONE', '+91-9876543210');
define('STROKE_HELPLINE', '1800-309-0247');
define('SITE_EMAIL', 'contact@drpraveengupta.com');
define('SITE_ADDRESS', 'New Delhi, India');

// WhatsApp — digits only, country code first, no '+', spaces or dashes (wa.me format)
define('SITE_WHATSAPP', '919876543210');
define('WHATSAPP_MESSAGE', 'Hello, I would like to book an appointment with Dr. Praveen Gupta.');

// Social Media
define('SOCIAL_FACEBOOK', 'https://facebook.com/drpraveengupta');
define('SOCIAL_INSTAGRAM', 'https://instagram.com/drpraveengupta');
define('SOCIAL_TWITTER', 'https://twitter.com/drpraveengupta');
define('SOCIAL_YOUTUBE', 'https://youtube.com/drpraveengupta');
define('SOCIAL_LINKEDIN', 'https://linkedin.com/in/drpraveengupta');

// Navigation
$navItems = [
    ['name' => 'Home', 'url' => 'index.php'],
    ['name' => 'About', 'url' => '#', 'children' => [
        ['name' => 'About Dr Praveen', 'url' => 'about.php'],
        ['name' => 'Why Choose Us', 'url' => 'why-choose-dr-praveen-gupta.php'],
        ['name' => 'Our Team', 'url' => 'team.php'],
        ['name' => 'Awards & Honors', 'url' => 'awards-and-recognition.php'],
    ]],
    // 'viewAll' => true renders the item as a highlighted link pinned to the
    // bottom of the dropdown, separated from the list above it.
    ['name' => 'Services', 'url' => '#', 'children' => [
        ['name' => 'Brain Tumor Surgery', 'url' => 'brain-tumor-surgery.php'],
        ['name' => 'Spine Surgery', 'url' => 'spine-surgery.php'],
        ['name' => 'Functional Neurosurgery', 'url' => 'functional-neurosurgery.php'],
        ['name' => 'Neurovascular Surgery', 'url' => 'neurovascular-surgery.php'],
        ['name' => 'Memory Clinic', 'url' => 'memory-clinic.php'],
        ['name' => 'Rehabilitation Hub', 'url' => 'neuro-rehabilitation-center.php'],
        ['name' => 'Brain Health Hub', 'url' => 'brain-health-center.php'],
        ['name' => 'Neurocritical Care', 'url' => 'neurocritical-acute-stroke-care.php'],
        ['name' => 'rTMS Therapy', 'url' => 'rtms-therapy.php'],
        ['name' => 'View All Services', 'url' => 'services.php', 'viewAll' => true],
    ]],
    ['name' => 'Conditions', 'url' => '#', 'children' => [
        ['name' => 'Epilepsy', 'url' => 'epilepsy.php'],
        ['name' => 'Headache', 'url' => 'headache.php'],
        ['name' => 'Migraine', 'url' => 'migraine.php'],
        ['name' => 'Stroke', 'url' => 'stroke.php'],
        ['name' => 'Vertigo', 'url' => 'vertigo.php'],
        ['name' => 'Parkinson\'s Disease', 'url' => 'parkinsons.php'],
        ['name' => 'Multiple Sclerosis', 'url' => 'ms.php'],
        ['name' => 'Movement Disorders', 'url' => 'movement.php'],
        ['name' => 'Peripheral Neuropathy', 'url' => 'neuropathy.php'],
        ['name' => 'View All Conditions', 'url' => 'neurological-conditions.php', 'viewAll' => true],
    ]],
    ['name' => 'Patient Info', 'url' => '#', 'children' => [
        ['name' => 'Patient Info', 'url' => 'patient-info.php'],
        ['name' => 'Consultation Guide', 'url' => 'neurology-consultation.php'],
        ['name' => 'Online Consultation', 'url' => 'online-neurologist-consultation.php'],
        ['name' => 'Second Opinion', 'url' => 'neurology-second-opinion.php'],
        ['name' => 'Emergency Care', 'url' => 'emergency-neurology-care.php'],
        ['name' => 'Stroke Helpline', 'url' => 'brain-stroke-helpline.php'],
        ['name' => 'Patient Testimonials', 'url' => 'neurology-patient-testimonials.php'],
        ['name' => 'Success Stories', 'url' => 'patient-success-stories.php'],
        ['name' => 'Case Studies', 'url' => 'case-studies.php'],
        ['name' => 'Google Reviews', 'url' => 'patient-reviews.php'],
        ['name' => 'FAQs', 'url' => 'neurology-faqs.php'],
    ]],
    ['name' => 'Media', 'url' => '#', 'children' => [
        ['name' => 'Videos Hub', 'url' => 'videos.php'],
        ['name' => 'Education Videos', 'url' => 'neurology-video-library.php'],
        ['name' => 'Video Testimonials', 'url' => 'video-testimonials.php'],
        ['name' => 'Media Coverage', 'url' => 'media-coverage.php'],
        ['name' => 'Photo Gallery', 'url' => 'gallery.php'],
    ]],
    ['name' => 'Blog', 'url' => 'dr-praveen-gupta-blog.php'],
];

// Services
$services = [
    [
        'title' => 'Stroke & Neurocritical Care Unit',
        'description' => 'Advanced Stroke Care in Gurgaon',
        'bullet' => 'Gurgaon\'s First 24×7 Brain Stroke Helpline – 1800-309-0247',
        'image' => 'assets/services/stroke-care.png',
        'link' => 'brain-stroke-helpline.php'
    ],
    [
        'title' => 'Epilepsy & Seizure Clinic',
        'description' => 'Comprehensive seizure diagnosis and treatment',
        'bullet' => 'Video EEG monitoring',
        'image' => 'assets/services/epilepsy.png',
        'link' => 'epilepsy.php'
    ],
    [
        'title' => 'Brain Tumor Surgery',
        'description' => 'Precision neurosurgery using advanced imaging',
        'bullet' => 'Minimally invasive tumor removal',
        'image' => 'assets/services/brain-tumor.png',
        'link' => 'brain-tumor-surgery.php'
    ],
    [
        'title' => 'Spine Surgery',
        'description' => 'Comprehensive care for spinal conditions',
        'bullet' => 'Minimally invasive spine surgery',
        'image' => 'assets/services/spine-surgery.png',
        'link' => 'spine-surgery.php'
    ],
    [
        'title' => 'Headache & Pain Clinic',
        'description' => 'Targeted care for migraines and chronic headaches',
        'bullet' => 'Preventive therapies',
        'image' => 'assets/services/headache.png',
        'link' => 'headache.php'
    ],
    [
        'title' => 'Functional Neurosurgery',
        'description' => 'Advanced surgical treatment for movement disorders',
        'bullet' => 'Deep Brain Stimulation (DBS) for Parkinson\'s',
        'image' => 'assets/services/functional-neuro.png',
        'link' => 'functional-neurosurgery.php'
    ],
    [
        'title' => 'Neurovascular Surgery',
        'description' => 'Treatment of complex vascular conditions',
        'bullet' => 'Aneurysm clipping',
        'image' => 'assets/services/neurovascular.png',
        'link' => 'neurovascular-surgery.php'
    ],
    [
        'title' => 'Geriatric & Dementia Clinic',
        'description' => 'Care for dementia, Alzheimer\'s, and memory disorders',
        'bullet' => 'Neuropsychological testing',
        'image' => 'assets/services/memory-clinic.png',
        'link' => 'memory-clinic.php'
    ],
    [
        'title' => 'Neuro-Rehabilitation Centre',
        'description' => 'Structured recovery programs after stroke, injury and surgery',
        'bullet' => 'Physiotherapy, speech and cognitive therapy',
        'image' => 'assets/services/rehab.png',
        'link' => 'neuro-rehabilitation-center.php'
    ]
];

// Stats
$stats = [
    [
        'number' => '500K',
        'label' => 'Happy Patients',
        'icon' => 'fas fa-user-group',
        'description' => 'We take pride in the trust of over 500,000 patients whose health and happiness remain our top priorities.'
    ],
    [
        'number' => '100%',
        'label' => 'Satisfaction',
        'icon' => 'fas fa-face-smile',
        'description' => 'Committed to delivering outstanding clinical outcomes and patient-first specialized care.'
    ],
    [
        'number' => '20+',
        'label' => 'Experience',
        'icon' => 'fas fa-user-doctor',
        'description' => 'Providing over two decades of expert medical diagnosis, treatment, and neurological care.'
    ],
    [
        'number' => '70+',
        'label' => 'Publications',
        'icon' => 'fas fa-book-medical',
        'description' => 'Contributing to global medical research with over 70 scientific publications and journals.'
    ],
];

// Testimonials
$testimonials = [
    [
        'name' => 'Priya Sharma',
        'role' => 'Patient',
        'message' => 'Dr. Praveen Gupta transformed my health journey. His expertise and compassion are unmatched.',
        'rating' => 5
    ],
    [
        'name' => 'Rajesh Kumar',
        'role' => 'Patient',
        'message' => 'The level of care and attention I received was exceptional. Truly a world-class professional.',
        'rating' => 5
    ],
    [
        'name' => 'Anita Desai',
        'role' => 'Patient',
        'message' => 'Outstanding doctor with a wonderful bedside manner. Highly recommend to everyone.',
        'rating' => 5
    ],
    [
        'name' => 'Suresh Mehta',
        'role' => 'Patient',
        'message' => 'After struggling with migraines for years, Dr. Gupta\'s treatment gave me my life back. Truly exceptional care.',
        'rating' => 5
    ],
    [
        'name' => 'Kavita Singh',
        'role' => 'Patient',
        'message' => 'I was diagnosed with Parkinson\'s and was devastated. Dr. Gupta\'s calm guidance and advanced treatment plan gave me renewed hope.',
        'rating' => 5
    ],
    [
        'name' => 'Deepak Nair',
        'role' => 'Patient',
        'message' => 'Best neurologist I have ever consulted. Diagnosed my condition accurately in the first visit and the treatment worked remarkably well.',
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
        'image'    => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&h=520&q=80',
        'url'      => 'blog.php'
    ],
    [
        'title'    => 'Stroke Awareness: Act FAST to Save Lives',
        'excerpt'  => 'Recognising stroke symptoms early can prevent permanent damage. Know the FAST signs and when to call for emergency help.',
        'category' => 'Stroke',
        'date'     => 'May 28, 2025',
        'image'    => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=800&h=520&q=80',
        'url'      => 'blog.php'
    ],
    [
        'title'    => 'Living with Parkinson\'s Disease: A Patient\'s Guide',
        'excerpt'  => 'From Deep Brain Stimulation to lifestyle strategies — explore how patients manage Parkinson\'s disease with quality of life.',
        'category' => 'Parkinson\'s',
        'date'     => 'May 14, 2025',
        'image'    => 'https://images.unsplash.com/photo-1530026405186-ed1ea0ac7a63?auto=format&fit=crop&w=800&h=520&q=80',
        'url'      => 'blog.php'
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

// Instagram Reels — shortcodes from the reel URL: instagram.com/reel/<shortcode>/
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
 * Order matters — the most directly relevant video should come first.
 * A page with no entry here simply renders no related-videos section.
 * Rendered by includes/related-videos.php.
 */
$pageVideos = [

    // ── Condition pages ──────────────────────────────────────────────
    'epilepsy.php' => [
        'HCBSttaqm08', // Understanding Epilepsy and Seizures
        'e-totg4fbAQ', // Epilepsy First Aid: What to Do
        'VA0iTziT-yU', // Living Safely with Epilepsy
        'JO9eGHAPOp4', // Pediatric Epilepsy and Seizure Control
        '9vE_Cofbayk', // Epilepsy Management During Pregnancy
    ],
    'migraine.php' => [
        'jdDJjHKXOuE', // Preventative Tips for Migraine Patients
        'K8Ct06if4Bc', // Migraine Triggers and Food Habits
        'bffAUpfcr1E', // How to Manage Chronic Headaches
        '7OdQGLg_NIQ', // Tackling Anxiety-Induced Headaches
        'iBvkymzjMWE', // How Stress Affects Your Brain
    ],
    'headache.php' => [
        'bffAUpfcr1E', // How to Manage Chronic Headaches
        '7OdQGLg_NIQ', // Tackling Anxiety-Induced Headaches
        'KijjPIG3mtA', // Managing Trigeminal Neuralgia Pain
        'jdDJjHKXOuE', // Preventative Tips for Migraine Patients
        'ox84BTy70gE', // Preventing Chronic Brain Fatigue
    ],
    'stroke.php' => [
        '19eYLaT95jo', // Stroke Warning Signs & FAST Protocol
        'LcBJlz040YY', // Recognizing Early Stroke Symptoms
        'yWkceIAx0I4', // Understanding TIA (Transient Ischemic Attack)
        'nVAhwpuwuFY', // Stroke Recovery: The Critical First Month
        'BdBsAkCpQtg', // Spasticity Treatment After Stroke
        '-3tAktnWlq8', // Post-Stroke Depression & Recovery Support
        'WAbz6l4zm7c', // Healthy Diet Tips for Stroke Prevention
        'p8q2ORXW5ts', // Preventing Brain Stroke Risks In Summers
    ],
    'parkinsons.php' => [
        'wzoHirIE8og', // Demystifying Parkinson's Disease & DBS
        'vU-KYEswDZ0', // Treatment for Tremors & Parkinson's
        'jp68Y0bYfuo', // DBS Surgery Candidate Selection
        'e2jhqLMxrg8', // Advanced Neuro-Rehabilitation Therapy
    ],
    'movement.php' => [
        'vU-KYEswDZ0', // Treatment for Tremors & Parkinson's
        'wzoHirIE8og', // Demystifying Parkinson's Disease & DBS
        'CLfWvubTAO0', // Restless Legs Syndrome Diagnosis
        'jp68Y0bYfuo', // DBS Surgery Candidate Selection
        '97iJMOfzbQ0', // Motor Neuron Disease (MND) Care Protocols
    ],
    'vertigo.php' => [
        'HHV_qGv5wCM', // Vertigo and Balance Disorders: Cure Without Pills
        'sXl0eyou7EU', // Vertigo: Relieved Without Pills!
        'x0PfxhAcnQ4', // Dizziness vs. Vertigo: Understanding Differences
    ],
    'ms.php' => [
        'dbJjk1_Y9Dw', // Managing Multiple Sclerosis Symptoms
        'DIdecCaF2Js', // Myasthenia Gravis: Diagnostic and Care Paths
        '479zCN2vdBQ', // Guillain-Barré Syndrome (GBS) Recovery
        'e2jhqLMxrg8', // Advanced Neuro-Rehabilitation Therapy
    ],
    'neuropathy.php' => [
        'gngiRwzLH20', // Nerve Pain and Neuropathy Treatment Options
        't8KS0TEkgl0', // Understanding Nerve Conduction Studies
        'pSLVKT1W93Q', // Understanding Neuromuscular Disorders
        '479zCN2vdBQ', // Guillain-Barré Syndrome (GBS) Recovery
        'bqibQJelNmU', // Dealing with Chronic Neurological Pain
        'KijjPIG3mtA', // Managing Trigeminal Neuralgia Pain
    ],

    // ── Service pages ────────────────────────────────────────────────
    'brain-tumor-surgery.php' => [
        'wiaiEgD_dtw', // Understanding Brain Tumors: Types & Stages
        'ohTGrS92kiE', // Management of Brain Infections
        '9AuZuZyI-Io', // Preventing Traumatic Brain Injury Complications
        'e2jhqLMxrg8', // Advanced Neuro-Rehabilitation Therapy
    ],
    'spine-surgery.php' => [
        'SfDdMcUCsBM', // Treating Cervical Spondylosis & Neck Pain
        'og9VMNrE7yk', // Management of Sciatica & Lower Back Pain
        'linE3GzsOYk', // Understanding Spinal Cord Injuries
        'r_FCRgtGl9Q', // Physical Therapy for Spinal Stenosis
        'zqOCl_r92kA', // Quick Tips for Back Pain Relief
    ],
    'functional-neurosurgery.php' => [
        'jp68Y0bYfuo', // DBS Surgery Candidate Selection
        'wzoHirIE8og', // Demystifying Parkinson's Disease & DBS
        'vU-KYEswDZ0', // Treatment for Tremors & Parkinson's
        '1lMG9FIfyR8', // rTMS Therapy for Brain Rehabilitation
    ],
    'neurovascular-surgery.php' => [
        'gns03zl4k7o', // Aneurysms and Neurovascular Care
        'yWkceIAx0I4', // Understanding TIA (Transient Ischemic Attack)
        '19eYLaT95jo', // Stroke Warning Signs & FAST Protocol
        'AomViYJ5yms', // Therapy Advancements in Neurocritical Care
    ],
    'memory-clinic.php' => [
        'gJuWUl08Urk', // Managing Dementia & Alzheimer's Care
        '3yhvFSFuPW4', // Alzheimer's Disease: Early Diagnostic Clues
        'nlZjfIk9Jws', // Prevention of Memory Loss & Dementia
        'VizML8pOj3g', // Protecting Memory as You Age
        '3TvNGdpDchU', // Cognitive Assessments in Elderly Patients
        'NZraszbqrt4', // Dementia Caregiver Survival Guide
        'RPrRp9h20kA', // Geriatric Neurology Care Guides
    ],
    'brain-health-center.php' => [
        'NFqg7wsC-sg', // Preventative Neurology & Healthy Brain Habits
        'iBvkymzjMWE', // How Stress Affects Your Brain
        'Yby46JYGC_0', // Management of Sleep Disorders
        'ox84BTy70gE', // Preventing Chronic Brain Fatigue
        'VizML8pOj3g', // Protecting Memory as You Age
    ],
    'neuro-rehabilitation-center.php' => [
        'e2jhqLMxrg8', // Advanced Neuro-Rehabilitation Therapy
        'BdBsAkCpQtg', // Spasticity Treatment After Stroke
        'nVAhwpuwuFY', // Stroke Recovery: The Critical First Month
        '1lMG9FIfyR8', // rTMS Therapy for Brain Rehabilitation
        'r_FCRgtGl9Q', // Physical Therapy for Spinal Stenosis
    ],
    'neurocritical-acute-stroke-care.php' => [
        'AomViYJ5yms', // Therapy Advancements in Neurocritical Care
        '19eYLaT95jo', // Stroke Warning Signs & FAST Protocol
        'QSVHJtC_Guc', // Brain Stroke Helpline & Emergency Response
        'nVAhwpuwuFY', // Stroke Recovery: The Critical First Month
    ],
    'brain-stroke-helpline.php' => [
        'QSVHJtC_Guc', // Brain Stroke Helpline & Emergency Response
        '19eYLaT95jo', // Stroke Warning Signs & FAST Protocol
        'LcBJlz040YY', // Recognizing Early Stroke Symptoms
        'yWkceIAx0I4', // Understanding TIA (Transient Ischemic Attack)
    ],
    'emergency-neurology-care.php' => [
        'QSVHJtC_Guc', // Brain Stroke Helpline & Emergency Response
        'e-totg4fbAQ', // Epilepsy First Aid: What to Do
        'AomViYJ5yms', // Therapy Advancements in Neurocritical Care
        '9AuZuZyI-Io', // Preventing Traumatic Brain Injury Complications
    ],
    'rtms-therapy.php' => [
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
    ],
    [
        'title' => 'Honours & Recognition - Image 8',
        'image' => 'assets/awards/8.jpg',
    ],
    [
        'title' => 'Honours & Recognition - Image 7',
        'image' => 'assets/awards/7.jpg',
    ],
    [
        'title' => 'Honours & Recognition - Image 6',
        'image' => 'assets/awards/6.jpg',
    ],
    [
        'title' => 'Honours & Recognition - Image 5',
        'image' => 'assets/awards/5.jpg',
    ],
    [
        'title' => 'Honours & Recognition - Image 4',
        'image' => 'assets/awards/4.jpg',
    ],
    [
        'title' => 'Honours & Recognition - Image 3',
        'image' => 'assets/awards/3.jpg',
    ],
    [
        'title' => 'Honours & Recognition - Image 2',
        'image' => 'assets/awards/2.jpg',
    ],
    [
        'title' => 'Honours & Recognition - Image 1',
        'image' => 'assets/awards/1.jpg',
    ],
    [
        'title' => 'Honours & Recognition - Image 15',
        'image' => 'assets/awards/15.jpg',
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
        'title' => 'Guillain-Barré Syndrome (GBS) Recovery',
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
 * Shared by videos.php and neurology-video-library.php so both pages
 * bucket the library identically — keep the filter buttons on those
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
        return 'brain-tumor-surgery.php';
    } elseif (strpos($titleLower, 'spine') !== false) {
        return 'spine-surgery.php';
    } elseif (strpos($titleLower, 'functional') !== false) {
        return 'functional-neurosurgery.php';
    } elseif (strpos($titleLower, 'neurovascular') !== false) {
        return 'neurovascular-surgery.php';
    } elseif (strpos($titleLower, 'geriatric') !== false || strpos($titleLower, 'dementia') !== false || strpos($titleLower, 'memory') !== false) {
        return 'memory-clinic.php';
    } elseif (strpos($titleLower, 'epilepsy') !== false) {
        return 'epilepsy.php';
    } elseif (strpos($titleLower, 'headache') !== false) {
        return 'headache.php';
    } elseif (strpos($titleLower, 'migraine') !== false) {
        return 'migraine.php';
    } elseif (strpos($titleLower, 'stroke') !== false || strpos($titleLower, 'neurocritical') !== false) {
        return 'brain-stroke-helpline.php';
    } elseif (strpos($titleLower, 'rehabilitation') !== false) {
        return 'neuro-rehabilitation-center.php';
    } elseif (strpos($titleLower, 'rtms') !== false) {
        return 'rtms-therapy.php';
    } elseif (strpos($titleLower, 'vertigo') !== false) {
        return 'vertigo.php';
    } elseif (strpos($titleLower, 'parkinson') !== false) {
        return 'parkinsons.php';
    } elseif (strpos($titleLower, 'multiple sclerosis') !== false || $titleLower === 'ms') {
        return 'ms.php';
    } elseif (strpos($titleLower, 'movement') !== false) {
        return 'movement.php';
    } elseif (strpos($titleLower, 'neuropathy') !== false) {
        return 'neuropathy.php';
    }
    return 'services.php';
}

