---
name: footer-design
description: Design and implement modern, responsive PHP footers with Tailwind CSS for doctor/clinic websites
---

# Footer Design

Create or redesign footers for PHP doctor/clinic websites with consistent styling and functionality.

## When to Use

- Creating a new footer for a PHP website
- Redesigning an existing footer to be more modern/aesthetic
- Adding new sections to a footer (services, links, contact)
- Fixing footer layout issues (distortion, alignment, spacing)

## Standard Footer Structure

```php
<!-- Footer -->
<footer class="bg-deep-indigo text-white relative overflow-hidden">
    <!-- Gradient top border -->
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-electric-blue via-cyan-accent to-electric-blue"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            
            <!-- Column 1: About -->
            <div>
                <div class="flex items-center space-x-3 mb-6">
                    <img src="[logo-path]" alt="[Site Name]" class="h-10">
                </div>
                <p class="text-white/70 text-sm leading-relaxed mb-6">
                    [Brief description]
                </p>
                <div class="flex items-center space-x-4">
                    <a href="[facebook]" class="w-10 h-10 rounded-full bg-white/10 hover:bg-electric-blue flex items-center justify-center transition-all duration-300">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="[instagram]" class="w-10 h-10 rounded-full bg-white/10 hover:bg-electric-blue flex items-center justify-center transition-all duration-300">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="[twitter]" class="w-10 h-10 rounded-full bg-white/10 hover:bg-electric-blue flex items-center justify-center transition-all duration-300">
                        <i class="fab fa-twitter text-sm"></i>
                    </a>
                    <a href="[youtube]" class="w-10 h-10 rounded-full bg-white/10 hover:bg-electric-blue flex items-center justify-center transition-all duration-300">
                        <i class="fab fa-youtube text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div>
                <h4 class="text-lg font-bold mb-6">Quick Links</h4>
                <ul class="space-y-3">
                    <?php foreach ($navItems as $item): ?>
                        <li>
                            <a href="<?php echo $item['url']; ?>" class="text-white/70 hover:text-cyan-accent text-sm transition-colors duration-300 flex items-center space-x-2">
                                <i class="fas fa-chevron-right text-xs text-electric-blue"></i>
                                <span><?php echo $item['name']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Column 3: Services -->
            <div>
                <h4 class="text-lg font-bold mb-6">Services</h4>
                <ul class="space-y-3">
                    <?php foreach (array_slice($services, 0, 6) as $service): ?>
                        <li>
                            <a href="services.php" class="text-white/70 hover:text-cyan-accent text-sm transition-colors duration-300 flex items-center space-x-2">
                                <i class="fas fa-chevron-right text-xs text-electric-blue"></i>
                                <span><?php echo $service['title']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Column 4: Contact -->
            <div>
                <h4 class="text-lg font-bold mb-6">Contact Us</h4>
                <ul class="space-y-4">
                    <li class="flex items-start space-x-3">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-electric-blue text-sm"></i>
                        </div>
                        <div>
                            <p class="text-white/70 text-sm"><?php echo SITE_ADDRESS; ?></p>
                        </div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone-alt text-electric-blue text-sm"></i>
                        </div>
                        <div>
                            <a href="tel:<?php echo SITE_PHONE; ?>" class="text-white/70 hover:text-cyan-accent text-sm transition-colors duration-300">
                                <?php echo SITE_PHONE; ?>
                            </a>
                        </div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-electric-blue text-sm"></i>
                        </div>
                        <div>
                            <a href="mailto:<?php echo SITE_EMAIL; ?>" class="text-white/70 hover:text-cyan-accent text-sm transition-colors duration-300">
                                <?php echo SITE_EMAIL; ?>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <p class="text-white/50 text-sm">
                    &copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.
                </p>
                <div class="flex items-center space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-white/50 hover:text-white text-sm transition-colors duration-300">Privacy Policy</a>
                    <a href="#" class="text-white/50 hover:text-white text-sm transition-colors duration-300">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 rounded-full bg-electric-blue text-white shadow-lg hover:bg-cyan-accent transition-all duration-300 flex items-center justify-center opacity-0 invisible z-50">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

<script>
// Back to top button
const backToTop = document.getElementById('back-to-top');
window.addEventListener('scroll', () => {
    if (window.scrollY > 500) {
        backToTop.classList.remove('opacity-0', 'invisible');
        backToTop.classList.add('opacity-100', 'visible');
    } else {
        backToTop.classList.add('opacity-0', 'invisible');
        backToTop.classList.remove('opacity-100', 'visible');
    }
});
backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
```

## Footer Variations

### Minimal Footer
```php
<footer class="bg-deep-indigo text-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <p class="text-white/50 text-sm">&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?></p>
            <div class="flex items-center space-x-4 mt-4 md:mt-0">
                <!-- Social icons -->
            </div>
        </div>
    </div>
</footer>
```

### Extended Footer with Newsletter
```php
<!-- Add before main footer columns -->
<div class="bg-electric-blue/10 py-12 mb-12 rounded-3xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <div class="mb-6 lg:mb-0">
                <h3 class="text-2xl font-bold text-white mb-2">Subscribe to Our Newsletter</h3>
                <p class="text-white/70">Stay updated with the latest news and health tips.</p>
            </div>
            <form class="flex w-full lg:w-auto">
                <input type="email" placeholder="Enter your email" class="flex-1 lg:w-80 px-6 py-3 rounded-l-full bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:border-cyan-accent">
                <button type="submit" class="px-8 py-3 bg-electric-blue hover:bg-cyan-accent text-white font-bold rounded-r-full transition-all duration-300">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</div>
```

## Color Classes

| Element | Classes |
|---------|---------|
| Footer background | `bg-deep-indigo` |
| Text primary | `text-white` |
| Text secondary | `text-white/70` |
| Text muted | `text-white/50` |
| Icon background | `bg-white/10` |
| Icon hover | `hover:bg-electric-blue` |
| Link hover | `hover:text-cyan-accent` |
| Border | `border-white/10` |

## Responsive Grid

| Breakpoint | Columns |
|------------|---------|
| Mobile | `grid-cols-1` |
| Tablet | `grid-cols-2` |
| Desktop | `grid-cols-4` |

## Common Issues & Fixes

### Issue: Footer distortion
**Fix:** Ensure proper grid structure and consistent padding
```php
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
```

### Issue: Logo not visible
**Fix:** Check image path and add proper sizing
```php
<img src="assets/logo/[logo].png" alt="[Name]" class="h-10">
```

### Issue: Links not working
**Fix:** Verify href paths match actual files
```php
<a href="index.php">  <!-- Not /index.php or ./index.php -->
```

### Issue: Spacing too tight
**Fix:** Increase padding and gap values
```py
class="py-16"  <!-- Section padding -->
class="gap-12" <!-- Grid gap -->
```

## Validation

After implementing footer:
1. Check PHP syntax: `php -l [file]`
2. Verify all links point to existing files
3. Test responsive layout on mobile/tablet/desktop
4. Check social media icon links
5. Verify back-to-top button functionality
6. Test hover states on all interactive elements
