<?php
/**
 * Hero breadcrumb trail (Home › Parent › Page).
 * Labels and the parent page come from each page's SEO card in the CMS
 * (data/pages/{slug}.json → breadcrumb_label / breadcrumb_parent) through
 * cms_breadcrumbs() in includes/cms-load.php.
 *
 *   <?php cms_breadcrumb_nav('stroke'); ?>
 *   <?php cms_breadcrumb_nav('about', ['class' => '...']); ?>
 */

if (!function_exists('cms_breadcrumb_nav')) {
    function cms_breadcrumb_nav($slug, array $options = []) {
        $trail = function_exists('cms_breadcrumbs') ? cms_breadcrumbs($slug) : [];
        if (empty($trail)) {
            return;
        }
        $navClass = $options['class'] ?? 'flex items-center space-x-2 text-white/80 text-sm mb-3';
        $linkClass = $options['link_class'] ?? 'hover:text-white transition-colors';
        $currentClass = $options['current_class'] ?? 'text-white font-medium';
        $sepClass = $options['sep_class'] ?? 'fas fa-chevron-right text-[8px]';
        $last = count($trail) - 1;
        ?>
            <nav class="<?php echo htmlspecialchars($navClass); ?>" aria-label="Breadcrumb">
                <?php foreach ($trail as $i => $crumb): ?>
                <?php if ($i > 0): ?>
                <i class="<?php echo htmlspecialchars($sepClass); ?>"></i>
                <?php endif; ?>
                <?php if ($i === $last): ?>
                <span class="<?php echo htmlspecialchars($currentClass); ?>"><?php echo htmlspecialchars($crumb['label']); ?></span>
                <?php else: ?>
                <a href="<?php echo htmlspecialchars($crumb['slug']); ?>" class="<?php echo htmlspecialchars($linkClass); ?>"><?php echo htmlspecialchars($crumb['label']); ?></a>
                <?php endif; ?>
                <?php endforeach; ?>
            </nav>
        <?php
    }
}
