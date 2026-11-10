<?php
/**
 * Migraine Service Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('migraine', [
    'hero_badge' => 'Specialized Neurological Care',
    'hero_title' => 'Expert <span class="text-white">Migraine</span> Treatment',
    'hero_desc'  => 'Advanced relief plans and prevention programs for acute and chronic migraine. Dr. Praveen Gupta provides customized care to help you regain control of your life.',
    'hero_bg'    => 'assets/breadcrumbs/dr-parveen-migraine.png',
]);

$section = get_page_section($pageContent, [
    'badge' => 'Understanding',
    'title' => 'What is a Migraine?',
    'text' => "A migraine is a neurological condition that causes intense, throbbing head pain, usually on one side. Unlike common tension headaches, migraines often present with associated symptoms like severe nausea, vomiting, and extreme sensitivity to light, sound, and smell.\n\nAn attack can last from several hours to days, making daily activities impossible. Our targeted diagnostic and therapy framework aims to reduce the severity and frequency of your migraine episodes using cutting-edge medical treatments.",
    'image' => 'assets/services/migraine.png',
    'image_alt' => 'Understanding Migraine',
]);
$heroBg = cms_media_path($pageContent['hero_bg'] ?? '', 'assets/breadcrumbs/dr-parveen-migraine.png');
$heroAlt = trim((string)($pageContent['hero_bg_alt'] ?? ''));
if ($heroAlt === '') $heroAlt = trim(strip_tags($pageContent['hero_title'] ?? 'Dr. Praveen Gupta'));
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <!-- Background image (gradient above stays as the fallback if it fails to load) -->
    <?php if ($heroBg): ?>
    <img src="<?php echo htmlspecialchars($heroBg); ?>" alt="<?php echo htmlspecialchars($heroAlt); ?>"
         fetchpriority="high"
         class="absolute inset-0 w-full h-full object-cover object-[68%_center] md:object-right pointer-events-none select-none">

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
                <span class="text-white font-medium">Migraine</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-brain text-[10px]"></i>
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
                <?php $heroPrimary = cms_page_cta('migraine', 'hero-primary'); ?>
                <?php if (trim($heroPrimary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroPrimary['url']); ?>" class="inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
                    <span><?php echo cms_cta_text('migraine', 'hero-primary'); ?></span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
                <?php endif; ?>
                <?php $heroSecondary = cms_page_cta('migraine', 'hero-secondary'); ?>
                <?php if (trim($heroSecondary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroSecondary['url']); ?>" class="inline-flex items-center space-x-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold px-6 py-2.5 rounded-full border border-white/30 hover:bg-white/30 transition-all duration-300 text-sm">
                    <i class="fas fa-phone text-xs"></i>
                    <span><?php echo cms_cta_text('migraine', 'hero-secondary'); ?></span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- What is Migraine Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($section['badge']); ?></span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($section['title']); ?></h2>
                <?php echo cms_section_paragraphs($section['text']); ?>

                <!-- Key Facts (CMS block) -->
                <?php cms_render_page_block('migraine', 'key-facts'); ?>
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

<!-- Types of Migraines -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('migraine', 'types'); ?>

        <!-- Warning Signs (CMS block) -->
        <?php cms_render_page_block('migraine', 'warning'); ?>
    </div>
</section>

<!-- Symptoms Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('migraine', 'symptoms'); ?>
    </div>
</section>

<!-- Diagnosis Section -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('migraine', 'diagnosis'); ?>

        <!-- CTA (text + destination edited in CMS) -->
        <?php $diagnosisCta = cms_page_cta('migraine', 'diagnosis'); ?>
        <?php if (trim($diagnosisCta['text']) !== ''): ?>
        <div class="text-center">
            <?php if (trim($diagnosisCta['intro']) !== ''): ?>
            <p class="text-dark-grey/70 mb-6"><?php echo $diagnosisCta['intro']; ?></p>
            <?php endif; ?>
            <a href="<?php echo cms_cta_href($diagnosisCta['url']); ?>" class="inline-flex items-center space-x-3 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold px-8 py-4 rounded-full hover:shadow-xl hover:shadow-electric-blue/30 transition-all duration-300 transform hover:-translate-y-1">
                <span><?php echo cms_cta_text('migraine', 'diagnosis'); ?></span>
                <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Treatment Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('migraine', 'treatments'); ?>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-12 bg-slate-50/50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('migraine', 'why-choose'); ?>
    </div>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<!-- Related Videos (topic-matched, see $pageVideos in includes/config.php) -->
<?php require __DIR__ . "/includes/related-videos.php"; ?>

<!-- FAQ Section (managed in CMS → FAQs) -->
<?php $faqSlug = 'migraine'; require __DIR__ . '/includes/faq-section.php'; ?>



<!-- Related Services -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('migraine', 'related'); ?>
    </div>
</section>

<!-- Final CTA (CMS block) -->
<?php cms_render_page_block('migraine', 'final-cta'); ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
