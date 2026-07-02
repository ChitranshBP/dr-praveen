<?php
/**
 * Neurology Case Studies Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Case Studies</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-microscope text-cyan-accent text-[10px]"></i>
                <span>Anonymized Clinical Case Files</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Neurology <span class="text-cyan-accent">Case Studies</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Explore real clinical histories demonstrating the effectiveness of advanced stroke treatments, DBS programming, and specialized neurology interventions.
            </p>
        </div>
    </div>
</section>

<!-- Case Studies List -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans">Clinical Portals</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Clinical Recovery Reports</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Detailed reviews of patient cases, clinical decisions, and outcomes under Dr. Praveen Gupta.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Case 1 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-all duration-300">
                <div class="inline-flex items-center space-x-2 bg-red-100 text-red-700 text-[10px] font-semibold px-2.5 py-1 rounded-full">
                    <i class="fas fa-heartbeat animate-pulse"></i>
                    <span>Acute Ischemic Stroke</span>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Thrombectomy During Golden Hour</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A 62-year-old patient arrived with sudden-onset left-sided paralysis and speech slurring. Activase (tPA) thrombolysis was administered within 40 minutes, followed by successful mechanical thrombectomy to clear a right MCA clot. The patient regained motor control in 48 hours.
                </p>
            </div>

            <!-- Case 2 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-all duration-300">
                <div class="inline-flex items-center space-x-2 bg-electric-blue/10 text-electric-blue text-[10px] font-semibold px-2.5 py-1 rounded-full">
                    <i class="fas fa-brain"></i>
                    <span>Parkinson's Disease</span>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">DBS for Tremor Control</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A 55-year-old patient experienced severe rigidity and tremors that resisted oral medications. Following a detailed cognitive and MRI screen, the patient underwent bilateral subthalamic nucleus Deep Brain Stimulation (STN-DBS). Hand tremors decreased by 85%, allowing writing function.
                </p>
            </div>

            <!-- Case 3 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-all duration-300">
                <div class="inline-flex items-center space-x-2 bg-cyan-accent/10 text-cyan-700 text-[10px] font-semibold px-2.5 py-1 rounded-full">
                    <i class="fas fa-wave-square"></i>
                    <span>Refractory Epilepsy</span>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Anti-Seizure Customization</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A 24-year-old student had recurrent, generalized seizures despite taking three separate anti-epileptic medications. Video-EEG monitoring mapped focus points. A tailored medical adjustment achieved seizure-free status for 3+ years.
                </p>
            </div>

            <!-- Case 4 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-all duration-300">
                <div class="inline-flex items-center space-x-2 bg-deep-indigo/10 text-deep-indigo text-[10px] font-semibold px-2.5 py-1 rounded-full">
                    <i class="fas fa-syringe"></i>
                    <span>Chronic Migraine</span>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Botox Injection Therapy</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A 40-year-old professional had 18 headache days per month, severely impacting their work. Therapeutic botulinum toxin (Botox) injections were administered in a structured clinical session. Headache frequency dropped to 3 days per month.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-3xl font-bold text-deep-indigo font-serif">Have a Complex Neurological Case?</h2>
        <p class="text-sm text-dark-grey/65 max-w-xl mx-auto leading-relaxed">
            Get an expert clinical evaluation, record review, or second opinion of your diagnosis and current treatments.
        </p>
        <div class="pt-2">
            <a href="contact-us-top-neurologist-delhi-ncr.php" class="inline-flex items-center space-x-3 bg-deep-indigo hover:bg-electric-blue text-white text-sm font-bold px-8 py-3.5 rounded-2xl transition-colors">
                <span>Book a Consultation</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
