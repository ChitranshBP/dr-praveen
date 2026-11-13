<?php
/**
 * Additional CMS block types (homepage & content-page sections).
 *
 * Each type has a renderer cms_render_block_{type}() picked up automatically
 * by cms_render_page_block(), an entry in cms_block_type_catalog_extra() so
 * the page editor knows its fields, and (optionally) starter content in
 * cms_block_blank_extra().
 *
 * Block field conventions used here:
 *   badge, badge_icon, title (HTML allowed when options.title_html), description
 *   image, image_alt, text (rich/paragraphs), text_after, bullets (list)
 *   button_text / button_url, button2_text / button2_url  (URL tokens via cms_nav_href)
 *   items[] with icon, color, title, subtitle, text, bullets, image, url
 *   collection, variant, limit  (collection-grid)
 */

if (!function_exists('cms_block_type_catalog_extra')) {
    function cms_block_type_catalog_extra() {
        return [
            'banner-slider'   => ['label' => 'Homepage banner slider', 'item_label' => 'Slide', 'no_items' => true, 'fields' => ['title'], 'help' => 'Slides are managed in CMS → Hero Banners. The heading here is the hidden SEO H1.'],
            'services-grid'   => ['label' => 'Services card grid', 'no_items' => true, 'fields' => ['badge', 'badge_icon', 'title', 'description'], 'help' => 'Cards are managed in CMS → Brain & Spine Cards.'],
            'slideshow'       => ['label' => 'Image slideshow', 'item_label' => 'Slide', 'item_fields' => ['imagepair']],
            'stats'           => ['label' => 'Statistics', 'item_label' => 'Statistic', 'fields' => ['badge', 'badge_icon', 'title', 'description', 'bullets', 'variant'], 'help' => 'Variants: home (icon cards), tiles, strip (thin divided row), split (tiles left + heading/points right), plain.', 'item_fields' => ['icon_color', 'title', 'subtitle', 'text'], 'item_hints' => ['title' => 'Number — type a value or a token such as {stats_patients}, {stats_awards}, {stats_experience}, {stats_rating}, {stats_success}', 'subtitle' => 'Label under the number', 'text' => 'Short description (optional)']],
            'text-media'      => ['label' => 'Text + photo section', 'item_label' => 'Highlight', 'fields' => ['badge', 'badge_icon', 'title', 'text', 'text_after', 'bullets', 'button_text', 'button_url'], 'block_image' => true, 'item_fields' => ['icon_color', 'title', 'text'], 'item_hints' => ['title' => 'Highlight title (leave empty for a plain icon + text line)', 'text' => 'Highlight text']],
            'hero-list'       => ['label' => 'Banner designation lines', 'item_label' => 'Line', 'fields' => [], 'item_fields' => ['icon_color', 'text'], 'item_hints' => ['text' => 'Line text'], 'help' => 'Shown inside the dark page banner under the heading.'],
            'split-panel'     => ['label' => 'Text + side card (phone / email / button)', 'item_label' => 'Point', 'fields' => ['badge', 'title', 'text', 'button_text', 'button_url'], 'block_panel' => true, 'item_fields' => ['title', 'text'], 'help' => 'Left: heading, paragraph and points. Right: dark card with the title/text below, the hospital phone/email (options show_phone / show_email) and the button.'],
            'quote'           => ['label' => 'Quote / vision statement', 'no_items' => true, 'fields' => ['badge', 'title', 'text', 'description'], 'help' => 'The paragraph field is the large italic quote; the intro field prints under it.'],
            'feature-split'   => ['label' => 'Feature list + photo', 'item_label' => 'Feature', 'fields' => ['badge', 'badge_icon', 'title', 'description', 'button_text', 'button_url'], 'block_image' => true, 'item_fields' => ['icon_color', 'title', 'text']],
            'strip'           => ['label' => 'Highlight strip (gradient banner with buttons)', 'no_items' => true, 'fields' => ['badge', 'badge_icon', 'title', 'description', 'button_text', 'button_url', 'button2_text', 'button2_url']],
            'team-grid'       => ['label' => 'Team cards', 'no_items' => true, 'fields' => ['badge', 'badge_icon', 'title', 'description', 'limit', 'button_text', 'button_url'], 'help' => 'Doctors are managed in CMS → Our Medical Team.'],
            'testimonials'    => ['label' => 'Written testimonials', 'no_items' => true, 'fields' => ['badge', 'badge_icon', 'title', 'description', 'variant', 'limit', 'button_text', 'button_url'], 'help' => 'Reviews are managed in CMS → Testimonials. Variants: marquee, slider, grid, cards, stories, video-grid.'],
            'blog-grid'       => ['label' => 'Blog article cards', 'no_items' => true, 'fields' => ['badge', 'badge_icon', 'title', 'description', 'variant', 'limit', 'button_text', 'button_url'], 'help' => 'Articles are managed in CMS → Blog Posts. Variants: teaser, all.'],
            'collection-grid' => ['label' => 'Collection grid (awards / gallery / videos / press / cases)', 'no_items' => true, 'fields' => ['badge', 'badge_icon', 'title', 'description', 'collection', 'variant', 'limit', 'button_text', 'button_url'], 'help' => 'Items come from the chosen collection screen in the CMS.'],
            'reels'           => ['label' => 'Instagram reels', 'no_items' => true, 'fields' => ['badge', 'badge_icon', 'title', 'description', 'button_text', 'button_url'], 'help' => 'Reels are managed in CMS → Instagram Reels; the handle comes from the Instagram URL in Settings.'],
        ];
    }
}

if (!function_exists('cms_block_blank_extra')) {
    function cms_block_blank_extra($type, array $def) {
        switch ($type) {
            case 'stats':
                $def['items'] = [['icon' => 'fas fa-user-group', 'color' => 'electric-blue', 'title' => '{stats_patients}', 'subtitle' => 'Patients Treated', 'text' => '']];
                break;
            case 'slideshow':
                $def['items'] = [];
                break;
            case 'text-media':
                $def['text'] = 'Write the paragraph(s) for this section.';
                $def['items'] = [];
                break;
            case 'hero-list':
                $def['placement'] = 'hero';
                $def['items'] = [['icon' => 'fa-award', 'color' => 'cyan-accent', 'text' => 'Designation line']];
                break;
            case 'split-panel':
                $def['text'] = 'Write the paragraph for this section.';
                $def['panel_title'] = 'Quick Appointment';
                $def['panel_text'] = 'Schedule a consultation with our team.';
                $def['button_text'] = 'Book Appointment Online';
                $def['button_url'] = 'contact-us-top-neurologist-delhi-ncr';
                $def['options'] = ['show_phone' => true];
                $def['items'] = [['title' => 'Point title', 'text' => 'One sentence about it.']];
                break;
            case 'quote':
                $def['text'] = 'The quotation goes here.';
                break;
            case 'feature-split':
                $def['items'] = [['icon' => 'fa-solid fa-circle-check', 'color' => 'electric-blue', 'title' => 'Feature', 'text' => 'One sentence about it.']];
                break;
            case 'collection-grid':
                $def['collection'] = 'awards';
                $def['variant'] = 'cards';
                break;
            case 'testimonials':
                $def['variant'] = 'grid';
                break;
            case 'blog-grid':
                $def['variant'] = 'teaser';
                $def['limit'] = 4;
                break;
        }
        return $def;
    }
}

/* ----------------------------------------------------------------------------
 * Shared helpers
 * -------------------------------------------------------------------------- */

if (!function_exists('cms_block_title_html')) {
    /** Title: HTML allowed (e.g. <span class="gradient-text">) when the block says so. */
    function cms_block_title_html(array $block) {
        $title = trim((string)($block['title'] ?? ''));
        $opts = isset($block['options']) && is_array($block['options']) ? $block['options'] : [];
        if (!empty($opts['title_html']) || !empty($block['title_html'])) {
            return strip_tags($title, '<span><br><em><strong><b><i>');
        }
        return htmlspecialchars($title);
    }
}

if (!function_exists('cms_render_pill_header')) {
    /**
     * Homepage-style centered section header: pill with icon + badge, serif
     * heading (HTML allowed) and intro paragraph.
     */
    function cms_render_pill_header(array $block, $wrapperClass = 'text-center max-w-3xl mx-auto mb-10 md:mb-12 observe', $style = null) {
        $badge = trim((string)($block['badge'] ?? ''));
        $title = trim((string)($block['title'] ?? ''));
        $desc = trim((string)($block['description'] ?? ''));
        $icon = trim((string)($block['badge_icon'] ?? ''));
        if ($badge === '' && $title === '' && $desc === '') {
            return;
        }
        $opts = isset($block['options']) && is_array($block['options']) ? $block['options'] : [];
        $style = $style ?: ($opts['header_style'] ?? 'pill');
        if ($style === 'line' || $style === 'plain') {
            // "line": eyebrow between two short rules (about page); "plain": small uppercase eyebrow.
            ?>
        <div class="<?php echo htmlspecialchars($wrapperClass); ?>">
            <?php if ($badge !== '' && $style === 'line'): ?>
            <div class="inline-flex items-center space-x-2 mb-6">
                <span class="w-8 h-px bg-electric-blue"></span>
                <span class="text-electric-blue text-xs font-semibold tracking-[0.2em] uppercase"><?php echo htmlspecialchars($badge); ?></span>
                <span class="w-8 h-px bg-electric-blue"></span>
            </div>
            <?php elseif ($badge !== ''): ?>
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider"><?php echo htmlspecialchars($badge); ?></span>
            <?php endif; ?>
            <?php if ($title !== ''): ?>
            <h2 class="<?php echo $style === 'line' ? 'text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4 leading-tight' : 'text-3xl font-bold text-deep-indigo font-serif mt-2'; ?>">
                <?php echo cms_block_title_html($block); ?>
            </h2>
            <?php endif; ?>
            <?php if ($desc !== ''): ?>
            <p class="<?php echo $style === 'line' ? 'text-base text-dark-grey/70 max-w-2xl mx-auto leading-relaxed' : 'text-sm text-dark-grey/65 mt-3 leading-relaxed'; ?>">
                <?php echo htmlspecialchars($desc); ?>
            </p>
            <?php endif; ?>
        </div>
            <?php
            return;
        }
        ?>
        <div class="<?php echo htmlspecialchars($wrapperClass); ?>">
            <?php if ($badge !== ''): ?>
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <?php if ($icon !== ''): ?><i class="<?php echo htmlspecialchars(strpos($icon, 'fa-') === 0 && strpos($icon, ' ') === false ? 'fas ' . $icon : $icon); ?> text-electric-blue text-sm"></i><?php endif; ?>
                <span class="text-electric-blue text-sm font-semibold"><?php echo htmlspecialchars($badge); ?></span>
            </div>
            <?php endif; ?>
            <?php if ($title !== ''): ?>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                <?php echo cms_block_title_html($block); ?>
            </h2>
            <?php endif; ?>
            <?php if ($desc !== ''): ?>
            <p class="text-lg text-dark-grey/70">
                <?php echo htmlspecialchars($desc); ?>
            </p>
            <?php endif; ?>
        </div>
        <?php
    }
}

if (!function_exists('cms_block_button')) {
    /** Gradient pill button used under homepage sections. */
    function cms_block_button(array $block, $textKey = 'button_text', $urlKey = 'button_url', $class = '', $wrapper = 'text-center mt-10 observe') {
        $text = trim((string)($block[$textKey] ?? ''));
        if ($text === '') {
            return;
        }
        $href = function_exists('cms_nav_href') ? cms_nav_href($block[$urlKey] ?? '#') : (string)($block[$urlKey] ?? '#');
        $class = $class !== '' ? $class : 'inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:shadow-electric-blue/40 hover:-translate-y-0.5 transition-all duration-300';
        if ($wrapper !== '') echo '<div class="' . htmlspecialchars($wrapper) . '">';
        ?>
            <a href="<?php echo htmlspecialchars($href); ?>" class="<?php echo htmlspecialchars($class); ?>">
                <span><?php echo htmlspecialchars($text); ?></span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        <?php
        if ($wrapper !== '') echo '</div>';
    }
}

if (!function_exists('cms_block_icon_class')) {
    /** Normalise "fa-brain" / "fas fa-brain" / "fa-solid fa-brain" to a full class. */
    function cms_block_icon_class($icon, $default = 'fas fa-check') {
        $icon = trim((string)$icon);
        if ($icon === '' || $icon === 'none') return $icon === 'none' ? '' : $default;
        return (strpos($icon, ' ') === false) ? 'fas ' . $icon : $icon;
    }
}

if (!function_exists('cms_block_wrap_attrs')) {
    /** Open the block's own <section> with id/bg/padding from "wrap". */
    function cms_block_section_open(array $block, $defaultBg = 'bg-white', $defaultPadding = 'py-10 md:py-14', $extra = 'relative overflow-hidden') {
        $wrap = isset($block['wrap']) && is_array($block['wrap']) ? $block['wrap'] : [];
        $id = trim((string)($wrap['id'] ?? ''));
        $cls = trim(((string)($wrap['padding'] ?? $defaultPadding)) . ' ' . ((string)($wrap['bg'] ?? $defaultBg)) . ' ' . ((string)($wrap['class'] ?? $extra)));
        echo '<section' . ($id !== '' ? ' id="' . htmlspecialchars($id) . '"' : '') . ' class="' . htmlspecialchars($cls) . '">';
    }
}

if (!function_exists('cms_resolve_stat_tokens')) {
    /** {stats_patients} → settings value. */
    function cms_resolve_stat_tokens($value) {
        global $cmsSettings;
        return preg_replace_callback('/\{([a-z0-9_]+)\}/i', function ($m) use ($cmsSettings) {
            $k = $m[1];
            if (isset($cmsSettings[$k]) && trim((string)$cmsSettings[$k]) !== '') return (string)$cmsSettings[$k];
            $fallbacks = ['stats_patients' => '3,00,000+', 'stats_success' => '1,00,000+', 'stats_awards' => '50+', 'stats_experience' => '20+', 'stats_rating' => '4.9'];
            return $fallbacks[$k] ?? $m[0];
        }, (string)$value);
    }
}

/* ----------------------------------------------------------------------------
 * banner-slider — homepage hero (banners.json)
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_banner_slider')) {
    function cms_render_block_banner_slider(array $block, array $options = [], $slug = null) {
        $banners = cms_json_read(CMS_DATA_DIR . '/banners.json') ?: [];
        $active = array_values(array_filter($banners, function ($b) { return is_array($b) && (!isset($b['is_active']) || !empty($b['is_active'])); }));
        usort($active, function ($a, $b) { return ((int)($a['order'] ?? 99)) <=> ((int)($b['order'] ?? 99)); });
        if (empty($active)) {
            $active = [['desktop_image' => 'assets/banner/dr-praveen-banner-desktop/stroke-care.jpeg', 'mobile_image' => 'assets/banner/dr-praveen-banner-mobile/stroke-care-mobile.jpeg', 'alt_text' => 'Dr. Praveen Gupta', 'order' => 1]];
        }
        $h1 = trim((string)($block['title'] ?? ''));
        ?>
<!-- Hero Section - Banner Slider (CMS → Hero Banners) -->
<section class="relative overflow-hidden bg-deep-indigo -mt-20 select-none">
    <?php if ($h1 !== ''): ?>
    <!-- SEO H1 (visually hidden - headline is baked into the banner artwork) -->
    <h1 class="sr-only"><?php echo htmlspecialchars($h1); ?></h1>
    <?php endif; ?>

    <div id="hero-slider" class="w-full max-w-[1920px] mx-auto relative">
        <div id="hero-track" class="flex transition-transform duration-700 ease-in-out">
            <?php foreach ($active as $bIndex => $banner):
                $desktopImg = $banner['desktop_image'] ?? 'assets/banner/dr-praveen-banner-desktop/stroke-care.jpeg';
                $mobileImg = !empty($banner['mobile_image']) ? $banner['mobile_image'] : $desktopImg;
                $alt = !empty($banner['alt_text']) ? $banner['alt_text'] : (!empty($banner['title']) ? $banner['title'] : 'Dr. Praveen Gupta Banner');
            ?>
            <div class="min-w-full relative">
                <picture>
                    <source media="(max-width: 639px)" srcset="<?php echo htmlspecialchars($mobileImg); ?>">
                    <source media="(min-width: 640px)" srcset="<?php echo htmlspecialchars($desktopImg); ?>">
                    <img src="<?php echo htmlspecialchars($desktopImg); ?>"
                         class="w-full h-auto object-cover object-[32%_center] md:object-center block"
                         alt="<?php echo htmlspecialchars($alt); ?>"
                         width="1440" height="500"
                         <?php echo $bIndex === 0 ? 'fetchpriority="high"' : 'loading="lazy"'; ?>>
                </picture>
                <?php if (!empty($banner['cta_text']) && !empty($banner['cta_link'])): ?>
                <a href="<?php echo htmlspecialchars(cms_nav_href($banner['cta_link'])); ?>" class="absolute inset-0 z-10" aria-label="<?php echo htmlspecialchars($banner['cta_text']); ?>"></a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Navigation Buttons -->
        <button id="hero-prev" type="button" aria-label="Previous slide"
                class="absolute left-3 md:left-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/20 hover:bg-black/45 text-white backdrop-blur-sm border border-white/20 flex items-center justify-center transition-all duration-300 active:scale-95 focus:outline-none z-20 shadow-md">
            <i class="fas fa-chevron-left text-sm md:text-base"></i>
        </button>
        <button id="hero-next" type="button" aria-label="Next slide"
                class="absolute right-3 md:right-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/20 hover:bg-black/45 text-white backdrop-blur-sm border border-white/20 flex items-center justify-center transition-all duration-300 active:scale-95 focus:outline-none z-20 shadow-md">
            <i class="fas fa-chevron-right text-sm md:text-base"></i>
        </button>

        <!-- Pagination Dots -->
        <div class="absolute bottom-4 md:bottom-6 left-1/2 -translate-x-1/2 flex items-center space-x-2.5 z-20">
            <?php foreach ($active as $dIndex => $b): ?>
            <button type="button" class="hero-dot w-2 h-2 rounded-full bg-white/45 transition-all duration-300 hover:bg-white" data-slide="<?php echo $dIndex; ?>" aria-label="Go to slide <?php echo $dIndex + 1; ?>"></button>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- JS for Hero Slider -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.getElementById('hero-slider');
        const track = document.getElementById('hero-track');
        if (!slider || !track) return;

        const dots = slider.querySelectorAll('.hero-dot');
        const prevBtn = document.getElementById('hero-prev');
        const nextBtn = document.getElementById('hero-next');
        const totalSlides = track.children.length;
        let currentIndex = 0;
        let autoplayTimer;

        function updateSlider(index) {
            currentIndex = (index + totalSlides) % totalSlides;
            track.style.transform = `translateX(-${currentIndex * 100}%)`;

            dots.forEach((dot, idx) => {
                if (idx === currentIndex) {
                    dot.classList.add('bg-white', 'w-6');
                    dot.classList.remove('bg-white/45');
                } else {
                    dot.classList.remove('bg-white', 'w-6');
                    dot.classList.add('bg-white/45');
                }
            });
        }

        function startAutoplay() {
            stopAutoplay();
            autoplayTimer = setInterval(() => updateSlider(currentIndex + 1), 5000);
        }

        function stopAutoplay() {
            if (autoplayTimer) clearInterval(autoplayTimer);
        }

        function goTo(index) {
            updateSlider(index);
            startAutoplay();
        }

        nextBtn.addEventListener('click', () => goTo(currentIndex + 1));
        prevBtn.addEventListener('click', () => goTo(currentIndex - 1));
        dots.forEach(dot => {
            dot.addEventListener('click', () => goTo(parseInt(dot.dataset.slide, 10)));
        });

        slider.addEventListener('mouseenter', stopAutoplay);
        slider.addEventListener('mouseleave', startAutoplay);

        // Touch / swipe support
        let touchStartX = 0;
        slider.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
            stopAutoplay();
        }, { passive: true });
        slider.addEventListener('touchend', (e) => {
            const delta = e.changedTouches[0].screenX - touchStartX;
            if (Math.abs(delta) > 50) {
                goTo(delta < 0 ? currentIndex + 1 : currentIndex - 1);
            } else {
                startAutoplay();
            }
        }, { passive: true });

        // Pause when the tab is hidden
        document.addEventListener('visibilitychange', () => {
            document.hidden ? stopAutoplay() : startAutoplay();
        });

        updateSlider(0);
        startAutoplay();
    });
    </script>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * services-grid — homepage / services page card grid (services.json)
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_services_grid')) {
    function cms_render_block_services_grid(array $block, array $options = [], $slug = null) {
        global $services;
        $list = is_array($services) ? $services : [];
        cms_block_section_open($block, 'bg-soft-cyan/30');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>

        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 pb-6 -mx-4 px-4 md:mx-0 md:px-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-8 md:pb-0">
            <?php foreach ($list as $index => $service):
                $storedLink = trim((string)($service['link'] ?? ''));
                $link = ($storedLink !== '' && $storedLink !== 'services') ? $storedLink : (function_exists('getServicePageLink') ? getServicePageLink($service['title']) : 'services');
                $cardWebp = trim((string)($service['webp'] ?? ''));
                $imageBase = strtolower(pathinfo((string)($service['image'] ?? ''), PATHINFO_FILENAME));
                $webpBase = strtolower(pathinfo($cardWebp, PATHINFO_FILENAME));
                $useWebp = ($cardWebp !== '' && $imageBase !== '' && $webpBase === $imageBase && file_exists(dirname(__DIR__) . '/' . $cardWebp));
                $cardAlt = trim((string)($service['image_alt'] ?? ''));
                if ($cardAlt === '') $cardAlt = trim((string)($service['alt'] ?? ''));
                if ($cardAlt === '') $cardAlt = trim((string)($service['title'] ?? ''));
                if ($cardAlt === '') $cardAlt = 'Neurology Service Card';
            ?>
                <a href="<?php echo htmlspecialchars($link); ?>" class="group bg-white rounded-3xl p-5 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 flex flex-col justify-between observe w-[80vw] md:w-auto flex-shrink-0 snap-start"
                    style="animation-delay: <?php echo $index * 100; ?>ms;">
                    <div>
                        <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-soft-cyan to-silver-grey">
                            <picture>
                                <?php if ($useWebp): ?>
                                <source srcset="<?php echo htmlspecialchars($cardWebp); ?>" type="image/webp">
                                <?php endif; ?>
                                <img src="<?php echo htmlspecialchars($service['image']); ?>" alt="<?php echo htmlspecialchars($cardAlt); ?>"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            </picture>
                        </div>
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-2xl font-bold text-deep-indigo group-hover:text-electric-blue transition-colors leading-tight">
                                <?php echo htmlspecialchars($service['title'] ?? ''); ?>
                            </h3>
                            <div class="w-10 h-10 rounded-full border border-silver-grey flex items-center justify-center text-dark-grey group-hover:text-white group-hover:bg-gradient-to-r group-hover:from-electric-blue group-hover:to-cyan-accent group-hover:border-transparent transition-all duration-300 flex-shrink-0 ml-4">
                                <i class="fas fa-arrow-right group-hover:-rotate-45 transition-transform duration-300"></i>
                            </div>
                        </div>
                        <p class="text-dark-grey/70 leading-relaxed text-sm mb-4">
                            <?php echo $service['description']; ?>
                        </p>
                        <?php if (!empty($service['bullet'])): ?>
                            <div class="mt-auto pt-4 border-t border-silver-grey/60 flex items-center space-x-2.5 text-xs font-bold">
                                <i class="fas <?php echo strpos($service['bullet'], '1800') !== false ? 'fa-phone-alt animate-pulse text-red-500' : 'fa-chevron-right text-cyan-accent'; ?> text-xs flex-shrink-0"></i>
                                <span class="<?php echo strpos($service['bullet'], '1800') !== false ? 'text-red-650 text-red-600' : 'text-dark-grey/75'; ?>"><?php echo htmlspecialchars($service['bullet']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php cms_block_button($block); ?>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * slideshow — full-width image carousel
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_slideshow')) {
    function cms_render_block_slideshow(array $block, array $options = [], $slug = null) {
        $items = array_values(array_filter(is_array($block['items'] ?? null) ? $block['items'] : [], function ($i) { return is_array($i) && trim((string)($i['image'] ?? '')) !== ''; }));
        if (empty($items)) return;
        $GLOBALS['cmsSlideshowCount'] = ($GLOBALS['cmsSlideshowCount'] ?? 0) + 1;
        $uid = 'banner-slider' . ($GLOBALS['cmsSlideshowCount'] > 1 ? '-' . $GLOBALS['cmsSlideshowCount'] : '');
        cms_block_section_open($block, 'bg-white', 'py-10 md:py-14', 'relative overflow-hidden select-none');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
        <div id="<?php echo $uid; ?>" class="relative w-full overflow-hidden rounded-3xl shadow-lg border border-silver-grey/50">
            <div class="flex transition-transform duration-700 ease-in-out" data-track>
                <?php foreach ($items as $i => $it): $src = cms_media_path($it['image'], $it['image']); ?>
                <div class="min-w-full relative">
                    <img src="<?php echo htmlspecialchars($src ?: $it['image']); ?>" alt="<?php echo htmlspecialchars(trim((string)($it['image_alt'] ?? $it['title'] ?? 'Slide ' . ($i + 1)))); ?>" <?php echo $i > 0 ? 'loading="lazy" ' : ''; ?>class="w-full h-auto block" width="1440" height="500">
                </div>
                <?php endforeach; ?>
            </div>
            <?php if (count($items) > 1): ?>
            <button type="button" data-prev class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/20 hover:bg-black/45 text-white backdrop-blur-sm border border-white/10 flex items-center justify-center transition-all duration-300 active:scale-95 focus:outline-none z-20 shadow-md" aria-label="Previous slide">
                <i class="fas fa-chevron-left text-sm md:text-base"></i>
            </button>
            <button type="button" data-next class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/20 hover:bg-black/45 text-white backdrop-blur-sm border border-white/10 flex items-center justify-center transition-all duration-300 active:scale-95 focus:outline-none z-20 shadow-md" aria-label="Next slide">
                <i class="fas fa-chevron-right text-sm md:text-base"></i>
            </button>
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center space-x-2.5 z-20">
                <?php foreach ($items as $i => $it): ?>
                <button type="button" class="banner-dot w-2 h-2 rounded-full bg-white/45 transition-all duration-300 hover:bg-white" data-slide="<?php echo $i; ?>" aria-label="Go to slide <?php echo $i + 1; ?>"></button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const root = document.getElementById('<?php echo $uid; ?>');
        if (!root) return;
        const track = root.querySelector('[data-track]');
        const slides = track.children;
        const dots = root.querySelectorAll('.banner-dot');
        const prevBtn = root.querySelector('[data-prev]');
        const nextBtn = root.querySelector('[data-next]');
        let currentIndex = 0;
        const totalSlides = slides.length;
        let autoplayTimer;
        function updateSlider(index) {
            currentIndex = index;
            track.style.transform = `translateX(-${index * 100}%)`;
            dots.forEach((dot, idx) => {
                if (idx === index) { dot.classList.add('bg-white', 'w-6'); dot.classList.remove('bg-white/45'); }
                else { dot.classList.remove('bg-white', 'w-6'); dot.classList.add('bg-white/45'); }
            });
        }
        function nextSlide() { updateSlider((currentIndex + 1) % totalSlides); }
        function prevSlide() { updateSlider((currentIndex - 1 + totalSlides) % totalSlides); }
        function startAutoplay() { stopAutoplay(); if (totalSlides > 1) autoplayTimer = setInterval(nextSlide, 5000); }
        function stopAutoplay() { if (autoplayTimer) clearInterval(autoplayTimer); }
        if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); startAutoplay(); });
        if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); startAutoplay(); });
        dots.forEach(dot => dot.addEventListener('click', () => { updateSlider(parseInt(dot.dataset.slide)); startAutoplay(); }));
        updateSlider(0);
        startAutoplay();
    });
    </script>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * stats — statistics tiles (variants: home, about, why, reviews)
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_stats')) {
    function cms_render_block_stats(array $block, array $options = [], $slug = null) {
        $items = is_array($block['items'] ?? null) ? array_values(array_filter($block['items'], 'is_array')) : [];
        if (empty($items)) return;
        $variant = $options['variant'] ?? ($block['variant'] ?? 'home');
        $cols = (int)($options['cols'] ?? count($items));
        $cols = max(1, min(4, $cols ?: 4));
        $gridCols = ['1' => 'lg:grid-cols-1', '2' => 'lg:grid-cols-2', '3' => 'lg:grid-cols-3', '4' => 'lg:grid-cols-4'][$cols];
        if ($variant === 'strip') {
            // Thin divided strip of numbers (about page).
            cms_block_section_open($block, 'bg-white', 'py-12', 'border-y border-silver-grey/60');
            ?>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
        <div class="grid grid-cols-2 md:grid-cols-<?php echo $cols; ?> divide-x divide-silver-grey/60">
            <?php foreach ($items as $stat): ?>
            <div class="text-center px-4 py-4">
                <div class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo"><?php echo htmlspecialchars(cms_resolve_stat_tokens($stat['title'] ?? '')); ?></div>
                <div class="text-xs text-dark-grey/60 mt-1 tracking-wide uppercase"><?php echo htmlspecialchars($stat['subtitle'] ?? ''); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
            <?php
            return;
        }
        if ($variant === 'split') {
            // 2×2 stat tiles on the left, heading + paragraph + check points on the right (why-choose page).
            $bullets = cms_block_bullets($block['bullets'] ?? []);
            cms_block_section_open($block, 'bg-white', 'py-16', '');
            ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 grid grid-cols-2 gap-6">
                <?php foreach ($items as $stat): ?>
                <div class="bg-gradient-to-br from-soft-cyan to-white p-6 rounded-3xl border border-cyan-accent/10 hover:shadow-md transition-shadow">
                    <span class="text-3xl md:text-4xl font-extrabold text-deep-indigo"><?php echo htmlspecialchars(cms_resolve_stat_tokens($stat['title'] ?? '')); ?></span>
                    <p class="text-sm font-semibold text-cyan-accent mt-1"><?php echo htmlspecialchars($stat['subtitle'] ?? ''); ?></p>
                    <?php if (trim((string)($stat['text'] ?? '')) !== ''): ?><p class="text-xs text-dark-grey/65 mt-2 leading-relaxed"><?php echo htmlspecialchars(cms_resolve_stat_tokens($stat['text'])); ?></p><?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="lg:col-span-6 space-y-6">
                <?php if (trim((string)($block['badge'] ?? '')) !== ''): ?><span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans"><?php echo htmlspecialchars($block['badge']); ?></span><?php endif; ?>
                <?php if (trim((string)($block['title'] ?? '')) !== ''): ?><h2 class="text-3xl font-bold text-deep-indigo font-serif"><?php echo cms_block_title_html($block); ?></h2><?php endif; ?>
                <?php if (trim((string)($block['description'] ?? '')) !== ''): ?><p class="text-sm text-dark-grey/70 leading-relaxed"><?php echo htmlspecialchars($block['description']); ?></p><?php endif; ?>
                <?php if (!empty($bullets)): ?>
                <div class="space-y-4">
                    <?php foreach ($bullets as $b): ?>
                    <div class="flex items-start space-x-3.5">
                        <div class="w-6 h-6 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-xs"></i></div>
                        <p class="text-xs text-dark-grey/70 leading-relaxed"><?php echo cms_render_html($b); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
            <?php
            return;
        }
        cms_block_section_open($block, 'bg-soft-cyan/30');
        ?>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
        <?php if ($variant === 'home'): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 <?php echo $gridCols; ?> gap-8">
            <?php foreach ($items as $stat): ?>
                <div class="group bg-white rounded-3xl p-6 md:p-8 border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col justify-between h-full text-left observe">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-electric-blue/10 text-electric-blue flex items-center justify-center text-xl mb-5 group-hover:bg-gradient-to-br group-hover:from-electric-blue group-hover:to-cyan-accent group-hover:text-white transition-all duration-300">
                            <i class="<?php echo htmlspecialchars(cms_block_icon_class($stat['icon'] ?? '', 'fas fa-chart-line')); ?>"></i>
                        </div>
                        <div class="text-4xl font-extrabold text-deep-indigo mb-1"><?php echo htmlspecialchars(cms_resolve_stat_tokens($stat['title'] ?? '')); ?></div>
                        <div class="text-base font-bold text-deep-indigo mb-4"><?php echo htmlspecialchars($stat['subtitle'] ?? ''); ?></div>
                        <?php if (trim((string)($stat['text'] ?? '')) !== ''): ?>
                        <div class="w-full h-px bg-silver-grey my-4"></div>
                        <p class="text-sm text-dark-grey/70 leading-relaxed mt-4"><?php echo htmlspecialchars(cms_resolve_stat_tokens($stat['text'])); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php elseif ($variant === 'tiles'): ?>
        <div class="grid grid-cols-2 <?php echo $gridCols; ?> gap-6 text-center">
            <?php foreach ($items as $stat): list($bgC, , $txtC) = cms_block_color($stat['color'] ?? 'electric-blue'); ?>
            <div class="bg-white border border-slate-200/50 rounded-3xl p-6 md:p-8 shadow-sm hover:shadow-md transition-shadow">
                <?php if (trim((string)($stat['icon'] ?? '')) !== '' && $stat['icon'] !== 'none'): ?>
                <div class="w-12 h-12 mx-auto <?php echo $bgC; ?> rounded-2xl flex items-center justify-center mb-4"><i class="<?php echo htmlspecialchars(cms_block_icon_class($stat['icon'])); ?> <?php echo $txtC; ?> text-xl"></i></div>
                <?php endif; ?>
                <div class="text-3xl md:text-4xl font-extrabold text-deep-indigo font-serif"><?php echo htmlspecialchars(cms_resolve_stat_tokens($stat['title'] ?? '')); ?></div>
                <div class="text-xs font-bold text-electric-blue uppercase tracking-wider mt-2"><?php echo htmlspecialchars($stat['subtitle'] ?? ''); ?></div>
                <?php if (trim((string)($stat['text'] ?? '')) !== ''): ?><p class="text-xs text-dark-grey/60 mt-2 leading-relaxed"><?php echo htmlspecialchars(cms_resolve_stat_tokens($stat['text'])); ?></p><?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="grid grid-cols-2 <?php echo $gridCols; ?> gap-8 text-center">
            <?php foreach ($items as $stat): ?>
            <div>
                <div class="text-4xl md:text-5xl font-extrabold text-deep-indigo font-serif"><?php echo htmlspecialchars(cms_resolve_stat_tokens($stat['title'] ?? '')); ?></div>
                <div class="text-sm font-semibold text-dark-grey/70 mt-2"><?php echo htmlspecialchars($stat['subtitle'] ?? ''); ?></div>
                <?php if (trim((string)($stat['text'] ?? '')) !== ''): ?><p class="text-xs text-dark-grey/55 mt-1"><?php echo htmlspecialchars(cms_resolve_stat_tokens($stat['text'])); ?></p><?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * text-media — portrait photo + badge/title/highlight lines/paragraphs/bullets/button
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_text_media')) {
    function cms_render_block_text_media(array $block, array $options = [], $slug = null) {
        $image = cms_media_path($block['image'] ?? '', '');
        $imageSide = $options['image_side'] ?? 'left';
        $aspect = $options['image_aspect'] ?? 'aspect-[4/5]';
        $headerStyle = $options['header_style'] ?? 'pill';      // pill | line
        $itemsStyle = $options['items_style'] ?? 'lines';       // lines (icon + text above copy) | tiles (2-col cards after copy) | list (check list after copy)
        $buttonStyle = $options['button_style'] ?? 'gradient';  // gradient | link
        $accents = isset($options['accent_images']) && is_array($options['accent_images']) ? $options['accent_images'] : [];
        $container = $options['container'] ?? 'max-w-7xl';
        $items = is_array($block['items'] ?? null) ? array_values(array_filter($block['items'], 'is_array')) : [];
        $bullets = cms_block_bullets($block['bullets'] ?? []);
        $badge = trim((string)($block['badge'] ?? ''));
        $icon = trim((string)($block['badge_icon'] ?? ''));
        $title = trim((string)($block['title'] ?? ''));
        $hasImage = $image !== '';
        $imageAlt = trim((string)($block['image_alt'] ?? $title));
        $titleClass = $headerStyle === 'line' ? 'text-3xl md:text-4xl font-serif font-bold text-deep-indigo mb-5 leading-tight' : 'text-4xl md:text-5xl font-serif font-bold text-deep-indigo leading-tight mb-4';
        if (!empty($options['title_class'])) $titleClass = $options['title_class'];
        $paraClass = $options['text_class'] ?? ($headerStyle === 'line' ? 'text-base text-dark-grey/70 leading-relaxed' : 'text-base text-dark-grey/85 leading-relaxed');
        $renderImage = function ($side) use ($image, $imageAlt, $aspect, $accents) {
            ?>
            <div class="lg:col-span-5 relative <?php echo $side === 'left' ? 'order-2 lg:order-1' : 'flex justify-center lg:justify-end'; ?> observe">
                <div class="relative <?php echo $side === 'left' ? 'max-w-md mx-auto' : 'w-full max-w-md lg:max-w-none'; ?>">
                    <div class="<?php echo htmlspecialchars($aspect); ?> rounded-3xl overflow-hidden shadow-xl ring-1 ring-silver-grey/50 bg-gradient-to-br from-soft-cyan to-silver-grey">
                        <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($imageAlt); ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" loading="lazy" width="500" height="625">
                    </div>
                    <?php foreach (array_values($accents) as $ai => $acc): if (!is_array($acc) || trim((string)($acc['image'] ?? '')) === '') continue; ?>
                    <div class="absolute <?php echo $ai === 0 ? '-top-6 -right-4 w-28 h-28' : '-bottom-6 -left-6 w-24 h-24'; ?> rounded-2xl overflow-hidden shadow-xl border-4 border-white hidden md:block">
                        <img src="<?php echo htmlspecialchars(cms_media_path($acc['image'], $acc['image'])); ?>" alt="<?php echo htmlspecialchars((string)($acc['alt'] ?? '')); ?>" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <?php endforeach; ?>
                    <div class="absolute -top-4 -left-4 w-24 h-24 rounded-full bg-gradient-to-br from-electric-blue/20 to-cyan-accent/20 blur-xl -z-10"></div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 rounded-full bg-gradient-to-br from-cyan-accent/20 to-electric-blue/20 blur-xl -z-10"></div>
                </div>
            </div>
            <?php
        };
        cms_block_section_open($block, 'bg-white');
        ?>
    <div class="<?php echo htmlspecialchars($container); ?> mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 <?php echo $hasImage ? 'lg:grid-cols-12' : ''; ?> gap-12 lg:gap-16 items-center">
            <?php if ($hasImage && $imageSide === 'left') $renderImage('left'); ?>

            <div class="<?php echo $hasImage ? 'lg:col-span-7' . ($imageSide === 'left' ? ' order-1 lg:order-2' : '') : 'max-w-4xl mx-auto'; ?> observe">
                <?php if ($badge !== '' && $headerStyle === 'line'): ?>
                <div class="inline-flex items-center space-x-2 mb-6">
                    <span class="w-8 h-px bg-electric-blue"></span>
                    <span class="text-electric-blue text-xs font-semibold tracking-[0.2em] uppercase"><?php echo htmlspecialchars($badge); ?></span>
                </div>
                <?php elseif ($badge !== ''): ?>
                <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                    <?php if ($icon !== ''): ?><i class="<?php echo htmlspecialchars(cms_block_icon_class($icon)); ?> text-electric-blue text-sm"></i><?php endif; ?>
                    <span class="text-electric-blue text-sm font-semibold"><?php echo htmlspecialchars($badge); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($title !== ''): ?>
                <h2 class="<?php echo htmlspecialchars($titleClass); ?>">
                    <?php echo cms_block_title_html($block); ?>
                </h2>
                <?php endif; ?>

                <?php if (!empty($items) && $itemsStyle === 'lines'): ?>
                <div class="flex flex-col space-y-2.5 mb-6">
                    <?php foreach ($items as $it): ?>
                    <div class="flex items-center space-x-2.5 text-electric-blue font-medium text-xs md:text-sm">
                        <i class="<?php echo htmlspecialchars(cms_block_icon_class($it['icon'] ?? '', 'fa-solid fa-certificate')); ?> text-cyan-accent flex-shrink-0 text-base"></i>
                        <span><?php echo htmlspecialchars(trim((string)(($it['text'] ?? '') !== '' ? $it['text'] : ($it['title'] ?? '')))); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php echo cms_section_paragraphs($block['text'] ?? '', $paraClass, 'mb-4'); ?>

                <?php if (!empty($bullets)): ?>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm text-dark-grey/80 border-l-2 border-cyan-accent/30 pl-4 py-1">
                    <?php foreach ($bullets as $b): ?>
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 bg-electric-blue rounded-full mt-2 flex-shrink-0"></span>
                        <span><?php echo cms_render_html($b); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php if (!empty($items) && $itemsStyle === 'tiles'): ?>
                <div class="grid grid-cols-2 gap-3 mt-7 mb-6">
                    <?php foreach ($items as $it): ?>
                    <div class="group flex items-start space-x-3 p-3 rounded-xl bg-soft-cyan/50 border border-silver-grey/40 hover:border-electric-blue/40 hover:bg-white transition-all duration-300">
                        <span class="w-9 h-9 rounded-lg bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 transition-colors">
                            <i class="<?php echo htmlspecialchars(cms_block_icon_class($it['icon'] ?? '', 'fas fa-check')); ?> text-electric-blue group-hover:text-white text-xs transition-colors"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-deep-indigo text-xs leading-tight"><?php echo htmlspecialchars(trim((string)($it['title'] ?? ''))); ?></p>
                            <p class="text-dark-grey/60 text-[11px] mt-0.5"><?php echo htmlspecialchars(trim((string)($it['text'] ?? ''))); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php elseif (!empty($items) && $itemsStyle === 'list'): ?>
                <ul class="space-y-5 mb-6">
                    <?php foreach ($items as $it): ?>
                    <li class="flex items-start space-x-4 group">
                        <span class="w-6 h-6 rounded-full bg-electric-blue/10 group-hover:bg-electric-blue flex items-center justify-center flex-shrink-0 mt-0.5 transition-colors">
                            <i class="<?php echo htmlspecialchars(cms_block_icon_class($it['icon'] ?? '', 'fas fa-check')); ?> text-electric-blue group-hover:text-white text-[10px] transition-colors"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-deep-indigo text-sm"><?php echo htmlspecialchars(trim((string)($it['title'] ?? ''))); ?></p>
                            <?php if (trim((string)($it['text'] ?? '')) !== ''): ?><p class="text-dark-grey/60 text-xs mt-0.5"><?php echo htmlspecialchars(trim((string)$it['text'])); ?></p><?php endif; ?>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php echo cms_section_paragraphs($block['text_after'] ?? '', $paraClass, 'mb-8'); ?>

                <?php if ($buttonStyle === 'link'): ?>
                    <?php if (trim((string)($block['button_text'] ?? '')) !== ''): ?>
                    <a href="<?php echo htmlspecialchars(cms_nav_href($block['button_url'] ?? '#')); ?>" class="group inline-flex items-center space-x-2 text-sm font-medium text-deep-indigo hover:text-electric-blue transition-colors">
                        <span><?php echo htmlspecialchars($block['button_text']); ?></span>
                        <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <?php endif; ?>
                <?php else: ?>
                    <?php cms_block_button($block, 'button_text', 'button_url', '', ''); ?>
                <?php endif; ?>
            </div>

            <?php if ($hasImage && $imageSide !== 'left') $renderImage('right'); ?>
        </div>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * hero-list — icon + text designation lines rendered inside the page banner
 * (block "placement": "hero"; templates call cms_render_page_flow($slug, ['placement' => 'hero']))
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_hero_list')) {
    function cms_render_block_hero_list(array $block, array $options = [], $slug = null) {
        $items = is_array($block['items'] ?? null) ? array_values(array_filter($block['items'], 'is_array')) : [];
        if (empty($items)) return;
        ?>
            <div class="space-y-3 mb-6 max-w-3xl">
                <?php foreach ($items as $it): $txt = trim((string)(($it['text'] ?? '') !== '' ? $it['text'] : ($it['title'] ?? ''))); if ($txt === '') continue; ?>
                <div class="flex items-start space-x-2.5">
                    <span class="w-5 h-5 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center mt-0.5 text-cyan-accent flex-shrink-0">
                        <i class="<?php echo htmlspecialchars(cms_block_icon_class($it['icon'] ?? '', 'fas fa-award')); ?> text-[10px]"></i>
                    </span>
                    <span class="text-sm md:text-base text-white/90 font-semibold leading-relaxed"><?php echo htmlspecialchars($txt); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * split-panel — copy + points on the left, dark contact/booking card on the right
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_split_panel')) {
    function cms_render_block_split_panel(array $block, array $options = [], $slug = null) {
        $items = is_array($block['items'] ?? null) ? array_values(array_filter($block['items'], 'is_array')) : [];
        $badge = trim((string)($block['badge'] ?? ''));
        $title = trim((string)($block['title'] ?? ''));
        $pTitle = trim((string)($block['panel_title'] ?? ''));
        $pText = trim((string)($block['panel_text'] ?? ''));
        $bText = trim((string)($block['button_text'] ?? ''));
        $pointStyle = $options['point_style'] ?? 'dot'; // dot | check
        $showPhone = !empty($options['show_phone']);
        $showEmail = !empty($options['show_email']);
        $hasPanel = $pTitle !== '' || $pText !== '' || $bText !== '' || $showPhone || $showEmail;
        cms_block_section_open($block, 'bg-white', 'py-16', '');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <div class="<?php echo $hasPanel ? 'lg:col-span-7' : 'lg:col-span-12'; ?> space-y-6">
                <?php if ($badge !== ''): ?><span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans"><?php echo htmlspecialchars($badge); ?></span><?php endif; ?>
                <?php if ($title !== ''): ?><h2 class="text-3xl md:text-4xl font-bold text-deep-indigo font-serif"><?php echo cms_block_title_html($block); ?></h2><?php endif; ?>
                <?php echo cms_section_paragraphs($block['text'] ?? '', 'text-sm text-dark-grey/70 leading-relaxed', ''); ?>
                <?php if (!empty($items)): ?>
                <div class="grid sm:grid-cols-2 gap-6<?php echo $pointStyle === 'check' ? ' text-xs text-dark-grey/70' : ''; ?>">
                    <?php foreach ($items as $it): $iTitle = trim((string)($it['title'] ?? '')); $iText = trim((string)($it['text'] ?? '')); ?>
                    <?php if ($pointStyle === 'check'): ?>
                    <div class="flex items-start space-x-3">
                        <div class="w-5 h-5 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></div>
                        <div><?php if ($iTitle !== ''): ?><strong class="text-deep-indigo"><?php echo htmlspecialchars($iTitle); ?></strong> <?php endif; ?><?php echo htmlspecialchars($iText); ?></div>
                    </div>
                    <?php else: ?>
                    <div class="space-y-2">
                        <h4 class="font-bold text-deep-indigo text-sm flex items-center space-x-2">
                            <span class="w-2 h-2 bg-cyan-accent rounded-full"></span>
                            <span><?php echo htmlspecialchars($iTitle); ?></span>
                        </h4>
                        <p class="<?php echo htmlspecialchars($options['point_text_class'] ?? 'text-xs text-dark-grey/65 leading-relaxed'); ?>"><?php echo htmlspecialchars($iText); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ($hasPanel): ?>
            <div class="lg:col-span-5 bg-gradient-to-br from-deep-indigo via-indigo-950 to-slate-900 text-white p-8 rounded-3xl shadow-xl space-y-6">
                <?php if ($pTitle !== ''): ?><h3 class="text-xl font-bold font-serif"><?php echo htmlspecialchars($pTitle); ?></h3><?php endif; ?>
                <?php if ($pText !== ''): ?><p class="text-xs text-white/80 leading-relaxed"><?php echo htmlspecialchars($pText); ?></p><?php endif; ?>
                <?php if ($showPhone || $showEmail): ?>
                <div class="space-y-4 pt-2">
                    <?php if ($showPhone): ?>
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-cyan-accent"><i class="fas fa-phone-alt"></i></div>
                        <div>
                            <p class="text-[10px] text-white/60 uppercase"><?php echo htmlspecialchars($options['phone_label'] ?? 'Direct Helpline'); ?></p>
                            <a href="tel:<?php echo htmlspecialchars(SITE_PHONE); ?>" class="text-sm font-bold hover:text-cyan-accent transition-colors"><?php echo htmlspecialchars(SITE_PHONE); ?></a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($showEmail): ?>
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-cyan-accent"><i class="fas fa-envelope"></i></div>
                        <div>
                            <p class="text-[10px] text-white/60 uppercase"><?php echo htmlspecialchars($options['email_label'] ?? 'Email Contact'); ?></p>
                            <a href="mailto:<?php echo htmlspecialchars(SITE_EMAIL); ?>" class="text-sm font-bold hover:text-cyan-accent transition-colors"><?php echo htmlspecialchars(SITE_EMAIL); ?></a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if ($bText !== ''): ?>
                <div class="pt-4 border-t border-white/10">
                    <a href="<?php echo htmlspecialchars(cms_nav_href($block['button_url'] ?? '#')); ?>" class="block w-full text-center bg-cyan-accent hover:bg-cyan-500 text-deep-indigo font-bold py-3 rounded-2xl transition-colors text-xs">
                        <?php echo htmlspecialchars($bText); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * quote — eyebrow, heading, large italic quotation, closing paragraph
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_quote')) {
    function cms_render_block_quote(array $block, array $options = [], $slug = null) {
        $badge = trim((string)($block['badge'] ?? ''));
        $title = trim((string)($block['title'] ?? ''));
        $quote = trim((string)($block['text'] ?? ''));
        $after = trim((string)($block['description'] ?? ''));
        cms_block_section_open($block, 'bg-white', 'py-14 lg:py-20', '');
        ?>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <?php if ($badge !== ''): ?>
        <div class="inline-flex items-center space-x-2 mb-8">
            <span class="w-8 h-px bg-electric-blue"></span>
            <span class="text-electric-blue text-xs font-semibold tracking-[0.2em] uppercase"><?php echo htmlspecialchars($badge); ?></span>
            <span class="w-8 h-px bg-electric-blue"></span>
        </div>
        <?php endif; ?>
        <?php if ($title !== ''): ?>
        <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo mb-10 leading-tight"><?php echo cms_block_title_html($block); ?></h2>
        <?php endif; ?>
        <?php if ($quote !== ''): ?>
        <div class="relative">
            <i class="fas fa-quote-left text-cyan-accent/20 text-5xl absolute -top-4 -left-4"></i>
            <p class="text-xl md:text-2xl text-deep-indigo/90 font-serif italic leading-relaxed relative"><?php echo cms_render_html($quote); ?></p>
        </div>
        <?php endif; ?>
        <?php if ($after !== ''): ?>
        <p class="text-sm text-dark-grey/60 mt-10 max-w-xl mx-auto leading-relaxed"><?php echo htmlspecialchars($after); ?></p>
        <?php endif; ?>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * feature-split — pill badge, title, intro, 2×2 icon features, button, photo
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_feature_split')) {
    function cms_render_block_feature_split(array $block, array $options = [], $slug = null) {
        $image = cms_media_path($block['image'] ?? '', '');
        $imageSide = $options['image_side'] ?? 'right';
        $items = is_array($block['items'] ?? null) ? array_values(array_filter($block['items'], 'is_array')) : [];
        $badge = trim((string)($block['badge'] ?? ''));
        $icon = trim((string)($block['badge_icon'] ?? ''));
        $title = trim((string)($block['title'] ?? ''));
        $desc = trim((string)($block['description'] ?? ''));
        $hasImage = $image !== '';
        cms_block_section_open($block, 'bg-soft-cyan/30');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 <?php echo $hasImage ? 'lg:grid-cols-12' : ''; ?> gap-12 lg:gap-16 items-center">
            <?php if ($hasImage && $imageSide === 'left'): ?>
            <div class="lg:col-span-5 relative flex justify-center lg:justify-start observe">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/5] rounded-3xl overflow-hidden border border-silver-grey/50 shadow-lg bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars(trim((string)($block['image_alt'] ?? $title))); ?>" class="w-full h-full object-cover" loading="lazy" width="500" height="625">
                </div>
            </div>
            <?php endif; ?>
            <div class="<?php echo $hasImage ? 'lg:col-span-7' : ''; ?> observe">
                <?php if ($badge !== ''): ?>
                <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                    <?php if ($icon !== ''): ?><i class="<?php echo htmlspecialchars(cms_block_icon_class($icon)); ?> text-electric-blue text-sm"></i><?php endif; ?>
                    <span class="text-electric-blue text-sm font-semibold"><?php echo htmlspecialchars($badge); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($title !== ''): ?>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo leading-tight mb-4">
                    <?php echo cms_block_title_html($block); ?>
                </h2>
                <?php endif; ?>
                <?php if ($desc !== ''): ?>
                <p class="text-lg text-dark-grey/70 mb-10 leading-relaxed max-w-xl">
                    <?php echo htmlspecialchars($desc); ?>
                </p>
                <?php endif; ?>

                <?php if (!empty($items)): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-10">
                    <?php foreach ($items as $it): list(, , $fsText) = cms_block_color($it['color'] ?? 'electric-blue'); ?>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white border border-silver-grey flex items-center justify-center flex-shrink-0 shadow-sm text-dark-grey">
                            <i class="<?php echo htmlspecialchars(cms_block_icon_class($it['icon'] ?? '', 'fa-solid fa-circle-check')); ?> text-xl <?php echo $fsText; ?>"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-deep-indigo mb-1 font-serif"><?php echo htmlspecialchars(trim((string)($it['title'] ?? ''))); ?></h4>
                            <p class="text-xs text-dark-grey/65 leading-relaxed"><?php echo htmlspecialchars(trim((string)($it['text'] ?? ''))); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php cms_block_button($block, 'button_text', 'button_url', '', ''); ?>
            </div>
            <?php if ($hasImage && $imageSide !== 'left'): ?>
            <div class="lg:col-span-5 relative flex justify-center lg:justify-end observe">
                <div class="relative w-full max-w-md lg:max-w-none aspect-[4/5] rounded-3xl overflow-hidden border border-silver-grey/50 shadow-lg bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars(trim((string)($block['image_alt'] ?? $title))); ?>" class="w-full h-full object-cover" loading="lazy" width="500" height="625">
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * strip — gradient highlight banner with icon, badge, title, text, 2 buttons
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_strip')) {
    function cms_render_block_strip(array $block, array $options = [], $slug = null) {
        $title = trim((string)($block['title'] ?? ''));
        if ($title === '') return;
        $badge = trim((string)($block['badge'] ?? ''));
        $icon = trim((string)($block['badge_icon'] ?? 'fa-video'));
        $desc = trim((string)($block['description'] ?? ''));
        $b1 = trim((string)($block['button_text'] ?? ''));
        $b2 = trim((string)($block['button2_text'] ?? ''));
        $b2url = (string)($block['button2_url'] ?? '');
        $b2href = cms_nav_href($b2url);
        $b2label = $b2;
        if (stripos($b2url, '{phone}') !== false && $b2 === '{phone}') $b2label = SITE_PHONE;
        $b2label = str_replace(['{phone}', '{stroke-helpline}'], [defined('SITE_PHONE') ? SITE_PHONE : '', defined('STROKE_HELPLINE') ? STROKE_HELPLINE : ''], $b2label);
        cms_block_section_open($block, 'bg-gradient-to-r from-deep-indigo via-electric-blue to-cyan-accent', 'py-8 md:py-10');
        ?>
    <div class="absolute -top-20 -left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 right-1/4 w-72 h-72 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    <?php if (!empty($options['watermark_icon'])): ?>
    <i class="<?php echo htmlspecialchars(cms_block_icon_class($options['watermark_icon'])); ?> absolute -right-6 top-1/2 -translate-y-1/2 text-white/10 text-[10rem] pointer-events-none hidden lg:block"></i>
    <?php endif; ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 observe">
            <div class="flex items-start sm:items-center gap-5">
                <?php if ($icon !== '' && $icon !== 'none'): ?>
                <div class="w-14 h-14 rounded-2xl bg-white/15 backdrop-blur-md border border-white/25 text-white flex items-center justify-center text-2xl flex-shrink-0">
                    <i class="<?php echo htmlspecialchars(cms_block_icon_class($icon)); ?>"></i>
                </div>
                <?php endif; ?>
                <div>
                    <?php if ($badge !== ''): ?>
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full border border-white/20 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-200 animate-pulse"></span>
                        <span class="text-white text-[11px] font-semibold uppercase tracking-wider"><?php echo htmlspecialchars($badge); ?></span>
                    </div>
                    <?php endif; ?>
                    <h2 class="text-2xl md:text-3xl font-serif font-bold text-white leading-tight mb-1.5">
                        <?php echo cms_block_title_html($block); ?>
                    </h2>
                    <?php if ($desc !== ''): ?>
                    <p class="text-sm md:text-base text-white/80 leading-relaxed max-w-xl">
                        <?php echo htmlspecialchars($desc); ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($b1 !== '' || $b2 !== ''): ?>
            <div class="flex flex-wrap items-center gap-4 flex-shrink-0">
                <?php if ($b1 !== ''): ?>
                <a href="<?php echo htmlspecialchars(cms_nav_href($block['button_url'] ?? '#')); ?>"
                   class="inline-flex items-center space-x-2.5 bg-white hover:bg-deep-indigo text-deep-indigo hover:text-white font-bold px-7 py-3.5 rounded-full shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <span><?php echo htmlspecialchars($b1); ?></span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
                <?php endif; ?>
                <?php if ($b2 !== ''): ?>
                <a href="<?php echo htmlspecialchars($b2href); ?>"
                   class="inline-flex items-center space-x-2.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/25 hover:border-white/50 text-white font-bold px-7 py-3.5 rounded-full transition-all duration-300">
                    <?php if (strncasecmp($b2href, 'tel:', 4) === 0): ?><i class="fas fa-phone-alt text-xs"></i><?php endif; ?>
                    <span><?php echo htmlspecialchars($b2label); ?></span>
                </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * team-grid — doctors from doctors.json (variants: home, grid, leader)
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_team_grid')) {
    function cms_render_block_team_grid(array $block, array $options = [], $slug = null) {
        $split = cms_team_split();
        $variant = $options['variant'] ?? ($block['variant'] ?? 'home');
        $limit = (int)($block['limit'] ?? ($options['limit'] ?? 0));
        $lead = $split['lead'];
        $team = $split['team'];
        $cardLabel = $options['card_label'] ?? 'View Profile';

        if ($variant === 'leader') {
            // Large clickable profile card for Dr. Praveen (team page "Clinical Director").
            cms_block_section_open($block, 'bg-white', 'py-16', '');
            ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block, 'text-center max-w-3xl mx-auto mb-12', 'plain'); ?>
        <?php if ($lead): ?>
        <div onclick="openPraveenModal()" class="max-w-4xl mx-auto bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 cursor-pointer hover:border-electric-blue/40">
            <div class="grid md:grid-cols-12 gap-8 items-center p-8">
                <div class="md:col-span-4 aspect-[4/5] rounded-2xl overflow-hidden relative shadow-md bg-gradient-to-br from-deep-indigo to-electric-blue p-0.5">
                    <div class="relative w-full h-full rounded-[0.9rem] overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent">
                        <img src="<?php echo htmlspecialchars($lead['image'] ?? ''); ?>" alt="<?php echo htmlspecialchars($lead['image_alt'] ?? $lead['alt'] ?? 'Dr. Praveen Gupta'); ?>" class="w-full h-full object-cover object-top">
                    </div>
                </div>
                <div class="md:col-span-8 space-y-4">
                    <span class="text-cyan-accent font-bold text-xs uppercase tracking-widest"><?php echo htmlspecialchars($lead['designation'] ?? ''); ?></span>
                    <h3 class="text-2xl font-bold text-deep-indigo font-serif"><?php echo htmlspecialchars($lead['name'] ?? ''); ?></h3>
                    <p class="text-sm text-dark-grey/70 leading-relaxed">
                        <?php echo htmlspecialchars($lead['modal']['sections']['About'][0] ?? ''); ?>
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <button onclick="event.stopPropagation(); openPraveenModal();" class="text-xs font-semibold text-electric-blue hover:underline"><?php echo htmlspecialchars($options['bio_label'] ?? 'Full Biography'); ?> <i class="fas fa-arrow-right text-[10px] ml-1"></i></button>
                        <?php if (trim((string)($block['button_text'] ?? '')) !== ''): ?>
                        <span class="text-slate-300">|</span>
                        <a href="<?php echo htmlspecialchars(cms_nav_href($block['button_url'] ?? '#')); ?>" onclick="event.stopPropagation();" class="text-xs font-semibold text-electric-blue hover:underline"><?php echo htmlspecialchars($block['button_text']); ?> <i class="fas fa-arrow-right text-[10px] ml-1"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
            <?php
            cms_doctor_modal_once();
            return;
        }

        $list = $team;
        if ($limit > 0) $list = array_slice($list, 0, $limit);

        if ($variant === 'grid') {
            // Team page grid: cards open the biography modal.
            cms_block_section_open($block, 'bg-slate-50', 'py-16', 'border-t border-b border-silver-grey/40');
            ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block, 'text-center max-w-3xl mx-auto mb-12', 'plain'); ?>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($list as $index => $doc): ?>
            <div onclick="openDoctorModal(<?php echo (int)$index; ?>)" class="bg-white border border-silver-grey/30 p-6 rounded-3xl hover:shadow-lg hover:border-electric-blue/30 transition-all duration-300 flex flex-col items-center text-center cursor-pointer group hover:-translate-y-1">
                <div class="w-32 h-32 rounded-full overflow-hidden mb-4 bg-gradient-to-br from-electric-blue to-cyan-accent p-0.5 shadow-md">
                    <img src="<?php echo htmlspecialchars($doc['image'] ?? ''); ?>" alt="<?php echo htmlspecialchars($doc['image_alt'] ?? $doc['alt'] ?? $doc['name'] ?? 'Doctor Profile'); ?>" class="w-full h-full object-cover object-top rounded-full group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="font-bold text-deep-indigo text-base leading-tight"><?php echo htmlspecialchars($doc['name'] ?? ''); ?></h3>
                <p class="text-[11px] text-cyan-accent font-semibold mt-1.5 leading-relaxed"><?php echo htmlspecialchars($doc['specialty'] ?? ''); ?></p>
                <p class="text-xs text-dark-grey/65 mt-2 leading-relaxed line-clamp-3"><?php echo htmlspecialchars($doc['designation'] ?? ''); ?></p>
                <div class="text-xs text-electric-blue font-semibold mt-auto pt-4 group-hover:underline flex items-center">
                    <span><?php echo htmlspecialchars($cardLabel); ?></span>
                    <i class="fas fa-arrow-right text-[9px] ml-1.5 transition-transform duration-300 group-hover:translate-x-0.5"></i>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php cms_block_button($block, 'button_text', 'button_url', '', 'text-center mt-10'); ?>
    </div>
</section>
            <?php
            cms_doctor_modal_once();
            return;
        }

        // Homepage carousel/grid of linked cards.
        $cardHref = (string)($options['card_url'] ?? 'team');
        cms_block_section_open($block, 'bg-soft-cyan/30');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>

        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 pb-6 -mx-4 px-4 sm:mx-0 sm:px-0 sm:grid sm:grid-cols-2 lg:grid-cols-4 sm:gap-8 sm:pb-0 mb-10">
            <?php foreach ($list as $doc): ?>
            <a href="<?php echo htmlspecialchars($cardHref); ?>" class="group bg-white border border-silver-grey/50 p-6 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 observe flex flex-col items-center text-center hover:-translate-y-2 w-[70vw] sm:w-auto flex-shrink-0 snap-start">
                <div class="w-32 h-32 rounded-full overflow-hidden mb-4 bg-gradient-to-br from-electric-blue to-cyan-accent p-0.5 shadow-md">
                    <img src="<?php echo htmlspecialchars($doc['image'] ?? ''); ?>" alt="<?php echo htmlspecialchars($doc['image_alt'] ?? $doc['alt'] ?? $doc['name'] ?? ''); ?>" class="w-full h-full object-cover object-top rounded-full transition-transform duration-500 group-hover:scale-105" loading="lazy" width="128" height="128">
                </div>
                <h3 class="font-bold text-deep-indigo text-base leading-tight"><?php echo htmlspecialchars($doc['name'] ?? ''); ?></h3>
                <p class="text-[11px] text-cyan-accent font-semibold mt-1.5 leading-relaxed"><?php echo htmlspecialchars($doc['specialty'] ?? ''); ?></p>
                <p class="text-xs text-dark-grey/65 mt-2 leading-relaxed line-clamp-3 font-light"><?php echo htmlspecialchars($doc['designation'] ?? ''); ?></p>
                <div class="text-xs text-electric-blue font-semibold mt-auto pt-4 group-hover:underline flex items-center">
                    <span><?php echo htmlspecialchars($cardLabel); ?></span>
                    <i class="fas fa-arrow-right text-[9px] ml-1.5 transition-transform duration-300 group-hover:translate-x-0.5"></i>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <?php cms_block_button($block, 'button_text', 'button_url', '', 'text-center'); ?>
    </div>
</section>
        <?php
    }
}

if (!function_exists('cms_team_split')) {
    /** Doctors split into the lead (Dr. Praveen) and the specialty team, in CMS order. */
    function cms_team_split() {
        static $split = null;
        if ($split !== null) return $split;
        $lead = null;
        $team = [];
        foreach ((array)(function_exists('cms_doctors') ? cms_doctors() : []) as $doc) {
            if (!is_array($doc)) continue;
            if ($lead === null && stripos((string)($doc['name'] ?? ''), 'Praveen') !== false) {
                $lead = $doc;
            } else {
                $team[] = $doc;
            }
        }
        $split = ['lead' => $lead, 'team' => $team];
        return $split;
    }
}

if (!function_exists('cms_doctor_modal_once')) {
    /** Biography modal + script shared by the team-grid "leader" and "grid" variants (printed once per page). */
    function cms_doctor_modal_once() {
        if (!empty($GLOBALS['cmsDoctorModalPrinted'])) return;
        $GLOBALS['cmsDoctorModalPrinted'] = true;
        $split = cms_team_split();
        ?>
<!-- Doctor Bio Modal Overlay -->
<div id="doctor-modal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div id="doctor-modal-backdrop" class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm transition-opacity duration-300 opacity-0"></div>
    <div id="doctor-modal-container" class="relative bg-white rounded-[32px] shadow-2xl max-w-4xl w-full max-h-[85vh] overflow-hidden flex flex-col md:flex-row transform scale-95 opacity-0 transition-all duration-300 z-10">
        <button onclick="closeDoctorModal()" class="absolute top-6 right-6 z-20 w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-all duration-200 shadow-sm focus:outline-none">
            <i class="fas fa-times text-base"></i>
        </button>
        <div class="w-full md:w-80 bg-gradient-to-b from-slate-50 to-slate-100/50 p-8 flex flex-col items-center border-b md:border-b-0 md:border-r border-slate-200/60 shrink-0">
            <div class="w-40 h-40 rounded-3xl overflow-hidden shadow-md bg-gradient-to-br from-deep-indigo to-electric-blue p-0.5 mb-6">
                <div class="relative w-full h-full rounded-[1.4rem] overflow-hidden bg-white">
                    <img id="modal-doc-image" src="" alt="" class="w-full h-full object-cover object-top">
                </div>
            </div>
            <h3 id="modal-doc-name" class="text-xl font-bold text-deep-indigo text-center font-serif leading-tight"></h3>
            <p id="modal-doc-specialty" class="text-xs text-electric-blue font-semibold uppercase tracking-wider text-center mt-2.5 px-2"></p>
            <div class="w-full border-t border-slate-200/80 my-6"></div>
            <div class="space-y-4 w-full">
                <div class="flex items-center space-x-3 bg-white p-3 rounded-2xl border border-slate-200/50 shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-electric-blue/10 flex items-center justify-center text-electric-blue shrink-0"><i class="fas fa-briefcase text-xs"></i></div>
                    <div>
                        <p class="text-[10px] text-dark-grey/50 uppercase font-semibold">Experience</p>
                        <p id="modal-doc-experience" class="text-xs font-bold text-deep-indigo"></p>
                    </div>
                </div>
                <div id="modal-doc-role-container" class="flex items-center space-x-3 bg-white p-3 rounded-2xl border border-slate-200/50 shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-cyan-accent/10 flex items-center justify-center text-cyan-accent shrink-0"><i class="fas fa-user-md text-xs"></i></div>
                    <div>
                        <p class="text-[10px] text-dark-grey/50 uppercase font-semibold">Role</p>
                        <p id="modal-doc-role" class="text-xs font-bold text-deep-indigo"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-grow p-8 overflow-y-auto max-h-[50vh] md:max-h-[85vh]">
            <div class="space-y-6 pr-2" id="modal-doc-details"></div>
        </div>
    </div>
</div>

<script>
    const praveenGuptaData = <?php echo json_encode($split['lead']); ?>;
    const specialtyTeamData = <?php echo json_encode($split['team']); ?>;

    function openDoctorModalFromData(data) {
        if (!data) return;
        document.getElementById('modal-doc-image').src = data.image || '';
        document.getElementById('modal-doc-image').alt = data.alt || data.name || '';
        document.getElementById('modal-doc-name').innerText = data.name || '';
        document.getElementById('modal-doc-specialty').innerText = data.specialty || '';
        document.getElementById('modal-doc-experience').innerText = data.experience || 'N/A';
        const roleContainer = document.getElementById('modal-doc-role-container');
        if (data.modal && data.modal.role) {
            document.getElementById('modal-doc-role').innerText = data.modal.role;
            roleContainer.classList.remove('hidden');
        } else {
            roleContainer.classList.add('hidden');
        }
        const detailsContainer = document.getElementById('modal-doc-details');
        detailsContainer.innerHTML = '';
        if (data.modal && data.modal.sections) {
            const sections = data.modal.sections;
            for (const [sectionTitle, items] of Object.entries(sections)) {
                if (!Array.isArray(items) || items.length === 0) continue;
                if (sectionTitle === 'Designation') continue;
                const sectionDiv = document.createElement('div');
                sectionDiv.className = 'space-y-3';
                let iconClass = 'fas fa-chevron-right';
                let listStyle = 'bullet';
                const titleLower = sectionTitle.toLowerCase();
                if (titleLower.includes('about')) { iconClass = 'fas fa-user'; listStyle = 'paragraphs'; }
                else if (titleLower.includes('qualification')) { iconClass = 'fas fa-graduation-cap'; listStyle = 'bullet'; }
                else if (titleLower.includes('expertise') || titleLower.includes('focus')) { iconClass = 'fas fa-check-circle'; listStyle = 'pills'; }
                else if (titleLower.includes('achievement') || titleLower.includes('award') || titleLower.includes('recognition')) { iconClass = 'fas fa-trophy text-amber-500'; listStyle = 'achievements'; }
                else if (titleLower.includes('research') || titleLower.includes('publication')) { iconClass = 'fas fa-book-open'; listStyle = 'bullet'; }
                else if (titleLower.includes('philanthropy') || titleLower.includes('innovation')) { iconClass = 'fas fa-lightbulb'; listStyle = 'bullet'; }
                else if (titleLower.includes('membership') || titleLower.includes('affiliation')) { iconClass = 'fas fa-id-card'; listStyle = 'pills'; }
                else if (titleLower.includes('experience')) { iconClass = 'fas fa-history'; listStyle = 'bullet'; }
                const header = document.createElement('h4');
                header.className = 'text-sm font-bold text-deep-indigo uppercase tracking-wider flex items-center space-x-2 border-b border-slate-100 pb-2 mt-4';
                header.innerHTML = `<i class="${iconClass} text-electric-blue shrink-0"></i> <span>${sectionTitle}</span>`;
                sectionDiv.appendChild(header);
                function parseRichText(str) {
                    if (!str) return '';
                    return str.replace(/\[([^\]]+)\]\((https?:\/\/[^\s\)\"]+|\/[^\s\)\"]+|tel:[^\s\)\"]+|mailto:[^\s\)\"]+)\)/gi, function(m, t, u) {
                        var isExt = /^https?:\/\//i.test(u) && !u.includes('drpraveengupta.com');
                        return '<a href="' + u + '" class="text-electric-blue hover:text-cyan-accent underline decoration-cyan-accent/50 hover:decoration-cyan-accent font-semibold transition-colors"' + (isExt ? ' target="_blank" rel="noopener noreferrer"' : '') + '>' + t + '</a>';
                    });
                }
                if (listStyle === 'paragraphs') {
                    items.forEach(text => { const p = document.createElement('p'); p.className = 'text-sm text-dark-grey/85 leading-relaxed'; p.innerHTML = parseRichText(text); sectionDiv.appendChild(p); });
                } else if (listStyle === 'pills') {
                    const flexDiv = document.createElement('div'); flexDiv.className = 'flex flex-wrap gap-2 pt-1';
                    items.forEach(text => { const pill = document.createElement('span'); pill.className = 'px-3 py-1.5 rounded-full bg-slate-50 border border-slate-200/60 text-[11px] text-deep-indigo font-semibold'; pill.innerHTML = parseRichText(text); flexDiv.appendChild(pill); });
                    sectionDiv.appendChild(flexDiv);
                } else if (listStyle === 'achievements') {
                    const ul = document.createElement('ul'); ul.className = 'space-y-2';
                    items.forEach(text => { const li = document.createElement('li'); li.className = 'flex items-start space-x-3 text-sm text-dark-grey/85 leading-relaxed bg-amber-50/20 p-3 rounded-2xl border border-amber-100/30'; li.innerHTML = `<i class="fas fa-star text-[10px] text-amber-500 shrink-0 mt-1"></i> <span>${parseRichText(text)}</span>`; ul.appendChild(li); });
                    sectionDiv.appendChild(ul);
                } else {
                    const ul = document.createElement('ul'); ul.className = 'space-y-2';
                    items.forEach(text => { const li = document.createElement('li'); li.className = 'flex items-start space-x-3 text-sm text-dark-grey/85 leading-relaxed'; li.innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-electric-blue shrink-0 mt-1.5"></span> <span>${parseRichText(text)}</span>`; ul.appendChild(li); });
                    sectionDiv.appendChild(ul);
                }
                detailsContainer.appendChild(sectionDiv);
            }
        }
        const modal = document.getElementById('doctor-modal');
        const backdrop = document.getElementById('doctor-modal-backdrop');
        const container = document.getElementById('doctor-modal-container');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            backdrop.classList.remove('opacity-0'); backdrop.classList.add('opacity-100');
            container.classList.remove('scale-95', 'opacity-0'); container.classList.add('scale-100', 'opacity-100');
        }, 10);
    }
    function openPraveenModal() { openDoctorModalFromData(praveenGuptaData); }
    function openDoctorModal(index) { if (specialtyTeamData && specialtyTeamData[index]) openDoctorModalFromData(specialtyTeamData[index]); }
    function closeDoctorModal() {
        const modal = document.getElementById('doctor-modal');
        const backdrop = document.getElementById('doctor-modal-backdrop');
        const container = document.getElementById('doctor-modal-container');
        backdrop.classList.remove('opacity-100'); backdrop.classList.add('opacity-0');
        container.classList.remove('scale-100', 'opacity-100'); container.classList.add('scale-95', 'opacity-0');
        setTimeout(() => { modal.classList.add('hidden'); document.body.style.overflow = ''; }, 300);
    }
    document.addEventListener('DOMContentLoaded', () => {
        const backdrop = document.getElementById('doctor-modal-backdrop');
        if (backdrop) backdrop.addEventListener('click', closeDoctorModal);
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') { const modal = document.getElementById('doctor-modal'); if (modal && !modal.classList.contains('hidden')) closeDoctorModal(); }
        });
    });
</script>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * testimonials — written reviews (variant marquee; others added with their pages)
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_testimonials')) {
    function cms_render_block_testimonials(array $block, array $options = [], $slug = null) {
        global $testimonials;
        $variant = $options['variant'] ?? ($block['variant'] ?? 'marquee');
        $list = is_array($testimonials) ? $testimonials : (cms_testimonials() ?? []);
        $limit = (int)($block['limit'] ?? 0);
        if ($limit > 0) $list = array_slice($list, 0, $limit);
        if ($variant === 'marquee') {
            cms_block_section_open($block, 'bg-white');
            ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
    </div>
    <?php
    $avatarColors = ['from-electric-blue to-cyan-accent', 'from-cyan-accent to-electric-blue', 'from-deep-indigo to-electric-blue', 'from-electric-blue to-deep-indigo'];
    $renderQuoteCard = function ($testimonial, $idx, $ariaHidden = false) use ($avatarColors) {
        $color = $avatarColors[$idx % count($avatarColors)];
        $rating = (int)($testimonial['rating'] ?? 5);
        ob_start(); ?>
        <div class="quote-card w-[300px] sm:w-[360px] flex-shrink-0 mr-6"<?php echo $ariaHidden ? ' aria-hidden="true"' : ''; ?>>
            <div class="h-full bg-white rounded-3xl p-7 border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-shadow duration-500 flex flex-col">
                <div class="flex items-center space-x-1 mb-4 text-amber-400 text-sm">
                    <?php for ($s = 0; $s < $rating; $s++): ?>
                        <i class="fas fa-star"></i>
                    <?php endfor; ?>
                </div>
                <p class="text-dark-grey/75 text-sm leading-relaxed flex-1 mb-5">
                    <?php echo $testimonial['message']; ?>
                </p>
                <div class="w-full h-px bg-silver-grey mb-4"></div>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br <?php echo $color; ?> flex items-center justify-center text-white font-bold text-sm shadow-md flex-shrink-0">
                        <?php echo strtoupper(substr($testimonial['name'], 0, 1)); ?>
                    </div>
                    <div>
                        <p class="font-bold text-deep-indigo text-sm leading-tight"><?php echo $testimonial['name']; ?></p>
                        <p class="text-xs text-cyan-accent font-medium mt-0.5"><?php echo $testimonial['role']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php return ob_get_clean();
    };
    ?>
    <div class="marquee-wrap relative observe">
        <div class="overflow-hidden">
            <div class="marquee-track flex w-max">
                <?php foreach ($list as $idx => $testimonial): echo $renderQuoteCard($testimonial, $idx); endforeach; ?>
                <?php foreach ($list as $idx => $testimonial): echo $renderQuoteCard($testimonial, $idx, true); endforeach; ?>
            </div>
        </div>
        <div class="absolute inset-y-0 left-0 w-12 md:w-32 bg-gradient-to-r from-white to-transparent pointer-events-none z-10"></div>
        <div class="absolute inset-y-0 right-0 w-12 md:w-32 bg-gradient-to-l from-white to-transparent pointer-events-none z-10"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_block_button($block); ?>
    </div>
    <style>
        @keyframes marquee-scroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        .marquee-track { animation: marquee-scroll 50s linear infinite; will-change: transform; }
        .marquee-track.marquee-reverse { animation-duration: 60s; animation-direction: reverse; }
        .marquee-wrap:hover .marquee-track { animation-play-state: paused; }
        @media (prefers-reduced-motion: reduce) { .marquee-track { animation: none; } }
    </style>
</section>
            <?php
            return;
        }
        if ($variant === 'slider') {
            // Paged 3-up slider with counter and dots (about page).
            $total = count($list);
            cms_block_section_open($block, 'bg-soft-cyan/30', 'py-14 lg:py-20', '');
            ?>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <?php if (trim((string)($block['badge'] ?? '')) !== ''): ?>
            <div class="inline-flex items-center space-x-2 mb-4">
                <span class="w-8 h-px bg-electric-blue"></span>
                <span class="text-electric-blue text-xs font-semibold tracking-[0.2em] uppercase"><?php echo htmlspecialchars($block['badge']); ?></span>
                <span class="w-8 h-px bg-electric-blue"></span>
            </div>
            <?php endif; ?>
            <?php if (trim((string)($block['title'] ?? '')) !== ''): ?>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-3"><?php echo cms_block_title_html($block); ?></h2>
            <?php endif; ?>
            <p class="text-sm text-dark-grey/60">
                <?php echo htmlspecialchars($options['counter_prefix'] ?? 'Showing'); ?> <span id="testimonial-current">3</span> of <?php echo $total; ?> <?php echo htmlspecialchars($options['counter_suffix'] ?? 'reviews'); ?>
            </p>
        </div>
        <div class="relative">
            <div id="testimonial-viewport" class="overflow-hidden">
                <div id="testimonial-track" class="flex transition-transform duration-500 ease-in-out">
                    <?php foreach ($list as $testimonial): ?>
                    <div class="testimonial-card flex-shrink-0 px-4 py-2" style="width: 33.333333%; min-width: 33.333333%; box-sizing: border-box;">
                        <div class="group h-full bg-white rounded-3xl p-7 border border-silver-grey/50 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 flex flex-col justify-between relative overflow-hidden">
                            <i class="fas fa-quote-right absolute right-6 top-6 text-slate-100 text-4xl pointer-events-none group-hover:text-electric-blue/5 transition-colors duration-300"></i>
                            <div>
                                <div class="flex space-x-0.5 mb-4 text-amber-400">
                                    <?php for ($i = 0; $i < (int)($testimonial['rating'] ?? 5); $i++): ?><i class="fas fa-star text-xs"></i><?php endfor; ?>
                                </div>
                                <p class="text-dark-grey/75 text-sm leading-relaxed mb-6 italic relative z-10">"<?php echo $testimonial['message']; ?>"</p>
                            </div>
                            <div class="w-full h-px bg-silver-grey/60 mb-4"></div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-electric-blue/15 to-cyan-accent/15 text-electric-blue font-bold text-sm flex items-center justify-center shadow-sm"><?php echo strtoupper(substr((string)$testimonial['name'], 0, 1)); ?></div>
                                <div>
                                    <p class="font-bold text-deep-indigo text-sm leading-tight"><?php echo $testimonial['name']; ?></p>
                                    <p class="text-[10px] text-cyan-accent font-semibold mt-0.5 uppercase tracking-wider"><?php echo $testimonial['role']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="flex items-center justify-center space-x-3 mt-8">
                <button id="testimonial-prev" type="button" class="w-10 h-10 rounded-full bg-white border border-silver-grey hover:border-electric-blue hover:bg-electric-blue hover:text-white text-deep-indigo flex items-center justify-center transition-all duration-300 shadow-sm active:scale-95" aria-label="Previous"><i class="fas fa-chevron-left text-xs"></i></button>
                <div id="testimonial-dots" class="flex items-center space-x-2"></div>
                <button id="testimonial-next" type="button" class="w-10 h-10 rounded-full bg-white border border-silver-grey hover:border-electric-blue hover:bg-electric-blue hover:text-white text-deep-indigo flex items-center justify-center transition-all duration-300 shadow-sm active:scale-95" aria-label="Next"><i class="fas fa-chevron-right text-xs"></i></button>
            </div>
        </div>
    </div>
    <style>
        @media (max-width: 767px) { .testimonial-card { width: 100% !important; min-width: 100% !important; } }
        @media (min-width: 768px) and (max-width: 1023px) { .testimonial-card { width: 50% !important; min-width: 50% !important; } }
        @media (min-width: 1024px) { .testimonial-card { width: 33.333333% !important; min-width: 33.333333% !important; } }
        .testimonial-dot.active { background-color: #2563EB !important; width: 24px !important; }
    </style>
    <script>
    (function() {
        const track = document.getElementById('testimonial-track');
        const prevBtn = document.getElementById('testimonial-prev');
        const nextBtn = document.getElementById('testimonial-next');
        const dotsBox = document.getElementById('testimonial-dots');
        const currentLabel = document.getElementById('testimonial-current');
        const viewport = document.getElementById('testimonial-viewport');
        if (!track || !viewport) return;
        const totalCards = <?php echo (int)$total; ?>;
        let currentPage = 0;
        function getCardsPerPage() { const w = window.innerWidth; if (w >= 1024) return 3; if (w >= 768) return 2; return 1; }
        function buildDots() {
            const maxPage = Math.max(0, Math.ceil(totalCards / getCardsPerPage()) - 1);
            dotsBox.innerHTML = '';
            for (let i = 0; i <= maxPage; i++) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'testimonial-dot rounded-full bg-silver-grey hover:bg-electric-blue transition-all duration-300';
                btn.style.width = '8px'; btn.style.height = '8px';
                btn.setAttribute('aria-label', 'Go to page ' + (i + 1));
                btn.addEventListener('click', function() { currentPage = i; update(); });
                dotsBox.appendChild(btn);
            }
        }
        function update() {
            const cardsPerPage = getCardsPerPage();
            const maxPage = Math.max(0, Math.ceil(totalCards / cardsPerPage) - 1);
            if (currentPage > maxPage) currentPage = maxPage;
            if (dotsBox.children.length !== maxPage + 1) buildDots();
            track.style.transform = 'translateX(-' + (currentPage * viewport.offsetWidth) + 'px)';
            if (currentLabel) currentLabel.textContent = Math.min(currentPage * cardsPerPage + cardsPerPage, totalCards);
            Array.from(dotsBox.children).forEach(function(d, i) { d.classList.toggle('active', i === currentPage); });
        }
        prevBtn.addEventListener('click', function() { if (currentPage > 0) { currentPage--; update(); } });
        nextBtn.addEventListener('click', function() { const maxPage = Math.max(0, Math.ceil(totalCards / getCardsPerPage()) - 1); if (currentPage < maxPage) { currentPage++; update(); } });
        let touchStartX = 0;
        viewport.addEventListener('touchstart', function(e) { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
        viewport.addEventListener('touchend', function(e) { const delta = e.changedTouches[0].screenX - touchStartX; if (Math.abs(delta) > 50) { (delta < 0 ? nextBtn : prevBtn).click(); } }, { passive: true });
        let resizeTimer;
        window.addEventListener('resize', function() { clearTimeout(resizeTimer); resizeTimer = setTimeout(update, 100); });
        update();
    })();
    </script>
</section>
            <?php
            return;
        }
        // Simple grid fallback (other variants are added with their pages)
        cms_block_section_open($block, 'bg-white');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($list as $t): ?>
            <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-6 md:p-8 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center space-x-1 text-amber-400"><?php for ($s = 0; $s < (int)($t['rating'] ?? 5); $s++): ?><i class="fas fa-star"></i><?php endfor; ?></div>
                    <p class="text-sm text-dark-grey/75 italic leading-relaxed">"<?php echo cms_render_html($t['message']); ?>"</p>
                </div>
                <div class="pt-6 border-t border-slate-200/60 mt-6">
                    <h4 class="font-bold text-dark-grey text-sm"><?php echo htmlspecialchars($t['name']); ?></h4>
                    <span class="text-xs text-electric-blue font-semibold"><?php echo htmlspecialchars($t['role']); ?></span>
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
 * blog-grid — latest articles (variant teaser)
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_blog_grid')) {
    function cms_render_block_blog_grid(array $block, array $options = [], $slug = null) {
        global $blogs;
        $list = is_array($blogs) ? $blogs : [];
        $limit = (int)($block['limit'] ?? 4);
        if ($limit > 0) $list = array_slice($list, 0, $limit);
        cms_block_section_open($block, 'bg-white');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>

        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 pb-6 -mx-4 px-4 md:mx-0 md:px-0 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6 md:pb-0">
            <?php foreach ($list as $blogIdx => $blog): ?>
                <a href="<?php echo htmlspecialchars($blog['url'] ?? '#'); ?>"
                   class="group bg-white rounded-3xl p-5 border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col observe w-[80vw] sm:w-[50vw] md:w-auto flex-shrink-0 snap-start"
                   style="animation-delay: <?php echo $blogIdx * 100; ?>ms;">
                    <div class="w-full aspect-[4/3] rounded-2xl overflow-hidden mb-5 bg-gradient-to-br from-soft-cyan to-silver-grey">
                        <picture>
                            <?php if (!empty($blog['webp']) && file_exists(dirname(__DIR__) . '/' . $blog['webp'])): ?>
                            <source srcset="<?php echo htmlspecialchars($blog['webp']); ?>" type="image/webp">
                            <?php endif; ?>
                            <img src="<?php echo htmlspecialchars($blog['image'] ?? ''); ?>"
                                 alt="<?php echo htmlspecialchars($blog['title'] ?? ''); ?>"
                                 loading="lazy"
                                 width="640" height="480"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </picture>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-deep-indigo leading-snug mb-2 line-clamp-2 group-hover:text-electric-blue transition-colors duration-300">
                        <?php echo $blog['title'] ?? ''; ?>
                    </h3>
                    <p class="text-xs sm:text-sm text-dark-grey/70 leading-relaxed mb-4 line-clamp-3 flex-1">
                        <?php echo $blog['excerpt'] ?? ''; ?>
                    </p>
                    <div class="mt-auto pt-3 border-t border-silver-grey/60 flex items-center justify-between text-xs">
                        <span class="inline-block bg-electric-blue/10 text-electric-blue font-bold px-2.5 py-1 rounded-full text-[11px]">
                            <?php echo $blog['category'] ?? ''; ?>
                        </span>
                        <span class="text-dark-grey/45 font-medium text-[11px]"><?php echo $blog['date'] ?? ''; ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <?php cms_block_button($block, 'button_text', 'button_url', 'inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-8 py-4 rounded-full shadow-lg shadow-electric-blue/30 hover:shadow-xl hover:shadow-electric-blue/40 hover:-translate-y-0.5 transition-all duration-300 group text-sm md:text-base', 'text-center mt-10 md:mt-12 observe'); ?>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * collection-grid — awards / videos (+ more variants added with their pages)
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_collection_grid')) {
    function cms_render_block_collection_grid(array $block, array $options = [], $slug = null) {
        $collection = preg_replace('/[^a-z0-9_]/', '', (string)($block['collection'] ?? ($options['collection'] ?? '')));
        $variant = (string)($block['variant'] ?? ($options['variant'] ?? 'cards'));
        $limit = (int)($block['limit'] ?? 0);
        $items = $collection !== '' ? cms_collection($collection) : [];
        if (!empty($options['featured_only']) || in_array($variant, ['awards-home', 'videos-home'], true)) {
            $items = array_values(array_filter($items, function ($i) { return !empty($i['featured']); }));
        }
        if ($limit > 0) $items = array_slice($items, 0, $limit);
        $fn = 'cms_collection_variant_' . str_replace('-', '_', $variant);
        if (function_exists($fn)) {
            $fn($block, $options, $items, $collection);
            return;
        }
        // Generic fallback: simple image/title cards
        cms_block_section_open($block, 'bg-white');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($items as $it): $img = cms_media_path($it['image'] ?? '', ''); ?>
            <div class="group bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                <?php if ($img !== ''): ?><div class="aspect-[4/3] overflow-hidden"><img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($it['alt'] ?? $it['title'] ?? ''); ?>" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"></div><?php endif; ?>
                <div class="p-6"><h3 class="text-sm font-bold text-deep-indigo leading-snug"><?php echo htmlspecialchars($it['title'] ?? $it['headline'] ?? ''); ?></h3></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php cms_block_button($block); ?>
    </div>
</section>
        <?php
    }
}

if (!function_exists('cms_collection_variant_awards_home')) {
    function cms_collection_variant_awards_home(array $block, array $options, array $items, $collection) {
        cms_block_section_open($block, 'bg-soft-cyan/30');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            <?php foreach ($items as $award): ?>
                <div class="group overflow-hidden rounded-3xl bg-white border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 aspect-[2/3] observe">
                    <picture>
                        <?php
                        $awardWebp = 'assets/webp/awards/' . pathinfo(basename((string)($award['image'] ?? '')), PATHINFO_FILENAME) . '.webp';
                        if (file_exists(dirname(__DIR__) . '/' . $awardWebp)): ?>
                        <source srcset="<?php echo $awardWebp; ?>" type="image/webp">
                        <?php endif; ?>
                        <img src="<?php echo htmlspecialchars($award['image'] ?? ''); ?>"
                             alt="<?php echo htmlspecialchars($award['alt'] ?? $award['title'] ?? ''); ?>"
                             class="w-full h-full object-cover transition-transform duration-500"
                             loading="lazy"
                             width="400" height="600">
                    </picture>
                </div>
            <?php endforeach; ?>
        </div>
        <?php cms_block_button($block); ?>
    </div>
</section>
        <?php
    }
}

if (!function_exists('cms_collection_variant_awards_tiles')) {
    /** About page: compact 2:3 award tiles with a text link underneath. */
    function cms_collection_variant_awards_tiles(array $block, array $options, array $items, $collection) {
        cms_block_section_open($block, 'bg-soft-cyan/30', 'py-14 lg:py-20', 'overflow-hidden');
        ?>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block, 'text-center mb-10', 'line'); ?>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 lg:gap-4">
            <?php foreach ($items as $it): $img = cms_media_path($it['image'] ?? '', ''); if ($img === '') continue; ?>
            <div class="aspect-[2/3] rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group cursor-pointer">
                <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($it['title'] ?? $it['alt'] ?? ''); ?>" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <?php endforeach; ?>
        </div>
        <?php if (trim((string)($block['button_text'] ?? '')) !== ''): ?>
        <div class="text-center mt-10">
            <a href="<?php echo htmlspecialchars(cms_nav_href($block['button_url'] ?? '#')); ?>" class="group inline-flex items-center space-x-2 text-sm font-medium text-deep-indigo hover:text-electric-blue transition-colors">
                <span><?php echo htmlspecialchars($block['button_text']); ?></span>
                <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>
        <?php
    }
}

if (!function_exists('cms_collection_variant_videos_home')) {
    function cms_collection_variant_videos_home(array $block, array $options, array $items, $collection) {
        $items = array_slice($items, 0, (int)($block['limit'] ?? 6) ?: 6);
        $pages = array_chunk($items, 3);
        cms_block_section_open($block, 'bg-white');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>

        <div class="sm:hidden flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 -mx-4 px-4 pb-4">
            <?php foreach ($items as $video): ?>
                <div class="flex-shrink-0 w-[80vw] snap-start bg-white rounded-3xl overflow-hidden border border-silver-grey/50 shadow-lg">
                    <div class="relative w-full aspect-video bg-dark-grey video-facade cursor-pointer group" data-embed="https://www.youtube.com/embed/<?php echo htmlspecialchars($video['youtube_id']); ?>?rel=0&modestbranding=1&autoplay=1">
                        <img src="https://img.youtube.com/vi/<?php echo htmlspecialchars($video['youtube_id']); ?>/hqdefault.jpg" alt="<?php echo htmlspecialchars($video['title']); ?>" loading="lazy" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/10 transition-colors">
                            <div class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-play text-white ml-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-deep-indigo text-sm leading-snug mb-1 line-clamp-1"><?php echo htmlspecialchars($video['title']); ?></h3>
                        <p class="text-xs text-dark-grey/55 leading-relaxed line-clamp-2"><?php echo htmlspecialchars($video['description'] ?? ''); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="hidden sm:block overflow-hidden">
            <div id="edu-track" class="flex transition-transform duration-500 ease-in-out">
                <?php foreach ($pages as $epIdx => $epPage): ?>
                    <div class="min-w-full grid grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php foreach ($epPage as $video): ?>
                            <div class="group bg-white rounded-3xl overflow-hidden border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 observe">
                                <div class="relative w-full aspect-video bg-dark-grey video-facade cursor-pointer group" data-embed="https://www.youtube.com/embed/<?php echo htmlspecialchars($video['youtube_id']); ?>?rel=0&modestbranding=1&autoplay=1">
                                    <img src="https://img.youtube.com/vi/<?php echo htmlspecialchars($video['youtube_id']); ?>/hqdefault.jpg" alt="<?php echo htmlspecialchars($video['title']); ?>" loading="lazy" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/10 transition-colors">
                                        <div class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                            <i class="fas fa-play text-white ml-1"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-deep-indigo text-sm md:text-base leading-snug mb-1 group-hover:text-electric-blue transition-colors duration-300 line-clamp-1"><?php echo htmlspecialchars($video['title']); ?></h3>
                                    <p class="text-xs text-dark-grey/55 leading-relaxed line-clamp-2"><?php echo htmlspecialchars($video['description'] ?? ''); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if (count($pages) > 1): ?>
        <div class="hidden sm:flex items-center justify-between gap-6 mt-8">
            <div class="flex items-center flex-wrap gap-2 flex-1 min-w-0" id="edu-dots">
                <?php foreach ($pages as $epIdx => $epPage): ?>
                    <button class="edu-dot rounded-full transition-all duration-300 <?php echo $epIdx === 0 ? 'w-6 h-2.5 bg-electric-blue' : 'w-2.5 h-2.5 bg-silver-grey'; ?>" aria-label="Go to video page <?php echo $epIdx + 1; ?>" data-page="<?php echo $epIdx; ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="flex items-center space-x-3">
                <button id="edu-prev" class="w-11 h-11 rounded-full bg-white hover:bg-electric-blue hover:text-white text-deep-indigo border border-silver-grey shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95"><i class="fas fa-chevron-left text-sm"></i></button>
                <button id="edu-next" class="w-11 h-11 rounded-full bg-electric-blue text-white hover:bg-deep-indigo border border-electric-blue shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95"><i class="fas fa-chevron-right text-sm"></i></button>
            </div>
        </div>
        <?php endif; ?>
        <?php cms_block_button($block); ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const track = document.getElementById('edu-track');
        if (!track) return;
        const dots = document.querySelectorAll('.edu-dot');
        const prevBtn = document.getElementById('edu-prev');
        const nextBtn = document.getElementById('edu-next');
        const total = track.children.length;
        let current = 0;
        function goTo(page) {
            current = page;
            track.style.transform = `translateX(-${page * 100}%)`;
            dots.forEach((d, i) => {
                if (i === page) { d.classList.add('bg-electric-blue', 'w-6'); d.classList.remove('bg-silver-grey', 'w-2.5'); }
                else { d.classList.remove('bg-electric-blue', 'w-6'); d.classList.add('bg-silver-grey', 'w-2.5'); }
            });
        }
        dots.forEach(d => d.addEventListener('click', () => goTo(+d.dataset.page)));
        if (prevBtn) prevBtn.addEventListener('click', () => goTo((current - 1 + total) % total));
        if (nextBtn) nextBtn.addEventListener('click', () => goTo((current + 1) % total));

        // Video facade: swap thumbnail for the YouTube player on click
        document.querySelectorAll('.video-facade').forEach(facade => {
            facade.addEventListener('click', function () {
                document.querySelectorAll('.video-facade iframe').forEach(iframe => {
                    let parent = iframe.parentElement;
                    iframe.remove();
                    parent.querySelector('img').style.display = 'block';
                    parent.querySelector('div.absolute').style.display = 'flex';
                });
                this.querySelector('img').style.display = 'none';
                this.querySelector('div.absolute').style.display = 'none';
                const iframe = document.createElement('iframe');
                iframe.className = 'w-full h-full absolute inset-0';
                iframe.src = this.dataset.embed;
                iframe.title = this.querySelector('img').alt;
                iframe.setAttribute('frameborder', '0');
                iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                iframe.setAttribute('allowfullscreen', '1');
                this.appendChild(iframe);
            });
        });
    });
    </script>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * reels — Instagram reels grid
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_reels')) {
    function cms_render_block_reels(array $block, array $options = [], $slug = null) {
        $reels = cms_collection('reels');
        $profile = defined('SOCIAL_INSTAGRAM') ? SOCIAL_INSTAGRAM : 'https://www.instagram.com/';
        $handle = trim((string)basename(rtrim((string)parse_url($profile, PHP_URL_PATH), '/')), '/@') ?: 'instagram';
        $avatar = cms_media_path($block['image'] ?? '', 'assets/dpg-1.webp');
        cms_block_section_open($block, 'bg-soft-cyan/30');
        $wrap = isset($block['wrap']) && is_array($block['wrap']) ? $block['wrap'] : [];
        $sectionId = trim((string)($wrap['id'] ?? 'instagram-reels'));
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <?php if (trim((string)($block['badge'] ?? '')) !== ''): ?>
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="<?php echo htmlspecialchars(cms_block_icon_class($block['badge_icon'] ?? 'fab fa-instagram', 'fab fa-instagram')); ?> text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold"><?php echo htmlspecialchars($block['badge']); ?></span>
            </div>
            <?php endif; ?>
            <?php if (trim((string)($block['title'] ?? '')) !== ''): ?>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                <?php echo cms_block_title_html($block); ?>
            </h2>
            <?php endif; ?>
            <?php if (trim((string)($block['description'] ?? '')) !== ''): ?>
            <p class="text-lg text-dark-grey/70 mb-6">
                <?php echo htmlspecialchars($block['description']); ?>
            </p>
            <?php endif; ?>

            <a href="<?php echo htmlspecialchars($profile); ?>" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-3 bg-white pl-2 pr-5 py-2 rounded-full border border-silver-grey/50 shadow-sm hover:shadow-lg transition-all duration-300 group">
                <span class="block p-[2px] rounded-full bg-gradient-to-tr from-cyan-accent via-electric-blue to-deep-indigo">
                    <img src="<?php echo htmlspecialchars($avatar); ?>" alt="<?php echo htmlspecialchars(trim((string)($block['image_alt'] ?? 'Dr. Praveen Gupta on Instagram'))); ?>"
                         loading="lazy"
                         class="w-10 h-10 rounded-full object-cover object-top border-2 border-white">
                </span>
                <span class="text-sm font-bold text-deep-indigo group-hover:text-electric-blue transition-colors duration-300">@<?php echo htmlspecialchars($handle); ?></span>
            </a>
        </div>

        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 -mx-4 px-4 pb-4 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-8 md:px-0 md:mx-0">
            <?php foreach ($reels as $reelIdx => $reel):
                $reelUrl = 'https://www.instagram.com/reel/' . rawurlencode((string)($reel['shortcode'] ?? '')) . '/';
            ?>
                <div class="flex-shrink-0 w-[80vw] snap-start md:w-auto observe" style="animation-delay: <?php echo $reelIdx * 120; ?>ms;">
                    <div class="group h-full p-[2px] rounded-3xl bg-gradient-to-br from-cyan-accent via-electric-blue to-deep-indigo shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="h-full bg-white rounded-[22px] overflow-hidden">
                            <blockquote class="instagram-media !m-0 !w-full !min-w-0 !max-w-none !border-0 !rounded-none !shadow-none"
                                data-instgrm-permalink="<?php echo $reelUrl; ?>?utm_source=ig_embed&amp;utm_campaign=loading"
                                data-instgrm-version="14">
                                <div class="ig-fallback flex flex-col items-center justify-center aspect-[9/16] w-full bg-gradient-to-br from-soft-cyan to-white px-6 text-center">
                                    <span class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-electric-blue to-cyan-accent text-white flex items-center justify-center text-2xl shadow-lg mb-4">
                                        <i class="fab fa-instagram"></i>
                                    </span>
                                    <p class="text-sm font-semibold text-deep-indigo mb-1">Reel by @<?php echo htmlspecialchars($handle); ?></p>
                                    <a href="<?php echo $reelUrl; ?>" target="_blank" rel="noopener noreferrer"
                                       class="text-sm font-bold text-electric-blue hover:underline">View this reel on Instagram</a>
                                </div>
                            </blockquote>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (trim((string)($block['button_text'] ?? '')) !== ''): ?>
        <div class="text-center mt-10 observe">
            <a href="<?php echo htmlspecialchars(trim((string)($block['button_url'] ?? '')) !== '' ? cms_nav_href($block['button_url']) : $profile); ?>" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:shadow-electric-blue/40 hover:-translate-y-0.5 transition-all duration-300">
                <span><?php echo htmlspecialchars($block['button_text']); ?></span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const igSection = document.getElementById('<?php echo htmlspecialchars($sectionId); ?>');
        if (!igSection) return;
        let igLoaded = false;
        const loadInstagram = () => {
            if (igLoaded) return;
            igLoaded = true;
            const script = document.createElement('script');
            script.async = true;
            script.src = 'https://www.instagram.com/embed.js';
            document.body.appendChild(script);
            ['scroll', 'mousemove', 'touchstart', 'click'].forEach(evt => { window.removeEventListener(evt, loadInstagram); });
        };
        ['scroll', 'mousemove', 'touchstart', 'click'].forEach(evt => { window.addEventListener(evt, loadInstagram, { passive: true, once: true }); });
    });
    </script>
</section>
        <?php
    }
}
