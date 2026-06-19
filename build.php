<?php
/**
 * Dynamic Build Script for Netlify Deployment
 * Automatically detects and generates static HTML files from all root PHP templates
 */

// Ensure dist folder exists
$distFolder = 'dist';
if (!is_dir($distFolder)) {
    mkdir($distFolder, 0755, true);
}

// Dynamically scan for all PHP files in the root directory
$phpFiles = glob('*.php');

// Exclude build.php and other utility scripts if any
$pages = array_filter($phpFiles, function($file) {
    return $file !== 'build.php';
});

if (empty($pages)) {
    echo "No PHP pages found to build.\n";
    exit(1);
}

echo "Starting build process...\n";
echo "Found " . count($pages) . " page(s) to compile.\n\n";

// Build each page
foreach ($pages as $srcFile) {
    $outFile = str_replace('.php', '.html', $srcFile);
    $destPath = $distFolder . '/' . $outFile;

    // Clean any previous build of this page
    if (file_exists($destPath)) {
        unlink($destPath);
    }

    // Capture output from PHP file execution
    ob_start();
    try {
        // Set up server context variables that might be used in template parsing
        $_SERVER['PHP_SELF'] = '/' . $srcFile;
        include $srcFile;
    } catch (Exception $e) {
        ob_end_clean();
        echo "Error building $srcFile: " . $e->getMessage() . "\n";
        continue;
    }
    $html = ob_get_clean();

    // Convert internal PHP links to HTML links for static hosting
    $html = str_replace('.php"', '.html"', $html);
    $html = str_replace(".php'", ".html'", $html);
    $html = str_replace('.php#', '.html#', $html);
    $html = str_replace('.php/', '.html/', $html);

    // Save to dist folder
    file_put_contents($destPath, $html);
    echo "  [Compiled] $srcFile => $outFile\n";
}

// Copy assets directory to dist
function copyDir($src, $dst) {
    if (!is_dir($src)) return;
    if (!is_dir($dst)) mkdir($dst, 0755, true);
    $files = scandir($src);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $srcPath = "$src/$file";
        $dstPath = "$dst/$file";
        if (is_dir($srcPath)) {
            copyDir($srcPath, $dstPath);
        } else {
            copy($srcPath, $dstPath);
        }
    }
}

echo "\nCopying assets folder...\n";
if (is_dir('assets')) {
    copyDir('assets', $distFolder . '/assets');
    echo "  [Copied] assets/ => $distFolder/assets/\n";
} else {
    echo "  [Warning] assets/ folder not found.\n";
}

echo "\nBuild complete: All pages generated successfully in '$distFolder/' directory!\n";
