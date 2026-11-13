<?php
/**
 * Emergency Neurology Care Page - Dr. Praveen Gupta
 * Banner, buttons + sections: CMS → All Pages.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('emergency-neurology-care', [
    'hero_badge' => '24/7 Emergency Neurology Response',
    'hero_title' => 'Emergency <span class="text-red-400">Neurology Care</span>',
    'hero_desc'  => 'When a neurological emergency strikes, every second counts. Under the guidance of Dr. Praveen Gupta, our team provides rapid, life-saving care for stroke, seizures, and head trauma.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
], ['style' => 'photo', 'icon' => 'fa-exclamation-circle text-red-400 animate-pulse', 'badge_border' => true]);

cms_render_page_flow('emergency-neurology-care');

require_once __DIR__ . '/includes/footer.php';
