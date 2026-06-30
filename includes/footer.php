<?php
/**
 * Footer Include
 */
$currentYear = date('Y');

// Build footer services from main config (limit to 6 for layout)
$serviceIcons = [
    'Epilepsy' => 'bolt',
    'Headache' => 'head-side-virus',
    'Migraine' => 'brain',
    'Stroke' => 'heart-pulse',
    'Vertigo' => 'sync',
    "Parkinson's Disease" => 'walking',
    'Multiple Sclerosis' => 'ribbon',
    'Movement Disorders' => 'person-walking',
    'Peripheral Neuropathy' => 'hand-holding-medical',
];

$footerServices = [];
foreach (array_slice($services, 0, 6) as $svc) {
    $footerServices[] = [
        'name' => $svc['title'],
        'icon' => $serviceIcons[$svc['title']] ?? 'stethoscope',
    ];
}
?>

    <!-- CTA Section -->
    <section class="relative py-12 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Main CTA Card -->
            <div class="relative bg-gradient-to-r from-electric-blue to-cyan-accent rounded-[36px] overflow-hidden shadow-2xl p-8 md:p-14 lg:p-16">

                <!-- Concentric Circles Pattern (Right Side) -->
                <div class="absolute -right-64 top-1/2 -translate-y-1/2 w-[850px] h-[850px] flex items-center justify-center pointer-events-none z-0">
                    <div class="absolute w-[850px] h-[850px] bg-white/[0.03] rounded-full"></div>
                    <div class="absolute w-[720px] h-[720px] bg-white/[0.05] rounded-full"></div>
                    <div class="absolute w-[590px] h-[590px] bg-white/[0.07] rounded-full"></div>
                    <div class="absolute w-[460px] h-[460px] bg-white/[0.09] rounded-full"></div>
                    <div class="absolute w-[330px] h-[330px] bg-white/[0.11] rounded-full"></div>
                    <div class="absolute w-[200px] h-[200px] bg-white/[0.13] rounded-full"></div>
                    <div class="absolute w-[70px]  h-[70px]  bg-white/[0.15] rounded-full"></div>
                </div>

                <!-- Content (Left Aligned) -->
                <div class="relative z-10 max-w-2xl text-left">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-sans font-extrabold text-white mb-4 leading-tight tracking-tight">
                        Let's Get In Touch.
                    </h2>

                    <p class="text-white/85 text-sm md:text-base mb-10 max-w-lg leading-relaxed">
                        Ready to prioritize your health? Schedule a consultation with Dr. Praveen Gupta today and take the first step towards a healthier tomorrow.
                    </p>

                    <!-- Buttons Row -->
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Book Appointment Button -->
                        <a href="contact.php"
                           class="inline-flex items-center space-x-6 bg-[#111827] text-white text-xs md:text-sm font-semibold pl-6 pr-2.5 py-2.5 rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:-translate-y-0.5 active:translate-y-0 group">
                            <span>Book Appointment</span>
                            <!-- Glossy metallic dot indicator -->
                            <div class="w-7 h-7 rounded-full bg-gradient-to-b from-white via-slate-100 to-slate-400 shadow-[inset_0_1px_2px_rgba(255,255,255,0.8),0_2px_4px_rgba(0,0,0,0.3)] flex items-center justify-center text-[#111827] text-xs font-bold transition-transform duration-300 group-hover:scale-110 flex-shrink-0">
                                <i class="fas fa-chevron-right text-[9px]"></i>
                            </div>
                        </a>

                        <!-- Call Now Button -->
                        <a href="tel:<?php echo SITE_PHONE; ?>"
                           class="inline-flex items-center space-x-6 bg-[#111827] text-white text-xs md:text-sm font-semibold pl-6 pr-2.5 py-2.5 rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:-translate-y-0.5 active:translate-y-0 group">
                            <span>Call Now</span>
                            <!-- Glossy metallic dot indicator -->
                            <div class="w-7 h-7 rounded-full bg-gradient-to-b from-white via-slate-100 to-slate-400 shadow-[inset_0_1px_2px_rgba(255,255,255,0.8),0_2px_4px_rgba(0,0,0,0.3)] flex items-center justify-center text-[#111827] text-xs font-bold transition-transform duration-300 group-hover:scale-110 flex-shrink-0">
                                <i class="fas fa-phone text-[9px]"></i>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-deep-indigo text-white relative overflow-hidden">
        <!-- Decorative background -->
        <div class="absolute inset-0 opacity-30 pointer-events-none">
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-electric-blue/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-cyan-accent/20 rounded-full blur-3xl"></div>
        </div>

        <!-- Top accent line -->
        <div class="h-1 bg-gradient-to-r from-electric-blue via-cyan-accent to-electric-blue"></div>

        <!-- Main Footer -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">
                <!-- About -->
                <div class="lg:col-span-4">
                    <div class="mb-6">
                        <a href="index.php" class="inline-block group">
                            <img src="assets/logo/NeuroDoc - logo_highquality.png" alt="Dr. Praveen Gupta - NeuroDoc Logo" class="h-16 w-auto object-contain block group-hover:scale-[1.02] transition-transform duration-300 invert brightness-0">
                        </a>
                    </div>
                    <p class="text-white/70 leading-relaxed mb-6 text-sm">
                        Providing exceptional medical care with compassion and expertise for over 25 years. Your trusted partner in health and wellness journey.
                    </p>

                    <!-- Stats badges -->
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                            <div class="text-lg font-bold text-white">25+</div>
                            <div class="text-[10px] text-white/60 uppercase tracking-wide">Years</div>
                        </div>
                        <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                            <div class="text-lg font-bold text-white">50K+</div>
                            <div class="text-[10px] text-white/60 uppercase tracking-wide">Patients</div>
                        </div>
                        <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                            <div class="text-lg font-bold text-white">4.9★</div>
                            <div class="text-[10px] text-white/60 uppercase tracking-wide">Rating</div>
                        </div>
                    </div>

                    <!-- Social -->
                    <div>
                        <p class="text-xs text-white/60 uppercase tracking-wider font-semibold mb-3">Follow Us</p>
                        <div class="flex space-x-2">
                            <a href="<?php echo SOCIAL_FACEBOOK; ?>" class="group relative w-10 h-10 rounded-xl bg-white/5 hover:bg-electric-blue border border-white/10 hover:border-electric-blue flex items-center justify-center transition-all duration-300 hover:-translate-y-1">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <a href="<?php echo SOCIAL_INSTAGRAM; ?>" class="group relative w-10 h-10 rounded-xl bg-white/5 hover:bg-gradient-to-br hover:from-purple-500 hover:to-pink-500 border border-white/10 hover:border-pink-500 flex items-center justify-center transition-all duration-300 hover:-translate-y-1">
                                <i class="fab fa-instagram text-sm"></i>
                            </a>
                            <a href="<?php echo SOCIAL_TWITTER; ?>" class="group relative w-10 h-10 rounded-xl bg-white/5 hover:bg-cyan-accent border border-white/10 hover:border-cyan-accent flex items-center justify-center transition-all duration-300 hover:-translate-y-1">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                            <a href="<?php echo SOCIAL_YOUTUBE; ?>" class="group relative w-10 h-10 rounded-xl bg-white/5 hover:bg-red-500 border border-white/10 hover:border-red-500 flex items-center justify-center transition-all duration-300 hover:-translate-y-1">
                                <i class="fab fa-youtube text-sm"></i>
                            </a>
                            <a href="<?php echo SOCIAL_LINKEDIN; ?>" class="group relative w-10 h-10 rounded-xl bg-white/5 hover:bg-blue-600 border border-white/10 hover:border-blue-600 flex items-center justify-center transition-all duration-300 hover:-translate-y-1">
                                <i class="fab fa-linkedin-in text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="lg:col-span-2">
                    <h3 class="text-base font-bold mb-5 flex items-center">
                        <span class="w-1 h-5 bg-gradient-to-b from-electric-blue to-cyan-accent rounded-full mr-3"></span>
                        Quick Links
                    </h3>
                    <ul class="space-y-2.5">
                        <?php foreach ($navItems as $item): ?>
                            <?php if (isset($item['children'])): ?>
                                <?php foreach ($item['children'] as $child): ?>
                                    <li>
                                        <a href="<?php echo $child['url']; ?>" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-2 group text-sm">
                                            <i class="fas fa-chevron-right text-[10px] text-cyan-accent/60 group-hover:text-cyan-accent group-hover:translate-x-1 transition-all"></i>
                                            <span class="group-hover:translate-x-0.5 transition-transform"><?php echo $child['name']; ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php elseif ($item['url'] !== '#'): ?>
                                <li>
                                    <a href="<?php echo $item['url']; ?>" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-2 group text-sm">
                                        <i class="fas fa-chevron-right text-[10px] text-cyan-accent/60 group-hover:text-cyan-accent group-hover:translate-x-1 transition-all"></i>
                                        <span class="group-hover:translate-x-0.5 transition-transform"><?php echo $item['name']; ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Services -->
                <div class="lg:col-span-3">
                    <h3 class="text-base font-bold mb-5 flex items-center">
                        <span class="w-1 h-5 bg-gradient-to-b from-electric-blue to-cyan-accent rounded-full mr-3"></span>
                        Our Services
                    </h3>
                    <ul class="space-y-2.5">
                        <?php foreach ($footerServices as $service): ?>
                            <li>
                                <a href="services.php" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-3 group text-sm">
                                    <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-cyan-accent/20 flex items-center justify-center transition-all duration-300 flex-shrink-0">
                                        <i class="fas fa-<?php echo $service['icon']; ?> text-[10px] text-cyan-accent/70 group-hover:text-cyan-accent transition-colors"></i>
                                    </span>
                                    <span class="group-hover:translate-x-0.5 transition-transform"><?php echo $service['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="lg:col-span-3">
                    <h3 class="text-base font-bold mb-5 flex items-center">
                        <span class="w-1 h-5 bg-gradient-to-b from-electric-blue to-cyan-accent rounded-full mr-3"></span>
                        Get In Touch
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3 group">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 group-hover:from-electric-blue group-hover:to-cyan-accent flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-map-marker-alt text-cyan-accent group-hover:text-white transition-colors text-sm"></i>
                            </div>
                            <div class="pt-1">
                                <p class="text-white/70 text-xs font-medium">Our Location</p>
                                <p class="text-white/90 text-sm font-semibold"><?php echo SITE_ADDRESS; ?></p>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3 group">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 group-hover:from-electric-blue group-hover:to-cyan-accent flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-phone text-cyan-accent group-hover:text-white transition-colors text-sm"></i>
                            </div>
                            <div class="pt-1">
                                <p class="text-white/70 text-xs font-medium">Call Us</p>
                                <a href="tel:<?php echo SITE_PHONE; ?>" class="text-white/90 text-sm font-semibold hover:text-cyan-accent transition-colors">
                                    <?php echo SITE_PHONE; ?>
                                </a>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3 group">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 group-hover:from-electric-blue group-hover:to-cyan-accent flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-envelope text-cyan-accent group-hover:text-white transition-colors text-sm"></i>
                            </div>
                            <div class="pt-1">
                                <p class="text-white/70 text-xs font-medium">Email Us</p>
                                <a href="mailto:<?php echo SITE_EMAIL; ?>" class="text-white/90 text-sm font-semibold hover:text-cyan-accent transition-colors break-all">
                                    <?php echo SITE_EMAIL; ?>
                                </a>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3 group">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 group-hover:from-electric-blue group-hover:to-cyan-accent flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-clock text-cyan-accent group-hover:text-white transition-colors text-sm"></i>
                            </div>
                            <div class="pt-1">
                                <p class="text-white/70 text-xs font-medium">Working Hours</p>
                                <p class="text-white/90 text-sm font-semibold">Mon - Sat: 9 AM - 7 PM</p>
                                <p class="text-white/60 text-xs">Sunday: Closed</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Newsletter -->
        <div class="relative border-t border-white/10 bg-black/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="flex items-start space-x-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-electric-blue to-cyan-accent flex items-center justify-center shadow-lg flex-shrink-0">
                            <i class="fas fa-paper-plane text-white text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold mb-1">Subscribe to Our Newsletter</h4>
                            <p class="text-white/70 text-sm">Get health tips, latest updates and medical insights directly in your inbox.</p>
                        </div>
                    </div>
                    <form class="flex w-full" onsubmit="event.preventDefault(); alert('Thanks for subscribing!');">
                        <div class="relative flex-1">
                            <i class="fas fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-white/40 text-sm"></i>
                            <input type="email" placeholder="Enter your email address" required
                                   class="w-full pl-12 pr-5 py-4 bg-white/10 border border-white/20 rounded-l-full text-white placeholder-white/50 focus:outline-none focus:border-cyan-accent focus:bg-white/15 transition-all">
                        </div>
                        <button type="submit" class="px-7 py-4 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold rounded-r-full hover:shadow-lg hover:shadow-electric-blue/50 transition-all duration-300 flex items-center space-x-2 group">
                            <span class="hidden sm:inline">Subscribe</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="relative border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-white/60">
                    <p>&copy; <?php echo $currentYear; ?> <span class="text-white font-semibold">Dr. Praveen Gupta</span>. All rights reserved.</p>
                    <div class="flex items-center space-x-1">
                        <a href="#" class="px-3 py-1.5 rounded-full hover:bg-white/5 hover:text-cyan-accent transition-all">Privacy Policy</a>
                        <span class="text-white/20">•</span>
                        <a href="#" class="px-3 py-1.5 rounded-full hover:bg-white/5 hover:text-cyan-accent transition-all">Terms of Service</a>
                        <span class="text-white/20">•</span>
                        <a href="#" class="px-3 py-1.5 rounded-full hover:bg-white/5 hover:text-cyan-accent transition-all">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 rounded-full bg-gradient-to-r from-electric-blue to-cyan-accent text-white shadow-lg hover:shadow-xl hover:shadow-electric-blue/40 transition-all duration-300 transform translate-y-20 opacity-0 z-50 flex items-center justify-center group">
        <i class="fas fa-arrow-up group-hover:-translate-y-0.5 transition-transform"></i>
    </button>

    <!-- Floating Appointment Button (Mobile) -->
    <a href="contact.php" class="lg:hidden fixed bottom-6 left-6 w-14 h-14 rounded-full bg-gradient-to-r from-electric-blue to-cyan-accent text-white shadow-lg flex items-center justify-center z-50 animate-pulse-slow">
        <i class="fas fa-calendar-plus text-lg"></i>
    </a>

    <script>
        // Back to top button
        const backToTopBtn = document.getElementById('back-to-top');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove('translate-y-20', 'opacity-0');
                backToTopBtn.classList.add('translate-y-0', 'opacity-100');
            } else {
                backToTopBtn.classList.add('translate-y-20', 'opacity-0');
                backToTopBtn.classList.remove('translate-y-0', 'opacity-100');
            }
        });
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.observe').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
