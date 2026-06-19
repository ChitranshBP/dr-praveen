<?php
/**
 * Homepage - Dr. Praveen Gupta
 */
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-[#edf5f9] -mt-20">
    <div class="w-full max-w-[1920px] mx-auto relative">
        <img src="assets\banner\web-banner-hero.webp" alt="Dr. Praveen Gupta – Best Neurologist in India"
            class="w-full h-auto block min-h-[480px] sm:min-h-[550px] md:min-h-0 object-cover object-[75%_center]">
        
        <!-- Content Overlay -->
        <div class="absolute inset-0 flex items-center bg-gradient-to-r from-deep-indigo/70 via-deep-indigo/35 to-transparent">
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-lg md:max-w-xl lg:max-w-2xl text-white">
                    <!-- Pill Tagline -->
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/20 mb-6 animate-fade-in-up">
                        <span class="w-2 h-2 rounded-full bg-cyan-accent animate-pulse"></span>
                        <span class="text-white text-xs font-semibold uppercase tracking-wider">A New Era in Brain & Spine Care</span>
                    </div>

                    <!-- SEO Optimized H1 Title -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white leading-tight mb-5 animate-fade-in-up drop-shadow-[0_4px_12px_rgba(0,0,0,0.55)]" style="animation-delay: 100ms;">
                        Led by <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-cyan-200 to-cyan-100 font-extrabold">Dr. Praveen Gupta</span>
                        <span class="block text-xl sm:text-2xl md:text-3xl font-sans font-bold text-cyan-200 mt-2">Best Neurologist in India</span>
                    </h1>

                    <!-- Description / Subtitle -->
                    <p class="text-sm sm:text-base md:text-lg text-white/90 leading-relaxed mb-8 max-w-xl animate-fade-in-up font-medium drop-shadow-[0_2px_8px_rgba(0,0,0,0.45)]" style="animation-delay: 200ms;">
                        Chairman at Marengo Asia International Institute of Neuro & Spine. Providing world-class, advanced neurological treatments for Stroke, Epilepsy, Parkinson's, Migraine, and movement disorders.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4 items-center animate-fade-in-up" style="animation-delay: 300ms;">
                        <a href="contact.php"
                           class="inline-flex items-center space-x-2.5 bg-gradient-to-r from-cyan-accent to-blue-500 hover:from-cyan-400 hover:to-blue-600 text-white font-bold px-6 py-3 rounded-full shadow-lg shadow-cyan-accent/20 hover:shadow-cyan-accent/40 hover:-translate-y-0.5 transition-all duration-300">
                            <span>Book Consultation</span>
                            <i class="fas fa-calendar-check text-xs"></i>
                        </a>
                        <a href="#about"
                           class="inline-flex items-center space-x-2.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 hover:border-white/40 text-white font-bold px-6 py-3 rounded-full hover:-translate-y-0.5 transition-all duration-300">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-down text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-12 bg-soft-cyan/30 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-electric-blue via-cyan-accent to-electric-blue">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-stethoscope text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Our Services</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Comprehensive <span class="gradient-text">Healthcare</span> Solutions
            </h2>
            <p class="text-lg text-dark-grey/70">
                From preventive care to specialized treatments, we offer a full spectrum of medical services tailored to
                your unique needs.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($services as $index => $service): ?>
                <div class="group bg-white rounded-3xl p-5 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 flex flex-col justify-between observe"
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
                        <p class="text-dark-grey/70 leading-relaxed text-sm">
                            <?php echo $service['description']; ?>
                        </p>
                    </div>
                </div>
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
                    Why Choose Dr. Praveen Gupta?
                </span>

                <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo leading-tight mb-6">
                    Providing Best Treatment
                </h2>

                <p class="text-base text-dark-grey/70 mb-10 leading-relaxed max-w-lg">
                    With an unwavering commitment to clinical excellence, Dr. Praveen Gupta combines advanced technology
                    and patient-centric therapies to deliver world-class neurological care.
                </p>

                <!-- Grid of 4 Items -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-12">
                    <!-- Feature 1 -->
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-earth-americas text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Global Standards of Care
                            </h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Treatments backed by advanced
                                technology and international guidelines.</p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-lightbulb text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Innovative Procedures</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Pioneer in stroke care, DBS, and
                                epilepsy surgery in India.</p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-circle-check text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Proven Results</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Thousands of patients treated
                                successfully with rapid recovery.</p>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-hand-holding-heart text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Compassionate Consultation
                            </h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Empowering patients with knowledge,
                                compassion, and personalized care.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div>
                    <a href="#appointment"
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

<!-- Testimonials Section -->
<section class="py-12 bg-soft-cyan/30 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-electric-blue via-cyan-accent to-electric-blue"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-comments text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Testimonials</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                What Our <span class="gradient-text">Patients</span> Say
            </h2>
            <p class="text-lg text-dark-grey/70">
                Real stories from real patients who experienced exceptional neurological care.
            </p>
        </div>

        <!-- Two-column grid: phone left | reviews right -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            <!-- ── LEFT: Phone Mockup + Video Slider ── -->
            <div class="flex flex-col items-center observe">

                <!-- Phone shell -->
                <div class="relative w-[272px] h-[510px] bg-deep-indigo rounded-[44px] p-[10px] shadow-2xl border-4 border-deep-indigo/80 ring-8 ring-deep-indigo/10">
                    <!-- Notch -->
                    <div class="absolute top-3 left-1/2 -translate-x-1/2 w-24 h-[22px] bg-deep-indigo rounded-full z-20 flex items-center justify-center gap-2">
                        <div class="w-8 h-[5px] bg-white/10 rounded-full"></div>
                        <div class="w-[7px] h-[7px] bg-cyan-accent/30 rounded-full border border-cyan-accent/40"></div>
                    </div>
                    <!-- Screen -->
                    <div class="relative w-full h-full rounded-[36px] overflow-hidden bg-dark-grey z-10">
                        <?php if (!empty($videoTestimonials)): ?>
                            <?php $firstVideo = $videoTestimonials[0]['id']; ?>
                            <iframe id="youtube-shorts-player" class="w-full h-full"
                                src="https://www.youtube.com/embed/<?php echo $firstVideo; ?>?autoplay=0&mute=1&loop=1&playlist=<?php echo $firstVideo; ?>&controls=1"
                                title="YouTube Shorts" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        <?php endif; ?>
                    </div>
                    <!-- Home bar -->
                    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-20 h-[4px] bg-silver-grey/40 rounded-full z-20"></div>
                </div>

                <!-- Video slider controls -->
                <div class="flex items-center justify-center space-x-4 mt-7">
                    <button id="prev-short"
                        class="w-11 h-11 rounded-full bg-white hover:bg-electric-blue hover:text-white text-deep-indigo border border-silver-grey shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                    <span class="text-xs font-semibold text-deep-indigo bg-white px-5 py-2.5 rounded-full border border-silver-grey shadow-sm">
                        Video <span id="current-short-num">1</span> of <span id="total-shorts-num"><?php echo count($videoTestimonials); ?></span>
                    </span>
                    <button id="next-short"
                        class="w-11 h-11 rounded-full bg-white hover:bg-electric-blue hover:text-white text-deep-indigo border border-silver-grey shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- ── RIGHT: 2×2 Review Grid with Slider ── -->
            <div class="flex flex-col observe">

                <!-- Sliding viewport — clipping wrapper -->
                <div class="overflow-hidden">
                    <div id="reviews-track" class="flex transition-transform duration-500 ease-in-out">

                        <?php
                        $avatarColors = [
                            'from-electric-blue to-cyan-accent',
                            'from-cyan-accent to-electric-blue',
                            'from-deep-indigo to-electric-blue',
                            'from-electric-blue to-deep-indigo',
                        ];
                        // Group testimonials into pages of 4
                        $pages = array_chunk($testimonials, 4);
                        foreach ($pages as $pageIdx => $page):
                        ?>
                            <!-- Page <?php echo $pageIdx + 1; ?> -->
                            <div class="min-w-full grid grid-cols-2 gap-5">
                                <?php foreach ($page as $cardIdx => $testimonial):
                                    $globalIdx = $pageIdx * 4 + $cardIdx;
                                    $color = $avatarColors[$globalIdx % count($avatarColors)];
                                ?>
                                    <div class="group bg-white rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 flex flex-col">


                                        <!-- Quote icon -->
                                        <i class="fas fa-quote-left text-electric-blue/20 text-2xl mb-2"></i>

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
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                <!-- Review slider controls -->
                <div class="flex items-center justify-between mt-8">

                    <!-- Dot indicators -->
                    <div class="flex items-center space-x-2" id="review-dots">
                        <?php foreach ($pages as $pageIdx => $page): ?>
                            <button class="review-dot w-2.5 h-2.5 rounded-full transition-all duration-300 <?php echo $pageIdx === 0 ? 'bg-electric-blue w-6' : 'bg-silver-grey'; ?>"
                                data-page="<?php echo $pageIdx; ?>"></button>
                        <?php endforeach; ?>
                    </div>

                    <!-- Prev / Next -->
                    <div class="flex items-center space-x-3">
                        <button id="prev-review"
                            class="w-11 h-11 rounded-full bg-white hover:bg-electric-blue hover:text-white text-deep-indigo border border-silver-grey shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
                            <i class="fas fa-chevron-left text-sm"></i>
                        </button>
                        <button id="next-review"
                            class="w-11 h-11 rounded-full bg-electric-blue text-white hover:bg-deep-indigo border border-electric-blue shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
                            <i class="fas fa-chevron-right text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- JS: Video Slider + Review Slider -->
        <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ── Video Slider ──
            const videoShorts = <?php echo json_encode($videoTestimonials); ?>;
            let currentShortIndex = 0;
            const player      = document.getElementById('youtube-shorts-player');
            const currentNum  = document.getElementById('current-short-num');
            const prevShort   = document.getElementById('prev-short');
            const nextShort   = document.getElementById('next-short');

            function loadShort(index) {
                currentShortIndex = index;
                const v = videoShorts[index];
                player.src = `https://www.youtube.com/embed/${v.id}?autoplay=0&mute=1&loop=1&playlist=${v.id}&controls=1`;
                currentNum.textContent = index + 1;
            }

            prevShort.addEventListener('click', () => loadShort((currentShortIndex - 1 + videoShorts.length) % videoShorts.length));
            nextShort.addEventListener('click', () => loadShort((currentShortIndex + 1) % videoShorts.length));

            // ── Review Slider ──
            const track      = document.getElementById('reviews-track');
            const dots       = document.querySelectorAll('.review-dot');
            const prevReview = document.getElementById('prev-review');
            const nextReview = document.getElementById('next-review');
            const totalPages = track.children.length;
            let currentPage  = 0;

            function goToPage(page) {
                currentPage = page;
                track.style.transform = `translateX(-${page * 100}%)`;

                dots.forEach((dot, i) => {
                    if (i === page) {
                        dot.classList.add('bg-electric-blue', 'w-6');
                        dot.classList.remove('bg-silver-grey');
                    } else {
                        dot.classList.remove('bg-electric-blue', 'w-6');
                        dot.classList.add('bg-silver-grey');
                    }
                });
            }

            dots.forEach(dot => dot.addEventListener('click', () => goToPage(+dot.dataset.page)));
            prevReview.addEventListener('click', () => goToPage((currentPage - 1 + totalPages) % totalPages));
            nextReview.addEventListener('click', () => goToPage((currentPage + 1) % totalPages));
        });
        </script>

    </div>
</section>

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