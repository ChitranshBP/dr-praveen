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

// Build each page in a separate PHP subprocess so require_once behaves correctly
foreach ($pages as $srcFile) {
    $outFile = str_replace('.php', '.html', $srcFile);
    $destPath = $distFolder . '/' . $outFile;

    // Clean any previous build of this page
    if (file_exists($destPath)) {
        unlink($destPath);
    }

    // Write a temporary build script that includes the PHP file
    $tmpScript = $distFolder . '/_build_tmp.php';
    $scriptContent = '<?php' . "\n"
        . '$_SERVER["PHP_SELF"] = "/' . $srcFile . '";' . "\n"
        . 'ob_start();' . "\n"
        . 'try { include "' . $srcFile . '"; }' . "\n"
        . 'catch (Exception $e) { ob_end_clean(); echo "Error: " . $e->getMessage(); exit(1); }' . "\n"
        . '$html = ob_get_clean();' . "\n"
        . '$html = str_replace([\'php"\', "php\'", \'php#\', \'php/\'], [\'html"\', "html\'", \'html#\', \'html/\'], $html);' . "\n"
        . 'file_put_contents("' . $destPath . '", $html);' . "\n"
        . 'echo "[Compiled] ' . $srcFile . ' => ' . $outFile . ' (length: " . strlen($html) . " bytes)\\n";' . "\n";

    file_put_contents($tmpScript, $scriptContent);

    // Execute the temp script in a subprocess
    $output = shell_exec('php ' . $tmpScript . ' 2>&1');
    echo '  ' . trim($output) . "\n";

    // Clean up temp script
    @unlink($tmpScript);
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
