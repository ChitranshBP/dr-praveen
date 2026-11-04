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
     */
    function cms_page_blocks($slug) {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);
        $defaults = cms_page_blocks_defaults($slug);

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

        $blocks = [];
        foreach ($defaults as $key => $default) {
            if (!is_array($default)) {
                continue;
            }
            $override = (isset($saved[$key]) && is_array($saved[$key])) ? $saved[$key] : [];
            $block = array_merge($default, $override);
            // Use the saved items only when the editor actually kept some.
            if (isset($override['items']) && is_array($override['items'])) {
                $block['items'] = array_values(array_filter($override['items'], 'is_array'));
            }
            $blocks[$key] = $block;
        }
        return $blocks;
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
            case 'electric-blue':
            default:
                return ['bg-electric-blue/10', 'group-hover:bg-electric-blue', 'text-electric-blue'];
        }
    }
}

if (!function_exists('cms_render_block_header')) {
    function cms_render_block_header(array $block, $margin = 'mb-16') {
        $badge = trim((string)($block['badge'] ?? ''));
        $title = trim((string)($block['title'] ?? ''));
        $desc  = trim((string)($block['description'] ?? ''));
        if ($badge === '' && $title === '' && $desc === '') {
            return;
        }
        ?>
        <div class="text-center max-w-3xl mx-auto <?php echo htmlspecialchars($margin); ?>">
            <?php if ($badge !== ''): ?>
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($badge); ?></span>
            <?php endif; ?>
            <?php if ($title !== ''): ?>
            <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($title); ?></h2>
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
        cms_render_block_header($block, $options['header_margin'] ?? 'mb-16');

        $items = is_array($block['items'] ?? null) ? $block['items'] : [];
        if (empty($items)) {
            return;
        }
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
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-silver-grey/20 hover:shadow-lg hover:border-electric-blue/20 transition-all duration-300 group">
                <div class="w-14 h-14 <?php echo $bgClass; ?> rounded-xl flex items-center justify-center mb-5 <?php echo $hoverBg; ?> transition-all duration-300">
                    <i class="fas <?php echo htmlspecialchars($icon); ?> <?php echo $textClass; ?> text-xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-3"><?php echo htmlspecialchars($itemTitle); ?></h3>
                <p class="text-sm text-dark-grey/60 leading-relaxed mb-4"><?php echo htmlspecialchars($itemText); ?></p>
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

if (!function_exists('cms_render_page_block')) {
    /**
     * Echo one editable block by page slug + block key.
     */
    function cms_render_page_block($slug, $key, array $options = []) {
        $block = cms_page_block($slug, $key);
        if ($block === null) {
            return;
        }
        if (isset($block['options']) && is_array($block['options'])) {
            $options = array_merge($block['options'], $options);
        }
        $type = $block['type'] ?? 'cards';
        if ($type === 'steps') {
            cms_render_block_steps($block, $options);
        } else {
            cms_render_block_cards($block, $options);
        }
    }
}
