<?php
/**
 * CMS-managed editable page blocks.
 *
 * Hard-coded sections such as "How We Operate" (cards) and "What to Expect"
 * (numbered steps) can be edited in CMS -> All Pages. Defaults live in
 * data/page-blocks.json; saved edits live in data/pages/{slug}.json under
 * "blocks". Templates render them with cms_render_page_block().
 */

if (!function_exists('cms_page_blocks_defaults')) {
    /**
     * All default block definitions, keyed by page slug then block key.
     */
    function cms_page_blocks_defaults($slug = null) {
        static $all = null;
        if ($all === null) {
            $file = (defined('CMS_DATA_DIR') ? CMS_DATA_DIR : dirname(__DIR__) . '/data') . '/page-blocks.json';
            $all = [];
            if (is_file($file)) {
                $raw = @file_get_contents($file);
                $data = ($raw !== false && trim($raw) !== '') ? json_decode($raw, true) : null;
                if (is_array($data)) {
                    $all = $data;
                }
            }
        }
        if ($slug === null) {
            return $all;
        }
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);
        return isset($all[$slug]) && is_array($all[$slug]) ? $all[$slug] : [];
    }
}

if (!function_exists('cms_page_blocks')) {
    /**
     * Defaults merged with editor overrides for one page.
     *
     * data/page-blocks.json may carry an "_shared" entry with copies of blocks
     * that are identical on many pages ("why-choose-us", "doctor"). A shared
     * default is applied to a page only when its "pages" list contains that
     * slug (or has no list at all); page-specific defaults always win.
     */
    function cms_page_blocks($slug) {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);
        $all = cms_page_blocks_defaults();
        $shared = (isset($all['_shared']) && is_array($all['_shared'])) ? $all['_shared'] : [];
        $defaults = cms_page_blocks_defaults($slug);

        $applicable = [];
        foreach ($shared as $key => $def) {
            if (!is_array($def)) {
                continue;
            }
            $pages = isset($def['pages']) && is_array($def['pages']) ? $def['pages'] : [];
            if (($pages === [] || in_array($slug, $pages, true)) && !isset($defaults[$key])) {
                $applicable[$key] = $def;
            }
        }
        $defaults = $applicable + $defaults;

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
        $saved = (is_array($page) && isset($page['blocks']) && is_array($page['blocks'])) ? $page['blocks'] : [];

        // A page entry may reference a shared block by position with
        // {"use": "_shared"} (or {"use": "_shared", "key": "doctor"}).
        foreach ($defaults as $key => $def) {
            if (is_array($def) && isset($def['use']) && $def['use'] === '_shared') {
                $sharedKey = $def['key'] ?? $key;
                if (isset($shared[$sharedKey]) && is_array($shared[$sharedKey])) {
                    $resolved = $shared[$sharedKey];
                    unset($resolved['pages']);
                    unset($def['use'], $def['key']);
                    $defaults[$key] = array_merge($resolved, $def);
                } else {
                    unset($defaults[$key]);
                }
            }
        }

        $blocks = [];
        foreach ($defaults as $key => $default) {
            if (!is_array($default) || (is_string($key) && $key !== '' && $key[0] === '_')) {
                continue;
            }
            $override = (isset($saved[$key]) && is_array($saved[$key])) ? $saved[$key] : [];
            $block = array_merge($default, array_filter($override, function ($v) { return $v !== null; }));
            // Use the saved items only when the editor actually kept some.
            if (isset($override['items']) && is_array($override['items'])) {
                $block['items'] = array_values(array_filter($override['items'], 'is_array'));
            }
            $blocks[$key] = $block;
        }
        // Blocks the editor added to this page (not in the defaults) carry
        // their own "type"; they join the list and are positioned by "layout".
        foreach ($saved as $key => $sb) {
            if (!isset($blocks[$key]) && is_array($sb) && !empty($sb['type'])) {
                $sb['added'] = true;
                $blocks[$key] = $sb;
            }
        }
        return $blocks;
    }
}

if (!function_exists('cms_page_layout')) {
    /**
     * Ordered section list for a page: [['key' => ..., 'hidden' => bool], ...].
     * Saved order lives in data/pages/{slug}.json → "layout"; otherwise the
     * order of the block definitions. Blocks missing from a saved layout are
     * appended so nothing silently disappears.
     */
    function cms_page_layout($slug, ?array $blocks = null) {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);
        if ($blocks === null) {
            $blocks = cms_page_blocks($slug);
        }
        $page = function_exists('get_page_content') ? get_page_content($slug, []) : [];
        $saved = (isset($page['layout']) && is_array($page['layout'])) ? $page['layout'] : [];
        $layout = [];
        $seen = [];
        foreach ($saved as $entry) {
            $key = is_array($entry) ? (string)($entry['key'] ?? '') : (string)$entry;
            if ($key === '' || !isset($blocks[$key]) || isset($seen[$key])) {
                continue;
            }
            $layout[] = ['key' => $key, 'hidden' => is_array($entry) && !empty($entry['hidden'])];
            $seen[$key] = true;
        }
        foreach ($blocks as $key => $b) {
            // Nested blocks (e.g. key-facts inside the intro) are rendered by
            // their parent, never as a top-level section.
            if (!isset($seen[$key]) && empty($b['nested'])) {
                $layout[] = ['key' => $key, 'hidden' => false];
                $seen[$key] = true;
            }
        }
        return $layout;
    }
}

if (!function_exists('cms_page_uses_flow')) {
    /**
     * True when the page's block definitions were converted to the ordered
     * flow (marker "_flow": true in data/page-blocks.json).
     */
    function cms_page_uses_flow($slug) {
        $defs = cms_page_blocks_defaults($slug);
        return !empty($defs['_flow']);
    }
}

if (!function_exists('cms_block_wrap_open')) {
    /**
     * Section wrapper printed around a block by the flow renderer. Controlled
     * by the block's "wrap" option: false/"none" = block prints its own
     * <section>; otherwise ['bg' => 'bg-white', 'padding' => 'py-12',
     * 'container' => 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8', 'class' => '',
     * 'id' => ''].
     */
    function cms_block_wrap_open(array $block) {
        $wrap = $block['wrap'] ?? [];
        if ($wrap === false || $wrap === 'none') {
            return false;
        }
        if (!is_array($wrap)) {
            $wrap = [];
        }
        $bg = (string)($wrap['bg'] ?? 'bg-white');
        $padding = (string)($wrap['padding'] ?? 'py-12');
        $extra = (string)($wrap['class'] ?? '');
        $container = array_key_exists('container', $wrap) ? $wrap['container'] : 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8';
        $id = trim((string)($wrap['id'] ?? ''));
        echo '<section' . ($id !== '' ? ' id="' . htmlspecialchars($id) . '"' : '') . ' class="' . htmlspecialchars(trim($padding . ' ' . $bg . ' ' . $extra)) . '">';
        if ($container) {
            echo '<div class="' . htmlspecialchars((string)$container) . '">';
        }
        return $container ? 2 : 1;
    }
}

if (!function_exists('cms_block_wrap_close')) {
    function cms_block_wrap_close($opened) {
        if ($opened === false) {
            return;
        }
        if ($opened === 2) {
            echo '</div>';
        }
        echo '</section>';
    }
}

if (!function_exists('cms_render_block_cta_key')) {
    /**
     * Centered intro line + gradient button for a block's "cta_key" option
     * (e.g. the diagnosis section button).
     */
    function cms_render_block_cta_key($slug, $key, array $options = []) {
        if (!$slug || !function_exists('cms_page_cta')) {
            return;
        }
        $cta = cms_page_cta($slug, $key);
        if (trim($cta['text']) === '') {
            return;
        }
        ?>
        <div class="<?php echo htmlspecialchars($options['cta_wrapper'] ?? 'text-center'); ?>">
            <?php if (trim($cta['intro']) !== ''): ?>
            <p class="text-dark-grey/70 mb-6"><?php echo $cta['intro']; ?></p>
            <?php endif; ?>
            <a href="<?php echo cms_cta_href($cta['url']); ?>" class="<?php echo htmlspecialchars($options['cta_class'] ?? 'inline-flex items-center space-x-3 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold px-8 py-4 rounded-full hover:shadow-xl hover:shadow-electric-blue/30 transition-all duration-300 transform hover:-translate-y-1'); ?>">
                <span><?php echo cms_cta_text($slug, $key); ?></span>
                <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
        <?php
    }
}

if (!function_exists('cms_render_page_flow')) {
    /**
     * Render every visible section of a page in its saved order. Templates
     * call this once between their hero and the footer include.
     */
    function cms_render_page_flow($slug, array $options = []) {
        global $cmsCurrentPageSlug;
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);
        $blocks = cms_page_blocks($slug);
        $layout = cms_page_layout($slug, $blocks);
        $previous = $cmsCurrentPageSlug ?? null;
        $cmsCurrentPageSlug = $slug;
        try {
            foreach ($layout as $entry) {
                if (!empty($entry['hidden']) || !isset($blocks[$entry['key']])) {
                    continue;
                }
                $block = $blocks[$entry['key']];
                $type = $block['type'] ?? 'cards';
                // Blocks that print their own <section>
                $selfWrapped = in_array($type, ['doctor', 'cta', 'faq', 'video-testimonials', 'related-videos', 'banner-slider', 'richtext-page', 'collection-grid', 'testimonials', 'team-grid', 'blog-grid', 'services-grid', 'reels', 'video-player', 'form', 'map', 'stats', 'text-media', 'strip', 'quote', 'slideshow', 'contact-cards', 'hero-plain'], true)
                    || (($block['wrap'] ?? null) === false) || (($block['wrap'] ?? null) === 'none');
                $opened = $selfWrapped ? false : cms_block_wrap_open($block);
                cms_render_page_block($slug, $entry['key']);
                cms_block_wrap_close($opened);
            }
        } finally {
            $cmsCurrentPageSlug = $previous;
        }
        if (empty($options['no_sections'])) {
            // Legacy "Additional Page Sections" + automatic FAQ keep working.
            $GLOBALS['cms_page_section_used'] = true;
        }
    }
}

if (!function_exists('cms_render_block_intro')) {
    /**
     * "What is X" split section: badge / heading / paragraphs (+ an optional
     * nested facts block) beside a 4:3 photo. Copy comes from the page's
     * section1_* fields (CMS → Main Body Section), falling back to the block's
     * own defaults — exactly like the old get_page_section() templates.
     */
    function cms_render_block_intro(array $block, array $options = [], $slug = null) {
        global $cmsCurrentPageSlug;
        $slug = $slug ?: $cmsCurrentPageSlug;
        $page = function_exists('get_page_content') ? get_page_content($slug, []) : [];
        $section = cms_section_resolve(is_array($page) ? $page : [], [
            'badge' => $block['badge'] ?? '',
            'title' => $block['title'] ?? '',
            'text' => $block['text'] ?? ($block['description'] ?? ''),
            'image' => $block['image'] ?? '',
            'image_alt' => $block['image_alt'] ?? '',
        ]);
        $GLOBALS['cms_page_section_used'] = true;
        $image = cms_media_path($section['image'], $block['image'] ?? '');
        $imageSide = $options['image_side'] ?? 'right';
        $factsKey = trim((string)($options['facts_key'] ?? ''));
        $layout = $options['layout'] ?? 'split';
        $badgeClass = $options['badge_class'] ?? 'text-electric-blue font-semibold text-sm uppercase tracking-wider';

        if ($layout === 'centered') {
            // Centered header (+ optional wide image) with a nested block grid below.
            ?>
        <div class="text-center max-w-3xl mx-auto mb-12">
            <?php if ($section['badge'] !== ''): ?>
            <span class="<?php echo htmlspecialchars($options['badge_class'] ?? 'text-electric-blue font-bold text-xs uppercase tracking-wider'); ?>"><?php echo htmlspecialchars($section['badge']); ?></span>
            <?php endif; ?>
            <?php if ($section['title'] !== ''): ?>
            <h2 class="<?php echo htmlspecialchars($options['title_class'] ?? 'text-3xl font-bold text-deep-indigo font-serif mt-2'); ?>"><?php echo htmlspecialchars($section['title']); ?></h2>
            <?php endif; ?>
            <?php echo cms_section_paragraphs($section['text'], $options['text_class'] ?? 'text-sm text-dark-grey/65 mt-3 leading-relaxed', 'mb-0'); ?>
        </div>
        <?php if ($image !== ''): ?>
        <div class="max-w-3xl mx-auto -mt-4 mb-10 rounded-3xl overflow-hidden shadow-lg border border-slate-200/50">
            <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($section['image_alt']); ?>" class="w-full h-auto object-cover" loading="lazy">
        </div>
        <?php endif; ?>
        <?php if ($factsKey !== '' && $slug) cms_render_page_block($slug, $factsKey); ?>
            <?php
            return;
        }

        if ($layout === 'sidebar') {
            // Narrow copy column (+ nested block) beside a wide side block.
            $asideKey = trim((string)($options['aside_key'] ?? ''));
            ?>
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <?php if ($section['badge'] !== ''): ?>
                    <span class="<?php echo htmlspecialchars($options['badge_class'] ?? 'text-red-600 font-bold text-xs uppercase tracking-wider'); ?>"><?php echo htmlspecialchars($section['badge']); ?></span>
                    <?php endif; ?>
                    <?php if ($section['title'] !== ''): ?>
                    <h2 class="<?php echo htmlspecialchars($options['title_class'] ?? 'text-3xl font-bold text-dark-grey mt-2 mb-4'); ?>"><?php echo htmlspecialchars($section['title']); ?></h2>
                    <?php endif; ?>
                    <?php echo cms_section_paragraphs($section['text'], $options['text_class'] ?? 'text-sm text-dark-grey/65 leading-relaxed', 'mb-0'); ?>
                    <?php if ($image !== ''): ?>
                    <div class="mt-4 rounded-2xl overflow-hidden border border-slate-200/60">
                        <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($section['image_alt']); ?>" class="w-full h-auto object-cover" loading="lazy">
                    </div>
                    <?php endif; ?>
                </div>
                <?php if ($factsKey !== '' && $slug) cms_render_page_block($slug, $factsKey); ?>
            </div>
            <?php if ($asideKey !== '' && $slug) cms_render_page_block($slug, $asideKey); ?>
        </div>
            <?php
            return;
        }

        $textOrder = $imageSide === 'left' ? 'lg:order-2' : '';
        $imgOrder = $imageSide === 'left' ? 'lg:order-1' : '';
        ?>
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left <?php echo $textOrder; ?>">
                <?php if ($section['badge'] !== ''): ?>
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($section['badge']); ?></span>
                <?php endif; ?>
                <?php if ($section['title'] !== ''): ?>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($section['title']); ?></h2>
                <?php endif; ?>
                <?php echo cms_section_paragraphs($section['text']); ?>
                <?php if ($factsKey !== '' && $slug): ?>
                <?php cms_render_page_block($slug, $factsKey); ?>
                <?php endif; ?>
            </div>
            <?php if ($image !== ''): ?>
            <div class="relative flex justify-center lg:justify-end animate-slide-in-right <?php echo $imgOrder; ?>">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/3] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey border border-silver-grey/20">
                    <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($section['image_alt']); ?>" class="w-full h-full object-cover" loading="lazy">
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }
}

if (!function_exists('cms_render_block_include')) {
    /**
     * Virtual blocks that wrap the shared includes so they can be ordered /
     * hidden like any other section: faq, video-testimonials, related-videos.
     */
    function cms_render_block_include(array $block, array $options = [], $slug = null) {
        global $cmsCurrentPageSlug;
        $slug = $slug ?: $cmsCurrentPageSlug;
        $type = $block['type'] ?? '';
        $root = dirname(__DIR__) . '/includes/';
        // The shared includes were written for page scope: give them every
        // global ($videoTestimonials, $cmsSettings, $services, ...).
        extract($GLOBALS, EXTR_SKIP);
        if ($type === 'faq') {
            $faqSlug = trim((string)($block['faq_slug'] ?? '')) !== '' ? $block['faq_slug'] : $slug;
            require $root . 'faq-section.php';
            return;
        }
        if ($type === 'video-testimonials') {
            if (trim((string)($block['badge'] ?? '')) !== '') $vtEyebrow = $block['badge'];
            if (trim((string)($block['title'] ?? '')) !== '') $vtHeading = $block['title'];
            if (trim((string)($block['description'] ?? '')) !== '') $vtIntro = $block['description'];
            if (!empty($options['limit'])) $vtLimit = (int)$options['limit'];
            if (array_key_exists('show_cta', $options)) $vtShowCta = (bool)$options['show_cta'];
            if (!empty($options['theme'])) $vtTheme = $options['theme'];
            require $root . 'video-testimonials.php';
            return;
        }
        if ($type === 'related-videos') {
            if (trim((string)($block['badge'] ?? '')) !== '') $relatedVideosEyebrow = $block['badge'];
            if (trim((string)($block['title'] ?? '')) !== '') $relatedVideosHeading = $block['title'];
            if (trim((string)($block['description'] ?? '')) !== '') $relatedVideosIntro = $block['description'];
            $currentPage = $slug;
            require $root . 'related-videos.php';
            return;
        }
    }
}

if (!function_exists('cms_page_block')) {
    function cms_page_block($slug, $key) {
        $blocks = cms_page_blocks($slug);
        return isset($blocks[$key]) ? $blocks[$key] : null;
    }
}

if (!function_exists('cms_block_color')) {
    /**
     * Map a short colour name to the Tailwind classes used by the templates.
     */
    function cms_block_color($color) {
        switch ($color) {
            case 'cyan-accent':
                return ['bg-cyan-accent/10', 'group-hover:bg-cyan-accent', 'text-cyan-accent'];
            case 'deep-indigo':
                return ['bg-deep-indigo/10', 'group-hover:bg-deep-indigo', 'text-deep-indigo'];
            case 'red':
                return ['bg-red-50', 'group-hover:bg-red-600', 'text-red-600'];
            case 'dark':
                return ['bg-dark-grey/10', 'group-hover:bg-dark-grey', 'text-dark-grey'];
            case 'electric-blue':
            default:
                return ['bg-electric-blue/10', 'group-hover:bg-electric-blue', 'text-electric-blue'];
        }
    }
}

if (!function_exists('cms_section_resolve')) {
    /**
     * Resolve the effective "Main Body Section" copy for a page.
     *
     * The catalog generator seeded every page with placeholder copy such as
     * "Expert Clinical Approach to ...". Those values must not replace the
     * real section that is hard-coded in a template, otherwise every page
     * turns into generic boilerplate. A saved field is used only once an
     * editor has changed it; empty/placeholder fields fall back to the
     * template's built-in defaults.
     *
     * Used by get_page_section() on the frontend and by the page editor so
     * the CMS shows exactly the copy that is live.
     */
    function cms_section_resolve(array $saved, array $defaults = []) {
        $defaults = array_merge([
            'badge' => '',
            'title' => '',
            'text' => '',
            'image' => '',
            'image_alt' => '',
        ], is_array($defaults) ? $defaults : []);

        $badge = trim((string)($saved['section1_badge'] ?? ''));
        $title = trim((string)($saved['section1_title'] ?? ''));
        $text  = trim((string)($saved['section1_text'] ?? ''));
        $image = trim((string)($saved['section1_image'] ?? ''));
        $imageAlt = trim((string)($saved['section1_img_alt'] ?? ''));

        $titlePlain = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($title), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
        $textPlain  = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8')));

        $titleIsPlaceholder = ($title === '' || strpos($titlePlain, 'Expert Clinical Approach to ') === 0);
        $textIsPlaceholder  = ($text === '' || strpos($textPlain, 'Dr. Praveen Gupta provides world-class diagnostic evaluation and cutting-edge treatments for ') === 0);
        // Breadcrumb banners are hero images, not 4:3 body photos.
        $imageIsPlaceholder = ($image === '' || strpos($image, 'assets/breadcrumbs/') === 0);

        if ($titleIsPlaceholder) $title = $defaults['title'];
        if ($textIsPlaceholder)  $text  = $defaults['text'];
        if ($imageIsPlaceholder) $image = $defaults['image'];
        $genericBadges = ['Specialist Care', 'General Guide', 'Conditions Guide', 'Services Guide', 'Patient Info Guide'];
        if ($badge === '' || in_array($badge, $genericBadges, true)) {
            $badge = $defaults['badge'];
        }
        if ($imageAlt === '') $imageAlt = $defaults['image_alt'];

        return [
            'badge' => $badge,
            'title' => $title,
            'text' => $text,
            'image' => $image,
            'image_alt' => $imageAlt,
        ];
    }
}

if (!function_exists('cms_render_block_header')) {
    function cms_render_block_header(array $block, $margin = 'mb-16', $titleClass = '', $align = 'center', $badgeClass = 'text-electric-blue font-semibold text-sm uppercase tracking-wider') {
        $badge = trim((string)($block['badge'] ?? ''));
        $title = trim((string)($block['title'] ?? ''));
        $desc  = trim((string)($block['description'] ?? ''));
        $titleClass = $titleClass !== '' ? $titleClass : 'text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6';
        if ($badge === '' && $title === '' && $desc === '') {
            return;
        }
        ?>
        <div class="<?php echo $align === 'left' ? '' : 'text-center max-w-3xl mx-auto '; echo htmlspecialchars($margin); ?>">
            <?php if ($badge !== ''): ?>
            <span class="<?php echo htmlspecialchars($badgeClass); ?>"><?php if (!empty($block['badge_icon'])): ?><i class="fas <?php echo htmlspecialchars(trim((string)$block['badge_icon'])); ?> mr-2"></i><?php endif; ?><?php echo htmlspecialchars($badge); ?></span>
            <?php endif; ?>
            <?php if ($title !== ''): ?>
            <h2 class="<?php echo htmlspecialchars($titleClass); ?>"><?php echo htmlspecialchars($title); ?></h2>
            <?php endif; ?>
            <?php if ($desc !== ''): ?>
            <p class="text-dark-grey/70 leading-relaxed"><?php echo htmlspecialchars($desc); ?></p>
            <?php endif; ?>
        </div>
        <?php
    }
}

if (!function_exists('cms_render_block_cards')) {
    /**
     * Icon + heading + paragraph + tag pills. Matches the existing service
     * page card grids.
     */
    function cms_render_block_cards(array $block, array $options = []) {
        $grid = $options['grid'] ?? 'grid md:grid-cols-2 lg:grid-cols-3 gap-6';
        cms_render_block_header(
            $block,
            $options['header_margin'] ?? 'mb-16',
            $options['title_class'] ?? '',
            $options['header_align'] ?? 'center',
            $options['badge_class'] ?? 'text-electric-blue font-semibold text-sm uppercase tracking-wider'
        );

        $items = is_array($block['items'] ?? null) ? $block['items'] : [];
        if (empty($items)) {
            return;
        }
        $hoverBorder = $options['hover_border'] ?? 'hover:border-electric-blue/20';
        $cardClass = trim((string)($options['card_class'] ?? ''));
        if ($cardClass === '') {
            $cardClass = 'bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg ' . $hoverBorder . ' transition-all duration-300 group';
        }
        $itemTitleClass = $options['item_title_class'] ?? 'text-lg font-bold text-dark-grey mb-3';
        $itemTextClass = $options['item_text_class'] ?? 'text-sm text-dark-grey/60 leading-relaxed mb-4';
        ?>
        <div class="<?php echo htmlspecialchars($grid); ?>">
            <?php foreach ($items as $item): ?>
            <?php
                $color = $item['color'] ?? 'electric-blue';
                list($bgClass, $hoverBg, $textClass) = cms_block_color($color);
                $icon = trim((string)($item['icon'] ?? 'fa-check'));
                $itemTitle = trim((string)($item['title'] ?? ''));
                $itemText = trim((string)($item['text'] ?? ''));
                $tags = $item['tags'] ?? [];
                if (is_string($tags)) {
                    $tags = array_filter(array_map('trim', explode(',', $tags)));
                }
            ?>
            <div class="<?php echo htmlspecialchars($cardClass); ?>">
                <?php $itemBadge = trim((string)($item['badge'] ?? '')); ?>
                <?php if ($itemBadge !== ''): ?>
                <span class="block text-4xl font-black <?php echo $textClass; ?> mb-2"><?php echo htmlspecialchars($itemBadge); ?></span>
                <?php endif; ?>
                <?php if ($icon !== 'none'): ?>
                <div class="w-14 h-14 <?php echo $bgClass; ?> rounded-xl flex items-center justify-center mb-5 <?php echo $hoverBg; ?> transition-all duration-300">
                    <i class="fas <?php echo htmlspecialchars($icon); ?> <?php echo $textClass; ?> text-xl group-hover:text-white transition-colors"></i>
                </div>
                <?php endif; ?>
                <h3 class="<?php echo htmlspecialchars($itemTitleClass); ?>"><?php echo htmlspecialchars($itemTitle); ?></h3>
                <?php $itemSub = trim((string)($item['subtitle'] ?? '')); ?>
                <?php if ($itemSub !== ''): ?>
                <p class="text-xs font-semibold uppercase tracking-wider <?php echo $textClass; ?>/70 mb-2"><?php echo htmlspecialchars($itemSub); ?></p>
                <?php endif; ?>
                <p class="<?php echo htmlspecialchars($itemTextClass); ?>"><?php echo htmlspecialchars($itemText); ?></p>
                <?php
                    $cardBullets = $item['bullets'] ?? [];
                    if (is_string($cardBullets)) {
                        $cardBullets = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $cardBullets)));
                    }
                ?>
                <?php if (!empty($cardBullets)): ?>
                <ul class="space-y-2 text-sm text-dark-grey/70 mb-4">
                    <?php foreach ($cardBullets as $bullet): ?>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-check text-electric-blue/60 text-xs"></i>
                        <span><?php echo htmlspecialchars(trim((string)$bullet)); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php if (!empty($tags)): ?>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($tags as $tag): ?>
                    <span class="text-xs <?php echo $bgClass; ?> <?php echo $textClass; ?> px-3 py-1 rounded-full font-medium"><?php echo htmlspecialchars(trim((string)$tag)); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

if (!function_exists('cms_render_block_steps')) {
    /**
     * Numbered step cards with optional chevron connectors.
     */
    function cms_render_block_steps(array $block, array $options = []) {
        $grid = $options['grid'] ?? 'grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16';
        $cardBg = $options['card_bg'] ?? 'bg-slate-50';
        $arrow = array_key_exists('arrow', $options) ? (bool)$options['arrow'] : true;
        $numberBg = $options['number_bg'] ?? 'bg-electric-blue';
        cms_render_block_header($block, $options['header_margin'] ?? 'mb-16');

        $items = is_array($block['items'] ?? null) ? $block['items'] : [];
        if (empty($items)) {
            return;
        }
        $total = count($items);
        ?>
        <div class="<?php echo htmlspecialchars($grid); ?>">
            <?php foreach (array_values($items) as $i => $item): ?>
            <div class="relative">
                <div class="<?php echo htmlspecialchars($cardBg); ?> rounded-2xl p-6 border border-silver-grey/20 h-full">
                    <div class="w-12 h-12 <?php echo htmlspecialchars($numberBg); ?> text-white rounded-xl flex items-center justify-center font-bold text-lg mb-5"><?php echo (int)$i + 1; ?></div>
                    <h3 class="text-lg font-bold text-dark-grey mb-3"><?php echo htmlspecialchars(trim((string)($item['title'] ?? ''))); ?></h3>
                    <p class="text-sm text-dark-grey/60 leading-relaxed mb-4"><?php echo htmlspecialchars(trim((string)($item['text'] ?? ''))); ?></p>
                    <?php
                        $bullets = $item['bullets'] ?? [];
                        if (is_string($bullets)) {
                            $bullets = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $bullets)));
                        }
                    ?>
                    <?php if (!empty($bullets)): ?>
                    <ul class="space-y-2 text-sm text-dark-grey/70">
                        <?php foreach ($bullets as $bullet): ?>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-clipboard-list text-electric-blue/60 text-xs"></i>
                            <span><?php echo htmlspecialchars(trim((string)$bullet)); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <?php if ($arrow && $i < $total - 1): ?>
                <div class="hidden lg:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-electric-blue/30">
                    <i class="fas fa-chevron-right text-xl"></i>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

if (!function_exists('cms_block_bullets')) {
    /**
     * Normalize an item's "bullets" value (array or newline text) to a list.
     */
    function cms_block_bullets($bullets) {
        if (is_string($bullets)) {
            $bullets = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $bullets)));
        }
        return is_array($bullets) ? array_values(array_filter(array_map('trim', $bullets), function ($b) {
            return (string)$b !== '';
        })) : [];
    }
}

if (!function_exists('cms_block_image_html')) {
    /**
     * A rounded, shadowed 4:3 image used inside split sections.
     */
    function cms_block_image_html(array $block, $alt = '') {
        $src = trim((string)($block['image'] ?? ''));
        if ($src === '' || !function_exists('cms_media_path')) {
            return;
        }
        $resolved = cms_media_path($src);
        if ($resolved === '') {
            // Remote URLs pass through untouched.
            $resolved = preg_match('#^(https?:)?//#i', $src) ? $src : '';
        }
        if ($resolved === '') {
            return;
        }
        $alt = trim((string)($block['image_alt'] ?? '')) !== '' ? $block['image_alt'] : $alt;
        ?>
        <img src="<?php echo htmlspecialchars($resolved); ?>" alt="<?php echo htmlspecialchars((string)$alt); ?>"
             loading="lazy" class="w-full aspect-[4/3] object-cover rounded-3xl shadow-xl border border-silver-grey/20">
        <?php
    }
}

if (!function_exists('cms_render_block_facts')) {
    /**
     * Compact icon + bold label + small description grid ("Key Facts").
     * Rendered without the standard section header by default, because the
     * facts sit inside the page's main body section.
     */
    function cms_render_block_facts(array $block, array $options = []) {
        $grid = $options['grid'] ?? 'grid grid-cols-2 gap-4';
        if (!empty($options['show_header'])) {
            cms_render_block_header($block, $options['header_margin'] ?? 'mb-10');
        }
        $items = is_array($block['items'] ?? null) ? $block['items'] : [];
        if (empty($items)) {
            return;
        }
        ?>
        <div class="<?php echo htmlspecialchars($grid); ?>">
            <?php foreach ($items as $item): $icon = trim((string)($item['icon'] ?? 'fa-check')); ?>
            <?php list($factBg, , $factText) = cms_block_color($item['color'] ?? 'electric-blue'); ?>
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8<?php echo $icon !== '' ? ' ' . $factBg . ' rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5' : ' hidden'; ?>">
                    <i class="fas <?php echo htmlspecialchars($icon !== '' ? $icon : 'fa-check'); ?> <?php echo $factText; ?> text-xs"></i>
                </div>
                <div>
                    <div class="font-semibold text-dark-grey text-sm"><?php echo htmlspecialchars(trim((string)($item['title'] ?? ''))); ?></div>
                    <div class="text-xs text-dark-grey/60"><?php echo htmlspecialchars(trim((string)($item['text'] ?? ''))); ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

if (!function_exists('cms_render_block_warning')) {
    /**
     * Red "seek emergency care" alert panel with short warning lines.
     */
    function cms_render_block_warning(array $block, array $options = []) {
        $title = trim((string)($block['title'] ?? ''));
        $desc  = trim((string)($block['description'] ?? ''));
        $items = is_array($block['items'] ?? null) ? array_values($block['items']) : [];
        if ($title === '' && empty($items)) {
            return;
        }
        ?>
        <div class="<?php echo htmlspecialchars($options['wrapper'] ?? 'mt-12 bg-white rounded-2xl p-8 border border-silver-grey/20'); ?>">
            <div class="flex items-start space-x-4 mb-6">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas <?php echo htmlspecialchars($block['icon'] ?? 'fa-triangle-exclamation'); ?> text-red-500 text-lg"></i>
                </div>
                <div>
                    <?php if ($title !== ''): ?>
                    <h4 class="text-lg font-bold text-dark-grey"><?php echo htmlspecialchars($title); ?></h4>
                    <?php endif; ?>
                    <?php if ($desc !== ''): ?>
                    <p class="text-sm text-dark-grey/60 mt-1"><?php echo htmlspecialchars($desc); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php foreach ($items as $item): ?>
                <div class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-circle text-red-400 text-[6px]"></i>
                    <?php $warn = trim((string)($item['text'] ?? $item['title'] ?? '')); ?>
                    <span class="text-dark-grey/80"><?php echo function_exists('cms_render_html') ? cms_render_html($warn) : htmlspecialchars($warn); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('cms_render_block_symptoms')) {
    /**
     * Split section: photo on one side, symptomgroups (icon + title +
     * bullet list) plus an optional pill row on the other.
     */
    function cms_render_block_symptoms(array $block, array $options = []) {
        $items = is_array($block['items'] ?? null) ? array_values($block['items']) : [];
        $tags = cms_block_bullets($block['tags'] ?? []);
        $text = trim((string)($block['description'] ?? ''));
        if (empty($items) && $text === '' && empty($tags)) {
            return;
        }
        $image = trim((string)($block['image'] ?? ''));
        ?>
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <?php if ($image !== ''): ?>
            <!-- Image -->
            <div class="relative order-2 lg:order-1">
                <div class="rounded-[32px] overflow-hidden shadow-xl">
                    <?php $remote = preg_match('#^(https?:)?//#i', $image); ?>
                    <img src="<?php echo htmlspecialchars($remote ? $image : (cms_media_path($image) ?: $image)); ?>"
                         alt="<?php echo htmlspecialchars(trim((string)($block['image_alt'] ?? '')) !== '' ? $block['image_alt'] : 'Symptoms'); ?>"
                         loading="lazy" class="w-full h-auto">
                </div>
                <!-- Decorative accents -->
                <div class="absolute -top-6 -left-6 w-32 h-32 bg-electric-blue/10 rounded-2xl -z-10"></div>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-cyan-accent/10 rounded-2xl -z-10"></div>
            </div>
            <?php endif; ?>

            <!-- Content -->
            <div class="order-1 <?php echo $image !== '' ? 'lg:order-2' : ''; ?>">
                <?php cms_render_block_header($block, 'mb-8'); ?>
                <?php if ($text !== ''): ?>
                <p class="text-dark-grey/70 leading-relaxed mb-8"><?php echo htmlspecialchars($text); ?></p>
                <?php endif; ?>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <?php foreach ($items as $item):
                        list($bgClass, $hoverBg, $textClass) = cms_block_color($item['color'] ?? 'electric-blue');
                    ?>
                    <div class="bg-[#edf5f9] rounded-xl p-4">
                        <div class="flex items-center space-x-3 mb-3">
                            <i class="fas <?php echo htmlspecialchars(trim((string)($item['icon'] ?? 'fa-check'))); ?> <?php echo $textClass; ?>"></i>
                            <span class="font-semibold text-dark-grey text-sm"><?php echo htmlspecialchars(trim((string)($item['title'] ?? ''))); ?></span>
                        </div>
                        <ul class="space-y-2 text-sm text-dark-grey/70">
                            <?php foreach (cms_block_bullets($item['bullets'] ?? []) as $bullet): ?>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-check <?php echo $textClass; ?>/60 text-[10px]"></i>
                                <span><?php echo htmlspecialchars($bullet); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php $noteTitle = trim((string)($block['note_title'] ?? '')); ?>
                <?php $noteText = trim((string)($block['note_text'] ?? '')); ?>
                <?php if ($noteTitle !== '' || $noteText !== ''): ?>
                <div class="bg-electric-blue/5 border border-electric-blue/20 rounded-xl p-4">
                    <?php if ($noteTitle !== ''): ?>
                    <div class="flex items-start space-x-3 mb-3">
                        <i class="fas <?php echo htmlspecialchars(trim((string)($block['note_icon'] ?? 'fa-info-circle'))); ?> text-electric-blue mt-0.5"></i>
                        <span class="font-semibold text-dark-grey text-sm"><?php echo htmlspecialchars($noteTitle); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ($noteText !== ''): ?>
                    <p class="text-xs text-dark-grey/60 leading-relaxed"><?php echo htmlspecialchars($noteText); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($tags)): ?>
                <div class="<?php echo htmlspecialchars($options['tags_wrapper'] ?? 'bg-electric-blue/5 border border-electric-blue/20 rounded-xl p-4'); ?>">
                    <?php if (trim((string)($block['tags_title'] ?? '')) !== ''): ?>
                    <div class="flex items-center space-x-3 mb-3">
                        <i class="fas <?php echo htmlspecialchars($block['tags_icon'] ?? 'fa-eye'); ?> <?php echo $options['tags_icon_class'] ?? 'text-electric-blue'; ?>"></i>
                        <span class="font-semibold text-dark-grey text-sm"><?php echo htmlspecialchars(trim((string)$block['tags_title'])); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($tags as $tag): ?>
                        <span class="text-xs bg-white border border-electric-blue/20 px-3 py-1.5 rounded-full text-dark-grey/70"><?php echo htmlspecialchars($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('cms_render_block_treatments')) {
    /**
     * Large two-column treatment cards: icon block, title, sub-text,
     * paragraph and a checklist. Matches the existing "Treatment Options"
     * sections on the condition pages.
     */
    function cms_render_block_treatments(array $block, array $options = []) {
        $items = is_array($block['items'] ?? null) ? array_values($block['items']) : [];
        cms_render_block_header($block, $options['header_margin'] ?? 'mb-16');
        if (empty($items)) {
            return;
        }
        $gradients = [
            'electric-blue' => ['from-electric-blue/5 to-cyan-accent/5', 'border-electric-blue/10', 'bg-electric-blue', 'text-electric-blue'],
            'cyan-accent'   => ['from-cyan-accent/5 to-electric-blue/5', 'border-cyan-accent/10', 'bg-cyan-accent', 'text-cyan-accent'],
            'deep-indigo'   => ['from-deep-indigo/5 to-electric-blue/5', 'border-deep-indigo/10', 'bg-deep-indigo', 'text-deep-indigo'],
            'red'           => ['from-red-50 to-white', 'border-red-200/50', 'bg-red-600', 'text-red-600'],
            'dark'          => ['from-silver-grey/30 to-white', 'border-silver-grey/40', 'bg-dark-grey', 'text-dark-grey'],
        ];
        ?>
        <div class="grid lg:grid-cols-2 gap-8 <?php echo htmlspecialchars($options['grid_margin'] ?? 'mb-16'); ?>">
            <?php foreach ($items as $item):
                $color = $item['color'] ?? 'electric-blue';
                if (!isset($gradients[$color])) $color = 'electric-blue';
                list($gradBg, $gradBorder, $iconBg, $accent) = $gradients[$color];
            ?>
            <div class="bg-gradient-to-br <?php echo $gradBg; ?> rounded-[24px] p-8 border <?php echo $gradBorder; ?>">
                <div class="flex items-start space-x-5 mb-6">
                    <div class="w-16 h-16 <?php echo $iconBg; ?> rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas <?php echo htmlspecialchars(trim((string)($item['icon'] ?? 'fa-check'))); ?> text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-grey mb-2"><?php echo htmlspecialchars(trim((string)($item['title'] ?? ''))); ?></h3>
                        <?php $sub = trim((string)($item['subtitle'] ?? '')); ?>
                        <?php if ($sub !== ''): ?>
                        <p class="text-sm text-dark-grey/60"><?php echo htmlspecialchars($sub); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php $body = trim((string)($item['text'] ?? '')); ?>
                <?php if ($body !== ''): ?>
                <p class="text-dark-grey/70 leading-relaxed mb-6"><?php echo htmlspecialchars($body); ?></p>
                <?php endif; ?>
                <?php $bullets = cms_block_bullets($item['bullets'] ?? []); ?>
                <?php if (!empty($bullets)): ?>
                <ul class="space-y-3">
                    <?php foreach ($bullets as $bullet): ?>
                    <li class="flex items-start space-x-3">
                        <div class="w-6 h-6 <?php echo $accent; ?>/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check <?php echo $accent; ?> text-[10px]"></i>
                        </div>
                        <span class="text-sm text-dark-grey/80"><?php echo htmlspecialchars($bullet); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

if (!function_exists('cms_render_block_why_choose')) {
    /**
     * "Why Choose Dr. Praveen Gupta?" split section with a 2×2 feature grid
     * and one call-to-action button (edited in the page's CTA registry).
     */
    function cms_render_block_why_choose(array $block, array $options = [], $slug = null) {
        global $cmsCurrentPageSlug;
        $slug = $slug ?: $cmsCurrentPageSlug;
        $items = is_array($block['items'] ?? null) ? array_values($block['items']) : [];
        $desc = trim((string)($block['description'] ?? ''));
        if (empty($items) && $desc === '') {
            return;
        } ?>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Content Side -->
            <div class="lg:col-span-6 observe">
                <?php $badge = trim((string)($block['badge'] ?? '')); ?>
                <?php if ($badge !== ''): ?>
                <span class="text-xs font-bold tracking-wider text-dark-grey/60 uppercase block mb-3 font-sans">
                    <?php echo htmlspecialchars($badge); ?>
                </span>
                <?php endif; ?>
                <?php $title = trim((string)($block['title'] ?? '')); ?>
                <?php if ($title !== ''): ?>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo leading-tight mb-6">
                    <?php echo htmlspecialchars($title); ?>
                </h2>
                <?php endif; ?>
                <?php if ($desc !== ''): ?>
                <p class="text-base text-dark-grey/70 mb-10 leading-relaxed max-w-lg">
                    <?php echo htmlspecialchars($desc); ?>
                </p>
                <?php endif; ?>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 <?php echo htmlspecialchars($options['features_margin'] ?? 'mb-12'); ?>">
                    <?php foreach ($items as $item): ?>
                    <?php list(, , $whyText) = cms_block_color($item['color'] ?? 'electric-blue'); ?>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="<?php echo preg_match('/^fa/', trim((string)($item['icon'] ?? 'fa-award'))) ? 'fa-solid' : 'fas'; ?> <?php echo htmlspecialchars(trim((string)($item['icon'] ?? 'fa-award'))); ?> text-xl <?php echo $whyText; ?>"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif"><?php echo htmlspecialchars(trim((string)($item['title'] ?? ''))); ?></h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed"><?php echo htmlspecialchars(trim((string)($item['text'] ?? ''))); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($slug && function_exists('cms_page_cta') && cms_page_cta($slug, 'why-choose')['text'] !== ''): ?>
                <div>
                    <a href="<?php echo cms_cta_href(cms_page_cta($slug, 'why-choose')['url']); ?>"
                       class="inline-flex items-center px-8 py-3.5 bg-[#111827] text-white text-sm font-bold rounded-full hover:bg-electric-blue transition-colors duration-300 shadow-lg shadow-dark-grey/10">
                        <?php echo htmlspecialchars(cms_page_cta($slug, 'why-choose')['text']); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <!-- Image Side -->
            <?php if (trim((string)($block['image'] ?? '')) !== ''): ?>
            <div class="lg:col-span-6 relative flex justify-center lg:justify-end observe">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[3/4] rounded-[32px] overflow-hidden shadow-2xl bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <?php $whyImg = trim((string)$block['image']); $whyRemote = preg_match('#^(https?:)?//#i', $whyImg); ?>
                    <img src="<?php echo htmlspecialchars($whyRemote ? $whyImg : (cms_media_path($whyImg) ?: $whyImg)); ?>"
                         alt="<?php echo htmlspecialchars(trim((string)($block['image_alt'] ?? '')) !== '' ? $block['image_alt'] : 'Compassionate Care'); ?>"
                         loading="lazy" class="w-full h-full object-cover">
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }
}

if (!function_exists('cms_render_block_related')) {
    /**
     * Link cards to related services / conditions, title-right-arrow layout.
     */
    function cms_render_block_related(array $block, array $options = []) {
        $items = is_array($block['items'] ?? null) ? array_values($block['items']) : [];
        cms_render_block_header($block, $options['header_margin'] ?? 'mb-12');
        if (empty($items)) {
            return;
        }
        $grid = $options['grid'] ?? 'grid md:grid-cols-2 lg:grid-cols-4 gap-6';
        ?>
        <div class="<?php echo htmlspecialchars($grid); ?>">
            <?php foreach ($items as $item): $href = cms_cta_href($item['url'] ?? ''); ?>
            <a href="<?php echo htmlspecialchars($href !== '' ? $href : '#'); ?>"
               class="group bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300">
                <h3 class="font-bold text-dark-grey mb-2 group-hover:text-electric-blue transition-colors"><?php echo htmlspecialchars(trim((string)($item['title'] ?? ''))); ?></h3>
                <p class="text-sm text-dark-grey/60"><?php echo htmlspecialchars(trim((string)($item['text'] ?? ''))); ?></p>
            </a>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

if (!function_exists('cms_render_block_doctor')) {
    /**
     * "Meet the Specialist" profile card (identical across service pages).
     */
    function cms_render_block_doctor(array $block, array $options = []) {
        global $cmsCurrentPageSlug;
        $slug = $cmsCurrentPageSlug ?? null;
        $sectionBadge = trim((string)($block['badge'] ?? 'Expert Leadership'));
        $sectionTitle = trim((string)($block['title'] ?? 'Meet the Specialist'));
        $role = trim((string)($block['role'] ?? ''));
        $name = trim((string)($block['name'] ?? ''));
        $text = trim((string)($block['text'] ?? ''));
        $links = is_array($block['items'] ?? null) ? array_values($block['items']) : [];
        $image = trim((string)($block['image'] ?? 'assets/dpg-1.webp'));
        if (($block['layout'] ?? 'profile') === 'about') {
            ?>
            <section id="about-doctor" class="py-16 <?php echo htmlspecialchars($options['bg'] ?? 'bg-white'); ?> border-t border-silver-grey/40">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                        <div class="lg:col-span-5 relative observe">
                            <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-xl bg-gradient-to-br from-soft-cyan to-silver-grey">
                                <img src="<?php echo htmlspecialchars(cms_media_path($image, $image)); ?>" alt="<?php echo htmlspecialchars(trim((string)($block['image_alt'] ?? 'Dr. Praveen Gupta'))); ?>" class="w-full h-full object-cover">
                            </div>
                        </div>

                        <div class="lg:col-span-7 observe">
                            <?php if (trim((string)($block['badge'] ?? '')) !== ''): ?>
                            <span class="text-xs font-bold tracking-wider text-dark-grey/60 uppercase block mb-3 font-sans">
                                <?php echo htmlspecialchars(trim((string)$block['badge'])); ?>
                            </span>
                            <?php endif; ?>
                            <?php if (trim((string)($block['title'] ?? '')) !== ''): ?>
                            <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo leading-tight mb-4">
                                <?php echo htmlspecialchars(trim((string)$block['title'])); ?>
                            </h2>
                            <?php endif; ?>

                            <?php $appointments = cms_block_bullets($block['roles'] ?? []); ?>
                            <?php if (!empty($appointments)): ?>
                            <div class="flex flex-col space-y-2.5 mb-6">
                                <?php $roleIcons = array_merge(['fa-award', 'fa-chart-line', 'fa-lightbulb'], array_fill(0, max(0, count($appointments)), 'fa-certificate')); ?>
                                <?php foreach ($appointments as $ri => $role): ?>
                                <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                                    <i class="fa-solid <?php echo htmlspecialchars($roleIcons[$ri] ?? 'fa-certificate'); ?> text-cyan-accent flex-shrink-0 text-base"></i>
                                    <span><?php echo htmlspecialchars($role); ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>

                            <?php echo cms_section_paragraphs($text, 'text-sm text-dark-grey/85 leading-relaxed', 'mb-4'); ?>

                            <?php if ($slug !== null && function_exists('cms_page_cta') && cms_page_cta($slug, 'doctor-more')['text'] !== ''): ?>
                            <div>
                                <a href="<?php echo cms_cta_href(cms_page_cta($slug, 'doctor-more')['url']); ?>" class="inline-flex items-center space-x-4 border-2 border-dark-grey px-6 py-2.5 rounded-full hover:bg-dark-grey hover:text-white transition-all duration-300 group">
                                    <span class="text-xs font-bold text-dark-grey group-hover:text-white transition-colors duration-300"><?php echo htmlspecialchars(cms_page_cta($slug, 'doctor-more')['text']); ?></span>
                                    <div class="w-8 h-8 rounded-full bg-dark-grey text-white flex items-center justify-center text-xs group-hover:bg-white group-hover:text-dark-grey transition-colors duration-300 flex-shrink-0">
                                        <i class="fas fa-arrow-right -rotate-45 transition-transform duration-300"></i>
                                    </div>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            return;
        }
        ?>
        <section class="py-16 <?php echo htmlspecialchars($options['bg'] ?? 'bg-white'); ?> border-t border-b border-silver-grey/40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-electric-blue font-bold text-xs uppercase tracking-wider"><?php echo htmlspecialchars($sectionBadge); ?></span>
                    <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2"><?php echo htmlspecialchars($sectionTitle); ?></h2>
                </div>

                <div class="max-w-4xl mx-auto <?php echo htmlspecialchars($options['card_bg'] ?? 'bg-slate-50'); ?> border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="grid md:grid-cols-12 gap-8 items-center p-8">
                        <div class="md:col-span-4 aspect-[4/5] rounded-2xl overflow-hidden relative shadow-md bg-gradient-to-br from-deep-indigo to-electric-blue p-0.5">
                            <div class="relative w-full h-full rounded-[0.9rem] overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent">
                                <img src="<?php echo htmlspecialchars(cms_media_path($image, $image)); ?>" alt="<?php echo htmlspecialchars(trim((string)($block['image_alt'] ?? 'Dr. Praveen Gupta'))); ?>" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="md:col-span-8 space-y-4">
                            <?php if ($role !== ''): ?>
                            <span class="text-cyan-accent font-bold text-xs uppercase tracking-widest"><?php echo htmlspecialchars($role); ?></span>
                            <?php endif; ?>
                            <?php if ($name !== ''): ?>
                            <h3 class="text-2xl font-bold text-deep-indigo font-serif"><?php echo htmlspecialchars($name); ?></h3>
                            <?php endif; ?>
                            <?php echo cms_section_paragraphs($text, 'text-sm text-dark-grey/70 leading-relaxed font-light', 'mb-0'); ?>
                            <div class="flex flex-wrap gap-4 pt-2">
                                <?php foreach ($links as $i => $link): ?>
                                <?php if ($i > 0): ?><span class="text-slate-300">|</span><?php endif; ?>
                                <a href="<?php echo htmlspecialchars(cms_cta_href($link['url'] ?? '#')); ?>"
                                   class="text-xs font-semibold text-electric-blue hover:underline">
                                    <?php echo htmlspecialchars(trim((string)($link['title'] ?? ''))); ?>
                                    <i class="fas fa-arrow-right text-[10px] ml-1"></i>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

if (!function_exists('cms_render_block_cta')) {
    /**
     * Final gradient CTA banner. Buttons come from the page CTA registry
     * (final-primary / final-secondary) so text and destinations are editable
     * in CMS → All Pages → Call-to-Action Buttons.
     */
    function cms_render_block_cta(array $block, array $options = [], $slug = null) {
        global $cmsCurrentPageSlug;
        $slug = $slug ?: $cmsCurrentPageSlug;
        $title = trim((string)($block['title'] ?? ''));
        $text  = trim((string)($block['description'] ?? ''));
        if ($title === '' || $slug === null || !function_exists('cms_page_cta')) {
            return;
        }
        $primary = cms_page_cta($slug, 'final-primary');
        $secondary = cms_page_cta($slug, 'final-secondary');
        ?>
        <section class="relative py-12 <?php echo htmlspecialchars($options['bg'] ?? 'bg-white overflow-hidden'); ?>">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="relative bg-gradient-to-r from-electric-blue to-cyan-accent rounded-[36px] overflow-hidden shadow-2xl p-8 md:p-14 lg:p-16">
                    <div class="absolute -right-64 top-1/2 -translate-y-1/2 w-[850px] h-[850px] flex items-center justify-center pointer-events-none z-0">
                        <div class="absolute w-[850px] h-[850px] bg-white/[0.03] rounded-full"></div>
                        <div class="absolute w-[720px] h-[720px] bg-white/[0.05] rounded-full"></div>
                        <div class="absolute w-[590px] h-[590px] bg-white/[0.07] rounded-full"></div>
                        <div class="absolute w-[460px] h-[460px] bg-white/[0.09] rounded-full"></div>
                        <div class="absolute w-[330px] h-[330px] bg-white/[0.11] rounded-full"></div>
                        <div class="absolute w-[200px] h-[200px] bg-white/[0.13] rounded-full"></div>
                        <div class="absolute w-[70px]  h-[70px]  bg-white/[0.15] rounded-full"></div>
                    </div>

                    <div class="relative z-10 max-w-2xl text-left">
                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-sans font-extrabold text-white mb-4 leading-tight tracking-tight">
                            <?php echo htmlspecialchars($title); ?>
                        </h2>
                        <?php if ($text !== ''): ?>
                        <p class="text-white/85 text-sm md:text-base mb-10 max-w-lg leading-relaxed">
                            <?php echo htmlspecialchars($text); ?>
                        </p>
                        <?php endif; ?>

                        <div class="flex flex-wrap gap-4 items-center">
                            <?php if ($primary['text'] !== ''): ?>
                            <a href="<?php echo cms_cta_href($primary['url']); ?>" class="inline-flex items-center space-x-6 bg-[#111827] text-white text-xs md:text-sm font-semibold pl-6 pr-2.5 py-2.5 rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:-translate-y-0.5 active:translate-y-0 group">
                                <span><?php echo function_exists('cms_render_html') ? cms_render_html($primary['text']) : htmlspecialchars($primary['text']); ?></span>
                                <span class="w-7 h-7 rounded-full bg-gradient-to-b from-white via-slate-100 to-slate-400 shadow-[inset_0_1px_2px_rgba(255,255,255,0.8),0_2px_4px_rgba(0,0,0,0.3)] flex items-center justify-center text-[#111827] text-xs font-bold transition-transform duration-300 group-hover:scale-110 flex-shrink-0">
                                    <i class="fas fa-chevron-right text-[9px]"></i>
                                </span>
                            </a>
                            <?php endif; ?>
                            <?php if ($secondary['text'] !== '' && preg_match('/^tel:/i', cms_cta_href($secondary['url']))): ?>
                            <a href="<?php echo cms_cta_href($secondary['url']); ?>" class="inline-flex items-center space-x-6 bg-[#111827] text-white text-xs md:text-sm font-semibold pl-6 pr-2.5 py-2.5 rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:-translate-y-0.5 active:translate-y-0 group">
                                <span><?php echo function_exists('cms_render_html') ? cms_render_html($secondary['text']) : htmlspecialchars($secondary['text']); ?></span>
                                <span class="w-7 h-7 rounded-full bg-gradient-to-b from-white via-slate-100 to-slate-400 shadow-[inset_0_1px_2px_rgba(255,255,255,0.8),0_2px_4px_rgba(0,0,0,0.3)] flex items-center justify-center text-[#111827] text-xs font-bold transition-transform duration-300 group-hover:scale-110 flex-shrink-0">
                                    <i class="fas fa-phone text-[9px]"></i>
                                </span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

if (!function_exists('cms_render_block_notice')) {
    /**
     * Alert / call-out panel: optional sub-badge + heading + text, a bullet
     * list of flags and an optional side card ("24/7 Emergency Support").
     */
    function cms_render_block_notice(array $block, array $options = [], $slug = null) {
        global $cmsCurrentPageSlug;
        $slug = $slug ?: $cmsCurrentPageSlug;
        $items = is_array($block['items'] ?? null) ? array_values($block['items']) : [];
        $text = trim((string)($block['description'] ?? ''));
        if (empty($items) && $text === '') {
            return;
        }
        $numbered = !empty($options['numbered']);
        $layout = $options['layout'] ?? 'full';

        /**
         * One alert point: numbered chip or icon, plus basic-HTML text.
         */
        $renderItem = function (array $item, $index) use ($numbered, $options) {
            $itemTextClass = trim((string)($options['item_text_class'] ?? ''));
            ?>
            <div class="flex items-start <?php echo $numbered ? 'space-x-3 p-4 ' . htmlspecialchars($options['numbered_item_class'] ?? 'bg-slate-50 rounded-2xl') : 'space-x-3'; ?>">
                <?php if ($numbered): ?>
                <span class="<?php echo htmlspecialchars($options['number_bg'] ?? 'bg-red-600'); ?> text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5"><?php echo (int)$index + 1; ?></span>
                <?php else: ?>
                <?php $iconBox = trim((string)($options['item_icon_box'] ?? '')); ?>
                <?php if ($iconBox !== ''): ?>
                <div class="<?php echo htmlspecialchars($iconBox); ?>">
                    <i class="fas <?php echo htmlspecialchars(trim((string)($item['icon'] ?? 'fa-chevron-right'))); ?> <?php echo htmlspecialchars($options['item_icon_class'] ?? ''); ?> text-xs"></i>
                </div>
                <?php else: ?>
                <i class="fas <?php echo htmlspecialchars(trim((string)($item['icon'] ?? '')) !== '' ? $item['icon'] : 'fa-chevron-right'); ?> text-red-600 mt-1 flex-shrink-0"></i>
                <?php endif; ?>
                <?php endif; ?>
                <p class="<?php echo htmlspecialchars($itemTextClass); ?>"><?php echo function_exists('cms_render_html') ? cms_render_html((string)($item['text'] ?? '')) : htmlspecialchars((string)($item['text'] ?? '')); ?></p>
            </div>
            <?php
        };

        // "items-only": just the point list, placed beside section copy.
        if ($layout === 'items-only') {
            ?>
            <div class="grid <?php echo htmlspecialchars($options['items_grid'] ?? 'sm:grid-cols-2 gap-6'); ?> <?php echo htmlspecialchars($options['items_text_class'] ?? 'text-xs text-dark-grey/70'); ?>">
                <?php foreach ($items as $i => $item) $renderItem(is_array($item) ? $item : [], $i); ?>
            </div>
            <?php
            return;
        }

        // "panel-only": a standalone card with heading + numbered points.
        if ($layout === 'panel-only') {
            $panelTitle = trim((string)($block['title'] ?? ''));
            if ($panelTitle === '' && empty($items)) {
                return;
            }
            ?>
            <div class="<?php echo htmlspecialchars($options['card_class'] ?? 'bg-white p-8 rounded-3xl border border-slate-200/50 space-y-6'); ?>">
                <?php if ($panelTitle !== ''): ?>
                <h3 class="<?php echo htmlspecialchars($options['title_class'] ?? 'text-xl font-bold text-dark-grey'); ?>"><?php echo htmlspecialchars($panelTitle); ?></h3>
                <?php endif; ?>
                <div class="grid <?php echo htmlspecialchars($options['items_grid'] ?? 'grid-cols-1 gap-4'); ?> <?php echo htmlspecialchars($options['items_text_class'] ?? 'text-sm text-dark-grey/70'); ?>">
                    <?php foreach ($items as $i => $item) $renderItem(is_array($item) ? $item : [], $i); ?>
                </div>
            </div>
            <?php
            return;
        }
        ?>
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left content -->
            <div class="<?php echo htmlspecialchars($options['left_cols'] ?? 'lg:col-span-7 space-y-6'); ?>">
                <?php cms_render_block_header(
                    $block,
                    'mb-0',
                    $options['title_class'] ?? '',
                    $options['header_align'] ?? 'left',
                    $options['badge_class'] ?? 'text-electric-blue font-semibold text-sm uppercase tracking-wider'
                ); ?>
                <?php if ($text !== ''): ?>
                <p class="<?php echo htmlspecialchars($options['text_class'] ?? 'text-sm text-dark-grey/70 leading-relaxed'); ?>">
                    <?php echo htmlspecialchars($text); ?>
                </p>
                <?php endif; ?>
                <div class="grid <?php echo htmlspecialchars($options['items_grid'] ?? 'sm:grid-cols-2 gap-6'); ?> <?php echo htmlspecialchars($options['items_text_class'] ?? 'text-xs text-dark-grey/70'); ?>">
                    <?php foreach ($items as $i => $item) $renderItem(is_array($item) ? $item : [], $i); ?>
                </div>
            </div>

            <!-- Right card -->
            <?php $panelTitle = trim((string)($block['panel_title'] ?? '')); ?>
            <?php if ($panelTitle !== ''): ?>
            <div class="lg:col-span-5 bg-gradient-to-br from-red-800 via-red-950 to-slate-950 text-white p-8 rounded-3xl shadow-xl space-y-6">
                <h3 class="text-xl font-bold font-serif"><?php echo htmlspecialchars($panelTitle); ?></h3>
                <p class="text-xs text-white/80 leading-relaxed"><?php echo htmlspecialchars(trim((string)($block['panel_text'] ?? ''))); ?></p>
                <?php if ($slug !== null && function_exists('cms_page_cta') && cms_page_cta($slug, 'emergency')['text'] !== ''): ?>
                <div class="pt-4 border-t border-white/10">
                    <a href="<?php echo cms_cta_href(cms_page_cta($slug, 'emergency')['url']); ?>"
                       class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-2xl transition-colors text-sm">
                        <?php echo htmlspecialchars(cms_page_cta($slug, 'emergency')['text']); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }
}

if (!function_exists('cms_render_block_links')) {
    /**
     * Directory cards: optional photo link cards (conditions hub) or compact
     * icon cards with a "potential causes" footer (symptoms hub).
     */
    function cms_render_block_links(array $block, array $options = []) {
        $items = is_array($block['items'] ?? null) ? array_values($block['items']) : [];
        cms_render_block_header($block, $options['header_margin'] ?? 'mb-12');
        if (empty($items)) {
            return;
        }
        $carded = !empty($options['card_image']);
        ?>
        <div class="<?php echo htmlspecialchars($options['grid'] ?? ($carded ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8' : 'grid sm:grid-cols-2 lg:grid-cols-3 gap-8')); ?>">
            <?php foreach ($items as $index => $item):
                list($bgClass, $hoverBg, $textClass) = cms_block_color($item['color'] ?? 'electric-blue');
                $href = htmlspecialchars(cms_cta_href($item['url'] ?? ''));
            ?>
            <?php if ($carded): ?>
            <a href="<?php echo $href; ?>"
               class="group bg-white rounded-3xl p-5 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 flex flex-col"
               style="animation-delay: <?php echo $index * 100; ?>ms;">
                <?php $img = trim((string)($item['image'] ?? '')); ?>
                <?php if ($img !== ''): ?>
                <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="<?php echo htmlspecialchars($item['image']); ?>"
                         alt="<?php echo htmlspecialchars(trim((string)($item['image_alt'] ?? $item['title'] ?? ''))); ?> treatment"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <?php endif; ?>
                <div class="flex justify-between items-start mb-3">
                    <h3 class="text-xl font-bold text-deep-indigo group-hover:text-electric-blue transition-colors leading-tight">
                        <?php echo htmlspecialchars(trim((string)($item['title'] ?? ''))); ?>
                    </h3>
                    <div class="w-10 h-10 rounded-full border border-silver-grey flex items-center justify-center text-dark-grey group-hover:text-white group-hover:bg-gradient-to-r group-hover:from-electric-blue group-hover:to-cyan-accent group-hover:border-transparent transition-all duration-300 flex-shrink-0 ml-4">
                        <i class="fas fa-arrow-right group-hover:-rotate-45 transition-transform duration-300"></i>
                    </div>
                </div>
                <p class="text-dark-grey/70 leading-relaxed text-sm">
                    <?php echo function_exists('cms_render_html') ? cms_render_html((string)($item['text'] ?? '')) : htmlspecialchars((string)($item['text'] ?? '')); ?>
                </p>
            </a>
            <?php else: ?>
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 <?php echo $bgClass; ?> rounded-2xl flex items-center justify-center <?php echo $textClass; ?>">
                    <i class="fas <?php echo htmlspecialchars(trim((string)($item['icon'] ?? 'fa-notes-medical'))); ?> text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-deep-indigo"><?php echo htmlspecialchars(trim((string)($item['title'] ?? ''))); ?></h3>
                <p class="text-xs text-dark-grey/65 leading-relaxed">
                    <?php echo function_exists('cms_render_html') ? cms_render_html((string)($item['text'] ?? '')) : htmlspecialchars((string)($item['text'] ?? '')); ?>
                </p>
                <?php $causes = trim((string)($item['subtitle'] ?? '')); ?>
                <?php if ($causes !== ''): ?>
                <div class="pt-2 border-t border-slate-200/40 text-[11px] text-dark-grey/60">
                    <strong class="text-deep-indigo">Potential Causes:</strong>
                    <?php echo function_exists('cms_render_html') ? cms_render_html($causes) : htmlspecialchars($causes); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

if (!function_exists('cms_page_section_flow')) {
    /**
     * Scan the page's live template file and return the visual order of its
     * editable blocks and CTA buttons (top → bottom), so the editor can
     * mirror the page section by section instead of using storage order.
     */
    function cms_page_section_flow($slug, $templateFile = null) {
        $flow = [];
        if (!$templateFile) {
            return $flow;
        }
        $path = dirname(__DIR__) . '/' . ltrim((string)$templateFile, '/');
        if (!is_file($path)) {
            return $flow;
        }
        $src = @file_get_contents($path);
        if ($src === false) {
            return $flow;
        }
        $slugPattern = preg_quote((string)$slug, '/');
        if (!preg_match_all('/cms_(?:render_page_block|page_cta)\(\s*[\'"]' . $slugPattern . '[\'"]\s*,\s*[\'"]([a-zA-Z0-9_-]+)[\'"]/', $src, $m, PREG_OFFSET_CAPTURE)) {
            return $flow;
        }
        $hits = $m[1];
        usort($hits, function ($a, $b) {
            return $a[1] - $b[1];
        });
        foreach ($hits as $hit) {
            $flow[] = $hit[0];
        }
        return $flow;
    }
}

if (!function_exists('cms_page_editor_entries')) {
    /**
     * Build the editor's card list for one page, mirroring the live page
     * top → bottom. Returns a list of entries:
     *   ['kind' => 'cta', 'key' => ...]      one editable button group
     *   ['kind' => 'block', 'key' => ...]    one editable content block
     *   ['kind' => 'section1']               the page's main body intro section
     *
     * The order comes from scanning the page's template file for
     * cms_render_page_block() / cms_page_cta() calls. Buttons that a block
     * renders internally (final banner, emergency card, doctor button…) are
     * attached to that block. CTA keys the page never uses are omitted, and
     * the "What is …" intro section is placed right before the first block,
     * exactly where it renders on the page.
     */
    function cms_page_editor_entries($slug, $templateFile = null) {
        $editableBlocks = cms_page_blocks($slug);
        $allCtaKeys = function_exists('cms_page_cta_keys') ? cms_page_cta_keys($slug) : [];

        // Pages converted to the ordered flow: the editor mirrors the saved
        // layout exactly (one card per section, nested blocks right after
        // their parent, buttons attached to the section that prints them).
        if (cms_page_uses_flow($slug)) {
            $entries = [];
            $usedCtas = [];
            $virtualTypes = ['faq', 'video-testimonials', 'related-videos'];
            $blockCtaMap = [
                'why-choose' => ['why-choose'],
                'cta'        => ['final-primary', 'final-secondary'],
                'notice'     => ['emergency'],
                'doctor'     => ['doctor-more'],
            ];
            foreach (['hero-primary', 'hero-secondary'] as $heroKey) {
                if (in_array($heroKey, $allCtaKeys, true)) {
                    $entries[] = ['kind' => 'cta', 'key' => $heroKey, 'group' => 'hero'];
                    $usedCtas[$heroKey] = true;
                }
            }
            foreach (cms_page_layout($slug, $editableBlocks) as $le) {
                $key = $le['key'];
                $block = $editableBlocks[$key];
                $type = $block['type'] ?? 'cards';
                $opts = isset($block['options']) && is_array($block['options']) ? $block['options'] : [];
                $base = ['key' => $key, 'hidden' => !empty($le['hidden']), 'added' => !empty($block['added']), 'flow' => true];
                if ($type === 'intro') {
                    $entries[] = $base + ['kind' => 'section1'];
                    foreach (['facts_key', 'aside_key'] as $nk) {
                        $nkey = trim((string)($opts[$nk] ?? ''));
                        if ($nkey !== '' && isset($editableBlocks[$nkey])) {
                            $entries[] = ['kind' => 'block', 'key' => $nkey, 'nested' => true];
                        }
                    }
                } elseif (in_array($type, $virtualTypes, true)) {
                    $entries[] = $base + ['kind' => 'virtual', 'type' => $type];
                } else {
                    $entries[] = $base + ['kind' => 'block'];
                }
                $attach = $blockCtaMap[$type] ?? [];
                if (!empty($opts['cta_key'])) {
                    $attach[] = $opts['cta_key'];
                }
                foreach ($attach as $ck) {
                    if ($type === 'doctor' && $ck === 'doctor-more' && ($block['layout'] ?? 'profile') !== 'about') continue;
                    if ($type === 'notice' && $ck === 'emergency' && (($opts['layout'] ?? 'full') !== 'full' || trim((string)($block['panel_title'] ?? '')) === '')) continue;
                    if (in_array($ck, $allCtaKeys, true) && empty($usedCtas[$ck])) {
                        $entries[] = ['kind' => 'cta', 'key' => $ck, 'attached' => true];
                        $usedCtas[$ck] = true;
                    }
                }
            }
            // Page-specific buttons no section claimed (defined for this slug in page-ctas.json)
            $registry = function_exists('cms_page_ctas_registry') ? cms_page_ctas_registry() : ['pages' => []];
            foreach (array_keys((array)($registry['pages'][$slug] ?? [])) as $ck) {
                if (empty($usedCtas[$ck])) {
                    $entries[] = ['kind' => 'cta', 'key' => $ck, 'group' => 'loose'];
                    $usedCtas[$ck] = true;
                }
            }
            return $entries;
        }

        $flowKeys = cms_page_section_flow($slug, $templateFile);

        $blockCtaMap = [
            'why-choose' => ['why-choose'],
            'cta'        => ['final-primary', 'final-secondary'],
            'notice'     => ['emergency'],
            'doctor'     => ['doctor-more'], // attached only for the "about" layout below
        ];

        $orderedEntries = [];
        $seenBlocks = [];
        $usedCtas = [];
        foreach ($flowKeys as $flowKey) {
            if (isset($seenBlocks[$flowKey]) || isset($usedCtas[$flowKey])) {
                continue;
            }
            if (isset($editableBlocks[$flowKey])) {
                $orderedEntries[] = ['kind' => 'block', 'key' => $flowKey];
                $seenBlocks[$flowKey] = true;
                $flowBlockType = $editableBlocks[$flowKey]['type'] ?? 'cards';
                foreach ($blockCtaMap[$flowBlockType] ?? [] as $mapCtaKey) {
                    // The emergency button only exists on notice blocks that
                    // render their dark panel (layout "full" with a panel title).
                    if ($flowBlockType === 'notice') {
                        $noticeOptions = (isset($editableBlocks[$flowKey]['options']) && is_array($editableBlocks[$flowKey]['options'])) ? $editableBlocks[$flowKey]['options'] : [];
                        $noticeLayout = $noticeOptions['layout'] ?? 'full';
                        if ($noticeLayout !== 'full' || trim((string)($editableBlocks[$flowKey]['panel_title'] ?? '')) === '') {
                            continue;
                        }
                    }
                    // The doctor-more button only exists on "about" layout
                    // doctor sections; the profile layout uses items links.
                    if ($flowBlockType === 'doctor' && $mapCtaKey === 'doctor-more') {
                        if (($editableBlocks[$flowKey]['layout'] ?? 'profile') !== 'about') {
                            continue;
                        }
                    }
                    if (in_array($mapCtaKey, $allCtaKeys, true) && empty($usedCtas[$mapCtaKey])) {
                        $orderedEntries[] = ['kind' => 'cta', 'key' => $mapCtaKey];
                        $usedCtas[$mapCtaKey] = true;
                    }
                }
            } elseif (in_array($flowKey, $allCtaKeys, true)) {
                $orderedEntries[] = ['kind' => 'cta', 'key' => $flowKey];
                $usedCtas[$flowKey] = true;
            }
        }
        // Blocks the scan did not find (safety net) keep their storage order, last.
        foreach ($editableBlocks as $blockKey => $block) {
            if (empty($seenBlocks[$blockKey])) {
                $orderedEntries[] = ['kind' => 'block', 'key' => $blockKey];
                $seenBlocks[$blockKey] = true;
            }
        }
        // The "What is …" intro section renders right before the first content
        // block on the live page — mirror that position here.
        $withSection1 = [];
        $section1Placed = false;
        foreach ($orderedEntries as $entry) {
            if (!$section1Placed && $entry['kind'] === 'block') {
                $withSection1[] = ['kind' => 'section1'];
                $section1Placed = true;
            }
            $withSection1[] = $entry;
        }
        if (!$section1Placed) {
            $withSection1[] = ['kind' => 'section1'];
        }
        return $withSection1;
    }
}

if (!function_exists('cms_block_blank')) {
    /**
     * Starter definition for a section the editor adds to a page.
     */
    function cms_block_blank($type) {
        $types = cms_block_type_catalog();
        if (!isset($types[$type])) {
            $type = 'cards';
        }
        $def = [
            'type' => $type,
            'label' => $types[$type]['label'],
            'added' => true,
            'badge' => '',
            'title' => $types[$type]['label'],
            'description' => '',
            'items' => [],
            'wrap' => ['bg' => 'bg-white', 'padding' => 'py-12'],
        ];
        switch ($type) {
            case 'cards':
            case 'facts':
            case 'why-choose':
            case 'treatments':
                $def['items'] = [['icon' => 'fa-check', 'color' => 'electric-blue', 'title' => 'First point', 'text' => 'Describe this point in a sentence or two.']];
                break;
            case 'steps':
                $def['items'] = [['title' => 'Step one', 'text' => 'What happens first.'], ['title' => 'Step two', 'text' => 'What happens next.']];
                break;
            case 'symptoms':
                $def['items'] = [['icon' => 'fa-check', 'color' => 'electric-blue', 'title' => 'Group', 'bullets' => ['Symptom one', 'Symptom two']]];
                break;
            case 'warning':
            case 'notice':
                $def['items'] = [['text' => 'First point to highlight.']];
                break;
            case 'related':
            case 'links':
                $def['items'] = [['title' => 'Related page', 'text' => 'Short description', 'url' => 'services']];
                break;
            case 'cta':
                $def['title'] = 'Need Personalized Advice?';
                $def['description'] = 'Consult with Dr. Praveen Gupta for an accurate diagnosis and treatment plan.';
                break;
            case 'intro':
                $def['text'] = 'Introductory paragraph.';
                $def['image'] = '';
                break;
            case 'faq':
            case 'video-testimonials':
            case 'related-videos':
                $def['title'] = '';
                break;
        }
        if (function_exists('cms_block_blank_extra')) {
            $def = cms_block_blank_extra($type, $def);
        }
        return $def;
    }
}

if (!function_exists('cms_block_type_catalog')) {
    /**
     * Section types an editor can add to a page: key => [label, item label].
     */
    function cms_block_type_catalog() {
        $catalog = [
            'cards'      => ['label' => 'Card grid', 'item_label' => 'Card'],
            'steps'      => ['label' => 'Numbered steps', 'item_label' => 'Step'],
            'facts'      => ['label' => 'Key facts grid', 'item_label' => 'Fact'],
            'warning'    => ['label' => 'Warning / emergency panel', 'item_label' => 'Warning line'],
            'symptoms'   => ['label' => 'Symptom groups (split section)', 'item_label' => 'Symptom group', 'block_image' => true, 'block_tags' => true],
            'treatments' => ['label' => 'Treatment option cards', 'item_label' => 'Treatment'],
            'why-choose' => ['label' => 'Why Choose section', 'item_label' => 'Feature', 'block_image' => true],
            'related'    => ['label' => 'Related pages', 'item_label' => 'Link'],
            'links'      => ['label' => 'Directory cards', 'item_label' => 'Card'],
            'doctor'     => ['label' => 'Doctor profile', 'item_label' => 'Link', 'block_image' => true, 'block_roles' => true],
            'cta'        => ['label' => 'Call-to-action banner', 'item_label' => 'Button'],
            'notice'     => ['label' => 'Alert panel', 'item_label' => 'Point', 'block_panel' => true],
            'intro'      => ['label' => 'Intro / text + photo section', 'item_label' => 'Item'],
            'faq'        => ['label' => 'FAQ section (from Page FAQs)', 'item_label' => 'Question'],
            'video-testimonials' => ['label' => 'Video testimonials slider', 'item_label' => 'Video'],
            'related-videos'     => ['label' => 'Watch & Learn (related videos)', 'item_label' => 'Video'],
        ];
        if (function_exists('cms_block_type_catalog_extra')) {
            $catalog = array_merge($catalog, cms_block_type_catalog_extra());
        }
        return $catalog;
    }
}

if (!function_exists('cms_render_page_block')) {
    /**
     * Echo one editable block by page slug + block key.
     */
    function cms_render_page_block($slug, $key, array $options = []) {
        global $cmsCurrentPageSlug;
        $previousSlug = $cmsCurrentPageSlug ?? null;
        $cmsCurrentPageSlug = $slug;
        try {
            $block = cms_page_block($slug, $key);
            if ($block === null) {
                return;
            }
            if (isset($block['options']) && is_array($block['options'])) {
                $options = array_merge($block['options'], $options);
            }
            $type = $block['type'] ?? 'cards';
            $ctaKey = trim((string)($options['cta_key'] ?? ''));
            switch ($type) {
                case 'intro':
                    cms_render_block_intro($block, $options, $slug);
                    break;
                case 'faq':
                case 'video-testimonials':
                case 'related-videos':
                    cms_render_block_include($block, $options, $slug);
                    break;
                case 'steps':
                    cms_render_block_steps($block, $options);
                    break;
                case 'facts':
                    cms_render_block_facts($block, $options);
                    break;
                case 'warning':
                    cms_render_block_warning($block, $options);
                    break;
                case 'symptoms':
                    cms_render_block_symptoms($block, $options);
                    break;
                case 'treatments':
                    cms_render_block_treatments($block, $options);
                    break;
                case 'why-choose':
                    cms_render_block_why_choose($block, $options, $slug);
                    break;
                case 'related':
                    cms_render_block_related($block, $options);
                    break;
                case 'doctor':
                    cms_render_block_doctor($block, $options);
                    break;
                case 'cta':
                    cms_render_block_cta($block, $options, $slug);
                    break;
                case 'notice':
                    cms_render_block_notice($block, $options, $slug);
                    break;
                case 'links':
                    cms_render_block_links($block, $options);
                    break;
                default:
                    if (function_exists('cms_render_block_' . str_replace('-', '_', $type))) {
                        call_user_func('cms_render_block_' . str_replace('-', '_', $type), $block, $options, $slug);
                    } else {
                        cms_render_block_cards($block, $options);
                    }
            }
            if ($ctaKey !== '') {
                cms_render_block_cta_key($slug, $ctaKey, $options);
            }
        } finally {
            $cmsCurrentPageSlug = $previousSlug;
        }
    }
}
