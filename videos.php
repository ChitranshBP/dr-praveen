<?php
/**
 * Videos Hub Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

// Default featured video is the first one in the list
$featuredVideo = $educationVideos[0];
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/5"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Videos Hub</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fab fa-youtube text-red-500 text-[10px]"></i>
                <span>Educational Neurology Library</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Neurology Video <span class="text-white font-normal">Hub</span>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Watch detailed explanations, treatment overviews, and healthy brain guides directly from Dr. Praveen Gupta.
            </p>
        </div>
    </div>
</section>

<!-- Featured Video Player -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-8 items-center">
            <!-- Left Side: Interactive Video Player (7 columns) -->
            <div class="lg:col-span-8 bg-black rounded-[32px] overflow-hidden shadow-2xl border border-slate-200/40 aspect-video relative group">
                <iframe id="main-video-player" class="w-full h-full border-0" 
                        src="https://www.youtube.com/embed/<?php echo $featuredVideo['id']; ?>?rel=0&modestbranding=1" 
                        title="<?php echo htmlspecialchars($featuredVideo['title']); ?>" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen 
                        loading="lazy">
                </iframe>
            </div>

            <!-- Right Side: Video Details & YouTube Channel Link (4 columns) -->
            <div class="lg:col-span-4 space-y-6 lg:pl-6">
                <div>
                    <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Now Playing</span>
                    <h2 id="main-video-title" class="text-2xl md:text-3xl font-bold text-dark-grey mt-2 mb-3">
                        <?php echo $featuredVideo['title']; ?>
                    </h2>
                    <p id="main-video-desc" class="text-sm text-dark-grey/65 leading-relaxed">
                        <?php echo $featuredVideo['desc']; ?>
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-200/60">
                    <a href="<?php echo SOCIAL_YOUTUBE; ?>" target="_blank" class="w-full inline-flex items-center justify-center space-x-3 bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-red-600/20 transition-all duration-300">
                        <i class="fab fa-youtube text-lg animate-pulse"></i>
                        <span>Subscribe on YouTube</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Playlist Grid -->
<section class="py-12 bg-[#edf5f9] border-t border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-8">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Video Library</span>
            <h2 class="text-3xl font-bold text-dark-grey mt-2">All Patient Awareness Videos</h2>
        </div>

        <!-- Search and Filters Bar -->
        <div class="max-w-7xl mx-auto mb-8 space-y-4">
            <div class="grid md:grid-cols-12 gap-4 items-center">
                <!-- Search Input (5 columns) -->
                <div class="md:col-span-5 relative">
                    <label for="video-search" class="sr-only">Search Videos</label>
                    <input type="text" id="video-search" placeholder="Search videos by title or topic..." class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-2xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey" oninput="filterVideos()">
                    <span class="absolute left-4 top-3.5 text-dark-grey/40"><i class="fas fa-search text-xs"></i></span>
                </div>
                <!-- Filter Buttons (7 columns) -->
                <div class="md:col-span-7 flex flex-wrap gap-2 justify-start md:justify-end" id="category-filters">
                    <button class="filter-btn active px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-electric-blue text-white border-electric-blue" onclick="setCategory('all', this)">All</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('stroke', this)">Stroke</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('epilepsy', this)">Epilepsy</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('headache', this)">Headache</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('dementia', this)">Dementia</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('spine', this)">Spine/Nerve</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('rehab', this)">Rehab</button>
                    <button class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" onclick="setCategory('wellness', this)">Wellness</button>
                </div>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6" id="video-grid">
            <?php foreach ($educationVideos as $video):
                // Categories come from getVideoCategory() in includes/config.php
                $cat = getVideoCategory($video['title']);
            ?>
                <div class="video-card group bg-white rounded-2xl overflow-hidden border border-slate-200/50 shadow-sm hover:shadow-xl transition-all duration-400 cursor-pointer" 
                     data-category="<?php echo $cat; ?>" data-title="<?php echo htmlspecialchars(strtolower($video['title'])); ?>"
                     onclick="playVideo('<?php echo $video['id']; ?>', '<?php echo addslashes($video['title']); ?>', '<?php echo addslashes($video['desc']); ?>')">
                    
                    <!-- Video Thumbnail Cover -->
                    <div class="relative w-full aspect-video bg-dark-grey overflow-hidden">
                        <img src="https://img.youtube.com/vi/<?php echo $video['id']; ?>/hqdefault.jpg" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             alt="<?php echo htmlspecialchars($video['title']); ?>" 
                             loading="lazy">
                        <!-- Play Overlay Button -->
                        <div class="absolute inset-0 bg-black/35 group-hover:bg-black/50 transition-colors duration-300 flex items-center justify-center">
                            <div class="w-12 h-12 bg-white/90 group-hover:bg-electric-blue rounded-full flex items-center justify-center text-electric-blue group-hover:text-white shadow-lg transition-all duration-300 scale-95 group-hover:scale-100">
                                <i class="fas fa-play text-sm ml-0.5"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Content -->
                    <div class="p-4">
                        <span class="inline-block text-[9px] font-bold uppercase tracking-wider text-electric-blue px-2 py-0.5 bg-electric-blue/5 rounded-md mb-1.5">
                            <?php echo ucfirst($cat); ?>
                        </span>
                        <h3 class="font-bold text-deep-indigo text-sm leading-snug group-hover:text-electric-blue transition-colors duration-300 line-clamp-1">
                            <?php echo $video['title']; ?>
                        </h3>
                        <p class="text-xs text-dark-grey/55 leading-relaxed line-clamp-2 mt-1">
                            <?php echo $video['desc']; ?>
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
    </div>
</section>

<!-- Playlist Play and Filter Script with Pagination -->
<script>
let currentCategory = 'all';
const itemsPerPage = 12;
let currentPage = 1;
let filteredCards = [];

function playVideo(id, title, desc) {
    const player = document.getElementById('main-video-player');
    player.src = `https://www.youtube.com/embed/${id}?autoplay=1&rel=0&modestbranding=1`;
    
    document.getElementById('main-video-title').innerText = title;
    document.getElementById('main-video-desc').innerText = desc;
    
    // Smooth scroll to featured video player section
    window.scrollTo({
        top: player.closest('section').offsetTop - 100,
        behavior: 'smooth'
    });
}

function setCategory(cat, btn) {
    currentCategory = cat;
    
    // Toggle active classes on filter buttons
    document.querySelectorAll('#category-filters .filter-btn').forEach(b => {
        b.classList.remove('bg-electric-blue', 'text-white', 'border-electric-blue');
        b.classList.add('bg-white', 'text-dark-grey/70', 'border-slate-200');
    });
    btn.classList.add('bg-electric-blue', 'text-white', 'border-electric-blue');
    btn.classList.remove('bg-white', 'text-dark-grey/70', 'border-slate-200');
    
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
