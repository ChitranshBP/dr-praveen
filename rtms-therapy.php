<?php
/**
 * rTMS Therapy Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/5"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <a href="services.php" class="hover:text-white transition-colors">Services</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">rTMS Therapy</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-wave-square text-[10px]"></i>
                <span>Non-Invasive Neuromodulation</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Advanced <span class="text-white">rTMS Therapy</span>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Repetitive Transcranial Magnetic Stimulation (rTMS) – a non-invasive, drug-free outpatient therapy utilizing magnetic fields to stimulate nerve cells for depression, chronic pain, and stroke recovery.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap gap-3">
                <a href="contact-us-top-neurologist-delhi-ncr.php" class="inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
                    <span>Book Appointment</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
                <a href="tel:<?php echo SITE_PHONE; ?>" class="inline-flex items-center space-x-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold px-6 py-2.5 rounded-full border border-white/30 hover:bg-white/30 transition-all duration-300 text-sm">
                    <i class="fas fa-phone text-xs"></i>
                    <span>Call Now</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- What is rTMS Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Understanding</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">What is Transcranial Magnetic Stimulation?</h2>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    rTMS is a state-of-the-art neurological neuromodulation therapy. Unlike systemic medications, which affect the entire body, rTMS targets specific areas of the brain to stimulate neurons and restore healthy communication pathways.
                </p>
                <p class="text-dark-grey/70 leading-relaxed mb-8">
                    An electromagnetic coil is placed gently against the patient's scalp. It delivers brief, highly focused magnetic pulses that stimulate nerve cells safely. The procedure is entirely painless, and patients remain awake and active throughout.
                </p>

                <!-- Key Facts -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Non-Invasive</div>
                            <div class="text-xs text-dark-grey/60">No surgery or needles</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">No Anesthesia</div>
                            <div class="text-xs text-dark-grey/60">No sedation or downtime</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">FDA Cleared</div>
                            <div class="text-xs text-dark-grey/60">Proven safety profile</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Outpatient Care</div>
                            <div class="text-xs text-dark-grey/60">Return home immediately</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Side -->
            <div class="relative flex justify-center lg:justify-end animate-slide-in-right">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey border border-silver-grey/20">
                    <img src="assets/services/rtms.png" alt="rTMS Therapy Device" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Indications / Treatable Conditions -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Applications</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Key Indications Treated</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                rTMS is clinical neuromodulation that targets a variety of chronic, drug-resistant neurological conditions.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Indication 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-electric-blue/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-electric-blue group-hover:text-white transition-all duration-300">
                    <i class="fas fa-brain text-electric-blue text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Refractory Depression (TRD)</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Stimulates the left dorsolateral prefrontal cortex (DLPFC), modulating neural activity to alleviate treatment-resistant mood disorders.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Drug-Free</span>
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Mood Support</span>
                </div>
            </div>

            <!-- Indication 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-cyan-accent/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-cyan-accent transition-all duration-300">
                    <i class="fas fa-hand-holding-hand text-cyan-accent text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Stroke Paralysis Recovery</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Encourages neuroplasticity in damaged motor pathways to help patients recover arm/leg movement and coordination post-stroke.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Motor Skill</span>
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Neuroplasticity</span>
                </div>
            </div>

            <!-- Indication 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-deep-indigo/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-deep-indigo transition-all duration-300">
                    <i class="fas fa-shield text-deep-indigo text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Chronic Pain & Migraine</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Desensitizes pain pathways in the brain to reduce the frequency and intensity of chronic pain conditions and migraine attacks.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Pain Control</span>
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Migraine Relief</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Diagnosis & Experience Steps -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Experience</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">What to Expect During rTMS Treatment</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Our protocol ensures patient comfort, clinical mapping accuracy, and tailored treatment parameters.
            </p>
        </div>

        <!-- Diagnosis Steps -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Step 1 -->
            <div class="relative">
                <div class="bg-slate-50 rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">1</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Motor Thresholding</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Mapping the patient's motor cortex to identify the exact threshold of stimulation and determine customized dosage guidelines.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Coil Positioning</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        The treatment coil is positioned over the target brain region while the patient rests in a comfortable recliner chair.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Magnetic Pulses</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Magnetic pulses are delivered in patterns, producing a clicking sound. A tapping feeling on the scalp is felt.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Immediate Discharge</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Sessions last 20-30 minutes. Once complete, you can drive, work, and resume all activities immediately.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Doctor Section -->
<section id="about-doctor" class="py-16 bg-white border-t border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Image Side -->
            <div class="lg:col-span-5 relative observe">
                <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-xl bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/dpg-1.webp" alt="Dr. Praveen Gupta" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Content Side -->
            <div class="lg:col-span-7 observe">
                <span class="text-xs font-bold tracking-wider text-dark-grey/60 uppercase block mb-3 font-sans">
                    About Dr. Praveen Gupta
                </span>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo leading-tight mb-4">
                    Dr. Praveen Gupta – Best Neurologist in India
                </h2>

                <!-- Prestigious Appointments -->
                <div class="flex flex-col space-y-2.5 mb-6">
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-award text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chairman – Marengo Asia International Institute of Neuro and Spine</span>
                    </div>
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-chart-line text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chief Clinical Strategy Growth and Innovation, North India</span>
                    </div>
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-lightbulb text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chief Mentor for Start-ups</span>
                    </div>
                </div>

                <p class="text-sm text-dark-grey/85 mb-4 leading-relaxed">
                    With over 20 years of clinical experience, Dr. Praveen Gupta has emerged as a pioneering force in the diagnosis, treatment, and advancement of neurological sciences across India and beyond. He is responsible for several firsts in the country’s neurology landscape, including establishing Gurugram's first stroke centre and conducting pioneering BMT procedures for autoimmune neuro-disorders.
                </p>

                <div>
                    <a href="about.php" class="inline-flex items-center space-x-4 border-2 border-dark-grey px-6 py-2.5 rounded-full hover:bg-dark-grey hover:text-white transition-all duration-300 group">
                        <span class="text-xs font-bold text-dark-grey group-hover:text-white transition-colors duration-300">More About Doctor</span>
                        <div class="w-8 h-8 rounded-full bg-dark-grey text-white flex items-center justify-center text-xs group-hover:bg-white group-hover:text-dark-grey transition-colors duration-300 flex-shrink-0">
                            <i class="fas fa-arrow-right -rotate-45 transition-transform duration-300"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<!-- Related Videos (topic-matched, see $pageVideos in includes/config.php) -->
<?php require __DIR__ . "/includes/related-videos.php"; ?>

<!-- FAQs Section -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans">Patient FAQ</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Frequently Asked Questions</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Common questions regarding Transcranial Magnetic Stimulation (rTMS) therapies.
            </p>
        </div>

        <div class="max-w-4xl mx-auto space-y-4">
            <!-- FAQ 1 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is rTMS therapy?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        Repetitive Transcranial Magnetic Stimulation (rTMS) is a non-invasive, drug-free therapy that utilizes targeted magnetic pulses to stimulate nerve cells in specific regions of the brain. It is primarily used for treatment-resistant depression, neuropathic pain, and post-stroke motor deficits.
                    </p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Is rTMS therapy safe?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        Yes, rTMS is FDA cleared and has a strong safety profile. Because it is completely non-invasive, it does not require anesthesia, sedation, or surgical incisions, and avoids the systemic side effects often associated with oral medications.
                    </p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Are there any side effects of rTMS?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        Side effects are generally mild and temporary, most commonly including a slight tapping sensation on the scalp during treatment, minor scalp discomfort, or a mild headache immediately following a session. These symptoms usually resolve quickly.
                    </p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How many rTMS sessions will I need?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        A standard course typically consists of daily outpatient sessions (Monday through Friday) lasting 20-30 minutes, conducted over a period of 4 to 6 weeks, depending on your clinical response and treatment plan.
                    </p>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Will I need to stop my current medications during rTMS?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        Generally, no. rTMS can be safely administered alongside your current medications. Dr. Praveen Gupta will review your complete medical history and current prescriptions during your initial consultation to ensure safety.
                    </p>
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
