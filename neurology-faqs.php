<?php
/**
 * Neurology FAQs Hub - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
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
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">FAQs Hub</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-question text-cyan-accent text-[10px]"></i>
                <span>Neurology Help & FAQ Hub</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Neurology <span class="text-cyan-accent">FAQs</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Find clear answers to common questions regarding appointments, neurological symptoms, diagnostic tests (EEG/EMG), and specialized therapies.
            </p>
        </div>
    </div>
</section>

<!-- Accordion FAQs Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-8">
            <!-- Category 1: General & Appointments -->
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-deep-indigo border-b border-slate-200 pb-2">Consultation & Appointments</h3>
                
                <!-- Q1 -->
                <details class="group bg-slate-50 border border-slate-200/50 rounded-3xl p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer" open>
                    <summary class="flex justify-between items-center text-sm font-bold text-deep-indigo list-none">
                        <span>How do I book a consultation with Dr. Praveen Gupta?</span>
                        <span class="transition group-open:rotate-185 text-xs text-cyan-accent"><i class="fas fa-plus group-open:hidden"></i><i class="fas fa-minus hidden group-open:inline"></i></span>
                    </summary>
                    <p class="text-xs text-dark-grey/65 leading-relaxed mt-3 border-t border-slate-200/40 pt-3">
                        You can book an in-person appointment or a video teleconsultation by visiting our online appointment portal, calling our direct scheduling line at <?php echo SITE_PHONE; ?>, or emailing us at <?php echo SITE_EMAIL; ?>.
                    </p>
                </details>

                <!-- Q2 -->
                <details class="group bg-slate-50 border border-slate-200/50 rounded-3xl p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex justify-between items-center text-sm font-bold text-deep-indigo list-none">
                        <span>What documents should I bring for my first consultation?</span>
                        <span class="transition group-open:rotate-185 text-xs text-cyan-accent"><i class="fas fa-plus group-open:hidden"></i><i class="fas fa-minus hidden group-open:inline"></i></span>
                    </summary>
                    <p class="text-xs text-dark-grey/65 leading-relaxed mt-3 border-t border-slate-200/40 pt-3">
                        Please bring all past medical prescriptions, blood test reports, and imaging scans (MRI/CT films or CDs) related to your neurological condition. Additionally, keep a list of your current medications handy.
                    </p>
                </details>
            </div>

            <!-- Category 2: Diagnostics & Tests -->
            <div class="space-y-4 pt-4">
                <h3 class="text-lg font-bold text-deep-indigo border-b border-slate-200 pb-2">Diagnostic Tests (EEG, EMG)</h3>

                <!-- Q3 -->
                <details class="group bg-slate-50 border border-slate-200/50 rounded-3xl p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex justify-between items-center text-sm font-bold text-deep-indigo list-none">
                        <span>Is any preparation required before undergoing an EEG test?</span>
                        <span class="transition group-open:rotate-185 text-xs text-cyan-accent"><i class="fas fa-plus group-open:hidden"></i><i class="fas fa-minus hidden group-open:inline"></i></span>
                    </summary>
                    <p class="text-xs text-dark-grey/65 leading-relaxed mt-3 border-t border-slate-200/40 pt-3">
                        Yes. Please wash your hair the night before or the morning of the test, and do not apply hair oils, sprays, or gels. Avoid caffeine on the day of the test as it can interfere with results. Take your usual medications unless advised otherwise by your doctor.
                    </p>
                </details>

                <!-- Q4 -->
                <details class="group bg-slate-50 border border-slate-200/50 rounded-3xl p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex justify-between items-center text-sm font-bold text-deep-indigo list-none">
                        <span>Are EMG and Nerve Conduction Studies painful?</span>
                        <span class="transition group-open:rotate-185 text-xs text-cyan-accent"><i class="fas fa-plus group-open:hidden"></i><i class="fas fa-minus hidden group-open:inline"></i></span>
                    </summary>
                    <p class="text-xs text-dark-grey/65 leading-relaxed mt-3 border-t border-slate-200/40 pt-3">
                        Nerve conduction studies involve mild electrical stimulation, which feels like a sudden tapping sensation. Electromyography (EMG) involves inserting a tiny needle electrode into specific muscles, causing minor, temporary discomfort similar to an injection.
                    </p>
                </details>
            </div>

            <!-- Category 3: Conditions & Emergencies -->
            <div class="space-y-4 pt-4">
                <h3 class="text-lg font-bold text-deep-indigo border-b border-slate-200 pb-2">Emergency Protocols</h3>

                <!-- Q5 -->
                <details class="group bg-slate-50 border border-slate-200/50 rounded-3xl p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex justify-between items-center text-sm font-bold text-deep-indigo list-none">
                        <span>What is the "Golden Hour" for a brain stroke?</span>
                        <span class="transition group-open:rotate-185 text-xs text-cyan-accent"><i class="fas fa-plus group-open:hidden"></i><i class="fas fa-minus hidden group-open:inline"></i></span>
                    </summary>
                    <p class="text-xs text-dark-grey/65 leading-relaxed mt-3 border-t border-slate-200/40 pt-3">
                        The golden hour refers to the first 4.5 hours after stroke symptoms begin. Administering clot-dissolving medications (thrombolysis) within this window significantly increases the chances of saving dying brain cells and achieving a full recovery.
                    </p>
                </details>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-3xl font-bold text-deep-indigo font-serif">Still Have Questions?</h2>
        <p class="text-sm text-dark-grey/65 max-w-xl mx-auto leading-relaxed">
            Our medical coordination help desk is available to answer any clinical or procedural queries.
        </p>
        <div class="pt-2">
            <a href="contact-us-top-neurologist-delhi-ncr.php" class="inline-flex items-center space-x-3 bg-deep-indigo hover:bg-electric-blue text-white text-sm font-bold px-8 py-3.5 rounded-2xl transition-colors">
                <span>Contact Us</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
