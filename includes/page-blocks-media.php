<?php
/**
 * CMS block renderers for the media / testimonial / case-study pages, the
 * shared page-hero helper and the simple centered CTA.
 *
 * Collection variants are picked up by cms_render_block_collection_grid()
 * as cms_collection_variant_{variant}(); testimonial variants by
 * cms_render_block_testimonials() as cms_testimonials_variant_{variant}().
 */

/* ----------------------------------------------------------------------------
 * Shared page hero (banner): breadcrumb, badge, H1, intro, hero buttons and
 * any "placement": "hero" blocks of the page flow.
 *
 *   $pageContent = cms_render_page_hero('gallery', [defaults…], ['style' => 'cover', 'icon' => 'fa-images']);
 *
 * options: style  cover (background image + indigo gradient, default)
 *                 photo (full-bleed <img> + legibility overlay)
 *          icon   default Font Awesome icon for the badge (page JSON hero_icon wins)
 *          badge_border  true to outline the badge pill
 *          blob   true to add the cyan glow in the corner
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_page_hero')) {
    function cms_render_page_hero($slug, array $defaults = [], array $opts = []) {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);
        $pageContent = get_page_content($slug, $defaults);
        $style = $opts['style'] ?? 'cover';
        $bg = cms_media_path($pageContent['hero_bg'] ?? '', (string)($defaults['hero_bg'] ?? ''));
        $bgAlt = trim((string)($pageContent['hero_bg_alt'] ?? ''));
        $icon = trim((string)($pageContent['hero_icon'] ?? ''));
        if ($icon === '') $icon = (string)($opts['icon'] ?? 'fa-brain');
        $iconClass = (strpos($icon, ' ') === false) ? 'fas ' . $icon : $icon;
        if (!preg_match('/(^|\s)text-/', $iconClass)) $iconClass .= ' ' . ($opts['icon_color'] ?? 'text-cyan-accent');
        $badge = trim((string)($pageContent['hero_badge'] ?? ''));
        $desc = trim((string)($pageContent['hero_desc'] ?? ''));
        $badgeBorder = !empty($opts['badge_border']) ? ' border border-white/20' : '';

        // Hero buttons come from CMS → Buttons (hero-primary / hero-secondary).
        // Pages without banner buttons carry blank per-page defaults in
        // data/page-ctas.json, so nothing prints until the editor adds text.
        $heroCtas = [];
        if (function_exists('cms_page_cta')) {
            foreach (['hero-primary', 'hero-secondary'] as $ck) {
                $cta = cms_page_cta($slug, $ck);
                if (trim((string)$cta['text']) !== '') $heroCtas[$ck] = $cta;
            }
        }
        ?>
<!-- Page Hero (CMS → All Pages → <?php echo htmlspecialchars($pageContent['title'] ?? $slug); ?>) -->
<?php if ($style === 'photo'): ?>
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <?php if ($bg !== ''): ?>
    <img src="<?php echo htmlspecialchars($bg); ?>" alt="<?php echo htmlspecialchars($bgAlt); ?>" fetchpriority="high"
         class="absolute inset-0 w-full h-full object-cover object-[78%_center] md:object-right pointer-events-none select-none">
    <?php endif; ?>
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/75 to-deep-indigo/35 md:to-transparent"></div>
<?php else: ?>
<section class="relative overflow-hidden text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20 bg-cover bg-center"<?php echo $bg !== '' ? ' style="background-image: url(\'' . htmlspecialchars($bg) . '\');"' : ''; ?>>
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/85 to-electric-blue/30"></div>
    <?php if (!empty($opts['blob'])): ?>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>
    <?php endif; ?>
<?php endif; ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <?php cms_breadcrumb_nav($slug); ?>

            <?php if ($badge !== ''): ?>
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4<?php echo $badgeBorder; ?>">
                <i class="<?php echo htmlspecialchars($iconClass); ?> text-[10px]"></i>
                <span><?php echo htmlspecialchars($badge); ?></span>
            </div>
            <?php endif; ?>

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title'] ?? ''; ?>
            </h1>

            <?php if ($desc !== ''): ?>
            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($desc); ?>
            </p>
            <?php endif; ?>

            <?php if (!empty($heroCtas)): ?>
            <div class="flex flex-wrap gap-3">
                <?php if (isset($heroCtas['hero-primary'])): ?>
                <a href="<?php echo cms_cta_href($heroCtas['hero-primary']['url']); ?>" class="inline-flex items-center space-x-2.5 bg-white text-deep-indigo font-semibold px-6 py-2.5 rounded-full hover:shadow-xl hover:shadow-white/30 transition-all duration-300 transform hover:-translate-y-1 text-sm">
                    <span><?php echo cms_cta_text($slug, 'hero-primary'); ?></span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
                <?php endif; ?>
                <?php if (isset($heroCtas['hero-secondary'])): $secHref = cms_cta_href($heroCtas['hero-secondary']['url']); ?>
                <a href="<?php echo $secHref; ?>" class="inline-flex items-center space-x-2.5 bg-white/10 backdrop-blur-sm border border-white/30 text-white font-semibold px-6 py-2.5 rounded-full hover:bg-white/20 transition-all duration-300 text-sm">
                    <?php if (strncasecmp($secHref, 'tel:', 4) === 0): ?><i class="fas fa-phone-alt text-xs"></i><?php endif; ?>
                    <span><?php echo cms_cta_text($slug, 'hero-secondary'); ?></span>
                </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if (function_exists('cms_render_page_flow')) cms_render_page_flow($slug, ['placement' => 'hero']); ?>
        </div>
    </div>
</section>
        <?php
        return $pageContent;
    }
}

/* ----------------------------------------------------------------------------
 * cta-simple — centered heading + text + one or two buttons
 * options: style  indigo (default: dark indigo button) | gradient (gradient + white buttons)
 *          button2_icon  e.g. "fab fa-google text-red-500"
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_cta_simple')) {
    function cms_render_block_cta_simple(array $block, array $options = [], $slug = null) {
        $title = trim((string)($block['title'] ?? ''));
        $desc = trim((string)($block['description'] ?? ''));
        $b1 = trim((string)($block['button_text'] ?? ''));
        $b2 = trim((string)($block['button2_text'] ?? ''));
        if ($title === '' && $desc === '' && $b1 === '' && $b2 === '') return;
        $style = $options['style'] ?? 'indigo';
        $external = function ($href) { return preg_match('#^https?://#i', $href) ? ' target="_blank" rel="noopener noreferrer"' : ''; };
        cms_block_section_open($block, $style === 'gradient' ? 'bg-[#edf5f9]' : 'bg-slate-50', $style === 'gradient' ? 'py-12' : 'py-16', $style === 'gradient' ? 'border-t border-slate-200/60' : 'border-t border-b border-silver-grey/40');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <?php if ($title !== ''): ?>
        <h2 class="<?php echo $style === 'gradient' ? 'text-2xl md:text-3xl font-bold text-dark-grey' : 'text-3xl font-bold text-deep-indigo font-serif'; ?>"><?php echo cms_block_title_html($block); ?></h2>
        <?php endif; ?>
        <?php if ($desc !== ''): ?>
        <p class="<?php echo $style === 'gradient' ? 'text-dark-grey/65 text-sm md:text-base leading-relaxed max-w-2xl mx-auto' : 'text-sm text-dark-grey/65 max-w-xl mx-auto leading-relaxed'; ?>"><?php echo htmlspecialchars($desc); ?></p>
        <?php endif; ?>
        <?php if ($b1 !== '' || $b2 !== ''): ?>
        <div class="pt-2 flex flex-wrap items-center justify-center gap-4">
            <?php if ($b1 !== ''): $h1 = cms_nav_href($block['button_url'] ?? '#'); ?>
            <a href="<?php echo htmlspecialchars($h1); ?>"<?php echo $external($h1); ?> class="<?php echo $style === 'gradient' ? 'bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold px-6 py-3.5 rounded-xl shadow-lg hover:shadow-electric-blue/20 transition-all duration-300' : 'inline-flex items-center space-x-3 bg-deep-indigo hover:bg-electric-blue text-white text-sm font-bold px-8 py-3.5 rounded-2xl transition-colors'; ?>">
                <span><?php echo htmlspecialchars($b1); ?></span>
            </a>
            <?php endif; ?>
            <?php if ($b2 !== ''): $h2 = cms_nav_href($block['button2_url'] ?? '#'); ?>
            <a href="<?php echo htmlspecialchars($h2); ?>"<?php echo $external($h2); ?> class="<?php echo $style === 'gradient' ? 'bg-white border border-slate-200 text-dark-grey font-semibold px-6 py-3.5 rounded-xl hover:bg-slate-50 transition-all duration-300 inline-flex items-center space-x-2' : 'inline-flex items-center space-x-2 bg-white border border-slate-200 text-deep-indigo text-sm font-bold px-8 py-3.5 rounded-2xl hover:bg-slate-50 transition-colors'; ?>">
                <?php if (!empty($options['button2_icon'])): ?><i class="<?php echo htmlspecialchars($options['button2_icon']); ?>"></i><?php endif; ?>
                <span><?php echo htmlspecialchars($b2); ?></span>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * collection-grid variant: gallery-filter — category chips, square photo grid, lightbox
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_collection_variant_gallery_filter')) {
    function cms_collection_variant_gallery_filter(array $block, array $options, array $items, $collection) {
        $categories = cms_setting_options('gallery_categories', ['awards' => 'Awards & Recognition', 'clinical' => 'Clinical Events']);
        $used = [];
        foreach ($items as $gi) { $used[(string)($gi['category'] ?? '')] = true; }
        cms_block_section_open($block, 'bg-white', 'py-12', '');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
        <div class="flex flex-wrap items-center justify-center gap-3 mb-10" id="gallery-filters">
            <button class="filter-btn active px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-300 bg-electric-blue text-white border-electric-blue shadow-md" data-filter="all">
                <?php echo htmlspecialchars($options['all_label'] ?? 'All Photos'); ?>
            </button>
            <?php foreach ($categories as $catKey => $catLabel): if (empty($used[$catKey])) continue; ?>
            <button class="filter-btn px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" data-filter="<?php echo htmlspecialchars($catKey); ?>">
                <?php echo htmlspecialchars($catLabel); ?>
            </button>
            <?php endforeach; ?>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-grid">
            <?php foreach ($items as $gi):
                $giImage = cms_media_path($gi['image'] ?? '');
                if ($giImage === '') continue;
                $giCat = (string)($gi['category'] ?? '');
                $giCatLabel = $categories[$giCat] ?? $giCat;
                $giCaption = trim((string)($gi['caption'] ?? '')) !== '' ? $gi['caption'] : ($gi['title'] ?? '');
            ?>
            <div class="gallery-item <?php echo htmlspecialchars($giCat); ?> relative group overflow-hidden rounded-[24px] bg-slate-50 border border-slate-200/50 aspect-square shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="openLightbox(<?php echo htmlspecialchars(json_encode($giImage, JSON_UNESCAPED_SLASHES), ENT_QUOTES); ?>, <?php echo htmlspecialchars(json_encode((string)$giCaption, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), ENT_QUOTES); ?>)">
                <img src="<?php echo htmlspecialchars($giImage); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?php echo htmlspecialchars($gi['alt'] ?? $gi['title'] ?? ''); ?>" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <span class="text-xs text-cyan-accent font-bold uppercase tracking-wider"><?php echo htmlspecialchars($giCatLabel); ?></span>
                    <h4 class="text-white font-bold text-base mt-1"><?php echo htmlspecialchars($gi['title'] ?? ''); ?></h4>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black/95 z-[9999] hidden flex flex-col items-center justify-center p-4">
    <button class="absolute top-6 right-6 text-white hover:text-cyan-accent text-3xl focus:outline-none" onclick="closeLightbox()" aria-label="Close"><i class="fas fa-times"></i></button>
    <div class="max-w-4xl max-h-[80vh] flex items-center justify-center overflow-hidden">
        <img id="lightbox-img" src="" class="max-w-full max-h-full object-contain rounded-xl shadow-2xl" alt="Enlarged gallery photo">
    </div>
    <p id="lightbox-caption" class="text-white/80 text-sm mt-6 max-w-2xl text-center font-medium"></p>
</div>
<script>
    document.querySelectorAll('#gallery-filters .filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('#gallery-filters .filter-btn').forEach(b => {
                b.classList.remove('bg-electric-blue', 'text-white', 'border-electric-blue', 'shadow-md');
                b.classList.add('bg-white', 'text-dark-grey/70', 'border-slate-200');
            });
            btn.classList.add('bg-electric-blue', 'text-white', 'border-electric-blue', 'shadow-md');
            btn.classList.remove('bg-white', 'text-dark-grey/70', 'border-slate-200');
            const filter = btn.getAttribute('data-filter');
            document.querySelectorAll('#gallery-grid .gallery-item').forEach(item => {
                item.classList.toggle('hidden', !(filter === 'all' || item.classList.contains(filter)));
            });
        });
    });
    function openLightbox(src, caption) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-caption').innerText = caption;
        document.getElementById('lightbox').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * collection-grid variant: press — media coverage cards
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_collection_variant_press')) {
    function cms_collection_variant_press(array $block, array $options, array $items, $collection) {
        cms_block_section_open($block, 'bg-white', 'py-12', '');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="media-grid">
            <?php foreach ($items as $mc):
                $mcImage = cms_media_path($mc['image'] ?? '');
                $mcLink  = trim((string)($mc['link_url'] ?? ''));
                $mcLabel = trim((string)($mc['link_label'] ?? ''));
            ?>
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <?php if ($mcImage !== ''): ?>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="<?php echo htmlspecialchars($mcImage); ?>" alt="<?php echo htmlspecialchars($mc['alt'] ?? $mc['headline'] ?? ''); ?>" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105" loading="lazy">
                    </div>
                    <?php endif; ?>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span><?php echo htmlspecialchars($mc['outlet'] ?? ''); ?></span>
                            <?php if (trim((string)($mc['date'] ?? '')) !== ''): ?><span class="text-dark-grey/40 font-normal"><?php echo htmlspecialchars($mc['date']); ?></span><?php endif; ?>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug"><?php echo htmlspecialchars($mc['headline'] ?? ''); ?></h4>
                        <?php if (trim((string)($mc['description'] ?? '')) !== ''): ?>
                        <p class="text-xs text-dark-grey/55 leading-relaxed"><?php echo htmlspecialchars($mc['description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40"><?php echo trim((string)($mc['topic'] ?? '')) !== '' ? htmlspecialchars(($options['topic_prefix'] ?? 'Topic: ') . $mc['topic']) : ''; ?></span>
                    <?php if ($mcLink !== ''): ?>
                    <a href="<?php echo htmlspecialchars($mcLink); ?>" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300"><?php echo htmlspecialchars($mcLabel !== '' ? $mcLabel : ($options['read_label'] ?? 'Read Article')); ?></a>
                    <?php elseif ($mcLabel !== ''): ?>
                    <span class="text-xs text-dark-grey/40"><?php echo htmlspecialchars($mcLabel); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php cms_block_button($block); ?>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * collection-grid variant: video-player — featured player + "Now Playing" + channel button
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_collection_variant_video_player')) {
    function cms_collection_variant_video_player(array $block, array $options, array $items, $collection) {
        $featured = $items[0] ?? ['youtube_id' => '', 'title' => '', 'description' => ''];
        $badge = trim((string)($block['badge'] ?? 'Now Playing'));
        $bText = trim((string)($block['button_text'] ?? ''));
        cms_block_section_open($block, 'bg-white', 'py-12', '');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8 bg-black rounded-[32px] overflow-hidden shadow-2xl border border-slate-200/40 aspect-video relative group">
                <iframe id="main-video-player" class="w-full h-full border-0"
                        src="https://www.youtube.com/embed/<?php echo htmlspecialchars($featured['youtube_id'] ?? ''); ?>?rel=0&modestbranding=1"
                        title="<?php echo htmlspecialchars($featured['title'] ?? ''); ?>"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen loading="lazy"></iframe>
            </div>
            <div class="lg:col-span-4 space-y-6 lg:pl-6">
                <div>
                    <?php if ($badge !== ''): ?><span class="text-electric-blue font-bold text-xs uppercase tracking-wider"><?php echo htmlspecialchars($badge); ?></span><?php endif; ?>
                    <h2 id="main-video-title" class="text-2xl md:text-3xl font-bold text-dark-grey mt-2 mb-3"><?php echo htmlspecialchars($featured['title'] ?? ''); ?></h2>
                    <p id="main-video-desc" class="text-sm text-dark-grey/65 leading-relaxed"><?php echo htmlspecialchars($featured['description'] ?? ''); ?></p>
                </div>
                <?php if ($bText !== ''): $bHref = cms_nav_href($block['button_url'] ?? '{youtube}'); ?>
                <div class="pt-4 border-t border-slate-200/60">
                    <a href="<?php echo htmlspecialchars($bHref); ?>" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center space-x-3 bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-red-600/20 transition-all duration-300">
                        <i class="fab fa-youtube text-lg animate-pulse"></i>
                        <span><?php echo htmlspecialchars($bText); ?></span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * collection-grid variant: video-library — search + category chips + paged grid
 * options: mode      player (cards load into #main-video-player) | inline (card swaps in its own iframe)
 *          per_page  12 | 8 …
 *          columns   4 | 2
 *          container max-w-7xl | max-w-5xl
 *          chip_bg   bg-white | bg-slate-50
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_collection_variant_video_library')) {
    function cms_collection_variant_video_library(array $block, array $options, array $items, $collection) {
        $categories = cms_setting_options('video_categories', ['stroke' => 'Stroke', 'epilepsy' => 'Epilepsy', 'headache' => 'Headache', 'dementia' => 'Dementia', 'spine' => 'Spine/Nerve', 'rehab' => 'Rehab', 'wellness' => 'Wellness']);
        $mode = ($options['mode'] ?? 'player') === 'inline' ? 'inline' : 'player';
        $perPage = (int)($options['per_page'] ?? ($mode === 'inline' ? 8 : 12));
        $cols = (int)($options['columns'] ?? ($mode === 'inline' ? 2 : 4));
        $gridClass = $cols === 2 ? 'grid md:grid-cols-2 gap-8 max-w-5xl mx-auto' : 'grid sm:grid-cols-2 lg:grid-cols-4 gap-6';
        $chipBg = $options['chip_bg'] ?? ($mode === 'inline' ? 'bg-slate-50' : 'bg-white');
        $searchBg = $mode === 'inline' ? 'bg-slate-50' : 'bg-white';
        cms_block_section_open($block, $mode === 'inline' ? 'bg-white' : 'bg-[#edf5f9]', 'py-12', $mode === 'inline' ? '' : 'border-t border-slate-200/60');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block, 'text-center max-w-3xl mx-auto mb-8', 'plain'); ?>

        <div class="<?php echo $mode === 'inline' ? 'max-w-5xl mx-auto mb-10 space-y-6' : 'max-w-7xl mx-auto mb-8 space-y-4'; ?>">
            <div class="grid md:grid-cols-12 gap-4 items-center">
                <div class="md:col-span-5 relative">
                    <label for="video-search" class="sr-only">Search Videos</label>
                    <input type="text" id="video-search" placeholder="<?php echo htmlspecialchars($options['search_placeholder'] ?? 'Search videos by title or topic...'); ?>" class="w-full pl-10 pr-4 py-3 <?php echo $searchBg; ?> border border-slate-200 rounded-2xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey" oninput="filterVideos()">
                    <span class="absolute left-4 top-3.5 text-dark-grey/40"><i class="fas fa-search text-xs"></i></span>
                </div>
                <div class="md:col-span-7 flex flex-wrap gap-2 justify-start md:justify-end" id="category-filters">
                    <button class="filter-btn active px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-electric-blue text-white border-electric-blue" onclick="setCategory('all', this)"><?php echo htmlspecialchars($options['all_label'] ?? 'All'); ?></button>
                    <?php foreach ($categories as $vcKey => $vcLabel): ?>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 <?php echo $chipBg; ?> text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('<?php echo htmlspecialchars($vcKey); ?>', this)"><?php echo htmlspecialchars($vcLabel); ?></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php if (!empty($items)): ?>
        <div class="<?php echo $gridClass; ?>" id="video-grid">
            <?php foreach ($items as $video):
                $cat = (string)($video['category'] ?? 'other');
                $catLabel = $categories[$cat] ?? ucfirst($cat);
                $yt = (string)($video['youtube_id'] ?? '');
            ?>
            <?php if ($mode === 'inline'): ?>
            <div class="video-card bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300" data-category="<?php echo htmlspecialchars($cat); ?>" data-title="<?php echo htmlspecialchars(strtolower((string)$video['title'])); ?>">
                <div class="relative aspect-video bg-black cursor-pointer group" onclick="loadPlayer(this, <?php echo htmlspecialchars(json_encode($yt), ENT_QUOTES); ?>)">
                    <img src="https://img.youtube.com/vi/<?php echo htmlspecialchars($yt); ?>/hqdefault.jpg" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102" alt="<?php echo htmlspecialchars($video['title']); ?>" loading="lazy">
                    <div class="absolute inset-0 bg-black/25 group-hover:bg-black/45 transition-colors duration-300 flex items-center justify-center">
                        <div class="w-14 h-14 bg-white/95 group-hover:bg-electric-blue rounded-full flex items-center justify-center text-electric-blue group-hover:text-white shadow-xl transition-all duration-300 transform scale-95 group-hover:scale-100">
                            <i class="fas fa-play text-lg ml-0.5 animate-pulse"></i>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-2">
                    <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-electric-blue px-2 py-0.5 bg-electric-blue/5 rounded-md"><?php echo htmlspecialchars($catLabel); ?></span>
                    <h3 class="text-base font-bold text-deep-indigo leading-snug"><?php echo htmlspecialchars($video['title']); ?></h3>
                    <p class="text-xs text-dark-grey/65 leading-relaxed"><?php echo htmlspecialchars($video['description'] ?? ''); ?></p>
                </div>
            </div>
            <?php else: ?>
            <div class="video-card group bg-white rounded-2xl overflow-hidden border border-slate-200/50 shadow-sm hover:shadow-xl transition-all duration-400 cursor-pointer"
                 data-category="<?php echo htmlspecialchars($cat); ?>" data-title="<?php echo htmlspecialchars(strtolower((string)$video['title'])); ?>"
                 onclick="playVideo(<?php echo htmlspecialchars(json_encode($yt), ENT_QUOTES); ?>, <?php echo htmlspecialchars(json_encode($video['title'], JSON_UNESCAPED_UNICODE), ENT_QUOTES); ?>, <?php echo htmlspecialchars(json_encode((string)($video['description'] ?? ''), JSON_UNESCAPED_UNICODE), ENT_QUOTES); ?>)">
                <div class="relative w-full aspect-video bg-dark-grey overflow-hidden">
                    <img src="https://img.youtube.com/vi/<?php echo htmlspecialchars($yt); ?>/hqdefault.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?php echo htmlspecialchars($video['title']); ?>" loading="lazy">
                    <div class="absolute inset-0 bg-black/35 group-hover:bg-black/50 transition-colors duration-300 flex items-center justify-center">
                        <div class="w-12 h-12 bg-white/90 group-hover:bg-electric-blue rounded-full flex items-center justify-center text-electric-blue group-hover:text-white shadow-lg transition-all duration-300 scale-95 group-hover:scale-100">
                            <i class="fas fa-play text-sm ml-0.5"></i>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <span class="inline-block text-[9px] font-bold uppercase tracking-wider text-electric-blue px-2 py-0.5 bg-electric-blue/5 rounded-md mb-1.5"><?php echo htmlspecialchars($catLabel); ?></span>
                    <h3 class="font-bold text-deep-indigo text-sm leading-snug group-hover:text-electric-blue transition-colors duration-300 line-clamp-1"><?php echo htmlspecialchars($video['title']); ?></h3>
                    <p class="text-xs text-dark-grey/55 leading-relaxed line-clamp-2 mt-1"><?php echo htmlspecialchars($video['description'] ?? ''); ?></p>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div id="pagination-controls" class="flex justify-center items-center space-x-2 mt-12"></div>

        <div id="no-results" class="hidden text-center py-12 max-w-md mx-auto space-y-3">
            <i class="fas fa-video-slash text-4xl text-dark-grey/30"></i>
            <h4 class="font-bold text-dark-grey"><?php echo htmlspecialchars($options['empty_title'] ?? 'No matching videos found'); ?></h4>
            <p class="text-xs text-dark-grey/55"><?php echo htmlspecialchars($options['empty_text'] ?? 'Try adjusting your search keywords or choosing a different category filter above.'); ?></p>
        </div>
        <?php else: ?>
        <p class="text-center text-xs text-dark-grey/55">No videos yet. Add them in CMS → Education Videos.</p>
        <?php endif; ?>
    </div>
</section>

<script>
let currentCategory = 'all';
const itemsPerPage = <?php echo max(1, $perPage); ?>;
let currentPage = 1;
let filteredCards = [];
<?php if ($mode === 'inline'): ?>
function loadPlayer(container, videoId) {
    container.innerHTML = '<iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
    container.removeAttribute('onclick');
}
<?php else: ?>
function playVideo(id, title, desc) {
    const player = document.getElementById('main-video-player');
    if (!player) { window.open('https://www.youtube.com/watch?v=' + id, '_blank'); return; }
    player.src = 'https://www.youtube.com/embed/' + id + '?autoplay=1&rel=0&modestbranding=1';
    const t = document.getElementById('main-video-title'); if (t) t.innerText = title;
    const d = document.getElementById('main-video-desc'); if (d) d.innerText = desc;
    window.scrollTo({ top: player.closest('section').offsetTop - 100, behavior: 'smooth' });
}
<?php endif; ?>
function setCategory(cat, btn) {
    currentCategory = cat;
    document.querySelectorAll('#category-filters .filter-btn').forEach(b => {
        b.classList.remove('bg-electric-blue', 'text-white', 'border-electric-blue');
        b.classList.add('<?php echo $chipBg; ?>', 'text-dark-grey/70', 'border-slate-200');
    });
    btn.classList.add('bg-electric-blue', 'text-white', 'border-electric-blue');
    btn.classList.remove('<?php echo $chipBg; ?>', 'text-dark-grey/70', 'border-slate-200');
    currentPage = 1;
    filterVideos();
}
function filterVideos() {
    const searchVal = document.getElementById('video-search').value.toLowerCase().trim();
    filteredCards = [];
    document.querySelectorAll('#video-grid .video-card').forEach(card => {
        const matchesCategory = (currentCategory === 'all' || card.getAttribute('data-category') === currentCategory);
        const matchesSearch = (searchVal === '' || card.getAttribute('data-title').includes(searchVal));
        if (matchesCategory && matchesSearch) { filteredCards.push(card); } else { card.classList.add('hidden'); }
    });
    const alert = document.getElementById('no-results');
    const pager = document.getElementById('pagination-controls');
    if (filteredCards.length === 0) { alert.classList.remove('hidden'); pager.classList.add('hidden'); }
    else { alert.classList.add('hidden'); pager.classList.remove('hidden'); renderPagination(); }
}
function renderPagination() {
    const totalPages = Math.ceil(filteredCards.length / itemsPerPage);
    const container = document.getElementById('pagination-controls');
    container.innerHTML = '';
    if (totalPages <= 1) { filteredCards.forEach(card => card.classList.remove('hidden')); container.classList.add('hidden'); return; }
    container.classList.remove('hidden');
    const startIndex = (currentPage - 1) * itemsPerPage, endIndex = startIndex + itemsPerPage;
    filteredCards.forEach((card, idx) => card.classList.toggle('hidden', !(idx >= startIndex && idx < endIndex)));
    const mk = (cls, html, onclick) => { const b = document.createElement('button'); b.className = cls; b.innerHTML = html; if (onclick) b.onclick = onclick; return b; };
    const idle = 'bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue';
    container.appendChild(mk('px-3 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 ' + (currentPage === 1 ? 'bg-slate-100 text-dark-grey/30 border-slate-200 cursor-not-allowed' : idle), '<i class="fas fa-chevron-left"></i>', currentPage > 1 ? () => { currentPage--; renderPagination(); scrollToGrid(); } : null));
    let startPage = Math.max(1, currentPage - 2), endPage = Math.min(totalPages, startPage + 4);
    if (endPage - startPage < 4) startPage = Math.max(1, endPage - 4);
    const dots = () => { const s = document.createElement('span'); s.className = 'text-dark-grey/40 text-xs px-1'; s.innerText = '...'; return s; };
    if (startPage > 1) { container.appendChild(mk('w-9 h-9 rounded-xl text-xs font-semibold border transition-all duration-300 ' + idle, '1', () => { currentPage = 1; renderPagination(); scrollToGrid(); })); if (startPage > 2) container.appendChild(dots()); }
    for (let i = startPage; i <= endPage; i++) container.appendChild(mk('w-9 h-9 rounded-xl text-xs font-semibold border transition-all duration-300 ' + (i === currentPage ? 'bg-electric-blue text-white border-electric-blue' : idle), String(i), () => { currentPage = i; renderPagination(); scrollToGrid(); }));
    if (endPage < totalPages) { if (endPage < totalPages - 1) container.appendChild(dots()); container.appendChild(mk('w-9 h-9 rounded-xl text-xs font-semibold border transition-all duration-300 ' + idle, String(totalPages), () => { currentPage = totalPages; renderPagination(); scrollToGrid(); })); }
    container.appendChild(mk('px-3 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 ' + (currentPage === totalPages ? 'bg-slate-100 text-dark-grey/30 border-slate-200 cursor-not-allowed' : idle), '<i class="fas fa-chevron-right"></i>', currentPage < totalPages ? () => { currentPage++; renderPagination(); scrollToGrid(); } : null));
}
function scrollToGrid() { const grid = document.getElementById('video-grid'); if (grid) window.scrollTo({ top: grid.offsetTop - 120, behavior: 'smooth' }); }
window.addEventListener('DOMContentLoaded', filterVideos);
</script>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * collection-grid variant: case-studies — alternating media + narrative cards
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_collection_variant_case_studies')) {
    function cms_collection_variant_case_studies(array $block, array $options, array $items, $collection) {
        $badgeClasses = [
            'red' => 'bg-red-100 text-red-700', 'electric-blue' => 'bg-electric-blue/10 text-electric-blue',
            'cyan-accent' => 'bg-cyan-accent/15 text-cyan-800', 'deep-indigo' => 'bg-deep-indigo/10 text-deep-indigo',
            'dark' => 'bg-dark-grey/10 text-dark-grey', 'emerald' => 'bg-emerald-100 text-emerald-700', 'amber' => 'bg-amber-100 text-amber-700',
        ];
        cms_block_section_open($block, 'bg-white', 'py-16', '');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block, 'text-center max-w-3xl mx-auto mb-12', 'plain'); ?>
        <div class="space-y-12">
            <?php foreach ($items as $csIdx => $cs):
                $mediaFirst = ($csIdx % 2 === 1);
                $csYt = trim((string)($cs['youtube_id'] ?? ''));
                $csImg = $csYt === '' ? cms_media_path($cs['image'] ?? '') : '';
                $badgeCls = $badgeClasses[$cs['badge_color'] ?? 'electric-blue'] ?? $badgeClasses['electric-blue'];
                $badgeIcon = trim((string)($cs['badge_icon'] ?? 'fa-brain'));
                $hasMedia = $csYt !== '' || $csImg !== '';
                $media = function ($first) use ($csYt, $csImg, $cs) {
                    $order = $first ? ' order-2 lg:order-1' : '';
                    if ($csYt !== ''): ?>
                <div class="lg:col-span-5<?php echo $order; ?> relative aspect-video lg:h-full bg-black flex items-center justify-center overflow-hidden">
                    <iframe class="w-full h-full lg:absolute lg:inset-0" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($csYt); ?>?rel=0&modestbranding=1" title="<?php echo htmlspecialchars($cs['title'] ?? 'Patient story'); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                </div>
                    <?php else: ?>
                <div class="lg:col-span-5<?php echo $order; ?> relative aspect-[4/3] lg:h-full overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="<?php echo htmlspecialchars($csImg); ?>" alt="<?php echo htmlspecialchars($cs['alt'] ?? $cs['title'] ?? ''); ?>" class="w-full h-full object-cover<?php echo $first ? ' object-top' : ''; ?> hover:scale-105 transition-transform duration-700" loading="lazy">
                </div>
                    <?php endif;
                };
            ?>
            <div class="bg-slate-50 border border-slate-200/50 rounded-[32px] overflow-hidden hover:shadow-xl transition-all duration-500 grid grid-cols-1 lg:grid-cols-12 items-center gap-6 lg:gap-0 observe">
                <?php if ($hasMedia && $mediaFirst) $media(true); ?>
                <div class="<?php echo $hasMedia ? 'lg:col-span-7' : 'lg:col-span-12'; ?> <?php echo ($hasMedia && $mediaFirst) ? 'order-1 lg:order-2 ' : ''; ?>p-8 md:p-10 space-y-4">
                    <?php if (trim((string)($cs['badge_label'] ?? '')) !== ''): ?>
                    <div class="inline-flex items-center space-x-2 <?php echo $badgeCls; ?> text-xs font-bold px-3 py-1 rounded-full">
                        <?php if ($badgeIcon !== '' && $badgeIcon !== 'none'): ?><i class="fas <?php echo htmlspecialchars($badgeIcon); ?><?php echo $badgeIcon === 'fa-heartbeat' ? ' animate-pulse' : ''; ?>"></i><?php endif; ?>
                        <span><?php echo htmlspecialchars($cs['badge_label']); ?></span>
                    </div>
                    <?php endif; ?>
                    <h3 class="text-2xl font-bold text-deep-indigo font-serif"><?php echo htmlspecialchars($cs['title'] ?? ''); ?></h3>
                    <div class="text-sm text-dark-grey/70 leading-relaxed"><?php echo cms_render_html($cs['narrative'] ?? ''); ?></div>
                    <?php if (trim((string)($cs['metric1_text'] ?? '')) !== '' || trim((string)($cs['metric2_text'] ?? '')) !== ''): ?>
                    <div class="pt-2 flex items-center space-x-4 text-xs font-semibold text-dark-grey/60">
                        <?php if (trim((string)($cs['metric1_text'] ?? '')) !== ''): $m1 = trim((string)($cs['metric1_icon'] ?? 'fa-clock')); ?><span><i class="<?php echo htmlspecialchars($m1 === 'fa-clock' ? 'far fa-clock' : 'fas ' . $m1); ?> mr-1.5 text-electric-blue"></i><?php echo htmlspecialchars($cs['metric1_text']); ?></span><?php endif; ?>
                        <?php if (trim((string)($cs['metric2_text'] ?? '')) !== ''): ?><span><i class="fas <?php echo htmlspecialchars(trim((string)($cs['metric2_icon'] ?? 'fa-check-circle'))); ?> mr-1.5 text-electric-blue"></i><?php echo htmlspecialchars($cs['metric2_text']); ?></span><?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if ($hasMedia && !$mediaFirst) $media(false); ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php cms_block_button($block); ?>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * testimonials variants
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_testimonials_variant_cards')) {
    /** patient-reviews page: light cards with stars, quote, name and role pill */
    function cms_testimonials_variant_cards(array $block, array $options, array $list) {
        cms_block_section_open($block, 'bg-white', 'py-8', '');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
        <?php if (!empty($list)): ?>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($list as $t): ?>
            <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow relative">
                <div class="flex text-yellow-400 text-xs"><?php for ($i = 0; $i < (int)($t['rating'] ?? 5); $i++): ?><i class="fas fa-star mr-0.5"></i><?php endfor; ?></div>
                <p class="text-xs text-dark-grey/70 leading-relaxed italic">"<?php echo $t['message']; ?>"</p>
                <div class="pt-2 border-t border-slate-200/40 flex justify-between items-center text-[10px]">
                    <strong class="text-deep-indigo text-xs"><?php echo $t['name']; ?></strong>
                    <span class="text-dark-grey/55 font-medium bg-white px-2 py-0.5 rounded-full border border-slate-200/30"><?php echo $t['role']; ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p class="text-center text-xs text-dark-grey/55">No patient reviews available in site configuration.</p>
        <?php endif; ?>
        <?php cms_block_button($block); ?>
    </div>
</section>
        <?php
    }
}

if (!function_exists('cms_testimonials_variant_stories')) {
    /** patient-success-stories page: long-form stories (testimonials of type "story") */
    function cms_testimonials_variant_stories(array $block, array $options, array $list) {
        $stories = cms_testimonials('story') ?? [];
        $limit = (int)($block['limit'] ?? 0);
        if ($limit > 0) $stories = array_slice($stories, 0, $limit);
        $palette = ['text-cyan-accent bg-cyan-50 border-cyan-100', 'text-red-650 bg-red-50 border-red-100'];
        cms_block_section_open($block, 'bg-white', 'py-16', '');
        ?>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <?php cms_render_pill_header($block, 'text-center max-w-3xl mx-auto', 'plain'); ?>
        <?php foreach ($stories as $stIdx => $st):
            $pill = $palette[$stIdx % count($palette)];
            $byline = trim((string)$st['name']) . (trim((string)($st['city'] ?? '')) !== '' ? ', ' . $st['city'] : '');
        ?>
        <div class="bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-deep-indigo font-serif"><?php echo htmlspecialchars(trim((string)($st['title'] ?? '')) !== '' ? $st['title'] : $st['condition']); ?></h3>
                <?php if (trim((string)$st['condition']) !== ''): ?>
                <span class="text-xs font-semibold <?php echo $pill; ?> px-3 py-1 rounded-full border"><?php echo htmlspecialchars($st['condition']); ?></span>
                <?php endif; ?>
            </div>
            <p class="text-xs text-dark-grey/70 leading-relaxed italic">"<?php echo cms_render_html($st['message']); ?>"</p>
            <p class="text-[11px] font-bold text-deep-indigo text-right">— <?php echo htmlspecialchars($byline); ?></p>
        </div>
        <?php endforeach; ?>
        <?php if (empty($stories)): ?>
        <p class="text-center text-sm text-dark-grey/55">Patient stories will appear here once they are added in the CMS.</p>
        <?php endif; ?>
    </div>
</section>
        <?php
    }
}

if (!function_exists('cms_testimonials_variant_video_grid')) {
    /** video-testimonials page: 9:16 YouTube embeds in a grid ($videoTestimonials) */
    function cms_testimonials_variant_video_grid(array $block, array $options, array $list) {
        $videos = isset($GLOBALS['videoTestimonials']) && is_array($GLOBALS['videoTestimonials']) ? $GLOBALS['videoTestimonials'] : [];
        $limit = (int)($block['limit'] ?? 0);
        if ($limit > 0) $videos = array_slice($videos, 0, $limit);
        cms_block_section_open($block, 'bg-white', 'py-16', '');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block, 'text-center max-w-3xl mx-auto mb-12', 'plain'); ?>
        <?php if (!empty($videos)): ?>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <?php foreach ($videos as $vid): ?>
            <div class="bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="relative aspect-[9/16] bg-black">
                    <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($vid['id'] ?? ''); ?>?rel=0" title="<?php echo htmlspecialchars($vid['title'] ?? ''); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
                </div>
                <div class="p-5 text-center">
                    <h3 class="text-xs font-bold text-deep-indigo leading-snug"><?php echo htmlspecialchars($vid['title'] ?? ''); ?></h3>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p class="text-center text-xs text-dark-grey/55">No video testimonials available in site configuration.</p>
        <?php endif; ?>
        <?php cms_block_button($block); ?>
    </div>
</section>
        <?php
    }
}
