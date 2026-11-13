<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/fields.php';

cms_require_auth();

$services = CMS_DB::get('services', []);
usort($services, function ($a, $b) { return ((int)($a['order'] ?? 999)) <=> ((int)($b['order'] ?? 999)); });

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';
    if ($action === 'reorder') {
        $services = cms_apply_reorder($services, is_array($_POST['ids'] ?? null) ? $_POST['ids'] : []);
        $ok = CMS_DB::set('services', $services);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) { header('Content-Type: application/json'); echo json_encode(['success' => $ok]); exit; }
        cms_set_flash($ok ? 'success' : 'error', $ok ? 'Card order saved.' : 'Could not save the order.');
    } elseif ($action === 'delete') {
        $id = (string)($_POST['id'] ?? '');
        $services = array_values(array_filter($services, function ($s) use ($id) { return (string)($s['id'] ?? '') !== $id; }));
        $services = cms_apply_reorder($services, array_column($services, 'id'));
        CMS_DB::set('services', $services);
        cms_set_flash('success', 'Condition card deleted.');
    }
    header('Location: services.php');
    exit;
}

$pageTitle = 'Brain & Spine Condition Cards';
require_once __DIR__ . '/includes/header.php';
?>

<div class="space-y-6 max-w-6xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-200">
        <div>
            <h2 class="text-base font-bold text-slate-900">Brain & Spine Condition Cards</h2>
            <p class="text-xs text-slate-500 mt-0.5">The condition cards shown in the "Comprehensive Care for Every Brain &amp; Spine Condition" section on the homepage, the Services page and the footer. Drag a card by its <i class="fas fa-grip-vertical"></i> handle to reorder.</p>
        </div>
        <a href="service-edit.php" class="px-4 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all flex items-center space-x-1.5 self-start sm:self-auto">
            <i class="fas fa-plus"></i>
            <span>Add New Card</span>
        </a>
    </div>

    <!-- Visual Cards Grid (Matches Website Layout) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" <?php echo cms_sortable_list_attrs('services.php'); ?>>
        <?php foreach ($services as $svc): ?>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow" data-id="<?php echo htmlspecialchars($svc['id'] ?? ''); ?>">
            <div>
                <!-- Card Image Preview -->
                <div class="relative w-full aspect-[4/3] bg-slate-100 overflow-hidden border-b border-slate-100">
                    <span class="drag-handle absolute top-3 left-3 z-10 w-8 h-8 rounded-lg bg-white/90 text-slate-500 flex items-center justify-center cursor-grab shadow" title="Drag to reorder"><i class="fas fa-grip-vertical"></i></span>
                    <img src="../<?php echo htmlspecialchars($svc['image'] ?? 'assets/services/stroke-care.png'); ?>" class="w-full h-full object-cover" alt="Card Image">
                    <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-[10px] font-bold shadow-sm <?php echo !empty($svc['is_active']) ? 'bg-emerald-500 text-white' : 'bg-slate-800 text-slate-200'; ?>">
                        <?php echo !empty($svc['is_active']) ? 'Active' : 'Hidden'; ?>
                    </span>
                </div>

                <div class="p-5">
                    <h3 class="text-sm font-bold text-slate-900 mb-1.5 leading-tight"><?php echo htmlspecialchars($svc['title']); ?></h3>
                    <p class="text-xs text-slate-500 line-clamp-2 mb-3"><?php echo htmlspecialchars($svc['short_description'] ?? ''); ?></p>

                    <!-- Features preview -->
                    <?php if (!empty($svc['features'])): ?>
                    <div class="space-y-1 mb-3 pt-2 border-t border-slate-100 text-[11px] text-slate-600">
                        <?php foreach (array_slice($svc['features'], 0, 3) as $feat): ?>
                        <div class="flex items-center space-x-1.5 truncate">
                            <i class="fas fa-check text-[9px] text-brand-blue flex-shrink-0"></i>
                            <span class="truncate"><?php echo htmlspecialchars(strip_tags((string)$feat)); ?></span>
                        </div>
                        <?php endforeach; ?>
                        <?php if (count($svc['features']) > 3): ?>
                        <span class="text-[10px] text-slate-400 font-semibold">+<?php echo count($svc['features']) - 3; ?> more procedures</span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="service-edit.php?id=<?php echo urlencode($svc['id']); ?>" class="px-3 py-1.5 bg-brand-blue hover:bg-blue-700 text-white font-bold rounded-lg transition-colors flex items-center space-x-1">
                    <i class="fas fa-edit text-[10px]"></i>
                    <span>Edit Content & Image</span>
                </a>
                <div class="flex items-center space-x-3">
                    <span class="text-[11px] text-slate-400 font-semibold">#<span class="sort-position"><?php echo $svc['order'] ?? 1; ?></span></span>
                    <form method="POST" class="inline" onsubmit="return confirm('Delete this condition card from the website?');">
                        <?php echo cms_csrf_field(); ?>
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($svc['id'] ?? ''); ?>">
                        <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600" title="Delete card"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
