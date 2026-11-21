<?php
/**
 * DPDP Act 2023 + NMC advertising compliance — data migration (Nov 2026).
 *
 *   php scripts/compliance-dpdp-nmc.php [path/to/data] [--dry-run]
 *
 * Run it once on the server AFTER deploying the code and merging live data
 * back (scripts/merge-live-data.php keeps live values, so the repo's data
 * fixes would otherwise be lost). Safe to run again: a second run changes
 * nothing.
 *
 * What it does to every data/*.json file (users.json and leads.json are never
 * touched; testimonials.json and collections/case_studies.json are kept
 * as internal records):
 *   1. removes retired sections (patient testimonials, video testimonials,
 *      case-study outcomes) and the retired pages' own block definitions;
 *   2. drops menu links to retired pages and the contact-form
 *      "Feedback / Testimonials" wording;
 *   3. adds the Medical Disclaimer link, page and catalog entry, installs the
 *      DPDP Privacy Policy text and links the Terms to both;
 *   4. lists any remaining testimonial / review / inducement wording so it
 *      can be fixed by hand, then regenerates sitemap.xml.
 * Clinical claims, statistics and headings are left exactly as the owner wrote them.
 */

$args = array_slice($argv, 1);
$dry = in_array('--dry-run', $args, true);
$args = array_values(array_filter($args, function ($a) { return $a !== '--dry-run'; }));
$root = dirname(__DIR__);
$dataDir = rtrim(str_replace('\\', '/', $args[0] ?? ($root . '/data')), '/');
if (!is_dir($dataDir) || !is_file($dataDir . '/page-blocks.json')) {
    fwrite(STDERR, "Usage: php scripts/compliance-dpdp-nmc.php [path/to/data] [--dry-run]\n");
    exit(1);
}
require_once $root . '/includes/compliance.php'; // cms_retired_pages(), cms_block_is_retired(), cms_is_retired_url()

const SKIP_FILES = ['users.json', 'leads.json'];
// Patient statements are kept verbatim as internal records (never published).
const NO_REWRITE_FILES = ['testimonials.json', 'collections/case_studies.json'];
// Values under these keys are identifiers / links, never prose.
const NO_REWRITE_KEYS = ['slug', 'id', 'url', 'file', 'image', 'hero_bg', 'button_url', 'button2_url', 'link_url', 'youtube_id', 'shortcode', 'type', 'icon', 'card_class'];

/* ---------------------------------------------------------------------------
 * 3. Phrase rewrites — exact, case-sensitive. Clinical claims, statistics and
 *    headings are kept as written by the owner (decision of 21 Nov 2026); only
 *    wording that points visitors to testimonials is changed, and the patient
 *    and awards counts are made consistent: 3,00,000+ patients, 50+ awards.
 * ------------------------------------------------------------------------- */
$REWRITES = [
    ['Feedback|Feedback / Testimonials', 'Feedback|Feedback'],
    // One patient count everywhere: 3,00,000+
    ['and more than 300,000 satisfied patients', 'and 3,00,000+ satisfied patients'],
    ['Over 300,000 satisfied patients,', '3,00,000+ satisfied patients,'],
    ['and over <strong>3,00,000 satisfied patients</strong>', 'and <strong>3,00,000+ satisfied patients</strong>'],
    ['with over <strong>3,00,000 patients</strong>', 'with <strong>3,00,000+ patients</strong>'],
    ['Trusted by half a million patients', 'Trusted by 3,00,000+ patients'],
    ['500K+', '3,00,000+'],
    // One awards count everywhere: 50+
    ['Recipient of 20+ National & International Awards', 'Recipient of 50+ National & International Awards'],
];

/* ---------------------------------------------------------------------------
 * 4. New page content
 * ------------------------------------------------------------------------- */
$h2 = '<h2 class="text-2xl font-bold text-deep-indigo font-serif">';
$ul = '<ul class="list-disc pl-5 space-y-1">';
$a = function ($href, $text) { return '<a href="' . $href . '" class="text-electric-blue hover:underline">' . $text . '</a>'; };
$sec = function ($title, $body) use ($h2) { return "<div class=\"space-y-3\">\n" . $h2 . $title . "</h2>\n" . $body . "\n</div>"; };

$PRIVACY_POLICY = implode("\n", [
    $sec('1. Who We Are', '<p>This Privacy Policy explains how {site} (“we”, “us”) collects, uses, shares and protects your personal data when you use this website, in line with the Digital Personal Data Protection Act, 2023 (“DPDP Act”) and the rules made under it. For personal data collected through this website, the Data Fiduciary is:</p>' . "\n" . $ul . "\n<li><strong>Name:</strong> {site}</li>\n<li><strong>Address:</strong> {address}</li>\n<li><strong>Email:</strong> " . $a('mailto:{email}', '{email}') . "</li>\n<li><strong>Phone:</strong> {phone}</li>\n</ul>\n<p>If you are seen or treated at a hospital, the hospital may also process your data under its own privacy policy. You can ask us for this notice in English or in any language listed in the Eighth Schedule to the Constitution of India.</p>"),
    $sec('2. Personal Data We Collect', '<p>We collect only what we need to respond to you:</p>' . "\n" . $ul . "\n<li><strong>Identity and contact details:</strong> your name, phone number and email address.</li>\n<li><strong>Health information you choose to share:</strong> the reason for your enquiry, symptoms, condition or diagnosis, your message, and any medical reports or scans you upload.</li>\n<li><strong>Consent records:</strong> when you gave consent and which version of the consent wording you saw.</li>\n<li><strong>Technical data:</strong> your IP address (stored with each enquiry to prevent spam and abuse), the page you submitted a form from, and basic browser information. If you accept cookies, analytics and marketing tools may also collect usage data (see section 9).</li>\n</ul>\n<p>Please share only the health information needed for your enquiry.</p>"),
    $sec('3. Why We Use Your Data', '<p>We use your personal data only for these purposes:</p>' . "\n" . $ul . "\n<li>To respond to your enquiry, call you back and arrange an appointment, online consultation or second opinion.</li>\n<li>To review medical reports that you send us for that purpose.</li>\n<li>To send you health articles and updates, only if you subscribe to our newsletter.</li>\n<li>To keep the website secure, prevent spam and abuse, and keep a record that consent was given.</li>\n<li>To understand how the website is used and improve it, only if you accept analytics cookies.</li>\n<li>To meet legal obligations and respond to lawful requests from authorities.</li>\n</ul>\n<p>We process your personal data on the basis of your consent. We process it without consent only where the DPDP Act allows this, for example to respond to a medical emergency or to comply with the law.</p>"),
    $sec('4. Your Consent and How to Withdraw It', '<p>You give consent by ticking the consent box on our forms (it is never pre-ticked) and by choosing “Accept” on the cookie banner. You can withdraw your consent at any time, as easily as you gave it:</p>' . "\n" . $ul . "\n<li>write to " . $a('mailto:{email}', '{email}') . " or call {phone} and ask us to stop using your data; or</li>\n<li>use “Cookie Settings” at the bottom of any page to change your cookie choice.</li>\n</ul>\n<p>When you withdraw consent we stop using your data for that purpose and delete it within a reasonable time, unless the law requires us to keep it. Withdrawal does not affect anything done before it. If you withdraw consent while an enquiry is open, we may not be able to complete it.</p>"),
    $sec('5. Your Rights', '<p>Under the DPDP Act you have the right to:</p>' . "\n" . $ul . "\n<li><strong>Access:</strong> a summary of the personal data we hold about you, how we use it, and who we have shared it with.</li>\n<li><strong>Correction, completion and updating</strong> of inaccurate or incomplete data.</li>\n<li><strong>Erasure</strong> of data that is no longer needed or for which you withdraw consent, unless the law requires us to keep it.</li>\n<li><strong>Grievance redressal</strong> (see section 11).</li>\n<li><strong>Nomination:</strong> to name another person who can exercise these rights for you if you die or become unable to do so.</li>\n</ul>\n<p>To use any of these rights, write to " . $a('mailto:{email}', '{email}') . '. We may ask you to confirm your identity before acting on a request. Please give accurate information and do not file false or frivolous complaints.</p>'),
    $sec('6. How Long We Keep Your Data', '<p>We keep enquiry data, including uploaded reports, only as long as needed to respond to your enquiry and follow up on it, and no longer than [ENQUIRY RETENTION PERIOD] after our last contact with you, unless the law requires a longer period. It is then deleted from our website systems. Newsletter details are kept until you unsubscribe. Consent records may be kept for as long as needed to show that consent was given. Medical records created when you are treated are kept for the periods required by applicable medical-records rules.</p>'),
    $sec('7. Who We Share Your Data With', '<p>We do not sell your personal data. We share it only as needed for the purposes above, with:</p>' . "\n" . $ul . "\n<li>our clinical and administrative team, to respond to your enquiry and arrange your care;</li>\n<li>service providers who process data for us under contract (Data Processors): our website hosting provider; Formester, which processes the details you submit on our forms; our email provider, for enquiry notifications; and, only if you accept cookies, Google (Google Tag Manager and the tags it loads);</li>\n<li>the hospital where you ask us to arrange an appointment or procedure;</li>\n<li>government bodies, courts or regulators where the law requires it.</li>\n</ul>\n<p>Some of these providers may store or process data outside India. Where this happens, it is done only as permitted under the DPDP Act.</p>"),
    $sec('8. Security and Data Breaches', '<p>We use reasonable security safeguards to protect your personal data, including encrypted (HTTPS) connections, access-restricted storage for enquiries and uploaded reports, and password-protected administration with limited staff access. No system is completely secure. If a personal data breach occurs, we will inform the Data Protection Board of India and the affected users as required by the DPDP Act and its rules.</p>'),
    $sec('9. Cookies and Third-Party Tools', '<p><strong>Essential:</strong> this website stores your cookie choice in your browser (local storage, key “dpg_consent”). It does not set its own tracking cookies.</p>' . "\n<p><strong>Only with your consent</strong> (loaded after you click “Accept”):</p>\n" . $ul . "\n<li>Google Tag Manager (container GTM-TF2TXQLK) and the tags it runs: [TAGS CONFIGURED IN GTM-TF2TXQLK]. These may set cookies to measure visits and advertising.</li>\n<li>Google Analytics 4 and the Meta Pixel, if they are switched on in the website settings.</li>\n<li>Embedded Instagram posts on the home page (Meta).</li>\n</ul>\n<p><strong>Other third-party content:</strong></p>\n" . $ul . "\n<li>YouTube videos are embedded in privacy-enhanced mode (youtube-nocookie.com); YouTube may set cookies when you play a video.</li>\n<li>Google Maps on the contact page, Google Fonts and Font Awesome (cdnjs) are loaded from third-party servers, which receive your IP address.</li>\n<li>The WhatsApp button opens WhatsApp (Meta); your chat is also covered by WhatsApp’s own terms and privacy policy.</li>\n</ul>\n<p>You can change your choice at any time with “Cookie Settings” at the bottom of every page, and you can clear cookies in your browser.</p>"),
    $sec('10. Children’s Data', '<p>This website is not directed at children. We do not knowingly collect personal data of anyone under 18 without verifiable consent from a parent or lawful guardian; parents and guardians should make enquiries about a child themselves. We do not track the behaviour of children or direct targeted advertising at them. If we learn that we hold a child’s data without such consent, we will delete it.</p>'),
    $sec('11. Grievance Officer and Data Requests', '<p>For questions, data requests or complaints about how we handle your personal data, contact our Grievance Officer:</p>' . "\n" . $ul . "\n<li><strong>Grievance Officer:</strong> [GRIEVANCE OFFICER NAME]</li>\n<li><strong>Email:</strong> " . $a('mailto:{email}', '{email}') . "</li>\n<li><strong>Phone:</strong> {phone}</li>\n<li><strong>Address:</strong> {address}</li>\n</ul>\n<p>We will acknowledge your request promptly and respond within 30 days. If you are not satisfied with our response, you may complain to the Data Protection Board of India.</p>"),
    $sec('12. Changes to This Policy', '<p><strong>Last updated: 21 November 2026.</strong> We may update this policy from time to time. The latest version will always be on this page with its “Last updated” date. If we make significant changes to how we use your data, we will announce them on this website and, where required, ask for your consent again.</p>'),
]) . "\n";

$MEDICAL_DISCLAIMER = implode("\n", [
    $sec('1. General Information Only', '<p>The information on this website, including articles, videos, FAQs and pages about conditions and treatments, is for general awareness only and is not a substitute for professional medical advice, diagnosis, or treatment. Please consult a qualified doctor about your own health.</p>'),
    $sec('2. No Doctor–Patient Relationship', '<p>Reading this website, sending an enquiry, or contacting us by phone, email or WhatsApp does not by itself create a doctor–patient relationship. Diagnosis and treatment decisions are made only after a proper consultation and, where needed, examination and tests.</p>'),
    $sec('3. Medical Emergencies', '<p>This website is not for emergencies. If you or someone near you has sudden signs of a stroke (face drooping, arm or leg weakness, difficulty speaking, loss of balance or vision), call the 24x7 Stroke Helpline on {stroke-helpline}, call an ambulance (108 / 112), or go to the nearest emergency department immediately.</p>'),
    $sec('4. Individual Results Vary', '<p>Every patient is different. Descriptions of conditions, procedures and treatments explain what is generally possible; they are not a promise or guarantee of any particular result. The benefits, risks and alternatives of any treatment should be discussed with your doctor.</p>'),
    $sec('5. Treatments and Procedures', '<p>Treatments and procedures mentioned on this website are offered only when clinically appropriate, after evaluation, and subject to applicable laws and hospital policies.</p>'),
    $sec('6. AI-Generated Content', '<p>Certain images, illustrations, or textual content on this website may be generated or assisted by artificial intelligence (AI). Such content is intended for informational and illustrative purposes only. AI-generated content is not intended to misrepresent actual patients, medical professionals, clinical outcomes, or healthcare services.</p>'),
    $sec('7. External Links and Media', '<p>Links to other websites, videos and news coverage are provided for convenience. We are not responsible for the content of external websites.</p>'),
    $sec('8. Accuracy and Updates', '<p>We try to keep the information on this website accurate and up to date, but medical knowledge changes and some content may not reflect the latest research. See also our ' . $a('privacy-policy', 'Privacy Policy') . ' and ' . $a('terms-of-service', 'Terms of Service') . '. <strong>Last updated: 21 November 2026.</strong></p>'),
]) . "\n";

$TERMS_RELATED = "\n" . $sec('8. Related Policies', '<p>Please also read our ' . $a('privacy-policy', 'Privacy Policy') . ', which explains how we handle personal data, and our ' . $a('medical-disclaimer', 'Medical Disclaimer') . '.</p>');

$MD_PAGE = [
    'slug' => 'medical-disclaimer',
    'file' => 'medical-disclaimer.php',
    'title' => 'Medical Disclaimer',
    'category' => 'Contact & Legal',
    'hero_badge' => '',
    'hero_title' => 'Medical Disclaimer',
    'hero_desc' => 'How to use the health information on this website, and what to do in an emergency.',
    'hero_bg' => '',
];

/* ---------------------------------------------------------------------------
 * Load
 * ------------------------------------------------------------------------- */
$files = [];
$iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dataDir, FilesystemIterator::SKIP_DOTS));
foreach ($iter as $file) {
    $rel = str_replace('\\', '/', substr($file->getPathname(), strlen($dataDir) + 1));
    if (substr($rel, -5) !== '.json' || strpos($rel, 'lead-uploads/') === 0 || in_array(basename($rel), SKIP_FILES, true)) {
        continue;
    }
    $decoded = json_decode((string)file_get_contents($file->getPathname()), true);
    if (!is_array($decoded)) {
        echo "skip (not JSON): $rel\n";
        continue;
    }
    $files[$rel] = $decoded;
}
ksort($files);
$original = $files;
$log = [];
$note = function ($msg) use (&$log) { $log[] = $msg; };
$retired = cms_retired_pages();

/* 1. Retired sections and pages ----------------------------------------------- */
$removedKeys = []; // slug => [block keys]
if (isset($files['page-blocks.json'])) {
    $pb = &$files['page-blocks.json'];
    foreach (array_keys($retired) as $slug) {
        if (isset($pb[$slug])) {
            unset($pb[$slug]);
            $note("page-blocks: removed retired page '$slug'");
        }
    }
    foreach ($pb as $slug => &$blocks) {
        if (!is_array($blocks)) continue;
        foreach ($blocks as $key => $block) {
            if (!is_array($block) || !isset($block['type'])) continue;
            if (cms_block_is_retired($block)) {
                unset($blocks[$key]);
                $removedKeys[$slug][] = $key;
                $note("page-blocks: removed $slug.$key ({$block['type']})");
                continue;
            }
        }
    }
    unset($blocks);

    // Privacy Policy (replaced only while it is still the pre-DPDP text, so edits
    // made afterwards — e.g. filling in the placeholders — are never overwritten),
    // Medical Disclaimer, Terms
    if (strpos((string)($pb['privacy-policy']['body']['text'] ?? ''), 'Digital Personal Data Protection Act') === false) {
        $pb['privacy-policy']['_flow'] = true;
        $pb['privacy-policy']['body'] = array_merge(['type' => 'richtext', 'label' => 'Policy text'], (array)($pb['privacy-policy']['body'] ?? []), ['text' => $PRIVACY_POLICY]);
        $note('page-blocks: installed DPDP Privacy Policy text');
    }
    if (!isset($pb['medical-disclaimer'])) {
        $pb['medical-disclaimer'] = ['_flow' => true, 'body' => ['type' => 'richtext', 'label' => 'Disclaimer text', 'text' => $MEDICAL_DISCLAIMER]];
        $note('page-blocks: added Medical Disclaimer page');
    }
    $terms = (string)($pb['terms-of-service']['body']['text'] ?? '');
    if ($terms !== '' && strpos($terms, 'medical-disclaimer') === false) {
        $pb['terms-of-service']['body']['text'] = rtrim($terms) . $TERMS_RELATED . "\n";
        $note('page-blocks: Terms of Service now link to the Privacy Policy and Medical Disclaimer');
    }
    unset($pb);
}

// Per-page saved data: drop overrides / layout entries of removed sections
foreach ($files as $rel => &$data) {
    if (!preg_match('#^pages/([a-z0-9_-]+)\.json$#i', $rel, $m)) continue;
    $slug = $m[1];
    $gone = $removedKeys[$slug] ?? [];
    if (isset($data['blocks']) && is_array($data['blocks'])) {
        foreach ($data['blocks'] as $key => $b) {
            $isRetired = is_array($b) && !empty($b['type']) && cms_block_is_retired($b);
            if ($isRetired || in_array($key, $gone, true)) {
                unset($data['blocks'][$key]);
                $note("$rel: removed saved section '$key'");
            }
        }
    }
    if (isset($data['layout']) && is_array($data['layout']) && !empty($gone)) {
        $before = count($data['layout']);
        $data['layout'] = array_values(array_filter($data['layout'], function ($e) use ($gone) {
            $k = is_array($e) ? (string)($e['key'] ?? '') : (string)$e;
            return !in_array($k, $gone, true);
        }));
        if (count($data['layout']) !== $before) $note("$rel: removed retired sections from the saved order");
    }
}
unset($data);
if (!isset($files['pages/medical-disclaimer.json'])) {
    $files['pages/medical-disclaimer.json'] = $MD_PAGE + ['breadcrumb_label' => 'Medical Disclaimer'];
    $note('pages/medical-disclaimer.json: created');
}

// Navigation: no links to retired pages; Medical Disclaimer in the footer legal links
if (isset($files['navigation.json'])) {
    $nav = &$files['navigation.json'];
    $clean = function (array $list) use (&$clean, $note) {
        $out = [];
        foreach ($list as $item) {
            if (is_array($item) && cms_is_retired_url($item['url'] ?? '')) {
                $note("navigation: removed link '" . ($item['label'] ?? '') . "'");
                continue;
            }
            if (is_array($item) && isset($item['children']) && is_array($item['children'])) {
                $item['children'] = $clean($item['children']);
            }
            $out[] = $item;
        }
        return $out;
    };
    foreach ($nav as $k => $v) {
        if (is_array($v) && array_keys($v) === range(0, count($v) - 1)) {
            $nav[$k] = $clean($v);
        }
    }
    $hasMd = false;
    foreach ((array)($nav['footer_legal_links'] ?? []) as $l) {
        if (trim((string)($l['url'] ?? ''), '/') === 'medical-disclaimer') $hasMd = true;
    }
    if (!$hasMd) {
        $nav['footer_legal_links'][] = ['label' => 'Medical Disclaimer', 'url' => 'medical-disclaimer'];
        $note('navigation: added Medical Disclaimer to the footer legal links');
    }
    unset($nav);
}

// Page catalog (CMS → All Pages, sitemap)
if (isset($files['pages_catalog.json'])) {
    $before = count($files['pages_catalog.json']);
    $files['pages_catalog.json'] = array_values(array_filter($files['pages_catalog.json'], function ($p) use ($retired) {
        return !is_array($p) || !isset($retired[$p['slug'] ?? '']);
    }));
    if (count($files['pages_catalog.json']) !== $before) $note('pages_catalog: removed ' . ($before - count($files['pages_catalog.json'])) . ' retired page(s)');
    $slugs = array_column($files['pages_catalog.json'], 'slug');
    if (!in_array('medical-disclaimer', $slugs, true)) {
        $files['pages_catalog.json'][] = $MD_PAGE;
        $note('pages_catalog: added Medical Disclaimer');
    }
}

/* 3. Phrase rewrites ---------------------------------------------------------- */
$rewriteCount = 0;
$rewrite = function ($value, $key) use (&$rewrite, $REWRITES, &$rewriteCount) {
    if (is_array($value)) {
        foreach ($value as $k => $v) {
            $value[$k] = $rewrite($v, $k);
        }
        return $value;
    }
    if (!is_string($value) || (is_string($key) && in_array($key, NO_REWRITE_KEYS, true))) {
        return $value;
    }
    foreach ($REWRITES as $pair) {
        if (strpos($value, $pair[0]) !== false) {
            $value = str_replace($pair[0], $pair[1], $value, $n);
            $rewriteCount += $n;
        }
    }
    return $value;
};
foreach ($files as $rel => $data) {
    if (in_array($rel, NO_REWRITE_FILES, true)) continue;
    $files[$rel] = $rewrite($data, null);
}
$note("phrase rewrites applied: $rewriteCount");

/* Write ----------------------------------------------------------------------- */
$changed = 0;
foreach ($files as $rel => $data) {
    if (isset($original[$rel]) && json_encode($original[$rel]) === json_encode($data)) continue;
    $changed++;
    echo ($dry ? 'would write: ' : 'write: ') . $rel . "\n";
    if (!$dry) {
        $path = $dataDir . '/' . $rel;
        if (!is_dir(dirname($path))) @mkdir(dirname($path), 0755, true);
        file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n", LOCK_EX);
    }
}
foreach ($log as $line) echo '  - ' . $line . "\n";
echo "$changed file(s) " . ($dry ? 'would change' : 'changed') . ".\n";

/* 5. Remaining audit terms --------------------------------------------------- */
$audit = '/\b(testimonial\w*|google reviews?|patient stories|discount|coupon|cashback|refer a friend|free consultation|free check-?up|limited time)\b/i';
// Kept on purpose: the Terms' own disclaimer wording.
$allow = '/make no guarantees/i';
$left = [];
$scan = function ($value, $path) use (&$scan, &$left, $audit, $allow) {
    if (is_array($value)) {
        foreach ($value as $k => $v) $scan($v, array_merge($path, [$k]));
        return;
    }
    if (!is_string($value) || in_array((string)end($path), NO_REWRITE_KEYS, true)) return;
    $plain = preg_replace($allow, '', $value);
    if (preg_match_all($audit, $plain, $m, PREG_OFFSET_CAPTURE)) {
        foreach ($m[0] as $hit) {
            $left[] = implode('.', $path) . ': …' . substr($plain, max(0, $hit[1] - 50), 120) . '…';
        }
    }
};
foreach ($files as $rel => $data) {
    if (in_array($rel, NO_REWRITE_FILES, true)) continue;
    // Saved data of retired pages is never shown (the URLs redirect).
    if (preg_match('#^pages/([a-z0-9_-]+)\.json$#i', $rel, $m) && isset($retired[$m[1]])) continue;
    $scan($data, [$rel]);
}
echo "\nRemaining audit terms (" . count($left) . ") — review by hand in the CMS:\n";
foreach ($left as $line) echo '  ' . str_replace(["\r", "\n"], ' ', $line) . "\n";

/* Sitemap -------------------------------------------------------------------- */
if (!$dry && realpath($dataDir) === realpath($root . '/data') && is_file($root . '/includes/generate-sitemap.php')) {
    require_once $root . '/includes/config.php';
    require_once $root . '/includes/generate-sitemap.php';
    if (function_exists('generate_sitemap_xml')) {
        generate_sitemap_xml();
        echo "sitemap.xml regenerated.\n";
    }
}
