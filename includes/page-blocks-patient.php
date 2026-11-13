<?php
/**
 * CMS block renderers for the patient-information pages: checklist card
 * (nested beside split-panel copy), enquiry form card, emergency banner and
 * rich text (legal pages).
 */

if (!function_exists('cms_lead_form_fields')) {
    /** Shared field definitions for the small lead forms (labels / placeholders / type). */
    function cms_lead_form_fields() {
        return [
            'name'      => ['label' => 'FULL NAME', 'placeholder' => 'John Doe', 'type' => 'text'],
            'phone'     => ['label' => 'PHONE NUMBER', 'placeholder' => 'Phone Number', 'type' => 'tel'],
            'email'     => ['label' => 'EMAIL ADDRESS', 'placeholder' => 'Email Address', 'type' => 'email'],
            'inquiry'   => ['label' => 'NATURE OF INQUIRY', 'placeholder' => 'Describe your query or symptom concerns...', 'type' => 'textarea'],
            'diagnosis' => ['label' => 'CURRENT DIAGNOSIS / ISSUES', 'placeholder' => 'Briefly describe your current neurological condition...', 'type' => 'textarea'],
            'message'   => ['label' => 'YOUR MESSAGE', 'placeholder' => 'Tell us how we can help you...', 'type' => 'textarea'],
        ];
    }
}

/* ----------------------------------------------------------------------------
 * checklist — card with title, intro, icon list and optional quick form.
 * options: theme light (soft-cyan gradient) | dark (indigo gradient) | white
 *          style  list | steps (numbered, first step red)
 *          form_fields ['name','phone'], form_label 'Quick Request', form_type
 * Rendered inside a split-panel (aside_key) or as its own section.
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_checklist')) {
    function cms_render_block_checklist(array $block, array $options = [], $slug = null) {
        $items = is_array($block['items'] ?? null) ? array_values(array_filter($block['items'], 'is_array')) : [];
        $title = trim((string)($block['title'] ?? ''));
        $text = trim((string)($block['text'] ?? ($block['description'] ?? '')));
        $button = trim((string)($block['button_text'] ?? ''));
        $theme = $options['theme'] ?? 'light';
        $style = $options['style'] ?? 'list';
        $nested = !empty($block['nested']);
        $card = ['light' => 'bg-gradient-to-br from-soft-cyan to-white p-8 rounded-3xl border border-cyan-accent/20 space-y-6',
                 'dark' => 'bg-gradient-to-br from-deep-indigo to-indigo-950 text-white p-8 rounded-3xl space-y-6',
                 'white' => 'bg-white p-8 rounded-3xl border border-silver-grey/40 space-y-6'][$theme] ?? 'bg-white p-8 rounded-3xl border border-silver-grey/40 space-y-6';
        $dark = $theme === 'dark';
        $fieldDefs = cms_lead_form_fields();
        $formFields = isset($options['form_fields']) && is_array($options['form_fields']) ? $options['form_fields'] : ['name', 'phone'];
        if (!$nested) {
            cms_block_section_open($block, 'bg-white', 'py-16', '');
            echo '<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">';
        }
        ?>
            <div class="<?php echo $card; ?>">
                <?php if ($title !== ''): ?><h3 class="text-xl font-bold <?php echo $dark ? '' : 'text-deep-indigo '; ?>font-serif"><?php echo htmlspecialchars($title); ?></h3><?php endif; ?>
                <?php if ($text !== ''): ?><p class="text-xs <?php echo $dark ? 'text-white/80' : 'text-dark-grey/65'; ?> leading-relaxed"><?php echo cms_render_html(cms_resolve_stat_tokens($text)); ?></p><?php endif; ?>

                <?php if (!empty($items) && $style === 'steps'): ?>
                <div class="space-y-4">
                    <?php foreach ($items as $i => $it): ?>
                    <div class="p-4 <?php echo $i === 0 ? 'bg-red-50/50' : 'bg-slate-50'; ?> rounded-2xl flex items-start space-x-3">
                        <span class="w-6 h-6 <?php echo $i === 0 ? 'bg-red-600' : 'bg-deep-indigo'; ?> text-white font-bold rounded-full flex items-center justify-center text-xs flex-shrink-0"><?php echo $i + 1; ?></span>
                        <div class="text-xs"><?php if (trim((string)($it['title'] ?? '')) !== ''): ?><strong class="text-deep-indigo"><?php echo htmlspecialchars(trim($it['title'])); ?></strong> <?php endif; ?><?php echo htmlspecialchars(trim((string)($it['text'] ?? ''))); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php elseif (!empty($items)): ?>
                <ul class="space-y-4 text-xs <?php echo $dark ? 'text-white/80' : 'text-dark-grey/70'; ?>">
                    <?php foreach ($items as $it): ?>
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 <?php echo $dark ? 'bg-white/10 text-cyan-accent' : 'bg-cyan-accent/20 text-cyan-700'; ?> font-bold rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><i class="<?php echo htmlspecialchars(cms_block_icon_class($it['icon'] ?? '', 'fas fa-check')); ?> text-[10px]"></i></span>
                        <div><?php if (trim((string)($it['title'] ?? '')) !== ''): ?><strong class="<?php echo $dark ? 'text-white' : 'text-deep-indigo'; ?>"><?php echo htmlspecialchars(trim($it['title'])); ?></strong> <?php endif; ?><?php echo htmlspecialchars(trim((string)($it['text'] ?? ''))); ?></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php if ($button !== ''): $uid = 'cl-' . substr(md5($title . $button), 0, 6); ?>
                <form class="pt-4 border-t <?php echo $dark ? 'border-white/10' : 'border-cyan-accent/20'; ?> space-y-3" accept-charset="UTF-8" action="<?php echo htmlspecialchars($options['action'] ?? 'api/save-lead.php'); ?>" method="POST">
                    <input type="hidden" name="form_type" value="<?php echo htmlspecialchars($options['form_type'] ?? ($title !== '' ? $title : 'Quick Request')); ?>">
                    <div class="hidden" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
                    <?php if (!empty($options['form_label'])): ?><span class="block text-xs font-bold <?php echo $dark ? 'text-white' : 'text-deep-indigo'; ?> uppercase tracking-wider"><?php echo htmlspecialchars($options['form_label']); ?></span><?php endif; ?>
                    <?php foreach ($formFields as $f): if (!isset($fieldDefs[$f])) continue; $d = $fieldDefs[$f]; $inputCls = $dark ? 'w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-cyan-accent text-xs text-white placeholder-white/60' : 'w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-xs text-dark-grey placeholder-dark-grey/50'; ?>
                    <div>
                        <label for="<?php echo $uid . '-' . $f; ?>" class="sr-only"><?php echo htmlspecialchars(ucwords(strtolower($d['label']))); ?></label>
                        <?php if ($d['type'] === 'textarea'): ?>
                        <textarea id="<?php echo $uid . '-' . $f; ?>" name="<?php echo $f; ?>" rows="3" required placeholder="<?php echo htmlspecialchars($d['placeholder']); ?>" class="<?php echo $inputCls; ?>"></textarea>
                        <?php else: ?>
                        <input type="<?php echo $d['type']; ?>" id="<?php echo $uid . '-' . $f; ?>" name="<?php echo $f; ?>" required placeholder="<?php echo htmlspecialchars($f === 'name' ? 'Your Name' : $d['placeholder']); ?>" class="<?php echo $inputCls; ?>">
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                    <div>
                        <button type="submit" class="block w-full text-center <?php echo $dark ? 'bg-cyan-accent hover:bg-cyan-500 text-deep-indigo' : 'bg-deep-indigo hover:bg-electric-blue text-white'; ?> font-bold py-2.5 rounded-xl transition-all duration-300 text-xs shadow-md"><?php echo htmlspecialchars($button); ?></button>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        <?php
        if (!$nested) {
            echo '</div></section>';
        }
    }
}

/* ----------------------------------------------------------------------------
 * form-card — centered gradient card with badge, heading, intro and a lead form
 * options: theme indigo | red; fields ['name','phone','inquiry']; form_type; labels {key: label}
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_form_card')) {
    function cms_render_block_form_card(array $block, array $options = [], $slug = null) {
        $badge = trim((string)($block['badge'] ?? ''));
        $title = trim((string)($block['title'] ?? ''));
        $desc = trim((string)($block['description'] ?? ''));
        $button = trim((string)($block['button_text'] ?? '')) ?: 'Submit';
        $red = ($options['theme'] ?? 'indigo') === 'red';
        $fieldDefs = cms_lead_form_fields();
        $labels = isset($options['labels']) && is_array($options['labels']) ? $options['labels'] : [];
        $fields = isset($options['fields']) && is_array($options['fields']) ? $options['fields'] : ['name', 'phone', 'message'];
        $inputCls = 'w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-xl focus:outline-none ' . ($red ? 'focus:border-red-400' : 'focus:border-cyan-accent') . ' text-xs text-white placeholder-white/50';
        $uid = 'fc-' . substr(md5($title . $button), 0, 6);
        cms_block_section_open($block, 'bg-white', 'py-16', 'border-t border-b border-silver-grey/40');
        ?>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br <?php echo $red ? 'from-red-800 to-slate-950' : 'from-deep-indigo to-indigo-950'; ?> text-white rounded-[32px] p-8 md:p-12 shadow-xl relative overflow-hidden">
            <div class="absolute -right-24 -bottom-24 w-96 h-96 <?php echo $red ? 'bg-red-650/15' : 'bg-cyan-accent/15'; ?> rounded-full blur-[100px] pointer-events-none"></div>
            <div class="relative z-10 space-y-6">
                <div class="text-center max-w-2xl mx-auto">
                    <?php if ($badge !== ''): ?><span class="<?php echo $red ? 'text-red-400' : 'text-cyan-accent'; ?> font-bold text-xs uppercase tracking-widest"><?php echo htmlspecialchars($badge); ?></span><?php endif; ?>
                    <?php if ($title !== ''): ?><h2 class="text-2xl md:text-3xl font-bold font-serif mt-2"><?php echo cms_block_title_html($block); ?></h2><?php endif; ?>
                    <?php if ($desc !== ''): ?><p class="text-white/80 text-xs mt-2 leading-relaxed"><?php echo htmlspecialchars($desc); ?></p><?php endif; ?>
                </div>
                <form class="space-y-4 pt-4 max-w-2xl mx-auto" accept-charset="UTF-8" action="<?php echo htmlspecialchars($options['action'] ?? 'api/save-lead.php'); ?>" method="POST">
                    <input type="hidden" name="form_type" value="<?php echo htmlspecialchars($options['form_type'] ?? ($title !== '' ? $title : 'Enquiry')); ?>">
                    <div class="hidden" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
                    <?php
                    $inline = array_values(array_filter($fields, function ($f) use ($fieldDefs) { return isset($fieldDefs[$f]) && $fieldDefs[$f]['type'] !== 'textarea'; }));
                    $areas = array_values(array_filter($fields, function ($f) use ($fieldDefs) { return isset($fieldDefs[$f]) && $fieldDefs[$f]['type'] === 'textarea'; }));
                    ?>
                    <?php if (!empty($inline)): ?>
                    <div class="grid md:grid-cols-<?php echo min(3, count($inline)); ?> gap-4">
                        <?php foreach ($inline as $f): $d = $fieldDefs[$f]; ?>
                        <div>
                            <label for="<?php echo $uid . '-' . $f; ?>" class="block text-xs font-semibold text-white/95 mb-2"><?php echo htmlspecialchars($labels[$f] ?? $d['label']); ?></label>
                            <input type="<?php echo $d['type']; ?>" id="<?php echo $uid . '-' . $f; ?>" name="<?php echo $f; ?>" required placeholder="<?php echo htmlspecialchars($d['placeholder']); ?>" class="<?php echo $inputCls; ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <?php foreach ($areas as $f): $d = $fieldDefs[$f]; ?>
                    <div>
                        <label for="<?php echo $uid . '-' . $f; ?>" class="block text-xs font-semibold text-white/95 mb-2"><?php echo htmlspecialchars($labels[$f] ?? $d['label']); ?></label>
                        <textarea id="<?php echo $uid . '-' . $f; ?>" name="<?php echo $f; ?>" rows="3" required placeholder="<?php echo htmlspecialchars($d['placeholder']); ?>" class="<?php echo $inputCls; ?>"></textarea>
                    </div>
                    <?php endforeach; ?>
                    <div class="pt-2">
                        <button type="submit" class="block w-full text-center <?php echo $red ? 'bg-red-600 hover:bg-red-700 text-white shadow-red-600/20' : 'bg-cyan-accent hover:bg-cyan-500 text-deep-indigo shadow-cyan-accent/20'; ?> font-bold py-3 rounded-xl transition-all duration-300 transform active:scale-95 text-xs shadow-lg"><?php echo htmlspecialchars($button); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * alert-banner — dark emergency banner with red badge, pills and a phone button
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_alert_banner')) {
    function cms_render_block_alert_banner(array $block, array $options = [], $slug = null) {
        $badge = trim((string)($block['badge'] ?? ''));
        $title = trim((string)($block['title'] ?? ''));
        $text = trim((string)($block['text'] ?? ''));
        $label = trim((string)($block['description'] ?? ''));
        $button = trim((string)($block['button_text'] ?? ''));
        $pills = cms_block_bullets($block['bullets'] ?? []);
        cms_block_section_open($block, 'bg-[#edf5f9]', 'py-12', 'border-y border-slate-200/60');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-deep-indigo to-dark-grey rounded-[32px] p-8 md:p-12 text-white relative overflow-hidden shadow-xl">
            <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="grid md:grid-cols-12 gap-8 items-center relative z-10">
                <div class="<?php echo $button !== '' ? 'md:col-span-8' : 'md:col-span-12'; ?> space-y-4">
                    <?php if ($badge !== ''): ?><span class="bg-red-500/20 text-red-300 text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full border border-red-500/30"><?php echo htmlspecialchars($badge); ?></span><?php endif; ?>
                    <?php if ($title !== ''): ?><h2 class="text-2xl md:text-3xl font-bold"><?php echo cms_block_title_html($block); ?></h2><?php endif; ?>
                    <?php if ($text !== ''): ?><p class="text-white/80 text-sm leading-relaxed max-w-2xl"><?php echo cms_render_html(cms_resolve_stat_tokens($text)); ?></p><?php endif; ?>
                    <?php if (!empty($pills)): ?>
                    <div class="flex flex-wrap gap-4 text-xs font-semibold text-white/95 pt-2">
                        <?php foreach ($pills as $p): $parts = array_map('trim', explode('|', $p, 2)); ?>
                        <span class="bg-white/10 px-3.5 py-2 rounded-xl"><?php if (count($parts) === 2): ?><strong class="text-cyan-accent"><?php echo htmlspecialchars($parts[0]); ?></strong> - <?php echo htmlspecialchars($parts[1]); ?><?php else: ?><?php echo htmlspecialchars($parts[0]); ?><?php endif; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if ($button !== ''): $href = cms_nav_href($block['button_url'] ?? '{stroke-helpline}'); ?>
                <div class="md:col-span-4 text-left md:text-right space-y-4">
                    <?php if ($label !== ''): ?><span class="block text-xs text-white/60"><?php echo htmlspecialchars($label); ?></span><?php endif; ?>
                    <a href="<?php echo htmlspecialchars($href); ?>" class="inline-flex items-center space-x-3 bg-red-600 hover:bg-red-700 text-white font-bold text-xl px-6 py-4 rounded-2xl shadow-lg hover:shadow-red-600/30 transition-all duration-300">
                        <i class="fas fa-phone-alt animate-bounce"></i>
                        <span><?php echo htmlspecialchars(cms_resolve_stat_tokens($button)); ?></span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * richtext — long-form HTML body (legal pages)
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_richtext')) {
    function cms_render_block_richtext(array $block, array $options = [], $slug = null) {
        $html = trim((string)($block['text'] ?? ''));
        if ($html === '') return;
        cms_block_section_open($block, 'bg-white', 'py-16', '');
        ?>
    <div class="<?php echo htmlspecialchars($options['container'] ?? 'max-w-4xl'); ?> mx-auto px-4 sm:px-6 lg:px-8">
        <div class="<?php echo htmlspecialchars($options['prose_class'] ?? 'prose prose-slate max-w-none space-y-8 text-dark-grey/80 leading-relaxed text-sm'); ?>">
            <?php echo cms_render_html(cms_resolve_stat_tokens($html)); ?>
        </div>
    </div>
</section>
        <?php
    }
}
