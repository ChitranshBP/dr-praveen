<?php
/**
 * Thank You Page - Dr. Praveen Gupta Landing Page
 */

// Load dynamic settings from CMS if present
$lp = [];
if (is_file(dirname(__DIR__) . '/data/lp.json')) {
    $decoded = json_decode((string)file_get_contents(dirname(__DIR__) . '/data/lp.json'), true);
    if (is_array($decoded)) {
        $lp = $decoded;
    }
}

$phone        = '+91-87969-77903';
$helpline     = '1800-309-0247';
$whatsapp     = '918796977903';
$email        = 'contact@drpraveengupta.com';
$address      = 'Marengo Asia Hospitals, Shushant Lok 2, Sector 56, Gurugram, Haryana 122011';
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
    <title>Thank You | Dr. Praveen Gupta &ndash; Best Neurologist in Gurgaon</title>
    <meta name="description" content="Thank you for your appointment inquiry. Our care team will connect with you shortly.">
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
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans text-dark-grey antialiased flex flex-col min-h-screen">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TF2TXQLK"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Top Bar -->
    <header class="bg-deep-indigo text-white py-3.5 px-4 sm:px-6 border-b border-white/10">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="index.php" class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-electric-blue to-cyan-accent flex items-center justify-center text-white font-bold text-lg shadow-md">
                    DG
                </div>
                <div>
                    <span class="block text-base sm:text-lg font-serif font-bold tracking-tight">Dr. Praveen Gupta</span>
                    <span class="block text-[10px] sm:text-xs text-cyan-accent font-medium">Chairman &ndash; Neurosciences, Marengo Asia</span>
                </div>
            </a>
            <div class="flex items-center space-x-3 sm:space-x-4 text-xs">
                <a href="tel:<?php echo $helpline; ?>" class="hidden sm:inline-flex items-center space-x-2 text-red-400 hover:text-red-300 font-bold transition-colors">
                    <i class="fas fa-phone-alt animate-pulse"></i>
                    <span>Helpline: <?php echo $helpline; ?></span>
                </a>
                <a href="index.php" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white font-semibold transition-all">
                    <i class="fas fa-home text-xs"></i>
                    <span>Home</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Thank You Hero Section -->
    <main class="flex-1 flex items-center justify-center py-12 sm:py-20 px-4 relative overflow-hidden bg-gradient-to-br from-[#0b1021] via-deep-indigo to-[#0b2447] text-white">
        <!-- Ambient background glows -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-electric-blue/20 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-2xl mx-auto text-center relative z-10 space-y-6 sm:space-y-8">
            <!-- Animated Success Check -->
            <div class="inline-flex items-center justify-center w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-emerald-500/10 border-2 border-emerald-400/40 shadow-2xl relative">
                <span class="absolute inset-0 rounded-full bg-emerald-400/20 animate-ping pointer-events-none"></span>
                <i class="fas fa-check text-3xl sm:text-4xl text-emerald-400"></i>
            </div>

            <div class="space-y-3 sm:space-y-4">
                <div class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-400/30 text-emerald-300 text-xs font-bold uppercase tracking-wider">
                    <i class="fas fa-shield-check"></i>
                    <span>Request Submitted Successfully</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-serif font-extrabold tracking-tight">
                    Thank <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-accent to-blue-300">You!</span>
                </h1>
                <p class="text-base sm:text-lg font-medium text-white/90 max-w-lg mx-auto leading-relaxed">
                    We have received your appointment details. Our patient coordinator will connect with you shortly to assist with your consultation.
                </p>
            </div>

            <!-- Action Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 sm:gap-4 max-w-lg mx-auto pt-2 text-left">
                <a href="index.php" class="bg-white/5 hover:bg-white/10 border border-white/10 rounded-2xl p-4 sm:p-5 flex items-start space-x-3.5 transition-all duration-300 group">
                    <div class="w-10 h-10 rounded-xl bg-electric-blue/20 group-hover:bg-electric-blue flex items-center justify-center text-cyan-accent group-hover:text-white transition-all flex-shrink-0">
                        <i class="fas fa-arrow-left text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm text-white group-hover:text-cyan-accent transition-colors">Return to Page</h3>
                        <p class="text-[11px] text-white/60 mt-0.5 leading-normal">Back to Dr. Praveen Gupta's landing page.</p>
                    </div>
                </a>

                <a href="https://wa.me/<?php echo $whatsapp; ?>?text=<?php echo rawurlencode('Hello Dr. Praveen Gupta\'s team, I recently submitted the callback form and would like to connect.'); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 rounded-2xl p-4 sm:p-5 flex items-start space-x-3.5 transition-all duration-300 group">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 group-hover:bg-emerald-500 flex items-center justify-center text-emerald-400 group-hover:text-white transition-all flex-shrink-0">
                        <i class="fab fa-whatsapp text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm text-white group-hover:text-emerald-300 transition-colors">Chat on WhatsApp</h3>
                        <p class="text-[11px] text-white/60 mt-0.5 leading-normal">Connect directly with our care desk.</p>
                    </div>
                </a>
            </div>

            <!-- Emergency Helpline Callout -->
            <div class="pt-4">
                <div class="inline-flex items-center space-x-2 text-xs text-white/70 bg-white/5 border border-white/10 rounded-full px-4 py-2">
                    <i class="fas fa-phone-alt text-red-400 animate-pulse"></i>
                    <span>For immediate emergency stroke triage, call:</span>
                    <a href="tel:<?php echo $helpline; ?>" class="font-bold text-red-400 hover:text-red-300 transition-colors"><?php echo $helpline; ?></a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark-grey text-white/60 text-xs py-6 px-4 sm:px-6 border-t border-white/10">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
            <p>&copy; <?php echo date('Y'); ?> Dr. Praveen Gupta. All rights reserved.</p>
            <p class="text-[11px] text-white/40"><?php echo $address; ?></p>
        </div>
    </footer>
</body>
</html>
