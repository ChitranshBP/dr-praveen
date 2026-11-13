<?php
/**
 * Testimonials Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('neurology-patient-testimonials', [
    'hero_badge' => 'Patient Stories & Reviews',
    'hero_title' => 'Patient <span class="text-white font-normal">Success Stories</span>',
    'hero_desc'  => 'Read inspiring recovery stories from patients treated by Dr. Praveen Gupta for various complex neurological conditions.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
]);
?>

<!-- Page Hero -->
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
                <span class="text-white font-medium">Testimonials</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-star text-amber-400 text-[10px]"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>
        </div>
    </div>
</section>

<!-- Stats Grid -->
<section class="py-6 bg-slate-50 border-b border-slate-200/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-4">
                <span class="block text-3xl md:text-4xl font-extrabold text-electric-blue"><?php echo htmlspecialchars($cmsSettings['stats_experience'] ?? '20+'); ?></span>
                <span class="text-xs md:text-sm text-dark-grey/60 font-medium mt-1 block">Years of Excellence</span>
            </div>
            <div class="p-4">
                <span class="block text-3xl md:text-4xl font-extrabold text-cyan-accent"><?php echo htmlspecialchars($cmsSettings['stats_patients'] ?? '3,00,000+'); ?></span>
                <span class="text-xs md:text-sm text-dark-grey/60 font-medium mt-1 block">Patients Treated</span>
            </div>
            <div class="p-4">
                <span class="block text-3xl md:text-4xl font-extrabold text-deep-indigo"><?php echo htmlspecialchars($cmsSettings['stats_rating'] ?? '4.9'); ?>/5</span>
                <span class="text-xs md:text-sm text-dark-grey/60 font-medium mt-1 block">Google Rating</span>
            </div>
            <div class="p-4">
                <span class="block text-3xl md:text-4xl font-extrabold text-[#00a86b]">98%</span>
                <span class="text-xs md:text-sm text-dark-grey/60 font-medium mt-1 block">Stroke Recovery Rate</span>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Grid -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            // Reviews are managed in CMS → Testimonials
            $reviewPalette = ['electric-blue', 'cyan-accent', 'deep-indigo'];
            $reviews = cms_testimonials() ?? [];
            foreach ($reviews as $rvIdx => $rv):
                $accent = $reviewPalette[$rvIdx % count($reviewPalette)];
                $initial = function_exists('mb_substr') ? mb_substr(trim((string)$rv['name']), 0, 1) : substr(trim((string)$rv['name']), 0, 1);
            ?>
            <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-6 md:p-8 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center space-x-1 text-amber-400">
                        <?php for ($s = 0; $s < (int)$rv['rating']; $s++): ?><i class="fas fa-star"></i><?php endfor; ?>
                    </div>
                    <p class="text-sm text-dark-grey/75 italic leading-relaxed">
                        "<?php echo cms_render_html($rv['message']); ?>"
                    </p>
                </div>
                <div class="flex items-center space-x-3 pt-6 border-t border-slate-200/60 mt-6">
                    <div class="w-10 h-10 bg-<?php echo $accent; ?>/10 rounded-full flex items-center justify-center text-<?php echo $accent; ?> font-bold text-sm">
                        <?php echo htmlspecialchars(strtoupper((string)$initial)); ?>
                    </div>
                    <div>
                        <h4 class="font-bold text-dark-grey text-sm"><?php echo htmlspecialchars($rv['name']); ?></h4>
                        <span class="text-xs text-<?php echo $accent; ?> font-semibold"><?php echo htmlspecialchars($rv['role'] . ($rv['condition'] !== '' && stripos($rv['role'], $rv['condition']) === false ? ' · ' . $rv['condition'] : '')); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($reviews)): ?>
            <p class="col-span-full text-center text-sm text-dark-grey/55">Patient reviews will appear here once they are added in the CMS.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-12 bg-[#edf5f9] border-t border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-2xl md:text-3xl font-bold text-dark-grey">Share Your Recovery Story</h2>
        <p class="text-dark-grey/65 text-sm md:text-base leading-relaxed max-w-2xl mx-auto">
            Your journey can inspire others going through similar neurological challenges. If you have been treated by Dr. Praveen Gupta, we would love to hear your feedback.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="contact-us-top-neurologist-delhi-ncr" class="bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold px-6 py-3.5 rounded-xl shadow-lg hover:shadow-electric-blue/20 transition-all duration-300">
                Submit Feedback
            </a>
            <a href="https://g.page/r/dr-praveen-gupta-neurologist/review" target="_blank" class="bg-white border border-slate-200 text-dark-grey font-semibold px-6 py-3.5 rounded-xl hover:bg-slate-50 transition-all duration-300 inline-flex items-center space-x-2">
                <i class="fab fa-google text-red-500"></i>
                <span>Review on Google</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
