<?php
/**
 * Neurology Second Opinion Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <!-- Background image -->
    <img src="assets/breadcrumbs/patient.png" alt=""
         fetchpriority="high"
         class="absolute inset-0 w-full h-full object-cover object-[78%_center] md:object-right pointer-events-none select-none">

    <!-- Legibility overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/75 to-deep-indigo/35 md:to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Second Opinion</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-search-plus text-cyan-accent text-[10px]"></i>
                <span>Independent Diagnosis Review</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Neurology <span class="text-cyan-accent">Second Opinion</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Gain clarity and confidence. Get a comprehensive review of your neurological diagnosis, imaging studies, and treatment plans from Dr. Praveen Gupta.
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="contact-us-top-neurologist-delhi-ncr" class="group inline-flex items-center space-x-3 bg-white text-deep-indigo text-sm font-bold pl-6 pr-2 py-2.5 rounded-full hover:bg-soft-cyan transition-colors duration-300">
                    <span>Request Second Opinion</span>
                    <span class="w-7 h-7 rounded-full bg-deep-indigo text-white flex items-center justify-center transition-transform group-hover:rotate-45 duration-300">
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Value of Second Opinion Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left: Info -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Why Seek a Review?</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Ensure Diagnostic Accuracy & Explore Alternatives</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Neurological conditions are complex and require high diagnostic precision. Seeking a second opinion is a common and vital step in ensuring you receive the correct treatment pathway:
                </p>

                <div class="space-y-4">
                    <div class="flex items-start space-x-3.5">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-xs"></i></div>
                        <p class="text-xs text-dark-grey/70 leading-relaxed">
                            <strong class="text-deep-indigo">Confirm Complex Diagnoses:</strong> Double-check diagnoses for conditions like multiple sclerosis, motor neuron diseases, or rare tremors.
                        </p>
                    </div>
                    <div class="flex items-start space-x-3.5">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-xs"></i></div>
                        <p class="text-xs text-dark-grey/70 leading-relaxed">
                            <strong class="text-deep-indigo">Evaluate Surgical Options:</strong> Discuss alternative medical management routes before committing to procedures like Deep Brain Stimulation (DBS) or epilepsy surgery.
                        </p>
                    </div>
                    <div class="flex items-start space-x-3.5">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-xs"></i></div>
                        <p class="text-xs text-dark-grey/70 leading-relaxed">
                            <strong class="text-deep-indigo">Optimise Recovery Pathways:</strong> Review stroke rehabilitation timelines, speech therapy modules, and cognitive training plans.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right: Documents Required Checklist -->
            <div class="lg:col-span-5 bg-gradient-to-br from-soft-cyan to-white p-8 rounded-3xl border border-cyan-accent/20 space-y-6">
                <h3 class="text-xl font-bold text-deep-indigo font-serif">What We Need</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed font-sans">
                    To conduct a detailed medical and diagnostic review, please prepare the following records:
                </p>

                <ul class="space-y-4 text-xs text-dark-grey/70">
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-compact-disc text-[10px]"></i></span>
                        <div><strong class="text-deep-indigo">Imaging Materials:</strong> Complete MRI, CT, PET scans, including both the printed reports and the original image files (on CD or digital upload).</div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-file-invoice-dollar text-[10px]"></i></span>
                        <div><strong class="text-deep-indigo">Test Results:</strong> EEG logs, EMG studies, nerve conduction recordings, and blood panel results.</div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 bg-cyan-accent/20 text-cyan-700 font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fas fa-scroll text-[10px]"></i></span>
                        <div><strong class="text-deep-indigo">Medical History:</strong> Current prescription charts, past treatment logs, and notes from your prior consulting physicians.</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Review Process Steps -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Our Methodology</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">The Opinion Review Process</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                How Dr. Praveen Gupta evaluates second opinion submissions.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-3xl border border-silver-grey/30 space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-electric-blue/10 rounded-2xl flex items-center justify-center text-electric-blue">
                    <i class="fas fa-glasses"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Record Review</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    A clinical review of all submitted reports, imaging films, medication charts, and symptoms logs to build a baseline profile.
                </p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-silver-grey/30 space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-cyan-accent/10 rounded-2xl flex items-center justify-center text-cyan-accent">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Clinical Re-Assessment</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    An in-person or video evaluation session to verify reflexes, motor pathways, cognitive status, and explore secondary symptoms.
                </p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-silver-grey/30 space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-deep-indigo/10 rounded-2xl flex items-center justify-center text-deep-indigo">
                    <i class="fas fa-file-medical-alt"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo">Detailed Report</h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    Delivery of a formal second opinion report, outlining diagnostic confirmation, recommended next steps, and potential care modifications.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Second Opinion Form Section -->
<section class="py-16 bg-white border-t border-b border-silver-grey/40">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-deep-indigo to-indigo-950 text-white rounded-[32px] p-8 md:p-12 shadow-xl relative overflow-hidden">
            <!-- Glow Accent -->
            <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/15 rounded-full blur-[100px] pointer-events-none"></div>

            <div class="relative z-10 space-y-6">
                <div class="text-center max-w-2xl mx-auto">
                    <span class="text-cyan-accent font-bold text-xs uppercase tracking-widest">Submit Case Details</span>
                    <h2 class="text-2xl md:text-3xl font-bold font-serif mt-2">Request Your Second Opinion</h2>
                    <p class="text-white/80 text-xs mt-2 leading-relaxed">
                        Fill in the quick details below. Our medical team will guide you on uploading records.
                    </p>
                </div>

                <form class="space-y-4 pt-4 max-w-2xl mx-auto" accept-charset="UTF-8" action="https://app.formester.com/forms/MUVNkRKYA/submissions" method="POST">
                    <input type="hidden" name="form_type" value="Second Opinion Request">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="so-name" class="block text-xs font-semibold text-white/95 mb-2">FULL NAME</label>
                            <input type="text" id="so-name" name="name" required placeholder="John Doe" class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-cyan-accent text-xs text-white placeholder-white/50">
                        </div>
                        <div>
                            <label for="so-phone" class="block text-xs font-semibold text-white/95 mb-2">PHONE NUMBER</label>
                            <input type="tel" id="so-phone" name="phone" required placeholder="Phone Number" class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-cyan-accent text-xs text-white placeholder-white/50">
                        </div>
                    </div>
                    <div>
                        <label for="so-diagnosis" class="block text-xs font-semibold text-white/95 mb-2">CURRENT DIAGNOSIS / ISSUES</label>
                        <textarea id="so-diagnosis" name="diagnosis" rows="3" required placeholder="Briefly describe your current neurological condition..." class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-cyan-accent text-xs text-white placeholder-white/50"></textarea>
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="block w-full text-center bg-cyan-accent hover:bg-cyan-500 text-deep-indigo font-bold py-3 rounded-xl transition-all duration-300 transform active:scale-95 text-xs shadow-lg shadow-cyan-accent/20">
                            Submit Case Review Request
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
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark-grey mt-3 mb-6">Frequently Asked Questions</h2>
                <p class="text-dark-grey/70 leading-relaxed max-w-md">
                    Answers to common queries regarding second opinions, records sharing, and consultation formats.
                </p>
            </div>

            <!-- Right Column: Accordions -->
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Why should I seek a second opinion for a neurological condition?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Neurological conditions are complex and often have multiple treatment pathways (such as choosing between surgery or medical management for tumors or spinal issues). A second opinion helps verify the diagnosis, explores alternative therapies, and provides peace of mind before starting major treatments.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What records should I provide for a second opinion?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Please share all relevant medical documentation, including clinical notes, history profiles, recent laboratory tests, and complete high-resolution radiology scans (MRI/CT scans on a CD or digital folder).
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can I get a second opinion online?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Yes. You can upload your medical reports securely through our online consultation portal and schedule a video consultation to discuss your case and receive a comprehensive second opinion report.
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

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
