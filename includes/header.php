<?php
/**
 * Header Include
 */
require_once __DIR__ . '/config.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dr. Praveen Gupta - Leading healthcare professional providing exceptional medical care with 25+ years of experience.">
    <meta name="keywords" content="Dr Praveen Gupta, healthcare, medical services, doctor, clinic">
    <meta name="author" content="Dr. Praveen Gupta">
    <title><?php echo SITE_NAME; ?> - <?php echo SITE_TAGLINE; ?></title>

    <!-- Tailwind CSS CDN -->
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
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%232563EB'/%3E%3Cpath d='M50 25 L50 75 M25 50 L75 50' stroke='white' stroke-width='12' stroke-linecap='round'/%3E%3C/svg%3E">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .font-serif {
            font-family: 'Playfair Display', serif;
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
    </style>
</head>
<body class="bg-white text-dark-grey antialiased">

    <!-- Top Bar -->
    <div class="bg-deep-indigo text-white py-2 text-sm hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <a href="tel:<?php echo SITE_PHONE; ?>" class="flex items-center space-x-2 hover:text-cyan-accent transition-colors">
                    <i class="fas fa-phone text-cyan-accent"></i>
                    <span><?php echo SITE_PHONE; ?></span>
                </a>
                <a href="mailto:<?php echo SITE_EMAIL; ?>" class="flex items-center space-x-2 hover:text-cyan-accent transition-colors">
                    <i class="fas fa-envelope text-cyan-accent"></i>
                    <span><?php echo SITE_EMAIL; ?></span>
                </a>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-clock text-cyan-accent"></i>
                    <span>Mon - Sat: 9:00 AM - 7:00 PM</span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="<?php echo SOCIAL_FACEBOOK; ?>" class="hover:text-cyan-accent transition-colors"><i class="fab fa-facebook-f"></i></a>
                <a href="<?php echo SOCIAL_INSTAGRAM; ?>" class="hover:text-cyan-accent transition-colors"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo SOCIAL_TWITTER; ?>" class="hover:text-cyan-accent transition-colors"><i class="fab fa-twitter"></i></a>
                <a href="<?php echo SOCIAL_LINKEDIN; ?>" class="hover:text-cyan-accent transition-colors"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav id="navbar" class="sticky top-0 z-50 bg-white/95 backdrop-blur-md shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="index.php" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                        <i class="fas fa-plus text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-deep-indigo leading-tight">Dr. Praveen Gupta</h1>
                        <p class="text-xs text-cyan-accent font-medium">MBBS, MD - Internal Medicine</p>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-1">
                    <?php foreach ($navItems as $item): ?>
                        <a href="<?php echo $item['url']; ?>"
                           class="relative px-4 py-2 text-sm font-medium transition-colors duration-300 <?php echo $currentPage === $item['url'] ? 'text-electric-blue' : 'text-dark-grey hover:text-electric-blue'; ?>">
                            <?php echo $item['name']; ?>
                            <?php if ($currentPage === $item['url']): ?>
                                <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-gradient-to-r from-electric-blue to-cyan-accent rounded-full"></span>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <!-- CTA Button -->
                <div class="hidden lg:flex items-center space-x-3">
                    <a href="contact.php" class="px-6 py-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent text-white text-sm font-semibold rounded-full hover:shadow-lg hover:shadow-electric-blue/30 transition-all duration-300 transform hover:-translate-y-0.5">
                        Book Appointment
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg text-dark-grey hover:bg-soft-cyan transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-silver-grey">
            <div class="px-4 py-4 space-y-2">
                <?php foreach ($navItems as $item): ?>
                    <a href="<?php echo $item['url']; ?>"
                       class="block px-4 py-3 rounded-lg text-base font-medium transition-colors <?php echo $currentPage === $item['url'] ? 'bg-soft-cyan text-electric-blue' : 'text-dark-grey hover:bg-soft-cyan'; ?>">
                        <?php echo $item['name']; ?>
                    </a>
                <?php endforeach; ?>
                <a href="contact.php" class="block px-4 py-3 text-center bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold rounded-lg">
                    Book Appointment
                </a>
            </div>
        </div>
    </nav>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-md');
            } else {
                navbar.classList.remove('shadow-md');
            }
        });
    </script>
