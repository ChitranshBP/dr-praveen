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
define('SITE_EMAIL', 'contact@drpraveengupta.com');
define('SITE_ADDRESS', 'New Delhi, India');

// Social Media
define('SOCIAL_FACEBOOK', 'https://facebook.com/drpraveengupta');
define('SOCIAL_INSTAGRAM', 'https://instagram.com/drpraveengupta');
define('SOCIAL_TWITTER', 'https://twitter.com/drpraveengupta');
define('SOCIAL_YOUTUBE', 'https://youtube.com/drpraveengupta');
define('SOCIAL_LINKEDIN', 'https://linkedin.com/in/drpraveengupta');

// Navigation
$navItems = [
    ['name' => 'Home', 'url' => 'index.php', 'active' => true],
    ['name' => 'About', 'url' => 'about.php', 'active' => false],
    ['name' => 'Services', 'url' => 'services.php', 'active' => false],
    ['name' => 'Gallery', 'url' => 'gallery.php', 'active' => false],
    ['name' => 'Blog', 'url' => 'blog.php', 'active' => false],
    ['name' => 'Contact', 'url' => 'contact.php', 'active' => false],
];

// Services
$services = [
    [
        'title' => 'Epilepsy',
        'description' => 'Advanced diagnosis and comprehensive management of seizures, using state-of-the-art EEG and personalized care plans.',
        'image' => 'https://images.unsplash.com/photo-1551076805-e18690bab3b4?auto=format&fit=crop&w=600&h=450&q=80'
    ],
    [
        'title' => 'Headache',
        'description' => 'Accurate diagnosis and targeted therapy for chronic, acute, and complex headache disorders to restore daily function.',
        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&h=450&q=80'
    ],
    [
        'title' => 'Migraine',
        'description' => 'Specialized migraine care plans including lifestyle advice, preventive medications, and advanced rescue therapies.',
        'image' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?auto=format&fit=crop&w=600&h=450&q=80'
    ],
    [
        'title' => 'Stroke',
        'description' => 'Rapid evaluation, stroke prevention strategies, and long-term neurological rehabilitation support.',
        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=600&h=450&q=80'
    ],
    [
        'title' => 'Vertigo',
        'description' => 'Detailed balance assessment and effective vestibular rehabilitation to address dizziness and inner-ear balance disorders.',
        'image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=600&h=450&q=80'
    ],
    [
        'title' => 'Parkinson\'s Disease',
        'description' => 'Comprehensive care plans combining modern pharmacology, motor therapy, and support for movement coordination.',
        'image' => 'https://images.unsplash.com/photo-1530026405186-ed1ea0ac7a63?auto=format&fit=crop&w=600&h=450&q=80'
    ],
    [
        'title' => 'Multiple Sclerosis',
        'description' => 'Advanced immunomodulatory therapies and tailored symptom management to improve mobility and slow progression.',
        'image' => 'https://images.unsplash.com/photo-1579154261294-11452aae9768?auto=format&fit=crop&w=600&h=450&q=80'
    ],
    [
        'title' => 'Movement Disorders',
        'description' => 'Expert management of tremors, dystonia, and other involuntary movements through clinical precision.',
        'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=600&h=450&q=80'
    ],
    [
        'title' => 'Peripheral Neuropathy',
        'description' => 'Diagnosis and targeted treatments to manage nerve damage, relieve chronic neuropathic pain, and restore sensation.',
        'image' => 'https://images.unsplash.com/photo-1603398938378-e54eab446dde?auto=format&fit=crop&w=600&h=450&q=80'
    ],
];

// Stats
$stats = [
    [
        'number' => '500K',
        'label' => 'Happy Patients',
        'description' => 'We take pride in the trust of over 500,000 patients whose health and happiness remain our top priorities.'
    ],
    [
        'number' => '100%',
        'label' => 'Satisfaction',
        'description' => 'Committed to delivering outstanding clinical outcomes and patient-first specialized care.'
    ],
    [
        'number' => '20+',
        'label' => 'Experience',
        'description' => 'Providing over two decades of expert medical diagnosis, treatment, and neurological care.'
    ],
    [
        'number' => '70+',
        'label' => 'Publications',
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
        'id'    => 'sXl0eyou7EU',
        'title' => 'Vertigo: Relieved Without Pills!',
        'desc'  => 'Learn how vertigo can be relieved effectively without medication from Dr. Praveen Gupta.',
    ],
    [
        'id'    => 'h50wGaV1y9Q',
        'title' => 'Say Goodbye to Headaches',
        'desc'  => 'Expert tips and medical insights on headache relief and migraine prevention by Dr. Praveen Gupta.',
    ],
    [
        'id'    => 'OJRq0VNLYIA',
        'title' => 'Managing Multiple Sclerosis',
        'desc'  => 'Comprehensive guide to Multiple Sclerosis diagnosis, symptom management, and treatments.',
    ],
    [
        'id'    => 'OKUjltLpKAc',
        'title' => 'Managing Dementia: Expert Tips',
        'desc'  => 'Practical strategies and expert tips from Dr. Praveen Gupta on managing dementia.',
    ],
];
