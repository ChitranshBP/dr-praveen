<?php
/**
 * Local Development Server Router for PHP Built-in Server
 * Mimics Apache .htaccess routing rules for local testing:
 * - Extensionless URLs (/about -> about.php, /blog -> blog.php)
 * - Blog clean URLs (/blog/<slug> -> blog-post.php?slug=<slug>)
 * - Landing page (/enquire -> LP/index.php, /enquire/thank-you -> LP/thank-you.php)
 * - Static assets served directly
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rawurldecode($uri);

// 1. Static asset files (CSS, JS, images, fonts, pdf, etc.) -> serve directly
$filePath = __DIR__ . $uri;
if ($uri !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    return false; // Built-in server serves file directly with proper MIME type
}

// 2. Landing Page routing (/enquire, /lp, /enquire/thank-you)
if (preg_match('#^/enquire/thank-you/?$#i', $uri)) {
    require __DIR__ . '/LP/thank-you.php';
    return true;
}
if (preg_match('#^/(enquire|lp)/?$#i', $uri)) {
    require __DIR__ . '/LP/index.php';
    return true;
}

// 3. Clean Blog Post routing (/blog/<slug> and /blog-post/<slug>)
if (preg_match('#^/(blog|blog-post)/([a-zA-Z0-9_-]+)/?$#i', $uri, $matches)) {
    $_GET['slug'] = $matches[2];
    require __DIR__ . '/blog-post.php';
    return true;
}

// 4. Clean extensionless PHP pages (/about -> about.php, /dr-praveen-gupta-blog -> dr-praveen-gupta-blog.php, /cms/blogs -> cms/blogs.php)
$cleanPhp = __DIR__ . $uri . '.php';
if (file_exists($cleanPhp) && is_file($cleanPhp)) {
    require $cleanPhp;
    return true;
}

// 5. Subdirectories with index.php (e.g. /cms/)
if (is_dir($filePath) && file_exists($filePath . '/index.php')) {
    require $filePath . '/index.php';
    return true;
}

// 6. Root Homepage
if ($uri === '/' || $uri === '/index' || $uri === '/index.php') {
    require __DIR__ . '/index.php';
    return true;
}

// 7. 404 Fallback
http_response_code(404);
if (file_exists(__DIR__ . '/404.php')) {
    require __DIR__ . '/404.php';
} else {
    echo "<h1>404 Not Found</h1>";
}
return true;
