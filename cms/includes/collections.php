<?php
/**
 * Generic collections: schema registry + storage helpers.
 *
 * A collection is an ordered list of items stored in data/collections/{name}.json
 * and edited with cms/collection.php (list) + cms/collection-edit.php (form).
 * The public site reads it with cms_collection($name) (includes/cms-load.php).
 *
 * Field types: text, textarea, richtext, image (with optional alt_key),
 * url, number, select (options | options_setting), toggle, date, tags
 * (comma separated → array), youtube (URL or id → id), pages (multi-select
 * of catalog page slugs → array), color (one of the block colours).
 */

require_once __DIR__ . '/db.php';

if (!defined('COLLECTIONS_DIR')) {
    define('COLLECTIONS_DIR', DATA_DIR . '/collections');
}

if (!function_exists('cms_collection_schemas')) {
    function cms_collection_schemas() {
        static $schemas = null;
        if ($schemas !== null) return $schemas;
        $schemas = [
            'gallery' => [
                'label' => 'Photo Gallery', 'singular' => 'Photo', 'icon' => 'fa-images',
                'description' => 'Photos shown on the Gallery page (filter chips come from the categories below).',
                'public' => 'gallery',
                'fields' => [
                    ['key' => 'image', 'label' => 'Photo', 'type' => 'image', 'folder' => 'gallery', 'alt_key' => 'alt', 'required' => true, 'size' => '1200 × 900 px'],
                    ['key' => 'title', 'label' => 'Title', 'type' => 'text', 'required' => true],
                    ['key' => 'caption', 'label' => 'Caption (shown in the lightbox)', 'type' => 'text'],
                    ['key' => 'category', 'label' => 'Category', 'type' => 'select', 'options_setting' => 'gallery_categories', 'default_options' => ['awards' => 'Awards & Recognition', 'clinical' => 'Clinical Events']],
                    ['key' => 'active', 'label' => 'Show on website', 'type' => 'toggle', 'default' => true],
                ],
                'list' => ['image' => 'image', 'title' => 'title', 'subtitle' => 'caption', 'badge' => 'category'],
            ],
            'awards' => [
                'label' => 'Awards & Honours', 'singular' => 'Award', 'icon' => 'fa-trophy',
                'description' => 'Award images shown on the homepage, About page and Awards & Recognition page.',
                'public' => 'awards-and-recognition',
                'fields' => [
                    ['key' => 'image', 'label' => 'Award photo / certificate', 'type' => 'image', 'folder' => 'awards', 'alt_key' => 'alt', 'required' => true, 'size' => '800 × 1200 px (portrait)'],
                    ['key' => 'title', 'label' => 'Award title', 'type' => 'text', 'required' => true],
                    ['key' => 'description', 'label' => 'Short description', 'type' => 'textarea'],
                    ['key' => 'year', 'label' => 'Year', 'type' => 'text'],
                    ['key' => 'featured', 'label' => 'Show on homepage', 'type' => 'toggle', 'default' => true],
                    ['key' => 'active', 'label' => 'Show on website', 'type' => 'toggle', 'default' => true],
                ],
                'list' => ['image' => 'image', 'title' => 'title', 'subtitle' => 'year', 'badge' => 'featured'],
            ],
            'media_coverage' => [
                'label' => 'Media Coverage', 'singular' => 'Article', 'icon' => 'fa-newspaper',
                'description' => 'Press articles, TV appearances and podcasts listed on the Media Coverage page.',
                'public' => 'media-coverage',
                'fields' => [
                    ['key' => 'image', 'label' => 'Cover image', 'type' => 'image', 'folder' => 'media', 'alt_key' => 'alt', 'size' => '800 × 500 px'],
                    ['key' => 'outlet', 'label' => 'Publication / Channel', 'type' => 'text', 'required' => true],
                    ['key' => 'headline', 'label' => 'Headline', 'type' => 'text', 'required' => true],
                    ['key' => 'description', 'label' => 'Summary', 'type' => 'textarea'],
                    ['key' => 'date', 'label' => 'Date or tag shown next to the outlet (e.g. Feb 2026, Clinical Update)', 'type' => 'text'],
                    ['key' => 'topic', 'label' => 'Topic pill (e.g. Stroke Awareness)', 'type' => 'text'],
                    ['key' => 'link_url', 'label' => 'Article / video link', 'type' => 'url'],
                    ['key' => 'link_label', 'label' => 'Link button text', 'type' => 'text', 'default' => 'Read Article'],
                    ['key' => 'active', 'label' => 'Show on website', 'type' => 'toggle', 'default' => true],
                ],
                'list' => ['image' => 'image', 'title' => 'headline', 'subtitle' => 'outlet', 'badge' => 'topic'],
            ],
            'videos' => [
                'label' => 'Education Videos', 'singular' => 'Video', 'icon' => 'fa-circle-play',
                'description' => 'YouTube awareness videos for the Video Library pages, homepage slider and the “Watch & Learn” sections on condition pages.',
                'public' => 'videos',
                'fields' => [
                    ['key' => 'youtube_id', 'label' => 'YouTube link or video ID', 'type' => 'youtube', 'required' => true],
                    ['key' => 'title', 'label' => 'Title', 'type' => 'text', 'required' => true],
                    ['key' => 'description', 'label' => 'Short description', 'type' => 'textarea'],
                    ['key' => 'category', 'label' => 'Category (filter chip)', 'type' => 'select', 'options_setting' => 'video_categories', 'default_options' => ['stroke' => 'Stroke', 'epilepsy' => 'Epilepsy', 'headache' => 'Headache', 'dementia' => 'Dementia', 'spine' => 'Spine & Nerve', 'rehab' => 'Rehab', 'wellness' => 'Wellness', 'other' => 'Other']],
                    ['key' => 'related_pages', 'label' => 'Show in “Watch & Learn” on these pages', 'type' => 'pages'],
                    ['key' => 'featured', 'label' => 'Show on homepage', 'type' => 'toggle', 'default' => false],
                    ['key' => 'active', 'label' => 'Show on website', 'type' => 'toggle', 'default' => true],
                ],
                'list' => ['youtube' => 'youtube_id', 'title' => 'title', 'subtitle' => 'description', 'badge' => 'category'],
            ],
            'reels' => [
                'label' => 'Instagram Reels', 'singular' => 'Reel', 'icon' => 'fa-film',
                'description' => 'Reels embedded in the homepage Instagram section.',
                'public' => 'index',
                'fields' => [
                    ['key' => 'shortcode', 'label' => 'Reel link or shortcode (instagram.com/reel/<shortcode>/)', 'type' => 'instagram', 'required' => true],
                    ['key' => 'caption', 'label' => 'Caption (internal note)', 'type' => 'text'],
                    ['key' => 'active', 'label' => 'Show on website', 'type' => 'toggle', 'default' => true],
                ],
                'list' => ['title' => 'shortcode', 'subtitle' => 'caption'],
            ],
            'case_studies' => [
                'label' => 'Case Studies', 'singular' => 'Case Study', 'icon' => 'fa-file-medical',
                'description' => 'Clinical recovery reports on the Case Studies page.',
                'public' => 'case-studies',
                'fields' => [
                    ['key' => 'badge_label', 'label' => 'Condition badge', 'type' => 'text', 'required' => true],
                    ['key' => 'badge_icon', 'label' => 'Badge icon (Font Awesome, e.g. fa-brain)', 'type' => 'text', 'default' => 'fa-brain'],
                    ['key' => 'badge_color', 'label' => 'Badge colour', 'type' => 'color', 'default' => 'electric-blue'],
                    ['key' => 'title', 'label' => 'Title', 'type' => 'text', 'required' => true],
                    ['key' => 'narrative', 'label' => 'Case narrative', 'type' => 'richtext', 'required' => true],
                    ['key' => 'metric1_icon', 'label' => 'Metric 1 icon', 'type' => 'text', 'default' => 'fa-clock'],
                    ['key' => 'metric1_text', 'label' => 'Metric 1 text', 'type' => 'text'],
                    ['key' => 'metric2_icon', 'label' => 'Metric 2 icon', 'type' => 'text', 'default' => 'fa-check-circle'],
                    ['key' => 'metric2_text', 'label' => 'Metric 2 text', 'type' => 'text'],
                    ['key' => 'youtube_id', 'label' => 'YouTube link or ID (optional — shown instead of the image)', 'type' => 'youtube'],
                    ['key' => 'image', 'label' => 'Image', 'type' => 'image', 'folder' => 'case-studies', 'alt_key' => 'alt', 'size' => '800 × 600 px'],
                    ['key' => 'active', 'label' => 'Show on website', 'type' => 'toggle', 'default' => true],
                ],
                'list' => ['image' => 'image', 'title' => 'title', 'subtitle' => 'badge_label'],
            ],
        ];
        return $schemas;
    }
}

if (!function_exists('cms_collection_schema')) {
    function cms_collection_schema($name) {
        $all = cms_collection_schemas();
        return $all[$name] ?? null;
    }
}

if (!function_exists('cms_collection_file')) {
    function cms_collection_file($name) {
        return COLLECTIONS_DIR . '/' . preg_replace('/[^a-z0-9_]/', '', (string)$name) . '.json';
    }
}

if (!function_exists('cms_collection_load')) {
    function cms_collection_load($name) {
        $file = cms_collection_file($name);
        if (!is_file($file)) return [];
        $data = json_decode((string)file_get_contents($file), true);
        if (!is_array($data)) return [];
        usort($data, function ($a, $b) { return ((int)($a['order'] ?? 0)) <=> ((int)($b['order'] ?? 0)); });
        return array_values($data);
    }
}

if (!function_exists('cms_collection_save')) {
    function cms_collection_save($name, array $items) {
        if (!is_dir(COLLECTIONS_DIR)) @mkdir(COLLECTIONS_DIR, 0755, true);
        $n = 1;
        foreach ($items as &$it) { $it['order'] = $n++; }
        unset($it);
        $file = cms_collection_file($name);
        $json = json_encode(array_values($items), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($json === false) return false;
        $tmp = $file . '.tmp.' . uniqid();
        if (file_put_contents($tmp, $json, LOCK_EX) === false) return false;
        if (!@rename($tmp, $file)) { @unlink($tmp); return false; }
        return true;
    }
}

if (!function_exists('cms_collection_options')) {
    /**
     * Options for a select field: the setting named in options_setting
     * (one "key|Label" or "Label" per line) wins over default_options.
     */
    function cms_collection_options(array $field) {
        if (!empty($field['options']) && is_array($field['options'])) return $field['options'];
        $opts = $field['default_options'] ?? [];
        if (!empty($field['options_setting'])) {
            $raw = trim((string)CMS_DB::getSetting($field['options_setting'], ''));
            if ($raw !== '') {
                $opts = [];
                foreach (preg_split('/\r\n|\r|\n/', $raw) as $line) {
                    $line = trim($line);
                    if ($line === '') continue;
                    if (strpos($line, '|') !== false) {
                        [$k, $l] = array_map('trim', explode('|', $line, 2));
                    } else {
                        $l = $line;
                        $k = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $line));
                        $k = trim($k, '-');
                    }
                    if ($k !== '') $opts[$k] = $l;
                }
            }
        }
        return $opts;
    }
}

if (!function_exists('cms_youtube_id')) {
    /** Accepts a YouTube URL or bare id; returns the 11-char id or ''. */
    function cms_youtube_id($value) {
        $value = trim((string)$value);
        if ($value === '') return '';
        if (preg_match('/^[A-Za-z0-9_-]{11}$/', $value)) return $value;
        if (preg_match('~(?:youtu\.be/|v=|/embed/|/shorts/|/live/)([A-Za-z0-9_-]{11})~', $value, $m)) return $m[1];
        return preg_replace('/[^A-Za-z0-9_-]/', '', $value);
    }
}

if (!function_exists('cms_instagram_shortcode')) {
    function cms_instagram_shortcode($value) {
        $value = trim((string)$value);
        if (preg_match('~instagram\.com/(?:reel|p|reels)/([A-Za-z0-9_-]+)~', $value, $m)) return $m[1];
        return preg_replace('/[^A-Za-z0-9_-]/', '', $value);
    }
}

if (!function_exists('cms_collection_read_post')) {
    /**
     * Build one item from the submitted form according to the schema.
     * Returns [item, errors[]].
     */
    function cms_collection_read_post(array $schema, array $existing = []) {
        require_once __DIR__ . '/fields.php';
        $item = $existing;
        $errors = [];
        foreach ($schema['fields'] as $f) {
            $k = $f['key'];
            $type = $f['type'];
            $label = $f['label'] ?? $k;
            switch ($type) {
                case 'image':
                    $res = cms_image_field_value('f_' . $k, $f['folder'] ?? 'library', (string)($existing[$k] ?? ''));
                    if ($res['error'] !== '') $errors[] = $label . ': ' . $res['error'];
                    $item[$k] = $res['path'];
                    if (!empty($f['alt_key'])) {
                        $item[$f['alt_key']] = trim((string)($_POST['f_' . $f['alt_key']] ?? ($existing[$f['alt_key']] ?? '')));
                    }
                    break;
                case 'toggle':
                    $item[$k] = !empty($_POST['f_' . $k]);
                    break;
                case 'tags':
                    $raw = (string)($_POST['f_' . $k] ?? '');
                    $item[$k] = array_values(array_filter(array_map('trim', preg_split('/[,\n]/', $raw)), 'strlen'));
                    break;
                case 'pages':
                    $raw = $_POST['f_' . $k] ?? [];
                    $item[$k] = is_array($raw) ? array_values(array_filter(array_map(function ($s) { return preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$s); }, $raw), 'strlen')) : [];
                    break;
                case 'youtube':
                    $item[$k] = cms_youtube_id($_POST['f_' . $k] ?? '');
                    break;
                case 'instagram':
                    $item[$k] = cms_instagram_shortcode($_POST['f_' . $k] ?? '');
                    break;
                case 'number':
                    $item[$k] = is_numeric($_POST['f_' . $k] ?? null) ? $_POST['f_' . $k] + 0 : null;
                    break;
                case 'select':
                case 'color':
                    $v = trim((string)($_POST['f_' . $k] ?? ''));
                    $opts = $type === 'color'
                        ? ['electric-blue' => 1, 'cyan-accent' => 1, 'deep-indigo' => 1, 'red' => 1, 'dark' => 1, 'emerald' => 1, 'amber' => 1]
                        : cms_collection_options($f);
                    $item[$k] = ($v !== '' && isset($opts[$v])) ? $v : (string)($f['default'] ?? array_key_first($opts) ?? '');
                    break;
                case 'richtext':
                    $item[$k] = trim((string)($_POST['f_' . $k] ?? ''));
                    break;
                default:
                    $item[$k] = trim((string)($_POST['f_' . $k] ?? ''));
            }
            if (!empty($f['required'])) {
                $v = $item[$k];
                $empty = is_array($v) ? empty($v) : (trim(strip_tags((string)$v)) === '');
                if ($empty) $errors[] = $label . ' is required.';
            }
        }
        if (empty($item['id'])) $item['id'] = CMS_DB::generateId();
        if (empty($item['created_at'])) $item['created_at'] = date('Y-m-d H:i:s');
        $item['updated_at'] = date('Y-m-d H:i:s');
        return [$item, $errors];
    }
}
