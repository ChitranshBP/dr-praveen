<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/fields.php';

cms_require_auth();

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
    // URL-safe, lowercase, and unique among the other posts (-2, -3 … appended).
    $slug = trim(preg_replace('/[^a-z0-9-]+/', '-', strtolower(cms_slugify($slug))), '-');
    if ($slug === '') $slug = 'post-' . date('Ymd-His');
    $taken = [];
    foreach ($blogs as $other) {
        if (is_array($other) && ($other['id'] ?? '') !== $id && !empty($other['slug'])) $taken[(string)$other['slug']] = true;
    }
    $baseSlug = $slug; $n = 2;
    while (isset($taken[$slug])) { $slug = $baseSlug . '-' . $n++; }
    $category = trim($_POST['category'] ?? 'Neurology');
    $author = trim($_POST['author'] ?? 'Dr. Praveen Gupta');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $status = in_array($_POST['status'] ?? '', ['published', 'draft'], true) ? $_POST['status'] : 'published';
    $date = trim($_POST['date'] ?? '') ?: date('Y-m-d');
    $imageAlt = trim($_POST['image_alt'] ?? '');
    $metaTitle = trim($_POST['meta_title'] ?? '');
    $metaDescription = trim($_POST['meta_description'] ?? '');

    $imgRes = cms_image_field_value('image', 'blogs', $blog['image'] ?? '');
    $imagePath = $imgRes['path'];
    $uploadError = $imgRes['error'];

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
                $b['image'] = $imagePath;
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
    
    // Auto-regenerate sitemap.xml
    $sitemapGen = dirname(__DIR__) . '/includes/generate-sitemap.php';
    if (file_exists($sitemapGen)) {
        require_once $sitemapGen;
        if (function_exists('generate_sitemap_xml')) {
            generate_sitemap_xml();
        }
    }

    if ($uploadError !== '') {
        cms_set_flash('error', 'Article saved, but the image upload failed: ' . $uploadError);
    } else {
        cms_set_flash('success', 'Article saved successfully and sitemap updated.');
    }
    header('Location: blogs.php');
    exit;
}

$pageTitle = $blog ? 'Edit Article: ' . $blog['title'] : 'Write New Article';
require_once __DIR__ . '/includes/header.php';
?>

<div class="max-w-4xl bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
        <h2 class="text-base font-bold text-slate-900"><?php echo $blog ? 'Edit Article' : 'Write New Article'; ?></h2>
        <div class="flex items-center space-x-3 text-xs">
            <?php if (!empty($blog['slug'])): ?>
            <a href="../blog/<?php echo urlencode($blog['slug']); ?>" target="_blank" class="px-3 py-1 bg-blue-50 text-brand-blue font-bold rounded-lg hover:bg-blue-100 transition-colors flex items-center space-x-1.5">
                <span>View Live Article</span>
                <i class="fas fa-external-link-alt text-[10px]"></i>
            </a>
            <?php endif; ?>
            <a href="blogs.php" class="text-slate-500 font-semibold hover:underline">&larr; Back to Blog List</a>
        </div>
    </div>

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-5">
        <?php echo cms_csrf_field(); ?>

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

        <?php cms_image_field('image', $blog['image'] ?? '', [
            'label' => 'Featured Banner Image', 'folder' => 'blogs', 'size' => 'Recommended: 1200 × 630 px',
            'hint' => 'Wide landscape format (16:9 or 1.91:1 social card). WebP, PNG or JPG (max 8MB).',
            'preview_class' => 'w-40 h-[84px]',
            'alt_name' => 'image_alt', 'alt_value' => $blog['image_alt'] ?? '',
            'alt_label' => 'Featured image alt tag, e.g. ' . ($blog['title'] ?? 'Blog Article') . ' - Dr. Praveen Gupta',
        ]); ?>

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
