<?php
$pageTitle = 'Publish & Rebuild Site';
require_once __DIR__ . '/includes/header.php';

$output = '';
$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();

    $buildScript = dirname(CMS_ROOT) . '/build.php';
    if (file_exists($buildScript)) {
        $lines = [];
        $exitCode = 1;
        exec('php ' . escapeshellarg($buildScript) . ' 2>&1', $lines, $exitCode);
        $output = implode("\n", $lines);

        if ($exitCode === 0) {
            // Double-check the build actually produced output files
            $distDir = dirname(CMS_ROOT) . '/dist';
            $htmlFiles = is_dir($distDir) ? glob($distDir . '/*.html') : [];
            if (!empty($htmlFiles)) {
                $status = 'success';
                cms_set_flash('success', count($htmlFiles) . ' static page(s) compiled into /dist successfully!');
            } else {
                $status = 'error';
                cms_set_flash('error', 'Build finished but no HTML files were generated. Check the log below.');
            }
        } else {
            $status = 'error';
            cms_set_flash('error', 'Build FAILED (exit code ' . $exitCode . '). Check the log below.');
        }
    } else {
        $output = 'build.php script not found.';
        $status = 'error';
        cms_set_flash('error', 'build.php script was not found on the server.');
    }
}
?>

<div class="max-w-4xl space-y-6">
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-3 border-b border-slate-100 flex items-center">
            <i class="fas fa-rocket text-emerald-600 mr-2"></i> 1-Click Static Site Compilation
        </h2>
        <p class="text-xs text-slate-600 leading-relaxed">
            Clicking the button below will run the automated build compiler (<code class="bg-slate-100 px-1.5 py-0.5 rounded text-brand-blue font-mono font-bold">build.php</code>) to generate static, ultra-fast HTML files into the <code class="bg-slate-100 px-1.5 py-0.5 rounded text-brand-blue font-mono font-bold">dist/</code> folder for production or Netlify hosting.
        </p>

        <form method="POST" action="" class="pt-2">
            <?php echo cms_csrf_field(); ?>
            <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-emerald-500/25 transition-all flex items-center space-x-2">
                <i class="fas fa-sync-alt"></i>
                <span>Compile & Publish Entire Website</span>
            </button>
        </form>
    </div>

    <?php if ($output): ?>
    <div class="bg-slate-900 text-emerald-400 p-5 rounded-2xl font-mono text-xs overflow-x-auto shadow-xl border border-slate-800">
        <div class="flex items-center justify-between pb-3 border-b border-slate-800 mb-3 text-slate-400">
            <span class="font-bold">Build Output Log</span>
            <span><?php echo date('Y-m-d H:i:s'); ?></span>
        </div>
        <pre class="whitespace-pre-wrap"><?php echo htmlspecialchars($output); ?></pre>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
