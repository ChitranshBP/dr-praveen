<?php
$pageTitle = 'Site Settings & Branding';
require_once __DIR__ . '/includes/header.php';

$settings = CMS_DB::get('settings', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    $fields = [
        'site_name', 'site_tagline', 'site_url', 'phone', 'stroke_helpline',
        'email', 'address', 'whatsapp', 'whatsapp_message',
        'social_facebook', 'social_instagram', 'social_twitter', 'social_youtube', 'social_linkedin',
        'gtm_id', 'ga4_id', 'meta_pixel_id', 'custom_head_scripts', 'custom_body_scripts',
        'working_hours_weekdays', 'working_hours_sunday',
        'stats_patients', 'stats_awards', 'stats_rating', 'stats_experience'
    ];

    $updated = [];
    foreach ($fields as $f) {
        $updated[$f] = trim($_POST[$f] ?? '');
    }

    // Handle logo upload if provided
    $logoUpload = cms_handle_upload('logo_file', 'logo');
    if ($logoUpload && !isset($logoUpload['error'])) {
        $updated['logo_path'] = $logoUpload['path'];
    }

    CMS_DB::setMultipleSettings($updated);
    cms_set_flash('success', 'Site settings have been updated successfully!');
    header('Location: settings.php');
    exit;
}
?>

<form method="POST" action="" enctype="multipart/form-data" class="space-y-6 max-w-5xl">
    <?php echo cms_csrf_field(); ?>

    <!-- General & Branding Card -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 flex items-center">
            <i class="fas fa-globe text-brand-blue mr-2"></i> General & Branding
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Site Name</label>
                <input type="text" name="site_name" value="<?php echo htmlspecialchars($settings['site_name'] ?? ''); ?>" required class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Site Tagline</label>
                <input type="text" name="site_tagline" value="<?php echo htmlspecialchars($settings['site_tagline'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Site URL</label>
                <input type="url" name="site_url" value="<?php echo htmlspecialchars($settings['site_url'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    <!-- Contact & Helpline Card -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 flex items-center">
            <i class="fas fa-phone-alt text-brand-blue mr-2"></i> Contact & Helpline Numbers
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Primary Phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($settings['phone'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Emergency Stroke Helpline</label>
                <input type="text" name="stroke_helpline" value="<?php echo htmlspecialchars($settings['stroke_helpline'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($settings['email'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">WhatsApp Number (digits only)</label>
                <input type="text" name="whatsapp" value="<?php echo htmlspecialchars($settings['whatsapp'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Default WhatsApp Message</label>
                <input type="text" name="whatsapp_message" value="<?php echo htmlspecialchars($settings['whatsapp_message'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="md:col-span-3">
                <label class="block text-xs font-bold text-slate-700 mb-1">Clinic Address</label>
                <textarea name="address" rows="2" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($settings['address'] ?? ''); ?></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Weekday Hours</label>
                <input type="text" name="working_hours_weekdays" value="<?php echo htmlspecialchars($settings['working_hours_weekdays'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Sunday Hours</label>
                <input type="text" name="working_hours_sunday" value="<?php echo htmlspecialchars($settings['working_hours_sunday'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    <!-- Stats Badges -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 flex items-center">
            <i class="fas fa-trophy text-brand-blue mr-2"></i> Key Achievements & Statistics
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Patients Count</label>
                <input type="text" name="stats_patients" value="<?php echo htmlspecialchars($settings['stats_patients'] ?? '3,00,000+'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Awards Count</label>
                <input type="text" name="stats_awards" value="<?php echo htmlspecialchars($settings['stats_awards'] ?? '50+'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Rating</label>
                <input type="text" name="stats_rating" value="<?php echo htmlspecialchars($settings['stats_rating'] ?? '4.9'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Experience</label>
                <input type="text" name="stats_experience" value="<?php echo htmlspecialchars($settings['stats_experience'] ?? '20+ Years'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    <!-- Social Media Links -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 flex items-center">
            <i class="fas fa-share-alt text-brand-blue mr-2"></i> Social Media Links
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><i class="fab fa-facebook text-blue-600 mr-1.5"></i> Facebook URL</label>
                <input type="url" name="social_facebook" value="<?php echo htmlspecialchars($settings['social_facebook'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><i class="fab fa-instagram text-pink-600 mr-1.5"></i> Instagram URL</label>
                <input type="url" name="social_instagram" value="<?php echo htmlspecialchars($settings['social_instagram'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><i class="fab fa-twitter text-cyan-500 mr-1.5"></i> Twitter / X URL</label>
                <input type="url" name="social_twitter" value="<?php echo htmlspecialchars($settings['social_twitter'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><i class="fab fa-youtube text-red-600 mr-1.5"></i> YouTube URL</label>
                <input type="url" name="social_youtube" value="<?php echo htmlspecialchars($settings['social_youtube'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    <!-- Analytics & Tracking -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 flex items-center">
            <i class="fas fa-chart-line text-brand-blue mr-2"></i> Analytics & Tag Manager
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Google Tag Manager (GTM) Container ID</label>
                <input type="text" name="gtm_id" value="<?php echo htmlspecialchars($settings['gtm_id'] ?? ''); ?>" placeholder="GTM-XXXXXXX" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Google Analytics 4 (GA4) ID</label>
                <input type="text" name="ga4_id" value="<?php echo htmlspecialchars($settings['ga4_id'] ?? ''); ?>" placeholder="G-XXXXXXXXXX" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-end space-x-3 pt-4">
        <button type="submit" class="px-6 py-3 bg-brand-blue hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-500/25 transition-all">
            <i class="fas fa-save mr-1.5"></i> Save Settings
        </button>
    </div>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
