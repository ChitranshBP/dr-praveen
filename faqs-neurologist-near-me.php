<?php
/**
 * FAQs Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">FAQs</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-question-circle text-[10px]"></i>
                <span>Helpful Answers to Common Inquiries</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Frequently Asked <span class="text-white font-normal">Questions</span>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Got questions? We have answers. Browse common queries related to doctor consultations, clinical programs, diagnoses, and hospital TPAs.
            </p>
        </div>
    </div>
</section>

<!-- FAQs Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 animate-fade-in">
            <!-- Left Side Sidebar Categories (4 columns) -->
            <div class="lg:col-span-4 lg:sticky lg:top-24 self-start space-y-4">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">FAQ Categories</span>
                <div class="flex flex-col space-y-2" id="faq-categories">
                    <button class="faq-cat-btn active text-left px-5 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 bg-electric-blue text-white shadow-md" data-category="general">
                        <i class="fas fa-hospital text-xs mr-2"></i> General Consultations
                    </button>
                    <button class="faq-cat-btn text-left px-5 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 bg-slate-50 text-dark-grey/70 hover:bg-slate-100" data-category="treatments">
                        <i class="fas fa-stethoscope text-xs mr-2"></i> Clinical Treatments
                    </button>
                    <button class="faq-cat-btn text-left px-5 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 bg-slate-50 text-dark-grey/70 hover:bg-slate-100" data-category="tpa">
                        <i class="fas fa-credit-card text-xs mr-2"></i> Billing & Insurance
                    </button>
                </div>
            </div>

            <!-- Right Side FAQ Items (8 columns) -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Group: General -->
                <div class="faq-group space-y-4" id="cat-general">
                    <h3 class="text-xl font-bold text-dark-grey mb-2 flex items-center">
                        <i class="fas fa-hospital text-electric-blue text-sm mr-2.5"></i> General Consultations
                    </h3>

                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How do I book an appointment with Dr. Praveen Gupta?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                You can book consultations directly online through our Contact page or call Marengo Asia Hospital's dedicated registration hotline at <?php echo SITE_PHONE; ?>.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What documents should I carry for my first consultation?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Please bring a list of current symptoms, all previous prescriptions, and recent radiological films (MRI/CT brain scans, EEGs).
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What are the consultation timings for OPD patients?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Dr. Praveen Gupta's OPD consultation hours at Marengo Asia Hospital, Gurgaon are from Monday to Saturday, between 9:00 AM and 5:00 PM. Prior booking helps reduce waiting times.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Is online or teleconsultation available?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Yes. Teleconsultations are available for follow-up patients and individuals seeking second opinions who cannot travel. You can schedule an online session by filling out our contact form.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can I request a clinical coordinator call-back?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Yes. Once you fill out the online message form on our Contact Us page, a clinical coordinator from our team will reach out to you within 24 business hours to address your query.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Group: Treatments -->
                <div class="faq-group space-y-4 hidden" id="cat-treatments">
                    <h3 class="text-xl font-bold text-dark-grey mb-2 flex items-center">
                        <i class="fas fa-stethoscope text-electric-blue text-sm mr-2.5"></i> Clinical Treatments
                    </h3>

                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What clinical procedures are offered for chronic Parkinson's?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Dr. Praveen Gupta is an expert in Deep Brain Stimulation (DBS) therapy. He also provides tailored motor rehabilitation courses and clinical check-ups for advanced Parkinson's disease.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is the F.A.S.T. protocol for Stroke emergencies?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                F.A.S.T. stands for Face drooping, Arm weakness, Speech difficulty, and Time to call emergency. Restoring blood flow to the brain within the 4.5-hour "golden hour" window via IV thrombolysis is crucial.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How does Botox help in managing chronic migraines?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                FDA-approved Botox injections are administered around pain pathways (31 specific sites) every 12 weeks to block pain transmission signals, reducing migraine frequency by up to 50% for chronic sufferers.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What treatments are available for drug-resistant epilepsy?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Beyond anti-seizure drugs, options include vagal nerve stimulation (VNS), specialized ketogenic diets, and surgical removal of the seizure-generating brain tissue (following Video-EEG evaluation).
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is the recovery rate of Deep Brain Stimulation (DBS) surgery?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                DBS has a high success rate in carefully selected patients, showing up to 60-80% improvement in tremor control, reducing drug dosages, and significantly improving overall movement control and quality of life.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Group: TPA -->
                <div class="faq-group space-y-4 hidden" id="cat-tpa">
                    <h3 class="text-xl font-bold text-dark-grey mb-2 flex items-center">
                        <i class="fas fa-credit-card text-electric-blue text-sm mr-2.5"></i> Billing & Insurance
                    </h3>

                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Does Marengo Hospital offer cashless TPA support?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Yes. Cashless TPA support is available for major corporate and private insurance providers (e.g. Star Health, HDFC Ergo, Max Bupa, CGHS).
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How do I request pre-authorization for planned surgeries?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                For planned admissions (like DBS or EEG monitoring), submit your doctor's estimate, policy details, and Aadhaar card to the hospital's TPA desk at least 48 hours in advance for processing.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Which corporate health panels are accepted?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                We support corporate panels including CGHS, ECHS, DGEHS, Indian Oil, NTPC, BHEL, and major nationalized bank health insurance schemes.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Are CGHS and ECHS panel cards accepted for OPD consultations?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Yes. Government health panels like CGHS and ECHS are fully supported for both outpatient department (OPD) consults and inpatient admissions, subject to standard referral letter protocols.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can I pay consulting fees using digital wallets and credit cards?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Yes. The hospital reception and TPA desks accept credit cards, debit cards, UPI payments (GPay, PhonePe, Paytm), and net banking for all consultation fees and procedural deposits.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Page Toggle Logic -->
<script>
    // FAQ Category Filter tabs
    document.querySelectorAll('#faq-categories .faq-cat-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active states
            document.querySelectorAll('#faq-categories .faq-cat-btn').forEach(b => {
                b.classList.remove('bg-electric-blue', 'text-white', 'shadow-md');
                b.classList.add('bg-slate-50', 'text-dark-grey/70');
            });
            
            // Add active states
            btn.classList.add('bg-electric-blue', 'text-white', 'shadow-md');
            btn.classList.remove('bg-slate-50', 'text-dark-grey/70');
            
            const target = btn.getAttribute('data-category');
            document.querySelectorAll('.faq-group').forEach(group => {
                if (group.id === `cat-${target}`) {
                    group.classList.remove('hidden');
                } else {
                    group.classList.add('hidden');
                }
            });
        });
    });

    // Accordion Toggle
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
