<?php
/**
 * Neurology Procedures Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Neurology Procedures</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-microscope text-cyan-accent text-[10px]"></i>
                <span>Advanced Diagnostics & Therapeutics</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Neurology <span class="text-cyan-accent">Procedures</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Explore the advanced clinical diagnostic tests and highly specialized therapeutic procedures conducted under the supervision of Dr. Praveen Gupta.
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="#diagnostics" class="group inline-flex items-center space-x-2 text-white font-medium text-sm hover:text-cyan-accent transition-colors">
                    <span>Explore Procedures</span>
                    <i class="fas fa-arrow-down text-xs group-hover:translate-y-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Diagnostics Section -->
<section id="diagnostics" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans">Diagnostic Excellence</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Advanced Diagnostic Testing</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                State-of-the-art neurological mapping to precisely evaluate brain, spinal cord, muscle, and nerve health.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Test 1 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-wave-square text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">EEG & Video EEG Monitoring</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Electroencephalogram (EEG) records the electrical activity of the brain. Continuous Video EEG allows prolonged tracking to monitor, classify, and identify precise focus areas for epilepsy or seizure events.
                </p>
                <div class="pt-2 text-xs text-dark-grey/60">
                    <strong class="text-deep-indigo">Common Indications:</strong> Seizures, blackouts, unexplained fainting, memory confusion.
                </div>
            </div>

            <!-- Test 2 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent">
                    <i class="fas fa-compress-alt text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">EMG & Nerve Conduction Study (NCS)</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Nerve Conduction Studies track the speed and strength of signals passing through peripheral nerves. Electromyography (EMG) evaluates electrical muscle activity to detect damage or neuromuscular diseases.
                </p>
                <div class="pt-2 text-xs text-dark-grey/60">
                    <strong class="text-deep-indigo">Common Indications:</strong> Numbness, limb pain, muscle weakness, neuropathy, carpal tunnel syndrome.
                </div>
            </div>

            <!-- Test 3 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo">
                    <i class="fas fa-wifi text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Evoked Potentials (VEP, SSEP, BERA)</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    These non-invasive tests measure electrical signals in the brain in response to sight, sound, or touch stimulation. They evaluate sensory nerve pathways across the central nervous system.
                </p>
                <div class="pt-2 text-xs text-dark-grey/60">
                    <strong class="text-deep-indigo">Common Indications:</strong> Multiple sclerosis screening, optic nerve injuries, hearing loss pathways.
                </div>
            </div>

            <!-- Test 4 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-bed text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Sleep Study (Polysomnography)</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    An overnight recording of sleep patterns, brain activity, blood oxygen levels, heart rate, and breathing. Used to diagnose complex sleep disorders.
                </p>
                <div class="pt-2 text-xs text-dark-grey/60">
                    <strong class="text-deep-indigo">Common Indications:</strong> Sleep apnea, severe insomnia, narcolepsy, restless leg syndrome.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Therapeutics Section -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-cyan-accent font-bold text-xs uppercase tracking-wider font-sans">Therapeutic Innovations</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Specialized Treatments & Interventions</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Advanced surgical and non-surgical procedures targeting root causes of complex neurological conditions.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Treatment 1 -->
            <div class="bg-white p-8 rounded-3xl border border-silver-grey/30 space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-brain text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Deep Brain Stimulation (DBS)</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Clinical management of implantable stimulators targeting deep brain structures. Offers significant symptomatic control for Parkinson's disease and dystonia when medications are no longer fully effective.
                </p>
            </div>

            <!-- Treatment 2 -->
            <div class="bg-white p-8 rounded-3xl border border-silver-grey/30 space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent">
                    <i class="fas fa-syringe text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Therapeutic Botox Injections</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Highly targeted injections of botulinum toxin to relieve chronic migraines, treat muscle spasticity following strokes, and manage hemifacial spasms or blepharospasm.
                </p>
            </div>

            <!-- Treatment 3 -->
            <div class="bg-white p-8 rounded-3xl border border-silver-grey/30 space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Stroke Thrombolysis & Thrombectomy</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Emergency administration of clot-dissolving tissue plasminogen activator (tPA) or referral for endovascular mechanical clot extraction (thrombectomy) to restore brain blood flow.
                </p>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
