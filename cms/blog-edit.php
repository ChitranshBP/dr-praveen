<?php
$pageTitle = 'Write / Edit Article';
require_once __DIR__ . '/includes/header.php';

$blogs = CMS_DB::get('blogs', []);
$id = $_GET['id'] ?? '';
$blog = null;

if ($id) {
    foreach ($blogs as $b) {
        if ($b['id'] === $id) {
            $blog = $b;
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '') ?: cms_slugify($title);
    $category = trim($_POST['category'] ?? 'Neurology');
    $author = trim($_POST['author'] ?? 'Dr. Praveen Gupta');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $status = $_POST['status'] ?? 'published';
    $date = trim($_POST['date'] ?? '') ?: date('Y-m-d');

    $imagePath = $_POST['existing_image'] ?? '';
    $imgUpload = cms_handle_upload('blog_image', 'blogs');
    if ($imgUpload && !isset($imgUpload['error'])) {
        $imagePath = $imgUpload['path'];
    }

    if ($id && $blog) {
        foreach ($blogs as &$b) {
            if ($b['id'] === $id) {
                $b['title'] = $title;
                $b['slug'] = $slug;
                $b['category'] = $category;
                $b['author'] = $author;
                $b['excerpt'] = $excerpt;
                $b['content'] = $content;
                $b['status'] = $status;
                $b['date'] = $date;
                if ($imagePath) $b['image'] = $imagePath;
                break;
            }
        }
    } else {
        $blogs[] = [
            'id' => CMS_DB::generateId(),
            'title' => $title,
            'slug' => $slug,
            'category' => $category,
            'author' => $author,
            'excerpt' => $excerpt,
            'content' => $content,
            'image' => $imagePath ?: 'assets/banner/1.png',
            'status' => $status,
            'date' => $date,
            'views' => 0
        ];
    }

    CMS_DB::set('blogs', $blogs);
    cms_set_flash('success', 'Article saved successfully.');
    header('Location: blogs.php');
    exit;
}
?>

<div class="max-w-4xl bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider"><?php echo $blog ? 'Edit Article' : 'Write New Article'; ?></h2>
        <a href="blogs.php" class="text-xs text-slate-500 font-semibold hover:underline">&larr; Back to Blog List</a>
    </div>

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-4">
        <?php echo cms_csrf_field(); ?>
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($blog['image'] ?? ''); ?>">

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Article Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($blog['title'] ?? ''); ?>" required class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Slug / URL</label>
                <input type="text" name="slug" value="<?php echo htmlspecialchars($blog['slug'] ?? ''); ?>" placeholder="auto-generated-if-blank" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Category</label>
                <input type="text" name="category" value="<?php echo htmlspecialchars($blog['category'] ?? 'Neurology'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Publish Date</label>
                <input type="date" name="date" value="<?php echo htmlspecialchars($blog['date'] ?? date('Y-m-d')); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Featured Banner Image</label>
            <input type="file" name="blog_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Short Excerpt</label>
            <textarea name="excerpt" rows="2" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($blog['excerpt'] ?? ''); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Article Body Content (HTML Supported)</label>
            <textarea name="content" rows="10" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($blog['content'] ?? ''); ?></textarea>
        </div>

        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">Publish Article</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
