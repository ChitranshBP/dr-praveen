<?php
$pageTitle = 'Site Settings & Branding';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/fields.php';

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

    // Every key listed here has a matching input in the form below. Keys that
    // are NOT posted are left untouched so a save can never blank a setting
    // the form does not show.
    $fields = [
        'site_name', 'site_tagline', 'site_url', 'logo_alt', 'phone', 'stroke_helpline',
        'email', 'address', 'whatsapp', 'whatsapp_message',
        'homepage_meta_title', 'homepage_meta_description',
        'social_facebook', 'social_instagram', 'social_twitter', 'social_youtube', 'social_linkedin',
        'gtm_id', 'ga4_id', 'meta_pixel_id', 'custom_head_scripts', 'custom_body_scripts',
        'working_hours_weekdays', 'working_hours_sunday',
        'stats_patients', 'stats_success', 'stats_awards', 'stats_rating', 'stats_experience',
        'formester_url', 'lead_notify_email',
    ];

    $updated = [];
    foreach ($fields as $f) {
        if (array_key_exists($f, $_POST)) {
            $updated[$f] = trim((string)$_POST[$f]);
        }
    }
    if (isset($updated['whatsapp'])) {
        $updated['whatsapp'] = preg_replace('/\D+/', '', $updated['whatsapp']);
    }

    $uploadErrors = [];
    foreach (['logo_path' => 'logo', 'favicon_path' => 'favicon', 'default_og_image' => 'seo'] as $settingKey => $folder) {
        if (!array_key_exists($settingKey, $_POST) && empty($_FILES[cms_image_file_key($settingKey)])) {
            continue;
        }
        $res = cms_image_field_value($settingKey, $folder, (string)($settings[$settingKey] ?? ''));
        if ($res['error'] !== '') {
            $uploadErrors[] = $res['error'];
        }
        $updated[$settingKey] = $res['path'];
    }
    // Lists & categories used by collections (one option per line)
    foreach (['gallery_categories', 'video_categories'] as $listKey) {
        if (array_key_exists($listKey, $_POST)) {
            $updated[$listKey] = trim((string)$_POST[$listKey]);
        }
    }

    CMS_DB::setMultipleSettings($updated);
    if (!empty($uploadErrors)) {
        cms_set_flash('error', 'Settings saved, but an upload failed: ' . implode(' ', $uploadErrors));
    } else {
        cms_set_flash('success', 'Site settings and SEO metadata have been updated successfully!');
    }
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
            <div class="md:col-span-2 space-y-3">
                <?php cms_image_field('logo_path', $settings['logo_path'] ?? '', [
                    'label' => 'Website Header & Footer Logo', 'folder' => 'logo', 'size' => 'Recommended: 300 × 80 px',
                    'hint' => 'Transparent PNG or WebP, aspect ratio ~4:1. Remove to fall back to the built-in NeuroDoc logo.',
                    'preview_class' => 'w-36 h-14',
                ]); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <?php cms_image_field('favicon_path', $settings['favicon_path'] ?? '', [
                        'label' => 'Favicon (browser tab icon)', 'folder' => 'favicon', 'size' => '512 × 512 px',
                        'preview_class' => 'w-14 h-14',
                    ]); ?>
                    <?php cms_image_field('default_og_image', $settings['default_og_image'] ?? '', [
                        'label' => 'Default Social Share Image', 'folder' => 'seo', 'size' => '1200 × 630 px',
                        'hint' => 'Shown when a page is shared on WhatsApp / Facebook and no page-specific image is set.',
                        'preview_class' => 'w-24 h-14',
                    ]); ?>
                </div>

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
        <p class="text-[11px] text-slate-500 -mt-1">These numbers appear in the homepage statistics strip, the footer and the testimonials page. Section headings around them are edited in <a href="pages.php" class="text-brand-blue font-semibold underline">All Pages</a>.</p>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Patients Count</label>
                <input type="text" name="stats_patients" value="<?php echo htmlspecialchars($settings['stats_patients'] ?? '3,00,000+'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Success Stories</label>
                <input type="text" name="stats_success" value="<?php echo htmlspecialchars($settings['stats_success'] ?? '1,00,000+'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><i class="fab fa-linkedin text-blue-700 mr-1.5"></i> LinkedIn URL</label>
                <input type="url" name="social_linkedin" value="<?php echo htmlspecialchars($settings['social_linkedin'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    <!-- Lists & Categories -->
    <div id="collections" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 flex items-center">
            <i class="fas fa-tags text-brand-blue mr-2"></i> Lists &amp; Categories
        </h2>
        <p class="text-[11px] text-slate-500 -mt-1">One option per line as <code class="bg-slate-100 px-1 rounded">key|Label</code> (the key is stored, the label is shown). Leave blank for the built-in defaults.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Gallery categories (filter chips)</label>
                <textarea name="gallery_categories" rows="4" placeholder="awards|Awards &amp; Recognition&#10;clinical|Clinical Events" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($settings['gallery_categories'] ?? ''); ?></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Video library categories (filter chips)</label>
                <textarea name="video_categories" rows="4" placeholder="stroke|Stroke&#10;epilepsy|Epilepsy&#10;headache|Headache" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($settings['video_categories'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>

    <!-- Lead Forms -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 flex items-center">
            <i class="fas fa-paper-plane text-brand-blue mr-2"></i> Appointment &amp; Enquiry Forms
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Formester Form URL (forwarding)</label>
                <input type="url" name="formester_url" value="<?php echo htmlspecialchars($settings['formester_url'] ?? ''); ?>" placeholder="https://app.formester.com/forms/XXXXXXXX/submissions" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <p class="text-[10px] text-slate-400 mt-1">Every form submission is stored in CMS → Leads and also forwarded here. Leave blank to only store leads.</p>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Lead Notification Email</label>
                <input type="email" name="lead_notify_email" value="<?php echo htmlspecialchars($settings['lead_notify_email'] ?? ''); ?>" placeholder="appointments@example.com" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <p class="text-[10px] text-slate-400 mt-1">Optional. New leads are emailed here if the server can send mail.</p>
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
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Meta (Facebook) Pixel ID</label>
                <input type="text" name="meta_pixel_id" value="<?php echo htmlspecialchars($settings['meta_pixel_id'] ?? ''); ?>" placeholder="123456789012345" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Custom &lt;head&gt; Scripts / Verification Tags</label>
                <textarea name="custom_head_scripts" rows="3" placeholder="&lt;meta name=&quot;google-site-verification&quot; content=&quot;...&quot;&gt;" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($settings['custom_head_scripts'] ?? ''); ?></textarea>
                <p class="text-[10px] text-slate-400 mt-1">Printed as-is inside &lt;head&gt; on every page. Only paste code from providers you trust.</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Custom Scripts before &lt;/body&gt; (chat widgets, etc.)</label>
                <textarea name="custom_body_scripts" rows="3" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($settings['custom_body_scripts'] ?? ''); ?></textarea>
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
        if (($u['id'] ?? '') === ($currentUser['id'] ?? '') && (password_verify('admin123', $u['password'] ?? '') || password_verify('@Praveen@123', $u['password'] ?? ''))) {
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
