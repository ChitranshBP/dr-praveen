<?php
/**
 * Rehabilitation Hub Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <a href="services.php" class="hover:text-white transition-colors">Services</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Rehabilitation Hub</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-child text-cyan-accent text-[10px]"></i>
                <span>Comprehensive Neuro-Rehabilitation</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Neurological <span class="text-cyan-accent">Rehabilitation Hub</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Restoring function, independence, and confidence. Tailored physical, occupational, and speech rehabilitation programs for stroke, trauma, and progressive movement disorders.
            </p>

            <div class="flex flex-wrap items-center gap-3">
                <a href="contact-us-top-neurologist-delhi-ncr.php" class="group inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
                    <span>Schedule Evaluation</span>
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

<!-- What is Rehabilitation Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Recovery Focus</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Rebuilding Independent Living</h2>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Following a stroke, brain trauma, or spinal cord injury, the nervous system requires specialized retraining. Our approach focuses on neuroplasticity – the brain's innate ability to reorganize and form new neural connections in response to therapeutic exercise.
                </p>
                <p class="text-dark-grey/70 leading-relaxed mb-8">
                    Dr. Praveen Gupta coordinates the clinical team to ensure physical therapists, speech-language pathologists, and occupational therapists deliver unified therapy protocols tailored to your recovery targets.
                </p>

                <!-- Key Facts -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Physical Therapy</div>
                            <div class="text-xs text-dark-grey/60">Gait and coordination</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Occupational Care</div>
                            <div class="text-xs text-dark-grey/60">Daily living adjustments</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Speech Therapy</div>
                            <div class="text-xs text-dark-grey/60">Dysphagia and clarity</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Tech Monitored</div>
                            <div class="text-xs text-dark-grey/60">Real-time biofeedback</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Side -->
            <div class="relative flex justify-center lg:justify-end animate-slide-in-right">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey border border-silver-grey/20">
                    <img src="assets/services/rehab.png" alt="Patient undergoing physical rehabilitation" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Rehabilitation Programs -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Our Services</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Core Rehabilitation Therapies</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                We combine experienced clinical expertise with state-of-the-art diagnostic and recovery tracking tools to ensure precise treatments.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Program 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-electric-blue/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-electric-blue group-hover:text-white transition-all duration-300">
                    <i class="fas fa-walking text-electric-blue text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Neuro-Physiotherapy</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Focuses on rebuilding muscle strength, improving balance, training gait cycles, and recovering motor control following a stroke, spine injury, or onset of neuropathy.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Gait Training</span>
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Strength</span>
                </div>
            </div>

            <!-- Program 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-cyan-accent/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-cyan-accent transition-all duration-300">
                    <i class="fas fa-hands-holding text-cyan-accent text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Occupational Therapy</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Aids patients in relearning daily living activities (bathing, dressing, writing). We provide cognitive adaptation, motor skills coordination, and assistive technology advice.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Life Skills</span>
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Fine Motor</span>
                </div>
            </div>

            <!-- Program 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-deep-indigo/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-deep-indigo transition-all duration-300">
                    <i class="fas fa-volume-up text-deep-indigo text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Speech & Swallowing</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Addresses dysphagia (swallowing difficulties) and speech clarity challenges (aphasia/dysarthria) caused by neurological damage, helping patients communicate safely.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Dysphagia</span>
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Speech Clarity</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rehabilitation Steps -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Pathway</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Your Recovery Journey</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Our structured recovery protocol ensures patient progress is monitored continuously from admission to outpatient support.
            </p>
        </div>

        <!-- Progress Steps -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Step 1 -->
            <div class="relative">
                <div class="bg-slate-50 rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">1</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Baseline Assessment</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Comprehensive clinical evaluation of motor control, cognitive functions, and sensory status to set realistic recovery targets.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Custom Treatment</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        A personalized rehabilitation schedule combining physical therapy, speech pathology, and occupational exercises.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Active Monitoring</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        We utilize advanced biofeedback tools (like Phezee) to monitor joint mobility and electromyography muscle recovery trends in real-time.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Home Care Care</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Preparing patients for discharge with customized home care guides, training caregivers, and setting up periodic checkups.
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
                Common questions regarding Neurological Rehabilitation.
            </p>
        </div>

        <div class="max-w-4xl mx-auto space-y-4">
            <!-- FAQ 1 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What does neuro-rehabilitation involve?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        Neuro-rehabilitation is a multidisciplinary program designed to support patients recovering from injury, disease, or disorders of the nervous system. It combines neurological physical therapy, occupational therapy, and speech therapy to recover lost functions and rebuild motor skills.
                    </p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How soon should rehabilitation start after a stroke?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        Rehabilitation should begin as soon as the patient is medically stable—often within 24 to 48 hours of the event. Early mobilization stimulates neuroplasticity and prevents secondary complications like muscle stiffness and joint contractures.
                    </p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can rehabilitation help with progressive disorders like Parkinson's?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        Yes. While progressive disorders cannot be fully cured, ongoing physical, balance, and occupational therapies help patients manage motor symptoms, maintain optimal gait patterns, reduce the risk of falls, and sustain independence for much longer.
                    </p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How long does a neuro-rehab program last?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        The duration is highly individualized, depending on the severity of the neurological deficit and the patient's recovery trajectory. A program might last from a few weeks to several months, with progress evaluations conducted periodically.
                    </p>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is the role of Phezee in physical therapy?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        Phezee is an advanced wearable biofeedback tool used to measure joint Range of Motion (ROM) and muscle electrical activity (EMG). It allows therapists to monitor recovery progress in real-time, customize exercise protocols, and provide patients with visual feedback on their improvement.
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
