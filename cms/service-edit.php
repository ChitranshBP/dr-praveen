<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$services = CMS_DB::get('services', []);
$id = $_GET['id'] ?? '';
$service = null;

if ($id) {
    foreach ($services as $s) {
        if ($s['id'] === $id) {
            $service = $s;
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    $title = trim($_POST['title'] ?? '');
    $short_desc = trim($_POST['short_description'] ?? '');
    $bullet = trim($_POST['bullet'] ?? '');
    $link = trim($_POST['link'] ?? '');
    $imageAlt = trim($_POST['image_alt'] ?? '');
    $features_raw = trim($_POST['features'] ?? '');
    $features = cms_parse_multiline_items($features_raw);
    $is_active = isset($_POST['is_active']);

    $imagePath = $_POST['existing_image'] ?? '';
    $imgUpload = cms_handle_upload('service_image', 'services');
    if ($imgUpload && !isset($imgUpload['error'])) {
        $imagePath = $imgUpload['path'];
    }

    if ($id && $service) {
        foreach ($services as &$s) {
            if ($s['id'] === $id) {
                $s['title'] = $title;
                $s['short_description'] = $short_desc;
                $s['bullet'] = $bullet;
                $s['link'] = $link;
                $s['features'] = $features;
                $s['image_alt'] = $imageAlt ?: $title;
                $s['is_active'] = $is_active;
                if ($imagePath) $s['image'] = $imagePath;
                break;
            }
        }
    } else {
        $services[] = [
            'id' => CMS_DB::generateId(),
            'title' => $title,
            'short_description' => $short_desc,
            'bullet' => $bullet,
            'link' => $link,
            'features' => $features,
            'image' => $imagePath ?: 'assets/services/stroke-care.png',
            'image_alt' => $imageAlt ?: $title,
            'is_active' => $is_active,
            'order' => count($services) + 1
        ];
    }

    CMS_DB::set('services', $services);
    cms_set_flash('success', 'Condition card content and image updated successfully.');
    header('Location: services.php');
    exit;
}

$pageTitle = 'Edit Condition Card';
require_once __DIR__ . '/includes/header.php';
?>

<div class="max-w-3xl bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
        <div>
            <h2 class="text-lg font-bold text-slate-800"><?php echo $id ? 'Edit Brain & Spine Condition Card' : 'Add New Condition Card'; ?></h2>
            <p class="text-xs text-slate-500">Edit title, description, features, image and links visible on the services section.</p>
        </div>
        <a href="services.php" class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Back</a>
    </div>

    <form method="POST" enctype="multipart/form-data" class="space-y-5">
        <?php echo cms_csrf_field(); ?>
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($service['image'] ?? ''); ?>">

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Service Title / Brain Condition</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($service['title'] ?? ''); ?>" required placeholder="e.g. Stroke & Neurocritical Care Unit" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Short Description</label>
            <textarea name="short_description" rows="3" placeholder="e.g. Advanced Stroke Care in Gurgaon." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($service['short_description'] ?? ''); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Key Procedures / Key Highlights (1 per line)</label>
            <textarea name="features" rows="4" placeholder="Thrombolytic therapy&#10;Mechanical thrombectomy&#10;24/7 stroke protocol" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php 
                $feats = $service['features'] ?? [];
                if (is_array($feats)) {
                    foreach ($feats as $f) {
                        echo htmlspecialchars($f) . "\n";
                    }
                } else {
                    echo htmlspecialchars($feats);
                }
            ?></textarea>
        </div>

        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 space-y-3">
            <div class="flex items-center justify-between">
                <label class="block text-xs font-bold text-slate-800">
                    <i class="fas fa-image text-brand-blue mr-1"></i> Condition Card Photo
                </label>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Recommended: 800 × 600 px</span>
            </div>
            <p class="text-[10px] text-slate-500">Standard 4:3 landscape photo. Supported: WebP, PNG, JPG (Max 4MB).</p>
            <?php if (!empty($service['image'])): ?>
            <div class="flex items-center space-x-3 py-1">
                <div class="w-36 aspect-[4/3] rounded-xl overflow-hidden border border-slate-200 bg-slate-100">
                    <img src="../<?php echo htmlspecialchars($service['image']); ?>" class="w-full h-full object-cover" alt="Card preview">
                </div>
                <span class="text-[10px] text-slate-400 font-mono"><?php echo htmlspecialchars($service['image']); ?></span>
            </div>
            <?php endif; ?>
            <input type="file" name="service_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

            <div class="pt-2 border-t border-slate-200/60">
                <label class="block text-xs font-bold text-slate-700 mb-1">Card Image Alt Tag (SEO & Accessibility)</label>
                <input type="text" name="image_alt" value="<?php echo htmlspecialchars($service['image_alt'] ?? ''); ?>" placeholder="e.g. <?php echo htmlspecialchars($service['title'] ?? 'Treatment'); ?> - Dr. Praveen Gupta" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Card Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($service['title'] ?? ''); ?>" required placeholder="e.g. Stroke & Neurocritical Care Unit" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Short Description</label>
            <textarea name="short_description" rows="3" placeholder="e.g. Advanced Stroke Care in Gurgaon." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($service['short_description'] ?? ''); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Key Procedures / "Read More" Dropdown Items (1 per line)</label>
            <textarea name="features" rows="4" placeholder="Thrombolytic therapy&#10;Mechanical thrombectomy&#10;24/7 stroke protocol" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars(implode("\n", $service['features'] ?? [])); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Bottom Highlight Bullet (Shown at card bottom)</label>
            <input type="text" name="bullet" value="<?php echo htmlspecialchars($service['bullet'] ?? ''); ?>" placeholder="e.g. Video EEG monitoring" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Card Link (page slug, e.g. epilepsy)</label>
            <input type="text" name="link" value="<?php echo htmlspecialchars($service['link'] ?? ''); ?>" placeholder="Leave blank to auto-link by title" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <p class="text-[11px] text-slate-400 mt-1">Used as the card's destination page. Example values: stroke, epilepsy, brain-tumor-surgery, spine-surgery.</p>
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" id="is_active" name="is_active" <?php echo !isset($service) || !empty($service['is_active']) ? 'checked' : ''; ?> class="w-4 h-4 text-blue-600 rounded">
            <label for="is_active" class="text-xs font-bold text-slate-700">Show this card on the website</label>
        </div>

        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">Save Card Changes</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
