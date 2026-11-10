<?php
/**
 * Epilepsy Service Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('epilepsy', [
    'hero_badge' => 'Specialized Neurological Care',
    'hero_title' => 'Expert <span class="text-white">Epilepsy</span> Treatment',
    'hero_desc'  => 'Comprehensive care for seizures and epilepsy disorders. Dr. Praveen Gupta provides advanced diagnosis and personalized treatment plans to help you achieve seizure freedom.',
    'hero_bg'    => 'assets/breadcrumbs/dr-parveen-epilepsy.png',
]);

$section = get_page_section($pageContent, [
    'badge' => 'Understanding',
    'title' => 'What is Epilepsy?',
    'text' => "Epilepsy is a neurological disorder characterized by recurrent, unprovoked seizures. It affects over 50 million people worldwide, making it one of the most common neurological conditions. While epilepsy can develop at any age, it often begins in childhood or after age 60.\n\nAt our clinic, we understand that living with epilepsy affects every aspect of your life—from daily activities to personal relationships. Our comprehensive approach focuses not just on controlling seizures, but on improving your overall quality of life through evidence-based treatments and compassionate care.",
    'image' => 'assets/services/epilepsy.png',
    'image_alt' => 'Understanding Epilepsy',
]);
$heroBg = cms_media_path($pageContent['hero_bg'] ?? '', 'assets/breadcrumbs/dr-parveen-epilepsy.png');
$heroAlt = trim((string)($pageContent['hero_bg_alt'] ?? ''));
if ($heroAlt === '') $heroAlt = trim(strip_tags($pageContent['hero_title'] ?? 'Dr. Praveen Gupta'));
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <!-- Background image (gradient above stays as the fallback if it fails to load) -->
    <?php if ($heroBg): ?>
    <img src="<?php echo htmlspecialchars($heroBg); ?>" alt="<?php echo htmlspecialchars($heroAlt); ?>"
         fetchpriority="high"
         class="absolute inset-0 w-full h-full object-cover object-[78%_center] md:object-right pointer-events-none select-none">

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
                <span class="text-white font-medium">Epilepsy</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-bolt text-[10px]"></i>
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
                <?php $heroPrimary = cms_page_cta('epilepsy', 'hero-primary'); ?>
                <?php if (trim($heroPrimary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroPrimary['url']); ?>" class="inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
                    <span><?php echo cms_cta_text('epilepsy', 'hero-primary'); ?></span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
                <?php endif; ?>
                <?php $heroSecondary = cms_page_cta('epilepsy', 'hero-secondary'); ?>
                <?php if (trim($heroSecondary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroSecondary['url']); ?>" class="inline-flex items-center space-x-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold px-6 py-2.5 rounded-full border border-white/30 hover:bg-white/30 transition-all duration-300 text-sm">
                    <i class="fas fa-phone text-xs"></i>
                    <span><?php echo cms_cta_text('epilepsy', 'hero-secondary'); ?></span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- What is Epilepsy Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($section['badge']); ?></span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($section['title']); ?></h2>
                <?php echo cms_section_paragraphs($section['text']); ?>

                <!-- Key Facts (CMS block) -->
                <?php cms_render_page_block('epilepsy', 'key-facts'); ?>
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

<!-- Types of Seizures -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('epilepsy', 'types'); ?>

        <!-- Warning Signs (CMS block) -->
        <?php cms_render_page_block('epilepsy', 'warning'); ?>
    </div>
</section>

<!-- Symptoms Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('epilepsy', 'symptoms'); ?>
    </div>
</section>

<!-- Diagnosis Section -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('epilepsy', 'diagnosis'); ?>

        <!-- CTA (text + destination edited in CMS) -->
        <?php $diagnosisCta = cms_page_cta('epilepsy', 'diagnosis'); ?>
        <?php if (trim($diagnosisCta['text']) !== ''): ?>
        <div class="text-center">
            <?php if (trim($diagnosisCta['intro']) !== ''): ?>
            <p class="text-dark-grey/70 mb-6"><?php echo $diagnosisCta['intro']; ?></p>
            <?php endif; ?>
            <a href="<?php echo cms_cta_href($diagnosisCta['url']); ?>" class="inline-flex items-center space-x-3 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold px-8 py-4 rounded-full hover:shadow-xl hover:shadow-electric-blue/30 transition-all duration-300 transform hover:-translate-y-1">
                <span><?php echo cms_cta_text('epilepsy', 'diagnosis'); ?></span>
                <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Treatment Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('epilepsy', 'treatments'); ?>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-12 bg-slate-50/50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('epilepsy', 'why-choose'); ?>
    </div>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<!-- Related Videos (topic-matched, see $pageVideos in includes/config.php) -->
<?php require __DIR__ . "/includes/related-videos.php"; ?>

<!-- FAQ Section (managed in CMS → FAQs) -->
<?php $faqSlug = 'epilepsy'; require __DIR__ . '/includes/faq-section.php'; ?>



<!-- Related Services -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('epilepsy', 'related'); ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
