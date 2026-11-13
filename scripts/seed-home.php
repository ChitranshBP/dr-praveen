<?php
/**
 * One-time: seed the homepage sections into data/page-blocks.json (slug "index")
 * with the exact copy currently hard-coded in index.php, then the template is
 * reduced to header + cms_render_page_flow('index') + footer.
 *
 *   php scripts/seed-home.php --write
 */
$root = dirname(__DIR__);
$write = in_array('--write', $argv, true);
$file = $root . '/data/page-blocks.json';
$all = json_decode(file_get_contents($file), true);

$home = [
    '_flow' => true,
    'hero' => [
        'type' => 'banner-slider', 'label' => 'Hero banner slider',
        'title' => 'Dr. Praveen Gupta Best Neurologist in India | Transforming Brain & Spine Care with Precision',
    ],
    'services' => [
        'type' => 'services-grid', 'label' => 'Services',
        'badge' => 'How We Can Help', 'badge_icon' => 'fa-stethoscope',
        'title' => 'Comprehensive Care for Every <span class="gradient-text">Brain & Spine</span> Condition',
        'description' => 'Expert diagnosis, advanced treatment, and personalized recovery—all under one roof.',
        'options' => ['title_html' => true],
        'wrap' => ['bg' => 'bg-soft-cyan/30'],
    ],
    'slideshow' => [
        'type' => 'slideshow', 'label' => 'Banner slideshow',
        'items' => [
            ['image' => 'assets/full-image/Dr-Praveen-Banner-1.webp', 'image_alt' => 'Dr. Praveen Gupta Slide 1'],
            ['image' => 'assets/full-image/Dr-Praveen-Banner-2.webp', 'image_alt' => 'Dr. Praveen Gupta Slide 2'],
            ['image' => 'assets/full-image/Dr-Praveen-Banner-6.webp', 'image_alt' => 'Dr. Praveen Gupta Slide 3'],
        ],
        'wrap' => ['bg' => 'bg-white'],
    ],
    'stats' => [
        'type' => 'stats', 'label' => 'Statistics', 'variant' => 'home',
        'items' => [
            ['icon' => 'fas fa-user-group', 'title' => '{stats_patients}', 'subtitle' => 'Patients Treated', 'text' => 'We take pride in the trust of over {stats_patients} patients whose health and recovery remain our top priorities.'],
            ['icon' => 'fas fa-face-smile', 'title' => '{stats_success}', 'subtitle' => 'Success Stories', 'text' => 'Documenting over 100,000 patient success stories driven by advanced neuro-clinical treatments.'],
            ['icon' => 'fas fa-award', 'title' => '{stats_awards}', 'subtitle' => 'Global Awards', 'text' => 'Recognized globally with prestigious awards for pioneering achievements in neurosciences.'],
            ['icon' => 'fas fa-user-doctor', 'title' => '{stats_experience}', 'subtitle' => 'Years of Experience', 'text' => 'Providing over two decades of expert clinical diagnosis, treatment, and neurological care.'],
        ],
        'wrap' => ['bg' => 'bg-soft-cyan/30'],
    ],
    'about' => [
        'type' => 'text-media', 'label' => 'About Dr. Praveen',
        'badge' => 'About Dr. Praveen Gupta', 'badge_icon' => 'fa-user-md',
        'title' => 'Dr. Praveen Gupta  <span class="gradient-text">Best Neurologist</span> in India',
        'image' => 'assets/dpg-1.webp', 'image_alt' => 'Dr. Praveen Gupta, Neurologist',
        'items' => [
            ['icon' => 'fa-solid fa-award', 'text' => 'Chairman  Marengo Asia International Institute of Neuro and Spine'],
            ['icon' => 'fa-solid fa-chart-line', 'text' => 'Chief Clinical Strategy Growth and Innovation, North India'],
            ['icon' => 'fa-solid fa-lightbulb', 'text' => 'Chief Mentor for Start-ups'],
        ],
        'text' => "Neurology is one of the most complex medical fields, requiring precision, innovation, and compassionate care. At the heart of this field stands Dr. Praveen Gupta, a name synonymous with excellence and trust in neurology across India and beyond. With over 20 years of clinical experience, Dr. Praveen Gupta has emerged as a pioneering force in the diagnosis, treatment, and advancement of neurological sciences.\n\n<strong>A true innovator, he has been responsible for several firsts in the country's neurology landscape:</strong>",
        'bullets' => [
            'Founder of the first stroke centre in Gurugram',
            'Performed the first solo mechanical thrombolysis in the region',
            'Led the first Deep Brain Stimulation (DBS) procedure in Gurugram',
            'Conducted the first epileptic DBS surgery in Asia',
            'Pioneered Bone Marrow Transplant (BMT) for autoimmune neurological disorders',
        ],
        'text_after' => 'Through his vision and dedication, Dr. Gupta has transformed neurological care in India and positioned himself as one of the best neurologists in India.',
        'button_text' => 'More About Us', 'button_url' => 'about',
        'options' => ['title_html' => true, 'image_side' => 'left'],
        'wrap' => ['bg' => 'bg-white', 'id' => 'about'],
    ],
    'why-trust' => [
        'type' => 'feature-split', 'label' => 'Why Patients Trust Us',
        'badge' => 'Why Patients Trust Us', 'badge_icon' => 'fa-heart',
        'title' => 'Compassionate Care That <span class="gradient-text">Puts You First</span>',
        'description' => 'When it comes to your brain and spine health, expert care makes all the difference. At NeuroDoc, we combine expert clinical care, advanced neuroscience, and compassionate support to guide you from diagnosis to recovery—with confidence at every step.',
        'image' => 'assets/full-image/dpg-award.webp', 'image_alt' => 'Dr. Praveen Gupta receiving an award',
        'items' => [
            ['icon' => 'fa-solid fa-hand-holding-heart', 'title' => 'Patient-First Care', 'text' => 'We listen closely to your concerns, explain things simply, and tailor treatments to your life.'],
            ['icon' => 'fa-solid fa-lightbulb', 'title' => 'Pioneering Treatment', 'text' => "Access to India's latest advancements in stroke recovery, brain therapies, and care."],
            ['icon' => 'fa-solid fa-circle-check', 'title' => 'Proven Recovery', 'text' => 'Over 20 years of experience helping thousands of families return to active, healthy lives.'],
            ['icon' => 'fa-solid fa-shield-halved', 'title' => 'Complete Support', 'text' => 'From consultations to home care guidelines, we stand by your family through healing.'],
        ],
        'button_text' => 'Get Started', 'button_url' => 'contact-us-top-neurologist-delhi-ncr',
        'options' => ['title_html' => true, 'image_side' => 'right'],
        'wrap' => ['bg' => 'bg-soft-cyan/30'],
    ],
    'virtual-consultation' => [
        'type' => 'strip', 'label' => 'Virtual consultation strip',
        'badge' => 'Virtual Consultation', 'badge_icon' => 'fa-video',
        'title' => 'Consult Dr. Praveen Gupta from Anywhere',
        'description' => 'Secure online video consultations for new diagnoses, treatment reviews and second opinions — no travel required.',
        'button_text' => 'Book Video Consultation', 'button_url' => 'online-neurologist-consultation',
        'button2_text' => '{phone}', 'button2_url' => '{phone}',
        'options' => ['watermark_icon' => 'fa-laptop-medical'],
        'wrap' => ['id' => 'virtual-consultation'],
    ],
    'technology' => [
        'type' => 'cards', 'label' => 'Advanced Technology',
        'badge' => 'Advanced Technology', 'badge_icon' => 'fa-microchip',
        'title' => 'Smart Tech for <span class="gradient-text">Faster Recovery</span>',
        'description' => 'We combine clinical expertise with state-of-the-art diagnostic and recovery tracking tools to ensure precise treatments.',
        'items' => [
            ['icon' => 'none', 'image' => 'assets/webp/services/rehab.webp', 'image_alt' => 'Phezee Biofeedback', 'title' => 'PHEZEE - Smart Biofeedback', 'text' => 'A smart wearable device used during physiotherapy sessions to monitor muscle health, track joint Range of Motion (ROM), and log precise electromyography (EMG) recovery trends in real-time.'],
            ['icon' => 'none', 'image' => 'assets/webp/services/movement.webp', 'image_alt' => 'Fall Risk Assessment', 'title' => 'OPD Fall Risk Assessment', 'text' => 'A comprehensive screening protocol conducted on an Outpatient (OPD) basis. We assess gait patterns, coordination, and muscular stability to prevent sudden falls and fractures, especially in senior patients.'],
        ],
        'options' => [
            'header_style' => 'pill', 'title_html' => true,
            'grid' => 'grid md:grid-cols-2 gap-8 max-w-5xl mx-auto',
            'card_class' => 'bg-white border border-silver-grey/50 p-8 rounded-3xl space-y-4 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 observe',
            'item_title_class' => 'text-xl font-bold text-deep-indigo font-serif',
            'item_text_class' => 'text-xs text-dark-grey/65 leading-relaxed',
            'item_image_class' => 'relative w-full aspect-video rounded-2xl overflow-hidden bg-silver-grey mb-4',
        ],
        'wrap' => ['bg' => 'bg-white', 'padding' => 'py-10 md:py-14', 'class' => 'relative overflow-hidden'],
    ],
    'team' => [
        'type' => 'team-grid', 'label' => 'Our Care Team',
        'badge' => 'Our Team', 'badge_icon' => 'fa-user-group',
        'title' => 'Our Care <span class="gradient-text">Team</span>',
        'description' => "The approach is simple: understand what's causing the problem, explain it clearly, and guide you toward the right treatment and recovery plan.",
        'limit' => 4,
        'button_text' => 'View Full Team Details', 'button_url' => 'team',
        'options' => ['title_html' => true],
        'wrap' => ['bg' => 'bg-soft-cyan/30'],
    ],
    'written-testimonials' => [
        'type' => 'testimonials', 'label' => 'Written testimonials', 'variant' => 'marquee',
        'badge' => 'Written Testimonials', 'badge_icon' => 'fa-quote-right',
        'title' => 'What Our <span class="gradient-text">Patients</span> Say',
        'description' => 'Real stories from real patients who experienced exceptional neurological care.',
        'button_text' => 'Read All Patient Reviews', 'button_url' => 'patient-reviews',
        'options' => ['title_html' => true],
        'wrap' => ['bg' => 'bg-white', 'id' => 'written-testimonials'],
    ],
    'video-testimonials' => ['type' => 'video-testimonials', 'label' => 'Video Testimonials', 'options' => ['limit' => 4]],
    'blog' => [
        'type' => 'blog-grid', 'label' => 'Latest Articles', 'variant' => 'teaser', 'limit' => 4,
        'badge' => 'Blogs', 'badge_icon' => 'fa-newspaper',
        'title' => 'Latest <span class="gradient-text">Articles</span>',
        'description' => 'Guidance on neurological conditions, treatments and recovery — written for patients and their families.',
        'button_text' => 'See All Blogs', 'button_url' => 'dr-praveen-gupta-blog',
        'options' => ['title_html' => true],
        'wrap' => ['bg' => 'bg-white'],
    ],
    'awards' => [
        'type' => 'collection-grid', 'label' => 'Awards & Recognition', 'collection' => 'awards', 'variant' => 'awards-home',
        'badge' => 'Awards & Recognition', 'badge_icon' => 'fa-trophy',
        'title' => 'Honours & <span class="gradient-text">Achievements</span>',
        'description' => 'National and international recognition for pioneering work in neurology and stroke care.',
        'options' => ['title_html' => true],
        'wrap' => ['bg' => 'bg-soft-cyan/30'],
    ],
    'education-videos' => [
        'type' => 'collection-grid', 'label' => 'Knowledge & Awareness videos', 'collection' => 'videos', 'variant' => 'videos-home', 'limit' => 6,
        'badge' => 'Education', 'badge_icon' => 'fa-graduation-cap',
        'title' => 'Knowledge & <span class="gradient-text">Awareness</span>',
        'description' => 'Short, practical explainers on symptoms, treatments and everyday brain health.',
        'options' => ['title_html' => true],
        'wrap' => ['bg' => 'bg-white'],
    ],
    'instagram' => [
        'type' => 'reels', 'label' => 'Instagram Reels',
        'badge' => 'Latest Reels', 'badge_icon' => 'fab fa-instagram',
        'title' => 'Follow the Journey on <span class="gradient-text">Instagram</span>',
        'description' => 'Quick neurology insights, patient moments and behind-the-scenes from the clinic.',
        'image' => 'assets/dpg-1.webp', 'image_alt' => 'Dr. Praveen Gupta on Instagram',
        'button_text' => 'Follow on Instagram', 'button_url' => '',
        'options' => ['title_html' => true],
        'wrap' => ['bg' => 'bg-soft-cyan/30', 'id' => 'instagram-reels'],
    ],
    'faq' => ['type' => 'faq', 'label' => 'FAQ Section'],
];

$template = <<<'PHP'
<?php
/**
 * Homepage - Dr. Praveen Gupta
 *
 * Every section (banner slider, services, slideshow, statistics, about,
 * why-choose, consultation strip, technology, team, testimonials, blog, awards,
 * videos, Instagram, FAQ) is a CMS block: order, visibility and copy are edited
 * in CMS → All Pages → Home.
 */
require_once __DIR__ . '/includes/header.php';

cms_render_page_flow('index');

require_once __DIR__ . '/includes/footer.php';
PHP;

echo "index flow: " . implode(' → ', array_keys(array_filter($home, function ($v, $k) { return $k[0] !== '_'; }, ARRAY_FILTER_USE_BOTH))) . "\n";
if ($write) {
    $all['index'] = $home;
    file_put_contents($file, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
    file_put_contents($root . '/index.php', $template . "\n");
    echo "written: data/page-blocks.json[index], index.php\n";
} else {
    echo "(dry run)\n";
}
