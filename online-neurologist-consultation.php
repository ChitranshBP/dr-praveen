<?php
/**
 * Online Teleconsultation Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <!-- Background image -->
    <img src="assets/breadcrumbs/patient.png" alt=""
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
                <span class="text-white font-medium">Online Consultation</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-video text-cyan-accent text-[10px]"></i>
                <span>Secure Digital Teleconsultation</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Online Neurology <span class="text-cyan-accent">Consultation</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Consult with one of India's leading neurologists from the comfort of your home. Secure, convenient, and comprehensive online video consultations.
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="contact-us-top-neurologist-delhi-ncr" class="group inline-flex items-center space-x-3 bg-white text-deep-indigo text-sm font-bold pl-6 pr-2 py-2.5 rounded-full hover:bg-soft-cyan transition-colors duration-300">
                    <span>Book Teleconsultation</span>
                    <span class="w-7 h-7 rounded-full bg-deep-indigo text-white flex items-center justify-center transition-transform group-hover:rotate-45 duration-300">
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- How it Works Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans">Process Flow</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">How Online Consultation Works</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                A simple 4-step process designed to give you world-class neurological assessment online.
            </p>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow relative">
                <span class="absolute top-4 right-6 text-4xl font-extrabold text-electric-blue/10">01</span>
                <div class="w-10 h-10 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base pt-2">Book Slot</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Select your preferred date and time on our booking portal and complete the registration.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow relative">
                <span class="absolute top-4 right-6 text-4xl font-extrabold text-electric-blue/10">02</span>
                <div class="w-10 h-10 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent">
                    <i class="fas fa-file-upload"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base pt-2">Upload Records</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Securely upload past prescriptions, blood test results, and imaging studies (MRI/CT reports).
                </p>
            </div>

            <!-- Step 3 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow relative">
                <span class="absolute top-4 right-6 text-4xl font-extrabold text-electric-blue/10">03</span>
                <div class="w-10 h-10 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo">
                    <i class="fas fa-video"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base pt-2">Video Consultation</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Connect with Dr. Praveen Gupta via a secure high-definition video link at your scheduled time.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow relative">
                <span class="absolute top-4 right-6 text-4xl font-extrabold text-electric-blue/10">04</span>
                <div class="w-10 h-10 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-file-prescription"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base pt-2">Get Prescription</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Receive your digital medical advice, diagnostic recommendations, and prescription copy.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Benefits / Suitability Section -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Suitability</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Is Online Consultation Right for You?</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    While acute medical emergencies and tests require clinic visits, many patients benefit enormously from online consulting:
                </p>

                <div class="space-y-4">
                    <div class="flex items-start space-x-3 text-xs text-dark-grey/70">
                        <div class="w-5 h-5 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></div>
                        <div>
                            <strong class="text-deep-indigo">Outstation & Global Patients:</strong> Seek clinical advice from anywhere in the world without travel overhead.
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 text-xs text-dark-grey/70">
                        <div class="w-5 h-5 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></div>
                        <div>
                            <strong class="text-deep-indigo">Routine Follow-ups:</strong> Ideal for reviewing treatment responses, discussing medication dosages, or reviewing lab tests.
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 text-xs text-dark-grey/70">
                        <div class="w-5 h-5 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></div>
                        <div>
                            <strong class="text-deep-indigo">Diagnostic Review:</strong> Share records to receive an expert diagnostic opinion.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right -->
            <div class="lg:col-span-5 bg-gradient-to-br from-deep-indigo to-indigo-950 text-white p-8 rounded-3xl space-y-6">
                <h3 class="text-xl font-bold font-serif">Fast Booking</h3>
                <p class="text-xs text-white/80 leading-relaxed">
                    Have your medical history and imaging scans ready before scheduling a slot. For urgent cases, please call the emergency desk directly.
                </p>
                <form class="pt-2 border-t border-white/10 space-y-3" accept-charset="UTF-8" action="https://app.formester.com/forms/MUVNkRKYA/submissions" method="POST">
                    <input type="hidden" name="form_type" value="Online Consultation Request">
                    <div>
                        <label for="tele-name" class="sr-only">Full Name</label>
                        <input type="text" id="tele-name" name="name" required placeholder="Your Name" class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-cyan-accent text-xs text-white placeholder-white/60">
                    </div>
                    <div>
                        <label for="tele-phone" class="sr-only">Phone Number</label>
                        <input type="tel" id="tele-phone" name="phone" required placeholder="Phone Number" class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-cyan-accent text-xs text-white placeholder-white/60">
                    </div>
                    <div>
                        <button type="submit" class="block w-full text-center bg-cyan-accent hover:bg-cyan-500 text-deep-indigo font-bold py-2.5 rounded-xl transition-all duration-300 transform active:scale-95 text-xs shadow-lg shadow-cyan-accent/20">
                            Book Online Slot
                        </button>
                    </div>
                </form>
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
                    Answers to common queries about online consultations, booking slots, and prescription downloads.
                </p>
            </div>

            <!-- Right Column: Accordions -->
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How do I book and connect to an online consultation?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                You can book an online consultation through our website booking portal. Once scheduled, you will receive a secure video link via email or SMS. Simply click the link at your appointment time to join the consultation on your phone or computer.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What conditions are suitable for online tele-consultation?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Online consultations are highly suitable for routine follow-ups, reviewing laboratory or imaging results, managing ongoing medication adjustments, and seeking general second opinions. If you have sudden or emergency symptoms, please seek in-person emergency care.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can I get a digital prescription during the video call?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Yes. After your consultation, Dr. Praveen Gupta will generate a digitally signed prescription and send it directly to your registered email or WhatsApp number, which you can use at any licensed pharmacy.
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
