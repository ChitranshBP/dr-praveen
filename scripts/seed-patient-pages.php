<?php
/**
 * One-time: patient-information, procedures, FAQ hub and legal pages onto the
 * ordered block flow with the copy that was hard-coded in the templates.
 *
 *   php scripts/seed-patient-pages.php --write
 */
$root = dirname(__DIR__);
$write = in_array('--write', $argv, true);
$blocksFile = $root . '/data/page-blocks.json';
$all = json_decode(file_get_contents($blocksFile), true);

$card = 'bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-4 hover:shadow-md transition-shadow';
$cardWhite = 'bg-white p-8 rounded-3xl border border-silver-grey/30 space-y-4 hover:shadow-md transition-shadow';
$iconBox = 'w-12 h-12 rounded-2xl flex items-center justify-center mb-0';

$pages = [];

$pages['emergency-neurology-care'] = [
    '_flow' => true,
    'signs' => [
        'type' => 'cards', 'label' => 'Emergency signs',
        'badge' => 'Emergency Signs', 'title' => 'When to Seek Immediate Emergency Neurology Care',
        'description' => 'If you or a loved one experiences any of the following symptoms, call our emergency hotline or go to the nearest emergency room immediately.',
        'items' => [
            ['icon' => 'fa-bolt', 'color' => 'red', 'title' => 'Acute Stroke Symptoms', 'text' => 'Sudden weakness or numbness in the face, arm, or leg (especially on one side of the body), difficulty speaking, slurred speech, or sudden vision loss.'],
            ['icon' => 'fa-wave-square', 'color' => 'red', 'title' => 'Status Epilepticus / Seizures', 'text' => 'Continuous seizures lasting more than 5 minutes, or multiple seizures in close succession without the person fully regaining consciousness in between.'],
            ['icon' => 'fa-tint', 'color' => 'red', 'title' => 'Thunderclap Headache', 'text' => 'A sudden, extremely severe headache that peaks within 60 seconds. Often described as the "worst headache of your life," possibly indicating brain hemorrhage.'],
            ['icon' => 'fa-user-injured', 'color' => 'red', 'title' => 'Head Trauma & Concussion', 'text' => 'Severe head injury accompanied by loss of consciousness, persistent confusion, repeated vomiting, unequal pupil sizes, or fluid leaking from the nose/ears.'],
            ['icon' => 'fa-wheelchair', 'color' => 'red', 'title' => 'Sudden Paralysis / Weakness', 'text' => 'Rapid onset of paralysis or loss of motor control in the legs or arms, which may indicate spinal cord compression, transverse myelitis, or Guillain-Barré syndrome.'],
            ['icon' => 'fa-dizzy', 'color' => 'red', 'title' => 'Altered Mental Status', 'text' => 'Sudden onset of severe confusion, delirium, hallucination, or unresponsiveness (stupor/coma), possibly due to brain infections (encephalitis/meningitis).'],
        ],
        'options' => ['header_margin' => 'mb-12', 'badge_class' => 'text-red-600 font-bold text-xs uppercase tracking-wider font-sans', 'grid' => 'grid sm:grid-cols-2 lg:grid-cols-3 gap-8', 'card_class' => $card, 'item_icon_class' => 'w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-xl', 'item_title_class' => 'text-lg font-bold text-deep-indigo', 'item_text_class' => 'text-xs text-dark-grey/65 leading-relaxed'],
        'wrap' => ['bg' => 'bg-white', 'padding' => 'py-16'],
    ],
    'protocols' => [
        'type' => 'split-panel', 'label' => 'Rapid Response Protocols + critical steps',
        'badge' => 'Our Action Code', 'title' => 'Rapid Response Protocols',
        'text' => 'Under the clinical leadership of Dr. Praveen Gupta, Marengo Asia Hospital runs structured neurological emergency response channels. Our stroke code and neuro-ICU procedures prioritize rapid triage, diagnosis, and treatment to minimize brain injury.',
        'bullets' => [
            'fa-clock|<strong class="text-deep-indigo">Door-to-Needle Time:</strong> Aiming to deliver thrombolytic (clot-dissolving) therapy within minutes of emergency arrival.',
            'fa-x-ray|<strong class="text-deep-indigo">24/7 Advanced Imaging:</strong> Immediate access to high-speed MRI and CT angiography to locate vessel blockages and bleeding.',
            'fa-procedures|<strong class="text-deep-indigo">Dedicated Neuro-ICU:</strong> Specialized intensive care unit equipped with intracranial pressure monitoring and specialized support systems.',
        ],
        'options' => ['accent' => 'red', 'badge_class' => 'text-red-600 font-bold text-xs uppercase tracking-wider', 'title_class' => 'text-3xl font-bold text-deep-indigo font-serif', 'left_span' => 6, 'aside_key' => 'critical-steps'],
        'wrap' => ['bg' => 'bg-slate-50', 'class' => 'border-t border-b border-silver-grey/40'],
    ],
    'critical-steps' => [
        'type' => 'checklist', 'label' => 'Critical steps card', 'nested' => true,
        'title' => 'Critical Steps in an Emergency',
        'items' => [
            ['icon' => 'none', 'title' => 'Call our emergency line immediately:', 'text' => 'Do not wait to see if the symptoms will go away.'],
            ['icon' => 'none', 'title' => 'Do not administer oral medication:', 'text' => 'Choking risks are high due to impaired swallowing reflexes.'],
            ['icon' => 'none', 'title' => 'Keep the airway clear:', 'text' => 'Lay the patient on their side if they are unconscious or semi-conscious.'],
        ],
        'options' => ['theme' => 'white', 'style' => 'steps'],
    ],
    'callback' => [
        'type' => 'form-card', 'label' => 'Call-back request form',
        'badge' => 'General Query or Callback', 'title' => 'Request a Call-Back',
        'description' => 'For non-life-threatening clinical inquiries, leave your details below and our triage coordinator will call you.',
        'button_text' => 'Request Call-Back',
        'options' => ['theme' => 'red', 'fields' => ['name', 'phone', 'inquiry'], 'form_type' => 'Emergency Callback Request'],
    ],
    'video-testimonials' => ['type' => 'video-testimonials', 'label' => 'Video Testimonials'],
    'related-videos' => ['type' => 'related-videos', 'label' => 'Related Videos'],
    'faq' => ['type' => 'faq', 'label' => 'FAQ Section'],
];

$pages['neurology-consultation'] = [
    '_flow' => true,
    'expect' => [
        'type' => 'split-panel', 'label' => 'What to Expect + How to Prepare card',
        'badge' => 'The Clinical Experience', 'title' => 'What to Expect During Your Appointment',
        'text' => 'A thorough neurological evaluation is essential for diagnosing conditions affecting the brain, spinal cord, nerves, and muscles. During your session, Dr. Praveen Gupta will guide you through a comprehensive checkup:',
        'items' => [
            ['icon' => 'fa-comments', 'color' => 'electric-blue', 'title' => 'Detailed Medical History', 'text' => 'We will discuss your symptoms in detail—when they started, their pattern, triggers, severity, and any past treatments or family history.'],
            ['icon' => 'fa-running', 'color' => 'electric-blue', 'title' => 'Neurological Examination', 'text' => 'A hands-on physical exam checking your reflexes, muscle strength, sensory perceptions, coordination, gait, balance, and cranial nerve functions (vision, hearing, facial movement).'],
            ['icon' => 'fa-notes-medical', 'color' => 'electric-blue', 'title' => 'Diagnostic & Treatment Plan', 'text' => 'If required, diagnostic tests (e.g., MRI, CT, EEG, EMG) will be recommended. We will formulate a tailored care and medical management plan immediately.'],
        ],
        'options' => ['point_style' => 'card', 'title_class' => 'text-3xl font-bold text-deep-indigo font-serif', 'aside_key' => 'prepare'],
    ],
    'prepare' => [
        'type' => 'checklist', 'label' => 'How to Prepare card', 'nested' => true,
        'title' => 'How to Prepare',
        'text' => 'Make the most of your consultation by taking a few steps to prepare before you arrive at our clinic:',
        'items' => [
            ['icon' => 'fa-file-medical', 'color' => 'cyan-accent', 'title' => 'Medical Documents:', 'text' => 'Bring all past reports, imaging films/CDs (MRI, CT scans), and blood test results.'],
            ['icon' => 'fa-pills', 'color' => 'cyan-accent', 'title' => 'Medication List:', 'text' => 'Bring current prescriptions or the actual packaging of all medicines you are currently taking.'],
            ['icon' => 'fa-pen', 'color' => 'cyan-accent', 'title' => 'Symptom Log:', 'text' => 'Jot down when your symptoms occur, how long they last, and what triggers or relieves them.'],
            ['icon' => 'fa-user-friends', 'color' => 'cyan-accent', 'title' => 'Bring a Companion:', 'text' => 'Family members can help recall details and listen to recommendations.'],
        ],
        'button_text' => 'Submit Request',
        'options' => ['theme' => 'light', 'form_label' => 'Quick Request', 'form_fields' => ['name', 'phone'], 'form_type' => 'Neurology Consultation Request'],
    ],
    'channels' => [
        'type' => 'cards', 'label' => 'Consultation options',
        'badge' => 'Appointment Modes', 'title' => 'Consultation Options',
        'description' => 'Choose the consulting channel that best matches your location, health status, and convenience.',
        'items' => [
            ['icon' => 'fa-building', 'color' => 'electric-blue', 'title' => 'In-Person Clinic Visit', 'text' => 'Consult directly at Marengo Asia Hospital. Best for initial assessments, evaluations requiring physical examination reflexes, and diagnostic testing.', 'note' => '<span class="text-xs font-semibold text-electric-blue"><i class="far fa-clock mr-1"></i> Mon - Sat: By Appointment</span>'],
            ['icon' => 'fa-video', 'color' => 'cyan-accent', 'title' => 'Online Tele-Consultation', 'text' => 'Connect via secure video consultation from the comfort of your home. Ideal for second opinions, routine follow-ups, and reviewing laboratory results.', 'note' => '<span class="text-xs font-semibold text-cyan-accent"><i class="fas fa-laptop-medical mr-1"></i> Global Video Access</span>'],
        ],
        'options' => ['header_margin' => 'mb-12', 'badge_class' => 'text-electric-blue font-bold text-xs uppercase tracking-wider', 'grid' => 'grid md:grid-cols-2 gap-8 max-w-4xl mx-auto', 'card_class' => $cardWhite, 'item_title_class' => 'text-lg font-bold text-deep-indigo', 'item_text_class' => 'text-xs text-dark-grey/65 leading-relaxed'],
        'wrap' => ['bg' => 'bg-slate-50', 'padding' => 'py-16', 'class' => 'border-t border-b border-silver-grey/40'],
    ],
    'faq' => ['type' => 'faq', 'label' => 'FAQ Section'],
    'video-testimonials' => ['type' => 'video-testimonials', 'label' => 'Video Testimonials'],
];

$pages['neurology-second-opinion'] = [
    '_flow' => true,
    'value' => [
        'type' => 'split-panel', 'label' => 'Why seek a review + records card',
        'badge' => 'Why Seek a Review?', 'title' => 'Ensure Diagnostic Accuracy & Explore Alternatives',
        'text' => 'Neurological conditions are complex and require high diagnostic precision. Seeking a second opinion is a common and vital step in ensuring you receive the correct treatment pathway:',
        'bullets' => [
            '<strong class="text-deep-indigo">Confirm Complex Diagnoses:</strong> Double-check diagnoses for conditions like multiple sclerosis, motor neuron diseases, or rare tremors.',
            '<strong class="text-deep-indigo">Evaluate Surgical Options:</strong> Discuss alternative medical management routes before committing to procedures like Deep Brain Stimulation (DBS) or epilepsy surgery.',
            '<strong class="text-deep-indigo">Optimise Recovery Pathways:</strong> Review stroke rehabilitation timelines, speech therapy modules, and cognitive training plans.',
        ],
        'options' => ['title_class' => 'text-3xl font-bold text-deep-indigo font-serif', 'aside_key' => 'records'],
    ],
    'records' => [
        'type' => 'checklist', 'label' => 'What We Need card', 'nested' => true,
        'title' => 'What We Need',
        'text' => 'To conduct a detailed medical and diagnostic review, please prepare the following records:',
        'items' => [
            ['icon' => 'fa-compact-disc', 'color' => 'cyan-accent', 'title' => 'Imaging Materials:', 'text' => 'Complete MRI, CT, PET scans, including both the printed reports and the original image files (on CD or digital upload).'],
            ['icon' => 'fa-file-invoice-dollar', 'color' => 'cyan-accent', 'title' => 'Test Results:', 'text' => 'EEG logs, EMG studies, nerve conduction recordings, and blood panel results.'],
            ['icon' => 'fa-scroll', 'color' => 'cyan-accent', 'title' => 'Medical History:', 'text' => 'Current prescription charts, past treatment logs, and notes from your prior consulting physicians.'],
        ],
        'options' => ['theme' => 'light'],
    ],
    'process' => [
        'type' => 'cards', 'label' => 'Review process',
        'badge' => 'Our Methodology', 'title' => 'The Opinion Review Process',
        'description' => 'How Dr. Praveen Gupta evaluates second opinion submissions.',
        'items' => [
            ['icon' => 'fa-glasses', 'color' => 'electric-blue', 'title' => 'Record Review', 'text' => 'A clinical review of all submitted reports, imaging films, medication charts, and symptoms logs to build a baseline profile.'],
            ['icon' => 'fa-stethoscope', 'color' => 'cyan-accent', 'title' => 'Clinical Re-Assessment', 'text' => 'An in-person or video evaluation session to verify reflexes, motor pathways, cognitive status, and explore secondary symptoms.'],
            ['icon' => 'fa-file-medical-alt', 'color' => 'deep-indigo', 'title' => 'Detailed Report', 'text' => 'Delivery of a formal second opinion report, outlining diagnostic confirmation, recommended next steps, and potential care modifications.'],
        ],
        'options' => ['header_margin' => 'mb-12', 'badge_class' => 'text-electric-blue font-bold text-xs uppercase tracking-wider', 'grid' => 'grid md:grid-cols-3 gap-8', 'card_class' => $cardWhite, 'item_title_class' => 'text-lg font-bold text-deep-indigo', 'item_text_class' => 'text-xs text-dark-grey/65 leading-relaxed'],
        'wrap' => ['bg' => 'bg-slate-50', 'padding' => 'py-16', 'class' => 'border-t border-b border-silver-grey/40'],
    ],
    'request' => [
        'type' => 'form-card', 'label' => 'Second opinion request form',
        'badge' => 'Submit Case Details', 'title' => 'Request Your Second Opinion',
        'description' => 'Fill in the quick details below. Our medical team will guide you on uploading records.',
        'button_text' => 'Submit Case Review Request',
        'options' => ['theme' => 'indigo', 'fields' => ['name', 'phone', 'diagnosis'], 'form_type' => 'Second Opinion Request'],
    ],
    'faq' => ['type' => 'faq', 'label' => 'FAQ Section'],
    'video-testimonials' => ['type' => 'video-testimonials', 'label' => 'Video Testimonials'],
];

$pages['online-neurologist-consultation'] = [
    '_flow' => true,
    'steps' => [
        'type' => 'cards', 'label' => 'How it works',
        'badge' => 'Process Flow', 'title' => 'How Online Consultation Works',
        'description' => 'A simple 4-step process designed to give you world-class neurological assessment online.',
        'items' => [
            ['icon' => 'fa-calendar-alt', 'color' => 'electric-blue', 'badge' => '01', 'title' => 'Book Slot', 'text' => 'Select your preferred date and time on our booking portal and complete the registration.'],
            ['icon' => 'fa-file-upload', 'color' => 'cyan-accent', 'badge' => '02', 'title' => 'Upload Records', 'text' => 'Securely upload past prescriptions, blood test results, and imaging studies (MRI/CT reports).'],
            ['icon' => 'fa-video', 'color' => 'deep-indigo', 'badge' => '03', 'title' => 'Video Consultation', 'text' => 'Connect with Dr. Praveen Gupta via a secure high-definition video link at your scheduled time.'],
            ['icon' => 'fa-file-prescription', 'color' => 'electric-blue', 'badge' => '04', 'title' => 'Get Prescription', 'text' => 'Receive your digital medical advice, diagnostic recommendations, and prescription copy.'],
        ],
        'options' => ['header_margin' => 'mb-12', 'badge_class' => 'text-electric-blue font-bold text-xs uppercase tracking-wider font-sans', 'grid' => 'grid md:grid-cols-4 gap-8', 'card_class' => 'bg-slate-50 border border-slate-200/50 p-6 rounded-3xl space-y-4 hover:shadow-md transition-shadow relative', 'item_icon_class' => 'w-10 h-10 bg-electric-blue/10 rounded-2xl flex items-center justify-center', 'item_icon_size' => 'text-base', 'item_title_class' => 'font-bold text-deep-indigo text-base pt-2', 'item_text_class' => 'text-xs text-dark-grey/65 leading-relaxed'],
        'wrap' => ['bg' => 'bg-white', 'padding' => 'py-16'],
    ],
    'suitability' => [
        'type' => 'split-panel', 'label' => 'Suitability + fast booking card',
        'badge' => 'Suitability', 'title' => 'Is Online Consultation Right for You?',
        'text' => 'While acute medical emergencies and tests require clinic visits, many patients benefit enormously from online consulting:',
        'bullets' => [
            '<strong class="text-deep-indigo">Outstation & Global Patients:</strong> Seek clinical advice from anywhere in the world without travel overhead.',
            '<strong class="text-deep-indigo">Routine Follow-ups:</strong> Ideal for reviewing treatment responses, discussing medication dosages, or reviewing lab tests.',
            '<strong class="text-deep-indigo">Diagnostic Review:</strong> Share records to receive an expert diagnostic opinion.',
        ],
        'options' => ['title_class' => 'text-3xl font-bold text-deep-indigo font-serif', 'aside_key' => 'booking'],
        'wrap' => ['bg' => 'bg-slate-50', 'class' => 'border-t border-b border-silver-grey/40'],
    ],
    'booking' => [
        'type' => 'checklist', 'label' => 'Fast Booking card', 'nested' => true,
        'title' => 'Fast Booking',
        'text' => 'Have your medical history and imaging scans ready before scheduling a slot. For urgent cases, please call the emergency desk directly.',
        'button_text' => 'Book Online Slot',
        'options' => ['theme' => 'dark', 'form_fields' => ['name', 'phone'], 'form_type' => 'Online Consultation Request'],
    ],
    'faq' => ['type' => 'faq', 'label' => 'FAQ Section'],
    'video-testimonials' => ['type' => 'video-testimonials', 'label' => 'Video Testimonials'],
];

$pages['patient-info'] = [
    '_flow' => true,
    'info' => [
        'type' => 'cards', 'label' => 'Patient information cards',
        'items' => [
            ['icon' => 'fa-clipboard-list', 'color' => 'electric-blue', 'title' => 'First Appointment Checklist', 'text' => 'To help Dr. Praveen Gupta understand your history clearly, please prepare the following for your consultation:', 'bullets' => ['All previous prescriptions & medications', 'Recent MRI, CT scans, and EEG reports', 'Discharge summaries (if hospitalized before)', 'List of current symptoms & when they started']],
            ['icon' => 'fa-calendar-alt', 'color' => 'cyan-accent', 'title' => 'OPD timings & Registration', 'text' => 'Marengo Asia Hospital (Gurgaon Sector 56) offers general and premium neurology OPD slots:', 'bullets' => ['Monday - Saturday|09:00 AM - 05:00 PM', 'Sunday|Closed'], 'note' => '*Please report to the OPD reception counter at least 15 minutes before your scheduled appointment slot to complete registration.'],
            ['icon' => 'fa-shield-alt', 'color' => 'deep-indigo', 'title' => 'Insurance & Cashless TPA', 'text' => 'We accept all major health insurance policies and cashless TPA partnerships:', 'tags' => ['Cigna TTK', 'Star Health', 'HDFC Ergo', 'Max Bupa', 'CGHS / ECHS', 'ICICI Lombard'], 'note' => '*For cashless approvals, visit the TPA Help Desk in the main lobby at least 24 hours prior to planned procedures.'],
        ],
        'options' => ['grid' => 'grid lg:grid-cols-3 gap-8', 'card_class' => 'bg-slate-50 border border-slate-200/50 p-8 rounded-3xl space-y-6 hover:shadow-xl transition-all duration-300', 'item_title_class' => 'text-xl font-bold text-dark-grey mb-2', 'item_text_class' => 'text-sm text-dark-grey/65 leading-relaxed', 'bullet_icon' => 'fas fa-check-circle'],
        'wrap' => ['bg' => 'bg-white', 'padding' => 'py-12'],
    ],
    'fast' => [
        'type' => 'alert-banner', 'label' => 'Emergency F.A.S.T. banner',
        'badge' => 'Emergency Stroke Info', 'title' => 'Suspecting a Brain Stroke? Act F.A.S.T.',
        'text' => 'Time is brain. In case of sudden loss of speech, facial dropping, weakness in arms, or balance issues, do not wait. Call our emergency helpline instantly.',
        'bullets' => ['F|Face Drooping', 'A|Arm Weakness', 'S|Speech Difficulty', 'T|Time to call Help'],
        'description' => '24/7 EMERGENCY HELPLINE',
        'button_text' => '{stroke-helpline}', 'button_url' => '{stroke-helpline}',
    ],
    'faq' => ['type' => 'faq', 'label' => 'FAQ Section'],
];

$pages['neurology-procedures'] = [
    '_flow' => true,
    'diagnostics' => [
        'type' => 'cards', 'label' => 'Diagnostic tests',
        'badge' => 'Diagnostic Excellence', 'title' => 'Advanced Diagnostic Testing',
        'description' => 'State-of-the-art neurological mapping to precisely evaluate brain, spinal cord, muscle, and nerve health.',
        'items' => [
            ['icon' => 'fa-wave-square', 'color' => 'electric-blue', 'title' => 'EEG & Video EEG Monitoring', 'text' => 'Electroencephalogram (EEG) records the electrical activity of the brain. Continuous Video EEG allows prolonged tracking to monitor, classify, and identify precise focus areas for epilepsy or seizure events.', 'note' => '<strong class="text-deep-indigo">Common Indications:</strong> Seizures, blackouts, unexplained fainting, memory confusion.'],
            ['icon' => 'fa-compress-alt', 'color' => 'cyan-accent', 'title' => 'EMG & Nerve Conduction Study (NCS)', 'text' => 'Nerve Conduction Studies track the speed and strength of signals passing through peripheral nerves. Electromyography (EMG) evaluates electrical muscle activity to detect damage or neuromuscular diseases.', 'note' => '<strong class="text-deep-indigo">Common Indications:</strong> Numbness, limb pain, muscle weakness, neuropathy, carpal tunnel syndrome.'],
            ['icon' => 'fa-wifi', 'color' => 'deep-indigo', 'title' => 'Evoked Potentials (VEP, SSEP, BERA)', 'text' => 'These non-invasive tests measure electrical signals in the brain in response to sight, sound, or touch stimulation. They evaluate sensory nerve pathways across the central nervous system.', 'note' => '<strong class="text-deep-indigo">Common Indications:</strong> Multiple sclerosis screening, optic nerve injuries, hearing loss pathways.'],
            ['icon' => 'fa-bed', 'color' => 'electric-blue', 'title' => 'Sleep Study (Polysomnography)', 'text' => 'An overnight recording of sleep patterns, brain activity, blood oxygen levels, heart rate, and breathing. Used to diagnose complex sleep disorders.', 'note' => '<strong class="text-deep-indigo">Common Indications:</strong> Sleep apnea, severe insomnia, narcolepsy, restless leg syndrome.'],
        ],
        'options' => ['header_margin' => 'mb-12', 'badge_class' => 'text-electric-blue font-bold text-xs uppercase tracking-wider font-sans', 'grid' => 'grid md:grid-cols-2 gap-8', 'card_class' => $card, 'item_icon_size' => 'text-lg', 'item_title_class' => 'text-lg font-bold text-deep-indigo', 'item_text_class' => 'text-xs text-dark-grey/65 leading-relaxed'],
        'wrap' => ['id' => 'diagnostics', 'bg' => 'bg-white', 'padding' => 'py-16'],
    ],
    'therapeutics' => [
        'type' => 'cards', 'label' => 'Therapeutic procedures',
        'badge' => 'Therapeutic Innovations', 'title' => 'Specialized Treatments & Interventions',
        'description' => 'Advanced surgical and non-surgical procedures targeting root causes of complex neurological conditions.',
        'items' => [
            ['icon' => 'fa-brain', 'color' => 'electric-blue', 'title' => 'Deep Brain Stimulation (DBS)', 'text' => "Clinical management of implantable stimulators targeting deep brain structures. Offers significant symptomatic control for Parkinson's disease and dystonia when medications are no longer fully effective."],
            ['icon' => 'fa-syringe', 'color' => 'cyan-accent', 'title' => 'Therapeutic Botox Injections', 'text' => 'Highly targeted injections of botulinum toxin to relieve chronic migraines, treat muscle spasticity following strokes, and manage hemifacial spasms or blepharospasm.'],
            ['icon' => 'fa-clock', 'color' => 'deep-indigo', 'title' => 'Stroke Thrombolysis & Thrombectomy', 'text' => 'Emergency administration of clot-dissolving tissue plasminogen activator (tPA) or referral for endovascular mechanical clot extraction (thrombectomy) to restore brain blood flow.'],
        ],
        'options' => ['header_margin' => 'mb-12', 'badge_class' => 'text-cyan-accent font-bold text-xs uppercase tracking-wider font-sans', 'grid' => 'grid md:grid-cols-3 gap-8', 'card_class' => $cardWhite, 'item_title_class' => 'text-lg font-bold text-deep-indigo', 'item_text_class' => 'text-xs text-dark-grey/65 leading-relaxed'],
        'wrap' => ['bg' => 'bg-slate-50', 'padding' => 'py-16', 'class' => 'border-t border-b border-silver-grey/40'],
    ],
    'video-testimonials' => ['type' => 'video-testimonials', 'label' => 'Video Testimonials'],
];

$pages['neurology-faqs'] = [
    '_flow' => true,
    'faq' => ['type' => 'faq', 'label' => 'FAQ Section'],
    'cta' => ['type' => 'cta-simple', 'label' => 'Call to action', 'title' => 'Still Have Questions?', 'description' => 'Our medical coordination help desk is available to answer any clinical or procedural queries.', 'button_text' => 'Contact Us', 'button_url' => 'contact-us-top-neurologist-delhi-ncr'],
];

$h2 = 'text-2xl font-bold text-deep-indigo font-serif';
$pages['privacy-policy'] = [
    '_flow' => true,
    'body' => ['type' => 'richtext', 'label' => 'Policy text', 'text' => <<<HTML
<div class="space-y-3">
<h2 class="$h2">1. Introduction</h2>
<p>Welcome to the official portal of {site}. Your privacy and the confidentiality of your personal and medical information are of paramount importance to us. This Privacy Policy details how we handle the information collected from visitors and patients who use this website.</p>
</div>
<div class="space-y-3">
<h2 class="$h2">2. Information We Collect</h2>
<p>We collect information from you when you submit a consultation request, book an appointment, request a second opinion, or upload medical records. The types of personal data we may collect include:</p>
<ul class="list-disc pl-5 space-y-1">
<li>Contact details such as name, email address, and phone number.</li>
<li>Clinical history, diagnosis logs, and uploaded medical reports/scans.</li>
<li>Technical data such as IP address and browsing behavior collected via standard cookies.</li>
</ul>
</div>
<div class="space-y-3">
<h2 class="$h2">3. How We Use Your Information</h2>
<p>The collected information is used solely to facilitate healthcare services, including:</p>
<ul class="list-disc pl-5 space-y-1">
<li>Scheduling and managing clinic appointments or online video consultations.</li>
<li>Reviewing medical records to provide accurate diagnostic second opinions.</li>
<li>Routing inquiry submissions to our secure clinic management systems.</li>
</ul>
</div>
<div class="space-y-3">
<h2 class="$h2">4. Data Security &amp; Storage</h2>
<p>We implement standard physical, electronic, and administrative safeguards to protect your personal and medical data against unauthorized access, loss, or modification. Medical uploads are transferred securely and stored within secure systems. However, please be aware that no data transmission over the Internet is completely risk-free.</p>
</div>
<div class="space-y-3">
<h2 class="$h2">5. Sharing of Data</h2>
<p>We do not sell, trade, or transfer patient data to external marketing companies. Your information is only shared with authorized medical staff, clinical coordinators, and hospital team members involved in administering your treatment plan.</p>
</div>
<div class="space-y-3">
<h2 class="$h2">6. Patient Rights</h2>
<p>You have the right to request access to the personal data we hold about you, request corrections to incomplete information, or request the deletion of non-medical records (subject to local legal requirements regarding medical records retention).</p>
</div>
<div class="space-y-3">
<h2 class="$h2">7. Contact Details</h2>
<p>For questions regarding this policy or to request data removal, please contact us at <a href="mailto:{email}" class="text-electric-blue hover:underline">{email}</a> or call the OPD helpline.</p>
</div>
HTML
    ],
];

$pages['terms-of-service'] = [
    '_flow' => true,
    'body' => ['type' => 'richtext', 'label' => 'Terms text', 'text' => <<<HTML
<div class="space-y-3">
<h2 class="$h2">1. Acceptance of Terms</h2>
<p>By accessing and using this website, you agree to comply with and be bound by the following Terms of Service and clinical disclaimers. If you do not agree to these terms, please do not use this portal or submit online inquiries.</p>
</div>
<div class="space-y-3">
<h2 class="$h2">2. Medical Disclaimer (Not for Emergencies)</h2>
<div class="bg-red-50 border-l-4 border-red-500 p-4 text-xs text-red-900 rounded-r-xl">
<p class="font-bold uppercase tracking-wider mb-1"><i class="fas fa-exclamation-triangle mr-1"></i> Medical Emergency Warning</p>
<p>The contents of this website, including clinical articles, case files, video explanations, and second-opinion responses, are for educational/information purposes only. <strong>This website does not provide emergency medical diagnosis or treatment.</strong></p>
<p class="mt-2">If you or a family member are experiencing sudden stroke symptoms (loss of balance, face drooping, arm weakness, speech difficulty), please call our 24/7 Stroke Helpline at <a href="tel:{stroke-helpline}" class="font-bold underline">{stroke-helpline}</a> or visit the nearest emergency department immediately.</p>
</div>
</div>
<div class="space-y-3">
<h2 class="$h2">3. Online Consultations</h2>
<p>Video consultations booked via this site serve as virtual advisory sessions. A complete diagnosis may require physical examinations, lab evaluations, or imaging checks at our clinic location. Any prescription issued during video sessions is subject to the doctor's clinical judgement and local regulations.</p>
</div>
<div class="space-y-3">
<h2 class="$h2">4. Submission of Clinical Records</h2>
<p>When submitting form messages or uploading file records (PDF, Word, or images), you warrant that you are authorized to share these files and that the information is accurate. Uploads of illegal or malicious files are strictly prohibited and will result in IP blocking.</p>
</div>
<div class="space-y-3">
<h2 class="$h2">5. Intellectual Property</h2>
<p>The layout, design details, medical articles, logos, graphics, and clinical videos on this site are protected by copyright. Unauthorized replication, redistribution, or commercial copying of materials from this portal without written consent is prohibited.</p>
</div>
<div class="space-y-3">
<h2 class="$h2">6. Limitation of Liability</h2>
<p>While we take reasonable care to keep the medical guidelines on this website accurate and updated, {site} and the administrative team make no guarantees about the completeness or absolute accuracy of information published, and shall not be held liable for any damages arising out of the use of this website.</p>
</div>
<div class="space-y-3">
<h2 class="$h2">7. Revisions to Terms</h2>
<p>We reserve the right to revise these Terms of Service at any time without prior notice. Any modifications will be active immediately upon publishing to this page.</p>
</div>
HTML
    ],
];

$pageMeta = [
    'emergency-neurology-care' => ['breadcrumb_label' => 'Emergency Care', 'hero_icon' => 'fa-exclamation-circle text-red-400 animate-pulse'],
    'neurology-consultation' => ['breadcrumb_label' => 'Neurology Consultation', 'hero_icon' => 'fa-hand-holding-medical'],
    'neurology-second-opinion' => ['breadcrumb_label' => 'Second Opinion', 'hero_icon' => 'fa-search-plus'],
    'online-neurologist-consultation' => ['breadcrumb_label' => 'Online Consultation', 'hero_icon' => 'fa-video'],
    'patient-info' => ['breadcrumb_label' => 'Patient Information', 'hero_icon' => 'fa-info-circle text-white'],
    'neurology-procedures' => ['breadcrumb_label' => 'Neurology Procedures', 'hero_icon' => 'fa-microscope'],
    'neurology-faqs' => ['breadcrumb_label' => 'FAQs Hub', 'hero_icon' => 'fa-question'],
    'privacy-policy' => ['breadcrumb_label' => 'Privacy Policy'],
    'terms-of-service' => ['breadcrumb_label' => 'Terms of Service'],
];
// Catalog placeholder copy that these templates used to ignore → replace with the live wording.
$placeholderFix = [
    'neurology-procedures' => ['hero_badge' => ['General Guide', 'Advanced Diagnostics & Therapeutics'], 'hero_title' => ['Neurology Procedures', 'Neurology <span class="text-cyan-accent">Procedures</span>']],
    'privacy-policy' => ['hero_badge' => ['Contact & Legal Guide', ''], 'hero_bg' => ['assets/breadcrumbs/about.png', '']],
    'terms-of-service' => ['hero_badge' => ['Contact & Legal Guide', ''], 'hero_bg' => ['assets/breadcrumbs/about.png', '']],
];
$heroCtas = [
    'emergency-neurology-care' => ['hero-primary' => ['text' => 'Call Helpline: {stroke-helpline}', 'url' => '{stroke-helpline}'], 'hero-secondary' => ['text' => '', 'url' => '']],
    'neurology-consultation' => ['hero-primary' => ['text' => 'Schedule Consultation', 'url' => 'contact-us-top-neurologist-delhi-ncr'], 'hero-secondary' => ['text' => '', 'url' => '']],
    'neurology-second-opinion' => ['hero-primary' => ['text' => 'Request Second Opinion', 'url' => 'contact-us-top-neurologist-delhi-ncr'], 'hero-secondary' => ['text' => '', 'url' => '']],
    'online-neurologist-consultation' => ['hero-primary' => ['text' => 'Book Teleconsultation', 'url' => 'contact-us-top-neurologist-delhi-ncr'], 'hero-secondary' => ['text' => '', 'url' => '']],
    'neurology-procedures' => ['hero-primary' => ['text' => 'Explore Procedures', 'url' => '#diagnostics'], 'hero-secondary' => ['text' => '', 'url' => '']],
    'patient-info' => ['hero-primary' => ['text' => '', 'url' => ''], 'hero-secondary' => ['text' => '', 'url' => '']],
    'neurology-faqs' => ['hero-primary' => ['text' => '', 'url' => ''], 'hero-secondary' => ['text' => '', 'url' => '']],
    'privacy-policy' => ['hero-primary' => ['text' => '', 'url' => ''], 'hero-secondary' => ['text' => '', 'url' => '']],
    'terms-of-service' => ['hero-primary' => ['text' => '', 'url' => ''], 'hero-secondary' => ['text' => '', 'url' => '']],
];

foreach ($pages as $slug => $def) {
    echo $slug . ': ' . implode(' → ', array_keys(array_filter($def, function ($v, $k) { return $k[0] !== '_'; }, ARRAY_FILTER_USE_BOTH))) . "\n";
}
if (!$write) { echo "(dry run)\n"; exit; }

foreach ($pages as $slug => $def) $all[$slug] = $def;
file_put_contents($blocksFile, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");

foreach ($pageMeta as $slug => $meta) {
    $file = $root . '/data/pages/' . $slug . '.json';
    $page = is_file($file) ? (json_decode(file_get_contents($file), true) ?: []) : ['slug' => $slug];
    foreach ($meta as $k => $v) {
        if (trim((string)($page[$k] ?? '')) === '' && $v !== '') $page[$k] = $v;
    }
    foreach ($placeholderFix[$slug] ?? [] as $k => [$placeholder, $replacement]) {
        if (trim(strip_tags((string)($page[$k] ?? ''))) === $placeholder) $page[$k] = $replacement;
    }
    file_put_contents($file, json_encode($page, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
}

$ctasFile = $root . '/data/page-ctas.json';
$ctas = json_decode(file_get_contents($ctasFile), true);
foreach ($heroCtas as $slug => $keys) {
    foreach ($keys as $k => $v) {
        if (!isset($ctas['pages'][$slug][$k])) $ctas['pages'][$slug][$k] = $v;
    }
}
file_put_contents($ctasFile, json_encode($ctas, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
echo "written\n";
