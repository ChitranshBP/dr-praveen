<?php
/**
 * Neurology FAQs Hub - Dr. Praveen Gupta
 * Banner, buttons + sections: CMS → All Pages.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('neurology-faqs', [
    'hero_badge' => 'Neurology Help & FAQ Hub',
    'hero_title' => 'Neurology <span class="text-cyan-accent">FAQs</span>',
    'hero_desc'  => 'Find clear answers to common questions regarding appointments, neurological symptoms, diagnostic tests (EEG/EMG), and specialized therapies.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
], ['style' => 'photo', 'icon' => 'fa-question', 'badge_border' => true]);

cms_render_page_flow('neurology-faqs');

require_once __DIR__ . '/includes/footer.php';
