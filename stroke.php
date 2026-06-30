<?php
/**
 * Stroke Service Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/5"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <a href="services.php" class="hover:text-white transition-colors">Services</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Stroke</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-brain text-[10px]"></i>
                <span>Emergency Neurological Care</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Expert <span class="text-white">Stroke</span> Care & Rehab
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Life-saving rapid evaluation, advanced prevention, and comprehensive neuro-rehabilitation. Dr. Praveen Gupta specializes in minimizing brain damage and aiding recovery.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap gap-3">
                <a href="contact.php" class="inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
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

<!-- What is Stroke Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Understanding</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">What is a Stroke?</h2>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    A stroke occurs when blood flow to an area of the brain is interrupted or reduced. This deprives brain cells of vital oxygen and nutrients, causing them to begin dying within minutes. A stroke is a critical emergency where rapid medical intervention can mean the difference between recovery and permanent disability.
                </p>
                <p class="text-dark-grey/70 leading-relaxed mb-8">
                    Dr. Praveen Gupta is a pioneer in hyperacute stroke management in India, offering rapid thrombolytic therapies and mechanical thrombectomy. Beyond emergency care, our clinic specializes in stroke prevention and customized long-term neuro-rehabilitation.
                </p>

                <!-- Key Facts -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Brain Attack</div>
                            <div class="text-xs text-dark-grey/60">Requires emergency response</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Time Sensitive</div>
                            <div class="text-xs text-dark-grey/60">"Time is Brain" - act FAST</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Preventable</div>
                            <div class="text-xs text-dark-grey/60">80% of strokes can be prevented</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Rehabilitation</div>
                            <div class="text-xs text-dark-grey/60">Physical & motor recovery helps</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Side -->
            <div class="relative flex justify-center lg:justify-end animate-slide-in-right">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey border border-silver-grey/20">
                    <img src="assets/services/stroke.png" alt="Understanding Stroke" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Types of Stroke -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Classification</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Types of Stroke</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Strokes are divided into categories based on whether they involve blood vessel blockage or rupture.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Ischemic Stroke -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-electric-blue/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-electric-blue group-hover:text-white transition-all duration-300">
                    <i class="fas fa-circle-minus text-electric-blue text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Ischemic Stroke</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    The most common type (accounts for 87% of strokes). Caused by a blood clot blocking an artery that supplies blood to the brain, cutting off oxygen.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Clot Blockage</span>
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Thrombolysis</span>
                </div>
            </div>

            <!-- Hemorrhagic Stroke -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-cyan-accent/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-cyan-accent transition-all duration-300">
                    <i class="fas fa-droplet text-cyan-accent text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Hemorrhagic Stroke</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Occurs when a weakened blood vessel ruptures and leaks blood into the surrounding brain tissue, causing severe local pressure and damage.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Vessel Rupture</span>
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Bleeding Care</span>
                </div>
            </div>

            <!-- Transient Ischemic Attack (TIA) -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-deep-indigo/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-deep-indigo transition-all duration-300">
                    <i class="fas fa-triangle-exclamation text-deep-indigo text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Transient Ischemic Attack (TIA)</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Known as a "mini-stroke." Blood flow is blocked temporarily (often resolving within minutes). Although symptoms fade quickly, a TIA is a warning sign of an impending major stroke.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Temporary Block</span>
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Warning Indicator</span>
                </div>
            </div>
        </div>

        <!-- Warning Signs -->
        <div class="mt-12 bg-white rounded-2xl p-8 border border-silver-grey/20">
            <div class="flex items-start space-x-4 mb-6">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-triangle-exclamation text-red-500 text-lg"></i>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-dark-grey">FAST Stroke Symptoms</h4>
                    <p class="text-sm text-dark-grey/60 mt-1">If you notice these signs, call emergency services immediately:</p>
                </div>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-circle text-red-400 text-[6px]"></i>
                    <span class="text-dark-grey/80"><strong>F - Face Drooping:</strong> One side of the face droops or is numb</span>
                </div>
                <div class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-circle text-red-400 text-[6px]"></i>
                    <span class="text-dark-grey/80"><strong>A - Arm Weakness:</strong> One arm feels weak, numb, or drifts downward</span>
                </div>
                <div class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-circle text-red-400 text-[6px]"></i>
                    <span class="text-dark-grey/80"><strong>S - Speech Difficulty:</strong> Slurred speech or difficulty understanding</span>
                </div>
                <div class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-circle text-red-400 text-[6px]"></i>
                    <span class="text-dark-grey/80"><strong>T - Time to Call:</strong> Time is critical, seek help immediately</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Symptoms Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Image -->
            <div class="relative order-2 lg:order-1">
                <div class="rounded-[32px] overflow-hidden shadow-xl">
                    <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&h=600&q=80" alt="Stroke Symptoms Recognition and Diagnosis" class="w-full h-auto">
                </div>
                <div class="absolute -top-6 -left-6 w-32 h-32 bg-electric-blue/10 rounded-2xl -z-10"></div>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-cyan-accent/10 rounded-2xl -z-10"></div>
            </div>

            <!-- Content -->
            <div class="order-1 lg:order-2">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Recognition</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Stroke Symptoms & Indicators</h2>
                <p class="text-dark-grey/70 leading-relaxed mb-8">
                    Understanding additional signs beyond the FAST guidelines can save lives and help healthcare providers target emergency care.
                </p>

                <!-- Symptoms Grid -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <!-- Physical Symptoms -->
                    <div class="bg-[#edf5f9] rounded-xl p-4">
                        <div class="flex items-center space-x-3 mb-3">
                            <i class="fas fa-user-xmark text-electric-blue"></i>
                            <span class="font-semibold text-dark-grey text-sm">Motor & Balance</span>
                        </div>
                        <ul class="space-y-2 text-sm text-dark-grey/70">
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Sudden loss of balance</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Difficulty walking or dizziness</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Numbness on one side</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Coordination problems</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Associated Symptoms -->
                    <div class="bg-[#edf5f9] rounded-xl p-4">
                        <div class="flex items-center space-x-3 mb-3">
                            <i class="fas fa-eye text-cyan-accent"></i>
                            <span class="font-semibold text-dark-grey text-sm">Sensory & Vision</span>
                        </div>
                        <ul class="space-y-2 text-sm text-dark-grey/70">
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Double or blurred vision</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Sudden severe headache</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Confusion or brain fog</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Swallowing difficulties</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-electric-blue/5 border border-electric-blue/20 rounded-xl p-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <i class="fas fa-clock text-electric-blue"></i>
                        <span class="font-semibold text-dark-grey text-sm">The Golden Hour</span>
                    </div>
                    <p class="text-xs text-dark-grey/65 leading-relaxed">
                        Reperfusion therapies like tPA must be administered within a 4.5-hour window from symptom onset to achieve the highest rate of recovery.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Diagnosis Section -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Diagnosis</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">How We Diagnose Stroke</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Emergency diagnostics are completed within minutes of arrival to determine if a stroke is ischemic or hemorrhagic, guiding immediate intervention.
            </p>
        </div>

        <!-- Diagnosis Steps -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Step 1 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">1</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Rapid Neuro Exam</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Immediate clinical checking of sensory inputs, pupillary reflexes, speech clarity, and motor strengths to assess severity.
                    </p>
                </div>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-electric-blue/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">2</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Emergency Brain CT</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Fast imaging to rule out brain bleeding (hemorrhage) before prescribing blood thinners or clot-busting medications.
                    </p>
                </div>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-electric-blue/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">3</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Brain MRI & MRA</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Detailed imaging scan to trace exact brain tissue damage locations and map arterial blood flow pathways.
                    </p>
                </div>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-electric-blue/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">4</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Vascular Ultrasound</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Carotid duplex ultrasound checks for narrow neck arteries or plaques that could spark subsequent strokes.
                    </p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <p class="text-dark-grey/70 mb-6">Ready to get a proper diagnosis? Schedule a consultation today.</p>
            <a href="contact.php" class="inline-flex items-center space-x-3 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold px-8 py-4 rounded-full hover:shadow-xl hover:shadow-electric-blue/30 transition-all duration-300 transform hover:-translate-y-1">
                <span>Schedule Diagnosis</span>
                <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
    </div>
</section>

<!-- Treatment Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Treatment</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Comprehensive Stroke Management</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                From emergency thrombolysis to advanced long-term motor rehabilitation, we offer structured care at every phase of recovery.
            </p>
        </div>

        <!-- Treatment Cards -->
        <div class="grid lg:grid-cols-2 gap-8 mb-16">
            <!-- Thrombolysis -->
            <div class="bg-gradient-to-br from-electric-blue/5 to-cyan-accent/5 rounded-[24px] p-8 border border-electric-blue/10">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-electric-blue rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-shield text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Hyperacute Thrombolysis (tPA)</h3>
                        <p class="text-sm text-dark-grey/60">Clot-busting medication within 4.5 hours</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Intravenous tissue plasminogen activator (tPA) dissolves the blood clot causing an ischemic stroke, restoring vital blood flow.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Emergency clot dissolution</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Minimizes permanent brain damage</span>
                    </li>
                </ul>
            </div>

            <!-- Thrombectomy -->
            <div class="bg-gradient-to-br from-cyan-accent/5 to-electric-blue/5 rounded-[24px] p-8 border border-cyan-accent/10">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-cyan-accent rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-compass text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Mechanical Thrombectomy</h3>
                        <p class="text-sm text-dark-grey/60">Endovascular clot removal for large vessel blockages</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Using specialized catheters, the clot is physically extracted from large brain arteries, providing excellent results even up to 24 hours in selected cases.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-cyan-accent/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-cyan-accent text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Advanced catheter-based extraction</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-cyan-accent/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-cyan-accent text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">High success in large artery blockages</span>
                    </li>
                </ul>
            </div>

            <!-- Secondary Prevention -->
            <div class="bg-gradient-to-br from-deep-indigo/5 to-electric-blue/5 rounded-[24px] p-8 border border-deep-indigo/10">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-deep-indigo rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user-shield text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Secondary Prevention</h3>
                        <p class="text-sm text-dark-grey/60">Management of risk factors</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Preventing recurrences through medications, anticoagulants, antiplatelets, blood pressure control, and managing diabetes or cholesterol.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-deep-indigo/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-deep-indigo text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Blood pressure and cholesterol management</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-deep-indigo/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-deep-indigo text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Blood thinners & antiplatelet drug therapies</span>
                    </li>
                </ul>
            </div>

            <!-- Rehabilitation -->
            <div class="bg-gradient-to-br from-silver-grey/30 to-white rounded-[24px] p-8 border border-silver-grey/40">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-dark-grey rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-hand-holding-heart text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Neuro-Rehabilitation</h3>
                        <p class="text-sm text-dark-grey/60">Physical, occupational, & speech therapy</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Comprehensive rehabilitation programs to retrain brain pathways, restore motor function, rebuild speech, and return patients to independent living.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-dark-grey/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-dark-grey text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Specialized motor skill exercises</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-dark-grey/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-dark-grey text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Speech therapy and swallowing retraining</span>
                    </li>
                </ul>
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
                    With an unwavering commitment to clinical excellence, Dr. Praveen Gupta combines advanced technology and patient-centric therapies to deliver world-class neurological care.
                </p>

                <!-- Grid of 4 Items -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-12">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-earth-americas text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Global Standards of Care</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Treatments backed by advanced technology and international guidelines.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-lightbulb text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Innovative Procedures</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Pioneer in stroke care, DBS, and epilepsy surgery in India.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-circle-check text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Proven Results</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Thousands of patients treated successfully with rapid recovery.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="fa-solid fa-hand-holding-heart text-xl text-electric-blue"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif">Compassionate Consultation</h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">Empowering patients with knowledge, compassion, and personalized care.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <a href="contact.php" class="inline-flex items-center px-8 py-3.5 bg-[#111827] text-white text-sm font-bold rounded-full hover:bg-electric-blue transition-colors duration-300 shadow-lg shadow-dark-grey/10">
                        Get Started
                    </a>
                </div>
            </div>

            <!-- Image Side -->
            <div class="lg:col-span-6 relative flex justify-center lg:justify-end observe">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[3:4] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets\full-image\dpg-award.webp" alt="Compassionate Care" class="w-full h-full object-cover">
                </div>
            </div>
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
                                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?php echo $video['id']; ?>?rel=0&modestbranding=1" title="<?php echo htmlspecialchars($video['title']); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
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
                    <button class="edu-dot rounded-full transition-all duration-300 <?php echo $epIdx === 0 ? 'w-6 h-2.5 bg-electric-blue' : 'w-2.5 h-2.5 bg-silver-grey'; ?>" data-page="<?php echo $epIdx; ?>"></button>
                <?php endforeach; ?>
            </div>

            <!-- Prev / Next -->
            <div class="flex items-center space-x-3">
                <button id="edu-prev" class="w-11 h-11 rounded-full bg-white hover:bg-electric-blue hover:text-white text-deep-indigo border border-silver-grey shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button id="edu-next" class="w-11 h-11 rounded-full bg-electric-blue text-white hover:bg-deep-indigo border border-electric-blue shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
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

<!-- FAQ Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Column: Header Information -->
            <div class="lg:col-span-5 lg:sticky lg:top-24 self-start">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark-grey mt-3 mb-6">Frequently Asked Questions</h2>
                <p class="text-dark-grey/70 leading-relaxed max-w-md">
                    Answers to common questions regarding stroke prevention, recognition, and clinical rehabilitation.
                </p>
            </div>

            <!-- Right Column: Accordions -->
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is the "Golden Hour" in stroke care?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                The "Golden Hour" refers to the first 60 minutes after stroke symptoms begin. Getting medical care during this window dramatically improves the chances of saving dying brain tissue, resolving clots with tPA, and achieving full functional recovery.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can stroke damage be reversed?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Yes, in many cases stroke damage can be prevented or significantly reversed if clot-dissolving treatment (tPA) or mechanical thrombectomy is administered within the first golden hours of onset. Long-term neuro-rehabilitation also helps retrain adjacent brain areas to recover lost functions.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How do you prevent a second stroke?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Preventing a secondary stroke involves daily antiplatelet/anticoagulant medications, aggressive management of hypertension, high cholesterol, and diabetes, stopping smoking, adopting a heart-healthy diet, and regular exercise monitoring.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Toggle Script -->
<script>
function toggleFaq(button) {
    const item = button.closest('.faq-item');
    const content = button.nextElementSibling;
    const icon = button.querySelector('i');
    const isOpen = !content.classList.contains('hidden');

    // Close all other FAQs
    document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
    document.querySelectorAll('.faq-item').forEach(i => {
        i.classList.remove('bg-[#edf5f9]');
        i.classList.add('bg-white');
    });
    document.querySelectorAll('.faq-toggle i').forEach(i => {
        i.classList.remove('fa-minus');
        i.classList.add('fa-plus');
        i.style.transform = 'rotate(0deg)';
    });

    // Toggle current
    if (!isOpen) {
        content.classList.remove('hidden');
        item.classList.remove('bg-white');
        item.classList.add('bg-[#edf5f9]');
        icon.classList.remove('fa-plus');
        icon.classList.add('fa-minus');
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>

<!-- Related Services -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Explore More</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3">Related Neurological Services</h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="headache.php" class="group bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300">
                <h3 class="font-bold text-dark-grey mb-2 group-hover:text-electric-blue transition-colors">Headache</h3>
                <p class="text-sm text-dark-grey/60">Comprehensive headache diagnosis and targeted treatments.</p>
            </a>

            <a href="migraine.php" class="group bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300">
                <h3 class="font-bold text-dark-grey mb-2 group-hover:text-electric-blue transition-colors">Migraine</h3>
                <p class="text-sm text-dark-grey/60">Specialized migraine relief and long-term preventive care plans.</p>
            </a>

            <a href="movement.php" class="group bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300">
                <h3 class="font-bold text-dark-grey mb-2 group-hover:text-electric-blue transition-colors">Movement Disorders</h3>
                <p class="text-sm text-dark-grey/60">Expert care for tremors, dystonia, and movement issues.</p>
            </a>

            <a href="services.php" class="group bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300">
                <h3 class="font-bold text-dark-grey mb-2 group-hover:text-electric-blue transition-colors">All Services</h3>
                <p class="text-sm text-dark-grey/60">View our complete range of neurological treatments.</p>
            </a>
        </div>
    </div>
</section>

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
                    <a href="contact.php" class="inline-flex items-center space-x-6 bg-[#111827] text-white text-xs md:text-sm font-semibold pl-6 pr-2.5 py-2.5 rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:-translate-y-0.5 active:translate-y-0 group">
                        <span>Book Appointment</span>
                        <div class="w-7 h-7 rounded-full bg-gradient-to-b from-white via-slate-100 to-slate-400 shadow-[inset_0_1px_2px_rgba(255,255,255,0.8),0_2px_4px_rgba(0,0,0,0.3)] flex items-center justify-center text-[#111827] text-xs font-bold transition-transform duration-300 group-hover:scale-110 flex-shrink-0">
                            <i class="fas fa-chevron-right text-[9px]"></i>
                        </div>
                    </a>
                    <a href="tel:<?php echo SITE_PHONE; ?>" class="inline-flex items-center space-x-6 bg-[#111827] text-white text-xs md:text-sm font-semibold pl-6 pr-2.5 py-2.5 rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:-translate-y-0.5 active:translate-y-0 group">
                        <span>Call Now</span>
                        <div class="w-7 h-7 rounded-full bg-gradient-to-b from-white via-slate-100 to-slate-400 shadow-[inset_0_1px_2px_rgba(255,255,255,0.8),0_2px_4px_rgba(0,0,0,0.3)] flex items-center justify-center text-[#111827] text-xs font-bold transition-transform duration-300 group-hover:scale-110 flex-shrink-0">
                            <i class="fas fa-phone text-[9px]"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
