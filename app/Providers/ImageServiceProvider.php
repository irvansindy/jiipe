<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;          // class manager v3
use Intervention\Image\Laravel\Facades\Image; // facade v3
use Intervention\Image\Drivers\Gd\Driver;
class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // bind manager ke container
        $this->app->singleton('image', function () {
            return new ImageManager(new Driver()); // gunakan instance Driver
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
