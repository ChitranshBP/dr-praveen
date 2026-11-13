<?php
/**
 * Functional Neurosurgery Clinic Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$functionalSectionText = "Functional neurosurgery restores neurological function and relieves motor deficits through direct electrical modulation of the brain circuits responsible — rather than through drugs that act on the whole body.\n\nDr. Praveen Gupta's team pioneered the first Deep Brain Stimulation surgeries in Gurgaon, and specialises in high-precision stereotactic procedures for patients whose symptoms no longer respond to conventional medication.";

$pageContent = get_page_content('functional-neurosurgery', [
    'hero_badge' => 'Advanced Neuromodulation Center',
    'hero_title' => 'Functional <span class="text-cyan-accent">Neurosurgery</span>',
    'hero_desc' => 'Advanced surgical treatments for movement disorders, pioneering Deep Brain Stimulation (DBS) to restore control, alleviate tremors, and improve daily functions.',
    'hero_bg' => 'assets/breadcrumbs/dr-parveen-services-breadcrumb/Functional%20Neurosurgery.png',
    'section1_badge' => 'Neuromodulation Excellence',
    'section1_title' => 'Restoring Motor Functions',
    'section1_text' => $functionalSectionText
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
            <?php cms_breadcrumb_nav('functional-neurosurgery'); ?>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas <?php echo htmlspecialchars(trim((string)($pageContent['hero_icon'] ?? '')) !== '' ? $pageContent['hero_icon'] : 'fa-microchip'); ?> text-cyan-accent text-[10px]"></i>
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
                <?php $heroPrimary = cms_page_cta('functional-neurosurgery', 'hero-primary'); ?>
                <?php if (trim($heroPrimary['text']) !== ''): ?>
                <a href="<?php echo cms_cta_href($heroPrimary['url']); ?>" class="group inline-flex items-center space-x-3 bg-white text-deep-indigo text-sm font-bold pl-6 pr-2 py-2.5 rounded-full hover:bg-soft-cyan transition-colors duration-300">
                    <span><?php echo cms_cta_text('functional-neurosurgery', 'hero-primary'); ?></span>
                    <span class="w-7 h-7 rounded-full bg-deep-indigo text-white flex items-center justify-center transition-transform group-hover:rotate-45 duration-300">
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<!-- Page sections: order, visibility and content are managed in CMS → All Pages -->
<?php cms_render_page_flow('functional-neurosurgery'); ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
