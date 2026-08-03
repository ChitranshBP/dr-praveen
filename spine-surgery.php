<?php
/**
 * Spine Surgery Clinic Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/5"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <a href="services.php" class="hover:text-white transition-colors">Services</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Spine Surgery</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-bone text-cyan-accent text-[10px]"></i>
                <span>Comprehensive Spine Care Center</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Spine <span class="text-cyan-accent">Surgery</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Providing comprehensive care for complex spinal conditions, specializing in Minimally Invasive Spine Surgery (MISS) to accelerate patient recovery and preserve mobility.
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="contact-us-top-neurologist-delhi-ncr.php" class="group inline-flex items-center space-x-3 bg-white text-deep-indigo text-sm font-bold pl-6 pr-2 py-2.5 rounded-full hover:bg-soft-cyan transition-colors duration-300">
                    <span>Schedule Evaluation</span>
                    <span class="w-7 h-7 rounded-full bg-deep-indigo text-white flex items-center justify-center transition-transform group-hover:rotate-45 duration-300">
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Clinical Overview -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left: Info -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Spine Clinic</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Comprehensive Spinal Care</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Spinal health affects every facet of daily movement. Our clinic covers a wide range of spine pathology, prioritizing conservative management and advanced Minimally Invasive Spine Surgery (MISS). Our goal is to achieve maximal decompression and stability with minimal disruption to surrounding muscles.
                </p>

                <!-- Conditions We Treat -->
                <div class="p-6 bg-gradient-to-br from-soft-cyan to-white rounded-3xl border border-cyan-accent/20 space-y-4">
                    <h3 class="font-bold text-deep-indigo text-base font-serif">Conditions We Treat</h3>
                    <ul class="grid sm:grid-cols-2 gap-4 text-xs text-dark-grey/70">
                        <li class="flex items-start space-x-2.5">
                            <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></span>
                            <div><strong class="text-deep-indigo">Herniated & Slip Discs:</strong> Relieving compressed sciatic nerves in the lumbar or cervical spine.</div>
                        </li>
                        <li class="flex items-start space-x-2.5">
                            <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></span>
                            <div><strong class="text-deep-indigo">Spinal Canal Stenosis:</strong> Widening narrowed passages to restore walking capacity.</div>
                        </li>
                        <li class="flex items-start space-x-2.5 sm:col-span-2">
                            <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></span>
                            <div><strong class="text-deep-indigo">Spondylolisthesis:</strong> Stabilizing slipped vertebrae using micro-fixation and fusion strategies.</div>
                        </li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <div class="p-6 bg-slate-50 border border-slate-200/50 rounded-3xl space-y-2">
                        <h3 class="font-bold text-deep-indigo text-base flex items-center space-x-2">
                            <span class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue text-xs"><i class="fas fa-compress-arrows-alt"></i></span>
                            <span>Minimally Invasive Spine Surgery (MISS)</span>
                        </h3>
                        <p class="text-xs text-dark-grey/65 leading-relaxed">
                            Treating herniated discs, spinal stenosis, and bone spurs using tiny tubular dilators, leading to smaller incisions, less postoperative pain, and minimized hospital stays.
                        </p>
                    </div>

                    <div class="p-6 bg-slate-50 border border-slate-200/50 rounded-3xl space-y-2">
                        <h3 class="font-bold text-deep-indigo text-base flex items-center space-x-2">
                            <span class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue text-xs"><i class="fas fa-project-diagram"></i></span>
                            <span>Decompression & Fusion Protocols</span>
                        </h3>
                        <p class="text-xs text-dark-grey/65 leading-relaxed">
                            Expertly executing lumbar laminectomy, microdiscectomy, and keyhole spinal fusions with real-time neural mapping to relieve compressed nerves safely.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right: Image -->
            <div class="lg:col-span-5 relative flex justify-center lg:justify-end">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey border border-silver-grey/20">
                    <img src="assets/services/spine-surgery.png" alt="Spine Surgery" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-12 bg-slate-50/50 relative overflow-hidden">
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
                        <div class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-earth-americas text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Global Standards of Care</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Treatments backed by advanced technology and international guidelines.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-lightbulb text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Innovative Procedures</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Pioneer in stroke care, DBS, and complex surgeries in India.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-circle-check text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Proven Results</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Thousands of patients treated successfully with rapid recovery.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
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
<section class="py-12 bg-slate-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Column: Header Information -->
            <div class="lg:col-span-5 lg:sticky lg:top-24 self-start">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark-grey mt-3 mb-6">Frequently Asked Questions</h2>
                <p class="text-dark-grey/70 leading-relaxed max-w-md">
                    Answers to common questions regarding minimally invasive spine surgeries, disc recovery, and diagnostic protocols.
                </p>
            </div>

            <!-- Right Column: Accordions -->
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How do I know if I need spine surgery or conservative management?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Most spinal conditions are managed conservatively using physical therapy, medications, and lifestyle changes. Surgery is recommended if you have progressive nerve compression leading to weakness, loss of bladder control, or persistent pain that does not improve after 6-12 weeks of non-surgical treatment.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What are the benefits of Minimally Invasive Spine Surgery (MISS)?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                MISS uses small incisions and muscle-splitting techniques rather than cutting through large muscle groups. Benefits include reduced postoperative pain, minimized blood loss, shorter hospital stays, and a much faster return to daily activities.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How long is the recovery after lumbar disc surgery?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                For minimally invasive microdiscectomies, patients can often walk the same day and return to light work within 2-4 weeks. Heavy lifting and sports are typically restricted for 6-8 weeks until the disc fully heals.
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

<!-- Recovery & Rehabilitation -->
<section class="py-16 bg-white border-t border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left: Text -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Spine Rehabilitation</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Comprehensive Rehabilitation</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Successful spine recovery relies heavily on structured physical rehabilitation. In cooperation with our rehabilitation center, we offer targeted programs to restore core strength, posture, and flexible movement patterns.
                </p>
                <div class="grid sm:grid-cols-2 gap-6 text-xs text-dark-grey/70">
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-cyan-accent mt-0.5 flex-shrink-0"></i>
                        <p><strong class="text-deep-indigo">Core Mobilization:</strong> Safely rebuild lumbar core stabilizers to protect the spine.</p>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-cyan-accent mt-0.5 flex-shrink-0"></i>
                        <p><strong class="text-deep-indigo">Posture Training:</strong> Ergonometric and alignment mapping to prevent recurring micro-stress on joints.</p>
                    </div>
                </div>
            </div>

            <!-- Right: Booking -->
            <div class="lg:col-span-5 bg-gradient-to-br from-deep-indigo to-indigo-950 text-white p-8 rounded-3xl space-y-4">
                <h3 class="text-xl font-bold font-serif">Consultation Booking</h3>
                <p class="text-xs text-white/80 leading-relaxed">
                    Schedule a diagnostic workup or surgical opinion with our clinical experts.
                </p>
                <div class="pt-2">
                    <a href="contact-us-top-neurologist-delhi-ncr.php" class="block w-full text-center bg-cyan-accent hover:bg-cyan-500 text-deep-indigo font-bold py-3 rounded-2xl transition-colors text-xs">
                        Book Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
