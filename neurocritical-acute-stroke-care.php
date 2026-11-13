<?php
/**
 * Neurocritical & Acute Stroke Care - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('neurocritical-acute-stroke-care', [
    'hero_badge' => '24/7 Stroke Rescue & ICU',
    'hero_title' => 'Neurocritical & <span class="text-cyan-accent">Acute Stroke Care</span>',
    'hero_desc'  => 'Immediate, lifesaving interventions for brain stroke, severe trauma, status epilepticus, and neurological emergencies. Monitored continuously in our specialized Neuro-ICU.',
    'hero_bg'    => 'assets/breadcrumbs/dr-parveen-services-breadcrumb/Neurocritical%20%26%20Acute%20Stroke.png',
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
            <?php cms_breadcrumb_nav('neurocritical-acute-stroke-care'); ?>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas <?php echo htmlspecialchars(trim((string)($pageContent['hero_icon'] ?? '')) !== '' ? $pageContent['hero_icon'] : 'fa-clock'); ?> text-[10px] animate-pulse text-red-400"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap gap-3">
                <?php $heroPrimary = cms_page_cta('neurocritical-acute-stroke-care', 'hero-primary'); ?>
                <?php if (trim($heroPrimary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroPrimary['url']); ?>" class="inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
                    <span><?php echo cms_cta_text('neurocritical-acute-stroke-care', 'hero-primary'); ?></span>
                    <i class="fas fa-phone-alt text-xs text-red-500"></i>
                </a>
                <?php endif; ?>
                <?php $heroSecondary = cms_page_cta('neurocritical-acute-stroke-care', 'hero-secondary'); ?>
                <?php if (trim($heroSecondary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroSecondary['url']); ?>" class="inline-flex items-center space-x-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold px-6 py-2.5 rounded-full border border-white/30 hover:bg-white/30 transition-all duration-300 text-sm">
                    <span><?php echo cms_cta_text('neurocritical-acute-stroke-care', 'hero-secondary'); ?></span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<!-- Page sections: order, visibility and content are managed in CMS → All Pages -->
<?php cms_render_page_flow('neurocritical-acute-stroke-care'); ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
