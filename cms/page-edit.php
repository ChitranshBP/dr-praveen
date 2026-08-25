<?php
$pageTitle = 'Edit Page Content';
require_once __DIR__ . '/includes/header.php';

$slug = $_GET['slug'] ?? 'functional-neurosurgery';
$pagesCatalog = CMS_DB::get('pages_catalog', []);

$pageMeta = null;
foreach ($pagesCatalog as $p) {
    if ($p['slug'] === $slug) {
        $pageMeta = $p;
        break;
    }
}

$pageDataFile = DATA_DIR . '/pages/' . preg_replace('/[^a-zA-Z0-9_-]/', '', $slug) . '.json';
$pageData = [];
if (file_exists($pageDataFile)) {
    $pageData = json_decode(file_get_contents($pageDataFile), true) ?: [];
}
if (empty($pageData) && $pageMeta) {
    $pageData = $pageMeta;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    $pageData['hero_badge'] = trim($_POST['hero_badge'] ?? '');
    $pageData['hero_title'] = trim($_POST['hero_title'] ?? '');
    $pageData['hero_desc'] = trim($_POST['hero_desc'] ?? '');
    
    $pageData['section1_badge'] = trim($_POST['section1_badge'] ?? '');
    $pageData['section1_title'] = trim($_POST['section1_title'] ?? '');
    $pageData['section1_text'] = trim($_POST['section1_text'] ?? '');

    // Handle Hero Banner image upload
    $heroUpload = cms_handle_upload('hero_bg_file', 'breadcrumbs');
    if ($heroUpload && !isset($heroUpload['error'])) {
        $pageData['hero_bg'] = $heroUpload['path'];
    }

    // Handle Section Image upload
    $secUpload = cms_handle_upload('section1_img_file', 'services');
    if ($secUpload && !isset($secUpload['error'])) {
        $pageData['section1_image'] = $secUpload['path'];
    }

    file_put_contents($pageDataFile, json_encode($pageData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), LOCK_EX);

    cms_set_flash('success', 'Page content and images saved successfully!');
    header('Location: page-edit.php?slug=' . urlencode($slug));
    exit;
}
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
            <!-- Quick Page Switcher -->
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

        <!-- Hero Section Box -->
        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-4">
            <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center">
                <i class="fas fa-heading text-brand-blue mr-2"></i> Hero Banner & Header Section
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Top Badge Text</label>
                    <input type="text" name="hero_badge" value="<?php echo htmlspecialchars($pageData['hero_badge'] ?? ''); ?>" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
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

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Hero Background Image</label>
                <?php if (!empty($pageData['hero_bg'])): ?>
                <div class="flex items-center space-x-3 mb-2">
                    <img src="../<?php echo htmlspecialchars($pageData['hero_bg']); ?>" class="w-24 h-12 object-cover rounded-lg border border-slate-200" alt="Hero bg">
                    <span class="text-[11px] text-slate-400 font-mono"><?php echo htmlspecialchars($pageData['hero_bg']); ?></span>
                </div>
                <?php endif; ?>
                <input type="file" name="hero_bg_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
        </div>

        <!-- Main Section Content Box -->
        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-4">
            <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center">
                <i class="fas fa-align-left text-brand-blue mr-2"></i> Main Body Section Content
            </h3>

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
                <label class="block text-xs font-bold text-slate-700 mb-1">Section Content Paragraphs (Supports multiple paragraphs)</label>
                <textarea name="section1_text" rows="6" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($pageData['section1_text'] ?? ''); ?></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Section Feature Photo</label>
                <?php if (!empty($pageData['section1_image'])): ?>
                <div class="w-32 aspect-[4/3] rounded-lg overflow-hidden border border-slate-200 mb-2">
                    <img src="../<?php echo htmlspecialchars($pageData['section1_image']); ?>" class="w-full h-full object-cover" alt="Section Image">
                </div>
                <?php endif; ?>
                <input type="file" name="section1_img_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
            <a href="pages.php" class="text-xs text-slate-500 font-semibold hover:underline">&larr; Back to All Pages</a>
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center space-x-1.5">
                <i class="fas fa-save"></i>
                <span>Save Page Content</span>
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
