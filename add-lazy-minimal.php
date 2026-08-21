<?php
$file = 'index.php';
$content = file_get_contents($file);

// Replace the specific line that has the class attribute without loading
// Looking for: class="w-full h-auto object-cover object-[32%_center] md:object-center block"
// And adding loading="lazy" before the closing quote

$search = 'class="w-full h-auto object-cover object-[32%_center] md:object-center block"';
$replace = 'class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy"';

// Only replace if not already present
if (strpos($content, $search) !== false && strpos($content, $search . ' loading="lazy"') === false) {
    $content = str_replace($search, $replace, $content);
    file_put_contents($file, $content);
    echo "Added loading='lazy' to first banner img\n";
} else {
    echo "Pattern already present or not found\n";
}
"
