<?php
/**
 * Brain Tumor Surgery Clinic Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('brain-tumor-surgery', [
    'hero_badge' => 'Precision Neurosurgery Center',
    'hero_title' => 'Brain Tumor <span class="text-cyan-accent">Surgery</span>',
    'hero_desc'  => 'Advanced surgical techniques using state-of-the-art brain mapping, computer-guided neuronavigation, and minimally invasive approaches for maximum tumor removal and safety.',
    'hero_bg'    => 'assets/breadcrumbs/dr-parveen-services-breadcrumb/Brain%20Tumor%20Surgery.png',
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
                <a href="services" class="hover:text-white transition-colors">Services</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Brain Tumor Surgery</span>
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
                <?php echo nl2br(htmlspecialchars($pageContent['hero_desc'])); ?>
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="contact-us-top-neurologist-delhi-ncr" class="group inline-flex items-center space-x-3 bg-white text-deep-indigo text-sm font-bold pl-6 pr-2 py-2.5 rounded-full hover:bg-soft-cyan transition-colors duration-300">
                    <span>Schedule Consultation</span>
                    <span class="w-7 h-7 rounded-full bg-deep-indigo text-white flex items-center justify-center transition-transform group-hover:rotate-45 duration-300">
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- What is Brain Tumor Surgery Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Neurosurgical Excellence</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Comprehensive Brain Tumor Care</h2>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Brain tumor treatment requires extreme precision and a multidisciplinary approach. Our clinic specializes in both benign and malignant brain tumors, using advanced imaging to map critical speech and motor pathways before a single incision is made.
                </p>
                <p class="text-dark-grey/70 leading-relaxed mb-8">
                    The goal in every case is the same: remove as much of the tumor as safely possible while preserving the brain function that defines who you are. Surgery is planned jointly with neuro-oncology and radiation specialists so the whole pathway is agreed before treatment begins.
                </p>

                <!-- Key Facts -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">3D Surgical Microscopes</div>
                            <div class="text-xs text-dark-grey/60">High-magnification stereoscopic views</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Awake Brain Mapping</div>
                            <div class="text-xs text-dark-grey/60">Protects language and motor centres</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Neuromonitoring</div>
                            <div class="text-xs text-dark-grey/60">Neural signals tracked during resection</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Multidisciplinary</div>
                            <div class="text-xs text-dark-grey/60">Planned with neuro-oncology</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Side -->
            <div class="relative flex justify-center lg:justify-end animate-slide-in-right">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey border border-silver-grey/20">
                    <img src="assets/services/brain-tumor.png" alt="Brain Tumor Surgery" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Surgical Techniques -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Techniques</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">How We Operate</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Three techniques underpin every tumor resection we perform â€” chosen and combined according to where the tumor sits and what it touches.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Technique 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-electric-blue/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-electric-blue transition-all duration-300">
                    <i class="fas fa-shield-alt text-electric-blue text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Minimally Invasive Removal</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Micro-neurosurgery and keyhole techniques reach deep-seated tumors through smaller incisions, minimising tissue trauma and shortening recovery.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Keyhole Access</span>
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Faster Recovery</span>
                </div>
            </div>

            <!-- Technique 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-cyan-accent/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-cyan-accent transition-all duration-300">
                    <i class="fas fa-crosshairs text-cyan-accent text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Intraoperative Neuronavigation</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    A high-resolution computer guidance system â€” effectively GPS for the brain â€” tracks tumor boundaries with sub-millimetre precision throughout the operation.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Sub-mm Precision</span>
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Live Guidance</span>
                </div>
            </div>

            <!-- Technique 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-deep-indigo/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-deep-indigo transition-all duration-300">
                    <i class="fas fa-comments text-deep-indigo text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Awake Brain Mapping</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    For tumors near speech or movement centres, the patient stays awake and responsive so those functions can be tested live and protected during resection.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Speech Safety</span>
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Motor Safety</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Treatment Journey Steps -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Experience</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">What to Expect, Start to Finish</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Surgery is one stage in a longer pathway. Here is how care runs from the first scan through to rehabilitation.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Step 1 -->
            <div class="relative">
                <div class="bg-slate-50 rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">1</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Diagnosis &amp; Imaging</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        High-resolution MRI and functional imaging establish the tumor type, its exact boundaries, and which pathways sit closest to it.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Surgical Planning</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        The approach, technique and expected outcome are agreed jointly with neuro-oncology and radiation specialists, then explained to you and your family.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Micro-Neurosurgery</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Resection under 3D microscopy with live neuronavigation and continuous neuromonitoring, so neural integrity is checked at every stage.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Recovery &amp; Rehab</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Focused physical, occupational and cognitive therapy to regain strength and coordination, with follow-up medical management throughout.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Doctor Section -->
<section class="py-16 bg-white border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Expert Leadership</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Meet the Specialist</h2>
        </div>

        <div class="max-w-4xl mx-auto bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
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
<section class="py-12 bg-slate-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Column: Header Information -->
            <div class="lg:col-span-5 lg:sticky lg:top-24 self-start">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark-grey mt-3 mb-6">Frequently Asked Questions</h2>
                <p class="text-dark-grey/70 leading-relaxed max-w-md">
                    Answers to common questions regarding brain tumor mapping, biopsy protocols, and surgical recovery.
                </p>
            </div>

            <!-- Right Column: Accordions -->
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Are all brain tumors cancerous (malignant)?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                No. Many brain tumors are benign (non-cancerous), meaning they grow slowly and do not spread. However, even benign tumors can cause symptoms by pressing on surrounding brain tissue and may require surgical removal.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is a minimally invasive brain tumor surgery?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Minimally invasive surgery uses advanced keyhole techniques, specialized endoscopes, and intraoperative microscopes to access the tumor through very small incisions, reducing recovery time and damage to healthy brain structures.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is Awake Craniotomy?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Awake craniotomy is a specialized surgical procedure where the patient is awake for part of the surgery. This allows neurosurgeons to map and test language, motor, or sensory functions in real-time, ensuring these areas are not damaged when removing the tumor.
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
