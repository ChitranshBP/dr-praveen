<?php
/**
 * Services Listing Page - Dr. Praveen Gupta
 * Cards: CMS → Brain & Spine Cards. Banner, buttons + sections: CMS → All Pages → Services.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('services', [
    'hero_badge' => 'Our Expertise',
    'hero_title' => 'Neurological <span class="text-white">Services</span> & Treatments',
    'hero_desc'  => 'Dr. Praveen Gupta offers state-of-the-art diagnostic and treatment solutions for a wide range of brain, spinal cord, and nerve disorders. Explore our specialized services below.',
    'hero_bg'    => ''
], ['style' => 'photo', 'icon' => 'fa-stethoscope text-white']);

cms_render_page_flow('services');

require_once __DIR__ . '/includes/footer.php';
