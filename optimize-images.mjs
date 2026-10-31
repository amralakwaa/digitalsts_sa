/**
 * Image Optimizer using Jimp v1.x named exports
 */
import { Jimp, JimpMime } from 'jimp';
import { readdirSync, statSync, writeFileSync } from 'fs';
import { join, extname, basename, dirname } from 'path';
import { fileURLToPath } from 'url';

const __dirname = dirname(fileURLToPath(import.meta.url));
const imagesDir = join(__dirname, 'public', 'images');

const MAX_WIDTH_HERO = 1920;
const MAX_WIDTH_LOGO = 400;
const JPEG_QUALITY = 80;

let totalSaved = 0;
let processed = 0;

async function processImage(filePath) {
    const ext = extname(filePath).toLowerCase();
    const name = basename(filePath, ext);
    
    if (!['.jpg', '.jpeg', '.png'].includes(ext)) return;
    
    const originalSize = statSync(filePath).size;
    const isLogo = name.toLowerCase().includes('logo');
    const maxW = isLogo ? MAX_WIDTH_LOGO : MAX_WIDTH_HERO;
    
    process.stdout.write(`\n📁 ${basename(filePath)} (${Math.round(originalSize / 1024)}KB) ... `);
    
    try {
        const image = await Jimp.read(filePath);
        const w = image.width;
        const h = image.height;
        
        if (w > maxW) {
            image.resize({ w: maxW });
            process.stdout.write(`📐${maxW}px `);
        }
        
        // Get buffer with quality
        const buffer = await image.getBuffer(JimpMime.jpeg, { quality: JPEG_QUALITY });
        writeFileSync(filePath, buffer);
        
        const newSize = statSync(filePath).size;
        const saved = originalSize - newSize;
        totalSaved += Math.max(0, saved);
        const pct = Math.round(saved / originalSize * 100);
        
        console.log(`✅ ${Math.round(newSize / 1024)}KB (${saved > 0 ? '-' + pct + '%' : '~same'})`);
        processed++;
    } catch (err) {
        console.log(`❌ ${err.message.split('\n')[0]}`);
    }
}

function getAllImages(dir) {
    const results = [];
    for (const item of readdirSync(dir)) {
        const fp = join(dir, item);
        const st = statSync(fp);
        if (st.isDirectory()) results.push(...getAllImages(fp));
        else if (/\.(jpg|jpeg|png)$/i.test(item)) results.push(fp);
    }
    return results;
}

const images = getAllImages(imagesDir);
console.log(`\n🚀 Compressing ${images.length} images (quality=${JPEG_QUALITY})...\n`);

for (const img of images) await processImage(img);

console.log(`\n\n✅ Done: ${processed}/${images.length} images, saved ~${Math.round(totalSaved/1024)}KB\n`);
