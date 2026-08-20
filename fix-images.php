<?php
/**
 * Fix image paths in index.php to use WebP with PNG fallback
 */

$file = 'index.php';
$content = file_get_contents($file);

// Replace mobile banner 1 reference
$content = str_replace(
    'srcset="assets/mobile-banner/1.png"',
    'srcset="assets/webp/mobile-banner/1.webp" type="image/webp"',
    $content
);

// Replace mobile banner 2 reference  
$content = str_replace(
    'srcset="assets/mobile-banner/2.png"',
    'srcset="assets/webp/mobile-banner/2.webp" type="image/webp"',
    $content
);

// Replace DrPraveen_WebBanner_New(1440X500).png reference (first one)
$content = str_replace(
    'src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png"',
    'src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png" type="image/png"',
    $content
);

// Add WebP source before first img in hero section (need to find the picture block and insert source)
// Let me just add the source tags by finding the pattern and inserting before img

// Replace the second picture block's source and img
$content = str_replace(
    '<source media="(max-width: 767px)" srcset="assets/mobile-banner/2.png">',
    '<source media="(max-width: 767px)" srcset="assets/webp/mobile-banner/2.webp" type="image/webp">
                    <source srcset="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500)%20(1).png" type="image/png">',
    $content
);

// Add loading="lazy" to images that don't have it
$content = str_replace(
    'class="w-full h-auto object-cover object-[32%_center] md:object-center block"',
    'class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy"',
    $content
);

// Count occurrences and report
$count = substr_count($content, 'webp');
echo "Updated $count WebP references in index.php\n";

file_put_contents($file, $content);
echo "Done!index.php updated.\n";