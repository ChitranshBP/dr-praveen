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
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Video Library</span>
            <h2 class="text-3xl font-bold text-dark-grey mt-2">All Patient Awareness Videos</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($educationVideos as $video): ?>
                <div class="group bg-white rounded-2xl overflow-hidden border border-slate-200/50 shadow-sm hover:shadow-xl transition-all duration-400 cursor-pointer" 
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
    </div>
</section>

<!-- Playlist Play Script -->
<script>
function playVideo(id, title, desc) {
    // Scroll smoothly to player
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
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
