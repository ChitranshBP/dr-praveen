<?php
$pageTitle = 'Site Settings & Branding';
require_once __DIR__ . '/includes/header.php';

$settings = CMS_DB::get('settings', []);
$currentUser = cms_current_user();

// Change Password form (separate action so it never mixes with settings save)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'change_password') {
    cms_verify_csrf();

    $current = (string)($_POST['current_password'] ?? '');
    $new     = (string)($_POST['new_password'] ?? '');
    $confirm = (string)($_POST['confirm_password'] ?? '');

    if (strlen($new) < 8) {
        cms_set_flash('error', 'New password must be at least 8 characters long.');
    } elseif ($new !== $confirm) {
        cms_set_flash('error', 'New password and confirmation do not match.');
    } else {
        $users = CMS_DB::get('users', []);
        $done = false;
        foreach ($users as &$u) {
            if (($u['id'] ?? '') === ($currentUser['id'] ?? '')) {
                if (!password_verify($current, $u['password'])) {
                    cms_set_flash('error', 'Current password is incorrect.');
                    $done = true;
                    break;
                }
                $u['password'] = password_hash($new, PASSWORD_BCRYPT);
                CMS_DB::set('users', $users);
                cms_set_flash('success', 'Password changed successfully.');
                $done = true;
                break;
            }
        }
        unset($u);
        if (!$done) {
            cms_set_flash('error', 'User account not found.');
        }
    }
    header('Location: settings.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    $fields = [
        'site_name', 'site_tagline', 'site_url', 'logo_alt', 'phone', 'stroke_helpline',
        'email', 'address', 'whatsapp', 'whatsapp_message',
        'homepage_meta_title', 'homepage_meta_description',
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
    cms_set_flash('success', 'Site settings and SEO metadata have been updated successfully!');
    header('Location: settings.php');
    exit;
}
?>

<form method="POST" action="" enctype="multipart/form-data" class="space-y-6 max-w-5xl">
    <?php echo cms_csrf_field(); ?>

    <!-- Homepage & Global SEO Card -->
    <div class="bg-gradient-to-br from-white to-blue-50/40 p-6 rounded-2xl border border-blue-100 shadow-sm space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-blue-100">
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center">
                <i class="fas fa-search text-brand-blue mr-2"></i> Homepage & Default SEO Meta Tags
            </h2>
            <span class="text-[11px] text-blue-700 font-semibold bg-blue-100/60 px-2.5 py-0.5 rounded-full">Google Default</span>
        </div>
        <div class="space-y-3">
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-bold text-slate-700">Homepage / Default Meta Title (&lt;title&gt;)</label>
                    <span class="text-[10px] text-slate-400">Recommended: 50 – 60 characters</span>
                </div>
                <input type="text" name="homepage_meta_title" value="<?php echo htmlspecialchars($settings['homepage_meta_title'] ?? ''); ?>" placeholder="Dr. Praveen Gupta – Best Neurologist in Gurgaon & Delhi NCR | Artemis Hospital" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-bold text-slate-700">Homepage / Default Meta Description (&lt;meta name="description"&gt;)</label>
                    <span class="text-[10px] text-slate-400">Recommended: 140 – 160 characters</span>
                </div>
                <textarea name="homepage_meta_description" rows="2" placeholder="Dr. Praveen Gupta is a world-renowned Neurologist in Gurgaon & Delhi NCR with 20+ years of experience in stroke, epilepsy, migraine, and neurological disorders." class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($settings['homepage_meta_description'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>

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
            <div class="md:col-span-2 bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold text-slate-800">
                        <i class="fas fa-image text-brand-blue mr-1"></i> Website Header & Footer Logo
                    </label>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Recommended: 300 × 80 px</span>
                </div>
                <p class="text-[10px] text-slate-500">Transparent PNG, SVG, or WebP format (Max 2MB). Ideal aspect ratio ~4:1 or 3:1.</p>
                <?php if (!empty($settings['logo_path'])): ?>
                <div class="flex items-center space-x-3 py-1">
                    <div class="bg-white p-2 rounded-lg border border-slate-200 inline-block">
                        <img src="../<?php echo htmlspecialchars($settings['logo_path']); ?>" class="h-8 max-w-xs object-contain" alt="Current Logo">
                    </div>
                    <span class="text-[10px] text-slate-400 font-mono"><?php echo htmlspecialchars($settings['logo_path']); ?></span>
                </div>
                <?php endif; ?>
                <input type="file" name="logo_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                <div class="pt-2 border-t border-slate-200/60">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Website Logo Alt Tag (SEO & Accessibility)</label>
                    <input type="text" name="logo_alt" value="<?php echo htmlspecialchars($settings['logo_alt'] ?? 'Dr. Praveen Gupta - Leading Neurologist Delhi NCR'); ?>" placeholder="e.g. Dr. Praveen Gupta - Leading Neurologist in Delhi NCR Logo" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
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

<!-- Change Password Card -->
<div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4 max-w-5xl mt-6">
    <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 flex items-center">
        <i class="fas fa-key text-brand-blue mr-2"></i> Change Admin Password
    </h2>
    <?php
    $usingDefaultPassword = false;
    foreach (CMS_DB::get('users', []) as $u) {
        if (($u['id'] ?? '') === ($currentUser['id'] ?? '') && password_verify('admin123', $u['password'] ?? '')) {
            $usingDefaultPassword = true;
            break;
        }
    }
    ?>
    <?php if ($usingDefaultPassword): ?>
    <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-xs font-semibold">
        <i class="fas fa-exclamation-triangle mr-1.5"></i>
        You are still using the default password. Please change it now.
    </div>
    <?php endif; ?>
    <form method="POST" action="" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        <?php echo cms_csrf_field(); ?>
        <input type="hidden" name="action" value="change_password">
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Current Password</label>
            <input type="password" name="current_password" required class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">New Password (min 8 chars)</label>
            <input type="password" name="new_password" required minlength="8" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Confirm New Password</label>
            <input type="password" name="confirm_password" required minlength="8" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="md:col-span-3 flex justify-end">
            <button type="submit" class="px-5 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-md transition-all">
                Update Password
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
