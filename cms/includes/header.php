<?php
ob_start();

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/functions.php';
cms_require_auth();

$currentUser = cms_current_user();
$siteName = CMS_DB::getSetting('site_name', 'Dr. Praveen Gupta');
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
$flash = cms_get_flash();
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle ?? 'Edit Content'); ?> - Website Manager</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-indigo': '#1E1B4B',
                        'brand-blue': '#2563EB',
                        'brand-cyan': '#06B6D4'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="h-full flex flex-col antialiased text-slate-800">

    <div class="min-h-full flex">
        <!-- Sidebar Navigation -->
        <aside class="w-60 bg-brand-indigo text-white flex-shrink-0 flex flex-col justify-between hidden md:flex border-r border-indigo-950">
            <div>
                <!-- Brand Header -->
                <div class="h-16 flex items-center px-6 border-b border-indigo-900/60">
                    <a href="index.php" class="flex items-center space-x-2.5">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-brand-blue to-brand-cyan flex items-center justify-center text-white shadow-md">
                            <i class="fas fa-edit text-sm"></i>
                        </div>
                        <div>
                            <span class="font-bold text-sm text-white block leading-tight">Content Editor</span>
                            <span class="text-[10px] text-slate-400 block">Dr. Praveen Gupta</span>
                        </div>
                    </a>
                </div>

                <!-- Simple Nav Menu -->
                <nav class="px-3 py-4 space-y-1 text-xs font-semibold">
                    <a href="index.php" class="flex items-center px-3 py-2.5 rounded-xl transition-all <?php echo $currentPage === 'index' ? 'bg-brand-blue text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white'; ?>">
                        <i class="fas fa-home w-5 text-center mr-2.5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="banners.php" class="flex items-center px-3 py-2.5 rounded-xl transition-all <?php echo $currentPage === 'banners' ? 'bg-brand-blue text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white'; ?>">
                        <i class="fas fa-images w-5 text-center mr-2.5"></i>
                        <span>Hero Banners</span>
                    </a>
                    <a href="about-editor.php" class="flex items-center px-3 py-2.5 rounded-xl transition-all <?php echo $currentPage === 'about-editor' ? 'bg-brand-blue text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white'; ?>">
                        <i class="fas fa-user-md w-5 text-center mr-2.5"></i>
                        <span>About Doctor</span>
                    </a>
                    <a href="services.php" class="flex items-center px-3 py-2.5 rounded-xl transition-all <?php echo $currentPage === 'services' || $currentPage === 'service-edit' ? 'bg-brand-blue text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white'; ?>">
                        <i class="fas fa-brain w-5 text-center mr-2.5"></i>
                        <span>Brain & Spine Cards</span>
                    </a>
                    <a href="testimonials.php" class="flex items-center px-3 py-2.5 rounded-xl transition-all <?php echo $currentPage === 'testimonials' ? 'bg-brand-blue text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white'; ?>">
                        <i class="fas fa-star w-5 text-center mr-2.5 text-amber-400"></i>
                        <span>Testimonials</span>
                    </a>
                    <a href="blogs.php" class="flex items-center px-3 py-2.5 rounded-xl transition-all <?php echo $currentPage === 'blogs' || $currentPage === 'blog-edit' ? 'bg-brand-blue text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white'; ?>">
                        <i class="fas fa-newspaper w-5 text-center mr-2.5"></i>
                        <span>Blog Posts</span>
                    </a>
                    <a href="pages.php" class="flex items-center px-3 py-2.5 rounded-xl transition-all <?php echo $currentPage === 'pages' || $currentPage === 'page-edit' ? 'bg-brand-blue text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white'; ?>">
                        <i class="fas fa-file-alt w-5 text-center mr-2.5"></i>
                        <span>All Pages Content</span>
                    </a>
                    <a href="doctors.php" class="flex items-center px-3 py-2.5 rounded-xl transition-all <?php echo $currentPage === 'doctors' || $currentPage === 'doctor-edit' ? 'bg-brand-blue text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white'; ?>">
                        <i class="fas fa-users w-5 text-center mr-2.5"></i>
                        <span>Our Medical Team</span>
                    </a>
                    <a href="contact-editor.php" class="flex items-center px-3 py-2.5 rounded-xl transition-all <?php echo $currentPage === 'contact-editor' ? 'bg-brand-blue text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white'; ?>">
                        <i class="fas fa-phone-alt w-5 text-center mr-2.5"></i>
                        <span>Phone & Contact</span>
                    </a>
                </nav>
            </div>

            <!-- User Logout -->
            <div class="p-4 border-t border-indigo-900/60 bg-black/20">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-white"><?php echo htmlspecialchars($currentUser['username'] ?? 'admin'); ?></span>
                    <a href="logout.php" title="Logout" class="text-xs text-red-400 hover:text-red-300 font-semibold flex items-center space-x-1">
                        <span>Logout</span>
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Topbar Header -->
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 z-10">
                <h1 class="text-base font-bold text-slate-800"><?php echo htmlspecialchars($pageTitle ?? 'Edit Content'); ?></h1>
                <div class="flex items-center space-x-3">
                    <a href="../" target="_blank" class="inline-flex items-center space-x-1.5 px-3.5 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                        <i class="fas fa-external-link-alt text-[10px]"></i>
                        <span>View Website</span>
                    </a>
                    <a href="publish.php" class="inline-flex items-center space-x-1.5 px-4 py-1.5 rounded-xl bg-emerald-600 text-white text-xs font-bold hover:bg-emerald-700 shadow-sm transition-colors">
                        <i class="fas fa-sync-alt text-[11px]"></i>
                        <span>Publish Changes</span>
                    </a>
                </div>
            </header>

            <!-- Flash Alert -->
            <?php if ($flash): ?>
            <div class="px-6 pt-4">
                <div class="p-3.5 rounded-xl text-xs font-semibold flex items-center space-x-2.5 <?php echo $flash['type'] === 'success' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-red-50 text-red-800 border border-red-200'; ?>">
                    <i class="fas <?php echo $flash['type'] === 'success' ? 'fa-check-circle text-emerald-500' : 'fa-exclamation-circle text-red-500'; ?> text-base"></i>
                    <span><?php echo htmlspecialchars($flash['message']); ?></span>
                </div>
            </div>
            <?php endif; ?>

            <!-- Page Body -->
            <main class="flex-1 overflow-y-auto p-6">
