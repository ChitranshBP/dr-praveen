<?php
/**
 * 404 Not Found Page - Dr. Praveen Gupta
 */
http_response_code(404);
$pageTitle = '404 - Page Not Found | Dr. Praveen Gupta';
$pageDescription = 'The page you are looking for might have been removed, renamed, or is temporarily unavailable.';
$isDarkHero = true;

require_once __DIR__ . '/includes/header.php';
?>

<!-- 404 Section -->
<section class="relative min-h-[70vh] flex items-center justify-center py-20 bg-gradient-to-br from-deep-indigo via-[#1E1B4B] to-deep-indigo text-white overflow-hidden -mt-20">
    <!-- Ambient Glow Blobs -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-electric-blue/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-cyan-accent/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 pt-20">
        <!-- 404 Badge -->
        <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 px-4 py-1.5 rounded-full mb-6">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
            <span class="text-xs font-bold tracking-widest uppercase text-cyan-200">Error 404</span>
        </div>

        <!-- Big Number -->
        <h1 class="text-7xl sm:text-8xl md:text-9xl font-extrabold tracking-tight font-serif text-transparent bg-clip-text bg-gradient-to-r from-white via-cyan-200 to-cyan-accent mb-4">
            404
        </h1>

        <!-- Subheading -->
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 font-serif">
            Page Not Found
        </h2>

        <p class="text-white/80 text-base md:text-lg max-w-xl mx-auto mb-10 leading-relaxed">
            The page you are looking for might have been relocated, renamed, or is temporarily unavailable. Let us help you get back on track.
        </p>

        <!-- Quick Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <a href="index"
               class="inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-8 py-3.5 rounded-full shadow-lg shadow-electric-blue/30 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                <i class="fas fa-home text-xs"></i>
                <span>Return to Homepage</span>
            </a>
            <a href="contact-us-top-neurologist-delhi-ncr"
               class="inline-flex items-center space-x-2.5 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white font-bold px-8 py-3.5 rounded-full transition-all duration-300">
                <i class="fas fa-calendar-check text-xs"></i>
                <span>Book Consultation</span>
            </a>
        </div>

        <!-- Helpful Navigation Links -->
        <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-6 md:p-8 max-w-2xl mx-auto">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-cyan-200 mb-4">
                Popular Quick Links
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-sm">
                <a href="about" class="px-3 py-2 rounded-xl bg-white/5 hover:bg-white/15 text-white/90 hover:text-white transition-colors flex items-center justify-center space-x-1.5">
                    <span>About Dr. Praveen</span>
                </a>
                <a href="services" class="px-3 py-2 rounded-xl bg-white/5 hover:bg-white/15 text-white/90 hover:text-white transition-colors flex items-center justify-center space-x-1.5">
                    <span>Our Services</span>
                </a>
                <a href="epilepsy" class="px-3 py-2 rounded-xl bg-white/5 hover:bg-white/15 text-white/90 hover:text-white transition-colors flex items-center justify-center space-x-1.5">
                    <span>Epilepsy Care</span>
                </a>
                <a href="stroke" class="px-3 py-2 rounded-xl bg-white/5 hover:bg-white/15 text-white/90 hover:text-white transition-colors flex items-center justify-center space-x-1.5">
                    <span>Stroke Care</span>
                </a>
                <a href="parkinsons" class="px-3 py-2 rounded-xl bg-white/5 hover:bg-white/15 text-white/90 hover:text-white transition-colors flex items-center justify-center space-x-1.5">
                    <span>Parkinson's Care</span>
                </a>
                <a href="dr-praveen-gupta-blog" class="px-3 py-2 rounded-xl bg-white/5 hover:bg-white/15 text-white/90 hover:text-white transition-colors flex items-center justify-center space-x-1.5">
                    <span>Neurology Blog</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
