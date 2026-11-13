<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/fields.php';
require_once __DIR__ . '/includes/collections.php';
require_once dirname(__DIR__) . '/includes/page-blocks.php';
require_once dirname(__DIR__) . '/includes/page-ctas.php';

cms_require_auth();

$pagesCatalog = CMS_DB::get('pages_catalog', []);
$slug = trim($_POST['slug'] ?? $_GET['slug'] ?? 'stroke');

// Find page in catalog
$pageMeta = null;
foreach ($pagesCatalog as $p) {
    if ($p['slug'] === $slug) {
        $pageMeta = $p;
        break;
    }
}

$pageDataFile = dirname(__DIR__) . '/data/pages/' . preg_replace('/[^a-zA-Z0-9_-]/', '', $slug) . '.json';
$pageData = [];
if (file_exists($pageDataFile)) {
    $pageData = json_decode(file_get_contents($pageDataFile), true) ?: [];
}
if (empty($pageData) && $pageMeta) {
    $pageData = $pageMeta;
}

// Every page now supports CMS body content. Templates that render their own
// section read the section1_* fields directly; the rest are printed by
// includes/cms-sections.php before the footer.

if (!function_exists('cms_template_section_defaults')) {
    /**
     * Extract the built-in "Main Body Section" copy a template falls back to
     * when the CMS fields are empty or still hold catalog placeholder text.
     * Reads the get_page_section($pageContent, [...]) call from the template
     * so the editor can show exactly the copy that is live on the page.
     */
    function cms_template_section_defaults($templateFile) {
        $empty = ['badge' => '', 'title' => '', 'text' => '', 'image' => '', 'image_alt' => ''];
        if (!$templateFile) {
            return $empty;
        }
        $path = dirname(__DIR__) . '/' . ltrim((string)$templateFile, '/');
        if (!is_file($path)) {
            return $empty;
        }
        $src = @file_get_contents($path);
        if ($src === false) {
            return $empty;
        }
        $tokens = @token_get_all($src);
        $n = count($tokens);
        for ($i = 0; $i < $n; $i++) {
            $t = $tokens[$i];
            if (!is_array($t) || $t[0] !== T_STRING || strtolower($t[1]) !== 'get_page_section') {
                continue;
            }
            // Find the opening parenthesis.
            $j = $i + 1;
            while ($j < $n && is_array($tokens[$j]) && in_array($tokens[$j][0], [T_WHITESPACE, T_COMMENT], true)) {
                $j++;
            }
            if ($j >= $n || $tokens[$j] !== '(') {
                continue;
            }
            // Walk the argument list; capture the 2nd argument (the defaults array).
            $depth = 0;
            $argStart = null;
            $argEnd = null;
            $commaSeen = 0;
            for ($k = $j; $k < $n; $k++) {
                $tok = $tokens[$k];
                if ($tok === '(' || $tok === '[') {
                    $depth++;
                    continue;
                }
                if ($tok === ')' || $tok === ']') {
                    $depth--;
                    if ($depth === 0) {
                        $argEnd = $k - 1;
                        break;
                    }
                    continue;
                }
                if ($depth === 1 && $tok === ',') {
                    $commaSeen++;
                    if ($commaSeen === 1) {
                        $argStart = $k + 1;
                    }
                }
            }
            if ($argStart === null || $argEnd === null || $argEnd < $argStart) {
                continue;
            }
            // Rebuild the array literal from the tokens (drops comments/whitespace noise is fine — eval needs valid PHP).
            $literal = '';
            for ($k = $argStart; $k <= $argEnd; $k++) {
                $tok = $tokens[$k];
                $literal .= is_array($tok) ? $tok[1] : $tok;
            }
            $literal = trim($literal);
            if ($literal === '' || $literal[0] !== '[') {
                continue;
            }
            $result = null;
            try {
                $result = eval("return {$literal};");
            } catch (ParseError $e) {
                $result = null;
            }
            if (is_array($result)) {
                return array_merge($empty, $result);
            }
        }
        return $empty;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    $pageData['hero_badge'] = trim($_POST['hero_badge'] ?? '');
    $pageData['hero_title'] = trim($_POST['hero_title'] ?? '');
    $pageData['hero_desc'] = trim($_POST['hero_desc'] ?? '');
    $pageData['hero_bg_alt'] = trim($_POST['hero_bg_alt'] ?? '');

    $pageData['section1_badge'] = trim($_POST['section1_badge'] ?? '');
    $pageData['section1_title'] = trim($_POST['section1_title'] ?? '');
    $pageData['section1_text'] = trim($_POST['section1_text'] ?? '');
    $pageData['section1_img_alt'] = trim($_POST['section1_img_alt'] ?? '');

    // SEO Meta Title & Meta Description + extras
    $pageData['meta_title'] = trim($_POST['meta_title'] ?? '');
    $pageData['meta_description'] = trim($_POST['meta_description'] ?? '');
    $pageData['meta_keywords'] = trim($_POST['meta_keywords'] ?? '');
    $pageData['canonical'] = trim($_POST['canonical'] ?? '');
    $pageData['robots_noindex'] = !empty($_POST['robots_noindex']);
    $pageData['breadcrumb_label'] = trim($_POST['breadcrumb_label'] ?? '');
    $pageData['breadcrumb_parent'] = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)($_POST['breadcrumb_parent'] ?? ''));
    $pageData['hero_icon'] = trim($_POST['hero_icon'] ?? '');

    $uploadErrors = [];

    // Social share image (Open Graph)
    $ogImg = cms_image_field_value('og_image', 'seo', (string)($pageData['og_image'] ?? ''));
    if ($ogImg['error'] !== '') {
        $uploadErrors[] = 'Share image: ' . $ogImg['error'];
    }
    $pageData['og_image'] = $ogImg['path'];

    // Hero banner image (upload / library pick / remove)
    $heroImg = cms_image_field_value('hero_bg', 'breadcrumbs', (string)($pageData['hero_bg'] ?? ''));
    if ($heroImg['error'] !== '') {
        $uploadErrors[] = 'Hero banner: ' . $heroImg['error'];
    }
    $pageData['hero_bg'] = $heroImg['path'];

    // Main body section image
    $secImg = cms_image_field_value('section1_image', 'services', (string)($pageData['section1_image'] ?? ''));
    if ($secImg['error'] !== '') {
        $uploadErrors[] = 'Section photo: ' . $secImg['error'];
    }
    $pageData['section1_image'] = $secImg['path'];
    if ($secImg['changed'] && $secImg['path'] !== '' && empty($pageData['section1_img_alt'])) {
        $pageData['section1_img_alt'] = $pageData['section1_title'] ?? '';
    }

    // Additional custom page sections (optional repeater).
    $customSections = [];
    $postedSections = $_POST['custom_sections'] ?? [];
    if (is_array($postedSections)) {
        foreach ($postedSections as $i => $sec) {
            if (!is_array($sec)) {
                continue;
            }
            $cImg = cms_image_field_value('custom_sections[' . $i . '][image]', 'pages', '');
            if ($cImg['error'] !== '') {
                $uploadErrors[] = 'Custom section ' . ((int)$i + 1) . ' photo: ' . $cImg['error'];
            }
            $cImage = $cImg['path'];

            $cTitle = trim($sec['title'] ?? '');
            $cText = trim($sec['text'] ?? '');
            $cBadge = trim($sec['badge'] ?? '');
            $cAlt = trim($sec['image_alt'] ?? '');
            if ($cTitle === '' && trim(strip_tags($cText)) === '' && $cImage === '') {
                continue; // ignore empty repeater rows
            }

            $cLayout = $sec['layout'] ?? 'image-right';
            if (!in_array($cLayout, ['image-right', 'image-left', 'text-only'], true)) {
                $cLayout = 'image-right';
            }

            $customSections[] = [
                'badge' => $cBadge,
                'title' => $cTitle,
                'text'  => $cText,
                'image' => $cImage,
                'image_alt' => $cAlt,
                'layout' => $cLayout,
            ];
        }
    }
    $pageData['custom_sections'] = $customSections;

    // ---- Section order / visibility / add / remove (flow pages) -------------
    $isFlowPage = cms_page_uses_flow($slug);
    if ($isFlowPage) {
        $existingBlocksForLayout = (isset($pageData['blocks']) && is_array($pageData['blocks'])) ? $pageData['blocks'] : [];
        $removeKey = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)($_POST['remove_block'] ?? ''));
        $addType = preg_replace('/[^a-z0-9-]/', '', (string)($_POST['add_block_type'] ?? ''));
        $orderPosted = isset($_POST['layout_order']) && is_array($_POST['layout_order']) ? $_POST['layout_order'] : [];
        $hiddenPosted = isset($_POST['layout_hidden']) && is_array($_POST['layout_hidden']) ? $_POST['layout_hidden'] : [];
        $newLayout = [];
        foreach ($orderPosted as $lk) {
            $lk = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$lk);
            if ($lk === '' || $lk === $removeKey) continue;
            $newLayout[] = ['key' => $lk, 'hidden' => !empty($hiddenPosted[$lk])];
        }
        if ($removeKey !== '' && isset($existingBlocksForLayout[$removeKey]) && !empty($existingBlocksForLayout[$removeKey]['added'])) {
            unset($existingBlocksForLayout[$removeKey]);
            $pageData['blocks'] = $existingBlocksForLayout;
        }
        if ($addType !== '') {
            $newKey = $addType . '-' . substr(bin2hex(random_bytes(3)), 0, 5);
            $pageData['blocks'] = $existingBlocksForLayout;
            $pageData['blocks'][$newKey] = cms_block_blank($addType);
            $newLayout[] = ['key' => $newKey, 'hidden' => false];
        }
        if (!empty($newLayout)) {
            $pageData['layout'] = $newLayout;
        }
    }

    // Editable page blocks (Techniques, What to Expect, ...). Defaults come
    // from data/page-blocks.json; the submitted values are stored here.
    $blockDefaults = cms_page_blocks($slug);
    if ($isFlowPage && isset($pageData['blocks']) && is_array($pageData['blocks'])) {
        // Blocks added in this very request are not in the cached defaults yet.
        foreach ($pageData['blocks'] as $bk => $bv) {
            if (!isset($blockDefaults[$bk]) && is_array($bv) && !empty($bv['type'])) {
                $blockDefaults[$bk] = $bv;
            }
        }
    }
    $postedBlocks = $_POST['page_blocks'] ?? [];
    if (!empty($blockDefaults) && is_array($postedBlocks)) {
        $existingBlocks = (isset($pageData['blocks']) && is_array($pageData['blocks'])) ? $pageData['blocks'] : [];
        $savedBlocks = $existingBlocks;
        foreach ($blockDefaults as $bKey => $bDefault) {
            if (!is_array($bDefault) || !isset($postedBlocks[$bKey]) || !is_array($postedBlocks[$bKey])) {
                continue;
            }
            if ($isFlowPage && isset($removeKey) && $removeKey !== '' && $bKey === $removeKey) {
                unset($savedBlocks[$bKey]);
                continue;
            }
            $pb = $postedBlocks[$bKey];
            if (empty($pb['_present'])) {
                continue;
            }
            // Start from the stored (or default) definition so options,
            // images and other presets survive the save.
            $base = (isset($existingBlocks[$bKey]) && is_array($existingBlocks[$bKey])) ? $existingBlocks[$bKey] : $bDefault;
            $bType = ($base['type'] ?? 'cards') === 'steps' ? 'steps' : ($base['type'] ?? 'cards');
            $block = $base;
            $block['type'] = $bType;
            // Header copy: a cleared field falls back to the built-in default
            // (the UI promises "clear to restore"), so drop the key instead of
            // storing an empty string that would override the default.
            foreach (['badge', 'title', 'description'] as $hf) {
                if (!isset($pb[$hf])) {
                    continue;
                }
                $hv = trim((string)$pb[$hf]);
                if ($hv === '' || $hv === trim((string)($bDefault[$hf] ?? ''))) {
                    unset($block[$hf]);
                } else {
                    $block[$hf] = $hv;
                }
            }

            // Split-section images (symptoms / why-choose / doctor blocks).
            // Split-section photo: the stored photo survives unless the editor
            // removed it, picked another from the library, or uploaded a file.
            if (isset($base['image'])) {
                $block['image'] = $base['image'];
            }
            if (isset($pb['image']) || !empty($_FILES[cms_image_file_key('page_blocks[' . $bKey . '][image]')])) {
                $bImg = cms_image_field_value('page_blocks[' . $bKey . '][image]', 'services', (string)($base['image'] ?? ''));
                if ($bImg['error'] !== '') {
                    $uploadErrors[] = $bKey . ' section photo: ' . $bImg['error'];
                }
                $block['image'] = $bImg['path'];
                if ($bImg['changed'] && $bImg['path'] !== '' && trim((string)($pb['image_alt'] ?? '')) === '') {
                    $pb['image_alt'] = $block['title'] ?? ($base['title'] ?? '');
                }
            }
            if (isset($pb['image_alt'])) {
                $block['image_alt'] = trim((string)$pb['image_alt']);
            } elseif (isset($base['image_alt'])) {
                $block['image_alt'] = trim((string)$base['image_alt']);
            }

            // Pill row (symptoms blocks) and icon choice (notification rows).
            if (isset($pb['tags_title'])) {
                $block['tags_title'] = trim($pb['tags_title'] ?? '');
                $tagsRaw = $pb['tags'] ?? '';
                $tags = is_array($tagsRaw) ? $tagsRaw : preg_split('/\r\n|\r|\n|,(?![^(]*\))/', (string)$tagsRaw);
                $block['tags'] = array_values(array_filter(array_map('trim', is_array($tags) ? $tags : [$tagsRaw]), function ($t) {
                    return $t !== '';
                }));
            }
            // Call-out note box (symptoms blocks).
            if (isset($pb['note_title'])) {
                $block['note_title'] = trim($pb['note_title'] ?? '');
                $block['note_text'] = trim($pb['note_text'] ?? '');
                // The icon lives with the note; only change it when a new icon
                // was submitted, so a blank field keeps the preset.
                if (trim($pb['note_icon'] ?? '') !== '') {
                    $block['note_icon'] = trim($pb['note_icon']);
                }
            }

            $block['items'] = [];
            $baseItems = is_array($base['items'] ?? null) ? array_values($base['items']) : [];
            foreach (($pb['items'] ?? []) as $ii => $item) {
                if (!is_array($item)) {
                    continue;
                }
                // The base/default item at the same position carries fields the
                // editor does not render for this block type (badge, subtitle,
                // icon colour, photos…). They must survive the save untouched.
                $baseItem = (isset($baseItems[$ii]) && is_array($baseItems[$ii])) ? $baseItems[$ii] : [];
                $it = [
                    'title' => array_key_exists('title', $item) ? trim((string)$item['title']) : trim((string)($baseItem['title'] ?? '')),
                    'text'  => array_key_exists('text', $item) ? trim((string)$item['text']) : trim((string)($baseItem['text'] ?? '')),
                ];
                if (isset($baseItem['number']) && !isset($item['number'])) {
                    $it['number'] = $baseItem['number'];
                }
                $extraTitle = trim($item['subtitle'] ?? ($baseItem['subtitle'] ?? ''));
                if ($extraTitle !== '') {
                    $it['subtitle'] = $extraTitle;
                }
                $extraBadge = trim($item['badge'] ?? ($baseItem['badge'] ?? ''));
                if ($extraBadge !== '') {
                    $it['badge'] = $extraBadge;
                }
                $extraUrl = trim($item['url'] ?? ($baseItem['url'] ?? ''));
                if ($extraUrl !== '') {
                    $it['url'] = $extraUrl;
                }
                $extraNote = trim((string)($item['note'] ?? ($baseItem['note'] ?? '')));
                if ($extraNote !== '') {
                    $it['note'] = $extraNote;
                }
                $bulletsRaw = $item['bullets'] ?? '';
                $bullets = is_array($bulletsRaw) ? $bulletsRaw : preg_split('/\r\n|\r|\n/', (string)$bulletsRaw);
                $bullets = array_values(array_filter(array_map('trim', $bullets), function ($b) {
                    return $b !== '';
                }));
                if (!empty($bullets)) {
                    $it['bullets'] = $bullets;
                } elseif (isset($baseItem['bullets']) && is_array($baseItem['bullets']) && !isset($item['bullets'])) {
                    $it['bullets'] = array_values($baseItem['bullets']);
                }
                if (array_key_exists('icon', $item)) {
                    $icon = trim($item['icon'] ?? '');
                    $baseIcon = trim((string)($baseItem['icon'] ?? ''));
                    // Empty field: keep the base icon when the base itself was
                    // empty (e.g. chevron defaults), otherwise fall back to the
                    // standard check icon.
                    $it['icon'] = $icon !== '' ? $icon : ($baseIcon === '' && array_key_exists('icon', $baseItem) ? '' : 'fa-check');
                    $color = $item['color'] ?? 'electric-blue';
                    if (!in_array($color, ['electric-blue', 'cyan-accent', 'deep-indigo', 'red', 'dark'], true)) {
                        $color = 'electric-blue';
                    }
                    $it['color'] = $color;
                    if (array_key_exists('tags', $item)) {
                        $tagsRaw = $item['tags'];
                        $tags = is_array($tagsRaw) ? $tagsRaw : explode(',', (string)$tagsRaw);
                        $it['tags'] = array_values(array_filter(array_map('trim', $tags), function ($t) {
                            return $t !== '';
                        }));
                    } elseif (isset($baseItem['tags']) && is_array($baseItem['tags'])) {
                        $it['tags'] = array_values($baseItem['tags']);
                    }
                } elseif (isset($baseItem['icon']) && !isset($item['icon'])) {
                    $it['icon'] = trim((string)$baseItem['icon']);
                    if (isset($baseItem['color'])) {
                        $it['color'] = $baseItem['color'];
                    }
                    if (isset($baseItem['tags']) && is_array($baseItem['tags'])) {
                        $it['tags'] = array_values($baseItem['tags']);
                    }
                }
                // Directory card photos (links blocks with card_image enabled).
                if (array_key_exists('image', $item) || array_key_exists('image_alt', $item)) {
                    $itemImg = cms_image_field_value('page_blocks[' . $bKey . '][items][' . $ii . '][image]', 'pages', (string)($baseItem['image'] ?? ''));
                    if ($itemImg['error'] !== '') {
                        $uploadErrors[] = $bKey . ' card photo: ' . $itemImg['error'];
                    }
                    if ($itemImg['path'] !== '') {
                        $it['image'] = $itemImg['path'];
                    }
                    $itemImageAlt = trim($item['image_alt'] ?? '');
                    if ($itemImageAlt !== '') {
                        $it['image_alt'] = $itemImageAlt;
                    }
                } elseif (isset($baseItem['image']) && !isset($item['image'])) {
                    $it['image'] = trim((string)$baseItem['image']);
                    if (isset($baseItem['image_alt'])) {
                        $it['image_alt'] = trim((string)$baseItem['image_alt']);
                    }
                }
                // Keep an item that only carries a URL, bullets or a photo, and
                // drop ones left completely blank by the editor.
                if ($it['title'] === '' && $it['text'] === '' && empty($it['bullets']) && empty($it['url']) && empty($it['subtitle']) && empty($it['image'])) {
                    continue;
                }
                $block['items'][] = $it;
            }

            // Generic block-level fields used by the newer section types
            // (text-media, feature-split, strip, stats, collection grids…).
            // A cleared field is dropped so the built-in default returns.
            foreach (['badge_icon', 'text', 'text_after', 'button_text', 'button_url', 'button2_text', 'button2_url', 'collection', 'variant'] as $gf) {
                if (!array_key_exists($gf, $pb)) {
                    continue;
                }
                $gv = trim((string)$pb[$gf]);
                if ($gv === '') {
                    unset($block[$gf]);
                } else {
                    $block[$gf] = $gv;
                }
            }
            if (array_key_exists('limit', $pb)) {
                $gLimit = (int)$pb['limit'];
                if ($gLimit > 0) {
                    $block['limit'] = $gLimit;
                } else {
                    unset($block['limit']);
                }
            }
            if (array_key_exists('bullets', $pb)) {
                $gBullets = preg_split('/\r\n|\r|\n/', (string)$pb['bullets']);
                $gBullets = array_values(array_filter(array_map('trim', $gBullets), function ($b) {
                    return $b !== '';
                }));
                if (!empty($gBullets)) {
                    $block['bullets'] = $gBullets;
                } else {
                    unset($block['bullets']);
                }
            }

            // Advanced layout options edited as JSON (flow pages). Invalid JSON
            // keeps the stored options and reports an error.
            if (isset($pb['options_json'])) {
                $optRaw = trim((string)$pb['options_json']);
                if ($optRaw !== '') {
                    $optDecoded = json_decode($optRaw, true);
                    if (is_array($optDecoded)) {
                        if (empty($optDecoded)) {
                            unset($block['options']);
                        } else {
                            $block['options'] = $optDecoded;
                        }
                    } else {
                        $uploadErrors[] = ($block['label'] ?? $bKey) . ': advanced options were not valid JSON and were left unchanged.';
                    }
                }
            }

            // Extra block-level fields.
            if (isset($pb['panel_title'])) {
                $block['panel_title'] = trim($pb['panel_title'] ?? '');
                $block['panel_text'] = trim($pb['panel_text'] ?? '');
            }
            if (isset($pb['roles'])) {
                $rolesRaw = is_array($pb['roles']) ? $pb['roles'] : preg_split('/\r\n|\r|\n/', (string)$pb['roles']);
                $roles = array_values(array_filter(array_map('trim', $rolesRaw), function ($r) {
                    return $r !== '';
                }));
                if (!empty($roles) || isset($block['roles'])) {
                    $block['roles'] = $roles;
                }
            }

            $savedBlocks[$bKey] = $block;
        }
        $pageData['blocks'] = $savedBlocks;
    }

    // Editable call-to-action buttons. Defaults come from
    // data/page-ctas.json; overrides are stored under "ctas".
    if (function_exists('cms_page_cta_keys')) {
        $postedCtas = $_POST['page_ctas'] ?? [];
        if (is_array($postedCtas)) {
            $existingCtas = (isset($pageData['ctas']) && is_array($pageData['ctas'])) ? $pageData['ctas'] : [];
            $savedCtas = [];
            foreach (cms_page_cta_keys($slug) as $ctaKey) {
                if (!isset($postedCtas[$ctaKey]) || !is_array($postedCtas[$ctaKey]) || empty($postedCtas[$ctaKey]['_present'])) {
                    if (isset($existingCtas[$ctaKey])) {
                        $savedCtas[$ctaKey] = $existingCtas[$ctaKey];
                    }
                    continue;
                }
                $pc = $postedCtas[$ctaKey];
                $tText = trim($pc['text'] ?? '');
                $tUrl = trim($pc['url'] ?? '');
                $tIntro = trim($pc['intro'] ?? '');
                if ($tText === '' && $tUrl === '' && $tIntro === '') {
                    // Left blank → restore the built-in default entirely.
                    continue;
                }
                $savedCtas[$ctaKey] = [
                    'text' => $tText,
                    'url' => $tUrl,
                    'intro' => $tIntro,
                ];
            }
            $pageData['ctas'] = $savedCtas;
        }
    }

    $dataDir = dirname($pageDataFile);
    if (!is_dir($dataDir)) {
        @mkdir($dataDir, 0755, true);
    }

    $json = json_encode($pageData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $saved = false;
    if ($json !== false) {
        $tmpFile = $pageDataFile . '.tmp.' . uniqid();
        if (file_put_contents($tmpFile, $json, LOCK_EX) !== false) {
            $saved = @rename($tmpFile, $pageDataFile);
            if (!$saved) {
                @unlink($tmpFile);
            }
        }
    }

    if (!$saved) {
        cms_set_flash('error', 'Could not save this page. Please check that data/pages is writable on the server.');
    } elseif (!empty($uploadErrors)) {
        cms_set_flash('error', 'Page content was saved, but an image upload failed: ' . implode(' ', $uploadErrors));
    } else {
        cms_set_flash('success', 'Page content, SEO metadata, and images saved successfully!');
    }
    // Keep sitemap.xml in sync (noindex pages are excluded).
    $sitemapGen = dirname(__DIR__) . '/includes/generate-sitemap.php';
    if ($saved && file_exists($sitemapGen)) {
        require_once $sitemapGen;
        if (function_exists('generate_sitemap_xml')) {
            @generate_sitemap_xml();
        }
    }

    header('Location: page-edit.php?slug=' . urlencode($slug));
    exit;
}

$pageTitle = 'Edit Page Content: ' . ($pageMeta['title'] ?? $slug);
require_once __DIR__ . '/includes/header.php';
?>

<div class="max-w-4xl bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
    <!-- Header with Quick Jump Dropdown -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-100">
        <div>
            <div class="flex items-center space-x-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-brand-blue">
                    <?php echo htmlspecialchars($pageMeta['category'] ?? 'Page'); ?>
                </span>
                <span class="text-xs text-slate-400 font-mono"><?php echo htmlspecialchars($pageMeta['file'] ?? ($slug . '.php')); ?></span>
            </div>
            <h2 class="text-base font-bold text-slate-900"><?php echo htmlspecialchars($pageMeta['title'] ?? $slug); ?></h2>
        </div>

        <div class="flex items-center space-x-3">
            <select onchange="if(this.value) window.location.href='page-edit.php?slug='+encodeURIComponent(this.value);"
                    class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Switch to another page...</option>
                <?php foreach ($pagesCatalog as $p): ?>
                <option value="<?php echo htmlspecialchars($p['slug']); ?>" <?php echo $p['slug'] === $slug ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($p['title']); ?> (<?php echo htmlspecialchars($p['file']); ?>)
                </option>
                <?php endforeach; ?>
            </select>

            <a href="../<?php echo htmlspecialchars($pageMeta['file'] ?? ($slug . '.php')); ?>" target="_blank" class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-colors flex items-center space-x-1.5 flex-shrink-0">
                <span>View Live</span>
                <i class="fas fa-external-link-alt text-[9px]"></i>
            </a>
        </div>
    </div>

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-6" id="page-edit-form">
        <?php echo cms_csrf_field(); ?>
        <input type="hidden" name="slug" value="<?php echo htmlspecialchars($slug); ?>">

        <!-- SEO Meta Tags Card -->
        <div class="bg-gradient-to-br from-slate-50 to-blue-50/30 p-5 rounded-2xl border border-blue-100/80 space-y-4 shadow-sm">
            <div class="flex items-center justify-between border-b border-blue-100 pb-2.5">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center">
                    <i class="fas fa-search text-brand-blue mr-2"></i> SEO & Search Engine Meta Tags
                </h3>
                <span class="text-[11px] text-blue-700 font-semibold bg-blue-100/60 px-2 py-0.5 rounded-full">Google Snippet</span>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="font-bold text-slate-800">SEO Page Title (&lt;title&gt; tag)</label>
                        <span class="text-[10px] text-slate-400">Recommended: 50 – 60 characters</span>
                    </div>
                    <input type="text" name="meta_title" value="<?php echo htmlspecialchars($pageData['meta_title'] ?? ''); ?>" placeholder="<?php echo htmlspecialchars(($pageMeta['title'] ?? 'Neurology Care') . ' - Dr. Praveen Gupta | Artemis Hospital'); ?>" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-900 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="font-bold text-slate-800">SEO Meta Description (&lt;meta name="description"&gt;)</label>
                        <span class="text-[10px] text-slate-400">Recommended: 140 – 160 characters</span>
                    </div>
                    <textarea name="meta_description" rows="2" placeholder="Brief summary of this page that appears under the title in Google search results..." class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($pageData['meta_description'] ?? ''); ?></textarea>
                </div>

                <details class="group">
                    <summary class="cursor-pointer text-[11px] font-bold text-brand-blue select-none"><i class="fas fa-chevron-right text-[9px] mr-1 group-open:rotate-90 transition-transform"></i> Advanced SEO: keywords, share image, canonical, breadcrumb, indexing</summary>
                    <div class="mt-3 space-y-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">Meta keywords (comma separated)</label>
                                <input type="text" name="meta_keywords" value="<?php echo htmlspecialchars($pageData['meta_keywords'] ?? ''); ?>" placeholder="Leave blank to use the site default" class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">Canonical URL (only if this page duplicates another)</label>
                                <input type="text" name="canonical" value="<?php echo htmlspecialchars($pageData['canonical'] ?? ''); ?>" placeholder="other-page-slug or https://…" class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-mono focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">Breadcrumb label (shown in the hero trail &amp; Google)</label>
                                <input type="text" name="breadcrumb_label" value="<?php echo htmlspecialchars($pageData['breadcrumb_label'] ?? ''); ?>" placeholder="<?php echo htmlspecialchars($pageMeta['title'] ?? 'Page name'); ?>" class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">Breadcrumb parent page</label>
                                <select name="breadcrumb_parent" class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    <option value="">Home only</option>
                                    <?php foreach ($pagesCatalog as $pc): if (empty($pc['slug']) || $pc['slug'] === $slug || $pc['slug'] === 'index') continue; ?>
                                    <option value="<?php echo htmlspecialchars($pc['slug']); ?>" <?php echo ($pageData['breadcrumb_parent'] ?? '') === $pc['slug'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($pc['title'] ?? $pc['slug']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">Hero badge icon (Font Awesome, e.g. fa-brain)</label>
                                <input type="text" name="hero_icon" value="<?php echo htmlspecialchars($pageData['hero_icon'] ?? ''); ?>" placeholder="fa-brain" class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-mono focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <label class="flex items-center space-x-2 pt-5 text-xs font-bold text-slate-700">
                                <input type="checkbox" name="robots_noindex" value="1" <?php echo !empty($pageData['robots_noindex']) ? 'checked' : ''; ?> class="w-4 h-4 rounded">
                                <span>Hide from Google (noindex) and leave out of the sitemap</span>
                            </label>
                        </div>
                        <?php cms_image_field('og_image', $pageData['og_image'] ?? '', [
                            'label' => 'Social share image (WhatsApp / Facebook preview)', 'folder' => 'seo', 'size' => '1200 × 630 px',
                            'hint' => 'Falls back to the hero banner, then to the default share image from Settings.',
                            'preview_class' => 'w-28 h-16',
                        ]); ?>
                    </div>
                </details>
            </div>
        </div>

        <!-- Hero Section Box -->
        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-4">
            <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center">
                <i class="fas fa-heading text-brand-blue mr-2"></i> Hero Banner & Header Section
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Top Badge Text</label>
                    <input type="text" name="hero_badge" value="<?php echo htmlspecialchars($pageData['hero_badge'] ?? ''); ?>" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <p class="text-[10px] text-slate-500 mt-1">Generic labels such as "General Guide" are replaced by this page's default badge on the live site. Enter a specific label to override it.</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Page Hero Title (H1)</label>
                    <input type="text" name="hero_title" value="<?php echo htmlspecialchars($pageData['hero_title'] ?? ''); ?>" required class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Hero Subtitle / Introductory Paragraph</label>
                <textarea name="hero_desc" rows="3" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($pageData['hero_desc'] ?? ''); ?></textarea>
            </div>

            <?php cms_image_field('hero_bg', $pageData['hero_bg'] ?? '', [
                'label' => 'Hero Background Banner', 'folder' => 'breadcrumbs', 'size' => 'Recommended: 1920 × 600 px',
                'hint' => 'Wide header backdrop (aspect ratio ~16:5). WebP, PNG or JPG (max 8MB). Remove it to show the gradient only.',
                'preview_class' => 'w-40 h-14',
                'alt_name' => 'hero_bg_alt', 'alt_value' => $pageData['hero_bg_alt'] ?? '',
                'alt_label' => 'Hero banner alt tag, e.g. ' . ($pageMeta['title'] ?? 'Neurology Service') . ' Banner - Dr. Praveen Gupta',
            ]); ?>
        </div>

        <!-- Main Body Section Content is rendered inside the "Page Sections" flow
             below, at the position where this intro section appears on the page. -->

        <!-- Page Sections (top → bottom, mirroring the live page) -->
        <?php
        $editableBlocks = cms_page_blocks($slug);
        $orderedEntries = cms_page_editor_entries($slug, $pageMeta['file'] ?? null);
        // The Main Body card shows the copy that is live right now: saved
        // values, falling back to the template's built-in section copy when
        // the saved value is empty or still catalog placeholder text.
        $isFlowPage = cms_page_uses_flow($slug);
        $introDefaults = null;
        if ($isFlowPage) {
            foreach ($editableBlocks as $ibKey => $ib) {
                if (($ib['type'] ?? '') === 'intro') {
                    $introDefaults = ['badge' => $ib['badge'] ?? '', 'title' => $ib['title'] ?? '', 'text' => $ib['text'] ?? ($ib['description'] ?? ''), 'image' => $ib['image'] ?? '', 'image_alt' => $ib['image_alt'] ?? ''];
                    break;
                }
            }
        }
        $effectiveSection = cms_section_resolve($pageData, $introDefaults ?? cms_template_section_defaults($pageMeta['file'] ?? null));
        $blockTypeCatalog = cms_block_type_catalog();
        ?>

        <?php if (!empty($orderedEntries)): ?>
        <?php
        $blockTypeMeta = cms_block_type_catalog() + [
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
            'cta'        => ['label' => 'Final CTA banner', 'item_label' => 'Button'],
            'notice'     => ['label' => 'Alert panel', 'item_label' => 'Point', 'block_panel' => true],
        ];
        $blockItemFields = [
            'cards'      => ['icon_color', 'badge', 'title', 'text', 'bullets', 'tags', 'note'],
            'steps'      => ['title', 'text', 'bullets'],
            'facts'      => ['icon_color', 'title', 'text'],
            'warning'    => ['text'],
            'symptoms'   => ['icon_color', 'title', 'bullets'],
            'treatments' => ['icon_color', 'title', 'subtitle', 'text', 'bullets'],
            'why-choose' => ['icon_color', 'title', 'text'],
            'related'    => ['title', 'text', 'url'],
            'links'      => ['icon_color', 'imagepair', 'title', 'text', 'subtitle', 'url'],
            'doctor'     => ['title', 'url'],
            'cta'        => [],
            'notice'     => ['icon', 'text'],
        ];
        $blockItemHints = [];
        foreach ($blockTypeCatalog as $catType => $catDef) {
            if (isset($catDef['item_fields']) && is_array($catDef['item_fields'])) {
                $blockItemFields[$catType] = $catDef['item_fields'];
            }
            if (isset($catDef['item_hints']) && is_array($catDef['item_hints'])) {
                $blockItemHints[$catType] = $catDef['item_hints'];
            }
        }
        $collectionChoices = function_exists('cms_collection_schemas') ? cms_collection_schemas() : [];

        /**
         * Print the editor fields for one repeater item of a block type.
         * Echoed directly; used for saved items and for the "add item" templates.
         */
        $renderItemFields = function ($type, $key, $index, array $item = []) use ($blockItemFields, $blockItemHints) {
            $fields = $blockItemFields[$type] ?? $blockItemFields['cards'];
            $hints = $blockItemHints[$type] ?? [];
            $name = function ($field) use ($key, $index) {
                return 'page_blocks[' . htmlspecialchars($key, ENT_QUOTES) . '][items][' . htmlspecialchars($index, ENT_QUOTES) . '][' . $field . ']';
            };
            $val = function ($field, $default = '') use ($item) {
                $v = $item[$field] ?? $default;
                if (is_array($v)) {
                    $v = implode("\n", $v);
                }
                return htmlspecialchars((string)$v, ENT_QUOTES);
            };
            $inp = 'w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none';
            $inpMono = 'w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-mono focus:ring-2 focus:ring-blue-500 focus:outline-none';
            $txt = 'w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none';
            $lbl = 'block text-[10px] font-bold text-slate-600 mb-1';
            $textLabel = in_array($type, ['warning', 'notice'], true) ? 'Text (basic HTML like <strong> allowed)' : 'Description';
            if (isset($hints['text'])) {
                $textLabel = $hints['text'];
            }
            $titleLabel = $hints['title'] ?? 'Title';
            $subtitleLabel = $hints['subtitle'] ?? 'Small Sub-Label (optional)';

            if (in_array('icon_color', $fields, true)) {
                ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <label class="<?php echo $lbl; ?>">Font Awesome Icon (use "none" to hide)</label>
                        <input type="text" name="<?php echo $name('icon'); ?>" value="<?php echo $val('icon', 'fa-check'); ?>" placeholder="fa-shield-alt" class="<?php echo $inpMono; ?>">
                    </div>
                    <div>
                        <label class="<?php echo $lbl; ?>">Icon Colour</label>
                        <select name="<?php echo $name('color'); ?>" class="<?php echo $inp; ?>">
                            <?php foreach (['electric-blue' => 'Electric blue', 'cyan-accent' => 'Cyan', 'deep-indigo' => 'Deep indigo', 'red' => 'Red', 'dark' => 'Dark grey'] as $colorKey => $colorLabel): ?>
                            <option value="<?php echo $colorKey; ?>" <?php echo ($item['color'] ?? 'electric-blue') === $colorKey ? 'selected' : ''; ?>><?php echo $colorLabel; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php
            }
            if (in_array('imagepair', $fields, true)) {
                cms_image_field('page_blocks[' . $key . '][items][' . $index . '][image]', (string)($item['image'] ?? ''), [
                    'label' => 'Card photo (optional)', 'folder' => 'pages', 'compact' => true,
                    'preview_class' => 'w-20 h-14',
                    'alt_name' => 'page_blocks[' . $key . '][items][' . $index . '][image_alt]', 'alt_value' => (string)($item['image_alt'] ?? ''),
                    'alt_label' => 'Photo alt tag',
                ]);
            }
            if (in_array('badge', $fields, true)) {
                ?>
                <div>
                    <label class="<?php echo $lbl; ?>">Big Letter / Badge (optional, e.g. F.A.S.T. letters)</label>
                    <input type="text" name="<?php echo $name('badge'); ?>" value="<?php echo $val('badge'); ?>" class="<?php echo $inp; ?>">
                </div>
                <?php
            }
            if (in_array('title', $fields, true)) {
                ?>
                <div>
                    <label class="<?php echo $lbl; ?>"><?php echo htmlspecialchars($titleLabel); ?></label>
                    <input type="text" name="<?php echo $name('title'); ?>" value="<?php echo $val('title'); ?>" class="<?php echo $inp; ?>">
                </div>
                <?php
            }
            if (in_array('subtitle', $fields, true)) {
                ?>
                <div>
                    <label class="<?php echo $lbl; ?>"><?php echo htmlspecialchars($subtitleLabel); ?></label>
                    <input type="text" name="<?php echo $name('subtitle'); ?>" value="<?php echo $val('subtitle'); ?>" placeholder="e.g. First-Line Therapy" class="<?php echo $inp; ?>">
                </div>
                <?php
            }
            if (in_array('text', $fields, true)) {
                ?>
                <div>
                    <label class="<?php echo $lbl; ?>"><?php echo $textLabel; ?></label>
                    <textarea name="<?php echo $name('text'); ?>" rows="2" class="<?php echo $txt; ?>"><?php echo $val('text'); ?></textarea>
                </div>
                <?php
            }
            if (in_array('bullets', $fields, true)) {
                ?>
                <div>
                    <label class="<?php echo $lbl; ?>">Bullet Points (one per line, optional)</label>
                    <textarea name="<?php echo $name('bullets'); ?>" rows="2" placeholder="One item per line" class="<?php echo $txt; ?>"><?php echo $val('bullets'); ?></textarea>
                </div>
                <?php
            }
            if (in_array('note', $fields, true)) {
                ?>
                <div>
                    <label class="<?php echo $lbl; ?>"><?php echo htmlspecialchars($hints['note'] ?? 'Small note under the card (optional, basic HTML like <strong> allowed)'); ?></label>
                    <textarea name="<?php echo $name('note'); ?>" rows="2" class="<?php echo $txt; ?>"><?php echo $val('note'); ?></textarea>
                </div>
                <?php
            }
            if (in_array('url', $fields, true)) {
                ?>
                <div>
                    <label class="<?php echo $lbl; ?>">Destination URL (page link, #anchor, https://…, tel:…)</label>
                    <input type="text" name="<?php echo $name('url'); ?>" value="<?php echo $val('url'); ?>" placeholder="contact-us-top-neurologist-delhi-ncr" class="<?php echo $inpMono; ?>">
                </div>
                <?php
            }
            if (in_array('tags', $fields, true)) {
                ?>
                <div>
                    <label class="<?php echo $lbl; ?>">Tag Pills (comma-separated)</label>
                    <input type="text" name="<?php echo $name('tags'); ?>" value="<?php echo htmlspecialchars(implode(', ', (array)($item['tags'] ?? [])), ENT_QUOTES); ?>" placeholder="Keyhole Access, Faster Recovery" class="<?php echo $inp; ?>">
                </div>
                <?php
            }
        };
        ?>

        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-4">
            <div>
                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center">
                    <i class="fas fa-pen-to-square text-brand-blue mr-2"></i> Page Sections (in live page order)
                </h3>
                <p class="text-[10px] text-slate-500 mt-1">Every card below matches one section of the live page, top to bottom. Buttons are listed inside the section where they appear. Leave a field empty to restore its built-in default.</p>
                <p class="text-[10px] text-slate-500 mt-1"><i class="fas fa-circle-info mr-1"></i> Fields show the copy that is live on the website right now. Clearing a field restores the page's built-in default copy.</p>
                <p class="text-[10px] text-slate-500 mt-1">URL tips: another page slug e.g. <code class="font-mono">contact-us-top-neurologist-delhi-ncr</code>, an anchor <code class="font-mono">#appointment</code>, <code class="font-mono">https://…</code>, <code class="font-mono">tel:…</code>, or the tokens <code class="font-mono">{phone}</code> / <code class="font-mono">{stroke-helpline}</code> which expand to the hospital numbers.</p>
            </div>

            <?php if ($isFlowPage): ?>
            <div class="rounded-xl border border-dashed border-slate-300 bg-slate-100/60 px-3 py-2 text-[10px] text-slate-600 flex items-center gap-3 flex-wrap">
                <span><i class="fas fa-grip-vertical text-slate-400 mr-1"></i> Drag a section to move it on the page.</span>
                <span><i class="fas fa-eye-slash text-slate-400 mr-1"></i> Tick “Hide” to take a section off the page without deleting its content.</span>
                <span><i class="fas fa-plus text-slate-400 mr-1"></i> Add new sections with the picker at the bottom.</span>
            </div>
            <input type="hidden" name="remove_block" id="remove-block-input" value="">
            <input type="hidden" name="add_block_type" id="add-block-type-input" value="">
            <div class="space-y-4" data-sortable="1" data-sortable-item=".flow-item" id="flow-list">
            <?php endif; ?>
            <?php $flowGroupOpen = false; ?>
            <?php foreach ($orderedEntries as $entry): ?>

            <?php if ($isFlowPage && !empty($entry['flow'])): ?>
                <?php if ($flowGroupOpen): ?></div><?php endif; $flowGroupOpen = true; ?>
                <?php $fKey = $entry['key']; $fBlock = $editableBlocks[$fKey] ?? []; $fType = $fBlock['type'] ?? 'cards'; ?>
                <div class="flow-item rounded-2xl border <?php echo !empty($entry['hidden']) ? 'border-amber-300 bg-amber-50/40' : 'border-slate-300 bg-slate-50'; ?> p-2 space-y-2" data-id="<?php echo htmlspecialchars($fKey); ?>">
                    <input type="hidden" name="layout_order[]" value="<?php echo htmlspecialchars($fKey); ?>">
                    <div class="flex items-center justify-between gap-2 px-1">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="drag-handle cursor-grab text-slate-400 hover:text-slate-600 px-1" title="Drag to reorder"><i class="fas fa-grip-vertical"></i></span>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500 truncate">Section <span class="sort-position"></span> · <?php echo htmlspecialchars($blockTypeCatalog[$fType]['label'] ?? $fType); ?></span>
                            <?php if (!empty($entry['hidden'])): ?><span class="px-1.5 py-0.5 rounded bg-amber-100 text-amber-800 text-[9px] font-bold uppercase">Hidden</span><?php endif; ?>
                            <?php if (!empty($entry['placement'])): ?><span class="px-1.5 py-0.5 rounded bg-indigo-100 text-indigo-800 text-[9px] font-bold uppercase" title="Printed inside the page banner; its position in this list does not matter">Inside banner</span><?php endif; ?>
                        </div>
                        <div class="flex items-center gap-3 flex-shrink-0">
                            <label class="inline-flex items-center gap-1.5 text-[10px] font-bold text-slate-600 cursor-pointer">
                                <input type="checkbox" name="layout_hidden[<?php echo htmlspecialchars($fKey); ?>]" value="1" <?php echo !empty($entry['hidden']) ? 'checked' : ''; ?> class="w-3.5 h-3.5 rounded">
                                <span>Hide</span>
                            </label>
                            <?php if (!empty($entry['added'])): ?>
                            <button type="button" onclick="flowRemoveBlock('<?php echo htmlspecialchars($fKey); ?>')" class="text-[10px] font-bold text-red-600 hover:underline"><i class="fas fa-trash-alt mr-1"></i>Remove section</button>
                            <?php endif; ?>
                        </div>
                    </div>
            <?php endif; ?>

            <?php if ($entry['kind'] === 'virtual'): ?>
            <?php $vKey = $entry['key']; $vBlock = $editableBlocks[$vKey] ?? []; $vType = $entry['type']; ?>
            <div class="bg-white p-4 rounded-xl border border-slate-200 space-y-3">
                <input type="hidden" name="page_blocks[<?php echo htmlspecialchars($vKey); ?>][_present]" value="1">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold text-slate-800"><?php echo htmlspecialchars($vBlock['label'] ?? $blockTypeCatalog[$vType]['label'] ?? $vKey); ?></h4>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Shared section</span>
                </div>
                <?php if ($vType === 'faq'): ?>
                <p class="text-[10px] text-slate-500">Shows the questions managed in <a href="faq-edit.php?slug=<?php echo urlencode(trim((string)($vBlock['faq_slug'] ?? '')) !== '' ? $vBlock['faq_slug'] : $slug); ?>" class="text-brand-blue font-bold underline">Page FAQs → <?php echo htmlspecialchars($pageMeta['title'] ?? $slug); ?></a>. Heading and layout are edited there.</p>
                <?php else: ?>
                <p class="text-[10px] text-slate-500">Default wording comes from <a href="site-text.php" class="text-brand-blue font-bold underline">Header, Footer &amp; Shared Text</a>. Fill a field below to override it on this page only.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Eyebrow label</label>
                        <input type="text" name="page_blocks[<?php echo htmlspecialchars($vKey); ?>][badge]" value="<?php echo htmlspecialchars($vBlock['badge'] ?? ''); ?>" placeholder="(site default)" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Heading (HTML allowed)</label>
                        <input type="text" name="page_blocks[<?php echo htmlspecialchars($vKey); ?>][title]" value="<?php echo htmlspecialchars($vBlock['title'] ?? ''); ?>" placeholder="(site default)" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Intro paragraph</label>
                    <textarea name="page_blocks[<?php echo htmlspecialchars($vKey); ?>][description]" rows="2" placeholder="(site default)" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($vBlock['description'] ?? ''); ?></textarea>
                </div>
                <?php if ($vType === 'related-videos'): ?>
                <p class="text-[10px] text-slate-500">Which videos appear here is chosen in <a href="collection.php?c=videos" class="text-brand-blue font-bold underline">Education Videos</a> (tag the video with this page).</p>
                <?php endif; ?>
                <?php endif; ?>
            </div>

            <?php elseif ($entry['kind'] === 'section1'): ?>
            <?php
                // What the website prints right now for this intro section.
                $effBadge = (string)($effectiveSection['badge'] ?? '');
                $effTitle = (string)($effectiveSection['title'] ?? '');
                $effText = (string)($effectiveSection['text'] ?? '');
                $effImage = (string)($effectiveSection['image'] ?? '');
                $effImageAlt = (string)($effectiveSection['image_alt'] ?? '');
            ?>
            <!-- Main Body Section Content Box -->
            <div class="bg-white p-4 rounded-xl border border-slate-200 space-y-3">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold text-slate-800">Main Body Section Content</h4>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Intro Section</span>
                </div>
                <p class="text-[10px] text-slate-500">This content is rendered in the body of the page. The fields below show exactly what the website is displaying right now — edit to change it, or clear a field to restore the page's built-in copy.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Section Sub-Badge</label>
                        <input type="text" name="section1_badge" value="<?php echo htmlspecialchars($effBadge); ?>" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Section Heading (H2)</label>
                        <input type="text" name="section1_title" value="<?php echo htmlspecialchars($effTitle); ?>" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Section Content Paragraphs (Full Rich Text Editor)</label>
                    <textarea name="section1_text" rows="6" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($effText); ?></textarea>
                </div>

                <?php cms_image_field('section1_image', $effImage, [
                    'label' => 'Section Feature Photo', 'folder' => 'services', 'size' => 'Recommended: 800 × 600 px',
                    'hint' => 'Standard 4:3 landscape photo. WebP, PNG or JPG (max 8MB).',
                    'preview_class' => 'w-28 h-20',
                    'alt_name' => 'section1_img_alt', 'alt_value' => $effImageAlt,
                    'alt_label' => 'Section photo alt tag, e.g. ' . ($pageMeta['title'] ?? 'Treatment') . ' Clinical Procedure',
                ]); ?>
            </div>

            <?php elseif ($entry['kind'] === 'block'): ?>
            <?php $blockKey = $entry['key']; $block = $editableBlocks[$blockKey]; ?>
            <?php
                $blockType = $block['type'] ?? 'cards';
                if (!isset($blockTypeMeta[$blockType])) {
                    $blockType = in_array($blockType, ['steps', 'cards'], true) ? $blockType : 'cards';
                }
                $meta = $blockTypeMeta[$blockType];
                $blockItems = is_array($block['items'] ?? null) ? array_values($block['items']) : [];
            ?>
            <div class="page-block-card bg-white p-4 rounded-xl border border-slate-200 space-y-3"
                 data-block-key="<?php echo htmlspecialchars($blockKey); ?>"
                 data-block-type="<?php echo htmlspecialchars($blockType); ?>">
                <input type="hidden" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][_present]" value="1">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold text-slate-800"><?php echo htmlspecialchars($block['label'] ?? $blockKey); ?></h4>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                        <?php echo htmlspecialchars($meta['label']); ?>
                    </span>
                </div>

                <?php
                    // Newer section types declare their fields in the catalog;
                    // legacy service-page types show header fields only when
                    // the block already prints a heading.
                    $metaFields = isset($meta['fields']) && is_array($meta['fields']) ? $meta['fields'] : null;
                    $hasField = function ($f) use ($metaFields) { return $metaFields === null || in_array($f, $metaFields, true); };
                    $blockHasOwnHeader = $metaFields !== null
                        ? (bool)array_intersect($metaFields, ['badge', 'title', 'description'])
                        : (trim((string)($block['badge'] ?? '')) !== '' || trim((string)($block['title'] ?? '')) !== '' || trim((string)($block['description'] ?? '')) !== '');
                    $fInp = 'w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none';
                    $fMono = 'w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none';
                    $fTxt = 'w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none';
                    $fLbl = 'block text-[11px] font-bold text-slate-700 mb-1';
                    $bn = function ($f) use ($blockKey) { return 'page_blocks[' . htmlspecialchars($blockKey) . '][' . $f . ']'; };
                    $bv = function ($f) use ($block) { $v = $block[$f] ?? ''; return htmlspecialchars(is_array($v) ? implode("\n", $v) : (string)$v); };
                ?>
                <?php if (!empty($meta['help'])): ?>
                <p class="text-[10px] text-slate-600 bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-1.5"><i class="fas fa-circle-info mr-1 text-brand-blue"></i> <?php echo htmlspecialchars($meta['help']); ?></p>
                <?php endif; ?>
                <?php if (!$blockHasOwnHeader && $metaFields === null): ?>
                <p class="text-[10px] text-blue-700 bg-blue-50 border border-blue-100 rounded-lg px-2.5 py-1.5">
                    <i class="fas fa-circle-info mr-1"></i> This block prints no heading of its own on the website. The heading shown above it comes from the <strong>Main Body Section Content</strong> card — edit it there.
                </p>
                <?php endif; ?>

                <?php if ($blockHasOwnHeader): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <?php if ($hasField('badge')): ?>
                    <div>
                        <label class="<?php echo $fLbl; ?>">Sub-Badge</label>
                        <input type="text" name="<?php echo $bn('badge'); ?>" value="<?php echo $bv('badge'); ?>" class="<?php echo $fInp; ?>">
                    </div>
                    <?php endif; ?>
                    <?php if ($hasField('title')): ?>
                    <div>
                        <label class="<?php echo $fLbl; ?>">Heading (H2)<?php echo !empty($block['options']['title_html']) ? ' — wrap words in <span class="gradient-text">…</span> for the blue highlight' : ''; ?></label>
                        <input type="text" name="<?php echo $bn('title'); ?>" value="<?php echo $bv('title'); ?>" class="<?php echo $fInp; ?> font-bold">
                    </div>
                    <?php endif; ?>
                    <?php if ($metaFields !== null && $hasField('badge_icon')): ?>
                    <div>
                        <label class="<?php echo $fLbl; ?>">Badge Icon (Font Awesome, e.g. fa-heart)</label>
                        <input type="text" name="<?php echo $bn('badge_icon'); ?>" value="<?php echo $bv('badge_icon'); ?>" class="<?php echo $fMono; ?>">
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($hasField('description')): ?>
                <div>
                    <label class="<?php echo $fLbl; ?>">Introductory Paragraph</label>
                    <textarea name="<?php echo $bn('description'); ?>" rows="2" class="<?php echo $fTxt; ?>"><?php echo $bv('description'); ?></textarea>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <?php if ($metaFields !== null): ?>
                <?php if ($hasField('text')): ?>
                <div>
                    <label class="<?php echo $fLbl; ?>">Paragraphs (blank line between paragraphs; basic HTML like &lt;strong&gt; allowed)</label>
                    <textarea name="<?php echo $bn('text'); ?>" rows="5" class="<?php echo $fTxt; ?>"><?php echo $bv('text'); ?></textarea>
                </div>
                <?php endif; ?>
                <?php if ($hasField('bullets')): ?>
                <div>
                    <label class="<?php echo $fLbl; ?>">Bullet Points (one per line)</label>
                    <textarea name="<?php echo $bn('bullets'); ?>" rows="3" class="<?php echo $fTxt; ?>"><?php echo $bv('bullets'); ?></textarea>
                </div>
                <?php endif; ?>
                <?php if ($hasField('text_after')): ?>
                <div>
                    <label class="<?php echo $fLbl; ?>">Closing Paragraph(s) (shown after the bullets)</label>
                    <textarea name="<?php echo $bn('text_after'); ?>" rows="2" class="<?php echo $fTxt; ?>"><?php echo $bv('text_after'); ?></textarea>
                </div>
                <?php endif; ?>
                <?php if ($hasField('collection') || $hasField('variant') || $hasField('limit')): ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <?php if ($hasField('collection')): ?>
                    <div>
                        <label class="<?php echo $fLbl; ?>">Collection</label>
                        <select name="<?php echo $bn('collection'); ?>" class="<?php echo $fInp; ?>">
                            <?php foreach ($collectionChoices as $cKey => $cDef): ?>
                            <option value="<?php echo htmlspecialchars($cKey); ?>" <?php echo ($block['collection'] ?? '') === $cKey ? 'selected' : ''; ?>><?php echo htmlspecialchars($cDef['label'] ?? $cKey); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    <?php if ($hasField('variant')): ?>
                    <div>
                        <label class="<?php echo $fLbl; ?>">Layout variant</label>
                        <input type="text" name="<?php echo $bn('variant'); ?>" value="<?php echo $bv('variant'); ?>" class="<?php echo $fMono; ?>">
                    </div>
                    <?php endif; ?>
                    <?php if ($hasField('limit')): ?>
                    <div>
                        <label class="<?php echo $fLbl; ?>">Max items (0 = all)</label>
                        <input type="number" min="0" name="<?php echo $bn('limit'); ?>" value="<?php echo (int)($block['limit'] ?? 0); ?>" class="<?php echo $fInp; ?>">
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if ($hasField('button_text')): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="<?php echo $fLbl; ?>">Button Text (leave empty for no button)</label>
                        <input type="text" name="<?php echo $bn('button_text'); ?>" value="<?php echo $bv('button_text'); ?>" class="<?php echo $fInp; ?>">
                    </div>
                    <div>
                        <label class="<?php echo $fLbl; ?>">Button URL</label>
                        <input type="text" name="<?php echo $bn('button_url'); ?>" value="<?php echo $bv('button_url'); ?>" placeholder="about / #anchor / {phone} / https://…" class="<?php echo $fMono; ?>">
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($hasField('button2_text')): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="<?php echo $fLbl; ?>">Second Button Text ({phone} prints the hospital number)</label>
                        <input type="text" name="<?php echo $bn('button2_text'); ?>" value="<?php echo $bv('button2_text'); ?>" class="<?php echo $fInp; ?>">
                    </div>
                    <div>
                        <label class="<?php echo $fLbl; ?>">Second Button URL</label>
                        <input type="text" name="<?php echo $bn('button2_url'); ?>" value="<?php echo $bv('button2_url'); ?>" placeholder="{phone}" class="<?php echo $fMono; ?>">
                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <?php if (!empty($meta['block_image'])): ?>
                <?php cms_image_field('page_blocks[' . $blockKey . '][image]', $block['image'] ?? '', [
                    'label' => 'Section Photo', 'folder' => 'services', 'size' => '800 × 600 px',
                    'preview_class' => 'w-28 h-20',
                    'alt_name' => 'page_blocks[' . $blockKey . '][image_alt]', 'alt_value' => $block['image_alt'] ?? '',
                    'alt_label' => 'Photo alt tag (describe the image)',
                ]); ?>
                <?php endif; ?>

                <?php if (!empty($meta['block_roles'])): ?>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 mb-1">Doctor Role Bullets (one per line)</label>
                    <textarea name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][roles]" rows="2" placeholder="Chairman - Marengo Asia Neuro &amp; Spine" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars(implode("\n", (array)($block['roles'] ?? []))); ?></textarea>
                </div>
                <?php endif; ?>

                <?php if (!empty($meta['block_panel'])): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1"><?php echo $blockType === 'notice' ? 'Emergency Card Title (optional)' : 'Side Card Title (optional)'; ?></label>
                        <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][panel_title]" value="<?php echo htmlspecialchars($block['panel_title'] ?? ''); ?>" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1"><?php echo $blockType === 'notice' ? 'Emergency Card Text' : 'Side Card Text'; ?></label>
                        <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][panel_text]" value="<?php echo htmlspecialchars($block['panel_text'] ?? ''); ?>" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($meta['block_tags'])): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1">Pill Row Title (optional)</label>
                        <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][tags_title]" value="<?php echo htmlspecialchars($block['tags_title'] ?? ''); ?>" placeholder="Aura Signs" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1">Pill Row Items (one per line or comma separated)</label>
                        <textarea name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][tags]" rows="2" placeholder="Visual blind spots&#10;Flashing lights" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars(is_array($block['tags'] ?? null) ? implode("\n", $block['tags']) : (string)($block['tags'] ?? '')); ?></textarea>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($blockType === 'symptoms'): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1">Call-out Box Title (optional)</label>
                        <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][note_title]" value="<?php echo htmlspecialchars($block['note_title'] ?? ''); ?>" placeholder="The Golden Hour" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1">Call-out Box Icon</label>
                        <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][note_icon]" value="<?php echo htmlspecialchars($block['note_icon'] ?? ''); ?>" placeholder="fa-clock" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] font-mono focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 mb-1">Call-out Box Text</label>
                    <textarea name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][note_text]" rows="2" placeholder="Supporting sentence shown under the title" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($block['note_text'] ?? ''); ?></textarea>
                </div>
                <?php endif; ?>

                <?php if ($isFlowPage): ?>
                <details class="text-[10px] text-slate-500">
                    <summary class="cursor-pointer font-bold text-slate-600 hover:text-slate-800"><i class="fas fa-sliders mr-1"></i> Advanced layout options (JSON)</summary>
                    <p class="mt-1.5 mb-1">Design settings for this section (layout variant, image side, colours, accent photos…). Edit carefully — it must stay valid JSON. Leave as is if unsure.</p>
                    <textarea name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][options_json]" rows="3" spellcheck="false" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] font-mono leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars(json_encode((isset($block['options']) && is_array($block['options'])) ? $block['options'] : new stdClass(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)); ?></textarea>
                </details>
                <?php endif; ?>

                <?php if (empty($meta['no_items'])): ?>
                <div class="pt-2 border-t border-slate-100">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-[11px] font-bold text-slate-700">
                            <?php echo htmlspecialchars($meta['item_label'] ?? 'Item'); ?>s (<?php echo count($blockItems); ?>)
                        </label>
                        <button type="button" onclick="pageBlockAddItem(this)" class="px-2.5 py-1.5 bg-brand-blue hover:bg-blue-700 text-white text-[11px] font-bold rounded-lg transition-colors flex items-center space-x-1">
                            <i class="fas fa-plus text-[9px]"></i>
                            <span>Add <?php echo htmlspecialchars($meta['item_label'] ?? 'Item'); ?></span>
                        </button>
                    </div>

                    <div class="page-block-items space-y-3" data-next-index="<?php echo count($blockItems); ?>" data-sortable="1" data-sortable-item=".page-block-item">
                        <?php foreach ($blockItems as $ii => $item): ?>
                        <div class="page-block-item bg-slate-50 p-3 rounded-xl border border-slate-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-bold text-slate-500"><span class="drag-handle cursor-grab text-slate-300 hover:text-slate-500 mr-1.5" title="Drag to reorder"><i class="fas fa-grip-vertical"></i></span><?php echo htmlspecialchars($meta['item_label'] ?? 'Item'); ?> <span class="sort-position"><?php echo (int)$ii + 1; ?></span></span>
                                <button type="button" onclick="pageBlockRemoveItem(this)" class="text-[10px] text-red-500 font-bold hover:underline">
                                    <i class="fas fa-trash text-[9px]"></i> Remove
                                </button>
                            </div>
                            <?php $renderItemFields($blockType, $blockKey, (int)$ii, is_array($item) ? $item : []); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <template id="page-block-item-template-<?php echo htmlspecialchars($blockType); ?>">
                        <div class="page-block-item bg-slate-50 p-3 rounded-xl border border-slate-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-bold text-slate-500"><span class="drag-handle cursor-grab text-slate-300 hover:text-slate-500 mr-1.5" title="Drag to reorder"><i class="fas fa-grip-vertical"></i></span>New <?php echo htmlspecialchars($meta['item_label'] ?? 'Item'); ?></span>
                                <button type="button" onclick="pageBlockRemoveItem(this)" class="text-[10px] text-red-500 font-bold hover:underline"><i class="fas fa-trash text-[9px]"></i> Remove</button>
                            </div>
                            <?php $renderItemFields($blockType, '__KEY__', '__INDEX__', []); ?>
                        </div>
                    </template>
                </div>
                <?php endif; ?>
            </div>

            <?php else: ?>
            <?php
                $ctaKey = $entry['key'];
                $cta = cms_page_cta($slug, $ctaKey);
                $showIntro = trim($cta['intro'] ?? '') !== '' || $ctaKey === 'diagnosis';
            ?>
            <div class="bg-white p-4 rounded-xl border border-slate-200 space-y-3">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold text-slate-800">Buttons — <?php echo htmlspecialchars($cta['label'] ?? ucfirst(str_replace('-', ' ', $ctaKey))); ?></h4>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800 font-mono"><?php echo htmlspecialchars($ctaKey); ?></span>
                </div>
                <input type="hidden" name="page_ctas[<?php echo htmlspecialchars($ctaKey); ?>][_present]" value="1">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Button Text</label>
                        <input type="text" name="page_ctas[<?php echo htmlspecialchars($ctaKey); ?>][text]" value="<?php echo htmlspecialchars($cta['text'] ?? ''); ?>" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Button URL</label>
                        <input type="text" name="page_ctas[<?php echo htmlspecialchars($ctaKey); ?>][url]" value="<?php echo htmlspecialchars($cta['url'] ?? ''); ?>" placeholder="contact (#) / #appointment / {phone} / https://…" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <?php if ($showIntro): ?>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Line Above The Buttons (optional)</label>
                    <input type="text" name="page_ctas[<?php echo htmlspecialchars($ctaKey); ?>][intro]" value="<?php echo htmlspecialchars($cta['intro'] ?? ''); ?>" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php endforeach; ?>
            <?php if ($isFlowPage): ?>
            <?php if ($flowGroupOpen): ?></div><?php endif; ?>
            </div>
            <div class="rounded-2xl border border-dashed border-brand-blue/40 bg-blue-50/40 p-4 flex flex-col sm:flex-row sm:items-center gap-3">
                <div class="flex-1">
                    <h4 class="text-xs font-bold text-slate-800"><i class="fas fa-plus-circle text-brand-blue mr-1.5"></i> Add a new section to this page</h4>
                    <p class="text-[10px] text-slate-500 mt-0.5">The section is added at the bottom with sample content; drag it into place, edit its text, then save.</p>
                </div>
                <select id="add-block-type-select" class="px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-semibold">
                    <?php foreach ($blockTypeCatalog as $tKey => $tMeta): if (in_array($tKey, ['intro'], true)) continue; ?>
                    <option value="<?php echo htmlspecialchars($tKey); ?>"><?php echo htmlspecialchars($tMeta['label']); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="button" onclick="flowAddBlock()" class="px-4 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm"><i class="fas fa-plus mr-1"></i> Add section</button>
            </div>
            <script>
            function flowAddBlock() {
                document.getElementById('add-block-type-input').value = document.getElementById('add-block-type-select').value;
                document.getElementById('page-edit-form').submit();
            }
            function flowRemoveBlock(key) {
                if (!confirm('Remove this section and its content from the page?')) return;
                document.getElementById('remove-block-input').value = key;
                document.getElementById('page-edit-form').submit();
            }
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('#flow-list .flow-item .sort-position').forEach(function (el, i) { el.textContent = i + 1; });
            });
            </script>
            <?php endif; ?>
        </div>

        <script>
        function pageBlockAddItem(button) {
            var block = button.closest('.page-block-card');
            if (!block) return;
            var key = block.getAttribute('data-block-key');
            var type = block.getAttribute('data-block-type');
            var container = block.querySelector('.page-block-items');
            var template = document.getElementById('page-block-item-template-' + type) || document.getElementById('page-block-item-template-cards');
            if (!container || !template) return;

            var index = parseInt(container.getAttribute('data-next-index') || '0', 10);
            var html = template.innerHTML.replace(/__KEY__/g, key).replace(/__INDEX__/g, String(index));
            var wrapper = document.createElement('div');
            wrapper.innerHTML = html.trim();
            var item = wrapper.firstElementChild;
            if (!item) return;
            container.appendChild(item);
            container.setAttribute('data-next-index', String(index + 1));
            if (typeof window.cmsWireImageFields === 'function') window.cmsWireImageFields(item);
            if (typeof window.cmsInitRichEditors === 'function') window.cmsInitRichEditors(item);
        }

        function pageBlockRemoveItem(button) {
            var item = button.closest('.page-block-item');
            if (item) item.remove();
        }
        </script>
        <?php endif; ?>

        <!-- Additional Custom Sections -->
        <?php $existingCustomSections = is_array($pageData['custom_sections'] ?? null) ? array_values($pageData['custom_sections']) : []; ?>
        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center">
                        <i class="fas fa-layer-group text-brand-blue mr-2"></i> Additional Page Sections
                    </h3>
                    <p class="text-[10px] text-slate-500 mt-1">Add extra body sections to this page. They appear below the main section and above the footer.</p>
                </div>
                <button type="button" onclick="addCustomSection()" class="px-3.5 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition-colors flex items-center justify-center space-x-1.5 self-start sm:self-auto">
                    <i class="fas fa-plus text-[10px]"></i>
                    <span>Add Section</span>
                </button>
            </div>

            <div id="custom-sections-container" class="space-y-4" data-next-index="<?php echo count($existingCustomSections); ?>" data-sortable="1" data-sortable-item=".custom-section-card">
                <?php foreach ($existingCustomSections as $ci => $cs): ?>
                <div class="custom-section-card bg-white p-4 rounded-xl border border-slate-200 space-y-3" data-index="<?php echo (int)$ci; ?>">
                    <div class="flex items-center justify-between">
                        <h4 class="text-xs font-bold text-slate-800 custom-section-number"><span class="drag-handle cursor-grab text-slate-300 hover:text-slate-500 mr-1.5" title="Drag to reorder"><i class="fas fa-grip-vertical"></i></span><span class="custom-section-label">Section <?php echo (int)$ci + 1; ?></span></h4>
                        <button type="button" onclick="removeCustomSection(this)" class="text-[11px] text-red-500 font-bold hover:underline flex items-center space-x-1">
                            <i class="fas fa-trash text-[9px]"></i>
                            <span>Remove</span>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Sub-Badge</label>
                            <input type="text" name="custom_sections[<?php echo (int)$ci; ?>][badge]" value="<?php echo htmlspecialchars($cs['badge'] ?? ''); ?>" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Heading (H2)</label>
                            <input type="text" name="custom_sections[<?php echo (int)$ci; ?>][title]" value="<?php echo htmlspecialchars($cs['title'] ?? ''); ?>" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Layout</label>
                        <select name="custom_sections[<?php echo (int)$ci; ?>][layout]" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="image-right" <?php echo ($cs['layout'] ?? '') === 'image-right' ? 'selected' : ''; ?>>Image on right</option>
                            <option value="image-left" <?php echo ($cs['layout'] ?? '') === 'image-left' ? 'selected' : ''; ?>>Image on left</option>
                            <option value="text-only" <?php echo ($cs['layout'] ?? '') === 'text-only' ? 'selected' : ''; ?>>Text only</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Section Content</label>
                        <textarea name="custom_sections[<?php echo (int)$ci; ?>][text]" rows="6" class="wysiwyg-editor w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($cs['text'] ?? ''); ?></textarea>
                    </div>

                    <?php cms_image_field('custom_sections[' . (int)$ci . '][image]', $cs['image'] ?? '', [
                        'label' => 'Section Photo', 'folder' => 'pages', 'size' => '800 × 600 px', 'preview_class' => 'w-28 h-20',
                        'alt_name' => 'custom_sections[' . (int)$ci . '][image_alt]', 'alt_value' => $cs['image_alt'] ?? '',
                        'alt_label' => 'Photo alt tag',
                    ]); ?>
                </div>
                <?php endforeach; ?>
            </div>

            <p class="text-[10px] text-slate-400">Tip: leave a section's heading and content empty to remove it when saving.</p>
        </div>

        <template id="custom-section-template">
            <div class="custom-section-card bg-white p-4 rounded-xl border border-slate-200 space-y-3" data-index="__INDEX__">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold text-slate-800 custom-section-number"><span class="drag-handle cursor-grab text-slate-300 hover:text-slate-500 mr-1.5" title="Drag to reorder"><i class="fas fa-grip-vertical"></i></span><span class="custom-section-label">Section</span></h4>
                    <button type="button" onclick="removeCustomSection(this)" class="text-[11px] text-red-500 font-bold hover:underline flex items-center space-x-1">
                        <i class="fas fa-trash text-[9px]"></i>
                        <span>Remove</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Sub-Badge</label>
                        <input type="text" name="custom_sections[__INDEX__][badge]" value="" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Heading (H2)</label>
                        <input type="text" name="custom_sections[__INDEX__][title]" value="" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Layout</label>
                    <select name="custom_sections[__INDEX__][layout]" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="image-right">Image on right</option>
                        <option value="image-left">Image on left</option>
                        <option value="text-only">Text only</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Section Content</label>
                    <textarea name="custom_sections[__INDEX__][text]" rows="6" class="wysiwyg-editor w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>

                <?php cms_image_field('custom_sections[__INDEX__][image]', '', [
                    'label' => 'Section Photo', 'folder' => 'pages', 'size' => '800 × 600 px', 'preview_class' => 'w-28 h-20',
                    'alt_name' => 'custom_sections[__INDEX__][image_alt]', 'alt_value' => '',
                    'alt_label' => 'Photo alt tag',
                ]); ?>
            </div>
        </template>

        <script>
        function renumberCustomSections() {
            document.querySelectorAll('#custom-sections-container .custom-section-card').forEach(function (card, i) {
                var label = card.querySelector(".custom-section-label");
                if (label) label.textContent = 'Section ' + (i + 1);
            });
        }

        function addCustomSection() {
            var container = document.getElementById('custom-sections-container');
            var template = document.getElementById('custom-section-template');
            if (!container || !template) return;

            var index = parseInt(container.getAttribute('data-next-index') || '0', 10);
            var html = template.innerHTML.replace(/__INDEX__/g, String(index));
            var wrapper = document.createElement('div');
            wrapper.innerHTML = html.trim();
            var card = wrapper.firstElementChild;
            if (!card) return;

            container.appendChild(card);
            container.setAttribute('data-next-index', String(index + 1));
            renumberCustomSections();

            if (typeof window.cmsInitRichEditors === 'function') {
                window.cmsInitRichEditors(card);
            }
            if (typeof window.cmsWireImageFields === 'function') {
                window.cmsWireImageFields(card);
            }
        }

        function removeCustomSection(button) {
            var card = button.closest('.custom-section-card');
            if (card) card.remove();
            renumberCustomSections();
        }
        </script>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
            <a href="pages.php" class="text-xs text-slate-500 font-semibold hover:underline">&larr; Back to All Pages</a>
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center space-x-1.5">
                <i class="fas fa-save"></i>
                <span>Save Page Content &amp; SEO Meta</span>
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
