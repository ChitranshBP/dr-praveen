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
            <?php cms_breadcrumb_nav('brain-stroke-helpline'); ?>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas <?php echo htmlspecialchars(trim((string)($pageContent['hero_icon'] ?? '')) !== '' ? $pageContent['hero_icon'] : 'fa-exclamation-triangle'); ?> text-red-400 text-[10px] animate-pulse"></i>
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


<!-- Page sections: order, visibility and content are managed in CMS → All Pages -->
<?php cms_render_page_flow('brain-stroke-helpline'); ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
