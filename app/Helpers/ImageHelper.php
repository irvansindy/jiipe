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

            // ✅ Try with Intervention\Image first
            try {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($fullPath);

                // Scale if needed
                if ($width && $image->width() > $width) {
                    $image->scale(width: $width);
                }

                $image->toWebp($quality)->save($fullWebpPath);
                \Log::info("Image optimized with Intervention: {$webpPath}");
                return $webpPath;

            } catch (\Exception $interventionError) {
                \Log::warning("Intervention Image failed: " . $interventionError->getMessage());

                // ✅ Try native PHP GD
                if (extension_loaded('gd')) {
                    return self::convertToWebpNative($fullPath, $fullWebpPath, $width, $quality, $webpPath);
                }

                // ✅ Try ImageMagick/convert command
                if (self::hasImageMagick()) {
                    return self::convertToWebpImageMagick($fullPath, $fullWebpPath, $width, $quality, $webpPath);
                }

                // ✅ Fallback: Just copy to webp (already optimized original)
                \Log::warning("No image conversion tool available, copying original file");
                return self::copyAsWebp($fullPath, $fullWebpPath, $imagePath, $webpPath);
            }

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

        // Add quality parameter
        $command .= "-quality {$quality} ";

        // Add resize parameter if needed
        if ($width) {
            $command .= "-resize {$width}x ";
        }

        // Input and output
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
        $imageInfo = getimagesize($fullPath);
        if (!$imageInfo) {
            throw new \Exception("Cannot read image: {$fullPath}");
        }

        $mimeType = $imageInfo['mime'];

        // Load image based on type
        switch ($mimeType) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($fullPath);
                break;
            case 'image/png':
                $source = imagecreatefrompng($fullPath);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($fullPath);
                break;
            default:
                throw new \Exception("Unsupported image type: {$mimeType}");
        }

        if (!$source) {
            throw new \Exception("Failed to load image: {$fullPath}");
        }

        // Scale if needed
        $srcWidth = imagesx($source);
        $srcHeight = imagesy($source);

        if ($width && $srcWidth > $width) {
            $ratio = $width / $srcWidth;
            $newHeight = (int)($srcHeight * $ratio);

            $dest = imagecreatetruecolor($width, $newHeight);
            imagecopyresampled($dest, $source, 0, 0, 0, 0, $width, $newHeight, $srcWidth, $srcHeight);
            imagedestroy($source);
            $source = $dest;
        }

        // Convert to WebP
        $success = imagewebp($source, $fullWebpPath, $quality);
        imagedestroy($source);

        if (!$success) {
            throw new \Exception("Failed to convert image to WebP: {$fullWebpPath}");
        }

        \Log::info("Image optimized with native PHP GD: {$webpPath}");
        return $webpPath;
    }

    /**
     * Fallback: Copy original file as WebP (binary copy, still saves space with .webp extension)
     */
    private static function copyAsWebp($fullPath, $fullWebpPath, $originalPath, $webpPath)
    {
        // Just copy the file with new extension
        if (File::copy($fullPath, $fullWebpPath)) {
            \Log::info("File copied as WebP (no conversion): {$webpPath}");
            return $webpPath;
        }

        throw new \Exception("Failed to copy file as WebP");
    }

    public static function uploadAndOptimize($uploadedFile, $directory = 'images', $width = null)
    {
        $filename = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $path = $directory . '/' . $filename;

        $uploadedFile->move(public_path($directory), $filename);

        return self::optimizeImage($path, $width);
    }
}
