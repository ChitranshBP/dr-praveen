<?php
/**
 * Homepage - Dr. Praveen Gupta
 */
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-white">
    <!-- Background decorations -->
    <div class="blob w-96 h-96 bg-cyan-accent/20 -top-20 -right-20 animate-float"></div>
    <div class="blob w-96 h-96 bg-electric-blue/20 -bottom-20 -left-20 animate-float" style="animation-delay: 2s;"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="animate-fade-in-up">
                <div class="inline-flex items-center space-x-2 bg-soft-cyan px-4 py-2 rounded-full mb-6">
                    <span class="w-2 h-2 bg-cyan-accent rounded-full animate-pulse"></span>
                    <span class="text-electric-blue text-sm font-medium">Available for Consultations</span>
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif font-bold text-deep-indigo leading-tight mb-6">
                    Your Health,
                    <span class="gradient-text block">Our Mission</span>
                </h1>

                <p class="text-lg text-dark-grey/70 mb-8 leading-relaxed max-w-lg">
                    With over 25 years of experience in advanced healthcare, Dr. Praveen Gupta provides personalized, compassionate medical care that puts patients first.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 mb-12">
                    <a href="contact.php" class="group px-8 py-4 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold rounded-full hover:shadow-2xl hover:shadow-electric-blue/30 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center space-x-2">
                        <span>Book Appointment</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="about.php" class="px-8 py-4 border-2 border-deep-indigo text-deep-indigo font-semibold rounded-full hover:bg-deep-indigo hover:text-white transition-all duration-300 flex items-center justify-center space-x-2">
                        <i class="fas fa-play-circle"></i>
                        <span>Learn More</span>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="grid grid-cols-3 gap-4 max-w-md">
                    <div class="text-center">
                        <div class="text-3xl font-bold gradient-text">25+</div>
                        <div class="text-xs text-dark-grey/60 mt-1">Years</div>
                    </div>
                    <div class="text-center border-x border-silver-grey">
                        <div class="text-3xl font-bold gradient-text">50K+</div>
                        <div class="text-xs text-dark-grey/60 mt-1">Patients</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold gradient-text">15+</div>
                        <div class="text-xs text-dark-grey/60 mt-1">Awards</div>
                    </div>
                </div>
            </div>

            <!-- Right Content - Doctor Image -->
            <div class="relative animate-fade-in">
                <div class="relative">
                    <!-- Decorative elements -->
                    <div class="absolute -top-6 -right-6 w-32 h-32 bg-gradient-to-br from-cyan-accent to-electric-blue rounded-full opacity-20 animate-pulse-slow"></div>
                    <div class="absolute -bottom-6 -left-6 w-40 h-40 bg-gradient-to-br from-electric-blue to-deep-indigo rounded-full opacity-20 animate-pulse-slow" style="animation-delay: 1s;"></div>

                    <!-- Main image container -->
                    <div class="relative aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey">
                        <!-- Doctor illustration placeholder -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center p-8">
                                <div class="w-48 h-48 mx-auto mb-6 rounded-full bg-gradient-to-br from-electric-blue to-cyan-accent flex items-center justify-center shadow-xl">
                                    <i class="fas fa-user-md text-7xl text-white"></i>
                                </div>
                                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-lg">
                                    <h3 class="text-xl font-bold text-deep-indigo">Dr. Praveen Gupta</h3>
                                    <p class="text-sm text-cyan-accent font-medium">MBBS, MD - Internal Medicine</p>
                                </div>
                            </div>
                        </div>

                        <!-- Floating badges -->
                        <div class="absolute top-6 right-6 glass-effect rounded-2xl p-3 animate-float">
                            <div class="flex items-center space-x-2">
                                <div class="w-10 h-10 rounded-full bg-cyan-accent/20 flex items-center justify-center">
                                    <i class="fas fa-award text-cyan-accent"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-deep-indigo">Verified</p>
                                    <p class="text-xs text-dark-grey/60">Specialist</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute bottom-6 left-6 glass-effect rounded-2xl p-3 animate-float" style="animation-delay: 1.5s;">
                            <div class="flex items-center space-x-2">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-star text-green-500"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-deep-indigo">4.9 Rating</p>
                                    <p class="text-xs text-dark-grey/60">2000+ Reviews</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-24 bg-soft-cyan/30 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-electric-blue via-cyan-accent to-electric-blue"></div>

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
                From preventive care to specialized treatments, we offer a full spectrum of medical services tailored to your unique needs.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($services as $index => $service): ?>
                <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 observe" style="animation-delay: <?php echo $index * 100; ?>ms;">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-electric-blue to-cyan-accent flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-electric-blue/20">
                        <i class="fas fa-<?php echo $service['icon']; ?> text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-indigo mb-3 group-hover:text-electric-blue transition-colors">
                        <?php echo $service['title']; ?>
                    </h3>
                    <p class="text-dark-grey/70 leading-relaxed mb-6">
                        <?php echo $service['description']; ?>
                    </p>
                    <a href="services.php" class="inline-flex items-center space-x-2 text-electric-blue font-semibold group-hover:text-cyan-accent transition-colors">
                        <span>Learn More</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 gradient-bg relative overflow-hidden">
    <div class="blob w-72 h-72 bg-white/20 top-10 left-10"></div>
    <div class="blob w-72 h-72 bg-white/20 bottom-10 right-10"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($stats as $stat): ?>
                <div class="text-center text-white observe">
                    <div class="text-5xl md:text-6xl font-bold mb-2 font-serif"><?php echo $stat['number']; ?></div>
                    <div class="text-white/80 text-sm md:text-base"><?php echo $stat['label']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Image Side -->
            <div class="relative observe">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="aspect-square rounded-3xl bg-gradient-to-br from-electric-blue to-cyan-accent flex items-center justify-center shadow-xl">
                            <i class="fas fa-heartbeat text-white text-6xl"></i>
                        </div>
                        <div class="aspect-square rounded-3xl bg-soft-cyan flex items-center justify-center shadow-lg">
                            <i class="fas fa-shield-alt text-electric-blue text-5xl"></i>
                        </div>
                    </div>
                    <div class="space-y-4 pt-8">
                        <div class="aspect-square rounded-3xl bg-soft-cyan flex items-center justify-center shadow-lg">
                            <i class="fas fa-user-md text-electric-blue text-5xl"></i>
                        </div>
                        <div class="aspect-square rounded-3xl bg-gradient-to-br from-deep-indigo to-electric-blue flex items-center justify-center shadow-xl">
                            <i class="fas fa-hospital text-white text-6xl"></i>
                        </div>
                    </div>
                </div>
                <!-- Floating badge -->
                <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl p-6 shadow-2xl animate-float">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-deep-indigo">100%</p>
                            <p class="text-sm text-dark-grey/60">Patient Safety</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Side -->
            <div class="observe">
                <div class="inline-flex items-center space-x-2 bg-soft-cyan px-4 py-2 rounded-full mb-4">
                    <i class="fas fa-star text-cyan-accent text-sm"></i>
                    <span class="text-electric-blue text-sm font-semibold">Why Choose Us</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-6">
                    Healthcare That
                    <span class="gradient-text">Puts You First</span>
                </h2>
                <p class="text-lg text-dark-grey/70 mb-8 leading-relaxed">
                    We combine cutting-edge medical technology with personalized care to deliver the best possible outcomes for our patients.
                </p>

                <div class="space-y-6">
                    <div class="flex items-start space-x-4 group">
                        <div class="w-12 h-12 rounded-xl bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 transition-colors duration-300">
                            <i class="fas fa-certificate text-electric-blue group-hover:text-white transition-colors"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-deep-indigo mb-1">Board Certified Expert</h3>
                            <p class="text-dark-grey/70">Highly qualified with international certifications and continuous medical education.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 group">
                        <div class="w-12 h-12 rounded-xl bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 transition-colors duration-300">
                            <i class="fas fa-clock text-electric-blue group-hover:text-white transition-colors"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-deep-indigo mb-1">24/7 Patient Support</h3>
                            <p class="text-dark-grey/70">Round-the-clock availability for emergencies and patient queries.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 group">
                        <div class="w-12 h-12 rounded-xl bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 transition-colors duration-300">
                            <i class="fas fa-microscope text-electric-blue group-hover:text-white transition-colors"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-deep-indigo mb-1">Advanced Technology</h3>
                            <p class="text-dark-grey/70">State-of-the-art equipment and modern diagnostic facilities.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 group">
                        <div class="w-12 h-12 rounded-xl bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 transition-colors duration-300">
                            <i class="fas fa-hand-holding-heart text-electric-blue group-hover:text-white transition-colors"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-deep-indigo mb-1">Personalized Care</h3>
                            <p class="text-dark-grey/70">Treatment plans customized to your unique health needs and goals.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-24 bg-soft-cyan/40 relative overflow-hidden">
    <div class="absolute top-20 left-10 w-32 h-32 bg-cyan-accent/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-40 h-40 bg-electric-blue/20 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 observe">
            <div class="inline-flex items-center space-x-2 bg-white px-4 py-2 rounded-full mb-4 shadow-sm">
                <i class="fas fa-comments text-cyan-accent text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Testimonials</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                What Our <span class="gradient-text">Patients</span> Say
            </h2>
            <p class="text-lg text-dark-grey/70">
                Real stories from real patients who experienced exceptional care.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 observe">
                    <!-- Stars -->
                    <div class="flex space-x-1 mb-4">
                        <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                            <i class="fas fa-star text-yellow-400"></i>
                        <?php endfor; ?>
                    </div>

                    <p class="text-dark-grey/80 italic mb-6 leading-relaxed">
                        "<?php echo $testimonial['message']; ?>"
                    </p>

                    <div class="flex items-center space-x-3 pt-4 border-t border-silver-grey">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-electric-blue to-cyan-accent flex items-center justify-center text-white font-bold text-lg">
                            <?php echo strtoupper(substr($testimonial['name'], 0, 1)); ?>
                        </div>
                        <div>
                            <p class="font-bold text-deep-indigo"><?php echo $testimonial['name']; ?></p>
                            <p class="text-sm text-cyan-accent"><?php echo $testimonial['role']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Appointment Form Section -->
<section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent rounded-3xl shadow-2xl overflow-hidden relative">
            <div class="blob w-64 h-64 bg-white/10 top-0 right-0"></div>
            <div class="blob w-64 h-64 bg-white/10 bottom-0 left-0"></div>

            <div class="relative grid grid-cols-1 lg:grid-cols-2">
                <!-- Left Content -->
                <div class="p-8 md:p-12 text-white">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold mb-4">
                        Book Your Appointment
                    </h2>
                    <p class="text-white/80 mb-8 leading-relaxed">
                        Schedule your consultation today and take the first step towards better health.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <span>Free initial consultation</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <span>Flexible scheduling options</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <span>Same-day appointments available</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <span>Insurance accepted</span>
                        </div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone-volume text-2xl"></i>
                            <div>
                                <p class="text-sm text-white/70">Emergency? Call us now</p>
                                <a href="tel:<?php echo SITE_PHONE; ?>" class="text-lg font-bold hover:text-cyan-accent transition-colors"><?php echo SITE_PHONE; ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Form -->
                <div class="bg-white p-8 md:p-12">
                    <h3 class="text-2xl font-bold text-deep-indigo mb-6">Schedule Now</h3>
                    <form class="space-y-4" onsubmit="event.preventDefault(); alert('Appointment request submitted! We will contact you shortly.');">
                        <div>
                            <label class="block text-sm font-medium text-dark-grey mb-2">Full Name</label>
                            <input type="text" required placeholder="John Doe"
                                   class="w-full px-4 py-3 rounded-xl border border-silver-grey focus:border-electric-blue focus:ring-2 focus:ring-electric-blue/20 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-dark-grey mb-2">Email Address</label>
                            <input type="email" required placeholder="john@example.com"
                                   class="w-full px-4 py-3 rounded-xl border border-silver-grey focus:border-electric-blue focus:ring-2 focus:ring-electric-blue/20 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-dark-grey mb-2">Phone Number</label>
                            <input type="tel" required placeholder="+91 98765 43210"
                                   class="w-full px-4 py-3 rounded-xl border border-silver-grey focus:border-electric-blue focus:ring-2 focus:ring-electric-blue/20 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-dark-grey mb-2">Preferred Date</label>
                            <input type="date" required
                                   class="w-full px-4 py-3 rounded-xl border border-silver-grey focus:border-electric-blue focus:ring-2 focus:ring-electric-blue/20 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-dark-grey mb-2">Service Required</label>
                            <select required
                                    class="w-full px-4 py-3 rounded-xl border border-silver-grey focus:border-electric-blue focus:ring-2 focus:ring-electric-blue/20 outline-none transition-all">
                                <option value="">Select a service</option>
                                <?php foreach ($services as $service): ?>
                                    <option value="<?php echo $service['title']; ?>"><?php echo $service['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-electric-blue/30 transition-all duration-300 transform hover:-translate-y-0.5">
                            Confirm Appointment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
