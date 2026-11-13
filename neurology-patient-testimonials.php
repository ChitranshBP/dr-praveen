<?php
/**
 * Testimonials Page - Dr. Praveen Gupta
 * Reviews: CMS → Testimonials. Banner + sections: CMS → All Pages → Testimonials.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('neurology-patient-testimonials', [
    'hero_badge' => 'Patient Stories & Reviews',
    'hero_title' => 'Patient <span class="text-white font-normal">Success Stories</span>',
    'hero_desc'  => 'Read inspiring recovery stories from patients treated by Dr. Praveen Gupta for various complex neurological conditions.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
], ['style' => 'photo', 'icon' => 'fa-star text-amber-400']);

cms_render_page_flow('neurology-patient-testimonials');

require_once __DIR__ . '/includes/footer.php';
