<?php
/**
 * Patient Reviews Page - Dr. Praveen Gupta
 * Reviews: CMS → Testimonials. Banner + sections: CMS → All Pages → Patient Reviews.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('patient-reviews', [
    'hero_badge' => '4.9/5 Rating - 1000+ Verified Patient Reviews',
    'hero_title' => 'Patient <span class="text-cyan-accent">Reviews</span>',
    'hero_desc'  => 'Read direct reviews, feedback, and statements left by patients regarding their diagnostic experiences and treatment outcomes.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
], ['style' => 'photo', 'icon' => 'fa-star text-yellow-400', 'badge_border' => true]);

cms_render_page_flow('patient-reviews');

require_once __DIR__ . '/includes/footer.php';
