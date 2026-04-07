<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HomeSlider;

/**
 * Jalankan: php artisan slider:generate-posters
 *
 * Prerequisite: FFmpeg harus terinstall di server
 * Ubuntu: sudo apt-get install ffmpeg
 * CentOS: sudo yum install ffmpeg
 *
 * Output: WebP, max 200KB per file
 */
class GenerateSliderPosters extends Command
{
    protected $signature   = 'slider:generate-posters {--force : Overwrite poster yang sudah ada}';
    protected $description = 'Generate poster WebP dari video slider (max 200KB) untuk meningkatkan LCP score';

    // Target max size dalam bytes (200 KB)
    const MAX_SIZE_BYTES = 200 * 1024;

    // Kualitas awal WebP, akan diturunkan bertahap kalau masih > 200KB
    const QUALITY_START = 80;
    const QUALITY_MIN   = 30;
    const QUALITY_STEP  = 10;

    public function handle()
    {
        $this->info('Generating poster WebP dari video slider...');
        $this->line('');

        // Cek FFmpeg
        exec('which ffmpeg', $output, $returnCode);
        if ($returnCode !== 0) {
            $this->error('FFmpeg tidak ditemukan! Install dulu: sudo apt-get install ffmpeg');
            return 1;
        }

        $sliders    = HomeSlider::where('is_active', 1)->orderBy('id')->get();
        $publicPath = public_path();
        $force      = $this->option('force');

        if ($sliders->isEmpty()) {
            $this->warn('Tidak ada slider aktif ditemukan.');
            return 0;
        }

        $this->info("Ditemukan {$sliders->count()} slider aktif.");
        $this->line('');

        foreach ($sliders as $index => $slider) {
            $videoPath  = $publicPath . '/uploads/home-slider/' . $slider->file;
            $posterPath = $publicPath . '/asset/images/slider-poster-' . $index . '.webp';

            $this->line("── Slider #{$index}: {$slider->file}");

            if (!file_exists($videoPath)) {
                $this->warn("   Video tidak ditemukan, skip.");
                continue;
            }

            if (file_exists($posterPath) && !$force) {
                $existingSize = round(filesize($posterPath) / 1024, 1);
                $this->line("   Poster sudah ada ({$existingSize} KB). Gunakan --force untuk overwrite.");
                continue;
            }

            $success = $this->generateWebPPoster($videoPath, $posterPath);

            if (!$success) {
                $this->error("   Gagal generate poster untuk slider #{$index}.");
            }

            $this->line('');
        }

        $this->info('Selesai! Poster tersimpan di public/asset/images/');
        $this->info('Pastikan slider_section.blade.php memakai:');
        $this->info('  poster="{{ asset(\'asset/images/slider-poster-X.webp\') }}"');

        return 0;
    }

    /**
     * Generate poster WebP dari video.
     * Kualitas diturunkan otomatis sampai ukuran file <= 200 KB.
     */
    private function generateWebPPoster(string $videoPath, string $posterPath): bool
    {
        // File JPG sementara di /tmp
        $tempJpg = sys_get_temp_dir() . '/slider_poster_' . uniqid() . '.jpg';

        // Step 1: Extract frame dari detik ke-1 sebagai JPG sementara
        $cmdExtract = "ffmpeg -y -i \"{$videoPath}\" -ss 00:00:01 -vframes 1 -q:v 1 \"{$tempJpg}\" 2>&1";
        exec($cmdExtract, $extractOutput, $extractCode);

        if ($extractCode !== 0 || !file_exists($tempJpg)) {
            $this->error('   Gagal extract frame dari video.');
            $this->line('   ' . implode("\n   ", array_slice($extractOutput, -5)));
            return false;
        }

        $this->line('   Frame berhasil di-extract dari video.');

        // Step 2: Convert JPG → WebP, turunkan kualitas sampai <= 200 KB
        $quality = self::QUALITY_START;
        $success = false;

        while ($quality >= self::QUALITY_MIN) {
            $this->line("   Encode WebP kualitas {$quality}...");

            // Coba encode WebP via FFmpeg (butuh libwebp)
            $cmdWebP = "ffmpeg -y -i \"{$tempJpg}\" -q:v {$quality} \"{$posterPath}\" 2>&1";
            exec($cmdWebP, $webpOutput, $webpCode);

            // Jika FFmpeg gagal (libwebp tidak ada), coba cwebp
            if ($webpCode !== 0 || !file_exists($posterPath) || filesize($posterPath) === 0) {
                $this->line("   FFmpeg WebP gagal, mencoba cwebp...");
                $cmdCwebp = "cwebp -q {$quality} \"{$tempJpg}\" -o \"{$posterPath}\" 2>&1";
                exec($cmdCwebp, $cwebpOutput, $cwebpCode);

                if ($cwebpCode !== 0 || !file_exists($posterPath) || filesize($posterPath) === 0) {
                    $this->error("   Encoder WebP tidak tersedia (FFmpeg libwebp & cwebp keduanya gagal).");
                    $this->line("   Install salah satu: sudo apt-get install webp");
                    break;
                }
            }

            $fileSize   = filesize($posterPath);
            $fileSizeKb = round($fileSize / 1024, 1);

            if ($fileSize <= self::MAX_SIZE_BYTES) {
                $this->info("   ✓ Berhasil: slider-poster-{$this->getIndex($posterPath)}.webp = {$fileSizeKb} KB (kualitas {$quality})");
                $success = true;
                break;
            }

            $this->line("   Ukuran {$fileSizeKb} KB masih > 200 KB, turunkan kualitas ke " . ($quality - self::QUALITY_STEP) . "...");
            $quality -= self::QUALITY_STEP;
        }

        // Kalau sudah di kualitas minimum tapi masih > 200KB,
        // tetap simpan — lebih baik ada poster daripada tidak ada
        if (!$success && file_exists($posterPath) && filesize($posterPath) > 0) {
            $fileSizeKb = round(filesize($posterPath) / 1024, 1);
            $this->warn("   ⚠ Kualitas minimum tercapai. Ukuran akhir: {$fileSizeKb} KB.");
            $success = true;
        }

        // Hapus temp JPG
        if (file_exists($tempJpg)) {
            unlink($tempJpg);
        }

        return $success;
    }

    private function getIndex(string $posterPath): string
    {
        preg_match('/slider-poster-(\d+)\.webp$/', $posterPath, $matches);
        return $matches[1] ?? '?';
    }
}