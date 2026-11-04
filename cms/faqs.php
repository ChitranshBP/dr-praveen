<?php
$pageTitle = 'FAQs Manager';
require_once __DIR__ . '/includes/header.php';

$faqs = CMS_DB::get('faqs', []);
$catalog = CMS_DB::get('pages_catalog', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';
    $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['slug'] ?? '');

    if ($action === 'delete_page' && $slug !== '' && isset($faqs[$slug])) {
        unset($faqs[$slug]);
        CMS_DB::set('faqs', $faqs);
        cms_set_flash('success', 'FAQs removed from this page.');
        header('Location: faqs.php');
        exit;
    }
}

$catalogBySlug = [];
foreach ($catalog as $p) {
    $catalogBySlug[$p['slug']] = $p;
}

$rows = [];
$seen = [];
foreach ($faqs as $slug => $entry) {
    $seen[$slug] = true;
    $rows[] = [
        'slug' => $slug,
        'title' => $catalogBySlug[$slug]['title'] ?? ($entry['title'] ?? $slug),
        'file' => $catalogBySlug[$slug]['file'] ?? ($slug . '.php'),
        'count' => is_array($entry['items'] ?? null) ? count($entry['items']) : 0,
        'layout' => $entry['layout'] ?? 'split',
        'configured' => true,
    ];
}

$unconfigured = [];
foreach ($catalog as $p) {
    if (empty($seen[$p['slug']])) {
        $unconfigured[] = $p;
    }
}
?>

<div class="space-y-6 max-w-6xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-200">
        <div>
            <h2 class="text-base font-bold text-slate-900">Frequently Asked Questions</h2>
            <p class="text-xs text-slate-500 mt-0.5">Edit the question and answer accordions shown on every page, including the homepage and service pages.</p>
        </div>
        <a href="faq-edit.php?slug=index" class="px-4 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all flex items-center space-x-1.5 self-start sm:self-auto">
            <i class="fas fa-plus"></i>
            <span>Edit Homepage FAQs</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-5 py-3.5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
            <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Pages with FAQs (<?php echo count($rows); ?>)</h3>
            <span class="text-[11px] text-slate-400">Changes go live immediately after saving</span>
        </div>
        <div class="divide-y divide-slate-100">
            <?php foreach ($rows as $row): ?>
            <div class="p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-slate-50/60 transition-colors">
                <div class="min-w-0">
                    <div class="flex items-center space-x-2 mb-1">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold <?php echo $row['count'] > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'; ?>">
                            <?php echo (int)$row['count']; ?> FAQ<?php echo $row['count'] === 1 ? '' : 's'; ?>
                        </span>
                        <span class="text-[10px] text-slate-400 font-mono"><?php echo htmlspecialchars($row['layout']); ?></span>
                    </div>
                    <h4 class="text-sm font-bold text-slate-900 truncate"><?php echo htmlspecialchars($row['title']); ?></h4>
                    <p class="text-[11px] text-slate-400 font-mono"><?php echo htmlspecialchars($row['file']); ?></p>
                </div>
                <div class="flex items-center space-x-2 flex-shrink-0">
                    <a href="faq-edit.php?slug=<?php echo urlencode($row['slug']); ?>" class="px-3.5 py-1.5 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition-colors flex items-center space-x-1.5">
                        <i class="fas fa-edit text-[10px]"></i>
                        <span>Edit FAQs</span>
                    </a>
                    <a href="../<?php echo htmlspecialchars($row['file']); ?>" target="_blank" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-colors">
                        View
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($rows)): ?>
            <div class="p-8 text-center text-sm text-slate-500">No FAQ pages configured yet.</div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($unconfigured)): ?>
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-5 py-3.5 bg-slate-50 border-b border-slate-200">
            <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Add FAQs to another page</h3>
            <p class="text-[11px] text-slate-400 mt-0.5">Create a new FAQ section on any page. It appears automatically above the footer once you add questions.</p>
        </div>
        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            <?php foreach ($unconfigured as $p): ?>
            <a href="faq-edit.php?slug=<?php echo urlencode($p['slug']); ?>" class="group flex items-center justify-between gap-3 p-3 rounded-xl border border-slate-200 hover:border-brand-blue hover:bg-blue-50/40 transition-all">
                <span class="min-w-0">
                    <span class="block text-xs font-bold text-slate-800 group-hover:text-brand-blue truncate"><?php echo htmlspecialchars($p['title']); ?></span>
                    <span class="block text-[10px] text-slate-400 font-mono truncate"><?php echo htmlspecialchars($p['file']); ?></span>
                </span>
                <i class="fas fa-plus text-[10px] text-slate-400 group-hover:text-brand-blue flex-shrink-0"></i>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
