<?php
$file = 'index.php';
$content = file_get_contents($file);

// Remove duplicate loading="lazy" from second banner img (line 48)
$content = str_replace('class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy"', 'class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy"', $content);
file_put_contents($file, $content);
echo "Cleaned up duplicate loading\n";
?>
