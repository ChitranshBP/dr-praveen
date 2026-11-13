<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/media.php';

cms_require_auth();

$roots = cms_media_roots();
$folder = (string)($_GET['folder'] ?? 'uploads/library');
if (!isset($roots[$folder])) {
    $folder = isset($roots['uploads/library']) ? 'uploads/library' : (string)array_key_first($roots);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';
    if ($action === 'upload') {
        $target = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)($_POST['folder'] ?? 'library')) ?: 'library';
        $ok = 0; $errors = [];
        if (!empty($_FILES['files']) && is_array($_FILES['files']['name'])) {
            foreach ($_FILES['files']['name'] as $i => $n) {
                $_FILES['one'] = [
                    'name' => $n,
                    'type' => $_FILES['files']['type'][$i],
                    'tmp_name' => $_FILES['files']['tmp_name'][$i],
                    'error' => $_FILES['files']['error'][$i],
                    'size' => $_FILES['files']['size'][$i],
                ];
                $up = cms_handle_upload('one', $target);
                if (is_array($up) && isset($up['error'])) $errors[] = $n . ': ' . $up['error'];
                elseif (is_array($up)) $ok++;
            }
        }
        if ($ok) cms_set_flash($errors ? 'error' : 'success', $ok . ' file(s) uploaded.' . ($errors ? ' Failed: ' . implode('; ', $errors) : ''));
        else cms_set_flash('error', $errors ? implode('; ', $errors) : 'No files were uploaded.');
        header('Location: media.php?folder=' . urlencode('uploads/' . $target));
        exit;
    }
    if ($action === 'delete') {
        $err = cms_media_delete((string)($_POST['path'] ?? ''));
        cms_set_flash($err === '' ? 'success' : 'error', $err === '' ? 'Image deleted.' : $err);
        header('Location: media.php?folder=' . urlencode($folder));
        exit;
    }
    if ($action === 'new_folder') {
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)($_POST['name'] ?? ''));
        if ($name === '' || $name === 'leads') {
            cms_set_flash('error', 'Please enter a folder name using letters, numbers or dashes.');
        } else {
            @mkdir(UPLOADS_DIR . '/' . $name, 0755, true);
            cms_set_flash('success', 'Folder created.');
            $folder = 'uploads/' . $name;
        }
        header('Location: media.php?folder=' . urlencode($folder));
        exit;
    }
}

if (!is_dir(UPLOADS_DIR . '/library')) {
    @mkdir(UPLOADS_DIR . '/library', 0755, true);
    $roots = cms_media_roots();
}

$items = cms_media_scan($folder);
$q = strtolower(trim((string)($_GET['q'] ?? '')));
if ($q !== '') {
    $items = array_values(array_filter($items, function ($r) use ($q) { return strpos(strtolower($r['path']), $q) !== false; }));
}
$writable = !empty($roots[$folder]['writable']);

$pageTitle = 'Media Library';
require_once __DIR__ . '/includes/header.php';
?>

<div class="space-y-5 max-w-7xl">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3 pb-4 border-b border-slate-200">
        <div>
            <h2 class="text-base font-bold text-slate-900">Media Library</h2>
            <p class="text-xs text-slate-500 mt-0.5">All images used on the website. Upload once, then pick the same image anywhere with “Choose from library”. Built-in site images are read-only; uploads can be deleted when nothing uses them.</p>
        </div>
        <form method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
            <?php echo cms_csrf_field(); ?>
            <input type="hidden" name="action" value="upload">
            <select name="folder" class="px-2.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-semibold">
                <?php foreach ($roots as $k => $r): if (empty($r['writable'])) continue; ?>
                <option value="<?php echo htmlspecialchars(substr($k, 8)); ?>" <?php echo $k === $folder ? 'selected' : ''; ?>><?php echo htmlspecialchars($r['label']); ?></option>
                <?php endforeach; ?>
            </select>
            <label class="inline-flex items-center space-x-1.5 px-4 py-2 rounded-xl bg-brand-blue text-white text-xs font-bold cursor-pointer hover:bg-blue-700 shadow-sm">
                <i class="fas fa-upload"></i><span>Upload images</span>
                <input type="file" name="files[]" multiple accept=".png,.jpg,.jpeg,.webp,.gif" class="hidden" onchange="this.form.submit()">
            </label>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        <aside class="lg:col-span-3 space-y-3">
            <div class="bg-white rounded-2xl border border-slate-200 p-3 space-y-1">
                <p class="px-2 pt-1 pb-2 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Uploads</p>
                <?php foreach ($roots as $k => $r): if (empty($r['writable'])) continue; ?>
                <a href="media.php?folder=<?php echo urlencode($k); ?>" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold <?php echo $k === $folder ? 'bg-brand-blue text-white' : 'text-slate-700 hover:bg-slate-50'; ?>">
                    <span><i class="fas fa-folder mr-2 <?php echo $k === $folder ? 'text-white/80' : 'text-amber-400'; ?>"></i><?php echo htmlspecialchars(substr($r['label'], 10)); ?></span>
                    <span class="text-[10px] opacity-70"><?php echo count(cms_media_scan($k)); ?></span>
                </a>
                <?php endforeach; ?>
                <form method="POST" class="flex items-center gap-1.5 px-2 pt-2 border-t border-slate-100">
                    <?php echo cms_csrf_field(); ?>
                    <input type="hidden" name="action" value="new_folder">
                    <input type="text" name="name" placeholder="new-folder" class="flex-1 min-w-0 px-2 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px]">
                    <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-[11px] font-bold text-slate-700" title="Create folder"><i class="fas fa-folder-plus"></i></button>
                </form>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-3 space-y-1">
                <p class="px-2 pt-1 pb-2 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Built-in site images</p>
                <?php foreach ($roots as $k => $r): if (!empty($r['writable'])) continue; ?>
                <a href="media.php?folder=<?php echo urlencode($k); ?>" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold <?php echo $k === $folder ? 'bg-brand-blue text-white' : 'text-slate-700 hover:bg-slate-50'; ?>">
                    <span><i class="fas fa-folder mr-2 <?php echo $k === $folder ? 'text-white/80' : 'text-slate-300'; ?>"></i><?php echo htmlspecialchars(substr($r['label'], 14)); ?></span>
                    <span class="text-[10px] opacity-70"><?php echo count(cms_media_scan($k)); ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </aside>

        <section class="lg:col-span-9 space-y-3">
            <form method="GET" class="flex items-center gap-2">
                <input type="hidden" name="folder" value="<?php echo htmlspecialchars($folder); ?>">
                <input type="search" name="q" value="<?php echo htmlspecialchars($q); ?>" placeholder="Search by file name…" class="flex-1 px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs">
                <button type="submit" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-xs font-bold text-slate-700">Search</button>
                <span class="text-xs text-slate-400 whitespace-nowrap"><?php echo count($items); ?> image<?php echo count($items) === 1 ? '' : 's'; ?></span>
            </form>

            <?php if (empty($items)): ?>
            <div class="bg-white p-12 rounded-2xl border border-slate-200 text-center text-xs text-slate-500">No images in this folder yet.</div>
            <?php else: ?>
            <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4">
                <?php foreach ($items as $it):
                    $uses = cms_media_usage_count($it['path']);
                    [$w, $h] = cms_media_dimensions($it['path']);
                ?>
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden flex flex-col">
                    <div class="aspect-[4/3] bg-slate-100 overflow-hidden">
                        <img src="../<?php echo htmlspecialchars($it['path']); ?>" alt="" loading="lazy" class="w-full h-full object-cover">
                    </div>
                    <div class="p-3 space-y-1.5 flex-1 flex flex-col">
                        <div class="text-[11px] font-bold text-slate-800 truncate" title="<?php echo htmlspecialchars($it['name']); ?>"><?php echo htmlspecialchars($it['name']); ?></div>
                        <div class="text-[10px] text-slate-400 flex items-center justify-between">
                            <span><?php echo $w ? $w . ' × ' . $h : ''; ?></span>
                            <span><?php echo round($it['size'] / 1024); ?> KB</span>
                        </div>
                        <div class="text-[10px] <?php echo $uses ? 'text-emerald-700' : 'text-slate-400'; ?> font-semibold"><i class="fas <?php echo $uses ? 'fa-link' : 'fa-unlink'; ?> mr-1"></i><?php echo $uses ? 'Used in ' . $uses . ' place' . ($uses === 1 ? '' : 's') : 'Not used anywhere'; ?></div>
                        <div class="mt-auto pt-2 flex items-center justify-between gap-2">
                            <button type="button" class="text-[10px] font-bold text-brand-blue hover:underline" onclick="navigator.clipboard && navigator.clipboard.writeText('<?php echo htmlspecialchars($it['path']); ?>'); this.textContent='Copied!';">Copy path</button>
                            <?php if ($writable && $uses === 0): ?>
                            <form method="POST" onsubmit="return confirm('Delete this image permanently?');">
                                <?php echo cms_csrf_field(); ?>
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="path" value="<?php echo htmlspecialchars($it['path']); ?>">
                                <button type="submit" class="text-[10px] font-bold text-red-500 hover:underline"><i class="fas fa-trash-alt mr-1"></i>Delete</button>
                            </form>
                            <?php elseif ($writable): ?>
                            <span class="text-[10px] text-slate-300" title="Replace the image where it is used before deleting it">In use</span>
                            <?php else: ?>
                            <span class="text-[10px] text-slate-300" title="Built-in site image">Protected</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </section>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
