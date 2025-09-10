<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
// admin side
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsAndArticleController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\MenuPermissionController;
use App\Http\Controllers\Admin\FormAppointment;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ZoneController;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // 🔹 Fortify routes dengan prefix section-admin
    Route::group(['prefix' => 'section-admin', 'middleware' => config('fortify.middleware', ['web'])], function () {
        // login
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->middleware(['guest'])
            ->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])
            ->middleware(['guest']);
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

    });

    // Route::get('/dashboard', function () {
    //     return view('layouts.admin.dashboard.index');
    // })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/news-blog', [NewsAndArticleController::class, 'index'])->name('news-blog');
    Route::get('/career', [CareerController::class, 'index'])->name('career');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/menu-permission', [MenuPermissionController::class, 'index'])->name('menu-permission');
        Route::get('/fetch-menu-permission', [MenuPermissionController::class, 'fetchData'])->name('fetch-menu-permission');
        Route::get('/fetch-menu-permission-v2', [MenuPermissionController::class, 'fetchMenu'])->name('fetch-menu-permission-v2');
        Route::get('/fetch-detail-menu', [MenuPermissionController::class, 'showData'])->name('fetch-detail-menu');
        Route::get('/fetch-child-menu', [MenuPermissionController::class, 'getChildMenus'])->name('fetch-child-menu');
        Route::get('/fetch-parent-menu', [MenuPermissionController::class, 'getChildMenus'])->name('fetch-parent-menu');
        Route::post('/store-menu-permission', [MenuPermissionController::class, 'storeData'])->name('store-menu-permission');
        Route::post('/update-menu-permission', [MenuPermissionController::class, 'updateData'])->name('update-menu-permission');
        
        Route::get('/list-appointment', [FormAppointment::class, 'index'])->name('list-appointment');
        Route::get('/form-appointment', [FormAppointment::class, 'formView'])->name('form-appointment');
        Route::post('/store-quick-appointment', [FormAppointment::class, 'store'])->name('store-quick-appointment');
        Route::post('/store-basic-information', [FormAppointment::class, 'storeBasicInformation'])->name('store-basic-information');
        Route::post('/store-reason', [FormAppointment::class, 'storeReason'])->name('store-reason');
        
        Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
        Route::post('/store-about-us-header', [AboutUsController::class, 'storeHeader'])->name('store-about-us-header');
        Route::post('/store-about-us-content', [AboutUsController::class, 'storeContent'])->name('store-about-us-content');
        Route::post('/store-about-us-vision-mission', [AboutUsController::class, 'storeVisionMission'])->name('store-about-us-vision-mission');

        Route::get('special-economic-zone', [ZoneController::class, 'index'])->name('special-economic-zone');
        Route::get('fetch-zone', [ZoneController::class, 'fetchZone'])->name('fetch-zone');
        Route::get('fetch-special-zone', [ZoneController::class, 'fetchSpecialZone'])->name('fetch-special-zone');
        Route::get('fetch-zone-class', [ZoneController::class, 'fetchZoneClass'])->name('fetch-zone-class');
        Route::get('zone/{id}/detail', [ZoneController::class, 'getZoneDetail'])->name('zone-detail');
        Route::post('store-zone', [ZoneController::class, 'storeZone'])->name('store-zone');
        Route::post('zone/{id}/update', [ZoneController::class, 'updateZone'])->name('zone-update');

        Route::get('article-and-news', [NewsAndArticleController::class, 'index'])->name('article-and-news');
    });
});