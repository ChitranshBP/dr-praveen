<?php
/**
 * Neurology Procedures Page - Dr. Praveen Gupta
 * Banner, buttons + sections: CMS → All Pages.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('neurology-procedures', [
    'hero_badge' => 'Advanced Diagnostics & Therapeutics',
    'hero_title' => 'Neurology <span class="text-cyan-accent">Procedures</span>',
    'hero_desc'  => 'Explore the advanced clinical diagnostic tests and highly specialized therapeutic procedures conducted under the supervision of Dr. Praveen Gupta.',
    'hero_bg'    => ''
], ['style' => 'photo', 'icon' => 'fa-microscope', 'badge_border' => true]);

cms_render_page_flow('neurology-procedures');

require_once __DIR__ . '/includes/footer.php';
