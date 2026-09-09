<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

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
    $imageAlt = trim($_POST['image_alt'] ?? '');
    $metaTitle = trim($_POST['meta_title'] ?? '');
    $metaDescription = trim($_POST['meta_description'] ?? '');

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
                $b['image_alt'] = $imageAlt ?: $title;
                $b['meta_title'] = $metaTitle;
                $b['meta_description'] = $metaDescription;
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
            'image_alt' => $imageAlt ?: $title,
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
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

$pageTitle = $blog ? 'Edit Article: ' . $blog['title'] : 'Write New Article';
require_once __DIR__ . '/includes/header.php';
?>

<div class="max-w-4xl bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
        <h2 class="text-base font-bold text-slate-900"><?php echo $blog ? 'Edit Article' : 'Write New Article'; ?></h2>
        <a href="blogs.php" class="text-xs text-slate-500 font-semibold hover:underline">&larr; Back to Blog List</a>
    </div>

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-5">
        <?php echo cms_csrf_field(); ?>
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($blog['image'] ?? ''); ?>">

        <!-- SEO Meta Box -->
        <div class="bg-gradient-to-br from-slate-50 to-blue-50/30 p-5 rounded-2xl border border-blue-100 space-y-3">
            <div class="flex items-center justify-between border-b border-blue-100 pb-2">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center">
                    <i class="fas fa-search text-brand-blue mr-2"></i> SEO & Search Engine Meta Tags
                </h3>
                <span class="text-[10px] text-blue-700 font-bold bg-blue-100/70 px-2 py-0.5 rounded-full">Google Snippet</span>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <label class="block font-bold text-slate-800 mb-1">SEO Article Title (&lt;title&gt;)</label>
                    <input type="text" name="meta_title" value="<?php echo htmlspecialchars($blog['meta_title'] ?? ''); ?>" placeholder="<?php echo htmlspecialchars(($blog['title'] ?? 'Article Title') . ' - Dr. Praveen Gupta'); ?>" class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-800 mb-1">SEO Meta Description (&lt;meta name="description"&gt;)</label>
                    <textarea name="meta_description" rows="2" placeholder="Brief summary displayed under the link in search results..." class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($blog['meta_description'] ?? ''); ?></textarea>
                </div>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Article Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($blog['title'] ?? ''); ?>" required placeholder="e.g. Understanding Stroke Symptoms & Rapid Interventions" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Slug / URL</label>
                <input type="text" name="slug" value="<?php echo htmlspecialchars($blog['slug'] ?? ''); ?>" placeholder="auto-generated-if-blank" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Category</label>
                <input type="text" name="category" value="<?php echo htmlspecialchars($blog['category'] ?? 'Neurology'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Publish Date</label>
                <input type="date" name="date" value="<?php echo htmlspecialchars($blog['date'] ?? date('Y-m-d')); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Author</label>
                <input type="text" name="author" value="<?php echo htmlspecialchars($blog['author'] ?? 'Dr. Praveen Gupta'); ?>" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Status</label>
                <select name="status" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="published" <?php echo ($blog['status'] ?? 'published') === 'published' ? 'selected' : ''; ?>>Published (visible on website)</option>
                    <option value="draft" <?php echo ($blog['status'] ?? '') === 'draft' ? 'selected' : ''; ?>>Draft (hidden from website)</option>
                </select>
            </div>
        </div>

        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-3">
            <div class="flex items-center justify-between">
                <label class="block text-xs font-bold text-slate-800">
                    <i class="fas fa-image text-brand-blue mr-1"></i> Featured Banner Image
                </label>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Recommended: 1200 × 630 px</span>
            </div>
            <p class="text-[10px] text-slate-500">Wide landscape format (Aspect ratio 16:9 or 1.91:1 standard social card). Supported: WebP, PNG, JPG (Max 5MB).</p>
            <?php if (!empty($blog['image'])): ?>
            <div class="flex items-center space-x-3 py-1">
                <img src="../<?php echo htmlspecialchars($blog['image']); ?>" class="h-14 w-24 object-cover rounded-lg border border-slate-200" alt="<?php echo htmlspecialchars($blog['image_alt'] ?? 'Blog Image'); ?>">
                <span class="text-[10px] text-slate-400 font-mono"><?php echo htmlspecialchars($blog['image']); ?></span>
            </div>
            <?php endif; ?>
            <input type="file" name="blog_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

            <div class="pt-2 border-t border-slate-200/60">
                <label class="block text-xs font-bold text-slate-700 mb-1">Featured Image Alt Tag (SEO & Accessibility)</label>
                <input type="text" name="image_alt" value="<?php echo htmlspecialchars($blog['image_alt'] ?? ''); ?>" placeholder="e.g. <?php echo htmlspecialchars($blog['title'] ?? 'Blog Article'); ?> Banner - Dr. Praveen Gupta" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Short Excerpt</label>
            <textarea name="excerpt" rows="2" placeholder="Brief 1-2 sentence overview of the article..." class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium leading-relaxed focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($blog['excerpt'] ?? ''); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Article Body Content (Full Rich Text Editor)</label>
            <textarea name="content" rows="12" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none"><?php echo htmlspecialchars($blog['content'] ?? ''); ?></textarea>
        </div>

        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
            <button type="submit" class="px-6 py-2.5 bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">Save &amp; Publish Article</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
