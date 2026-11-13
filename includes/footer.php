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
        'icon' => !empty($svc['icon']) ? preg_replace('/^fa[sb]?\s+fa-/', '', $svc['icon']) : ($serviceIcons[$svc['title']] ?? 'stethoscope'),
        'link' => !empty($svc['link']) ? $svc['link'] : getServicePageLink($svc['title']),
    ];
}
$footerNav = cms_navigation();
$footerMapsLink = trim((string)($cmsSettings['maps_link'] ?? '')) !== ''
    ? $cmsSettings['maps_link']
    : 'https://www.google.com/maps/search/?api=1&query=' . urlencode(SITE_ADDRESS);
?>

    <?php require __DIR__ . '/cms-sections.php'; ?>

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
                        <?php echo htmlspecialchars(cms_text('footer_cta_title')); ?>
                    </h2>

                    <p class="text-white/85 text-sm md:text-base mb-10 max-w-lg leading-relaxed">
                        <?php echo htmlspecialchars(cms_text('footer_cta_text')); ?>
                    </p>

                    <!-- Buttons Row -->
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Book Appointment Button -->
                        <a href="<?php echo htmlspecialchars(cms_nav_href(cms_text('footer_cta_primary_url'))); ?>"
                           class="inline-flex items-center space-x-6 bg-[#111827] text-white text-xs md:text-sm font-semibold pl-6 pr-2.5 py-2.5 rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:-translate-y-0.5 active:translate-y-0 group">
                            <span><?php echo htmlspecialchars(cms_text('footer_cta_primary_label')); ?></span>
                            <!-- Glossy metallic dot indicator -->
                            <div class="w-7 h-7 rounded-full bg-gradient-to-b from-white via-slate-100 to-slate-400 shadow-[inset_0_1px_2px_rgba(255,255,255,0.8),0_2px_4px_rgba(0,0,0,0.3)] flex items-center justify-center text-[#111827] text-xs font-bold transition-transform duration-300 group-hover:scale-110 flex-shrink-0">
                                <i class="fas fa-chevron-right text-[9px]"></i>
                            </div>
                        </a>

                        <!-- Call Now Button -->
                        <a href="<?php echo htmlspecialchars(cms_nav_href(cms_text('footer_cta_secondary_url'))); ?>"
                           class="inline-flex items-center space-x-6 bg-[#111827] text-white text-xs md:text-sm font-semibold pl-6 pr-2.5 py-2.5 rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:-translate-y-0.5 active:translate-y-0 group">
                            <span><?php echo htmlspecialchars(cms_text('footer_cta_secondary_label')); ?></span>
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
                            <?php $footerLogo = cms_site_logo(); ?>
                            <picture>
                                <?php if ($footerLogo['webp'] !== ''): ?><source srcset="<?php echo htmlspecialchars($footerLogo['webp']); ?>" type="image/webp"><?php endif; ?>
                                <img src="<?php echo htmlspecialchars($footerLogo['path']); ?>" alt="<?php echo htmlspecialchars($cmsSettings['logo_alt'] ?? 'Dr. Praveen Gupta - NeuroDoc Logo'); ?>" width="200" height="56" class="h-16 w-auto object-contain block group-hover:scale-[1.02] transition-transform duration-300 invert brightness-0">
                            </picture>
                        </a>
                    </div>
                    <p class="text-white/70 leading-relaxed mb-6 text-sm">
                        <?php echo htmlspecialchars(cms_text('footer_about_text')); ?>
                    </p>

                    <!-- Stats badges -->
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                            <div class="text-lg font-bold text-white"><?php echo htmlspecialchars($cmsSettings['stats_patients'] ?? '3,00,000+'); ?></div>
                            <div class="text-[10px] text-white/60 uppercase tracking-wide"><?php echo htmlspecialchars(cms_text('footer_stat_patients_label')); ?></div>
                        </div>
                        <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                            <div class="text-lg font-bold text-white"><?php echo htmlspecialchars($cmsSettings['stats_awards'] ?? '50+'); ?></div>
                            <div class="text-[10px] text-white/60 uppercase tracking-wide"><?php echo htmlspecialchars(cms_text('footer_stat_awards_label')); ?></div>
                        </div>
                        <div class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                            <div class="text-lg font-bold text-white"><?php echo htmlspecialchars($cmsSettings['stats_rating'] ?? '4.9'); ?> <i class="fas fa-star text-amber-400 text-xs"></i></div>
                            <div class="text-[10px] text-white/60 uppercase tracking-wide"><?php echo htmlspecialchars(cms_text('footer_stat_rating_label')); ?></div>
                        </div>
                    </div>

                    <!-- Social -->
                    <div>
                        <p class="text-xs text-white/60 uppercase tracking-wider font-semibold mb-3"><?php echo htmlspecialchars(cms_text('footer_follow_label')); ?></p>
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
                            <a href="<?php echo SOCIAL_LINKEDIN; ?>" aria-label="Visit our LinkedIn profile" target="_blank" rel="noopener noreferrer" class="group relative w-10 h-10 rounded-xl bg-white/5 hover:bg-[#0A66C2] border border-white/10 hover:border-[#0A66C2] flex items-center justify-center transition-all duration-300 hover:-translate-y-1">
                                <i class="fab fa-linkedin-in text-sm" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="lg:col-span-2">
                    <h3 class="text-base font-bold mb-5 flex items-center">
                        <span class="w-1 h-5 bg-gradient-to-b from-electric-blue to-cyan-accent rounded-full mr-3"></span>
                        <?php echo htmlspecialchars(cms_text('footer_quick_links_heading')); ?>
                    </h3>
                    <ul class="space-y-2.5">
                        <?php foreach ($footerNav['footer_quick_links'] as $ql): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars(cms_nav_href($ql['url'])); ?>" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-2 group text-sm">
                                <i class="fas fa-chevron-right text-[10px] text-cyan-accent/60 group-hover:text-cyan-accent group-hover:translate-x-1 transition-all"></i>
                                <span class="group-hover:translate-x-0.5 transition-transform"><?php echo htmlspecialchars($ql['label']); ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Services -->
                <div class="lg:col-span-3">
                    <h3 class="text-base font-bold mb-5 flex items-center">
                        <span class="w-1 h-5 bg-gradient-to-b from-electric-blue to-cyan-accent rounded-full mr-3"></span>
                        <?php echo htmlspecialchars(cms_text('footer_services_heading')); ?>
                    </h3>
                    <ul class="space-y-2.5">
                        <?php foreach ($footerServices as $service): ?>
                            <li>
                                <a href="<?php echo htmlspecialchars($service['link']); ?>" class="text-white/70 hover:text-cyan-accent transition-all duration-300 flex items-center space-x-3 group text-sm">
                                    <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-cyan-accent/20 flex items-center justify-center transition-all duration-300 flex-shrink-0">
                                        <i class="fas fa-<?php echo $service['icon']; ?> text-[10px] text-cyan-accent/70 group-hover:text-cyan-accent transition-colors"></i>
                                    </span>
                                    <span class="group-hover:translate-x-0.5 transition-transform"><?php echo htmlspecialchars($service['name']); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="lg:col-span-3">
                    <h3 class="text-base font-bold mb-5 flex items-center">
                        <span class="w-1 h-5 bg-gradient-to-b from-electric-blue to-cyan-accent rounded-full mr-3"></span>
                        <?php echo htmlspecialchars(cms_text('footer_contact_heading')); ?>
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3 group">
                            <a href="<?php echo htmlspecialchars($footerMapsLink); ?>"
                               target="_blank" rel="noopener noreferrer"
                               class="flex items-start space-x-3 group/loc hover:text-cyan-accent transition-colors">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 group-hover/loc:from-electric-blue group-hover/loc:to-cyan-accent flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                    <i class="fas fa-map-marker-alt text-cyan-accent group-hover/loc:text-white transition-colors text-sm"></i>
                                </div>
                                <div class="pt-1">
                                    <p class="text-white/70 text-xs font-medium"><?php echo htmlspecialchars(cms_text('footer_location_label')); ?></p>
                                    <p class="text-white/90 text-sm font-semibold group-hover/loc:text-cyan-accent transition-colors"><?php echo htmlspecialchars(SITE_ADDRESS); ?></p>
                                    <span class="text-cyan-accent text-xs font-medium mt-1 inline-flex items-center space-x-1">
                                        <span><?php echo htmlspecialchars(cms_text('footer_maps_label')); ?></span>
                                        <i class="fas fa-external-link-alt text-[9px]"></i>
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="flex items-start space-x-3 group">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 group-hover:from-electric-blue group-hover:to-cyan-accent flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-phone text-cyan-accent group-hover:text-white transition-colors text-sm"></i>
                            </div>
                            <div class="pt-1">
                                <p class="text-white/70 text-xs font-medium"><?php echo htmlspecialchars(cms_text('footer_phone_label')); ?></p>
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
                                <p class="text-white/70 text-xs font-medium"><?php echo htmlspecialchars(cms_text('footer_email_label')); ?></p>
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
                                <p class="text-white/70 text-xs font-medium"><?php echo htmlspecialchars(cms_text('footer_hours_label')); ?></p>
                                <p class="text-white/90 text-sm font-semibold"><?php echo htmlspecialchars(WORKING_HOURS_WEEKDAYS); ?></p>
                                <p class="text-white/60 text-xs"><?php echo htmlspecialchars(WORKING_HOURS_SUNDAY); ?></p>
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
                    <p><?php echo str_replace(htmlspecialchars(SITE_NAME), '<span class="text-white font-semibold">' . htmlspecialchars(SITE_NAME) . '</span>', htmlspecialchars(cms_text('footer_copyright'))); ?></p>
                    <div class="flex items-center space-x-1">
                        <?php foreach ($footerNav['footer_legal_links'] as $li => $legal): ?>
                        <?php if ($li > 0): ?><span class="text-white/20">&bull;</span><?php endif; ?>
                        <a href="<?php echo htmlspecialchars(cms_nav_href($legal['url'])); ?>" class="px-3 py-1.5 rounded-full hover:bg-white/5 hover:text-cyan-accent transition-all"><?php echo htmlspecialchars($legal['label']); ?></a>
                        <?php endforeach; ?>
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
            <?php echo htmlspecialchars(cms_text('float_whatsapp_label')); ?>
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
            <?php echo htmlspecialchars(cms_text('float_helpline_label')); ?>
        </span>
    </a>

    <!-- Sticky Bottom Bar (Mobile Only - Premium Floating Capsule) -->
    <?php if (!empty($footerNav['mobile_bar'])): ?>
    <div class="lg:hidden fixed bottom-4 left-4 right-4 bg-white/95 backdrop-blur-md border border-slate-200/80 shadow-[0_8px_30px_rgba(0,0,0,0.12)] rounded-[24px] z-50 px-4 py-2.5 flex items-center justify-between gap-3">
        <?php
        // Mobile sticky bar items (CMS → Navigation → Mobile bar)
        $mobileStyles = [
            'whatsapp' => ['bg-emerald-50 text-emerald-600', 'text-lg'],
            'blue'     => ['bg-electric-blue/10 text-electric-blue', 'text-base'],
            'red'      => ['bg-red-50 text-red-650 text-red-600', 'text-sm animate-pulse'],
        ];
        foreach ($footerNav['mobile_bar'] as $mb):
            $mbHref = cms_nav_href($mb['url'] ?? '#');
            $mbExternal = preg_match('#^https?://#i', $mbHref) ? ' target="_blank" rel="noopener noreferrer"' : '';
            $mbIcon = trim((string)($mb['icon'] ?? 'fas fa-circle'));
            $mbStyle = $mb['style'] ?? 'blue';
        ?>
        <?php if ($mbStyle === 'primary'): ?>
        <a href="<?php echo htmlspecialchars($mbHref); ?>"<?php echo $mbExternal; ?>
           class="flex-1 flex items-center justify-center gap-1.5 bg-gradient-to-r from-deep-indigo via-electric-blue to-cyan-accent text-white font-extrabold text-xs h-10 px-3 rounded-full shadow-[0_4px_15px_rgba(37,99,235,0.25)] active:scale-[0.97] transition-all duration-300">
            <i class="<?php echo htmlspecialchars($mbIcon); ?> text-sm animate-pulse"></i>
            <span class="uppercase tracking-wider"><?php echo htmlspecialchars($mb['label']); ?></span>
        </a>
        <?php else: [$mbCircle, $mbIconSize] = $mobileStyles[$mbStyle] ?? $mobileStyles['blue']; ?>
        <a href="<?php echo htmlspecialchars($mbHref); ?>"<?php echo $mbExternal; ?>
           class="flex flex-col items-center justify-center text-center group">
            <span class="w-10 h-10 rounded-full <?php echo $mbCircle; ?> flex items-center justify-center shadow-sm active:scale-90 transition-all duration-300">
                <i class="<?php echo htmlspecialchars($mbIcon); ?> <?php echo $mbIconSize; ?>"></i>
            </span>
            <span class="text-[8px] font-bold text-slate-500 uppercase tracking-wider mt-1"><?php echo htmlspecialchars($mb['label']); ?></span>
        </a>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
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
    <?php if (!empty($cmsSettings['custom_body_scripts'])): ?>
    <!-- Custom body scripts (CMS → Settings) -->
    <?php echo $cmsSettings['custom_body_scripts']; ?>

    <?php endif; ?>
</body>
</html>
