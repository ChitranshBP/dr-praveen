<?php
$file = 'index.php';
$content = file_get_contents($file);

// Fix 1: Restore the first img tag with proper attributes
// The current state has: <img src="..." > with no class/alt
// We need: <img src="..." class="..." alt="..." fetchpriority="high" loading="lazy">

$content = str_replace(
    '<img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png"',
    '<img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png" class="w-full h-auto object-cover object-[32%_center] md:object-center block" alt="Transforming Brain & Spine Care with Precision – Led by Dr. Praveen Gupta, Chairman, Marengo Asia International Institute of Neuro & Spine" fetchpriority="high" loading="lazy"',
    $content
);

// Fix 2: Remove duplicate loading="lazy" from second img
$content = str_replace('loading="lazy" loading="lazy"', 'loading="lazy"', $content);

file_put_contents($file, $content);
echo "Fixed both issues\n";
?>