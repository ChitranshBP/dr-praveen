<?php
/**
 * Gallery Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('gallery', [
    'hero_badge' => 'Events, Conferences & Recognition',
    'hero_title' => 'Media & Event <span class="text-white font-normal">Gallery</span>',
    'hero_desc'  => 'Explore moments from Dr. Praveen Gupta\'s patient awareness workshops, national and international clinical conferences, and prestigious medical awards.',
    'hero_bg'    => 'assets/breadcrumbs/media.png'
]);
?>

<!-- Page Hero -->
<section class="relative overflow-hidden text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($pageContent['hero_bg']); ?>');">
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/85 to-electric-blue/30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Gallery</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-images text-[10px]"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>
        </div>
    </div>
</section>

<!-- Filterable Gallery Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-10" id="gallery-filters">
            <?php
            // Photos + categories are managed in CMS → Photo Gallery (categories: Settings → Lists & Categories)
            $galleryItems = cms_collection('gallery');
            $galleryCategories = cms_setting_options('gallery_categories', ['awards' => 'Awards & Recognition', 'clinical' => 'Clinical Events']);
            $usedCategories = [];
            foreach ($galleryItems as $gi) { $usedCategories[(string)($gi['category'] ?? '')] = true; }
            ?>
            <button class="filter-btn active px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-300 bg-electric-blue text-white border-electric-blue shadow-md" data-filter="all">
                All Photos
            </button>
            <?php foreach ($galleryCategories as $catKey => $catLabel): if (empty($usedCategories[$catKey])) continue; ?>
            <button class="filter-btn px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-300 bg-white text-dark-grey/70 border-slate-200 hover:border-electric-blue" data-filter="<?php echo htmlspecialchars($catKey); ?>">
                <?php echo htmlspecialchars($catLabel); ?>
            </button>
            <?php endforeach; ?>
        </div>

        <!-- Photos Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-grid">
            <?php foreach ($galleryItems as $gi):
                $giImage = cms_media_path($gi['image'] ?? '');
                if ($giImage === '') continue;
                $giCat = (string)($gi['category'] ?? '');
                $giCatLabel = $galleryCategories[$giCat] ?? $giCat;
                $giCaption = trim((string)($gi['caption'] ?? '')) !== '' ? $gi['caption'] : ($gi['title'] ?? '');
            ?>
            <div class="gallery-item <?php echo htmlspecialchars($giCat); ?> relative group overflow-hidden rounded-[24px] bg-slate-50 border border-slate-200/50 aspect-square shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="openLightbox(<?php echo htmlspecialchars(json_encode($giImage, JSON_UNESCAPED_SLASHES), ENT_QUOTES); ?>, <?php echo htmlspecialchars(json_encode((string)$giCaption, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), ENT_QUOTES); ?>)">
                <img src="<?php echo htmlspecialchars($giImage); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?php echo htmlspecialchars($gi['alt'] ?? $gi['title'] ?? ''); ?>" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <span class="text-xs text-cyan-accent font-bold uppercase tracking-wider"><?php echo htmlspecialchars($giCatLabel); ?></span>
                    <h4 class="text-white font-bold text-base mt-1"><?php echo htmlspecialchars($gi['title'] ?? ''); ?></h4>
                </div>
            </div>
            <?php endforeach; ?>
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
