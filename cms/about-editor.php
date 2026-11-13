<?php
/**
 * "About Dr. Praveen" hub — everything about the doctor now lives in three
 * dedicated screens; this page just points to them so nothing is edited in
 * two places.
 */
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

cms_require_auth();

$doctors = CMS_DB::get('doctors', []);
$mainDoc = null;
foreach ($doctors as $d) {
    if (is_array($d) && stripos((string)($d['name'] ?? ''), 'Praveen') !== false) {
        $mainDoc = $d;
        break;
    }
}
$settings = CMS_DB::get('settings', []);

$pageTitle = 'About Dr. Praveen Gupta';
require_once __DIR__ . '/includes/header.php';

$cards = [
    [
        'icon' => 'fa-user-md', 'title' => 'Doctor profile & biography',
        'text' => 'Photo, designation, experience, About text, qualifications, expertise and every popup section shown on the Team page and homepage.',
        'url' => $mainDoc ? 'doctor-edit.php?id=' . urlencode((string)($mainDoc['id'] ?? '')) : 'doctors.php',
        'cta' => 'Edit profile',
    ],
    [
        'icon' => 'fa-file-alt', 'title' => 'About page sections',
        'text' => 'Banner, designations, biography, highlights, stats strip, expertise cards, achievements, awards gallery, vision quote and testimonials slider — reorder, hide or rewrite any of them.',
        'url' => 'page-edit.php?slug=about',
        'cta' => 'Edit About page',
    ],
    [
        'icon' => 'fa-home', 'title' => 'Homepage "About" section',
        'text' => 'The About Dr. Praveen section on the homepage (photo, appointments, paragraphs, firsts and button) is a section of the Home page.',
        'url' => 'page-edit.php?slug=index',
        'cta' => 'Edit Home page',
    ],
    [
        'icon' => 'fa-chart-line', 'title' => 'Key statistics',
        'text' => 'Patients treated, awards, years of experience, rating and success stories. Used wherever a page prints {stats_patients}, {stats_awards}, {stats_experience}, {stats_rating} or {stats_success}.',
        'url' => 'settings.php',
        'cta' => 'Edit statistics',
    ],
    [
        'icon' => 'fa-trophy', 'title' => 'Awards & honours photos',
        'text' => 'The award images shown on the homepage, About page and Awards & Recognition page.',
        'url' => 'collection.php?c=awards',
        'cta' => 'Manage awards',
    ],
    [
        'icon' => 'fa-star', 'title' => 'Why Choose Dr. Praveen page',
        'text' => 'Leadership statistics, milestones and the patient-first philosophy section.',
        'url' => 'page-edit.php?slug=why-choose-dr-praveen-gupta',
        'cta' => 'Edit page',
    ],
];
?>

<div class="max-w-5xl space-y-6">
    <div class="bg-gradient-to-r from-brand-indigo via-blue-950 to-brand-indigo text-white p-6 rounded-3xl shadow border border-white/10 flex flex-col md:flex-row md:items-center gap-5">
        <?php if ($mainDoc && !empty($mainDoc['image'])): ?>
        <img src="../<?php echo htmlspecialchars(ltrim((string)$mainDoc['image'], '/')); ?>" alt="" class="w-20 h-24 rounded-2xl object-cover object-top border-2 border-white/20 flex-shrink-0">
        <?php endif; ?>
        <div>
            <h2 class="text-base font-extrabold"><?php echo htmlspecialchars($mainDoc['name'] ?? 'Dr. Praveen Gupta'); ?></h2>
            <p class="text-xs text-slate-300 mt-1"><?php echo htmlspecialchars($mainDoc['designation'] ?? ''); ?></p>
            <p class="text-xs text-slate-300 mt-2">Everything about the doctor is edited in the screens below. Statistics: <strong class="text-white"><?php echo htmlspecialchars($settings['stats_patients'] ?? '3,00,000+'); ?></strong> patients · <strong class="text-white"><?php echo htmlspecialchars($settings['stats_awards'] ?? '50+'); ?></strong> awards · <strong class="text-white"><?php echo htmlspecialchars($settings['stats_experience'] ?? '20+'); ?></strong> years · <strong class="text-white"><?php echo htmlspecialchars($settings['stats_rating'] ?? '4.9'); ?></strong> rating.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php foreach ($cards as $c): ?>
        <a href="<?php echo htmlspecialchars($c['url']); ?>" class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-brand-blue hover:shadow-md transition-all group flex flex-col">
            <div class="flex items-center space-x-3 mb-2">
                <span class="w-9 h-9 rounded-xl bg-blue-50 text-brand-blue flex items-center justify-center"><i class="fas <?php echo $c['icon']; ?>"></i></span>
                <h3 class="text-sm font-bold text-slate-900 group-hover:text-brand-blue"><?php echo htmlspecialchars($c['title']); ?></h3>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed flex-1"><?php echo htmlspecialchars($c['text']); ?></p>
            <span class="mt-3 text-xs font-bold text-brand-blue"><?php echo htmlspecialchars($c['cta']); ?> <i class="fas fa-arrow-right text-[9px] ml-1"></i></span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
