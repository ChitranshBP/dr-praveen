<?php
/**
 * Neurological Symptoms Hub - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Neurological Symptoms</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-notes-medical text-cyan-accent text-[10px]"></i>
                <span>Symptom Directory & Guidance</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Neurological <span class="text-cyan-accent">Symptoms</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Recognize key warning signs and symptoms that affect the nervous system, understand their potential causes, and learn when you should consult a neurologist.
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="#symptoms-list" class="group inline-flex items-center space-x-2 text-white font-medium text-sm hover:text-cyan-accent transition-colors">
                    <span>Explore Symptoms</span>
                    <i class="fas fa-arrow-down text-xs group-hover:translate-y-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Symptoms List Section -->
<section id="symptoms-list" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Symptom Mapping</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Identify Your Symptoms</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Click on the symptom areas below to learn about potential underlying conditions and when to see a specialist.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Symptom 1 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-head-side-cough text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Chronic / Severe Headaches</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Recurrent throbbing, sharp headaches, or headaches accompanied by nausea, sensitivity to light/sound, or visual disturbances.
                </p>
                <div class="pt-2 border-t border-slate-200/40 text-[11px] text-dark-grey/60">
                    <strong class="text-deep-indigo">Potential Causes:</strong> <a href="migraine.php" class="hover:text-electric-blue font-medium underline">Migraine</a>, <a href="headache.php" class="hover:text-electric-blue font-medium underline">Tension Headache</a>, Cluster Headache.
                </div>
            </div>

            <!-- Symptom 2 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent">
                    <i class="fas fa-sync-alt text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Dizziness & Loss of Balance</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Feeling lightheaded, unsteady, or experiencing a spinning sensation (vertigo) which affects coordination or walking.
                </p>
                <div class="pt-2 border-t border-slate-200/40 text-[11px] text-dark-grey/60">
                    <strong class="text-deep-indigo">Potential Causes:</strong> <a href="vertigo.php" class="hover:text-cyan-accent font-medium underline">Vestibular Vertigo</a>, Balance disorders, Inner-ear infection.
                </div>
            </div>

            <!-- Symptom 3 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo">
                    <i class="fas fa-compress-arrows-alt text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Numbness & Tingling</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A "pins and needles" sensation, loss of feeling, or burning pain in the feet, legs, hands, or arms.
                </p>
                <div class="pt-2 border-t border-slate-200/40 text-[11px] text-dark-grey/60">
                    <strong class="text-deep-indigo">Potential Causes:</strong> <a href="neuropathy.php" class="hover:text-electric-blue font-medium underline">Peripheral Neuropathy</a>, Radiculopathy, Nerve entrapment.
                </div>
            </div>

            <!-- Symptom 4 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-hand-paper text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Tremors & Stiffness</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Involuntary shaking of the hands or limbs, muscle stiffness, slowed movements, or difficulty with walking coordination.
                </p>
                <div class="pt-2 border-t border-slate-200/40 text-[11px] text-dark-grey/60">
                    <strong class="text-deep-indigo">Potential Causes:</strong> <a href="parkinsons.php" class="hover:text-electric-blue font-medium underline">Parkinson's Disease</a>, <a href="movement.php" class="hover:text-electric-blue font-medium underline">Essential Tremor</a>, Movement disorders.
                </div>
            </div>

            <!-- Symptom 5 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent">
                    <i class="fas fa-question text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Memory Loss & Confusion</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Persistent forgetfulness, difficulty finding words, disorientation in familiar places, or sudden changes in cognitive behavior.
                </p>
                <div class="pt-2 border-t border-slate-200/40 text-[11px] text-dark-grey/60">
                    <strong class="text-deep-indigo">Potential Causes:</strong> Dementia, Early-onset Alzheimer's, Vitamin deficiencies, Neurodegeneration.
                </div>
            </div>

            <!-- Symptom 6 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo">
                    <i class="fas fa-dumbbell text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Muscle Weakness</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Loss of muscle power, difficulty raising arms or legs, foot drop, or general weakness that worsens with activity.
                </p>
                <div class="pt-2 border-t border-slate-200/40 text-[11px] text-dark-grey/60">
                    <strong class="text-deep-indigo">Potential Causes:</strong> <a href="ms.php" class="hover:text-electric-blue font-medium underline">Multiple Sclerosis</a>, Myopathies, Motor neuron diseases.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Red Flag Warnings Section -->
<section class="py-16 bg-red-50/30 border-t border-b border-red-200/35">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left content -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center space-x-2 bg-red-100 text-red-700 text-xs font-semibold px-3 py-1.5 rounded-full border border-red-200">
                    <i class="fas fa-exclamation-triangle animate-pulse"></i>
                    <span>Red Flag Warning Symptoms</span>
                </div>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">When is it a Neurological Emergency?</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Some symptoms indicate acute damage or severe threat to the nervous system. If you notice any of these signs, seek emergency care immediately.
                </p>

                <div class="grid sm:grid-cols-2 gap-6 text-xs text-dark-grey/70">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-chevron-right text-red-650 text-red-650 mt-1 flex-shrink-0"></i>
                        <p><strong class="text-deep-indigo">Sudden weakness or numbness</strong> in the face, arm, or leg, especially on one side of the body.</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-chevron-right text-red-650 mt-1 flex-shrink-0"></i>
                        <p><strong class="text-deep-indigo">Sudden speech difficulty</strong>, slurring, confusion, or difficulty understanding others.</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-chevron-right text-red-650 mt-1 flex-shrink-0"></i>
                        <p><strong class="text-deep-indigo">Worst headache of your life</strong> (sudden onset "thunderclap" headache).</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-chevron-right text-red-650 mt-1 flex-shrink-0"></i>
                        <p><strong class="text-deep-indigo">Loss of vision or double vision</strong> occurring suddenly.</p>
                    </div>
                </div>
            </div>

            <!-- Right card -->
            <div class="lg:col-span-5 bg-gradient-to-br from-red-800 via-red-950 to-slate-950 text-white p-8 rounded-3xl shadow-xl space-y-6">
                <h3 class="text-xl font-bold font-serif">24/7 Emergency Support</h3>
                <p class="text-xs text-white/80 leading-relaxed">
                    Under the clinical directorship of Dr. Praveen Gupta, Marengo Asia Hospital operates a dedicated 24/7 emergency stroke and seizure response protocol.
                </p>
                <div class="pt-4 border-t border-white/10">
                    <a href="emergency-neurology-care.php" class="block w-full text-center bg-red-600 hover:bg-red-750 hover:bg-red-700 text-white font-bold py-3 rounded-2xl transition-colors text-sm">
                        View Emergency Protocols
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
