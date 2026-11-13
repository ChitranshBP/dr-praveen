<?php
/**
 * One-time migration: convert block-based service/condition templates to the
 * ordered page flow (cms_render_page_flow) and record their section order,
 * wrappers and breadcrumb settings in the CMS data.
 *
 *   php scripts/migrate-flow.php stroke epilepsy ...      (dry run, prints the plan)
 *   php scripts/migrate-flow.php --write stroke epilepsy  (rewrites templates + data)
 */
$root = dirname(__DIR__);
$write = in_array('--write', $argv, true);
$slugs = array_values(array_filter(array_slice($argv, 1), function ($a) { return $a[0] !== '-'; }));
if (!$slugs) { fwrite(STDERR, "Give one or more page slugs.\n"); exit(1); }

$blocksFile = $root . '/data/page-blocks.json';
$allBlocks = json_decode(file_get_contents($blocksFile), true);
$shared = $allBlocks['_shared'] ?? [];

function eval_literal($code) {
    try { return eval('return ' . $code . ';'); } catch (Throwable $e) { return null; }
}
/** Extract the balanced [...] literal that starts at $pos in $src. */
function balanced_array($src, $pos) {
    $depth = 0; $start = null;
    for ($i = $pos, $n = strlen($src); $i < $n; $i++) {
        $c = $src[$i];
        if ($c === '[') { if ($depth === 0) $start = $i; $depth++; }
        elseif ($c === ']') { $depth--; if ($depth === 0) return substr($src, $start, $i - $start + 1); }
    }
    return null;
}

foreach ($slugs as $slug) {
    $file = $root . '/' . $slug . '.php';
    if (!is_file($file)) { echo "!! $slug: template not found\n"; continue; }
    $src = str_replace("\r\n", "\n", file_get_contents($file));
    $bom = strpos($src, "\xEF\xBB\xBF") === 0 ? "\xEF\xBB\xBF" : '';
    $src = ltrim($src, "\xEF\xBB\xBF");
    $pageDefaults = $allBlocks[$slug] ?? [];
    if (!empty($pageDefaults['_flow'])) { echo "-- $slug already converted\n"; continue; }

    // ---- hero boundary --------------------------------------------------------
    if (!preg_match('/^<\/section>\s*$/m', $src, $hm, PREG_OFFSET_CAPTURE)) { echo "!! $slug: hero end not found\n"; continue; }
    $heroEnd = $hm[0][1] + strlen($hm[0][0]);
    $footerPos = strpos($src, "<?php require_once __DIR__ . '/includes/footer.php'; ?>");
    if ($footerPos === false) { echo "!! $slug: footer include not found\n"; continue; }
    $head = substr($src, 0, $heroEnd);
    $body = substr($src, $heroEnd, $footerPos - $heroEnd);

    // ---- section1 defaults from get_page_section() ---------------------------
    $sectionDefaults = ['badge' => '', 'title' => '', 'text' => '', 'image' => '', 'image_alt' => ''];
    // Simple string variables defined in the head may be referenced by the literal.
    $prelude = '';
    if (preg_match_all('/^\$(\w+)\s*=\s*("(?:[^"\\\\]|\\\\.)*"|\'(?:[^\'\\\\]|\\\\.)*\');\s*$/m', $head, $vm, PREG_SET_ORDER)) {
        foreach ($vm as $v) $prelude .= '$' . $v[1] . ' = ' . $v[2] . '; ';
    }
    if (preg_match('/get_page_section\(\s*\$pageContent\s*,\s*/', $head, $gm, PREG_OFFSET_CAPTURE)) {
        $lit = balanced_array($head, $gm[0][1] + strlen($gm[0][0]));
        $arr = $lit !== null ? eval_literal('(function () { ' . $prelude . ' return ' . $lit . '; })()') : null;
        if (is_array($arr)) $sectionDefaults = array_merge($sectionDefaults, $arr);
    }

    // ---- walk the body ----------------------------------------------------------
    $flow = [];      // ordered entries: ['key'=>..., 'def'=>[...]]
    $leftover = $body;
    $tokens = [];
    // Tokenise: sections, includes, loose block calls
    $re = '~(<section\b[^>]*>.*?</section>)|(<\?php\s*(?:\$vt\w+\s*=\s*[^;]+;\s*)*require\s+__DIR__\s*\.\s*["\']/includes/(video-testimonials|related-videos)\.php["\'];\s*\?>)|(<\?php\s*\$faqSlug\s*=\s*\'([a-z0-9-]+)\'\s*;\s*require\s+__DIR__\s*\.\s*\'/includes/faq-section\.php\'\s*;\s*\?>)|(<\?php\s*cms_render_page_block\(\s*\'' . preg_quote($slug, '~') . '\'\s*,\s*\'([a-z0-9-]+)\'\s*(?:,\s*(\[.*?\]))?\s*\);\s*\?>)~s';
    preg_match_all($re, $body, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE);
    foreach ($mm as $m) {
        $full = $m[0][0];
        $leftover = str_replace($full, '', $leftover);
        if (!empty($m[1][0])) {
            $sec = $m[1][0];
            preg_match('/<section\b[^>]*class="([^"]*)"/', $sec, $cm);
            $classes = preg_split('/\s+/', trim($cm[1] ?? ''));
            $bg = ''; $padding = []; $extra = [];
            foreach ($classes as $c) {
                if (preg_match('/^bg-/', $c)) $bg = $c;
                elseif (preg_match('/^p[ytb]-/', $c)) $padding[] = $c;
                else $extra[] = $c;
            }
            $wrap = ['bg' => $bg ?: 'bg-white', 'padding' => $padding ? implode(' ', $padding) : 'py-12'];
            if ($extra) $wrap['class'] = implode(' ', $extra);
            // intro section?
            $isIntro = strpos($sec, "\$section['title']") !== false;
            preg_match_all('/cms_render_page_block\(\s*\'' . preg_quote($slug, '/') . '\'\s*,\s*\'([a-z0-9-]+)\'/', $sec, $bm);
            $keys = $bm[1];
            preg_match_all('/cms_page_cta\(\s*\'' . preg_quote($slug, '/') . '\'\s*,\s*\'([a-z0-9-]+)\'/', $sec, $cm2);
            $ctaKeys = array_values(array_unique($cm2[1]));
            if ($isIntro) {
                $factsKey = $keys[0] ?? '';
                $introOpts = ['facts_key' => $factsKey];
                if (strpos($sec, 'lg:grid-cols-12') !== false && strpos($sec, 'lg:col-span-5') !== false) {
                    $introOpts['layout'] = 'sidebar';
                    if (isset($keys[1])) $introOpts['aside_key'] = $keys[1];
                    if (preg_match('/<span class="([^"]*)"><\?php echo htmlspecialchars\(\$section\[\'badge\'\]\)/', $sec, $bc)) $introOpts['badge_class'] = $bc[1];
                } elseif (strpos($sec, 'text-center max-w-3xl mx-auto') !== false) {
                    $introOpts['layout'] = 'centered';
                } else {
                    $imageSide = (preg_match('/lg:order-1/', $sec) && strpos($sec, 'lg:order-1') < strpos($sec, "\$section['title']")) ? 'left' : 'right';
                    if ($imageSide === 'left') $introOpts['image_side'] = 'left';
                }
                if (preg_match('/<section\b[^>]*\sid="([^"]+)"/', $sec, $idm)) $wrap['id'] = $idm[1];
                $def = ['type' => 'intro', 'label' => 'Main Body Section', 'badge' => $sectionDefaults['badge'], 'title' => $sectionDefaults['title'], 'text' => $sectionDefaults['text'], 'image' => $sectionDefaults['image'], 'image_alt' => $sectionDefaults['image_alt'], 'options' => $introOpts, 'wrap' => $wrap];
                $flow[] = ['key' => 'intro', 'def' => $def];
                foreach ($keys as $ki => $k) {
                    if ($ki <= (($introOpts['layout'] ?? '') === 'sidebar' ? 1 : 0)) $flow[] = ['key' => $k, 'nested' => true];
                    else echo "   note: extra block '$k' inside intro section of $slug\n";
                }
                continue;
            }
            if (preg_match('/<section\b[^>]*\sid="([^"]+)"/', $sec, $idm)) $wrap['id'] = $idm[1];
            $n = count($keys);
            foreach ($keys as $i => $k) {
                $w = $wrap;
                if ($n > 1) {
                    // Split a shared section so spacing stays identical: first keeps top padding, last keeps bottom padding.
                    $pt = 'pt-12'; $pb = 'pb-12';
                    foreach ($padding as $p) { if (preg_match('/^py-(.+)$/', $p, $pm)) { $pt = 'pt-' . $pm[1]; $pb = 'pb-' . $pm[1]; } if (preg_match('/^pt-/', $p)) $pt = $p; if (preg_match('/^pb-/', $p)) $pb = $p; }
                    $w['padding'] = ($i === 0 ? $pt : 'pt-0') . ' ' . ($i === $n - 1 ? $pb : 'pb-0');
                }
                $entry = ['key' => $k, 'wrap' => $w];
                // CTA rendered after the LAST block of the section → cta_key option on it
                if ($i === $n - 1 && $ctaKeys) {
                    $entry['cta_key'] = $ctaKeys[0];
                    if (count($ctaKeys) > 1) echo "   note: several CTAs in one section of $slug: " . implode(',', $ctaKeys) . "\n";
                }
                $flow[] = $entry;
            }
            if ($n === 0) { echo "   !! section without blocks in $slug — left as-is\n"; $leftover .= "\n" . $sec; }
        } elseif (!empty($m[2][0])) {
            $inc = $m[3][0];
            $def = ['type' => $inc, 'label' => $inc === 'video-testimonials' ? 'Video Testimonials' : 'Watch & Learn (related videos)'];
            foreach (['Eyebrow' => 'badge', 'Heading' => 'title', 'Intro' => 'description'] as $var => $field) {
                if (preg_match('/\$vt' . $var . '\s*=\s*\'((?:[^\'\\\\]|\\\\.)*)\'/', $m[2][0], $vm)) $def[$field] = stripslashes($vm[1]);
            }
            $flow[] = ['key' => $inc, 'def' => $def];
        } elseif (!empty($m[4][0])) {
            $def = ['type' => 'faq', 'label' => 'FAQ Section'];
            if ($m[5][0] !== $slug) $def['faq_slug'] = $m[5][0];
            $flow[] = ['key' => 'faq', 'def' => $def];
        } elseif (!empty($m[6][0])) {
            $entry = ['key' => $m[7][0], 'wrap' => false];
            if (!empty($m[8][0])) {
                $opts = eval_literal($m[8][0]);
                if (is_array($opts)) $entry['inline_options'] = $opts;
            }
            $flow[] = $entry;
        }
    }
    $leftoverClean = trim(preg_replace('/<!--.*?-->/s', '', $leftover));
    $leftoverClean = preg_replace('/\s+/', ' ', $leftoverClean);
    if ($leftoverClean !== '') {
        echo "!! $slug: unrecognised body content left — skipped:\n   " . substr($leftoverClean, 0, 300) . "\n";
        continue;
    }

    // ---- hero edits: breadcrumb + icon ------------------------------------------
    $pageJsonFile = $root . '/data/pages/' . $slug . '.json';
    $pageJson = is_file($pageJsonFile) ? (json_decode(file_get_contents($pageJsonFile), true) ?: []) : [];
    if (preg_match('/<nav class="flex items-center space-x-2 text-white\/80 text-sm mb-3">(.*?)<\/nav>/s', $head, $nm)) {
        $navHtml = $nm[1];
        preg_match_all('/<a href="([^"]+)"[^>]*>([^<]+)<\/a>/', $navHtml, $links);
        preg_match('/<span class="text-white font-medium">([^<]+)<\/span>/', $navHtml, $cur);
        $parent = '';
        foreach ($links[1] as $li => $href) if ($href !== 'index') $parent = $href;
        $pageJson['breadcrumb_label'] = html_entity_decode(trim($cur[1] ?? ''), ENT_QUOTES);
        $pageJson['breadcrumb_parent'] = $parent;
        $head = str_replace($nm[0], "<?php cms_breadcrumb_nav('" . $slug . "'); ?>", $head);
    } else {
        echo "   note: no breadcrumb nav found in $slug\n";
    }
    if (preg_match('/(<div class="inline-flex items-center space-x-2 bg-white\/10[^"]*"[^>]*>\s*<i class=")(fas|fab) (fa-[a-z0-9-]+)( [^"]*)?("[^>]*><\/i>)/s', $head, $im)) {
        $pageJson['hero_icon'] = $im[3];
        $replacement = $im[1] . $im[2] . ' <?php echo htmlspecialchars(trim((string)($pageContent[\'hero_icon\'] ?? \'\')) !== \'\' ? $pageContent[\'hero_icon\'] : \'' . $im[3] . '\'); ?>' . ($im[4] ?? '') . $im[5];
        $head = str_replace($im[0], $replacement, $head);
    } else {
        echo "   note: hero icon not found in $slug\n";
    }
    // drop get_page_section() + $section var from the head (the intro block owns it now)
    if (preg_match('/\$section = get_page_section\(\s*\$pageContent\s*,\s*/', $head, $gm2, PREG_OFFSET_CAPTURE)) {
        $lit = balanced_array($head, $gm2[0][1] + strlen($gm2[0][0]));
        $full = substr($head, $gm2[0][1], strlen($gm2[0][0]) + strlen($lit));
        $head = preg_replace('/' . preg_quote($full, '/') . '\s*\);\s*\n/', '', $head, 1);
    }

    // ---- new page-blocks entry ------------------------------------------------------
    $newDefs = ['_flow' => true];
    foreach ($flow as $e) {
        $k = $e['key'];
        if (!empty($e['nested'])) {
            $d = $pageDefaults[$k] ?? ['type' => 'facts'];
            $d['nested'] = true;
            $newDefs[$k] = $d;
            continue;
        }
        if (isset($e['def'])) { $newDefs[$k] = $e['def']; continue; }
        if (isset($pageDefaults[$k])) { $d = $pageDefaults[$k]; }
        elseif (isset($shared[$k])) { $d = ['use' => '_shared']; }
        else { echo "!! $slug: block '$k' has no definition\n"; $d = ['type' => 'cards', 'label' => $k]; }
        if (array_key_exists('wrap', $e)) $d['wrap'] = $e['wrap'];
        if (!empty($e['cta_key'])) { $d['options'] = ($d['options'] ?? []) + ['cta_key' => $e['cta_key']]; }
        if (!empty($e['inline_options'])) { $d['options'] = array_merge($d['options'] ?? [], $e['inline_options']); }
        $newDefs[$k] = $d;
    }
    // keep any defaults not reached by the flow (safety)
    foreach ($pageDefaults as $k => $d) if (!isset($newDefs[$k]) && $k[0] !== '_') { echo "   note: default block '$k' not in template flow of $slug — kept (hidden by default)\n"; $d['nested'] = true; $newDefs[$k] = $d; }

    $newBody = "\n\n<!-- Page sections: order, visibility and content are managed in CMS → All Pages -->\n<?php cms_render_page_flow('" . $slug . "'); ?>\n\n";
    $newSrc = $bom . $head . $newBody . substr($src, $footerPos);

    echo "== $slug: " . implode(' → ', array_map(function ($e) { return $e['key'] . (!empty($e['nested']) ? '(nested)' : '') . (!empty($e['cta_key']) ? '+cta:' . $e['cta_key'] : ''); }, $flow)) . "\n";
    echo "   breadcrumb: " . ($pageJson['breadcrumb_parent'] ?? '-') . ' › ' . ($pageJson['breadcrumb_label'] ?? '-') . " | icon: " . ($pageJson['hero_icon'] ?? '-') . "\n";

    if ($write) {
        $allBlocks[$slug] = $newDefs;
        file_put_contents($file, $newSrc);
        file_put_contents($pageJsonFile, json_encode($pageJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
    }
}
if ($write) {
    file_put_contents($blocksFile, json_encode($allBlocks, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
    echo "page-blocks.json written\n";
} else {
    echo "(dry run — add --write)\n";
}
