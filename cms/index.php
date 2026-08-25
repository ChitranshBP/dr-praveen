<?php
$pageTitle = 'Website Content Dashboard';
require_once __DIR__ . '/includes/header.php';

$banners = CMS_DB::get('banners', []);
$services = CMS_DB::get('services', []);
$testimonials = CMS_DB::get('testimonials', []);
$blogs = CMS_DB::get('blogs', []);
$phone = CMS_DB::getSetting('phone', '+91-87969-77903');
$helpline = CMS_DB::getSetting('stroke_helpline', '1800-309-0247');
?>

<div class="max-w-5xl space-y-6">
    <div class="bg-gradient-to-r from-brand-indigo via-blue-950 to-brand-indigo text-white p-6 rounded-3xl shadow-lg border border-white/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-extrabold text-white">Welcome to the Website Content Manager</h2>
            <p class="text-xs text-slate-300 mt-1">Easily update your banner images, text headlines, doctor bio, services, reviews, and phone numbers below.</p>
        </div>
        <a href="publish.php" class="px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold shadow-lg transition-all flex items-center space-x-1.5 flex-shrink-0">
            <i class="fas fa-check-circle"></i>
            <span>Publish to Live Site</span>
        </a>
    </div>

    <!-- Visual Content Edit Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <!-- Banners Card -->
        <a href="banners.php" class="bg-white p-5 rounded-2xl border border-slate-200 hover:border-brand-blue shadow-sm hover:shadow-md transition-all group flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-brand-blue flex items-center justify-center text-lg mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-images"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">Hero Banners & Slider</h3>
                <p class="text-xs text-slate-500">Change banner images, headline text, and CTA buttons on the homepage.</p>
            </div>
            <div class="pt-3 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-brand-blue font-bold">
                <span><?php echo count($banners); ?> Slides</span>
                <span class="group-hover:translate-x-1 transition-transform">Edit &rarr;</span>
            </div>
        </a>

        <!-- About Doctor Card -->
        <a href="about-editor.php" class="bg-white p-5 rounded-2xl border border-slate-200 hover:border-brand-blue shadow-sm hover:shadow-md transition-all group flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">About Doctor Profile</h3>
                <p class="text-xs text-slate-500">Update Dr. Praveen Gupta's photo, biography text, qualifications, and stats.</p>
            </div>
            <div class="pt-3 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-brand-blue font-bold">
                <span>Doctor Bio & Stats</span>
                <span class="group-hover:translate-x-1 transition-transform">Edit &rarr;</span>
            </div>
        </a>

        <!-- Services Card -->
        <a href="services.php" class="bg-white p-5 rounded-2xl border border-slate-200 hover:border-brand-blue shadow-sm hover:shadow-md transition-all group flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-lg mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-brain"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">Brain & Spine Condition Cards</h3>
                <p class="text-xs text-slate-500">Edit titles, images, and procedure lists for Stroke, Epilepsy, Brain Tumor, Spine, etc.</p>
            </div>
            <div class="pt-3 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-brand-blue font-bold">
                <span><?php echo count($services); ?> Cards</span>
                <span class="group-hover:translate-x-1 transition-transform">Edit &rarr;</span>
            </div>
        </a>

        <!-- Testimonials Card -->
        <a href="testimonials.php" class="bg-white p-5 rounded-2xl border border-slate-200 hover:border-brand-blue shadow-sm hover:shadow-md transition-all group flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-lg mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">Patient Testimonials</h3>
                <p class="text-xs text-slate-500">Add or edit patient review text, star ratings, and recovery stories.</p>
            </div>
            <div class="pt-3 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-brand-blue font-bold">
                <span><?php echo count($testimonials); ?> Reviews</span>
                <span class="group-hover:translate-x-1 transition-transform">Edit &rarr;</span>
            </div>
        </a>

        <!-- Blogs Card -->
        <a href="blogs.php" class="bg-white p-5 rounded-2xl border border-slate-200 hover:border-brand-blue shadow-sm hover:shadow-md transition-all group flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center text-lg mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">Blog Posts & Articles</h3>
                <p class="text-xs text-slate-500">Write articles, edit health guides, and update post banner images.</p>
            </div>
            <div class="pt-3 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-brand-blue font-bold">
                <span><?php echo count($blogs); ?> Articles</span>
                <span class="group-hover:translate-x-1 transition-transform">Edit &rarr;</span>
            </div>
        </a>

        <!-- All Pages Content Card -->
        <a href="pages.php" class="bg-white p-5 rounded-2xl border border-slate-200 hover:border-brand-blue shadow-sm hover:shadow-md transition-all group flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-brand-blue flex items-center justify-center text-lg mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">All Website Pages</h3>
                <p class="text-xs text-slate-500">Edit any page directly: Functional Neurosurgery, Stroke, Spine, Why Choose Us, etc.</p>
            </div>
            <div class="pt-3 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-brand-blue font-bold">
                <span>All 20+ Pages</span>
                <span class="group-hover:translate-x-1 transition-transform">Edit &rarr;</span>
            </div>
        </a>

        <!-- Medical Team Card -->
        <a href="doctors.php" class="bg-white p-5 rounded-2xl border border-slate-200 hover:border-brand-blue shadow-sm hover:shadow-md transition-all group flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-lg mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">Our Medical Team</h3>
                <p class="text-xs text-slate-500">Edit associate doctors on team.php, their photos, designations, and bios.</p>
            </div>
            <div class="pt-3 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-brand-blue font-bold">
                <span>Team Page</span>
                <span class="group-hover:translate-x-1 transition-transform">Edit &rarr;</span>
            </div>
        </a>

        <!-- Contact Info Card -->
        <a href="contact-editor.php" class="bg-white p-5 rounded-2xl border border-slate-200 hover:border-brand-blue shadow-sm hover:shadow-md transition-all group flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-lg mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">Phone & Contact Info</h3>
                <p class="text-xs text-slate-500">Update phone numbers, WhatsApp, clinic address, and email.</p>
            </div>
            <div class="pt-3 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-brand-blue font-bold">
                <span><?php echo htmlspecialchars($phone); ?></span>
                <span class="group-hover:translate-x-1 transition-transform">Edit &rarr;</span>
            </div>
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
