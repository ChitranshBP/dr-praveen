<?php
/**
 * Rehabilitation Hub Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Rehabilitation Hub</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-child text-cyan-accent text-[10px]"></i>
                <span>Comprehensive Neuro-Rehabilitation</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Rehabilitation <span class="text-cyan-accent">Hub</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Restoring function, independence, and confidence. Custom-tailored physical, occupational, and speech rehabilitation programs for stroke, trauma, and progressive disorders.
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

<!-- Overview and Core Programs -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans">Our Therapies</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Core Rehabilitation Programs</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                We combine specialized therapies to rebuild mobility, speech patterns, and daily function.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Program 1 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-walking text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Neuro-Physiotherapy</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Focuses on rebuilding muscle strength, improving balance, training gait cycles, and recovering motor control following a stroke, spine injury, or onset of neuropathy.
                </p>
            </div>

            <!-- Program 2 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent">
                    <i class="fas fa-hands-helping text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Occupational Therapy</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Aids patients in relearning daily living activities (bathing, dressing, writing). We provide cognitive adaptation, motor skills coordination, and assistive technology advice.
                </p>
            </div>

            <!-- Program 3 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo">
                    <i class="fas fa-volume-up text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Speech & Swallowing</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Addresses dysphagia (swallowing difficulties) and speech clarity challenges (aphasia/dysarthria) caused by neurological damage, helping patients communicate safely.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Multidisciplinary Approach -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left: Content -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Recovery Philosophy</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Comprehensive Clinical Support</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Rehabilitation is most successful when it begins early and is tailored to the individual. Dr. Praveen Gupta coordinates care with specialized physiotherapists, speech paths, and occupational therapists to structure unified daily recovery schedules.
                </p>
                <div class="space-y-4 text-xs text-dark-grey/70">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-check text-cyan-accent mt-0.5"></i>
                        <p><strong class="text-deep-indigo">Stroke Recovery:</strong> Focused motor skill training to bypass damaged brain pathways (neuroplasticity).</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-check text-cyan-accent mt-0.5"></i>
                        <p><strong class="text-deep-indigo">Movement Adaptation:</strong> Assisting Parkinson's and tremor patients in preserving coordination and balance.</p>
                    </div>
                </div>
            </div>

            <!-- Right -->
            <div class="lg:col-span-5 bg-gradient-to-br from-deep-indigo to-indigo-950 text-white p-8 rounded-3xl space-y-4">
                <h3 class="text-xl font-bold font-serif">Evaluation Booking</h3>
                <p class="text-xs text-white/80 leading-relaxed">
                    Schedule a clinical coordination session to assess rehabilitation requirements and design your tailored pathway.
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
