<?php
/**
 * Headache Service Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('headache', [
    'hero_badge' => 'Specialized Neurological Care',
    'hero_title' => 'Expert <span class="text-white">Headache</span> Treatment',
    'hero_desc'  => 'Comprehensive care for chronic, acute, and complex headache disorders. Dr. Praveen Gupta provides accurate diagnosis and targeted therapies to help you find lasting relief.',
    'hero_bg'    => 'assets/breadcrumbs/dr-parveen-headache.png',
]);

$section = get_page_section($pageContent, [
    'badge' => 'Understanding',
    'title' => 'What is a Headache Disorder?',
    'text' => "A headache is pain or discomfort in the head or face area. While almost everyone experiences headaches occasionally, recurrent or persistent headaches can indicate an underlying disorder that requires expert medical evaluation and management.\n\nLiving with frequent headaches can significantly impact your work, relationships, and emotional well-being. Our clinic focuses on identifying your specific headache type and triggers, creating a customized plan combining preventive strategies and advanced treatments.",
    'image' => 'assets/services/headache.png',
    'image_alt' => 'Understanding Headache',
]);
$heroBg = cms_media_path($pageContent['hero_bg'] ?? '', 'assets/breadcrumbs/dr-parveen-headache.png');
$heroAlt = trim((string)($pageContent['hero_bg_alt'] ?? ''));
if ($heroAlt === '') $heroAlt = trim(strip_tags($pageContent['hero_title'] ?? 'Dr. Praveen Gupta'));
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <!-- Background image (gradient above stays as the fallback if it fails to load) -->
    <?php if ($heroBg): ?>
    <img src="<?php echo htmlspecialchars($heroBg); ?>" alt="<?php echo htmlspecialchars($heroAlt); ?>"
         fetchpriority="high"
         class="absolute inset-0 w-full h-full object-cover object-[72%_center] md:object-right pointer-events-none select-none">

    <!-- Legibility overlay: solid behind the copy, clearing towards the photo on the right -->
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
                <span class="text-white font-medium">Headache</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-head-side-virus text-[10px]"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>

            <!-- CTA Buttons (edited in CMS → Call-to-Action Buttons) -->
            <div class="flex flex-wrap gap-3">
                <?php $heroPrimary = cms_page_cta('headache', 'hero-primary'); ?>
                <?php if (trim($heroPrimary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroPrimary['url']); ?>" class="inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
                    <span><?php echo cms_cta_text('headache', 'hero-primary'); ?></span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
                <?php endif; ?>
                <?php $heroSecondary = cms_page_cta('headache', 'hero-secondary'); ?>
                <?php if (trim($heroSecondary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroSecondary['url']); ?>" class="inline-flex items-center space-x-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold px-6 py-2.5 rounded-full border border-white/30 hover:bg-white/30 transition-all duration-300 text-sm">
                    <i class="fas fa-phone text-xs"></i>
                    <span><?php echo cms_cta_text('headache', 'hero-secondary'); ?></span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- What is Headache Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($section['badge']); ?></span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($section['title']); ?></h2>
                <?php echo cms_section_paragraphs($section['text']); ?>

                <!-- Key Facts (CMS block) -->
                <?php cms_render_page_block('headache', 'key-facts'); ?>
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

<!-- Types of Headaches -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('headache', 'types'); ?>

        <!-- Warning Signs (CMS block) -->
        <?php cms_render_page_block('headache', 'warning'); ?>
    </div>
</section>

<!-- Symptoms Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('headache', 'symptoms'); ?>
    </div>
</section>

<!-- Diagnosis Section -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('headache', 'diagnosis'); ?>

        <!-- CTA (text + destination edited in CMS) -->
        <?php $diagnosisCta = cms_page_cta('headache', 'diagnosis'); ?>
        <?php if (trim($diagnosisCta['text']) !== ''): ?>
        <div class="text-center">
            <?php if (trim($diagnosisCta['intro']) !== ''): ?>
            <p class="text-dark-grey/70 mb-6"><?php echo $diagnosisCta['intro']; ?></p>
            <?php endif; ?>
            <a href="<?php echo cms_cta_href($diagnosisCta['url']); ?>" class="inline-flex items-center space-x-3 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold px-8 py-4 rounded-full hover:shadow-xl hover:shadow-electric-blue/30 transition-all duration-300 transform hover:-translate-y-1">
                <span><?php echo cms_cta_text('headache', 'diagnosis'); ?></span>
                <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Treatment Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('headache', 'treatments'); ?>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-12 bg-slate-50/50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('headache', 'why-choose'); ?>
    </div>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<!-- Related Videos (topic-matched, see $pageVideos in includes/config.php) -->
<?php require __DIR__ . "/includes/related-videos.php"; ?>

<!-- FAQ Section (managed in CMS → FAQs) -->
<?php $faqSlug = 'headache'; require __DIR__ . '/includes/faq-section.php'; ?>



<!-- Related Services -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('headache', 'related'); ?>
    </div>
</section>

<!-- CTA Section -->


<?php require_once __DIR__ . '/includes/footer.php'; ?>
