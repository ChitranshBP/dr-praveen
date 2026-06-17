<?php
/**
 * Footer Include
 */
$currentYear = date('Y');
$footerServices = [
    'Cardiology',
    'General Medicine',
    'Preventive Care',
    'Neurology',
    'Diagnostics',
    'Family Health'
];
?>

    <!-- CTA Section -->
    <section class="relative py-24 overflow-hidden">
        <div class="absolute inset-0 gradient-bg"></div>
        <div class="blob w-96 h-96 bg-cyan-accent -top-20 -right-20"></div>
        <div class="blob w-96 h-96 bg-electric-blue -bottom-20 -left-20"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                <i class="fas fa-heartbeat text-cyan-accent animate-pulse"></i>
                <span class="text-white text-sm font-medium">Your Health, Our Priority</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-serif font-bold text-white mb-6">
                Ready to Prioritize<br>Your Health?
            </h2>
            <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto">
                Schedule a consultation with Dr. Praveen Gupta today and take the first step towards a healthier tomorrow.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="contact.php" class="px-8 py-4 bg-white text-electric-blue font-semibold rounded-full hover:bg-soft-cyan transition-all duration-300 transform hover:-translate-y-1 shadow-2xl flex items-center space-x-2">
                    <i class="fas fa-calendar-check"></i>
                    <span>Book Appointment</span>
                </a>
                <a href="tel:<?php echo SITE_PHONE; ?>" class="px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-electric-blue transition-all duration-300 transform hover:-translate-y-1 flex items-center space-x-2">
                    <i class="fas fa-phone"></i>
                    <span>Call Now</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-deep-indigo text-white">
        <!-- Main Footer -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- About -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-electric-blue to-cyan-accent flex items-center justify-center">
                            <i class="fas fa-plus text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Dr. Praveen Gupta</h3>
                            <p class="text-xs text-cyan-accent">Healthcare Excellence</p>
                        </div>
                    </div>
                    <p class="text-white/70 leading-relaxed mb-6">
                        Providing exceptional medical care with compassion and expertise for over 25 years. Your trusted partner in health and wellness.
                    </p>
                    <div class="flex space-x-3">
                        <a href="<?php echo SOCIAL_FACEBOOK; ?>" class="w-10 h-10 rounded-full bg-white/10 hover:bg-electric-blue flex items-center justify-center transition-all duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="<?php echo SOCIAL_INSTAGRAM; ?>" class="w-10 h-10 rounded-full bg-white/10 hover:bg-gradient-to-br hover:from-purple-500 hover:to-pink-500 flex items-center justify-center transition-all duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="<?php echo SOCIAL_TWITTER; ?>" class="w-10 h-10 rounded-full bg-white/10 hover:bg-cyan-accent flex items-center justify-center transition-all duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="<?php echo SOCIAL_YOUTUBE; ?>" class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-500 flex items-center justify-center transition-all duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="<?php echo SOCIAL_LINKEDIN; ?>" class="w-10 h-10 rounded-full bg-white/10 hover:bg-blue-600 flex items-center justify-center transition-all duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 flex items-center">
                        <span class="w-8 h-0.5 bg-cyan-accent mr-3"></span>
                        Quick Links
                    </h3>
                    <ul class="space-y-3">
                        <?php foreach ($navItems as $item): ?>
                            <li>
                                <a href="<?php echo $item['url']; ?>" class="text-white/70 hover:text-cyan-accent transition-colors duration-300 flex items-center space-x-2 group">
                                    <i class="fas fa-chevron-right text-xs text-cyan-accent group-hover:translate-x-1 transition-transform"></i>
                                    <span><?php echo $item['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 flex items-center">
                        <span class="w-8 h-0.5 bg-cyan-accent mr-3"></span>
                        Our Services
                    </h3>
                    <ul class="space-y-3">
                        <?php foreach ($footerServices as $service): ?>
                            <li>
                                <a href="services.php" class="text-white/70 hover:text-cyan-accent transition-colors duration-300 flex items-center space-x-2 group">
                                    <i class="fas fa-chevron-right text-xs text-cyan-accent group-hover:translate-x-1 transition-transform"></i>
                                    <span><?php echo $service; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 flex items-center">
                        <span class="w-8 h-0.5 bg-cyan-accent mr-3"></span>
                        Get In Touch
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-electric-blue/20 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-cyan-accent"></i>
                            </div>
                            <div>
                                <p class="text-white/70 text-sm"><?php echo SITE_ADDRESS; ?></p>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-electric-blue/20 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-cyan-accent"></i>
                            </div>
                            <div>
                                <a href="tel:<?php echo SITE_PHONE; ?>" class="text-white/70 hover:text-cyan-accent transition-colors text-sm">
                                    <?php echo SITE_PHONE; ?>
                                </a>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-electric-blue/20 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-cyan-accent"></i>
                            </div>
                            <div>
                                <a href="mailto:<?php echo SITE_EMAIL; ?>" class="text-white/70 hover:text-cyan-accent transition-colors text-sm break-all">
                                    <?php echo SITE_EMAIL; ?>
                                </a>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-electric-blue/20 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-cyan-accent"></i>
                            </div>
                            <div>
                                <p class="text-white/70 text-sm">Mon - Sat: 9:00 AM - 7:00 PM</p>
                                <p class="text-white/70 text-sm">Sun: Closed</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Newsletter -->
        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h4 class="text-xl font-semibold mb-1">Subscribe to Our Newsletter</h4>
                        <p class="text-white/70 text-sm">Get health tips and updates directly in your inbox.</p>
                    </div>
                    <form class="flex w-full md:w-auto" onsubmit="event.preventDefault(); alert('Thanks for subscribing!');">
                        <input type="email" placeholder="Enter your email" required
                               class="px-5 py-3 bg-white/10 border border-white/20 rounded-l-full text-white placeholder-white/50 focus:outline-none focus:border-cyan-accent w-full md:w-80">
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold rounded-r-full hover:opacity-90 transition-opacity">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-white/60">
                    <p>&copy; <?php echo $currentYear; ?> Dr. Praveen Gupta. All rights reserved.</p>
                    <div class="flex items-center space-x-6">
                        <a href="#" class="hover:text-cyan-accent transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-cyan-accent transition-colors">Terms of Service</a>
                        <a href="#" class="hover:text-cyan-accent transition-colors">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 rounded-full bg-gradient-to-r from-electric-blue to-cyan-accent text-white shadow-lg hover:shadow-xl transition-all duration-300 transform translate-y-20 opacity-0 z-50 flex items-center justify-center">
        <i class="fas fa-arrow-up"></i>
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
