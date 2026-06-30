<?php
/**
 * Media Updates Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Media Updates</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-bullhorn text-[10px]"></i>
                <span>Press Releases & Clinic Announcements</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Press & Media <span class="text-white font-normal">Updates</span>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Stay updated with the latest clinical milestones, research publications, hospital events, and health camps organized by Dr. Praveen Gupta.
            </p>
        </div>
    </div>
</section>

<!-- Updates Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Update 1 -->
            <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-6 md:p-8 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div class="space-y-4">
                    <span class="text-xs text-electric-blue font-bold uppercase tracking-wider">Press Release</span>
                    <span class="block text-xs text-dark-grey/40">15 June 2026</span>
                    <h3 class="text-xl font-bold text-dark-grey leading-snug">Marengo Hospital Launches Advanced Stroke Center</h3>
                    <p class="text-sm text-dark-grey/65 leading-relaxed">
                        Under the leadership of Dr. Praveen Gupta, Marengo Asia Hospital, Gurgaon has launched a state-of-the-art 24/7 Stroke Response Center.
                    </p>
                </div>
                <div class="pt-6 border-t border-slate-200/60 mt-6 flex justify-between items-center">
                    <span class="text-xs text-dark-grey/45">Gurgaon Campus</span>
                    <span class="text-xs font-semibold text-electric-blue">Read More <i class="fas fa-chevron-right text-[8px] ml-1"></i></span>
                </div>
            </div>

            <!-- Update 2 -->
            <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-6 md:p-8 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div class="space-y-4">
                    <span class="text-xs text-electric-blue font-bold uppercase tracking-wider">Awareness Camp</span>
                    <span class="block text-xs text-dark-grey/40">02 June 2026</span>
                    <h3 class="text-xl font-bold text-dark-grey leading-snug">World Brain Day Awareness Initiative</h3>
                    <p class="text-sm text-dark-grey/65 leading-relaxed">
                        Join our free consultation camp and EEG screening initiative on World Brain Day, aiming to spread awareness on chronic headaches and dementia.
                    </p>
                </div>
                <div class="pt-6 border-t border-slate-200/60 mt-6 flex justify-between items-center">
                    <span class="text-xs text-dark-grey/45">Patient Awareness</span>
                    <span class="text-xs font-semibold text-electric-blue">Read More <i class="fas fa-chevron-right text-[8px] ml-1"></i></span>
                </div>
            </div>

            <!-- Update 3 -->
            <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-6 md:p-8 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div class="space-y-4">
                    <span class="text-xs text-electric-blue font-bold uppercase tracking-wider">Research Publication</span>
                    <span class="block text-xs text-dark-grey/40">18 May 2026</span>
                    <h3 class="text-xl font-bold text-dark-grey leading-snug">New Study on Epilepsy Medication</h3>
                    <p class="text-sm text-dark-grey/65 leading-relaxed">
                        Dr. Praveen Gupta's clinical study on drug-resistant epilepsy has been accepted for publication in the International Journal of Neurology.
                    </p>
                </div>
                <div class="pt-6 border-t border-slate-200/60 mt-6 flex justify-between items-center">
                    <span class="text-xs text-dark-grey/45">Clinical Research</span>
                    <span class="text-xs font-semibold text-electric-blue">Read More <i class="fas fa-chevron-right text-[8px] ml-1"></i></span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
