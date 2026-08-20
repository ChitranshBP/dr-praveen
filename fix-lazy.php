<?php
$file = 'index.php';
$content = file_get_contents($file);

// Add loading='lazy' to the first banner img's class attribute
// The target is: class="w-full h-auto object-cover object-[32%_center] md:object-center block"
// Change to: class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy"

$search = 'class="w-full h-auto object-cover object-[32%_center] md:object-center block"';
$replace = 'class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy"';

// Replace only the first occurrence (the one in the hero banner)
if (strpos($content, $search) !== false && strpos($content, $search . ' loading="lazy"') === false) {
    // Replace first occurrence only
    $firstPos = strpos($content, $search);
    $before = substr($content, 0, $firstPos);
    $after = substr($content, $firstPos + strlen($search));
    // In the after part, put back the original search string
    $secondPos = strpos($after, $search);
    if ($secondPos !== false) {
        $after = substr($after, 0, $secondPos) . $search . substr($after, $secondPos + strlen($search));
    }
    $content = $before . str_replace($search, $replace, $after);
    file_put_contents($file, $content);
    echo "Added loading='lazy' to first banner img\n";
} else {
    echo "Already present or not found\n";
}
?>