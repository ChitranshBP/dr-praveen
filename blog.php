<?php
/**
 * Blog Page - Dr. Praveen Gupta
 * Lists all published articles managed in the CMS (/cms/blogs.php).
 * Heading copy + SEO title: CMS → All Pages → Blog.
 */
require_once __DIR__ . '/includes/header.php';

cms_render_page_flow('blog');

require_once __DIR__ . '/includes/footer.php';
