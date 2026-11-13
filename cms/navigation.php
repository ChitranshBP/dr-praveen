<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/fields.php';

cms_require_auth();

$navFile = DATA_DIR . '/navigation.json';
$nav = CMS_DB::get('navigation', []);
$pagesCatalog = CMS_DB::getPagesCatalog();

function nav_clean_links($rows, $withIcon = false) {
    $out = [];
    if (!is_array($rows)) return $out;
    foreach ($rows as $r) {
        if (!is_array($r)) continue;
        $label = trim((string)($r['label'] ?? ''));
        $url = trim((string)($r['url'] ?? ''));
        if ($label === '') continue;
        $row = ['label' => $label, 'url' => $url !== '' ? $url : '#'];
        if ($withIcon) {
            $row['icon'] = trim((string)($r['icon'] ?? ''));
            $row['style'] = in_array($r['style'] ?? '', ['whatsapp', 'blue', 'primary', 'red'], true) ? $r['style'] : 'blue';
        }
        $out[] = $row;
    }
    return $out;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $main = [];
    foreach (($_POST['main'] ?? []) as $item) {
        if (!is_array($item)) continue;
        $label = trim((string)($item['label'] ?? ''));
        if ($label === '') continue;
        $children = nav_clean_links($item['children'] ?? []);
        foreach ($children as &$c) {
            $c['view_all'] = false;
        }
        unset($c);
        if (is_array($item['children'] ?? null)) {
            $i = 0;
            foreach ($item['children'] as $raw) {
                if (!is_array($raw) || trim((string)($raw['label'] ?? '')) === '') continue;
                if (!empty($raw['view_all']) && isset($children[$i])) $children[$i]['view_all'] = true;
                $i++;
            }
        }
        $url = trim((string)($item['url'] ?? ''));
        $main[] = ['label' => $label, 'url' => $url !== '' ? $url : ($children ? '#' : 'index'), 'children' => $children];
    }
    $nav = [
        'main' => $main,
        'header_cta' => ['label' => trim((string)($_POST['header_cta_label'] ?? 'Book Appointment')), 'url' => trim((string)($_POST['header_cta_url'] ?? 'contact-us-top-neurologist-delhi-ncr'))],
        'footer_quick_links' => nav_clean_links($_POST['footer_quick_links'] ?? []),
        'footer_legal_links' => nav_clean_links($_POST['footer_legal_links'] ?? []),
        'mobile_bar' => nav_clean_links($_POST['mobile_bar'] ?? [], true),
        'not_found_links' => nav_clean_links($_POST['not_found_links'] ?? []),
    ];
    $ok = CMS_DB::set('navigation', $nav);
    cms_set_flash($ok ? 'success' : 'error', $ok ? 'Navigation saved. The menus on the live site are updated.' : 'Could not write data/navigation.json.');
    header('Location: navigation.php');
    exit;
}

$pageTitle = 'Navigation & Menus';
require_once __DIR__ . '/includes/header.php';

$inp = 'w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none';

/** One link row (label + url) used by every simple list. */
function nav_link_row($prefix, $row = [], $withIcon = false, $inp = '') {
    $label = htmlspecialchars((string)($row['label'] ?? ''));
    $url = htmlspecialchars((string)($row['url'] ?? ''));
    ?>
    <div class="nav-row flex items-start gap-2 bg-slate-50 border border-slate-200 rounded-xl p-2">
        <span class="drag-handle cursor-grab text-slate-300 hover:text-slate-500 pt-2 px-1"><i class="fas fa-grip-vertical"></i></span>
        <div class="flex-1 grid grid-cols-1 sm:grid-cols-<?php echo $withIcon ? '4' : '2'; ?> gap-2">
            <input type="text" name="<?php echo $prefix; ?>[label]" value="<?php echo $label; ?>" placeholder="Label" class="<?php echo $inp; ?>" required>
            <input type="text" name="<?php echo $prefix; ?>[url]" value="<?php echo $url; ?>" placeholder="page-slug, https://…, {phone}" list="page-slugs" class="<?php echo $inp; ?> font-mono">
            <?php if ($withIcon): ?>
            <input type="text" name="<?php echo $prefix; ?>[icon]" value="<?php echo htmlspecialchars((string)($row['icon'] ?? '')); ?>" placeholder="fas fa-video" class="<?php echo $inp; ?> font-mono">
            <select name="<?php echo $prefix; ?>[style]" class="<?php echo $inp; ?>">
                <?php foreach (['whatsapp' => 'Green (WhatsApp)', 'blue' => 'Blue circle', 'primary' => 'Primary (wide button)', 'red' => 'Red (emergency)'] as $sk => $sl): ?>
                <option value="<?php echo $sk; ?>" <?php echo ($row['style'] ?? 'blue') === $sk ? 'selected' : ''; ?>><?php echo $sl; ?></option>
                <?php endforeach; ?>
            </select>
            <?php endif; ?>
        </div>
        <button type="button" class="nav-remove text-slate-400 hover:text-red-600 pt-2 px-1" title="Remove"><i class="fas fa-trash-alt"></i></button>
    </div>
    <?php
}
?>

<datalist id="page-slugs">
    <?php foreach ($pagesCatalog as $p): if (empty($p['slug'])) continue; ?>
    <option value="<?php echo htmlspecialchars($p['slug']); ?>"><?php echo htmlspecialchars($p['title'] ?? $p['slug']); ?></option>
    <?php endforeach; ?>
    <option value="{phone}">Call the clinic phone</option>
    <option value="{stroke-helpline}">Call the stroke helpline</option>
    <option value="{whatsapp}">Open WhatsApp chat</option>
</datalist>

<form method="POST" class="space-y-6 max-w-5xl">
    <?php echo cms_csrf_field(); ?>

    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center"><i class="fas fa-bars text-brand-blue mr-2"></i> Main Menu (header &amp; mobile menu)</h2>
            <button type="button" id="add-main" class="px-3 py-1.5 bg-brand-blue text-white text-[11px] font-bold rounded-lg hover:bg-blue-700"><i class="fas fa-plus mr-1"></i> Add menu item</button>
        </div>
        <p class="text-[11px] text-slate-500 -mt-1">Drag items to reorder. A menu item with sub-links opens as a dropdown; leave its URL as <code>#</code>. Tick “pin as View all” to show a sub-link as the highlighted last entry.</p>
        <div id="main-list" class="space-y-3" data-sortable="1" data-sortable-item=".main-item">
            <?php foreach (($nav['main'] ?? []) as $mi => $item): ?>
            <div class="main-item bg-slate-50 border border-slate-200 rounded-2xl p-3 space-y-2" data-index="<?php echo $mi; ?>">
                <div class="flex items-start gap-2">
                    <span class="drag-handle cursor-grab text-slate-300 hover:text-slate-500 pt-2 px-1"><i class="fas fa-grip-vertical"></i></span>
                    <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <input type="text" name="main[<?php echo $mi; ?>][label]" value="<?php echo htmlspecialchars($item['label'] ?? ''); ?>" placeholder="Menu label" class="<?php echo $inp; ?> font-bold" required>
                        <input type="text" name="main[<?php echo $mi; ?>][url]" value="<?php echo htmlspecialchars($item['url'] ?? '#'); ?>" placeholder="# for dropdown, or page-slug" list="page-slugs" class="<?php echo $inp; ?> font-mono">
                    </div>
                    <button type="button" class="main-remove text-slate-400 hover:text-red-600 pt-2 px-1" title="Remove menu item"><i class="fas fa-trash-alt"></i></button>
                </div>
                <div class="pl-7 space-y-1.5">
                    <div class="child-list space-y-1.5" data-sortable="1" data-sortable-item=".child-row">
                        <?php foreach (($item['children'] ?? []) as $ci => $child): ?>
                        <div class="child-row flex items-start gap-2 bg-white border border-slate-200 rounded-xl p-1.5">
                            <span class="drag-handle cursor-grab text-slate-300 hover:text-slate-500 pt-2 px-1 text-xs"><i class="fas fa-grip-vertical"></i></span>
                            <input type="text" name="main[<?php echo $mi; ?>][children][<?php echo $ci; ?>][label]" value="<?php echo htmlspecialchars($child['label'] ?? ''); ?>" placeholder="Sub-link label" class="<?php echo $inp; ?>">
                            <input type="text" name="main[<?php echo $mi; ?>][children][<?php echo $ci; ?>][url]" value="<?php echo htmlspecialchars($child['url'] ?? ''); ?>" placeholder="page-slug" list="page-slugs" class="<?php echo $inp; ?> font-mono">
                            <label class="flex items-center space-x-1 text-[10px] font-semibold text-slate-600 whitespace-nowrap pt-2"><input type="checkbox" name="main[<?php echo $mi; ?>][children][<?php echo $ci; ?>][view_all]" value="1" <?php echo !empty($child['view_all']) ? 'checked' : ''; ?> class="w-3.5 h-3.5 rounded"><span>Pin as “View all”</span></label>
                            <button type="button" class="child-remove text-slate-400 hover:text-red-600 pt-2 px-1" title="Remove"><i class="fas fa-times"></i></button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="add-child text-[11px] font-bold text-brand-blue hover:underline"><i class="fas fa-plus mr-1"></i> Add sub-link</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-3 border-t border-slate-100">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Header button text</label>
                <input type="text" name="header_cta_label" value="<?php echo htmlspecialchars($nav['header_cta']['label'] ?? 'Book Appointment'); ?>" class="<?php echo $inp; ?>">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Header button link</label>
                <input type="text" name="header_cta_url" value="<?php echo htmlspecialchars($nav['header_cta']['url'] ?? 'contact-us-top-neurologist-delhi-ncr'); ?>" list="page-slugs" class="<?php echo $inp; ?> font-mono">
            </div>
        </div>
    </div>

    <?php foreach ([
        'footer_quick_links' => ['Footer: Quick Links column', 'fa-link', false],
        'footer_legal_links' => ['Footer: legal links (bottom bar)', 'fa-shield-alt', false],
        'mobile_bar' => ['Mobile sticky bottom bar (phones only)', 'fa-mobile-alt', true],
        'not_found_links' => ['404 page: Popular Quick Links', 'fa-compass', false],
    ] as $listKey => [$listLabel, $listIcon, $withIcon]): ?>
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center"><i class="fas <?php echo $listIcon; ?> text-brand-blue mr-2"></i> <?php echo htmlspecialchars($listLabel); ?></h2>
            <button type="button" class="add-link px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-bold rounded-lg" data-list="<?php echo $listKey; ?>" data-icon="<?php echo $withIcon ? '1' : '0'; ?>"><i class="fas fa-plus mr-1"></i> Add link</button>
        </div>
        <?php if ($withIcon): ?><p class="text-[11px] text-slate-500 -mt-1">Columns: label, link, Font Awesome icon class, colour style. Use <code>{whatsapp}</code>, <code>{phone}</code> or <code>{stroke-helpline}</code> as the link for call / chat buttons.</p><?php endif; ?>
        <div id="list-<?php echo $listKey; ?>" class="space-y-2" data-sortable="1" data-sortable-item=".nav-row" data-next-index="<?php echo count($nav[$listKey] ?? []); ?>">
            <?php foreach (($nav[$listKey] ?? []) as $li => $row): nav_link_row($listKey . '[' . $li . ']', $row, $withIcon, $inp); endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="flex items-center justify-end pt-2">
        <button type="submit" class="px-6 py-3 bg-brand-blue hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-lg"><i class="fas fa-save mr-1.5"></i> Save Navigation</button>
    </div>
</form>

<template id="tpl-link-row"><?php nav_link_row('__LIST__[__I__]', [], false, $inp); ?></template>
<template id="tpl-link-row-icon"><?php nav_link_row('__LIST__[__I__]', [], true, $inp); ?></template>
<template id="tpl-main-item">
    <div class="main-item bg-slate-50 border border-slate-200 rounded-2xl p-3 space-y-2" data-index="__M__">
        <div class="flex items-start gap-2">
            <span class="drag-handle cursor-grab text-slate-300 hover:text-slate-500 pt-2 px-1"><i class="fas fa-grip-vertical"></i></span>
            <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-2">
                <input type="text" name="main[__M__][label]" value="" placeholder="Menu label" class="<?php echo $inp; ?> font-bold" required>
                <input type="text" name="main[__M__][url]" value="#" placeholder="# for dropdown, or page-slug" list="page-slugs" class="<?php echo $inp; ?> font-mono">
            </div>
            <button type="button" class="main-remove text-slate-400 hover:text-red-600 pt-2 px-1" title="Remove menu item"><i class="fas fa-trash-alt"></i></button>
        </div>
        <div class="pl-7 space-y-1.5">
            <div class="child-list space-y-1.5" data-sortable="1" data-sortable-item=".child-row"></div>
            <button type="button" class="add-child text-[11px] font-bold text-brand-blue hover:underline"><i class="fas fa-plus mr-1"></i> Add sub-link</button>
        </div>
    </div>
</template>
<template id="tpl-child-row">
    <div class="child-row flex items-start gap-2 bg-white border border-slate-200 rounded-xl p-1.5">
        <span class="drag-handle cursor-grab text-slate-300 hover:text-slate-500 pt-2 px-1 text-xs"><i class="fas fa-grip-vertical"></i></span>
        <input type="text" name="main[__M__][children][__C__][label]" value="" placeholder="Sub-link label" class="<?php echo $inp; ?>">
        <input type="text" name="main[__M__][children][__C__][url]" value="" placeholder="page-slug" list="page-slugs" class="<?php echo $inp; ?> font-mono">
        <label class="flex items-center space-x-1 text-[10px] font-semibold text-slate-600 whitespace-nowrap pt-2"><input type="checkbox" name="main[__M__][children][__C__][view_all]" value="1" class="w-3.5 h-3.5 rounded"><span>Pin as “View all”</span></label>
        <button type="button" class="child-remove text-slate-400 hover:text-red-600 pt-2 px-1" title="Remove"><i class="fas fa-times"></i></button>
    </div>
</template>

<script>
(function () {
    var mainList = document.getElementById('main-list');
    var nextMain = mainList.querySelectorAll('.main-item').length;
    function wire(scope) { if (window.cmsWireSortables) window.cmsWireSortables(scope || document); }
    document.getElementById('add-main').addEventListener('click', function () {
        var html = document.getElementById('tpl-main-item').innerHTML.replace(/__M__/g, String(nextMain++));
        var w = document.createElement('div'); w.innerHTML = html.trim();
        mainList.appendChild(w.firstElementChild); wire(mainList);
    });
    document.addEventListener('click', function (e) {
        var t = e.target.closest('button'); if (!t) return;
        if (t.classList.contains('main-remove')) { if (confirm('Remove this menu item and its sub-links?')) t.closest('.main-item').remove(); }
        if (t.classList.contains('child-remove')) t.closest('.child-row').remove();
        if (t.classList.contains('nav-remove')) t.closest('.nav-row').remove();
        if (t.classList.contains('add-child')) {
            var item = t.closest('.main-item'); var m = item.getAttribute('data-index');
            var list = item.querySelector('.child-list'); var c = Date.now() % 1000000;
            var html = document.getElementById('tpl-child-row').innerHTML.replace(/__M__/g, m).replace(/__C__/g, String(c));
            var w = document.createElement('div'); w.innerHTML = html.trim(); list.appendChild(w.firstElementChild); wire(list);
        }
        if (t.classList.contains('add-link')) {
            var key = t.getAttribute('data-list'); var list = document.getElementById('list-' + key);
            var i = parseInt(list.getAttribute('data-next-index') || '0', 10);
            var tpl = document.getElementById(t.getAttribute('data-icon') === '1' ? 'tpl-link-row-icon' : 'tpl-link-row');
            var html = tpl.innerHTML.replace(/__LIST__/g, key).replace(/__I__/g, String(i));
            var w = document.createElement('div'); w.innerHTML = html.trim(); list.appendChild(w.firstElementChild);
            list.setAttribute('data-next-index', String(i + 1)); wire(list);
        }
    });
})();
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
