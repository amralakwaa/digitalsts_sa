<?php
/**
 * Image Optimizer Script
 * Compresses JPG images and creates WebP versions for maximum performance
 */

$imagesDir = __DIR__ . '/public/images';
$quality = 75; // JPEG quality (good balance between quality and size)
$webpQuality = 80; // WebP quality

function optimizeImage($sourcePath, $quality, $webpQuality) {
    $info = getimagesize($sourcePath);
    if (!$info) {
        echo "  ⚠️  Cannot read: " . basename($sourcePath) . "\n";
        return;
    }
    
    $mimeType = $info['mime'];
    $width = $info[0];
    $height = $info[1];
    $originalSize = filesize($sourcePath);
    
    // Load image
    switch ($mimeType) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($sourcePath);
            break;
        case 'image/png':
            $image = imagecreatefrompng($sourcePath);
            break;
        default:
            echo "  ⏭  Skipping (unsupported type): " . basename($sourcePath) . "\n";
            return;
    }
    
    if (!$image) {
        echo "  ⚠️  Failed to load: " . basename($sourcePath) . "\n";
        return;
    }
    
    // Resize if too large (max width 1920px for hero images)
    $maxWidth = 1920;
    if ($width > $maxWidth) {
        $ratio = $maxWidth / $width;
        $newWidth = $maxWidth;
        $newHeight = (int)($height * $ratio);
        $resized = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagedestroy($image);
        $image = $resized;
        echo "  📐 Resized: {$width}x{$height} → {$newWidth}x{$newHeight}\n";
    }
    
    // Save optimized JPEG
    imagejpeg($image, $sourcePath, $quality);
    $newSize = filesize($sourcePath);
    $savings = round(($originalSize - $newSize) / $originalSize * 100);
    echo "  ✅ JPEG optimized: " . basename($sourcePath) . " | " . round($originalSize/1024) . "KB → " . round($newSize/1024) . "KB (-{$savings}%)\n";
    
    // Create WebP version
    $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $sourcePath);
    if (function_exists('imagewebp')) {
        imagewebp($image, $webpPath, $webpQuality);
        $webpSize = filesize($webpPath);
        $webpSavings = round(($originalSize - $webpSize) / $originalSize * 100);
        echo "  🌐 WebP created: " . basename($webpPath) . " | " . round($webpSize/1024) . "KB (-{$webpSavings}% vs original)\n";
    }
    
    imagedestroy($image);
}

echo "\n🚀 STS Image Optimizer\n";
echo str_repeat("=", 50) . "\n\n";

// Check GD support
if (!extension_loaded('gd')) {
    die("❌ GD extension is not available!\n");
}

$gdInfo = gd_info();
echo "✅ GD Version: " . $gdInfo['GD Version'] . "\n";
echo "✅ WebP Support: " . ($gdInfo['WebP Support'] ? 'Yes' : 'No') . "\n\n";

// Process all images in public/images (recursively)
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($imagesDir, RecursiveDirectoryIterator::SKIP_DOTS)
);

$processed = 0;
foreach ($iterator as $file) {
    if (preg_match('/\.(jpg|jpeg|png)$/i', $file->getFilename())) {
        // Skip already processed webp sources
        echo "📁 Processing: " . $file->getFilename() . "\n";
        optimizeImage($file->getPathname(), $quality, $webpQuality);
        $processed++;
        echo "\n";
    }
}

echo str_repeat("=", 50) . "\n";
echo "✅ Done! Processed {$processed} images.\n\n";
