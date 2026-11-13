<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/fields.php';

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
    $imageAlt = trim($_POST['image_alt'] ?? '');

    $imgRes = cms_image_field_value('image', 'doctors', $doc['image'] ?? '');
    $imagePath = $imgRes['path'];
    $uploadError = $imgRes['error'];

    $docData = $doc;
    if (!is_array($docData)) {
        $docData = [];
    }
    if (empty($docData['id'])) {
        $docData['id'] = $id ?: CMS_DB::generateId();
    }
    $docData['name'] = $name;
    $docData['specialty'] = $specialty;
    $docData['designation'] = $designation;
    $docData['experience'] = $experience;
    $docData['alt'] = $imageAlt ?: $name;
    $docData['image_alt'] = $imageAlt ?: $name;
    if ($imagePath) {
        $docData['image'] = $imagePath;
    } elseif (empty($docData['image'])) {
        $docData['image'] = 'assets/ggn-nuro-images/optimized/dr-praveen-gupta.webp';
    }

    $modal = $docData['modal'] ?? [];
    if (!is_array($modal)) {
        $modal = [];
    }
    $modal['title'] = $modal['title'] ?? $name;
    $modal['subtitle'] = $modal['subtitle'] ?? $specialty;
    $modal['role'] = $modal['role'] ?? $designation;
    $sections = $modal['sections'] ?? [];
    if (!is_array($sections)) {
        $sections = [];
    }

    if (!isset($sections['Designation']) && $designation !== '') {
        $sections['Designation'] = [$designation];
    }

    $aboutText = trim($about);
    if ($aboutText !== '') {
        $sections['About'] = [$aboutText];
    }
    $sections['Qualifications'] = cms_parse_multiline_items($qualifications);
    $sections['Areas of Expertise'] = cms_parse_multiline_items($expertise);

    // Popup header lines + any further biography sections (Awards, Memberships, …)
    $modal['subtitle'] = trim((string)($_POST['modal_subtitle'] ?? '')) !== '' ? trim((string)$_POST['modal_subtitle']) : ($modal['subtitle'] ?? $specialty);
    $modal['role'] = trim((string)($_POST['modal_role'] ?? '')) !== '' ? trim((string)$_POST['modal_role']) : ($modal['role'] ?? $designation);
    if (isset($_POST['extra_sections']) && is_array($_POST['extra_sections'])) {
        $standard = ['Designation', 'About', 'Qualifications', 'Areas of Expertise'];
        $kept = array_intersect_key($sections, array_flip($standard));
        $extraTitles = $_POST['extra_sections']['title'] ?? [];
        $extraItems = $_POST['extra_sections']['items'] ?? [];
        foreach ((array)$extraTitles as $i => $t) {
            $t = trim((string)$t);
            $list = cms_parse_multiline_items((string)($extraItems[$i] ?? ''));
            if ($t === '' || empty($list) || isset($kept[$t])) continue;
            $kept[$t] = $list;
        }
        $sections = $kept;
    }

    $modal['sections'] = $sections;
    $docData['modal'] = $modal;

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
    if ($uploadError !== '') {
        cms_set_flash('error', 'Profile saved, but the photo upload failed: ' . $uploadError);
    } else {
        cms_set_flash('success', 'Doctor profile updated successfully.');
    }
    header('Location: doctors.php');
    exit;
}
?>

<div class="max-w-4xl bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
        <div>
            <h2 class="text-lg font-bold text-slate-800"><?php echo $id ? 'Edit Specialist' : 'Add New Specialist'; ?></h2>
            <p class="text-xs text-slate-500">Manage credentials, bio, qualifications, and areas of expertise with rich formatting.</p>
        </div>
        <a href="doctors.php" class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Back</a>
    </div>

    <form method="POST" enctype="multipart/form-data" class="space-y-5">
        <?php echo cms_csrf_field(); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Doctor Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($doc['name'] ?? ''); ?>" required class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Specialty / Department</label>
                <input type="text" name="specialty" value="<?php echo htmlspecialchars($doc['specialty'] ?? ''); ?>" required class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Designation</label>
                <input type="text" name="designation" value="<?php echo htmlspecialchars($doc['designation'] ?? $doc['modal']['role'] ?? ''); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Experience (Years)</label>
                <input type="text" name="experience" value="<?php echo htmlspecialchars($doc['experience'] ?? ''); ?>" placeholder="e.g. 15+ Years" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <?php cms_image_field('image', $doc['image'] ?? '', [
            'label' => 'Doctor Profile Photo', 'folder' => 'doctors', 'size' => 'Recommended: 600 × 750 px',
            'hint' => 'Portrait format (aspect ratio ~4:5). WebP, PNG or JPG (max 8MB).',
            'preview_class' => 'w-20 h-24',
            'alt_name' => 'image_alt', 'alt_value' => $doc['image_alt'] ?? $doc['alt'] ?? '',
            'alt_label' => 'Photo alt tag, e.g. ' . ($doc['name'] ?? 'Doctor') . ' - Neurologist',
        ]); ?>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">About / Biography</label>
            <textarea name="about" rows="4" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php 
                $aboutSection = $doc['modal']['sections']['About'] ?? [];
                echo htmlspecialchars(is_array($aboutSection) ? implode("\n\n", $aboutSection) : $aboutSection); 
            ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Degrees & Qualifications</label>
            <textarea name="qualifications" rows="3" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php 
                $quals = $doc['modal']['sections']['Qualifications'] ?? [];
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
            <textarea name="expertise" rows="3" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php 
                $exps = $doc['modal']['sections']['Areas of Expertise'] ?? [];
                if (is_array($exps)) {
                    foreach ($exps as $e) {
                        echo htmlspecialchars($e) . "\n";
                    }
                } else {
                    echo htmlspecialchars($exps);
                }
            ?></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Popup subtitle (under the name)</label>
                <input type="text" name="modal_subtitle" value="<?php echo htmlspecialchars($doc['modal']['subtitle'] ?? ''); ?>" placeholder="e.g. Neurology &amp; Neurosciences | Clinical Director" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Popup "Role" badge</label>
                <input type="text" name="modal_role" value="<?php echo htmlspecialchars($doc['modal']['role'] ?? ''); ?>" placeholder="e.g. Clinical Director" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <div>
                    <label class="block text-xs font-bold text-slate-700">More biography sections</label>
                    <p class="text-[11px] text-slate-500">Awards &amp; Achievements, Memberships, Experience, Research… Each shows as its own heading in the doctor popup (one item per line).</p>
                </div>
                <button type="button" onclick="docAddSection()" class="px-3 py-1.5 bg-brand-blue hover:bg-blue-700 text-white text-[11px] font-bold rounded-lg"><i class="fas fa-plus text-[9px] mr-1"></i> Add section</button>
            </div>
            <div id="doc-extra-sections" class="space-y-3">
                <?php
                $standardSections = ['Designation', 'About', 'Qualifications', 'Areas of Expertise'];
                foreach (($doc['modal']['sections'] ?? []) as $secTitle => $secItems):
                    if (in_array($secTitle, $standardSections, true) || !is_array($secItems)) continue;
                ?>
                <div class="doc-extra-section bg-slate-50 border border-slate-200 rounded-xl p-3 space-y-2">
                    <div class="flex items-center gap-2">
                        <input type="text" name="extra_sections[title][]" value="<?php echo htmlspecialchars((string)$secTitle); ?>" placeholder="Section heading" class="flex-1 px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <button type="button" onclick="this.closest('.doc-extra-section').remove()" class="text-[11px] text-red-500 font-bold hover:underline"><i class="fas fa-trash text-[9px]"></i> Remove</button>
                    </div>
                    <textarea name="extra_sections[items][]" rows="3" placeholder="One item per line" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars(implode("\n", array_map('strval', $secItems))); ?></textarea>
                </div>
                <?php endforeach; ?>
            </div>
            <template id="doc-extra-section-template">
                <div class="doc-extra-section bg-slate-50 border border-slate-200 rounded-xl p-3 space-y-2">
                    <div class="flex items-center gap-2">
                        <input type="text" name="extra_sections[title][]" value="" placeholder="Section heading, e.g. Awards &amp; Achievements" class="flex-1 px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <button type="button" onclick="this.closest('.doc-extra-section').remove()" class="text-[11px] text-red-500 font-bold hover:underline"><i class="fas fa-trash text-[9px]"></i> Remove</button>
                    </div>
                    <textarea name="extra_sections[items][]" rows="3" placeholder="One item per line" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs leading-relaxed focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>
            </template>
            <input type="hidden" name="extra_sections[present]" value="1">
            <script>
            function docAddSection() {
                const tpl = document.getElementById('doc-extra-section-template');
                document.getElementById('doc-extra-sections').appendChild(tpl.content.cloneNode(true));
            }
            </script>
        </div>

        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">Save Profile</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
