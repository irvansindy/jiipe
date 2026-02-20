<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageOptimizer
{
    /**
     * Optimize tenant logo dengan auto-resize dan compress
     * ULTRA-SAFE VERSION - Uses native PHP GD for large files
     *
     * @param string $imagePath - Path dari storage (uploads/tenant-logo/xxx.png)
     * @param string $size - thumbnail|small|medium|large
     * @param bool $forceRegenerate - Force regenerate meskipun sudah ada cache
     * @return string - Path ke optimized image
     */
    public static function optimizeTenantLogo($imagePath, $size = 'thumbnail', $forceRegenerate = false)
    {
        // Cache key berdasarkan path dan size
        $cacheKey = 'img_' . md5($imagePath . $size);

        // Check cache dulu (kecuali force regenerate)
        if (!$forceRegenerate) {
            $cachedPath = Cache::get($cacheKey);
            if ($cachedPath && self::fileExists($cachedPath)) {
                return $cachedPath;
            }
        }

        // Process image
        $optimizedPath = self::processImage($imagePath, $size);

        // Cache result
        Cache::put($cacheKey, $optimizedPath, 86400); // 24 hours

        return $optimizedPath;
    }

    /**
     * Process image resize & compress
     * ULTRA-SAFE: Bypass Intervention Image for files > 2MB
     */
    protected static function processImage($imagePath, $size)
    {
        // Definisi ukuran berdasarkan kebutuhan di UI
        $dimensions = [
            'thumbnail' => ['width' => 200, 'quality' => 80],
            'small' => ['width' => 300, 'quality' => 85],
            'medium' => ['width' => 600, 'quality' => 85],
            'large' => ['width' => 1200, 'quality' => 90],
        ];

        $config = $dimensions[$size] ?? $dimensions['thumbnail'];

        // Convert storage path ke public path
        $publicPath = str_replace('storage/app/public/', '', $imagePath);
        $publicPath = str_replace('uploads/', 'uploads/', $publicPath);

        // Full path check
        $fullPath = public_path($publicPath);

        // Jika file di storage, copy ke public dulu
        if (!file_exists($fullPath)) {
            $storagePath = storage_path('app/public/' . $publicPath);
            if (file_exists($storagePath)) {
                $directory = dirname($fullPath);
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }
                File::copy($storagePath, $fullPath);
            } else {
                \Log::error("Image not found: {$publicPath}");
                return $imagePath;
            }
        }

        // ⚡ CHECK FILE SIZE
        $fileSize = filesize($fullPath);
        $fileSizeMB = round($fileSize / 1024 / 1024, 2);

        // Generate optimized paths
        $pathInfo = pathinfo($publicPath);
        $optimizedFileName = $pathInfo['filename'] . '_' . $size . '.webp'; // Always WebP
        $optimizedPath = $pathInfo['dirname'] . '/optimized/' . $optimizedFileName;
        $optimizedFullPath = public_path($optimizedPath);

        // Create directory jika belum ada
        $optimizedDir = dirname($optimizedFullPath);
        if (!File::exists($optimizedDir)) {
            File::makeDirectory($optimizedDir, 0755, true);
        }

        // Cek jika optimized version sudah ada
        if (file_exists($optimizedFullPath)) {
            return $optimizedPath;
        }

        // ⚡⚡⚡ STRATEGY BASED ON FILE SIZE

        // 1. SKIP files > 10MB completely
        if ($fileSize > 10 * 1024 * 1024) {
            \Log::warning("⚠ Image too large ({$fileSizeMB}MB), skipping: {$publicPath}");
            return $imagePath; // Return original
        }

        // 2. Files > 2MB: Use NATIVE PHP GD (bypass ImageHelper & Intervention)
        if ($fileSize > 2 * 1024 * 1024) {
            \Log::info("📦 Large file ({$fileSizeMB}MB), using native PHP GD: {$publicPath}");
            return self::processWithNativeGD($fullPath, $optimizedFullPath, $config['width'], $config['quality'], $optimizedPath, $imagePath);
        }

        // 3. Files < 2MB: Use ImageHelper (with Intervention)
        try {
            // Increase memory limit temporarily
            $originalMemoryLimit = ini_get('memory_limit');
            ini_set('memory_limit', '256M');

            $webpPath = \App\Helpers\ImageHelper::optimizeImage(
                $publicPath,
                $config['width'],
                $config['quality']
            );

            // Restore memory limit
            ini_set('memory_limit', $originalMemoryLimit);

            // Free memory
            if (function_exists('gc_collect_cycles')) {
                gc_collect_cycles();
            }

            // Copy to optimized folder
            if ($webpPath && file_exists(public_path($webpPath))) {
                File::copy(public_path($webpPath), $optimizedFullPath);
                \Log::info("✓ Optimized with ImageHelper: {$optimizedPath}");
                return $optimizedPath;
            }

            return $publicPath;

        } catch (\Exception $e) {
            \Log::error("ImageHelper failed: {$e->getMessage()}. Trying native GD...");

            // Fallback to native GD
            return self::processWithNativeGD($fullPath, $optimizedFullPath, $config['width'], $config['quality'], $optimizedPath, $imagePath);
        }
    }

    /**
     * ⚡ Process with NATIVE PHP GD (most memory-efficient)
     * NO Intervention Image, NO ImageHelper
     */
    protected static function processWithNativeGD($inputPath, $outputPath, $maxWidth, $quality, $relativePath, $fallbackPath)
    {
        try {
            // Get image info
            $imageInfo = @getimagesize($inputPath);
            if (!$imageInfo) {
                \Log::error("Cannot read image info: {$inputPath}");
                return $fallbackPath;
            }

            list($originalWidth, $originalHeight, $imageType) = $imageInfo;

            // Calculate new dimensions
            if ($originalWidth <= $maxWidth) {
                $newWidth = $originalWidth;
                $newHeight = $originalHeight;
            } else {
                $ratio = $maxWidth / $originalWidth;
                $newWidth = $maxWidth;
                $newHeight = (int)($originalHeight * $ratio);
            }

            // ⚡ INCREASE MEMORY based on image size
            $memoryNeeded = (int)(($originalWidth * $originalHeight * 4) / 1024 / 1024) + 64; // MB
            $currentLimit = (int)ini_get('memory_limit');
            if ($memoryNeeded > $currentLimit) {
                $newLimit = min($memoryNeeded + 128, 512); // Cap at 512MB
                ini_set('memory_limit', "{$newLimit}M");
                \Log::info("Increased memory to {$newLimit}M for large image");
            }

            // Load source image based on type
            $source = null;
            switch ($imageType) {
                case IMAGETYPE_JPEG:
                    $source = @imagecreatefromjpeg($inputPath);
                    break;
                case IMAGETYPE_PNG:
                    $source = @imagecreatefrompng($inputPath);
                    break;
                case IMAGETYPE_GIF:
                    $source = @imagecreatefromgif($inputPath);
                    break;
                case IMAGETYPE_WEBP:
                    $source = @imagecreatefromwebp($inputPath);
                    break;
                default:
                    \Log::error("Unsupported image type: {$imageType}");
                    return $fallbackPath;
            }

            if (!$source) {
                \Log::error("Failed to load image: {$inputPath}");
                return $fallbackPath;
            }

            // Create new image
            $dest = imagecreatetruecolor($newWidth, $newHeight);
            if (!$dest) {
                imagedestroy($source);
                \Log::error("Failed to create destination image");
                return $fallbackPath;
            }

            // Preserve transparency for PNG
            if ($imageType === IMAGETYPE_PNG) {
                imagealphablending($dest, false);
                imagesavealpha($dest, true);
                $transparent = imagecolorallocatealpha($dest, 255, 255, 255, 127);
                imagefilledrectangle($dest, 0, 0, $newWidth, $newHeight, $transparent);
            }

            // Resize
            $success = imagecopyresampled($dest, $source, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

            if (!$success) {
                imagedestroy($source);
                imagedestroy($dest);
                \Log::error("Failed to resize image");
                return $fallbackPath;
            }

            // Save as WebP
            $saved = @imagewebp($dest, $outputPath, $quality);

            // Cleanup
            imagedestroy($source);
            imagedestroy($dest);

            // Free memory
            if (function_exists('gc_collect_cycles')) {
                gc_collect_cycles();
            }

            if ($saved && file_exists($outputPath)) {
                $savedSize = round(filesize($outputPath) / 1024, 2);
                \Log::info("✓ Optimized with native GD: {$relativePath} ({$savedSize}KB)");
                return $relativePath;
            }

            \Log::error("Failed to save WebP: {$outputPath}");
            return $fallbackPath;

        } catch (\Exception $e) {
            \Log::error("Native GD processing failed: {$e->getMessage()}");

            // Free memory on error
            if (function_exists('gc_collect_cycles')) {
                gc_collect_cycles();
            }

            return $fallbackPath;
        }
    }

    /**
     * Generate WebP version untuk modern browsers
     */
    public static function generateWebP($imagePath)
    {
        try {
            $publicPath = str_replace('storage/app/public/', '', $imagePath);
            $publicPath = str_replace('uploads/', 'uploads/', $publicPath);

            if (pathinfo($publicPath, PATHINFO_EXTENSION) === 'webp') {
                return $publicPath;
            }

            $fullPath = public_path($publicPath);
            if (!file_exists($fullPath)) {
                return null;
            }

            $fileSize = filesize($fullPath);

            // Skip files > 10MB
            if ($fileSize > 10 * 1024 * 1024) {
                return null;
            }

            // Use native GD for files > 2MB
            if ($fileSize > 2 * 1024 * 1024) {
                $pathInfo = pathinfo($publicPath);
                $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
                $webpFullPath = public_path($webpPath);

                if (file_exists($webpFullPath)) {
                    return $webpPath;
                }

                return self::processWithNativeGD($fullPath, $webpFullPath, 800, 85, $webpPath, null);
            }

            // Use ImageHelper for small files
            $webpPath = \App\Helpers\ImageHelper::optimizeImage($publicPath);

            if ($webpPath && file_exists(public_path($webpPath))) {
                return $webpPath;
            }

            return null;

        } catch (\Exception $e) {
            \Log::error('WebP generation failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Batch optimize all tenant logos
     */
    public static function batchOptimizeTenantLogos($directory = 'uploads/tenant-logo', $chunkSize = 3)
    {
        $processed = 0;
        $failed = 0;
        $skipped = 0;

        $publicDir = public_path($directory);

        if (!File::exists($publicDir)) {
            \Log::warning("Directory not found: {$publicDir}");
            return [
                'processed' => 0,
                'failed' => 0,
                'skipped' => 0,
                'total' => 0
            ];
        }

        $files = File::files($publicDir);
        $total = count($files);

        // Sort by size (smallest first)
        usort($files, function($a, $b) {
            return $a->getSize() - $b->getSize();
        });

        $chunks = array_chunk($files, $chunkSize);

        foreach ($chunks as $chunkIndex => $chunk) {
            foreach ($chunk as $file) {
                $filename = $file->getFilename();

                // Skip already optimized
                if (strpos($filename, '_thumbnail') !== false ||
                    strpos($filename, '_small') !== false ||
                    strpos($filename, '_medium') !== false ||
                    strpos($filename, '_large') !== false ||
                    pathinfo($filename, PATHINFO_EXTENSION) === 'webp') {
                    $skipped++;
                    continue;
                }

                $fileSize = $file->getSize();
                $fileSizeMB = round($fileSize / 1024 / 1024, 2);

                // Skip files > 10MB
                if ($fileSize > 10 * 1024 * 1024) {
                    \Log::warning("⚠ Skipped (too large): {$filename} ({$fileSizeMB}MB)");
                    $skipped++;
                    continue;
                }

                $relativePath = $directory . '/' . $filename;

                try {
                    self::optimizeTenantLogo($relativePath, 'thumbnail', true);
                    $processed++;
                    echo "✓ {$filename} ({$fileSizeMB}MB)\n";

                } catch (\Exception $e) {
                    \Log::error("✗ Failed: {$filename} - {$e->getMessage()}");
                    $failed++;
                    echo "✗ {$filename} - ERROR\n";
                }
            }

            // Free memory after each chunk
            if (function_exists('gc_collect_cycles')) {
                gc_collect_cycles();
            }

            // Pause between chunks
            if ($chunkIndex < count($chunks) - 1) {
                usleep(200000); // 200ms
            }
        }

        return [
            'processed' => $processed,
            'failed' => $failed,
            'skipped' => $skipped,
            'total' => $total
        ];
    }

    /**
     * Clear image cache
     */
    public static function clearCache()
    {
        Cache::flush();
        \Log::info('Image cache cleared');
    }

    /**
     * Check if file exists
     */
    protected static function fileExists($path)
    {
        if (file_exists(public_path($path))) {
            return true;
        }

        $storagePath = str_replace('uploads/', 'storage/app/public/uploads/', $path);
        if (file_exists($storagePath)) {
            return true;
        }

        return false;
    }

    /**
     * Get optimized image URL
     */
    public static function getOptimizedUrl($originalPath, $size = 'thumbnail')
    {
        $optimizedPath = self::optimizeTenantLogo($originalPath, $size);
        return asset($optimizedPath);
    }
}