<?php
/**
 * Retired page (DPDP / NMC compliance, Nov 2026): video testimonials are no
 * longer published. Permanent redirect; the target is set in
 * cms_retired_pages() (includes/compliance.php).
 */
require_once __DIR__ . '/includes/cms-load.php';
cms_redirect_retired_page('video-testimonials');
