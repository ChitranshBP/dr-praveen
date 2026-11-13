<?php
/**
 * Online Teleconsultation Page - Dr. Praveen Gupta
 * Banner, buttons + sections: CMS → All Pages.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('online-neurologist-consultation', [
    'hero_badge' => 'Secure Digital Teleconsultation',
    'hero_title' => 'Online Neurology <span class="text-cyan-accent">Consultation</span>',
    'hero_desc'  => 'Consult with one of India\'s leading neurologists from the comfort of your home. Secure, convenient, and comprehensive online video consultations.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
], ['style' => 'photo', 'icon' => 'fa-video', 'badge_border' => true]);

cms_render_page_flow('online-neurologist-consultation');

require_once __DIR__ . '/includes/footer.php';
