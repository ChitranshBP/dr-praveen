<?php
$pageTitle = 'Edit Doctor Profile';
require_once __DIR__ . '/includes/header.php';

$doctors = CMS_DB::get('doctors', []);
$id = $_GET['id'] ?? '';
$doc = null;

if ($id) {
    foreach ($doctors as $d) {
        if (($d['id'] ?? '') === $id) {
            $doc = $d;
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    $name = trim($_POST['name'] ?? '');
    $specialty = trim($_POST['specialty'] ?? '');
    $designation = trim($_POST['designation'] ?? '');
    $experience = trim($_POST['experience'] ?? '');
    $about = trim($_POST['about'] ?? '');
    $qualifications = trim($_POST['qualifications'] ?? '');
    $expertise = trim($_POST['expertise'] ?? '');

    $imagePath = $_POST['existing_image'] ?? '';
    $imgUpload = cms_handle_upload('doctor_photo', 'doctors');
    if ($imgUpload && !isset($imgUpload['error'])) {
        $imagePath = $imgUpload['path'];
    }

    $docData = [
        'id' => $id ?: CMS_DB::generateId(),
        'name' => $name,
        'specialty' => $specialty,
        'designation' => $designation,
        'experience' => $experience,
        'image' => $imagePath ?: 'assets/ggn-nuro-images/optimized/dr-praveen-gupta.webp',
        'alt' => $name,
        'modal' => [
            'title' => $name,
            'subtitle' => $specialty,
            'role' => $designation,
            'sections' => [
                'About' => array_filter([$about]),
                'Qualifications' => array_filter(array_map('trim', explode("\n", $qualifications))),
                'Areas of Expertise' => array_filter(array_map('trim', explode("\n", $expertise)))
            ]
        ]
    ];

    if ($id && $doc) {
        foreach ($doctors as &$d) {
            if (($d['id'] ?? '') === $id) {
                $d = $docData;
                break;
            }
        }
    } else {
        $doctors[] = $docData;
    }

    CMS_DB::set('doctors', $doctors);
    cms_set_flash('success', 'Doctor profile updated.');
    header('Location: doctors.php');
    exit;
}
?>

<div class="max-w-4xl bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider"><?php echo $doc ? 'Edit Doctor' : 'Add New Doctor'; ?></h2>
        <a href="doctors.php" class="text-xs text-slate-500 font-semibold hover:underline">&larr; Back to Team</a>
    </div>

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-4">
        <?php echo cms_csrf_field(); ?>
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($doc['image'] ?? ''); ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Doctor Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($doc['name'] ?? ''); ?>" required class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Specialty / Department</label>
                <input type="text" name="specialty" value="<?php echo htmlspecialchars($doc['specialty'] ?? ''); ?>" placeholder="e.g. Neurology, Neurosciences" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Designation</label>
                <input type="text" name="designation" value="<?php echo htmlspecialchars($doc['designation'] ?? ''); ?>" placeholder="e.g. Associate Director" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Experience</label>
                <input type="text" name="experience" value="<?php echo htmlspecialchars($doc['experience'] ?? ''); ?>" placeholder="e.g. 15+ Years Experience" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Doctor Photo</label>
                <input type="file" name="doctor_photo" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">About / Bio</label>
            <textarea name="about" rows="4" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($doc['modal']['sections']['About'][0] ?? ''); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Qualifications (1 per line)</label>
            <textarea name="qualifications" rows="3" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars(implode("\n", $doc['modal']['sections']['Qualifications'] ?? [])); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Areas of Expertise (1 per line)</label>
            <textarea name="expertise" rows="3" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars(implode("\n", $doc['modal']['sections']['Areas of Expertise'] ?? [])); ?></textarea>
        </div>

        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">Save Profile</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
