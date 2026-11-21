<?php
/**
 * DPDP Act 2023 + NMC compliance helpers.
 *
 * These live in code (not data/) so they apply to whatever content the CMS
 * holds, including live data merged back by scripts/merge-live-data.php:
 *
 *  - retired pages and section types: patient testimonials, reviews, ratings
 *    and case-study outcomes are not published (NMC advertising rules);
 *  - the privacy notice + consent checkbox every lead form must print;
 *  - footer legal links and the medical / AI-content disclaimers;
 *  - the cookie banner: GTM, GA4, Meta Pixel and social embeds load only
 *    after the visitor clicks Accept.
 *
 * Copy comes from CMS → Site Text (group "Compliance & consent").
 * Data-level clean-up (claims, retired sections, policy pages) is done by
 * scripts/compliance-dpdp-nmc.php.
 */

if (!defined('CMS_CONSENT_VERSION')) {
    // Bump when the consent wording or the tracker list changes: visitors are asked again.
    define('CMS_CONSENT_VERSION', '2026-11-21');
}

if (!function_exists('cms_retired_pages')) {
    /**
     * Pages that are no longer published => where their URL now points (301).
     */
    function cms_retired_pages() {
        return [
            'neurology-patient-testimonials' => 'patient-info',
            'patient-success-stories'        => 'patient-info',
            'patient-reviews'                => 'patient-info',
            'case-studies'                   => 'patient-info',
            'video-testimonials'             => 'neurology-video-library',
        ];
    }
}

if (!function_exists('cms_is_retired_url')) {
    /** True when a nav/CTA URL points at a retired page (slug, /slug, slug.php, absolute URL). */
    function cms_is_retired_url($url) {
        $path = strtolower(trim((string)$url));
        $path = preg_replace('#^https?://[^/]+#', '', $path);
        $path = preg_replace('/[?#].*$/', '', $path);
        $path = preg_replace('/\.php$/', '', trim($path, '/'));
        return $path !== '' && isset(cms_retired_pages()[$path]);
    }
}

if (!function_exists('cms_redirect_retired_page')) {
    /** Permanently redirect a retired page template to its replacement. */
    function cms_redirect_retired_page($slug) {
        $map = cms_retired_pages();
        $target = $map[$slug] ?? 'patient-info';
        header('Location: /' . $target, true, 301);
        exit;
    }
}

if (!function_exists('cms_block_is_retired')) {
    /**
     * Section types that must not render: patient testimonials (written and
     * video) and case-study outcome stories.
     */
    function cms_block_is_retired(array $block) {
        $type = (string)($block['type'] ?? '');
        if (in_array($type, ['testimonials', 'video-testimonials'], true)) {
            return true;
        }
        if ($type === 'collection-grid') {
            $collection = (string)($block['collection'] ?? ($block['options']['collection'] ?? ''));
            return $collection === 'case_studies';
        }
        return false;
    }
}

if (!function_exists('cms_compliance_site_name')) {
    function cms_compliance_site_name() {
        if (defined('SITE_NAME') && SITE_NAME !== '') {
            return SITE_NAME;
        }
        global $cmsSettings;
        return trim((string)($cmsSettings['site_name'] ?? '')) !== '' ? $cmsSettings['site_name'] : 'Dr. Praveen Gupta';
    }
}

if (!function_exists('cms_compliance_text')) {
    /**
     * Site Text value, HTML-escaped, with {site} and {privacy} (a link to the
     * Privacy Policy) filled in.
     */
    function cms_compliance_text($key, $linkClass = '') {
        $text = function_exists('cms_text') ? cms_text($key) : '';
        $text = str_replace('{site}', cms_compliance_site_name(), $text);
        $html = htmlspecialchars($text);
        if (strpos($html, '{privacy}') !== false) {
            $label = function_exists('cms_text') ? cms_text('privacy_link_label') : 'Privacy Policy';
            $link = '<a href="/privacy-policy" target="_blank" rel="noopener"' . ($linkClass !== '' ? ' class="' . htmlspecialchars($linkClass) . '"' : '') . '>' . htmlspecialchars($label) . '</a>';
            $html = str_replace('{privacy}', $link, $html);
        }
        return $html;
    }
}

if (!function_exists('cms_compliance_styles')) {
    /**
     * Styles for the consent fields, disclaimers and cookie banner. Printed
     * once in <head>; plain CSS because the compiled Tailwind file only holds
     * classes that existed when it was built.
     */
    function cms_compliance_styles() {
        static $printed = false;
        if ($printed) {
            return;
        }
        $printed = true;
        ?>
    <style>
        .dpg-consent{margin:0;text-align:left}
        .dpg-consent__notice{margin:0 0 .5rem;font-size:11px;line-height:1.6;color:rgba(17,24,39,.68)}
        .dpg-consent__row{display:flex;align-items:flex-start;gap:.6rem;margin:0;cursor:pointer;font-size:12px;line-height:1.6;font-weight:500;color:rgba(17,24,39,.85)}
        .dpg-consent__row input{flex-shrink:0;width:1rem;height:1rem;margin-top:.2rem;accent-color:#2563EB;cursor:pointer}
        .dpg-consent a{font-weight:600;text-decoration:underline;color:#2563EB}
        .dpg-consent--dark .dpg-consent__notice{color:rgba(255,255,255,.78)}
        .dpg-consent--dark .dpg-consent__row{color:rgba(255,255,255,.92)}
        .dpg-consent--dark .dpg-consent__row input{accent-color:#06B6D4}
        .dpg-consent--dark a{color:#67E8F9}
        .dpg-form-alert{margin:0 0 1.25rem;padding:.75rem 1rem;border-radius:.75rem;border:1px solid #FECACA;background:#FEF2F2;color:#B91C1C;font-size:13px;font-weight:600}
        .dpg-disclaimers{display:grid;gap:.6rem;padding:1.25rem 0;border-top:1px solid rgba(255,255,255,.1)}
        .dpg-disclaimers p{margin:0;font-size:12px;line-height:1.65;color:rgba(255,255,255,.8)}
        .dpg-disclaimers em{font-style:italic;font-weight:600;color:#fff}
        .dpg-disclaimers a{color:#67E8F9;text-decoration:underline}
        .dpg-cookie{display:none;position:fixed;left:1rem;right:1rem;bottom:1rem;z-index:70;max-width:46rem;margin:0 auto;padding:1rem 1.25rem;border:1px solid #E5E7EB;border-radius:1.25rem;background:#fff;color:#111827;box-shadow:0 12px 40px rgba(0,0,0,.18);font-family:inherit}
        .dpg-cookie.is-open{display:block}
        .dpg-cookie__text{margin:0 0 .75rem;font-size:13px;line-height:1.6}
        .dpg-cookie__text a{font-weight:600;text-decoration:underline;color:#2563EB}
        .dpg-cookie__actions{display:flex;flex-wrap:wrap;gap:.5rem}
        .dpg-cookie__btn{min-width:7rem;padding:.6rem 1.25rem;border-radius:9999px;border:1px solid #2563EB;font-size:13px;font-weight:700;cursor:pointer}
        .dpg-cookie__btn--accept{background:#2563EB;color:#fff}
        .dpg-cookie__btn--reject{background:#fff;color:#1E1B4B;border-color:#1E1B4B}
        .dpg-cookie-link{background:none;border:0;padding:0;font:inherit;color:inherit;cursor:pointer}
        @media (max-width:1023px){.dpg-cookie{bottom:5.75rem}}
    </style>
        <?php
    }
}

if (!function_exists('cms_consent_fields')) {
    /**
     * Privacy notice + required, unticked consent checkbox for a lead form.
     * $theme: 'light' | 'dark' (form on a dark card); $purpose: 'enquiry' | 'newsletter'.
     * api/save-lead.php rejects submissions without consent=yes.
     */
    function cms_consent_fields($uid, $theme = 'light', $purpose = 'enquiry') {
        $id = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$uid) . '-consent';
        $newsletter = $purpose === 'newsletter';
        ?>
                    <div class="dpg-consent<?php echo $theme === 'dark' ? ' dpg-consent--dark' : ''; ?>">
                        <p class="dpg-consent__notice"><?php echo cms_compliance_text($newsletter ? 'newsletter_privacy_notice' : 'form_privacy_notice'); ?></p>
                        <label class="dpg-consent__row" for="<?php echo $id; ?>">
                            <input type="checkbox" id="<?php echo $id; ?>" name="consent" value="yes" required>
                            <span><?php echo cms_compliance_text($newsletter ? 'newsletter_consent_label' : 'form_consent_label'); ?></span>
                        </label>
                    </div>
        <?php
    }
}

if (!function_exists('cms_form_error_notice')) {
    /** Message shown above a form when api/save-lead.php sent the visitor back with ?error=consent. */
    function cms_form_error_notice() {
        if (($_GET['error'] ?? '') !== 'consent') {
            return;
        }
        echo '<p class="dpg-form-alert" role="alert">' . cms_compliance_text('form_error_consent') . '</p>';
    }
}

if (!function_exists('cms_footer_legal_links')) {
    /**
     * Footer legal links (CMS → Navigation), always including Privacy Policy,
     * Terms and the Medical Disclaimer, never a retired page.
     */
    function cms_footer_legal_links() {
        $nav = function_exists('cms_navigation') ? cms_navigation() : [];
        $links = [];
        $have = [];
        foreach ((array)($nav['footer_legal_links'] ?? []) as $link) {
            if (!is_array($link) || cms_is_retired_url($link['url'] ?? '')) {
                continue;
            }
            $links[] = $link;
            $have[strtolower(preg_replace('/\.php$/', '', trim((string)($link['url'] ?? ''), '/')))] = true;
        }
        foreach ([['Privacy Policy', 'privacy-policy'], ['Terms of Service', 'terms-of-service'], ['Medical Disclaimer', 'medical-disclaimer']] as $req) {
            if (!isset($have[$req[1]])) {
                $links[] = ['label' => $req[0], 'url' => $req[1]];
            }
        }
        return $links;
    }
}

if (!function_exists('cms_render_legal_disclaimers')) {
    /** Medical + AI-generated-content disclaimers (footer of every page). */
    function cms_render_legal_disclaimers($class = '') {
        $more = function_exists('cms_text') ? cms_text('footer_medical_disclaimer_link') : '';
        ?>
        <div class="dpg-disclaimers<?php echo $class !== '' ? ' ' . htmlspecialchars($class) : ''; ?>">
            <p><em><?php echo cms_compliance_text('footer_medical_disclaimer_label'); ?></em> <?php echo cms_compliance_text('footer_medical_disclaimer'); ?><?php if ($more !== ''): ?> <a href="/medical-disclaimer"><?php echo htmlspecialchars($more); ?></a><?php endif; ?></p>
            <p><em><?php echo cms_compliance_text('footer_ai_disclaimer_label'); ?></em> <?php echo cms_compliance_text('footer_ai_disclaimer'); ?></p>
        </div>
        <?php
    }
}

if (!function_exists('cms_tracking_config')) {
    /** Non-essential trackers configured in CMS → Settings (loaded only after consent). */
    function cms_tracking_config() {
        global $cmsSettings;
        $gtm = defined('GTM_ID') ? trim((string)GTM_ID) : trim((string)($cmsSettings['gtm_id'] ?? ''));
        return [
            'gtm'   => preg_replace('/[^A-Za-z0-9_-]/', '', $gtm),
            'ga4'   => preg_replace('/[^A-Za-z0-9_-]/', '', trim((string)($cmsSettings['ga4_id'] ?? ''))),
            'pixel' => preg_replace('/[^0-9]/', '', trim((string)($cmsSettings['meta_pixel_id'] ?? ''))),
        ];
    }
}

if (!function_exists('cms_render_consent_loader')) {
    /**
     * <head> script: remembers the visitor's cookie choice and loads GTM / GA4 /
     * Meta Pixel only after Accept. Exposes window.dpgConsent:
     *   onAccept(fn) — run fn once consent is given (immediately if it already was)
     *   granted(), decided(), set('accepted'|'rejected'), open()
     */
    function cms_render_consent_loader() {
        $cfg = cms_tracking_config();
        cms_compliance_styles();
        ?>
    <!-- Consent-gated tags: GTM / GA4 / Meta Pixel load only after "Accept" (DPDP Act 2023) -->
    <script>
    (function (w, d) {
        var KEY = 'dpg_consent', VER = <?php echo json_encode(CMS_CONSENT_VERSION); ?>;
        var cfg = <?php echo json_encode($cfg); ?>;
        var state = null, loaded = false, queue = [];
        try { state = JSON.parse(w.localStorage.getItem(KEY) || 'null'); } catch (e) { state = null; }
        if (!state || state.ver !== VER) { state = null; }
        function add(src) { var s = d.createElement('script'); s.async = true; s.src = src; d.head.appendChild(s); }
        function loadTags() {
            if (loaded) { return; }
            loaded = true;
            w.dataLayer = w.dataLayer || [];
            if (cfg.gtm) {
                w.dataLayer.push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
                add('https://www.googletagmanager.com/gtm.js?id=' + encodeURIComponent(cfg.gtm));
            }
            if (cfg.ga4) {
                add('https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(cfg.ga4));
                w.gtag = w.gtag || function () { w.dataLayer.push(arguments); };
                w.gtag('js', new Date());
                w.gtag('config', cfg.ga4);
            }
            if (cfg.pixel) {
                !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(w,d,'script','https://connect.facebook.net/en_US/fbevents.js');
                w.fbq('init', cfg.pixel);
                w.fbq('track', 'PageView');
            }
            while (queue.length) { try { queue.shift()(); } catch (e) {} }
        }
        w.dpgConsent = {
            granted: function () { return !!state && state.v === 'accepted'; },
            decided: function () { return !!state; },
            onAccept: function (fn) { if (loaded) { fn(); } else { queue.push(fn); } },
            set: function (v) {
                var had = this.granted();
                state = {v: v === 'accepted' ? 'accepted' : 'rejected', ver: VER, t: new Date().toISOString()};
                try { w.localStorage.setItem(KEY, JSON.stringify(state)); } catch (e) {}
                if (state.v === 'accepted') { loadTags(); } else if (had) { w.location.reload(); }
            },
            open: function () { var b = d.getElementById('dpg-cookie'); if (b) { b.classList.add('is-open'); } }
        };
        if (w.dpgConsent.granted()) { loadTags(); }
    })(window, document);
    </script>
        <?php
    }
}

if (!function_exists('cms_render_cookie_banner')) {
    /**
     * Cookie banner (Accept / Reject / Privacy Policy). Shown until the visitor
     * chooses; "Cookie Settings" links ([data-dpg-cookie-settings]) reopen it.
     * Printed only when something non-essential can load.
     */
    function cms_render_cookie_banner() {
        $cfg = cms_tracking_config();
        if ($cfg['gtm'] === '' && $cfg['ga4'] === '' && $cfg['pixel'] === '' && empty($GLOBALS['cms_needs_consent'])) {
            return;
        }
        ?>
    <div id="dpg-cookie" class="dpg-cookie" role="dialog" aria-modal="false" aria-labelledby="dpg-cookie-text">
        <p id="dpg-cookie-text" class="dpg-cookie__text"><?php echo cms_compliance_text('cookie_banner_text'); ?></p>
        <div class="dpg-cookie__actions">
            <button type="button" class="dpg-cookie__btn dpg-cookie__btn--accept" data-dpg-consent="accepted"><?php echo htmlspecialchars(cms_text('cookie_accept_label')); ?></button>
            <button type="button" class="dpg-cookie__btn dpg-cookie__btn--reject" data-dpg-consent="rejected"><?php echo htmlspecialchars(cms_text('cookie_reject_label')); ?></button>
        </div>
    </div>
    <script>
    (function () {
        var banner = document.getElementById('dpg-cookie');
        if (!banner || !window.dpgConsent) { return; }
        if (!window.dpgConsent.decided()) { banner.classList.add('is-open'); }
        banner.addEventListener('click', function (e) {
            var choice = e.target && e.target.getAttribute('data-dpg-consent');
            if (choice) { banner.classList.remove('is-open'); window.dpgConsent.set(choice); }
        });
        document.querySelectorAll('[data-dpg-cookie-settings]').forEach(function (el) {
            el.addEventListener('click', function (e) { e.preventDefault(); banner.classList.add('is-open'); });
        });
    })();
    </script>
        <?php
    }
}
