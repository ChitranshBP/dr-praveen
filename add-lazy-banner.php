<?php
// Add loading="lazy" to first banner img tag

$file = 'index.php';
$content = file_get_contents($file);

// Add loading="lazy" to the first img in the hero banner section
// The img is on line 38-39 area, class attribute needs loading added
$search = 'class="w-full h-auto object-cover object-[32%_center] md:object-center block"';
$replace = 'class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy"';

if (strpos($content, $search) !== false) {
    $content = str_replace($search, $replace, $content);
    echo "Added loading='lazy' to first banner img\n";
} else {
    echo "Pattern not found in first banner\n";
}

// Also check and add to second banner if not present
$search2 = 'class="w-full h-auto object-cover object-[32%_center] md:object-center block"';
if (strpos($content, $search2 . ' loading="lazy"' ) === false && strpos($content, $search2) !== false) {
    // Add loading after the class attribute
    $content = preg_replace('/class="([^"]+)"([^>]*>)/', 'class="$1" loading="lazy"$2', $content, 1);
    echo "Added loading to second banner img\n";
}

file_put_contents($file, $content);
echo "Done\n";

// Verify
$lines = file($file);
echo "Line 38-39 content:\n";
for ($i = 37; $i < 42; $i++) {
    echo "$i: " . $lines[$i];
}
"
