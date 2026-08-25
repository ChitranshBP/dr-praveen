<?php
$pageTitle = 'Hero Banners & Slider';
require_once __DIR__ . '/includes/header.php';

$banners = CMS_DB::get('banners', []);

// Handle Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';

    if ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        $banners = array_values(array_filter($banners, fn($b) => $b['id'] !== $id));
        CMS_DB::set('banners', $banners);
        cms_set_flash('success', 'Banner slide deleted.');
        header('Location: banners.php');
        exit;
    }

    if ($action === 'save') {
        $id = $_POST['id'] ?? '';
        $title = trim($_POST['title'] ?? '');
        $subtitle = trim($_POST['subtitle'] ?? '');
        $cta_text = trim($_POST['cta_text'] ?? '');
        $cta_link = trim($_POST['cta_link'] ?? '');
        $alt_text = trim($_POST['alt_text'] ?? '');
        $is_active = isset($_POST['is_active']);

        // Upload desktop banner
        $desktopPath = $_POST['existing_desktop'] ?? '';
        $desktopUpload = cms_handle_upload('desktop_image', 'banner');
        if ($desktopUpload && !isset($desktopUpload['error'])) {
            $desktopPath = $desktopUpload['path'];
        }

        // Upload mobile banner
        $mobilePath = $_POST['existing_mobile'] ?? '';
        $mobileUpload = cms_handle_upload('mobile_image', 'banner');
        if ($mobileUpload && !isset($mobileUpload['error'])) {
            $mobilePath = $mobileUpload['path'];
        }

        if ($id) {
            foreach ($banners as &$b) {
                if ($b['id'] === $id) {
                    $b['title'] = $title;
                    $b['subtitle'] = $subtitle;
                    $b['cta_text'] = $cta_text;
                    $b['cta_link'] = $cta_link;
                    $b['alt_text'] = $alt_text;
                    $b['is_active'] = $is_active;
                    if ($desktopPath) $b['desktop_image'] = $desktopPath;
                    if ($mobilePath) $b['mobile_image'] = $mobilePath;
                    break;
                }
            }
        } else {
            $banners[] = [
                'id' => 'banner-' . uniqid(),
                'title' => $title,
                'subtitle' => $subtitle,
                'cta_text' => $cta_text,
                'cta_link' => $cta_link,
                'alt_text' => $alt_text,
                'desktop_image' => $desktopPath ?: 'assets/banner/banner-new/DrPraveen_WebBanner_New(1440X500).png',
                'mobile_image' => $mobilePath ?: 'assets/mobile-banner/1.png',
                'is_active' => $is_active,
                'order' => count($banners) + 1
            ];
        }

        CMS_DB::set('banners', $banners);
        cms_set_flash('success', 'Banner saved successfully.');
        header('Location: banners.php');
        exit;
    }
}

$editBanner = null;
if (isset($_GET['edit'])) {
    foreach ($banners as $b) {
        if ($b['id'] === $_GET['edit']) {
            $editBanner = $b;
            break;
        }
    }
}
?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 max-w-7xl">
    <!-- List of Banners -->
    <div class="lg:col-span-7 space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Active Homepage Slides (<?php echo count($banners); ?>)</h2>
            <a href="banners.php" class="text-xs text-brand-blue font-bold hover:underline">+ Add New Slide</a>
        </div>

        <div class="space-y-3">
            <?php foreach ($banners as $index => $b): ?>
            <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-start space-x-4">
                <div class="w-32 h-16 rounded-xl bg-slate-100 overflow-hidden border border-slate-200 flex-shrink-0">
                    <img src="../<?php echo htmlspecialchars($b['desktop_image']); ?>" class="w-full h-full object-cover" alt="Banner">
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold <?php echo !empty($b['is_active']) ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500'; ?>">
                            <?php echo !empty($b['is_active']) ? 'Active' : 'Disabled'; ?>
                        </span>
                        <h3 class="text-xs font-bold text-slate-900 truncate"><?php echo htmlspecialchars($b['title'] ?: 'Slide #' . ($index+1)); ?></h3>
                    </div>
                    <p class="text-[11px] text-slate-500 truncate mt-1"><?php echo htmlspecialchars($b['subtitle'] ?? ''); ?></p>
                    <div class="flex items-center space-x-3 mt-2 text-xs">
                        <a href="banners.php?edit=<?php echo urlencode($b['id']); ?>" class="text-brand-blue font-semibold hover:underline">Edit</a>
                        <form method="POST" action="" onsubmit="return confirm('Are you sure you want to delete this banner?');" class="inline">
                            <?php echo cms_csrf_field(); ?>
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($b['id']); ?>">
                            <button type="submit" class="text-red-500 font-semibold hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Form Editor -->
    <div class="lg:col-span-5">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm sticky top-6">
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 mb-4">
                <?php echo $editBanner ? 'Edit Banner Slide' : 'Add New Slide'; ?>
            </h2>

            <form method="POST" action="" enctype="multipart/form-data" class="space-y-4">
                <?php echo cms_csrf_field(); ?>
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($editBanner['id'] ?? ''); ?>">
                <input type="hidden" name="existing_desktop" value="<?php echo htmlspecialchars($editBanner['desktop_image'] ?? ''); ?>">
                <input type="hidden" name="existing_mobile" value="<?php echo htmlspecialchars($editBanner['mobile_image'] ?? ''); ?>">

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Headline (Title)</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($editBanner['title'] ?? ''); ?>" required class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Subtitle / Supporting Text</label>
                    <input type="text" name="subtitle" value="<?php echo htmlspecialchars($editBanner['subtitle'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Desktop Banner Image (1440x500 / 2160x750)</label>
                    <input type="file" name="desktop_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Mobile Banner Image (400x506)</label>
                    <input type="file" name="mobile_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">CTA Button Text</label>
                        <input type="text" name="cta_text" value="<?php echo htmlspecialchars($editBanner['cta_text'] ?? 'Book Appointment'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">CTA Link</label>
                        <input type="text" name="cta_link" value="<?php echo htmlspecialchars($editBanner['cta_link'] ?? 'contact-us-top-neurologist-delhi-ncr'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div class="flex items-center space-x-2 pt-2">
                    <input type="checkbox" id="is_active" name="is_active" <?php echo !isset($editBanner) || !empty($editBanner['is_active']) ? 'checked' : ''; ?> class="w-4 h-4 text-blue-600 rounded">
                    <label for="is_active" class="text-xs font-bold text-slate-700">Display this slide on live site</label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">
                        <?php echo $editBanner ? 'Update Slide' : 'Create Slide'; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
