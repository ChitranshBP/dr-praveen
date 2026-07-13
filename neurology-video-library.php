<?php
/**
 * Education Video Library - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

// Helper function to tag categories dynamically
function getVideoCategory($title) {
    $t = strtolower($title);
    if (strpos($t, 'stroke') !== false || strpos($t, 'tia') !== false) return 'stroke';
    if (strpos($t, 'epilepsy') !== false || strpos($t, 'seizure') !== false) return 'epilepsy';
    if (strpos($t, 'headache') !== false || strpos($t, 'migraine') !== false) return 'headache';
    if (strpos($t, 'dementia') !== false || strpos($t, 'alzheimer') !== false || strpos($t, 'memory') !== false) return 'dementia';
    if (strpos($t, 'spine') !== false || strpos($t, 'back pain') !== false || strpos($t, 'neck pain') !== false || strpos($t, 'spondylosis') !== false || strpos($t, 'nerve') !== false || strpos($t, 'neuropathy') !== false || strpos($t, 'sciatica') !== false) return 'spine';
    return 'wellness';
}
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Video Library</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-video text-cyan-accent text-[10px]"></i>
                <span>Educational Neurology Library</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Neurology <span class="text-cyan-accent">Video Library</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Explore clinical explanations, medical guidelines, and diagnostic insights shared directly by Dr. Praveen Gupta.
            </p>
        </div>
    </div>
</section>

<!-- Videos Grid Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search and Filters Bar -->
        <div class="max-w-5xl mx-auto mb-10 space-y-6">
            <div class="grid md:grid-cols-12 gap-4 items-center">
                <!-- Search Input (5 columns) -->
                <div class="md:col-span-5 relative">
                    <label for="video-search" class="sr-only">Search Videos</label>
                    <input type="text" id="video-search" placeholder="Search videos by title or topic..." class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey" oninput="filterVideos()">
                    <span class="absolute left-4 top-3.5 text-dark-grey/40"><i class="fas fa-search text-xs"></i></span>
                </div>
                <!-- Filter Buttons (7 columns) -->
                <div class="md:col-span-7 flex flex-wrap gap-2 justify-start md:justify-end" id="category-filters">
                    <button class="filter-btn active px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-electric-blue text-white border-electric-blue" onclick="setCategory('all', this)">All</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-slate-50 text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('stroke', this)">Stroke</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-slate-50 text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('epilepsy', this)">Epilepsy</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-slate-50 text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('headache', this)">Headache</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-slate-50 text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('dementia', this)">Dementia</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-slate-50 text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('spine', this)">Spine/Nerve</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-slate-50 text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('wellness', this)">Wellness</button>
                </div>
            </div>
        </div>

        <?php if (isset($educationVideos) && !empty($educationVideos)): ?>
            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto" id="video-grid">
                <?php foreach ($educationVideos as $vid): 
                    $cat = getVideoCategory($vid['title']);
                ?>
                    <div class="video-card bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300" data-category="<?php echo $cat; ?>" data-title="<?php echo htmlspecialchars(strtolower($vid['title'])); ?>">
                        <!-- Dynamic Iframe Loader Wrapper (Performance Optimized) -->
                        <div class="relative aspect-video bg-black cursor-pointer group" onclick="loadPlayer(this, '<?php echo $vid['id']; ?>')">
                            <!-- Thumbnail -->
                            <img src="https://img.youtube.com/vi/<?php echo $vid['id']; ?>/hqdefault.jpg" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102" alt="<?php echo htmlspecialchars($vid['title']); ?>" loading="lazy">
                            <!-- Play Overlay -->
                            <div class="absolute inset-0 bg-black/25 group-hover:bg-black/45 transition-colors duration-300 flex items-center justify-center">
                                <div class="w-14 h-14 bg-white/95 group-hover:bg-electric-blue rounded-full flex items-center justify-center text-electric-blue group-hover:text-white shadow-xl transition-all duration-300 transform scale-95 group-hover:scale-100">
                                    <i class="fas fa-play text-lg ml-0.5 animate-pulse"></i>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 space-y-2">
                            <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-electric-blue px-2 py-0.5 bg-electric-blue/5 rounded-md">
                                <?php echo ucfirst($cat); ?>
                            </span>
                            <h3 class="text-base font-bold text-deep-indigo leading-snug">
                                <?php echo $vid['title']; ?>
                            </h3>
                            <p class="text-xs text-dark-grey/65 leading-relaxed">
                                <?php echo $vid['desc']; ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination Controls -->
            <div id="pagination-controls" class="flex justify-center items-center space-x-2 mt-12"></div>
            
            <!-- Empty Results Alert -->
            <div id="no-results" class="hidden text-center py-12 max-w-md mx-auto space-y-3">
                <i class="fas fa-video-slash text-4xl text-dark-grey/30"></i>
                <h4 class="font-bold text-dark-grey">No matching videos found</h4>
                <p class="text-xs text-dark-grey/55">Try adjusting your search keywords or choosing a different category filter above.</p>
            </div>
        <?php else: ?>
            <p class="text-center text-xs text-dark-grey/55">No educational videos available in site configuration.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Video Player & Filter Logic with Pagination -->
<script>
let currentCategory = 'all';
const itemsPerPage = 8;
let currentPage = 1;
let filteredCards = [];

function loadPlayer(container, videoId) {
    container.innerHTML = `
        <iframe 
            class="absolute inset-0 w-full h-full" 
            src="https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0" 
            title="YouTube video player" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            allowfullscreen>
        </iframe>
    `;
    container.removeAttribute('onclick');
}

function setCategory(cat, btn) {
    currentCategory = cat;
    
    // Toggle active classes on filter buttons
    document.querySelectorAll('#category-filters .filter-btn').forEach(b => {
        b.classList.remove('bg-electric-blue', 'text-white', 'border-electric-blue');
        b.classList.add('bg-slate-50', 'text-dark-grey/70', 'border-slate-200');
    });
    btn.classList.add('bg-electric-blue', 'text-white', 'border-electric-blue');
    btn.classList.remove('bg-slate-50', 'text-dark-grey/70', 'border-slate-200');
    
    currentPage = 1;
    filterVideos();
}

function filterVideos() {
    const searchVal = document.getElementById('video-search').value.toLowerCase().trim();
    const cards = document.querySelectorAll('#video-grid .video-card');
    filteredCards = [];
    
    cards.forEach(card => {
        const title = card.getAttribute('data-title');
        const cat = card.getAttribute('data-category');
        
        const matchesCategory = (currentCategory === 'all' || cat === currentCategory);
        const matchesSearch = (searchVal === '' || title.includes(searchVal));
        
        if (matchesCategory && matchesSearch) {
            filteredCards.push(card);
        } else {
            card.classList.add('hidden');
        }
    });
    
    // Show/hide no results alert
    const alert = document.getElementById('no-results');
    if (filteredCards.length === 0) {
        alert.classList.remove('hidden');
        document.getElementById('pagination-controls').classList.add('hidden');
    } else {
        alert.classList.add('hidden');
        document.getElementById('pagination-controls').classList.remove('hidden');
        renderPagination();
    }
}

function renderPagination() {
    const totalPages = Math.ceil(filteredCards.length / itemsPerPage);
    const container = document.getElementById('pagination-controls');
    container.innerHTML = '';
    
    if (totalPages <= 1) {
        filteredCards.forEach(card => card.classList.remove('hidden'));
        container.classList.add('hidden');
        return;
    }
    
    container.classList.remove('hidden');
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    
    filteredCards.forEach((card, idx) => {
        if (idx >= startIndex && idx < endIndex) {
            card.classList.remove('hidden');
        } else {
            card.classList.add('hidden');
        }
    });
    
    // Prev button
    const prevBtn = document.createElement('button');
    prevBtn.className = `px-3 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 ${currentPage === 1 ? 'bg-slate-100 text-dark-grey/30 border-slate-200 cursor-not-allowed' : 'bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue'}`;
    prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
    if (currentPage > 1) {
        prevBtn.onclick = () => { currentPage--; renderPagination(); scrollToGrid(); };
    }
    container.appendChild(prevBtn);
    
    // Page Numbers (sliding window if many pages)
    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(totalPages, startPage + 4);
    if (endPage - startPage < 4) {
        startPage = Math.max(1, endPage - 4);
    }
    
    if (startPage > 1) {
        const firstBtn = document.createElement('button');
        firstBtn.className = `w-9 h-9 rounded-xl text-xs font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue`;
        firstBtn.innerText = '1';
        firstBtn.onclick = () => { currentPage = 1; renderPagination(); scrollToGrid(); };
        container.appendChild(firstBtn);
        
        if (startPage > 2) {
            const dots = document.createElement('span');
            dots.className = 'text-dark-grey/40 text-xs px-1';
            dots.innerText = '...';
            container.appendChild(dots);
        }
    }
    
    for (let i = startPage; i <= endPage; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.className = `w-9 h-9 rounded-xl text-xs font-semibold border transition-all duration-300 ${i === currentPage ? 'bg-electric-blue text-white border-electric-blue' : 'bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue'}`;
        pageBtn.innerText = i;
        pageBtn.onclick = () => { currentPage = i; renderPagination(); scrollToGrid(); };
        container.appendChild(pageBtn);
    }
    
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            const dots = document.createElement('span');
            dots.className = 'text-dark-grey/40 text-xs px-1';
            dots.innerText = '...';
            container.appendChild(dots);
        }
        const lastBtn = document.createElement('button');
        lastBtn.className = `w-9 h-9 rounded-xl text-xs font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue`;
        lastBtn.innerText = totalPages;
        lastBtn.onclick = () => { currentPage = totalPages; renderPagination(); scrollToGrid(); };
        container.appendChild(lastBtn);
    }
    
    // Next button
    const nextBtn = document.createElement('button');
    nextBtn.className = `px-3 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 ${currentPage === totalPages ? 'bg-slate-100 text-dark-grey/30 border-slate-200 cursor-not-allowed' : 'bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue'}`;
    nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
    if (currentPage < totalPages) {
        nextBtn.onclick = () => { currentPage++; renderPagination(); scrollToGrid(); };
    }
    container.appendChild(nextBtn);
}

function scrollToGrid() {
    const grid = document.getElementById('video-grid');
    window.scrollTo({
        top: grid.offsetTop - 120,
        behavior: 'smooth'
    });
}

// Initial Run
window.addEventListener('DOMContentLoaded', () => {
    filterVideos();
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
