<?php
/**
 * Patient Success Stories Page - Dr. Praveen Gupta
 * Stories: CMS → Testimonials (type "story"). Banner + sections: CMS → All Pages → Success Stories.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('patient-success-stories', [
    'hero_badge' => 'Patient Letters & Recovery Journals',
    'hero_title' => 'Patient <span class="text-cyan-accent">Success Stories</span>',
    'hero_desc'  => 'Read recovery stories, letters of appreciation, and medical updates shared directly by our patients and their families.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
], ['style' => 'photo', 'icon' => 'fa-notes-medical', 'badge_border' => true]);

cms_render_page_flow('patient-success-stories');

require_once __DIR__ . '/includes/footer.php';
