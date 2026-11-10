<?php
/**
 * Rehabilitation Hub Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('neuro-rehabilitation-center', [
    'hero_badge' => 'Comprehensive Neuro-Rehabilitation',
    'hero_title' => 'Neurological <span class="text-cyan-accent">Rehabilitation Hub</span>',
    'hero_desc'  => 'Restoring function, independence, and confidence. Tailored physical, occupational, and speech rehabilitation programs for stroke, trauma, and progressive movement disorders.',
    'hero_bg'    => 'assets/breadcrumbs/dr-parveen-services-breadcrumb/rehab.png',
]);

$section = get_page_section($pageContent, [
    'badge' => 'Recovery Focus',
    'title' => 'Rebuilding Independent Living',
    'text' => "Following a stroke, brain trauma, or spinal cord injury, the nervous system requires specialized retraining. Our approach focuses on neuroplasticity — the brain's innate ability to reorganize and form new neural connections in response to therapeutic exercise.\n\nDr. Praveen Gupta coordinates the clinical team to ensure physical therapists, speech-language pathologists, and occupational therapists deliver unified therapy protocols tailored to your recovery targets.",
    'image' => 'assets/services/rehab.png',
    'image_alt' => 'Patient undergoing physical rehabilitation',
]);
$heroBg = cms_media_path($pageContent['hero_bg'] ?? '');
$heroAlt = trim((string)($pageContent['hero_bg_alt'] ?? ''));
if ($heroAlt === '') $heroAlt = trim(strip_tags($pageContent['hero_title'] ?? 'Dr. Praveen Gupta'));
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <!-- Background image -->
    <?php if ($heroBg): ?>
    <img src="<?php echo htmlspecialchars($heroBg); ?>" alt="<?php echo htmlspecialchars($heroAlt); ?>"
         fetchpriority="high"
         class="absolute inset-0 w-full h-full object-cover object-[78%_center] md:object-right pointer-events-none select-none">

    <!-- Legibility overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/75 to-deep-indigo/35 md:to-transparent"></div>
    <?php endif; ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <a href="services" class="hover:text-white transition-colors">Services</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Rehabilitation Hub</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-child text-cyan-accent text-[10px]"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>

            <div class="flex flex-wrap gap-3">
                <?php $heroPrimary = cms_page_cta('neuro-rehabilitation-center', 'hero-primary'); ?>
                <?php if (trim($heroPrimary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroPrimary['url']); ?>" class="group inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
                    <span><?php echo cms_cta_text('neuro-rehabilitation-center', 'hero-primary'); ?></span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
                <?php endif; ?>
                <?php $heroSecondary = cms_page_cta('neuro-rehabilitation-center', 'hero-secondary'); ?>
                <?php if (trim($heroSecondary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroSecondary['url']); ?>" class="inline-flex items-center space-x-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold px-6 py-2.5 rounded-full border border-white/30 hover:bg-white/30 transition-all duration-300 text-sm">
                    <i class="fas fa-phone text-xs"></i>
                    <span><?php echo cms_cta_text('neuro-rehabilitation-center', 'hero-secondary'); ?></span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- What is Rehabilitation Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($section['badge']); ?></span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($section['title']); ?></h2>
                <?php echo cms_section_paragraphs($section['text']); ?>

                <!-- Key Facts -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Physical Therapy</div>
                            <div class="text-xs text-dark-grey/60">Gait and coordination</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Occupational Care</div>
                            <div class="text-xs text-dark-grey/60">Daily living adjustments</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Speech Therapy</div>
                            <div class="text-xs text-dark-grey/60">Dysphagia and clarity</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Tech Monitored</div>
                            <div class="text-xs text-dark-grey/60">Real-time biofeedback</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Side -->
            <div class="relative flex justify-center lg:justify-end animate-slide-in-right">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey border border-silver-grey/20">
                    <img src="<?php echo htmlspecialchars($section['image']); ?>" alt="<?php echo htmlspecialchars($section['image_alt']); ?>" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Rehabilitation Programs -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('neuro-rehabilitation-center', 'core-therapies'); ?>
    </div>
</section>

<!-- Rehabilitation Steps -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('neuro-rehabilitation-center', 'recovery-journey'); ?>
    </div>
</section>

<!-- About Doctor Section -->
<section id="about-doctor" class="py-16 bg-white border-t border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Image Side -->
            <div class="lg:col-span-5 relative observe">
                <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-xl bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/dpg-1.webp" alt="Dr. Praveen Gupta" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Content Side -->
            <div class="lg:col-span-7 observe">
                <span class="text-xs font-bold tracking-wider text-dark-grey/60 uppercase block mb-3 font-sans">
                    About Dr. Praveen Gupta
                </span>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo leading-tight mb-4">
                    Dr. Praveen Gupta  Best Neurologist in India
                </h2>

                <!-- Prestigious Appointments -->
                <div class="flex flex-col space-y-2.5 mb-6">
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-award text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chairman  Marengo Asia International Institute of Neuro and Spine</span>
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

                <p class="text-sm text-dark-grey/85 mb-4 leading-relaxed">
                    With over 20 years of clinical experience, Dr. Praveen Gupta has emerged as a pioneering force in the diagnosis, treatment, and advancement of neurological sciences across India and beyond. He is responsible for several firsts in the country's neurology landscape, including establishing Gurugram's first stroke centre and conducting pioneering BMT procedures for autoimmune neuro-disorders.
                </p>

                <div>
                    <a href="about" class="inline-flex items-center space-x-4 border-2 border-dark-grey px-6 py-2.5 rounded-full hover:bg-dark-grey hover:text-white transition-all duration-300 group">
                        <span class="text-xs font-bold text-dark-grey group-hover:text-white transition-colors duration-300">More About Doctor</span>
                        <div class="w-8 h-8 rounded-full bg-dark-grey text-white flex items-center justify-center text-xs group-hover:bg-white group-hover:text-dark-grey transition-colors duration-300 flex-shrink-0">
                            <i class="fas fa-arrow-right -rotate-45 transition-transform duration-300"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<!-- Related Videos (topic-matched, see $pageVideos in includes/config.php) -->
<?php require __DIR__ . "/includes/related-videos.php"; ?>

<!-- FAQ Section (managed in CMS → FAQs) -->
<?php $faqSlug = 'neuro-rehabilitation-center'; require __DIR__ . '/includes/faq-section.php'; ?>



<?php require_once __DIR__ . '/includes/footer.php'; ?>
