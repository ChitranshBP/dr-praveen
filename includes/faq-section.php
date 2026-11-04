<?php
/**
 * CMS-managed FAQ section renderer.
 *
 * Usage from a public page:
 *   $faqSlug = 'brain-tumor-surgery';
 *   require __DIR__ . '/includes/faq-section.php';
 *
 * Content is managed in CMS → FAQs (data/faqs.json). The layout is stored with
 * each page entry: split | centered | details | categories | home.
 */

if (!isset($faqSlug) || $faqSlug === '') {
    $faqSlug = $currentPage ?? '';
}

$faqPage = function_exists('cms_faq_page') ? cms_faq_page($faqSlug) : null;
if ($faqPage === null || empty($faqPage['items'])) {
    return;
}

// Tells includes/cms-sections.php that this page already printed its FAQ
// section, so it does not render the same questions a second time.
$GLOBALS['cms_faq_section_used'] = true;

$faqLayout = $faqPage['layout'] ?? 'split';
$faqBadge = trim((string)($faqPage['badge'] ?? 'FAQ'));
$faqTitle = trim((string)($faqPage['title'] ?? 'Frequently Asked Questions'));
$faqDescription = (string)($faqPage['description'] ?? '');
$faqItems = $faqPage['items'];

$faqAnswer = function ($html) {
    $html = trim((string)$html);
    if ($html === '') {
        return '';
    }
    return function_exists('cms_render_html') ? cms_render_html($html) : $html;
};

$faqGroups = [];
foreach ($faqItems as $item) {
    $category = trim((string)($item['category'] ?? ''));
    $key = $category !== '' ? $category : 'General';
    if (!isset($faqGroups[$key])) {
        $faqGroups[$key] = [
            'name' => $key,
            'icon' => 'fa-circle-question',
            'items' => [],
        ];
    }
    $faqGroups[$key]['items'][] = $item;
}

foreach ($faqGroups as $name => &$group) {
    $lower = strtolower($name);
    if (strpos($lower, 'billing') !== false || strpos($lower, 'insurance') !== false || strpos($lower, 'tpa') !== false) {
        $group['icon'] = 'fa-credit-card';
    } elseif (strpos($lower, 'treatment') !== false || strpos($lower, 'diagnos') !== false || strpos($lower, 'clinical') !== false) {
        $group['icon'] = 'fa-stethoscope';
    } elseif (strpos($lower, 'emergency') !== false) {
        $group['icon'] = 'fa-triangle-exclamation';
    } elseif (strpos($lower, 'consult') !== false || strpos($lower, 'appointment') !== false) {
        $group['icon'] = 'fa-hospital';
    }
}
unset($group);
?>

<?php if ($faqLayout === 'home'): ?>
<!-- Frequently Asked Questions -->
<section id="homepage-faqs" class="py-14 md:py-20 bg-gradient-to-b from-white via-slate-50 to-white relative overflow-hidden">
    <div class="absolute -left-20 top-1/3 w-72 h-72 bg-electric-blue/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -right-20 bottom-1/3 w-72 h-72 bg-cyan-accent/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-14 observe">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-question-circle text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold"><?php echo htmlspecialchars($faqBadge ?: 'Common Queries'); ?></span>
            </div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                <?php echo htmlspecialchars($faqTitle); ?>
            </h2>
            <?php if ($faqDescription !== ''): ?>
            <div class="text-base sm:text-lg text-dark-grey/70 leading-relaxed">
                <?php echo $faqAnswer($faqDescription); ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="space-y-4 md:space-y-5">
            <?php foreach ($faqItems as $index => $item): ?>
            <details class="group bg-white border border-slate-200/80 rounded-2xl md:rounded-3xl p-5 sm:p-6 shadow-sm hover:shadow-md hover:border-electric-blue/30 transition-all duration-300 [&_summary::-webkit-details-marker]:hidden cursor-pointer observe" <?php echo $index === 0 ? 'open' : ''; ?>>
                <summary class="flex justify-between items-center text-base sm:text-lg font-bold text-deep-indigo list-none gap-4">
                    <span><?php echo htmlspecialchars($item['question'] ?? ''); ?></span>
                    <span class="w-8 h-8 rounded-full bg-slate-100 group-open:bg-electric-blue group-open:text-white flex items-center justify-center text-xs text-electric-blue flex-shrink-0 transition-all duration-300">
                        <i class="fas fa-plus group-open:hidden"></i>
                        <i class="fas fa-minus hidden group-open:inline"></i>
                    </span>
                </summary>
                <div class="text-xs sm:text-sm text-dark-grey/75 leading-relaxed mt-4 pt-4 border-t border-slate-100 space-y-2">
                    <?php echo $faqAnswer($item['answer'] ?? ''); ?>
                </div>
            </details>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-10 md:mt-12 observe flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="neurology-faqs" class="inline-flex items-center space-x-2 text-electric-blue font-bold text-sm hover:text-deep-indigo transition-colors py-2 px-4 rounded-xl hover:bg-slate-100">
                <i class="fas fa-book-open text-xs"></i>
                <span>View Full FAQs Hub</span>
            </a>
            <span class="hidden sm:inline text-slate-300">&bull;</span>
            <a href="contact-us-top-neurologist-delhi-ncr" class="inline-flex items-center space-x-2 text-dark-grey/70 font-semibold text-sm hover:text-electric-blue transition-colors py-2 px-4 rounded-xl hover:bg-slate-100">
                <i class="fas fa-headset text-xs"></i>
                <span>Contact Our Patient Care Team</span>
            </a>
        </div>
    </div>

    <?php
    $faqSchemaItems = [];
    foreach ($faqItems as $item) {
        $faqSchemaItems[] = [
            '@type' => 'Question',
            'name' => trim(strip_tags((string)($item['question'] ?? ''))),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => trim(preg_replace('/\s+/u', ' ', strip_tags((string)($item['answer'] ?? '')))),
            ],
        ];
    }
    ?>
    <?php if (!empty($faqSchemaItems)): ?>
    <script type="application/ld+json">
    <?php echo json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqSchemaItems,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
    </script>
    <?php endif; ?>
</section>

<?php elseif ($faqLayout === 'details'): ?>
<!-- Accordion FAQs Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if ($faqBadge !== '' || $faqTitle !== '' || trim($faqDescription) !== ''): ?>
        <div class="text-center max-w-3xl mx-auto mb-10">
            <?php if ($faqBadge !== ''): ?>
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider"><?php echo htmlspecialchars($faqBadge); ?></span>
            <?php endif; ?>
            <?php if ($faqTitle !== ''): ?>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2"><?php echo htmlspecialchars($faqTitle); ?></h2>
            <?php endif; ?>
            <?php if (trim($faqDescription) !== ''): ?>
            <div class="text-sm text-dark-grey/65 mt-3 leading-relaxed"><?php echo $faqAnswer($faqDescription); ?></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="space-y-8">
            <?php $first = true; foreach ($faqGroups as $group): ?>
            <div class="space-y-4<?php echo $first ? '' : ' pt-4'; ?>">
                <?php if ($group['name'] !== 'General'): ?>
                <h3 class="text-lg font-bold text-deep-indigo border-b border-slate-200 pb-2"><?php echo htmlspecialchars($group['name']); ?></h3>
                <?php endif; ?>
                <?php foreach ($group['items'] as $item): ?>
                <details class="group bg-slate-50 border border-slate-200/50 rounded-3xl p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer" <?php echo $first ? 'open' : ''; ?>>
                    <summary class="flex justify-between items-center text-sm font-bold text-deep-indigo list-none">
                        <span><?php echo htmlspecialchars($item['question'] ?? ''); ?></span>
                        <span class="transition group-open:rotate-185 text-xs text-cyan-accent"><i class="fas fa-plus group-open:hidden"></i><i class="fas fa-minus hidden group-open:inline"></i></span>
                    </summary>
                    <div class="text-xs text-dark-grey/65 leading-relaxed mt-3 border-t border-slate-200/40 pt-3">
                        <?php echo $faqAnswer($item['answer'] ?? ''); ?>
                    </div>
                </details>
                <?php $first = false; endforeach; ?>
            </div>
            <?php $first = false; endforeach; ?>
        </div>
    </div>
</section>

<?php elseif ($faqLayout === 'categories'): ?>
<!-- FAQs Section with category filter -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if ($faqBadge !== '' || $faqTitle !== '' || trim($faqDescription) !== ''): ?>
        <div class="text-center max-w-3xl mx-auto mb-10">
            <?php if ($faqBadge !== ''): ?>
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider"><?php echo htmlspecialchars($faqBadge); ?></span>
            <?php endif; ?>
            <?php if ($faqTitle !== ''): ?>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2"><?php echo htmlspecialchars($faqTitle); ?></h2>
            <?php endif; ?>
            <?php if (trim($faqDescription) !== ''): ?>
            <div class="text-sm text-dark-grey/65 mt-3 leading-relaxed"><?php echo $faqAnswer($faqDescription); ?></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-4 lg:sticky lg:top-24 self-start space-y-4">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">FAQ Categories</span>
                <div class="flex flex-col space-y-2" id="faq-categories">
                    <?php $catIndex = 0; foreach ($faqGroups as $group): ?>
                    <button class="faq-cat-btn text-left px-5 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 <?php echo $catIndex === 0 ? 'active bg-electric-blue text-white shadow-md' : 'bg-slate-50 text-dark-grey/70 hover:bg-slate-100'; ?>" data-category="<?php echo htmlspecialchars(strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $group['name']))); ?>">
                        <i class="fas <?php echo htmlspecialchars($group['icon']); ?> text-xs mr-2"></i> <?php echo htmlspecialchars($group['name']); ?>
                    </button>
                    <?php $catIndex++; endforeach; ?>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">
                <?php $groupIndex = 0; foreach ($faqGroups as $group): ?>
                <div class="faq-group space-y-4 <?php echo $groupIndex === 0 ? '' : 'hidden'; ?>" id="cat-<?php echo htmlspecialchars(strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $group['name']))); ?>">
                    <h3 class="text-xl font-bold text-dark-grey mb-2 flex items-center">
                        <i class="fas <?php echo htmlspecialchars($group['icon']); ?> text-electric-blue text-sm mr-2.5"></i> <?php echo htmlspecialchars($group['name']); ?>
                    </h3>
                    <?php foreach ($group['items'] as $item): ?>
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300"><?php echo htmlspecialchars($item['question'] ?? ''); ?></span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <div class="text-dark-grey/70 leading-relaxed text-sm">
                                <?php echo $faqAnswer($item['answer'] ?? ''); ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php $groupIndex++; endforeach; ?>
            </div>
        </div>
    </div>
</section>

<script>
document.querySelectorAll('#faq-categories .faq-cat-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        document.querySelectorAll('#faq-categories .faq-cat-btn').forEach(function (b) {
            b.classList.remove('bg-electric-blue', 'text-white', 'shadow-md');
            b.classList.add('bg-slate-50', 'text-dark-grey/70');
        });
        btn.classList.add('bg-electric-blue', 'text-white', 'shadow-md');
        btn.classList.remove('bg-slate-50', 'text-dark-grey/70');
        var target = btn.getAttribute('data-category');
        document.querySelectorAll('.faq-group').forEach(function (group) {
            group.classList.toggle('hidden', group.id !== 'cat-' + target);
        });
    });
});
function toggleFaq(button) {
    var item = button.closest('.faq-item');
    var content = button.nextElementSibling;
    var icon = button.querySelector('i');
    var isOpen = !content.classList.contains('hidden');
    document.querySelectorAll('.faq-content').forEach(function (c) { c.classList.add('hidden'); });
    document.querySelectorAll('.faq-item').forEach(function (i) {
        i.classList.remove('bg-[#edf5f9]');
        i.classList.add('bg-white');
    });
    document.querySelectorAll('.faq-toggle i').forEach(function (i) {
        i.classList.remove('fa-minus');
        i.classList.add('fa-plus');
        i.style.transform = 'rotate(0deg)';
    });
    if (!isOpen) {
        content.classList.remove('hidden');
        item.classList.remove('bg-white');
        item.classList.add('bg-[#edf5f9]');
        icon.classList.remove('fa-plus');
        icon.classList.add('fa-minus');
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>

<?php else: ?>
<?php $isCentered = ($faqLayout === 'centered'); ?>
<!-- FAQ Section -->
<section class="py-12 <?php echo $isCentered ? 'py-16 bg-slate-50 border-t border-b border-silver-grey/40' : 'bg-white'; ?>">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if ($isCentered): ?>
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans"><?php echo htmlspecialchars($faqBadge ?: 'Patient FAQ'); ?></span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2"><?php echo htmlspecialchars($faqTitle); ?></h2>
            <?php if ($faqDescription !== ''): ?>
            <div class="text-sm text-dark-grey/65 mt-3 leading-relaxed"><?php echo $faqAnswer($faqDescription); ?></div>
            <?php endif; ?>
        </div>
        <div class="max-w-4xl mx-auto space-y-4">
        <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-5 lg:sticky lg:top-24 self-start">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($faqBadge ?: 'FAQ'); ?></span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark-grey mt-3 mb-6"><?php echo htmlspecialchars($faqTitle); ?></h2>
                <?php if ($faqDescription !== ''): ?>
                <div class="text-dark-grey/70 leading-relaxed max-w-md"><?php echo $faqAnswer($faqDescription); ?></div>
                <?php endif; ?>
            </div>
            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
        <?php endif; ?>

                <?php foreach ($faqItems as $item): ?>
                <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                    <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                        <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300"><?php echo htmlspecialchars($item['question'] ?? ''); ?></span>
                        <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                            <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                        </span>
                    </button>
                    <div class="faq-content hidden px-6 pb-6">
                        <div class="text-xs text-dark-grey/70 leading-relaxed">
                            <?php echo $faqAnswer($item['answer'] ?? ''); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

        <?php if ($isCentered): ?>
        </div>
        <?php else: ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
function toggleFaq(button) {
    var item = button.closest('.faq-item');
    var content = button.nextElementSibling;
    var icon = button.querySelector('i');
    var isOpen = !content.classList.contains('hidden');
    document.querySelectorAll('.faq-content').forEach(function (c) { c.classList.add('hidden'); });
    document.querySelectorAll('.faq-item').forEach(function (i) {
        i.classList.remove('bg-[#edf5f9]');
        i.classList.add('bg-white');
    });
    document.querySelectorAll('.faq-toggle i').forEach(function (i) {
        i.classList.remove('fa-minus');
        i.classList.add('fa-plus');
        i.style.transform = 'rotate(0deg)';
    });
    if (!isOpen) {
        content.classList.remove('hidden');
        item.classList.remove('bg-white');
        item.classList.add('bg-[#edf5f9]');
        icon.classList.remove('fa-plus');
        icon.classList.add('fa-minus');
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>
<?php endif; ?>
