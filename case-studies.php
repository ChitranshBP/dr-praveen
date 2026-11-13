<?php
/**
 * Neurology Case Studies Page - Dr. Praveen Gupta
 * Cases: CMS → Case Studies. Banner + sections: CMS → All Pages → Case Studies.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('case-studies', [
    'hero_badge' => 'Anonymized Clinical Case Files',
    'hero_title' => 'Neurology <span class="text-cyan-accent">Case Studies</span>',
    'hero_desc'  => 'Explore real clinical histories demonstrating the effectiveness of advanced stroke treatments, DBS programming, and specialized neurology interventions.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
], ['style' => 'photo', 'icon' => 'fa-microscope', 'badge_border' => true]);

cms_render_page_flow('case-studies');

require_once __DIR__ . '/includes/footer.php';
