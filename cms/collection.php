<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/fields.php';
require_once __DIR__ . '/includes/collections.php';

cms_require_auth();

$name = preg_replace('/[^a-z0-9_]/', '', (string)($_GET['c'] ?? $_POST['c'] ?? ''));
$schema = cms_collection_schema($name);
if (!$schema) {
    http_response_code(404);
    $pageTitle = 'Unknown collection';
    require_once __DIR__ . '/includes/header.php';
    echo '<div class="p-6 bg-white rounded-2xl border border-slate-200 text-sm">Unknown collection. <a href="index.php" class="text-brand-blue font-bold">Back to dashboard</a></div>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$items = cms_collection_load($name);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';
    $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']);

    if ($action === 'reorder') {
        $ids = isset($_POST['ids']) && is_array($_POST['ids']) ? $_POST['ids'] : [];
        $items = cms_apply_reorder($items, $ids);
        $ok = cms_collection_save($name, $items);
        if ($isAjax) { header('Content-Type: application/json'); echo json_encode(['success' => $ok]); exit; }
        cms_set_flash($ok ? 'success' : 'error', $ok ? 'Order saved.' : 'Could not save the order.');
    } elseif ($action === 'delete') {
        $id = (string)($_POST['id'] ?? '');
        $items = array_values(array_filter($items, function ($it) use ($id) { return (string)($it['id'] ?? '') !== $id; }));
        cms_collection_save($name, $items);
        cms_set_flash('success', $schema['singular'] . ' deleted.');
    } elseif ($action === 'toggle') {
        $id = (string)($_POST['id'] ?? '');
        foreach ($items as &$it) {
            if ((string)($it['id'] ?? '') === $id) { $it['active'] = empty($it['active']) ? true : false; break; }
        }
        unset($it);
        cms_collection_save($name, $items);
        cms_set_flash('success', 'Visibility updated.');
    }
    header('Location: collection.php?c=' . urlencode($name));
    exit;
}

$list = $schema['list'] ?? [];
$hasActive = false;
foreach ($schema['fields'] as $f) if ($f['type'] === 'toggle' && $f['key'] === 'active') $hasActive = true;
$selectLabels = [];
foreach ($schema['fields'] as $f) if ($f['type'] === 'select') $selectLabels[$f['key']] = cms_collection_options($f);

$pageTitle = $schema['label'];
require_once __DIR__ . '/includes/header.php';
?>

<div class="space-y-5 max-w-6xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-200">
        <div>
            <h2 class="text-base font-bold text-slate-900"><i class="fas <?php echo htmlspecialchars($schema['icon'] ?? 'fa-list'); ?> text-brand-blue mr-2"></i><?php echo htmlspecialchars($schema['label']); ?> <span class="text-slate-400 font-semibold">(<?php echo count($items); ?>)</span></h2>
            <p class="text-xs text-slate-500 mt-0.5"><?php echo htmlspecialchars($schema['description'] ?? ''); ?> Drag the <i class="fas fa-grip-vertical"></i> handle to reorder.</p>
        </div>
        <div class="flex items-center gap-2">
            <?php if (!empty($schema['public'])): ?>
            <a href="../<?php echo htmlspecialchars($schema['public']); ?>" target="_blank" class="px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fas fa-external-link-alt text-[10px] mr-1"></i> View page</a>
            <?php endif; ?>
            <a href="collection-edit.php?c=<?php echo urlencode($name); ?>" class="px-4 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm flex items-center space-x-1.5">
                <i class="fas fa-plus"></i><span>Add <?php echo htmlspecialchars($schema['singular']); ?></span>
            </a>
        </div>
    </div>

    <?php if (empty($items)): ?>
    <div class="bg-white p-12 rounded-2xl border border-slate-200 text-center">
        <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3 text-lg"><i class="fas <?php echo htmlspecialchars($schema['icon'] ?? 'fa-list'); ?>"></i></div>
        <p class="text-xs font-bold text-slate-600">Nothing here yet</p>
        <p class="text-[11px] text-slate-400 mt-1">Click “Add <?php echo htmlspecialchars($schema['singular']); ?>” to create the first entry.</p>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-2xl border border-slate-200 divide-y divide-slate-100 overflow-hidden" <?php echo cms_sortable_list_attrs('collection.php?c=' . urlencode($name)); ?>>
        <?php foreach ($items as $i => $it): ?>
        <div class="flex items-center gap-3 px-3 py-2.5 hover:bg-slate-50 <?php echo ($hasActive && empty($it['active'])) ? 'opacity-60' : ''; ?>" data-id="<?php echo htmlspecialchars($it['id']); ?>">
            <span class="drag-handle cursor-grab text-slate-300 hover:text-slate-500 px-1" title="Drag to reorder"><i class="fas fa-grip-vertical"></i></span>
            <span class="sort-position w-6 text-center text-[10px] font-bold text-slate-400"><?php echo $i + 1; ?></span>
            <?php if (!empty($list['image'])): ?>
            <div class="w-16 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0 border border-slate-200">
                <?php if (!empty($it[$list['image']])): ?><img src="../<?php echo htmlspecialchars($it[$list['image']]); ?>" alt="" class="w-full h-full object-cover" loading="lazy"><?php endif; ?>
            </div>
            <?php elseif (!empty($list['youtube']) && !empty($it[$list['youtube']])): ?>
            <div class="w-16 h-12 rounded-lg bg-slate-900 overflow-hidden flex-shrink-0 border border-slate-200">
                <img src="https://img.youtube.com/vi/<?php echo htmlspecialchars($it[$list['youtube']]); ?>/mqdefault.jpg" alt="" class="w-full h-full object-cover" loading="lazy">
            </div>
            <?php endif; ?>
            <div class="flex-1 min-w-0">
                <div class="text-xs font-bold text-slate-900 truncate"><?php echo htmlspecialchars(strip_tags((string)($it[$list['title'] ?? 'title'] ?? ''))); ?></div>
                <?php if (!empty($list['subtitle'])): ?><div class="text-[11px] text-slate-500 truncate"><?php echo htmlspecialchars(strip_tags((string)($it[$list['subtitle']] ?? ''))); ?></div><?php endif; ?>
            </div>
            <?php if (!empty($list['badge']) && isset($it[$list['badge']]) && $it[$list['badge']] !== '' && $it[$list['badge']] !== false): ?>
            <span class="hidden sm:inline px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 whitespace-nowrap">
                <?php $bv = $it[$list['badge']]; echo htmlspecialchars($bv === true ? 'Homepage' : (string)($selectLabels[$list['badge']][$bv] ?? $bv)); ?>
            </span>
            <?php endif; ?>
            <?php if ($hasActive): ?>
            <form method="POST" class="inline">
                <?php echo cms_csrf_field(); ?>
                <input type="hidden" name="c" value="<?php echo htmlspecialchars($name); ?>">
                <input type="hidden" name="action" value="toggle">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($it['id']); ?>">
                <button type="submit" class="px-2 py-1 rounded-lg text-[10px] font-bold <?php echo !empty($it['active']) ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500'; ?>" title="Click to toggle"><?php echo !empty($it['active']) ? 'Visible' : 'Hidden'; ?></button>
            </form>
            <?php endif; ?>
            <a href="collection-edit.php?c=<?php echo urlencode($name); ?>&id=<?php echo urlencode($it['id']); ?>" class="px-3 py-1.5 bg-brand-blue hover:bg-blue-700 text-white text-[11px] font-bold rounded-lg">Edit</a>
            <form method="POST" class="inline" onsubmit="return confirm('Delete this <?php echo htmlspecialchars(strtolower($schema['singular'])); ?>?');">
                <?php echo cms_csrf_field(); ?>
                <input type="hidden" name="c" value="<?php echo htmlspecialchars($name); ?>">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($it['id']); ?>">
                <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600" title="Delete"><i class="fas fa-trash-alt"></i></button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
