<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/fields.php';

cms_require_auth();

$banners = CMS_DB::get('banners', []);

// Ensure all banners have integer orders and default alt tags
foreach ($banners as $idx => &$b) {
    if (!isset($b['order']) || $b['order'] === '') {
        $b['order'] = $idx + 1;
    } else {
        $b['order'] = (int)$b['order'];
    }
}
unset($b);

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';

    if ($action === 'reorder') {
        $banners = cms_apply_reorder($banners, is_array($_POST['ids'] ?? null) ? $_POST['ids'] : []);
        $ok = CMS_DB::set('banners', $banners);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) { header('Content-Type: application/json'); echo json_encode(['success' => $ok]); exit; }
        cms_set_flash($ok ? 'success' : 'error', $ok ? 'Banner order saved.' : 'Could not save the order.');
        header('Location: banners.php');
        exit;
    }

    if ($action === 'move_up' || $action === 'move_down') {
        $id = $_POST['banner_id'] ?? '';
        // Sort first
        usort($banners, function($a, $b) {
            return ($a['order'] ?? 99) <=> ($b['order'] ?? 99);
        });

        $targetIndex = -1;
        foreach ($banners as $i => $b) {
            if (($b['id'] ?? '') === $id) {
                $targetIndex = $i;
                break;
            }
        }

        if ($targetIndex !== -1) {
            if ($action === 'move_up' && $targetIndex > 0) {
                $prevIndex = $targetIndex - 1;
                $tempOrder = $banners[$targetIndex]['order'];
                $banners[$targetIndex]['order'] = $banners[$prevIndex]['order'];
                $banners[$prevIndex]['order'] = $tempOrder;
                // If equal orders, assign distinct
                if ($banners[$targetIndex]['order'] === $banners[$prevIndex]['order']) {
                    $banners[$targetIndex]['order'] = $targetIndex;
                    $banners[$prevIndex]['order'] = $targetIndex + 1;
                }
                cms_set_flash('success', 'Banner display order updated.');
            } elseif ($action === 'move_down' && $targetIndex < count($banners) - 1) {
                $nextIndex = $targetIndex + 1;
                $tempOrder = $banners[$targetIndex]['order'];
                $banners[$targetIndex]['order'] = $banners[$nextIndex]['order'];
                $banners[$nextIndex]['order'] = $tempOrder;
                if ($banners[$targetIndex]['order'] === $banners[$nextIndex]['order']) {
                    $banners[$targetIndex]['order'] = $nextIndex + 1;
                    $banners[$nextIndex]['order'] = $nextIndex;
                }
                cms_set_flash('success', 'Banner display order updated.');
            }
            // Re-normalize orders 1..N
            usort($banners, function($a, $b) {
                return ($a['order'] ?? 99) <=> ($b['order'] ?? 99);
            });
            foreach ($banners as $k => &$b) {
                $b['order'] = $k + 1;
            }
            unset($b);
            CMS_DB::set('banners', $banners);
        }
        header('Location: banners.php');
        exit;
    }

    if ($action === 'create' || $action === 'edit') {
        $id = $_POST['banner_id'] ?? '';
        $title = trim($_POST['title'] ?? '');
        $subtitle = trim($_POST['subtitle'] ?? '');
        $ctaText = trim($_POST['cta_text'] ?? '');
        $ctaLink = trim($_POST['cta_link'] ?? '');
        $altText = trim($_POST['alt_text'] ?? '');
        $order = (int)($_POST['order'] ?? (count($banners) + 1));
        $isActive = isset($_POST['is_active']);

        $current = null;
        foreach ($banners as $cb) {
            if (($cb['id'] ?? '') === $id) { $current = $cb; break; }
        }
        $uploadErrors = [];
        $deskRes = cms_image_field_value('desktop_image', 'banner', $current['desktop_image'] ?? '');
        $mobRes = cms_image_field_value('mobile_image', 'banner', $current['mobile_image'] ?? '');
        foreach ([$deskRes, $mobRes] as $r) {
            if ($r['error'] !== '') $uploadErrors[] = $r['error'];
        }
        $desktopImg = $deskRes['path'];
        $mobileImg = $mobRes['path'];

        if ($action === 'create') {
            $newBanner = [
                'id' => CMS_DB::generateId(),
                'title' => $title,
                'subtitle' => $subtitle,
                'cta_text' => $ctaText,
                'cta_link' => $ctaLink,
                'alt_text' => $altText ?: $title,
                'desktop_image' => $desktopImg ?: 'assets/banner/dr-praveen-banner-desktop/stroke-care.jpeg',
                'mobile_image' => $mobileImg ?: 'assets/banner/dr-praveen-banner-mobile/stroke-care-mobile.jpeg',
                'is_active' => $isActive,
                'order' => $order > 0 ? $order : (count($banners) + 1)
            ];
            $banners[] = $newBanner;
            cms_set_flash('success', 'Banner created successfully.');
        } else {
            foreach ($banners as &$b) {
                if ($b['id'] === $id) {
                    $b['title'] = $title;
                    // Only overwrite fields the form actually posted so a save
                    // never blanks data the modal does not show.
                    if (array_key_exists('subtitle', $_POST)) $b['subtitle'] = $subtitle;
                    if (array_key_exists('cta_text', $_POST)) $b['cta_text'] = $ctaText;
                    if (array_key_exists('cta_link', $_POST)) $b['cta_link'] = $ctaLink;
                    $b['alt_text'] = $altText ?: $title;
                    $b['order'] = $order;
                    $b['is_active'] = $isActive;
                    if ($desktopImg) $b['desktop_image'] = $desktopImg;
                    if ($mobileImg) $b['mobile_image'] = $mobileImg;
                    break;
                }
            }
            cms_set_flash('success', 'Banner updated successfully.');
        }
        if (!empty($uploadErrors)) {
            cms_set_flash('error', 'Banner saved, but an image upload failed: ' . implode(' ', $uploadErrors));
        }

        // Re-sort
        usort($banners, function($a, $b) {
            return ($a['order'] ?? 99) <=> ($b['order'] ?? 99);
        });

        CMS_DB::set('banners', $banners);
        header('Location: banners.php');
        exit;
    } elseif ($action === 'delete') {
        $id = $_POST['banner_id'] ?? '';
        $banners = array_values(array_filter($banners, function($b) use ($id) { return ($b['id'] ?? '') !== $id; }));
        // Re-normalize orders
        foreach ($banners as $k => &$b) {
            $b['order'] = $k + 1;
        }
        unset($b);
        CMS_DB::set('banners', $banners);
        cms_set_flash('success', 'Banner deleted.');
        header('Location: banners.php');
        exit;
    }
}

// Sort banners before display
usort($banners, function($a, $b) {
    return ($a['order'] ?? 99) <=> ($b['order'] ?? 99);
});

$pageTitle = 'Hero Banners';
require_once __DIR__ . '/includes/header.php';

$editId = $_GET['edit'] ?? '';
$editBanner = null;
if ($editId) {
    foreach ($banners as $b) {
        if ($b['id'] === $editId) {
            $editBanner = $b;
            break;
        }
    }
}
?>

<div class="space-y-6 max-w-6xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-200">
        <div>
            <h2 class="text-base font-bold text-slate-900">Hero Slider Banners</h2>
            <p class="text-xs text-slate-500 mt-0.5">Manage, reorder, and update banners displayed at the top of your homepage. Drag a slide by its <i class="fas fa-grip-vertical"></i> handle to change the order.</p>
        </div>
        <button onclick="document.getElementById('bannerFormModal').classList.toggle('hidden');" class="px-4 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all flex items-center space-x-1.5 self-start sm:self-auto">
            <i class="fas fa-plus"></i>
            <span>Add New Banner</span>
        </button>
    </div>

    <!-- Active Banners List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5" <?php echo cms_sortable_list_attrs('banners.php'); ?>>
        <?php foreach ($banners as $index => $b): ?>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow" data-id="<?php echo htmlspecialchars($b['id']); ?>">
            <div>
                <!-- Image Preview -->
                <div class="relative w-full aspect-[1440/500] bg-slate-100 overflow-hidden border-b border-slate-100">
                    <img src="../<?php echo htmlspecialchars($b['desktop_image']); ?>" class="w-full h-full object-cover" alt="<?php echo htmlspecialchars($b['alt_text'] ?? $b['title'] ?? 'Banner'); ?>">
                    <span class="drag-handle absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[11px] font-extrabold shadow-sm bg-slate-900/85 text-white backdrop-blur-sm flex items-center space-x-1.5 cursor-grab" title="Drag to reorder">
                        <i class="fas fa-grip-vertical text-cyan-400"></i>
                        <span>Slide #<span class="sort-position"><?php echo (int)($b['order'] ?? ($index + 1)); ?></span></span>
                    </span>
                    <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-[10px] font-bold shadow-sm <?php echo !empty($b['is_active']) ? 'bg-emerald-500 text-white' : 'bg-slate-800 text-slate-200'; ?>">
                        <?php echo !empty($b['is_active']) ? 'Active' : 'Disabled'; ?>
                    </span>
                </div>

                <div class="p-4 space-y-2">
                    <div class="flex items-start justify-between">
                        <h3 class="text-xs font-bold text-slate-900 leading-tight"><?php echo htmlspecialchars($b['title'] ?: 'Hero Banner Slide #' . ($index + 1)); ?></h3>
                        <span class="text-[10px] text-slate-400 font-mono">Slide #<?php echo $index + 1; ?></span>
                    </div>
                    <?php if (!empty($b['alt_text'])): ?>
                    <p class="text-[11px] text-slate-500 bg-slate-50 px-2.5 py-1.5 rounded-lg border border-slate-100">
                        <strong class="text-slate-700">Alt Tag:</strong> <?php echo htmlspecialchars($b['alt_text']); ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="p-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-[11px] text-slate-400 font-semibold"><i class="fas fa-mobile-alt mr-1"></i><?php echo !empty($b['mobile_image']) ? 'Mobile artwork set' : 'No mobile artwork'; ?></span>

                <div class="flex items-center space-x-2">
                    <a href="banners.php?edit=<?php echo urlencode($b['id']); ?>" class="px-3 py-1.5 bg-brand-blue hover:bg-blue-700 text-white font-bold rounded-lg transition-colors flex items-center space-x-1">
                        <i class="fas fa-edit text-[10px]"></i>
                        <span>Edit</span>
                    </a>
                    <form method="POST" action="" onsubmit="return confirm('Delete this banner slide?');">
                        <?php echo cms_csrf_field(); ?>
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="banner_id" value="<?php echo htmlspecialchars($b['id']); ?>">
                        <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 transition-colors">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Banner Edit Modal / Form -->
    <div id="bannerFormModal" class="<?php echo $editBanner ? '' : 'hidden'; ?> fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-xl w-full p-6 max-h-[90vh] overflow-y-auto shadow-2xl space-y-5">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900"><?php echo $editBanner ? 'Edit Banner Slide' : 'Add New Banner Slide'; ?></h3>
                <a href="banners.php" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></a>
            </div>

            <form method="POST" action="" enctype="multipart/form-data" class="space-y-4 text-xs">
                <?php echo cms_csrf_field(); ?>
                <input type="hidden" name="action" value="<?php echo $editBanner ? 'edit' : 'create'; ?>">
                <input type="hidden" name="banner_id" value="<?php echo htmlspecialchars($editBanner['id'] ?? ''); ?>">
                <input type="hidden" name="order" value="<?php echo htmlspecialchars($editBanner['order'] ?? (count($banners) + 1)); ?>">

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Banner Title / Name</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($editBanner['title'] ?? ''); ?>" placeholder="e.g. Transforming Brain & Spine Care" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <p class="text-[10px] text-slate-400 mt-1">Internal name for this slide (the artwork carries the visible headline). Reorder slides by dragging them in the list.</p>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Image Alt Tag (SEO & Accessibility)</label>
                    <input type="text" name="alt_text" value="<?php echo htmlspecialchars($editBanner['alt_text'] ?? ''); ?>" placeholder="e.g. Stroke Care Specialists - Dr. Praveen Gupta" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <p class="text-[10px] text-slate-400 mt-1">Brief descriptive text used by Google Image Search and screen readers.</p>
                </div>

                <?php cms_image_field('desktop_image', $editBanner['desktop_image'] ?? '', [
                    'label' => 'Desktop Banner Artwork', 'folder' => 'banner', 'size' => '1920 × 670 px (or 1440 × 500 px)',
                    'hint' => 'Wide landscape format (aspect ratio ~16:5). WebP, PNG or JPG (max 8MB).',
                    'preview_class' => 'w-40 h-14',
                ]); ?>
                <?php cms_image_field('mobile_image', $editBanner['mobile_image'] ?? '', [
                    'label' => 'Mobile Banner Artwork (Portrait)', 'folder' => 'banner', 'size' => '750 × 900 px (or 1080 × 1300 px)',
                    'hint' => 'Portrait format for phones (aspect ratio ~4:5 / 5:6). WebP, PNG or JPG (max 8MB).',
                    'preview_class' => 'w-16 h-20',
                ]); ?>

                <div class="flex items-center space-x-2 pt-2">
                    <input type="checkbox" id="is_active" name="is_active" <?php echo !isset($editBanner) || !empty($editBanner['is_active']) ? 'checked' : ''; ?> class="w-4 h-4 text-blue-600 rounded">
                    <label for="is_active" class="font-bold text-slate-700">Enable this banner on website</label>
                </div>

                <div class="flex items-center justify-end space-x-2 pt-4 border-t border-slate-100">
                    <a href="banners.php" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl">Cancel</a>
                    <button type="submit" class="px-5 py-2 bg-brand-blue hover:bg-blue-700 text-white font-bold rounded-xl shadow-sm">Save Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
