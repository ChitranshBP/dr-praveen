---
name: php-website-scaffold
description: Scaffold a new PHP doctor/clinic website with Tailwind CSS, standard includes structure, and common sections
---

# PHP Website Scaffold

Scaffold a new PHP doctor/clinic website with a consistent, maintainable structure.

## When to Use

- Creating a new doctor, clinic, or healthcare provider website
- Starting a PHP project with Tailwind CSS styling
- Need a consistent project structure across multiple similar sites

## Project Structure

```
project-root/
├── index.php              # Homepage with hero, services, stats, about, testimonials, blog
├── about.php              # About page
├── services.php           # Services listing
├── contact.php            # Contact/appointment form
├── blog.php               # Blog listing
├── gallery.php            # Photo gallery
├── includes/
│   ├── config.php         # Site configuration & data arrays
│   ├── header.php         # Reusable header with navbar
│   └── footer.php         # Reusable footer with scripts
├── assets/
│   ├── services/          # Service images
│   ├── awards/            # Award/recognition images
│   ├── full-image/        # Banner images
│   └── press/             # Press/media images
├── dist/                  # Compiled/built output
└── README.md              # Project documentation
```

## Step 1: Create config.php

```php
<?php
/**
 * Site Configuration
 * [Doctor Name] - Official Website
 */

// Site Information
define('SITE_NAME', '[Doctor Name]');
define('SITE_TAGLINE', '[Tagline]');
define('SITE_URL', '[URL]');
define('SITE_PHONE', '[Phone]');
define('SITE_EMAIL', '[Email]');
define('SITE_ADDRESS', '[Address]');

// Social Media
define('SOCIAL_FACEBOOK', '[URL]');
define('SOCIAL_INSTAGRAM', '[URL]');
define('SOCIAL_TWITTER', '[URL]');
define('SOCIAL_YOUTUBE', '[URL]');
define('SOCIAL_LINKEDIN', '[URL]');

// Navigation
$navItems = [
    ['name' => 'Home', 'url' => 'index.php', 'active' => true],
    ['name' => 'About', 'url' => 'about.php', 'active' => false],
    ['name' => 'Services', 'url' => 'services.php', 'active' => false],
    ['name' => 'Blog', 'url' => 'blog.php', 'active' => false],
    ['name' => 'Contact', 'url' => 'contact.php', 'active' => false],
];

// Services (array of [title, description, image])
$services = [];

// Stats (array of [number, label, description])
$stats = [];

// Testimonials (array of [name, role, message, rating])
$testimonials = [];

// Blog Posts (array of [title, excerpt, category, date, image, url])
$blogs = [];
```

## Step 2: Create header.php

- Include Tailwind CSS via CDN
- Include Font Awesome for icons
- Add responsive navbar with mobile menu toggle
- Use site colors: Electric Blue (#2563EB), Cyan (#06B6D4), Deep Indigo (#1E1B4B)

## Step 3: Create footer.php

- Footer with site info, quick links, services, contact
- Social media icons
- Copyright notice
- Back-to-top button
- Include any JavaScript scripts

## Step 4: Create index.php Sections

Standard homepage sections in order:
1. **Hero Section** - Full-width banner with overlay text, CTA buttons
2. **Services Section** - Grid of service cards with images
3. **Stats Section** - Animated counters
4. **About Section** - Doctor photo + bio with achievements
5. **Why Choose Us** - Feature grid with icons
6. **Testimonials** - Patient reviews with slider
7. **Blog Section** - Latest articles grid
8. **Awards Section** - Recognition images grid
9. **Education Videos** - YouTube embeds

## Tailwind Color Classes

Use these custom color names (define in tailwind.config.js or use inline):
- `text-electric-blue` / `bg-electric-blue` → #2563EB
- `text-cyan-accent` / `bg-cyan-accent` → #06B6D4
- `text-deep-indigo` / `bg-deep-indigo` → #1E1B4B
- `bg-soft-cyan` → #ECFEFF
- `text-dark-grey` → #111827
- `border-silver-grey` → #E5E7EB

## Common Patterns

### Section Wrapper
```php
<section class="py-12 bg-[color] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Content -->
    </div>
</section>
```

### Card Pattern
```php
<div class="group bg-white rounded-3xl p-5 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50">
    <!-- Card content -->
</div>
```

### Button Pattern
```php
<a href="[url]" class="inline-flex items-center space-x-2.5 bg-gradient-to-r from-cyan-accent to-blue-500 hover:from-cyan-400 hover:to-blue-600 text-white font-bold px-6 py-3 rounded-full shadow-lg transition-all duration-300">
    <span>[Text]</span>
    <i class="fas fa-[icon] text-xs"></i>
</a>
```

## Validation

After scaffolding:
1. Verify all PHP files have no syntax errors: `php -l [file]`
2. Check all internal links point to existing files
3. Verify image paths are correct
4. Test responsive design on mobile/tablet/desktop
