<?php
/**
 * Awards & Recognition Page - Dr. Praveen Gupta
 *
 * Award photos come from CMS → Awards & Honours; the banner copy from
 * CMS → All Pages → Awards & Recognition; every section below is a CMS block.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('awards-and-recognition', [
    'hero_badge' => 'Honors & Certifications',
    'hero_title' => 'Awards & <span class="text-cyan-accent">Recognition</span>',
    'hero_desc'  => 'Recognizing outstanding clinical contributions, medical innovations, and dedicated patient care services in the field of neurology.',
    'hero_bg'    => 'assets/breadcrumbs/about.png'
]);
$heroBg = cms_media_path($pageContent['hero_bg'] ?? '', 'assets/breadcrumbs/about.png');
?>

<!-- Hero Section -->
<section class="relative overflow-hidden text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($heroBg); ?>');">
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/85 to-electric-blue/30"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <?php cms_breadcrumb_nav('awards-and-recognition'); ?>

            <?php if (trim((string)($pageContent['hero_badge'] ?? '')) !== ''): ?>
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas <?php echo htmlspecialchars(trim((string)($pageContent['hero_icon'] ?? '')) !== '' ? $pageContent['hero_icon'] : 'fa-award'); ?> text-cyan-accent text-[10px]"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>
            <?php endif; ?>

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <?php if (trim((string)($pageContent['hero_desc'] ?? '')) !== ''): ?>
            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php cms_render_page_flow('awards-and-recognition'); ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
