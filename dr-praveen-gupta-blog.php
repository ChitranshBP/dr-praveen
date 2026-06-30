<?php
/**
 * Blog Hub Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Blog</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-book-open text-[10px]"></i>
                <span>Healthy Brain Guides & Articles</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                The Neurology <span class="text-white font-normal">Blog</span>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Expert guides, healthy lifestyle tips, and detailed neuro-health columns curated directly by Dr. Praveen Gupta.
            </p>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-8">
            <!-- Left Side: Blog List (8 columns) -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Blog Post 1 -->
                <article class="bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 grid md:grid-cols-12 gap-6 p-6">
                    <div class="md:col-span-5 aspect-video md:aspect-square bg-slate-200 rounded-2xl overflow-hidden">
                        <img src="assets/services/stroke.webp" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Brain Stroke" loading="lazy">
                    </div>
                    <div class="md:col-span-7 flex flex-col justify-between py-2">
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3 text-xs">
                                <span class="bg-electric-blue/10 text-electric-blue font-semibold px-2.5 py-1 rounded-md">Stroke Care</span>
                                <span class="text-dark-grey/40">June 28, 2026</span>
                            </div>
                            <h3 class="text-xl font-bold text-dark-grey leading-snug hover:text-electric-blue transition-colors duration-300">
                                <a href="#">Understanding the 24-Hour Recovery Window in Stroke Patients</a>
                            </h3>
                            <p class="text-sm text-dark-grey/65 leading-relaxed line-clamp-3">
                                Why time is of the absolute essence when a stroke hits. A deep dive into modern mechanical thrombectomy procedures and recovery outcomes.
                            </p>
                        </div>
                        <div class="pt-4 flex items-center justify-between text-xs text-dark-grey/50">
                            <span>By Dr. Praveen Gupta</span>
                            <a href="#" class="font-semibold text-electric-blue hover:text-deep-indigo transition-colors">Read Article <i class="fas fa-chevron-right text-[8px] ml-1"></i></a>
                        </div>
                    </div>
                </article>

                <!-- Blog Post 2 -->
                <article class="bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 grid md:grid-cols-12 gap-6 p-6">
                    <div class="md:col-span-5 aspect-video md:aspect-square bg-slate-200 rounded-2xl overflow-hidden">
                        <img src="assets/services/migraine.webp" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Migraine Relief" loading="lazy">
                    </div>
                    <div class="md:col-span-7 flex flex-col justify-between py-2">
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3 text-xs">
                                <span class="bg-cyan-accent/10 text-cyan-accent font-semibold px-2.5 py-1 rounded-md">Headache Relief</span>
                                <span class="text-dark-grey/40">June 15, 2026</span>
                            </div>
                            <h3 class="text-xl font-bold text-dark-grey leading-snug hover:text-electric-blue transition-colors duration-300">
                                <a href="#">Can Lifestyle Adjustments Cure Chronic Migraine?</a>
                            </h3>
                            <p class="text-sm text-dark-grey/65 leading-relaxed line-clamp-3">
                                Discover triggers like dietary choices, sleeping schedules, and computer screen exposure, and explore non-invasive clinical remedies.
                            </p>
                        </div>
                        <div class="pt-4 flex items-center justify-between text-xs text-dark-grey/50">
                            <span>By Dr. Praveen Gupta</span>
                            <a href="#" class="font-semibold text-electric-blue hover:text-deep-indigo transition-colors">Read Article <i class="fas fa-chevron-right text-[8px] ml-1"></i></a>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Right Side: Sidebar (4 columns) -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Sidebar Category Block -->
                <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-6 md:p-8">
                    <h4 class="font-bold text-dark-grey text-base mb-4 pb-2 border-b border-slate-200/80">Blog Categories</h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex justify-between items-center text-sm font-semibold text-dark-grey/70 hover:text-electric-blue transition-colors">
                                <span>Stroke Care</span>
                                <span class="bg-white border border-slate-200/60 px-2 py-0.5 rounded text-xs text-dark-grey/50">14</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center text-sm font-semibold text-dark-grey/70 hover:text-electric-blue transition-colors">
                                <span>Epilepsy & Seizures</span>
                                <span class="bg-white border border-slate-200/60 px-2 py-0.5 rounded text-xs text-dark-grey/50">8</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center text-sm font-semibold text-dark-grey/70 hover:text-electric-blue transition-colors">
                                <span>Parkinson's & DBS</span>
                                <span class="bg-white border border-slate-200/60 px-2 py-0.5 rounded text-xs text-dark-grey/50">11</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between items-center text-sm font-semibold text-dark-grey/70 hover:text-electric-blue transition-colors">
                                <span>Headache & Migraine</span>
                                <span class="bg-white border border-slate-200/60 px-2 py-0.5 rounded text-xs text-dark-grey/50">19</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter Subscription -->
                <div class="bg-gradient-to-br from-deep-indigo to-dark-grey rounded-3xl p-6 md:p-8 text-white">
                    <h4 class="font-bold text-lg mb-2">Subscribe to Newsletter</h4>
                    <p class="text-xs text-white/70 leading-relaxed mb-6">
                        Stay updated with healthy brain guidelines and latest clinical updates.
                    </p>
                    <form class="space-y-3">
                        <input type="email" required placeholder="Your email address" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-cyan-accent text-sm text-white placeholder-white/40">
                        <button type="submit" class="w-full bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold py-3 rounded-xl hover:shadow-lg transition-all duration-300">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
