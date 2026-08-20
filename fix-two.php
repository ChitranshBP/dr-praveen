<?php
$file = 'index.php';
$content = file_get_contents($file);

// Fix 1: Add class attribute back to first img and add loading="lazy"
$content = str_replace(
    '<img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png"',
    '<img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png" class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy"',
    $content
);

// Fix 2: Remove duplicate loading="lazy" from second img
$content = str_replace('loading="lazy" loading="lazy"', 'loading="lazy"', $content);

file_put_contents($file, $content);
echo "Fixed both issues\n";