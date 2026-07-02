<?php
/**
 * Neurological Conditions Hub - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Neurological Conditions</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-brain text-cyan-accent text-[10px]"></i>
                <span>Comprehensive Neurology Directory</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Neurological <span class="text-cyan-accent">Conditions</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Explore comprehensive information, symptoms, and advanced diagnostic and treatment options for a wide spectrum of neurological disorders.
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="#directory" class="group inline-flex items-center space-x-2 text-white font-medium text-sm hover:text-cyan-accent transition-colors">
                    <span>Browse Conditions</span>
                    <i class="fas fa-arrow-down text-xs group-hover:translate-y-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Conditions Grid Section -->
<section id="directory" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Neurology Portal</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Explore Medical Conditions</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Click on any of the specialties below to read detailed resources on symptoms, diagnosis, and care plans.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Condition 1 -->
            <a href="stroke.php" class="group bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue group-hover:bg-electric-blue group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo group-hover:text-electric-blue transition-colors">Brain Stroke</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Acute care, mechanical thrombectomy, and comprehensive neuro-rehabilitation protocols to treat and recover from strokes.
                </p>
                <div class="flex items-center space-x-1.5 text-xs font-semibold text-electric-blue pt-2">
                    <span>Read Details</span>
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Condition 2 -->
            <a href="epilepsy.php" class="group bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent group-hover:bg-cyan-accent group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-wave-square text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo group-hover:text-cyan-accent transition-colors">Epilepsy & Seizures</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Personalized pharmacotherapy, long-term monitoring, and surgical evaluations for complex seizure disorders.
                </p>
                <div class="flex items-center space-x-1.5 text-xs font-semibold text-cyan-accent pt-2">
                    <span>Read Details</span>
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Condition 3 -->
            <a href="migraine.php" class="group bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo group-hover:bg-deep-indigo group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-head-side-virus text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo group-hover:text-electric-blue transition-colors">Migraine</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Advanced prevention therapies, lifestyle modification, and specialized neuro-modulators to manage chronic migraine.
                </p>
                <div class="flex items-center space-x-1.5 text-xs font-semibold text-deep-indigo pt-2">
                    <span>Read Details</span>
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Condition 4 -->
            <a href="headache.php" class="group bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue group-hover:bg-electric-blue group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-head-side-slash text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo group-hover:text-electric-blue transition-colors">Headache Disorders</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Comprehensive workups for tension headaches, cluster headaches, and secondary headache symptoms.
                </p>
                <div class="flex items-center space-x-1.5 text-xs font-semibold text-electric-blue pt-2">
                    <span>Read Details</span>
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Condition 5 -->
            <a href="parkinsons.php" class="group bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent group-hover:bg-cyan-accent group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-running text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo group-hover:text-cyan-accent transition-colors">Parkinson's Disease</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Symptom control, advanced pharmacology, and Deep Brain Stimulation (DBS) therapies for Parkinson's disease.
                </p>
                <div class="flex items-center space-x-1.5 text-xs font-semibold text-cyan-accent pt-2">
                    <span>Read Details</span>
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Condition 6 -->
            <a href="ms.php" class="group bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo group-hover:bg-deep-indigo group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-shield-alt text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo group-hover:text-electric-blue transition-colors">Multiple Sclerosis</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Immunomodulatory therapies and tailored symptom management to improve mobility and reduce relapse frequency.
                </p>
                <div class="flex items-center space-x-1.5 text-xs font-semibold text-deep-indigo pt-2">
                    <span>Read Details</span>
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Condition 7 -->
            <a href="movement.php" class="group bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue group-hover:bg-electric-blue group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-child text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo group-hover:text-electric-blue transition-colors">Movement Disorders</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Specialized management of tremor, dystonia, chorea, and other complex involuntary movement issues.
                </p>
                <div class="flex items-center space-x-1.5 text-xs font-semibold text-electric-blue pt-2">
                    <span>Read Details</span>
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Condition 8 -->
            <a href="neuropathy.php" class="group bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent group-hover:bg-cyan-accent group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-compress-alt text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo group-hover:text-cyan-accent transition-colors">Peripheral Neuropathy</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Nerve testing, neuropathic pain management, and root-cause therapies for nerve damage and sensory loss.
                </p>
                <div class="flex items-center space-x-1.5 text-xs font-semibold text-cyan-accent pt-2">
                    <span>Read Details</span>
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Condition 9 -->
            <a href="vertigo.php" class="group bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo group-hover:bg-deep-indigo group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-sync-alt text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo group-hover:text-electric-blue transition-colors">Vertigo & Balance</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Diagnostic balance assessments, vestibular testing, and physical rehabilitation programs to stop dizziness.
                </p>
                <div class="flex items-center space-x-1.5 text-xs font-semibold text-deep-indigo pt-2">
                    <span>Read Details</span>
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
