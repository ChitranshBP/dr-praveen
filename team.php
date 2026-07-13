<?php
/**
 * Team Listing Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';

// Load doctor data from JSON
$doctorsJsonPath = __DIR__ . '/assets/doctors_full.json';
$doctors = [];
$praveenGupta = null;
$specialtyTeam = [];

if (file_exists($doctorsJsonPath)) {
    $doctorsJson = file_get_contents($doctorsJsonPath);
    $doctors = json_decode($doctorsJson, true);
    if (is_array($doctors)) {
        foreach ($doctors as $doc) {
            if (isset($doc['name']) && $doc['name'] === 'Dr. Praveen Gupta') {
                $praveenGupta = $doc;
            } else {
                $specialtyTeam[] = $doc;
            }
        }
    }
}
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
                <span class="text-white font-medium">Our Team</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4 border border-white/20">
                <i class="fas fa-users text-cyan-accent text-[10px]"></i>
                <span>Medical & Support Team</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Meet <span class="text-cyan-accent">Our Team</span>
            </h1>

            <p class="text-sm md:text-base text-white/85 leading-relaxed mb-6 max-w-2xl">
                Our multidisciplinary team of associate neurologists, rehabilitation therapists, and coordinators work together under the direction of Dr. Praveen Gupta to deliver outstanding neurological care.
            </p>
        </div>
    </div>
</section>

<!-- Clinical Director / Leadership Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Leadership</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Clinical Director</h2>
        </div>

        <!-- Dr Praveen Gupta profile -->
        <?php if ($praveenGupta): ?>
        <div onclick="openPraveenModal()" class="max-w-4xl mx-auto bg-slate-50 border border-slate-200/50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 cursor-pointer hover:border-electric-blue/40">
            <div class="grid md:grid-cols-12 gap-8 items-center p-8">
                <div class="md:col-span-4 aspect-[4/5] rounded-2xl overflow-hidden relative shadow-md bg-gradient-to-br from-deep-indigo to-electric-blue p-0.5">
                    <div class="relative w-full h-full rounded-[0.9rem] overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent">
                        <img src="<?php echo htmlspecialchars($praveenGupta['image']); ?>" alt="Dr. Praveen Gupta" class="w-full h-full object-cover object-top">
                    </div>
                </div>
                <div class="md:col-span-8 space-y-4">
                    <span class="text-cyan-accent font-bold text-xs uppercase tracking-widest"><?php echo htmlspecialchars($praveenGupta['designation']); ?></span>
                    <h3 class="text-2xl font-bold text-deep-indigo font-serif"><?php echo htmlspecialchars($praveenGupta['name']); ?></h3>
                    <p class="text-xs text-dark-grey/70 leading-relaxed font-light">
                        <?php echo htmlspecialchars($praveenGupta['modal']['sections']['About'][0] ?? ''); ?>
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <button onclick="event.stopPropagation(); openPraveenModal();" class="text-xs font-semibold text-electric-blue hover:underline">Full Biography <i class="fas fa-arrow-right text-[10px] ml-1"></i></button>
                        <span class="text-slate-300">|</span>
                        <a href="why-choose-dr-praveen-gupta.php" onclick="event.stopPropagation();" class="text-xs font-semibold text-electric-blue hover:underline">Why Choose Dr. Praveen <i class="fas fa-arrow-right text-[10px] ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Specialty Team Grid -->
<section class="py-16 bg-slate-50 border-t border-b border-silver-grey/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-electric-blue font-bold text-xs uppercase tracking-wider">Associate Specialists</span>
            <h2 class="text-3xl font-bold text-deep-indigo font-serif mt-2">Specialty & Rehabilitation Team</h2>
            <p class="text-sm text-dark-grey/65 mt-3 leading-relaxed">
                Our specialists provide dedicated diagnostics, care, and recovery assistance.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($specialtyTeam as $index => $doc): ?>
            <!-- Team Member Card -->
            <div onclick="openDoctorModal(<?php echo $index; ?>)" class="bg-white border border-silver-grey/30 p-6 rounded-3xl hover:shadow-lg hover:border-electric-blue/30 transition-all duration-300 flex flex-col items-center text-center cursor-pointer group hover:-translate-y-1">
                <div class="w-32 h-32 rounded-full overflow-hidden mb-4 bg-gradient-to-br from-electric-blue to-cyan-accent p-0.5 shadow-md">
                    <img src="<?php echo htmlspecialchars($doc['image']); ?>" alt="<?php echo htmlspecialchars($doc['alt']); ?>" class="w-full h-full object-cover object-top rounded-full group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="font-bold text-deep-indigo text-base leading-tight"><?php echo htmlspecialchars($doc['name']); ?></h3>
                <p class="text-[11px] text-cyan-accent font-semibold mt-1.5 leading-relaxed"><?php echo htmlspecialchars($doc['specialty']); ?></p>
                <p class="text-xs text-dark-grey/65 mt-2 leading-relaxed line-clamp-3 font-light"><?php echo htmlspecialchars($doc['designation']); ?></p>
                <div class="text-xs text-electric-blue font-semibold mt-auto pt-4 group-hover:underline flex items-center">
                    <span>View Profile</span>
                    <i class="fas fa-arrow-right text-[9px] ml-1.5 transition-transform duration-300 group-hover:translate-x-0.5"></i>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Support Coordinators -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-electric-blue font-bold text-xs uppercase tracking-widest font-sans">Patient Coordination</span>
                <h2 class="text-3xl font-bold text-deep-indigo font-serif">Seamless Patient Experience Support</h2>
                <p class="text-sm text-dark-grey/70 leading-relaxed">
                    Our patient coordinators are dedicated to easing your journey, managing schedules, coordinating diagnostic tests, handling outstation or international cases, and providing emergency helpline coordination.
                </p>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <h4 class="font-bold text-deep-indigo text-sm flex items-center space-x-2">
                            <span class="w-2 h-2 bg-cyan-accent rounded-full"></span>
                            <span>Appointment Scheduling</span>
                        </h4>
                        <p class="text-xs text-dark-grey/65 leading-relaxed">Assists with booking slots for in-person, online, and emergency evaluations.</p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="font-bold text-deep-indigo text-sm flex items-center space-x-2">
                            <span class="w-2 h-2 bg-cyan-accent rounded-full"></span>
                            <span>Emergency Coordination</span>
                        </h4>
                        <p class="text-xs text-dark-grey/65 leading-relaxed">Helps dispatch stroke ambulance codes and coordinates with emergency ICU teams.</p>
                    </div>
                </div>
            </div>

            <!-- Right -->
            <div class="lg:col-span-5 bg-gradient-to-br from-deep-indigo to-indigo-950 text-white p-8 rounded-3xl space-y-6">
                <h3 class="text-xl font-bold font-serif">Contact Coordination</h3>
                <p class="text-xs text-white/80 leading-relaxed">
                    Have questions about consultation slots, documentation, or outstation visits? Get in touch with our team.
                </p>
                <div class="space-y-4 pt-2">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-cyan-accent">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-white/60 uppercase">Direct Helpline</p>
                            <a href="tel:<?php echo SITE_PHONE; ?>" class="text-sm font-bold hover:text-cyan-accent transition-colors"><?php echo SITE_PHONE; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Doctor Bio Modal Overlay -->
<div id="doctor-modal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <!-- Backdrop with premium blur -->
    <div id="doctor-modal-backdrop" class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm transition-opacity duration-300 opacity-0"></div>
    
    <!-- Modal Container -->
    <div id="doctor-modal-container" class="relative bg-white rounded-[32px] shadow-2xl max-w-4xl w-full max-h-[85vh] overflow-hidden flex flex-col md:flex-row transform scale-95 opacity-0 transition-all duration-300 z-10">
        <!-- Close Button -->
        <button onclick="closeDoctorModal()" class="absolute top-6 right-6 z-20 w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-all duration-200 shadow-sm focus:outline-none">
            <i class="fas fa-times text-base"></i>
        </button>

        <!-- Left Column: Summary Info -->
        <div class="w-full md:w-80 bg-gradient-to-b from-slate-50 to-slate-100/50 p-8 flex flex-col items-center border-b md:border-b-0 md:border-r border-slate-200/60 shrink-0">
            <div class="w-40 h-40 rounded-3xl overflow-hidden shadow-md bg-gradient-to-br from-deep-indigo to-electric-blue p-0.5 mb-6">
                <div class="relative w-full h-full rounded-[1.4rem] overflow-hidden bg-white">
                    <img id="modal-doc-image" src="" alt="" class="w-full h-full object-cover object-top">
                </div>
            </div>
            <h3 id="modal-doc-name" class="text-xl font-bold text-deep-indigo text-center font-serif leading-tight"></h3>
            <p id="modal-doc-specialty" class="text-xs text-electric-blue font-semibold uppercase tracking-wider text-center mt-2.5 px-2"></p>
            
            <div class="w-full border-t border-slate-200/80 my-6"></div>
            
            <!-- Dynamic Badges -->
            <div class="space-y-4 w-full">
                <div class="flex items-center space-x-3 bg-white p-3 rounded-2xl border border-slate-200/50 shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-electric-blue/10 flex items-center justify-center text-electric-blue shrink-0">
                        <i class="fas fa-briefcase text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-dark-grey/50 uppercase font-semibold">Experience</p>
                        <p id="modal-doc-experience" class="text-xs font-bold text-deep-indigo"></p>
                    </div>
                </div>
                
                <div id="modal-doc-role-container" class="flex items-center space-x-3 bg-white p-3 rounded-2xl border border-slate-200/50 shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-cyan-accent/10 flex items-center justify-center text-cyan-accent shrink-0">
                        <i class="fas fa-user-md text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-dark-grey/50 uppercase font-semibold">Role</p>
                        <p id="modal-doc-role" class="text-xs font-bold text-deep-indigo"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Scrollable Bio and Details -->
        <div class="flex-grow p-8 overflow-y-auto max-h-[50vh] md:max-h-[85vh]">
            <div class="space-y-6 pr-2" id="modal-doc-details">
                <!-- Javascript will inject sections dynamically -->
            </div>
        </div>
    </div>
</div>

<script>
    // Embed doctor data arrays
    const praveenGuptaData = <?php echo json_encode($praveenGupta); ?>;
    const specialtyTeamData = <?php echo json_encode($specialtyTeam); ?>;

    function openDoctorModalFromData(data) {
        if (!data) return;
        
        // Fill base fields
        document.getElementById('modal-doc-image').src = data.image || '';
        document.getElementById('modal-doc-image').alt = data.alt || data.name || '';
        document.getElementById('modal-doc-name').innerText = data.name || '';
        document.getElementById('modal-doc-specialty').innerText = data.specialty || '';
        document.getElementById('modal-doc-experience').innerText = data.experience || 'N/A';
        
        const roleContainer = document.getElementById('modal-doc-role-container');
        if (data.modal && data.modal.role) {
            document.getElementById('modal-doc-role').innerText = data.modal.role;
            roleContainer.classList.remove('hidden');
        } else {
            roleContainer.classList.add('hidden');
        }
        
        // Populate scrollable sections
        const detailsContainer = document.getElementById('modal-doc-details');
        detailsContainer.innerHTML = '';
        
        if (data.modal && data.modal.sections) {
            const sections = data.modal.sections;
            
            for (const [sectionTitle, items] of Object.entries(sections)) {
                if (!Array.isArray(items) || items.length === 0) continue;
                
                // Skip Designation header redundant with left panel or subtitle
                if (sectionTitle === 'Designation') continue;
                
                const sectionDiv = document.createElement('div');
                sectionDiv.className = 'space-y-3';
                
                let iconClass = 'fas fa-chevron-right';
                let listStyle = 'bullet'; // bullet, paragraphs, pills, achievements
                
                const titleLower = sectionTitle.toLowerCase();
                if (titleLower.includes('about')) {
                    iconClass = 'fas fa-user';
                    listStyle = 'paragraphs';
                } else if (titleLower.includes('qualification')) {
                    iconClass = 'fas fa-graduation-cap';
                    listStyle = 'bullet';
                } else if (titleLower.includes('expertise') || titleLower.includes('focus')) {
                    iconClass = 'fas fa-check-circle';
                    listStyle = 'pills';
                } else if (titleLower.includes('achievement') || titleLower.includes('award') || titleLower.includes('recognition')) {
                    iconClass = 'fas fa-trophy text-amber-500';
                    listStyle = 'achievements';
                } else if (titleLower.includes('research') || titleLower.includes('publication')) {
                    iconClass = 'fas fa-book-open';
                    listStyle = 'bullet';
                } else if (titleLower.includes('philanthropy') || titleLower.includes('innovation')) {
                    iconClass = 'fas fa-lightbulb';
                    listStyle = 'bullet';
                } else if (titleLower.includes('membership') || titleLower.includes('affiliation')) {
                    iconClass = 'fas fa-id-card';
                    listStyle = 'pills';
                } else if (titleLower.includes('experience')) {
                    iconClass = 'fas fa-history';
                    listStyle = 'bullet';
                }
                
                // Header
                const header = document.createElement('h4');
                header.className = 'text-sm font-bold text-deep-indigo uppercase tracking-wider flex items-center space-x-2 border-b border-slate-100 pb-2 mt-4';
                header.innerHTML = `<i class="${iconClass} text-electric-blue shrink-0"></i> <span>${sectionTitle}</span>`;
                sectionDiv.appendChild(header);
                
                // Render List
                if (listStyle === 'paragraphs') {
                    items.forEach(text => {
                        const p = document.createElement('p');
                        p.className = 'text-xs text-dark-grey/85 leading-relaxed font-light text-justify';
                        p.innerText = text;
                        sectionDiv.appendChild(p);
                    });
                } else if (listStyle === 'pills') {
                    const flexDiv = document.createElement('div');
                    flexDiv.className = 'flex flex-wrap gap-2 pt-1';
                    items.forEach(text => {
                        const pill = document.createElement('span');
                        pill.className = 'px-3 py-1.5 rounded-full bg-slate-50 border border-slate-200/60 text-[11px] text-deep-indigo font-semibold';
                        pill.innerText = text;
                        flexDiv.appendChild(pill);
                    });
                    sectionDiv.appendChild(flexDiv);
                } else if (listStyle === 'achievements') {
                    const ul = document.createElement('ul');
                    ul.className = 'space-y-2';
                    items.forEach(text => {
                        const li = document.createElement('li');
                        li.className = 'flex items-start space-x-3 text-xs text-dark-grey/85 leading-relaxed bg-amber-50/20 p-3 rounded-2xl border border-amber-100/30';
                        li.innerHTML = `<i class="fas fa-star text-[10px] text-amber-500 shrink-0 mt-1"></i> <span class="font-light">${text}</span>`;
                        ul.appendChild(li);
                    });
                    sectionDiv.appendChild(ul);
                } else {
                    const ul = document.createElement('ul');
                    ul.className = 'space-y-2';
                    items.forEach(text => {
                        const li = document.createElement('li');
                        li.className = 'flex items-start space-x-3 text-xs text-dark-grey/85 leading-relaxed';
                        li.innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-electric-blue shrink-0 mt-1.5"></span> <span class="font-light">${text}</span>`;
                        ul.appendChild(li);
                    });
                    sectionDiv.appendChild(ul);
                }
                
                detailsContainer.appendChild(sectionDiv);
            }
        }
        
        // Open
        const modal = document.getElementById('doctor-modal');
        const backdrop = document.getElementById('doctor-modal-backdrop');
        const container = document.getElementById('doctor-modal-container');
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            container.classList.remove('scale-95', 'opacity-0');
            container.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function openPraveenModal() {
        openDoctorModalFromData(praveenGuptaData);
    }

    function openDoctorModal(index) {
        if (specialtyTeamData && specialtyTeamData[index]) {
            openDoctorModalFromData(specialtyTeamData[index]);
        }
    }

    function closeDoctorModal() {
        const modal = document.getElementById('doctor-modal');
        const backdrop = document.getElementById('doctor-modal-backdrop');
        const container = document.getElementById('doctor-modal-container');
        
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        container.classList.remove('scale-100', 'opacity-100');
        container.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        const backdrop = document.getElementById('doctor-modal-backdrop');
        if (backdrop) backdrop.addEventListener('click', closeDoctorModal);
        
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                const modal = document.getElementById('doctor-modal');
                if (modal && !modal.classList.contains('hidden')) {
                    closeDoctorModal();
                }
            }
        });
    });
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
