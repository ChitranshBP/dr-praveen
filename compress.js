const sharp = require('sharp');
const fs = require('fs');
const path = require('path');

const convertDir = async (srcDir, destDir) => {
    if (!fs.existsSync(destDir)) {
        fs.mkdirSync(destDir, { recursive: true });
    }
    const files = fs.readdirSync(srcDir);
    for (const file of files) {
        if (file.endsWith('.png') || file.endsWith('.jpg') || file.endsWith('.jpeg')) {
            const basename = path.parse(file).name;
            const srcPath = path.join(srcDir, file);
            const destPath = path.join(destDir, basename + '.webp');
            console.log(`Converting ${srcPath} -> ${destPath}`);
            await sharp(srcPath).webp({ quality: 80 }).toFile(destPath);
        }
    }
};

(async () => {
    console.log('Starting compression...');
    await convertDir('./assets/services', './assets/webp/services');
    await convertDir('./assets/banner/banner-new', './assets/webp/banner');
    await convertDir('./assets/mobile-banner', './assets/webp/mobile-banner');
    console.log('Done!');
})();
