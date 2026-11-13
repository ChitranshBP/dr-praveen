<?php
/**
 * Merge a backup of the live server's data/ folder back over the repo's data/
 * after a git pull, so CMS edits made on the server are kept and the new keys
 * shipped with the code are added.
 *
 *   php scripts/merge-live-data.php /path/to/data-backup [--dry-run]
 *
 * Rules (per JSON file present in the backup):
 *   - objects (settings, pages/*.json, page-blocks, …): live values win,
 *     keys that only exist in the repo version are added
 *   - lists (blogs, doctors, testimonials, collections …): live list is kept,
 *     repo items whose id/slug is missing are appended
 *   - files that only exist in the backup are copied as they are
 * Then sitemap.xml is regenerated.
 */
$backup = rtrim((string)($argv[1] ?? ''), '/\\');
$dry = in_array('--dry-run', $argv, true);
$root = dirname(__DIR__);
$dataDir = $root . '/data';
if ($backup === '' || !is_dir($backup)) {
    fwrite(STDERR, "Usage: php scripts/merge-live-data.php /path/to/data-backup [--dry-run]\n");
    exit(1);
}

function isList(array $a) { return array_keys($a) === range(0, count($a) - 1); }
function itemKey(array $item) {
    foreach (['id', 'slug', 'shortcode', 'youtube_id'] as $k) {
        if (isset($item[$k]) && $item[$k] !== '') return $k . ':' . $item[$k];
    }
    return 'json:' . md5(json_encode($item));
}
function mergeData($live, $repo) {
    if (!is_array($live) || !is_array($repo)) return $live;
    if (isList($live) && isList($repo)) {
        $seen = [];
        foreach ($live as $it) { if (is_array($it)) $seen[itemKey($it)] = true; }
        foreach ($repo as $it) {
            if (is_array($it) && !isset($seen[itemKey($it)])) { $live[] = $it; }
        }
        return $live;
    }
    if (!isList($live) && !isList($repo)) {
        foreach ($repo as $k => $v) {
            if (!array_key_exists($k, $live)) { $live[$k] = $v; }
            elseif (is_array($v) && is_array($live[$k]) && !isList($v) && !isList($live[$k])) { $live[$k] = mergeData($live[$k], $v); }
        }
        return $live;
    }
    return $live;
}

$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($backup, FilesystemIterator::SKIP_DOTS));
$changed = 0;
foreach ($files as $file) {
    $rel = substr($file->getPathname(), strlen($backup) + 1);
    $rel = str_replace('\\', '/', $rel);
    if (strpos($rel, 'lead-uploads/') === 0 || substr($rel, -5) !== '.json') continue;
    $target = $dataDir . '/' . $rel;
    $liveRaw = file_get_contents($file->getPathname());
    $live = json_decode($liveRaw, true);
    if (!is_array($live)) { echo "skip (not JSON): $rel\n"; continue; }
    $repo = is_file($target) ? json_decode((string)file_get_contents($target), true) : null;
    $merged = is_array($repo) ? mergeData($live, $repo) : $live;
    $out = json_encode($merged, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n";
    if (is_file($target) && trim((string)file_get_contents($target)) === trim($out)) continue;
    echo ($dry ? 'would write: ' : 'write: ') . $rel . "\n";
    $changed++;
    if (!$dry) {
        if (!is_dir(dirname($target))) @mkdir(dirname($target), 0755, true);
        file_put_contents($target, $out, LOCK_EX);
    }
}
echo "$changed file(s) " . ($dry ? 'would change' : 'merged') . ".\n";

if (!$dry) {
    $sitemapGen = $root . '/includes/generate-sitemap.php';
    if (is_file($sitemapGen)) {
        require_once $root . '/includes/config.php';
        require_once $sitemapGen;
        if (function_exists('generate_sitemap_xml')) { @generate_sitemap_xml(); echo "sitemap.xml regenerated\n"; }
    }
}
