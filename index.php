<?php
/**
 * Homepage - Dr. Praveen Gupta
 *
 * Every section (banner slider, services, slideshow, statistics, about,
 * why-choose, consultation strip, technology, team, testimonials, blog, awards,
 * videos, Instagram, FAQ) is a CMS block: order, visibility and copy are edited
 * in CMS → All Pages → Home.
 */
require_once __DIR__ . '/includes/header.php';

cms_render_page_flow('index');

require_once __DIR__ . '/includes/footer.php';
