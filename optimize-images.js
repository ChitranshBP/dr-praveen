/**
 * Image Optimization Script for Dr. Praveen Gupta Website
 * 
 * Resizes images to their actual display dimensions (2x for retina)
 * and converts to optimized WebP format.
 */
const sharp = require('sharp');
const fs = require('fs');
const path = require('path');

// Helper: optimize a single image
async function optimizeImage(srcPath, destPath, options = {}) {
    const { width, height, quality = 75, fit = 'cover' } = options;
    try {
        let pipeline = sharp(srcPath);
        
        if (width || height) {
            pipeline = pipeline.resize(width, height, { 
                fit, 
                withoutEnlargement: true 
            });
        }
        
        await pipeline.webp({ quality, effort: 6 }).toFile(destPath);
        
        const srcSize = fs.statSync(srcPath).size;
        const destSize = fs.statSync(destPath).size;
        const savings = ((1 - destSize / srcSize) * 100).toFixed(1);
        console.log(`  ✓ ${path.basename(srcPath)} (${(srcSize/1024).toFixed(0)}KB) → ${path.basename(destPath)} (${(destSize/1024).toFixed(0)}KB) [${savings}% smaller]`);
    } catch (err) {
        console.error(`  ✗ Failed: ${srcPath} — ${err.message}`);
    }
}

// Helper: ensure directory exists
function ensureDir(dir) {
    if (!fs.existsSync(dir)) {
        fs.mkdirSync(dir, { recursive: true });
    }
}

// Helper: convert all images in a directory
async function convertDir(srcDir, destDir, options = {}) {
    ensureDir(destDir);
    if (!fs.existsSync(srcDir)) {
        console.log(`  ⚠ Source dir not found: ${srcDir}`);
        return;
    }
    const files = fs.readdirSync(srcDir);
    for (const file of files) {
        const ext = path.extname(file).toLowerCase();
        if (['.png', '.jpg', '.jpeg'].includes(ext)) {
            const basename = path.parse(file).name;
            const srcPath = path.join(srcDir, file);
            const destPath = path.join(destDir, basename + '.webp');
            await optimizeImage(srcPath, destPath, options);
        }
    }
}

(async () => {
    console.log('═══════════════════════════════════════════');
    console.log('  Image Optimization for Dr. Praveen Gupta');
    console.log('═══════════════════════════════════════════\n');
    
    // ─── 1. Doctor Team Photos ───
    // Displayed at 128×128 on homepage, 160×160 on team page
    // Resize to 320×320 (2x retina of 160px)
    console.log('▸ Doctor team photos (target: 320×320)...');
    const ggn = './assets/ggn-nuro-images';
    const ggn_opt = './assets/ggn-nuro-images/optimized';
    ensureDir(ggn_opt);
    if (fs.existsSync(ggn)) {
        const files = fs.readdirSync(ggn);
        for (const file of files) {
            const ext = path.extname(file).toLowerCase();
            if (['.webp', '.png', '.jpg', '.jpeg'].includes(ext) && file !== 'optimized') {
                const srcPath = path.join(ggn, file);
                const stat = fs.statSync(srcPath);
                if (stat.isFile() && stat.size > 100000) { // Only optimize files > 100KB
                    const basename = path.parse(file).name;
                    const destPath = path.join(ggn_opt, basename + '.webp');
                    await optimizeImage(srcPath, destPath, { width: 320, height: 320, quality: 78 });
                }
            }
        }
    }
    
    // ─── 2. Service Images ───
    // Displayed at ~400×300 on cards. Resize to 640×480 (2x retina)
    console.log('\n▸ Service images (target: 640×480)...');
    await convertDir('./assets/services', './assets/webp/services', { 
        width: 640, height: 480, quality: 75 
    });
    
    // ─── 3. Banner Images ───
    // Desktop banners displayed at 1440×500 max. Keep at 1440 wide, quality reduce
    console.log('\n▸ Desktop banners (target: 1440w, quality 70)...');
    await convertDir('./assets/banner/banner-new', './assets/webp/banner', { 
        width: 1440, quality: 70 
    });
    
    // ─── 4. Mobile Banners ───
    // Mobile banners at ~768px max. Resize to 768 wide
    console.log('\n▸ Mobile banners (target: 768w, quality 72)...');
    await convertDir('./assets/mobile-banner', './assets/webp/mobile-banner', { 
        width: 768, quality: 72 
    });
    
    // ─── 5. Award Images ───
    // Awards shown at ~250×375 (2/3 aspect). Resize to 400×600
    console.log('\n▸ Award images (target: 400w, quality 72)...');
    const awardsDir = './assets/awards';
    const awardsOpt = './assets/webp/awards';
    ensureDir(awardsOpt);
    if (fs.existsSync(awardsDir)) {
        const files = fs.readdirSync(awardsDir);
        for (const file of files) {
            const ext = path.extname(file).toLowerCase();
            if (['.png', '.jpg', '.jpeg', '.webp'].includes(ext)) {
                const basename = path.parse(file).name;
                const srcPath = path.join(awardsDir, file);
                const destPath = path.join(awardsOpt, basename + '.webp');
                await optimizeImage(srcPath, destPath, { width: 400, quality: 72 });
            }
        }
    }
    
    // ─── 6. Full-Image Banners ───
    // Mid-page banners at 1440 wide
    console.log('\n▸ Full-image banners (target: 1440w, quality 68)...');
    const fullImg = './assets/full-image';
    if (fs.existsSync(fullImg)) {
        const files = fs.readdirSync(fullImg);
        for (const file of files) {
            const ext = path.extname(file).toLowerCase();
            if (['.png', '.jpg', '.jpeg'].includes(ext)) {
                const basename = path.parse(file).name;
                const srcPath = path.join(fullImg, file);
                const destPath = path.join(fullImg, basename + '.webp');
                // Only convert if webp doesn't already exist or is too large
                if (!fs.existsSync(destPath) || fs.statSync(destPath).size > 60000) {
                    await optimizeImage(srcPath, destPath, { width: 1440, quality: 68 });
                }
            }
        }
    }
    
    // ─── 7. Logo ───
    // Logo displayed at 56px height. Resize to 112px height (2x retina)
    console.log('\n▸ Logo (target: 112px height)...');
    const logoSrc = './assets/logo/NeuroDoc-final-logo.png';
    const logoDest = './assets/logo/NeuroDoc-final-logo.webp';
    if (fs.existsSync(logoSrc)) {
        await optimizeImage(logoSrc, logoDest, { height: 112, quality: 80, fit: 'inside' });
    }
    
    // ─── 8. DPG-1 (about section photo) ───
    // Displayed at ~500px wide. Resize to 800px (2x)
    console.log('\n▸ About section photo...');
    const dpgSrc = './assets/dpg-1.webp';
    const dpgOpt = './assets/dpg-1-opt.webp';
    if (fs.existsSync(dpgSrc)) {
        const stat = fs.statSync(dpgSrc);
        if (stat.size > 30000) {
            await optimizeImage(dpgSrc, dpgOpt, { width: 800, quality: 75 });
        }
    }

    // ─── 9. Breadcrumbs images ───
    console.log('\n▸ Breadcrumb images (target: 1440w, quality 65)...');
    await convertDir('./assets/breadcrumbs', './assets/webp/breadcrumbs', { 
        width: 1440, quality: 65 
    });
    
    console.log('\n═══════════════════════════════════════════');
    console.log('  Optimization complete!');
    console.log('═══════════════════════════════════════════');
})();
