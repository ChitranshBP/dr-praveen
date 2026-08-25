<?php
$pageTitle = 'All Website Pages';
require_once __DIR__ . '/includes/header.php';

$pagesCatalog = CMS_DB::get('pages_catalog', []);
$totalCount = count($pagesCatalog);

$categories = ['All', 'Services', 'Conditions', 'About Doctor', 'Patient Info', 'Media & Blog', 'Contact & Legal'];
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
                <p class="text-xs text-slate-500 mt-1">Search and click on any page to edit its title, hero header, images, and text content.</p>
            </div>
            
            <!-- Live Search Input -->
            <div class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                    <i class="fas fa-search text-xs"></i>
                </span>
                <input type="text" id="pageSearch" placeholder="Search any page (e.g. stroke, team, functional)..."
                       class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">
                <button id="clearSearch" type="button" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 hidden">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>
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

    <!-- Active Count Bar -->
    <div class="flex items-center justify-between text-xs text-slate-500 px-1 font-semibold">
        <span id="resultsCount">Showing all <?php echo $totalCount; ?> pages</span>
        <span class="text-[11px] text-slate-400">Click any card below to edit</span>
    </div>

    <!-- Search Results Grid -->
    <div id="pagesGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach ($pagesCatalog as $p): ?>
        <div class="page-card bg-white rounded-2xl border border-slate-200 shadow-sm p-5 flex flex-col justify-between hover:border-brand-blue hover:shadow-md transition-all group"
             data-title="<?php echo htmlspecialchars(strtolower($p['title'])); ?>"
             data-slug="<?php echo htmlspecialchars(strtolower($p['slug'])); ?>"
             data-file="<?php echo htmlspecialchars(strtolower($p['file'])); ?>"
             data-category="<?php echo htmlspecialchars($p['category']); ?>">
            <div>
                <div class="flex items-center justify-between mb-2.5">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-brand-blue">
                        <?php echo htmlspecialchars($p['category'] ?? 'Page'); ?>
                    </span>
                    <span class="text-[10px] text-slate-400 font-mono font-medium"><?php echo htmlspecialchars($p['file']); ?></span>
                </div>
                <h3 class="text-sm font-bold text-slate-900 group-hover:text-brand-blue transition-colors mb-1.5 line-clamp-1">
                    <?php echo htmlspecialchars($p['title']); ?>
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2 mb-4 leading-relaxed">
                    <?php echo htmlspecialchars($p['hero_desc'] ?? ''); ?>
                </p>
            </div>

            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="page-edit.php?slug=<?php echo urlencode($p['slug']); ?>" class="px-3.5 py-1.5 bg-brand-blue hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-sm flex items-center space-x-1.5">
                    <i class="fas fa-edit text-[10px]"></i>
                    <span>Edit Content</span>
                </a>
                <a href="../<?php echo htmlspecialchars($p['file']); ?>" target="_blank" class="text-slate-400 hover:text-slate-700 text-xs font-semibold flex items-center space-x-1">
                    <span>Live Page</span>
                    <i class="fas fa-external-link-alt text-[9px]"></i>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- No Results Message -->
    <div id="noResults" class="hidden bg-white p-12 rounded-3xl border border-slate-200 text-center">
        <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3 text-lg">
            <i class="fas fa-search"></i>
        </div>
        <p class="text-sm font-bold text-slate-800">No pages found matching your search</p>
        <p class="text-xs text-slate-400 mt-1">Try typing another keyword or select "All" categories.</p>
    </div>
</div>

<script>
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

    function filterCards() {
        let visibleCount = 0;
        const q = searchQuery.toLowerCase().trim();

        cards.forEach(card => {
            const title = card.getAttribute('data-title');
            const slug = card.getAttribute('data-slug');
            const file = card.getAttribute('data-file');
            const cat = card.getAttribute('data-category');

            const matchesCategory = (activeCategory === 'All' || cat === activeCategory);
            const matchesSearch = (!q || title.includes(q) || slug.includes(q) || file.includes(q));

            if (matchesCategory && matchesSearch) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        resultsCount.textContent = `Showing ${visibleCount} of ${total} pages`;
        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        clearBtn.style.display = q.length > 0 ? 'flex' : 'none';
    }

    searchInput.addEventListener('input', function(e) {
        searchQuery = e.target.value;
        filterCards();
    });

    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        searchQuery = '';
        filterCards();
        searchInput.focus();
    });

    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            categoryBtns.forEach(b => {
                b.className = 'category-filter-btn px-3.5 py-1.5 rounded-xl border transition-all whitespace-nowrap bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100';
            });
            this.className = 'category-filter-btn px-3.5 py-1.5 rounded-xl border transition-all whitespace-nowrap bg-brand-blue text-white border-brand-blue shadow-sm';
            activeCategory = this.getAttribute('data-category');
            filterCards();
        });
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
