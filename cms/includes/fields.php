<?php
/**
 * Shared form-field helpers for the CMS editors.
 *
 *  cms_image_field()        renders an image picker (preview, upload, choose from
 *                           the media library, remove, optional alt text)
 *  cms_image_field_value()  reads the submitted value of such a field
 *  cms_image_file_key()     the <input type=file> name used for a field
 *  cms_sortable_list_attrs() attributes for a drag-and-drop list container
 */

require_once __DIR__ . '/functions.php';

if (!function_exists('cms_image_file_key')) {
    /**
     * File inputs cannot share the bracket syntax of their hidden path field
     * (PHP stops parsing "a[b]_file"), so derive a flat, unique name.
     */
    function cms_image_file_key($name) {
        return 'imgfile_' . preg_replace('/[^a-zA-Z0-9_]/', '_', (string)$name);
    }
}

if (!function_exists('cms_image_field')) {
    /**
     * Render an image field.
     *
     * @param string $name   form name of the hidden path input (brackets allowed)
     * @param string $value  current relative path (e.g. assets/uploads/x.webp)
     * @param array  $opts   label, hint, size (e.g. "800 × 600 px"), folder (library
     *                       folder suggested for uploads), alt_name, alt_value,
     *                       alt_label, compact (bool), preview_class
     */
    function cms_image_field($name, $value, array $opts = []) {
        $value = trim((string)$value);
        $label = $opts['label'] ?? 'Image';
        $hint = $opts['hint'] ?? '';
        $size = $opts['size'] ?? '';
        $folder = $opts['folder'] ?? 'general';
        $fileKey = cms_image_file_key($name);
        $previewClass = $opts['preview_class'] ?? 'w-28 h-20';
        $compact = !empty($opts['compact']);
        $id = 'imgf_' . substr(md5($name), 0, 10);
        $hasAlt = isset($opts['alt_name']);
        ?>
        <div class="cms-image-field <?php echo $compact ? 'space-y-1.5' : 'bg-slate-50 p-3.5 rounded-xl border border-slate-200 space-y-2'; ?>" id="<?php echo $id; ?>" data-folder="<?php echo htmlspecialchars($folder); ?>">
            <?php if (!$compact || $label !== ''): ?>
            <div class="flex items-center justify-between">
                <label class="block text-xs font-bold text-slate-800"><i class="fas fa-image text-brand-blue mr-1"></i> <?php echo htmlspecialchars($label); ?></label>
                <?php if ($size !== ''): ?><span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800"><?php echo htmlspecialchars($size); ?></span><?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if ($hint !== ''): ?><p class="text-[10px] text-slate-500"><?php echo htmlspecialchars($hint); ?></p><?php endif; ?>
            <input type="hidden" name="<?php echo htmlspecialchars($name); ?>" value="<?php echo htmlspecialchars($value); ?>" class="cms-image-path">
            <div class="flex items-start gap-3">
                <div class="cms-image-preview <?php echo htmlspecialchars($previewClass); ?> flex-shrink-0 rounded-lg border border-slate-200 bg-white overflow-hidden flex items-center justify-center text-slate-300">
                    <?php if ($value !== ''): ?>
                    <img src="../<?php echo htmlspecialchars(ltrim($value, '/')); ?>" alt="" class="w-full h-full object-cover">
                    <?php else: ?>
                    <i class="fas fa-image text-xl"></i>
                    <?php endif; ?>
                </div>
                <div class="flex-1 min-w-0 space-y-1.5">
                    <div class="flex flex-wrap items-center gap-1.5">
                        <label class="inline-flex items-center space-x-1 px-2.5 py-1.5 rounded-lg bg-brand-blue text-white text-[11px] font-bold cursor-pointer hover:bg-blue-700">
                            <i class="fas fa-upload text-[10px]"></i><span>Upload</span>
                            <input type="file" name="<?php echo htmlspecialchars($fileKey); ?>" accept=".png,.jpg,.jpeg,.webp,.gif" class="hidden cms-image-file">
                        </label>
                        <button type="button" class="cms-image-choose inline-flex items-center space-x-1 px-2.5 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 text-[11px] font-bold hover:bg-slate-100">
                            <i class="fas fa-photo-film text-[10px]"></i><span>Choose from library</span>
                        </button>
                        <button type="button" class="cms-image-clear inline-flex items-center space-x-1 px-2.5 py-1.5 rounded-lg bg-white border border-red-200 text-red-600 text-[11px] font-bold hover:bg-red-50 <?php echo $value === '' ? 'hidden' : ''; ?>">
                            <i class="fas fa-times text-[10px]"></i><span>Remove</span>
                        </button>
                    </div>
                    <div class="cms-image-pathlabel text-[10px] text-slate-400 font-mono break-all"><?php echo $value !== '' ? htmlspecialchars($value) : 'No image selected'; ?></div>
                    <?php if ($hasAlt): ?>
                    <input type="text" name="<?php echo htmlspecialchars($opts['alt_name']); ?>" value="<?php echo htmlspecialchars((string)($opts['alt_value'] ?? '')); ?>" placeholder="<?php echo htmlspecialchars($opts['alt_label'] ?? 'Alt text (describe the image for SEO & accessibility)'); ?>" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('cms_image_field_value')) {
    /**
     * Resolve the submitted value of an image field.
     *
     * Priority: a freshly uploaded file > the posted path (set by the library
     * picker, or '' after "Remove") > the stored value when the field was not
     * part of the form at all.
     *
     * @return array ['path' => string, 'error' => string, 'changed' => bool]
     */
    function cms_image_field_value($name, $folder, $current = '') {
        $posted = null;
        $src = $_POST;
        // Support bracketed names: walk the POST array.
        if (preg_match_all('/\[([^\]]*)\]/', $name, $m) && strpos($name, '[') !== false) {
            $root = substr($name, 0, strpos($name, '['));
            $node = $src[$root] ?? null;
            foreach ($m[1] as $k) {
                if (!is_array($node) || !array_key_exists($k, $node)) { $node = null; break; }
                $node = $node[$k];
            }
            if ($node !== null && !is_array($node)) $posted = trim((string)$node);
        } elseif (array_key_exists($name, $src)) {
            $posted = trim((string)$src[$name]);
        }

        $out = ['path' => $posted !== null ? $posted : (string)$current, 'error' => '', 'changed' => false];
        if ($posted !== null && $posted !== (string)$current) {
            $out['changed'] = true;
        }
        $up = cms_handle_upload(cms_image_file_key($name), $folder);
        if (is_array($up) && isset($up['error'])) {
            $out['error'] = $up['error'];
        } elseif (is_array($up) && !empty($up['path'])) {
            $out['path'] = $up['path'];
            $out['changed'] = true;
        }
        // Never store a path outside the site assets.
        if ($out['path'] !== '' && !preg_match('#^(https?:)?//#i', $out['path'])) {
            $out['path'] = ltrim(str_replace(['..', "\0"], '', $out['path']), '/');
        }
        return $out;
    }
}

if (!function_exists('cms_sortable_list_attrs')) {
    /**
     * Attributes for a drag-and-drop container. Rows need data-id and a
     * .drag-handle element. With $reorderUrl the new order is POSTed as
     * ids[] (plus csrf_token) to that URL right after a drop.
     */
    function cms_sortable_list_attrs($reorderUrl = '', $action = 'reorder') {
        $attrs = ' data-sortable="1"';
        if ($reorderUrl !== '') {
            $attrs .= ' data-reorder-url="' . htmlspecialchars($reorderUrl) . '" data-reorder-action="' . htmlspecialchars($action) . '"';
        }
        return $attrs;
    }
}

if (!function_exists('cms_apply_reorder')) {
    /**
     * Re-sequence a collection array by an ordered list of ids: items named in
     * $ids come first (order 1..N), unknown items keep their relative order after.
     */
    function cms_apply_reorder(array $items, array $ids, $idKey = 'id') {
        $byId = [];
        foreach ($items as $it) {
            if (is_array($it) && isset($it[$idKey])) $byId[(string)$it[$idKey]] = $it;
        }
        $sorted = [];
        foreach ($ids as $id) {
            $id = (string)$id;
            if (isset($byId[$id])) { $sorted[] = $byId[$id]; unset($byId[$id]); }
        }
        foreach ($byId as $rest) $sorted[] = $rest;
        $n = 1;
        foreach ($sorted as &$it) { $it['order'] = $n++; }
        unset($it);
        return $sorted;
    }
}
