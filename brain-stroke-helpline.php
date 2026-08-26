<?php
/**
 * Brain Stroke Helpline Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('brain-stroke-helpline', [
    'hero_badge' => '24/7 Urgent Stroke Care',
    'hero_title' => '24/7 Brain Stroke <span class="text-red-400">Helpline</span>',
    'hero_desc'  => 'A stroke is a medical emergency. Every minute counts. Under the leadership of Dr. Praveen Gupta, Marengo Asia Hospital offers round-the-clock emergency thrombolysis and mechanical thrombectomy.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
]);
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <!-- Background image -->
    <img src="<?php echo htmlspecialchars($pageContent['hero_bg']); ?>" alt=""
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
                <span class="text-white font-medium">Stroke Helpline</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-exclamation-triangle text-red-400 text-[10px] animate-pulse"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                <?php echo nl2br(htmlspecialchars($pageContent['hero_desc'])); ?>
            </p>

            <!-- Emergency Direct Action Button -->
            <div class="flex flex-wrap items-center gap-4">
                <a href="tel:<?php echo STROKE_HELPLINE; ?>" class="inline-flex items-center space-x-3 bg-red-600 hover:bg-red-700 text-white font-extrabold text-lg px-8 py-4 rounded-2xl shadow-lg shadow-red-600/20 hover:shadow-red-600/40 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fas fa-phone-alt animate-bounce"></i>
                    <span>Call Emergency: <?php echo STROKE_HELPLINE; ?></span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- F.A.S.T. Signs Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-red-600 font-bold text-xs uppercase tracking-wider">Spot a Stroke</span>
            <h2 class="text-3xl font-bold text-dark-grey mt-2">Act F.A.S.T. - Learn the Signs</h2>
            <p class="text-sm text-dark-grey/65 leading-relaxed mt-3">
                If you observe any of these symptoms in yourself or someone else, call the emergency stroke helpline immediately.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- F -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-lg transition-all duration-300">
                <span class="text-4xl font-black text-red-600">F</span>
                <div>
                    <h3 class="font-bold text-dark-grey text-base">Face Drooping</h3>
                    <p class="text-xs text-dark-grey/65 leading-relaxed mt-1">
                        Does one side of the face droop or is it numb? Ask the person to smile. Is the smile uneven?
                    </p>
                </div>
            </div>

            <!-- A -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-lg transition-all duration-300">
                <span class="text-4xl font-black text-red-600">A</span>
                <div>
                    <h3 class="font-bold text-dark-grey text-base">Arm Weakness</h3>
                    <p class="text-xs text-dark-grey/65 leading-relaxed mt-1">
                        Is one arm weak or numb? Ask the person to raise both arms. Does one arm drift downward?
                    </p>
                </div>
            </div>

            <!-- S -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-lg transition-all duration-300">
                <span class="text-4xl font-black text-red-600">S</span>
                <div>
                    <h3 class="font-bold text-dark-grey text-base">Speech Difficulty</h3>
                    <p class="text-xs text-dark-grey/65 leading-relaxed mt-1">
                        Is speech slurred? Is the person unable to speak or hard to understand? Ask them to repeat a simple sentence.
                    </p>
                </div>
            </div>

            <!-- T -->
            <div class="bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-lg transition-all duration-300">
                <span class="text-4xl font-black text-red-600">T</span>
                <div>
                    <h3 class="font-bold text-dark-grey text-base">Time to Call Help</h3>
                    <p class="text-xs text-dark-grey/65 leading-relaxed mt-1">
                        If the person shows any of these signs, even if the symptoms go away, check the time and call us immediately.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stroke Protocols -->
<section class="py-12 bg-[#edf5f9] border-y border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left Card: Urgent Care Timelines -->
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <span class="text-red-600 font-bold text-xs uppercase tracking-wider">Clinical Protocol</span>
                    <h2 class="text-3xl font-bold text-dark-grey mt-2 mb-4">Golden Hour Window</h2>
                    <p class="text-sm text-dark-grey/65 leading-relaxed">
                        When a stroke strikes, millions of brain cells die every minute. Reversing this damage is highly dependent on how quickly blood flow is restored.
                    </p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3.5">
                        <div class="w-6 h-6 bg-red-600/10 rounded-full flex items-center justify-center text-red-600 flex-shrink-0 mt-0.5">
                            <i class="fas fa-clock text-xs"></i>
                        </div>
                        <p class="text-xs text-dark-grey/70 leading-relaxed">
                            <strong class="text-dark-grey font-bold">Within 4.5 Hours:</strong> Clot-dissolving IV thrombolysis injection can be administered to open blocked arteries.
                        </p>
                    </div>
                    <div class="flex items-start space-x-3.5">
                        <div class="w-6 h-6 bg-red-600/10 rounded-full flex items-center justify-center text-red-600 flex-shrink-0 mt-0.5">
                            <i class="fas fa-brain text-xs"></i>
                        </div>
                        <p class="text-xs text-dark-grey/70 leading-relaxed">
                            <strong class="text-dark-grey font-bold">Within 24 Hours:</strong> Advanced mechanical thrombectomy (catheter-guided clot removal) can save patients with large blood vessel blockages.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Card: Interactive Steps (7 columns) -->
            <div class="lg:col-span-7 bg-white p-8 rounded-3xl border border-slate-200/50 space-y-6">
                <h3 class="text-xl font-bold text-dark-grey">What to Do While Waiting for the Ambulance</h3>
                <div class="space-y-4 text-sm text-dark-grey/70">
                    <div class="p-4 bg-slate-50 rounded-2xl flex items-start space-x-3">
                        <span class="bg-red-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">1</span>
                        <p class="text-xs">Keep the patient calm and lay them down on their side (recovery position) if they are unconscious or vomiting.</p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl flex items-start space-x-3">
                        <span class="bg-red-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">2</span>
                        <p class="text-xs"><strong class="text-red-600 font-bold">DO NOT</strong> give any food, water, or aspirin. Swallowing reflexes are often impaired during a stroke, posing a severe choking hazard.</p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl flex items-start space-x-3">
                        <span class="bg-red-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">3</span>
                        <p class="text-xs">Note down the exact time when you first observed symptoms. This is crucial for selecting the right treatment protocol.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Testimonials (component: includes/video-testimonials.php) -->
<?php require __DIR__ . "/includes/video-testimonials.php"; ?>

<!-- Related Videos (topic-matched, see $pageVideos in includes/config.php) -->
<?php require __DIR__ . "/includes/related-videos.php"; ?>

<!-- FAQ Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Column: Header Information -->
            <div class="lg:col-span-5 lg:sticky lg:top-24 self-start">
                <span class="text-red-650 text-red-600 font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark-grey mt-3 mb-6">Frequently Asked Questions</h2>
                <p class="text-dark-grey/70 leading-relaxed max-w-md">
                    Answers to crucial questions regarding stroke timelines, emergency responses, and hotline actions.
                </p>
            </div>

            <!-- Right Column: Accordions -->
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Is the stroke helpline active 24/7?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Yes, the dedicated helpline **1800-309-0247** is fully operational 24 hours a day, 7 days a week, connecting you directly to our stroke response team.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Why is the first hour after a stroke called the 'Golden Hour'?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                The "Golden Hour" is the critical period immediately following a stroke. Administering clot-busting medication (thrombolysis) or performing clot removal (thrombectomy) within this window can drastically reduce brain damage and prevent permanent disability.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">Can I call the helpline for general neurological issues?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                The stroke helpline is reserved exclusively for acute emergency situations like suspected brain strokes, sudden paralysis, or loss of speech. For general appointments or routine queries, please use our standard contact number: <?php echo SITE_PHONE; ?>.
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
