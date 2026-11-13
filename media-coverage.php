<?php
/**
 * Media Coverage Page - Dr. Praveen Gupta
 * Press cards: CMS → Media Coverage. Banner + sections: CMS → All Pages → Media Coverage.
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = cms_render_page_hero('media-coverage', [
    'hero_badge' => 'TV Interviews & Press Coverage',
    'hero_title' => 'Media <span class="text-white font-normal">Coverage & Appearances</span>',
    'hero_desc'  => 'Dr. Praveen Gupta is a regular health panelist on top national TV channels and writes health columns in major English and Hindi newspapers.',
    'hero_bg'    => 'assets/breadcrumbs/media.png'
], ['style' => 'cover', 'icon' => 'fa-tv', 'icon_color' => 'text-white']);

cms_render_page_flow('media-coverage');

require_once __DIR__ . '/includes/footer.php';
