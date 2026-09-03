<?php
/**
 * Brain Health Hub Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('brain-health-center', [
    'hero_badge' => 'Preventive Neurology & Wellness',
    'hero_title' => 'Brain Health <span class="text-cyan-accent">Hub</span>',
    'hero_desc'  => 'Nurture your mind. Discover scientifically backed wellness guidelines, preventative advice, and cognitive screening options to keep your brain healthy.',
    'hero_bg'    => 'assets/breadcrumbs/dr-parveen-services-breadcrumb/brain%20health.png',
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
                <span class="text-white font-medium">Brain Health Hub</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-heart text-cyan-accent text-[10px]"></i>
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

<!-- Preventive Brain Health Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Preventive Neurology</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Brain Health Starts Before Symptoms</h2>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Most neurological decline is decades in the making. The habits and vascular risks that lead to stroke and dementia are measurable — and modifiable — long before anything goes wrong.
                </p>
                <p class="text-dark-grey/70 leading-relaxed mb-8">
                    Dr. Praveen Gupta recommends regular neurological wellness checks for adults over 50, and earlier for anyone with a family history of stroke, dementia or vascular disease.
                </p>

                <!-- Key Facts -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Vascular Risk Profile</div>
                            <div class="text-xs text-dark-grey/60">BP, cholesterol, carotid health</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Cognitive Baseline</div>
                            <div class="text-xs text-dark-grey/60">Benchmarks for future comparison</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">From Age 50</div>
                            <div class="text-xs text-dark-grey/60">Earlier with family history</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Modifiable Risk</div>
                            <div class="text-xs text-dark-grey/60">Most factors respond to change</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Side -->
            <div class="relative flex justify-center lg:justify-end animate-slide-in-right">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey border border-silver-grey/20">
                    <img src="assets/services/memory-clinic.png" alt="Preventive brain health screening" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pillars of Brain Health -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Wellness Pillars</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Pillars of Brain Health</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Four scientifically proven habits that support neural connectivity and delay cognitive ageing.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-electric-blue/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-electric-blue transition-all duration-300">
                    <i class="fas fa-apple-whole text-electric-blue text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Nutrition</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    A diet rich in antioxidants, omega-3 fatty acids and green vegetables protects brain cells and supports micro-vascular circulation.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Omega-3</span>
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Antioxidants</span>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-cyan-accent/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-cyan-accent transition-all duration-300">
                    <i class="fas fa-person-running text-cyan-accent text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Physical Activity</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Regular aerobic exercise increases blood flow to the brain, encourages neuroplasticity and releases BDNF, which supports memory cells.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Aerobic</span>
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Neuroplasticity</span>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-deep-indigo/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-deep-indigo transition-all duration-300">
                    <i class="fas fa-moon text-deep-indigo text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Restful Sleep</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Deep sleep activates the brain's glymphatic system, clearing metabolic waste and proteins such as amyloid-beta that drive cognitive decline.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Glymphatic</span>
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Waste Clearance</span>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-electric-blue/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-electric-blue transition-all duration-300">
                    <i class="fas fa-puzzle-piece text-electric-blue text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Mental Exercise</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Learning new skills, reading, solving puzzles and staying socially active builds cognitive reserve that resists age-related memory loss.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Cognitive Reserve</span>
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Social Activity</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Screening Journey -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Experience</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">What an Executive Screening Covers</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Prevention is the best cure. A full brain health screening takes a single appointment and sets a benchmark you can measure against for years.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Step 1 -->
            <div class="relative">
                <div class="bg-slate-50 rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">1</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Risk History Review</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Family history, lifestyle, medication and prior events are reviewed to establish which risks apply to you specifically.
                    </p>
                </div>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-electric-blue/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>
            <!-- Step 2 -->
            <div class="relative">
                <div class="bg-slate-50 rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">2</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Vascular Screening</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Blood pressure, cholesterol and carotid arterial health are checked — the three factors that most directly govern stroke risk.
                    </p>
                </div>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-electric-blue/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>
            <!-- Step 3 -->
            <div class="relative">
                <div class="bg-slate-50 rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">3</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Cognitive Audit</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        A baseline cognitive screening detects early memory change and establishes benchmarks for future comparison.
                    </p>
                </div>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-electric-blue/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>
            <!-- Step 4 -->
            <div class="relative">
                <div class="bg-slate-50 rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">4</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Personalised Plan</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        A written plan covering nutrition, activity, sleep and follow-up intervals, tailored to the risks the screening actually found.
                    </p>
                </div>
            </div>
        </div>
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

<!-- FAQ Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Column: Header Information -->
            <div class="lg:col-span-5 lg:sticky lg:top-24 self-start">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark-grey mt-3 mb-6">Frequently Asked Questions</h2>
                <p class="text-dark-grey/70 leading-relaxed max-w-md">
                    Answers to common questions regarding cognitive wellness, preventive screenings, and brain lifestyle habits.
                </p>
            </div>

            <!-- Right Column: Accordions -->
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is a cognitive wellness audit?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                A cognitive wellness audit is a proactive assessment designed to baseline your memory, attention, and executive functions. It helps identify early, subtle changes in cognitive health and establishes a blueprint for preventative care.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">At what age should I start focusing on preventive brain health screenings?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                While brain health habits should be practiced at all ages, formal preventive screenings are highly recommended starting at age 50, or earlier if you have a family history of strokes, Alzheimer's, or vascular diseases.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can lifestyle changes really reverse or prevent cognitive decline?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Clinical studies show that regular exercise, a Mediterranean-style diet, cognitive training, and managing cardiovascular risk factors (blood pressure, diabetes) can slow down cognitive aging and significantly reduce the risk of developing dementia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Toggle Script -->
<script>
function toggleFaq(button) {
    const item = button.closest('.faq-item');
    const content = button.nextElementSibling;
    const icon = button.querySelector('i');
    const isOpen = !content.classList.contains('hidden');

    // Close all other FAQs
    document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
    document.querySelectorAll('.faq-item').forEach(i => {
        i.classList.remove('bg-[#edf5f9]');
        i.classList.add('bg-white');
    });
    document.querySelectorAll('.faq-toggle i').forEach(i => {
        i.classList.remove('fa-minus');
        i.classList.add('fa-plus');
        i.style.transform = 'rotate(0deg)';
    });

    // Toggle current
    if (!isOpen) {
        content.classList.remove('hidden');
        item.classList.remove('bg-white');
        item.classList.add('bg-[#edf5f9]');
        icon.classList.remove('fa-plus');
        icon.classList.add('fa-minus');
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
