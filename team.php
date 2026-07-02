<?php
/**
 * Team Listing Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Our Team</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-users text-cyan-accent text-[10px]"></i>
                <span>Medical & Support Team</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Meet <span class="text-cyan-accent">Our Team</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Our multidisciplinary team of associate neurologists, rehabilitation therapists, and coordinators work together under the direction of Dr. Praveen Gupta to deliver outstanding neurological care.
            </p>
        </div>
    </div>
</section>

<!-- Clinical Director / Leadership Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Leadership</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Clinical Director</h2>
        </div>

        <!-- Dr Praveen Gupta profile -->
        <div class="max-w-4xl mx-auto bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
            <div class="grid md:grid-cols-12 gap-8 items-center p-8">
                <div class="md:col-span-4 aspect-[4/5] rounded-2xl overflow-hidden relative shadow-md bg-gradient-to-br from-deep-indigo to-electric-blue p-0.5">
                    <div class="relative w-full h-full rounded-[0.9rem] overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent">
                        <img src="assets/dpg-1.webp" alt="Dr. Praveen Gupta" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="md:col-span-8 space-y-4">
                    <span class="text-cyan-accent font-bold text-xs uppercase tracking-widest">Chairman - Marengo Asia Neuro & Spine</span>
                    <h3 class="text-2xl font-bold text-deep-indigo font-serif">Dr. Praveen Gupta</h3>
                    <p class="text-xs text-dark-grey/70 leading-relaxed font-light">
                        Pioneering neurologist with 20+ years of experience. Renowned for starting the first stroke mechanical thrombectomy services in Gurgaon and executing the first Deep Brain Stimulation (DBS) in the region.
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <a href="about.php" class="text-xs font-semibold text-electric-blue hover:underline">Full Biography <i class="fas fa-arrow-right text-[10px] ml-1"></i></a>
                        <span class="text-slate-300">|</span>
                        <a href="why-choose-dr-praveen-gupta.php" class="text-xs font-semibold text-electric-blue hover:underline">Why Choose Dr. Praveen <i class="fas fa-arrow-right text-[10px] ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Specialty Team Grid -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Associate Specialists</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Specialty & Rehabilitation Team</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Our specialists provide dedicated diagnostics, care, and recovery assistance.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Team Member 1 -->
            <div class="bg-white border border-silver-grey/30 p-6 rounded-3xl hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full overflow-hidden mb-4 bg-gradient-to-br from-electric-blue to-cyan-accent p-0.5 shadow-md">
                    <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&q=80&w=400&h=400" alt="Dr. Rahul Verma" class="w-full h-full object-cover rounded-full">
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Dr. Rahul Verma</h3>
                <p class="text-xs text-cyan-accent font-medium mt-1">Associate Consultant - Neurology</p>
                <p class="text-xs text-dark-grey/65 mt-2 leading-relaxed">Specializes in managing epilepsy, headache, and electro-diagnostics (EEG/EMG).</p>
            </div>

            <!-- Team Member 2 -->
            <div class="bg-white border border-silver-grey/30 p-6 rounded-3xl hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full overflow-hidden mb-4 bg-gradient-to-br from-electric-blue to-cyan-accent p-0.5 shadow-md">
                    <img src="https://images.unsplash.com/photo-1594824813573-246434de83fb?auto=format&fit=crop&q=80&w=400&h=400" alt="Dr. Sneha Sharma" class="w-full h-full object-cover rounded-full">
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Dr. Sneha Sharma</h3>
                <p class="text-xs text-cyan-accent font-medium mt-1">Consultant - Neuro-Rehabilitation</p>
                <p class="text-xs text-dark-grey/65 mt-2 leading-relaxed">Focuses on stroke rehabilitation, motor training, and post-TBI recovery therapies.</p>
            </div>

            <!-- Team Member 3 -->
            <div class="bg-white border border-silver-grey/30 p-6 rounded-3xl hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full overflow-hidden mb-4 bg-gradient-to-br from-electric-blue to-cyan-accent p-0.5 shadow-md">
                    <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&q=80&w=400&h=400" alt="Mr. Amit Kumar" class="w-full h-full object-cover rounded-full">
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Mr. Amit Kumar</h3>
                <p class="text-xs text-cyan-accent font-medium mt-1">Senior Neuro-Physiotherapist</p>
                <p class="text-xs text-dark-grey/65 mt-2 leading-relaxed">Delivers active vestibular rehabilitation, balance training, and gait coordination.</p>
            </div>

            <!-- Team Member 4 -->
            <div class="bg-white border border-silver-grey/30 p-6 rounded-3xl hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full overflow-hidden mb-4 bg-gradient-to-br from-electric-blue to-cyan-accent p-0.5 shadow-md">
                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=400&h=400" alt="Ms. Preeti Singh" class="w-full h-full object-cover rounded-full">
                </div>
                <h3 class="font-bold text-deep-indigo text-base">Ms. Preeti Singh</h3>
                <p class="text-xs text-cyan-accent font-medium mt-1">Senior Speech Therapist</p>
                <p class="text-xs text-dark-grey/65 mt-2 leading-relaxed">Aids in speech recovery, language pathology, and cognitive therapy after strokes.</p>
            </div>
        </div>
    </div>
</section>

<!-- Support Coordinators -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Patient Coordination</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Seamless Patient Experience Support</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Our patient coordinators are dedicated to easing your journey, managing schedules, coordinating diagnostic tests, handling outstation or international cases, and providing emergency helpline coordination.
                </p>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <h4 class="font-bold text-deep-indigo text-sm flex items-center space-x-2">
                            <span class="w-2 h-2 bg-cyan-accent rounded-full"></span>
                            <span>Appointment Scheduling</span>
                        </h4>
                        <p class="text-xs text-dark-grey/65 leading-relaxed">Assists with booking slots for in-person, online, and emergency evaluations.</p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="font-bold text-deep-indigo text-sm flex items-center space-x-2">
                            <span class="w-2 h-2 bg-cyan-accent rounded-full"></span>
                            <span>Emergency Coordination</span>
                        </h4>
                        <p class="text-xs text-dark-grey/65 leading-relaxed">Helps dispatch stroke ambulance codes and coordinates with emergency ICU teams.</p>
                    </div>
                </div>
            </div>

            <!-- Right -->
            <div class="lg:col-span-5 bg-gradient-to-br from-deep-indigo to-indigo-950 text-white p-8 rounded-3xl space-y-6">
                <h3 class="text-xl font-bold font-serif">Contact Coordination</h3>
                <p class="text-xs text-white/80 leading-relaxed">
                    Have questions about consultation slots, documentation, or outstation visits? Get in touch with our team.
                </p>
                <div class="space-y-4 pt-2">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-cyan-accent">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-white/60 uppercase">Direct Helpline</p>
                            <a href="tel:<?php echo SITE_PHONE; ?>" class="text-sm font-bold hover:text-cyan-accent transition-colors"><?php echo SITE_PHONE; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
