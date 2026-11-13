<?php
/**
 * Terms of Service Page - Dr. Praveen Gupta
 * Banner, buttons + sections: CMS → All Pages.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('terms-of-service', [
    'hero_badge' => '',
    'hero_title' => 'Terms of <span class="text-cyan-accent">Service</span>',
    'hero_desc'  => 'Review the terms and clinical disclaimers governing the use of this website and online consultation portals.',
    'hero_bg'    => ''
], ['style' => 'photo']);

cms_render_page_flow('terms-of-service');

require_once __DIR__ . '/includes/footer.php';
