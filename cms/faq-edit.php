<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
cms_require_auth();

$faqs = CMS_DB::get('faqs', []);
$catalog = CMS_DB::get('pages_catalog', []);
$catalogBySlug = [];
foreach ($catalog as $p) {
    if (!empty($p['slug'])) {
        $catalogBySlug[$p['slug']] = $p;
    }
}

$slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['slug'] ?? $_GET['slug'] ?? '');
if ($slug === '') {
    cms_set_flash('error', 'Choose a page to edit FAQs for.');
    header('Location: faqs.php');
    exit;
}

$layouts = [
    'split'      => 'Split layout (heading left, questions right)',
    'centered'   => 'Centered layout (stacked, centered header)',
    'details'    => 'Grouped accordion (uses categories)',
    'categories' => 'Category filter (uses categories)',
    'home'       => 'Homepage layout (card accordion + schema)',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? 'save';

    if ($action === 'delete') {
        unset($faqs[$slug]);
        CMS_DB::set('faqs', $faqs);
        cms_set_flash('success', 'FAQ section removed from this page.');
        header('Location: faqs.php');
        exit;
    }

    if ($action === 'save') {
        $layout = $_POST['layout'] ?? 'split';
        if (!isset($layouts[$layout])) {
            $layout = 'split';
        }

        $items = [];
        $order = 1;
        $postedItems = $_POST['items'] ?? [];
        if (is_array($postedItems)) {
            foreach ($postedItems as $item) {
                if (!is_array($item)) {
                    continue;
                }
                $question = trim($item['question'] ?? '');
                $answer = trim($item['answer'] ?? '');
                if ($answer === '<p><br></p>') {
                    $answer = '';
                }
                // An answer cannot be shown without a question, so drop empty rows.
                if ($question === '') {
                    continue;
                }
                $id = preg_replace('/[^a-zA-Z0-9]/', '', $item['id'] ?? '');
                if ($id === '') {
                    $id = CMS_DB::generateId();
                }
                $items[] = [
                    'question'    => $question,
                    'answer'      => $answer,
                    'category'    => trim($item['category'] ?? ''),
                    'category_id' => trim($item['category_id'] ?? ''),
                    'id'          => $id,
                    'order'       => $order++,
                    'is_active'   => !empty($item['is_active']),
                ];
            }
        }

        $faqs[$slug] = [
            'badge'       => trim($_POST['badge'] ?? 'FAQ'),
            'title'       => trim($_POST['title'] ?? 'Frequently Asked Questions'),
            'description' => trim($_POST['description'] ?? ''),
            'layout'      => $layout,
            'items'       => $items,
        ];

        if (CMS_DB::set('faqs', $faqs)) {
            cms_set_flash('success', 'FAQ section saved. Changes are live on the website.');
        } else {
            cms_set_flash('error', 'Could not save FAQs. Please check that data/faqs.json is writable.');
        }
        header('Location: faq-edit.php?slug=' . urlencode($slug));
        exit;
    }
}

$entry = $faqs[$slug] ?? [];
if (!is_array($entry)) {
    $entry = [];
}
$entry = array_merge([
    'badge'       => 'FAQ',
    'title'       => 'Frequently Asked Questions',
    'description' => '',
    'layout'      => 'split',
    'items'       => [],
], $entry);

$items = is_array($entry['items'] ?? null) ? array_values($entry['items']) : [];
usort($items, function ($a, $b) {
    return (int)($a['order'] ?? 999) <=> (int)($b['order'] ?? 999);
});

$pageMeta = $catalogBySlug[$slug] ?? [
    'title' => $slug,
    'file'  => $slug . '.php',
];
$pageTitle = 'Edit FAQs: ' . ($pageMeta['title'] ?? $slug);
require_once __DIR__ . '/includes/header.php';
?>

<div class="max-w-5xl space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-200">
        <div>
            <div class="flex items-center space-x-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-brand-blue">FAQs</span>
                <span class="text-[11px] text-slate-400 font-mono"><?php echo htmlspecialchars($pageMeta['file'] ?? ($slug . '.php')); ?></span>
            </div>
            <h2 class="text-base font-bold text-slate-900"><?php echo htmlspecialchars($pageMeta['title'] ?? $slug); ?></h2>
            <p class="text-[11px] text-slate-500 mt-0.5">Edit the section header, choose a layout, and manage every question shown on this page.</p>
        </div>
        <div class="flex items-center space-x-2 flex-shrink-0">
            <a href="faqs.php" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-colors">
                &larr; All FAQs
            </a>
            <a href="../<?php echo htmlspecialchars($pageMeta['file'] ?? ($slug . '.php')); ?>" target="_blank" class="px-3.5 py-1.5 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition-colors flex items-center space-x-1.5">
                <span>View Live</span>
                <i class="fas fa-external-link-alt text-[9px]"></i>
            </a>
        </div>
    </div>

    <form method="POST" action="" class="space-y-6">
        <?php echo cms_csrf_field(); ?>
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="slug" value="<?php echo htmlspecialchars($slug); ?>">

        <!-- Section header -->
        <div class="bg-gradient-to-br from-slate-50 to-blue-50/30 p-5 rounded-2xl border border-blue-100/80 space-y-4 shadow-sm">
            <div class="flex items-center justify-between border-b border-blue-100 pb-2.5">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center">
                    <i class="fas fa-heading text-brand-blue mr-2"></i> FAQ Section Header &amp; Layout
                </h3>
                <span class="text-[11px] text-blue-700 font-semibold bg-blue-100/60 px-2 py-0.5 rounded-full"><?php echo count($items); ?> question<?php echo count($items) === 1 ? '' : 's'; ?></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Section Badge</label>
                    <input type="text" name="badge" value="<?php echo htmlspecialchars($entry['badge']); ?>" placeholder="FAQ" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Layout</label>
                    <select name="layout" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <?php foreach ($layouts as $value => $label): ?>
                        <option value="<?php echo htmlspecialchars($value); ?>" <?php echo ($entry['layout'] ?? 'split') === $value ? 'selected' : ''; ?>><?php echo htmlspecialchars($label); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Section Heading (H2)</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($entry['title']); ?>" placeholder="Frequently Asked Questions" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Introductory Description (optional, HTML allowed)</label>
                <textarea name="description" rows="3" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($entry['description']); ?></textarea>
            </div>
        </div>

        <!-- Questions -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center">
                        <i class="fas fa-circle-question text-brand-blue mr-2"></i> Questions &amp; Answers
                    </h3>
                    <p class="text-[10px] text-slate-500 mt-1">Drag-free ordering: use the arrow buttons to move questions. Uncheck “Active” to hide one without deleting it.</p>
                </div>
                <button type="button" onclick="addFaqItem()" class="px-3.5 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition-colors flex items-center justify-center space-x-1.5 self-start sm:self-auto">
                    <i class="fas fa-plus text-[10px]"></i>
                    <span>Add Question</span>
                </button>
            </div>

            <div id="faq-items-container" class="space-y-4" data-next-index="<?php echo count($items); ?>">
                <?php foreach ($items as $i => $item): ?>
                <div class="faq-item-card bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-3" data-index="<?php echo (int)$i; ?>">
                    <input type="hidden" name="items[<?php echo (int)$i; ?>][id]" value="<?php echo htmlspecialchars($item['id'] ?? ''); ?>">
                    <input type="hidden" name="items[<?php echo (int)$i; ?>][category_id]" value="<?php echo htmlspecialchars($item['category_id'] ?? ''); ?>">
                    <input type="hidden" name="items[<?php echo (int)$i; ?>][is_active]" value="0">

                    <div class="flex items-center justify-between gap-2">
                        <h4 class="text-xs font-bold text-slate-800 faq-item-number">Question <?php echo (int)$i + 1; ?></h4>
                        <div class="flex items-center space-x-1.5">
                            <button type="button" onclick="moveFaqItem(this, -1)" title="Move up" class="w-7 h-7 rounded-lg bg-white border border-slate-200 text-slate-500 hover:text-brand-blue hover:border-blue-300 transition-colors flex items-center justify-center">
                                <i class="fas fa-arrow-up text-[9px]"></i>
                            </button>
                            <button type="button" onclick="moveFaqItem(this, 1)" title="Move down" class="w-7 h-7 rounded-lg bg-white border border-slate-200 text-slate-500 hover:text-brand-blue hover:border-blue-300 transition-colors flex items-center justify-center">
                                <i class="fas fa-arrow-down text-[9px]"></i>
                            </button>
                            <button type="button" onclick="removeFaqItem(this)" title="Remove question" class="w-7 h-7 rounded-lg bg-white border border-slate-200 text-red-500 hover:text-red-700 hover:border-red-300 transition-colors flex items-center justify-center">
                                <i class="fas fa-trash text-[9px]"></i>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Question</label>
                            <input type="text" name="items[<?php echo (int)$i; ?>][question]" value="<?php echo htmlspecialchars($item['question'] ?? ''); ?>" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Category <span class="font-normal text-slate-400">(optional)</span></label>
                            <input type="text" name="items[<?php echo (int)$i; ?>][category]" value="<?php echo htmlspecialchars($item['category'] ?? ''); ?>" placeholder="e.g. Treatment" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Answer</label>
                        <textarea name="items[<?php echo (int)$i; ?>][answer]" rows="5" class="faq-answer-editor w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($item['answer'] ?? ''); ?></textarea>
                    </div>

                    <label class="inline-flex items-center space-x-2 text-[11px] font-semibold text-slate-700 cursor-pointer">
                        <input type="checkbox" name="items[<?php echo (int)$i; ?>][is_active]" value="1" <?php echo (!isset($item['is_active']) || $item['is_active']) ? 'checked' : ''; ?> class="w-4 h-4 text-brand-blue rounded border-slate-300 focus:ring-blue-500">
                        <span>Active (show on the website)</span>
                    </label>
                </div>
                <?php endforeach; ?>

                <?php if (empty($items)): ?>
                <div class="p-8 text-center text-xs text-slate-500 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                    No questions yet. Click “Add Question” to create the first one.
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center space-x-3">
                <a href="faqs.php" class="text-xs text-slate-500 font-semibold hover:underline">&larr; Back to All FAQs</a>
                <?php if (isset($faqs[$slug])): ?>
                <button type="button" onclick="if (confirm('Remove the entire FAQ section from this page?')) { document.getElementById('faq-delete-form').submit(); }" class="text-[11px] text-red-500 font-bold hover:underline">
                    Delete FAQ section
                </button>
                <?php endif; ?>
            </div>
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center space-x-1.5">
                <i class="fas fa-save"></i>
                <span>Save FAQs</span>
            </button>
        </div>
    </form>

    <?php if (isset($faqs[$slug])): ?>
    <form id="faq-delete-form" method="POST" action="" class="hidden">
        <?php echo cms_csrf_field(); ?>
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="slug" value="<?php echo htmlspecialchars($slug); ?>">
    </form>
    <?php endif; ?>
</div>

<template id="faq-item-template">
    <div class="faq-item-card bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-3" data-index="__INDEX__">
        <input type="hidden" name="items[__INDEX__][id]" value="">
        <input type="hidden" name="items[__INDEX__][category_id]" value="">
        <input type="hidden" name="items[__INDEX__][is_active]" value="0">

        <div class="flex items-center justify-between gap-2">
            <h4 class="text-xs font-bold text-slate-800 faq-item-number">Question</h4>
            <div class="flex items-center space-x-1.5">
                <button type="button" onclick="moveFaqItem(this, -1)" title="Move up" class="w-7 h-7 rounded-lg bg-white border border-slate-200 text-slate-500 hover:text-brand-blue hover:border-blue-300 transition-colors flex items-center justify-center">
                    <i class="fas fa-arrow-up text-[9px]"></i>
                </button>
                <button type="button" onclick="moveFaqItem(this, 1)" title="Move down" class="w-7 h-7 rounded-lg bg-white border border-slate-200 text-slate-500 hover:text-brand-blue hover:border-blue-300 transition-colors flex items-center justify-center">
                    <i class="fas fa-arrow-down text-[9px]"></i>
                </button>
                <button type="button" onclick="removeFaqItem(this)" title="Remove question" class="w-7 h-7 rounded-lg bg-white border border-slate-200 text-red-500 hover:text-red-700 hover:border-red-300 transition-colors flex items-center justify-center">
                    <i class="fas fa-trash text-[9px]"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="md:col-span-2">
                <label class="block text-[11px] font-bold text-slate-700 mb-1">Question</label>
                <input type="text" name="items[__INDEX__][question]" value="" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-700 mb-1">Category <span class="font-normal text-slate-400">(optional)</span></label>
                <input type="text" name="items[__INDEX__][category]" value="" placeholder="e.g. Treatment" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-[11px] font-bold text-slate-700 mb-1">Answer</label>
            <textarea name="items[__INDEX__][answer]" rows="5" class="faq-answer-editor w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
        </div>

        <label class="inline-flex items-center space-x-2 text-[11px] font-semibold text-slate-700 cursor-pointer">
            <input type="checkbox" name="items[__INDEX__][is_active]" value="1" checked class="w-4 h-4 text-brand-blue rounded border-slate-300 focus:ring-blue-500">
            <span>Active (show on the website)</span>
        </label>
    </div>
</template>

<script>
function renumberFaqItems() {
    document.querySelectorAll('#faq-items-container .faq-item-card').forEach(function (card, i) {
        var label = card.querySelector('.faq-item-number');
        if (label) label.textContent = 'Question ' + (i + 1);
    });
}

function addFaqItem() {
    var container = document.getElementById('faq-items-container');
    var template = document.getElementById('faq-item-template');
    if (!container || !template) return;

    // Remove the empty-state placeholder if present.
    var empty = container.querySelector('.border-dashed');
    if (empty) empty.remove();

    var index = parseInt(container.getAttribute('data-next-index') || '0', 10);
    var html = template.innerHTML.replace(/__INDEX__/g, String(index));
    var wrapper = document.createElement('div');
    wrapper.innerHTML = html.trim();
    var card = wrapper.firstElementChild;
    if (!card) return;

    container.appendChild(card);
    container.setAttribute('data-next-index', String(index + 1));
    renumberFaqItems();

    if (typeof window.cmsInitRichEditors === 'function') {
        window.cmsInitRichEditors(card);
    }

    var question = card.querySelector('input[name$="[question]"]');
    if (question) question.focus();
}

function removeFaqItem(button) {
    var card = button.closest('.faq-item-card');
    if (card) card.remove();
    renumberFaqItems();
}

function moveFaqItem(button, direction) {
    var card = button.closest('.faq-item-card');
    var container = document.getElementById('faq-items-container');
    if (!card || !container) return;

    if (direction < 0 && card.previousElementSibling) {
        container.insertBefore(card, card.previousElementSibling);
    } else if (direction > 0 && card.nextElementSibling) {
        container.insertBefore(card.nextElementSibling, card);
    }
    renumberFaqItems();
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
