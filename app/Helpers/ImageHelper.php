<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;  // Pakai GD Driver
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

            // ✅ V3 Syntax - Create ImageManager
            $manager = new ImageManager(new Driver());

            // ✅ V3 Syntax - read() instead of make()
            $image = $manager->read($fullPath);

            // ✅ V3 Syntax - scale() instead of resize()
            if ($width && $image->width() > $width) {
                $image->scale(width: $width);
            }

            $webpPath = preg_replace('/\.(jpg|jpeg|png|gif)$/i', '.webp', $imagePath);
            $fullWebpPath = public_path($webpPath);

            $directory = dirname($fullWebpPath);
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            // ✅ V3 Syntax - toWebp() instead of encode('webp')
            $image->toWebp($quality)->save($fullWebpPath);

            return $webpPath;

        } catch (\Exception $e) {
            \Log::error('Image optimization error: ' . $e->getMessage());
            return $imagePath;
        }
    }

    public static function uploadAndOptimize($uploadedFile, $directory = 'images', $width = null)
    {
        $filename = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $path = $directory . '/' . $filename;

        $uploadedFile->move(public_path($directory), $filename);

        return self::optimizeImage($path, $width);
    }
}
