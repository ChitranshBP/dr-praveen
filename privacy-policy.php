<?php
/**
 * Privacy Policy Page - Dr. Praveen Gupta
 * Banner, buttons + sections: CMS → All Pages.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('privacy-policy', [
    'hero_badge' => '',
    'hero_title' => 'Privacy <span class="text-cyan-accent">Policy</span>',
    'hero_desc'  => 'Learn how we collect, protect, and use your personal information and clinical records on this website.',
    'hero_bg'    => ''
], ['style' => 'photo']);

cms_render_page_flow('privacy-policy');

require_once __DIR__ . '/includes/footer.php';
