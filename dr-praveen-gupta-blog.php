<?php
/**
 * Blog Hub Page - Dr. Praveen Gupta
 * Lists articles managed in the CMS (/cms/blogs.php).
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$posts = cms_blogs_published();
$categoryCounts = cms_blog_categories();

$pageTitle = 'Neurology Blog - Dr. Praveen Gupta';
$pageDescription = 'Expert guides, healthy lifestyle tips, and detailed neuro-health columns curated directly by Dr. Praveen Gupta.';
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/5"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Blog</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-book-open text-[10px]"></i>
                <span>Healthy Brain Guides &amp; Articles</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                The Neurology <span class="text-white font-normal">Blog</span>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Expert guides, healthy lifestyle tips, and detailed neuro-health columns curated directly by Dr. Praveen Gupta.
            </p>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-8">
            <!-- Left Side: Blog List (8 columns) -->
            <div class="lg:col-span-8 space-y-8">
                <?php if (empty($posts)): ?>
                <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-10 text-center">
                    <p class="text-dark-grey/60">New articles are coming soon. Please check back shortly.</p>
                </div>
                <?php else: ?>
                <?php foreach ($posts as $post):
                    $postUrl  = 'blog-post.php?slug=' . urlencode($post['slug'] ?? '');
                    $postDate = !empty($post['date']) ? date('F j, Y', strtotime($post['date'])) : '';
                ?>
                <article class="bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 grid md:grid-cols-12 gap-6 p-6">
                    <div class="md:col-span-5 aspect-video md:aspect-square bg-slate-200 rounded-2xl overflow-hidden">
                        <img src="<?php echo htmlspecialchars($post['image'] ?? 'assets/services/stroke.png'); ?>" width="640" height="480" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="<?php echo htmlspecialchars($post['title']); ?>" loading="lazy">
                    </div>
                    <div class="md:col-span-7 flex flex-col justify-between py-2">
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3 text-xs">
                                <span class="bg-electric-blue/10 text-electric-blue font-semibold px-2.5 py-1 rounded-md"><?php echo htmlspecialchars($post['category'] ?? 'Neurology'); ?></span>
                                <span class="text-dark-grey/40"><?php echo htmlspecialchars($postDate); ?></span>
                            </div>
                            <h3 class="text-xl font-bold text-dark-grey leading-snug hover:text-electric-blue transition-colors duration-300">
                                <a href="<?php echo $postUrl; ?>"><?php echo htmlspecialchars($post['title']); ?></a>
                            </h3>
                            <p class="text-sm text-dark-grey/65 leading-relaxed line-clamp-3">
                                <?php echo htmlspecialchars($post['excerpt'] ?? ''); ?>
                            </p>
                        </div>
                        <div class="pt-4 flex items-center justify-between text-xs text-dark-grey/50">
                            <span>By <?php echo htmlspecialchars($post['author'] ?? 'Dr. Praveen Gupta'); ?></span>
                            <a href="<?php echo $postUrl; ?>" class="font-semibold text-electric-blue hover:text-deep-indigo transition-colors">Read Article <i class="fas fa-chevron-right text-[8px] ml-1"></i></a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Right Side: Sidebar (4 columns) -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Sidebar Category Block -->
                <?php if (!empty($categoryCounts)): ?>
                <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-6 md:p-8">
                    <h4 class="font-bold text-dark-grey text-base mb-4 pb-2 border-b border-slate-200/80">Blog Categories</h4>
                    <ul class="space-y-3">
                        <?php foreach ($categoryCounts as $cat => $count): ?>
                        <li>
                            <a href="blog.php" class="flex justify-between items-center text-sm font-semibold text-dark-grey/70 hover:text-electric-blue transition-colors">
                                <span><?php echo htmlspecialchars($cat); ?></span>
                                <span class="bg-white border border-slate-200/60 px-2 py-0.5 rounded text-xs text-dark-grey/50"><?php echo (int)$count; ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- Newsletter Subscription -->
                <div class="bg-gradient-to-br from-deep-indigo to-dark-grey rounded-3xl p-6 md:p-8 text-white">
                    <h4 class="font-bold text-lg mb-2">Subscribe to Newsletter</h4>
                    <p class="text-xs text-white/70 leading-relaxed mb-6">
                        Stay updated with healthy brain guidelines and latest clinical updates.
                    </p>
                    <form class="space-y-3" accept-charset="UTF-8" action="api/save-lead.php" method="POST">
                        <input type="hidden" name="form_type" value="Blog Newsletter Subscription">
                        <input type="email" name="email" required placeholder="Your email address" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-cyan-accent text-sm text-white placeholder-white/40">
                        <button type="submit" class="w-full bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold py-3 rounded-xl hover:shadow-lg transition-all duration-300">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
