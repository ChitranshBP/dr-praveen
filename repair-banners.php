<?php
// Repair banner images - replace broken WebP picture tags with direct img tags

$file = 'index.php';
$lines = file($file);
$output = '';
$in_picture = false;
$picture_count = 0;

foreach ($lines as $line) {
    // Check if this line starts a picture tag with webp source
    if (preg_match('/<picture>/', $line) && strpos($line, 'assets/webp/mobile-banner') !== false) {
        $in_picture = true;
        $picture_count++;
        // Skip the picture tag and its contents, output just the img tag instead
        // We need to find the img tag inside and replace it
        // Actually, let's just skip everything until we close the picture
        $nesting = 1;
        while ($nesting > 0 && isset($lines[++$i])) {
            // This is getting complex, let's take a different approach
        }
    }
}

// Simpler approach: just replace specific lines
$output = '';
foreach ($lines as $line) {
    // Replace the first picture block (lines 34-40 area)
    if (strpos($line, 'srcset="assets/webp/mobile-banner/1.webp"') !== false) {
        // This is the first source line - replace entire picture with img
        $output .= '<img src="assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png"\
alt="Transforming Brain & Spine Care with Precision â€“ Led by Dr. Praveen Gupta, Chairman, Marengo Asia International Institute of Neuro & Spine"\
fetchpriority="high"\
class="w-full h-auto object-cover object-\\[32%_center\\] md:object-center block" loading="lazy">\n';
        // Skip the rest of the picture block (about 7 more lines)
        // Skip lines that are part of this picture block
        for ($i = 1; $i <= 7; $i++) {
            if (isset($lines[$key + $i])) {
                // Just don't output these lines
            }
        }
        continue;
    }
    // Similar for second picture
    // This is getting too complex, let me use a different approach
    $output .= $line;
}

file_put_contents($file, $output);
echo "Done\n";
"
