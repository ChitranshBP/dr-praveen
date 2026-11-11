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

$section = get_page_section($pageContent, [
    'badge' => 'Emergency Response',
    'title' => 'Expert Acute Stroke & Neuro ICU',
    'text' => "A neurological emergency requires rapid diagnostics and immediate treatment. The \"Golden Hour\" represents the first few hours after stroke symptoms begin. Restoring blood flow to the brain via thrombolysis (clot-busting medication) or mechanical thrombectomy (catheter clot retrieval) can reverse paralysis and save lives.\n\nFollowing initial rescue, critically ill patients are monitored in our advanced Neuro-ICU. Here, we track intracranial pressure (ICP), brain oxygenation, and continuous electroencephalography (EEG) to detect non-convulsive seizures and protect tissue.",
    'image' => 'assets/services/stroke-care.png',
    'image_alt' => 'Neurocritical ICU room',
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
                <a href="services" class="hover:text-white transition-colors">Services</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Neurocritical Care</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-clock text-[10px] animate-pulse text-red-400"></i>
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

<!-- What is Neurocritical Care Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($section['badge']); ?></span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($section['title']); ?></h2>
                <?php echo cms_section_paragraphs($section['text']); ?>

                <!-- Key Facts (CMS block) -->
                <?php cms_render_page_block('neurocritical-acute-stroke-care', 'key-facts'); ?>
            </div>

            <!-- Image Side -->
            <div class="relative flex justify-center lg:justify-end animate-slide-in-right">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-red-50 to-white border border-red-200/50">
                    <img src="<?php echo htmlspecialchars($section['image']); ?>" alt="<?php echo htmlspecialchars($section['image_alt']); ?>" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BE FAST Stroke Warning Signs (CMS block) -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('neurocritical-acute-stroke-care', 'be-fast'); ?>
    </div>
</section>

<!-- Clinical ICU Steps (CMS block) -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('neurocritical-acute-stroke-care', 'emergency-protocol'); ?>
    </div>
</section>

<!-- About Doctor Section (CMS block) -->
<?php cms_render_page_block('neurocritical-acute-stroke-care', 'doctor'); ?>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<!-- Related Videos (topic-matched, see $pageVideos in includes/config.php) -->
<?php require __DIR__ . "/includes/related-videos.php"; ?>

<!-- FAQ Section (managed in CMS → FAQs) -->
<?php $faqSlug = 'neurocritical-acute-stroke-care'; require __DIR__ . '/includes/faq-section.php'; ?>



<?php require_once __DIR__ . '/includes/footer.php'; ?>
