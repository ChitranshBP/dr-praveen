<?php
/**
 * Retired page (DPDP / NMC compliance, Nov 2026): patient success stories are
 * no longer published. Permanent redirect; the target is set in
 * cms_retired_pages() (includes/compliance.php).
 */
require_once __DIR__ . '/includes/cms-load.php';
cms_redirect_retired_page('patient-success-stories');
