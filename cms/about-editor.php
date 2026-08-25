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
    
    $aboutText = trim($_POST['about'] ?? '');
    if (!isset($mainDoc['modal'])) $mainDoc['modal'] = ['sections' => []];
    $mainDoc['modal']['sections']['About'] = [$aboutText];

    $qualifications = array_filter(array_map('trim', explode("\n", $_POST['qualifications'] ?? '')));
    $mainDoc['modal']['sections']['Qualifications'] = $qualifications;

    $expertise = array_filter(array_map('trim', explode("\n", $_POST['expertise'] ?? '')));
    $mainDoc['modal']['sections']['Areas of Expertise'] = $expertise;

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

<div class="max-w-4xl bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
    <div class="pb-4 border-b border-slate-100 mb-6 flex items-start justify-between">
        <div>
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Dr. Praveen Gupta — Profile & Biography</h2>
            <p class="text-xs text-slate-500 mt-1">Update the doctor's photo, bio text, qualifications, and homepage statistics.</p>
        </div>
        <div class="w-14 h-14 rounded-xl overflow-hidden border border-slate-200 bg-slate-100 flex-shrink-0">
            <img src="../<?php echo htmlspecialchars($mainDoc['image'] ?? 'assets/ggn-nuro-images/optimized/dr-praveen-gupta.webp'); ?>" class="w-full h-full object-cover" alt="Doctor Photo">
        </div>
    </div>

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-5">
        <?php echo cms_csrf_field(); ?>

        <!-- Key Stats Counters -->
        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-3">Homepage Stats Badges</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <div>
                    <span class="text-[11px] text-slate-500 block mb-1">Patients Treated</span>
                    <input type="text" name="stats_patients" value="<?php echo htmlspecialchars($settings['stats_patients'] ?? '3,00,000+'); ?>" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <span class="text-[11px] text-slate-500 block mb-1">Global Awards</span>
                    <input type="text" name="stats_awards" value="<?php echo htmlspecialchars($settings['stats_awards'] ?? '50+'); ?>" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <span class="text-[11px] text-slate-500 block mb-1">Experience</span>
                    <input type="text" name="stats_experience" value="<?php echo htmlspecialchars($settings['stats_experience'] ?? '20+ Years'); ?>" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <span class="text-[11px] text-slate-500 block mb-1">Rating Badge</span>
                    <input type="text" name="stats_rating" value="<?php echo htmlspecialchars($settings['stats_rating'] ?? '4.9'); ?>" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>

        <!-- Doctor Photo Upload -->
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Doctor Photo (Upload to replace current photo)</label>
            <input type="file" name="doctor_photo" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

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
            <label class="block text-xs font-bold text-slate-700 mb-1">Degrees & Qualifications (1 per line)</label>
            <textarea name="qualifications" rows="4" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php 
                $quals = $mainDoc['modal']['sections']['Qualifications'] ?? [];
                echo htmlspecialchars(is_array($quals) ? implode("\n", $quals) : $quals);
            ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Areas of Clinical Expertise (1 per line)</label>
            <textarea name="expertise" rows="4" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php 
                $exp = $mainDoc['modal']['sections']['Areas of Expertise'] ?? [];
                echo htmlspecialchars(is_array($exp) ? implode("\n", $exp) : $exp);
            ?></textarea>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">Save Changes</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
