<?php
/**
 * Contact Us Page - Dr. Praveen Gupta
 */
$isDarkHero = true;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-deep-indigo via-electric-blue to-cyan-accent text-white pt-28 md:pt-32 pb-8 md:pb-10 -mt-20">
    <div class="absolute inset-0 bg-black/5"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl text-left animate-fade-in-up">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-3">
                <a href="index.php" class="hover:text-white transition-colors">Home</a>
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
                            <p class="text-sm text-dark-grey/65 mt-0.5">
                                Marengo Asia Hospitals, Sector 56, Gurgaon, Haryana 122011
                            </p>
                            <p class="text-xs text-dark-grey/50">Golf Course Extension Road</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Interactive Form (7 columns) -->
            <div class="lg:col-span-7 bg-slate-50/50 rounded-3xl p-6 md:p-10 border border-slate-200/60 observe">
                <h3 class="text-2xl font-bold text-dark-grey mb-2">Send Us a Message</h3>
                <p class="text-sm text-dark-grey/60 mb-8">Fill out the form below, and our coordinator will connect with you shortly.</p>

                <form id="contact-form" class="space-y-6">
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

                    <button type="submit" class="w-full inline-flex items-center justify-center space-x-2.5 bg-gradient-to-r from-electric-blue to-cyan-accent text-white font-semibold py-3.5 rounded-xl hover:shadow-xl hover:shadow-electric-blue/30 transition-all duration-300">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane text-xs"></i>
                    </button>
                </form>
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
            <iframe class="w-full h-full border-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3509.3087340058863!2d77.09848527622998!3d28.431057493475225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1m3!1d1152!2d77.10106019999999!3d28.4310575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1719245000000!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
