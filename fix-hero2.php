<?php
$file = 'index.php';
$content = file_get_contents($file);

// Completely replace the hero banner section with correct HTML
$old_hero = '<div id="hero-slider" class="w-full max-w-[1920px] mx-auto relative">
        <div id="hero-track" class="flex transition-transform duration-700 ease-in-out">
            <div class="min-w-full relative">
                <picture>
                    
                    <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png" class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy"
                         alt="Transforming Brain & Spine Care with Precision – Led by Dr. Praveen Gupta, Chairman, Marengo Asia International Institute of Neuro & Spine"
                         fetchpriority="high"
                         >
                 </picture>
             </div>
             <div class="min-w-full relative">
                <picture>
                    
                    <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500)%20(1).png"
                         alt="Your Brain Deserves Expert Care – Empowering every thought for a life beyond neurological limits"
                         loading="lazy"
                         class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy">
                </picture>
             </div>
        </div>';

$new_hero = '<div id="hero-slider" class="w-full max-w-[1920px] mx-auto relative">
        <div id="hero-track" class="flex transition-transform duration-700 ease-in-out">
            <div class="min-w-full relative">
                <picture>
                    <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png"
                         alt="Transforming Brain & Spine Care with Precision – Led by Dr. Praveen Gupta, Chairman, Marengo Asia International Institute of Neuro & Spine"
                         fetchpriority="high"
                         class="w-full h-auto object-cover object-[32%_center] md:object-center block"
                         loading="lazy">
                 </picture>
             </div>
             <div class="min-w-full relative">
                <picture>
                    <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500)%20(1).png"
                         alt="Your Brain Deserves Expert Care – Empowering every thought for a life beyond neurological limits"
                         loading="lazy"
                         class="w-full h-auto object-cover object-[32%_center] md:object-center block">
                </picture>
             </div>
        </div>';

if (strpos($content, $old_hero) !== false) {
    $content = str_replace($old_hero, $new_hero, $content);
    echo "Replaced hero section successfully\n";
} else {
    echo "Old hero section pattern not found, applying partial fixes\n";
    // Apply individual fixes
    // Fix first img - ensure proper structure
    $content = preg_replace('/<img src="assets\\/banner\\/banner-new\\/DrPraveen_WebBanner_New\\(1440X500\\)\\.png" class="([^"]+)" loading="lazy"$/}', '<img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png" class="$1" loading="lazy">', $content);
    // Fix second img duplicate loading
    $content = str_replace('loading="lazy" loading="lazy"', 'loading="lazy"', $content);
}

file_put_contents($file, $content);
echo "Applied fixes\n";