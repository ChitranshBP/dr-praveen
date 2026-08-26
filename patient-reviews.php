<?php
/**
 * Patient Reviews Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('patient-reviews', [
    'hero_badge' => '4.9/5 Rating - 1000+ Verified Patient Reviews',
    'hero_title' => 'Patient <span class="text-cyan-accent">Reviews</span>',
    'hero_desc'  => 'Read direct reviews, feedback, and statements left by patients regarding their diagnostic experiences and treatment outcomes.',
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
                <span class="text-white font-medium">Reviews</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-star text-yellow-400 text-[10px]"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                <?php echo nl2br(htmlspecialchars($pageContent['hero_desc'])); ?>
            </p>
        </div>
    </div>
</section>

<!-- Stats Grid -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto grid grid-cols-3 gap-6 bg-slate-50 border border-slate-200/50 p-8 rounded-3xl text-center">
            <div>
                <span class="text-3xl md:text-4xl font-extrabold text-deep-indigo">4.9</span>
                <div class="flex justify-center text-yellow-400 text-xs my-1">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-[10px] text-dark-grey/60 uppercase">Average Rating</p>
            </div>
            <div class="border-l border-r border-slate-200">
                <span class="text-3xl md:text-4xl font-extrabold text-deep-indigo">1K+</span>
                <p class="text-[10px] text-dark-grey/60 uppercase mt-2">Verified Reviews</p>
            </div>
            <div>
                <span class="text-3xl md:text-4xl font-extrabold text-deep-indigo">100%</span>
                <p class="text-[10px] text-dark-grey/60 uppercase mt-2">Patient Care Guarantee</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Cards Grid -->
<section class="py-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (isset($testimonials) && !empty($testimonials)): ?>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($testimonials as $t): ?>
                    <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow relative">
                        <!-- Rating Stars -->
                        <div class="flex text-yellow-400 text-xs">
                            <?php for ($i = 0; $i < $t['rating']; $i++): ?>
                                <i class="fas fa-star mr-0.5"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="text-xs text-dark-grey/70 leading-relaxed italic">
                            "<?php echo $t['message']; ?>"
                        </p>
                        <div class="pt-2 border-t border-slate-200/40 flex justify-between items-center text-[10px]">
                            <strong class="text-deep-indigo text-xs"><?php echo $t['name']; ?></strong>
                            <span class="text-dark-grey/55 font-medium bg-white px-2 py-0.5 rounded-full border border-slate-200/30"><?php echo $t['role']; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-xs text-dark-grey/55">No patient reviews available in site configuration.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-3xl font-bold text-deep-indigo font-serif">Consult with Dr. Praveen Gupta</h2>
        <p class="text-sm text-dark-grey/65 max-w-xl mx-auto leading-relaxed">
            Experience the standard of clinical excellence and patient care praised by thousands of families.
        </p>
        <div class="pt-2">
            <a href="contact-us-top-neurologist-delhi-ncr" class="inline-flex items-center space-x-3 bg-deep-indigo hover:bg-electric-blue text-white text-sm font-bold px-8 py-3.5 rounded-2xl transition-colors">
                <span>Request Appointment</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
