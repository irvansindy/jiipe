<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class ImageHelper
{
    public static function optimizeImage($imagePath, $width = null, $quality = 85)
    {
        try {
            $fullPath = public_path($imagePath);

            if (!File::exists($fullPath)) {
                throw new \Exception("File tidak ditemukan: {$fullPath}");
            }

            // ✅ Determine target WebP path
            $webpPath = preg_replace('/\.(jpg|jpeg|png|gif)$/i', '.webp', $imagePath);
            $fullWebpPath = public_path($webpPath);

            // Create directory if not exists
            $directory = dirname($fullWebpPath);
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            // ✅ Priority 1: Native PHP GD (paling hemat memory)
            if (extension_loaded('gd')) {
                try {
                    return self::convertToWebpNative($fullPath, $fullWebpPath, $width, $quality, $webpPath);
                } catch (\Exception $gdError) {
                    \Log::warning("Native GD failed: " . $gdError->getMessage());
                }
            }

            // ✅ Priority 2: ImageMagick CLI
            if (self::hasImageMagick()) {
                try {
                    return self::convertToWebpImageMagick($fullPath, $fullWebpPath, $width, $quality, $webpPath);
                } catch (\Exception $magickError) {
                    \Log::warning("ImageMagick failed: " . $magickError->getMessage());
                }
            }

            // ✅ Priority 3: Intervention Image (last resort, boros memory, max 5MB)
            try {
                $fileSize = filesize($fullPath);
                if ($fileSize > 5 * 1024 * 1024) {
                    throw new \Exception("File too large for Intervention: " . round($fileSize / 1024 / 1024, 2) . "MB");
                }

                $manager = new ImageManager(new Driver());
                $image = $manager->read($fullPath);

                if ($width && $image->width() > $width) {
                    $image->scale(width: $width);
                }

                $image->toWebp($quality)->save($fullWebpPath);
                \Log::info("Image optimized with Intervention: {$webpPath}");
                return $webpPath;

            } catch (\Exception $interventionError) {
                \Log::warning("Intervention Image failed: " . $interventionError->getMessage());
            }

            // ✅ Fallback: Copy original as WebP
            \Log::warning("No image conversion tool available, copying original file");
            return self::copyAsWebp($fullPath, $fullWebpPath, $imagePath, $webpPath);

        } catch (\Exception $e) {
            \Log::error('Image optimization error: ' . $e->getMessage());
            return $imagePath;
        }
    }

    /**
     * Check if ImageMagick convert command is available
     */
    private static function hasImageMagick()
    {
        $output = null;
        $retval = null;
        @exec('convert -version', $output, $retval);
        return $retval === 0;
    }

    /**
     * Convert using ImageMagick command line
     */
    private static function convertToWebpImageMagick($fullPath, $fullWebpPath, $width, $quality, $webpPath)
    {
        $command = "convert ";
        $command .= "-quality {$quality} ";

        if ($width) {
            $command .= "-resize {$width}x ";
        }

        $command .= escapeshellarg($fullPath) . " " . escapeshellarg($fullWebpPath);

        \Log::info("Converting with ImageMagick: {$command}");

        $output = null;
        $retval = null;
        @exec($command, $output, $retval);

        if ($retval === 0 && File::exists($fullWebpPath)) {
            \Log::info("Image optimized with ImageMagick: {$webpPath}");
            return $webpPath;
        }

        throw new \Exception("ImageMagick conversion failed with return code {$retval}");
    }

    /**
     * Convert image to WebP using native PHP GD functions (no library needed)
     */
    private static function convertToWebpNative($fullPath, $fullWebpPath, $width, $quality, $webpPath)
{
    $imageInfo = @getimagesize($fullPath);
    if (!$imageInfo) {
        throw new \Exception("Cannot read image: {$fullPath}");
    }

    [$srcWidth, $srcHeight, $imageType] = $imageInfo;

    // Hitung memory yang BENAR-BENAR dibutuhkan
    // PNG butuh lebih banyak karena ada alpha channel
    $channels = ($imageType === IMAGETYPE_PNG) ? 4 : 3;
    $memoryNeededBytes = $srcWidth * $srcHeight * $channels * 2; // x2 untuk src + dst
    $memoryNeededMB = (int)ceil($memoryNeededBytes / 1024 / 1024) + 64;

    // Hard limit: tolak gambar yang butuh > 800MB
    if ($memoryNeededMB > 800) {
        throw new \Exception("Image too large to process safely: needs ~{$memoryNeededMB}MB RAM ({$srcWidth}x{$srcHeight}px)");
    }

    ini_set('memory_limit', "{$memoryNeededMB}M");
    \Log::info("Set memory to {$memoryNeededMB}M for {$srcWidth}x{$srcHeight} image");

    $source = match ($imageType) {
        IMAGETYPE_JPEG => @imagecreatefromjpeg($fullPath),
        IMAGETYPE_PNG  => @imagecreatefrompng($fullPath),
        IMAGETYPE_GIF  => @imagecreatefromgif($fullPath),
        IMAGETYPE_WEBP => @imagecreatefromwebp($fullPath),
        default        => throw new \Exception("Unsupported image type: {$imageType}"),
    };

    if (!$source) {
        throw new \Exception("Failed to load image: {$fullPath}");
    }

    // Tentukan dimensi output
    $targetWidth  = ($width && $srcWidth > $width) ? $width : $srcWidth;
    $targetHeight = (int)($srcHeight * ($targetWidth / $srcWidth));

    $dest = imagecreatetruecolor($targetWidth, $targetHeight);

    if ($imageType === IMAGETYPE_PNG) {
        imagealphablending($dest, false);
        imagesavealpha($dest, true);
        $transparent = imagecolorallocatealpha($dest, 255, 255, 255, 127);
        imagefilledrectangle($dest, 0, 0, $targetWidth, $targetHeight, $transparent);
    }

    imagecopyresampled($dest, $source, 0, 0, 0, 0, $targetWidth, $targetHeight, $srcWidth, $srcHeight);
    imagedestroy($source); // Bebaskan source segera

    $success = @imagewebp($dest, $fullWebpPath, $quality);
    imagedestroy($dest);
    gc_collect_cycles();

    if (!$success) {
        throw new \Exception("Failed to save WebP: {$fullWebpPath}");
    }

    \Log::info("✓ Native GD success: {$webpPath}");
    return $webpPath;
}

    /**
     * Fallback: Copy original file as WebP (binary copy)
     */
    private static function copyAsWebp($fullPath, $fullWebpPath, $originalPath, $webpPath)
    {
        if (File::copy($fullPath, $fullWebpPath)) {
            \Log::info("File copied as WebP (no conversion): {$webpPath}");
            return $webpPath;
        }

        throw new \Exception("Failed to copy file as WebP");
    }

    /**
     * Upload file dan langsung optimize
     */
    public static function uploadAndOptimize($uploadedFile, $directory = 'images', $width = null)
    {
        $filename = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $path     = $directory . '/' . $filename;

        $uploadedFile->move(public_path($directory), $filename);

        return self::optimizeImage($path, $width);
    }
}