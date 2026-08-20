<?php
/**
 * Video Testimonials Slider — reusable section component
 *
 * Renders $videoTestimonials (see includes/config.php) as a slider of vertical
 * 9:16 cards. Cards show a YouTube thumbnail and only swap in the player when
 * clicked, so a page carrying this section does not load N iframes up front.
 *
 * Usage — one line, anywhere between the header and footer includes:
 *     <?php require __DIR__ . '/includes/video-testimonials.php'; ?>
 *
 * Optional overrides, set before the require:
 *     $vtEyebrow   — badge label      (default "Video Testimonials")
 *     $vtHeading   — h2 HTML          (default "Hear It From Our Patients")
 *     $vtIntro     — subtitle copy
 *     $vtLimit     — max cards to show (default: all)
 *     $vtTheme     — 'dark' (default) or 'light'
 *     $vtShowCta   — false to hide the "Watch All" button
 *
 * Safe to include more than once per page — each instance gets its own id.
 */

if (!empty($videoTestimonials)) {

    $vtItems = isset($vtLimit) ? array_slice($videoTestimonials, 0, (int) $vtLimit) : $videoTestimonials;

    if (!empty($vtItems)):

        // Unique id per instance so two sliders on one page cannot collide
        $GLOBALS['vtInstanceCount'] = ($GLOBALS['vtInstanceCount'] ?? 0) + 1;
        $vtNum  = $GLOBALS['vtInstanceCount'];
        $vtId   = 'video-testimonials-slider-' . $vtNum;

        $vtEyebrow  = $vtEyebrow  ?? 'Video Testimonials';
        $vtHeading  = $vtHeading  ?? 'Hear It From Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-200 to-cyan-accent">Patients</span>';
        $vtIntro    = $vtIntro    ?? 'Watch patients share their recovery journeys with Dr. Praveen Gupta in their own words.';
        $vtShowCta  = $vtShowCta  ?? true;
        $dark       = (($vtTheme ?? 'dark') === 'dark');

        // Theme-dependent classes
        $secBg      = $dark ? 'bg-deep-indigo' : 'bg-soft-cyan/30';
        $badge      = $dark ? 'bg-white/10 backdrop-blur-md border border-white/20' : 'bg-electric-blue/10';
        $badgeIcon  = $dark ? 'text-cyan-accent' : 'text-electric-blue';
        $badgeText  = $dark ? 'text-white' : 'text-electric-blue';
        $headText   = $dark ? 'text-white' : 'text-deep-indigo';
        $introText  = $dark ? 'text-white/70' : 'text-dark-grey/70';
        $cardShell  = $dark ? 'bg-black/40 border-white/10' : 'bg-deep-indigo/5 border-silver-grey/50';
        $dotActive  = $dark ? 'bg-cyan-accent' : 'bg-electric-blue';
        $dotIdle    = $dark ? 'bg-white/30' : 'bg-silver-grey';
        $prevBtn    = $dark
            ? 'bg-white/10 hover:bg-white/20 text-white border-white/20 backdrop-blur-sm'
            : 'bg-white hover:bg-electric-blue hover:text-white text-deep-indigo border-silver-grey shadow-sm hover:shadow-lg';
        $nextBtn    = $dark
            ? 'bg-cyan-accent hover:bg-electric-blue text-white border-cyan-accent hover:border-electric-blue'
            : 'bg-electric-blue hover:bg-deep-indigo text-white border-electric-blue shadow-sm hover:shadow-lg';
        $ctaBtn     = $dark
            ? 'bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/50 text-white'
            : 'bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-deep-indigo hover:to-electric-blue text-white shadow-lg shadow-electric-blue/25 hover:shadow-xl hover:shadow-electric-blue/40 hover:-translate-y-0.5';
?>

<!-- ════════ Video Testimonials Slider ════════ -->
<section <?php echo $vtNum === 1 ? 'id="video-testimonials" ' : ''; ?>class="py-10 md:py-14 <?php echo $secBg; ?> relative overflow-hidden">
    <?php if ($dark): ?>
        <!-- Ambient glow -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-electric-blue/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-cyan-accent/10 rounded-full blur-3xl pointer-events-none"></div>
    <?php endif; ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 <?php echo $badge; ?> px-4 py-2 rounded-full mb-4">
                <i class="fas fa-play-circle <?php echo $badgeIcon; ?> text-sm"></i>
                <span class="<?php echo $badgeText; ?> text-sm font-semibold"><?php echo $vtEyebrow; ?></span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold <?php echo $headText; ?> mb-4">
                <?php echo $vtHeading; ?>
            </h2>
            <p class="text-lg <?php echo $introText; ?>">
                <?php echo $vtIntro; ?>
            </p>
        </div>

        <!-- Slider -->
        <div id="<?php echo $vtId; ?>" class="observe">
            <div class="overflow-hidden">
                <div class="flex -mx-4 transition-transform duration-500 ease-out" data-track>
                    <?php foreach ($vtItems as $video): ?>
                        <div class="w-[72%] sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 flex-shrink-0" data-slide>
                            <div class="group relative w-full aspect-[9/16] rounded-3xl overflow-hidden <?php echo $cardShell; ?> border shadow-xl hover:shadow-cyan-accent/20 hover:-translate-y-1.5 transition-all duration-500"
                                 data-video-card data-video-id="<?php echo $video['id']; ?>">

                                <img src="https://img.youtube.com/vi/<?php echo $video['id']; ?>/hqdefault.jpg"
                                     alt="<?php echo htmlspecialchars($video['title']); ?>"
                                     loading="lazy"
                                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                                <!-- Gradient overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-deep-indigo/90 via-deep-indigo/10 to-transparent"></div>

                                <!-- Play button -->
                                <button type="button" aria-label="Play <?php echo htmlspecialchars($video['title']); ?>"
                                    class="absolute inset-0 flex items-center justify-center focus:outline-none">
                                    <span class="w-16 h-16 rounded-full bg-white/15 backdrop-blur-md border border-white/40 flex items-center justify-center text-white text-xl shadow-lg group-hover:bg-cyan-accent group-hover:scale-110 transition-all duration-300">
                                        <i class="fas fa-play ml-1"></i>
                                    </span>
                                </button>

                                <!-- Caption -->
                                <div class="absolute bottom-0 left-0 right-0 p-5 pointer-events-none">
                                    <p class="text-white font-bold text-sm leading-snug"><?php echo htmlspecialchars($video['title']); ?></p>
                                    <p class="text-cyan-200 text-xs font-medium mt-1">Patient Testimonial</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Slider controls (hidden when every card already fits) -->
            <div class="flex items-center justify-between gap-6 mt-8" data-controls>
                <div class="flex items-center flex-wrap gap-2 flex-1 min-w-0" data-dots></div>
                <div class="flex items-center space-x-3 flex-shrink-0">
                    <button type="button" data-prev aria-label="Previous testimonials"
                        class="w-11 h-11 rounded-full border <?php echo $prevBtn; ?> transition-all duration-300 flex items-center justify-center active:scale-95">
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                    <button type="button" data-next aria-label="Next testimonials"
                        class="w-11 h-11 rounded-full border <?php echo $nextBtn; ?> transition-all duration-300 flex items-center justify-center active:scale-95">
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-10 observe">
                <a href="video-testimonials.php"
                   class="inline-flex items-center space-x-2.5 <?php echo $ctaBtn; ?> font-bold px-7 py-3.5 rounded-full transition-all duration-300">
                    <span>Watch All Video Testimonials</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    function initVideoTestimonials() {
        const root = document.getElementById('<?php echo $vtId; ?>');
        if (!root) return;

        const track    = root.querySelector('[data-track]');
        const slides   = Array.from(root.querySelectorAll('[data-slide]'));
        const dotsBox  = root.querySelector('[data-dots]');
        const controls = root.querySelector('[data-controls]');
        const prevBtn  = root.querySelector('[data-prev]');
        const nextBtn  = root.querySelector('[data-next]');
        if (!track || !slides.length) return;

        const ACTIVE = '<?php echo $dotActive; ?>';
        const IDLE   = '<?php echo $dotIdle; ?>';

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
                dot.setAttribute('aria-label', 'Go to testimonial ' + (i + 1));
                dot.className = 'w-2.5 h-2.5 rounded-full transition-all duration-300 ' + IDLE;
                dot.addEventListener('click', () => goTo(i));
                dotsBox.appendChild(dot);
            }
        }

        function paintDots() {
            Array.from(dotsBox.children).forEach((dot, i) => {
                dot.classList.toggle(ACTIVE, i === index);
                dot.classList.toggle('w-6', i === index);
                dot.classList.toggle(IDLE, i !== index);
            });
        }

        function goTo(i) {
            index = Math.min(Math.max(i, 0), maxIndex);
            track.style.transform = `translateX(-${slides[index].offsetLeft - slides[0].offsetLeft}px)`;
            paintDots();
        }

        function layout() {
            maxIndex = Math.max(0, slides.length - visibleCount());
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

        // Click-to-play: swap the thumbnail for the real player
        // Only one video plays at a time - pause all others first
        root.querySelectorAll('[data-video-card]').forEach(function (card) {
            card.addEventListener('click', function () {
                // Pause any currently playing video first
                document.querySelectorAll('[data-video-card]').forEach(function (c) {
                    c.dataset.playing = 'false';
                    // If the card has an iframe, remove it to pause the video
                    const existingIframe = c.querySelector('iframe');
                    if (existingIframe) {
                        existingIframe.remove();
                    }
                    c.classList.remove('playing');
                });
                if (card.dataset.playing === 'true') return;
                card.dataset.playing = 'true';
                card.innerHTML = '<iframe class="absolute inset-0 w-full h-full" '
                    + 'src="https://www.youtube.com/embed/' + card.dataset.videoId
                    + '?autoplay=1&rel=0&modestbranding=1&playsinline=1" '
                    + 'title="Patient video testimonial" frameborder="0" '
                    + 'allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" '
                    + 'allowfullscreen></iframe>';
                card.classList.add('playing');
            });
        });

        layout();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initVideoTestimonials);
    } else {
        initVideoTestimonials();
    }
})();
</script>
<?php
    endif;
}