<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$doctors = CMS_DB::get('doctors', []);
$settings = CMS_DB::get('settings', []);

// Find Dr. Praveen Gupta's entry
$mainDocIndex = 0;
foreach ($doctors as $idx => $d) {
    if (stripos($d['name'] ?? '', 'Praveen') !== false) {
        $mainDocIndex = $idx;
        break;
    }
}
$mainDoc = $doctors[$mainDocIndex] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    // 1. Update Stats in settings
    $stats = [
        'stats_patients' => trim($_POST['stats_patients'] ?? '3,00,000+'),
        'stats_awards' => trim($_POST['stats_awards'] ?? '50+'),
        'stats_experience' => trim($_POST['stats_experience'] ?? '20+ Years'),
        'stats_rating' => trim($_POST['stats_rating'] ?? '4.9')
    ];
    CMS_DB::setMultipleSettings($stats);

    // 2. Update Dr. Praveen profile
    $mainDoc['designation'] = trim($_POST['designation'] ?? '');
    $mainDoc['specialty'] = trim($_POST['specialty'] ?? 'Neurology, Neurosciences');
    $mainDoc['image_alt'] = trim($_POST['image_alt'] ?? 'Dr. Praveen Gupta - Best Neurologist in Gurgaon & Delhi NCR');
    
    $aboutText = trim($_POST['about'] ?? '');
    if (!isset($mainDoc['modal'])) $mainDoc['modal'] = ['sections' => []];
    $mainDoc['modal']['sections']['About'] = [$aboutText];

    $mainDoc['modal']['sections']['Qualifications'] = cms_parse_multiline_items($_POST['qualifications'] ?? '');
    $mainDoc['modal']['sections']['Areas of Expertise'] = cms_parse_multiline_items($_POST['expertise'] ?? '');

    // Handle photo upload
    $imgUpload = cms_handle_upload('doctor_photo', 'doctors');
    if ($imgUpload && !isset($imgUpload['error'])) {
        $mainDoc['image'] = $imgUpload['path'];
    }

    $doctors[$mainDocIndex] = $mainDoc;
    CMS_DB::set('doctors', $doctors);

    cms_set_flash('success', 'Doctor profile, biography, and statistics updated successfully!');
    header('Location: about-editor.php');
    exit;
}

$pageTitle = 'Edit About Doctor & Bio';
require_once __DIR__ . '/includes/header.php';
?>

<div class="max-w-4xl bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
        <div>
            <h2 class="text-lg font-bold text-slate-800">Edit Main Doctor Profile & Experience</h2>
            <p class="text-xs text-slate-500">Update Dr. Praveen Gupta's statistics, bio, degrees, and areas of expertise with rich formatting.</p>
        </div>
        <a href="index.php" class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Dashboard</a>
    </div>

    <form method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php echo cms_csrf_field(); ?>

        <!-- Key Website Statistics -->
        <div class="p-5 bg-gradient-to-br from-slate-50 to-blue-50/30 rounded-2xl border border-slate-200/80 space-y-3">
            <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center">
                <i class="fas fa-chart-line text-brand-blue mr-2"></i> Key Verified Statistics
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-1">
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Patients Treated</label>
                    <input type="text" name="stats_patients" value="<?php echo htmlspecialchars($settings['stats_patients'] ?? '3,00,000+'); ?>" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Awards / Honours</label>
                    <input type="text" name="stats_awards" value="<?php echo htmlspecialchars($settings['stats_awards'] ?? '50+'); ?>" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Years Experience</label>
                    <input type="text" name="stats_experience" value="<?php echo htmlspecialchars($settings['stats_experience'] ?? '20+ Years'); ?>" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Patient Rating</label>
                    <input type="text" name="stats_rating" value="<?php echo htmlspecialchars($settings['stats_rating'] ?? '4.9'); ?>" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- Doctor Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Designation</label>
                <input type="text" name="designation" value="<?php echo htmlspecialchars($mainDoc['designation'] ?? 'Chairman - Neurology'); ?>" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Specialty</label>
                <input type="text" name="specialty" value="<?php echo htmlspecialchars($mainDoc['specialty'] ?? 'Neurology, Neurosciences'); ?>" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Doctor Biography / About Summary</label>
            <textarea name="about" rows="5" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php 
                $aboutP = $mainDoc['modal']['sections']['About'] ?? [];
                echo htmlspecialchars(is_array($aboutP) ? implode("\n\n", $aboutP) : $aboutP);
            ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Degrees & Qualifications</label>
            <textarea name="qualifications" rows="4" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php 
                $quals = $mainDoc['modal']['sections']['Qualifications'] ?? [];
                if (is_array($quals)) {
                    foreach ($quals as $q) {
                        echo htmlspecialchars($q) . "\n";
                    }
                } else {
                    echo htmlspecialchars($quals);
                }
            ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Areas of Clinical Expertise</label>
            <textarea name="expertise" rows="4" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php 
                $exp = $mainDoc['modal']['sections']['Areas of Expertise'] ?? [];
                if (is_array($exp)) {
                    foreach ($exp as $e) {
                        echo htmlspecialchars($e) . "\n";
                    }
                } else {
                    echo htmlspecialchars($exp);
                }
            ?></textarea>
        </div>

        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">Save Profile Changes</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
