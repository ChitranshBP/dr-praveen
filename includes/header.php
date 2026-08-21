<?php
/**
 * Header Include
 */
require_once __DIR__ . '/config.php';
$currentPage = str_replace('.php', '', basename($_SERVER['PHP_SELF']));
$isHomepage = ($currentPage === 'index');
$isDarkHero = isset($isDarkHero) ? $isDarkHero : false;
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dr. Praveen Gupta - Leading healthcare professional providing exceptional medical care with 20+ years of experience.">
    <meta name="keywords" content="Dr Praveen Gupta, healthcare, medical services, doctor, clinic">
    <meta name="author" content="Dr. Praveen Gupta">
    <title><?php echo SITE_NAME; ?> - <?php echo SITE_TAGLINE; ?></title>

    <!-- Canonical URL -->
    <?php
    $canonicalUrl = rtrim(SITE_URL, '/') . '/';
    if (!$isHomepage && $currentPage !== '') {
        $canonicalUrl .= $currentPage;
    }
    ?>
    <link rel="canonical" href="<?php echo $canonicalUrl; ?>">

    <!-- Compiled Tailwind CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome (Deferred) -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/favicon/favicon.png">

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

        /* Glass navbar (transparent) */
        .navbar-glass {
            background: transparent;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            border-bottom: 1px solid transparent;
        }
        .navbar-solid {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(229, 231, 235, 0.6);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.06);
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

        /* Mobile menu animation */
        .mobile-menu-anim {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-in-out;
        }
        .mobile-menu-anim.open {
            max-height: 1000px;
        }

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
    </style>
</head>
<body class="bg-white text-dark-grey antialiased overflow-x-hidden">

    <!-- Top Bar - Modern -->
    <!-- <div class="bg-gradient-to-r from-deep-indigo via-[#1E1B4B] to-deep-indigo text-white py-2.5 text-xs hidden md:block relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 left-1/4 w-32 h-full bg-cyan-accent/20 blur-2xl"></div>
            <div class="absolute top-0 right-1/4 w-32 h-full bg-electric-blue/20 blur-2xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <a href="tel:<?php echo SITE_PHONE; ?>" class="flex items-center space-x-2 hover:text-cyan-accent transition-all duration-300 group">
                    <span class="w-7 h-7 rounded-full bg-cyan-accent/10 flex items-center justify-center group-hover:bg-cyan-accent/20 transition-colors">
                        <i class="fas fa-phone text-cyan-accent text-[10px]"></i>
                    </span>
                    <span class="font-medium"><?php echo SITE_PHONE; ?></span>
                </a>
                <span class="w-px h-4 bg-white/20"></span>
                <a href="mailto:<?php echo SITE_EMAIL; ?>" class="flex items-center space-x-2 hover:text-cyan-accent transition-all duration-300 group">
                    <span class="w-7 h-7 rounded-full bg-cyan-accent/10 flex items-center justify-center group-hover:bg-cyan-accent/20 transition-colors">
                        <i class="fas fa-envelope text-cyan-accent text-[10px]"></i>
                    </span>
                    <span class="font-medium"><?php echo SITE_EMAIL; ?></span>
                </a>
                <span class="w-px h-4 bg-white/20"></span>
                <div class="flex items-center space-x-2">
                    <span class="w-7 h-7 rounded-full bg-cyan-accent/10 flex items-center justify-center">
                        <i class="fas fa-clock text-cyan-accent text-[10px]"></i>
                    </span>
                    <span class="font-medium">Mon - Sat: 9:00 AM - 7:00 PM</span>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-white/60 mr-2">Follow:</span>
                <a href="<?php echo SOCIAL_FACEBOOK; ?>" class="w-7 h-7 rounded-full bg-white/5 hover:bg-electric-blue flex items-center justify-center transition-all duration-300 hover:scale-110">
                    <i class="fab fa-facebook-f text-[11px]"></i>
                </a>
                <a href="<?php echo SOCIAL_INSTAGRAM; ?>" class="w-7 h-7 rounded-full bg-white/5 hover:bg-gradient-to-br hover:from-purple-500 hover:to-pink-500 flex items-center justify-center transition-all duration-300 hover:scale-110">
                    <i class="fab fa-instagram text-[11px]"></i>
                </a>
                <a href="<?php echo SOCIAL_TWITTER; ?>" class="w-7 h-7 rounded-full bg-white/5 hover:bg-cyan-accent flex items-center justify-center transition-all duration-300 hover:scale-110">
                    <i class="fab fa-twitter text-[11px]"></i>
                </a>
                <a href="<?php echo SOCIAL_YOUTUBE; ?>" class="w-7 h-7 rounded-full bg-white/5 hover:bg-red-500 flex items-center justify-center transition-all duration-300 hover:scale-110">
                    <i class="fab fa-youtube text-[11px]"></i>
                </a>
                <a href="<?php echo SOCIAL_LINKEDIN; ?>" class="w-7 h-7 rounded-full bg-white/5 hover:bg-blue-600 flex items-center justify-center transition-all duration-300 hover:scale-110">
                    <i class="fab fa-linkedin-in text-[11px]"></i>
                </a>
            </div>
        </div>
    </div> -->

    <!-- Main Navigation -->
    <nav id="navbar" class="sticky top-0 z-50 transition-all duration-500 <?php echo $isHomepage || $isDarkHero ? 'navbar-glass' : 'navbar-solid'; ?>">
        <!-- Scroll Progress Bar -->
        <div class="scroll-progress" id="scroll-progress" style="width: 0%"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="index" class="flex items-center group">
                    <img id="header-logo" src="assets/logo/NeuroDoc-final-logo.png" alt="Dr. Praveen Gupta - NeuroDoc Logo" class="h-14 sm:h-16 w-auto object-contain block group-hover:scale-[1.02] transition-transform duration-300 <?php echo $isHomepage || $isDarkHero ? 'invert brightness-0' : ''; ?>">
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-1 bg-white/5 backdrop-blur-sm rounded-full px-2 py-1.5 border border-white/10 nav-glass-el">
                    <?php foreach ($navItems as $item): ?>
                        <?php if (isset($item['children'])): ?>
                            <div class="relative group">
                                <button class="nav-link flex items-center space-x-1 px-5 py-2 text-sm font-semibold text-dark-grey hover:bg-white/5 rounded-full focus:outline-none">
                                    <span><?php echo $item['name']; ?></span>
                                    <i class="fas fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                                </button>
                                <div class="absolute left-0 mt-2 w-64 rounded-3xl bg-white/95 backdrop-blur-xl shadow-[0_20px_50px_rgba(0,0,0,0.12)] border border-slate-200/40 p-2.5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform scale-95 origin-top-left group-hover:scale-100 z-50">
                                    <div class="space-y-1">
                                        <?php foreach ($item['children'] as $child): ?>
                                            <?php if (!empty($child['viewAll'])): ?>
                                                <!-- Pinned "view all" link, separated from the list above -->
                                                <a href="<?php echo $child['url']; ?>"
                                                   class="flex items-center justify-between px-4 py-2.5 mt-2 pt-3 border-t border-slate-200/70 text-xs font-bold rounded-2xl text-electric-blue hover:bg-gradient-to-r hover:from-electric-blue/10 hover:to-cyan-accent/10 transition-all duration-300 group/item">
                                                    <span><?php echo $child['name']; ?></span>
                                                    <i class="fas fa-arrow-right text-[9px] text-cyan-accent group-hover/item:translate-x-0.5 transition-transform duration-300"></i>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo $child['url']; ?>"
                                                   class="flex items-center justify-between px-4 py-2.5 text-xs font-semibold rounded-2xl text-dark-grey/75 hover:bg-gradient-to-r hover:from-electric-blue/5 hover:to-cyan-accent/5 hover:text-electric-blue transition-all duration-305 group/item transform hover:translate-x-1">
                                                    <span><?php echo $child['name']; ?></span>
                                                    <i class="fas fa-chevron-right text-[9px] opacity-0 -translate-x-2 group-hover/item:opacity-100 group-hover/item:translate-x-0 transition-all duration-300 text-cyan-accent"></i>
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo $item['url']; ?>"
                               class="nav-link-anim relative px-5 py-2 text-sm font-semibold transition-colors duration-300 nav-link rounded-full <?php echo $currentPage === $item['url'] ? 'active bg-white/10' : 'text-dark-grey hover:bg-white/5'; ?>">
                                <?php echo $item['name']; ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Right Actions -->
                <div class="hidden lg:flex items-center space-x-3">
                    <!-- Search Icon -->
                    <!-- <button class="nav-icon-btn w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center transition-all duration-300 text-dark-grey border border-white/10 nav-glass-el">
                        <i class="fas fa-search text-sm"></i>
                    </button> -->

                    <!-- CTA Button - Premium Style -->
                    <a href="contact-us-top-neurologist-delhi-ncr" class="btn-shimmer group relative inline-flex items-center space-x-2 bg-gradient-to-r from-electric-blue to-cyan-accent text-white text-sm font-semibold pl-5 pr-2 py-2 rounded-full hover:shadow-xl hover:shadow-electric-blue/40 transition-all duration-300 transform hover:-translate-y-0.5">
                        <span>Book Appointment</span>
                        <span class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center group-hover:rotate-45 transition-transform duration-300">
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all duration-300 nav-icon-btn border border-white/10 nav-glass-el">
                    <i class="fas fa-bars text-lg" id="menu-icon"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu-anim lg:hidden bg-white/95 backdrop-blur-xl border-t border-silver-grey/50">
            <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
                <?php foreach ($navItems as $item): ?>
                    <?php if (isset($item['children'])): ?>
                        <div class="mobile-dropdown">
                            <button onclick="toggleMobileDropdown(this)" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-base font-semibold text-dark-grey hover:bg-soft-cyan hover:text-electric-blue focus:outline-none">
                                <span class="flex items-center space-x-3">
                                    <span class="w-1.5 h-1.5 rounded-full bg-silver-grey"></span>
                                    <span><?php echo $item['name']; ?></span>
                                </span>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                            </button>
                            <div class="hidden pl-6 py-1.5 space-y-1 bg-slate-50/40 rounded-2xl mt-1.5 border border-slate-100/50">
                                <?php foreach ($item['children'] as $child): ?>
                                    <a href="<?php echo $child['url']; ?>"
                                       class="flex items-center justify-between px-4 py-3 rounded-xl text-xs transition-colors <?php echo !empty($child['viewAll'])
                                            ? 'mt-1.5 pt-3 border-t border-slate-200/70 font-bold text-electric-blue hover:bg-electric-blue/5'
                                            : 'font-semibold text-dark-grey/70 hover:bg-electric-blue/5 hover:text-electric-blue'; ?>">
                                        <span><?php echo $child['name']; ?></span>
                                        <i class="fas fa-arrow-right text-[9px] text-cyan-accent"></i>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo $item['url']; ?>"
                           class="flex items-center justify-between px-4 py-3 rounded-xl text-base font-semibold transition-all <?php echo $currentPage === $item['url'] ? 'bg-gradient-to-r from-electric-blue/10 to-cyan-accent/10 text-electric-blue border border-electric-blue/20' : 'text-dark-grey hover:bg-soft-cyan hover:text-electric-blue'; ?>">
                            <span class="flex items-center space-x-3">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo $currentPage === $item['url'] ? 'bg-cyan-accent' : 'bg-silver-grey'; ?>"></span>
                                <span><?php echo $item['name']; ?></span>
                            </span>
                            <i class="fas fa-chevron-right text-xs text-cyan-accent"></i>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                <a href="contact-us-top-neurologist-delhi-ncr" class="block mt-3 px-4 py-3 text-center bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold rounded-xl shadow-lg shadow-electric-blue/20">
                    Book Appointment
                </a>
            </div>
        </div>
    </nav>

    <script>
        // Toggle mobile sub-menus
        function toggleMobileDropdown(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('i');
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const isHomepage = <?php echo $isHomepage ? 'true' : 'false'; ?>;
        const isDarkHero = <?php echo isset($isDarkHero) && $isDarkHero ? 'true' : 'false'; ?>;
        let menuOpen = false;

        mobileMenuBtn.addEventListener('click', function() {
            menuOpen = !menuOpen;
            mobileMenu.classList.toggle('open');

            if (menuOpen) {
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-xmark');
                navbar.classList.remove('navbar-glass');
                navbar.classList.add('navbar-solid');
                if (headerLogo) {
                    headerLogo.classList.remove('invert', 'brightness-0');
                }
            } else {
                menuIcon.classList.remove('fa-xmark');
                menuIcon.classList.add('fa-bars');
                updateNavbar();
            }
        });

        // Navbar scroll effect + scroll progress
        const navbar = document.getElementById('navbar');
        const scrollProgress = document.getElementById('scroll-progress');
        const headerLogo = document.getElementById('header-logo');

        function updateNavbar() {
            const scrollY = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? (scrollY / docHeight) * 100 : 0;
            scrollProgress.style.width = progress + '%';

            // Don't change navbar when mobile menu is open
            if (menuOpen) return;

            if (isHomepage || isDarkHero) {
                if (scrollY > 50) {
                    navbar.classList.remove('navbar-glass');
                    navbar.classList.add('navbar-solid');
                    if (headerLogo) {
                        headerLogo.classList.remove('invert', 'brightness-0');
                    }
                } else {
                    navbar.classList.remove('navbar-solid');
                    navbar.classList.add('navbar-glass');
                    if (headerLogo) {
                        headerLogo.classList.add('invert', 'brightness-0');
                    }
                }
            } else {
                if (scrollY > 50) {
                    navbar.classList.add('shadow-lg');
                    if (headerLogo) {
                        headerLogo.classList.remove('invert', 'brightness-0');
                    }
                } else {
                    navbar.classList.remove('shadow-lg');
                    if (headerLogo) {
                        headerLogo.classList.remove('invert', 'brightness-0');
                    }
                }
            }
        }

        window.addEventListener('scroll', updateNavbar);
        updateNavbar();
    </script>
