<?php
/**
 * Epilepsy Service Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Epilepsy</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-bolt text-[10px]"></i>
                <span>Specialized Neurological Care</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Expert <span class="text-white">Epilepsy</span> Treatment
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Comprehensive care for seizures and epilepsy disorders. Dr. Praveen Gupta provides advanced diagnosis and personalized treatment plans to help you achieve seizure freedom.
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

<!-- What is Epilepsy Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Understanding</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">What is Epilepsy?</h2>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Epilepsy is a neurological disorder characterized by recurrent, unprovoked seizures. It affects over 50 million people worldwide, making it one of the most common neurological conditions. While epilepsy can develop at any age, it often begins in childhood or after age 60.
                </p>
                <p class="text-dark-grey/70 leading-relaxed mb-8">
                    At our clinic, we understand that living with epilepsy affects every aspect of your life—from daily activities to personal relationships. Our comprehensive approach focuses not just on controlling seizures, but on improving your overall quality of life through evidence-based treatments and compassionate care.
                </p>

                <!-- Key Facts -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Neurological Disorder</div>
                            <div class="text-xs text-dark-grey/60">Brain-based condition</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Treatable Condition</div>
                            <div class="text-xs text-dark-grey/60">70% can be seizure-free</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">All Ages</div>
                            <div class="text-xs text-dark-grey/60">Can affect anyone</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-electric-blue/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Not a Mental Illness</div>
                            <div class="text-xs text-dark-grey/60">Separate from psychiatric</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Side -->
            <div class="relative flex justify-center lg:justify-end animate-slide-in-right">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey border border-silver-grey/20">
                    <img src="assets/services/epilepsy.png" alt="Understanding Epilepsy" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Types of Seizures -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Recognition</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Types of Seizures</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Understanding the different types of seizures is crucial for proper diagnosis and treatment. Seizures are categorized based on where they begin in the brain.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Focal Onset Seizures -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-electric-blue/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-electric-blue group-hover:text-white transition-all duration-300">
                    <i class="fas fa-brain text-electric-blue text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Focal Onset Seizures</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Begin in one area of the brain. May cause changes in sensation, emotions, or movements while the person remains conscious (focal aware) or may cause loss of awareness (focal impaired awareness).
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Motor</span>
                    <span class="text-xs bg-electric-blue/10 text-electric-blue px-3 py-1 rounded-full font-medium">Non-Motor</span>
                </div>
            </div>

            <!-- Generalized Onset -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-cyan-accent/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-cyan-accent transition-all duration-300">
                    <i class="fas fa-bolt text-cyan-accent text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Generalized Onset Seizures</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Affect both sides of the brain simultaneously from the start. These include absence seizures (brief loss of awareness), tonic seizures (muscle stiffening), and clonic seizures (rhythmic jerking).
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Tonic-Clonic</span>
                    <span class="text-xs bg-cyan-accent/10 text-cyan-accent px-3 py-1 rounded-full font-medium">Absence</span>
                </div>
            </div>

            <!-- Unknown Onset -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 bg-deep-indigo/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-deep-indigo transition-all duration-300">
                    <i class="fas fa-question text-deep-indigo text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Unknown Onset Seizures</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    When the beginning of a seizure cannot be determined as focal or generalized. Further testing and monitoring may be needed to classify the seizure type accurately.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Unclassified</span>
                    <span class="text-xs bg-deep-indigo/10 text-deep-indigo px-3 py-1 rounded-full font-medium">Diagnostic</span>
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
                    <h4 class="text-lg font-bold text-dark-grey">When to Seek Emergency Care</h4>
                    <p class="text-sm text-dark-grey/60 mt-1">Call emergency services immediately if:</p>
                </div>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-circle text-red-400 text-[6px]"></i>
                    <span class="text-dark-grey/80">Seizure lasts more than 5 minutes</span>
                </div>
                <div class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-circle text-red-400 text-[6px]"></i>
                    <span class="text-dark-grey/80">Second seizure follows immediately</span>
                </div>
                <div class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-circle text-red-400 text-[6px]"></i>
                    <span class="text-dark-grey/80">Person doesn't breathe normally after</span>
                </div>
                <div class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-circle text-red-400 text-[6px]"></i>
                    <span class="text-dark-grey/80">Person is injured during seizure</span>
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
                    <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&h=600&q=80" alt="Epilepsy Symptoms Recognition and Diagnosis" class="w-full h-auto">
                </div>
                <!-- Decorative element -->
                <div class="absolute -top-6 -left-6 w-32 h-32 bg-electric-blue/10 rounded-2xl -z-10"></div>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-cyan-accent/10 rounded-2xl -z-10"></div>
            </div>

            <!-- Content -->
            <div class="order-1 lg:order-2">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Recognition</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Symptoms & Warning Signs</h2>
                <p class="text-dark-grey/70 leading-relaxed mb-8">
                    Recognizing seizure symptoms is the first step toward proper diagnosis and treatment. Symptoms vary widely depending on the type of seizure and the area of the brain affected.
                </p>

                <!-- Symptoms Grid -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <!-- Motor Symptoms -->
                    <div class="bg-[#edf5f9] rounded-xl p-4">
                        <div class="flex items-center space-x-3 mb-3">
                            <i class="fas fa-hand-fist text-electric-blue"></i>
                            <span class="font-semibold text-dark-grey text-sm">Motor Symptoms</span>
                        </div>
                        <ul class="space-y-2 text-sm text-dark-grey/70">
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Jerking movements</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Muscle weakness</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Twitching or spasms</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-electric-blue/60 text-[10px]"></i>
                                <span>Rigid muscles</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Non-Motor Symptoms -->
                    <div class="bg-[#edf5f9] rounded-xl p-4">
                        <div class="flex items-center space-x-3 mb-3">
                            <i class="fas fa-brain text-cyan-accent"></i>
                            <span class="font-semibold text-dark-grey text-sm">Non-Motor Symptoms</span>
                        </div>
                        <ul class="space-y-2 text-sm text-dark-grey/70">
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Staring spells</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Confusion</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Fear or anxiety</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check text-cyan-accent/60 text-[10px]"></i>
                                <span>Strange smells/tastes</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Aura Signs -->
                <div class="bg-electric-blue/5 border border-electric-blue/20 rounded-xl p-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <i class="fas fa-eye text-electric-blue"></i>
                        <span class="font-semibold text-dark-grey text-sm">Aura Signs (Early Warning)</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-white border border-electric-blue/20 px-3 py-1.5 rounded-full text-dark-grey/70">Visual disturbances</span>
                        <span class="text-xs bg-white border border-electric-blue/20 px-3 py-1.5 rounded-full text-dark-grey/70">Nausea</span>
                        <span class="text-xs bg-white border border-electric-blue/20 px-3 py-1.5 rounded-full text-dark-grey/70">D déjà vu</span>
                        <span class="text-xs bg-white border border-electric-blue/20 px-3 py-1.5 rounded-full text-dark-grey/70">Numbness</span>
                        <span class="text-xs bg-white border border-electric-blue/20 px-3 py-1.5 rounded-full text-dark-grey/70">Speech difficulty</span>
                    </div>
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
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">How We Diagnose Epilepsy</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Accurate diagnosis is the foundation of effective treatment. Our comprehensive diagnostic approach combines clinical evaluation with advanced technology to identify the type and cause of your seizures.
            </p>
        </div>

        <!-- Diagnosis Steps -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Step 1 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">1</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Clinical Assessment</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Detailed review of your medical history, seizure description, family history, and physical examination to understand your symptoms.
                    </p>
                    <ul class="space-y-2 text-sm text-dark-grey/70">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>Medical history review</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>Seizure description</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>Physical examination</span>
                        </li>
                    </ul>
                </div>
                <!-- Arrow -->
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-electric-blue/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">2</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">EEG Monitoring</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Electroencephalogram (EEG) records brain electrical activity to identify seizure patterns and determine the seizure focus.
                    </p>
                    <ul class="space-y-2 text-sm text-dark-grey/70">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>Standard EEG</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>Video EEG monitoring</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>Ambulatory EEG</span>
                        </li>
                    </ul>
                </div>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-electric-blue/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">3</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Advanced Imaging</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        MRI and CT scans to identify structural abnormalities, tumors, or brain lesions that may be causing seizures.
                    </p>
                    <ul class="space-y-2 text-sm text-dark-grey/70">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>High-resolution MRI</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>Functional MRI</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>PET scans</span>
                        </li>
                    </ul>
                </div>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-electric-blue/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-electric-blue text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">4</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Lab Tests</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Blood tests and other laboratory investigations to rule out metabolic causes and identify any underlying conditions.
                    </p>
                    <ul class="space-y-2 text-sm text-dark-grey/70">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>Blood panel</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>Metabolic screening</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span>Genetic testing</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CTA -->
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
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Comprehensive Treatment Options</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Every patient's journey with epilepsy is unique. We offer a range of evidence-based treatments tailored to your specific condition, seizure type, and lifestyle needs.
            </p>
        </div>

        <!-- Treatment Cards -->
        <div class="grid lg:grid-cols-2 gap-8 mb-16">
            <!-- Medication -->
            <div class="bg-gradient-to-br from-electric-blue/5 to-cyan-accent/5 rounded-[24px] p-8 border border-electric-blue/10">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-electric-blue rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-pills text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Anti-Seizure Medications (ASM)</h3>
                        <p class="text-sm text-dark-grey/60">First-line treatment for most patients</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Anti-seizure medications are the most common treatment for epilepsy. We carefully select and adjust medications based on your seizure type, age, other health conditions, and potential side effects.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Over 20 FDA-approved medications available</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Personalized medication selection</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Regular monitoring and dose adjustment</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-electric-blue text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Side effect management</span>
                    </li>
                </ul>
            </div>

            <!-- Dietary Therapy -->
            <div class="bg-gradient-to-br from-cyan-accent/5 to-electric-blue/5 rounded-[24px] p-8 border border-cyan-accent/10">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-cyan-accent rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-utensils text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Dietary Therapies</h3>
                        <p class="text-sm text-dark-grey/60">Metabolic approaches to seizure control</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Dietary modifications can be highly effective, especially for children and patients who don't respond well to medications. We offer guidance on specialized diets tailored to your needs.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-cyan-accent/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-cyan-accent text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Ketogenic diet programs</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-cyan-accent/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-cyan-accent text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Modified Atkins diet</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-cyan-accent/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-cyan-accent text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Low glycemic index treatment</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-cyan-accent/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-cyan-accent text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Nutritional counseling</span>
                    </li>
                </ul>
            </div>

            <!-- Surgical Options -->
            <div class="bg-gradient-to-br from-deep-indigo/5 to-electric-blue/5 rounded-[24px] p-8 border border-deep-indigo/10">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-deep-indigo rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-microscope text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Surgical Interventions</h3>
                        <p class="text-sm text-dark-grey/60">For drug-resistant epilepsy</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    When medications don't control seizures, surgical options may be considered. We evaluate candidates thoroughly to determine the most appropriate surgical approach.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-deep-indigo/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-deep-indigo text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Resective surgery</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-deep-indigo/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-deep-indigo text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Laser ablation</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-deep-indigo/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-deep-indigo text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Vagus Nerve Stimulation (VNS)</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-deep-indigo/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-deep-indigo text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Responsive Neurostimulation (RNS)</span>
                    </li>
                </ul>
            </div>

            <!-- Lifestyle Management -->
            <div class="bg-gradient-to-br from-silver-grey/30 to-white rounded-[24px] p-8 border border-silver-grey/40">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 bg-dark-grey rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-heart-pulse text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2">Lifestyle & Support</h3>
                        <p class="text-sm text-dark-grey/60">Holistic approach to epilepsy management</p>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    Living well with epilepsy involves more than just medication. We provide comprehensive guidance on lifestyle modifications and support services.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-dark-grey/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-dark-grey text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Sleep hygiene optimization</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-dark-grey/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-dark-grey text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Stress management techniques</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-dark-grey/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-dark-grey text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Seizure trigger identification</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-dark-grey/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-dark-grey text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80">Safety planning & first aid</span>
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

<!-- FAQ Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Column: Header Information -->
            <div class="lg:col-span-5 lg:sticky lg:top-24 self-start">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark-grey mt-3 mb-6">Frequently Asked Questions</h2>
                <p class="text-dark-grey/70 leading-relaxed max-w-md">
                    We compiled a list of answers to address your most pressing questions regarding epilepsy diagnosis, treatment, and management.
                </p>
            </div>

            <!-- Right Column: Accordions -->
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is the difference between epilepsy and a single seizure?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                A single seizure doesn't necessarily mean you have epilepsy. Epilepsy is diagnosed when a person has two or more unprovoked seizures occurring at least 24 hours apart. Single seizures can be triggered by various factors like fever, head injury, or metabolic disturbances, and may not recur.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can epilepsy be cured completely?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                While there's no universal cure for epilepsy, many people achieve complete seizure control with proper treatment. About 70% of people with epilepsy can be seizure-free with medication. Some patients, particularly children, may outgrow epilepsy. In select cases of drug-resistant epilepsy, surgery can potentially provide a cure.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What should I do if someone is having a seizure?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Stay calm and move nearby objects out of the way. Gently guide the person to the ground if they're standing. Turn them on their side to keep airways clear. Don't put anything in their mouth. Time the seizure and call emergency services if it lasts more than 5 minutes, they don't wake up after, or they're injured.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can I live a normal life with epilepsy?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Absolutely. With proper treatment and management, many people with epilepsy live full, active lives. Most people with well-controlled seizures can work, drive (when seizure-free per local regulations), exercise, and participate in all normal activities. We work with you to minimize limitations and maximize quality of life.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What are common epilepsy triggers?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Common triggers vary by individual but may include lack of sleep, stress, alcohol or drug use, flashing lights (photosensitivity), certain medications, hormonal changes, and missed anti-seizure doses. We help you identify your personal triggers through detailed history and seizure diaries.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 6 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How often should I see my neurologist?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed">
                                Follow-up frequency depends on seizure control and medication side effects. Initially, visits may be every 1-3 months. Once stable, visits typically occur every 6-12 months. You'll need more frequent visits if adjustments are being made to medication or if breakthrough seizures occur.
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
                <p class="text-sm text-dark-grey/60">Comprehensive headache and migraine diagnosis and treatment.</p>
            </a>

            <a href="stroke.php" class="group bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300">
                <h3 class="font-bold text-dark-grey mb-2 group-hover:text-electric-blue transition-colors">Stroke</h3>
                <p class="text-sm text-dark-grey/60">Prevention, treatment, and rehabilitation for stroke patients.</p>
            </a>

            <a href="movement.php" class="group bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300">
                <h3 class="font-bold text-dark-grey mb-2 group-hover:text-electric-blue transition-colors">Movement Disorders</h3>
                <p class="text-sm text-dark-grey/60">Expert care for tremors, dystonia, and other movement issues.</p>
            </a>

            <a href="services.php" class="group bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300">
                <h3 class="font-bold text-dark-grey mb-2 group-hover:text-electric-blue transition-colors">All Services</h3>
                <p class="text-sm text-dark-grey/60">View our complete range of neurological treatments.</p>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
