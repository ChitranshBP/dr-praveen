<?php
/**
 * Homepage - Dr. Praveen Gupta
 */
require_once __DIR__ . '/includes/header.php';

// Load doctor data from JSON for the homepage team section
$doctorsJsonPath = __DIR__ . '/assets/doctors_full.json';
$specialtyTeam = [];
$homepageTeam = [];

if (file_exists($doctorsJsonPath)) {
    $doctorsJson = file_get_contents($doctorsJsonPath);
    $doctors = json_decode($doctorsJson, true);
    if (is_array($doctors)) {
        foreach ($doctors as $doc) {
            if (isset($doc['name']) && $doc['name'] !== 'Dr. Praveen Gupta') {
                $specialtyTeam[] = $doc;
            }
        }
        $homepageTeam = array_slice($specialtyTeam, 0, 4);
    }
}
?>

<!-- Hero Section - Banner Slider -->
<section class="relative overflow-hidden bg-deep-indigo -mt-20 select-none">
    <!-- SEO H1 (visually hidden - headline is baked into the banner artwork) -->
    <h1 class="sr-only">Dr. Praveen Gupta â€“ Best Neurologist in India | Transforming Brain &amp; Spine Care with Precision</h1>

    <div id="hero-slider" class="w-full max-w-[1920px] mx-auto relative">
        <div id="hero-track" class="flex transition-transform duration-700 ease-in-out">
            <div class="min-w-full relative">
                <picture>
                    <source media="(max-width: 767px)" srcset="assets/mobile-banner/1.png">
                    <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png" 
                         class="w-full h-auto object-cover object-[32%_center] md:object-center block" 
                         alt="Transforming Brain & Spine Care with Precision â€“ Led by Dr. Praveen Gupta, Chairman, Marengo Asia International Institute of Neuro & Spine" 
                         fetchpriority="high">
                </picture>
            </div>
            <div class="min-w-full relative">
                <picture>
                    <source media="(max-width: 767px)" srcset="assets/mobile-banner/2.png">
                    <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500)%20(1).png"
                         alt="Your Brain Deserves Expert Care â€“ Empowering every thought for a life beyond neurological limits"
                         loading="lazy"
                         class="w-full h-auto object-cover object-[32%_center] md:object-center block">
                </picture>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <button id="hero-prev" type="button" aria-label="Previous slide"
                class="absolute left-3 md:left-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/20 hover:bg-black/45 text-white backdrop-blur-sm border border-white/20 flex items-center justify-center transition-all duration-300 active:scale-95 focus:outline-none z-20 shadow-md">
            <i class="fas fa-chevron-left text-sm md:text-base"></i>
        </button>
        <button id="hero-next" type="button" aria-label="Next slide"
                class="absolute right-3 md:right-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/20 hover:bg-black/45 text-white backdrop-blur-sm border border-white/20 flex items-center justify-center transition-all duration-300 active:scale-95 focus:outline-none z-20 shadow-md">
            <i class="fas fa-chevron-right text-sm md:text-base"></i>
        </button>

        <!-- Pagination Dots -->
        <div class="absolute bottom-4 md:bottom-6 left-1/2 -translate-x-1/2 flex items-center space-x-2.5 z-20">
            <button type="button" class="hero-dot w-2 h-2 rounded-full bg-white/45 transition-all duration-300 hover:bg-white" data-slide="0" aria-label="Go to slide 1"></button>
            <button type="button" class="hero-dot w-2 h-2 rounded-full bg-white/45 transition-all duration-300 hover:bg-white" data-slide="1" aria-label="Go to slide 2"></button>
        </div>
    </div>

    <!-- JS for Hero Slider -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.getElementById('hero-slider');
        const track = document.getElementById('hero-track');
        if (!slider || !track) return;

        const dots = slider.querySelectorAll('.hero-dot');
        const prevBtn = document.getElementById('hero-prev');
        const nextBtn = document.getElementById('hero-next');
        const totalSlides = track.children.length;
        let currentIndex = 0;
        let autoplayTimer;

        function updateSlider(index) {
            currentIndex = (index + totalSlides) % totalSlides;
            track.style.transform = `translateX(-${currentIndex * 100}%)`;

            dots.forEach((dot, idx) => {
                if (idx === currentIndex) {
                    dot.classList.add('bg-white', 'w-6');
                    dot.classList.remove('bg-white/45');
                } else {
                    dot.classList.remove('bg-white', 'w-6');
                    dot.classList.add('bg-white/45');
                }
            });
        }

        function startAutoplay() {
            stopAutoplay();
            autoplayTimer = setInterval(() => updateSlider(currentIndex + 1), 5000);
        }

        function stopAutoplay() {
            if (autoplayTimer) clearInterval(autoplayTimer);
        }

        function goTo(index) {
            updateSlider(index);
            startAutoplay();
        }

        nextBtn.addEventListener('click', () => goTo(currentIndex + 1));
        prevBtn.addEventListener('click', () => goTo(currentIndex - 1));
        dots.forEach(dot => {
            dot.addEventListener('click', () => goTo(parseInt(dot.dataset.slide, 10)));
        });

        slider.addEventListener('mouseenter', stopAutoplay);
        slider.addEventListener('mouseleave', startAutoplay);

        // Touch / swipe support
        let touchStartX = 0;
        slider.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
            stopAutoplay();
        }, { passive: true });
        slider.addEventListener('touchend', (e) => {
            const delta = e.changedTouches[0].screenX - touchStartX;
            if (Math.abs(delta) > 50) {
                goTo(delta < 0 ? currentIndex + 1 : currentIndex - 1);
            } else {
                startAutoplay();
            }
        }, { passive: true });

        // Pause when the tab is hidden
        document.addEventListener('visibilitychange', () => {
            document.hidden ? stopAutoplay() : startAutoplay();
        });

        updateSlider(0);
        startAutoplay();
    });
    </script>
</section>

<!-- Services Section -->
<section class="py-10 md:py-14 bg-soft-cyan/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-stethoscope text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">How We Can Help</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Comprehensive Care for Every <span class="gradient-text">Brain & Spine</span> Condition
            </h2>
            <p class="text-lg text-dark-grey/70">
                Expert diagnosis, advanced treatment, and personalized recoveryâ€”all under one roof.
            </p>
        </div>

        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 pb-6 -mx-4 px-4 md:mx-0 md:px-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-8 md:pb-0">
            <?php foreach ($services as $index => $service): 
                $link = getServicePageLink($service['title']);
            ?>
                <a href="<?php echo $link; ?>" class="group bg-white rounded-3xl p-5 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 flex flex-col justify-between observe w-[80vw] md:w-auto flex-shrink-0 snap-start"
                    style="animation-delay: <?php echo $index * 100; ?>ms;">
                    <div>
                        <!-- Image Container -->
                        <div
                            class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-soft-cyan to-silver-grey">
                            <picture>
                                <?php if(!empty($service['webp']) && file_exists(__DIR__ . '/' . $service['webp'])): ?>
                                <source srcset="<?php echo $service['webp']; ?>" type="image/webp">
                                <?php endif; ?>
                                <img src="<?php echo $service['image']; ?>" alt="<?php echo $service['title']; ?>"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            </picture>
                        </div>

                        <!-- Title & Arrow Row -->
                        <div class="flex justify-between items-start mb-3">
                            <h3
                                class="text-2xl font-bold text-deep-indigo group-hover:text-electric-blue transition-colors leading-tight">
                                <?php echo $service['title']; ?>
                            </h3>
                            <div
                                class="w-10 h-10 rounded-full border border-silver-grey flex items-center justify-center text-dark-grey group-hover:text-white group-hover:bg-gradient-to-r group-hover:from-electric-blue group-hover:to-cyan-accent group-hover:border-transparent transition-all duration-300 flex-shrink-0 ml-4">
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

<!-- Full Width Banner Slideshow Section -->
<section class="py-10 md:py-14 bg-white relative overflow-hidden select-none">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Slider Wrapper -->
        <div id="banner-slider" class="relative w-full overflow-hidden rounded-3xl shadow-lg border border-silver-grey/50">
            <div id="banner-track" class="flex transition-transform duration-700 ease-in-out">
                <div class="min-w-full relative">
                    <img src="assets/full-image/Dr-Praveen-Banner-1.png" alt="Dr. Praveen Gupta Slide 1" class="w-full h-auto block">
                </div>
                <div class="min-w-full relative">
                    <img src="assets/full-image/Dr-Praveen-Banner-2.png" alt="Dr. Praveen Gupta Slide 2" class="w-full h-auto block">
                </div>
                <div class="min-w-full relative">
                    <img src="assets/full-image/Dr-Praveen-Banner-6.png" alt="Dr. Praveen Gupta Slide 3" class="w-full h-auto block">
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button id="banner-prev" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/20 hover:bg-black/45 text-white backdrop-blur-sm border border-white/10 flex items-center justify-center transition-all duration-300 active:scale-95 focus:outline-none z-20 shadow-md">
                <i class="fas fa-chevron-left text-sm md:text-base"></i>
            </button>
            <button id="banner-next" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/20 hover:bg-black/45 text-white backdrop-blur-sm border border-white/10 flex items-center justify-center transition-all duration-300 active:scale-95 focus:outline-none z-20 shadow-md">
                <i class="fas fa-chevron-right text-sm md:text-base"></i>
            </button>

            <!-- Pagination Dots -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center space-x-2.5 z-20">
                <button class="banner-dot w-2 h-2 rounded-full bg-white/45 transition-all duration-300 hover:bg-white" data-slide="0"></button>
                <button class="banner-dot w-2 h-2 rounded-full bg-white/45 transition-all duration-300 hover:bg-white" data-slide="1"></button>
                <button class="banner-dot w-2 h-2 rounded-full bg-white/45 transition-all duration-300 hover:bg-white" data-slide="2"></button>
            </div>
        </div>
    </div>

    <!-- JS for Banner Slideshow -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const track = document.getElementById('banner-track');
        const slides = track.children;
        const dots = document.querySelectorAll('.banner-dot');
        const prevBtn = document.getElementById('banner-prev');
        const nextBtn = document.getElementById('banner-next');
        let currentIndex = 0;
        const totalSlides = slides.length;
        let autoplayTimer;

        function updateSlider(index) {
            currentIndex = index;
            track.style.transform = `translateX(-${index * 100}%)`;
            
            // Update dots
            dots.forEach((dot, idx) => {
                if (idx === index) {
                    dot.classList.add('bg-white', 'w-6');
                    dot.classList.remove('bg-white/45');
                } else {
                    dot.classList.remove('bg-white', 'w-6');
                    dot.classList.add('bg-white/45');
                }
            });
        }

        function nextSlide() {
            updateSlider((currentIndex + 1) % totalSlides);
        }

        function prevSlide() {
            updateSlider((currentIndex - 1 + totalSlides) % totalSlides);
        }

        function startAutoplay() {
            stopAutoplay();
            autoplayTimer = setInterval(nextSlide, 5000);
        }

        function stopAutoplay() {
            if (autoplayTimer) {
                clearInterval(autoplayTimer);
            }
        }

        nextBtn.addEventListener('click', () => {
            nextSlide();
            startAutoplay();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            startAutoplay();
        });

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const index = parseInt(dot.dataset.slide);
                updateSlider(index);
                startAutoplay();
            });
        });

        updateSlider(0);
        startAutoplay();
    });
    </script>
</section>

<!-- Stats Section -->
<section class="py-10 md:py-14 bg-soft-cyan/30 relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($stats as $stat): ?>
                <div
                    class="group bg-white rounded-3xl p-6 md:p-8 border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col justify-between h-full text-left observe">
                    <div>
                        <!-- Icon -->
                        <div class="w-12 h-12 rounded-2xl bg-electric-blue/10 text-electric-blue flex items-center justify-center text-xl mb-5 group-hover:bg-gradient-to-br group-hover:from-electric-blue group-hover:to-cyan-accent group-hover:text-white transition-all duration-300">
                            <i class="<?php echo $stat['icon'] ?? 'fas fa-chart-line'; ?>"></i>
                        </div>
                        <div class="text-4xl font-extrabold text-deep-indigo mb-1"><?php echo $stat['number']; ?></div>
                        <div class="text-base font-bold text-deep-indigo mb-4"><?php echo $stat['label']; ?></div>
                        <div class="w-full h-px bg-silver-grey my-4"></div>
                        <p class="text-sm text-dark-grey/70 leading-relaxed mt-4"><?php echo $stat['description']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- About Doctor Section -->
<section id="about" class="py-10 md:py-14 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Image Side -->
            <div class="lg:col-span-5 relative observe">
                <div
                    class="aspect-[4/5] rounded-3xl overflow-hidden border border-silver-grey/50 shadow-lg bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/dpg-1.webp"
                        alt="Dr. Praveen Gupta, Neurologist" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Content Side -->
            <div class="lg:col-span-7 observe">
                <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                    <i class="fas fa-user-md text-electric-blue text-sm"></i>
                    <span class="text-electric-blue text-sm font-semibold">About Dr. Praveen Gupta</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo leading-tight mb-4">
                    Dr. Praveen Gupta â€“ <span class="gradient-text">Best Neurologist</span> in India
                </h2>

                <!-- Prestigious Appointments -->
                <div class="flex flex-col space-y-2.5 mb-6">
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-award text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chairman â€“ Marengo Asia International Institute of Neuro and Spine</span>
                    </div>
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-chart-line text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chief Clinical Strategy Growth and Innovation, North India</span>
                    </div>
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-lightbulb text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chief Mentor for Start-ups</span>
                    </div>
                </div>

                <p class="text-base text-dark-grey/85 mb-4 leading-relaxed">
                    Neurology is one of the most complex medical fields, requiring precision, innovation, and
                    compassionate care. At the heart of this field stands Dr. Praveen Gupta, a name synonymous with
                    excellence and trust in neurology across India and beyond. With over 20 years of clinical
                    experience, Dr. Praveen Gupta has emerged as a pioneering force in the diagnosis, treatment, and
                    advancement of neurological sciences.
                </p>

                <p class="text-base text-dark-grey/85 mb-4 leading-relaxed font-semibold">
                    A true innovator, he has been responsible for several firsts in the countryâ€™s neurology landscape:
                </p>

                <!-- List of Firsts -->
                <ul
                    class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm text-dark-grey/80 border-l-2 border-cyan-accent/30 pl-4 py-1">
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 bg-electric-blue rounded-full mt-2 flex-shrink-0"></span>
                        <span>Founder of the first stroke centre in Gurugram</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 bg-electric-blue rounded-full mt-2 flex-shrink-0"></span>
                        <span>Performed the first solo mechanical thrombolysis in the region</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 bg-electric-blue rounded-full mt-2 flex-shrink-0"></span>
                        <span>Led the first Deep Brain Stimulation (DBS) procedure in Gurugram</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 bg-electric-blue rounded-full mt-2 flex-shrink-0"></span>
                        <span>Conducted the first epileptic DBS surgery in Asia</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 bg-electric-blue rounded-full mt-2 flex-shrink-0"></span>
                        <span>Pioneered Bone Marrow Transplant (BMT) for autoimmune neurological disorders</span>
                    </li>
                </ul>

                <p class="text-base text-dark-grey/85 mb-8 leading-relaxed">
                    Through his vision and dedication, Dr. Gupta has transformed neurological care in India and
                    positioned himself as one of the best neurologists in India.
                </p>

                <!-- Button -->
                <div>
                    <a href="about"
                        class="inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:shadow-electric-blue/40 hover:-translate-y-0.5 transition-all duration-300">
                        <span>More About Us</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-10 md:py-14 bg-soft-cyan/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Content Side -->
            <div class="lg:col-span-7 observe">
                <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                    <i class="fas fa-heart text-electric-blue text-sm"></i>
                    <span class="text-electric-blue text-sm font-semibold">Why Patients Trust Us</span>
                </div>

                <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo leading-tight mb-4">
                    Compassionate Care That <span class="gradient-text">Puts You First</span>
                </h2>

                <p class="text-lg text-dark-grey/70 mb-10 leading-relaxed max-w-xl">
                    When it comes to your brain and spine health, expert care makes all the difference. At NeuroDoc, we combine expert clinical care, advanced neuroscience, and compassionate support to guide you from diagnosis to recoveryâ€”with confidence at every step.
                </p>

                <!-- Grid of 4 Items -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-10">
                    <!-- Feature 1 -->
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-hand-holding-heart text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Patient-First Care</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">We listen closely to your concerns, explain things simply, and tailor treatments to your life.</p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-lightbulb text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Pioneering Treatment</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Access to India's latest advancements in stroke recovery, brain therapies, and care.</p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-circle-check text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Proven Recovery</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Over 20 years of experience helping thousands of families return to active, healthy lives.</p>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-shield-halved text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Complete Support</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">From consultations to home care guidelines, we stand by your family through healing.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div>
                    <a href="contact-us-top-neurologist-delhi-ncr"
                        class="inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:shadow-electric-blue/40 hover:-translate-y-0.5 transition-all duration-300">
                        <span>Get Started</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Image Side -->
            <div class="lg:col-span-5 relative flex justify-center lg:justify-end observe">
                <div
                    class="relative w-full max-w-md lg:max-w-none aspect-[4/5] rounded-3xl overflow-hidden border border-silver-grey/50 shadow-lg bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <!-- Background Portrait Photo -->
                    <img src="assets/full-image/dpg-award.webp"
                        alt="Dr. Praveen Gupta receiving an award" class="w-full h-full object-cover">

                    <!-- Floating Overlaid Card -->

                </div>
            </div>
        </div>
    </div>
</section>

<!-- â•â•â•â•â•â•â•â• Virtual Consultation Strip â•â•â•â•â•â•â•â• -->
<section id="virtual-consultation" class="py-8 md:py-10 bg-gradient-to-r from-deep-indigo via-electric-blue to-cyan-accent relative overflow-hidden">
    <!-- Ambient glow -->
    <div class="absolute -top-20 -left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 right-1/4 w-72 h-72 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    <!-- Oversized watermark icon -->
    <i class="fas fa-laptop-medical absolute -right-6 top-1/2 -translate-y-1/2 text-white/10 text-[10rem] pointer-events-none hidden lg:block"></i>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 observe">

            <!-- Message -->
            <div class="flex items-start sm:items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-white/15 backdrop-blur-md border border-white/25 text-white flex items-center justify-center text-2xl flex-shrink-0">
                    <i class="fas fa-video"></i>
                </div>
                <div>
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full border border-white/20 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-200 animate-pulse"></span>
                        <span class="text-white text-[11px] font-semibold uppercase tracking-wider">Virtual Consultation</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-serif font-bold text-white leading-tight mb-1.5">
                        Consult Dr. Praveen Gupta from Anywhere
                    </h2>
                    <p class="text-sm md:text-base text-white/80 leading-relaxed max-w-xl">
                        Secure online video consultations for new diagnoses, treatment reviews and second opinions â€” no travel required.
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-wrap items-center gap-4 flex-shrink-0">
                <a href="online-neurologist-consultation"
                   class="inline-flex items-center space-x-2.5 bg-white hover:bg-deep-indigo text-deep-indigo hover:text-white font-bold px-7 py-3.5 rounded-full shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <span>Book Video Consultation</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
                <a href="tel:<?php echo SITE_PHONE; ?>"
                   class="inline-flex items-center space-x-2.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/25 hover:border-white/50 text-white font-bold px-7 py-3.5 rounded-full transition-all duration-300">
                    <i class="fas fa-phone-alt text-xs"></i>
                    <span><?php echo SITE_PHONE; ?></span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Tech Section -->
<section class="py-10 md:py-14 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-microchip text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Advanced Technology</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Smart Tech for <span class="gradient-text">Faster Recovery</span>
            </h2>
            <p class="text-lg text-dark-grey/70">
                We combine clinical expertise with state-of-the-art diagnostic and recovery tracking tools to ensure precise treatments.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            <!-- Tech 1: Phezee -->
            <div class="bg-white border border-silver-grey/50 p-8 rounded-3xl space-y-4 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 observe">
                <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-silver-grey mb-4">
                    <img src="https://images.unsplash.com/photo-1607613009820-a29f7bb81c04?auto=format&fit=crop&q=80&w=600" alt="Phezee Biofeedback" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-bold text-deep-indigo font-serif">PHEZEE - Smart Biofeedback</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A smart wearable device used during physiotherapy sessions to monitor muscle health, track joint Range of Motion (ROM), and log precise electromyography (EMG) recovery trends in real-time.
                </p>
            </div>

            <!-- Tech 2: Fall Risk Assessment -->
            <div class="bg-white border border-silver-grey/50 p-8 rounded-3xl space-y-4 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 observe">
                <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-silver-grey mb-4">
                    <img src="https://images.unsplash.com/photo-1471864190281-a93a3070b6de?auto=format&fit=crop&q=80&w=600" alt="Fall Risk Assessment" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-bold text-deep-indigo font-serif">OPD Fall Risk Assessment</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A comprehensive screening protocol conducted on an Outpatient (OPD) basis. We assess gait patterns, coordination, and muscular stability to prevent sudden falls and fractures, especially in senior patients.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-10 md:py-14 bg-soft-cyan/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-user-group text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Our Team</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Our Care <span class="gradient-text">Team</span>
            </h2>
            <p class="text-lg text-dark-grey/70">
                The approach is simple: understand whatâ€™s causing the problem, explain it clearly, and guide you toward the right treatment and recovery plan.
            </p>
        </div>

        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 pb-6 -mx-4 px-4 sm:mx-0 sm:px-0 sm:grid sm:grid-cols-2 lg:grid-cols-4 sm:gap-8 sm:pb-0 mb-10">
            <?php foreach ($homepageTeam as $doc): ?>
            <!-- Dynamic Team Card -->
            <a href="team" class="group bg-white border border-silver-grey/50 p-6 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 observe flex flex-col items-center text-center hover:-translate-y-2 w-[70vw] sm:w-auto flex-shrink-0 snap-start">
                <div class="w-32 h-32 rounded-full overflow-hidden mb-4 bg-gradient-to-br from-electric-blue to-cyan-accent p-0.5 shadow-md">
                    <img src="<?php echo htmlspecialchars($doc['image']); ?>" alt="<?php echo htmlspecialchars($doc['alt']); ?>" class="w-full h-full object-cover object-top rounded-full transition-transform duration-500 group-hover:scale-105">
                </div>
                <h3 class="font-bold text-deep-indigo text-base leading-tight"><?php echo htmlspecialchars($doc['name']); ?></h3>
                <p class="text-[11px] text-cyan-accent font-semibold mt-1.5 leading-relaxed"><?php echo htmlspecialchars($doc['specialty']); ?></p>
                <p class="text-xs text-dark-grey/65 mt-2 leading-relaxed line-clamp-3 font-light"><?php echo htmlspecialchars($doc['designation']); ?></p>
                <div class="text-xs text-electric-blue font-semibold mt-auto pt-4 group-hover:underline flex items-center">
                    <span>View Profile</span>
                    <i class="fas fa-arrow-right text-[9px] ml-1.5 transition-transform duration-300 group-hover:translate-x-0.5"></i>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="text-center">
            <a href="team" class="inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:shadow-electric-blue/40 hover:-translate-y-0.5 transition-all duration-300">
                <span>View Full Team Details</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>

<!-- â•â•â•â•â•â•â•â• Written Testimonials Section â•â•â•â•â•â•â•â• -->
<section id="written-testimonials" class="py-10 md:py-14 bg-white relative overflow-hidden">

    <!-- Section Header -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-quote-right text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Written Testimonials</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                What Our <span class="gradient-text">Patients</span> Say
            </h2>
            <p class="text-lg text-dark-grey/70">
                Real stories from real patients who experienced exceptional neurological care.
            </p>
        </div>
    </div>

    <?php
    // Two rows drifting in opposite directions. Each row is rendered three times so the
    // keyframe lands exactly on a repeat and the loop is seamless on any screen width.
    $avatarColors = [
        'from-electric-blue to-cyan-accent',
        'from-cyan-accent to-electric-blue',
        'from-deep-indigo to-electric-blue',
        'from-electric-blue to-deep-indigo',
    ];
    
    // Split testimonials so each is only displayed in one row
    $half = ceil(count($testimonials) / 2);
    $row1 = array_slice($testimonials, 0, $half);
    $row2 = array_slice($testimonials, $half);
    
    // Duplicate within track to ensure CSS marquee scrolls seamlessly
    $marqueeRows = [
        array_merge($row1, $row1),
        array_merge($row2, $row2)
    ];

    // Card markup, reused by both rows and both copies
    $renderQuoteCard = function ($testimonial, $idx, $ariaHidden = false) use ($avatarColors) {
        $color   = $avatarColors[$idx % count($avatarColors)];
        $rating  = (int) ($testimonial['rating'] ?? 5);
        ob_start(); ?>
        <div class="quote-card w-[300px] sm:w-[360px] flex-shrink-0 mr-6"<?php echo $ariaHidden ? ' aria-hidden="true"' : ''; ?>>
            <div class="h-full bg-white rounded-3xl p-7 border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-shadow duration-500 flex flex-col">

                <!-- Rating -->
                <div class="flex items-center space-x-1 mb-4 text-amber-400 text-sm">
                    <?php for ($s = 0; $s < $rating; $s++): ?>
                        <i class="fas fa-star"></i>
                    <?php endfor; ?>
                </div>

                <!-- Review text -->
                <p class="text-dark-grey/75 text-sm leading-relaxed flex-1 mb-5">
                    <?php echo $testimonial['message']; ?>
                </p>

                <!-- Divider -->
                <div class="w-full h-px bg-silver-grey mb-4"></div>

                <!-- Author -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br <?php echo $color; ?> flex items-center justify-center text-white font-bold text-sm shadow-md flex-shrink-0">
                        <?php echo strtoupper(substr($testimonial['name'], 0, 1)); ?>
                    </div>
                    <div>
                        <p class="font-bold text-deep-indigo text-sm leading-tight"><?php echo $testimonial['name']; ?></p>
                        <p class="text-xs text-cyan-accent font-medium mt-0.5"><?php echo $testimonial['role']; ?></p>
                    </div>
                </div>

            </div>
        </div>
        <?php return ob_get_clean();
    };
    ?>

    <!-- Marquee rows (full-bleed so cards run edge to edge) -->
    <div class="marquee-wrap relative observe">
        <?php foreach ($marqueeRows as $rowIdx => $row): ?>
            <div class="overflow-hidden <?php echo $rowIdx > 0 ? 'mt-6' : ''; ?>">
                <div class="marquee-track flex w-max <?php echo $rowIdx > 0 ? 'marquee-reverse' : ''; ?>">
                    <?php foreach ($row as $idx => $testimonial): ?>
                        <?php echo $renderQuoteCard($testimonial, $idx, $rowIdx > 0); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Edge fades -->
        <div class="absolute inset-y-0 left-0 w-12 md:w-32 bg-gradient-to-r from-white to-transparent pointer-events-none z-10"></div>
        <div class="absolute inset-y-0 right-0 w-12 md:w-32 bg-gradient-to-l from-white to-transparent pointer-events-none z-10"></div>
    </div>

    <!-- CTA -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mt-10 observe">
            <a href="patient-reviews"
               class="inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:shadow-electric-blue/40 hover:-translate-y-0.5 transition-all duration-300">
                <span>Read All Patient Reviews</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>

    <style>
        /* Self-referencing marquee - one copy per row */
        @keyframes marquee-scroll {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }
        .marquee-track {
            animation: marquee-scroll 50s linear infinite;
            will-change: transform;
        }
        .marquee-track.marquee-reverse {
            animation-duration: 60s;
            animation-direction: reverse;
        }
        /* Pause the whole wall while the visitor is reading it */
        .marquee-wrap:hover .marquee-track {
            animation-play-state: paused;
        }
        @media (prefers-reduced-motion: reduce) {
            .marquee-track { animation: none; }
        }
    </style>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<!-- Blog Section -->
<section class="py-10 md:py-14 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-newspaper text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Blogs</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Latest <span class="gradient-text">Articles</span>
            </h2>
            <p class="text-lg text-dark-grey/70">
                Guidance on neurological conditions, treatments and recovery â€” written for patients and their families.
            </p>
        </div>

        <!-- 3-column card grid -->
        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 pb-6 -mx-4 px-4 md:mx-0 md:px-0 md:grid md:grid-cols-3 md:gap-8 md:pb-0">
            <?php foreach ($blogs as $blogIdx => $blog): ?>
                <a href="<?php echo $blog['url']; ?>"
                   class="group bg-white rounded-3xl p-5 border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col observe w-[80vw] md:w-auto flex-shrink-0 snap-start"
                   style="animation-delay: <?php echo $blogIdx * 100; ?>ms;">

                    <!-- Image -->
                    <div class="w-full aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-soft-cyan to-silver-grey">
                        <picture>
                            <?php if(!empty($blog['webp']) && file_exists(__DIR__ . '/' . $blog['webp'])): ?>
                            <source srcset="<?php echo htmlspecialchars($blog['webp']); ?>" type="image/webp">
                            <?php endif; ?>
                            <img src="<?php echo htmlspecialchars($blog['image']); ?>"
                                 alt="<?php echo htmlspecialchars($blog['title']); ?>"
                                 loading="lazy"
                                 width="640" height="480"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </picture>
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-bold text-deep-indigo leading-snug mb-3 group-hover:text-electric-blue transition-colors duration-300">
                        <?php echo $blog['title']; ?>
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-sm text-dark-grey/70 leading-relaxed mb-5 flex-1">
                        <?php echo $blog['excerpt']; ?>
                    </p>

                    <!-- Footer: category pill + date -->
                    <div class="mt-auto pt-4 border-t border-silver-grey/60 flex items-center space-x-4">
                        <span class="inline-block bg-electric-blue/10 text-electric-blue text-xs font-bold px-3 py-1.5 rounded-full">
                            <?php echo $blog['category']; ?>
                        </span>
                        <span class="text-xs text-dark-grey/45 font-medium"><?php echo $blog['date']; ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- Awards & Recognition Section -->
<section class="py-10 md:py-14 bg-soft-cyan/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-trophy text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Awards & Recognition</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Honours & <span class="gradient-text">Achievements</span>
            </h2>
            <p class="text-lg text-dark-grey/70">
                National and international recognition for pioneering work in neurology and stroke care.
            </p>
        </div>

        <!-- Grid of award/honour images only -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            <?php foreach ($awards as $award): ?>
                <div class="group overflow-hidden rounded-3xl bg-white border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 aspect-[2/3] observe">
                    <img src="<?php echo $award['image']; ?>" 
                         alt="<?php echo htmlspecialchars($award['title']); ?>" 
                         class="w-full h-full object-cover transition-transform duration-500"
                         width="640" height="480">
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- Education / Knowledge Videos Section -->
<section class="py-10 md:py-14 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-graduation-cap text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Education</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Knowledge & <span class="gradient-text">Awareness</span>
            </h2>
            <p class="text-lg text-dark-grey/70">
                Short, practical explainers on symptoms, treatments and everyday brain health.
            </p>
        </div>

        <!-- Mobile Swipe View (Visible on Mobile only: hidden sm:flex) -->
        <div class="sm:hidden flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 -mx-4 px-4 pb-4">
            <?php foreach ($educationVideos as $video): ?>
                <div class="flex-shrink-0 w-[80vw] snap-start bg-white rounded-3xl overflow-hidden border border-silver-grey/50 shadow-lg">
                    <!-- Embed -->
                    <div class="relative w-full aspect-video bg-dark-grey video-facade cursor-pointer group" data-embed="https://www.youtube.com/embed/<?php echo $video['id']; ?>?rel=0&modestbranding=1&autoplay=1">
                        <img src="https://img.youtube.com/vi/<?php echo $video['id']; ?>/hqdefault.jpg" alt="<?php echo htmlspecialchars($video['title']); ?>" loading="lazy" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/10 transition-colors">
                            <div class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-play text-white ml-1"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Card footer -->
                    <div class="p-4">
                        <h3 class="font-bold text-deep-indigo text-sm leading-snug mb-1 line-clamp-1">
                            <?php echo $video['title']; ?>
                        </h3>
                        <p class="text-xs text-dark-grey/55 leading-relaxed line-clamp-2">
                            <?php echo $video['desc']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Desktop Slider View (Hidden on Mobile: hidden sm:block) -->
        <div class="hidden sm:block overflow-hidden">
            <div id="edu-track" class="flex transition-transform duration-500 ease-in-out">
                <?php
                $eduPages = array_chunk($educationVideos, 3);
                foreach ($eduPages as $epIdx => $epPage):
                ?>
                    <div class="min-w-full grid grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php foreach ($epPage as $video): ?>
                            <div class="group bg-white rounded-3xl overflow-hidden border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 observe">

                                <!-- Embed -->
                                <div class="relative w-full aspect-video bg-dark-grey video-facade cursor-pointer group" data-embed="https://www.youtube.com/embed/<?php echo $video['id']; ?>?rel=0&modestbranding=1&autoplay=1">
                                    <img src="https://img.youtube.com/vi/<?php echo $video['id']; ?>/hqdefault.jpg" alt="<?php echo htmlspecialchars($video['title']); ?>" loading="lazy" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/10 transition-colors">
                                        <div class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                            <i class="fas fa-play text-white ml-1"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card footer -->
                                <div class="p-4">
                                    <h3 class="font-bold text-deep-indigo text-sm md:text-base leading-snug mb-1 group-hover:text-electric-blue transition-colors duration-300 line-clamp-1">
                                        <?php echo $video['title']; ?>
                                    </h3>
                                    <p class="text-xs text-dark-grey/55 leading-relaxed line-clamp-2">
                                        <?php echo $video['desc']; ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Slider controls -->
        <div class="hidden sm:flex items-center justify-between gap-6 mt-8">

            <!-- Dot indicators (wrap so 19 pages never collide with the arrows) -->
            <div class="flex items-center flex-wrap gap-2 flex-1 min-w-0" id="edu-dots">
                <?php foreach ($eduPages as $epIdx => $epPage): ?>
                    <button class="edu-dot rounded-full transition-all duration-300 <?php echo $epIdx === 0 ? 'w-6 h-2.5 bg-electric-blue' : 'w-2.5 h-2.5 bg-silver-grey'; ?>"
                        aria-label="Go to video page <?php echo $epIdx + 1; ?>"
                        data-page="<?php echo $epIdx; ?>"></button>
                <?php endforeach; ?>
            </div>

            <!-- Prev / Next -->
            <div class="flex items-center space-x-3">
                <button id="edu-prev"
                    class="w-11 h-11 rounded-full bg-white hover:bg-electric-blue hover:text-white text-deep-indigo border border-silver-grey shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button id="edu-next"
                    class="w-11 h-11 rounded-full bg-electric-blue text-white hover:bg-deep-indigo border border-electric-blue shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>
        </div>

    </div>

    <!-- Education Slider JS -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const track     = document.getElementById('edu-track');
        const dots      = document.querySelectorAll('.edu-dot');
        const prevBtn   = document.getElementById('edu-prev');
        const nextBtn   = document.getElementById('edu-next');
        const total     = track.children.length;
        let current     = 0;

        function goTo(page) {
            current = page;
            track.style.transform = `translateX(-${page * 100}%)`;
            dots.forEach((d, i) => {
                if (i === page) {
                    d.classList.add('bg-electric-blue', 'w-6');
                    d.classList.remove('bg-silver-grey', 'w-2.5');
                } else {
                    d.classList.remove('bg-electric-blue', 'w-6');
                    d.classList.add('bg-silver-grey', 'w-2.5');
                }
            });
        }

        dots.forEach(d => d.addEventListener('click', () => goTo(+d.dataset.page)));
        prevBtn.addEventListener('click', () => goTo((current - 1 + total) % total));
        nextBtn.addEventListener('click', () => goTo((current + 1) % total));
    });
    </script>
</section>

<!-- â•â•â•â•â•â•â•â• Instagram Reels Section â•â•â•â•â•â•â•â• -->
<section id="instagram-reels" class="py-10 md:py-14 bg-soft-cyan/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fab fa-instagram text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Latest Reels</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Follow the Journey on <span class="gradient-text">Instagram</span>
            </h2>
            <p class="text-lg text-dark-grey/70 mb-6">
                Quick neurology insights, patient moments and behind-the-scenes from the clinic.
            </p>

            <!-- Profile chip -->
            <a href="<?php echo $instagramProfile; ?>" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-3 bg-white pl-2 pr-5 py-2 rounded-full border border-silver-grey/50 shadow-sm hover:shadow-lg transition-all duration-300 group">
                <span class="block p-[2px] rounded-full bg-gradient-to-tr from-cyan-accent via-electric-blue to-deep-indigo">
                    <img src="assets/dpg-1.webp" alt="Dr. Praveen Gupta on Instagram"
                         loading="lazy"
                         class="w-10 h-10 rounded-full object-cover object-top border-2 border-white">
                </span>
                <span class="text-sm font-bold text-deep-indigo group-hover:text-electric-blue transition-colors duration-300">@<?php echo $instagramHandle; ?></span>
            </a>
        </div>

        <!-- Reels layout: Swipe Carousel on Mobile, Grid on Desktop -->
        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 -mx-4 px-4 pb-4 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-8 md:px-0 md:mx-0">
            <?php foreach ($instagramReels as $reelIdx => $reel):
                $reelUrl = 'https://www.instagram.com/reel/' . $reel['id'] . '/';
            ?>
                <div class="flex-shrink-0 w-[80vw] snap-start md:w-auto observe" style="animation-delay: <?php echo $reelIdx * 120; ?>ms;">
                    <!-- Gradient border shell -->
                    <div class="group h-full p-[2px] rounded-3xl bg-gradient-to-br from-cyan-accent via-electric-blue to-deep-indigo shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="h-full bg-white rounded-[22px] overflow-hidden">
                            <!-- Instagram embed (replaced in-place by embed.js) -->
                            <blockquote class="instagram-media !m-0 !w-full !min-w-0 !max-w-none !border-0 !rounded-none !shadow-none"
                                data-instgrm-permalink="<?php echo $reelUrl; ?>?utm_source=ig_embed&amp;utm_campaign=loading"
                                data-instgrm-version="14">

                                <!-- Fallback shown until the Instagram script swaps in the player -->
                                <div class="ig-fallback flex flex-col items-center justify-center aspect-[9/16] w-full bg-gradient-to-br from-soft-cyan to-white px-6 text-center">
                                    <span class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-electric-blue to-cyan-accent text-white flex items-center justify-center text-2xl shadow-lg mb-4">
                                        <i class="fab fa-instagram"></i>
                                    </span>
                                    <p class="text-sm font-semibold text-deep-indigo mb-1">Reel by @<?php echo $instagramHandle; ?></p>
                                    <a href="<?php echo $reelUrl; ?>" target="_blank" rel="noopener noreferrer"
                                       class="text-sm font-bold text-electric-blue hover:underline">View this reel on Instagram</a>
                                </div>
                            </blockquote>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Footer CTA -->
        <div class="text-center mt-10 observe">
            <a href="<?php echo $instagramProfile; ?>" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:shadow-electric-blue/40 hover:-translate-y-0.5 transition-all duration-300">
                <span>Follow on Instagram</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>

    <!-- Instagram embed script (loads once, processes every blockquote on the page) -->
    <script async src="https://www.instagram.com/embed.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // If embed.js was cached and ran before this markup existed, re-process manually.
        let tries = 0;
        const timer = setInterval(function () {
            if (window.instgrm && window.instgrm.Embeds) {
                window.instgrm.Embeds.process();
                clearInterval(timer);
            } else if (++tries > 20) {
                clearInterval(timer);
            }
        }, 300);
    });
    </script>
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Video Facade Logic for Performance and Pausing
            document.querySelectorAll('.video-facade').forEach(facade => {
                facade.addEventListener('click', function() {
                    // Pause/remove iframes from all other facades
                    document.querySelectorAll('.video-facade iframe').forEach(iframe => {
                        let parent = iframe.parentElement;
                        iframe.remove();
                        // Restore play button and image
                        parent.querySelector('img').style.display = 'block';
                        parent.querySelector('div.absolute').style.display = 'flex';
                    });
                    
                    // Hide image and play button for this facade
                    this.querySelector('img').style.display = 'none';
                    this.querySelector('div.absolute').style.display = 'none';
                    
                    // Inject iframe
                    const iframe = document.createElement('iframe');
                    iframe.className = 'w-full h-full absolute inset-0';
                    iframe.src = this.dataset.embed;
                    iframe.title = this.querySelector('img').alt;
                    iframe.setAttribute('frameborder', '0');
                    iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                    iframe.setAttribute('allowfullscreen', '1');
                    
                    this.appendChild(iframe);
                });
            });
        });
    </script>
</section>



<?php require_once __DIR__ . '/includes/footer.php'; ?>
