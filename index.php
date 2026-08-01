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
    <h1 class="sr-only">Dr. Praveen Gupta – Best Neurologist in India | Transforming Brain &amp; Spine Care with Precision</h1>

    <div id="hero-slider" class="w-full max-w-[1920px] mx-auto relative">
        <div id="hero-track" class="flex transition-transform duration-700 ease-in-out">
            <div class="min-w-full relative">
                <img src="assets/banner/dr-parveen-gupta-banner.png"
                     alt="Transforming Brain &amp; Spine Care with Precision – Led by Dr. Praveen Gupta, Chairman, Marengo Asia International Institute of Neuro &amp; Spine"
                     fetchpriority="high"
                     class="w-full h-[320px] sm:h-[400px] md:h-auto object-cover object-[32%_center] md:object-center block">
            </div>
            <div class="min-w-full relative">
                <img src="assets/banner/dr-parveen-gupta-banner-2.png"
                     alt="Your Brain Deserves Expert Care – Empowering every thought for a life beyond neurological limits"
                     loading="lazy"
                     class="w-full h-[320px] sm:h-[400px] md:h-auto object-cover object-[32%_center] md:object-center block">
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
<section class="py-12 bg-soft-cyan/30 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-electric-blue via-cyan-accent to-electric-blue">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-stethoscope text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">How We Can Help</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Specialized Care for Your <span class="gradient-text">Brain & Spine</span> Health
            </h2>
            <p class="text-lg text-dark-grey/70">
                We offer advanced treatments and caring support for a wide range of neurological conditions. Explore our areas of expertise below to see how we can guide your recovery.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($services as $index => $service): 
                $link = getServicePageLink($service['title']);
            ?>
                <a href="<?php echo $link; ?>" class="group bg-white rounded-3xl p-5 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 flex flex-col justify-between observe"
                    style="animation-delay: <?php echo $index * 100; ?>ms;">
                    <div>
                        <!-- Image Container -->
                        <div
                            class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-soft-cyan to-silver-grey">
                            <img src="<?php echo $service['image']; ?>" alt="<?php echo $service['title']; ?>"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
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
<section class="relative overflow-hidden pb-16 w-full bg-white select-none">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Slider Wrapper -->
        <div id="banner-slider" class="relative w-full overflow-hidden rounded-[32px] shadow-lg border border-silver-grey/30">
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
<section class="py-12 bg-[#d4e9f7] relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($stats as $stat): ?>
                <div
                    class="bg-white rounded-2xl p-6 md:p-8 shadow-sm flex flex-col justify-between h-full text-left observe">
                    <div>
                        <div class="text-4xl font-extrabold text-dark-grey mb-1"><?php echo $stat['number']; ?></div>
                        <div class="text-base font-bold text-deep-indigo mb-4"><?php echo $stat['label']; ?></div>
                        <div class="w-full h-px bg-gray-100 my-4"></div>
                        <p class="text-sm text-dark-grey/70 leading-relaxed mt-4"><?php echo $stat['description']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- About Doctor Section -->
<section id="about" class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Image Side -->
            <div class="lg:col-span-5 relative observe">
                <div
                    class="aspect-[4/5] rounded-3xl overflow-hidden shadow-xl bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets\dpg-1.webp"
                        alt="Neurology Care Team" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Content Side -->
            <div class="lg:col-span-7 observe">
                <span class="text-xs font-bold tracking-wider text-dark-grey/60 uppercase block mb-3 font-sans">
                    About Dr. Praveen Gupta
                </span>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo leading-tight mb-4">
                    Dr. Praveen Gupta – Best Neurologist in India
                </h2>

                <!-- Prestigious Appointments -->
                <div class="flex flex-col space-y-2.5 mb-6">
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-award text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chairman – Marengo Asia International Institute of Neuro and Spine</span>
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
                    A true innovator, he has been responsible for several firsts in the country’s neurology landscape:
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
                <div class="mb-10">
                    <a href="about.php"
                        class="inline-flex items-center space-x-4 border-2 border-dark-grey px-6 py-2.5 rounded-full hover:bg-dark-grey hover:text-white transition-all duration-300 group">
                        <span
                            class="text-sm font-bold text-dark-grey group-hover:text-white transition-colors duration-300">More
                            About us</span>
                        <div
                            class="w-8 h-8 rounded-full bg-dark-grey text-white flex items-center justify-center text-xs group-hover:bg-white group-hover:text-dark-grey transition-colors duration-300 flex-shrink-0">
                            <i class="fas fa-arrow-right -rotate-45 transition-transform duration-300"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-12 bg-slate-50/50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Content Side -->
            <div class="lg:col-span-6 observe">
                <span class="text-xs font-bold tracking-wider text-dark-grey/60 uppercase block mb-3 font-sans">
                    Why Patients Trust Us
                </span>

                <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo leading-tight mb-6">
                    Compassionate Care That Puts You First
                </h2>

                <p class="text-base text-dark-grey/70 mb-10 leading-relaxed max-w-lg">
                    Dealing with neurological concerns can feel overwhelming. We are here to support you at every step with clear answers, advanced treatments, and a caring team focused on your comfort and recovery.
                </p>

                <!-- Grid of 4 Items -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-12">
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
                    <a href="contact-us-top-neurologist-delhi-ncr.php"
                        class="inline-flex items-center px-8 py-3.5 bg-[#111827] text-white text-sm font-bold rounded-full hover:bg-electric-blue transition-colors duration-300 shadow-lg shadow-dark-grey/10">
                        Get Started
                    </a>
                </div>
            </div>

            <!-- Image Side -->
            <div class="lg:col-span-6 relative flex justify-center lg:justify-end observe">
                <div
                    class="relative w-full max-w-md lg:max-w-none aspect-[3:4] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <!-- Background Portrait Photo -->
                    <img src="assets\full-image\dpg-award.webp"
                        alt="Compassionate Care Nurse" class="w-full h-full object-cover">

                    <!-- Floating Overlaid Card -->

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tech Section -->
<section class="py-12 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 observe">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Advanced Technology</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mt-2">Smart Tech for Faster Recovery</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                We combine clinical expertise with state-of-the-art diagnostic and recovery tracking tools to ensure precise treatments.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            <!-- Tech 1: Phezee -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-[32px] space-y-4 hover:shadow-md transition-shadow observe">
                <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-silver-grey mb-4">
                    <img src="https://images.unsplash.com/photo-1607613009820-a29f7bb81c04?auto=format&fit=crop&q=80&w=600" alt="Phezee Biofeedback" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-bold text-deep-indigo font-serif">PHEZEE - Smart Biofeedback</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A smart wearable device used during physiotherapy sessions to monitor muscle health, track joint Range of Motion (ROM), and log precise electromyography (EMG) recovery trends in real-time.
                </p>
            </div>

            <!-- Tech 2: Fall Risk Assessment -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-[32px] space-y-4 hover:shadow-md transition-shadow observe">
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
<section class="py-12 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 observe">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Our Team</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mt-2">Specialists & Support Staff</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Working together under the clinical leadership of Dr. Praveen Gupta to guide you back to wellness.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            <?php foreach ($homepageTeam as $doc): ?>
            <!-- Dynamic Team Card -->
            <a href="team.php" class="group bg-white border border-silver-grey/30 p-6 rounded-[32px] shadow-sm hover:shadow-lg hover:border-electric-blue/30 transition-all duration-300 observe flex flex-col items-center text-center hover:-translate-y-1">
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
            <a href="team.php" class="inline-flex items-center space-x-2.5 bg-deep-indigo hover:bg-electric-blue text-white text-xs font-bold px-6 py-2.5 rounded-full transition-colors">
                <span>View Full Team Details</span>
                <i class="fas fa-arrow-right text-[10px] ml-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- ════════ Written Testimonials Section ════════ -->
<section class="py-12 bg-soft-cyan/30 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-electric-blue via-cyan-accent to-electric-blue"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14 observe">
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

        <!-- Review Carousel -->
        <div class="carousel observe" data-carousel>
            <div class="overflow-hidden">
                <div class="flex -mx-3 transition-transform duration-500 ease-out" data-track>
                    <?php
                    $avatarColors = [
                        'from-electric-blue to-cyan-accent',
                        'from-cyan-accent to-electric-blue',
                        'from-deep-indigo to-electric-blue',
                        'from-electric-blue to-deep-indigo',
                    ];
                    foreach ($testimonials as $idx => $testimonial):
                        $color = $avatarColors[$idx % count($avatarColors)];
                    ?>
                        <div class="w-full sm:w-1/2 lg:w-1/3 px-3 flex-shrink-0" data-slide>
                            <div class="group h-full bg-white rounded-3xl p-7 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 flex flex-col">

                                <!-- Rating -->
                                <div class="flex items-center space-x-1 mb-4 text-amber-400 text-sm">
                                    <?php for ($s = 0; $s < (int) ($testimonial['rating'] ?? 5); $s++): ?>
                                        <i class="fas fa-star"></i>
                                    <?php endfor; ?>
                                </div>

                                <!-- Quote icon -->
                                <i class="fas fa-quote-left text-electric-blue/20 text-2xl mb-3"></i>

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
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Carousel controls -->
            <div class="flex items-center justify-between mt-8">
                <div class="flex items-center space-x-2" data-dots></div>
                <div class="flex items-center space-x-3">
                    <button type="button" data-prev aria-label="Previous reviews"
                        class="w-11 h-11 rounded-full bg-white hover:bg-electric-blue hover:text-white text-deep-indigo border border-silver-grey shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                    <button type="button" data-next aria-label="Next reviews"
                        class="w-11 h-11 rounded-full bg-electric-blue text-white hover:bg-deep-indigo border border-electric-blue shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center mt-12 observe">
            <a href="patient-reviews.php"
               class="inline-flex items-center space-x-2 bg-white hover:bg-electric-blue text-deep-indigo hover:text-white font-bold px-7 py-3.5 rounded-full border border-silver-grey shadow-sm hover:shadow-lg transition-all duration-300">
                <span>Read All Patient Reviews</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>
</section>

<!-- ════════ Video Testimonials Section ════════ -->
<section class="py-14 bg-deep-indigo relative overflow-hidden">
    <!-- Ambient glow -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-electric-blue/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-cyan-accent/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14 observe">
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 mb-4">
                <i class="fas fa-play-circle text-cyan-accent text-sm"></i>
                <span class="text-white text-sm font-semibold">Video Testimonials</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-4">
                Hear It From Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-200 to-cyan-accent">Patients</span>
            </h2>
            <p class="text-lg text-white/70">
                Watch patients share their recovery journeys with Dr. Praveen Gupta in their own words.
            </p>
        </div>

        <!-- Video Carousel -->
        <div class="carousel observe" data-carousel>
            <div class="overflow-hidden">
                <div class="flex -mx-3 transition-transform duration-500 ease-out" data-track>
                    <?php foreach ($videoTestimonials as $vIdx => $video): ?>
                        <div class="w-[72%] sm:w-1/2 md:w-1/3 lg:w-1/4 px-3 flex-shrink-0" data-slide>
                            <div class="group relative w-full aspect-[9/16] rounded-3xl overflow-hidden bg-black/40 border border-white/10 shadow-xl hover:shadow-cyan-accent/20 hover:-translate-y-1.5 transition-all duration-500"
                                 data-video-card data-video-id="<?php echo $video['id']; ?>">

                                <img src="https://img.youtube.com/vi/<?php echo $video['id']; ?>/hqdefault.jpg"
                                     alt="<?php echo htmlspecialchars($video['title']); ?>"
                                     loading="lazy"
                                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                                <!-- Gradient overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-deep-indigo/90 via-deep-indigo/10 to-transparent"></div>

                                <!-- Play button -->
                                <button type="button" aria-label="Play <?php echo htmlspecialchars($video['title']); ?>"
                                    class="absolute inset-0 flex items-center justify-center focus:outline-none">
                                    <span class="w-16 h-16 rounded-full bg-white/15 backdrop-blur-md border border-white/40 flex items-center justify-center text-white text-xl shadow-lg group-hover:bg-cyan-accent group-hover:scale-110 transition-all duration-300">
                                        <i class="fas fa-play ml-1"></i>
                                    </span>
                                </button>

                                <!-- Caption -->
                                <div class="absolute bottom-0 left-0 right-0 p-5 pointer-events-none">
                                    <p class="text-white font-bold text-sm leading-snug"><?php echo htmlspecialchars($video['title']); ?></p>
                                    <p class="text-cyan-200 text-xs font-medium mt-1">Patient Testimonial</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Carousel controls -->
            <div class="flex items-center justify-between mt-8">
                <div class="flex items-center space-x-2" data-dots data-dot-active="bg-cyan-accent" data-dot-idle="bg-white/30"></div>
                <div class="flex items-center space-x-3">
                    <button type="button" data-prev aria-label="Previous videos"
                        class="w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-sm transition-all duration-300 flex items-center justify-center active:scale-95">
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                    <button type="button" data-next aria-label="Next videos"
                        class="w-11 h-11 rounded-full bg-cyan-accent hover:bg-electric-blue text-white border border-cyan-accent hover:border-electric-blue transition-all duration-300 flex items-center justify-center active:scale-95">
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center mt-12 observe">
            <a href="video-testimonials.php"
               class="inline-flex items-center space-x-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/25 hover:border-white/50 text-white font-bold px-7 py-3.5 rounded-full transition-all duration-300">
                <span>Watch All Video Testimonials</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>
</section>

<!-- JS: Testimonial carousels (written + video) -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Generic card carousel (responsive: steps by one card, clamps at the end) ──
    document.querySelectorAll('[data-carousel]').forEach(function (root) {
        const track   = root.querySelector('[data-track]');
        const slides  = Array.from(root.querySelectorAll('[data-slide]'));
        const dotsBox = root.querySelector('[data-dots]');
        const prevBtn = root.querySelector('[data-prev]');
        const nextBtn = root.querySelector('[data-next]');
        if (!track || !slides.length) return;

        const activeCls = (dotsBox && dotsBox.dataset.dotActive) || 'bg-electric-blue';
        const idleCls   = (dotsBox && dotsBox.dataset.dotIdle)   || 'bg-silver-grey';

        let index = 0;
        let maxIndex = 0;

        function visibleCount() {
            const viewport = track.parentElement.clientWidth;
            const step = slides[0].offsetWidth + (parseFloat(getComputedStyle(track).columnGap) || 0);
            if (!step) return 1;
            return Math.max(1, Math.round(viewport / step));
        }

        function buildDots() {
            if (!dotsBox) return;
            dotsBox.innerHTML = '';
            for (let i = 0; i <= maxIndex; i++) {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
                dot.className = 'w-2.5 h-2.5 rounded-full transition-all duration-300 ' + idleCls;
                dot.addEventListener('click', () => goTo(i));
                dotsBox.appendChild(dot);
            }
        }

        function paintDots() {
            if (!dotsBox) return;
            Array.from(dotsBox.children).forEach((dot, i) => {
                dot.classList.toggle(activeCls, i === index);
                dot.classList.toggle('w-6', i === index);
                dot.classList.toggle(idleCls, i !== index);
            });
        }

        function goTo(i) {
            index = Math.min(Math.max(i, 0), maxIndex);
            track.style.transform = `translateX(-${slides[index].offsetLeft - slides[0].offsetLeft}px)`;
            paintDots();
        }

        function layout() {
            maxIndex = Math.max(0, slides.length - visibleCount());
            buildDots();
            goTo(Math.min(index, maxIndex));
        }

        prevBtn && prevBtn.addEventListener('click', () => goTo(index === 0 ? maxIndex : index - 1));
        nextBtn && nextBtn.addEventListener('click', () => goTo(index >= maxIndex ? 0 : index + 1));

        // Touch / swipe
        let startX = 0;
        root.addEventListener('touchstart', (e) => { startX = e.changedTouches[0].screenX; }, { passive: true });
        root.addEventListener('touchend', (e) => {
            const delta = e.changedTouches[0].screenX - startX;
            if (Math.abs(delta) > 50) goTo(delta < 0 ? index + 1 : index - 1);
        }, { passive: true });

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(layout, 150);
        });

        layout();
    });

    // ── Click-to-play video testimonial cards (thumbnail → iframe) ──
    document.querySelectorAll('[data-video-card]').forEach(function (card) {
        card.addEventListener('click', function () {
            if (card.dataset.playing === 'true') return;
            card.dataset.playing = 'true';
            const id = card.dataset.videoId;
            card.innerHTML = '<iframe class="absolute inset-0 w-full h-full" '
                + 'src="https://www.youtube.com/embed/' + id + '?autoplay=1&rel=0&modestbranding=1&playsinline=1" '
                + 'title="Patient video testimonial" frameborder="0" '
                + 'allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" '
                + 'allowfullscreen></iframe>';
        });
    });
});
</script>

<!-- Blog Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Left-aligned header (matches reference image) -->
        <div class="mb-12 observe">
            <div class="flex items-center space-x-2 mb-3">
                <i class="fas fa-newspaper text-dark-grey/40 text-sm"></i>
                <span class="text-sm text-dark-grey/50 font-medium">Blogs</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-dark-grey leading-tight">
                Latest Articles
            </h2>
        </div>

        <!-- 3-column card grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($blogs as $blog): ?>
                <a href="<?php echo $blog['url']; ?>"
                   class="group flex flex-col observe">

                    <!-- Image -->
                    <div class="w-full aspect-[16/10] rounded-2xl overflow-hidden mb-5 bg-silver-grey">
                        <img src="<?php echo $blog['image']; ?>"
                             alt="<?php echo htmlspecialchars($blog['title']); ?>"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Title -->
                    <h3 class="text-lg font-bold text-dark-grey leading-snug mb-2 group-hover:text-electric-blue transition-colors duration-300">
                        <?php echo $blog['title']; ?>
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-5 flex-1">
                        <?php echo $blog['excerpt']; ?>
                    </p>

                    <!-- Footer: category pill + date -->
                    <div class="flex items-center space-x-4">
                        <span class="inline-block border border-silver-grey text-dark-grey/70 text-xs font-medium px-3 py-1.5 rounded-full">
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
<section class="py-12 bg-soft-cyan/30 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-electric-blue via-cyan-accent to-electric-blue"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Left-aligned header -->
        <div class="mb-12 observe">
            <div class="flex items-center space-x-2 mb-3">
                <i class="fas fa-trophy text-amber-400 text-sm"></i>
                <span class="text-sm text-dark-grey/50 font-medium">Awards & Recognition</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-dark-grey leading-tight">
                Honours & Achievements
            </h2>
        </div>

        <!-- Grid of award/honour images only -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 lg:gap-8">
            <?php foreach ($awards as $award): ?>
                <div class="group overflow-hidden rounded-3xl bg-white shadow-md border border-silver-grey/50 aspect-[2/3] observe">
                    <img src="<?php echo $award['image']; ?>" 
                         alt="<?php echo htmlspecialchars($award['title']); ?>" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- Education / Knowledge Videos Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Left-aligned header -->
        <div class="mb-12 observe">
            <div class="flex items-center space-x-2 mb-3">
                <i class="fas fa-play-circle text-electric-blue text-sm"></i>
                <span class="text-sm text-dark-grey/50 font-medium">Education</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-dark-grey leading-tight">
                Knowledge & Awareness
            </h2>
        </div>

        <!-- Sliding viewport: shows 4 videos (2×2) per page -->
        <div class="overflow-hidden">
            <div id="edu-track" class="flex transition-transform duration-500 ease-in-out">
                <?php
                $eduPages = array_chunk($educationVideos, 4);
                foreach ($eduPages as $epIdx => $epPage):
                ?>
                    <div class="min-w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php foreach ($epPage as $video): ?>
                            <div class="group bg-white rounded-2xl overflow-hidden border border-silver-grey/50 shadow-sm hover:shadow-xl transition-all duration-400 hover:-translate-y-1 observe">

                                <!-- Embed -->
                                <div class="relative w-full aspect-video bg-dark-grey">
                                    <iframe
                                        class="w-full h-full"
                                        src="https://www.youtube.com/embed/<?php echo $video['id']; ?>?rel=0&modestbranding=1"
                                        title="<?php echo htmlspecialchars($video['title']); ?>"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                        loading="lazy">
                                    </iframe>
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
        <div class="flex items-center justify-between mt-8">

            <!-- Dot indicators -->
            <div class="flex items-center space-x-2" id="edu-dots">
                <?php foreach ($eduPages as $epIdx => $epPage): ?>
                    <button class="edu-dot rounded-full transition-all duration-300 <?php echo $epIdx === 0 ? 'w-6 h-2.5 bg-electric-blue' : 'w-2.5 h-2.5 bg-silver-grey'; ?>"
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



<?php require_once __DIR__ . '/includes/footer.php'; ?>