<?php

namespace App\Helpers;

class ShowcaseImageHelper
{
    /**
     * Generate srcset string untuk gambar showcase.
     *
     * Penggunaan di blade:
     *   {!! \App\Helpers\ShowcaseImageHelper::srcset($showcase['image']) !!}
     *
     * Output contoh:
     *   /uploads/showcase/resized/foto-1280.webp 1280w,
     *   /uploads/showcase/resized/foto-960.webp 960w,
     *   /uploads/showcase/foto.webp 1920w
     */
    public static function srcset(string $imageName): string
    {
        $nameWithoutExt = pathinfo($imageName, PATHINFO_FILENAME);
        $resizedBase    = 'uploads/showcase/resized';

        $srcset = [];

        // Cek apakah versi resize tersedia
        foreach ([1280, 960, 640] as $width) {
            $resizedPath = public_path("{$resizedBase}/{$nameWithoutExt}-{$width}.webp");

            if (file_exists($resizedPath)) {
                $srcset[] = asset("{$resizedBase}/{$nameWithoutExt}-{$width}.webp") . " {$width}w";
            }
        }

        // Tambahkan gambar asli sebagai fallback terbesar
        $srcset[] = asset("uploads/showcase/{$imageName}") . " 1920w";

        return implode(', ', $srcset);
    }

    /**
     * Cek apakah versi WebP dari gambar tersedia
     */
    public static function hasWebP(string $imageName): bool
    {
        $nameWithoutExt = pathinfo($imageName, PATHINFO_FILENAME);
        return file_exists(public_path("uploads/showcase/resized/{$nameWithoutExt}-1280.webp"));
    }
}