<?php
/**
 * Blog Single Post Page - Dr. Praveen Gupta
 * Displays a single blog post
 */

// Get the blog post title from URL parameter
$title = $_GET['title'] ?? 'understanding-migraine';

// Include header for proper <head> section with canonical URL
require_once __DIR__ . '/includes/header.php';

// Blog posts data
$allBlogs = [
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
        'date'     => 'Jun 10, 2025',
        'image'    => 'assets/services/migraine.png',
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
        'date'     => 'May 28, 2025',
        'image'    => 'assets/services/stroke.png',
    ],
    'parkinsons-disease' => [
        'title'    => 'Living with Parkinson\'s Disease: A Patient\'s Guide',
        'excerpt'  => 'From Deep Brain Stimulation to lifestyle strategies â€” explore how patients manage Parkinson\'s disease with quality of life.',
        'content'  => 'Parkinson\'s disease is a progressive neurological disorder that affects movement, but with proper management, patients can maintain a good quality of life for years. This guide explores:

- **Medication management**: How different medications work and when to adjust them
- **Deep Brain Stimulation (DBS)**: An overview of this surgical option for advanced cases
- **Physical therapy**: Exercises to maintain mobility, balance, and coordination
- **Occupational therapy**: Strategies for adapting daily activities
- **Lifestyle adjustments**: Diet, exercise, and sleep strategies
- **Support systems**: Building a strong support network and accessing resources

Whether you\'ve recently been diagnosed or have been living with Parkinson\'s for years, this article provides practical advice and hope for maintaining the best possible quality of life.',
        'category' => 'Parkinson\'s',
        'date'     => 'May 14, 2025',
        'image'    => 'assets/services/parkinsons.png',
    ],
];

$blog = $allBlogs[$title] ?? $allBlogs['understanding-migraine'];

// SEO Meta Tags
$pageTitle = $blog['title'] . ' - Dr. Praveen Gupta, Neurologist';
$pageDescription = $blog['excerpt'];
?>
<!-- Blog Single Post -->
<section class="py-10 md:py-14 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
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
        <div class="prose mx-auto max-w-xl lg:max-w-2xl">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-6 leading-tight">
                <?php echo htmlspecialchars($blog['title']); ?>
            </h1>

            <!-- Featured Image -->
            <div class="w-full rounded-3xl overflow-hidden mb-8">
                <img src="<?php echo $blog['image']; ?>"
                     alt="<?php echo htmlspecialchars($blog['title']); ?>"
                     width="800" height="600"
                     class="w-full h-auto object-cover">
            </div>

            <!-- Content -->
            <p class="text-base text-dark-grey-600 mb-6">
                <?php echo htmlspecialchars($blog['content']); ?>
            </p>

            <!-- Metadata -->
            <div class="flex flex-col sm:flex-row items-center space-x-4 pt-6 border-t border-silver-grey/60">
                <span class="text-xs text-dark-grey/45 font-medium">
                    Category: <?php echo htmlspecialchars($blog['category']); ?>
                </span>
                <span class="text-xs text-dark-grey/45 font-medium">
                    Date: <?php echo htmlspecialchars($blog['date']); ?>
                </span>
            </div>
        </div>
    </div>
</section>

<!-- â•â•â•â•â•â•â•â• Site Footer â•â•â•â•â•â•â•â• -->
<?php require_once __DIR__ . '/includes/footer.php'; ?>
