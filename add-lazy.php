<?php
/**
 * Add loading="lazy" to all img tags in index.php that don't have it
 */

$file = 'index.php';
$content = file_get_contents($file);

// Add loading="lazy" to img tags that have specific patterns
// Pattern 1: class="w-full h-full object-cover (from services, blog, awards)
$content = preg_replace_callback(
    '/<img [^>]*class="[^"]*w-full h-full object-cover[^"]*"[^>]*>/',
    function($matches) {
        if (strpos($matches[0], 'loading="lazy"') === false) {
            $matches[0] = str_replace('>', ' loading="lazy">', $matches[0]);
        }
        return $matches[0];
    },
    $content
);

// Pattern 2: img tags with src that are from assets folder and don't have loading
$content = preg_replace(
    '/(<img [^>]*)(src="assets\/[^"]*"[^>]*>)/',
    '$1$2 loading="lazy"',
    $content
);

// Pattern 3: img tags with type="image/png" that need loading
$content = preg_replace(
    '/(<img [^>]*type="image\/png"[^>]*)>/',
    '$1 loading="lazy"',
    $content
);

// Remove any double loading attributes
$content = str_replace('loading="lazy" loading="lazy"', 'loading="lazy"', $content);

file_put_contents($file, $content);
echo "Added loading='lazy' to images in index.php\n";

// Count final lazy loading
$lazyCount = substr_count($content, 'loading="lazy"');
echo "Total images with loading='lazy': $lazyCount\n";

// Count WebP references
$webpCount = substr_count($content, 'webp');
echo "Total WebP references: $webpCount\n";
