<?php
/**
 * Gallery Page - Dr. Praveen Gupta
 * Photos: CMS → Photo Gallery. Banner + sections: CMS → All Pages → Gallery.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('gallery', [
    'hero_badge' => 'Events, Conferences & Recognition',
    'hero_title' => 'Media & Event <span class="text-white font-normal">Gallery</span>',
    'hero_desc'  => 'Explore moments from Dr. Praveen Gupta\'s patient awareness workshops, national and international clinical conferences, and prestigious medical awards.',
    'hero_bg'    => 'assets/breadcrumbs/media.png'
], ['style' => 'cover', 'icon' => 'fa-images', 'icon_color' => 'text-white']);

cms_render_page_flow('gallery');

require_once __DIR__ . '/includes/footer.php';
