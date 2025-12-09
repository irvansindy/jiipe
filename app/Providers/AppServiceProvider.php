<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Language;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

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

        // Share menu ke semua view dengan permission filter
        View::composer('*', function ($view) {
            $user = Auth::user();

            // Jika tidak ada user yang login, return empty collection
            if (!$user) {
                $view->with('menus', collect([]));
                return;
            }

            // Load menu dengan eager loading children + filter permission
            $menus = Menu::with(['translations', 'children' => function ($query) use ($user) {
                    // Filter children berdasarkan permission
                    $query->where(function ($q) use ($user) {
                        $q->whereNull('permission')
                          ->orWhere('permission', '');

                        $userPermissions = $user->getAllPermissions()->pluck('name')->toArray();
                        if (!empty($userPermissions)) {
                            $q->orWhereIn('permission', $userPermissions);
                        }
                    });
                }])
                ->roots()
                ->active()
                ->orderBy('order')
                ->get()
                ->filter(function ($menu) use ($user) {
                    // Filter parent menu berdasarkan permission
                    if (!$menu->canAccess($user)) {
                        return false;
                    }

                    // Jika menu punya children, pastikan minimal ada 1 child yang bisa diakses
                    // Kalau tidak ada children yang bisa diakses, hide parent-nya juga
                    if ($menu->relationLoaded('children') && $menu->children->isNotEmpty()) {
                        return $menu->children->count() > 0;
                    }

                    return true;
                });

            $view->with('menus', $menus);
        });
    }
}