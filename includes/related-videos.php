<?php
/**
 * Related Videos Section
 *
 * Renders the education videos that match the current page, using the
 * $pageVideos topic map in config.php. Pages with no mapping render nothing.
 *
 * Usage â€” drop this line in just above the footer include:
 *     <?php require __DIR__ . '/includes/related-videos.php'; ?>
 *
 * Optional overrides, set before the require:
 *     $relatedVideosEyebrow  â€” badge label   (default "Video Guides")
 *     $relatedVideosHeading  â€” h2 HTML       (default "Watch & <spanâ€¦>Learn</span>")
 *     $relatedVideosIntro    â€” subtitle copy
 */

$currentPageFile = str_replace('.php', '', basename($_SERVER['PHP_SELF'] ?? ''));
$relatedIds      = $pageVideos[$currentPageFile] ?? [];

if (!empty($relatedIds) && !empty($educationVideos)) {

    // Resolve IDs to the full video records, preserving the order in the map
    $videosById    = array_column($educationVideos, null, 'id');
    $relatedVideos = [];
    foreach ($relatedIds as $relatedId) {
        if (isset($videosById[$relatedId])) {
            $relatedVideos[] = $videosById[$relatedId];
        }
    }

    if (!empty($relatedVideos)):
        $eyebrow = $relatedVideosEyebrow ?? 'Video Guides';
        $heading = $relatedVideosHeading ?? 'Watch & <span class="gradient-text">Learn</span>';
        $intro   = $relatedVideosIntro   ?? 'Dr. Praveen Gupta explains the essentials in plain language â€” what to look out for, the treatment options available, and what to expect.';
?>

<!-- â•â•â•â•â•â•â•â• Related Videos â•â•â•â•â•â•â•â• -->
<section class="py-10 md:py-14 bg-[#edf5f9] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-play-circle text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold"><?php echo $eyebrow; ?></span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                <?php echo $heading; ?>
            </h2>
            <p class="text-lg text-dark-grey/70">
                <?php echo $intro; ?>
            </p>
        </div>

        <!-- Video slider: 3 at a time on desktop, 2 on tablet, 1 on mobile -->
        <div id="related-videos-carousel" class="observe">
            <div class="overflow-hidden">
                <div class="flex -mx-4 transition-transform duration-500 ease-out" data-track>
                    <?php foreach ($relatedVideos as $video): ?>
                        <div class="w-full sm:w-1/2 lg:w-1/3 px-4 flex-shrink-0" data-slide>
                            <div class="group h-full bg-white rounded-3xl overflow-hidden border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 flex flex-col">

                                <!-- Embed -->
                                <div class="relative w-full aspect-video bg-dark-grey">
                                    <iframe
                                        class="w-full h-full"
                                        src="https://www.youtube.com/embed/<?php echo $video['id']; ?>?rel=0&modestbranding=1"
                                        title="<?php echo htmlspecialchars($video['title']); ?>"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                        loading="lazy">
                                    </iframe>
                                </div>

                                <!-- Card footer -->
                                <div class="p-5">
                                    <h3 class="font-bold text-deep-indigo text-base leading-snug mb-1.5 group-hover:text-electric-blue transition-colors duration-300">
                                        <?php echo $video['title']; ?>
                                    </h3>
                                    <p class="text-sm text-dark-grey/60 leading-relaxed line-clamp-2">
                                        <?php echo $video['desc']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Slider controls (hidden when every video already fits on screen) -->
            <div class="flex items-center justify-between gap-6 mt-8" data-controls>
                <div class="flex items-center flex-wrap gap-2 flex-1 min-w-0" data-dots></div>
                <div class="flex items-center space-x-3 flex-shrink-0">
                    <button type="button" data-prev aria-label="Previous videos"
                        class="w-11 h-11 rounded-full bg-white hover:bg-electric-blue hover:text-white text-deep-indigo border border-silver-grey shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                    <button type="button" data-next aria-label="Next videos"
                        class="w-11 h-11 rounded-full bg-electric-blue text-white hover:bg-deep-indigo border border-electric-blue shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center active:scale-95">
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const root = document.getElementById('related-videos-carousel');
            if (!root) return;

            const track    = root.querySelector('[data-track]');
            const slides   = Array.from(root.querySelectorAll('[data-slide]'));
            const dotsBox  = root.querySelector('[data-dots]');
            const controls = root.querySelector('[data-controls]');
            const prevBtn  = root.querySelector('[data-prev]');
            const nextBtn  = root.querySelector('[data-next]');
            if (!track || !slides.length) return;

            let index = 0, maxIndex = 0;

            function visibleCount() {
                const viewport = track.parentElement.clientWidth;
                const step = slides[0].offsetWidth;
                if (!step) return 1;
                return Math.max(1, Math.round(viewport / step));
            }

            function buildDots() {
                dotsBox.innerHTML = '';
                for (let i = 0; i <= maxIndex; i++) {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.setAttribute('aria-label', 'Go to video ' + (i + 1));
                    dot.className = 'w-2.5 h-2.5 rounded-full transition-all duration-300 bg-silver-grey';
                    dot.addEventListener('click', () => goTo(i));
                    dotsBox.appendChild(dot);
                }
            }

            function paintDots() {
                Array.from(dotsBox.children).forEach((dot, i) => {
                    dot.classList.toggle('bg-electric-blue', i === index);
                    dot.classList.toggle('w-6', i === index);
                    dot.classList.toggle('bg-silver-grey', i !== index);
                });
            }

            function goTo(i) {
                index = Math.min(Math.max(i, 0), maxIndex);
                track.style.transform = `translateX(-${slides[index].offsetLeft - slides[0].offsetLeft}px)`;
                paintDots();
            }

            function layout() {
                maxIndex = Math.max(0, slides.length - visibleCount());
                // Nothing to scroll â€” no point showing arrows or a single dot
                controls.classList.toggle('hidden', maxIndex === 0);
                buildDots();
                goTo(Math.min(index, maxIndex));
            }

            prevBtn.addEventListener('click', () => goTo(index === 0 ? maxIndex : index - 1));
            nextBtn.addEventListener('click', () => goTo(index >= maxIndex ? 0 : index + 1));

            // Touch / swipe
            let startX = 0;
            root.addEventListener('touchstart', (e) => { startX = e.changedTouches[0].screenX; }, { passive: true });
            root.addEventListener('touchend', (e) => {
                const delta = e.changedTouches[0].screenX - startX;
                if (Math.abs(delta) > 50) goTo(delta < 0 ? index + 1 : index - 1);
            }, { passive: true });

            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(layout, 150);
            });

            layout();
        });
        </script>

        <!-- CTA -->
        <div class="text-center mt-10 observe">
            <a href="neurology-video-library"
               class="inline-flex items-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:shadow-electric-blue/40 hover:-translate-y-0.5 transition-all duration-300">
                <span>Browse the Full Video Library</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>
</section>

<?php
    endif;
}
