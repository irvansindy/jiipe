<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Language;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if (app()->environment('local')) {
        //     URL::forceScheme('https');
        // }
        Schema::defaultStringLength(191);
        if (Schema::hasTable('languages')) {
            $languages = Language::all();
            if ($languages->count()) {
                $supportedLocales = [];
                foreach ($languages as $lang) {
                    $supportedLocales[$lang->locale] = [
                        'locale' => $lang->locale,
                        'name' => $lang->name,
                        'script' => $lang->script ?? 'Latn',
                        'native' => $lang->native,
                        'regional' => $lang->regional,
                    ];
                }

                config(['laravellocalization.supportedLocales' => $supportedLocales]);

                // pastikan default app locale ada di daftar
                $defaultLocale = config('app.locale');
                if (!array_key_exists($defaultLocale, $supportedLocales)) {
                    // fallback ke locale pertama yang ada
                    $first = array_key_first($supportedLocales);
                    config(['app.locale' => $first]);
                }
                // bagikan ke semua view
                View::share('languages', $supportedLocales);
            }
        }
        // Share menu ke semua view
        View::composer('*', function ($view) {
            $menus = Menu::with(['translations', 'children']) // children sudah sorted + active
                ->roots()   // <- kunci: hanya parent_id = null
                ->active()
                ->orderBy('order')
                // ->where('id', 34)
                ->get();
            $view->with('menus', $menus);
        });
    }

}
