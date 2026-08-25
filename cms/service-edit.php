<?php
$pageTitle = 'Edit Condition Card';
require_once __DIR__ . '/includes/header.php';

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
    $features_raw = trim($_POST['features'] ?? '');
    $features = array_filter(array_map('trim', explode("\n", $features_raw)));
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
            'is_active' => $is_active,
            'order' => count($services) + 1
        ];
    }

    CMS_DB::set('services', $services);
    cms_set_flash('success', 'Condition card content and image updated successfully.');
    header('Location: services.php');
    exit;
}
?>

<div class="max-w-3xl bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
        <div>
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider"><?php echo $service ? 'Edit Card Content' : 'Add Condition Card'; ?></h2>
            <p class="text-xs text-slate-500 mt-0.5">Customize the card title, photo, summary, and bullet procedures.</p>
        </div>
        <a href="services.php" class="text-xs text-slate-500 font-semibold hover:underline">&larr; Back to Cards</a>
    </div>

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-5">
        <?php echo cms_csrf_field(); ?>
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($service['image'] ?? ''); ?>">

        <!-- Current Image Preview -->
        <?php if (!empty($service['image'])): ?>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Current Card Image</label>
            <div class="w-48 aspect-[4/3] rounded-xl overflow-hidden border border-slate-200 bg-slate-100">
                <img src="../<?php echo htmlspecialchars($service['image']); ?>" class="w-full h-full object-cover" alt="Card Image">
            </div>
        </div>
        <?php endif; ?>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Upload New Image (Replaces current photo)</label>
            <input type="file" name="service_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Card Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($service['title'] ?? ''); ?>" required placeholder="e.g. Stroke & Neurocritical Care Unit" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Short Description</label>
            <textarea name="short_description" rows="2" placeholder="e.g. Advanced Stroke Care in Gurgaon." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($service['short_description'] ?? ''); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Key Procedures / "Read More" Dropdown Items (1 per line)</label>
            <textarea name="features" rows="5" placeholder="Thrombolytic therapy&#10;Mechanical thrombectomy&#10;24/7 stroke protocol" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars(implode("\n", $service['features'] ?? [])); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Bottom Highlight Bullet (Shown at card bottom)</label>
            <input type="text" name="bullet" value="<?php echo htmlspecialchars($service['bullet'] ?? ''); ?>" placeholder="e.g. Video EEG monitoring" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
