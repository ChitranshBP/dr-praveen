<?php
/**
 * Memory & Cognitive Center Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Memory Clinic</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-brain text-cyan-accent text-[10px]"></i>
                <span>Cognitive & Dementia Evaluation Center</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Memory & <span class="text-cyan-accent">Cognitive Center</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Comprehensive clinical diagnosis, cognitive screening, pharmacotherapy, and family support systems to manage dementia, Alzheimer's, and memory disorders.
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
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Cognitive Care</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Understanding Memory Disorders</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Memory loss can range from mild forgetfulness to progressive conditions like dementia and Alzheimer's disease. Early detection is crucial to slow progression and improve the quality of life for patients and their caregivers.
                </p>

                <div class="space-y-4">
                    <div class="p-6 bg-slate-50 border border-slate-200/50 rounded-3xl space-y-2">
                        <h3 class="font-bold text-deep-indigo text-base flex items-center space-x-2">
                            <span class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue text-xs"><i class="fas fa-heartbeat"></i></span>
                            <span>Alzheimer's & Progressive Dementia</span>
                        </h3>
                        <p class="text-xs text-dark-grey/65 leading-relaxed">
                            Evaluating progressive cognitive decline, memory impairment, spatial disorientation, and behavioral changes through structured medical strategies.
                        </p>
                    </div>

                    <div class="p-6 bg-slate-50 border border-slate-200/50 rounded-3xl space-y-2">
                        <h3 class="font-bold text-deep-indigo text-base flex items-center space-x-2">
                            <span class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue text-xs"><i class="fas fa-brain"></i></span>
                            <span>Mild Cognitive Impairment (MCI)</span>
                        </h3>
                        <p class="text-xs text-dark-grey/65 leading-relaxed">
                            Addressing early-stage memory changes that exceed normal age-related forgetfulness but do not yet prevent daily living function.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right: Diagnostics -->
            <div class="lg:col-span-5 bg-gradient-to-br from-soft-cyan to-white p-8 rounded-3xl border border-cyan-accent/20 space-y-6">
                <h3 class="text-xl font-bold text-deep-indigo font-serif">Diagnostic Protocols</h3>
                <p class="text-xs text-dark-grey/60 leading-relaxed">
                    Our center conducts precise diagnostic mapping to trace the root causes of cognitive symptoms:
                </p>

                <ul class="space-y-4 text-xs text-dark-grey/70">
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-paste text-[10px]"></i></span>
                        <div><strong class="text-deep-indigo">Cognitive Testing:</strong> Standardized memory, reasoning, and speech assessments (e.g., MoCA, MMSE).</div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-brain text-[10px]"></i></span>
                        <div><strong class="text-deep-indigo">Advanced Brain Imaging:</strong> High-resolution brain MRI to check for tissue shrinkage (atrophy) or structural issues.</div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-vial text-[10px]"></i></span>
                        <div><strong class="text-deep-indigo">Lab Panels:</strong> Blood profiles to rule out vitamin B12 deficiency, thyroid imbalances, or infections.</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Family & Caregiver Support -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left: Text -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Caregiver Support</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Supporting the Entire Family</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Dementia affects not just the patient, but the entire household. Our clinical plans emphasize caregiver training, safety counseling, behavioral management, and connection to respite services.
                </p>
                <div class="grid sm:grid-cols-2 gap-6 text-xs text-dark-grey/70">
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-cyan-accent mt-0.5 flex-shrink-0"></i>
                        <p><strong class="text-deep-indigo">Behavioral Strategies:</strong> Dealing with confusion, mood changes, or sleep-wake cycle disturbances.</p>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-cyan-accent mt-0.5 flex-shrink-0"></i>
                        <p><strong class="text-deep-indigo">Home Safety Guidance:</strong> Layout tips to prevent falls, wandering, and household injuries.</p>
                    </div>
                </div>
            </div>

            <!-- Right -->
            <div class="lg:col-span-5 bg-gradient-to-br from-deep-indigo to-indigo-950 text-white p-8 rounded-3xl space-y-4">
                <h3 class="text-xl font-bold font-serif font-serif">Memory Assessment</h3>
                <p class="text-xs text-white/80 leading-relaxed">
                    If you are concerned about persistent memory gaps or cognitive changes, schedule an evaluation today.
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
