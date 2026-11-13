<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/fields.php';

cms_require_auth();

$doctors = CMS_DB::get('doctors', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';

    if ($action === 'reorder') {
        $doctors = cms_apply_reorder($doctors, is_array($_POST['ids'] ?? null) ? $_POST['ids'] : []);
        $ok = CMS_DB::set('doctors', $doctors);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) { header('Content-Type: application/json'); echo json_encode(['success' => $ok]); exit; }
        cms_set_flash($ok ? 'success' : 'error', $ok ? 'Team order saved.' : 'Could not save the order.');
        header('Location: doctors.php');
        exit;
    }

    if ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        $doctors = array_values(array_filter($doctors, function($d) use ($id) { return ($d['id'] ?? '') !== $id; }));
        CMS_DB::set('doctors', $doctors);
        cms_set_flash('success', 'Doctor removed from team.');
        header('Location: doctors.php');
        exit;
    }
}

$pageTitle = 'Doctor Profile & Team';
require_once __DIR__ . '/includes/header.php';
?>

<div class="space-y-6 max-w-6xl">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Medical Team & Associates (<?php echo count($doctors); ?>)</h2>
            <p class="text-xs text-slate-500 mt-0.5">The order here is the order on the Team page and the homepage team strip. Drag the <i class="fas fa-grip-vertical"></i> handle to reorder.</p>
        </div>
        <a href="doctor-edit.php" class="px-4 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all flex items-center space-x-1.5">
            <i class="fas fa-user-plus"></i>
            <span>Add Doctor</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" <?php echo cms_sortable_list_attrs('doctors.php'); ?>>
        <?php foreach ($doctors as $doc): ?>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between" data-id="<?php echo htmlspecialchars($doc['id'] ?? ''); ?>">
            <div class="flex items-start space-x-4">
                <span class="drag-handle cursor-grab text-slate-300 hover:text-slate-500 pt-5 -ml-2" title="Drag to reorder"><i class="fas fa-grip-vertical"></i></span>
                <div class="w-16 h-16 rounded-xl bg-slate-100 overflow-hidden border border-slate-200 flex-shrink-0">
                    <img src="../<?php echo htmlspecialchars($doc['image'] ?? 'assets/ggn-nuro-images/optimized/dr-praveen-gupta.webp'); ?>" class="w-full h-full object-cover" alt="<?php echo htmlspecialchars($doc['name']); ?>">
                </div>
                <div class="min-w-0 flex-1">
                    <h3 class="text-sm font-bold text-slate-900 truncate"><?php echo htmlspecialchars($doc['name']); ?></h3>
                    <p class="text-xs text-brand-blue font-semibold mt-0.5 truncate"><?php echo htmlspecialchars($doc['specialty'] ?? 'Neurology'); ?></p>
                    <p class="text-[11px] text-slate-500 mt-1 line-clamp-2"><?php echo htmlspecialchars($doc['designation'] ?? ''); ?></p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 mt-4 flex items-center justify-between text-xs">
                <a href="doctor-edit.php?id=<?php echo urlencode($doc['id'] ?? ''); ?>" class="text-brand-blue font-bold hover:underline">Edit Profile</a>
                <form method="POST" action="" onsubmit="return confirm('Remove this doctor?');" class="inline">
                    <?php echo cms_csrf_field(); ?>
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($doc['id'] ?? ''); ?>">
                    <button type="submit" class="text-red-500 font-bold hover:underline">Delete</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
