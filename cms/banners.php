<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$banners = CMS_DB::get('banners', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';

    if ($action === 'create' || $action === 'edit') {
        $id = $_POST['banner_id'] ?? '';
        $title = trim($_POST['title'] ?? '');
        $subtitle = trim($_POST['subtitle'] ?? '');
        $ctaText = trim($_POST['cta_text'] ?? '');
        $ctaLink = trim($_POST['cta_link'] ?? '');
        $altText = trim($_POST['alt_text'] ?? '');
        $isActive = isset($_POST['is_active']);

        $desktopImg = $_POST['existing_desktop_image'] ?? '';
        $deskUpload = cms_handle_upload('desktop_image', 'banner');
        if ($deskUpload && !isset($deskUpload['error'])) {
            $desktopImg = $deskUpload['path'];
        }

        $mobileImg = $_POST['existing_mobile_image'] ?? '';
        $mobUpload = cms_handle_upload('mobile_image', 'banner');
        if ($mobUpload && !isset($mobUpload['error'])) {
            $mobileImg = $mobUpload['path'];
        }

        if ($action === 'create') {
            $newBanner = [
                'id' => CMS_DB::generateId(),
                'title' => $title,
                'subtitle' => $subtitle,
                'cta_text' => $ctaText,
                'cta_link' => $ctaLink,
                'alt_text' => $altText,
                'desktop_image' => $desktopImg ?: 'assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png',
                'mobile_image' => $mobileImg ?: 'assets/mobile-banner/1.png',
                'is_active' => $isActive,
                'order' => count($banners) + 1
            ];
            $banners[] = $newBanner;
            cms_set_flash('success', 'Banner created successfully.');
        } else {
            foreach ($banners as &$b) {
                if ($b['id'] === $id) {
                    $b['title'] = $title;
                    $b['subtitle'] = $subtitle;
                    $b['cta_text'] = $ctaText;
                    $b['cta_link'] = $ctaLink;
                    $b['alt_text'] = $altText;
                    $b['is_active'] = $isActive;
                    if ($desktopImg) $b['desktop_image'] = $desktopImg;
                    if ($mobileImg) $b['mobile_image'] = $mobileImg;
                    break;
                }
            }
            cms_set_flash('success', 'Banner updated successfully.');
        }

        CMS_DB::set('banners', $banners);
        header('Location: banners.php');
        exit;
    } elseif ($action === 'delete') {
        $id = $_POST['banner_id'] ?? '';
        $banners = array_values(array_filter($banners, function($b) use ($id) { return ($b['id'] ?? '') !== $id; }));
        CMS_DB::set('banners', $banners);
        cms_set_flash('success', 'Banner deleted.');
        header('Location: banners.php');
        exit;
    }
}

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
            <p class="text-xs text-slate-500 mt-0.5">Manage and reorder banners displayed at the top of your homepage.</p>
        </div>
        <button onclick="document.getElementById('bannerFormModal').classList.toggle('hidden');" class="px-4 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all flex items-center space-x-1.5 self-start sm:self-auto">
            <i class="fas fa-plus"></i>
            <span>Add New Banner</span>
        </button>
    </div>

    <!-- Active Banners List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <?php foreach ($banners as $index => $b): ?>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <!-- Image Preview -->
                <div class="relative w-full aspect-[1440/500] bg-slate-100 overflow-hidden border-b border-slate-100">
                    <img src="../<?php echo htmlspecialchars($b['desktop_image']); ?>" class="w-full h-full object-cover" alt="Desktop Banner">
                    <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-[10px] font-bold shadow-sm <?php echo !empty($b['is_active']) ? 'bg-emerald-500 text-white' : 'bg-slate-800 text-slate-200'; ?>">
                        <?php echo !empty($b['is_active']) ? 'Active' : 'Disabled'; ?>
                    </span>
                </div>

                <div class="p-4 space-y-2">
                    <div class="flex items-start justify-between">
                        <h3 class="text-xs font-bold text-slate-900 leading-tight"><?php echo htmlspecialchars($b['title'] ?: 'Hero Banner Slide #' . ($index + 1)); ?></h3>
                        <span class="text-[10px] text-slate-400 font-mono">Slide #<?php echo $index + 1; ?></span>
                    </div>
                </div>
            </div>

            <div class="p-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="banners.php?edit=<?php echo urlencode($b['id']); ?>" class="px-3 py-1.5 bg-brand-blue hover:bg-blue-700 text-white font-bold rounded-lg transition-colors flex items-center space-x-1">
                    <i class="fas fa-edit text-[10px]"></i>
                    <span>Edit Artwork</span>
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
                <input type="hidden" name="existing_desktop_image" value="<?php echo htmlspecialchars($editBanner['desktop_image'] ?? ''); ?>">
                <input type="hidden" name="existing_mobile_image" value="<?php echo htmlspecialchars($editBanner['mobile_image'] ?? ''); ?>">

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Banner Title / Name</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($editBanner['title'] ?? ''); ?>" placeholder="e.g. Transforming Brain & Spine Care" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Desktop Banner Image (1440x500 WebP/PNG/JPG)</label>
                    <input type="file" name="desktop_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Mobile Banner Image (Optional)</label>
                    <input type="file" name="mobile_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                </div>

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
