<?php
/**
 * CMS-managed call-to-action buttons.
 *
 * Every button link that appears on the service / condition pages (hero
 * buttons, diagnosis CTA, "why choose" button, final CTA banner, emergency
 * banner, ...) is registered here together with its current copy and
 * destination. Defaults live in data/page-ctas.json; saved edits live in
 * data/pages/{slug}.json under "ctas" and are edited in CMS → All Pages
 * ("Call-to-Action Buttons" card).
 *
 * Templates read values with cms_page_cta() and print the URL with
 * cms_cta_href() so {phone} / {stroke-helpline} tokens stay live.
 */

if (!function_exists('cms_page_ctas_registry')) {
    /**
     * The default CTA definitions, keyed by CTA key, plus per-page overrides.
     */
    function cms_page_ctas_registry() {
        static $registry = null;
        if ($registry === null) {
            $file = (defined('CMS_DATA_DIR') ? CMS_DATA_DIR : dirname(__DIR__) . '/data') . '/page-ctas.json';
            $registry = ['defaults' => [], 'pages' => []];
            if (is_file($file)) {
                $raw = @file_get_contents($file);
                $data = ($raw !== false && trim($raw) !== '') ? json_decode($raw, true) : null;
                if (is_array($data)) {
                    if (isset($data['defaults']) && is_array($data['defaults'])) {
                        $registry['defaults'] = $data['defaults'];
                    }
                    if (isset($data['pages']) && is_array($data['pages'])) {
                        $registry['pages'] = $data['pages'];
                    }
                }
            }
        }
        return $registry;
    }
}

if (!function_exists('cms_page_cta_keys')) {
    /**
     * All CTA keys defined for a page, in registry order
     * (page-level overrides first, then the global defaults).
     */
    function cms_page_cta_keys($slug) {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);
        $registry = cms_page_ctas_registry();
        $keys = [];
        $pageDef = (isset($registry['pages'][$slug]) && is_array($registry['pages'][$slug])) ? $registry['pages'][$slug] : [];
        foreach ($pageDef as $key => $_) {
            if (is_string($key) && $key !== '') {
                $keys[$key] = true;
            }
        }
        foreach ($registry['defaults'] as $key => $_) {
            if (is_string($key) && $key !== '' && !isset($keys[$key])) {
                $keys[$key] = true;
            }
        }
        return array_keys($keys);
    }
}

if (!function_exists('cms_page_cta')) {
    /**
     * One merged CTA definition for a page: label / text / url / intro.
     * Page-specific overrides win over the global defaults.
     */
    function cms_page_cta($slug, $key) {
        $registry = cms_page_ctas_registry();
        $defaults = isset($registry['defaults'][$key]) && is_array($registry['defaults'][$key])
            ? $registry['defaults'][$key] : [];

        // Optional per-page default in the registry ({"pages": {"slug": {...}}}).
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);

        // Saved editor values live in data/pages/{slug}.json under "ctas".
        $saved = [];
        if (function_exists('get_page_content')) {
            $page = get_page_content($slug, []);
        } else {
            $dir = defined('CMS_DATA_DIR') ? CMS_DATA_DIR : dirname(__DIR__) . '/data';
            $file = $dir . '/pages/' . $slug . '.json';
            $page = [];
            if (is_file($file)) {
                $raw = @file_get_contents($file);
                $decoded = ($raw !== false && trim($raw) !== '') ? json_decode($raw, true) : null;
                if (is_array($decoded)) {
                    $page = $decoded;
                }
            }
        }
        // Per-page defaults from the registry ({"pages": {"slug": {...}}}).
        $pageDef = (isset($registry['pages'][$slug]) && is_array($registry['pages'][$slug]))
            ? $registry['pages'][$slug] : [];
        $pageDefault = (isset($pageDef[$key]) && is_array($pageDef[$key])) ? $pageDef[$key] : [];

        if (isset($page['ctas'][$key]) && is_array($page['ctas'][$key])) {
            $saved = $page['ctas'][$key];
        }

        $out = [
            'label' => (string)($saved['label'] ?? $pageDefault['label'] ?? $defaults['label'] ?? ucfirst(str_replace(['-', '_'], ' ', $key))),
            'text'  => (string)($saved['text'] ?? $pageDefault['text'] ?? $defaults['text'] ?? ''),
            'url'   => (string)($saved['url'] ?? $pageDefault['url'] ?? $defaults['url'] ?? ''),
            'intro' => (string)($saved['intro'] ?? $pageDefault['intro'] ?? $defaults['intro'] ?? ''),
            'note'  => (string)($saved['note'] ?? $pageDefault['note'] ?? $defaults['note'] ?? ''),
        ];
        return $out;
    }
}

if (!function_exists('cms_cta_text')) {
    /**
     * CTA label with live tokens expanded ({phone} / {stroke-helpline} print
     * the actual phone numbers, as in "Call Emergency: 1800-309-0247").
     */
    function cms_cta_text($slug, $key) {
        $cta = cms_page_cta($slug, $key);
        $text = (string)$cta['text'];
        if (stripos($text, '{phone}') !== false) {
            $text = str_ireplace('{phone}', defined('SITE_PHONE') ? SITE_PHONE : '', $text);
        }
        if (stripos($text, '{stroke-helpline}') !== false) {
            $text = str_ireplace('{stroke-helpline}', defined('STROKE_HELPLINE') ? STROKE_HELPLINE : '', $text);
        }
        return $text;
    }
}

if (!function_exists('cms_cta_href')) {
    /**
     * Resolve special URL tokens:
     *   {phone}            → tel:SITE_PHONE
     *   {stroke-helpline}  → tel:STROKE_HELPLINE
     * Plain anchors / pages / http(s) URLs pass through unchanged.
     */
    function cms_cta_href($url) {
        $url = trim((string)$url);
        if ($url === '') {
            return '#';
        }
        if (stripos($url, '{phone}') !== false) {
            $url = str_ireplace('{phone}', 'tel:' . (defined('SITE_PHONE') ? SITE_PHONE : ''), $url);
        }
        if (stripos($url, '{stroke-helpline}') !== false) {
            $url = str_ireplace('{stroke-helpline}', 'tel:' . (defined('STROKE_HELPLINE') ? STROKE_HELPLINE : ''), $url);
        }
        if (strncasecmp($url, 'tel:', 4) === 0 || strncasecmp($url, 'mailto:', 7) === 0) {
            return $url;
        }
        if (preg_match('#^(https?:)?//#i', $url) || preg_match('#^/#', $url)) {
            return $url;
        }
        return htmlspecialchars($url, ENT_QUOTES);
    }
}

if (!function_exists('cms_cta_button')) {
    /**
     * Convenience renderer: <a href><span>text</span>…</a> with optional icon
     * circle. Used by the final CTA banner and simple pill buttons.
     *
     * $options['class']       classes for the <a>
     * $options['badge']       small circular badge after the label (chevron/phone icon)
     * $options['raw_text']    print the label without escaping (for {phone} values)
     */
    function cms_cta_button($slug, $key, $options = []) {
        $cta = cms_page_cta($slug, $key);
        $href = cms_cta_href($cta['url']);
        if ($href === '#' && $cta['text'] === '') {
            return;
        }
        $class = trim((string)($options['class'] ?? ''));
        $text = htmlspecialchars($cta['text'], ENT_QUOTES);
        $raw = !empty($options['raw_text']);
        ?>
        <a href="<?php echo $href; ?>" class="<?php echo htmlspecialchars($class); ?>">
            <span><?php echo $raw ? (function_exists('cms_render_html') ? cms_render_html($cta['text']) : $text) : $text; ?></span>
            <?php if (!empty($options['badge_icon'])): ?>
            <span class="<?php echo htmlspecialchars($options['badge_class'] ?? 'w-7 h-7 rounded-full bg-white text-deep-indigo flex items-center justify-center text-[10px]'); ?>">
                <i class="fas <?php echo htmlspecialchars($options['badge_icon']); ?>"></i>
            </span>
            <?php endif; ?>
        </a>
        <?php
    }
}
