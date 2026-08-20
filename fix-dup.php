<?php
$file = 'index.php';
$content = file_get_contents($file);

// Remove duplicate loading="lazy" from second banner img
$content = str_replace('loading="lazy" loading="lazy"', 'loading="lazy"', $content);
file_put_contents($file, $content);
echo "Fixed duplicate loading\n";
?>