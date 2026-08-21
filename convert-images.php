<?php
/**
 * Image Conversion Script for dr-praveen.com
 * Converts PNG/JPG to WebP format with compression
 * 
 * Prerequisites:
 * 1. Install GraphicsMagick: choco install graphicsmagick
 *    OR install PHP Imagick extension
 * 2. Or use the included cwebp.exe (download from https://developers.google.com/speed/webp/docs/rutt)
 */

$assetsDir = __DIR__ . '/assets';
$webpDir = $assetsDir . '/webp';

// Create WebP directory
if (!is_dir($webpDir)) {
    mkdir($webpDir, 0755, true);
}

$converted = 0;
$skipped = 0;
$failed = 0;

// Find all PNG and JPEG images
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

echo "Found " . count($imageFiles) . " images to process\n\n";

foreach ($imageFiles as $index => $imagePath) {
    $relativePath = str_replace($assetsDir . '/', '', $imagePath);
    $fileName = pathinfo($relativePath, PATHINFO_FILENAME);
    $ext = strtolower(pathinfo($relativePath, PATHINFO_EXTENSION));
    $webpPath = $webpDir . '/' . $fileName . '.webp';
    
    // Skip if already converted
    if (file_exists($webpPath)) {
        echo "[$index] SKIP: $relativePath (WebP already exists)\n";
        $skipped++;
        continue;
    }
    
    $originalSize = filesize($imagePath);
    
    // Method 1: Try using system cwebp command
    $command = 'cwebp -q 85 "' . escapeshellarg($imagePath) . '" -o "' . $webpPath . '"';
    $output = [];
    $returnCode = 0;
    exec($command, $output, $returnCode);
    
    if ($returnCode === 0 && file_exists($webpPath)) {
        $webpSize = filesize($webpPath);
        $saved = $originalSize - $webpSize;
        $reduction = ($originalSize > 0) ? round(($saved / $originalSize) * 100) : 0;
        echo "[$index] OK: $relativePath -> " . basename($webpPath);
        echo " ($originalSize bytes -> $webpSize bytes, saved $reduction%)\n";
        $converted++;
        continue;
    }
    
    // Method 2: Try using GraphicsMagick convert
    $command = 'convert "' . escapeshellarg($imagePath) . '" -quality 85 "' . $webpPath . '"';
    $output = [];
    $returnCode = 0;
    exec($command, $output, $returnCode);
    
    if ($returnCode === 0 && file_exists($webpPath)) {
        $webpSize = filesize($webpPath);
        $saved = $originalSize - $webpSize;
        $reduction = ($originalSize > 0) ? round(($saved / $originalSize) * 100) : 0;
        echo "[$index] OK: $relativePath -> " . basename($webpPath);
        echo " ($originalSize bytes -> $webpSize bytes, saved $reduction%)\n";
        $converted++;
        continue;
    }
    
    // Method 3: Try using PHP GD if available
    if (function_exists('imagecreatefrompng') && function_exists('imagewebp')) {
        try {
            $ext = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
            if ($ext === 'png') {
                $source = @imagecreatefrompng($imagePath);
            } elseif ($ext === 'jpg' || $ext === 'jpeg') {
                $source = @imagecreatefromjpeg($imagePath);
            }
            
            if ($source) {
                // For PNG with transparency, we need to handle background
                $bg = imagecreatetruecolor(imagesx($source), imagesy($source));
                imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
                imagecopyresized($bg, $source, 0, 0, 0, 0, imagesx($bg), imagesy($bg), imagesx($source), imagesy($source));
                
                imagealphablending($bg, false);
                imagesavealpha($bg, true);
                imagewebp($bg, $webpPath, 85);
                imagedestroy($source);
                imagedestroy($bg);
                
                $webpSize = filesize($webpPath);
                $saved = $originalSize - $webpSize;
                $reduction = ($originalSize > 0) ? round(($saved / $originalSize) * 100) : 0;
                echo "[$index] OK: $relativePath -> " . basename($webpPath);
                echo " ($originalSize bytes -> $webpSize bytes, saved $reduction%)\n";
                $converted++;
                continue;
            }
        } catch (Exception $e) {
            // Fall through to failed
        }
    }
    
    // Method 4: Fallback - just copy original with .webp extension (no conversion)
    copy($imagePath, $webpPath);
    $webpSize = filesize($webpPath);
    echo "[$index] COPY: $relativePath (original, not converted) - $originalSize bytes\n";
    $failed++;
}

echo "\n===================\n";
echo "Summary:\n";
echo "  Converted: $converted\n";
echo "  Skipped (already WebP): $skipped\n";
echo "  Failed: $failed\n";
echo "  Total: " . ( $converted + $skipped + $failed ) . "\n";
echo "\nWebP files saved to: $webpDir\n";
echo "To use these images, update your HTML to use .webp format with fallbacks.\n";
