<?php
/**
 * Medical Disclaimer Page - Dr. Praveen Gupta
 * Banner, buttons + sections: CMS → All Pages → Medical Disclaimer.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('medical-disclaimer', [
    'hero_badge' => '',
    'hero_title' => 'Medical <span class="text-cyan-accent">Disclaimer</span>',
    'hero_desc'  => 'How to use the health information on this website, and what to do in an emergency.',
    'hero_bg'    => ''
], ['style' => 'photo']);

cms_render_page_flow('medical-disclaimer');

require_once __DIR__ . '/includes/footer.php';
