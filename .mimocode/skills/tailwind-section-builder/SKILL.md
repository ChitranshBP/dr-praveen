---
name: tailwind-section-builder
description: Build reusable PHP sections with Tailwind CSS for doctor/clinic websites (hero, services, testimonials, FAQ, etc.)
---

# Tailwind Section Builder

Create or modify PHP sections with consistent Tailwind CSS styling for healthcare websites.

## When to Use

- Adding a new section to an existing PHP page
- Modifying section layouts (grid, flex, spacing)
- Updating section styling (colors, shadows, borders)
- Converting between section layouts (e.g., 2-col to 3-col grid)

## Common Section Types

### 1. Hero Section

```php
<section class="relative overflow-hidden bg-[#edf5f9] -mt-20">
    <div class="w-full max-w-[1920px] mx-auto relative">
        <img src="[banner-image]" alt="[Alt text]" class="w-full h-auto block min-h-[480px] object-cover">
        
        <div class="absolute inset-0 flex items-center bg-gradient-to-r from-deep-indigo/70 via-deep-indigo/35 to-transparent">
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-lg md:max-w-xl lg:max-w-2xl text-white">
                    <!-- Pill Tagline -->
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/20 mb-6 animate-fade-in-up">
                        <span class="w-2 h-2 rounded-full bg-cyan-accent animate-pulse"></span>
                        <span class="text-white text-xs font-semibold uppercase tracking-wider">[Tagline]</span>
                    </div>

                    <!-- H1 Title -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white leading-tight mb-5 animate-fade-in-up">
                        [Title] <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-cyan-200 to-cyan-100 font-extrabold">[Highlight]</span>
                    </h1>

                    <!-- Description -->
                    <p class="text-sm sm:text-base md:text-lg text-white/90 leading-relaxed mb-8 max-w-xl animate-fade-in-up font-medium">
                        [Description]
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4 items-center animate-fade-in-up">
                        <a href="[primary-url]" class="inline-flex items-center space-x-2.5 bg-gradient-to-r from-cyan-accent to-blue-500 hover:from-cyan-400 hover:to-blue-600 text-white font-bold px-6 py-3 rounded-full shadow-lg transition-all duration-300">
                            <span>[Primary CTA]</span>
                            <i class="fas fa-[icon] text-xs"></i>
                        </a>
                        <a href="[secondary-url]" class="inline-flex items-center space-x-2.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 hover:border-white/40 text-white font-bold px-6 py-3 rounded-full transition-all duration-300">
                            <span>[Secondary CTA]</span>
                            <i class="fas fa-[icon] text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
```

### 2. Services Grid

```php
<section class="py-12 bg-soft-cyan/30 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-electric-blue via-cyan-accent to-electric-blue"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-[icon] text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">[Label]</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                [Title] <span class="gradient-text">[Highlight]</span>
            </h2>
            <p class="text-lg text-dark-grey/70">[Description]</p>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($services as $index => $service): ?>
                <div class="group bg-white rounded-3xl p-5 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 flex flex-col justify-between">
                    <div>
                        <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-soft-cyan to-silver-grey">
                            <img src="<?php echo $service['image']; ?>" alt="<?php echo $service['title']; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <h3 class="text-2xl font-bold text-deep-indigo group-hover:text-electric-blue transition-colors leading-tight mb-3">
                            <?php echo $service['title']; ?>
                        </h3>
                        <p class="text-dark-grey/70 leading-relaxed text-sm">
                            <?php echo $service['description']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
```

### 3. Testimonials Slider

```php
<section class="py-12 bg-soft-cyan/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center space-x-2 bg-electric-blue/10 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-comments text-electric-blue text-sm"></i>
                <span class="text-electric-blue text-sm font-semibold">Testimonials</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-deep-indigo mb-4">
                What Our <span class="gradient-text">Patients</span> Say
            </h2>
        </div>

        <!-- Reviews Grid with Slider -->
        <div class="overflow-hidden">
            <div id="reviews-track" class="flex transition-transform duration-500 ease-in-out">
                <?php
                $pages = array_chunk($testimonials, 4);
                foreach ($pages as $pageIdx => $page):
                ?>
                    <div class="min-w-full grid grid-cols-2 gap-5">
                        <?php foreach ($page as $testimonial): ?>
                            <div class="group bg-white rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-silver-grey/50 flex flex-col">
                                <i class="fas fa-quote-left text-electric-blue/20 text-2xl mb-2"></i>
                                <p class="text-dark-grey/75 text-sm leading-relaxed flex-1 mb-5">
                                    <?php echo $testimonial['message']; ?>
                                </p>
                                <div class="w-full h-px bg-silver-grey mb-4"></div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-electric-blue to-cyan-accent flex items-center justify-center text-white font-bold text-sm">
                                        <?php echo strtoupper(substr($testimonial['name'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <p class="font-bold text-deep-indigo text-sm"><?php echo $testimonial['name']; ?></p>
                                        <p class="text-xs text-cyan-accent font-medium"><?php echo $testimonial['role']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Slider Controls -->
        <div class="flex items-center justify-between mt-8">
            <div class="flex items-center space-x-2" id="review-dots">
                <?php foreach ($pages as $pageIdx => $page): ?>
                    <button class="review-dot w-2.5 h-2.5 rounded-full transition-all duration-300 <?php echo $pageIdx === 0 ? 'bg-electric-blue w-6' : 'bg-silver-grey'; ?>" data-page="<?php echo $pageIdx; ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="flex items-center space-x-3">
                <button id="prev-review" class="w-11 h-11 rounded-full bg-white hover:bg-electric-blue hover:text-white text-deep-indigo border border-silver-grey shadow-sm transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button id="next-review" class="w-11 h-11 rounded-full bg-electric-blue text-white hover:bg-deep-indigo border border-electric-blue shadow-sm transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>
        </div>
    </div>
</section>
```

### 4. Stats Counter

```php
<section class="py-12 bg-[#d4e9f7] relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($stats as $stat): ?>
                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm flex flex-col justify-between h-full text-left">
                    <div>
                        <div class="text-4xl font-extrabold text-dark-grey mb-1"><?php echo $stat['number']; ?></div>
                        <div class="text-base font-bold text-deep-indigo mb-4"><?php echo $stat['label']; ?></div>
                        <div class="w-full h-px bg-gray-100 my-4"></div>
                        <p class="text-sm text-dark-grey/70 leading-relaxed mt-4"><?php echo $stat['description']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
```

### 5. FAQ Accordion

```php
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Left: Header -->
            <div>
                <span class="text-xs font-bold tracking-wider text-dark-grey/60 uppercase block mb-3">FAQ</span>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-deep-indigo leading-tight mb-4">
                    Frequently Asked Questions
                </h2>
                <p class="text-base text-dark-grey/70 mb-8">[Description]</p>
            </div>

            <!-- Right: Accordion -->
            <div class="space-y-4">
                <?php foreach ($faqs as $index => $faq): ?>
                    <div class="border border-silver-grey/50 rounded-2xl overflow-hidden">
                        <button class="faq-toggle w-full flex items-center justify-between p-5 text-left" data-index="<?php echo $index; ?>">
                            <span class="font-bold text-deep-indigo pr-4"><?php echo $faq['question']; ?></span>
                            <i class="fas fa-chevron-down text-electric-blue transition-transform duration-300"></i>
                        </button>
                        <div class="faq-content px-5 pb-5 hidden">
                            <p class="text-dark-grey/70 text-sm leading-relaxed"><?php echo $faq['answer']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
```

## Grid Variations

| Columns | Classes |
|---------|---------|
| 1 col | `grid-cols-1` |
| 2 cols | `grid-cols-1 md:grid-cols-2` |
| 3 cols | `grid-cols-1 md:grid-cols-2 lg:grid-cols-3` |
| 4 cols | `grid-cols-1 md:grid-cols-2 lg:grid-cols-4` |
| 5 cols | `grid-cols-2 md:grid-cols-3 lg:grid-cols-5` |

## Spacing Classes

| Element | Padding | Margin |
|---------|---------|--------|
| Section | `py-12` or `py-16` | - |
| Container | `px-4 sm:px-6 lg:px-8` | - |
| Card | `p-5` or `p-6` | - |
| Grid gap | `gap-6` or `gap-8` | - |
| Section header | - | `mb-12` or `mb-16` |

## Animation Classes

- Fade in up: `animate-fade-in-up`
- Hover lift: `hover:-translate-y-2`
- Hover scale: `group-hover:scale-105`
- Transition: `transition-all duration-500`

## Validation

After building a section:
1. Check PHP syntax: `php -l [file]`
2. Verify responsive breakpoints work
3. Test hover states
4. Check color contrast for accessibility
