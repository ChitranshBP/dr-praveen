<?php
/**
 * Spine Surgery Clinic Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('spine-surgery', [
    'hero_badge' => 'Comprehensive Spine Care Center',
    'hero_title' => 'Spine <span class="text-cyan-accent">Surgery</span>',
    'hero_desc'  => 'Providing comprehensive care for complex spinal conditions, specializing in Minimally Invasive Spine Surgery (MISS) to accelerate patient recovery and preserve mobility.',
    'hero_bg'    => 'assets/breadcrumbs/dr-parveen-services-breadcrumb/spine%20surgery.png',
]);

$section = get_page_section($pageContent, [
    'badge' => 'Spine Clinic',
    'title' => 'Comprehensive Spinal Care',
    'text' => "Spinal health affects every facet of daily movement. Our clinic covers the full range of spine pathology, prioritising conservative management first and turning to advanced Minimally Invasive Spine Surgery (MISS) only where it is genuinely warranted.\n\nWhen surgery is the right answer, the goal is maximal decompression and stability with minimal disruption to the surrounding muscle — smaller incisions, less postoperative pain, and a shorter stay in hospital.",
    'image' => 'assets/services/spine-surgery.png',
    'image_alt' => 'Spine Surgery',
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
                <span class="text-white font-medium">Spine Surgery</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-bone text-cyan-accent text-[10px]"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <?php $heroPrimary = cms_page_cta('spine-surgery', 'hero-primary'); ?>
                <?php if (trim($heroPrimary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroPrimary['url']); ?>" class="group inline-flex items-center space-x-3 bg-white text-deep-indigo text-sm font-bold pl-6 pr-2 py-2.5 rounded-full hover:bg-soft-cyan transition-colors duration-300">
                    <span><?php echo cms_cta_text('spine-surgery', 'hero-primary'); ?></span>
                    <span class="w-7 h-7 rounded-full bg-deep-indigo text-white flex items-center justify-center transition-transform group-hover:rotate-45 duration-300">
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Comprehensive Spinal Care Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($section['badge']); ?></span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($section['title']); ?></h2>
                <?php echo cms_section_paragraphs($section['text']); ?>

                <!-- Key Facts (CMS block) -->
                <?php cms_render_page_block('spine-surgery', 'key-facts'); ?>
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

<!-- Conditions We Treat -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('spine-surgery', 'conditions-we-treat'); ?>
    </div>
</section>

<!-- Treatment Journey -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('spine-surgery', 'what-to-expect'); ?>
    </div>
</section>

<!-- About Doctor Section (CMS block) -->
                <?php cms_render_page_block('spine-surgery', 'doctor'); ?>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<!-- Related Videos (topic-matched, see $pageVideos in includes/config.php) -->
<?php require __DIR__ . "/includes/related-videos.php"; ?>

<!-- FAQ Section (managed in CMS → FAQs) -->
<?php $faqSlug = 'spine-surgery'; require __DIR__ . '/includes/faq-section.php'; ?>



<?php require_once __DIR__ . '/includes/footer.php'; ?>
