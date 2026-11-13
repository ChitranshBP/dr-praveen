<?php
/**
 * Neurology Second Opinion Page - Dr. Praveen Gupta
 * Banner, buttons + sections: CMS → All Pages.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('neurology-second-opinion', [
    'hero_badge' => 'Independent Diagnosis Review',
    'hero_title' => 'Neurology <span class="text-cyan-accent">Second Opinion</span>',
    'hero_desc'  => 'Gain clarity and confidence. Get a comprehensive review of your neurological diagnosis, imaging studies, and treatment plans from Dr. Praveen Gupta.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
], ['style' => 'photo', 'icon' => 'fa-search-plus', 'badge_border' => true]);

cms_render_page_flow('neurology-second-opinion');

require_once __DIR__ . '/includes/footer.php';
