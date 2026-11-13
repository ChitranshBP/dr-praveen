<?php
/**
 * Neurology Case Studies Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('case-studies', [
    'hero_badge' => 'Anonymized Clinical Case Files',
    'hero_title' => 'Neurology <span class="text-cyan-accent">Case Studies</span>',
    'hero_desc'  => 'Explore real clinical histories demonstrating the effectiveness of advanced stroke treatments, DBS programming, and specialized neurology interventions.',
    'hero_bg'    => 'assets/breadcrumbs/patient.png'
]);
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <!-- Background image -->
    <img src="<?php echo htmlspecialchars($pageContent['hero_bg']); ?>" alt=""
         fetchpriority="high"
         class="absolute inset-0 w-full h-full object-cover object-[78%_center] md:object-right pointer-events-none select-none">

    <!-- Legibility overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/75 to-deep-indigo/35 md:to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Case Studies</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-microscope text-cyan-accent text-[10px]"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>
        </div>
    </div>
</section>

<!-- Case Studies List -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans">Clinical Portals</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Clinical Recovery Reports</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Detailed reviews of patient cases, clinical decisions, and outcomes under Dr. Praveen Gupta.
            </p>
        </div>

        <div class="space-y-12">
            <?php
            // Case studies are managed in CMS → Case Studies (data/collections/case_studies.json)
            $caseBadgeClasses = [
                'red' => 'bg-red-100 text-red-700', 'electric-blue' => 'bg-electric-blue/10 text-electric-blue',
                'cyan-accent' => 'bg-cyan-accent/15 text-cyan-800', 'deep-indigo' => 'bg-deep-indigo/10 text-deep-indigo',
                'dark' => 'bg-dark-grey/10 text-dark-grey', 'emerald' => 'bg-emerald-100 text-emerald-700', 'amber' => 'bg-amber-100 text-amber-700',
            ];
            foreach (cms_collection('case_studies') as $csIdx => $cs):
                $mediaFirst = ($csIdx % 2 === 1);
                $csYt = trim((string)($cs['youtube_id'] ?? ''));
                $csImg = $csYt === '' ? cms_media_path($cs['image'] ?? '') : '';
                $badgeCls = $caseBadgeClasses[$cs['badge_color'] ?? 'electric-blue'] ?? $caseBadgeClasses['electric-blue'];
                $badgeIcon = trim((string)($cs['badge_icon'] ?? 'fa-brain'));
                $hasMedia = $csYt !== '' || $csImg !== '';
            ?>
            <div class="bg-slate-50 border border-slate-200/50 rounded-[32px] overflow-hidden hover:shadow-xl transition-all duration-500 grid grid-cols-1 lg:grid-cols-12 items-center gap-6 lg:gap-0 observe">
                <?php if ($hasMedia && $mediaFirst): ?>
                <?php if ($csYt !== ''): ?>
                <div class="lg:col-span-5 order-2 lg:order-1 relative aspect-video lg:h-full bg-black flex items-center justify-center overflow-hidden">
                    <iframe class="w-full h-full lg:absolute lg:inset-0" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($csYt); ?>?rel=0&modestbranding=1" title="<?php echo htmlspecialchars($cs['title'] ?? 'Patient story'); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                </div>
                <?php else: ?>
                <div class="lg:col-span-5 order-2 lg:order-1 relative aspect-[4/3] lg:h-full overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="<?php echo htmlspecialchars($csImg); ?>" alt="<?php echo htmlspecialchars($cs['alt'] ?? $cs['title'] ?? ''); ?>" class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-700" loading="lazy">
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <div class="<?php echo $hasMedia ? 'lg:col-span-7' : 'lg:col-span-12'; ?> <?php echo ($hasMedia && $mediaFirst) ? 'order-1 lg:order-2 ' : ''; ?>p-8 md:p-10 space-y-4">
                    <?php if (trim((string)($cs['badge_label'] ?? '')) !== ''): ?>
                    <div class="inline-flex items-center space-x-2 <?php echo $badgeCls; ?> text-xs font-bold px-3 py-1 rounded-full">
                        <?php if ($badgeIcon !== '' && $badgeIcon !== 'none'): ?><i class="fas <?php echo htmlspecialchars($badgeIcon); ?><?php echo $badgeIcon === 'fa-heartbeat' ? ' animate-pulse' : ''; ?>"></i><?php endif; ?>
                        <span><?php echo htmlspecialchars($cs['badge_label']); ?></span>
                    </div>
                    <?php endif; ?>
                    <h3 class="text-2xl font-bold text-deep-indigo font-serif"><?php echo htmlspecialchars($cs['title'] ?? ''); ?></h3>
                    <div class="text-sm text-dark-grey/70 leading-relaxed">
                        <?php echo cms_render_html($cs['narrative'] ?? ''); ?>
                    </div>
                    <?php if (trim((string)($cs['metric1_text'] ?? '')) !== '' || trim((string)($cs['metric2_text'] ?? '')) !== ''): ?>
                    <div class="pt-2 flex items-center space-x-4 text-xs font-semibold text-dark-grey/60">
                        <?php if (trim((string)($cs['metric1_text'] ?? '')) !== ''): ?><span><i class="<?php echo htmlspecialchars(trim((string)($cs['metric1_icon'] ?? 'fa-clock')) === 'fa-clock' ? 'far fa-clock' : 'fas ' . trim((string)($cs['metric1_icon'] ?? 'fa-clock'))); ?> mr-1.5 text-electric-blue"></i><?php echo htmlspecialchars($cs['metric1_text']); ?></span><?php endif; ?>
                        <?php if (trim((string)($cs['metric2_text'] ?? '')) !== ''): ?><span><i class="fas <?php echo htmlspecialchars(trim((string)($cs['metric2_icon'] ?? 'fa-check-circle'))); ?> mr-1.5 text-electric-blue"></i><?php echo htmlspecialchars($cs['metric2_text']); ?></span><?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($hasMedia && !$mediaFirst): ?>
                <?php if ($csYt !== ''): ?>
                <div class="lg:col-span-5 relative aspect-video lg:h-full bg-black flex items-center justify-center overflow-hidden">
                    <iframe class="w-full h-full lg:absolute lg:inset-0" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($csYt); ?>?rel=0&modestbranding=1" title="<?php echo htmlspecialchars($cs['title'] ?? 'Patient story'); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                </div>
                <?php else: ?>
                <div class="lg:col-span-5 relative aspect-[4/3] lg:h-full overflow-hidden bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="<?php echo htmlspecialchars($csImg); ?>" alt="<?php echo htmlspecialchars($cs['alt'] ?? $cs['title'] ?? ''); ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" loading="lazy">
                </div>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-3xl font-bold text-deep-indigo font-serif">Have a Complex Neurological Case?</h2>
        <p class="text-sm text-dark-grey/65 max-w-xl mx-auto leading-relaxed">
            Get an expert clinical evaluation, record review, or second opinion of your diagnosis and current treatments.
        </p>
        <div class="pt-2">
            <a href="contact-us-top-neurologist-delhi-ncr" class="inline-flex items-center space-x-3 bg-deep-indigo hover:bg-electric-blue text-white text-sm font-bold px-8 py-3.5 rounded-2xl transition-colors">
                <span>Book a Consultation</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
