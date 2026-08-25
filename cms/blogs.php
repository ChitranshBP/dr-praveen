<?php
$pageTitle = 'Blog & Articles';
require_once __DIR__ . '/includes/header.php';

$blogs = CMS_DB::get('blogs', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';

    if ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        $blogs = array_values(array_filter($blogs, function($b) use ($id) { return ($b['id'] ?? '') !== $id; }));
        CMS_DB::set('blogs', $blogs);
        cms_set_flash('success', 'Article deleted.');
        header('Location: blogs.php');
        exit;
    }
}
?>

<div class="space-y-6 max-w-6xl">
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider">All Published Articles (<?php echo count($blogs); ?>)</h2>
        <a href="blog-edit.php" class="px-4 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all flex items-center space-x-1.5">
            <i class="fas fa-plus"></i>
            <span>Write New Post</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach ($blogs as $b): ?>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between text-xs text-slate-400 mb-2">
                    <span class="font-semibold text-brand-blue"><?php echo htmlspecialchars($b['category'] ?? 'Health'); ?></span>
                    <span><?php echo htmlspecialchars($b['date'] ?? ''); ?></span>
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-2 line-clamp-2"><?php echo htmlspecialchars($b['title']); ?></h3>
                <p class="text-xs text-slate-500 line-clamp-3 mb-4"><?php echo htmlspecialchars($b['excerpt'] ?? ''); ?></p>
            </div>

            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="blog-edit.php?id=<?php echo urlencode($b['id']); ?>" class="text-brand-blue font-bold hover:underline">Edit Article</a>
                <form method="POST" action="" onsubmit="return confirm('Delete this blog post?');" class="inline">
                    <?php echo cms_csrf_field(); ?>
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($b['id']); ?>">
                    <button type="submit" class="text-red-500 font-bold hover:underline">Delete</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
