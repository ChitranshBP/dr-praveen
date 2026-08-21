<?php
/**
 * Thank You Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Thank You Hero / Content Section -->
<section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 pb-16 -mt-20">
    <!-- Background overlay elements -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute -left-20 top-20 w-96 h-96 bg-white rounded-full blur-[100px]"></div>
        <div class="absolute -right-20 bottom-20 w-96 h-96 bg-cyan-accent rounded-full blur-[100px]"></div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-8 animate-fade-in-up">
        <!-- Success Check Icon -->
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white/10 backdrop-blur-md border border-white/20 shadow-lg relative">
            <span class="absolute inset-0 rounded-full bg-white/5 animate-ping pointer-events-none"></span>
            <i class="fas fa-check text-4xl text-cyan-accent"></i>
        </div>

        <div class="space-y-4">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold font-serif tracking-tight">
                Thank <span class="text-cyan-accent">You!</span>
            </h1>
            <h2 class="text-xl md:text-2xl font-semibold text-white/90">
                Your Submission has been Received
            </h2>
            <p class="text-sm md:text-base text-white/80 max-w-xl mx-auto leading-relaxed">
                Thank you for contacting Dr. Praveen Gupta's clinical team. We have successfully received your inquiry and our patient coordinator will review the details and reach back to you shortly.
            </p>
        </div>

        <!-- Next Steps Cards -->
        <div class="grid sm:grid-cols-2 gap-4 max-w-lg mx-auto pt-6 text-left">
            <a href="index" class="bg-white/5 hover:bg-white/10 border border-white/10 rounded-2xl p-5 flex items-start space-x-4 transition-all duration-300 group">
                <span class="w-10 h-10 rounded-xl bg-cyan-accent/20 flex items-center justify-center text-cyan-accent flex-shrink-0">
                    <i class="fas fa-home text-base"></i>
                </span>
                <div>
                    <h3 class="font-bold text-sm text-white group-hover:text-cyan-accent transition-colors">Return Home</h3>
                    <p class="text-[11px] text-white/70 mt-1 leading-normal">Go back to the homepage to read about services.</p>
                </div>
            </a>

            <a href="tel:<?php echo STROKE_HELPLINE; ?>" class="bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 rounded-2xl p-5 flex items-start space-x-4 transition-all duration-300 group">
                <span class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center text-red-400 flex-shrink-0">
                    <i class="fas fa-phone-alt text-base animate-pulse"></i>
                </span>
                <div>
                    <h3 class="font-bold text-sm text-white group-hover:text-red-400 transition-colors">Emergency Desk</h3>
                    <p class="text-[11px] text-white/70 mt-1 leading-normal">Call 24x7 helpline for urgent medical help.</p>
                </div>
            </a>
        </div>

        <div class="pt-4">
            <a href="index" class="inline-flex items-center space-x-2 text-xs font-bold text-cyan-accent hover:text-white uppercase tracking-wider group transition-colors">
                <i class="fas fa-arrow-left text-[9px] group-hover:-translate-x-0.5 transition-transform"></i>
                <span>Back to main website</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
