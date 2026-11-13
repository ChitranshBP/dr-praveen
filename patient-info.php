<?php
/**
 * Patient Information Page - Dr. Praveen Gupta
 * Banner, buttons + sections: CMS → All Pages.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('patient-info', [
    'hero_badge' => 'Helpful Resources & Guidelines',
    'hero_title' => 'Patient <span class="text-white font-normal">Information & Resources</span>',
    'hero_desc'  => 'Find everything you need to know ahead of your visit. Explore insurance guidelines, consultation checklists, emergency contact info, and patient resources.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
], ['style' => 'photo', 'icon' => 'fa-info-circle text-white']);

cms_render_page_flow('patient-info');

require_once __DIR__ . '/includes/footer.php';
