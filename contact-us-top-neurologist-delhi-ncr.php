<?php
/**
 * Contact Us Page - Dr. Praveen Gupta
 * Banner + sections (contact cards, enquiry form, map, FAQs): CMS → All Pages → Contact Us.
 * Form submissions are stored in CMS → Leads (api/save-lead.php).
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('contact-us-top-neurologist-delhi-ncr', [
    'hero_badge' => 'Gurgaon & Delhi NCR Locations',
    'hero_title' => 'Get in <span class="text-white">Touch</span> with Us',
    'hero_desc'  => 'Have questions or want to schedule an appointment? Reach out to Dr. Praveen Gupta\'s clinical team. We are here to support your neurological health journey.',
    'hero_bg'    => 'assets/breadcrumbs/contact.png'
], ['style' => 'photo', 'icon' => 'fa-location-dot text-white']);

cms_render_page_flow('contact-us-top-neurologist-delhi-ncr');

require_once __DIR__ . '/includes/footer.php';
