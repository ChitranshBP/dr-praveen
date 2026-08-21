<?php
/**
 * Terms of Service Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Terms of Service</span>
            </nav>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Terms of <span class="text-cyan-accent">Service</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed max-w-2xl">
                Review the terms and clinical disclaimers governing the use of this website and online consultation portals.
            </p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-slate max-w-none space-y-8 text-dark-grey/80 leading-relaxed text-sm">
            
            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">1. Acceptance of Terms</h2>
                <p>
                    By accessing and using this website, you agree to comply with and be bound by the following Terms of Service and clinical disclaimers. If you do not agree to these terms, please do not use this portal or submit online inquiries.
                </p>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">2. Medical Disclaimer (Not for Emergencies)</h2>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 text-xs text-red-900 rounded-r-xl">
                    <p class="font-bold uppercase tracking-wider mb-1"><i class="fas fa-exclamation-triangle mr-1"></i> Medical Emergency Warning</p>
                    <p>
                        The contents of this website, including clinical articles, case files, video explanations, and second-opinion responses, are for educational/information purposes only. **This website does not provide emergency medical diagnosis or treatment.** 
                    </p>
                    <p class="mt-2">
                        If you or a family member are experiencing sudden stroke symptoms (loss of balance, face drooping, arm weakness, speech difficulty), please call our 24/7 Stroke Helpline at <a href="tel:<?php echo STROKE_HELPLINE; ?>" class="font-bold underline"><?php echo STROKE_HELPLINE; ?></a> or visit the nearest emergency department immediately.
                    </p>
                </div>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">3. Online Consultations</h2>
                <p>
                    Video consultations booked via this site serve as virtual advisory sessions. A complete diagnosis may require physical examinations, lab evaluations, or imaging checks at our clinic location. Any prescription issued during video sessions is subject to the doctor's clinical judgement and local regulations.
                </p>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">4. Submission of Clinical Records</h2>
                <p>
                    When submitting form messages or uploading file records (PDF, Word, or images), you warrant that you are authorized to share these files and that the information is accurate. Uploads of illegal or malicious files are strictly prohibited and will result in IP blocking.
                </p>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">5. Intellectual Property</h2>
                <p>
                    The layout, design details, medical articles, logos, graphics, and clinical videos on this site are protected by copyright. Unauthorized replication, redistribution, or commercial copying of materials from this portal without written consent is prohibited.
                </p>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">6. Limitation of Liability</h2>
                <p>
                    While we take reasonable care to keep the medical guidelines on this website accurate and updated, <?php echo SITE_NAME; ?> and the administrative team make no guarantees about the completeness or absolute accuracy of information published, and shall not be held liable for any damages arising out of the use of this website.
                </p>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">7. Revisions to Terms</h2>
                <p>
                    We reserve the right to revise these Terms of Service at any time without prior notice. Any modifications will be active immediately upon publishing to this page.
                </p>
            </div>

        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
