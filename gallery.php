<?php
/**
 * Gallery Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
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
                <span class="text-white font-medium">Gallery</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-images text-[10px]"></i>
                <span>Events, Conferences & Recognition</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Media & Event <span class="text-white font-normal">Gallery</span>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Explore moments from Dr. Praveen Gupta's patient awareness workshops, national and international clinical conferences, and prestigious medical awards.
            </p>
        </div>
    </div>
</section>

<!-- Filterable Gallery Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-10" id="gallery-filters">
            <button class="filter-btn active px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-300 bg-electric-blue text-white border-electric-blue shadow-md" data-filter="all">
                All Photos
            </button>
            <button class="filter-btn px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" data-filter="awards">
                Awards & Recognition
            </button>
            <button class="filter-btn px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" data-filter="clinical">
                Clinical Events
            </button>
        </div>

        <!-- Photos Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-grid">
            <!-- Award 1 -->
            <div class="gallery-item awards relative group overflow-hidden rounded-[24px] bg-slate-50 border border-slate-200/50 aspect-square shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="openLightbox('assets/awards/AWARD-PRAVEEN.webp', 'Dr. Praveen Gupta receiving national neurology award.')">
                <img src="assets/awards/AWARD-PRAVEEN.webp" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Award Ceremony" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <span class="text-xs text-cyan-accent font-bold uppercase tracking-wider">Award & Recognition</span>
                    <h4 class="text-white font-bold text-base mt-1">Academic Excellence Award</h4>
                </div>
            </div>

            <!-- Award 2 -->
            <div class="gallery-item awards relative group overflow-hidden rounded-[24px] bg-slate-50 border border-slate-200/50 aspect-square shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="openLightbox('assets/awards/1.jpg', 'Award presentation ceremony.')">
                <img src="assets/awards/1.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Award 1" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <span class="text-xs text-cyan-accent font-bold uppercase tracking-wider">Award & Recognition</span>
                    <h4 class="text-white font-bold text-base mt-1">Outstanding Contribution in Neurology</h4>
                </div>
            </div>

            <!-- Award 3 -->
            <div class="gallery-item awards relative group overflow-hidden rounded-[24px] bg-slate-50 border border-slate-200/50 aspect-square shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="openLightbox('assets/awards/2.jpg', 'Dr. Praveen Gupta receiving certification of honor.')">
                <img src="assets/awards/2.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Award 2" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <span class="text-xs text-cyan-accent font-bold uppercase tracking-wider">Award & Recognition</span>
                    <h4 class="text-white font-bold text-base mt-1">Neurology Leadership Award</h4>
                </div>
            </div>

            <!-- Award 4 -->
            <div class="gallery-item awards relative group overflow-hidden rounded-[24px] bg-slate-50 border border-slate-200/50 aspect-square shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="openLightbox('assets/awards/3.jpg', 'Conference Keynote Award.')">
                <img src="assets/awards/3.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Award 3" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <span class="text-xs text-cyan-accent font-bold uppercase tracking-wider">Award & Recognition</span>
                    <h4 class="text-white font-bold text-base mt-1">Stroke Awareness Champion</h4>
                </div>
            </div>

            <!-- Clinical 1 -->
            <div class="gallery-item clinical relative group overflow-hidden rounded-[24px] bg-slate-50 border border-slate-200/50 aspect-square shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="openLightbox('assets/awards/4.jpg', 'Patient support group meeting.')">
                <img src="assets/awards/4.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Clinical Event 1" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <span class="text-xs text-cyan-accent font-bold uppercase tracking-wider">Clinical Event</span>
                    <h4 class="text-white font-bold text-base mt-1">Brain Stroke Support Group</h4>
                </div>
            </div>

            <!-- Clinical 2 -->
            <div class="gallery-item clinical relative group overflow-hidden rounded-[24px] bg-slate-50 border border-slate-200/50 aspect-square shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="openLightbox('assets/awards/5.jpg', 'Neurology awareness seminar.')">
                <img src="assets/awards/5.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Clinical Event 2" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <span class="text-xs text-cyan-accent font-bold uppercase tracking-wider">Clinical Event</span>
                    <h4 class="text-white font-bold text-base mt-1">Gurgaon Neurology Seminar</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black/95 z-[9999] hidden flex flex-col items-center justify-center p-4">
    <!-- Close Button -->
    <button class="absolute top-6 right-6 text-white hover:text-cyan-accent text-3xl focus:outline-none" onclick="closeLightbox()">
        <i class="fas fa-times"></i>
    </button>
    
    <!-- Image -->
    <div class="max-w-4xl max-h-[80vh] flex items-center justify-center overflow-hidden">
        <img id="lightbox-img" src="" class="max-w-full max-h-full object-contain rounded-xl shadow-2xl" alt="Enlarged gallery photo">
    </div>
    
    <!-- Caption -->
    <p id="lightbox-caption" class="text-white/80 text-sm mt-6 max-w-2xl text-center font-medium"></p>
</div>

<!-- Gallery Scripts -->
<script>
    // Filter logic
    document.querySelectorAll('#gallery-filters .filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active styles from all buttons
            document.querySelectorAll('#gallery-filters .filter-btn').forEach(b => {
                b.classList.remove('bg-electric-blue', 'text-white', 'border-electric-blue', 'shadow-md');
                b.classList.add('bg-white', 'text-dark-grey/70', 'border-slate-200');
            });
            
            // Add active styles to clicked button
            btn.classList.add('bg-electric-blue', 'text-white', 'border-electric-blue', 'shadow-md');
            btn.classList.remove('bg-white', 'text-dark-grey/70', 'border-slate-200');
            
            const filter = btn.getAttribute('data-filter');
            document.querySelectorAll('#gallery-grid .gallery-item').forEach(item => {
                if (filter === 'all' || item.classList.contains(filter)) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });

    // Lightbox logic
    function openLightbox(src, caption) {
        const modal = document.getElementById('lightbox');
        const img = document.getElementById('lightbox-img');
        const cap = document.getElementById('lightbox-caption');
        
        img.src = src;
        cap.innerText = caption;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
    
    // Close lightbox on Escape key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeLightbox();
    });
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
