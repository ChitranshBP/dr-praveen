<?php
/**
 * Schema.org JSON-LD Generator - Dr. Praveen Gupta
 * Outputs MedicalBusiness, Physician, WebSite, BreadcrumbList, and FAQPage schemas.
 */

$siteUrl = rtrim(SITE_URL, '/');
$currentCanonical = $canonicalUrl ?? ($siteUrl . '/');
$pageTitleClean = strip_tags($pageTitle ?? 'Dr. Praveen Gupta - Best Neurologist in Gurgaon');
$pageDescClean  = strip_tags($pageDescription ?? 'Leading Neurologist in Gurgaon & Delhi NCR with 20+ years of experience.');

// 1. WebSite Schema
$websiteSchema = [
    '@context' => 'https://schema.org',
    '@type'    => 'WebSite',
    '@id'      => $siteUrl . '/#website',
    'name'     => SITE_NAME,
    'url'      => $siteUrl,
    'description' => 'Official website of Dr. Praveen Gupta, Principal Director & Head of Neurology at Marengo Asia Hospitals.',
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
$physicianSchema = [
    '@context' => 'https://schema.org',
    '@type'    => ['Physician', 'MedicalBusiness'],
    '@id'      => $siteUrl . '/#physician',
    'name'     => 'Dr. Praveen Gupta',
    'alternateName' => 'Dr Praveen Gupta Neurologist',
    'url'      => $siteUrl,
    'logo'     => $siteUrl . '/assets/logo/NeuroDoc-final-logo.png',
    'image'    => $siteUrl . '/assets/full-image/dpg-award.webp',
    'description' => 'Dr. Praveen Gupta is a renowned Neurologist in Gurgaon & Delhi NCR with 20+ years of experience and 3,00,000+ patients treated. Specializing in Stroke mechanical thrombectomy, Epilepsy, Parkinson\'s DBS, Migraine, and Spine care.',
    'telephone' => SITE_PHONE,
    'email'     => SITE_EMAIL,
    'medicalSpecialty' => 'Neurology',
    'priceRange' => '$$',
    'address'  => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Marengo Asia Hospitals, Shushant Lok 2, Sector 56',
        'addressLocality' => 'Gurugram',
        'addressRegion' => 'Haryana',
        'postalCode' => '122011',
        'addressCountry' => 'IN'
    ],
    'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => 28.4287,
        'longitude' => 77.0984
    ],
    'openingHoursSpecification' => [
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            'opens' => '09:00',
            'closes' => '19:00'
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
// 3. BreadcrumbList Schema (for subpages)
if (!empty($currentPage) && $currentPage !== 'index' && empty($isHomepage)) {
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => $siteUrl . '/'
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $pageTitleClean,
                'item' => $currentCanonical
            ]
        ]
    ];
?>
<script type="application/ld+json">
<?php echo json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
</script>
<?php } ?>
