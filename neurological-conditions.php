<?php
/**
 * Neurological Conditions Hub - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('neurological-conditions', [
    'hero_badge' => 'Comprehensive Neurology Directory',
    'hero_title' => 'Neurological <span class="text-cyan-accent">Conditions</span>',
    'hero_desc'  => 'Explore comprehensive information, symptoms, and advanced diagnostic and treatment options for a wide spectrum of neurological disorders.'
]);

$section = get_page_section($pageContent, [
    'badge' => 'Neurology Portal',
    'title' => 'Explore Medical Conditions',
    'text' => 'Click on any of the specialties below to read detailed resources on symptoms, diagnosis, and care plans.',
    'image' => '',
    'image_alt' => '',
]);
$heroBg = cms_media_path($pageContent['hero_bg'] ?? '');
$heroAlt = trim((string)($pageContent['hero_bg_alt'] ?? ''));
if ($heroAlt === '') $heroAlt = trim(strip_tags($pageContent['hero_title'] ?? 'Dr. Praveen Gupta'));
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <?php if ($heroBg): ?>
    <img src="<?php echo htmlspecialchars($heroBg); ?>" alt="<?php echo htmlspecialchars($heroAlt); ?>"
         fetchpriority="high"
         class="absolute inset-0 w-full h-full object-cover object-[78%_center] md:object-right pointer-events-none select-none">
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/75 to-deep-indigo/35 md:to-transparent"></div>
    <?php else: ?>
    <div class="absolute inset-0 bg-black/10"></div>
    <?php endif; ?>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Neurological Conditions</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-brain text-cyan-accent text-[10px]"></i>
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
                <?php $heroPrimary = cms_page_cta('neurological-conditions', 'hero-primary'); ?>
                <?php if (trim($heroPrimary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroPrimary['url']); ?>" class="group inline-flex items-center space-x-2 text-white font-medium text-sm hover:text-cyan-accent transition-colors">
                    <span><?php echo cms_cta_text('neurological-conditions', 'hero-primary'); ?></span>
                    <i class="fas fa-arrow-down text-xs group-hover:translate-y-1 transition-transform"></i>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Conditions Grid Section -->
<section id="directory" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider"><?php echo htmlspecialchars($section['badge']); ?></span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2"><?php echo htmlspecialchars($section['title']); ?></h2>
            <?php echo cms_section_paragraphs($section['text'], 'text-sm text-dark-grey/65 mt-3 leading-relaxed', 'mb-0'); ?>
        </div>

        <?php if (!empty($section['image'])): ?>
        <div class="max-w-3xl mx-auto -mt-4 mb-10 rounded-3xl overflow-hidden shadow-lg border border-slate-200/50">
            <img src="<?php echo htmlspecialchars($section['image']); ?>" alt="<?php echo htmlspecialchars($section['image_alt']); ?>" class="w-full h-auto object-cover">
        </div>
        <?php endif; ?>

        <!-- Condition directory cards (CMS block) -->
        <?php cms_render_page_block('neurological-conditions', 'condition-cards'); ?>
    </div>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
