<?php
/**
 * Fix homepage banner images - use direct PNG with lazy loading
 * Removes broken WebP <picture> tags and uses direct img tags
 */

$file = 'index.php';
$content = file_get_contents($file);

// Replace the first picture block with direct img tag
$content = str_replace(
    '<picture>
                    <source media="(max-width: 767px)" srcset="assets/webp/mobile-banner/1.webp" type="image/webp">
                    <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png" type="image/png"
                         alt="Transforming Brain & Spine Care with Precision – Led by Dr. Praveen Gupta, Chairman, Marengo Asia International Institute of Neuro & Spine"
                         fetchpriority="high"
                         class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy" loading="lazy">
                </picture>',
    '<img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png"
         alt="Transforming Brain & Spine Care with Precision – Led by Dr. Praveen Gupta, Chairman, Marengo Asia International Institute of Neuro & Spine"
         fetchpriority="high"
         class="w-full h-auto object-cover object-[32%_center] md:object-center block"
         loading="lazy">',
    $content
);

// Replace the second picture block with direct img tag
$content = str_replace(
    '<picture>
                    <source media="(max-width: 767px)" srcset="assets/webp/mobile-banner/2.webp" type="image/webp">
                    <img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500)%20(1).png"
                         alt="Your Brain Deserves Expert Care – Empowering every thought for a life beyond neurological limits"
                         loading="lazy"
                         class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy"> loading="lazy"',
    '<img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500)%20(1).png"
         alt="Your Brain Deserves Expert Care – Empowering every thought for a life beyond neurological limits"
         loading="lazy"
         class="w-full h-auto object-cover object-[32%_center] md:object-center block">',
    $content
);

// Remove duplicate loading="lazy" instances
$content = str_replace('loading="lazy" loading="lazy"', 'loading="lazy"', $content);

// Save
file_put_contents($file, $content);
echo "Fixed banner images in index.php\n";

// Count lazy loading
$lazyCount = substr_count($content, 'loading="lazy"');
echo "Images with loading='lazy': $lazyCount\n";