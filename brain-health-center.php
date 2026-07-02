<?php
/**
 * Brain Health Hub Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Brain Health Hub</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-heart text-cyan-accent text-[10px]"></i>
                <span>Preventive Neurology & Wellness</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Brain Health <span class="text-cyan-accent">Hub</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Nurture your mind. Discover scientifically backed wellness guidelines, preventative advice, and cognitive screening options to keep your brain healthy.
            </p>
        </div>
    </div>
</section>

<!-- Lifestyle Pillars Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans">Wellness Pillars</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Pillars of Brain Health</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Simple, scientifically proven habits that support neural connectivity and delay cognitive aging.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Pillar 1 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-apple-alt"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Nutrition</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A diet rich in antioxidants, omega-3 fatty acids, and green vegetables helps protect brain cells and supports micro-vascular blood circulation.
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent">
                    <i class="fas fa-running"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Physical Activity</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Regular aerobic exercise increases blood flow to the brain, encourages neuroplasticity, and releases BDNF, which supports memory cells.
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo">
                    <i class="fas fa-moon"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Restful Sleep</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Deep sleep activates the brain's glymphatic system, clearing metabolic waste and harmful proteins (like amyloid-beta) that can trigger cognitive decline.
                </p>
            </div>

            <!-- Pillar 4 -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-puzzle-piece"></i>
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Mental Exercise</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Learning new skills, reading, solving puzzles, and staying socially active helps build a robust cognitive reserve that resists age-related memory loss.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Preventive Screenings -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Preventive Screening</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Executive Brain Health Screening</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Prevention is the best cure. Dr. Praveen Gupta recommends regular neurological wellness checks for adults over 50, or those with family histories of stroke, dementia, or vascular issues.
                </p>
                <div class="space-y-4 text-xs text-dark-grey/70">
                    <div class="flex items-start space-x-3.5">
                        <div class="w-5 h-5 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></div>
                        <p><strong class="text-deep-indigo">Vascular Risk Profiles:</strong> Check blood pressure, cholesterol, and carotid arterial health to manage stroke risks.</p>
                    </div>
                    <div class="flex items-start space-x-3.5">
                        <div class="w-5 h-5 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></div>
                        <p><strong class="text-deep-indigo">Baseline Cognitive Audits:</strong> Simple screenings to detect early memory changes and establish treatment benchmarks.</p>
                    </div>
                </div>
            </div>

            <!-- Right -->
            <div class="lg:col-span-5 bg-gradient-to-br from-deep-indigo to-indigo-950 text-white p-8 rounded-3xl space-y-4">
                <h3 class="text-xl font-bold font-serif">Health Audit</h3>
                <p class="text-xs text-white/80 leading-relaxed">
                    Evaluate your stroke and memory health. Schedule a preventative neurology consultation session today.
                </p>
                <div class="pt-2">
                    <a href="contact-us-top-neurologist-delhi-ncr.php" class="block w-full text-center bg-cyan-accent hover:bg-cyan-500 text-deep-indigo font-bold py-3 rounded-2xl transition-colors text-xs">
                        Book Consultation
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
