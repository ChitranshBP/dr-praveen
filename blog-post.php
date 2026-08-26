<?php
/**
 * Blog Single Post Page - Dr. Praveen Gupta
 * Renders an article managed in the CMS (/cms/blogs.php) by slug.
 * Legacy ?title=<old-slug> URLs still resolve to the original built-in posts.
 */

// Accept both ?slug= and legacy ?title=
$slug = trim((string)($_GET['slug'] ?? $_GET['title'] ?? 'understanding-migraine'));

// Load CMS readers before looking up the post
require_once __DIR__ . '/includes/cms-load.php';

// Legacy built-in posts (kept so old links never break)
$legacyBlogs = [
    'understanding-migraine' => [
        'title'    => 'Understanding Migraine: Causes & Modern Treatments',
        'excerpt'  => 'Migraines are more than headaches. Learn the neurological triggers and the latest preventive therapies available today.',
        'content'  => 'Migraines are more than just severe headaches. They are a complex neurological condition that affects millions of people worldwide. In this comprehensive guide, we explore the various triggers that can bring on a migraine attack, from stress and hormonal changes to dietary factors and environmental stimuli.

We also cover the latest preventive therapies available today, including:
- New pharmaceutical medications designed to reduce migraine frequency
- Non-drug approaches like neuromodulation devices
- Lifestyle modifications and trigger management strategies
- Emerging treatments like CGRP inhibitors

Whether you suffer from occasional migraines or chronic daily headaches, this article provides valuable insights into understanding your condition and the modern treatment options that can help you regain control of your health.',
        'category' => 'Migraine',
        'date'     => '2025-06-10',
        'image'    => 'assets/services/migraine.png',
        'author'   => 'Dr. Praveen Gupta',
    ],
    'stroke-awareness' => [
        'title'    => 'Stroke Awareness: Act FAST to Save Lives',
        'excerpt'  => 'Recognising stroke symptoms early can prevent permanent damage. Know the FAST signs and when to call for emergency help.',
        'content'  => 'Stroke is a medical emergency that occurs when blood flow to part of the brain is interrupted. Every minute counts during a stroke, and recognizing the signs early can mean the difference between recovery and permanent disability.

In this article, we explain the FAST acronym which stands for:
- **F**ace drooping: Does one side of the face droop or is it numb?
- **A**rm weakness: Is one arm weak or numb?
- **S**peech difficulty: Is speech slurred, or are they unable to speak?
- **T**ime to call emergency services: If any of these signs are present, time is critical.

We also cover other less common stroke symptoms, risk factors to watch for, and what to do immediately after recognizing a stroke. Time is brain - every minute without treatment, millions of neurons are lost. Learn when to call for emergency help and how to act FAST to save a life.',
        'category' => 'Stroke',
        'date'     => '2025-05-28',
        'image'    => 'assets/services/stroke.png',
        'author'   => 'Dr. Praveen Gupta',
    ],
    'parkinsons-disease' => [
        'title'    => 'Living with Parkinson\'s Disease: A Patient\'s Guide',
        'excerpt'  => 'From Deep Brain Stimulation to lifestyle strategies — explore how patients manage Parkinson\'s disease with quality of life.',
        'content'  => 'Parkinson\'s disease is a progressive neurological disorder that affects movement, but with proper management, patients can maintain a good quality of life for years. This guide explores:

- **Medication management**: How different medications work and when to adjust them
- **Deep Brain Stimulation (DBS)**: An overview of this surgical option for advanced cases
- **Physical therapy**: Exercises to maintain mobility, balance, and coordination
- **Occupational therapy**: Strategies for adapting daily activities
- **Lifestyle adjustments**: Diet, exercise, and sleep strategies
- **Support systems**: Building a strong support network and accessing resources

Whether you\'ve recently been diagnosed or have been living with Parkinson\'s for years, this article provides practical advice and hope for maintaining the best possible quality of life.',
        'category' => 'Parkinson\'s',
        'date'     => '2025-05-14',
        'image'    => 'assets/services/parkinsons.png',
        'author'   => 'Dr. Praveen Gupta',
    ],
];

// 1) Try the CMS first, 2) fall back to legacy posts, 3) finally default
$post = cms_blog_find_by_slug($slug);
$isCmsPost = ($post !== null);
if (!$post) {
    $post = $legacyBlogs[$slug] ?? null;
}
if (!$post) {
    // Unknown slug -> show the default article instead of a broken page
    $post = cms_blogs_published()[0] ?? $legacyBlogs['understanding-migraine'];
    $isCmsPost = array_key_exists('id', $post); // CMS rows carry ids
}

$postDate = !empty($post['date']) ? date('F j, Y', strtotime($post['date'])) : '';
$pageTitle       = $post['title'] . ' - Dr. Praveen Gupta, Neurologist';
$pageDescription = $post['excerpt'] ?? '';
$canonicalPath   = 'blog-post.php?slug=' . ($post['slug'] ?? $slug);

require_once __DIR__ . '/includes/header.php';
?>
<!-- Blog Single Post -->
<section class="py-10 md:py-14 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-newspaper text-electric-blue text-sm"></i>
                <a href="dr-praveen-gupta-blog" class="text-electric-blue text-sm font-semibold hover:underline">Blog</a>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                Latest <span class="gradient-text">Articles</span>
            </h2>
        </div>

        <!-- Blog Content -->
        <article class="prose mx-auto max-w-xl lg:max-w-2xl">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-6 leading-tight">
                <?php echo htmlspecialchars($post['title']); ?>
            </h1>

            <?php if (!empty($pageDescription)): ?>
            <p class="text-base text-dark-grey/70 italic mb-6">
                <?php echo htmlspecialchars($pageDescription); ?>
            </p>
            <?php endif; ?>

            <!-- Featured Image -->
            <?php if (!empty($post['image'])): ?>
            <div class="w-full rounded-3xl overflow-hidden mb-8">
                <img src="<?php echo htmlspecialchars($post['image']); ?>"
                     alt="<?php echo htmlspecialchars($post['title']); ?>"
                     width="800" height="600"
                     class="w-full h-auto object-cover">
            </div>
            <?php endif; ?>

            <!-- Content (CMS body is trusted admin-authored HTML; legacy bodies are plain text) -->
            <div class="space-y-4 text-dark-grey/80 leading-relaxed">
                <?php echo $isCmsPost ? ($post['content'] ?? '') : nl2br(htmlspecialchars($post['content'])); ?>
            </div>

            <!-- Metadata -->
            <div class="flex flex-col sm:flex-row items-center sm:space-x-4 pt-6 mt-8 border-t border-silver-grey/60">
                <span class="inline-block bg-electric-blue/10 text-electric-blue text-xs font-bold px-3 py-1.5 rounded-full mb-2 sm:mb-0">
                    <?php echo htmlspecialchars($post['category'] ?? 'Neurology'); ?>
                </span>
                <?php if (!empty($post['author'])): ?>
                <span class="text-xs text-dark-grey/45 font-medium">By <?php echo htmlspecialchars($post['author']); ?></span>
                <?php endif; ?>
                <span class="text-xs text-dark-grey/45 font-medium"><?php echo htmlspecialchars($postDate); ?></span>
            </div>

            <div class="pt-8 text-center">
                <a href="dr-praveen-gupta-blog" class="inline-flex items-center space-x-2 text-electric-blue font-bold text-sm hover:underline">
                    <i class="fas fa-arrow-left text-xs"></i>
                    <span>Back to All Articles</span>
                </a>
            </div>
        </article>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
