<?php
/**
 * Education Video Library - Dr. Praveen Gupta
 * Videos + categories: CMS → Education Videos / Settings → Lists & Categories.
 * Banner + sections: CMS → All Pages → Video Library.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('neurology-video-library', [
    'hero_badge' => 'Educational Neurology Library',
    'hero_title' => 'Neurology <span class="text-cyan-accent">Video Library</span>',
    'hero_desc'  => 'Explore clinical explanations, medical guidelines, and diagnostic insights shared directly by Dr. Praveen Gupta.',
    'hero_bg'    => 'assets/breadcrumbs/media.png'
], ['style' => 'cover', 'icon' => 'fa-video', 'badge_border' => true, 'blob' => true]);

cms_render_page_flow('neurology-video-library');

require_once __DIR__ . '/includes/footer.php';
