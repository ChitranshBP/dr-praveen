<?php
/**
 * Contact Us Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <!-- Background image -->
    <img src="assets/breadcrumbs/contact.png" alt=""
         fetchpriority="high"
         class="absolute inset-0 w-full h-full object-cover object-[78%_center] md:object-right pointer-events-none select-none">

    <!-- Legibility overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-deep-indigo/95 via-deep-indigo/75 to-deep-indigo/35 md:to-transparent"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Contact Us</span>
            </nav>

            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                <i class="fas fa-location-dot text-[10px]"></i>
                <span>Gurgaon & Delhi NCR Locations</span>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                Get in <span class="text-white">Touch</span> with Us
            </h1>

            <p class="text-sm md:text-base text-white/80 leading-relaxed mb-6 max-w-2xl">
                Have questions or want to schedule an appointment? Reach out to Dr. Praveen Gupta's clinical team. We are here to support your neurological health journey.
            </p>
        </div>
    </div>
</section>

<!-- Contact Info & Form -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12">
            <!-- Left Side: Contact Information (5 columns) -->
            <div class="lg:col-span-5 space-y-8 observe">
                <div>
                    <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Contact Details</span>
                    <h2 class="text-3xl font-bold text-dark-grey mt-2 mb-4">How to Reach Us</h2>
                    <p class="text-dark-grey/70 text-sm leading-relaxed">
                        For emergencies, please call our 24/7 helpline immediately. For regular consultations, please fill out the form or use our direct clinic lines.
                    </p>
                </div>

                <!-- Info Cards -->
                <div class="space-y-4">
                    <!-- Phone -->
                    <div class="flex items-start space-x-4 p-5 bg-[#edf5f9] rounded-2xl border border-slate-200/40">
                        <div class="w-11 h-11 bg-electric-blue/10 rounded-xl flex items-center justify-center text-electric-blue flex-shrink-0">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark-grey text-base">Call Us</h4>
                            <p class="text-sm text-dark-grey/65 mt-0.5"><?php echo SITE_PHONE; ?></p>
                            <p class="text-xs text-dark-grey/50">Mon - Sat: 9:00 AM - 7:00 PM</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start space-x-4 p-5 bg-[#edf5f9] rounded-2xl border border-slate-200/40">
                        <div class="w-11 h-11 bg-cyan-accent/10 rounded-xl flex items-center justify-center text-cyan-accent flex-shrink-0">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark-grey text-base">Email Us</h4>
                            <p class="text-sm text-dark-grey/65 mt-0.5"><?php echo SITE_EMAIL; ?></p>
                            <p class="text-xs text-dark-grey/50">We reply within 24 business hours</p>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="flex items-start space-x-4 p-5 bg-[#edf5f9] rounded-2xl border border-slate-200/40">
                        <div class="w-11 h-11 bg-deep-indigo/10 rounded-xl flex items-center justify-center text-deep-indigo flex-shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark-grey text-base">OPD Clinic Location</h4>
                            <p class="text-xs text-dark-grey/65 mt-0.5">
                                <?php echo SITE_ADDRESS; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Interactive Form (7 columns) -->
            <div class="lg:col-span-7 bg-slate-50/50 rounded-3xl p-6 md:p-10 border border-slate-200/60 observe">
                <h3 class="text-2xl font-bold text-dark-grey mb-2">Send Us a Message</h3>
                <p class="text-sm text-dark-grey/60 mb-8">Fill out the form below, and our coordinator will connect with you shortly.</p>

                <form id="contact-form" class="space-y-6" accept-charset="UTF-8" action="https://app.formester.com/forms/MUVNkRKYA/submissions" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="form_type" value="Main Contact Form">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-xs font-semibold text-dark-grey mb-2">FULL NAME</label>
                            <input type="text" id="name" name="name" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey" placeholder="John Doe">
                        </div>
                        <div>
                            <label for="phone" class="block text-xs font-semibold text-dark-grey mb-2">PHONE NUMBER</label>
                            <input type="tel" id="phone" name="phone" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey" placeholder="+91 98765 43210">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-xs font-semibold text-dark-grey mb-2">EMAIL ADDRESS</label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey" placeholder="john@example.com">
                        </div>
                        <div>
                            <label for="subject" class="block text-xs font-semibold text-dark-grey mb-2">SELECT SUBJECT</label>
                            <select id="subject" name="subject" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey">
                                <option value="Appointment">Schedule Appointment</option>
                                <option value="Second Opinion">Second Opinion Consultation</option>
                                <option value="General Query">General Inquiry</option>
                                <option value="Feedback">Feedback / Testimonials</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-semibold text-dark-grey mb-2">YOUR MESSAGE</label>
                        <textarea id="message" name="message" rows="4" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-electric-blue text-sm text-dark-grey" placeholder="Tell us how we can help you..."></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-dark-grey mb-2">UPLOAD MEDICAL REPORTS (OPTIONAL)</label>
                        <div class="relative flex items-center justify-center border-2 border-dashed border-slate-200 rounded-xl p-6 bg-white hover:bg-slate-50 transition-colors cursor-pointer group">
                            <input type="file" id="report" name="report" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                            <div class="text-center">
                                <i class="fas fa-cloud-upload-alt text-2xl text-slate-400 group-hover:text-electric-blue transition-colors mb-2"></i>
                                <p class="text-xs text-dark-grey/70"><span class="text-electric-blue font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-[10px] text-dark-grey/40 mt-1">PDF, DOC, DOCX, JPG, PNG (Max 5MB)</p>
                            </div>
                        </div>
                        <!-- File name preview placeholder -->
                        <div id="file-name-preview" class="hidden mt-2 p-2.5 bg-electric-blue/5 rounded-xl border border-electric-blue/10 flex items-center justify-between text-xs text-electric-blue font-medium animate-fade-in">
                            <div class="flex items-center space-x-2 truncate">
                                <i class="far fa-file text-base"></i>
                                <span class="truncate" id="file-name-text">filename.pdf</span>
                            </div>
                            <button type="button" id="remove-file-btn" class="text-red-500 hover:text-red-700 transition-colors pl-2">
                                <i class="fas fa-times-circle text-base"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold py-3.5 rounded-xl hover:shadow-xl hover:shadow-electric-blue/30 transition-all duration-300">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane text-xs"></i>
                    </button>
                </form>

                <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const fileInput = document.getElementById('report');
                    const previewContainer = document.getElementById('file-name-preview');
                    const fileNameText = document.getElementById('file-name-text');
                    const removeFileBtn = document.getElementById('remove-file-btn');
                    const fileIcon = previewContainer.querySelector('i');

                    fileInput.addEventListener('change', function () {
                        if (fileInput.files.length > 0) {
                            const file = fileInput.files[0];
                            fileNameText.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                            
                            // Set appropriate file icon
                            const ext = file.name.split('.').pop().toLowerCase();
                            if (ext === 'pdf') {
                                fileIcon.className = 'far fa-file-pdf text-base text-red-500';
                            } else if (['jpg', 'jpeg', 'png'].includes(ext)) {
                                fileIcon.className = 'far fa-file-image text-base text-emerald-500';
                            } else if (['doc', 'docx'].includes(ext)) {
                                fileIcon.className = 'far fa-file-word text-base text-blue-500';
                            } else {
                                fileIcon.className = 'far fa-file text-base text-slate-500';
                            }

                            previewContainer.classList.remove('hidden');
                        } else {
                            previewContainer.classList.add('hidden');
                        }
                    });

                    removeFileBtn.addEventListener('click', function () {
                        fileInput.value = ''; // Reset file input
                        previewContainer.classList.add('hidden');
                    });
                });
                </script>
            </div>
        </div>
    </div>
</section>

<!-- Maps Section -->
<section class="py-12 bg-[#edf5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">Hospital Location</span>
            <h2 class="text-3xl font-bold text-dark-grey mt-2">Find Us on the Map</h2>
        </div>

        <div class="bg-white rounded-[32px] overflow-hidden shadow-lg border border-slate-200/50 aspect-video md:aspect-[21/9] w-full">
            <iframe class="w-full h-full border-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3509.0274423192873!2d77.09722769999999!3d28.4184288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d18db30f58d29%3A0x34e8f9f94a91b569!2sDr.%20Praveen%20Gupta!5e0!3m2!1sen!2sin!4v1786967899128!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-5 lg:sticky lg:top-24 self-start">
                <span class="text-electric-blue font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-3xl font-bold text-dark-grey mt-2 mb-4">Frequently Asked Questions</h2>
                <p class="text-dark-grey/70 text-sm leading-relaxed max-w-md">
                    Answers to common queries regarding appointment scheduling, consultations, and second opinions.
                </p>
            </div>

            <div class="lg:col-span-7">
                <div class="space-y-4" id="faq-container">
                    <!-- FAQ 1 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">What are Dr. Praveen Gupta's OPD consultation hours?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                Dr. Praveen Gupta consults at Marengo Asia Hospitals, Gurgaon, from Monday to Saturday, between 9:00 AM and 5:00 PM. Prior booking is highly recommended to minimize wait times.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item bg-white rounded-2xl overflow-hidden border border-slate-200/80 transition-all duration-300">
                        <button class="faq-toggle w-full flex justify-between items-center p-6 text-left focus:outline-none" onclick="toggleFaq(this)">
                            <span class="font-semibold text-dark-grey pr-4 transition-colors duration-300">How can I book a second opinion for a complex neurological case?</span>
                            <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                                <i class="fas fa-plus text-dark-grey/50 text-xs transition-transform duration-300"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-grey/70 leading-relaxed text-sm">
                                You can schedule a second opinion by filling out our online form and selecting "Second Opinion" as the subject. Please upload or bring all previous scans (MRI/CT), medical prescriptions, and discharge summaries for an accurate clinical review.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Toggle Script -->
<script>
function toggleFaq(button) {
    const item = button.closest('.faq-item');
    const content = button.nextElementSibling;
    const icon = button.querySelector('i');
    const isOpen = !content.classList.contains('hidden');

    document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
    document.querySelectorAll('.faq-item').forEach(i => {
        i.classList.remove('bg-[#edf5f9]');
        i.classList.add('bg-white');
    });
    document.querySelectorAll('.faq-toggle i').forEach(i => {
        i.classList.remove('fa-minus');
        i.classList.add('fa-plus');
        i.style.transform = 'rotate(0deg)';
    });

    if (!isOpen) {
        content.classList.remove('hidden');
        item.classList.remove('bg-white');
        item.classList.add('bg-[#edf5f9]');
        icon.classList.remove('fa-plus');
        icon.classList.add('fa-minus');
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
