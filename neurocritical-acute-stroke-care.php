<?php
/**
 * Neurocritical & Acute Stroke Care - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Neurocritical Care</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-clock text-[10px] animate-pulse text-red-400"></i>
                <span>24/7 Stroke Rescue & ICU</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Neurocritical & <span class="text-cyan-accent">Acute Stroke Care</span>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Immediate, lifesaving interventions for brain stroke, severe trauma, status epilepticus, and neurological emergencies. Monitored continuously in our specialized Neuro-ICU.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap gap-3">
                <a href="tel:<?php echo SITE_PHONE; ?>" class="inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
                    <span>Emergency Helpline</span>
                    <i class="fas fa-phone-alt text-xs text-red-500"></i>
                </a>
                <a href="contact-us-top-neurologist-delhi-ncr.php" class="inline-flex items-center space-x-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold px-6 py-2.5 rounded-full border border-white/30 hover:bg-white/30 transition-all duration-300 text-sm">
                    <span>Book Consultation</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- What is Neurocritical Care Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Emergency Response</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Expert Acute Stroke & Neuro ICU</h2>
                <p class="text-dark-grey/70 leading-relaxed mb-6">
                    A neurological emergency requires rapid diagnostics and immediate treatment. The "Golden Hour" represents the first few hours after stroke symptoms begin. Restoring blood flow to the brain via thrombolysis (clot-busting medication) or mechanical thrombectomy (catheter clot retrieval) can reverse paralysis and save lives.
                </p>
                <p class="text-dark-grey/70 leading-relaxed mb-8">
                    Following initial rescue, critically ill patients are monitored in our advanced Neuro-ICU. Here, we track intracranial pressure (ICP), brain oxygenation, and continuous electroencephalography (EEG) to detect non-convulsive seizures and protect tissue.
                </p>

                <!-- Key Facts -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-red-650 text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Clot Retrieval</div>
                            <div class="text-xs text-dark-grey/60">Mechanical thrombectomy</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-red-650 text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Golden Hour Care</div>
                            <div class="text-xs text-dark-grey/60">Urgent clot-dissolving tPA</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-red-650 text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">Neuro ICU Monitoring</div>
                            <div class="text-xs text-dark-grey/60">Continuous ICP & EEG tracking</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-red-650 text-xs"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-dark-grey text-sm">ICU Nursing</div>
                            <div class="text-xs text-dark-grey/60">1:1 neuro-certified care</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Side -->
            <div class="relative flex justify-center lg:justify-end animate-slide-in-right">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-red-50 to-white border border-red-200/50">
                    <img src="assets/services/stroke-care.png" alt="Neurocritical ICU room" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BE FAST Stroke Warning Signs -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-red-650 font-semibold text-sm uppercase tracking-wider">Recognition</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">BE FAST: Stroke Recognition</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Use the BE FAST method to immediately identify stroke symptoms in others and coordinate care.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Sign 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-red-200/30 transition-all duration-300 group">
                <div class="w-14 h-14 bg-red-50 rounded-xl flex items-center justify-center mb-5 group-hover:bg-red-600 transition-all duration-300">
                    <i class="fas fa-sync text-red-650 text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Balance & Eyes</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Sudden loss of balance, trouble walking, or coordination difficulty, paired with abrupt vision changes like blurred or double vision.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-red-50 text-red-650 px-3 py-1 rounded-full font-medium">Balance Loss</span>
                    <span class="text-xs bg-red-50 text-red-650 px-3 py-1 rounded-full font-medium">Vision Blur</span>
                </div>
            </div>

            <!-- Sign 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-red-200/30 transition-all duration-300 group">
                <div class="w-14 h-14 bg-red-50 rounded-xl flex items-center justify-center mb-5 group-hover:bg-red-600 transition-all duration-300">
                    <i class="fas fa-face-meh text-red-650 text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Face & Arms</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    One side of the face droops or is numb when attempting to smile. When raising both arms, one arm drifts downward or feels weak.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-red-50 text-red-650 px-3 py-1 rounded-full font-medium">Facial Droop</span>
                    <span class="text-xs bg-red-50 text-red-650 px-3 py-1 rounded-full font-medium">Arm Drift</span>
                </div>
            </div>

            <!-- Sign 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-red-200/30 transition-all duration-300 group">
                <div class="w-14 h-14 bg-red-50 rounded-xl flex items-center justify-center mb-5 group-hover:bg-red-600 transition-all duration-300">
                    <i class="fas fa-comments text-red-650 text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3">Speech & Time</h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                    Speech is slurred, garbled, or difficult to understand, or the person cannot speak. Time is critical – call the emergency helpline immediately.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs bg-red-50 text-red-650 px-3 py-1 rounded-full font-medium">Slurred Speech</span>
                    <span class="text-xs bg-red-50 text-red-650 px-3 py-1 rounded-full font-medium">Call Emergency</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Clinical ICU Steps -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-red-650 font-semibold text-sm uppercase tracking-wider">Clinical Steps</span>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6">Our Emergency Response Protocol</h2>
            <p class="text-dark-grey/70 leading-relaxed">
                Our emergency neurology protocol coordinates fast-tracked diagnostics and treatments to save brain tissue.
            </p>
        </div>

        <!-- ICU Steps -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Step 1 -->
            <div class="relative">
                <div class="bg-slate-50 rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-red-650 text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">1</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Rapid Brain Imaging</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Upon arrival at emergency, a non-contrast brain CT scan is performed within 25 minutes to verify the type of stroke.
                    </p>
                </div>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-red-650/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative">
                <div class="bg-slate-50 rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-red-650 text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">2</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">IV Thrombolysis</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Clot-dissolving medication (tPA) is administered intravenously to break down blockages and restore blood circulation.
                    </p>
                </div>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-red-650/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative">
                <div class="bg-slate-50 rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-red-650 text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">3</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">Mechanical Retrieval</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Catheter-based thrombectomy is performed in our Cath Lab to physically extract the blockage from the cerebral artery.
                    </p>
                </div>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-red-650/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative">
                <div class="bg-slate-50 rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 bg-red-650 text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5">4</div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3">ICU Care & Tracking</h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4">
                        Transfer to the specialized Neuro-ICU for continuous intracranial pressure, blood pressure, and EEG monitoring.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Doctor Section -->
<section id="about-doctor" class="py-16 bg-white border-t border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Image Side -->
            <div class="lg:col-span-5 relative observe">
                <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-xl bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="assets/dpg-1.webp" alt="Dr. Praveen Gupta" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Content Side -->
            <div class="lg:col-span-7 observe">
                <span class="text-xs font-bold tracking-wider text-dark-grey/60 uppercase block mb-3 font-sans">
                    About Dr. Praveen Gupta
                </span>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo leading-tight mb-4">
                    Dr. Praveen Gupta – Best Neurologist in India
                </h2>

                <!-- Prestigious Appointments -->
                <div class="flex flex-col space-y-2.5 mb-6">
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-award text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chairman – Marengo Asia International Institute of Neuro and Spine</span>
                    </div>
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-chart-line text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chief Clinical Strategy Growth and Innovation, North India</span>
                    </div>
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="fa-solid fa-lightbulb text-cyan-accent flex-shrink-0 text-base"></i>
                        <span>Chief Mentor for Start-ups</span>
                    </div>
                </div>

                <p class="text-sm text-dark-grey/85 mb-4 leading-relaxed">
                    With over 20 years of clinical experience, Dr. Praveen Gupta has emerged as a pioneering force in the diagnosis, treatment, and advancement of neurological sciences across India and beyond. He is responsible for several firsts in the country’s neurology landscape, including establishing Gurugram's first stroke centre and conducting pioneering BMT procedures for autoimmune neuro-disorders.
                </p>

                <div>
                    <a href="about.php" class="inline-flex items-center space-x-4 border-2 border-dark-grey px-6 py-2.5 rounded-full hover:bg-dark-grey hover:text-white transition-all duration-300 group">
                        <span class="text-xs font-bold text-dark-grey group-hover:text-white transition-colors duration-300">More About Doctor</span>
                        <div class="w-8 h-8 rounded-full bg-dark-grey text-white flex items-center justify-center text-xs group-hover:bg-white group-hover:text-dark-grey transition-colors duration-300 flex-shrink-0">
                            <i class="fas fa-arrow-right -rotate-45 transition-transform duration-300"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQs Section -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans">Patient FAQ</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Frequently Asked Questions</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Common questions regarding Neurocritical Care and Acute Stroke therapies.
            </p>
        </div>

        <div class="max-w-4xl mx-auto space-y-4">
            <!-- FAQ 1 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is the "Golden Hour" in stroke treatment?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        The Golden Hour represents the first 4.5 hours after the onset of stroke symptoms. Administering clot-busting medications (IV tPA) or initiating mechanical thrombectomy within this window drastically increases the chances of reversing paralysis and achieving full recovery.
                    </p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What is mechanical thrombectomy?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        Mechanical thrombectomy is an advanced, catheter-based endovascular surgery. A specialist feeds a micro-catheter from the groin up to the brain to physically grab and remove the clot blocking blood flow, instantly re-oxygenating brain tissues.
                    </p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How is a Neuro-ICU different from a regular ICU?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        A Neuro-ICU is dedicated exclusively to life-threatening brain and spine issues. It features specialized equipment like intracranial pressure (ICP) monitors, continuous bedside video-EEG, and is staffed by neurologists, neurointensivists, and nurses certified in advanced neurological life support.
                    </p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can stroke paralysis be reversed?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        Yes, if emergency treatment (thrombolysis or thrombectomy) is initiated immediately. Even if some deficits remain after the acute phase, structured neurological physical rehabilitation can help retrain the brain to restore mobility and function.
                    </p>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                    <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What are the risk factors for stroke?</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                    </span>
                </button>
                <div class="faq-content hidden px-6 pb-6">
                    <p class="text-xs text-dark-grey/70 leading-relaxed">
                        Common risk factors include chronic high blood pressure, diabetes, high cholesterol, smoking, physical inactivity, obesity, and heart conditions like atrial fibrillation. Managing these under neurological supervision drastically lowers stroke risk.
                    </p>
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
