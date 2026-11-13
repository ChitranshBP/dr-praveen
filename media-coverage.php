<?php
/**
 * Media Coverage Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

$pageContent = get_page_content('media-coverage', [
    'hero_badge' => 'TV Interviews & Press Coverage',
    'hero_title' => 'Media <span class="text-white font-normal">Coverage & Appearances</span>',
    'hero_desc'  => 'Dr. Praveen Gupta is a regular health panelist on top national TV channels and writes health columns in major English and Hindi newspapers.',
    'hero_bg'    => 'assets/breadcrumbs/media.png'
]);
?>

<!-- Page Hero -->
<section class="relative overflow-hidden text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($pageContent['hero_bg']); ?>');">
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/85 to-electric-blue/30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Media Coverage</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-tv text-[10px]"></i>
                <span><?php echo htmlspecialchars($pageContent['hero_badge']); ?></span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                <?php echo $pageContent['hero_title']; ?>
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                <?php echo cms_render_html($pageContent['hero_desc']); ?>
            </p>
        </div>
    </div>
</section>

<!-- Media Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Media Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="media-grid">
            <?php // Press cards are managed in CMS → Media Coverage (data/collections/media_coverage.json) ?>
            <?php foreach (cms_collection('media_coverage') as $mc):
                $mcImage = cms_media_path($mc['image'] ?? '');
                $mcLink  = trim((string)($mc['link_url'] ?? ''));
                $mcLabel = trim((string)($mc['link_label'] ?? ''));
            ?>
            <div class="media-item print bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between animate-fade-in">
                <div>
                    <?php if ($mcImage !== ''): ?>
                    <div class="relative w-full h-[450px] bg-slate-50 overflow-hidden flex items-center justify-center border-b border-slate-200/40">
                        <img src="<?php echo htmlspecialchars($mcImage); ?>" alt="<?php echo htmlspecialchars($mc['alt'] ?? $mc['headline'] ?? ''); ?>" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105" loading="lazy">
                    </div>
                    <?php endif; ?>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between text-xs text-electric-blue font-bold uppercase tracking-wider">
                            <span><?php echo htmlspecialchars($mc['outlet'] ?? ''); ?></span>
                            <?php if (trim((string)($mc['date'] ?? '')) !== ''): ?><span class="text-dark-grey/40 font-normal"><?php echo htmlspecialchars($mc['date']); ?></span><?php endif; ?>
                        </div>
                        <h4 class="font-bold text-dark-grey text-base leading-snug"><?php echo htmlspecialchars($mc['headline'] ?? ''); ?></h4>
                        <?php if (trim((string)($mc['description'] ?? '')) !== ''): ?>
                        <p class="text-xs text-dark-grey/55 leading-relaxed">
                            <?php echo htmlspecialchars($mc['description']); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-3 border-t border-slate-200/60 flex justify-between items-center bg-slate-50/80">
                    <span class="text-xs text-dark-grey/40"><?php echo trim((string)($mc['topic'] ?? '')) !== '' ? 'Topic: ' . htmlspecialchars($mc['topic']) : ''; ?></span>
                    <?php if ($mcLink !== ''): ?>
                    <a href="<?php echo htmlspecialchars($mcLink); ?>" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-electric-blue hover:text-deep-indigo transition-colors duration-300"><?php echo htmlspecialchars($mcLabel !== '' ? $mcLabel : 'Read Article'); ?></a>
                    <?php elseif ($mcLabel !== ''): ?>
                    <span class="text-xs text-dark-grey/40"><?php echo htmlspecialchars($mcLabel); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
