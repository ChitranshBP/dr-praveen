<?php
/**
 * Neurology Consultation Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Neurology Consultation</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-hand-holding-medical text-cyan-accent text-[10px]"></i>
                <span>Clinical Consulting Services</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Your Neurology <span class="text-cyan-accent">Consultation</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Learn what to expect during your first neurological consultation with Dr. Praveen Gupta, and how to prepare to get the most out of your clinical evaluation.
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="contact-us-top-neurologist-delhi-ncr.php" class="group inline-flex items-center space-x-3 bg-white text-deep-indigo text-sm font-bold pl-6 pr-2 py-2.5 rounded-full hover:bg-soft-cyan transition-colors duration-300">
                    <span>Schedule Consultation</span>
                    <span class="w-7 h-7 rounded-full bg-deep-indigo text-white flex items-center justify-center transition-transform group-hover:rotate-45 duration-300">
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- What to Expect Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left: Info Cards -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">The Clinical Experience</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">What to Expect During Your Appointment</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    A thorough neurological evaluation is essential for diagnosing conditions affecting the brain, spinal cord, nerves, and muscles. During your session, Dr. Praveen Gupta will guide you through a comprehensive checkup:
                </p>

                <div class="space-y-4">
                    <div class="p-6 bg-slate-50 border border-slate-200/50 rounded-3xl space-y-2">
                        <h3 class="font-bold text-deep-indigo text-base flex items-center space-x-2">
                            <span class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue text-xs"><i class="fas fa-comments"></i></span>
                            <span>Detailed Medical History</span>
                        </h3>
                        <p class="text-xs text-dark-grey/65 leading-relaxed">
                            We will discuss your symptoms in detail—when they started, their pattern, triggers, severity, and any past treatments or family history.
                        </p>
                    </div>

                    <div class="p-6 bg-slate-50 border border-slate-200/50 rounded-3xl space-y-2">
                        <h3 class="font-bold text-deep-indigo text-base flex items-center space-x-2">
                            <span class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue text-xs"><i class="fas fa-running"></i></span>
                            <span>Neurological Examination</span>
                        </h3>
                        <p class="text-xs text-dark-grey/65 leading-relaxed">
                            A hands-on physical exam checking your reflexes, muscle strength, sensory perceptions, coordination, gait, balance, and cranial nerve functions (vision, hearing, facial movement).
                        </p>
                    </div>

                    <div class="p-6 bg-slate-50 border border-slate-200/50 rounded-3xl space-y-2">
                        <h3 class="font-bold text-deep-indigo text-base flex items-center space-x-2">
                            <span class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue text-xs"><i class="fas fa-notes-medical"></i></span>
                            <span>Diagnostic & Treatment Plan</span>
                        </h3>
                        <p class="text-xs text-dark-grey/65 leading-relaxed">
                            If required, diagnostic tests (e.g., MRI, CT, EEG, EMG) will be recommended. We will formulate a tailored care and medical management plan immediately.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right: Preparation Sidebar -->
            <div class="lg:col-span-5 bg-gradient-to-br from-soft-cyan to-white p-8 rounded-3xl border border-cyan-accent/20 space-y-6">
                <h3 class="text-xl font-bold text-deep-indigo font-serif">How to Prepare</h3>
                <p class="text-xs text-dark-grey/60 leading-relaxed">
                    Make the most of your consultation by taking a few steps to prepare before you arrive at our clinic:
                </p>

                <ul class="space-y-4">
                    <li class="flex items-start space-x-3 text-xs text-dark-grey/70">
                        <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-file-medical text-[10px]"></i></span>
                        <div>
                            <strong class="text-deep-indigo">Medical Documents:</strong> Bring all past reports, imaging films/CDs (MRI, CT scans), and blood test results.
                        </div>
                    </li>
                    <li class="flex items-start space-x-3 text-xs text-dark-grey/70">
                        <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-pills text-[10px]"></i></span>
                        <div>
                            <strong class="text-deep-indigo">Medication List:</strong> Bring current prescriptions or the actual packaging of all medicines you are currently taking.
                        </div>
                    </li>
                    <li class="flex items-start space-x-3 text-xs text-dark-grey/70">
                        <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-pen text-[10px]"></i></span>
                        <div>
                            <strong class="text-deep-indigo">Symptom Log:</strong> Jot down when your symptoms occur, how long they last, and what triggers or relieves them.
                        </div>
                    </li>
                    <li class="flex items-start space-x-3 text-xs text-dark-grey/70">
                        <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-user-friends text-[10px]"></i></span>
                        <div>
                            <strong class="text-deep-indigo">Bring a Companion:</strong> Family members can help recall details and listen to recommendations.
                        </div>
                    </li>
                </ul>

                <form class="pt-4 border-t border-cyan-accent/20 space-y-3" onsubmit="event.preventDefault(); alert('Request submitted successfully! Our coordinator will contact you shortly.');">
                    <span class="block text-xs font-bold text-deep-indigo uppercase tracking-wider">Quick Request</span>
                    <div>
                        <label for="consult-name" class="sr-only">Full Name</label>
                        <input type="text" id="consult-name" required placeholder="Your Name" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-xs text-dark-grey placeholder-dark-grey/50">
                    </div>
                    <div>
                        <label for="consult-phone" class="sr-only">Phone Number</label>
                        <input type="tel" id="consult-phone" required placeholder="Phone Number" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-xs text-dark-grey placeholder-dark-grey/50">
                    </div>
                    <div>
                        <button type="submit" class="block w-full text-center bg-deep-indigo hover:bg-electric-blue text-white font-bold py-2.5 rounded-xl transition-colors text-xs shadow-md">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Consultation Channels -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Appointment Modes</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Consultation Options</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Choose the consulting channel that best matches your location, health status, and convenience.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Channel 1 -->
            <div class="bg-white p-8 rounded-3xl border border-silver-grey/30 space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-building text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">In-Person Clinic Visit</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Consult directly at Marengo Asia Hospital. Best for initial assessments, evaluations requiring physical examination reflexes, and diagnostic testing.
                </p>
                <div class="pt-2">
                    <span class="text-xs font-semibold text-electric-blue"><i class="far fa-clock mr-1"></i> Mon - Sat: By Appointment</span>
                </div>
            </div>

            <!-- Channel 2 -->
            <div class="bg-white p-8 rounded-3xl border border-silver-grey/30 space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent">
                    <i class="fas fa-video text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Online Tele-Consultation</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Connect via secure video consultation from the comfort of your home. Ideal for second opinions, routine follow-ups, and reviewing laboratory results.
                </p>
                <div class="pt-2">
                    <span class="text-xs font-semibold text-cyan-accent"><i class="fas fa-laptop-medical mr-1"></i> Global Video Access</span>
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
                    Answers to common queries about booking a consultation, what to bring, and diagnostic procedures.
                </p>
            </div>

            <!-- Right Column: Accordions -->
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Do I need a referral to book a neurology consultation?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                No, you do not need a formal referral to schedule an appointment with Dr. Praveen Gupta. However, if your insurance provider requires a referral for coverage, please obtain it before your visit.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How long does a typical first consultation take?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                A comprehensive initial consultation usually takes between 30 to 45 minutes. This allows sufficient time to take a detailed medical history, perform a physical examination, and discuss the diagnostic plan.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Should I stop taking my current medications before the appointment?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                No, please continue to take your medications as prescribed unless specifically instructed otherwise. Simply bring a list or the original boxes of all medications you are currently taking.
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

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
