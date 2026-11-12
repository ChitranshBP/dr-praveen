<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
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

    // SEO Meta Title & Meta Description
    $pageData['meta_title'] = trim($_POST['meta_title'] ?? '');
    $pageData['meta_description'] = trim($_POST['meta_description'] ?? '');

    $uploadErrors = [];

    // Handle Hero Banner image upload
    $heroUpload = cms_handle_upload('hero_bg_file', 'breadcrumbs');
    if (is_array($heroUpload) && isset($heroUpload['error'])) {
        $uploadErrors[] = 'Hero banner: ' . $heroUpload['error'];
    } elseif (is_array($heroUpload) && !empty($heroUpload['path'])) {
        $pageData['hero_bg'] = $heroUpload['path'];
    }

    // Handle Section Image upload
    $secUpload = cms_handle_upload('section1_img_file', 'services');
    if (is_array($secUpload) && isset($secUpload['error'])) {
        $uploadErrors[] = 'Section photo: ' . $secUpload['error'];
    } elseif (is_array($secUpload) && !empty($secUpload['path'])) {
        $pageData['section1_image'] = $secUpload['path'];
        // A new photo invalidates any old alt-text placeholder, but keep a
        // real alt tag the editor already wrote.
        if (empty($pageData['section1_img_alt'])) {
            $pageData['section1_img_alt'] = $pageData['section1_title'] ?? '';
        }
    }

    // Additional custom page sections (optional repeater).
    $customSections = [];
    $postedSections = $_POST['custom_sections'] ?? [];
    if (is_array($postedSections)) {
        foreach ($postedSections as $i => $sec) {
            if (!is_array($sec)) {
                continue;
            }
            $cImage = trim($sec['image'] ?? '');
            $uploadKey = 'custom_section_image_' . $i;
            $cUpload = cms_handle_upload($uploadKey, 'pages');
            if (is_array($cUpload) && isset($cUpload['error'])) {
                $uploadErrors[] = 'Custom section ' . ((int)$i + 1) . ' photo: ' . $cUpload['error'];
            } elseif (is_array($cUpload) && !empty($cUpload['path'])) {
                $cImage = $cUpload['path'];
            }

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

    // Editable page blocks (Techniques, What to Expect, ...). Defaults come
    // from data/page-blocks.json; the submitted values are stored here.
    $blockDefaults = cms_page_blocks($slug);
    $postedBlocks = $_POST['page_blocks'] ?? [];
    if (!empty($blockDefaults) && is_array($postedBlocks)) {
        $existingBlocks = (isset($pageData['blocks']) && is_array($pageData['blocks'])) ? $pageData['blocks'] : [];
        $savedBlocks = $existingBlocks;
        foreach ($blockDefaults as $bKey => $bDefault) {
            if (!is_array($bDefault) || !isset($postedBlocks[$bKey]) || !is_array($postedBlocks[$bKey])) {
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
            // The stored photo survives unless the editor removed it, typed /
            // picked a new path, or uploaded a file (handled further down).
            if (isset($base['image'])) {
                $block['image'] = $base['image'];
            }
            if (!empty($pb['image_remove'])) {
                $block['image'] = '';
            } elseif (isset($pb['image']) && trim((string)$pb['image']) !== '') {
                $block['image'] = trim((string)$pb['image']);
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
                    $itemImage = trim($item['image'] ?? '');
                    if ($itemImage !== '') {
                        $it['image'] = $itemImage;
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
                // Keep an item that only carries a URL or bullets, and drop
                // ones left completely blank by the editor.
                if ($it['title'] === '' && $it['text'] === '' && empty($it['bullets']) && empty($it['url']) && empty($it['subtitle'])) {
                    continue;
                }
                $block['items'][] = $it;
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

            // Block-level photo upload (symptoms / why-choose / doctor splits).
            $bUpload = cms_handle_upload('page_block_image_' . $bKey, 'services');
            if (is_array($bUpload) && isset($bUpload['error'])) {
                $uploadErrors[] = $bKey . ' section photo: ' . $bUpload['error'];
            } elseif (is_array($bUpload) && !empty($bUpload['path'])) {
                $block['image'] = $bUpload['path'];
                if (empty($block['image_alt'])) {
                    $block['image_alt'] = $block['title'] ?? '';
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

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-6">
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

            <div class="bg-white p-4 rounded-xl border border-slate-200 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold text-slate-800">
                        <i class="fas fa-image text-brand-blue mr-1"></i> Hero Background Banner
                    </label>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Recommended: 1920 × 600 px</span>
                </div>
                <p class="text-[10px] text-slate-500">Wide header backdrop (Aspect ratio ~16:5). Supported: WebP, PNG, JPG (Max 4MB).</p>
                <?php if (!empty($pageData['hero_bg'])): ?>
                <div class="flex items-center space-x-3 py-1">
                    <img src="../<?php echo htmlspecialchars($pageData['hero_bg']); ?>" class="w-24 h-12 object-cover rounded-lg border border-slate-200" alt="Hero bg">
                    <span class="text-[11px] text-slate-400 font-mono"><?php echo htmlspecialchars($pageData['hero_bg']); ?></span>
                </div>
                <?php endif; ?>
                <input type="file" name="hero_bg_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                <div class="pt-2 border-t border-slate-100">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Hero Banner Image Alt Tag</label>
                    <input type="text" name="hero_bg_alt" value="<?php echo htmlspecialchars($pageData['hero_bg_alt'] ?? ''); ?>" placeholder="e.g. <?php echo htmlspecialchars($pageMeta['title'] ?? 'Neurology Service'); ?> Banner - Dr. Praveen Gupta" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>
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
        $effectiveSection = cms_section_resolve($pageData, cms_template_section_defaults($pageMeta['file'] ?? null));
        ?>

        <?php if (!empty($orderedEntries)): ?>
        <?php
        $blockTypeMeta = [
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
            'cards'      => ['icon_color', 'badge', 'title', 'text', 'bullets', 'tags'],
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

        /**
         * Print the editor fields for one repeater item of a block type.
         * Echoed directly; used for saved items and for the "add item" templates.
         */
        $renderItemFields = function ($type, $key, $index, array $item = []) use ($blockItemFields) {
            $fields = $blockItemFields[$type] ?? $blockItemFields['cards'];
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
                ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <label class="<?php echo $lbl; ?>">Photo path / URL (optional)</label>
                        <input type="text" name="<?php echo $name('image'); ?>" value="<?php echo $val('image'); ?>" placeholder="assets/services/… or https://…" class="<?php echo $inpMono; ?>">
                    </div>
                    <div>
                        <label class="<?php echo $lbl; ?>">Photo Alt Tag</label>
                        <input type="text" name="<?php echo $name('image_alt'); ?>" value="<?php echo $val('image_alt'); ?>" class="<?php echo $inp; ?>">
                    </div>
                </div>
                <?php
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
                    <label class="<?php echo $lbl; ?>">Title</label>
                    <input type="text" name="<?php echo $name('title'); ?>" value="<?php echo $val('title'); ?>" class="<?php echo $inp; ?>">
                </div>
                <?php
            }
            if (in_array('subtitle', $fields, true)) {
                ?>
                <div>
                    <label class="<?php echo $lbl; ?>">Small Sub-Label (optional)</label>
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

            <?php foreach ($orderedEntries as $entry): ?>

            <?php if ($entry['kind'] === 'section1'): ?>
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

                <div class="bg-slate-50 p-3 rounded-xl border border-slate-200 space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="block text-[10px] font-bold text-slate-600">
                            <i class="fas fa-camera text-brand-blue mr-1"></i> Section Feature Photo
                        </label>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Recommended: 800 × 600 px</span>
                    </div>
                    <p class="text-[10px] text-slate-500">Standard 4:3 landscape photo. Supported: WebP, PNG, JPG (Max 4MB).</p>
                    <?php if ($effImage !== ''): ?>
                    <div class="flex items-center space-x-3 py-1">
                        <img src="../<?php echo htmlspecialchars($effImage); ?>" class="w-16 h-12 object-cover rounded-lg border border-slate-200" alt="<?php echo htmlspecialchars($effImageAlt !== '' ? $effImageAlt : 'Section Image'); ?>">
                        <span class="text-[10px] text-slate-400 font-mono break-all"><?php echo htmlspecialchars($effImage); ?></span>
                    </div>
                    <?php endif; ?>
                    <input type="file" name="section1_img_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                    <div class="pt-2 border-t border-slate-100">
                        <label class="block text-[10px] font-bold text-slate-600 mb-1">Section Photo Alt Tag</label>
                        <input type="text" name="section1_img_alt" value="<?php echo htmlspecialchars($effImageAlt); ?>" placeholder="e.g. <?php echo htmlspecialchars($pageMeta['title'] ?? 'Treatment'); ?> Clinical Procedure" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>
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

                <?php $blockHasOwnHeader = trim((string)($block['badge'] ?? '')) !== '' || trim((string)($block['title'] ?? '')) !== '' || trim((string)($block['description'] ?? '')) !== ''; ?>
                <?php if (!$blockHasOwnHeader): ?>
                <p class="text-[10px] text-blue-700 bg-blue-50 border border-blue-100 rounded-lg px-2.5 py-1.5">
                    <i class="fas fa-circle-info mr-1"></i> This block prints no heading of its own on the website. The heading shown above it comes from the <strong>Main Body Section Content</strong> card — edit it there.
                </p>
                <?php endif; ?>

                <?php if ($blockHasOwnHeader): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Sub-Badge</label>
                        <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][badge]" value="<?php echo htmlspecialchars($block['badge'] ?? ''); ?>" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Heading (H2)</label>
                        <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][title]" value="<?php echo htmlspecialchars($block['title'] ?? ''); ?>" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Introductory Paragraph</label>
                    <textarea name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][description]" rows="2" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($block['description'] ?? ''); ?></textarea>
                </div>
                <?php endif; ?>

                <?php if (!empty($meta['block_image'])): ?>
                <div class="bg-white p-3 rounded-xl border border-slate-200 space-y-2">
                    <label class="block text-[10px] font-bold text-slate-600">
                        <i class="fas fa-image text-brand-blue mr-1"></i> Section Photo
                    </label>
                    <?php if (!empty($block['image'])): ?>
                    <div class="flex items-center space-x-3 py-1">
                        <img src="../<?php echo htmlspecialchars($block['image']); ?>" class="w-16 h-12 object-cover rounded-lg border border-slate-200" alt="Section photo">
                        <span class="text-[10px] text-slate-400 font-mono break-all"><?php echo htmlspecialchars($block['image']); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">Replace Photo (max 8MB)</label>
                            <input type="file" name="page_block_image_<?php echo htmlspecialchars($blockKey); ?>" accept=".webp,.png,.jpg,.jpeg" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px]">
                            <?php if (!empty($block['image'])): ?>
                            <label class="inline-flex items-center space-x-1.5 mt-1.5 text-[10px] font-semibold text-red-600">
                                <input type="checkbox" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][image_remove]" value="1" class="w-3.5 h-3.5 rounded">
                                <span>Remove this photo</span>
                            </label>
                            <?php endif; ?>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-600 mb-1">Photo Alt Tag</label>
                            <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][image_alt]" value="<?php echo htmlspecialchars($block['image_alt'] ?? ''); ?>" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                    </div>
                </div>
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
                        <label class="block text-[10px] font-bold text-slate-600 mb-1">Emergency Card Title (optional)</label>
                        <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][panel_title]" value="<?php echo htmlspecialchars($block['panel_title'] ?? ''); ?>" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1">Emergency Card Text</label>
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

                <div class="pt-2 border-t border-slate-100">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-[11px] font-bold text-slate-700">
                            <?php echo htmlspecialchars($meta['item_label']); ?>s (<?php echo count($blockItems); ?>)
                        </label>
                        <button type="button" onclick="pageBlockAddItem(this)" class="px-2.5 py-1.5 bg-brand-blue hover:bg-blue-700 text-white text-[11px] font-bold rounded-lg transition-colors flex items-center space-x-1">
                            <i class="fas fa-plus text-[9px]"></i>
                            <span>Add <?php echo htmlspecialchars($meta['item_label']); ?></span>
                        </button>
                    </div>

                    <div class="page-block-items space-y-3" data-next-index="<?php echo count($blockItems); ?>">
                        <?php foreach ($blockItems as $ii => $item): ?>
                        <div class="page-block-item bg-slate-50 p-3 rounded-xl border border-slate-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-bold text-slate-500"><?php echo htmlspecialchars($meta['item_label']); ?> <?php echo (int)$ii + 1; ?></span>
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
                                <span class="text-[10px] font-bold text-slate-500">New <?php echo htmlspecialchars($meta['item_label']); ?></span>
                                <button type="button" onclick="pageBlockRemoveItem(this)" class="text-[10px] text-red-500 font-bold hover:underline"><i class="fas fa-trash text-[9px]"></i> Remove</button>
                            </div>
                            <?php $renderItemFields($blockType, '__KEY__', '__INDEX__', []); ?>
                        </div>
                    </template>
                </div>
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

            <div id="custom-sections-container" class="space-y-4" data-next-index="<?php echo count($existingCustomSections); ?>">
                <?php foreach ($existingCustomSections as $ci => $cs): ?>
                <div class="custom-section-card bg-white p-4 rounded-xl border border-slate-200 space-y-3" data-index="<?php echo (int)$ci; ?>">
                    <div class="flex items-center justify-between">
                        <h4 class="text-xs font-bold text-slate-800 custom-section-number">Section <?php echo (int)$ci + 1; ?></h4>
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Layout</label>
                            <select name="custom_sections[<?php echo (int)$ci; ?>][layout]" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <option value="image-right" <?php echo ($cs['layout'] ?? '') === 'image-right' ? 'selected' : ''; ?>>Image on right</option>
                                <option value="image-left" <?php echo ($cs['layout'] ?? '') === 'image-left' ? 'selected' : ''; ?>>Image on left</option>
                                <option value="text-only" <?php echo ($cs['layout'] ?? '') === 'text-only' ? 'selected' : ''; ?>>Text only</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Photo Alt Tag</label>
                            <input type="text" name="custom_sections[<?php echo (int)$ci; ?>][image_alt]" value="<?php echo htmlspecialchars($cs['image_alt'] ?? ''); ?>" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Section Content</label>
                        <textarea name="custom_sections[<?php echo (int)$ci; ?>][text]" rows="6" class="wysiwyg-editor w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($cs['text'] ?? ''); ?></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Photo Path or URL</label>
                            <input type="text" name="custom_sections[<?php echo (int)$ci; ?>][image]" value="<?php echo htmlspecialchars($cs['image'] ?? ''); ?>" placeholder="assets/... or https://..." class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Upload Photo</label>
                            <input type="file" name="custom_section_image_<?php echo (int)$ci; ?>" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <?php if (!empty($cs['image'])): ?>
                    <div class="w-28 aspect-[4/3] rounded-lg overflow-hidden border border-slate-200">
                        <img src="../<?php echo htmlspecialchars($cs['image']); ?>" class="w-full h-full object-cover" alt="<?php echo htmlspecialchars($cs['image_alt'] ?? 'Custom section image'); ?>">
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <p class="text-[10px] text-slate-400">Tip: leave a section's heading and content empty to remove it when saving.</p>
        </div>

        <template id="custom-section-template">
            <div class="custom-section-card bg-white p-4 rounded-xl border border-slate-200 space-y-3" data-index="__INDEX__">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold text-slate-800 custom-section-number">Section</h4>
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Layout</label>
                        <select name="custom_sections[__INDEX__][layout]" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="image-right">Image on right</option>
                            <option value="image-left">Image on left</option>
                            <option value="text-only">Text only</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Photo Alt Tag</label>
                        <input type="text" name="custom_sections[__INDEX__][image_alt]" value="" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Section Content</label>
                    <textarea name="custom_sections[__INDEX__][text]" rows="6" class="wysiwyg-editor w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Photo Path or URL</label>
                        <input type="text" name="custom_sections[__INDEX__][image]" value="" placeholder="assets/... or https://..." class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Upload Photo</label>
                        <input type="file" name="custom_section_image___INDEX__" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>
            </div>
        </template>

        <script>
        function renumberCustomSections() {
            document.querySelectorAll('#custom-sections-container .custom-section-card').forEach(function (card, i) {
                var label = card.querySelector('.custom-section-number');
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
