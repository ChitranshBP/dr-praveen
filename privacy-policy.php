<?php
/**
 * Privacy Policy Page - Dr. Praveen Gupta
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
                <span class="text-white font-medium">Privacy Policy</span>
            </nav>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Privacy <span class="text-cyan-accent">Policy</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed max-w-2xl">
                Learn how we collect, protect, and use your personal information and clinical records on this website.
            </p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-slate max-w-none space-y-8 text-dark-grey/80 leading-relaxed text-sm">
            
            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">1. Introduction</h2>
                <p>
                    Welcome to the official portal of <?php echo SITE_NAME; ?>. Your privacy and the confidentiality of your personal and medical information are of paramount importance to us. This Privacy Policy details how we handle the information collected from visitors and patients who use this website.
                </p>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">2. Information We Collect</h2>
                <p>
                    We collect information from you when you submit a consultation request, book an appointment, request a second opinion, or upload medical records. The types of personal data we may collect include:
                </p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Contact details such as name, email address, and phone number.</li>
                    <li>Clinical history, diagnosis logs, and uploaded medical reports/scans.</li>
                    <li>Technical data such as IP address and browsing behavior collected via standard cookies.</li>
                </ul>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">3. How We Use Your Information</h2>
                <p>
                    The collected information is used solely to facilitate healthcare services, including:
                </p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Scheduling and managing clinic appointments or online video consultations.</li>
                    <li>Reviewing medical records to provide accurate diagnostic second opinions.</li>
                    <li>Routing inquiry submissions to our secure clinic management systems.</li>
                </ul>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">4. Data Security & Storage</h2>
                <p>
                    We implement standard physical, electronic, and administrative safeguards to protect your personal and medical data against unauthorized access, loss, or modification. Medical uploads are transferred securely and stored within secure systems. However, please be aware that no data transmission over the Internet is completely risk-free.
                </p>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">5. Sharing of Data</h2>
                <p>
                    We do not sell, trade, or transfer patient data to external marketing companies. Your information is only shared with authorized medical staff, clinical coordinators, and hospital team members involved in administering your treatment plan.
                </p>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">6. Patient Rights</h2>
                <p>
                    You have the right to request access to the personal data we hold about you, request corrections to incomplete information, or request the deletion of non-medical records (subject to local legal requirements regarding medical records retention).
                </p>
            </div>

            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-deep-indigo font-serif">7. Contact Details</h2>
                <p>
                    For questions regarding this policy or to request data removal, please contact us at <a href="mailto:<?php echo SITE_EMAIL; ?>" class="text-electric-blue hover:underline"><?php echo SITE_EMAIL; ?></a> or call the OPD helpline.
                </p>
            </div>

        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
