<?php
/**
 * Brain Health Hub Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Brain Health Hub</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-heart text-cyan-accent text-[10px]"></i>
                <span>Preventive Neurology & Wellness</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Brain Health <span class="text-cyan-accent">Hub</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Nurture your mind. Discover scientifically backed wellness guidelines, preventative advice, and cognitive screening options to keep your brain healthy.
            </p>
        </div>
    </div>
</section>

<!-- Lifestyle Pillars Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans">Wellness Pillars</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Pillars of Brain Health</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Simple, scientifically proven habits that support neural connectivity and delay cognitive aging.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Pillar 1 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-apple-alt"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Nutrition</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A diet rich in antioxidants, omega-3 fatty acids, and green vegetables helps protect brain cells and supports micro-vascular blood circulation.
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent">
                    <i class="fas fa-running"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Physical Activity</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Regular aerobic exercise increases blood flow to the brain, encourages neuroplasticity, and releases BDNF, which supports memory cells.
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo">
                    <i class="fas fa-moon"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Restful Sleep</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Deep sleep activates the brain's glymphatic system, clearing metabolic waste and harmful proteins (like amyloid-beta) that can trigger cognitive decline.
                </p>
            </div>

            <!-- Pillar 4 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-puzzle-piece"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Mental Exercise</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Learning new skills, reading, solving puzzles, and staying socially active helps build a robust cognitive reserve that resists age-related memory loss.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Preventive Screenings -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Preventive Screening</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Executive Brain Health Screening</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Prevention is the best cure. Dr. Praveen Gupta recommends regular neurological wellness checks for adults over 50, or those with family histories of stroke, dementia, or vascular issues.
                </p>
                <div class="space-y-4 text-xs text-dark-grey/70">
                    <div class="flex items-start space-x-3.5">
                        <div class="w-5 h-5 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></div>
                        <p><strong class="text-deep-indigo">Vascular Risk Profiles:</strong> Check blood pressure, cholesterol, and carotid arterial health to manage stroke risks.</p>
                    </div>
                    <div class="flex items-start space-x-3.5">
                        <div class="w-5 h-5 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></div>
                        <p><strong class="text-deep-indigo">Baseline Cognitive Audits:</strong> Simple screenings to detect early memory changes and establish treatment benchmarks.</p>
                    </div>
                </div>
            </div>

            <!-- Right -->
            <div class="lg:col-span-5 bg-gradient-to-br from-deep-indigo to-indigo-950 text-white p-8 rounded-3xl space-y-4">
                <h3 class="text-xl font-bold font-serif">Health Audit</h3>
                <p class="text-xs text-white/80 leading-relaxed">
                    Evaluate your stroke and memory health. Schedule a preventative neurology consultation session today.
                </p>
                <div class="pt-2">
                    <a href="contact-us-top-neurologist-delhi-ncr.php" class="block w-full text-center bg-cyan-accent hover:bg-cyan-500 text-deep-indigo font-bold py-3 rounded-2xl transition-colors text-xs">
                        Book Consultation
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-12 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Content Side -->
            <div class="lg:col-span-6 observe">
                <span class="text-xs font-bold tracking-wider text-dark-grey/60 uppercase block mb-3 font-sans">
                    Why Choose Dr. Praveen Gupta?
                </span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo leading-tight mb-6">
                    Providing Best Treatment
                </h2>
                <p class="text-base text-dark-grey/70 mb-10 leading-relaxed max-w-lg">
                    With an unwavering commitment to clinical excellence, Dr. Praveen Gupta combines advanced technology and patient-centric therapies to deliver world-class neurological care.
                </p>

                <!-- Grid of 4 Items -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-12">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-slate-50 border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-earth-americas text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Global Standards of Care</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Treatments backed by advanced technology and international guidelines.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-slate-50 border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-lightbulb text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Innovative Procedures</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Pioneer in stroke care, DBS, and complex surgeries in India.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-slate-50 border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-circle-check text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Proven Results</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Thousands of patients treated successfully with rapid recovery.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-slate-50 border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-hand-holding-heart text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Compassionate Consultation</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Empowering patients with knowledge, compassion, and personalized care.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <a href="contact-us-top-neurologist-delhi-ncr.php" class="inline-flex items-center px-8 py-3.5 bg-[#111827] text-white text-sm font-bold rounded-full hover:bg-electric-blue transition-colors duration-300 shadow-lg shadow-dark-grey/10">
                        Get Started
                    </a>
                </div>
            </div>

            <!-- Image Side -->
            <div class="lg:col-span-6 relative flex justify-center lg:justify-end observe">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[3:4] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/full-image/dpg-award.webp" alt="Compassionate Care" class="w-full h-full object-cover">
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
                        <a href="about.php" class="text-xs font-semibold text-electric-blue hover:underline">Full Biography <i class="fas fa-arrow-right text-[10px] ml-1"></i></a>
                        <span class="text-slate-300">|</span>
                        <a href="why-choose-dr-praveen-gupta.php" class="text-xs font-semibold text-electric-blue hover:underline">Why Choose Dr. Praveen <i class="fas fa-arrow-right text-[10px] ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
