<?php
/**
 * Patient Information Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Patient Information</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-info-circle text-[10px]"></i>
                <span>Helpful Resources & Guidelines</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Patient <span class="text-white font-normal">Information & Resources</span>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Find everything you need to know ahead of your visit. Explore insurance guidelines, consultation checklists, emergency contact info, and patient resources.
            </p>
        </div>
    </div>
</section>

<!-- Main Info Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Col 1: Checklist -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-6 hover:shadow-xl transition-all duration-300">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-clipboard-list text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-dark-grey mb-2">First Appointment Checklist</h3>
                    <p class="text-sm text-dark-grey/65 leading-relaxed">
                        To help Dr. Praveen Gupta understand your history clearly, please prepare the following for your consultation:
                    </p>
                </div>
                <ul class="space-y-3 text-sm text-dark-grey/70">
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-electric-blue text-xs mt-1"></i>
                        <span>All previous prescriptions & medications</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-electric-blue text-xs mt-1"></i>
                        <span>Recent MRI, CT scans, and EEG reports</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-electric-blue text-xs mt-1"></i>
                        <span>Discharge summaries (if hospitalized before)</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-electric-blue text-xs mt-1"></i>
                        <span>List of current symptoms & when they started</span>
                    </li>
                </ul>
            </div>

            <!-- Col 2: Timings & Booking -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-6 hover:shadow-xl transition-all duration-300">
                <div class="w-12 h-12 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-dark-grey mb-2">OPD timings & Registration</h3>
                    <p class="text-sm text-dark-grey/65 leading-relaxed">
                        Marengo Asia Hospital (Gurgaon Sector 56) offers general and premium neurology OPD slots:
                    </p>
                </div>
                <div class="space-y-3 text-sm text-dark-grey/70">
                    <div class="flex justify-between border-b border-slate-200/60 pb-2">
                        <span class="font-medium">Monday - Saturday</span>
                        <span>09:00 AM - 05:00 PM</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-200/60 pb-2">
                        <span class="font-medium">Sunday</span>
                        <span class="text-amber-600 font-semibold">Closed</span>
                    </div>
                    <p class="text-xs text-dark-grey/50 leading-relaxed mt-2">
                        *Please report to the OPD reception counter at least 15 minutes before your scheduled appointment slot to complete registration.
                    </p>
                </div>
            </div>

            <!-- Col 3: Insurance & TPA -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-6 hover:shadow-xl transition-all duration-300">
                <div class="w-12 h-12 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo">
                    <i class="fas fa-shield-alt text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-dark-grey mb-2">Insurance & Cashless TPA</h3>
                    <p class="text-sm text-dark-grey/65 leading-relaxed">
                        We accept all major health insurance policies and cashless TPA partnerships:
                    </p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-white border border-slate-200 px-3 py-1.5 rounded-lg text-xs font-semibold text-dark-grey">Cigna TTK</span>
                    <span class="bg-white border border-slate-200 px-3 py-1.5 rounded-lg text-xs font-semibold text-dark-grey">Star Health</span>
                    <span class="bg-white border border-slate-200 px-3 py-1.5 rounded-lg text-xs font-semibold text-dark-grey">HDFC Ergo</span>
                    <span class="bg-white border border-slate-200 px-3 py-1.5 rounded-lg text-xs font-semibold text-dark-grey">Max Bupa</span>
                    <span class="bg-white border border-slate-200 px-3 py-1.5 rounded-lg text-xs font-semibold text-dark-grey">CGHS / ECHS</span>
                    <span class="bg-white border border-slate-200 px-3 py-1.5 rounded-lg text-xs font-semibold text-dark-grey">ICICI Lombard</span>
                </div>
                <p class="text-xs text-dark-grey/50">
                    *For cashless approvals, visit the TPA Help Desk in the main lobby at least 24 hours prior to planned procedures.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Emergency Guidelines Section -->
<section class="py-12 bg-[#edf5f9] border-y border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-deep-indigo to-dark-grey rounded-[32px] p-8 md:p-12 text-white relative overflow-hidden shadow-xl">
            <!-- Glow Accent -->
            <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[100px] pointer-events-none"></div>
            
            <div class="grid md:grid-cols-12 gap-8 items-center relative z-10">
                <div class="md:col-span-8 space-y-4">
                    <span class="bg-red-500/20 text-red-300 text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full border border-red-500/30">
                        Emergency Stroke Info
                    </span>
                    <h2 class="text-2xl md:text-3xl font-bold">Suspecting a Brain Stroke? Act F.A.S.T.</h2>
                    <p class="text-white/80 text-sm leading-relaxed max-w-2xl">
                        Time is brain. In case of sudden loss of speech, facial dropping, weakness in arms, or balance issues, do not wait. Call our emergency helpline instantly.
                    </p>
                    <div class="flex flex-wrap gap-4 text-xs font-semibold text-white/95 pt-2">
                        <span class="bg-white/10 px-3.5 py-2 rounded-xl"><strong class="text-cyan-accent">F</strong> - Face Drooping</span>
                        <span class="bg-white/10 px-3.5 py-2 rounded-xl"><strong class="text-cyan-accent">A</strong> - Arm Weakness</span>
                        <span class="bg-white/10 px-3.5 py-2 rounded-xl"><strong class="text-cyan-accent">S</strong> - Speech Difficulty</span>
                        <span class="bg-white/10 px-3.5 py-2 rounded-xl"><strong class="text-cyan-accent">T</strong> - Time to call Help</span>
                    </div>
                </div>
                <div class="md:col-span-4 text-left md:text-right space-y-4">
                    <span class="block text-xs text-white/60">24/7 EMERGENCY HELPLINE</span>
                    <a href="tel:<?php echo SITE_PHONE; ?>" class="inline-flex items-center space-x-3 bg-red-600 hover:bg-red-700 text-white font-bold text-xl px-6 py-4 rounded-2xl shadow-lg hover:shadow-red-600/30 transition-all duration-300">
                        <i class="fas fa-phone-alt animate-bounce"></i>
                        <span><?php echo SITE_PHONE; ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-5 lg:sticky lg:top-24 self-start">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-3xl font-bold text-dark-grey mt-2 mb-4">Patient FAQ</h2>
                <p class="text-dark-grey/70 text-sm leading-relaxed max-w-md">
                    Find quick answers to registration, billing, and scheduling protocols.
                </p>
            </div>

            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How early should I arrive for my appointment?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Please arrive at least 15-20 minutes before your scheduled appointment time. This gives the registration staff enough time to make your card and enter your vitals.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can I request cashless admission for a planned surgery?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Yes. For planned procedures, visit the TPA Help Desk in the hospital lobby with your insurance card, e-card, doctor's prescription, and Aadhaar card at least 24-48 hours before admission.
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
