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
                        Need Personalized Advice?
                    </h2>

                    <p class="text-white/85 text-sm md:text-base mb-10 max-w-lg leading-relaxed">
                        Consult with Dr. Praveen Gupta to get an accurate diagnosis and custom treatment plan for your neurological health. We are here to support your journey back to wellness.
                    </p>

                    <!-- Buttons Row -->
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Book Appointment Button -->
                        <a href="contact-us-top-neurologist-delhi-ncr"
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
    <footer class="bg-deep-indigo text-white relative overflow-hidden pb-20 lg:pb-0">
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
                        <a href="index" class="inline-block group">
                            <picture>
                                <source srcset="assets/logo/NeuroDoc-final-logo.webp" type="image/webp">
                                <img src="assets/logo/NeuroDoc-final-logo.png" alt="Dr. Praveen Gupta - NeuroDoc Logo" width="200" height="56" class="h-16 w-auto object-contain block group-hover:scale-[1.02] transition-transform duration-300 invert brightness-0">
                            </picture>
                        </a>
                    </div>
                    <p class="text-white/70 leading-relaxed mb-6 text-sm">
                        Providing exceptional medical care with compassion and expertise for over 20 years. Your trusted partner in health and wellness journey.
                    </p>

                    <!-- Stats badges -->
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                            <div class="text-lg font-bold text-white">3,00,000+</div>
                            <div class="text-lg font-bold text-white"><?php echo htmlspecialchars($cmsSettings['stats_patients'] ?? '3,00,000+'); ?></div>
                            <div class="text-[10px] text-white/60 uppercase tracking-wide">Patients</div>
                        </div>
                        <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                            <div class="text-lg font-bold text-white">50+</div>
                            <div class="text-lg font-bold text-white"><?php echo htmlspecialchars($cmsSettings['stats_awards'] ?? '50+'); ?></div>
                            <div class="text-[10px] text-white/60 uppercase tracking-wide">Awards</div>
                        </div>
                        <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                            <div class="text-lg font-bold text-white">4.9 <i class="fas fa-star text-amber-400 text-xs"></i></div>
                            <div class="text-lg font-bold text-white"><?php echo htmlspecialchars($cmsSettings['stats_rating'] ?? '4.9'); ?> <i class="fas fa-star text-amber-400 text-xs"></i></div>
                            <div class="text-[10px] text-white/60 uppercase tracking-wide">Rating</div>
                        </div>
                    </div>

                    <!-- Social -->
                    <div>
                        <p class="text-xs text-white/60 uppercase tracking-wider font-semibold mb-3">Follow Us</p>
                        <div class="flex space-x-2">
                            <a href="<?php echo SOCIAL_FACEBOOK; ?>" aria-label="Visit our Facebook page" target="_blank" rel="noopener noreferrer" class="group relative w-10 h-10 rounded-xl bg-white/5 hover:bg-electric-blue border border-white/10 hover:border-electric-blue flex items-center justify-center transition-all duration-300 hover:-translate-y-1">
                                <i class="fab fa-facebook-f text-sm" aria-hidden="true"></i>
                            </a>
                            <a href="<?php echo SOCIAL_INSTAGRAM; ?>" aria-label="Visit our Instagram profile" target="_blank" rel="noopener noreferrer" class="group relative w-10 h-10 rounded-xl bg-white/5 hover:bg-gradient-to-br hover:from-purple-500 hover:to-pink-500 border border-white/10 hover:border-pink-500 flex items-center justify-center transition-all duration-300 hover:-translate-y-1">
                                <i class="fab fa-instagram text-sm" aria-hidden="true"></i>
                            </a>
                            <a href="<?php echo SOCIAL_TWITTER; ?>" aria-label="Visit our Twitter profile" target="_blank" rel="noopener noreferrer" class="group relative w-10 h-10 rounded-xl bg-white/5 hover:bg-cyan-accent border border-white/10 hover:border-cyan-accent flex items-center justify-center transition-all duration-300 hover:-translate-y-1">
                                <i class="fab fa-twitter text-sm" aria-hidden="true"></i>
                            </a>
                            <a href="<?php echo SOCIAL_YOUTUBE; ?>" aria-label="Visit our YouTube channel" target="_blank" rel="noopener noreferrer" class="group relative w-10 h-10 rounded-xl bg-white/5 hover:bg-red-500 border border-white/10 hover:border-red-500 flex items-center justify-center transition-all duration-300 hover:-translate-y-1">
                                <i class="fab fa-youtube text-sm" aria-hidden="true"></i>
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
                        <li>
                            <a href="index" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-2 group text-sm">
                                <i class="fas fa-chevron-right text-[10px] text-cyan-accent/60 group-hover:text-cyan-accent group-hover:translate-x-1 transition-all"></i>
                                <span class="group-hover:translate-x-0.5 transition-transform">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="about" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-2 group text-sm">
                                <i class="fas fa-chevron-right text-[10px] text-cyan-accent/60 group-hover:text-cyan-accent group-hover:translate-x-1 transition-all"></i>
                                <span class="group-hover:translate-x-0.5 transition-transform">About Dr. Praveen</span>
                            </a>
                        </li>
                        <li>
                            <a href="services" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-2 group text-sm">
                                <i class="fas fa-chevron-right text-[10px] text-cyan-accent/60 group-hover:text-cyan-accent group-hover:translate-x-1 transition-all"></i>
                                <span class="group-hover:translate-x-0.5 transition-transform">Our Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="patient-info" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-2 group text-sm">
                                <i class="fas fa-chevron-right text-[10px] text-cyan-accent/60 group-hover:text-cyan-accent group-hover:translate-x-1 transition-all"></i>
                                <span class="group-hover:translate-x-0.5 transition-transform">Patient Information</span>
                            </a>
                        </li>
                        <li>
                            <a href="videos" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-2 group text-sm">
                                <i class="fas fa-chevron-right text-[10px] text-cyan-accent/60 group-hover:text-cyan-accent group-hover:translate-x-1 transition-all"></i>
                                <span class="group-hover:translate-x-0.5 transition-transform">Media & Videos</span>
                            </a>
                        </li>
                        <li>
                            <a href="gallery" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-2 group text-sm">
                                <i class="fas fa-chevron-right text-[10px] text-cyan-accent/60 group-hover:text-cyan-accent group-hover:translate-x-1 transition-all"></i>
                                <span class="group-hover:translate-x-0.5 transition-transform">Photo Gallery</span>
                            </a>
                        </li>
                        <li>
                            <a href="dr-praveen-gupta-blog" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-2 group text-sm">
                                <i class="fas fa-chevron-right text-[10px] text-cyan-accent/60 group-hover:text-cyan-accent group-hover:translate-x-1 transition-all"></i>
                                <span class="group-hover:translate-x-0.5 transition-transform">Blog & Articles</span>
                            </a>
                        </li>
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
                                <a href="services" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-3 group text-sm">
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
                                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode('Marengo Asia Hospitals, Shushant Lok 2, Sector 56, Gurugram, Haryana 122011'); ?>"
                                   class="text-white/70 text-xs font-medium mt-1 block hover:text-cyan-accent transition-colors">
                                    View on Google Maps
                                </a>
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


        <!-- Bottom Bar -->
        <div class="relative border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-white/60">
                    <p>&copy; <?php echo $currentYear; ?> <span class="text-white font-semibold">Dr. Praveen Gupta</span>. All rights reserved.</p>
                    <div class="flex items-center space-x-1">
                        <a href="privacy-policy" class="px-3 py-1.5 rounded-full hover:bg-white/5 hover:text-cyan-accent transition-all">Privacy Policy</a>
                        <span class="text-white/20">&bull;</span>
                        <a href="terms-of-service" class="px-3 py-1.5 rounded-full hover:bg-white/5 hover:text-cyan-accent transition-all">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/<?php echo SITE_WHATSAPP; ?>?text=<?php echo rawurlencode(WHATSAPP_MESSAGE); ?>"
       target="_blank" rel="noopener noreferrer"
       aria-label="Chat with us on WhatsApp"
       class="hidden lg:flex group fixed bottom-8 right-8 w-14 h-14 rounded-full bg-[#25D366] hover:bg-[#1DA851] text-white shadow-lg hover:shadow-xl hover:shadow-[#25D366]/50 hover:-translate-y-0.5 transition-all duration-300 items-center justify-center z-50">
        <!-- Pulsing halo -->
        <span class="absolute inset-0 rounded-full bg-[#25D366]/40 animate-ping pointer-events-none"></span>
        <i class="fab fa-whatsapp text-2xl relative"></i>

        <!-- Hover label (desktop) -->
        <span class="hidden lg:block absolute right-full mr-3 whitespace-nowrap bg-deep-indigo text-white text-xs font-semibold px-3 py-2 rounded-full shadow-lg opacity-0 translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 pointer-events-none">
            Chat on WhatsApp
        </span>
    </a>

    <!-- Back to Top Button (stacked above the WhatsApp button) -->
    <button id="back-to-top" class="hidden lg:flex fixed bottom-28 right-9 w-12 h-12 rounded-full bg-white text-deep-indigo border border-silver-grey shadow-lg hover:bg-electric-blue hover:text-white hover:shadow-xl hover:shadow-electric-blue/40 transition-all duration-300 transform translate-y-20 opacity-0 z-50 items-center justify-center group">
        <i class="fas fa-arrow-up group-hover:-translate-y-0.5 transition-transform"></i>
    </button>

    <!-- Floating Emergency Stroke Helpline Button -->
    <a href="tel:<?php echo STROKE_HELPLINE; ?>"
       aria-label="Call 24x7 Emergency Stroke Helpline"
       class="hidden lg:flex group fixed bottom-48 right-8 w-14 h-14 rounded-full bg-red-650 bg-red-600 hover:bg-red-750 hover:bg-red-700 text-white shadow-lg hover:shadow-xl hover:shadow-red-600/50 hover:-translate-y-0.5 transition-all duration-300 items-center justify-center z-50">
        <!-- Pulsing halo -->
        <span class="absolute inset-0 rounded-full bg-red-600/40 animate-ping pointer-events-none"></span>
        <i class="fas fa-phone-alt text-lg relative animate-pulse"></i>

        <!-- Hover label (desktop) -->
        <span class="hidden lg:block absolute right-full mr-3 whitespace-nowrap bg-red-600 text-white text-xs font-bold px-3 py-2 rounded-full shadow-lg opacity-0 translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 pointer-events-none">
            24x7 Stroke Helpline: <?php echo STROKE_HELPLINE; ?>
        </span>
    </a>

    <!-- Sticky Bottom Bar (Mobile Only - Premium Floating Capsule) -->
    <div class="lg:hidden fixed bottom-4 left-4 right-4 bg-white/95 backdrop-blur-md border border-slate-200/80 shadow-[0_8px_30px_rgba(0,0,0,0.12)] rounded-[24px] z-50 px-4 py-2.5 flex items-center justify-between gap-3">
        <!-- WhatsApp Link -->
        <a href="https://wa.me/<?php echo SITE_WHATSAPP; ?>?text=<?php echo rawurlencode(WHATSAPP_MESSAGE); ?>" 
           target="_blank" rel="noopener noreferrer"
           class="flex flex-col items-center justify-center text-center group">
            <span class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-sm active:scale-90 transition-all duration-300">
                <i class="fab fa-whatsapp text-lg"></i>
            </span>
            <span class="text-[8px] font-bold text-slate-500 uppercase tracking-wider mt-1">WhatsApp</span>
        </a>

        <!-- Online Consult -->
        <a href="online-neurologist-consultation" 
           class="flex flex-col items-center justify-center text-center group">
            <span class="w-10 h-10 rounded-full bg-electric-blue/10 text-electric-blue flex items-center justify-center shadow-sm active:scale-90 transition-all duration-300">
                <i class="fas fa-video text-base"></i>
            </span>
            <span class="text-[8px] font-bold text-slate-500 uppercase tracking-wider mt-1">Online</span>
        </a>

        <!-- Book Appointment Central Button -->
        <a href="contact-us-top-neurologist-delhi-ncr" 
           class="flex-1 flex items-center justify-center gap-1.5 bg-gradient-to-r from-deep-indigo via-electric-blue to-cyan-accent text-white font-extrabold text-xs h-10 px-3 rounded-full shadow-[0_4px_15px_rgba(37,99,235,0.25)] active:scale-[0.97] transition-all duration-300">
            <i class="fas fa-calendar-check text-sm animate-pulse"></i>
            <span class="uppercase tracking-wider">Book Clinic</span>
        </a>

        <!-- Emergency Helpline Link -->
        <a href="tel:<?php echo STROKE_HELPLINE; ?>" 
           class="flex flex-col items-center justify-center text-center group">
            <span class="w-10 h-10 rounded-full bg-red-50 text-red-650 text-red-600 flex items-center justify-center shadow-sm active:scale-90 transition-all duration-300">
                <i class="fas fa-phone-alt text-sm animate-pulse"></i>
            </span>
            <span class="text-[8px] font-bold text-slate-500 uppercase tracking-wider mt-1">Emergency</span>
        </a>
    </div>

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
        }, { passive: true });
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
