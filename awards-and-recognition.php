<?php
/**
 * Awards & Recognition Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-cyan-accent/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Awards & Recognition</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-award text-cyan-accent text-[10px]"></i>
                <span>Honors & Certifications</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Awards & <span class="text-cyan-accent">Recognition</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Recognizing outstanding clinical contributions, medical innovations, and dedicated patient care services in the field of neurology.
            </p>
        </div>
    </div>
</section>

<!-- Gallery Grid Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider font-sans">Honors Gallery</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Clinical Milestones & Awards</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                A visual showcase of awards, academic commendations, and recognitions received by Dr. Praveen Gupta.
            </p>
        </div>

        <!-- Check if awards list is populated from config -->
        <?php if (isset($awards) && !empty($awards)): ?>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($awards as $award): ?>
                    <div class="group bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="relative overflow-hidden aspect-[4/3] bg-gradient-to-br from-deep-indigo/10 to-cyan-accent/10">
                            <!-- Image -->
                            <img src="<?php echo $award['image']; ?>" alt="<?php echo $award['title']; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-deep-indigo/40 via-transparent to-transparent"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-sm font-bold text-deep-indigo leading-snug group-hover:text-electric-blue transition-colors">
                                <?php echo $award['title']; ?>
                            </h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-xs text-dark-grey/55">No awards data available in site configuration.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Key Accreditations -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left: Text -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Professional Status</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Certifications & Accreditations</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Over his distinguished career, Dr. Praveen Gupta has established high clinical standards in neurology, leading specialized care initiatives at premier hospitals across India.
                </p>
                
                <div class="grid sm:grid-cols-2 gap-6 text-xs text-dark-grey/70">
                    <div class="flex items-start space-x-3">
                        <div class="w-5 h-5 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></div>
                        <div>
                            <strong class="text-deep-indigo">Director of Neurology:</strong> Chairman position leading critical care neuro services.
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-5 h-5 bg-electric-blue/10 rounded-full flex items-center justify-center text-electric-blue flex-shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></div>
                        <div>
                            <strong class="text-deep-indigo">National Board Certified:</strong> Board certified specialist with credentials matching global care indices.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right -->
            <div class="lg:col-span-5 bg-gradient-to-br from-deep-indigo to-indigo-950 text-white p-8 rounded-3xl space-y-4">
                <h3 class="text-xl font-bold font-serif">Clinical Credentials</h3>
                <p class="text-xs text-white/80 leading-relaxed">
                    For detailed reviews of published research, clinical cases, or academic lectures, please consult our dedicated medical resources hubs.
                </p>
                <div class="pt-2">
                    <a href="contact-us-top-neurologist-delhi-ncr.php" class="block w-full text-center bg-cyan-accent hover:bg-cyan-500 text-deep-indigo font-bold py-3 rounded-2xl transition-colors text-xs">
                        Book Consultation
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
