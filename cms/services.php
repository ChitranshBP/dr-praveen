<?php
$pageTitle = 'Brain & Spine Condition Cards';
require_once __DIR__ . '/includes/header.php';

$services = CMS_DB::get('services', []);
?>

<div class="space-y-6 max-w-6xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-200">
        <div>
            <h2 class="text-base font-bold text-slate-900">Brain & Spine Condition Cards</h2>
            <p class="text-xs text-slate-500 mt-0.5">Edit the 9 condition cards displayed in the "Comprehensive Care for Every Brain & Spine Condition" section on your homepage.</p>
        </div>
        <a href="service-edit.php" class="px-4 py-2 bg-brand-blue hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all flex items-center space-x-1.5 self-start sm:self-auto">
            <i class="fas fa-plus"></i>
            <span>Add New Card</span>
        </a>
    </div>

    <!-- Visual Cards Grid (Matches Website Layout) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($services as $svc): ?>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <!-- Card Image Preview -->
                <div class="relative w-full aspect-[4/3] bg-slate-100 overflow-hidden border-b border-slate-100">
                    <img src="../<?php echo htmlspecialchars($svc['image'] ?? 'assets/services/stroke-care.png'); ?>" class="w-full h-full object-cover" alt="Card Image">
                    <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-[10px] font-bold shadow-sm <?php echo !empty($svc['is_active']) ? 'bg-emerald-500 text-white' : 'bg-slate-800 text-slate-200'; ?>">
                        <?php echo !empty($svc['is_active']) ? 'Active' : 'Hidden'; ?>
                    </span>
                </div>

                <div class="p-5">
                    <h3 class="text-sm font-bold text-slate-900 mb-1.5 leading-tight"><?php echo htmlspecialchars($svc['title']); ?></h3>
                    <p class="text-xs text-slate-500 line-clamp-2 mb-3"><?php echo htmlspecialchars($svc['short_description'] ?? ''); ?></p>

                    <!-- Features preview -->
                    <?php if (!empty($svc['features'])): ?>
                    <div class="space-y-1 mb-3 pt-2 border-t border-slate-100 text-[11px] text-slate-600">
                        <?php foreach (array_slice($svc['features'], 0, 3) as $feat): ?>
                        <div class="flex items-center space-x-1.5 truncate">
                            <i class="fas fa-check text-[9px] text-brand-blue flex-shrink-0"></i>
                            <span class="truncate"><?php echo htmlspecialchars($feat); ?></span>
                        </div>
                        <?php endforeach; ?>
                        <?php if (count($svc['features']) > 3): ?>
                        <span class="text-[10px] text-slate-400 font-semibold">+<?php echo count($svc['features']) - 3; ?> more procedures</span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="service-edit.php?id=<?php echo urlencode($svc['id']); ?>" class="px-3 py-1.5 bg-brand-blue hover:bg-blue-700 text-white font-bold rounded-lg transition-colors flex items-center space-x-1">
                    <i class="fas fa-edit text-[10px]"></i>
                    <span>Edit Content & Image</span>
                </a>
                <span class="text-[11px] text-slate-400 font-semibold">Card #<?php echo $svc['order'] ?? 1; ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
