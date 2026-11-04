<?php
/**
 * Memory & Cognitive Center Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('memory-clinic', [
    'hero_badge' => 'Cognitive & Dementia Evaluation Center',
    'hero_title' => 'Memory & <span class="text-cyan-accent">Cognitive Center</span>',
    'hero_desc'  => 'Comprehensive clinical diagnosis, cognitive screening, pharmacotherapy, and family support systems to manage dementia, Alzheimer\'s, and memory disorders.',
    'hero_bg'    => 'assets/breadcrumbs/dr-parveen-services-breadcrumb/memory.png',
]);

$section = get_page_section($pageContent, [
    'badge' => 'Cognitive Care',
    'title' => 'Understanding Memory Disorders',
    'text' => "Memory loss ranges from mild forgetfulness to progressive conditions such as dementia and Alzheimer's disease. Early detection is what makes the difference — it slows progression and buys quality of life for both patient and family.\n\nOur centre maps the root cause of cognitive symptoms rather than assuming one, because a meaningful proportion of memory complaints turn out to be treatable: a vitamin deficiency, a thyroid imbalance or a medication effect.",
    'image' => 'assets/services/memory-clinic.png',
    'image_alt' => 'Memory Clinic',
]);
$heroBg = cms_media_path($pageContent['hero_bg'] ?? '');
$heroAlt = trim((string)($pageContent['hero_bg_alt'] ?? ''));
if ($heroAlt === '') $heroAlt = trim(strip_tags($pageContent['hero_title'] ?? 'Dr. Praveen Gupta'));
?>

<!-- Hero Section -->
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
                <span class="text-white font-medium">Memory Clinic</span>
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
                <a href="contact-us-top-neurologist-delhi-ncr" class="group inline-flex items-center space-x-3 bg-white text-deep-indigo text-sm font-bold pl-6 pr-2 py-2.5 rounded-full hover:bg-soft-cyan transition-colors duration-300">
                    <span>Schedule Evaluation</span>
                    <span class="w-7 h-7 rounded-full bg-deep-indigo text-white flex items-center justify-center transition-transform group-hover:rotate-45 duration-300">
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Understanding Memory Disorders Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($section['badge']); ?></span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($section['title']); ?></h2>
                <?php echo cms_section_paragraphs($section['text']); ?>

                <!-- Key Facts -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Cognitive Testing</div>
                            <div class="text-xs text-dark-grey/60">MoCA and MMSE assessments</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Brain Imaging</div>
                            <div class="text-xs text-dark-grey/60">High-resolution MRI</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Lab Panels</div>
                            <div class="text-xs text-dark-grey/60">Rules out reversible causes</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Caregiver Support</div>
                            <div class="text-xs text-dark-grey/60">Training for the whole family</div>
                        </div>
                    </div>
                </div>
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

<!-- Conditions We Assess -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('memory-clinic', 'conditions-we-assess'); ?>
    </div>
</section>

<!-- Assessment Journey -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_page_block('memory-clinic', 'what-to-expect'); ?>
    </div>
</section>

<!-- About Doctor Section -->
<section class="py-16 bg-[#edf5f9] border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Expert Leadership</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Meet the Specialist</h2>
        </div>

        <div class="max-w-4xl mx-auto bg-white border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
            <div class="grid md:grid-cols-12 gap-8 items-center p-8">
                <div class="md:col-span-4 aspect-[4/5] rounded-2xl overflow-hidden relative shadow-md bg-gradient-to-br from-deep-indigo to-electric-blue p-0.5">
                    <div class="relative w-full h-full rounded-[0.9rem] overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent">
                        <img src="assets/dpg-1.webp" alt="Dr. Praveen Gupta" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="md:col-span-8 space-y-4">
                    <span class="text-cyan-accent font-bold text-xs uppercase tracking-widest">Chairman - Marengo Asia Neuro & Spine</span>
                    <h3 class="text-2xl font-bold text-deep-indigo font-serif">Dr. Praveen Gupta</h3>
                    <p class="text-sm text-dark-grey/70 leading-relaxed font-light">
                        Dr. Praveen Gupta is a pioneering neurologist with 20+ years of clinical excellence. Renowned for introducing the first stroke mechanical thrombectomy services in Gurgaon and executing the region's first Deep Brain Stimulation (DBS) surgery, he leads Marengo Asia Neuro & Spine Institute with a commitment to state-of-the-art diagnostics and compassionate patient recovery.
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <a href="about" class="text-xs font-semibold text-electric-blue hover:underline">Full Biography <i class="fas fa-arrow-right text-[10px] ml-1"></i></a>
                        <span class="text-slate-300">|</span>
                        <a href="why-choose-dr-praveen-gupta" class="text-xs font-semibold text-electric-blue hover:underline">Why Choose Dr. Praveen <i class="fas fa-arrow-right text-[10px] ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<!-- Related Videos (topic-matched, see $pageVideos in includes/config.php) -->
<?php require __DIR__ . "/includes/related-videos.php"; ?>

<!-- FAQ Section (managed in CMS → FAQs) -->
<?php $faqSlug = 'memory-clinic'; require __DIR__ . '/includes/faq-section.php'; ?>



<?php require_once __DIR__ . '/includes/footer.php'; ?>
