<?php
/**
 * Media Coverage Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Media Coverage</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-tv text-[10px]"></i>
                <span>TV Interviews & Press Coverage</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Media <span class="text-white font-normal">Coverage & Appearances</span>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Dr. Praveen Gupta is a regular health panelist on top national TV channels and writes health columns in major English and Hindi newspapers.
            </p>
        </div>
    </div>
</section>

<!-- Media Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-10" id="media-filters">
            <button class="filter-btn active px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-300 bg-electric-blue text-white border-electric-blue shadow-md" data-filter="all">
                All Media
            </button>
            <button class="filter-btn px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" data-filter="tv">
                TV Appearances
            </button>
            <button class="filter-btn px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" data-filter="print">
                Print Publications
            </button>
        </div>

        <!-- Media Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="media-grid">
            <!-- TV 1 -->
            <div class="media-item tv bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="relative w-full aspect-video bg-black">
                    <iframe class="w-full h-full border-0" src="https://www.youtube.com/embed/sXl0eyou7EU?rel=0" title="TV Interview 1" allowfullscreen loading="lazy"></iframe>
                </div>
                <div class="p-6">
                    <span class="text-xs text-red-500 font-bold uppercase tracking-wider">NDTV News Panel</span>
                    <h4 class="font-bold text-dark-grey text-base mt-1">Understanding Brain Stroke Guidelines</h4>
                    <p class="text-xs text-dark-grey/55 mt-2 leading-relaxed">
                        Dr. Praveen Gupta explains the F.A.S.T. stroke protocol and the critical golden hour for stroke recovery.
                    </p>
                </div>
            </div>

            <!-- TV 2 -->
            <div class="media-item tv bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="relative w-full aspect-video bg-black">
                    <iframe class="w-full h-full border-0" src="https://www.youtube.com/embed/h50wGaV1y9Q?rel=0" title="TV Interview 2" allowfullscreen loading="lazy"></iframe>
                </div>
                <div class="p-6">
                    <span class="text-xs text-red-500 font-bold uppercase tracking-wider">Aaj Tak Channel</span>
                    <h4 class="font-bold text-dark-grey text-base mt-1">Preventing Lifestyle Headaches</h4>
                    <p class="text-xs text-dark-grey/55 mt-2 leading-relaxed">
                        Panel discussion detailing the causes of rising chronic migraines in corporate professionals.
                    </p>
                </div>
            </div>

            <!-- Print 1 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div class="p-6 space-y-3">
                    <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                        <span>Hindustan Times</span>
                        <span class="text-dark-grey/40 font-normal">24 May 2026</span>
                    </div>
                    <h4 class="font-bold text-dark-grey text-base leading-snug">Rising Dementia Rates in Elderly</h4>
                    <p class="text-xs text-dark-grey/55 leading-relaxed">
                        Dr. Praveen Gupta highlights how cognitive assessments and early mental exercises can delay the progression of Alzheimer's.
                    </p>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 mt-4 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Brain Aging</span>
                    <span class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Summary</span>
                </div>
            </div>

            <!-- Print 2 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div class="p-6 space-y-3">
                    <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                        <span>Times of India</span>
                        <span class="text-dark-grey/40 font-normal">12 April 2026</span>
                    </div>
                    <h4 class="font-bold text-dark-grey text-base leading-snug">Deep Brain Stimulation (DBS) for Parkinson's</h4>
                    <p class="text-xs text-dark-grey/55 leading-relaxed">
                        Dr. Praveen Gupta details the advanced surgical DBS protocol that helps control Parkinson's tremors.
                    </p>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 mt-4 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: DBS / Parkinson's</span>
                    <span class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Summary</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Script -->
<script>
    document.querySelectorAll('#media-filters .filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active styles from all buttons
            document.querySelectorAll('#media-filters .filter-btn').forEach(b => {
                b.classList.remove('bg-electric-blue', 'text-white', 'border-electric-blue', 'shadow-md');
                b.classList.add('bg-white', 'text-dark-grey/70', 'border-slate-200');
            });
            
            // Add active styles to clicked button
            btn.classList.add('bg-electric-blue', 'text-white', 'border-electric-blue', 'shadow-md');
            btn.classList.remove('bg-white', 'text-dark-grey/70', 'border-slate-200');
            
            const filter = btn.getAttribute('data-filter');
            document.querySelectorAll('#media-grid .media-item').forEach(item => {
                if (filter === 'all' || item.classList.contains(filter)) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
