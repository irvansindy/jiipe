<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Exception;

class FlagImageHelper
{
    /**
     * Store flag image as WebP
     * Resize to 32x32px (icon size like Themify Icons)
     *
     * @param mixed $file - File object from request
     * @param string $locale - Language locale code
     * @return string - Filename of stored flag image
     */
    // public static function storeFlagImage($file, string $locale): string
    // {
    //     try {
    //         if (!$file || !$file->isValid()) {
    //             throw new Exception('Invalid file');
    //         }

    //         // Validate file type
    //         $mimeType = $file->getMimeType();
    //         $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];

    //         if (!in_array($mimeType, $allowedMimes)) {
    //             throw new Exception('Only image files are allowed (JPG, PNG, GIF, WebP, SVG)');
    //         }

    //         // Create image manager using GD driver
    //         $manager = new ImageManager(new Driver());
    //         $image = $manager->read($file->getRealPath());

    //         // Resize to 32x32px (cover to fill the dimensions while maintaining aspect ratio)
    //         $image->cover(32, 32);

    //         // Create directory if not exists
    //         $directory = 'flags';
    //         if (!Storage::disk('public')->exists($directory)) {
    //             Storage::disk('public')->makeDirectory($directory);
    //         }

    //         // Generate filename
    //         $filename = $locale . '_' . time() . '.webp';
    //         $path = $directory . '/' . $filename;

    //         // Encode to WebP format with quality setting (0-100, default 80)
    //         $webpContent = $image->toWebp(quality: 80);

    //         // Store the file
    //         Storage::disk('public')->put($path, (string) $webpContent);

    //         // Return only filename, path will be handled in frontend/blade
    //         return $filename;
    //     } catch (Exception $e) {
    //         throw new Exception('Failed to process flag image: ' . $e->getMessage());
    //     }
    // }
    public static function storeFlagImage($file, string $locale): string
    {
        try {
            if (!$file || !$file->isValid()) {
                throw new Exception('Invalid file');
            }

            // Validate file type
            $mimeType = $file->getMimeType();
            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];

            if (!in_array($mimeType, $allowedMimes)) {
                throw new Exception('Only image files are allowed (JPG, PNG, GIF, WebP, SVG)');
            }

            // Create image manager using GD driver
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getRealPath());

            // Resize to 32x32px
            $image->cover(32, 32);

            // Define directory path
            $directory = public_path('uploads/flags');

            // Create directory if not exists
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Generate filename
            $filename = $locale . '_' . time() . '.webp';
            $path = $directory . '/' . $filename;

            // Encode to WebP
            $webpContent = $image->toWebp(quality: 80);

            // Save file
            file_put_contents($path, (string) $webpContent);

            return $filename;

        } catch (Exception $e) {
            throw new Exception('Failed to process flag image: ' . $e->getMessage());
        }
    }

    /**
     * Delete flag image
     *
     * @param string $filename - Filename of flag image
     * @return bool
     */
    public static function deleteFlagImage(string $filename): bool
    {
        try {
            if (!$filename) {
                return true;
            }

            $path = 'flags/' . $filename;

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return true;
        } catch (Exception $e) {
            \Log::error('Failed to delete flag image: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get flag image URL from filename
     *
     * @param string $filename - Filename of flag image
     * @return string - Full URL to flag image or empty string
     */
    public static function getFlagImageUrl(string $filename): string
    {
        if (!$filename) {
            return '';
        }

        return asset('uploads/flags/' . $filename);
    }
}
