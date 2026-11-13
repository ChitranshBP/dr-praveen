<?php
/**
 * Schema.org JSON-LD Generator - Dr. Praveen Gupta
 * Outputs WebSite, Physician/MedicalBusiness and BreadcrumbList schemas.
 * Organisation details come from CMS → Settings → Organisation & Schema;
 * breadcrumb names come from each page's SEO card (CMS → All Pages).
 */

$siteUrl = rtrim(SITE_URL, '/');
$currentCanonical = $canonicalUrl ?? ($siteUrl . '/');
$pageTitleClean = strip_tags($pageTitle ?? ($finalMetaTitle ?? SITE_NAME));
$pageDescClean  = strip_tags($pageDescription ?? ($finalMetaDesc ?? ''));
$schemaSettings = isset($cmsSettings) && is_array($cmsSettings) ? $cmsSettings : [];
$s = function ($key, $default = '') use ($schemaSettings) {
    $v = isset($schemaSettings[$key]) ? trim((string)$schemaSettings[$key]) : '';
    return $v !== '' ? $v : $default;
};

$orgDescription = $s('org_description', 'Dr. Praveen Gupta is a renowned Neurologist in Gurgaon & Delhi NCR with 20+ years of experience and 3,00,000+ patients treated. Specializing in Stroke mechanical thrombectomy, Epilepsy, Parkinson\'s DBS, Migraine, and Spine care.');
$orgImage = cms_media_path($s('org_image'), 'assets/full-image/dpg-award.webp');

// 1. WebSite Schema
$websiteSchema = [
    '@context' => 'https://schema.org',
    '@type'    => 'WebSite',
    '@id'      => $siteUrl . '/#website',
    'name'     => SITE_NAME,
    'url'      => $siteUrl,
    'description' => $s('site_description', 'Official website of Dr. Praveen Gupta, Principal Director & Head of Neurology at Marengo Asia Hospitals.'),
    'publisher' => [
        '@id' => $siteUrl . '/#physician'
    ],
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => [
            '@type' => 'EntryPoint',
            'urlTemplate' => $siteUrl . '/services?q={search_term_string}'
        ],
        'query-input' => 'required name=search_term_string'
    ]
];

// 2. Physician & MedicalBusiness Schema
$openingDays = array_values(array_filter(array_map('trim', explode(',', $s('hours_days', 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday')))));
$physicianSchema = [
    '@context' => 'https://schema.org',
    '@type'    => ['Physician', 'MedicalBusiness'],
    '@id'      => $siteUrl . '/#physician',
    'name'     => SITE_NAME,
    'alternateName' => $s('org_alternate_name', SITE_NAME . ' Neurologist'),
    'url'      => $siteUrl,
    'logo'     => $siteUrl . '/' . ltrim(cms_site_logo()['path'], '/'),
    'image'    => $orgImage !== '' ? ($siteUrl . '/' . ltrim($orgImage, '/')) : ($siteUrl . '/' . ltrim(cms_site_logo()['path'], '/')),
    'description' => $orgDescription,
    'telephone' => SITE_PHONE,
    'email'     => SITE_EMAIL,
    'medicalSpecialty' => $s('org_specialty', 'Neurology'),
    'priceRange' => $s('org_price_range', '$$'),
    'address'  => [
        '@type' => 'PostalAddress',
        'streetAddress' => $s('addr_street', 'Marengo Asia Hospitals, Shushant Lok 2, Sector 56'),
        'addressLocality' => $s('addr_locality', 'Gurugram'),
        'addressRegion' => $s('addr_region', 'Haryana'),
        'postalCode' => $s('addr_postal', '122011'),
        'addressCountry' => $s('addr_country', 'IN')
    ],
    'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => (float)$s('geo_lat', '28.4287'),
        'longitude' => (float)$s('geo_lng', '77.0984')
    ],
    'openingHoursSpecification' => [
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => $openingDays,
            'opens' => $s('hours_open', '09:00'),
            'closes' => $s('hours_close', '19:00')
        ]
    ],
    'sameAs' => array_values(array_filter([
        defined('SOCIAL_FACEBOOK') ? SOCIAL_FACEBOOK : null,
        defined('SOCIAL_INSTAGRAM') ? SOCIAL_INSTAGRAM : null,
        defined('SOCIAL_TWITTER') ? SOCIAL_TWITTER : null,
        defined('SOCIAL_YOUTUBE') ? SOCIAL_YOUTUBE : null,
        defined('SOCIAL_LINKEDIN') ? SOCIAL_LINKEDIN : null,
    ]))
];

// Output Schemas
?>
<script type="application/ld+json">
<?php echo json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
</script>
<script type="application/ld+json">
<?php echo json_encode($physicianSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
</script>

<?php
// 3. BreadcrumbList Schema (for subpages) — mirrors the page's breadcrumb settings
if (!empty($currentPage) && $currentPage !== 'index' && empty($isHomepage)) {
    $crumbs = function_exists('cms_breadcrumbs') ? cms_breadcrumbs($currentPage, $pageTitleClean) : [];
    $items = [];
    $pos = 1;
    foreach ($crumbs as $crumb) {
        $items[] = [
            '@type' => 'ListItem',
            'position' => $pos++,
            'name' => $crumb['label'],
            'item' => $crumb['slug'] === 'index' ? $siteUrl . '/' : $siteUrl . '/' . $crumb['slug'],
        ];
    }
    if (empty($items)) {
        $items = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteUrl . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $pageTitleClean, 'item' => $currentCanonical],
        ];
    } else {
        $items[count($items) - 1]['item'] = $currentCanonical;
    }
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $items,
    ];
?>
<script type="application/ld+json">
<?php echo json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
</script>
<?php } ?>
