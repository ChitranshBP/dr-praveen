<?php
/**
 * Neurology FAQs Hub - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('neurology-faqs', [
    'hero_badge' => 'Neurology Help & FAQ Hub',
    'hero_title' => 'Neurology <span class="text-cyan-accent">FAQs</span>',
    'hero_desc'  => 'Find clear answers to common questions regarding appointments, neurological symptoms, diagnostic tests (EEG/EMG), and specialized therapies.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
]);
?>

<!-- Hero Section -->
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
                <span class="text-white font-medium">FAQs Hub</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-question text-cyan-accent text-[10px]"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>
        </div>
    </div>
</section>

<!-- Accordion FAQs Section (managed in CMS → FAQs) -->
<?php $faqSlug = 'neurology-faqs'; require __DIR__ . '/includes/faq-section.php'; ?>

<!-- Call to Action -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-3xl font-bold text-deep-indigo font-serif">Still Have Questions?</h2>
        <p class="text-sm text-dark-grey/65 max-w-xl mx-auto leading-relaxed">
            Our medical coordination help desk is available to answer any clinical or procedural queries.
        </p>
        <div class="pt-2">
            <a href="contact-us-top-neurologist-delhi-ncr" class="inline-flex items-center space-x-3 bg-deep-indigo hover:bg-electric-blue text-white text-sm font-bold px-8 py-3.5 rounded-2xl transition-colors">
                <span>Contact Us</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
