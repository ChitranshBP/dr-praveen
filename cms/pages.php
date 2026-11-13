<?php
/**
 * All Website Pages — search / filter the page catalog, create brand-new
 * pages (rendered by page.php) and delete pages that were created here.
 */
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/cms-load.php';
require_once dirname(__DIR__) . '/includes/page-blocks.php';

cms_require_auth();

$pagesCatalog = CMS_DB::get('pages_catalog', []);
$categories = ['All', 'General', 'Services', 'Conditions', 'About Doctor', 'Patient Info', 'Media & Blog', 'Contact & Legal'];
$pagesDir = dirname(__DIR__) . '/data/pages';

$regenSitemap = function () {
    $sitemapGen = dirname(__DIR__) . '/includes/generate-sitemap.php';
    if (file_exists($sitemapGen)) {
        require_once $sitemapGen;
        if (function_exists('generate_sitemap_xml')) {
            @generate_sitemap_xml();
        }
    }
};
$writeJson = function ($file, $data) {
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if ($json === false) return false;
    $tmp = $file . '.tmp.' . uniqid();
    if (@file_put_contents($tmp, $json, LOCK_EX) === false) return false;
    if (!@rename($tmp, $file)) { @unlink($tmp); return false; }
    return true;
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = (string)($_POST['action'] ?? '');

    if ($action === 'create') {
        $title = trim((string)($_POST['title'] ?? ''));
        $slug = trim((string)($_POST['slug'] ?? ''));
        $slug = $slug !== '' ? $slug : $title;
        $slug = strtolower(cms_slugify($slug));
        $slug = trim(preg_replace('/[^a-z0-9-]+/', '-', $slug), '-');
        $category = trim((string)($_POST['category'] ?? 'General'));
        if (!in_array($category, array_slice($categories, 1), true)) $category = 'General';
        $source = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)($_POST['clone_from'] ?? ''));
        $reserved = ['cms', 'api', 'assets', 'data', 'includes', 'scripts', 'lp', 'enquire', 'blog', 'blog-post', 'page', 'index'];

        $error = '';
        if ($title === '') $error = 'Please give the page a title.';
        elseif ($slug === '' || strlen($slug) > 80) $error = 'The URL slug must be 1–80 characters of lowercase letters, numbers and hyphens.';
        elseif (in_array($slug, $reserved, true)) $error = 'That URL is reserved. Please choose another slug.';
        elseif (is_file(dirname(__DIR__) . '/' . $slug . '.php')) $error = 'A built-in page already uses this URL.';
        else {
            foreach ($pagesCatalog as $p) {
                if (is_array($p) && ($p['slug'] ?? '') === $slug) { $error = 'A page with this URL already exists.'; break; }
            }
        }

        if ($error !== '') {
            cms_set_flash('error', $error);
        } else {
            // 1. Catalog entry (sitemap, breadcrumbs, navigation picker, editor list)
            $pagesCatalog[] = [
                'slug' => $slug, 'file' => 'page.php', 'title' => $title, 'category' => $category,
                'hero_badge' => '', 'hero_title' => $title, 'hero_desc' => '', 'hero_bg' => '',
                'created_in_cms' => true, 'created_at' => date('Y-m-d H:i:s'),
            ];
            CMS_DB::set('pages_catalog', $pagesCatalog);

            // 2. Section defaults: blank starter or a copy of another page's sections
            $allBlocks = CMS_DB::get('page-blocks', []);
            $blocks = ['_flow' => true];
            if ($source !== '' && isset($allBlocks[$source]) && is_array($allBlocks[$source])) {
                foreach (cms_page_blocks($source) as $bKey => $bDef) {
                    if (!is_array($bDef) || strpos($bKey, '_') === 0) continue;
                    $blocks[$bKey] = $bDef;
                }
            } else {
                $blocks['intro'] = ['type' => 'intro', 'label' => 'Introduction', 'badge' => 'Overview', 'title' => $title, 'text' => 'Write the introduction for this page here.', 'options' => ['layout' => 'split']];
                $blocks['cta'] = ['type' => 'cta-simple', 'label' => 'Call to action', 'title' => 'Talk to Our Team', 'description' => 'Book a consultation or call the clinic for guidance.', 'button_text' => 'Book Appointment', 'button_url' => 'contact-us-top-neurologist-delhi-ncr'];
            }
            $allBlocks[$slug] = $blocks;
            CMS_DB::set('page-blocks', $allBlocks);

            // 3. Page JSON (banner copy, SEO, overrides)
            if (!is_dir($pagesDir)) @mkdir($pagesDir, 0755, true);
            $pageJson = [
                'slug' => $slug, 'file' => 'page.php', 'title' => $title, 'category' => $category,
                'hero_badge' => '', 'hero_title' => $title, 'hero_desc' => '', 'hero_bg' => '',
                'breadcrumb_label' => $title, 'meta_title' => $title . ' - ' . (defined('SITE_NAME') ? SITE_NAME : 'Dr. Praveen Gupta'),
                'meta_description' => '', 'created_in_cms' => true,
            ];
            if ($source !== '') {
                $srcJson = is_file($pagesDir . '/' . $source . '.json') ? (json_decode((string)file_get_contents($pagesDir . '/' . $source . '.json'), true) ?: []) : [];
                foreach (['hero_badge', 'hero_desc', 'hero_bg', 'hero_icon', 'breadcrumb_parent', 'ctas'] as $k) {
                    if (isset($srcJson[$k]) && $srcJson[$k] !== '') $pageJson[$k] = $srcJson[$k];
                }
            }
            $writeJson($pagesDir . '/' . $slug . '.json', $pageJson);
            $regenSitemap();
            cms_set_flash('success', 'Page "' . $title . '" created. Add its sections below, then link it from Navigation.');
            header('Location: page-edit.php?slug=' . urlencode($slug));
            exit;
        }
        header('Location: pages.php');
        exit;
    }

    if ($action === 'delete') {
        $slug = preg_replace('/[^a-z0-9-]/', '', (string)($_POST['slug'] ?? ''));
        $found = null;
        foreach ($pagesCatalog as $i => $p) {
            if (is_array($p) && ($p['slug'] ?? '') === $slug) { $found = $i; break; }
        }
        if ($found === null || empty($pagesCatalog[$found]['created_in_cms'])) {
            cms_set_flash('error', 'Only pages created in the CMS can be deleted here.');
        } else {
            array_splice($pagesCatalog, $found, 1);
            CMS_DB::set('pages_catalog', $pagesCatalog);
            $allBlocks = CMS_DB::get('page-blocks', []);
            unset($allBlocks[$slug]);
            CMS_DB::set('page-blocks', $allBlocks);
            @unlink($pagesDir . '/' . $slug . '.json');
            $regenSitemap();
            cms_set_flash('success', 'Page deleted. Remember to remove any menu links that pointed to it (Navigation).');
        }
        header('Location: pages.php');
        exit;
    }
}

$pageTitle = 'All Website Pages';
require_once __DIR__ . '/includes/header.php';
$totalCount = count($pagesCatalog);
$inp = 'w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none';
?>

<div class="space-y-6 max-w-7xl">
    <!-- Header & Search Bar -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-5">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-extrabold text-slate-900 flex items-center">
                    <i class="fas fa-file-alt text-brand-blue mr-2.5"></i>
                    <span>All Website Pages (<?php echo $totalCount; ?> Pages)</span>
                </h2>
                <p class="text-xs text-slate-500 mt-1">Search and click on any page to edit its banner, sections, images, buttons and SEO.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative w-full md:w-72">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none"><i class="fas fa-search text-xs"></i></span>
                    <input type="text" id="pageSearch" placeholder="Search any page (e.g. stroke, team, functional)..." class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">
                    <button id="clearSearch" type="button" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 hidden"><i class="fas fa-times text-xs"></i></button>
                </div>
                <button type="button" onclick="document.getElementById('new-page-panel').classList.toggle('hidden')" class="px-4 py-2.5 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-2xl shadow-sm whitespace-nowrap"><i class="fas fa-plus mr-1.5"></i> New page</button>
            </div>
        </div>

        <!-- New page form -->
        <div id="new-page-panel" class="hidden rounded-2xl border border-dashed border-brand-blue/40 bg-blue-50/40 p-5">
            <form method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                <?php echo cms_csrf_field(); ?>
                <input type="hidden" name="action" value="create">
                <div class="md:col-span-4">
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Page title</label>
                    <input type="text" name="title" required placeholder="e.g. Sleep Disorders Clinic" class="<?php echo $inp; ?>" oninput="pagesSlugPreview(this.value)">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">URL slug (optional)</label>
                    <input type="text" name="slug" id="new-page-slug" placeholder="sleep-disorders-clinic" pattern="[a-z0-9-]*" class="<?php echo $inp; ?> font-mono">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Category</label>
                    <select name="category" class="<?php echo $inp; ?>">
                        <?php foreach (array_slice($categories, 1) as $cat): ?><option value="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Start from</label>
                    <select name="clone_from" class="<?php echo $inp; ?>">
                        <option value="">Blank page (intro + call to action)</option>
                        <?php foreach ($pagesCatalog as $p): if (!is_array($p) || !cms_page_uses_flow((string)($p['slug'] ?? ''))) continue; ?>
                        <option value="<?php echo htmlspecialchars($p['slug']); ?>">Copy sections of: <?php echo htmlspecialchars($p['title'] ?? $p['slug']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="md:col-span-1">
                    <button type="submit" class="w-full px-4 py-2.5 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl">Create</button>
                </div>
                <p class="md:col-span-12 text-[11px] text-slate-500">The page goes live at <span class="font-mono">/<span id="new-page-slug-preview">your-slug</span></span> immediately, is added to the sitemap, and can be linked from <a href="navigation.php" class="text-brand-blue font-bold underline">Navigation</a>. Edit its sections on the next screen.</p>
            </form>
        </div>

        <!-- Category Filter Tabs -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-1 text-xs font-bold scrollbar-none">
            <?php foreach ($categories as $cat): ?>
            <button type="button" class="category-filter-btn px-3.5 py-1.5 rounded-xl border transition-all whitespace-nowrap <?php echo $cat === 'All' ? 'bg-brand-blue text-white border-brand-blue shadow-sm' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'; ?>" data-category="<?php echo htmlspecialchars($cat); ?>">
                <?php echo htmlspecialchars($cat); ?>
            </button>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="flex items-center justify-between text-xs text-slate-500 px-1 font-semibold">
        <span id="resultsCount">Showing all <?php echo $totalCount; ?> pages</span>
        <span class="text-[11px] text-slate-400">Click any card below to edit</span>
    </div>

    <div id="pagesGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach ($pagesCatalog as $p): if (!is_array($p)) continue; $isCms = !empty($p['created_in_cms']); $liveHref = $isCms ? '../' . rawurlencode((string)$p['slug']) : '../' . (string)($p['file'] ?? ''); ?>
        <div class="page-card bg-white rounded-2xl border border-slate-200 shadow-sm p-5 flex flex-col justify-between hover:border-brand-blue hover:shadow-md transition-all group"
             data-title="<?php echo htmlspecialchars(strtolower((string)($p['title'] ?? ''))); ?>"
             data-slug="<?php echo htmlspecialchars(strtolower((string)($p['slug'] ?? ''))); ?>"
             data-file="<?php echo htmlspecialchars(strtolower((string)($p['file'] ?? ''))); ?>"
             data-category="<?php echo htmlspecialchars((string)($p['category'] ?? '')); ?>">
            <div>
                <div class="flex items-center justify-between mb-2.5">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold <?php echo $isCms ? 'bg-emerald-50 text-emerald-700' : 'bg-blue-50 text-brand-blue'; ?>">
                        <?php echo htmlspecialchars($p['category'] ?? 'Page'); ?><?php echo $isCms ? ' · created in CMS' : ''; ?>
                    </span>
                    <span class="text-[10px] text-slate-400 font-mono font-medium">/<?php echo htmlspecialchars((string)($p['slug'] ?? '')); ?></span>
                </div>
                <h3 class="text-sm font-bold text-slate-900 group-hover:text-brand-blue transition-colors mb-1.5 line-clamp-1">
                    <?php echo htmlspecialchars((string)($p['title'] ?? '')); ?>
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2 mb-4 leading-relaxed">
                    <?php echo htmlspecialchars((string)($p['hero_desc'] ?? '')); ?>
                </p>
            </div>

            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="page-edit.php?slug=<?php echo urlencode((string)$p['slug']); ?>" class="px-3.5 py-1.5 bg-brand-blue hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-sm flex items-center space-x-1.5">
                    <i class="fas fa-edit text-[10px]"></i>
                    <span>Edit Content</span>
                </a>
                <div class="flex items-center gap-3">
                    <?php if ($isCms): ?>
                    <form method="POST" onsubmit="return confirm('Delete this page and all its sections? Links to it will stop working.');">
                        <?php echo cms_csrf_field(); ?>
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="slug" value="<?php echo htmlspecialchars((string)$p['slug']); ?>">
                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-semibold"><i class="fas fa-trash-alt text-[9px] mr-1"></i>Delete</button>
                    </form>
                    <?php endif; ?>
                    <a href="<?php echo htmlspecialchars($liveHref); ?>" target="_blank" class="text-slate-400 hover:text-slate-700 text-xs font-semibold flex items-center space-x-1">
                        <span>Live Page</span>
                        <i class="fas fa-external-link-alt text-[9px]"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div id="noResults" class="hidden bg-white p-12 rounded-3xl border border-slate-200 text-center">
        <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3 text-lg"><i class="fas fa-search"></i></div>
        <p class="text-sm font-bold text-slate-800">No pages found matching your search</p>
        <p class="text-xs text-slate-400 mt-1">Try typing another keyword or select "All" categories.</p>
    </div>
</div>

<script>
function pagesSlugPreview(v) {
    const s = v.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
    const slugInput = document.getElementById('new-page-slug');
    document.getElementById('new-page-slug-preview').textContent = (slugInput.value || s || 'your-slug');
}
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('pageSearch');
    const clearBtn = document.getElementById('clearSearch');
    const categoryBtns = document.querySelectorAll('.category-filter-btn');
    const cards = document.querySelectorAll('.page-card');
    const resultsCount = document.getElementById('resultsCount');
    const noResults = document.getElementById('noResults');
    const total = cards.length;
    let activeCategory = 'All';
    let searchQuery = '';
    document.getElementById('new-page-slug').addEventListener('input', function () { pagesSlugPreview(this.value); });

    function filterCards() {
        let visibleCount = 0;
        const q = searchQuery.toLowerCase().trim();
        cards.forEach(card => {
            const matchesCategory = (activeCategory === 'All' || card.getAttribute('data-category') === activeCategory);
            const matchesSearch = (!q || card.getAttribute('data-title').includes(q) || card.getAttribute('data-slug').includes(q) || card.getAttribute('data-file').includes(q));
            card.style.display = (matchesCategory && matchesSearch) ? 'flex' : 'none';
            if (matchesCategory && matchesSearch) visibleCount++;
        });
        resultsCount.textContent = `Showing ${visibleCount} of ${total} pages`;
        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        clearBtn.style.display = q.length > 0 ? 'flex' : 'none';
    }
    searchInput.addEventListener('input', function(e) { searchQuery = e.target.value; filterCards(); });
    clearBtn.addEventListener('click', function() { searchInput.value = ''; searchQuery = ''; filterCards(); searchInput.focus(); });
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            categoryBtns.forEach(b => { b.className = 'category-filter-btn px-3.5 py-1.5 rounded-xl border transition-all whitespace-nowrap bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'; });
            this.className = 'category-filter-btn px-3.5 py-1.5 rounded-xl border transition-all whitespace-nowrap bg-brand-blue text-white border-brand-blue shadow-sm';
            activeCategory = this.getAttribute('data-category');
            filterCards();
        });
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
