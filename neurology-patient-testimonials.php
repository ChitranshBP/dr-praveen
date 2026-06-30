<?php
/**
 * Testimonials Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Testimonials</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-star text-amber-400 text-[10px]"></i>
                <span>Patient Stories & Reviews</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Patient <span class="text-white font-normal">Success Stories</span>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Read inspiring recovery stories from patients treated by Dr. Praveen Gupta for various complex neurological conditions.
            </p>
        </div>
    </div>
</section>

<!-- Stats Grid -->
<section class="py-6 bg-slate-50 border-b border-slate-200/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-4">
                <span class="block text-3xl md:text-4xl font-extrabold text-electric-blue">20+</span>
                <span class="text-xs md:text-sm text-dark-grey/60 font-medium mt-1 block">Years of Excellence</span>
            </div>
            <div class="p-4">
                <span class="block text-3xl md:text-4xl font-extrabold text-cyan-accent">10,000+</span>
                <span class="text-xs md:text-sm text-dark-grey/60 font-medium mt-1 block">Happy Patients</span>
            </div>
            <div class="p-4">
                <span class="block text-3xl md:text-4xl font-extrabold text-deep-indigo">4.9/5</span>
                <span class="text-xs md:text-sm text-dark-grey/60 font-medium mt-1 block">Google Rating</span>
            </div>
            <div class="p-4">
                <span class="block text-3xl md:text-4xl font-extrabold text-[#00a86b]">98%</span>
                <span class="text-xs md:text-sm text-dark-grey/60 font-medium mt-1 block">Stroke Recovery Rate</span>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Grid -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-6 md:p-8 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center space-x-1 text-amber-400">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-sm text-dark-grey/75 italic leading-relaxed">
                        "My father was admitted under Dr. Praveen Gupta after a sudden brain stroke. His quick decision-making and mechanical thrombectomy procedure saved my father's life. Today, he is walking and talking normally. We are forever grateful to Dr. Praveen."
                    </p>
                </div>
                <div class="flex items-center space-x-3 pt-6 border-t border-slate-200/60 mt-6">
                    <div class="w-10 h-10 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue font-bold text-sm">
                        R
                    </div>
                    <div>
                        <h4 class="font-bold text-dark-grey text-sm">Rajesh Kumar</h4>
                        <span class="text-xs text-electric-blue font-semibold">Brain Stroke Survivor's Son</span>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-6 md:p-8 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center space-x-1 text-amber-400">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-sm text-dark-grey/75 italic leading-relaxed">
                        "I suffered from chronic migraine for over 7 years. I consulted many doctors but got no relief. After consulting Dr. Praveen Gupta, my migraine frequency has dropped from daily to almost zero. His treatment plan has changed my life."
                    </p>
                </div>
                <div class="flex items-center space-x-3 pt-6 border-t border-slate-200/60 mt-6">
                    <div class="w-10 h-10 bg-cyan-accent/10 rounded-full flex items-center justify-center text-cyan-accent font-bold text-sm">
                        S
                    </div>
                    <div>
                        <h4 class="font-bold text-dark-grey text-sm">Sneha Sharma</h4>
                        <span class="text-xs text-cyan-accent font-semibold">Chronic Migraine Patient</span>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-6 md:p-8 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center space-x-1 text-amber-400">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-sm text-dark-grey/75 italic leading-relaxed">
                        "Dr. Praveen Gupta successfully managed my daughter's drug-resistant epilepsy. Her seizures are now completely controlled, and she has started attending school regularly. Thank you so much for the care and support!"
                    </p>
                </div>
                <div class="flex items-center space-x-3 pt-6 border-t border-slate-200/60 mt-6">
                    <div class="w-10 h-10 bg-deep-indigo/10 rounded-full flex items-center justify-center text-deep-indigo font-bold text-sm">
                        P
                    </div>
                    <div>
                        <h4 class="font-bold text-dark-grey text-sm">Pooja Verma</h4>
                        <span class="text-xs text-deep-indigo font-semibold">Parent of Epilepsy Patient</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-12 bg-[#edf5f9] border-t border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-2xl md:text-3xl font-bold text-dark-grey">Share Your Recovery Story</h2>
        <p class="text-dark-grey/65 text-sm md:text-base leading-relaxed max-w-2xl mx-auto">
            Your journey can inspire others going through similar neurological challenges. If you have been treated by Dr. Praveen Gupta, we would love to hear your feedback.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="contact-us-top-neurologist-delhi-ncr.php" class="bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold px-6 py-3.5 rounded-xl shadow-lg hover:shadow-electric-blue/20 transition-all duration-300">
                Submit Feedback
            </a>
            <a href="https://g.page/r/dr-praveen-gupta-neurologist/review" target="_blank" class="bg-white border border-slate-200 text-dark-grey font-semibold px-6 py-3.5 rounded-xl hover:bg-slate-50 transition-all duration-300 inline-flex items-center space-x-2">
                <i class="fab fa-google text-red-500"></i>
                <span>Review on Google</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
