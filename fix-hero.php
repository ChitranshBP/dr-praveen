<?php
// This script fixes the hero banner images by removing broken WebP source tags
// and ensuring lazy loading is properly applied

$file = 'index.php';
$content = file_get_contents($file);

// Replace the entire hero banner section's picture/img structure
// We'll replace lines 33-50 (the two picture blocks) with simpler img tags

$old = '<div class="min-w-full relative">
                <picture>
                    <source media="(max-width: 767px)" srcset="assets/mobile-banner/1.png">
                    <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png"
                         alt="Transforming Brain & Spine Care with Precision â€“ Led by Dr. Praveen Gupta, Chairman, Marengo Asia International Institute of Neuro & Spine"
                         fetchpriority="high"
                         class="w-full h-auto object-cover object-[32%_center] md:object-center block">
                 </picture>
             </div>
             <div class="min-w-full relative">
                <picture>
                    <source media="(max-width: 767px)" srcset="assets/mobile-banner/2.png">
                    <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500)%20(1).png"
                         alt="Your Brain Deserves Expert Care â€“ Empowering every thought for a life beyond neurological limits"
                         loading="lazy"
                         class="w-full h-auto object-cover object-[32%_center] md:object-center block">';
                         
$new = '<div class="min-w-full relative">
                <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png"
                     alt="Transforming Brain & Spine Care with Precision â€“ Led by Dr. Praveen Gupta, Chairman, Marengo Asia International Institute of Neuro & Spine"
                     fetchpriority="high"
                     class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy">
             </div>
             <div class="min-w-full relative">
                <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500)%20(1).png"
                     alt="Your Brain Deserves Expert Care â€“ Empowering every thought for a life beyond neurological limits"
                     loading="lazy"
                     class="w-full h-auto object-cover object-[32%_center] md:object-center block">';
                     
if (strpos($content, $old) !== false) {
    $content = str_replace($old, $new, $content);
    echo "Replaced hero banner section successfully\n";
} else {
    echo "Old pattern not found - trying alternative match\n";
    // Try partial replacement
    if (strpos($content, 'srcset="assets/mobile-banner/1.png"') !== false) {
        // Remove the source tags only
        $content = str_replace('<source media="(max-width: 767px)" srcset="assets/mobile-banner/1.png">', '', $content);
        $content = str_replace('<source media="(max-width: 767px)" srcset="assets/mobile-banner/2.png">', '', $content);
        echo "Removed source tags\n";
    }
}

file_put_contents($file, $content);
echo "Done fixing hero banners\n";
