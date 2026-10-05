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
$pageTitle       = !empty($post['meta_title']) ? $post['meta_title'] : ($post['title'] . ' - Dr. Praveen Gupta, Neurologist');
$pageDescription = !empty($post['meta_description']) ? $post['meta_description'] : ($post['excerpt'] ?? '');
$canonicalPath   = 'blog/' . ($post['slug'] ?? $slug);

require_once __DIR__ . '/includes/header.php';
?>
<!-- Blog Single Post -->
<section class="py-10 md:py-14 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-newspaper text-electric-blue text-xs"></i>
                <span class="text-xs font-bold text-electric-blue uppercase tracking-wider">Health Articles</span>
            </div>
            <p class="text-xs text-dark-grey/60 font-medium">Published on <?php echo htmlspecialchars($postDate); ?> &bull; By <?php echo htmlspecialchars($post['author'] ?? 'Dr. Praveen Gupta'); ?></p>
        </div>

        <article class="mx-auto max-w-3xl lg:max-w-4xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-6 leading-tight">
                <?php echo htmlspecialchars($post['title']); ?>
            </h1>

            <?php if (!empty($post['excerpt'])): ?>
            <p class="text-base md:text-lg text-dark-grey/75 italic mb-8 border-l-4 border-electric-blue pl-4 bg-slate-50 py-3 rounded-r-xl">
                <?php echo htmlspecialchars($post['excerpt']); ?>
            </p>
            <?php endif; ?>

            <!-- Featured Image -->
            <?php if (!empty($post['image'])): ?>
            <div class="w-full rounded-3xl overflow-hidden mb-10 bg-slate-100 shadow-md">
                <img src="<?php echo htmlspecialchars($post['image']); ?>"
                     alt="<?php echo htmlspecialchars($post['image_alt'] ?? $post['title'] ?? 'Blog Featured Image'); ?>"
                     width="1200" height="630"
                     onerror="this.onerror=null; this.src='assets/services/migraine.png';"
                     class="w-full max-h-[480px] object-cover">
            </div>
            <?php endif; ?>

            <!-- Content -->
            <div class="blog-content text-dark-grey/85 leading-relaxed text-base md:text-lg space-y-6">
                <?php echo cms_render_html($post['content'] ?? ''); ?>
            </div>

            <style>
                .blog-content h2 {
                    font-family: 'Playfair Display', serif;
                    font-size: 1.75rem;
                    font-weight: 700;
                    color: #1E1B4B;
                    margin-top: 2.25rem;
                    margin-bottom: 1rem;
                    line-height: 1.3;
                    border-bottom: 2px solid #F1F5F9;
                    padding-bottom: 0.5rem;
                }
                .blog-content h3 {
                    font-size: 1.25rem;
                    font-weight: 700;
                    color: #2563EB;
                    margin-top: 1.75rem;
                    margin-bottom: 0.75rem;
                    line-height: 1.4;
                }
                .blog-content p {
                    margin-bottom: 1.25rem;
                    line-height: 1.8;
                }
                .blog-content ul, .blog-content ol {
                    margin-top: 0.75rem;
                    margin-bottom: 1.5rem;
                    padding-left: 1.5rem;
                }
                .blog-content ul {
                    list-style-type: disc;
                }
                .blog-content ol {
                    list-style-type: decimal;
                }
                .blog-content li {
                    margin-bottom: 0.5rem;
                    line-height: 1.7;
                }
                .blog-content strong {
                    color: #0F172A;
                    font-weight: 700;
                }
                .blog-content blockquote {
                    border-left: 4px solid #06B6D4;
                    padding-left: 1rem;
                    margin: 1.5rem 0;
                    color: #475569;
                    font-style: italic;
                    background: #F8FAFC;
                    padding: 1rem;
                    border-radius: 0 0.75rem 0.75rem 0;
                }
            </style>

            <!-- Metadata -->
            <div class="flex flex-col sm:flex-row items-center justify-between pt-6 mt-10 border-t border-silver-grey/60">
                <div class="flex items-center space-x-3 mb-4 sm:mb-0">
                    <span class="inline-block bg-electric-blue/10 text-electric-blue text-xs font-bold px-3 py-1.5 rounded-full">
                        <?php echo htmlspecialchars($post['category'] ?? 'Neurology'); ?>
                    </span>
                    <?php if (!empty($post['author'])): ?>
                    <span class="text-xs text-dark-grey/60 font-medium">By <?php echo htmlspecialchars($post['author']); ?></span>
                    <?php endif; ?>
                </div>
                <span class="text-xs text-dark-grey/50 font-medium"><?php echo htmlspecialchars($postDate); ?></span>
            </div>

            <!-- Doctor Bio & Consultation CTA Card -->
            <div class="mt-12 p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-deep-indigo via-slate-900 to-electric-blue text-white shadow-xl relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl overflow-hidden border-2 border-white/20 flex-shrink-0 bg-white/10">
                        <img src="assets/banner/1.png" alt="Dr. Praveen Gupta" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='assets/logo/NeuroDoc-final-logo.png';">
                    </div>
                    <div class="flex-1 text-center md:text-left space-y-2">
                        <span class="text-[10px] uppercase font-bold tracking-widest text-cyan-accent bg-cyan-accent/10 px-2.5 py-1 rounded-full inline-block">Expert Care</span>
                        <h3 class="text-xl sm:text-2xl font-bold font-serif text-white">Consult Dr. Praveen Gupta</h3>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">Chairman – Marengo Asia International Institute of Neuro & Spine &bull; 20+ Years Experience &bull; DM (AIIMS, New Delhi)</p>
                    </div>
                    <div class="flex flex-col sm:flex-row md:flex-col gap-3 w-full md:w-auto">
                        <a href="contact-us-top-neurologist-delhi-ncr" class="inline-flex items-center justify-center space-x-2 px-5 py-3 bg-gradient-to-r from-electric-blue to-cyan-accent hover:from-cyan-accent hover:to-electric-blue text-white text-xs font-bold rounded-xl shadow-lg transition-all duration-300 whitespace-nowrap">
                            <i class="fas fa-calendar-check"></i>
                            <span>Book Consultation</span>
                        </a>
                        <a href="tel:<?php echo defined('PRIMARY_PHONE') ? PRIMARY_PHONE : '+919811456789'; ?>" class="inline-flex items-center justify-center space-x-2 px-5 py-3 bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-bold rounded-xl transition-all duration-300 whitespace-nowrap">
                            <i class="fas fa-phone-alt text-cyan-accent"></i>
                            <span>Call Clinic</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            <?php
            $allPub = function_exists('cms_blogs_published') ? cms_blogs_published() : [];
            $related = array_values(array_filter($allPub, function ($p) use ($post) {
                return ($p['slug'] ?? '') !== ($post['slug'] ?? '');
            }));
            if (!empty($related)):
                $related = array_slice($related, 0, 3);
            ?>
            <div class="mt-16 pt-10 border-t border-slate-200">
                <h3 class="text-2xl font-serif font-bold text-deep-indigo mb-6">More Health Articles</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($related as $rel):
                        $relUrl = 'blog/' . urlencode($rel['slug'] ?? '');
                        $relDate = !empty($rel['date']) ? date('M j, Y', strtotime($rel['date'])) : '';
                    ?>
                    <a href="<?php echo $relUrl; ?>" class="group bg-slate-50 border border-slate-200/60 rounded-2xl p-4 flex flex-col justify-between hover:shadow-md hover:bg-white transition-all duration-300">
                        <div>
                            <div class="aspect-video bg-slate-200 rounded-xl overflow-hidden mb-3">
                                <img src="<?php echo htmlspecialchars($rel['image'] ?? 'assets/services/migraine.png'); ?>" alt="<?php echo htmlspecialchars($rel['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                            </div>
                            <span class="text-[10px] font-bold text-electric-blue uppercase tracking-wider"><?php echo htmlspecialchars($rel['category'] ?? 'Neurology'); ?></span>
                            <h4 class="text-sm font-bold text-slate-900 mt-1 line-clamp-2 group-hover:text-electric-blue transition-colors"><?php echo htmlspecialchars($rel['title']); ?></h4>
                        </div>
                        <span class="text-[11px] text-slate-400 mt-3 flex items-center justify-between">
                            <span><?php echo $relDate; ?></span>
                            <span class="font-bold text-electric-blue group-hover:underline">Read &rarr;</span>
                        </span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="pt-10 text-center">
                <a href="dr-praveen-gupta-blog" class="inline-flex items-center space-x-2 text-electric-blue font-bold text-sm hover:underline">
                    <i class="fas fa-arrow-left text-xs"></i>
                    <span>Back to All Articles</span>
                </a>
            </div>
        </article>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
