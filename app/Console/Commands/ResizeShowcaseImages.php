<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ResizeShowcaseImages extends Command
{
    protected $signature   = 'showcase:resize';
    protected $description = 'Resize gambar showcase ke multiple ukuran untuk responsive image (srcset)';

    // Target lebar yang dibutuhkan
    protected $sizes = [
        1280 => '1280',
        960  => '960',
        640  => '640',
    ];

    public function handle()
    {
        // Cek apakah Intervention Image tersedia
        if (!class_exists('\Intervention\Image\ImageManager')) {
            $this->error('Intervention Image belum diinstall!');
            $this->line('Jalankan: composer require intervention/image');
            return 1;
        }

        $showcaseDir  = public_path('uploads/showcase');
        $resizedDir   = public_path('uploads/showcase/resized');

        if (!File::exists($resizedDir)) {
            File::makeDirectory($resizedDir, 0755, true);
            $this->info("Folder dibuat: uploads/showcase/resized/");
        }

        $images = File::files($showcaseDir);
        $count  = 0;

        foreach ($images as $image) {
            $ext      = strtolower($image->getExtension());
            $filename = $image->getFilenameWithoutExtension();

            // Skip folder resized dan file non-gambar
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                continue;
            }

            $this->line("Processing: {$image->getFilename()}");

            foreach ($this->sizes as $width => $suffix) {
                $outputPath = "{$resizedDir}/{$filename}-{$suffix}.webp";

                if (File::exists($outputPath)) {
                    $this->line("  → {$filename}-{$suffix}.webp sudah ada (skip)");
                    continue;
                }

                try {
                    $manager = new \Intervention\Image\ImageManager(
                        new \Intervention\Image\Drivers\Gd\Driver()
                    );

                    $img = $manager->read($image->getPathname());

                    // Resize hanya kalau gambar asli lebih besar dari target
                    if ($img->width() > $width) {
                        $img->scale(width: $width);
                    }

                    // Convert ke WebP dengan kualitas 80 (balance antara kualitas & ukuran)
                    $img->toWebp(80)->save($outputPath);

                    $originalSize = round($image->getSize() / 1024, 1);
                    $newSize      = round(filesize($outputPath) / 1024, 1);
                    $saved        = round((1 - $newSize / $originalSize) * 100);

                    $this->info("  ✓ {$filename}-{$suffix}.webp ({$newSize} KB, hemat {$saved}% dari {$originalSize} KB)");
                    $count++;

                } catch (\Exception $e) {
                    $this->error("  ✗ Gagal: " . $e->getMessage());
                }
            }
        }

        $this->info('');
        $this->info("Selesai! {$count} file berhasil di-resize.");
        $this->info('');
        $this->info('Selanjutnya update blade showcase untuk gunakan srcset:');
        $this->info('  resized/{nama}-1280.webp 1280w,');
        $this->info('  resized/{nama}-960.webp 960w,');
        $this->info('  resized/{nama}-640.webp 640w');

        return 0;
    }
}