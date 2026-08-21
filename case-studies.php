<?php
/**
 * Neurology Case Studies Page - Dr. Praveen Gupta
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
                <a href="index" class="hover:text-white transition-colors">Home</a>
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

        <div class="space-y-12">
            <!-- Case 1: Stroke (Text + Video) -->
            <div class="bg-slate-50 border border-slate-200/50 rounded-[32px] overflow-hidden hover:shadow-xl transition-all duration-500 grid grid-cols-1 lg:grid-cols-12 items-center gap-6 lg:gap-0 observe">
                <!-- Text Content (7 cols) -->
                <div class="lg:col-span-7 p-8 md:p-10 space-y-4">
                    <div class="inline-flex items-center space-x-2 bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">
                        <i class="fas fa-heartbeat animate-pulse"></i>
                        <span>Acute Ischemic Stroke</span>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-indigo font-serif">Thrombectomy During Golden Hour</h3>
                    <p class="text-sm text-dark-grey/70 leading-relaxed">
                        A 62-year-old patient arrived with sudden-onset left-sided paralysis and speech slurring. Activase (tPA) thrombolysis was administered within 40 minutes, followed by successful mechanical thrombectomy to clear a right MCA clot. The patient regained motor control in 48 hours.
                    </p>
                    <div class="pt-2 flex items-center space-x-4 text-xs font-semibold text-dark-grey/60">
                        <span><i class="far fa-clock mr-1.5 text-electric-blue"></i>Door-to-Needle: 40 mins</span>
                        <span><i class="fas fa-user-check mr-1.5 text-electric-blue"></i>Outcome: Full Recovery</span>
                    </div>
                </div>
                <!-- Video Embed (5 cols) -->
                <div class="lg:col-span-5 relative aspect-video lg:h-full bg-black flex items-center justify-center overflow-hidden">
                    <iframe class="w-full h-full lg:absolute lg:inset-0" 
                            src="https://www.youtube.com/embed/QhoPKOgHrwY?rel=0&modestbranding=1" 
                            title="Patient Stroke Recovery Story" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
            </div>

            <!-- Case 2: Parkinson's DBS (Image + Text) -->
            <div class="bg-slate-50 border border-slate-200/50 rounded-[32px] overflow-hidden hover:shadow-xl transition-all duration-500 grid grid-cols-1 lg:grid-cols-12 items-center gap-6 lg:gap-0 observe">
                <!-- Image Slot (5 cols - comes first on desktop for alternating layout) -->
                <div class="lg:col-span-5 order-2 lg:order-1 relative aspect-[4/3] lg:h-full overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/ggn-nuro-images/dr-praveen-gupta.webp" 
                         alt="Dr. Praveen Gupta providing neurology consultation" 
                         class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-700">
                </div>
                <!-- Text Content (7 cols - comes second) -->
                <div class="lg:col-span-7 order-1 lg:order-2 p-8 md:p-10 space-y-4">
                    <div class="inline-flex items-center space-x-2 bg-electric-blue/10 text-electric-blue text-xs font-bold px-3 py-1 rounded-full">
                        <i class="fas fa-brain"></i>
                        <span>Parkinson's Disease</span>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-indigo font-serif">DBS for Tremor Control</h3>
                    <p class="text-sm text-dark-grey/70 leading-relaxed">
                        A 55-year-old patient experienced severe rigidity and tremors that resisted oral medications. Following a detailed cognitive and MRI screen, the patient underwent bilateral subthalamic nucleus Deep Brain Stimulation (STN-DBS) led by Dr. Praveen Gupta's team. Hand tremors decreased by 85%, allowing writing function.
                    </p>
                    <div class="pt-2 flex items-center space-x-4 text-xs font-semibold text-dark-grey/60">
                        <span><i class="fas fa-microchip mr-1.5 text-electric-blue"></i>STN-DBS Stimulation</span>
                        <span><i class="fas fa-check-circle mr-1.5 text-electric-blue"></i>Outcome: 85% Tremor Reduction</span>
                    </div>
                </div>
            </div>

            <!-- Case 3: Refractory Epilepsy (Text + Video) -->
            <div class="bg-slate-50 border border-slate-200/50 rounded-[32px] overflow-hidden hover:shadow-xl transition-all duration-500 grid grid-cols-1 lg:grid-cols-12 items-center gap-6 lg:gap-0 observe">
                <!-- Text Content (7 cols) -->
                <div class="lg:col-span-7 p-8 md:p-10 space-y-4">
                    <div class="inline-flex items-center space-x-2 bg-cyan-accent/15 text-cyan-800 text-xs font-bold px-3 py-1 rounded-full">
                        <i class="fas fa-wave-square"></i>
                        <span>Refractory Epilepsy</span>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-indigo font-serif">Anti-Seizure Customization</h3>
                    <p class="text-sm text-dark-grey/70 leading-relaxed">
                        A 24-year-old student had recurrent, generalized seizures despite taking three separate anti-epileptic medications. Video-EEG monitoring mapped focus points. Dr. Praveen Gupta customized a tailored medical dosage and drug combination, achieving seizure-free status for 3+ years.
                    </p>
                    <div class="pt-2 flex items-center space-x-4 text-xs font-semibold text-dark-grey/60">
                        <span><i class="fas fa-video mr-1.5 text-electric-blue"></i>Video-EEG Mapping</span>
                        <span><i class="fas fa-shield-alt mr-1.5 text-electric-blue"></i>Outcome: Seizure-free 3+ Years</span>
                    </div>
                </div>
                <!-- Video Embed (5 cols) -->
                <div class="lg:col-span-5 relative aspect-video lg:h-full bg-black flex items-center justify-center overflow-hidden">
                    <iframe class="w-full h-full lg:absolute lg:inset-0" 
                            src="https://www.youtube.com/embed/kEwXD0aT_rQ?rel=0&modestbranding=1" 
                            title="Patient Epilepsy Recovery Story" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
            </div>

            <!-- Case 4: Chronic Migraine (Image + Text) -->
            <div class="bg-slate-50 border border-slate-200/50 rounded-[32px] overflow-hidden hover:shadow-xl transition-all duration-500 grid grid-cols-1 lg:grid-cols-12 items-center gap-6 lg:gap-0 observe">
                <!-- Image Slot (5 cols - comes first for alternating layout) -->
                <div class="lg:col-span-5 order-2 lg:order-1 relative aspect-[4/3] lg:h-full overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/full-image/dpg-award.webp" 
                         alt="Dr. Praveen Gupta Award Recognition" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                </div>
                <!-- Text Content (7 cols - comes second) -->
                <div class="lg:col-span-7 order-1 lg:order-2 p-8 md:p-10 space-y-4">
                    <div class="inline-flex items-center space-x-2 bg-deep-indigo/10 text-deep-indigo text-xs font-bold px-3 py-1 rounded-full">
                        <i class="fas fa-syringe"></i>
                        <span>Chronic Migraine</span>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-indigo font-serif">Botox Injection Therapy</h3>
                    <p class="text-sm text-dark-grey/70 leading-relaxed">
                        A 40-year-old professional had 18 headache days per month, severely impacting their work. Therapeutic botulinum toxin (Botox) injections were administered in a structured clinical session. Headache frequency dropped to 3 days per month.
                    </p>
                    <div class="pt-2 flex items-center space-x-4 text-xs font-semibold text-dark-grey/60">
                        <span><i class="fas fa-calendar-alt mr-1.5 text-electric-blue"></i>Botox Protocol</span>
                        <span><i class="fas fa-smile mr-1.5 text-electric-blue"></i>Outcome: 3 Headache Days/Month</span>
                    </div>
                </div>
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
            <a href="contact-us-top-neurologist-delhi-ncr" class="inline-flex items-center space-x-3 bg-deep-indigo hover:bg-electric-blue text-white text-sm font-bold px-8 py-3.5 rounded-2xl transition-colors">
                <span>Book a Consultation</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
