<?php
$pageTitle = 'Leads & Inquiries';
require_once __DIR__ . '/includes/header.php';

$leads = CMS_DB::get('leads', []);

if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="leads_' . date('Y-m-d') . '.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID', 'Date', 'Name', 'Phone', 'Email', 'Source', 'Message']);
    foreach ($leads as $l) {
        fputcsv($out, [
            $l['id'] ?? '',
            $l['created_at'] ?? '',
            $l['name'] ?? '',
            $l['phone'] ?? '',
            $l['email'] ?? '',
            $l['source'] ?? '',
            $l['message'] ?? ''
        ]);
    }
    fclose($out);
    exit;
}
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
                        <th class="p-3.5">Condition/Notes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    <?php foreach ($leads as $lead): ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-3.5 text-slate-400 whitespace-nowrap"><?php echo htmlspecialchars($lead['created_at'] ?? ''); ?></td>
                        <td class="p-3.5 font-bold text-slate-900"><?php echo htmlspecialchars($lead['name'] ?? ''); ?></td>
                        <td class="p-3.5"><a href="tel:<?php echo htmlspecialchars($lead['phone'] ?? ''); ?>" class="text-brand-blue hover:underline"><?php echo htmlspecialchars($lead['phone'] ?? ''); ?></a></td>
                        <td class="p-3.5"><?php echo htmlspecialchars($lead['email'] ?? ''); ?></td>
                        <td class="p-3.5 max-w-xs truncate"><?php echo htmlspecialchars($lead['message'] ?? ''); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
