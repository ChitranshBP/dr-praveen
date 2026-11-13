<?php
/**
 * Why Choose Dr. Praveen Gupta - Special Page
 *
 * Banner copy and button come from CMS → All Pages → Why Choose Us; every
 * section below the banner is a CMS block.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('why-choose-dr-praveen-gupta', [
    'hero_badge' => 'Leading Neurologist in India',
    'hero_title' => 'Why Choose <span class="text-cyan-accent">Dr. Praveen Gupta</span>',
    'hero_desc'  => 'Discover the credentials, achievements, and unique patient-first healthcare philosophy that make Dr. Praveen Gupta one of India\'s most trusted neurological specialists.',
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
            <?php cms_breadcrumb_nav('why-choose-dr-praveen-gupta'); ?>

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

            <?php $heroPrimary = cms_page_cta('why-choose-dr-praveen-gupta', 'hero-primary'); ?>
            <?php if (trim($heroPrimary['text']) !== ''): ?>
            <div class="flex flex-wrap items-center gap-4">
                <a href="<?php echo cms_cta_href($heroPrimary['url']); ?>" class="group inline-flex items-center space-x-3 bg-white text-deep-indigo text-sm font-bold pl-6 pr-2 py-2.5 rounded-full hover:bg-soft-cyan transition-colors duration-300">
                    <span><?php echo cms_cta_text('why-choose-dr-praveen-gupta', 'hero-primary'); ?></span>
                    <span class="w-7 h-7 rounded-full bg-deep-indigo text-white flex items-center justify-center transition-transform group-hover:rotate-45 duration-300">
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </span>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php cms_render_page_flow('why-choose-dr-praveen-gupta'); ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
