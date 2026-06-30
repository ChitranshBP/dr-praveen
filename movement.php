<?php
/**
 * Movement Disorders Service Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Movement Disorders</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-person-walking text-[10px]"></i>
                <span>Specialized Neurological Care</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Expert <span class="text-white">Movement Disorders</span> Treatment
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Advanced diagnostic and treatment solutions for tremors, dystonia, and coordination issues. Dr. Praveen Gupta designs customized plans to help you move with ease.
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

<!-- What is Movement Disorder Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Understanding</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">What is a Movement Disorder?</h2>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Movement disorders are neurological conditions that affect the speed, fluency, quality, and ease of movement. They are typically divided into hyperkinetic disorders (causing excessive, involuntary movements, such as tremors or spasms) and hypokinetic disorders (causing slow, stiff, or reduced movements).
                </p>
                <p class="text-dark-grey/70 leading-relaxed mb-8">
                    Involuntary movements or balance issues can make eating, writing, or walking extremely difficult. Our comprehensive diagnostic approach identifies the specific nerve or brain center origin to customize targeted medication regimens and therapy programs.
                </p>

                <!-- Key Facts -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Nerve Signal Basis</div>
                            <div class="text-xs text-dark-grey/60">Brain pathway signal issues</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Diverse Syndromes</div>
                            <div class="text-xs text-dark-grey/60">Includes tremors, dystonia, ataxia</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Botox Therapy</div>
                            <div class="text-xs text-dark-grey/60">Relieves local muscle spasms</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Coordination Rehab</div>
                            <div class="text-xs text-dark-grey/60">Helps retrain body balance</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Side -->
            <div class="relative flex justify-center lg:justify-end animate-slide-in-right">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey border border-silver-grey/20">
                    <img src="assets/services/movement.png" alt="Understanding Movement Disorders" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Types of Movement Disorders -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Recognition</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Common Movement Disorders</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Movement disorders present as involuntary muscle twitching, steady shaking, or a lack of coordination.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Essential Tremor -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-electric-blue/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-electric-blue group-hover:text-white transition-all duration-300">
                    <i class="fas fa-hand-holding text-electric-blue text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Essential Tremor</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    A common nerve disorder causing involuntary shaking, typically in the hands during active tasks like writing, drinking, or holding objects.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Active Shaking</span>
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Hands Focus</span>
                </div>
            </div>

            <!-- Dystonia -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-cyan-accent/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-cyan-accent transition-all duration-300">
                    <i class="fas fa-arrows-spin text-cyan-accent text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Dystonia</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Causes involuntary muscle contractions, leading to repetitive twisting movements or abnormal postures (such as writer's cramp or cervical neck twisting).
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Twisting Muscle</span>
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Botox Treatment</span>
                </div>
            </div>

            <!-- Ataxia -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-deep-indigo/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-deep-indigo transition-all duration-300">
                    <i class="fas fa-person-running text-deep-indigo text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Ataxia</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    A degenerative condition affecting the cerebellum, resulting in a severe lack of voluntary muscle coordination, balance problems, and unsteady walking.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Cerebellum Focus</span>
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Balance Loss</span>
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
                    <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&h=600&q=80" alt="Movement Disorder Symptoms Recognition and Diagnosis" class="w-full h-auto">
                </div>
                <div class="absolute -top-6 -left-6 w-32 h-32 bg-electric-blue/10 rounded-2xl -z-10"></div>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-cyan-accent/10 rounded-2xl -z-10"></div>
            </div>

            <!-- Content -->
            <div class="order-1 lg:order-2">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Recognition</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Symptoms & Signs</h2>
                <p class="text-dark-grey/70 leading-relaxed mb-8">
                    Recognizing the specific patterns of shaking, rigidity, or coordination drop-offs is key to correct medical classification.
                </p>

                <!-- Symptoms Grid -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <!-- Physical Motor Signs -->
                    <div class="bg-[#edf5f9] rounded-xl p-4">
                        <div class="flex items-center space-x-3 mb-3">
                            <i class="fas fa-hand-fist text-electric-blue"></i>
                            <span class="font-semibold text-dark-grey text-sm">Physical Motor</span>
                        </div>
                        <ul class="space-y-2 text-sm text-dark-grey/70">
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Involuntary shaking / tremors</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Abnormal muscle posturing</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Repetitive twisting motions</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Muscle twitching or jerks</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Associated Balance Signs -->
                    <div class="bg-[#edf5f9] rounded-xl p-4">
                        <div class="flex items-center space-x-3 mb-3">
                            <i class="fas fa-person-walking-lucida text-cyan-accent"></i>
                            <span class="font-semibold text-dark-grey text-sm">Coordination & Gait</span>
                        </div>
                        <ul class="space-y-2 text-sm text-dark-grey/70">
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Unsteady gait / walking issues</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Loss of fine motor skills</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Uncoordinated balance</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Vocal cord muscle spasms</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-electric-blue/5 border border-electric-blue/20 rounded-xl p-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <i class="fas fa-info-circle text-electric-blue"></i>
                        <span class="font-semibold text-dark-grey text-sm">Tremor Trigger Factors</span>
                    </div>
                    <p class="text-xs text-dark-grey/65 leading-relaxed">
                        Essential tremors often worsen during periods of stress, fatigue, temperature extremes, or heavy caffeine consumption.
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
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Diagnosing Movement Disorders</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Diagnosing movement disorders combines expert motor skill tracking, nerve path conduction tests, and brain scans to map basal ganglia pathways.
            </p>
        </div>

        <!-- Diagnosis Steps -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Step 1 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">1</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Motor Evaluation</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        In-depth testing of reflexes, gait patterns, tremor speed, range of motion, and fine motor skills.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">EMG & Nerve Studies</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Electromyography (EMG) and Nerve Conduction Studies measure electrical pathways inside active muscles and peripheral nerves.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Brain MRI</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        High-resolution imaging scans search for damage in the basal ganglia, cerebellum, or brainstem pathways.
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
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Genetic Screening</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Investigating chromosomal factors for hereditary conditions like Huntington's disease, ataxia, or early-onset dystonia.
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
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Movement Disorder Treatments</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                We utilize specialized pharmaceutical drugs, Botox injections, and neuro-rehabilitation therapies to improve motor function.
            </p>
        </div>

        <!-- Treatment Cards -->
        <div class="grid lg:grid-cols-2 gap-8 mb-16">
            <!-- Medical -->
            <div class="bg-gradient-to-br from-electric-blue/5 to-cyan-accent/5 rounded-[24px] p-8 border border-electric-blue/10">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-electric-blue rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-capsules text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Pharmacological Management</h3>
                        <p class="text-sm text-dark-grey/60">Targeted neurotransmitter drug therapies</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Dopaminergic drugs, anticholinergics, or muscle relaxants help regulate the brain signals that control voluntary muscle movements.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Beta-blockers or anticonvulsants for essential tremors</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Muscle relaxants (baclofen/clonazepam) for dystonia</span>
                    </li>
                </ul>
            </div>

            <!-- Botox -->
            <div class="bg-gradient-to-br from-cyan-accent/5 to-electric-blue/5 rounded-[24px] p-8 border border-cyan-accent/10">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-cyan-accent rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-syringe text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Botulinum Toxin (Botox) Injections</h3>
                        <p class="text-sm text-dark-grey/60">Highly targeted spasm control</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Botox injections temporarily block nerve signals to overactive muscles, relieving painful neck twists (cervical dystonia) or eye spasms (blepharospasm).
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-cyan-accent/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-cyan-accent text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Targeted localized muscle relaxation</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-cyan-accent/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-cyan-accent text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Effective relief lasting 3-4 months per session</span>
                    </li>
                </ul>
            </div>

            <!-- Physical Rehabilitation -->
            <div class="bg-gradient-to-br from-deep-indigo/5 to-electric-blue/5 rounded-[24px] p-8 border border-deep-indigo/10">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-deep-indigo rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-walking text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Motor Rehab & Balance Therapy</h3>
                        <p class="text-sm text-dark-grey/60">Stabilizing motor control and posture</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Physical therapy programs help patients maintain muscle strength, correct walking gait, improve balance, and prevent fall-related injuries.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-deep-indigo/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-deep-indigo text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Core strengthening and stability training</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-deep-indigo/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-deep-indigo text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Adaptive motor control exercise routines</span>
                    </li>
                </ul>
            </div>

            <!-- Deep Brain Stimulation -->
            <div class="bg-gradient-to-br from-silver-grey/30 to-white rounded-[24px] p-8 border border-silver-grey/40">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-dark-grey rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-bolt text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Deep Brain Stimulation (DBS) Referral</h3>
                        <p class="text-sm text-dark-grey/60">Advanced neurosurgical options</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    For severe essential tremors or generalized dystonias that do not respond to medications, DBS neurosurgery can offer life-changing results.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-dark-grey/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-dark-grey text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Suppresses severe, disabling tremors</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-dark-grey/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-dark-grey text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Comprehensive pre- and post-operative management</span>
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
                    Answers to common questions regarding essential tremors, dystonias, and physical balance retraining.
                </p>
            </div>

            <!-- Right Column: Accordions -->
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is the difference between Essential Tremor and Parkinson's?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Parkinson's tremors are typically "resting tremors"—they happen when muscles are completely relaxed. Essential Tremor is an "action tremor"—shaking occurs when using the hands to write, drink, or perform tasks. Parkinson's also includes stiffness and slow movements, which are absent in Essential Tremor.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How do Botox injections help dystonias?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Dystonia causes involuntary, sustained muscle contractions. Injecting Botox (botulinum toxin) directly into affected muscles blocks the chemical signals that trigger muscle tightening, relaxing the spasm and relieving twisting or painful posturing for up to 3 to 4 months.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can ataxia symptoms be managed?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                While progressive cerebellar ataxia does not have a single cure, symptoms are managed using targeted physical therapies focusing on balance preservation, gait coordination, and occupational adaptations (like weighted utensils) to help patients retain daily independence.
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
            <a href="parkinsons.php" class="group bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300">
                <h3 class="font-bold text-dark-grey mb-2 group-hover:text-electric-blue transition-colors">Parkinson's Disease</h3>
                <p class="text-sm text-dark-grey/60">Expert pharmacological care, motor therapy, and DBS guidance.</p>
            </a>

            <a href="ms.php" class="group bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300">
                <h3 class="font-bold text-dark-grey mb-2 group-hover:text-electric-blue transition-colors">Multiple Sclerosis</h3>
                <p class="text-sm text-dark-grey/60">Advanced immunomodulatory therapies and symptom management.</p>
            </a>

            <a href="neuropathy.php" class="group bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300">
                <h3 class="font-bold text-dark-grey mb-2 group-hover:text-electric-blue transition-colors">Peripheral Neuropathy</h3>
                <p class="text-sm text-dark-grey/60">Diagnosis and targeted treatment for chronic nerve pain.</p>
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
