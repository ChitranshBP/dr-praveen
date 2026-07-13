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
        <!-- Media Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="media-grid">

            <!-- Print 1: India TV -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/dr-praveen-1.png" alt="India TV Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>India TV</span>
                            <span class="text-dark-grey/40 font-normal">Feb 2026</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Union Budget 2026: Healthcare Expectations</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Dr. Praveen Gupta weighs in on the healthcare allocations and expectations from the newly declared budget.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Policy / Budget</span>
                    <a href="https://www.indiatv.in/health/budget-2026-increased-hopes-or-disappointment-in-the-healthcare-sector-know-what-doctors-had-to-say-about-the-budget-2026-02-01-1194907" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 2: Business World -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/dr-praveen.png" alt="Business World Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Business World</span>
                            <span class="text-dark-grey/40 font-normal">Feb 2026</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Budget 2026: Reforms in Healthcare Tourism</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Detailed overview of clinical Allied Professionals rules and their impact on Indian medical tourism.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Medical Tourism</span>
                    <a href="https://www.bwhindi.com/business-news/budget-2026-major-reforms-in-the-healthcare-sector-government-emphasizes-allied-professionals-and-medical-tourism-68547.html" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 3: Outlook India -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/dr-praveen-jan.png" alt="Outlook India Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Outlook India</span>
                            <span class="text-dark-grey/40 font-normal">Jan 2026</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Future Forward Leadership: Building Tomorrow</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Feature naming Dr. Praveen Gupta among key business and medical minds shaping healthcare systems.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Leadership</span>
                    <a href="https://www.outlookindia.com/hub4business/future-forward-leadership-10-business-minds-building-tomorrow" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 4: LiveMint -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/regwe4r.png" alt="LiveMint Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>LiveMint</span>
                            <span class="text-dark-grey/40 font-normal">May 2024</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Doctors Caution About Heatstroke Warnings</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Urgent guidelines from leading medical staff about avoiding extreme heatwave exposures in North India.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Heatstroke</span>
                    <a href="https://www.livemint.com/politics/policy/doctors-caution-about-heatstroke-amid-imd-warning-of-severe-heatwave-11716382298842.html" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 5: Indian Express -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/gsdg.jpg" alt="Indian Express Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Indian Express</span>
                            <span class="text-dark-grey/40 font-normal">May 2024</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Hospitals Step Up Heat Illness Readiness</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Details on emergency department updates and clinical setups across NCR for treating heat stress.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Clinical Care</span>
                    <a href="https://indianexpress.com/article/cities/delhi/heat-related-illnesses-on-the-rise-delhi-hospitals-step-up-preparedness-9346169/" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 6: TheHealthSite -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/yrhjfbt.png" alt="TheHealthSite Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>TheHealthSite</span>
                            <span class="text-dark-grey/40 font-normal">May 2024</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Impact of Heatwaves on Brain Functions</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            How severe thermal stress impacts neurotransmitter balance, cerebral flow, and early warning flags.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Brain Health</span>
                    <a href="https://www.thehealthsite.com/diseases-conditions/impact-of-heat-wave-on-brain-and-nervous-system-neurologist-shares-key-signs-and-safety-measures-1093776/amp/" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 7: Daijiworld 1 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/article_8.jpg" alt="Daijiworld Article 1" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Daijiworld</span>
                            <span class="text-dark-grey/40 font-normal">May 2024</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Stroke Rates Escalate with Rising Summer Temperatures</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Explains how severe dehydration spikes blood viscosity, increasing acute stroke risks among seniors.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Stroke Risks</span>
                    <a href="https://www.daijiworld.com/news/newsDisplay?newsID=1189431" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 8: Daijiworld 2 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/article_9.jpg" alt="Daijiworld Article 2" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Daijiworld</span>
                            <span class="text-dark-grey/40 font-normal">May 2024</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Preventative Steps Against Neurological Stress</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Part two of our summer neuro-care review detailing fluid charts, nutrition plans, and cooling steps.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Prevention</span>
                    <a href="https://www.daijiworld.com/news/newsDisplay?newsID=1189431" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 9: Zee News -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/world-liver-day.jpg" alt="Zee News Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Zee News</span>
                            <span class="text-dark-grey/40 font-normal">April 2025</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Fatty Liver Disease Emerging Epidemic in Youth</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Discussing the alarming spike in non-alcoholic metabolic conditions linked directly to long desk hours.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Lifestyle Health</span>
                    <a href="https://zeenews.india.com/hindi/health/world-liver-day-fatty-liver-is-emerging-as-a-new-epidemic-among-youth-due-to-long-sitting-hour/2722990" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 10: Poorvanchal Media -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/fatty-liver-disease.jpg" alt="Poorvanchal Media Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Poorvanchal Media</span>
                            <span class="text-dark-grey/40 font-normal">April 2025</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Metabolic Dysfunction and Brain Linkages</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Understanding how hepatic inflammation and fatty tissues alter cerebral circulation and cognitive performance.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Metabolic Health</span>
                    <a href="https://poorvanchalmedia.com/health-news-hindi/non-alcoholic-fatty-liver-disease-became-a-serious-problem/" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 11: HealthTekPak -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/epidemic.jpg" alt="HealthTekPak Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>HealthTekPak</span>
                            <span class="text-dark-grey/40 font-normal">April 2025</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Fatty Liver & Sedentary Risks in Young Professionals</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            How chronic sitting and lack of daily exercise impact general wellness and raise corporate health risks.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Diagnostics</span>
                    <a href="https://healthtekpak.com/diagnostics/fatty-liver-emerging-as-a-new-epidemic-among-youth/" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 12: India Today Podcast -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/health-wealth.jpg" alt="India Today Podcast" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>India Today</span>
                            <span class="text-dark-grey/40 font-normal">March 2025</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Returning to Work Safely After Surgery</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Guidelines on rehabilitation pathways and safety precautions when returning to active work post-surgery.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Podcast / Recovery</span>
                    <a href="https://podcasts.indiatoday.in/health/health-wealth/when-can-i-return-to-work-after-a-surgery-health-wealth-ep-85-1178632-2025-03-03" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Listen Episode</a>
                </div>
            </div>

            <!-- Print 13: The Week -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/liver.jpg" alt="The Week Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>The Week</span>
                            <span class="text-dark-grey/40 font-normal">April 2025</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">World Liver Day: New Risks Beyond Drinking</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Reviewing dietary risk indices, food additives, and non-alcoholic factors triggering hepatic failures.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Liver Care</span>
                    <a href="https://www.theweek.in/news/health/2025/04/19/world-liver-day-2025-what-can-save-your-liver-as-new-risks-beyond-drinking-emerges.html" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 14: Morung Express -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/theyr5y5.png" alt="Morung Express Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Morung Express</span>
                            <span class="text-dark-grey/40 font-normal">Aug 2025</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Asthma & Its Negative Impact on Brain Functions</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Clinical reports indicating how chronic breathing constraints alter oxygenation levels in active brain areas.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Cognitive Health</span>
                    <a href="https://morungexpress.com/asthma-can-negatively-affect-brain-functions-experts" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 15: News Patrolling -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/liver-day.jpg" alt="News Patrolling Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>News Patrolling</span>
                            <span class="text-dark-grey/40 font-normal">April 2025</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Managing Sedentary Risks & Metabolic Syndrome</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Expert analysis on designing active intervals during office shifts to combat chronic organ strain.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Wellness</span>
                    <a href="https://newspatrolling.com/world-liver-day/" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 16: TheHealthSite 2 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/fatty-liver.jpg" alt="TheHealthSite Article 2" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>TheHealthSite</span>
                            <span class="text-dark-grey/40 font-normal">April 2025</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Lack of Sleep, Diet, and Cellular Liver Destruction</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            How chronic insomnia combined with processed fats causes fat accumulation in vital organs.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Metabolic Stress</span>
                    <a href="https://www.thehealthsite.com/diseases-conditions/world-liver-day-2025-fatty-liver-epidemic-in-india-how-sedentary-lifestyle-lack-of-sleep-and-poor-diet-are-silently-destroying-your-liver-health-1208972/" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Print 17: Firstpost -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/liver-disease.jpg" alt="Firstpost Article" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Firstpost</span>
                            <span class="text-dark-grey/40 font-normal">April 2025</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Desk Jobs and Non-Alcoholic Fatty Liver Risks</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Reviewing systemic metabolic shifts triggered by continuous sitting and lack of core movement.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Desk Job Health</span>
                    <a href="https://www.firstpost.com/health/is-a-desk-job-increasing-your-risk-of-non-alcoholic-fatty-liver-disease-13881054.html" target="_blank" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300">Read Article</a>
                </div>
            </div>

            <!-- Additional Print 18: Article 6 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/article_6.jpg" alt="Clinical Diagnosis" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Press Release</span>
                            <span class="text-dark-grey/40 font-normal">Clinical Update</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Diagnostic Accuracy in Complex Brain Anomalies</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Review of new diagnostic protocols for diagnosing rare structural anomalies.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Brain Diagnostics</span>
                    <span class="text-xs text-dark-grey/40">In-house Update</span>
                </div>
            </div>

            <!-- Additional Print 19: er3gy4r3 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/er3gy4r3.png" alt="Stroke Interventions" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Clinical Update</span>
                            <span class="text-dark-grey/40 font-normal">Stroke Code</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Advanced Stroke Unit Urgent Interventions</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            How multidisciplinary emergency units act fast during golden-hour windows to reverse stroke symptoms.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Stroke Care</span>
                    <span class="text-xs text-dark-grey/40">Triage Protocols</span>
                </div>
            </div>

            <!-- Additional Print 20: th4h6r6 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/th4h6r6.png" alt="Recovery Protocols" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Rehab News</span>
                            <span class="text-dark-grey/40 font-normal">Patient Care</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Neurological Patient Recovery Protocols</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            A look into clinical rehabilitation methods that target motor and cognitive recovery.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Rehabilitation</span>
                    <span class="text-xs text-dark-grey/40">Recovery Paths</span>
                </div>
            </div>

            <!-- Additional Print 21: article_5 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/article_5.jpg" alt="Parkinson's Disease" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Clinical Focus</span>
                            <span class="text-dark-grey/40 font-normal">Parkinson's</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Early Intervention in Parkinson's Disease</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            How early clinical therapy helps manage Parkinson's progression and tremor severity.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Parkinson's</span>
                    <span class="text-xs text-dark-grey/40">Early Care</span>
                </div>
            </div>

            <!-- Additional Print 22: article_4 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/article_4.jpg" alt="Spinal Traumas" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Spine Focus</span>
                            <span class="text-dark-grey/40 font-normal">Clinical Care</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Preventing Chronic Spinal Traumas</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            Essential clinical guides to maintaining core health and posture during long desktop jobs.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Spine Health</span>
                    <span class="text-xs text-dark-grey/40">Prevention Tips</span>
                </div>
            </div>

            <!-- Additional Print 23: article_2 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/article_2.jpg" alt="Refractory Epilepsy" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Epilepsy Focus</span>
                            <span class="text-dark-grey/40 font-normal">Epilepsy</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Management of Refractory Epilepsy Attacks</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            A breakdown of clinical paths for drug-resistant seizures using advanced diagnostic options.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Epilepsy</span>
                    <span class="text-xs text-dark-grey/40">Clinical Paths</span>
                </div>
            </div>

            <!-- Additional Print 24: article_1 -->
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="assets/media/article_1.jpg" alt="Pain Pathways" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span>Pain Focus</span>
                            <span class="text-dark-grey/40 font-normal">Headache</span>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug">Understanding Neurological Pain Pathways</h4>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            How our team identifies and treats chronic headache pain and neuropathic discomfort.
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40">Topic: Pain Care</span>
                    <span class="text-xs text-dark-grey/40">Diagnostics</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
