<?php
/**
 * Services Listing Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

// Link mapping helper for service details pages
function getServicePageLink($title) {
    $titleLower = strtolower($title);
    if (strpos($titleLower, 'epilepsy') !== false) {
        return 'epilepsy.php';
    } elseif (strpos($titleLower, 'headache') !== false) {
        return 'headache.php';
    } elseif (strpos($titleLower, 'migraine') !== false) {
        return 'migraine.php';
    } elseif (strpos($titleLower, 'stroke') !== false) {
        return 'stroke.php';
    } elseif (strpos($titleLower, 'vertigo') !== false) {
        return 'vertigo.php';
    } elseif (strpos($titleLower, 'parkinson') !== false) {
        return 'parkinsons.php';
    } elseif (strpos($titleLower, 'multiple sclerosis') !== false || $titleLower === 'ms') {
        return 'ms.php';
    } elseif (strpos($titleLower, 'movement') !== false) {
        return 'movement.php';
    } elseif (strpos($titleLower, 'neuropathy') !== false) {
        return 'neuropathy.php';
    }
    return 'services.php';
}
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
                <span class="text-white font-medium">Services</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-stethoscope text-[10px]"></i>
                <span>Our Expertise</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Neurological <span class="text-white">Services</span> & Treatments
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Dr. Praveen Gupta offers state-of-the-art diagnostic and treatment solutions for a wide range of brain, spinal cord, and nerve disorders. Explore our specialized services below.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap gap-3">
                <a href="contact.php" class="inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
                    <span>Book Appointment</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
                <a href="tel:<?php echo SITE_PHONE; ?>" class="inline-flex items-center space-x-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold px-6 py-2.5 rounded-full border border-white/30 hover:bg-white/30 transition-all duration-300 text-sm">
                    <i class="fas fa-phone text-xs"></i>
                    <span>Call Now</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid Section -->
<section class="py-12 bg-soft-cyan/10 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($services as $index => $service): 
                $link = getServicePageLink($service['title']);
            ?>
                <a href="<?php echo $link; ?>" class="group bg-white rounded-3xl p-5 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 flex flex-col justify-between observe"
                    style="animation-delay: <?php echo $index * 100; ?>ms;">
                    <div>
                        <!-- Image Container -->
                        <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-soft-cyan to-silver-grey">
                            <img src="<?php echo $service['image']; ?>" alt="<?php echo $service['title']; ?>"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Title & Arrow Row -->
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-2xl font-bold text-deep-indigo group-hover:text-electric-blue transition-colors leading-tight">
                                <?php echo $service['title']; ?>
                            </h3>
                            <div class="w-10 h-10 rounded-full border border-silver-grey flex items-center justify-center text-dark-grey group-hover:text-white group-hover:bg-gradient-to-r group-hover:from-electric-blue group-hover:to-cyan-accent group-hover:border-transparent transition-all duration-300 flex-shrink-0 ml-4">
                                <i class="fas fa-arrow-right group-hover:-rotate-45 transition-transform duration-300"></i>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-dark-grey/70 leading-relaxed text-sm">
                            <?php echo $service['description']; ?>
                        </p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action (CTA) Section -->
<section class="relative py-12 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="relative bg-gradient-to-r from-electric-blue to-cyan-accent rounded-[36px] overflow-hidden shadow-2xl p-8 md:p-14 lg:p-16">
            
            <!-- Concentric Circles Pattern -->
            <div class="absolute -right-64 top-1/2 -translate-y-1/2 w-[850px] h-[850px] flex items-center justify-center pointer-events-none z-0">
                <div class="absolute w-[850px] h-[850px] bg-white/[0.03] rounded-full"></div>
                <div class="absolute w-[720px] h-[720px] bg-white/[0.05] rounded-full"></div>
                <div class="absolute w-[590px] h-[590px] bg-white/[0.07] rounded-full"></div>
                <div class="absolute w-[460px] h-[460px] bg-white/[0.09] rounded-full"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 max-w-2xl text-left">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-sans font-extrabold text-white mb-4 leading-tight tracking-tight">
                    Need Personalized Advice?
                </h2>
                <p class="text-white/85 text-sm md:text-base mb-10 max-w-lg leading-relaxed">
                    Consult with Dr. Praveen Gupta to get an accurate diagnosis and custom treatment plan for your neurological health.
                </p>
                <div class="flex flex-wrap gap-4 items-center">
                    <a href="contact.php" class="inline-flex items-center space-x-6 bg-[#111827] text-white text-xs md:text-sm font-semibold pl-6 pr-2.5 py-2.5 rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:-translate-y-0.5 active:translate-y-0 group">
                        <span>Book Appointment</span>
                        <div class="w-7 h-7 rounded-full bg-gradient-to-b from-white via-slate-100 to-slate-400 shadow-[inset_0_1px_2px_rgba(255,255,255,0.8),0_2px_4px_rgba(0,0,0,0.3)] flex items-center justify-center text-[#111827] text-xs font-bold transition-transform duration-300 group-hover:scale-110 flex-shrink-0">
                            <i class="fas fa-chevron-right text-[9px]"></i>
                        </div>
                    </a>
                    <a href="tel:<?php echo SITE_PHONE; ?>" class="inline-flex items-center space-x-6 bg-[#111827] text-white text-xs md:text-sm font-semibold pl-6 pr-2.5 py-2.5 rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:-translate-y-0.5 active:translate-y-0 group">
                        <span>Call Now</span>
                        <div class="w-7 h-7 rounded-full bg-gradient-to-b from-white via-slate-100 to-slate-400 shadow-[inset_0_1px_2px_rgba(255,255,255,0.8),0_2px_4px_rgba(0,0,0,0.3)] flex items-center justify-center text-[#111827] text-xs font-bold transition-transform duration-300 group-hover:scale-110 flex-shrink-0">
                            <i class="fas fa-phone text-[9px]"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
