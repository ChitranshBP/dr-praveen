<?php
/**
 * Patient Success Stories Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Success Stories</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-notes-medical text-cyan-accent text-[10px]"></i>
                <span>Patient Letters & Recovery Journals</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Patient <span class="text-cyan-accent">Success Stories</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Read recovery stories, letters of appreciation, and medical updates shared directly by our patients and their families.
            </p>
        </div>
    </div>
</section>

<!-- Success Stories List -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <!-- Story 1 -->
        <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-deep-indigo font-serif">Regaining My Independence After DBS</h3>
                <span class="text-xs font-semibold text-cyan-accent bg-cyan-50 px-3 py-1 rounded-full border border-cyan-100">Parkinson's Disease</span>
            </div>
            <p class="text-xs text-dark-grey/70 leading-relaxed italic">
                "My hand tremors had gotten so severe that I could no longer hold a pen, sign checks, or even drink tea without spilling. It was frustrating and humiliating. Dr. Praveen Gupta recommended DBS. The surgery went smoothly, and once the stimulator was programmed, my tremors stopped almost completely. Today, I can write again and enjoy independent living."
            </p>
            <p class="text-[11px] font-bold text-deep-indigo text-right">— Ramesh Chandra, Gurgaon</p>
        </div>

        <!-- Story 2 -->
        <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-deep-indigo font-serif">Back on My Feet After a Stroke</h3>
                <span class="text-xs font-semibold text-red-650 bg-red-50 px-3 py-1 rounded-full border border-red-100">Acute Stroke Care</span>
            </div>
            <p class="text-xs text-dark-grey/70 leading-relaxed italic">
                "When my husband suddenly couldn't raise his left arm and his speech was slurred, we panicked. We called the emergency stroke helpline and reached Marengo Asia Hospital. The stroke team was ready, and Dr. Praveen Gupta guided his mechanical thrombectomy. Within 2 days, he was walking and speaking normally. We are forever grateful for the rapid, professional response."
            </p>
            <p class="text-[11px] font-bold text-deep-indigo text-right">— Priya Verma, Delhi</p>
        </div>

        <!-- Story 3 -->
        <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-deep-indigo font-serif">Seizure-Free After Years of Struggle</h3>
                <span class="text-xs font-semibold text-cyan-accent bg-cyan-50 px-3 py-1 rounded-full border border-cyan-100">Epilepsy Care</span>
            </div>
            <p class="text-xs text-dark-grey/70 leading-relaxed italic">
                "Our teenage daughter suffered from recurrent seizures that multiple medications failed to control. Dr. Gupta set up prolonged video-EEG monitoring to identify the focus. By adjusting her dosage and introducing advanced anti-seizure medication, her seizures have stopped entirely for over two years. She is back in school and thriving."
            </p>
            <p class="text-[11px] font-bold text-deep-indigo text-right">— Mrs. Kapoor (Parent), Noida</p>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-3xl font-bold text-deep-indigo font-serif">Share Your Recovery Story</h2>
        <p class="text-sm text-dark-grey/65 max-w-xl mx-auto leading-relaxed">
            Your recovery path can inspire others undergoing difficult diagnoses. Let us know how your health has improved.
        </p>
        <div class="pt-2">
            <a href="contact-us-top-neurologist-delhi-ncr.php" class="inline-flex items-center space-x-3 bg-deep-indigo hover:bg-electric-blue text-white text-sm font-bold px-8 py-3.5 rounded-2xl transition-colors">
                <span>Book a Consultation</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
