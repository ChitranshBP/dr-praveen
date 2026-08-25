<?php
$pageTitle = 'Testimonials & Reviews';
require_once __DIR__ . '/includes/header.php';

$testimonials = CMS_DB::get('testimonials', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';

    if ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        $testimonials = array_values(array_filter($testimonials, function($t) use ($id) { return ($t['id'] ?? '') !== $id; }));
        CMS_DB::set('testimonials', $testimonials);
        cms_set_flash('success', 'Testimonial deleted.');
        header('Location: testimonials.php');
        exit;
    }

    if ($action === 'save') {
        $id = $_POST['id'] ?? '';
        $name = trim($_POST['name'] ?? '');
        $role = trim($_POST['role'] ?? 'Patient');
        $rating = intval($_POST['rating'] ?? 5);
        $condition = trim($_POST['condition'] ?? '');
        $message = trim($_POST['message'] ?? '');
        $video_id = trim($_POST['video_id'] ?? '');
        $featured = isset($_POST['featured']);

        if ($id) {
            foreach ($testimonials as &$t) {
                if ($t['id'] === $id) {
                    $t['name'] = $name;
                    $t['role'] = $role;
                    $t['rating'] = $rating;
                    $t['condition'] = $condition;
                    $t['message'] = $message;
                    $t['video_id'] = $video_id;
                    $t['featured'] = $featured;
                    break;
                }
            }
        } else {
            $testimonials[] = [
                'id' => CMS_DB::generateId(),
                'name' => $name,
                'role' => $role,
                'rating' => $rating,
                'condition' => $condition,
                'message' => $message,
                'video_id' => $video_id,
                'featured' => $featured,
                'date' => date('Y-m-d')
            ];
        }

        CMS_DB::set('testimonials', $testimonials);
        cms_set_flash('success', 'Testimonial saved.');
        header('Location: testimonials.php');
        exit;
    }
}

$editT = null;
if (isset($_GET['edit'])) {
    foreach ($testimonials as $t) {
        if ($t['id'] === $_GET['edit']) {
            $editT = $t;
            break;
        }
    }
}
?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 max-w-7xl">
    <div class="lg:col-span-7 space-y-4">
        <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Patient Testimonials (<?php echo count($testimonials); ?>)</h2>

        <div class="space-y-3">
            <?php foreach ($testimonials as $t): ?>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-2">
                        <span class="font-bold text-xs text-slate-900"><?php echo htmlspecialchars($t['name']); ?></span>
                        <span class="text-[11px] text-slate-400">&bull; <?php echo htmlspecialchars($t['role']); ?></span>
                    </div>
                    <div class="text-amber-400 text-xs">
                        <?php for($i=0; $i<$t['rating']; $i++): ?><i class="fas fa-star"></i><?php endfor; ?>
                    </div>
                </div>
                <p class="text-xs text-slate-600 line-clamp-3 mb-3"><?php echo htmlspecialchars($t['message']); ?></p>
                <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                    <span class="text-[11px] font-semibold text-brand-blue"><?php echo htmlspecialchars($t['condition'] ?: 'General Care'); ?></span>
                    <div class="flex items-center space-x-3">
                        <a href="testimonials.php?edit=<?php echo urlencode($t['id']); ?>" class="text-brand-blue font-bold hover:underline">Edit</a>
                        <form method="POST" action="" onsubmit="return confirm('Delete review?');" class="inline">
                            <?php echo cms_csrf_field(); ?>
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($t['id']); ?>">
                            <button type="submit" class="text-red-500 font-bold hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="lg:col-span-5">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm sticky top-6">
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 mb-4">
                <?php echo $editT ? 'Edit Review' : 'Add Testimonial'; ?>
            </h2>

            <form method="POST" action="" class="space-y-4">
                <?php echo cms_csrf_field(); ?>
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($editT['id'] ?? ''); ?>">

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Patient Name</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($editT['name'] ?? ''); ?>" required class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Role / Relation</label>
                        <input type="text" name="role" value="<?php echo htmlspecialchars($editT['role'] ?? 'Patient'); ?>" placeholder="Patient / Son" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Condition Treated</label>
                        <input type="text" name="condition" value="<?php echo htmlspecialchars($editT['condition'] ?? ''); ?>" placeholder="e.g. Stroke, Epilepsy" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Review Message</label>
                    <textarea name="message" rows="4" required class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($editT['message'] ?? ''); ?></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">YouTube Video ID (Optional)</label>
                    <input type="text" name="video_id" value="<?php echo htmlspecialchars($editT['video_id'] ?? ''); ?>" placeholder="e.g. kEwXD0aT_rQ" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="featured" name="featured" <?php echo !empty($editT['featured']) ? 'checked' : ''; ?> class="w-4 h-4 text-blue-600 rounded">
                    <label for="featured" class="text-xs font-bold text-slate-700">Feature on Homepage</label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">Save Review</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
