<?php
/**
 * Blog Page - Dr. Praveen Gupta
 * Displays the latest blog posts
 */

require_once __DIR__ . '/includes/header.php';

// Blog posts data (from config)
$blogs = [
    [
        'title'    => 'Understanding Migraine: Causes & Modern Treatments',
        'excerpt'  => 'Migraines are more than headaches. Learn the neurological triggers and the latest preventive therapies available today.',
        'category' => 'Migraine',
        'date'     => 'Jun 10, 2025',
        'image'    => 'assets/services/migraine.png',
        'url'      => 'blog-post.php?title=understanding-migraine'
    ],
    [
        'title'    => 'Stroke Awareness: Act FAST to Save Lives',
        'excerpt'  => 'Recognising stroke symptoms early can prevent permanent damage. Know the FAST signs and when to call for emergency help.',
        'category' => 'Stroke',
        'date'     => 'May 28, 2025',
        'image'    => 'assets/services/stroke.png',
        'url'      => 'blog-post.php?title=stroke-awareness'
    ],
    [
        'title'    => 'Living with Parkinson\'s Disease: A Patient\'s Guide',
        'excerpt'  => 'From Deep Brain Stimulation to lifestyle strategies — explore how patients manage Parkinson\'s disease with quality of life.',
        'category' => 'Parkinson\'s',
        'date'     => 'May 14, 2025',
        'image'    => 'assets/services/parkinsons.png',
        'url'      => 'blog-post.php?title=parkinsons-disease'
    ],
];
// Simple pagination - show all blogs for now
$pageTitle = 'Blog - Dr. Praveen Gupta';
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
                Guidance on neurological conditions, treatments and recovery — written for patients and their families.
            </p>
        </div>

        <!-- 3-column card grid -->
        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none gap-6 pb-6 -mx-4 px-4 md:mx-0 md:px-0 md:grid md:grid-cols-3 md:gap-8 md:pb-0">
            <?php foreach ($blogs as $blogIdx => $blog): ?>
                <a href="<?php echo $blog['url']; ?>"
                   class="group bg-white rounded-3xl p-5 border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col observe w-[80vw] md:w-auto flex-shrink-0 snap-start"
                   style="animation-delay: <?php echo $blogIdx * 100; ?>ms;">

                    <!-- Image -->
                    <div class="w-full aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-soft-cyan to-silver-grey">
                        <img src="<?php echo $blog['image']; ?>"
                             alt="<?php echo htmlspecialchars($blog['title']); ?>"
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-bold text-deep-indigo leading-snug mb-3 group-hover:text-electric-blue transition-colors duration-300">
                        <?php echo $blog['title']; ?>
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-sm text-dark-grey/70 leading-relaxed mb-5 flex-1">
                        <?php echo $blog['excerpt']; ?>
                    </p>

                    <!-- Footer: category pill + date -->
                    <div class="mt-auto pt-4 border-t border-silver-grey/60 flex items-center space-x-4">
                        <span class="inline-block bg-electric-blue/10 text-electric-blue text-xs font-bold px-3 py-1.5 rounded-full">
                            <?php echo $blog['category']; ?>
                        </span>
                        <span class="text-xs text-dark-grey/45 font-medium"><?php echo $blog['date']; ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- Load more / Pagination -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="text-center">
        <p class="text-lg text-dark-grey/70">
            Read more neurological articles and stay updated with the latest insights.
        </p>
    </div>
</div>
</section>

<!-- ════════ Blog Single Post ════════ -->
<section class="py-10 md:py-14 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-newspaper text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Blog</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Latest <span class="gradient-text">Articles</span>
            </h2>
        </div>

        <!-- Blog Content -->
        <div class="prose mx-auto max-w-xl">
            <h1><?php echo $blog['title']; ?></h1>
            <p class="text-base text-dark-grey-600 mb-4">
                <?php echo $blog['excerpt']; ?>
            </p>
            <p class="text-base text-dark-grey-600 mb-6">
                Category: <?php echo $blog['category']; ?> | Date: <?php echo $blog['date']; ?>
            </p>
            <p>
                More content about <?php echo $blog['title']; ?> would go here...
            </p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>