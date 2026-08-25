<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$settings = CMS_DB::get('settings', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    $updates = [
        'site_phone' => trim($_POST['site_phone'] ?? ''),
        'stroke_helpline' => trim($_POST['stroke_helpline'] ?? ''),
        'site_whatsapp' => trim($_POST['site_whatsapp'] ?? ''),
        'site_email' => trim($_POST['site_email'] ?? ''),
        'site_address' => trim($_POST['site_address'] ?? ''),
        'working_hours' => trim($_POST['working_hours'] ?? ''),
    ];

    CMS_DB::setMultipleSettings($updates);
    cms_set_flash('success', 'Phone, WhatsApp, and contact information updated successfully.');
    header('Location: contact-editor.php');
    exit;
}

$pageTitle = 'Edit Contact Information';
require_once __DIR__ . '/includes/header.php';
?>

<div class="max-w-2xl bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-6">
    <div class="pb-4 border-b border-slate-100">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Contact & Phone Numbers</h2>
        <p class="text-xs text-slate-500 mt-1">Changes made here automatically update the header, footer, mobile call buttons, and WhatsApp link.</p>
    </div>

    <form method="POST" action="" class="space-y-4">
        <?php echo cms_csrf_field(); ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Primary Phone Number</label>
                <input type="text" name="site_phone" value="<?php echo htmlspecialchars($settings['site_phone'] ?? '+91-9810000000'); ?>" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">24/7 Stroke Helpline</label>
                <input type="text" name="stroke_helpline" value="<?php echo htmlspecialchars($settings['stroke_helpline'] ?? '1800-123-4567'); ?>" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">WhatsApp Chat Number</label>
                <input type="text" name="site_whatsapp" value="<?php echo htmlspecialchars($settings['site_whatsapp'] ?? '919810000000'); ?>" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Address</label>
                <input type="email" name="site_email" value="<?php echo htmlspecialchars($settings['site_email'] ?? 'contact@drpraveengupta.in'); ?>" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Clinic Address</label>
            <textarea name="site_address" rows="3" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($settings['site_address'] ?? 'Marengo Asia Hospitals, Sector 56, Gurgaon, Haryana 122011'); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Consultation / OPD Hours</label>
            <input type="text" name="working_hours" value="<?php echo htmlspecialchars($settings['working_hours'] ?? 'Mon - Sat: 9:00 AM - 6:00 PM'); ?>" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">Save Contact Details</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
