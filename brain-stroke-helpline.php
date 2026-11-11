<?php
/**
 * Brain Stroke Helpline Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('brain-stroke-helpline', [
    'hero_badge' => '24/7 Urgent Stroke Care',
    'hero_title' => '24/7 Brain Stroke <span class="text-red-400">Helpline</span>',
    'hero_desc'  => 'A stroke is a medical emergency. Every minute counts. Under the leadership of Dr. Praveen Gupta, Marengo Asia Hospital offers round-the-clock emergency thrombolysis and mechanical thrombectomy.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
]);

$section = get_page_section($pageContent, [
    'badge' => 'Clinical Protocol',
    'title' => 'Golden Hour Window',
    'text' => 'When a stroke strikes, millions of brain cells die every minute. Reversing this damage is highly dependent on how quickly blood flow is restored.',
    'image' => '',
    'image_alt' => 'Emergency stroke protocol',
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
                <span class="text-white font-medium">Stroke Helpline</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-exclamation-triangle text-red-400 text-[10px] animate-pulse"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>

            <!-- Emergency Direct Action Button -->
            <div class="flex flex-wrap items-center gap-4">
                <?php $heroPrimary = cms_page_cta('brain-stroke-helpline', 'hero-primary'); ?>
                <?php if (trim($heroPrimary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroPrimary['url']); ?>" class="inline-flex items-center space-x-3 bg-red-600 hover:bg-red-700 text-white font-extrabold text-lg px-8 py-4 rounded-2xl shadow-lg shadow-red-600/20 hover:shadow-red-600/40 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fas fa-phone-alt animate-bounce"></i>
                    <span><?php echo cms_cta_text('brain-stroke-helpline', 'hero-primary'); ?></span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- F.A.S.T. Signs Section (CMS block) -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('brain-stroke-helpline', 'fast-signs'); ?>
    </div>
</section>

<!-- Stroke Protocols -->
<section class="py-12 bg-[#edf5f9] border-y border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left Card: Urgent Care Timelines -->
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <span class="text-red-600 font-bold text-xs uppercase tracking-wider"><?php echo htmlspecialchars($section['badge']); ?></span>
                    <h2 class="text-3xl font-bold text-dark-grey mt-2 mb-4"><?php echo htmlspecialchars($section['title']); ?></h2>
                    <?php echo cms_section_paragraphs($section['text'], 'text-sm text-dark-grey/65 leading-relaxed', 'mb-0'); ?>
                    <?php if (!empty($section['image'])): ?>
                    <div class="mt-4 rounded-2xl overflow-hidden border border-slate-200/60">
                        <img src="<?php echo htmlspecialchars($section['image']); ?>" alt="<?php echo htmlspecialchars($section['image_alt']); ?>" class="w-full h-auto object-cover">
                    </div>
                    <?php endif; ?>
                </div>
                <!-- Golden Hour timelines (CMS block) -->
                <?php cms_render_page_block('brain-stroke-helpline', 'golden-hour'); ?>
            </div>

            <!-- Right Card: numbered steps while waiting (CMS block) -->
            <?php cms_render_page_block('brain-stroke-helpline', 'while-waiting'); ?>
        </div>
    </div>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<!-- Related Videos (topic-matched, see $pageVideos in includes/config.php) -->
<?php require __DIR__ . "/includes/related-videos.php"; ?>

<!-- FAQ Section (managed in CMS → FAQs) -->
<?php $faqSlug = 'brain-stroke-helpline'; require __DIR__ . '/includes/faq-section.php'; ?>



<?php require_once __DIR__ . '/includes/footer.php'; ?>
