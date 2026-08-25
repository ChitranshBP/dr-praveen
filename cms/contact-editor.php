<?php
$pageTitle = 'Edit Phone & Contact Information';
require_once __DIR__ . '/includes/header.php';

$settings = CMS_DB::get('settings', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    $data = [
        'phone' => trim($_POST['phone'] ?? ''),
        'stroke_helpline' => trim($_POST['stroke_helpline'] ?? ''),
        'whatsapp' => trim($_POST['whatsapp'] ?? ''),
        'whatsapp_message' => trim($_POST['whatsapp_message'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'address' => trim($_POST['address'] ?? ''),
        'working_hours_weekdays' => trim($_POST['working_hours_weekdays'] ?? ''),
        'working_hours_sunday' => trim($_POST['working_hours_sunday'] ?? '')
    ];

    CMS_DB::setMultipleSettings($data);
    cms_set_flash('success', 'Phone and contact information updated successfully!');
    header('Location: contact-editor.php');
    exit;
}
?>

<div class="max-w-3xl bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
    <div class="pb-4 border-b border-slate-100 mb-6">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Phone, Helpline & Address</h2>
        <p class="text-xs text-slate-500 mt-1">Changes made here automatically update all phone buttons, helpline bars, and footers across the website.</p>
    </div>

    <form method="POST" action="" class="space-y-4">
        <?php echo cms_csrf_field(); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Primary Phone Number</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($settings['phone'] ?? '+91-87969-77903'); ?>" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Emergency Stroke Helpline</label>
                <input type="text" name="stroke_helpline" value="<?php echo htmlspecialchars($settings['stroke_helpline'] ?? '1800-309-0247'); ?>" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">WhatsApp Number (digits only)</label>
                <input type="text" name="whatsapp" value="<?php echo htmlspecialchars($settings['whatsapp'] ?? '918796977903'); ?>" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Contact Email Address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($settings['email'] ?? 'contact@drpraveengupta.com'); ?>" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Default WhatsApp Message</label>
                <input type="text" name="whatsapp_message" value="<?php echo htmlspecialchars($settings['whatsapp_message'] ?? 'Hello, I would like to book an appointment with Dr. Praveen Gupta.'); ?>" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Clinic Physical Address</label>
                <textarea name="address" rows="2" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($settings['address'] ?? ''); ?></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Weekday Timings</label>
                <input type="text" name="working_hours_weekdays" value="<?php echo htmlspecialchars($settings['working_hours_weekdays'] ?? 'Mon - Sat: 9 AM - 7 PM'); ?>" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Sunday Timings</label>
                <input type="text" name="working_hours_sunday" value="<?php echo htmlspecialchars($settings['working_hours_sunday'] ?? 'Sunday: Closed'); ?>" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">Save Contact Details</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
