<?php
/**
 * Image Conversion Script - GD Method
 * Converts PNG/JPG to WebP using PHP GD library
 */

$assetsDir = __DIR__ . '/assets';
$webpDir = $assetsDir . '/webp';

// Create WebP directory if needed
if (!is_dir($webpDir)) {
    mkdir($webpDir, 0755, true);
}

function convertPngToWebPGd($sourceFile, $destFile, $quality = 85) {
    // Create image from PNG
    $source = @imagecreatefrompng($sourceFile);
    if (!$source) {
        return false;
    }
    
    // For PNG with transparency, create proper WebP with background
    $bg = imagecreatetruecolor(imagesx($source), imagesy($source));
    $backgroundColor = imagecolorallocate($bg, 255, 255, 255);
    imagefill($bg, 0, 0, $backgroundColor);
    
    // Copy the PNG onto the white background
    imagecopy($bg, $source, 0, 0, 0, 0, imagesx($source), imagesy($source));
    
    // Clean up alpha
    imagealphablending($bg, false);
    imagesavealpha($bg, true);
    
    // Save as WebP
    $result = imagewebp($bg, $destFile, $quality);
    
    imagedestroy($source);
    imagedestroy($bg);
    
    return $result !== false;
}

function convertJpgToWebPGd($sourceFile, $destFile, $quality = 85) {
    $source = @imagecreatefromjpeg($sourceFile);
    if (!$source) {
        return false;
    }
    
    // Save as WebP
    $result = imagewebp($source, $destFile, $quality);
    imagedestroy($source);
    
    return $result !== false;
}

$converted = 0;
$failed = 0;

// Process all PNG and JPG images
$extensions = ['png', 'jpg', 'jpeg'];
$imageFiles = [];

function scanDirForImages($dir, &$imageFiles, $extensions) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . '/' . $file;
        if (is_dir($path)) {
            scanDirForImages($path, $imageFiles, $extensions);
        } elseif (pathinfo($file, PATHINFO_EXTENSION) && in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $extensions)) {
            $imageFiles[] = $path;
        }
    }
}

scanDirForImages($assetsDir, $imageFiles, $extensions);

echo "Found " . count($imageFiles) . " images to convert using GD method\n\n";

foreach ($imageFiles as $index => $imagePath) {
    $relativePath = str_replace($assetsDir . '/', '', $imagePath);
    $fileName = pathinfo($relativePath, PATHINFO_FILENAME);
    $ext = strtolower(pathinfo($relativePath, PATHINFO_EXTENSION));
    $webpPath = $webpDir . '/' . $fileName . '.webp';
    
    // Skip if WebP already exists and is smaller
    if (file_exists($webpPath)) {
        $originalSize = filesize($imagePath);
        $webpSize = filesize($webpPath);
        if ($webpSize < $originalSize) {
            echo "[$index] SKIP: $relativePath (WebP already smaller: $webpSize vs $originalSize)\n";
            continue;
        }
    }
    
    $originalSize = filesize($imagePath);
    $success = false;
    
    try {
        if ($ext === 'png') {
            $success = convertPngToWebPGd($imagePath, $webpPath, 85);
        } elseif ($ext === 'jpg' || $ext === 'jpeg') {
            $success = convertJpgToWebPGd($imagePath, $webpPath, 85);
        }
    } catch (Exception $e) {
        $success = false;
    }
    
    if ($success && file_exists($webpPath)) {
        $webpSize = filesize($webpPath);
        $saved = $originalSize - $webpSize;
        $reduction = ($originalSize > 0) ? round(($saved / $originalSize) * 100) : 0;
        echo "[$index] OK: $relativePath -> " . basename($webpPath);
        echo " ($originalSize bytes -> $webpSize bytes, saved $reduction%)\n";
        $converted++;
    } else {
        // Fallback: copy original
        copy($imagePath, $webpPath);
        $webpSize = filesize($webpPath);
        echo "[$index] COPY: $relativePath (original, GD failed) - $originalSize bytes\n";
        $failed++;
    }
}

echo "\n===================\n";
echo "GD Method Summary:\n";
echo "  Converted: $converted\n";
echo "  Failed/Fallback: $failed\n";
echo "  Total: " . count($imageFiles) . "\n";
echo "\nWebP files saved to: $webpDir\n";