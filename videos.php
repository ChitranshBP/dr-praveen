<?php
/**
 * Videos Hub Page - Dr. Praveen Gupta
 * Videos + categories: CMS → Education Videos / Settings → Lists & Categories.
 * Banner + sections: CMS → All Pages → Videos Hub.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('videos', [
    'hero_badge' => 'Educational Neurology Library',
    'hero_title' => 'Neurology Video <span class="text-white font-normal">Hub</span>',
    'hero_desc'  => 'Watch detailed explanations, treatment overviews, and healthy brain guides directly from Dr. Praveen Gupta.',
    'hero_bg'    => 'assets/breadcrumbs/media.png'
], ['style' => 'cover', 'icon' => 'fab fa-youtube text-red-500']);

cms_render_page_flow('videos');

require_once __DIR__ . '/includes/footer.php';
