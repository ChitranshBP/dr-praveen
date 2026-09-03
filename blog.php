<?php
/**
 * Blog Page - Dr. Praveen Gupta
 * Lists all published articles managed in the CMS (/cms/blogs.php).
 */

require_once __DIR__ . '/includes/header.php';

// Published posts from the CMS (newest first)
$posts = cms_blogs_published();

$pageTitle = 'Blog - Dr. Praveen Gupta, Neurologist';
$pageDescription = 'Articles and health guides on stroke, epilepsy, migraine, Parkinson\'s disease and brain health by Dr. Praveen Gupta.';
?>
<!-- Blog Section -->
<section class="py-10 md:py-14 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-newspaper text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Blogs</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Latest <span class="gradient-text">Articles</span>
            </h2>
            <p class="text-lg text-dark-grey/70">
                Guidance on neurological conditions, treatments and recovery &mdash; written for patients and their families.
            </p>
        </div>

        <?php if (empty($posts)): ?>
        <div class="text-center py-16">
            <p class="text-dark-grey/60">New articles are coming soon. Please check back shortly.</p>
        </div>
        <?php else: ?>
        <!-- 3-column card grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($posts as $blogIdx => $post):
                $postUrl  = 'blog-post?slug=' . urlencode($post['slug'] ?? '');
                $postDate = !empty($post['date']) ? date('M j, Y', strtotime($post['date'])) : '';
            ?>
                <a href="<?php echo $postUrl; ?>"
                   class="group bg-white rounded-3xl p-5 border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col observe"
                   style="animation-delay: <?php echo ($blogIdx % 6) * 100; ?>ms;">

                    <!-- Image -->
                    <div class="w-full aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-soft-cyan to-silver-grey">
                        <img src="<?php echo htmlspecialchars($post['image'] ?? 'assets/services/migraine.png'); ?>"
                             alt="<?php echo htmlspecialchars($post['title']); ?>"
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-bold text-deep-indigo leading-snug mb-3 group-hover:text-electric-blue transition-colors duration-300">
                        <?php echo htmlspecialchars($post['title']); ?>
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-sm text-dark-grey/70 leading-relaxed mb-5 flex-1">
                        <?php echo htmlspecialchars($post['excerpt'] ?? ''); ?>
                    </p>

                    <!-- Footer: category pill + date -->
                    <div class="mt-auto pt-4 border-t border-silver-grey/60 flex items-center space-x-4">
                        <span class="inline-block bg-electric-blue/10 text-electric-blue text-xs font-bold px-3 py-1.5 rounded-full">
                            <?php echo htmlspecialchars($post['category'] ?? 'Neurology'); ?>
                        </span>
                        <span class="text-xs text-dark-grey/45 font-medium"><?php echo htmlspecialchars($postDate); ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
