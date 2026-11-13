<?php
/**
 * Video Testimonials Page - Dr. Praveen Gupta
 * Videos: CMS → Testimonials (video entries). Banner + sections: CMS → All Pages → Video Testimonials.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('video-testimonials', [
    'hero_badge' => 'Video Patient Reviews & Recovery Stories',
    'hero_title' => 'Video <span class="text-cyan-accent">Testimonials</span>',
    'hero_desc'  => 'Watch verified recovery stories shared by patients who underwent advanced neurology treatments under the direction of Dr. Praveen Gupta.',
    'hero_bg'    => 'assets/breadcrumbs/media.png'
], ['style' => 'cover', 'icon' => 'fa-video', 'badge_border' => true, 'blob' => true]);

cms_render_page_flow('video-testimonials');

require_once __DIR__ . '/includes/footer.php';
