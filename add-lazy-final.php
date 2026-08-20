<?php
$file = 'index.php';
$content = file_get_contents($file);

// Find the first occurrence of the class and add loading="lazy"
$search = 'class="w-full h-auto object-cover object-[32%_center] md:object-center block"';
$replace = 'class="w-full h-auto object-cover object-[32%_center] md:object-center block" loading="lazy"';

 // Only replace the first occurrence (the one in the hero banner)
 if (strpos($content, $search) !== false) {
     // Replace only the first occurrence
     $first_pos = strpos($content, $search);
     $before = substr($content, 0, $first_pos);
     $after = substr($content, $first_pos + strlen($search));
     // In the after part, find the next occurrence and put it back
     $second_pos = strpos($after, $search);
     if ($second_pos !== false) {
         // There's a second occurrence - only modify the first
         $after = substr($after, 0, $second_pos) . str_replace($search, $replace, substr($after, $second_pos, strlen($search))) . substr($after, $second_pos + strlen($search));
     }
     $content = $before . str_replace($search, $replace, $after);
     file_put_contents($file, $content);
     echo "Added loading='lazy' to first banner img\n";
 } else {
     echo "Pattern not found\n";
 }