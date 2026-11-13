<?php
/**
 * Patient Success Stories Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('patient-success-stories', [
    'hero_badge' => 'Patient Letters & Recovery Journals',
    'hero_title' => 'Patient <span class="text-cyan-accent">Success Stories</span>',
    'hero_desc'  => 'Read recovery stories, letters of appreciation, and medical updates shared directly by our patients and their families.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
]);
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <!-- Background image -->
    <img src="<?php echo htmlspecialchars($pageContent['hero_bg']); ?>" alt=""
         fetchpriority="high"
         class="absolute inset-0 w-full h-full object-cover object-[78%_center] md:object-right pointer-events-none select-none">

    <!-- Legibility overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/75 to-deep-indigo/35 md:to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Success Stories</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-notes-medical text-cyan-accent text-[10px]"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>
        </div>
    </div>
</section>

<!-- Success Stories List -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <?php
        // Written success stories are testimonials of type "story" (CMS → Testimonials)
        $storyPalette = [
            ['text-cyan-accent bg-cyan-50 border-cyan-100'],
            ['text-red-650 bg-red-50 border-red-100'],
        ];
        $stories = cms_testimonials('story') ?? [];
        foreach ($stories as $stIdx => $st):
            $pill = $storyPalette[$stIdx % count($storyPalette)][0];
            $byline = trim((string)$st['name']) . (trim((string)($st['city'] ?? '')) !== '' ? ', ' . $st['city'] : '');
        ?>
        <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-deep-indigo font-serif"><?php echo htmlspecialchars(trim((string)($st['title'] ?? '')) !== '' ? $st['title'] : $st['condition']); ?></h3>
                <?php if (trim((string)$st['condition']) !== ''): ?>
                <span class="text-xs font-semibold <?php echo $pill; ?> px-3 py-1 rounded-full border"><?php echo htmlspecialchars($st['condition']); ?></span>
                <?php endif; ?>
            </div>
            <p class="text-xs text-dark-grey/70 leading-relaxed italic">
                "<?php echo cms_render_html($st['message']); ?>"
            </p>
            <p class="text-[11px] font-bold text-deep-indigo text-right">— <?php echo htmlspecialchars($byline); ?></p>
        </div>
        <?php endforeach; ?>
        <?php if (empty($stories)): ?>
        <p class="text-center text-sm text-dark-grey/55">Patient stories will appear here once they are added in the CMS.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php
$vtEyebrow = 'Video Stories';
$vtHeading = 'Recovery Stories on <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-200 to-cyan-accent">Video</span>';
$vtIntro   = 'Hear these journeys first hand — patients describing their diagnosis, treatment and recovery in their own words.';
require __DIR__ . '/includes/video-testimonials.php';
?>

<!-- Call to Action -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-3xl font-bold text-deep-indigo font-serif">Share Your Recovery Story</h2>
        <p class="text-sm text-dark-grey/65 max-w-xl mx-auto leading-relaxed">
            Your recovery path can inspire others undergoing difficult diagnoses. Let us know how your health has improved.
        </p>
        <div class="pt-2">
            <a href="contact-us-top-neurologist-delhi-ncr" class="inline-flex items-center space-x-3 bg-deep-indigo hover:bg-electric-blue text-white text-sm font-bold px-8 py-3.5 rounded-2xl transition-colors">
                <span>Book a Consultation</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
