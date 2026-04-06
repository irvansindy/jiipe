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
 */
class GenerateSliderPosters extends Command
{
    protected $signature   = 'slider:generate-posters';
    protected $description = 'Generate poster images dari video slider untuk meningkatkan LCP score';

    public function handle()
    {
        $this->info('Generating poster images dari video slider...');

        // Cek apakah FFmpeg tersedia
        exec('which ffmpeg', $output, $returnCode);
        if ($returnCode !== 0) {
            $this->error('FFmpeg tidak ditemukan! Install dulu: sudo apt-get install ffmpeg');
            return 1;
        }

        $sliders = HomeSlider::where('is_active', 1)->orderBy('id')->get();
        $publicPath = public_path();

        foreach ($sliders as $index => $slider) {
            $videoPath = $publicPath . '/uploads/home-slider/' . $slider->file;
            $posterPath = $publicPath . '/asset/images/slider-poster-' . $index . '.jpg';

            if (!file_exists($videoPath)) {
                $this->warn("Video tidak ditemukan: {$slider->file}");
                continue;
            }

            if (file_exists($posterPath)) {
                $this->line("Poster sudah ada: slider-poster-{$index}.jpg (skip)");
                continue;
            }

            // Ambil frame di detik ke-1 sebagai poster
            $cmd = "ffmpeg -i \"{$videoPath}\" -ss 00:00:01 -vframes 1 -q:v 2 \"{$posterPath}\" 2>&1";
            exec($cmd, $ffmpegOutput, $ffmpegCode);

            if ($ffmpegCode === 0 && file_exists($posterPath)) {
                $this->info("✓ Poster dibuat: slider-poster-{$index}.jpg");
            } else {
                $this->error("✗ Gagal membuat poster untuk: {$slider->file}");
                $this->line(implode("\n", $ffmpegOutput));
            }
        }

        $this->info('');
        $this->info('Selesai! Semua poster tersimpan di public/asset/images/');
        $this->info('Pastikan slider_section.blade.php sudah menggunakan atribut poster="..."');

        return 0;
    }
}