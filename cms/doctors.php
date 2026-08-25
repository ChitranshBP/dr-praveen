<?php
$pageTitle = 'Doctor Profile & Team';
require_once __DIR__ . '/includes/header.php';

$doctors = CMS_DB::get('doctors', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';

    if ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        $doctors = array_values(array_filter($doctors, function($d) use ($id) { return ($d['id'] ?? '') !== $id; }));
        CMS_DB::set('doctors', $doctors);
        cms_set_flash('success', 'Doctor removed from team.');
        header('Location: doctors.php');
        exit;
    }
}
?>

<div class="space-y-6 max-w-6xl">
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Medical Team & Associates (<?php echo count($doctors); ?>)</h2>
        <a href="doctor-edit.php" class="px-4 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all flex items-center space-x-1.5">
            <i class="fas fa-user-plus"></i>
            <span>Add Doctor</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach ($doctors as $doc): ?>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-start space-x-4">
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
