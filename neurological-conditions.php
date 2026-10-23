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
                <a href="#directory" class="group inline-flex items-center space-x-2 text-white font-medium text-sm hover:text-cyan-accent transition-colors">
                    <span>Browse Conditions</span>
                    <i class="fas fa-arrow-down text-xs group-hover:translate-y-1 transition-transform"></i>
                </a>
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

        <?php
        // Condition directory — image, title, blurb and destination for each card
        $conditionCards = [
            [
                'url'   => 'stroke.php',
                'image' => 'assets/services/stroke.png',
                'title' => 'Brain Stroke',
                'desc'  => 'Acute care, mechanical thrombectomy, and comprehensive neuro-rehabilitation protocols to treat and recover from strokes.',
            ],
            [
                'url'   => 'epilepsy.php',
                'image' => 'assets/services/epilepsy.png',
                'title' => 'Epilepsy & Seizures',
                'desc'  => 'Personalized pharmacotherapy, long-term monitoring, and surgical evaluations for complex seizure disorders.',
            ],
            [
                'url'   => 'migraine.php',
                'image' => 'assets/services/migraine.png',
                'title' => 'Migraine',
                'desc'  => 'Advanced prevention therapies, lifestyle modification, and specialized neuro-modulators to manage chronic migraine.',
            ],
            [
                'url'   => 'headache.php',
                'image' => 'assets/services/headache.png',
                'title' => 'Headache Disorders',
                'desc'  => 'Comprehensive workups for tension headaches, cluster headaches, and secondary headache symptoms.',
            ],
            [
                'url'   => 'parkinsons.php',
                'image' => 'assets/services/parkinsons.png',
                'title' => "Parkinson's Disease",
                'desc'  => "Symptom control, advanced pharmacology, and Deep Brain Stimulation (DBS) therapies for Parkinson's disease.",
            ],
            [
                'url'   => 'ms.php',
                'image' => 'assets/services/ms.png',
                'title' => 'Multiple Sclerosis',
                'desc'  => 'Immunomodulatory therapies and tailored symptom management to improve mobility and reduce relapse frequency.',
            ],
            [
                'url'   => 'movement.php',
                'image' => 'assets/services/movement.png',
                'title' => 'Movement Disorders',
                'desc'  => 'Specialized management of tremor, dystonia, chorea, and other complex involuntary movement issues.',
            ],
            [
                'url'   => 'neuropathy.php',
                'image' => 'assets/services/neuropathy.png',
                'title' => 'Peripheral Neuropathy',
                'desc'  => 'Nerve testing, neuropathic pain management, and root-cause therapies for nerve damage and sensory loss.',
            ],
            [
                'url'   => 'vertigo.php',
                'image' => 'assets/services/vertigo.png',
                'title' => 'Vertigo & Balance',
                'desc'  => 'Diagnostic balance assessments, vestibular testing, and physical rehabilitation programs to stop dizziness.',
            ],
        ];
        ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($conditionCards as $index => $card): ?>
                <a href="<?php echo $card['url']; ?>"
                   class="group bg-white rounded-3xl p-5 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 flex flex-col"
                   style="animation-delay: <?php echo $index * 100; ?>ms;">

                    <!-- Image -->
                    <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-soft-cyan to-silver-grey">
                        <img src="<?php echo $card['image']; ?>"
                             alt="<?php echo htmlspecialchars($card['title']); ?> treatment"
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Title & Arrow -->
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-deep-indigo group-hover:text-electric-blue transition-colors leading-tight">
                            <?php echo $card['title']; ?>
                        </h3>
                        <div class="w-10 h-10 rounded-full border border-silver-grey flex items-center justify-center text-dark-grey group-hover:text-white group-hover:bg-gradient-to-r group-hover:from-electric-blue group-hover:to-cyan-accent group-hover:border-transparent transition-all duration-300 flex-shrink-0 ml-4">
                            <i class="fas fa-arrow-right group-hover:-rotate-45 transition-transform duration-300"></i>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-dark-grey/70 leading-relaxed text-sm">
                        <?php echo $card['desc']; ?>
                    </p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
