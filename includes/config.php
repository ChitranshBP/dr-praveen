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
        'icon' => 'heart',
        'title' => 'Cardiology',
        'description' => 'Comprehensive cardiac care with advanced diagnostics and personalized treatment plans.',
        'color' => 'blue'
    ],
    [
        'icon' => 'stethoscope',
        'title' => 'General Medicine',
        'description' => 'Holistic primary care focused on prevention, wellness, and long-term health.',
        'color' => 'cyan'
    ],
    [
        'icon' => 'shield',
        'title' => 'Preventive Care',
        'description' => 'Proactive health screenings and lifestyle guidance to keep you at your best.',
        'color' => 'indigo'
    ],
    [
        'icon' => 'brain',
        'title' => 'Neurology',
        'description' => 'Expert neurological assessment and treatment for complex conditions.',
        'color' => 'blue'
    ],
    [
        'icon' => 'activity',
        'title' => 'Diagnostics',
        'description' => 'State-of-the-art diagnostic services with rapid, accurate results.',
        'color' => 'cyan'
    ],
    [
        'icon' => 'users',
        'title' => 'Family Health',
        'description' => 'Compassionate care for every member of your family, from kids to seniors.',
        'color' => 'indigo'
    ],
];

// Stats
$stats = [
    ['number' => '25+', 'label' => 'Years Experience'],
    ['number' => '50K+', 'label' => 'Happy Patients'],
    ['number' => '15+', 'label' => 'Awards Won'],
    ['number' => '98%', 'label' => 'Patient Satisfaction'],
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
];
