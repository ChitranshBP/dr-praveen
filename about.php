<?php
/**
 * About Page - Dr. Praveen Gupta
 */
require_once __DIR__ . '/includes/header.php';
?>

<!-- About Page Hero -->
<section class="relative overflow-hidden bg-white">
    <div class="absolute inset-0 -z-0">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-cyan-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-electric-blue/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 text-xs text-dark-grey/50 mb-8 animate-fade-in tracking-wide uppercase">
            <a href="index.php" class="hover:text-electric-blue transition-colors">Home</a>
            <span class="text-cyan-accent">/</span>
            <span class="text-electric-blue font-semibold">About</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Left Content -->
            <div class="lg:col-span-7">
                <div class="inline-flex items-center space-x-2 mb-6 animate-fade-in-up">
                    <span class="w-8 h-px bg-electric-blue"></span>
                    <span class="text-electric-blue text-xs font-semibold tracking-[0.2em] uppercase">Neurologist • Chairman MAIINS</span>
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif font-bold text-deep-indigo leading-[1.05] mb-6 animate-fade-in-up tracking-tight" style="animation-delay: 100ms;">
                    Dr. Praveen
                    <span class="block gradient-text">Gupta</span>
                </h1>

                <p class="text-lg md:text-xl text-dark-grey/70 mb-6 leading-relaxed max-w-xl font-light animate-fade-in-up" style="animation-delay: 200ms;">
                    A leading neurologist with over <span class="text-deep-indigo font-medium">20 years</span> of experience pioneering advanced treatments in stroke, epilepsy, and movement disorders.
                </p>

                <!-- Minimal meta -->
                <div class="flex flex-wrap items-center gap-x-8 gap-y-3 mb-7 text-sm text-dark-grey/60 animate-fade-in-up" style="animation-delay: 300ms;">
                    <span class="flex items-center space-x-2">
                        <i class="fas fa-graduation-cap text-cyan-accent"></i>
                        <span>MBBS, MD</span>
                    </span>
                    <span class="flex items-center space-x-2">
                        <i class="fas fa-hospital text-cyan-accent"></i>
                        <span>Marengo Asia</span>
                    </span>
                    <span class="flex items-center space-x-2">
                        <i class="fas fa-award text-cyan-accent"></i>
                        <span>First DBS, Gurugram</span>
                    </span>
                </div>

                <!-- CTAs -->
                <div class="flex flex-wrap items-center gap-4 animate-fade-in-up" style="animation-delay: 400ms;">
                    <a href="contact.php" class="group inline-flex items-center space-x-3 bg-deep-indigo text-white text-sm font-medium pl-6 pr-2 py-2.5 rounded-full hover:bg-electric-blue transition-colors duration-300">
                        <span>Book Consultation</span>
                        <span class="w-7 h-7 rounded-full bg-white/10 group-hover:bg-white/20 flex items-center justify-center transition-colors">
                            <i class="fas fa-arrow-right text-[10px] group-hover:rotate-45 transition-transform duration-300"></i>
                        </span>
                    </a>
                    <a href="#specializations" class="group text-sm font-medium text-deep-indigo hover:text-electric-blue transition-colors flex items-center space-x-2">
                        <span>Specializations</span>
                        <i class="fas fa-arrow-down text-xs group-hover:translate-y-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Right - Doctor Portrait -->
            <div class="lg:col-span-5 animate-fade-in" style="animation-delay: 200ms;">
                <div class="relative max-w-sm mx-auto">
                    <!-- Soft glow -->
                    <div class="absolute -inset-4 bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 rounded-3xl blur-2xl"></div>

                    <!-- Portrait image with gradient frame -->
                    <div class="relative aspect-[4/5] rounded-3xl overflow-hidden shadow-xl bg-gradient-to-br from-deep-indigo to-electric-blue p-1">
                        <div class="relative w-full h-full rounded-[1.4rem] overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent">
                            <img src="assets/dpg-1.webp" alt="Dr. Praveen Gupta" class="absolute inset-0 w-full h-full object-cover">
                            <!-- Subtle gradient overlay for legibility -->
                            <div class="absolute inset-0 bg-gradient-to-t from-deep-indigo/60 via-transparent to-transparent"></div>

                            <!-- Bottom info -->
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <p class="text-cyan-200 text-xs tracking-widest uppercase">Chairman</p>
                                <p class="text-white font-serif text-lg font-semibold mt-1">Marengo Asia Neuro & Spine</p>
                            </div>
                        </div>
                    </div>

                    <!-- Small floating badge -->
                    <div class="absolute -top-3 -right-3 w-14 h-14 rounded-full bg-white shadow-lg flex items-center justify-center border border-silver-grey/50">
                        <i class="fas fa-award text-cyan-accent text-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Minimal Stats Strip -->
<section class="py-12 border-y border-silver-grey/60 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-silver-grey/60">
            <div class="text-center px-4 py-4">
                <div class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo">20+</div>
                <div class="text-xs text-dark-grey/60 mt-1 tracking-wide uppercase">Years</div>
            </div>
            <div class="text-center px-4 py-4">
                <div class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo">500K+</div>
                <div class="text-xs text-dark-grey/60 mt-1 tracking-wide uppercase">Patients</div>
            </div>
            <div class="text-center px-4 py-4">
                <div class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo">70+</div>
                <div class="text-xs text-dark-grey/60 mt-1 tracking-wide uppercase">Publications</div>
            </div>
            <div class="text-center px-4 py-4">
                <div class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo">4.9</div>
                <div class="text-xs text-dark-grey/60 mt-1 tracking-wide uppercase">Rating</div>
            </div>
        </div>
    </div>
</section>

<!-- About / Bio Section with Image -->
<section class="py-14 lg:py-20 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            <!-- Single Image -->
            <div class="lg:col-span-5 order-2 lg:order-1">
                <div class="relative max-w-md mx-auto">
                    <!-- Main single image -->
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden shadow-xl ring-1 ring-silver-grey/50">
                        <img src="assets/awards/AWARD-PRAVEEN.webp" alt="Dr. Praveen Gupta Award Recognition" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                    </div>
                    <!-- Decorative gradient blobs -->
                    <div class="absolute -top-4 -left-4 w-24 h-24 rounded-full bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 blur-xl -z-10"></div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 rounded-full bg-gradient-to-br from-cyan-accent/20 to-electric-blue/20 blur-xl -z-10"></div>
                </div>
            </div>

            <!-- Text -->
            <div class="lg:col-span-7 order-1 lg:order-2">
                <div class="inline-flex items-center space-x-2 mb-6">
                    <span class="w-8 h-px bg-electric-blue"></span>
                    <span class="text-electric-blue text-xs font-semibold tracking-[0.2em] uppercase">About</span>
                </div>

                <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo mb-5 leading-tight">
                    Pioneering the Future of <span class="gradient-text">Neurology in India</span>
                </h2>

                <p class="text-base text-dark-grey/70 mb-4 leading-relaxed">
                    Driven by passion and precision, Dr. Gupta has played a pioneering role in shaping the future of neurology in India. He established <strong class="text-deep-indigo">Gurgaon's first dedicated stroke centre</strong> and became the first neurologist to perform solo mechanical thrombolysis in the region.
                </p>

                <p class="text-base text-dark-grey/70 leading-relaxed">
                    His groundbreaking achievements include conducting the <strong class="text-deep-indigo">first Deep Brain Stimulation (DBS) procedure in Gurugram</strong> and performing the <strong class="text-deep-indigo">first epileptic DBS in Asia</strong> — setting new benchmarks for neurological innovation.
                </p>

                <!-- Key Highlights Grid -->
                <div class="grid grid-cols-2 gap-3 mt-7">
                    <div class="group flex items-start space-x-3 p-3 rounded-xl bg-soft-cyan/50 border border-silver-grey/40 hover:border-electric-blue/40 hover:bg-white transition-all duration-300">
                        <span class="w-9 h-9 rounded-lg bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 transition-colors">
                            <i class="fas fa-bolt text-electric-blue group-hover:text-white text-xs transition-colors"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-deep-indigo text-xs leading-tight">Pioneer of Stroke Care</p>
                            <p class="text-dark-grey/60 text-[11px] mt-0.5">Gurgaon's 1st stroke centre</p>
                        </div>
                    </div>
                    <div class="group flex items-start space-x-3 p-3 rounded-xl bg-soft-cyan/50 border border-silver-grey/40 hover:border-electric-blue/40 hover:bg-white transition-all duration-300">
                        <span class="w-9 h-9 rounded-lg bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 transition-colors">
                            <i class="fas fa-brain text-electric-blue group-hover:text-white text-xs transition-colors"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-deep-indigo text-xs leading-tight">First DBS, Gurugram</p>
                            <p class="text-dark-grey/60 text-[11px] mt-0.5">Deep brain stimulation</p>
                        </div>
                    </div>
                    <div class="group flex items-start space-x-3 p-3 rounded-xl bg-soft-cyan/50 border border-silver-grey/40 hover:border-electric-blue/40 hover:bg-white transition-all duration-300">
                        <span class="w-9 h-9 rounded-lg bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 transition-colors">
                            <i class="fas fa-globe-asia text-electric-blue group-hover:text-white text-xs transition-colors"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-deep-indigo text-xs leading-tight">First Epileptic DBS, Asia</p>
                            <p class="text-dark-grey/60 text-[11px] mt-0.5">Continental benchmark</p>
                        </div>
                    </div>
                    <div class="group flex items-start space-x-3 p-3 rounded-xl bg-soft-cyan/50 border border-silver-grey/40 hover:border-electric-blue/40 hover:bg-white transition-all duration-300">
                        <span class="w-9 h-9 rounded-lg bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 transition-colors">
                            <i class="fas fa-stethoscope text-electric-blue group-hover:text-white text-xs transition-colors"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-deep-indigo text-xs leading-tight">20+ Years of Practice</p>
                            <p class="text-dark-grey/60 text-[11px] mt-0.5">Neurology expertise</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Clinical Excellence Section with Service Images -->
<section id="specializations" class="py-14 lg:py-20 bg-soft-cyan/30 relative overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center space-x-2 mb-6">
                <span class="w-8 h-px bg-electric-blue"></span>
                <span class="text-electric-blue text-xs font-semibold tracking-[0.2em] uppercase">Clinical Excellence</span>
                <span class="w-8 h-px bg-electric-blue"></span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4 leading-tight">
                Areas of <span class="gradient-text">Expertise</span>
            </h2>
            <p class="text-base text-dark-grey/70 max-w-2xl mx-auto leading-relaxed">
                A deep commitment to patient-centric care and innovation has shaped comprehensive stroke, epilepsy, and movement disorder programs — setting new benchmarks in neurology.
            </p>
        </div>

        <!-- Specialty Cards with Images -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Stroke -->
            <div class="group bg-white rounded-2xl overflow-hidden border border-silver-grey/50 hover:shadow-xl transition-all duration-500">
                <div class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/services/stroke.png" alt="Stroke & Vascular Neurology"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-9 h-9 rounded-full border border-electric-blue/30 group-hover:bg-electric-blue group-hover:border-electric-blue flex items-center justify-center transition-all duration-300">
                            <i class="fas fa-heartbeat text-electric-blue group-hover:text-white text-xs transition-colors"></i>
                        </div>
                        <h3 class="text-base font-semibold text-deep-indigo">Stroke & Vascular</h3>
                    </div>
                    <p class="text-sm text-dark-grey/60 leading-relaxed">Pioneer of Gurgaon's first dedicated stroke centre with advanced management protocols.</p>
                </div>
            </div>

            <!-- Epilepsy -->
            <div class="group bg-white rounded-2xl overflow-hidden border border-silver-grey/50 hover:shadow-xl transition-all duration-500">
                <div class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/services/epilepsy.png" alt="Epilepsy & Seizure Management"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-9 h-9 rounded-full border border-electric-blue/30 group-hover:bg-electric-blue group-hover:border-electric-blue flex items-center justify-center transition-all duration-300">
                            <i class="fas fa-bolt text-electric-blue group-hover:text-white text-xs transition-colors"></i>
                        </div>
                        <h3 class="text-base font-semibold text-deep-indigo">Epilepsy & Seizures</h3>
                    </div>
                    <p class="text-sm text-dark-grey/60 leading-relaxed">Performed the first epileptic DBS in Asia — redefining advanced epilepsy treatment.</p>
                </div>
            </div>

            <!-- Movement Disorders -->
            <div class="group bg-white rounded-2xl overflow-hidden border border-silver-grey/50 hover:shadow-xl transition-all duration-500">
                <div class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/services/parkinsons.png" alt="Movement Disorders & Parkinson's"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-9 h-9 rounded-full border border-electric-blue/30 group-hover:bg-electric-blue group-hover:border-electric-blue flex items-center justify-center transition-all duration-300">
                            <i class="fas fa-walking text-electric-blue group-hover:text-white text-xs transition-colors"></i>
                        </div>
                        <h3 class="text-base font-semibold text-deep-indigo">Movement Disorders</h3>
                    </div>
                    <p class="text-sm text-dark-grey/60 leading-relaxed">Conducted the first Deep Brain Stimulation (DBS) procedure in Gurugram.</p>
                </div>
            </div>

            <!-- Headache -->
            <div class="group bg-white rounded-2xl overflow-hidden border border-silver-grey/50 hover:shadow-xl transition-all duration-500">
                <div class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/services/headache.png" alt="Headache & Migraine"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-9 h-9 rounded-full border border-electric-blue/30 group-hover:bg-electric-blue group-hover:border-electric-blue flex items-center justify-center transition-all duration-300">
                            <i class="fas fa-head-side-virus text-electric-blue group-hover:text-white text-xs transition-colors"></i>
                        </div>
                        <h3 class="text-base font-semibold text-deep-indigo">Headache & Migraine</h3>
                    </div>
                    <p class="text-sm text-dark-grey/60 leading-relaxed">Comprehensive therapeutic approaches for chronic and complex headache disorders.</p>
                </div>
            </div>

            <!-- MS -->
            <div class="group bg-white rounded-2xl overflow-hidden border border-silver-grey/50 hover:shadow-xl transition-all duration-500">
                <div class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/services/ms.png" alt="Multiple Sclerosis"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-9 h-9 rounded-full border border-electric-blue/30 group-hover:bg-electric-blue group-hover:border-electric-blue flex items-center justify-center transition-all duration-300">
                            <i class="fas fa-ribbon text-electric-blue group-hover:text-white text-xs transition-colors"></i>
                        </div>
                        <h3 class="text-base font-semibold text-deep-indigo">Multiple Sclerosis</h3>
                    </div>
                    <p class="text-sm text-dark-grey/60 leading-relaxed">Advanced immunomodulatory therapies and tailored symptom management.</p>
                </div>
            </div>

            <!-- Neuropathy -->
            <div class="group bg-white rounded-2xl overflow-hidden border border-silver-grey/50 hover:shadow-xl transition-all duration-500">
                <div class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/services/neuropathy.png" alt="Peripheral Neuropathy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-9 h-9 rounded-full border border-electric-blue/30 group-hover:bg-electric-blue group-hover:border-electric-blue flex items-center justify-center transition-all duration-300">
                            <i class="fas fa-hand-holding-medical text-electric-blue group-hover:text-white text-xs transition-colors"></i>
                        </div>
                        <h3 class="text-base font-semibold text-deep-indigo">Peripheral Neuropathy</h3>
                    </div>
                    <p class="text-sm text-dark-grey/60 leading-relaxed">Expert diagnosis and targeted treatments for nerve damage and neurodegenerative conditions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Achievements — Image Carousel Style -->
<section class="py-14 lg:py-20 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            <!-- Main Award Image -->
            <div class="lg:col-span-5 order-2 lg:order-1">
                <div class="relative max-w-md mx-auto">
                    <!-- Main large image -->
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden shadow-2xl ring-1 ring-silver-grey/50">
                        <img src="assets/full-image/dpg-award.webp" alt="Dr. Praveen Gupta - Award Recognition" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                    </div>
                    <!-- Floating accent: small image top-right -->
                    <div class="absolute -top-6 -right-4 w-28 h-28 rounded-2xl overflow-hidden shadow-xl border-4 border-white hidden md:block">
                        <img src="assets/awards/1.jpg" alt="Award" class="w-full h-full object-cover">
                    </div>
                    <!-- Floating accent: small image bottom-left -->
                    <div class="absolute -bottom-6 -left-6 w-24 h-24 rounded-2xl overflow-hidden shadow-xl border-4 border-white hidden md:block">
                        <img src="assets/awards/3.jpg" alt="Award" class="w-full h-full object-cover">
                    </div>
                    <!-- Decorative gradient blob -->
                    <div class="absolute -top-4 -left-4 w-24 h-24 rounded-full bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 blur-xl -z-10"></div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 rounded-full bg-gradient-to-br from-cyan-accent/20 to-electric-blue/20 blur-xl -z-10"></div>
                </div>
            </div>

            <!-- Content -->
            <div class="lg:col-span-7 order-1 lg:order-2">
                <div class="inline-flex items-center space-x-2 mb-6">
                    <span class="w-8 h-px bg-electric-blue"></span>
                    <span class="text-electric-blue text-xs font-semibold tracking-[0.2em] uppercase">Achievements</span>
                </div>

                <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-5 leading-tight">
                    A Career of <span class="gradient-text">Firsts</span>
                </h2>

                <p class="text-base text-dark-grey/70 mb-6 leading-relaxed">
                    A career decorated with honors, awards, and milestones that reflect a relentless pursuit of medical excellence and innovation in Indian neurology.
                </p>

                <!-- Minimal list -->
                <ul class="space-y-5">
                    <li class="flex items-start space-x-4 group">
                        <span class="w-6 h-6 rounded-full bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 mt-0.5 transition-colors">
                            <i class="fas fa-check text-electric-blue group-hover:text-white text-[10px] transition-colors"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-deep-indigo text-sm">First Dedicated Stroke Centre in Gurgaon</p>
                            <p class="text-dark-grey/60 text-xs mt-0.5">Established pioneering stroke protocols for the region</p>
                        </div>
                    </li>
                    <li class="flex items-start space-x-4 group">
                        <span class="w-6 h-6 rounded-full bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 mt-0.5 transition-colors">
                            <i class="fas fa-check text-electric-blue group-hover:text-white text-[10px] transition-colors"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-deep-indigo text-sm">First Solo Mechanical Thrombolysis in the Region</p>
                            <p class="text-dark-grey/60 text-xs mt-0.5">A breakthrough in advanced stroke intervention</p>
                        </div>
                    </li>
                    <li class="flex items-start space-x-4 group">
                        <span class="w-6 h-6 rounded-full bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 mt-0.5 transition-colors">
                            <i class="fas fa-check text-electric-blue group-hover:text-white text-[10px] transition-colors"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-deep-indigo text-sm">First Deep Brain Stimulation in Gurugram</p>
                            <p class="text-dark-grey/60 text-xs mt-0.5">Transforming treatment for movement disorders</p>
                        </div>
                    </li>
                    <li class="flex items-start space-x-4 group">
                        <span class="w-6 h-6 rounded-full bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 mt-0.5 transition-colors">
                            <i class="fas fa-check text-electric-blue group-hover:text-white text-[10px] transition-colors"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-deep-indigo text-sm">First Epileptic DBS in Asia</p>
                            <p class="text-dark-grey/60 text-xs mt-0.5">Setting a continental benchmark in epilepsy care</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Awards Gallery — Grid -->
<section class="py-14 lg:py-20 bg-soft-cyan/30 overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center space-x-2 mb-4">
                <span class="w-8 h-px bg-electric-blue"></span>
                <span class="text-electric-blue text-xs font-semibold tracking-[0.2em] uppercase">Gallery</span>
                <span class="w-8 h-px bg-electric-blue"></span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Moments of <span class="gradient-text">Recognition</span>
            </h2>
            <p class="text-sm text-dark-grey/60 max-w-xl mx-auto">
                A curated glimpse into the awards, honors, and milestones that have shaped a career dedicated to neurological excellence.
            </p>
        </div>

        <!-- Uniform Image Grid using all 10 award images -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 lg:gap-4">
            <?php foreach ($awards as $award): ?>
                <div class="aspect-[2/3] rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group cursor-pointer">
                    <img src="<?php echo $award['image']; ?>"
                         alt="<?php echo htmlspecialchars($award['title']); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
            <?php endforeach; ?>
        </div>

        <!-- View More Link -->
        <div class="text-center mt-10">
            <a href="#" class="group inline-flex items-center space-x-2 text-sm font-medium text-deep-indigo hover:text-electric-blue transition-colors">
                <span>View All Recognitions</span>
                <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

<!-- Vision — Minimal Quote Section -->
<section class="py-14 lg:py-20 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center space-x-2 mb-8">
            <span class="w-8 h-px bg-electric-blue"></span>
            <span class="text-electric-blue text-xs font-semibold tracking-[0.2em] uppercase">Vision</span>
            <span class="w-8 h-px bg-electric-blue"></span>
        </div>

        <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo mb-10 leading-tight">
            Technology with <span class="gradient-text">Empathy</span>
        </h2>

        <div class="relative">
            <i class="fas fa-quote-left text-cyan-accent/20 text-5xl absolute -top-4 -left-4"></i>
            <p class="text-xl md:text-2xl text-deep-indigo/90 font-serif italic leading-relaxed relative">
                Integrating technology with empathy — ensuring every patient receives personalized, evidence-based treatment aimed at improving quality of life.
            </p>
        </div>

        <p class="text-sm text-dark-grey/60 mt-10 max-w-xl mx-auto leading-relaxed">
            As one of India's leading neurologists, Dr. Gupta's vision extends beyond treatment — focusing on awareness, prevention, and rehabilitation to make advanced neurological therapies more accessible and affordable.
        </p>
    </div>
</section>

<!-- Testimonials — Minimal Slider -->
<section class="py-14 lg:py-20 bg-soft-cyan/30">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <div class="inline-flex items-center space-x-2 mb-4">
                <span class="w-8 h-px bg-electric-blue"></span>
                <span class="text-electric-blue text-xs font-semibold tracking-[0.2em] uppercase">Testimonials</span>
                <span class="w-8 h-px bg-electric-blue"></span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-3">
                What Patients <span class="gradient-text">Say</span>
            </h2>
            <p class="text-sm text-dark-grey/60">
                Showing <span id="testimonial-current">3</span> of <?php echo count($testimonials); ?> reviews
            </p>
        </div>

        <!-- Slider — All 6 cards visible, scroll between pages -->
        <div class="relative">
            <div id="testimonial-viewport" class="overflow-hidden">
                <div id="testimonial-track" class="flex transition-transform duration-500 ease-in-out">
                    <?php foreach ($testimonials as $testimonial): ?>
                        <div class="testimonial-card flex-shrink-0 px-3" style="width: 33.333333%; min-width: 33.333333%; box-sizing: border-box;">
                            <div class="h-full border-l-2 border-silver-grey hover:border-electric-blue pl-5 py-2 transition-colors duration-300">
                                <div class="flex space-x-0.5 mb-3">
                                    <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <?php endfor; ?>
                                </div>
                                <p class="text-dark-grey/80 text-sm italic leading-relaxed mb-5">
                                    "<?php echo $testimonial['message']; ?>"
                                </p>
                                <div>
                                    <p class="font-semibold text-deep-indigo text-sm"><?php echo $testimonial['name']; ?></p>
                                    <p class="text-xs text-dark-grey/50 mt-0.5"><?php echo $testimonial['role']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Slider Controls -->
            <div class="flex items-center justify-center space-x-3 mt-8">
                <button id="testimonial-prev" type="button"
                        class="w-10 h-10 rounded-full bg-white border border-silver-grey hover:border-electric-blue hover:bg-electric-blue hover:text-white text-deep-indigo flex items-center justify-center transition-all duration-300 shadow-sm">
                    <i class="fas fa-chevron-left text-xs"></i>
                </button>

                <div id="testimonial-dots" class="flex items-center space-x-2">
                    <?php
                    // One dot per page. With 6 cards, 3 per page = 2 pages
                    $totalPages = 2;
                    for ($i = 0; $i < $totalPages; $i++): ?>
                        <button type="button"
                                class="testimonial-dot rounded-full bg-silver-grey hover:bg-electric-blue transition-all duration-300"
                                style="width: 8px; height: 8px;"
                                data-index="<?php echo $i; ?>"
                                aria-label="Go to page <?php echo $i + 1; ?>"></button>
                    <?php endfor; ?>
                </div>

                <button id="testimonial-next" type="button"
                        class="w-10 h-10 rounded-full bg-white border border-silver-grey hover:border-electric-blue hover:bg-electric-blue hover:text-white text-deep-indigo flex items-center justify-center transition-all duration-300 shadow-sm">
                    <i class="fas fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<style>
    /* Testimonials slider: 3 cards visible on desktop, 2 on tablet, 1 on mobile */
    @media (max-width: 767px) {
        .testimonial-card {
            width: 100% !important;
            min-width: 100% !important;
        }
    }
    @media (min-width: 768px) and (max-width: 1023px) {
        .testimonial-card {
            width: 50% !important;
            min-width: 50% !important;
        }
    }
    @media (min-width: 1024px) {
        .testimonial-card {
            width: 33.333333% !important;
            min-width: 33.333333% !important;
        }
    }
    .testimonial-dot.active {
        background-color: #2563EB !important;
        width: 24px !important;
    }
</style>

<!-- Testimonials Slider Script -->
<script>
(function() {
    const track = document.getElementById('testimonial-track');
    const prevBtn = document.getElementById('testimonial-prev');
    const nextBtn = document.getElementById('testimonial-next');
    const dots = document.querySelectorAll('.testimonial-dot');
    const currentLabel = document.getElementById('testimonial-current');
    const viewport = document.getElementById('testimonial-viewport');
    const totalCards = <?php echo count($testimonials); ?>;
    const totalPages = <?php echo $totalPages; ?>;
    let currentPage = 0;

    function getCardsPerPage() {
        const w = window.innerWidth;
        if (w >= 1024) return 3;
        if (w >= 768) return 2;
        return 1;
    }

    function update() {
        const cardsPerPage = getCardsPerPage();
        const maxPage = Math.max(0, Math.ceil(totalCards / cardsPerPage) - 1);
        if (currentPage > maxPage) currentPage = maxPage;

        // Translate by viewport width
        const viewportWidth = viewport.offsetWidth;
        const offset = currentPage * viewportWidth;
        track.style.transform = 'translateX(-' + offset + 'px)';

        // Update counter
        if (currentLabel) currentLabel.textContent = Math.min(currentPage * cardsPerPage + cardsPerPage, totalCards);

        // Update dots
        dots.forEach(function(d, i) {
            if (i === currentPage) {
                d.classList.add('active');
            } else {
                d.classList.remove('active');
            }
        });
    }

    prevBtn.addEventListener('click', function() {
        if (currentPage > 0) {
            currentPage--;
            update();
        }
    });

    nextBtn.addEventListener('click', function() {
        const cardsPerPage = getCardsPerPage();
        const maxPage = Math.max(0, Math.ceil(totalCards / cardsPerPage) - 1);
        if (currentPage < maxPage) {
            currentPage++;
            update();
        }
    });

    for (let i = 0; i < dots.length; i++) {
        dots[i].addEventListener('click', function() {
            currentPage = parseInt(this.getAttribute('data-index'), 10);
            update();
        });
    }

    // Recalculate on resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(update, 100);
    });

    // Initialize
    update();
})();
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
