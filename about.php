<?php
/**
 * About Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('about', [
    'hero_badge' => '',
    'hero_title' => '<span class="text-cyan-accent">Dr. Praveen Gupta</span>',
    'hero_desc'  => '',
    'hero_bg'    => 'assets/breadcrumbs/about.png'
]);
?>

<!-- Hero Section -->
<section class="relative overflow-hidden text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($pageContent['hero_bg']); ?>');">
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/85 to-electric-blue/30"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">About</span>
            </nav>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-4">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <!-- Designations Stack -->
            <div class="space-y-3 mb-6 max-w-3xl">
                <div class="flex items-start space-x-2.5">
                    <span class="w-5 h-5 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center mt-0.5 text-cyan-accent flex-shrink-0">
                        <i class="fas fa-award text-[10px]"></i>
                    </span>
                    <span class="text-sm md:text-base text-white/90 font-semibold leading-relaxed">Chairman MAIINS (Marengo Asia International Institute of Neuro & Spine), MAH Gurgaon</span>
                </div>
                <div class="flex items-start space-x-2.5">
                    <span class="w-5 h-5 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center mt-0.5 text-cyan-accent flex-shrink-0">
                        <i class="fas fa-user-md text-[10px]"></i>
                    </span>
                    <span class="text-sm md:text-base text-white/90 font-semibold leading-relaxed">Chief Clinical Strategy, Growth and Innovation, North India</span>
                </div>
                <div class="flex items-start space-x-2.5">
                    <span class="w-5 h-5 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center mt-0.5 text-cyan-accent flex-shrink-0">
                        <i class="fas fa-lightbulb text-[10px]"></i>
                    </span>
                    <span class="text-sm md:text-base text-white/90 font-semibold leading-relaxed">Chief Mentor for Start-up and Clinical Innovation for Neurosciences, Mental Health and Neuro Rehab Programs</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Doctor Portrait & Summary Section -->

<!-- Minimal Stats Strip -->


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
                    His groundbreaking achievements include conducting the <strong class="text-deep-indigo">first Deep Brain Stimulation (DBS) procedure in Gurugram</strong> and performing the <strong class="text-deep-indigo">first epileptic DBS in Asia</strong> â€” setting new benchmarks for neurological innovation.
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
                A deep commitment to patient-centric care and innovation has shaped comprehensive stroke, epilepsy, and movement disorder programs â€” setting new benchmarks in neurology.
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
                    <p class="text-sm text-dark-grey/60 leading-relaxed">Performed the first epileptic DBS in Asia â€” redefining advanced epilepsy treatment.</p>
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

<!-- Achievements â€” Image Carousel Style -->
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

<!-- Awards Gallery â€” Grid -->
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

<!-- Vision â€” Minimal Quote Section -->
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
                Integrating technology with empathy â€” ensuring every patient receives personalized, evidence-based treatment aimed at improving quality of life.
            </p>
        </div>

        <p class="text-sm text-dark-grey/60 mt-10 max-w-xl mx-auto leading-relaxed">
            As one of India's leading neurologists, Dr. Gupta's vision extends beyond treatment â€” focusing on awareness, prevention, and rehabilitation to make advanced neurological therapies more accessible and affordable.
        </p>
    </div>
</section>

<!-- Testimonials â€” Modern Elevated Slider -->
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

        <!-- Slider -->
        <div class="relative">
            <div id="testimonial-viewport" class="overflow-hidden">
                <div id="testimonial-track" class="flex transition-transform duration-500 ease-in-out">
                    <?php foreach ($testimonials as $testimonial): ?>
                        <div class="testimonial-card flex-shrink-0 px-4 py-2" style="width: 33.333333%; min-width: 33.333333%; box-sizing: border-box;">
                            <div class="group h-full bg-white rounded-3xl p-7 border border-silver-grey/50 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 flex flex-col justify-between relative overflow-hidden">
                                <!-- Background Decorative Quote -->
                                <i class="fas fa-quote-right absolute right-6 top-6 text-slate-100 text-4xl pointer-events-none group-hover:text-electric-blue/5 transition-colors duration-300"></i>

                                <div>
                                    <!-- Stars -->
                                    <div class="flex space-x-0.5 mb-4 text-amber-400">
                                        <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                            <i class="fas fa-star text-xs"></i>
                                        <?php endfor; ?>
                                    </div>
                                    
                                    <!-- Message -->
                                    <p class="text-dark-grey/75 text-sm leading-relaxed mb-6 italic relative z-10">
                                        "<?php echo $testimonial['message']; ?>"
                                    </p>
                                </div>

                                <!-- Divider -->
                                <div class="w-full h-px bg-silver-grey/60 mb-4"></div>

                                <!-- Author Row -->
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-electric-blue/15 to-cyan-accent/15 text-electric-blue font-bold text-sm flex items-center justify-center shadow-sm">
                                        <?php echo strtoupper(substr($testimonial['name'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <p class="font-bold text-deep-indigo text-sm leading-tight"><?php echo $testimonial['name']; ?></p>
                                        <p class="text-[10px] text-cyan-accent font-semibold mt-0.5 uppercase tracking-wider"><?php echo $testimonial['role']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Slider Controls -->
            <div class="flex items-center justify-center space-x-3 mt-8">
                <button id="testimonial-prev" type="button"
                        class="w-10 h-10 rounded-full bg-white border border-silver-grey hover:border-electric-blue hover:bg-electric-blue hover:text-white text-deep-indigo flex items-center justify-center transition-all duration-300 shadow-sm active:scale-95">
                    <i class="fas fa-chevron-left text-xs"></i>
                </button>

                <div id="testimonial-dots" class="flex items-center space-x-2">
                    <!-- Dots generated dynamically in JS -->
                </div>

                <button id="testimonial-next" type="button"
                        class="w-10 h-10 rounded-full bg-white border border-silver-grey hover:border-electric-blue hover:bg-electric-blue hover:text-white text-deep-indigo flex items-center justify-center transition-all duration-300 shadow-sm active:scale-95">
                    <i class="fas fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<style>
    /* Responsive slide widths */
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
    const dotsBox = document.getElementById('testimonial-dots');
    const currentLabel = document.getElementById('testimonial-current');
    const viewport = document.getElementById('testimonial-viewport');
    const totalCards = <?php echo count($testimonials); ?>;
    let currentPage = 0;

    function getCardsPerPage() {
        const w = window.innerWidth;
        if (w >= 1024) return 3;
        if (w >= 768) return 2;
        return 1;
    }

    function buildDots() {
        const cardsPerPage = getCardsPerPage();
        const maxPage = Math.max(0, Math.ceil(totalCards / cardsPerPage) - 1);
        dotsBox.innerHTML = '';
        for (let i = 0; i <= maxPage; i++) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'testimonial-dot rounded-full bg-silver-grey hover:bg-electric-blue transition-all duration-300';
            btn.style.width = '8px';
            btn.style.height = '8px';
            btn.setAttribute('data-index', i);
            btn.setAttribute('aria-label', 'Go to page ' + (i + 1));
            btn.addEventListener('click', function() {
                currentPage = i;
                update();
            });
            dotsBox.appendChild(btn);
        }
    }

    function update() {
        const cardsPerPage = getCardsPerPage();
        const maxPage = Math.max(0, Math.ceil(totalCards / cardsPerPage) - 1);
        if (currentPage > maxPage) currentPage = maxPage;

        // Rebuild dots if mismatch
        if (dotsBox.children.length !== maxPage + 1) {
            buildDots();
        }

        // Translate
        const viewportWidth = viewport.offsetWidth;
        const offset = currentPage * viewportWidth;
        track.style.transform = 'translateX(-' + offset + 'px)';

        // Counter
        if (currentLabel) {
            currentLabel.textContent = Math.min(currentPage * cardsPerPage + cardsPerPage, totalCards);
        }

        // Paint dots
        Array.from(dotsBox.children).forEach(function(d, i) {
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

    // Touch / Swipe
    let touchStartX = 0;
    viewport.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });
    viewport.addEventListener('touchend', function(e) {
        const delta = e.changedTouches[0].screenX - touchStartX;
        if (Math.abs(delta) > 50) {
            if (delta < 0) {
                nextBtn.click();
            } else {
                prevBtn.click();
            }
        }
    }, { passive: true });

    // Recalculate
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
