<?php
/**
 * Add WebP paths to config.php arrays
 */

$file = 'includes/config.php';
$content = file_get_contents($file);

// Add webp key to $services array - stroke care
$content = str_replace(
    "'image' => 'assets/services/stroke-care.png',",
    "'image' => 'assets/services/stroke-care.png',
        'webp' => 'assets/webp/services/stroke-care.webp',",
    $content
);

// Add webp key to epilepsy
$content = str_replace(
    "'image' => 'assets/services/epilepsy.png',",
    "'image' => 'assets/services/epilepsy.png',
        'webp' => 'assets/webp/services/epilepsy.webp',",
    $content
);

// Add webp key to brain tumor
$content = str_replace(
    "'image' => 'assets/services/brain-tumor.png',",
    "'image' => 'assets/services/brain-tumor.png',
        'webp' => 'assets/webp/services/brain-tumor.webp',",
    $content
);

// Add webp key to spine surgery
$content = str_replace(
    "'image' => 'assets/services/spine-surgery.png',",
    "'image' => 'assets/services/spine-surgery.png',
        'webp' => 'assets/webp/services/spine-surgery.webp',",
    $content
);

// Add webp key to headache
$content = str_replace(
    "'image' => 'assets/services/headache.png',",
    "'image' => 'assets/services/headache.png',
        'webp' => 'assets/webp/services/headache.webp',",
    $content
);

// Add webp key to functional neurosurgery
$content = str_replace(
    "'image' => 'assets/services/functional-neuro.png',",
    "'image' => 'assets/services/functional-neuro.png',
        'webp' => 'assets/webp/services/functional-neuro.webp',",
    $content
);

// Add webp key to neurovascular
$content = str_replace(
    "'image' => 'assets/services/neurovascular.png',",
    "'image' => 'assets/services/neurovascular.png',
        'webp' => 'assets/webp/services/neurovascular.webp',",
    $content
);

// Add webp key to memory clinic
$content = str_replace(
    "'image' => 'assets/services/memory-clinic.png',",
    "'image' => 'assets/services/memory-clinic.png',
        'webp' => 'assets/webp/services/memory-clinic.webp',",
    $content
);

// Add webp key to rehab
$content = str_replace(
    "'image' => 'assets/services/rehab.png',",
    "'image' => 'assets/services/rehab.png',
        'webp' => 'assets/webp/services/rehab.webp',",
    $content
);

// Add webp key to parkinsons
$content = str_replace(
    "'image' => 'assets/services/parkinsons.png',",
    "'image' => 'assets/services/parkinsons.png',
        'webp' => 'assets/webp/services/parkinsons.webp',",
    $content
);

// Add webp key to ms
$content = str_replace(
    "'image' => 'assets/services/ms.png',",
    "'image' => 'assets/services/ms.png',
        'webp' => 'assets/webp/services/ms.webp',",
    $content
);

// Add webp key to migraine
$content = str_replace(
    "'image' => 'assets/services/migraine.png',",
    "'image' => 'assets/services/migraine.png',
        'webp' => 'assets/webp/services/migraine.webp',",
    $content
);

// Add webp key to neuropathy
$content = str_replace(
    "'image' => 'assets/services/neuropathy.png',",
    "'image' => 'assets/services/neuropathy.png',
        'webp' => 'assets/webp/services/neuropathy.webp',",
    $content
);

// Add webp key to neurovascular (second entry, stroke)
$content = str_replace(
    "'image' => 'assets/services/stroke.png',",
    "'image' => 'assets/services/stroke.png',
        'webp' => 'assets/webp/services/stroke.webp',",
    $content
);

// Add webp key to stroke-care
$content = str_replace(
    "'image' => 'assets/services/stroke-care.png',",
    "'image' => 'assets/services/stroke-care.png',
        'webp' => 'assets/webp/services/stroke-care.webp',",
    $content
);

// Add webp key to vertigo
$content = str_replace(
    "'image' => 'assets/services/vertigo.png',",
    "'image' => 'assets/services/vertigo.png',
        'webp' => 'assets/webp/services/vertigo.webp',",
    $content
);

// Add webp key to awards
$content = str_replace(
    "'image' => 'assets/awards/9.jpg',",
    "'image' => 'assets/awards/9.jpg',
        'webp' => 'assets/webp/awards/9.webp',",
    $content
);
$content = str_replace(
    "'image' => 'assets/awards/8.jpg',",
    "'image' => 'assets/awards/8.jpg',
        'webp' => 'assets/webp/awards/8.webp',",
    $content
);
$content = str_replace(
    "'image' => 'assets/awards/7.jpg',",
    "'image' => 'assets/awards/7.jpg',
        'webp' => 'assets/webp/awards/7.webp',",
    $content
);
$content = str_replace(
    "'image' => 'assets/awards/6.jpg',",
    "'image' => 'assets/awards/6.jpg',
        'webp' => 'assets/webp/awards/6.webp',",
    $content
);
$content = str_replace(
    "'image' => 'assets/awards/5.jpg',",
    "'image' => 'assets/awards/5.jpg',
        'webp' => 'assets/webp/awards/5.webp',",
    $content
);
$content = str_replace(
    "'image' => 'assets/awards/4.jpg',",
    "'image' => 'assets/awards/4.jpg',
        'webp' => 'assets/webp/awards/4.webp',",
    $content
);
$content = str_replace(
    "'image' => 'assets/awards/3.jpg',",
    "'image' => 'assets/awards/3.jpg',
        'webp' => 'assets/webp/awards/3.webp',",
    $content
);
$content = str_replace(
    "'image' => 'assets/awards/2.jpg',",
    "'image' => 'assets/awards/2.jpg',
        'webp' => 'assets/webp/awards/2.webp',",
    $content
);
$content = str_replace(
    "'image' => 'assets/awards/1.jpg',",
    "'image' => 'assets/awards/1.jpg',
        'webp' => 'assets/webp/awards/1.webp',",
    $content
);
$content = str_replace(
    "'image' => 'assets/awards/15.jpg',",
    "'image' => 'assets/awards/15.jpg',
        'webp' => 'assets/webp/awards/15.webp',",
    $content
);

// Add webp key to blogs
$content = str_replace(
    "'image' => 'assets/services/migraine.png',",
    "'image' => 'assets/services/migraine.png',
        'webp' => 'assets/webp/blogs/migraine.webp',",
    $content
);
$content = str_replace(
    "'image' => 'assets/services/stroke.png',",
    "'image' => 'assets/services/stroke.png',
        'webp' => 'assets/webp/blogs/stroke.webp',",
    $content
);
$content = str_replace(
    "'image' => 'assets/services/parkinsons.png',",
    "'image' => 'assets/services/parkinsons.png',
        'webp' => 'assets/webp/blogs/parkinsons.webp',",
    $content
);

// Save the file
file_put_contents($file, $content);
echo "Updated config.php with WebP paths\n";

// Count webp entries
$webpCount = substr_count($content, "'webp'");
echo "Total WebP entries in config: $webpCount\n";
