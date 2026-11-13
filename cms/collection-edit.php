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
    header('Location: index.php');
    exit;
}
$items = cms_collection_load($name);
$id = (string)($_GET['id'] ?? $_POST['id'] ?? '');
$item = null;
foreach ($items as $it) {
    if ((string)($it['id'] ?? '') === $id) { $item = $it; break; }
}
$isNew = $item === null;
if ($isNew) {
    $item = [];
    foreach ($schema['fields'] as $f) {
        if (array_key_exists('default', $f)) $item[$f['key']] = $f['default'];
    }
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    [$saved, $errors] = cms_collection_read_post($schema, $isNew ? [] : $item);
    if (empty($errors)) {
        if ($isNew) {
            $saved['order'] = count($items) + 1;
            $items[] = $saved;
        } else {
            foreach ($items as &$it) {
                if ((string)($it['id'] ?? '') === $id) { $it = array_merge($it, $saved); break; }
            }
            unset($it);
        }
        if (cms_collection_save($name, $items)) {
            cms_set_flash('success', $schema['singular'] . ' saved.');
            header('Location: collection.php?c=' . urlencode($name));
            exit;
        }
        $errors[] = 'Could not write data/collections/' . $name . '.json. Check folder permissions.';
    }
    $item = array_merge($item, $saved);
}

$pagesCatalog = CMS_DB::getPagesCatalog();
$pageTitle = ($isNew ? 'Add ' : 'Edit ') . $schema['singular'];
require_once __DIR__ . '/includes/header.php';

$inp = 'w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none';
?>

<div class="max-w-3xl bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
        <div>
            <h2 class="text-lg font-bold text-slate-800"><?php echo htmlspecialchars($pageTitle); ?></h2>
            <p class="text-xs text-slate-500"><?php echo htmlspecialchars($schema['description'] ?? ''); ?></p>
        </div>
        <a href="collection.php?c=<?php echo urlencode($name); ?>" class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Back</a>
    </div>

    <?php if ($errors): ?>
    <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs font-semibold space-y-1">
        <?php foreach ($errors as $e): ?><div><i class="fas fa-exclamation-circle mr-1"></i><?php echo htmlspecialchars($e); ?></div><?php endforeach; ?>
    </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="space-y-5">
        <?php echo cms_csrf_field(); ?>
        <input type="hidden" name="c" value="<?php echo htmlspecialchars($name); ?>">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <?php foreach ($schema['fields'] as $f):
            $k = $f['key']; $type = $f['type']; $v = $item[$k] ?? ($f['default'] ?? '');
            $req = !empty($f['required']);
            $label = htmlspecialchars($f['label'] ?? $k) . ($req ? ' <span class="text-red-500">*</span>' : '');
        ?>
            <?php if ($type === 'image'): ?>
            <?php cms_image_field('f_' . $k, (string)$v, [
                'label' => $f['label'] ?? 'Image', 'folder' => $f['folder'] ?? 'library', 'size' => $f['size'] ?? '',
                'alt_name' => !empty($f['alt_key']) ? 'f_' . $f['alt_key'] : null,
                'alt_value' => !empty($f['alt_key']) ? (string)($item[$f['alt_key']] ?? '') : '',
            ] + (empty($f['alt_key']) ? ['alt_name' => null] : [])); ?>
            <?php elseif ($type === 'toggle'): ?>
            <label class="flex items-center space-x-2 text-xs font-bold text-slate-700">
                <input type="checkbox" name="f_<?php echo $k; ?>" value="1" <?php echo !empty($v) ? 'checked' : ''; ?> class="w-4 h-4 text-blue-600 rounded">
                <span><?php echo $label; ?></span>
            </label>
            <?php elseif ($type === 'textarea'): ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><?php echo $label; ?></label>
                <textarea name="f_<?php echo $k; ?>" rows="3" class="<?php echo $inp; ?>"><?php echo htmlspecialchars((string)$v); ?></textarea>
            </div>
            <?php elseif ($type === 'richtext'): ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><?php echo $label; ?></label>
                <textarea name="f_<?php echo $k; ?>" rows="6" class="rich-editor <?php echo $inp; ?>"><?php echo htmlspecialchars((string)$v); ?></textarea>
            </div>
            <?php elseif ($type === 'select' || $type === 'color'):
                $opts = $type === 'color'
                    ? ['electric-blue' => 'Blue', 'cyan-accent' => 'Cyan', 'deep-indigo' => 'Indigo', 'red' => 'Red', 'dark' => 'Dark grey', 'emerald' => 'Green', 'amber' => 'Amber']
                    : cms_collection_options($f);
            ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><?php echo $label; ?></label>
                <select name="f_<?php echo $k; ?>" class="<?php echo $inp; ?>">
                    <?php foreach ($opts as $ok => $ol): ?>
                    <option value="<?php echo htmlspecialchars($ok); ?>" <?php echo (string)$v === (string)$ok ? 'selected' : ''; ?>><?php echo htmlspecialchars($ol); ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($f['options_setting'])): ?>
                <p class="text-[10px] text-slate-400 mt-1">Options are managed in <a href="settings.php#collections" class="text-brand-blue font-semibold underline">Settings → Lists &amp; Categories</a>.</p>
                <?php endif; ?>
            </div>
            <?php elseif ($type === 'pages'): ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><?php echo $label; ?></label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-1.5 max-h-56 overflow-y-auto p-3 bg-slate-50 border border-slate-200 rounded-xl">
                    <?php $sel = is_array($v) ? $v : []; foreach ($pagesCatalog as $p): $ps = $p['slug'] ?? ''; if ($ps === '' || $ps === 'index') continue; ?>
                    <label class="flex items-center space-x-1.5 text-[11px] text-slate-700">
                        <input type="checkbox" name="f_<?php echo $k; ?>[]" value="<?php echo htmlspecialchars($ps); ?>" <?php echo in_array($ps, $sel, true) ? 'checked' : ''; ?> class="w-3.5 h-3.5 rounded">
                        <span class="truncate" title="<?php echo htmlspecialchars($p['title'] ?? $ps); ?>"><?php echo htmlspecialchars($p['title'] ?? $ps); ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php elseif ($type === 'youtube'): ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><?php echo $label; ?></label>
                <div class="flex items-start gap-3">
                    <input type="text" name="f_<?php echo $k; ?>" value="<?php echo htmlspecialchars((string)$v); ?>" placeholder="https://www.youtube.com/watch?v=… or the 11-character ID" class="<?php echo $inp; ?>" <?php echo $req ? 'required' : ''; ?>>
                    <?php if ($v !== ''): ?><img src="https://img.youtube.com/vi/<?php echo htmlspecialchars((string)$v); ?>/mqdefault.jpg" alt="" class="w-24 h-14 object-cover rounded-lg border border-slate-200"><?php endif; ?>
                </div>
            </div>
            <?php elseif ($type === 'tags'): ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><?php echo $label; ?></label>
                <input type="text" name="f_<?php echo $k; ?>" value="<?php echo htmlspecialchars(is_array($v) ? implode(', ', $v) : (string)$v); ?>" placeholder="comma, separated, values" class="<?php echo $inp; ?>">
            </div>
            <?php else: ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><?php echo $label; ?></label>
                <input type="<?php echo $type === 'url' ? 'url' : ($type === 'number' ? 'number' : ($type === 'date' ? 'date' : 'text')); ?>" name="f_<?php echo $k; ?>" value="<?php echo htmlspecialchars((string)$v); ?>" class="<?php echo $inp; ?>" <?php echo $req ? 'required' : ''; ?> <?php echo !empty($f['placeholder']) ? 'placeholder="' . htmlspecialchars($f['placeholder']) . '"' : ''; ?>>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
            <a href="collection.php?c=<?php echo urlencode($name); ?>" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md">Save <?php echo htmlspecialchars($schema['singular']); ?></button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
