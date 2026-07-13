<?php
/**
 * Emergency Neurology Care Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section (Urgency Theme) -->
<section class="relative overflow-hidden bg-gradient-to-br from-red-800 via-red-950 to-slate-950 text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-red-600/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Emergency Care</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-exclamation-circle text-red-400 text-[10px] animate-pulse"></i>
                <span>24/7 Emergency Neurology Response</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Emergency <span class="text-red-400">Neurology Care</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                When a neurological emergency strikes, every second counts. Under the guidance of Dr. Praveen Gupta, our team provides rapid, life-saving care for stroke, seizures, and head trauma.
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="tel:<?php echo SITE_PHONE; ?>" class="inline-flex items-center space-x-3 bg-red-600 hover:bg-red-700 text-white font-extrabold text-base px-8 py-3.5 rounded-2xl shadow-lg shadow-red-600/20 hover:shadow-red-600/40 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fas fa-phone-alt animate-bounce"></i>
                    <span>Call Helpline: <?php echo SITE_PHONE; ?></span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Neurological Emergencies List -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-red-600 font-bold text-xs uppercase tracking-wider font-sans">Emergency Signs</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">When to Seek Immediate Emergency Neurology Care</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                If you or a loved one experiences any of the following symptoms, call our emergency hotline or go to the nearest emergency room immediately.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Emergency 1 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Acute Stroke Symptoms</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Sudden weakness or numbness in the face, arm, or leg (especially on one side of the body), difficulty speaking, slurred speech, or sudden vision loss.
                </p>
            </div>

            <!-- Emergency 2 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-wave-square"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Status Epilepticus / Seizures</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Continuous seizures lasting more than 5 minutes, or multiple seizures in close succession without the person fully regaining consciousness in between.
                </p>
            </div>

            <!-- Emergency 3 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-tint"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Thunderclap Headache</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A sudden, extremely severe headache that peaks within 60 seconds. Often described as the "worst headache of your life," possibly indicating brain hemorrhage.
                </p>
            </div>

            <!-- Emergency 4 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-user-injured"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Head Trauma & Concussion</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Severe head injury accompanied by loss of consciousness, persistent confusion, repeated vomiting, unequal pupil sizes, or fluid leaking from the nose/ears.
                </p>
            </div>

            <!-- Emergency 5 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-wheelchair"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Sudden Paralysis / Weakness</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Rapid onset of paralysis or loss of motor control in the legs or arms, which may indicate spinal cord compression, transverse myelitis, or Guillain-Barré syndrome.
                </p>
            </div>

            <!-- Emergency 6 -->
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-dizzy"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Altered Mental Status</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Sudden onset of severe confusion, delirium, hallucination, or unresponsiveness (stupor/coma), possibly due to brain infections (encephalitis/meningitis).
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Emergency Protocol Section -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left: Text -->
            <div class="lg:col-span-6 space-y-6">
                <span class="text-red-600 font-bold text-xs uppercase tracking-wider">Our Action Code</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Rapid Response Protocols</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Under the clinical leadership of Dr. Praveen Gupta, Marengo Asia Hospital runs structured neurological emergency response channels. Our stroke code and neuro-ICU procedures prioritize rapid triage, diagnosis, and treatment to minimize brain injury.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3.5">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center text-red-600 flex-shrink-0 mt-0.5">
                            <i class="fas fa-clock text-xs"></i>
                        </div>
                        <p class="text-xs text-dark-grey/70 leading-relaxed">
                            <strong class="text-deep-indigo">Door-to-Needle Time:</strong> Aiming to deliver thrombolytic (clot-dissolving) therapy within minutes of emergency arrival.
                        </p>
                    </div>
                    <div class="flex items-start space-x-3.5">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center text-red-600 flex-shrink-0 mt-0.5">
                            <i class="fas fa-x-ray text-xs"></i>
                        </div>
                        <p class="text-xs text-dark-grey/70 leading-relaxed">
                            <strong class="text-deep-indigo">24/7 Advanced Imaging:</strong> Immediate access to high-speed MRI and CT angiography to locate vessel blockages and bleeding.
                        </p>
                    </div>
                    <div class="flex items-start space-x-3.5">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center text-red-600 flex-shrink-0 mt-0.5">
                            <i class="fas fa-procedures text-xs"></i>
                        </div>
                        <p class="text-xs text-dark-grey/70 leading-relaxed">
                            <strong class="text-deep-indigo">Dedicated Neuro-ICU:</strong> Specialized intensive care unit equipped with intracranial pressure monitoring and specialized support systems.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right: Critical Steps -->
            <div class="lg:col-span-6 bg-white p-8 rounded-3xl border border-silver-grey/40 space-y-6">
                <h3 class="text-xl font-bold text-deep-indigo font-serif">Critical Steps in an Emergency</h3>
                
                <div class="space-y-4">
                    <div class="p-4 bg-red-50/50 rounded-2xl flex items-start space-x-3">
                        <span class="w-6 h-6 bg-red-600 text-white font-bold rounded-full flex items-center justify-center text-xs flex-shrink-0">1</span>
                        <div class="text-xs">
                            <strong class="text-deep-indigo">Call our emergency line immediately:</strong> Do not wait to see if the symptoms will go away.
                        </div>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl flex items-start space-x-3">
                        <span class="w-6 h-6 bg-deep-indigo text-white font-bold rounded-full flex items-center justify-center text-xs flex-shrink-0">2</span>
                        <div class="text-xs">
                            <strong class="text-deep-indigo">Do not administer oral medication:</strong> Choking risks are high due to impaired swallowing reflexes.
                        </div>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl flex items-start space-x-3">
                        <span class="w-6 h-6 bg-deep-indigo text-white font-bold rounded-full flex items-center justify-center text-xs flex-shrink-0">3</span>
                        <div class="text-xs">
                            <strong class="text-deep-indigo">Keep the airway clear:</strong> Lay the patient on their side if they are unconscious or semi-conscious.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Emergency Contact / Query Form Section -->
<section class="py-16 bg-white border-t border-b border-silver-grey/40">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-red-800 to-slate-950 text-white rounded-[32px] p-8 md:p-12 shadow-xl relative overflow-hidden">
            <!-- Glow Accent -->
            <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-red-650/15 rounded-full blur-[100px] pointer-events-none"></div>

            <div class="relative z-10 space-y-6">
                <div class="text-center max-w-2xl mx-auto">
                    <span class="text-red-400 font-bold text-xs uppercase tracking-widest">General Query or Callback</span>
                    <h2 class="text-2xl md:text-3xl font-bold font-serif mt-2">Request a Call-Back</h2>
                    <p class="text-white/80 text-xs mt-2 leading-relaxed">
                        For non-life-threatening clinical inquiries, leave your details below and our triage coordinator will call you.
                    </p>
                </div>

                <form class="space-y-4 pt-4 max-w-2xl mx-auto" onsubmit="event.preventDefault(); alert('Callback request submitted successfully! Our coordinator will contact you shortly.');">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="ec-name" class="block text-xs font-semibold text-white/95 mb-2">FULL NAME</label>
                            <input type="text" id="ec-name" required placeholder="John Doe" class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-red-400 text-xs text-white placeholder-white/50">
                        </div>
                        <div>
                            <label for="ec-phone" class="block text-xs font-semibold text-white/95 mb-2">PHONE NUMBER</label>
                            <input type="tel" id="ec-phone" required placeholder="Phone Number" class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-red-400 text-xs text-white placeholder-white/50">
                        </div>
                    </div>
                    <div>
                        <label for="ec-desc" class="block text-xs font-semibold text-white/95 mb-2">NATURE OF INQUIRY</label>
                        <textarea id="ec-desc" rows="3" required placeholder="Describe your query or symptom concerns..." class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-red-400 text-xs text-white placeholder-white/50"></textarea>
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl transition-all duration-300 transform active:scale-95 text-xs shadow-lg shadow-red-600/20">
                            Request Call-Back
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Column: Header Information -->
            <div class="lg:col-span-5 lg:sticky lg:top-24 self-start">
                <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark-grey mt-3 mb-6">Frequently Asked Questions</h2>
                <p class="text-dark-grey/70 leading-relaxed max-w-md">
                    Answers to critical questions regarding emergency admissions, stroke response, and first-aid measures.
                </p>
            </div>

            <!-- Right Column: Accordions -->
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What constitutes a neurological emergency?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Neurological emergencies include sudden onset of facial drooping, arm or leg weakness, difficulty speaking, severe sudden headache (thunderclap headache), sudden vision loss, loss of consciousness, or prolonged seizures.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Does the hospital have a dedicated stroke unit?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Yes, Marengo Asia Hospital features a dedicated, round-the-clock Stroke and Neurocritical Care Unit with rapid access to CT/MRI imaging, catheterization labs for mechanical thrombectomy, and highly specialized intensive care.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What should I do while waiting for emergency transport?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Keep the patient calm, lying down on their side to keep the airway clear. Note the exact time when the first symptom started. Do not give the patient anything to eat or drink (including water or aspirin) as they may have swallowing difficulties.
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

<?php require_once __DIR__ . '/includes/footer.php'; ?>
