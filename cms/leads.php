<?php
$pageTitle = 'Leads & Inquiries';
require_once __DIR__ . '/includes/header.php';

$leads = CMS_DB::get('leads', []);
// Newest first
usort($leads, function ($a, $b) { return strcmp((string)($b['created_at'] ?? ''), (string)($a['created_at'] ?? '')); });

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cms_verify_csrf();
    $action = $_POST['action'] ?? '';
    $id = (string)($_POST['id'] ?? '');
    if ($action === 'status') {
        $status = in_array($_POST['status'] ?? '', ['new', 'contacted', 'closed'], true) ? $_POST['status'] : 'new';
        foreach ($leads as &$l) {
            if ((string)($l['id'] ?? '') === $id) { $l['status'] = $status; break; }
        }
        unset($l);
        CMS_DB::set('leads', $leads);
        cms_set_flash('success', 'Lead status updated.');
    } elseif ($action === 'delete') {
        foreach ($leads as $l) {
            if ((string)($l['id'] ?? '') === $id && !empty($l['report'])) {
                $f = DATA_DIR . '/lead-uploads/' . basename($l['report']);
                if (is_file($f)) @unlink($f);
            }
        }
        $leads = array_values(array_filter($leads, function ($l) use ($id) { return (string)($l['id'] ?? '') !== $id; }));
        CMS_DB::set('leads', $leads);
        cms_set_flash('success', 'Lead deleted.');
    }
    header('Location: leads.php');
    exit;
}

if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    if (ob_get_level() > 0) { ob_end_clean(); }
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="leads_' . date('Y-m-d') . '.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID', 'Date', 'Name', 'Phone', 'Email', 'Subject', 'Source', 'Status', 'Message']);
    foreach ($leads as $l) {
        fputcsv($out, [
            $l['id'] ?? '',
            $l['created_at'] ?? '',
            $l['name'] ?? '',
            $l['phone'] ?? '',
            $l['email'] ?? '',
            $l['subject'] ?? '',
            $l['source'] ?? '',
            $l['status'] ?? 'new',
            $l['message'] ?? ''
        ]);
    }
    fclose($out);
    exit;
}
$statusClasses = ['new' => 'bg-blue-50 text-blue-700', 'contacted' => 'bg-amber-50 text-amber-700', 'closed' => 'bg-slate-100 text-slate-500'];
?>

<div class="space-y-6 max-w-6xl">
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Patient Inquiries & Appointment Requests (<?php echo count($leads); ?>)</h2>
        <?php if (!empty($leads)): ?>
        <a href="leads.php?export=csv" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all flex items-center space-x-1.5">
            <i class="fas fa-file-csv"></i>
            <span>Export CSV</span>
        </a>
        <?php endif; ?>
    </div>

    <?php if (empty($leads)): ?>
    <div class="bg-white p-12 rounded-2xl border border-slate-200 text-center">
        <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3 text-lg">
            <i class="fas fa-inbox"></i>
        </div>
        <p class="text-xs font-bold text-slate-600">No leads recorded yet</p>
        <p class="text-[11px] text-slate-400 mt-1">When patients submit the website appointment form, inquiries will appear here.</p>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 border-b border-slate-200 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                    <tr>
                        <th class="p-3.5">Date</th>
                        <th class="p-3.5">Name</th>
                        <th class="p-3.5">Phone</th>
                        <th class="p-3.5">Email</th>
                        <th class="p-3.5">Subject / Source</th>
                        <th class="p-3.5">Message</th>
                        <th class="p-3.5">Status</th>
                        <th class="p-3.5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    <?php foreach ($leads as $lead): $st = $lead['status'] ?? 'new'; ?>
                    <tr class="hover:bg-slate-50 transition-colors align-top">
                        <td class="p-3.5 text-slate-400 whitespace-nowrap"><?php echo htmlspecialchars($lead['created_at'] ?? ''); ?></td>
                        <td class="p-3.5 font-bold text-slate-900"><?php echo htmlspecialchars($lead['name'] ?? ''); ?></td>
                        <td class="p-3.5 whitespace-nowrap"><a href="tel:<?php echo htmlspecialchars($lead['phone'] ?? ''); ?>" class="text-brand-blue hover:underline"><?php echo htmlspecialchars($lead['phone'] ?? ''); ?></a></td>
                        <td class="p-3.5"><?php echo htmlspecialchars($lead['email'] ?? ''); ?></td>
                        <td class="p-3.5">
                            <div class="font-semibold text-slate-800"><?php echo htmlspecialchars($lead['subject'] ?? ''); ?></div>
                            <div class="text-[10px] text-slate-400"><?php echo htmlspecialchars($lead['source'] ?? ''); ?></div>
                        </td>
                        <td class="p-3.5 max-w-xs">
                            <div class="whitespace-pre-line line-clamp-3" title="<?php echo htmlspecialchars($lead['message'] ?? ''); ?>"><?php echo htmlspecialchars($lead['message'] ?? ''); ?></div>
                            <?php if (!empty($lead['report'])): ?>
                            <a href="lead-file.php?f=<?php echo urlencode(basename($lead['report'])); ?>" class="inline-flex items-center space-x-1 mt-1 text-[10px] font-bold text-brand-blue hover:underline"><i class="fas fa-paperclip"></i><span>Download report</span></a>
                            <?php endif; ?>
                        </td>
                        <td class="p-3.5">
                            <form method="POST" class="inline">
                                <?php echo cms_csrf_field(); ?>
                                <input type="hidden" name="action" value="status">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($lead['id'] ?? ''); ?>">
                                <select name="status" onchange="this.form.submit()" class="px-2 py-1 rounded-lg text-[10px] font-bold border-0 <?php echo $statusClasses[$st] ?? $statusClasses['new']; ?>">
                                    <?php foreach (['new' => 'New', 'contacted' => 'Contacted', 'closed' => 'Closed'] as $sk => $sl): ?>
                                    <option value="<?php echo $sk; ?>" <?php echo $st === $sk ? 'selected' : ''; ?>><?php echo $sl; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                        </td>
                        <td class="p-3.5">
                            <form method="POST" class="inline" onsubmit="return confirm('Delete this lead permanently?');">
                                <?php echo cms_csrf_field(); ?>
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($lead['id'] ?? ''); ?>">
                                <button type="submit" class="text-slate-400 hover:text-red-600" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
