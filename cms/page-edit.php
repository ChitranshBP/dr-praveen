<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/page-blocks.php';

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
    $blockDefaults = cms_page_blocks_defaults($slug);
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
            $bType = ($bDefault['type'] ?? 'cards') === 'steps' ? 'steps' : 'cards';
            $block = [
                'type'        => $bType,
                'badge'       => trim($pb['badge'] ?? ''),
                'title'       => trim($pb['title'] ?? ''),
                'description' => trim($pb['description'] ?? ''),
                'items'       => [],
            ];
            foreach (($pb['items'] ?? []) as $item) {
                if (!is_array($item)) {
                    continue;
                }
                $it = [
                    'title' => trim($item['title'] ?? ''),
                    'text'  => trim($item['text'] ?? ''),
                ];
                $bulletsRaw = $item['bullets'] ?? '';
                $bullets = is_array($bulletsRaw) ? $bulletsRaw : preg_split('/\r\n|\r|\n/', (string)$bulletsRaw);
                $bullets = array_values(array_filter(array_map('trim', $bullets), function ($b) {
                    return $b !== '';
                }));
                if (!empty($bullets)) {
                    $it['bullets'] = $bullets;
                }
                if ($bType === 'cards') {
                    $icon = trim($item['icon'] ?? '');
                    $it['icon'] = $icon !== '' ? $icon : 'fa-check';
                    $color = $item['color'] ?? 'electric-blue';
                    if (!in_array($color, ['electric-blue', 'cyan-accent', 'deep-indigo'], true)) {
                        $color = 'electric-blue';
                    }
                    $it['color'] = $color;
                    $tagsRaw = $item['tags'] ?? '';
                    $tags = is_array($tagsRaw) ? $tagsRaw : explode(',', (string)$tagsRaw);
                    $it['tags'] = array_values(array_filter(array_map('trim', $tags), function ($t) {
                        return $t !== '';
                    }));
                }
                if ($it['title'] === '' && $it['text'] === '') {
                    continue;
                }
                $block['items'][] = $it;
            }
            $savedBlocks[$bKey] = $block;
        }
        $pageData['blocks'] = $savedBlocks;
    }

    $dataDir = dirname($pageDataFile);
    if (!is_dir($dataDir)) {
        @mkdir($dataDir, 0755, true);
    }

    $json = json_encode($pageData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $saved = ($json !== false) && file_put_contents($pageDataFile, $json, LOCK_EX) !== false;

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

        <!-- Main Section Content Box -->
        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-4">
            <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center">
                <i class="fas fa-align-left text-brand-blue mr-2"></i> Main Body Section Content
            </h3>
            <p class="text-[10px] text-slate-500 -mt-2">This content is rendered in the body of the page. Service and condition templates place it inside their own layout; every other page shows it just above the footer. Leave a field empty to keep the page's built-in copy.</p>
            <p class="text-[10px] text-amber-600 -mt-1"><i class="fas fa-circle-info mr-1"></i> Catalog placeholder text (for example “Expert Clinical Approach to…”) is ignored on the live site — replace it with your own copy to make this section appear.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Section Sub-Badge</label>
                    <input type="text" name="section1_badge" value="<?php echo htmlspecialchars($pageData['section1_badge'] ?? ''); ?>" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Section Heading (H2)</label>
                    <input type="text" name="section1_title" value="<?php echo htmlspecialchars($pageData['section1_title'] ?? ''); ?>" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Section Content Paragraphs (Full Rich Text Editor)</label>
                <textarea name="section1_text" rows="8" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($pageData['section1_text'] ?? ''); ?></textarea>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold text-slate-800">
                        <i class="fas fa-camera text-brand-blue mr-1"></i> Section Feature Photo
                    </label>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Recommended: 800 × 600 px</span>
                </div>
                <p class="text-[10px] text-slate-500">Standard 4:3 landscape photo. Supported: WebP, PNG, JPG (Max 4MB).</p>
                <?php if (!empty($pageData['section1_image'])): ?>
                <div class="w-32 aspect-[4/3] rounded-lg overflow-hidden border border-slate-200 py-1">
                    <img src="../<?php echo htmlspecialchars($pageData['section1_image']); ?>" class="w-full h-full object-cover" alt="<?php echo htmlspecialchars($pageData['section1_img_alt'] ?? 'Section Image'); ?>">
                </div>
                <?php endif; ?>
                <input type="file" name="section1_img_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                <div class="pt-2 border-t border-slate-100">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Section Photo Alt Tag</label>
                    <input type="text" name="section1_img_alt" value="<?php echo htmlspecialchars($pageData['section1_img_alt'] ?? ''); ?>" placeholder="e.g. <?php echo htmlspecialchars($pageMeta['title'] ?? 'Treatment'); ?> Clinical Procedure" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- Editable Existing Page Sections -->
        <?php $editableBlocks = cms_page_blocks($slug); ?>
        <?php if (!empty($editableBlocks)): ?>
        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-4">
            <div>
                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center">
                    <i class="fas fa-pen-to-square text-brand-blue mr-2"></i> Existing Page Content Sections
                </h3>
                <p class="text-[10px] text-slate-500 mt-1">Edit the sections that already appear on this page. Changes save with the rest of the page.</p>
            </div>

            <?php foreach ($editableBlocks as $blockKey => $block): ?>
            <?php
                $blockType = ($block['type'] ?? 'cards') === 'steps' ? 'steps' : 'cards';
                $blockItems = is_array($block['items'] ?? null) ? array_values($block['items']) : [];
            ?>
            <div class="page-block-card bg-white p-4 rounded-xl border border-slate-200 space-y-3"
                 data-block-key="<?php echo htmlspecialchars($blockKey); ?>"
                 data-block-type="<?php echo htmlspecialchars($blockType); ?>">
                <input type="hidden" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][_present]" value="1">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold text-slate-800"><?php echo htmlspecialchars($block['label'] ?? $blockKey); ?></h4>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                        <?php echo $blockType === 'steps' ? 'Numbered steps' : 'Card grid'; ?>
                    </span>
                </div>

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

                <div class="pt-2 border-t border-slate-100">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-[11px] font-bold text-slate-700">
                            <?php echo $blockType === 'steps' ? 'Steps' : 'Cards'; ?> (<?php echo count($blockItems); ?>)
                        </label>
                        <button type="button" onclick="pageBlockAddItem(this)" class="px-2.5 py-1.5 bg-brand-blue hover:bg-blue-700 text-white text-[11px] font-bold rounded-lg transition-colors flex items-center space-x-1">
                            <i class="fas fa-plus text-[9px]"></i>
                            <span>Add <?php echo $blockType === 'steps' ? 'Step' : 'Card'; ?></span>
                        </button>
                    </div>

                    <div class="page-block-items space-y-3" data-next-index="<?php echo count($blockItems); ?>">
                        <?php foreach ($blockItems as $ii => $item): ?>
                        <div class="page-block-item bg-slate-50 p-3 rounded-xl border border-slate-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-bold text-slate-500"><?php echo $blockType === 'steps' ? 'Step' : 'Card'; ?> <?php echo (int)$ii + 1; ?></span>
                                <button type="button" onclick="pageBlockRemoveItem(this)" class="text-[10px] text-red-500 font-bold hover:underline">
                                    <i class="fas fa-trash text-[9px]"></i> Remove
                                </button>
                            </div>

                            <?php if ($blockType === 'cards'): ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-600 mb-1">Font Awesome Icon</label>
                                    <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][items][<?php echo (int)$ii; ?>][icon]" value="<?php echo htmlspecialchars($item['icon'] ?? 'fa-check'); ?>" placeholder="fa-shield-alt" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-mono focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-600 mb-1">Icon Colour</label>
                                    <select name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][items][<?php echo (int)$ii; ?>][color]" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                        <option value="electric-blue" <?php echo ($item['color'] ?? '') === 'electric-blue' ? 'selected' : ''; ?>>Electric blue</option>
                                        <option value="cyan-accent" <?php echo ($item['color'] ?? '') === 'cyan-accent' ? 'selected' : ''; ?>>Cyan</option>
                                        <option value="deep-indigo" <?php echo ($item['color'] ?? '') === 'deep-indigo' ? 'selected' : ''; ?>>Deep indigo</option>
                                    </select>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 mb-1">Title</label>
                                <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][items][<?php echo (int)$ii; ?>][title]" value="<?php echo htmlspecialchars($item['title'] ?? ''); ?>" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 mb-1">Description</label>
                                <textarea name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][items][<?php echo (int)$ii; ?>][text]" rows="2" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($item['text'] ?? ''); ?></textarea>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 mb-1">Bullet Points (one per line, optional)</label>
                                <textarea name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][items][<?php echo (int)$ii; ?>][bullets]" rows="2" placeholder="One item per line" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars(is_array($item['bullets'] ?? null) ? implode("\n", $item['bullets']) : (string)($item['bullets'] ?? '')); ?></textarea>
                            </div>
                            <?php if ($blockType === 'cards'): ?>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 mb-1">Tag Pills (comma-separated)</label>
                                <input type="text" name="page_blocks[<?php echo htmlspecialchars($blockKey); ?>][items][<?php echo (int)$ii; ?>][tags]" value="<?php echo htmlspecialchars(implode(', ', (array)($item['tags'] ?? []))); ?>" placeholder="Keyhole Access, Faster Recovery" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <template id="page-block-card-template">
            <div class="page-block-item bg-slate-50 p-3 rounded-xl border border-slate-200 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-500">Card</span>
                    <button type="button" onclick="pageBlockRemoveItem(this)" class="text-[10px] text-red-500 font-bold hover:underline"><i class="fas fa-trash text-[9px]"></i> Remove</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1">Font Awesome Icon</label>
                        <input type="text" name="page_blocks[__KEY__][items][__INDEX__][icon]" value="fa-check" placeholder="fa-shield-alt" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-mono focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1">Icon Colour</label>
                        <select name="page_blocks[__KEY__][items][__INDEX__][color]" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="electric-blue">Electric blue</option>
                            <option value="cyan-accent">Cyan</option>
                            <option value="deep-indigo">Deep indigo</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 mb-1">Title</label>
                    <input type="text" name="page_blocks[__KEY__][items][__INDEX__][title]" value="" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 mb-1">Description</label>
                    <textarea name="page_blocks[__KEY__][items][__INDEX__][text]" rows="2" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 mb-1">Bullet Points (one per line, optional)</label>
                    <textarea name="page_blocks[__KEY__][items][__INDEX__][bullets]" rows="2" placeholder="One item per line" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 mb-1">Tag Pills (comma-separated)</label>
                    <input type="text" name="page_blocks[__KEY__][items][__INDEX__][tags]" value="" placeholder="Keyhole Access, Faster Recovery" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>
        </template>

        <template id="page-block-step-template">
            <div class="page-block-item bg-slate-50 p-3 rounded-xl border border-slate-200 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-500">Step</span>
                    <button type="button" onclick="pageBlockRemoveItem(this)" class="text-[10px] text-red-500 font-bold hover:underline"><i class="fas fa-trash text-[9px]"></i> Remove</button>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 mb-1">Title</label>
                    <input type="text" name="page_blocks[__KEY__][items][__INDEX__][title]" value="" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 mb-1">Description</label>
                    <textarea name="page_blocks[__KEY__][items][__INDEX__][text]" rows="2" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 mb-1">Bullet Points (one per line, optional)</label>
                    <textarea name="page_blocks[__KEY__][items][__INDEX__][bullets]" rows="2" placeholder="One item per line" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>
            </div>
        </template>

        <script>
        function pageBlockAddItem(button) {
            var block = button.closest('.page-block-card');
            if (!block) return;
            var key = block.getAttribute('data-block-key');
            var type = block.getAttribute('data-block-type');
            var container = block.querySelector('.page-block-items');
            var template = document.getElementById(type === 'steps' ? 'page-block-step-template' : 'page-block-card-template');
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
