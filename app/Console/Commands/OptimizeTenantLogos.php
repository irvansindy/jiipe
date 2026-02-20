<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\ImageOptimizer;

class OptimizeTenantLogos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:optimize-logos
                            {--clear-cache : Clear image cache before optimization}
                            {--force : Force re-optimization of already optimized images}
                            {--chunk-size=5 : Number of images to process per chunk (lower = safer memory)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Batch optimize all tenant logos (resize + compress + WebP) - Memory Safe';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting tenant logo optimization...');
        $this->info('⚡ Memory-safe mode with chunking');
        $this->newLine();

        // Show current memory limit
        $memoryLimit = ini_get('memory_limit');
        $this->info("📊 Current memory limit: {$memoryLimit}");
        $this->newLine();

        // Clear cache if requested
        if ($this->option('clear-cache')) {
            $this->info('🧹 Clearing image cache...');
            ImageOptimizer::clearCache();
            $this->info('✓ Cache cleared');
            $this->newLine();
        }

        // Get chunk size
        $chunkSize = (int) $this->option('chunk-size');
        $this->info("⚙️  Processing {$chunkSize} images per chunk");
        $this->newLine();

        // Start optimization
        $this->info('🔄 Processing images...');

        try {
            $result = ImageOptimizer::batchOptimizeTenantLogos('uploads/tenant-logo', $chunkSize);

            $this->newLine(2);

            // Display results
            $this->info('✅ Optimization completed!');
            $this->newLine();

            $this->table(
                ['Metric', 'Count'],
                [
                    ['Total Images Found', $result['total']],
                    ['✓ Processed', $result['processed']],
                    ['⚠ Skipped (too large or already optimized)', $result['skipped']],
                    ['✗ Failed', $result['failed']],
                ]
            );

            $this->newLine();

            // Success rate
            if ($result['total'] > 0) {
                $successRate = round(($result['processed'] / ($result['total'] - $result['skipped'])) * 100, 1);
                $this->info("📊 Success Rate: {$successRate}%");
                $this->newLine();
            }

            // Tips
            $this->info('💡 Tips:');
            $this->line('  - Optimized images saved in /uploads/tenant-logo/optimized/');
            $this->line('  - WebP versions created for modern browsers');
            $this->line('  - Use <x-tenant-logo> component to display optimized images');
            $this->newLine();

            // If there were failures
            if ($result['failed'] > 0) {
                $this->warn('⚠ Some images failed to optimize. Check logs for details.');
                $this->line('  Run: tail -f storage/logs/laravel.log');
                $this->newLine();
            }

            // If many were skipped
            if ($result['skipped'] > ($result['total'] / 2)) {
                $this->warn('⚠ Many images were skipped (too large or already optimized).');
                $this->line('  - Large images (>10MB) are automatically skipped');
                $this->line('  - Already optimized images are skipped');
                $this->line('  - Use --force flag to re-optimize existing images');
                $this->newLine();
            }

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Error during optimization:');
            $this->error($e->getMessage());
            $this->newLine();

            $this->warn('💡 Try these solutions:');
            $this->line('  1. Reduce chunk size: php artisan images:optimize-logos --chunk-size=3');
            $this->line('  2. Increase PHP memory: php -d memory_limit=512M artisan images:optimize-logos');
            $this->line('  3. Process images manually one by one');

            return Command::FAILURE;
        }
    }
}