<?php
/**
 * Neurology Consultation Page - Dr. Praveen Gupta
 * Banner, buttons + sections: CMS → All Pages.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('neurology-consultation', [
    'hero_badge' => 'Clinical Consulting Services',
    'hero_title' => 'Your Neurology <span class="text-cyan-accent">Consultation</span>',
    'hero_desc'  => 'Learn what to expect during your first neurological consultation with Dr. Praveen Gupta, and how to prepare to get the most out of your clinical evaluation.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
], ['style' => 'photo', 'icon' => 'fa-hand-holding-medical', 'badge_border' => true]);

cms_render_page_flow('neurology-consultation');

require_once __DIR__ . '/includes/footer.php';
