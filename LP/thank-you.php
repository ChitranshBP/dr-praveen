<?php
/**
 * Dedicated Landing Page Thank You Page
 * URL: https://drpraveengupta.com/enquire/thank-you
 */
$phonePrimary = '+91 98114 56789';
$phoneClean   = '919811456789';
$hospitalName = 'Marengo Asia Hospitals, Gurugram';
$address      = 'Sector 56, Gurugram, Haryana 122011';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <base href="/">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TF2TXQLK');</script>
    <!-- End Google Tag Manager -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, follow">
    <title>Thank You | Appointment Request Received – Dr. Praveen Gupta</title>
    <meta name="description" content="Thank you for your appointment request with Dr. Praveen Gupta. Our patient care team will call you shortly.">

    <link rel="icon" type="image/x-icon" href="/assets/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" href="/assets/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">

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
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .gradient-text {
            background: linear-gradient(135deg, #2563EB 0%, #06B6D4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col justify-between antialiased selection:bg-cyan-accent selection:text-deep-indigo">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TF2TXQLK"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Top Standalone Header -->
    <header class="w-full bg-slate-950/80 backdrop-blur-md border-b border-white/10 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between">
            <a href="/enquire" class="flex items-center space-x-3 group">
                <img src="/assets/logo.png" alt="Dr. Praveen Gupta Logo" class="h-10 sm:h-12 w-auto brightness-0 invert object-contain" onerror="this.style.display='none'">
                <div>
                    <span class="block text-base sm:text-lg font-serif font-bold text-white tracking-tight group-hover:text-cyan-accent transition-colors">Dr. Praveen Gupta</span>
                    <span class="block text-[10px] sm:text-xs text-cyan-accent font-medium uppercase tracking-wider">Chairman – Neurosciences</span>
                </div>
            </a>
            
            <div class="flex items-center space-x-3 sm:space-x-4">
                <a href="tel:<?php echo $phonePrimary; ?>" class="inline-flex items-center space-x-2 bg-white/10 hover:bg-white/20 border border-white/15 text-white text-xs sm:text-sm font-semibold px-3.5 py-2 rounded-full transition-all">
                    <i class="fas fa-phone-alt text-cyan-accent text-xs"></i>
                    <span class="hidden sm:inline">Call Coordinator:</span>
                    <span><?php echo $phonePrimary; ?></span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Thank You Hero -->
    <main class="flex-grow flex items-center justify-center py-12 sm:py-16 px-4 relative overflow-hidden">
        <!-- Background Ambient Glow -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-electric-blue/20 to-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-3xl w-full mx-auto relative z-10 text-center animate-fade-in-up">
            
            <!-- Checkmark Animation Icon -->
            <div class="inline-flex items-center justify-center w-20 h-20 sm:w-24 sm:h-24 rounded-3xl bg-gradient-to-br from-electric-blue to-cyan-accent text-white text-3xl sm:text-4xl shadow-2xl shadow-cyan-accent/30 mb-6 relative">
                <span class="absolute inset-0 rounded-3xl bg-cyan-400 animate-ping opacity-20 pointer-events-none"></span>
                <i class="fas fa-check"></i>
            </div>

            <!-- Title & Subtitle -->
            <div class="space-y-3 mb-8">
                <div class="inline-flex items-center space-x-2 bg-cyan-500/10 border border-cyan-500/30 px-3.5 py-1.5 rounded-full text-cyan-300 text-xs font-semibold">
                    <i class="fas fa-shield-alt text-[10px]"></i>
                    <span>Request Successfully Confirmed</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-serif font-bold text-white tracking-tight">
                    Thank You for <span class="text-transparent bg-clip-text bg-gradient-to-r from-electric-blue to-cyan-accent">Reaching Out</span>
                </h1>
                <p class="text-sm sm:text-base text-slate-300 max-w-xl mx-auto leading-relaxed">
                    Your appointment request has been safely received. Our Senior Clinical Care Coordinator is reviewing your details and will call you back within <strong class="text-white font-semibold">15–30 minutes</strong> to finalize your consultation timing.
                </p>
            </div>

            <!-- What Happens Next Timeline -->
            <div class="bg-slate-800/80 backdrop-blur-md border border-slate-700/70 rounded-3xl p-6 sm:p-8 text-left mb-8 shadow-xl">
                <h2 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-cyan-accent mb-6 flex items-center space-x-2">
                    <i class="fas fa-list-check"></i>
                    <span>What Happens Next?</span>
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative">
                    <!-- Step 1 -->
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-full bg-cyan-500/20 text-cyan-300 flex items-center justify-center text-xs font-bold border border-cyan-500/30">1</div>
                        <h3 class="text-sm font-bold text-white">Case Review</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">Our neurology care team assesses your symptoms and notes to prepare your consultation file.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-full bg-electric-blue/20 text-blue-300 flex items-center justify-center text-xs font-bold border border-electric-blue/30">2</div>
                        <h3 class="text-sm font-bold text-white">Care Callback</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">A coordinator calls you on the provided number to confirm your preferred slot and instructions.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-300 flex items-center justify-center text-xs font-bold border border-emerald-500/30">3</div>
                        <h3 class="text-sm font-bold text-white">Consultation</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">Meet Dr. Praveen Gupta at Marengo Asia Hospitals or attend your scheduled video call.</p>
                    </div>
                </div>
            </div>

            <!-- Direct Contact Options -->
            <div class="grid sm:grid-cols-2 gap-4 text-left mb-8">
                <!-- Immediate Phone Assistance -->
                <a href="tel:<?php echo $phonePrimary; ?>" class="bg-slate-800/60 hover:bg-slate-800 border border-slate-700/60 hover:border-cyan-500/50 rounded-2xl p-5 flex items-start space-x-4 transition-all group shadow-md">
                    <span class="w-12 h-12 rounded-xl bg-electric-blue/20 text-electric-blue group-hover:bg-electric-blue group-hover:text-white flex items-center justify-center text-lg flex-shrink-0 transition-colors">
                        <i class="fas fa-phone-volume"></i>
                    </span>
                    <div>
                        <h3 class="text-sm font-bold text-white group-hover:text-cyan-accent transition-colors">Need Urgent Support?</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Call our direct appointment helpline:</p>
                        <p class="text-xs font-bold text-cyan-300 mt-1"><?php echo $phonePrimary; ?></p>
                    </div>
                </a>

                <!-- WhatsApp Quick Chat -->
                <a href="https://wa.me/<?php echo $phoneClean; ?>?text=Hi%20Dr.%20Praveen%20Gupta%20Team%2C%20I%20just%20submitted%20an%20appointment%20request%20on%20your%20website." target="_blank" rel="noopener noreferrer" class="bg-slate-800/60 hover:bg-slate-800 border border-slate-700/60 hover:border-emerald-500/50 rounded-2xl p-5 flex items-start space-x-4 transition-all group shadow-md">
                    <span class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white flex items-center justify-center text-lg flex-shrink-0 transition-colors">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </span>
                    <div>
                        <h3 class="text-sm font-bold text-white group-hover:text-emerald-400 transition-colors">Chat on WhatsApp</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Connect instantly with our desk via WhatsApp:</p>
                        <p class="text-xs font-bold text-emerald-400 mt-1">Start WhatsApp Chat &rarr;</p>
                    </div>
                </a>
            </div>

            <!-- Clinic Details & Back Button -->
            <div class="space-y-4 pt-2">
                <div class="inline-flex flex-wrap items-center justify-center gap-2 text-xs text-slate-400">
                    <span class="inline-flex items-center space-x-1.5 bg-slate-800/80 px-3 py-1.5 rounded-full border border-slate-700/50">
                        <i class="fas fa-hospital text-cyan-accent"></i>
                        <span><?php echo $hospitalName; ?></span>
                    </span>
                    <span class="inline-flex items-center space-x-1.5 bg-slate-800/80 px-3 py-1.5 rounded-full border border-slate-700/50">
                        <i class="fas fa-map-marker-alt text-cyan-accent"></i>
                        <span><?php echo $address; ?></span>
                    </span>
                </div>

                <div>
                    <a href="/enquire" class="inline-flex items-center space-x-2 text-xs font-bold text-cyan-400 hover:text-white uppercase tracking-wider transition-colors pt-2 group">
                        <i class="fas fa-arrow-left text-[10px] group-hover:-translate-x-1 transition-transform"></i>
                        <span>Return to Appointment Page</span>
                    </a>
                </div>
            </div>

        </div>
    </main>

    <!-- Standalone LP Footer -->
    <footer class="w-full bg-slate-950 border-t border-slate-800 py-6 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 space-y-2">
            <p>&copy; <?php echo date('Y'); ?> Dr. Praveen Gupta. All Rights Reserved. Marengo Asia Hospitals, Gurugram.</p>
            <div class="flex items-center justify-center space-x-4 text-[11px] text-slate-400">
                <a href="/privacy-policy" class="hover:text-cyan-400 transition-colors">Privacy Policy</a>
                <span>&bull;</span>
                <a href="/terms-of-service" class="hover:text-cyan-400 transition-colors">Terms of Service</a>
            </div>
        </div>
    </footer>

</body>
</html>
