<?php
/**
 * Header, footer & shared-section copy. Every field here is printed by the
 * public templates through cms_text() (includes/cms-load.php); defaults are
 * the original hard-coded wording.
 */
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/cms-load.php';

cms_require_auth();

$fields = cms_site_text_fields();
$settings = CMS_DB::get('settings', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $updated = [];
    foreach ($fields as $key => $def) {
        if (!array_key_exists($key, $_POST)) continue;
        $v = trim((string)$_POST[$key]);
        // Saving the default (or nothing) stores '' so future default changes still apply.
        $updated[$key] = ($v === (string)$def[2]) ? '' : $v;
    }
    CMS_DB::setMultipleSettings($updated);
    cms_set_flash('success', 'Site text saved. The header, footer and shared sections are updated on the live site.');
    header('Location: site-text.php');
    exit;
}

$groups = [];
foreach ($fields as $key => $def) {
    $groups[$def[0]][$key] = $def;
}
$groupIcons = [
    'Footer CTA band' => 'fa-bullhorn', 'Footer' => 'fa-shoe-prints', 'Floating buttons' => 'fa-comment-dots',
    'Video testimonials section' => 'fa-video', 'Watch & Learn section' => 'fa-play-circle', 'FAQ sections' => 'fa-circle-question',
    '404 page' => 'fa-unlink', 'SEO defaults' => 'fa-search',
];

$pageTitle = 'Header, Footer & Shared Text';
require_once __DIR__ . '/includes/header.php';
$inp = 'w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none';
?>

<form method="POST" class="space-y-6 max-w-5xl">
    <?php echo cms_csrf_field(); ?>
    <div class="bg-gradient-to-r from-brand-indigo via-blue-950 to-brand-indigo text-white p-5 rounded-2xl shadow border border-white/10">
        <h2 class="text-sm font-extrabold">Text that appears on every page</h2>
        <p class="text-xs text-slate-300 mt-1">Footer call-to-action, footer columns, floating buttons and the shared “Video Testimonials”, “Watch &amp; Learn” and FAQ sections. Menu links are edited under <a href="navigation.php" class="underline font-semibold">Navigation</a>; phone numbers, address and hours under <a href="contact-editor.php" class="underline font-semibold">Phone &amp; Contact</a>. Clear a field to go back to the built-in wording.</p>
    </div>

    <?php foreach ($groups as $groupName => $groupFields): ?>
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 flex items-center">
            <i class="fas <?php echo $groupIcons[$groupName] ?? 'fa-font'; ?> text-brand-blue mr-2"></i> <?php echo htmlspecialchars($groupName); ?>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php foreach ($groupFields as $key => [$g, $label, $default, $type]):
                $val = (string)($settings[$key] ?? '');
                $shown = $val !== '' ? $val : $default;
            ?>
            <div class="<?php echo $type === 'textarea' ? 'md:col-span-2' : ''; ?>">
                <label class="block text-xs font-bold text-slate-700 mb-1"><?php echo htmlspecialchars($label); ?></label>
                <?php if ($type === 'textarea'): ?>
                <textarea name="<?php echo $key; ?>" rows="2" class="<?php echo $inp; ?>"><?php echo htmlspecialchars($shown); ?></textarea>
                <?php else: ?>
                <input type="text" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($shown); ?>" class="<?php echo $inp; ?> <?php echo $type === 'url' ? 'font-mono' : ''; ?>">
                <?php endif; ?>
                <?php if ($val !== '' && $val !== $default): ?><p class="text-[10px] text-slate-400 mt-1">Default: <?php echo htmlspecialchars(mb_strimwidth(strip_tags($default), 0, 90, '…')); ?></p><?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="flex items-center justify-end pt-2">
        <button type="submit" class="px-6 py-3 bg-brand-blue hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-lg"><i class="fas fa-save mr-1.5"></i> Save Text</button>
    </div>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
