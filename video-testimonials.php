<?php
/**
 * Video Testimonials Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative overflow-hidden text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20 bg-cover bg-center" style="background-image: url('assets/breadcrumbs/media.png');">
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/85 to-electric-blue/30"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Video Testimonials</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-video text-cyan-accent text-[10px]"></i>
                <span>Video Patient Reviews & Recovery Stories</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Video <span class="text-cyan-accent">Testimonials</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Watch verified recovery stories shared by patients who underwent advanced neurology treatments under the direction of Dr. Praveen Gupta.
            </p>
        </div>
    </div>
</section>

<!-- Videos Grid Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans">Patient Recovery Clips</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Verified Patient Video Stories</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Click play to watch their experiences and health transformations.
            </p>
        </div>

        <?php if (isset($videoTestimonials) && !empty($videoTestimonials)): ?>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <?php foreach ($videoTestimonials as $vid): ?>
                    <div class="bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="relative aspect-[9/16] bg-black">
                            <!-- Responsive Iframe for YouTube Shorts/Videos -->
                            <iframe 
                                class="absolute inset-0 w-full h-full" 
                                src="https://www.youtube.com/embed/<?php echo $vid['id']; ?>?rel=0" 
                                title="<?php echo $vid['title']; ?>" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="p-5 text-center">
                            <h3 class="text-xs font-bold text-deep-indigo leading-snug">
                                <?php echo $vid['title']; ?>
                            </h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-xs text-dark-grey/55">No video testimonials available in site configuration.</p>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
