<?php
/**
 * Blog Hub Page - Dr. Praveen Gupta
 * Lists articles managed in the CMS (/cms/blogs.php).
 * Banner, newsletter box + SEO title: CMS → All Pages → The Neurology Blog.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('dr-praveen-gupta-blog', [
    'hero_badge' => 'Healthy Brain Guides & Articles',
    'hero_title' => 'The Neurology <span class="text-white font-normal">Blog</span>',
    'hero_desc'  => 'Expert guides, healthy lifestyle tips, and detailed neuro-health columns curated directly by Dr. Praveen Gupta.',
    'hero_bg'    => ''
], ['style' => 'photo', 'icon' => 'fa-book-open text-white']);

cms_render_page_flow('dr-praveen-gupta-blog');

require_once __DIR__ . '/includes/footer.php';
