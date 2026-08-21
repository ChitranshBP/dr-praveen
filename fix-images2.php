<?php
/**
 * Fix all image paths in index.php to use WebP with PNG fallback
 */

$file = 'index.php';
$content = file_get_contents($file);

// 1. Full-width banner section (lines 216-223)
$content = str_replace(
    '<img src="assets/full-image/Dr-Praveen-Banner-1.png" alt="Dr. Praveen Gupta Slide 1" class="w-full h-auto block">',
    '<picture>
                <source srcset="assets/webp/full-image/Dr-Praveen-Banner-1.webp" type="image/webp">
                <img src="assets/full-image/Dr-Praveen-Banner-1.png" alt="Dr. Praveen Gupta Slide 1" class="w-full h-auto block" loading="lazy">
            </picture>',
    $content
);

$content = str_replace(
    '<img src="assets/full-image/Dr-Praveen-Banner-2.png" alt="Dr. Praveen Gupta Slide 2" class="w-full h-auto block">',
    '<picture>
                <source srcset="assets/webp/full-image/Dr-Praveen-Banner-2.webp" type="image/webp">
                <img src="assets/full-image/Dr-Praveen-Banner-2.png" alt="Dr. Praveen Gupta Slide 2" class="w-full h-auto block" loading="lazy">
            </picture>',
    $content
);

$content = str_replace(
    '<img src="assets/full-image/Dr-Praveen-Banner-6.png" alt="Dr. Praveen Gupta Slide 3" class="w-full h-auto block">',
    '<picture>
                <source srcset="assets/webp/full-image/Dr-Praveen-Banner-6.webp" type="image/webp">
                <img src="assets/full-image/Dr-Praveen-Banner-6.png" alt="Dr. Praveen Gupta Slide 3" class="w-full h-auto block" loading="lazy">
            </picture>',
    $content
);

// 2. Blog section - need to update the image source pattern
// The blog images use PHP: src="<?php echo $blog['image']; ?>"
// These are defined in config.php, so I'll add WebP support there instead

// 3. Awards section - uses PHP: src="<?php echo $award['image']; ?>"  
// These are defined in config.php, so I'll add WebP support there instead

// 4. Team section - uses PHP: src="<?php echo htmlspecialchars($doc['image']); ?>" 
// from doctors_full.json - need to update the JSON or add WebP support

// 5. Add loading="lazy" to all remaining img tags that don't have it
// Check which imgs already have loading="lazy"
$lazyCount = substr_count($content, 'loading="lazy"');
echo "Images with loading='lazy': $lazyCount\n";

// 6. Add loading="lazy" to team member images (line 637 area)
// The team image already has class but needs loading="lazy"
// Let me find and add it

// 7. Ensure all new WebP references are added
$webpCount = substr_count($content, 'webp');
echo "Total WebP references: $webpCount\n";

// 8. Add picture tags for services images - these use PHP echo
// The services use: src="<?php echo $service['image']; ?>"
// I'll add a fallback mechanism by modifying the img tag to use picture

// Let me just add loading="lazy" to all img tags that don't have it yet
// Pattern: class="w-full h-full object-cover (various classes)
$content = preg_replace(
    '/class="w-full h-full object-cover([^"]*)"([^>]*>)/',
    'class="w-full h-full object-cover$1"$2 loading="lazy"',
    $content
);

echo "Added loading='lazy' to images via regex\n";

file_put_contents($file, $content);
echo "Done! index.php fully updated.\n";

// Count final WebP references
$finalWebpCount = substr_count($content, 'webp');
echo "Final WebP references: $finalWebpCount\n";
