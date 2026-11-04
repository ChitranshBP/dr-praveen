<?php
/**
 * CMS-managed page body sections.
 *
 * Included automatically from includes/footer.php so every page gets a body
 * area that can be edited in CMS → All Pages. Templates that render their own
 * section with get_page_section() are detected through
 * $GLOBALS['cms_page_section_used'] to avoid printing the same content twice.
 *
 * Besides the standard "Main Body Section" fields, editors can append any
 * number of custom sections (data/pages/{slug}.json → custom_sections).
 */

if (!function_exists('cms_render_page_section_block')) {
    /**
     * Render one badge / heading / rich-text / image block.
     */
    function cms_render_page_section_block(array $section, $imageSide = 'right', $background = 'white', $layout = '') {
        $badge = trim((string)($section['badge'] ?? ''));
        $title = trim((string)($section['title'] ?? ''));
        $text  = (string)($section['text'] ?? '');
        $image = trim((string)($section['image'] ?? ''));
        $imageAlt = trim((string)($section['image_alt'] ?? ''));

        $textPlain = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
        if ($title === '' && $textPlain === '' && $image === '') {
            return;
        }

        $bgClass = $background === 'light' ? 'bg-slate-50' : 'bg-white';
        $hasImage = ($image !== '' && $layout !== 'text-only');
        $side = ($imageSide === 'left' || $layout === 'image-left') ? 'left' : 'right';
        $imageAlt = $imageAlt !== '' ? $imageAlt : trim(strip_tags($title));

        if ($hasImage) {
            $textOrder = $side === 'left' ? 'lg:order-2' : '';
            $imgOrder  = $side === 'left' ? 'lg:order-1' : '';
        }
        ?>
        <section class="py-12 md:py-16 <?php echo $bgClass; ?>">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <?php if ($hasImage): ?>
                <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                    <div class="<?php echo $textOrder; ?>">
                        <?php if ($badge !== ''): ?>
                        <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($badge); ?></span>
                        <?php endif; ?>
                        <?php if ($title !== ''): ?>
                        <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($title); ?></h2>
                        <?php endif; ?>
                        <?php echo cms_section_paragraphs($text); ?>
                    </div>
                    <div class="<?php echo $imgOrder; ?>">
                        <img src="<?php echo htmlspecialchars(cms_media_path($image)); ?>"
                             alt="<?php echo htmlspecialchars($imageAlt); ?>"
                             loading="lazy"
                             class="w-full aspect-[4/3] object-cover rounded-3xl shadow-lg border border-slate-100">
                    </div>
                </div>
                <?php else: ?>
                <div class="max-w-4xl mx-auto">
                    <?php if ($badge !== ''): ?>
                    <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($badge); ?></span>
                    <?php endif; ?>
                    <?php if ($title !== ''): ?>
                    <h2 class="text-3xl md:text-4xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($title); ?></h2>
                    <?php endif; ?>
                    <?php echo cms_section_paragraphs($text); ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}

if (!function_exists('cms_render_page_sections')) {
    /**
     * Print the generic section + every custom section for the current page.
     */
    function cms_render_page_sections($slug) {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$slug);
        if ($slug === '') {
            return;
        }

        $page = get_page_content($slug, []);
        if (!is_array($page)) {
            $page = [];
        }

        // Standard section (skipped when the template already rendered it,
        // and skipped on the homepage which has its own bespoke layout).
        if (empty($GLOBALS['cms_page_section_used']) && $slug !== 'index') {
            $section = get_page_section($page, [], false);
            if (trim((string)$section['title']) !== '' || trim(strip_tags((string)$section['text'])) !== '') {
                cms_render_page_section_block([
                    'badge' => $section['badge'],
                    'title' => $section['title'],
                    'text'  => $section['text'],
                    'image' => $section['image'],
                    'image_alt' => $section['image_alt'],
                ], 'right', 'white');
            }
        }

        // Additional sections added by the editor.
        $custom = $page['custom_sections'] ?? [];
        if (!is_array($custom)) {
            return;
        }

        $index = 0;
        foreach ($custom as $section) {
            if (!is_array($section)) {
                continue;
            }
            $layout = (string)($section['layout'] ?? 'image-right');
            $imageSide = $layout === 'image-left' ? 'left' : 'right';
            $background = ($index % 2 === 0) ? 'light' : 'white';
            cms_render_page_section_block([
                'badge' => $section['badge'] ?? '',
                'title' => $section['title'] ?? '',
                'text'  => $section['text'] ?? '',
                'image' => $section['image'] ?? '',
                'image_alt' => $section['image_alt'] ?? '',
            ], $imageSide, $background, $layout);
            $index++;
        }
    }
}

$cmsSectionsSlug = $currentPage ?? str_replace('.php', '', basename($_SERVER['PHP_SELF'] ?? ''));
cms_render_page_sections($cmsSectionsSlug);

// Pages that do not hard-code an FAQ section still get one automatically as
// soon as an editor adds questions in CMS → Page FAQs.
if (
    empty($GLOBALS['cms_faq_section_used'])
    && function_exists('cms_faq_page')
    && cms_faq_page($cmsSectionsSlug) !== null
) {
    $faqSlug = $cmsSectionsSlug;
    require __DIR__ . '/faq-section.php';
}
