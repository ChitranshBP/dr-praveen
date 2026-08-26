<?php
/**
 * Landing Page - Dr. Praveen Gupta (Standalone)
 * Lives inside /LP and does not modify the main codebase.
 * Assets are referenced from the parent directory via assets/
 */

// Settings managed from the CMS (/cms/lp-manager.php)
$lp = [];
if (is_file(dirname(__DIR__) . '/data/lp.json')) {
    $decoded = json_decode((string)file_get_contents(dirname(__DIR__) . '/data/lp.json'), true);
    if (is_array($decoded)) {
        $lp = $decoded;
    }
}
$lpHeroTitle    = trim((string)($lp['hero_title'] ?? ''));
$lpHeroSubtitle = trim((string)($lp['hero_subtitle'] ?? ''));

$email        = 'contact@drpraveengupta.com';
$address      = 'Marengo Asia Hospitals, Shushant Lok 2, Sector 56, Gurugram, Haryana 122011';

$stats = [
    ['number' => ($lp['stats_treated'] ?? '') !== '' ? $lp['stats_treated'] : '3,00,000+', 'label' => 'Patients Treated'],
    ['number' => ($lp['stats_stories'] ?? '') !== '' ? $lp['stats_stories'] : '1,00,000+', 'label' => 'Success Stories'],
    ['number' => ($lp['stats_awards'] ?? '') !== '' ? $lp['stats_awards'] : '50+',       'label' => 'Global Awards'],
    ['number' => ($lp['stats_experience'] ?? '') !== '' ? $lp['stats_experience'] : '20+',       'label' => 'Years of Experience'],
];

$conditions = [
    ['title' => 'Stroke',                    'desc' => 'Emergency stroke care, thrombolysis & mechanical thrombectomy.', 'image' => 'assets/services/stroke.png'],
    ['title' => 'Epilepsy & Seizures',       'desc' => 'Advanced diagnosis, EEG monitoring and seizure control.',        'image' => 'assets/services/epilepsy.png'],
    ['title' => "Parkinson's Disease",       'desc' => 'Deep Brain Stimulation (DBS) and movement disorder care.',       'image' => 'assets/services/parkinsons.png'],
    ['title' => 'Migraine',                  'desc' => 'Preventive therapies, Botox & CGRP antibody treatments.',        'image' => 'assets/services/migraine.png'],
    ['title' => 'Headache & Pain',           'desc' => 'Targeted care for chronic headaches and neuralgic pain.',        'image' => 'assets/services/headache.png'],
    ['title' => 'Multiple Sclerosis',        'desc' => 'Immunotherapy and long-term MS management programs.',            'image' => 'assets/services/ms.png'],
    ['title' => 'Vertigo & Balance',         'desc' => 'Vestibular rehabilitation to cure dizziness without pills.',     'image' => 'assets/services/vertigo.png'],
    ['title' => 'Movement Disorders',        'desc' => 'Tremor, dystonia and rigidity treatment with DBS expertise.',    'image' => 'assets/services/movement.png'],
    ['title' => 'Peripheral Neuropathy',     'desc' => 'Nerve pain, diabetic neuropathy and neuro-rehabilitation.',      'image' => 'assets/services/neuropathy.png'],
];

$testimonials = [
    ['name' => 'Atul Saxena',   'role' => "Patient's Son",  'message' => "I would like to express my heartfelt gratitude to Dr. Praveen Gupta and his outstanding team for the exceptional care during my mother's treatment for acute neuropathy. Dr. Gupta's clinical expertise, calm approach, and ability to explain every aspect of the treatment gave our family immense confidence."],
    ['name' => 'Yashu Jindal',  'role' => "Patient's Son",  'message' => "We are extremely grateful to Dr. Praveen Gupta for the exceptional care and treatment provided to my father during his brain stroke surgery. From the very beginning, Dr. Gupta guided us with confidence, clarity, and compassion during a very difficult time for our family."],
    ['name' => 'Dheeraj Tiwari','role' => 'Patient',        'message' => "Really good experience at Dr. Praveen Gupta's clinic. My vertigo and dizziness improved a lot. My condition was explained in a way I could easily understand. I felt much better after following the treatment. Highly recommended."],
    ['name' => 'Syed Mazhar Kandhlavi','role' => 'Patient', 'message' => "Dr. Praveen Gupta is a brilliant, empathetic, and very supportive physician. I struggled with a neurological disorder for a decade, but under his care, I was completely cured in 10 days. He is genuinely an embodiment of compassion and healing."],
    ['name' => 'Vandana Gera',  'role' => 'Patient',        'message' => "I am extremely grateful to Dr. Praveen Gupta for the exceptional care and attention throughout my treatment. The diagnosis was made after thorough and well-planned investigations, and treatment was started at the right time, making a significant difference."],
    ['name' => 'Seema Saini',   'role' => "Patient's Wife", 'message' => "My husband had been suffering from epilepsy for the last 3 years. Dr. Praveen Gupta told me in our very first meeting that my husband would get well, and the results are better now. My husband is doing well. Thank you, Sir."],
    ['name' => 'Jyoti Singh',   'role' => "Patient's Family",'message' => "My family member was admitted under Dr. Praveen Gupta and we are very thankful for the excellent treatment and attention provided throughout the stay. The doctor regularly monitored the patient's condition, explained progress clearly, and addressed all our concerns."],
    ['name' => 'Manjit Singh',  'role' => 'Patient',        'message' => "I would like to express my heartfelt gratitude to Dr. Praveen Gupta for his exceptional care and dedication. His vast knowledge, calm nature, and ability to patiently listen give immense confidence. He is always reachable and responds on time when needed."],
];

$videos = [
    ['id' => 'QhoPKOgHrwY', 'title' => 'Patient Recovery Story 1'],
    ['id' => 'kEwXD0aT_rQ', 'title' => 'Patient Recovery Story 2'],
    ['id' => 'jg4e8bjYl-A', 'title' => 'Patient Recovery Story 3'],
    ['id' => 'LNxm9G-IYZE', 'title' => 'Patient Recovery Story 4'],
    ['id' => '6UCSDoYncK8', 'title' => 'Patient Recovery Story 5'],
    ['id' => 'qj3Z1NhVxqU', 'title' => 'Patient Recovery Story 6'],
];
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TF2TXQLK');</script>
    <!-- End Google Tag Manager -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Praveen Gupta &ndash; Best Neurologist in Gurgaon | Book Appointment</title>
    <meta name="description" content="Consult Dr. Praveen Gupta, Chairman &ndash; Marengo Asia International Institute of Neuro & Spine. 20+ years of experience, 3,00,000+ patients treated. Book your appointment today.">
    <link rel="icon" type="image/x-icon" href="assets/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" href="assets/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'electric-blue': '#2563EB',
                        'cyan-accent': '#06B6D4',
                        'deep-indigo': '#1E1B4B',
                        'soft-cyan': '#ECFEFF',
                        'silver-grey': '#E5E7EB',
                        'dark-grey': '#111827',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'serif': ['Playfair Display', 'serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'fade-in': 'fadeIn 1s ease-out',
                        'slide-in-left': 'slideInLeft 0.8s ease-out',
                        'slide-in-right': 'slideInRight 0.8s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                        'gradient': 'gradient 8s ease infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideInLeft: {
                            '0%': { opacity: '0', transform: 'translateX(-50px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        },
                        slideInRight: {
                            '0%': { opacity: '0', transform: 'translateX(50px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        },
                        gradient: {
                            '0%, 100%': { 'background-position': '0% 50%' },
                            '50%': { 'background-position': '100% 50%' },
                        },
                        shimmer: {
                            '0%': { 'background-position': '-200% 0' },
                            '100%': { 'background-position': '200% 0' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" href="assets/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
        /* Hide scrollbar for Chrome, Safari and Opera */
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .scrollbar-none {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        /* Safe area bottom padding for sticky bar */
        .pb-safe {
            padding-bottom: calc(0.75rem + env(safe-area-inset-bottom, 0px));
        }
        .gradient-text {
            background: linear-gradient(135deg, #2563EB 0%, #06B6D4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1E1B4B 0%, #2563EB 50%, #06B6D4 100%);
            background-size: 200% 200%;
            animation: gradient 8s ease infinite;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.4;
            z-index: 0;
        }

        /* ===== NAVBAR STYLES ===== */
        .nav-link-anim {
            position: relative;
            overflow: hidden;
        }
        .nav-link-anim::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #2563EB, #06B6D4);
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        .nav-link-anim:hover::before,
        .nav-link-anim.active::before {
            width: 70%;
        }

        /* Individual liquid glass pill for each nav link */
        .nav-pill-link {
            padding: 0.45rem 1.05rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.92);
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.16), rgba(255, 255, 255, 0.06));
            border: 1px solid rgba(255, 255, 255, 0.28);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.28), 0 2px 8px rgba(2, 6, 23, 0.10);
            -webkit-backdrop-filter: blur(8px) saturate(160%);
            backdrop-filter: blur(8px) saturate(160%);
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.12);
            white-space: nowrap;
            transition: all 0.3s cubic-bezier(.4, 0, .2, 1);
        }
        .nav-pill-link:hover {
            color: #ffffff;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.30), rgba(255, 255, 255, 0.14));
            transform: translateY(-1px);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.40), 0 6px 18px rgba(2, 6, 23, 0.18);
        }
        .navbar-solid .nav-pill-link {
            color: #334155;
            text-shadow: none;
            background: linear-gradient(120deg, rgba(15, 23, 42, 0.045), rgba(15, 23, 42, 0.02));
            border-color: rgba(15, 23, 42, 0.10);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.90), 0 2px 8px rgba(15, 23, 42, 0.06);
        }
        .navbar-solid .nav-pill-link:hover {
            color: #2563EB;
            background: linear-gradient(120deg, rgba(37, 99, 235, 0.12), rgba(6, 182, 212, 0.08));
            border-color: rgba(37, 99, 235, 0.25);
            transform: translateY(-1px);
        }

        /* macOS-style liquid glass pill */
        .navbar-glass {
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.14), rgba(255, 255, 255, 0.06));
            backdrop-filter: blur(18px) saturate(160%);
            -webkit-backdrop-filter: blur(18px) saturate(160%);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px rgba(2, 6, 23, 0.28), inset 0 1px 0 rgba(255, 255, 255, 0.28);
        }
        .navbar-solid {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.75);
            box-shadow: 0 8px 32px rgba(15, 23, 42, 0.10), inset 0 1px 0 rgba(255, 255, 255, 0.95);
        }

        /* Navbar text colors for glass state */
        .navbar-glass .nav-title {
            color: #ffffff !important;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
        .navbar-glass .nav-subtitle {
            color: rgba(255, 255, 255, 0.85) !important;
        }
        .navbar-glass .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar-glass .nav-link:hover {
            color: #ffffff !important;
        }
        .navbar-glass .nav-link.active {
            background-color: #ffffff !important;
            color: #2563EB !important;
        }
        .navbar-glass .nav-icon-btn {
            color: #ffffff !important;
        }
        .navbar-glass .nav-icon-btn:hover {
            background: rgba(255, 255, 255, 0.15) !important;
        }

        /* Shimmer effect on CTA */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }
        .btn-shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s ease;
        }
        .btn-shimmer:hover::after {
            left: 100%;
        }

        /* Logo pulse ring */
        .logo-ring {
            position: relative;
        }
        .logo-ring::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 18px;
            background: linear-gradient(135deg, #2563EB, #06B6D4);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }
        .logo-ring:hover::before {
            opacity: 0.3;
        }

        /* Mobile liquid glass menu panel */
        .mobile-menu-panel {
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            right: 0;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.95);
            opacity: 0;
            transform: translateY(-12px) scale(0.97);
            transform-origin: top right;
            pointer-events: none;
            transition: opacity 0.35s cubic-bezier(.4, 0, .2, 1), transform 0.35s cubic-bezier(.4, 0, .2, 1);
            overflow: hidden;
            z-index: 60;
        }
        .mobile-menu-panel.open {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        /* Hamburger button states */
        #mobile-menu-btn {
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.30);
            color: #ffffff !important;
        }
        #mobile-menu-btn:hover {
            background: rgba(255, 255, 255, 0.20) !important;
        }
        .navbar-solid #mobile-menu-btn {
            background: rgba(15, 23, 42, 0.05);
            border-color: rgba(15, 23, 42, 0.12);
            color: #1e293b !important;
        }
        .navbar-solid #mobile-menu-btn:hover {
            background: rgba(15, 23, 42, 0.08) !important;
        }

        /* Offset anchor scroll for fixed navbar */
        section[id] { scroll-margin-top: 96px; }

        /* Scroll progress bar */
        .scroll-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            background: linear-gradient(90deg, #2563EB, #06B6D4);
            transition: width 0.1s ease;
        }

        /* Solid navbar: make glass-style elements visible on white background */
        .navbar-solid .nav-glass-el {
            background: rgba(0, 0, 0, 0.05) !important;
            border-color: rgba(0, 0, 0, 0.1) !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }
        .navbar-solid .nav-glass-el:hover {
            background: rgba(0, 0, 0, 0.08) !important;
        }
        .navbar-solid .nav-link.active {
            background: rgba(37, 99, 235, 0.1) !important;
            color: #2563EB !important;
        }
        .navbar-solid .nav-link:hover {
            background: rgba(0, 0, 0, 0.05) !important;
        }
            @keyframes marquee-scroll { from { transform: translateX(0); } to { transform: translateX(-50%); } } .marquee-track { animation: marquee-scroll 50s linear infinite; will-change: transform; } .marquee-track.marquee-reverse { animation-duration: 60s; animation-direction: reverse; } .marquee-wrap:hover .marquee-track { animation-play-state: paused; } @media (prefers-reduced-motion: reduce) { .marquee-track { animation: none; } } @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(30px); } 100% { opacity: 1; transform: translateY(0); } } .animate-fade-in-up { animation: fadeInUp 0.8s ease-out both; } </style>
</head>
<body class="bg-white text-dark-grey antialiased">

<!-- Navbar : Floating Liquid Glass Pill -->
<nav id="navbar" class="fixed top-0 left-0 w-full z-50 px-3 sm:px-6 pt-3 sm:pt-4">
    <div class="max-w-7xl mx-auto relative">
        <!-- Pill -->
        <div id="nav-pill" class="navbar-glass relative flex justify-between items-center h-14 sm:h-16 pl-4 pr-2 sm:pl-6 sm:pr-3 rounded-full overflow-hidden transition-all duration-500">
            <div class="scroll-progress" id="scroll-progress" style="width: 0%"></div>

            <!-- Logo -->
            <a href="#" class="flex items-center group">
                <img id="header-logo" src="assets/logo/NeuroDoc-final-logo.png" alt="Dr. Praveen Gupta - NeuroDoc Logo" class="h-8 sm:h-11 w-auto object-contain block group-hover:scale-[1.02] transition-transform duration-300 invert brightness-0">
            </a>

            <!-- Nav Links (Desktop) -->
            <div class="hidden lg:flex items-center space-x-1.5">
                <a href="#book" class="nav-pill-link">Home</a>
                <a href="#conditions" class="nav-pill-link">Conditions</a>
                <a href="#about" class="nav-pill-link">About</a>
                <a href="#testimonials" class="nav-pill-link">Testimonials</a>
                <a href="#videos" class="nav-pill-link">Videos</a>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center space-x-2 sm:space-x-3">
                <a href="#book" class="btn-shimmer group relative inline-flex items-center space-x-1.5 sm:space-x-2 bg-gradient-to-r from-electric-blue to-cyan-accent text-white text-xs sm:text-sm font-semibold pl-3.5 sm:pl-5 pr-1.5 sm:pr-2 py-1.5 sm:py-2 rounded-full hover:shadow-xl hover:shadow-electric-blue/40 transition-all duration-300 transform hover:-translate-y-0.5">
                    <span>Book Appointment</span>
                    <span class="w-5 h-5 sm:w-7 sm:h-7 rounded-full bg-white/20 flex items-center justify-center group-hover:rotate-45 transition-transform duration-300">
                        <i class="fas fa-arrow-right text-[8px] sm:text-[10px]"></i>
                    </span>
                </a>

                <!-- Hamburger (Mobile) -->
                <button id="mobile-menu-btn" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu" class="lg:hidden w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center flex-shrink-0 transition-all duration-300">
                    <i id="menu-icon" class="fas fa-bars text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Panel (Liquid Glass) -->
        <div id="mobile-menu" class="mobile-menu-panel lg:hidden">
            <div class="p-3">
                <nav class="flex flex-col space-y-2">
                    <a href="#book" class="flex items-center justify-between px-4 py-2.5 rounded-full bg-white/70 border border-slate-200/80 shadow-sm text-sm font-semibold text-deep-indigo hover:bg-electric-blue/10 hover:text-electric-blue hover:border-electric-blue/30 transition-all duration-200">
                        <span><i class="fas fa-house w-6 text-xs text-cyan-accent mr-2"></i>Home</span>
                        <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="#conditions" class="flex items-center justify-between px-4 py-2.5 rounded-full bg-white/70 border border-slate-200/80 shadow-sm text-sm font-semibold text-deep-indigo hover:bg-electric-blue/10 hover:text-electric-blue hover:border-electric-blue/30 transition-all duration-200">
                        <span><i class="fas fa-heart-pulse w-6 text-xs text-cyan-accent mr-2"></i>Conditions We Treat</span>
                        <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="#about" class="flex items-center justify-between px-4 py-2.5 rounded-full bg-white/70 border border-slate-200/80 shadow-sm text-sm font-semibold text-deep-indigo hover:bg-electric-blue/10 hover:text-electric-blue hover:border-electric-blue/30 transition-all duration-200">
                        <span><i class="fas fa-user-doctor w-6 text-xs text-cyan-accent mr-2"></i>About Dr. Praveen</span>
                        <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="#testimonials" class="flex items-center justify-between px-4 py-2.5 rounded-full bg-white/70 border border-slate-200/80 shadow-sm text-sm font-semibold text-deep-indigo hover:bg-electric-blue/10 hover:text-electric-blue hover:border-electric-blue/30 transition-all duration-200">
                        <span><i class="fas fa-quote-right w-6 text-xs text-cyan-accent mr-2"></i>Testimonials</span>
                        <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="#videos" class="flex items-center justify-between px-4 py-2.5 rounded-full bg-white/70 border border-slate-200/80 shadow-sm text-sm font-semibold text-deep-indigo hover:bg-electric-blue/10 hover:text-electric-blue hover:border-electric-blue/30 transition-all duration-200">
                        <span><i class="fas fa-video w-6 text-xs text-cyan-accent mr-2"></i>Videos</span>
                        <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                </nav>
                <div class="h-px bg-gradient-to-r from-transparent via-slate-300 to-transparent my-3 mx-4"></div>
                <div class="flex items-center justify-center space-x-3 pb-1">
                    <a href="https://www.instagram.com/neurodocpg?igsi=MzI5Y25hZDY2eDZw" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="w-9 h-9 rounded-full bg-white border border-slate-200 shadow-sm flex items-center justify-center text-deep-indigo hover:text-white hover:bg-gradient-to-br hover:from-electric-blue hover:to-cyan-accent hover:border-transparent transition-all duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/share/1DNxuR8Cqj/?mibextid=wwXIfr" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="w-9 h-9 rounded-full bg-white border border-slate-200 shadow-sm flex items-center justify-center text-deep-indigo hover:text-white hover:bg-gradient-to-br hover:from-electric-blue hover:to-cyan-accent hover:border-transparent transition-all duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://youtube.com/@neuro_doc?si=g5fPVsZLdMZjFALm" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="w-9 h-9 rounded-full bg-white border border-slate-200 shadow-sm flex items-center justify-center text-deep-indigo hover:text-white hover:bg-gradient-to-br hover:from-electric-blue hover:to-cyan-accent hover:border-transparent transition-all duration-300">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/dr-praveen-gupta-635b9317?utm_source=share_via&utm_content=profile&utm_medium=member_ios" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="w-9 h-9 rounded-full bg-white border border-slate-200 shadow-sm flex items-center justify-center text-deep-indigo hover:text-white hover:bg-gradient-to-br hover:from-electric-blue hover:to-cyan-accent hover:border-transparent transition-all duration-300">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('nav-pill');
        const headerLogo = document.getElementById('header-logo');
        const scrollProgress = document.getElementById('scroll-progress');

        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');

        function closeMobileMenu() {
            mobileMenu.classList.remove('open');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            menuIcon.classList.remove('fa-xmark');
            menuIcon.classList.add('fa-bars');
        }

        mobileMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = mobileMenu.classList.toggle('open');
            mobileMenuBtn.setAttribute('aria-expanded', String(isOpen));
            menuIcon.classList.toggle('fa-bars', !isOpen);
            menuIcon.classList.toggle('fa-xmark', isOpen);
        });

        mobileMenu.querySelectorAll('a[href^="#"]').forEach(function(link) {
            link.addEventListener('click', closeMobileMenu);
        });

        document.addEventListener('click', function(e) {
            if (mobileMenu.classList.contains('open') && !mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                closeMobileMenu();
            }
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) closeMobileMenu();
        });

        function updateNavbar() {
            const scrollY = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? (scrollY / docHeight) * 100 : 0;
            if (scrollProgress) scrollProgress.style.width = progress + '%';

            if (scrollY > 50) {
                navbar.classList.remove('navbar-glass');
                navbar.classList.add('navbar-solid');
                if (headerLogo) headerLogo.classList.remove('invert', 'brightness-0');
            } else {
                navbar.classList.remove('navbar-solid');
                navbar.classList.add('navbar-glass');
                if (headerLogo) headerLogo.classList.add('invert', 'brightness-0');
            }
        }

        window.addEventListener('scroll', updateNavbar, { passive: true });
        updateNavbar();
    });
</script>

<!-- ════════ Hero : Content Left / Form Right ════════ -->
<section id="book" class="relative overflow-hidden">
    <!-- Flipped Background Image -->
    <div class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('assets/banner/web-banner-hero.webp'); transform: scaleX(-1);"></div>
    <!-- Advanced Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/70 to-deep-indigo/30 pointer-events-none z-0"></div>
    <div class="absolute inset-0 bg-black/20 z-0"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 sm:pt-32 lg:pt-36 pb-8 sm:pb-14 lg:pb-20 z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-8 lg:gap-12 items-center">

            <!-- Left : Content -->
            <div class="lg:col-span-7 text-white observe">
                <div class="inline-flex items-center space-x-1.5 sm:space-x-2 bg-white/10 backdrop-blur-md border border-white/20 px-2.5 py-1 sm:px-4 sm:py-2 rounded-full mb-2.5 sm:mb-6 shadow-[0_0_15px_rgba(255,255,255,0.1)] hover:bg-white/15 transition-all cursor-default">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-cyan-accent animate-pulse shadow-[0_0_10px_#06B6D4]"></span>
                    <span class="text-[9px] sm:text-xs font-bold uppercase tracking-wider text-cyan-50">Chairman - Marengo Asia International Institute of Neuro & Spine</span>
                </div>

                <h1 class="text-2xl sm:text-4xl md:text-5xl xl:text-6xl font-serif font-extrabold leading-tight mb-2.5 sm:mb-6 drop-shadow-2xl">
                    <?php if ($lpHeroTitle !== ''): ?>
                        <?php echo htmlspecialchars($lpHeroTitle); ?>
                    <?php else: ?>
                        Consult <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 via-white to-cyan-100 drop-shadow-md">Dr. Praveen Gupta</span><br class="hidden sm:inline">
                        <span class="text-xl sm:text-4xl md:text-5xl xl:text-6xl font-serif font-bold text-white/95">Best Neurologist in Gurgaon</span>
                    <?php endif; ?>
                </h1>

                <div class="bg-white/5 backdrop-blur-sm border-l-2 sm:border-l-4 border-cyan-accent p-2.5 sm:p-4 mb-3 sm:mb-8 rounded-r-xl">
                    <p class="text-xs sm:text-base md:text-xl text-white/95 leading-snug sm:leading-relaxed font-medium">
                        <?php if ($lpHeroSubtitle !== ''): ?>
                            <?php echo htmlspecialchars($lpHeroSubtitle); ?>
                        <?php else: ?>
                            20+ years of pioneering brain &amp; spine care &bull; DM (AIIMS, New Delhi) &bull; Trusted by
                            <strong class="text-white font-bold">3,00,000+ patients</strong> for stroke, epilepsy, Parkinson's, migraine and complex neurological disorders.
                        <?php endif; ?>
                    </p>
                </div>

                <ul class="grid grid-cols-2 gap-2 sm:gap-y-4 sm:gap-x-6 mb-3 sm:mb-10 text-[11px] sm:text-sm">
                    <li class="flex items-center space-x-1.5 sm:space-x-3 group">
                        <div class="flex-shrink-0 w-4 h-4 sm:w-6 sm:h-6 rounded-full bg-cyan-400/25 border border-cyan-300/40 flex items-center justify-center group-hover:bg-cyan-400/40 transition-colors">
                            <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 text-cyan-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-white/90 font-medium leading-tight">First stroke centre in Gurugram</span>
                    </li>
                    <li class="flex items-center space-x-1.5 sm:space-x-3 group">
                        <div class="flex-shrink-0 w-4 h-4 sm:w-6 sm:h-6 rounded-full bg-cyan-400/25 border border-cyan-300/40 flex items-center justify-center group-hover:bg-cyan-400/40 transition-colors">
                            <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 text-cyan-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-white/90 font-medium leading-tight">First epileptic DBS surgery in Asia</span>
                    </li>
                    <li class="flex items-center space-x-1.5 sm:space-x-3 group">
                        <div class="flex-shrink-0 w-4 h-4 sm:w-6 sm:h-6 rounded-full bg-cyan-400/25 border border-cyan-300/40 flex items-center justify-center group-hover:bg-cyan-400/40 transition-colors">
                            <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 text-cyan-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-white/90 font-medium leading-tight">First DBS for Parkinson's in Gurugram</span>
                    </li>
                    <li class="flex items-center space-x-1.5 sm:space-x-3 group">
                        <div class="flex-shrink-0 w-4 h-4 sm:w-6 sm:h-6 rounded-full bg-cyan-400/25 border border-cyan-300/40 flex items-center justify-center group-hover:bg-cyan-400/40 transition-colors">
                            <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 text-cyan-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-white/90 font-medium leading-tight">Pioneered BMT for neuro disorders</span>
                    </li>
                </ul>

                
            </div>

            <!-- Right : Appointment Form -->
            <div class="lg:col-span-5 relative mt-2 sm:mt-8 lg:mt-0">
                <!-- Glowing backdrop blob -->
                <div class="absolute -inset-2 bg-gradient-to-br from-electric-blue/40 to-cyan-accent/40 rounded-2xl sm:rounded-[3rem] blur-xl sm:blur-2xl opacity-60 pointer-events-none"></div>
                <div class="bg-white/95 backdrop-blur-3xl rounded-2xl sm:rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.3)] p-4 sm:p-7 md:p-9 border border-white/50 relative z-10 observe">
                    <div class="text-center mb-3 sm:mb-6">
                        <div class="hidden sm:inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-electric-blue to-cyan-accent text-white text-2xl mb-4 shadow-xl shadow-electric-blue/40 transform -translate-y-4">
                            <i class="fas fa-calendar-check animate-pulse"></i>
                        </div>
                        <h2 class="text-lg sm:text-2xl font-serif font-bold text-deep-indigo mb-0.5 sm:mb-1.5">Book Your Appointment</h2>
                        <p class="text-xs sm:text-sm font-medium text-dark-grey/60">Fill the form and our care team will call you back shortly.</p>
                    </div>

                    <form id="appointment-form" class="space-y-2.5 sm:space-y-4" accept-charset="UTF-8" action="../api/save-lead.php" method="POST">
                        <input type="hidden" name="form_key" value="lp">
                        <input type="hidden" name="form_type" value="Landing Page Appointment">
                        <!-- Honeypot (hidden from humans, catches bots) -->
                        <div class="hidden" aria-hidden="true">
                            <label for="lp-website">Website</label>
                            <input type="text" id="lp-website" name="website" tabindex="-1" autocomplete="off">
                        </div>
                        <div>
                            <label for="lp-name" class="block text-[10px] sm:text-xs font-bold text-dark-grey/70 uppercase tracking-wider mb-1 sm:mb-1.5">Full Name *</label>
                            <input type="text" id="lp-name" name="name" required placeholder="Enter your full name"
                                   class="w-full px-3.5 py-2.5 sm:px-5 sm:py-3.5 rounded-xl sm:rounded-2xl border border-slate-200 bg-slate-50/50 text-xs sm:text-sm font-medium focus:outline-none focus:bg-white focus:ring-4 focus:ring-electric-blue/10 focus:border-electric-blue transition-all shadow-sm">
                        </div>
                        <div>
                            <label for="lp-phone" class="block text-[10px] sm:text-xs font-bold text-dark-grey/70 uppercase tracking-wider mb-1 sm:mb-1.5">Phone Number *</label>
                            <input type="tel" id="lp-phone" name="phone" required pattern="[0-9+ ]{10,15}" placeholder="Enter your mobile number"
                                   class="w-full px-3.5 py-2.5 sm:px-5 sm:py-3.5 rounded-xl sm:rounded-2xl border border-slate-200 bg-slate-50/50 text-xs sm:text-sm font-medium focus:outline-none focus:bg-white focus:ring-4 focus:ring-electric-blue/10 focus:border-electric-blue transition-all shadow-sm">
                        </div>
                        <div>
                            <label for="lp-condition" class="block text-[10px] sm:text-xs font-bold text-dark-grey/70 uppercase tracking-wider mb-1 sm:mb-1.5">Condition / Concern *</label>
                            <select id="lp-condition" name="condition" required
                                    class="w-full px-3.5 py-2.5 sm:px-5 sm:py-3.5 rounded-xl sm:rounded-2xl border border-slate-200 bg-slate-50/50 text-xs sm:text-sm font-medium text-dark-grey focus:outline-none focus:bg-white focus:ring-4 focus:ring-electric-blue/10 focus:border-electric-blue transition-all shadow-sm">
                                <option value="" disabled selected>Select your concern</option>
                                <option>Stroke</option>
                                <option>Epilepsy / Seizures</option>
                                <option>Parkinson's Disease</option>
                                <option>Migraine / Headache</option>
                                <option>Multiple Sclerosis</option>
                                <option>Vertigo / Dizziness</option>
                                <option>Movement Disorder / Tremors</option>
                                <option>Neuropathy / Nerve Pain</option>
                                <option>Second Opinion</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="lp-message" class="block text-[10px] sm:text-xs font-bold text-dark-grey/70 uppercase tracking-wider mb-1 sm:mb-1.5">Message (Optional)</label>
                            <textarea id="lp-message" name="message" rows="2" placeholder="Briefly describe your symptoms..."
                                      class="w-full px-3.5 py-2.5 sm:px-5 sm:py-3.5 rounded-xl sm:rounded-2xl border border-slate-200 bg-slate-50/50 text-xs sm:text-sm font-medium focus:outline-none focus:bg-white focus:ring-4 focus:ring-electric-blue/10 focus:border-electric-blue transition-all resize-none shadow-sm sm:rows-3"></textarea>
                        </div>

                        <button type="submit"
                                class="btn-shimmer relative w-full inline-flex items-center justify-center space-x-2 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold py-3 sm:py-4 rounded-xl shadow-xl shadow-electric-blue/30 hover:-translate-y-0.5 transition-all duration-300 overflow-hidden text-xs sm:text-sm">
                            <span id="form-btn-text">Request Callback</span>
                            <i class="fas fa-arrow-right text-[10px] sm:text-xs"></i>
                        </button>

                        <p id="form-status" class="hidden text-center text-xs sm:text-sm font-semibold rounded-xl px-3 py-2 sm:px-4 sm:py-3"></p>

                        <p class="text-[10px] sm:text-[11px] text-dark-grey/45 text-center leading-relaxed">
                            <i class="fas fa-lock mr-1"></i>Your information is private and secure.
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ════════ Stats : Modern Premium Design ════════ -->
<section class="py-16 md:py-24 bg-gradient-to-br from-blue-50 to-cyan-50 relative overflow-hidden">
    <!-- Background Accents -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-electric-blue/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-cyan-accent/10 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16 observe">
            <h2 class="text-3xl md:text-5xl font-serif font-bold text-gray-800 mb-4">
                A Legacy of <span class="text-transparent bg-clip-text bg-gradient-to-r from-electric-blue to-cyan-accent">Healing & Hope</span>
            </h2>
            <p class="text-lg text-gray-600 font-medium">
                Pioneering treatments and compassionate care that have transformed countless lives globally.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            <?php foreach ($stats as $index => $stat): ?>
                <div class="relative group observe text-center" style="transition-delay: <?php echo $index * 100; ?>ms;">
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-500 border border-gray-100">
                        <div class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-electric-blue to-cyan-accent mb-3 tracking-tight">
                            <?php echo $stat['number']; ?>
                        </div>
                        <div class="text-base font-semibold text-gray-600 uppercase tracking-wider">
                            <?php echo $stat['label']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ════════ Conditions We Treat ════════ -->
<section id="conditions" class="py-12 md:py-16 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-brain text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Expert Care</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo mb-3">
                Conditions We <span class="gradient-text">Treat</span>
            </h2>
            <p class="text-lg text-dark-grey/70">
                Comprehensive diagnosis and advanced treatment for the full spectrum of neurological disorders.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($conditions as $cond): ?>
                <div class="group bg-white rounded-3xl p-6 shadow-lg hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 border border-silver-grey/50 flex flex-col observe">
                    <div class="w-12 h-12 rounded-full bg-soft-cyan text-electric-blue flex items-center justify-center mb-4 group-hover:bg-electric-blue group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-brain text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-deep-indigo mb-2 group-hover:text-electric-blue transition-colors"><?php echo $cond['title']; ?></h3>
                    <p class="text-sm text-dark-grey/70 leading-relaxed"><?php echo $cond['desc']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-10 text-center observe">
            <a href="#book" class="btn-shimmer group relative inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                <span>Book Appointment</span>
                <i class="fas fa-arrow-right text-xs transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- About Doctor -->
<section id="about" class="py-12 md:py-16 bg-soft-cyan/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <div class="lg:col-span-5 relative observe">
                <div class="absolute -inset-4 bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 rounded-[3rem] blur-2xl opacity-60 pointer-events-none"></div>
                <div class="aspect-[4/5] rounded-[2.5rem] overflow-hidden border border-silver-grey/50 shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey relative group z-10">
                    <div class="absolute inset-0 bg-gradient-to-tr from-electric-blue/10 to-transparent mix-blend-overlay z-10 pointer-events-none"></div>
                    <img src="assets/dpg-1.webp" alt="Dr. Praveen Gupta, Neurologist" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 relative z-0">
                    <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-deep-indigo/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>
                </div>
            </div>

            <div class="lg:col-span-7 observe">
                <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                    <i class="fas fa-user-md text-electric-blue text-sm"></i>
                    <span class="text-electric-blue text-sm font-semibold">About Dr. Praveen Gupta</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo leading-tight mb-4">
                    Dr. Praveen Gupta  <span class="gradient-text">Best Neurologist</span> in India
                </h2>

                <div class="flex flex-col space-y-2.5 mb-6">
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-award text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chairman &ndash; Marengo Asia International Institute of Neuro and Spine</span>
                    </div>
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-chart-line text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chief Clinical Strategy Growth and Innovation, North India</span>
                    </div>
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-lightbulb text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chief Mentor for Start-ups</span>
                    </div>
                </div>

                <p class="text-base text-dark-grey/85 mb-4 leading-relaxed">
                    With over 20 years of clinical experience and a DM from AIIMS, New Delhi, Dr. Praveen Gupta has emerged as a
                    pioneering force in the diagnosis, treatment, and advancement of neurological sciences &mdash; a name synonymous
                    with excellence and trust across India and beyond.
                </p>

                <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm text-dark-grey/80 border-l-2 border-cyan-accent/30 pl-4 py-1">
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 bg-electric-blue rounded-full mt-2 flex-shrink-0"></span>
                        <span>Founder of the first stroke centre in Gurugram</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 bg-electric-blue rounded-full mt-2 flex-shrink-0"></span>
                        <span>Performed the first solo mechanical thrombolysis in the region</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 bg-electric-blue rounded-full mt-2 flex-shrink-0"></span>
                        <span>Led the first Deep Brain Stimulation (DBS) procedure in Gurugram</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 bg-electric-blue rounded-full mt-2 flex-shrink-0"></span>
                        <span>Conducted the first epileptic DBS surgery in Asia</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 bg-electric-blue rounded-full mt-2 flex-shrink-0"></span>
                        <span>Pioneered Bone Marrow Transplant (BMT) for autoimmune neurological disorders</span>
                    </li>
                </ul>

                <a href="#book" class="btn-shimmer group relative inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <span>Book an Appointment</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-12 md:py-16 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <div class="lg:col-span-7 observe">
                <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                    <i class="fas fa-heart text-electric-blue text-sm"></i>
                    <span class="text-electric-blue text-sm font-semibold">Why Patients Trust Us</span>
                </div>

                <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo leading-tight mb-4">
                    Compassionate Care That <span class="gradient-text">Puts You First</span>
                </h2>

                <p class="text-lg text-dark-grey/70 mb-10 leading-relaxed max-w-xl">
                    When it comes to your brain and spine health, expert care makes all the difference. We combine expert clinical
                    care, advanced neuroscience, and compassionate support to guide you from diagnosis to recovery.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-10">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-soft-cyan border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-hand-holding-heart text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Patient-First Care</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">We listen closely to your concerns, explain things simply, and tailor treatments to your life.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-soft-cyan border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-lightbulb text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Pioneering Treatment</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Access to India's latest advancements in stroke recovery, brain therapies, and care.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-soft-cyan border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-circle-check text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Proven Recovery</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Over 20 years of experience helping thousands of families return to active, healthy lives.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-soft-cyan border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-shield-halved text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Complete Support</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">From consultations to home care guidelines, we stand by your family through healing.</p>
                        </div>
                    </div>
                </div>

                <a href="#book" class="btn-shimmer group relative inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <span>Get Started</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="lg:col-span-5 relative flex justify-center lg:justify-end observe">
                <div class="relative w-full max-w-md aspect-[4/5] rounded-3xl overflow-hidden border border-silver-grey/50 shadow-lg bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/full-image/dpg-award.webp" alt="Dr. Praveen Gupta receiving an award" loading="lazy" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section id="testimonials" class="py-12 md:py-16 bg-soft-cyan/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-quote-right text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Testimonials</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo mb-3">
                What Our <span class="gradient-text">Patients</span> Say
            </h2>
            <p class="text-lg text-dark-grey/70">Real stories from real patients who experienced exceptional neurological care.</p>
        </div>
    </div>

    <div class="marquee-wrap relative observe">
        <div class="overflow-hidden">
            <div class="marquee-track flex w-max">
                <?php foreach ($testimonials as $t): ?>
                    <div class="quote-card w-[300px] sm:w-[360px] flex-shrink-0 mr-6">
                        <div class="h-full bg-white rounded-3xl p-7 border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-shadow duration-500 flex flex-col">
                            <div class="flex items-center space-x-1 mb-4 text-amber-400 text-sm">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="text-dark-grey/75 text-sm leading-relaxed flex-1 mb-5"><?php echo $t['message']; ?></p>
                            <div class="w-full h-px bg-silver-grey mb-4"></div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-electric-blue to-cyan-accent flex items-center justify-center text-white font-bold text-sm shadow-md flex-shrink-0">
                                    <?php echo strtoupper(substr($t['name'], 0, 1)); ?>
                                </div>
                                <div>
                                    <p class="font-bold text-deep-indigo text-sm leading-tight"><?php echo $t['name']; ?></p>
                                    <p class="text-xs text-cyan-accent font-medium mt-0.5"><?php echo $t['role']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="absolute inset-y-0 left-0 w-12 md:w-32 bg-gradient-to-r from-soft-cyan to-transparent pointer-events-none z-10"></div>
        <div class="absolute inset-y-0 right-0 w-12 md:w-32 bg-gradient-to-l from-soft-cyan to-transparent pointer-events-none z-10"></div>
        <div class="mt-10 text-center observe relative z-20">
            <a href="#book" class="btn-shimmer group relative inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                <span>Book Appointment</span>
                <i class="fas fa-arrow-right text-xs transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- Videos -->
<section id="videos" class="py-12 md:py-16 bg-deep-indigo relative overflow-hidden">
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-electric-blue/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-cyan-accent/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-play-circle text-cyan-accent text-sm"></i>
                <span class="text-white text-sm font-semibold">Video Testimonials</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-3">
                Hear It From Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-200 to-cyan-accent">Patients</span>
            </h2>
            <p class="text-lg text-white/70">Watch patients share their recovery journeys with Dr. Praveen Gupta in their own words.</p>
        </div>

        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 pb-4 -mx-4 px-4 md:mx-0 md:px-0 md:grid md:grid-cols-3 lg:grid-cols-6 md:pb-0">
            <?php foreach ($videos as $video): ?>
                <div class="w-[62vw] sm:w-[38vw] md:w-auto flex-shrink-0 snap-start">
                    <div class="group relative w-full aspect-[9/16] rounded-3xl overflow-hidden bg-black/40 border border-white/10 shadow-xl hover:shadow-cyan-accent/20 hover:-translate-y-1.5 transition-all duration-500 cursor-pointer video-card" data-video-id="<?php echo $video['id']; ?>">
                        <img src="https://img.youtube.com/vi/<?php echo $video['id']; ?>/hqdefault.jpg"
                             alt="<?php echo htmlspecialchars($video['title']); ?>" loading="lazy"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-deep-indigo/90 via-deep-indigo/10 to-transparent"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="w-14 h-14 rounded-full bg-white/15 backdrop-blur-md border border-white/40 flex items-center justify-center text-white text-lg shadow-lg group-hover:bg-cyan-accent group-hover:scale-110 transition-all duration-300">
                                <i class="fas fa-play ml-1"></i>
                            </span>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 pointer-events-none">
                            <p class="text-white font-bold text-xs leading-snug"><?php echo htmlspecialchars($video['title']); ?></p>
                            <p class="text-cyan-200 text-[10px] font-medium mt-1">Patient Testimonial</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        
        <div class="mt-10 text-center observe">
            <a href="#book" class="btn-shimmer group relative inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                <span>Book Appointment</span>
                <i class="fas fa-arrow-right text-xs transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-deep-indigo text-white relative overflow-hidden border-t border-white/10">
    <div class="h-1 bg-gradient-to-r from-electric-blue via-cyan-accent to-electric-blue"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">

            <div class="lg:col-span-4">
                <div class="mb-6">
                    <img src="assets/logo/NeuroDoc-final-logo.png" alt="Dr. Praveen Gupta - NeuroDoc Logo" width="200" height="56" class="h-16 w-auto object-contain block invert brightness-0">
                </div>
                <p class="text-white/70 leading-relaxed mb-6 text-sm">
                    Providing exceptional neurological care with compassion and expertise for over 20 years. Your trusted partner in brain and spine health.
                </p>
                <div class="flex items-center space-x-4 mb-6">
                    <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                        <div class="text-lg font-bold text-white">300K+</div>
                        <div class="text-[10px] text-white/60 uppercase tracking-wide">Patients</div>
                    </div>
                    <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                        <div class="text-lg font-bold text-white">50+</div>
                        <div class="text-[10px] text-white/60 uppercase tracking-wide">Awards</div>
                    </div>
                    <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                        <div class="text-lg font-bold text-white">4.9 <i class="fas fa-star text-amber-400 text-xs"></i></div>
                        <div class="text-[10px] text-white/60 uppercase tracking-wide">Rating</div>
                    </div>
                </div>
                <div>
                    <h3 class="text-base font-bold mb-4 flex items-center">
                        <span class="w-1 h-5 bg-gradient-to-b from-electric-blue to-cyan-accent rounded-full mr-3"></span>
                        Follow Us
                    </h3>
                    <div class="flex items-center space-x-3">
                        <a href="https://www.instagram.com/neurodocpg?igsi=MzI5Y25hZDY2eDZw" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/70 hover:text-white hover:bg-gradient-to-br hover:from-electric-blue hover:to-cyan-accent hover:border-transparent hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-instagram text-lg"></i>
                        </a>
                        <a href="https://www.facebook.com/share/1DNxuR8Cqj/?mibextid=wwXIfr" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/70 hover:text-white hover:bg-gradient-to-br hover:from-electric-blue hover:to-cyan-accent hover:border-transparent hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-facebook-f text-lg"></i>
                        </a>
                        <a href="https://youtube.com/@neuro_doc?si=g5fPVsZLdMZjFALm" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/70 hover:text-white hover:bg-gradient-to-br hover:from-electric-blue hover:to-cyan-accent hover:border-transparent hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-youtube text-lg"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/dr-praveen-gupta-635b9317?utm_source=share_via&utm_content=profile&utm_medium=member_ios" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/70 hover:text-white hover:bg-gradient-to-br hover:from-electric-blue hover:to-cyan-accent hover:border-transparent hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-linkedin-in text-lg"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <h3 class="text-base font-bold mb-5 flex items-center">
                    <span class="w-1 h-5 bg-gradient-to-b from-electric-blue to-cyan-accent rounded-full mr-3"></span>
                    Quick Links
                </h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="#book" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-2 group"><i class="fas fa-chevron-right text-[10px] text-cyan-accent/60"></i><span>Book Appointment</span></a></li>
                    <li><a href="#conditions" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-2 group"><i class="fas fa-chevron-right text-[10px] text-cyan-accent/60"></i><span>Conditions We Treat</span></a></li>
                    <li><a href="#about" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-2 group"><i class="fas fa-chevron-right text-[10px] text-cyan-accent/60"></i><span>About Dr. Praveen</span></a></li>
                    <li><a href="#testimonials" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-2 group"><i class="fas fa-chevron-right text-[10px] text-cyan-accent/60"></i><span>Testimonials</span></a></li>
                    <li><a href="#videos" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-2 group"><i class="fas fa-chevron-right text-[10px] text-cyan-accent/60"></i><span>Videos</span></a></li>
                    <li><a href="../index" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-2 group"><i class="fas fa-chevron-right text-[10px] text-cyan-accent/60"></i><span>Main Website</span></a></li>
                </ul>
            </div>

            <div class="lg:col-span-3">
                <h3 class="text-base font-bold mb-5 flex items-center">
                    <span class="w-1 h-5 bg-gradient-to-b from-electric-blue to-cyan-accent rounded-full mr-3"></span>
                    Conditions We Treat
                </h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="#conditions" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-3 group"><span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-cyan-accent/20 flex items-center justify-center flex-shrink-0 transition-all"><i class="fas fa-heart-pulse text-[10px] text-cyan-accent/70"></i></span><span>Stroke Care</span></a></li>
                    <li><a href="#conditions" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-3 group"><span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-cyan-accent/20 flex items-center justify-center flex-shrink-0 transition-all"><i class="fas fa-bolt text-[10px] text-cyan-accent/70"></i></span><span>Epilepsy &amp; Seizures</span></a></li>
                    <li><a href="#conditions" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-3 group"><span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-cyan-accent/20 flex items-center justify-center flex-shrink-0 transition-all"><i class="fas fa-walking text-[10px] text-cyan-accent/70"></i></span><span>Parkinson's Disease</span></a></li>
                    <li><a href="#conditions" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-3 group"><span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-cyan-accent/20 flex items-center justify-center flex-shrink-0 transition-all"><i class="fas fa-brain text-[10px] text-cyan-accent/70"></i></span><span>Migraine &amp; Headache</span></a></li>
                    <li><a href="#conditions" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-3 group"><span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-cyan-accent/20 flex items-center justify-center flex-shrink-0 transition-all"><i class="fas fa-ribbon text-[10px] text-cyan-accent/70"></i></span><span>Multiple Sclerosis</span></a></li>
                    <li><a href="#conditions" class="text-white/70 hover:text-cyan-accent transition-colors flex items-center space-x-3 group"><span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-cyan-accent/20 flex items-center justify-center flex-shrink-0 transition-all"><i class="fas fa-sync text-[10px] text-cyan-accent/70"></i></span><span>Vertigo &amp; Balance</span></a></li>
                </ul>
            </div>

            <div class="lg:col-span-3">
                <h3 class="text-base font-bold mb-5 flex items-center">
                    <span class="w-1 h-5 bg-gradient-to-b from-electric-blue to-cyan-accent rounded-full mr-3"></span>
                    Get In Touch
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 group-hover:from-electric-blue group-hover:to-cyan-accent flex items-center justify-center flex-shrink-0 transition-all duration-300">
                            <i class="fas fa-map-marker-alt text-cyan-accent group-hover:text-white transition-colors text-sm"></i>
                        </div>
                        <div class="pt-1">
                            <p class="text-white/70 text-xs font-medium">Our Location</p>
                            <p class="text-white/90 text-sm font-semibold"><?php echo $address; ?></p>
                        </div>
                    </li>
                    
                    <li class="flex items-start space-x-3 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 group-hover:from-electric-blue group-hover:to-cyan-accent flex items-center justify-center flex-shrink-0 transition-all duration-300">
                            <i class="fas fa-envelope text-cyan-accent group-hover:text-white transition-colors text-sm"></i>
                        </div>
                        <div class="pt-1">
                            <p class="text-white/70 text-xs font-medium">Email Us</p>
                            <a href="mailto:<?php echo $email; ?>" class="text-white/90 text-sm font-semibold hover:text-cyan-accent transition-colors break-all"><?php echo $email; ?></a>
                        </div>
                    </li>
                    <li class="flex items-start space-x-3 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 group-hover:from-electric-blue group-hover:to-cyan-accent flex items-center justify-center flex-shrink-0 transition-all duration-300">
                            <i class="fas fa-clock text-cyan-accent group-hover:text-white transition-colors text-sm"></i>
                        </div>
                        <div class="pt-1">
                            <p class="text-white/70 text-xs font-medium">Working Hours</p>
                            <p class="text-white/90 text-sm font-semibold">Mon - Sat: 9 AM - 7 PM</p>
                            <p class="text-white/60 text-xs">Sunday: Closed</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="relative border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-white/60">
                <p>&copy; <?php echo date('Y'); ?> <span class="text-white font-semibold">Dr. Praveen Gupta</span>. All rights reserved.</p>
                <div class="flex items-center space-x-1">
                    <a href="../privacy-policy" class="px-3 py-1.5 rounded-full hover:bg-white/5 hover:text-cyan-accent transition-all">Privacy Policy</a>
                    
                    <a href="../terms-of-service" class="px-3 py-1.5 rounded-full hover:bg-white/5 hover:text-cyan-accent transition-all">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="hidden lg:flex fixed bottom-8 right-8 w-12 h-12 rounded-full bg-white text-deep-indigo border border-silver-grey shadow-lg hover:bg-electric-blue hover:text-white hover:shadow-xl hover:shadow-electric-blue/40 transition-all duration-300 transform translate-y-20 opacity-0 z-50 items-center justify-center group">
        <i class="fas fa-arrow-up group-hover:-translate-y-0.5 transition-transform"></i>
    </button>

    <script>
document.addEventListener('DOMContentLoaded', function () {

    var form = document.getElementById('appointment-form');
    var statusEl = document.getElementById('form-status');
    var btnText = document.getElementById('form-btn-text');

    function showStatus(message, isError) {
        statusEl.textContent = message;
        statusEl.classList.remove('hidden');
        statusEl.classList.toggle('bg-red-50', !!isError);
        statusEl.classList.toggle('text-red-600', !!isError);
        statusEl.classList.toggle('bg-emerald-50', !isError);
        statusEl.classList.toggle('text-emerald-700', !isError);
    }

    document.querySelectorAll('.video-card').forEach(function (card) {
        card.addEventListener('click', function () {
            if (card.querySelector('iframe')) return;
            card.innerHTML = '<iframe class="absolute inset-0 w-full h-full" '
                + 'src="https://www.youtube.com/embed/' + card.dataset.videoId
                + '?autoplay=1&rel=0&modestbranding=1&playsinline=1" '
                + 'title="Patient video testimonial" frameborder="0" '
                + 'allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" '
                + 'allowfullscreen></iframe>';
        });
    });

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.observe').forEach(function (el) { observer.observe(el); });

    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Back to top button
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove('translate-y-20', 'opacity-0');
                backToTopBtn.classList.add('translate-y-0', 'opacity-100');
            } else {
                backToTopBtn.classList.add('translate-y-20', 'opacity-0');
                backToTopBtn.classList.remove('translate-y-0', 'opacity-100');
            }
        }, { passive: true });
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});
    </script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TF2TXQLK"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script>const scrollProgress = document.getElementById('scroll-progress'); window.addEventListener('scroll', () => { const scrollY = window.scrollY; const docHeight = document.documentElement.scrollHeight - window.innerHeight; const progress = docHeight > 0 ? (scrollY / docHeight) * 100 : 0; scrollProgress.style.width = progress + '%'; });</script>
</body>
</html>









