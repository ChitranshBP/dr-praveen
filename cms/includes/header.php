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
    <!-- Quill WYSIWYG Rich Editor -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .ql-toolbar.ql-snow { 
            border-top-left-radius: 0.75rem; 
            border-top-right-radius: 0.75rem; 
            border-color: #e2e8f0; 
            background: #f8fafc; 
            padding: 8px 10px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2px;
        }
        .ql-snow .ql-formats {
            margin-right: 6px !important;
            padding-right: 6px !important;
            border-right: 1px solid #e2e8f0 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 2px !important;
            margin-bottom: 3px !important;
        }
        .ql-snow .ql-formats:last-child {
            border-right: none !important;
            margin-right: 0 !important;
            padding-right: 0 !important;
        }
        .ql-container.ql-snow { 
            border-bottom-left-radius: 0.75rem; 
            border-bottom-right-radius: 0.75rem; 
            border-color: #e2e8f0; 
            background: #ffffff; 
            font-family: 'Inter', sans-serif; 
            font-size: 0.875rem; 
        }
        .ql-editor { 
            min-height: 180px; 
            line-height: 1.65; 
            color: #1e293b;
        }
        .ql-editor p { margin-bottom: 0.75rem; }
        .ql-editor h1 { font-size: 2rem; font-weight: 800; margin: 1.25rem 0 0.5rem; color: #0f172a; }
        .ql-editor h2 { font-size: 1.5rem; font-weight: 700; margin: 1rem 0 0.5rem; color: #0f172a; }
        .ql-editor h3 { font-size: 1.25rem; font-weight: 700; margin: 0.875rem 0 0.5rem; color: #1e293b; }
        .ql-editor h4 { font-size: 1.1rem; font-weight: 600; margin: 0.75rem 0 0.5rem; color: #334155; }
        
        /* Table Styles inside Editor */
        .ql-editor table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            font-size: 0.875rem;
        }
        .ql-editor th, .ql-editor td {
            border: 1px solid #cbd5e1;
            padding: 8px 12px;
            text-align: left;
        }
        .ql-editor th {
            background-color: #f1f5f9;
            font-weight: 700;
            color: #0f172a;
        }
        .ql-editor blockquote {
            border-left: 4px solid #2563eb;
            padding-left: 1rem;
            color: #475569;
            font-style: italic;
            margin: 1rem 0;
        }
        .ql-editor hr {
            border: 0;
            border-top: 2px solid #e2e8f0;
            margin: 1.5rem 0;
        }

        /* Custom Font Size Dropdown Labels */
        .ql-snow .ql-picker.ql-size { width: 125px; }
        .ql-snow .ql-picker.ql-size .ql-picker-label::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item::before {
            content: '14px (Normal)';
        }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="10px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="10px"]::before { content: '10px (Tiny)'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="12px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="12px"]::before { content: '12px (Small)'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="14px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="14px"]::before { content: '14px (Normal)'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="16px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="16px"]::before { content: '16px (Medium)'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="18px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="18px"]::before { content: '18px (Large)'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="20px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="20px"]::before { content: '20px (XL)'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="24px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="24px"]::before { content: '24px (2XL)'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="28px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="28px"]::before { content: '28px (3XL)'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="32px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="32px"]::before { content: '32px (4XL)'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="36px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="36px"]::before { content: '36px (5XL)'; }
        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="48px"]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="48px"]::before { content: '48px (Huge)'; }

        /* Custom Font Family Dropdown Labels */
        .ql-snow .ql-picker.ql-font { width: 135px; }
        .ql-snow .ql-picker.ql-font .ql-picker-label::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item::before {
            content: 'Default Font';
        }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="sans-serif"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="sans-serif"]::before { content: 'Sans-Serif'; font-family: sans-serif; }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="Arial"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="Arial"]::before { content: 'Arial'; font-family: Arial, sans-serif; }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="Georgia"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="Georgia"]::before { content: 'Georgia'; font-family: Georgia, serif; }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="Times New Roman"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="Times New Roman"]::before { content: 'Times New Roman'; font-family: 'Times New Roman', serif; }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="Trebuchet MS"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="Trebuchet MS"]::before { content: 'Trebuchet MS'; font-family: 'Trebuchet MS', sans-serif; }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="Verdana"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="Verdana"]::before { content: 'Verdana'; font-family: Verdana, sans-serif; }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="Roboto"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="Roboto"]::before { content: 'Roboto'; font-family: 'Roboto', sans-serif; }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="monospace"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="monospace"]::before { content: 'Monospace'; font-family: monospace; }
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="serif"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="serif"]::before { content: 'Serif'; font-family: serif; }

        /* Headings Dropdown Labels */
        .ql-snow .ql-picker.ql-header { width: 125px; }
        .ql-snow .ql-picker.ql-header .ql-picker-label::before,
        .ql-snow .ql-picker.ql-header .ql-picker-item::before { content: 'Normal Text'; }
        .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="1"]::before,
        .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="1"]::before { content: 'Heading 1'; }
        .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="2"]::before,
        .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="2"]::before { content: 'Heading 2'; }
        .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="3"]::before,
        .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="3"]::before { content: 'Heading 3'; }
        .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="4"]::before,
        .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="4"]::before { content: 'Heading 4'; }
        .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="5"]::before,
        .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="5"]::before { content: 'Heading 5'; }
        .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="6"]::before,
        .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="6"]::before { content: 'Heading 6'; }

        /* Fullscreen Mode */
        .cms-quill-fullscreen-mode {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            z-index: 999999 !important;
            background: #f1f5f9 !important;
            padding: 1.25rem !important;
            box-sizing: border-box !important;
            display: flex !important;
            flex-direction: column !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
        }
        .cms-quill-fullscreen-mode .ql-container {
            flex: 1 !important;
            overflow-y: auto !important;
            background: #ffffff !important;
        }
        .cms-quill-fullscreen-mode .ql-toolbar {
            background: #ffffff !important;
        }
    </style>
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
