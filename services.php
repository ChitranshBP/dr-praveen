<?php
/**
 * Services Listing Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

// Link mapping helper for service details pages is now defined in config.php
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/5"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
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
                <a href="contact" class="inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
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
                        <p class="text-dark-grey/70 leading-relaxed text-sm mb-4">
                            <?php echo $service['description']; ?>
                        </p>

                        <!-- Bullet Feature / Helpline Badge -->
                        <?php if (!empty($service['bullet'])): ?>
                            <div class="mt-auto pt-4 border-t border-silver-grey/60 flex items-center space-x-2.5 text-xs font-bold">
                                <i class="fas <?php echo strpos($service['bullet'], '1800') !== false ? 'fa-phone-alt animate-pulse text-red-500' : 'fa-chevron-right text-cyan-accent'; ?> text-xs flex-shrink-0"></i>
                                <span class="<?php echo strpos($service['bullet'], '1800') !== false ? 'text-red-650 text-red-600' : 'text-dark-grey/75'; ?>"><?php echo $service['bullet']; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action (CTA) Section -->
<!--  -->

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
