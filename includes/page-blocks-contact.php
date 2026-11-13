<?php
/**
 * CMS block renderers: contact details + enquiry form, Google map, full-screen
 * message (thank-you) and the blog listing variants (all / list).
 */

/* ----------------------------------------------------------------------------
 * contact-form — info cards on the left, enquiry form (api/save-lead.php) on the right
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_contact_form')) {
    function cms_render_block_contact_form(array $block, array $options = [], $slug = null) {
        $items = is_array($block['items'] ?? null) ? array_values(array_filter($block['items'], 'is_array')) : [];
        $badge = trim((string)($block['badge'] ?? ''));
        $title = trim((string)($block['title'] ?? ''));
        $pTitle = trim((string)($block['panel_title'] ?? ''));
        $pText = trim((string)($block['panel_text'] ?? ''));
        $submit = trim((string)($block['button_text'] ?? '')) ?: 'Send Message';
        $subjects = [];
        foreach (cms_block_bullets($block['bullets'] ?? []) as $line) {
            $parts = array_map('trim', explode('|', $line, 2));
            $subjects[] = ['value' => $parts[0], 'label' => $parts[1] ?? $parts[0]];
        }
        $labels = array_merge([
            'name' => 'FULL NAME', 'name_placeholder' => 'John Doe',
            'phone' => 'PHONE NUMBER', 'phone_placeholder' => '+91 98765 43210',
            'email' => 'EMAIL ADDRESS', 'email_placeholder' => 'john@example.com',
            'subject' => 'SELECT SUBJECT',
            'message' => 'YOUR MESSAGE', 'message_placeholder' => 'Tell us how we can help you...',
            'upload' => 'UPLOAD MEDICAL REPORTS (OPTIONAL)', 'upload_hint' => 'PDF, DOC, DOCX, JPG, PNG (Max 5MB)',
        ], isset($options['labels']) && is_array($options['labels']) ? $options['labels'] : []);
        $formType = (string)($options['form_type'] ?? 'Main Contact Form');
        $showUpload = !array_key_exists('show_upload', $options) || !empty($options['show_upload']);
        $action = (string)($options['action'] ?? 'api/save-lead.php');
        $hasPanel = $pTitle !== '' || $pText !== '' || !empty($subjects) || !empty($options['show_form']);
        cms_block_section_open($block, 'bg-white', 'py-12', '');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12">
            <div class="lg:col-span-5 space-y-8 observe">
                <div>
                    <?php if ($badge !== ''): ?><span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($badge); ?></span><?php endif; ?>
                    <?php if ($title !== ''): ?><h2 class="text-3xl font-bold text-dark-grey mt-2 mb-4"><?php echo cms_block_title_html($block); ?></h2><?php endif; ?>
                    <?php echo cms_section_paragraphs($block['text'] ?? '', 'text-dark-grey/70 text-sm leading-relaxed', ''); ?>
                </div>
                <?php if (!empty($items)): ?>
                <div class="space-y-4">
                    <?php foreach ($items as $it): list($bgC, , $txtC) = cms_block_color($it['color'] ?? 'electric-blue');
                        $line1 = cms_resolve_stat_tokens(trim((string)($it['text'] ?? '')));
                        $line2 = cms_resolve_stat_tokens(trim((string)($it['subtitle'] ?? '')));
                    ?>
                    <div class="flex items-start space-x-4 p-5 bg-[#edf5f9] rounded-2xl border border-slate-200/40">
                        <div class="w-11 h-11 <?php echo $bgC; ?> rounded-xl flex items-center justify-center <?php echo $txtC; ?> flex-shrink-0">
                            <i class="<?php echo htmlspecialchars(cms_block_icon_class($it['icon'] ?? '', 'fas fa-phone-alt')); ?>"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark-grey text-base"><?php echo htmlspecialchars(trim((string)($it['title'] ?? ''))); ?></h4>
                            <?php if ($line1 !== ''): ?><p class="text-sm text-dark-grey/65 mt-0.5"><?php echo htmlspecialchars($line1); ?></p><?php endif; ?>
                            <?php if ($line2 !== ''): ?><p class="text-xs text-dark-grey/<?php echo $line1 === '' ? '65 mt-0.5' : '50'; ?>"><?php echo htmlspecialchars($line2); ?></p><?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ($hasPanel): ?>
            <div class="lg:col-span-7 bg-slate-50/50 rounded-3xl p-6 md:p-10 border border-slate-200/60 observe">
                <?php if ($pTitle !== ''): ?><h3 class="text-2xl font-bold text-dark-grey mb-2"><?php echo htmlspecialchars($pTitle); ?></h3><?php endif; ?>
                <?php if ($pText !== ''): ?><p class="text-sm text-dark-grey/60 mb-8"><?php echo htmlspecialchars($pText); ?></p><?php endif; ?>

                <form id="contact-form" class="space-y-6" accept-charset="UTF-8" action="<?php echo htmlspecialchars($action); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="form_type" value="<?php echo htmlspecialchars($formType); ?>">
                    <div class="hidden" aria-hidden="true">
                        <label for="website">Website</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                    </div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-xs font-semibold text-dark-grey mb-2"><?php echo htmlspecialchars($labels['name']); ?></label>
                            <input type="text" id="name" name="name" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey" placeholder="<?php echo htmlspecialchars($labels['name_placeholder']); ?>">
                        </div>
                        <div>
                            <label for="phone" class="block text-xs font-semibold text-dark-grey mb-2"><?php echo htmlspecialchars($labels['phone']); ?></label>
                            <input type="tel" id="phone" name="phone" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey" placeholder="<?php echo htmlspecialchars($labels['phone_placeholder']); ?>">
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-xs font-semibold text-dark-grey mb-2"><?php echo htmlspecialchars($labels['email']); ?></label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey" placeholder="<?php echo htmlspecialchars($labels['email_placeholder']); ?>">
                        </div>
                        <?php if (!empty($subjects)): ?>
                        <div>
                            <label for="subject" class="block text-xs font-semibold text-dark-grey mb-2"><?php echo htmlspecialchars($labels['subject']); ?></label>
                            <select id="subject" name="subject" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey">
                                <?php foreach ($subjects as $s): ?>
                                <option value="<?php echo htmlspecialchars($s['value']); ?>"><?php echo htmlspecialchars($s['label']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="message" class="block text-xs font-semibold text-dark-grey mb-2"><?php echo htmlspecialchars($labels['message']); ?></label>
                        <textarea id="message" name="message" rows="4" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey" placeholder="<?php echo htmlspecialchars($labels['message_placeholder']); ?>"></textarea>
                    </div>
                    <?php if ($showUpload): ?>
                    <div>
                        <label class="block text-xs font-semibold text-dark-grey mb-2"><?php echo htmlspecialchars($labels['upload']); ?></label>
                        <div class="relative flex items-center justify-center border-2 border-dashed border-slate-200 rounded-xl p-6 bg-white hover:bg-slate-50 transition-colors cursor-pointer group">
                            <input type="file" id="report" name="report" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                            <div class="text-center">
                                <i class="fas fa-cloud-upload-alt text-2xl text-slate-400 group-hover:text-electric-blue transition-colors mb-2"></i>
                                <p class="text-xs text-dark-grey/70"><span class="text-electric-blue font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-[10px] text-dark-grey/40 mt-1"><?php echo htmlspecialchars($labels['upload_hint']); ?></p>
                            </div>
                        </div>
                        <div id="file-name-preview" class="hidden mt-2 p-2.5 bg-electric-blue/5 rounded-xl border border-electric-blue/10 flex items-center justify-between text-xs text-electric-blue font-medium animate-fade-in">
                            <div class="flex items-center space-x-2 truncate">
                                <i class="far fa-file text-base"></i>
                                <span class="truncate" id="file-name-text">filename.pdf</span>
                            </div>
                            <button type="button" id="remove-file-btn" class="text-red-500 hover:text-red-700 transition-colors pl-2" aria-label="Remove file"><i class="fas fa-times-circle text-base"></i></button>
                        </div>
                    </div>
                    <?php endif; ?>
                    <button type="submit" class="w-full inline-flex items-center justify-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold py-3.5 rounded-xl hover:shadow-xl hover:shadow-electric-blue/30 transition-all duration-300">
                        <span><?php echo htmlspecialchars($submit); ?></span>
                        <i class="fas fa-paper-plane text-xs"></i>
                    </button>
                </form>
                <?php if ($showUpload): ?>
                <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const fileInput = document.getElementById('report');
                    const previewContainer = document.getElementById('file-name-preview');
                    if (!fileInput || !previewContainer) return;
                    const fileNameText = document.getElementById('file-name-text');
                    const fileIcon = previewContainer.querySelector('i');
                    fileInput.addEventListener('change', function () {
                        if (fileInput.files.length > 0) {
                            const file = fileInput.files[0];
                            fileNameText.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                            const ext = file.name.split('.').pop().toLowerCase();
                            fileIcon.className = ext === 'pdf' ? 'far fa-file-pdf text-base text-red-500' : (['jpg', 'jpeg', 'png'].includes(ext) ? 'far fa-file-image text-base text-emerald-500' : (['doc', 'docx'].includes(ext) ? 'far fa-file-word text-base text-blue-500' : 'far fa-file text-base text-slate-500'));
                            previewContainer.classList.remove('hidden');
                        } else {
                            previewContainer.classList.add('hidden');
                        }
                    });
                    document.getElementById('remove-file-btn').addEventListener('click', function () {
                        fileInput.value = '';
                        previewContainer.classList.add('hidden');
                    });
                });
                </script>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * map — heading + Google Maps iframe (Settings → maps_embed_url, or options.embed_url)
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_map')) {
    function cms_render_block_map(array $block, array $options = [], $slug = null) {
        global $cmsSettings;
        $embed = trim((string)($options['embed_url'] ?? ''));
        if ($embed === '') $embed = trim((string)($cmsSettings['maps_embed_url'] ?? ''));
        if ($embed === '') $embed = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3509.0274423192873!2d77.09722769999999!3d28.4184288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d18db30f58d29%3A0x34e8f9f94a91b569!2sDr.%20Praveen%20Gupta!5e0!3m2!1sen!2sin!4v1786967899128!5m2!1sen!2sin';
        $badge = trim((string)($block['badge'] ?? ''));
        $title = trim((string)($block['title'] ?? ''));
        $desc = trim((string)($block['description'] ?? ''));
        cms_block_section_open($block, 'bg-[#edf5f9]', 'py-12', '');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if ($badge !== '' || $title !== '' || $desc !== ''): ?>
        <div class="text-center max-w-3xl mx-auto mb-10">
            <?php if ($badge !== ''): ?><span class="text-electric-blue font-semibold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($badge); ?></span><?php endif; ?>
            <?php if ($title !== ''): ?><h2 class="text-3xl font-bold text-dark-grey mt-2"><?php echo cms_block_title_html($block); ?></h2><?php endif; ?>
            <?php if ($desc !== ''): ?><p class="text-sm text-dark-grey/65 mt-3 leading-relaxed"><?php echo htmlspecialchars($desc); ?></p><?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="bg-white rounded-[32px] overflow-hidden shadow-lg border border-slate-200/50 aspect-video md:aspect-[21/9] w-full">
            <iframe class="w-full h-full border-0" src="<?php echo htmlspecialchars($embed); ?>" title="<?php echo htmlspecialchars($title !== '' ? $title : 'Map'); ?>" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </div>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * message-hero — full-height gradient message with icon, heading, link cards (thank-you page)
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_render_block_message_hero')) {
    function cms_render_block_message_hero(array $block, array $options = [], $slug = null) {
        $items = is_array($block['items'] ?? null) ? array_values(array_filter($block['items'], 'is_array')) : [];
        $icon = trim((string)($block['badge_icon'] ?? 'fa-check'));
        $title = trim((string)($block['title'] ?? ''));
        $sub = trim((string)($block['description'] ?? ''));
        $text = trim((string)($block['text'] ?? ''));
        $back = trim((string)($block['button_text'] ?? ''));
        ?>
<section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 pb-16 -mt-20">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute -left-20 top-20 w-96 h-96 bg-white rounded-full blur-[100px]"></div>
        <div class="absolute -right-20 bottom-20 w-96 h-96 bg-cyan-accent rounded-full blur-[100px]"></div>
    </div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-8 animate-fade-in-up">
        <?php if ($icon !== '' && $icon !== 'none'): ?>
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white/10 backdrop-blur-md border border-white/20 shadow-lg relative">
            <span class="absolute inset-0 rounded-full bg-white/5 animate-ping pointer-events-none"></span>
            <i class="<?php echo htmlspecialchars(cms_block_icon_class($icon)); ?> text-4xl text-cyan-accent"></i>
        </div>
        <?php endif; ?>
        <div class="space-y-4">
            <?php if ($title !== ''): ?><h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold font-serif tracking-tight"><?php echo cms_block_title_html($block); ?></h1><?php endif; ?>
            <?php if ($sub !== ''): ?><h2 class="text-xl md:text-2xl font-semibold text-white/90"><?php echo htmlspecialchars($sub); ?></h2><?php endif; ?>
            <?php if ($text !== ''): ?><p class="text-sm md:text-base text-white/80 max-w-xl mx-auto leading-relaxed"><?php echo cms_render_html(cms_resolve_stat_tokens($text)); ?></p><?php endif; ?>
        </div>
        <?php if (!empty($items)): ?>
        <div class="grid sm:grid-cols-2 gap-4 max-w-lg mx-auto pt-6 text-left">
            <?php foreach ($items as $it): $red = ($it['color'] ?? '') === 'red'; $href = cms_nav_href($it['url'] ?? '#'); ?>
            <a href="<?php echo htmlspecialchars($href); ?>" class="<?php echo $red ? 'bg-red-500/10 hover:bg-red-500/20 border border-red-500/20' : 'bg-white/5 hover:bg-white/10 border border-white/10'; ?> rounded-2xl p-5 flex items-start space-x-4 transition-all duration-300 group">
                <span class="w-10 h-10 rounded-xl <?php echo $red ? 'bg-red-500/20 text-red-400' : 'bg-cyan-accent/20 text-cyan-accent'; ?> flex items-center justify-center flex-shrink-0">
                    <i class="<?php echo htmlspecialchars(cms_block_icon_class($it['icon'] ?? '', 'fas fa-home')); ?> text-base<?php echo $red ? ' animate-pulse' : ''; ?>"></i>
                </span>
                <div>
                    <h3 class="font-bold text-sm text-white <?php echo $red ? 'group-hover:text-red-400' : 'group-hover:text-cyan-accent'; ?> transition-colors"><?php echo htmlspecialchars(trim((string)($it['title'] ?? ''))); ?></h3>
                    <p class="text-[11px] text-white/70 mt-1 leading-normal"><?php echo htmlspecialchars(cms_resolve_stat_tokens(trim((string)($it['text'] ?? '')))); ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if ($back !== ''): ?>
        <div class="pt-4">
            <a href="<?php echo htmlspecialchars(cms_nav_href($block['button_url'] ?? '/')); ?>" class="inline-flex items-center space-x-2 text-xs font-bold text-cyan-accent hover:text-white uppercase tracking-wider group transition-colors">
                <i class="fas fa-arrow-left text-[9px] group-hover:-translate-x-0.5 transition-transform"></i>
                <span><?php echo htmlspecialchars($back); ?></span>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>
        <?php
    }
}

/* ----------------------------------------------------------------------------
 * blog-grid variants
 * -------------------------------------------------------------------------- */
if (!function_exists('cms_blog_grid_variant_all')) {
    /** blog page: pill header + 3-column grid of every published article */
    function cms_blog_grid_variant_all(array $block, array $options) {
        $posts = function_exists('cms_blogs_published') ? cms_blogs_published() : [];
        $limit = (int)($block['limit'] ?? 0);
        if ($limit > 0) $posts = array_slice($posts, 0, $limit);
        cms_block_section_open($block, 'bg-white');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
        <?php if (empty($posts)): ?>
        <div class="text-center py-16"><p class="text-dark-grey/60"><?php echo htmlspecialchars($options['empty_text'] ?? 'New articles are coming soon. Please check back shortly.'); ?></p></div>
        <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($posts as $blogIdx => $post):
                $postUrl = 'blog/' . urlencode($post['slug'] ?? '');
                $postDate = !empty($post['date']) ? date('M j, Y', strtotime($post['date'])) : '';
            ?>
            <a href="<?php echo $postUrl; ?>" class="group bg-white rounded-3xl p-5 border border-silver-grey/50 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col observe" style="animation-delay: <?php echo ($blogIdx % 6) * 100; ?>ms;">
                <div class="w-full aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-soft-cyan to-silver-grey">
                    <img src="<?php echo htmlspecialchars($post['image'] ?? 'assets/services/migraine.png'); ?>" alt="<?php echo htmlspecialchars($post['image_alt'] ?? $post['title']); ?>" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="text-xl font-bold text-deep-indigo leading-snug mb-3 group-hover:text-electric-blue transition-colors duration-300"><?php echo htmlspecialchars($post['title']); ?></h3>
                <p class="text-sm text-dark-grey/70 leading-relaxed mb-5 flex-1"><?php echo cms_inline_html($post['excerpt'] ?? ''); ?></p>
                <div class="mt-auto pt-4 border-t border-silver-grey/60 flex items-center space-x-4">
                    <span class="inline-block bg-electric-blue/10 text-electric-blue text-xs font-bold px-3 py-1.5 rounded-full"><?php echo htmlspecialchars($post['category'] ?? 'Neurology'); ?></span>
                    <span class="text-xs text-dark-grey/45 font-medium"><?php echo htmlspecialchars($postDate); ?></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php cms_block_button($block); ?>
    </div>
</section>
        <?php
    }
}

if (!function_exists('cms_blog_grid_variant_list')) {
    /** blog hub: article list + categories sidebar + newsletter box (side card fields) */
    function cms_blog_grid_variant_list(array $block, array $options) {
        $posts = function_exists('cms_blogs_published') ? cms_blogs_published() : [];
        $limit = (int)($block['limit'] ?? 0);
        if ($limit > 0) $posts = array_slice($posts, 0, $limit);
        $categoryCounts = function_exists('cms_blog_categories') ? cms_blog_categories() : [];
        $pTitle = trim((string)($block['panel_title'] ?? ''));
        $pText = trim((string)($block['panel_text'] ?? ''));
        $subscribe = trim((string)($block['button_text'] ?? ''));
        $catHeading = (string)($options['categories_heading'] ?? 'Blog Categories');
        $catUrl = (string)($options['categories_url'] ?? 'blog.php');
        $byLabel = (string)($options['by_label'] ?? 'By');
        $readLabel = (string)($options['read_label'] ?? 'Read Article');
        cms_block_section_open($block, 'bg-white', 'py-12', '');
        ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php cms_render_pill_header($block); ?>
        <div class="grid lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 space-y-8">
                <?php if (empty($posts)): ?>
                <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-10 text-center"><p class="text-dark-grey/60"><?php echo htmlspecialchars($options['empty_text'] ?? 'New articles are coming soon. Please check back shortly.'); ?></p></div>
                <?php else: ?>
                <?php foreach ($posts as $post):
                    $postUrl = 'blog/' . urlencode($post['slug'] ?? '');
                    $postDate = !empty($post['date']) ? date('F j, Y', strtotime($post['date'])) : '';
                ?>
                <article class="bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 grid md:grid-cols-12 gap-6 p-6">
                    <div class="md:col-span-5 aspect-video md:aspect-square bg-slate-200 rounded-2xl overflow-hidden">
                        <img src="<?php echo htmlspecialchars($post['image'] ?? 'assets/services/stroke.png'); ?>" width="640" height="480" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="<?php echo htmlspecialchars($post['image_alt'] ?? $post['title']); ?>" loading="lazy">
                    </div>
                    <div class="md:col-span-7 flex flex-col justify-between py-2">
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3 text-xs">
                                <span class="bg-electric-blue/10 text-electric-blue font-semibold px-2.5 py-1 rounded-md"><?php echo htmlspecialchars($post['category'] ?? 'Neurology'); ?></span>
                                <span class="text-dark-grey/40"><?php echo htmlspecialchars($postDate); ?></span>
                            </div>
                            <h3 class="text-xl font-bold text-dark-grey leading-snug hover:text-electric-blue transition-colors duration-300"><a href="<?php echo $postUrl; ?>"><?php echo htmlspecialchars($post['title']); ?></a></h3>
                            <p class="text-sm text-dark-grey/65 leading-relaxed line-clamp-3"><?php echo cms_inline_html($post['excerpt'] ?? ''); ?></p>
                        </div>
                        <div class="pt-4 flex items-center justify-between text-xs text-dark-grey/50">
                            <span><?php echo htmlspecialchars($byLabel . ' ' . ($post['author'] ?? 'Dr. Praveen Gupta')); ?></span>
                            <a href="<?php echo $postUrl; ?>" class="font-semibold text-electric-blue hover:text-deep-indigo transition-colors"><?php echo htmlspecialchars($readLabel); ?> <i class="fas fa-chevron-right text-[8px] ml-1"></i></a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="lg:col-span-4 space-y-8">
                <?php if (!empty($categoryCounts) && empty($options['hide_categories'])): ?>
                <div class="bg-slate-50 border border-slate-200/50 rounded-3xl p-6 md:p-8">
                    <h4 class="font-bold text-dark-grey text-base mb-4 pb-2 border-b border-slate-200/80"><?php echo htmlspecialchars($catHeading); ?></h4>
                    <ul class="space-y-3">
                        <?php foreach ($categoryCounts as $cat => $count): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars($catUrl); ?>" class="flex justify-between items-center text-sm font-semibold text-dark-grey/70 hover:text-electric-blue transition-colors">
                                <span><?php echo htmlspecialchars($cat); ?></span>
                                <span class="bg-white border border-slate-200/60 px-2 py-0.5 rounded text-xs text-dark-grey/50"><?php echo (int)$count; ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if ($pTitle !== '' || $subscribe !== ''): ?>
                <div class="bg-gradient-to-br from-deep-indigo to-dark-grey rounded-3xl p-6 md:p-8 text-white">
                    <?php if ($pTitle !== ''): ?><h4 class="font-bold text-lg mb-2"><?php echo htmlspecialchars($pTitle); ?></h4><?php endif; ?>
                    <?php if ($pText !== ''): ?><p class="text-xs text-white/70 leading-relaxed mb-6"><?php echo htmlspecialchars($pText); ?></p><?php endif; ?>
                    <form class="space-y-3" accept-charset="UTF-8" action="<?php echo htmlspecialchars($options['action'] ?? 'api/save-lead.php'); ?>" method="POST">
                        <input type="hidden" name="form_type" value="<?php echo htmlspecialchars($options['form_type'] ?? 'Blog Newsletter Subscription'); ?>">
                        <div class="hidden" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
                        <input type="email" name="email" required placeholder="<?php echo htmlspecialchars($options['email_placeholder'] ?? 'Your email address'); ?>" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:border-cyan-accent text-sm text-white placeholder-white/40">
                        <button type="submit" class="w-full bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold py-3 rounded-xl hover:shadow-lg transition-all duration-300"><?php echo htmlspecialchars($subscribe !== '' ? $subscribe : 'Subscribe'); ?></button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
        <?php
    }
}
