<?php
$pageTitle = 'Landing Page (/LP) Settings';
require_once __DIR__ . '/includes/header.php';

$lp = CMS_DB::get('lp', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    $data = [
        'hero_title' => trim($_POST['hero_title'] ?? ''),
        'hero_subtitle' => trim($_POST['hero_subtitle'] ?? ''),
        'formester_url' => trim($_POST['formester_url'] ?? ''),
        'stats_treated' => trim($_POST['stats_treated'] ?? '3,00,000+'),
        'stats_stories' => trim($_POST['stats_stories'] ?? '1,00,000+'),
        'stats_awards' => trim($_POST['stats_awards'] ?? '50+'),
        'stats_experience' => trim($_POST['stats_experience'] ?? '20+')
    ];

    CMS_DB::set('lp', $data);
    cms_set_flash('success', 'Landing Page settings saved successfully.');
    header('Location: lp-manager.php');
    exit;
}
?>

<div class="max-w-4xl bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Landing Page Customizer</h2>
        <a href="../LP/" target="_blank" class="text-xs text-brand-blue font-bold hover:underline flex items-center space-x-1">
            <span>View /LP</span>
            <i class="fas fa-external-link-alt text-[10px]"></i>
        </a>
    </div>

    <form method="POST" action="" class="space-y-4">
        <?php echo cms_csrf_field(); ?>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Hero Title</label>
            <input type="text" name="hero_title" value="<?php echo htmlspecialchars($lp['hero_title'] ?? 'Top Neurologist & Spine Specialist in Gurgaon & Delhi NCR'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Hero Subtitle</label>
            <input type="text" name="hero_subtitle" value="<?php echo htmlspecialchars($lp['hero_subtitle'] ?? 'Transforming Neurological Care with Advanced Precision & Compassion'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Patients Treated</label>
                <input type="text" name="stats_treated" value="<?php echo htmlspecialchars($lp['stats_treated'] ?? '3,00,000+'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Success Stories</label>
                <input type="text" name="stats_stories" value="<?php echo htmlspecialchars($lp['stats_stories'] ?? '1,00,000+'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Awards</label>
                <input type="text" name="stats_awards" value="<?php echo htmlspecialchars($lp['stats_awards'] ?? '50+'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Experience</label>
                <input type="text" name="stats_experience" value="<?php echo htmlspecialchars($lp['stats_experience'] ?? '20+'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">Save Landing Page</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
