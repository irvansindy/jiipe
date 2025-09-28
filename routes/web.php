<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
// admin side
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsAndArticleController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\MenuPermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FormAppointment;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\BrochureController;
use App\Http\Controllers\Admin\GalleryController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {
    Route::get('/', function () {
        return view('layouts.client.home.index');
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

    Route::group(['middleware' => ['auth']], function () {
        Route::get('home-page', [HomeController::class,'index'])->name('home-page');
        Route::post('store-home-header', [HomeController::class,'storeHeader'])->name('store-home-header');
        Route::post('store-home-slider', [HomeController::class,'storeSlider'])->name('store-home-slider');

        Route::get('/menu-permission', [MenuPermissionController::class, 'index'])->name('menu-permission');
        Route::get('/fetch-menu-permission', [MenuPermissionController::class, 'fetchData'])->name('fetch-menu-permission');
        Route::get('/fetch-menu-permission-v2', [MenuPermissionController::class, 'fetchMenu'])->name('fetch-menu-permission-v2');
        Route::get('/fetch-detail-menu', [MenuPermissionController::class, 'showData'])->name('fetch-detail-menu');
        Route::get('/fetch-child-menu', [MenuPermissionController::class, 'getChildMenus'])->name('fetch-child-menu');
        Route::get('/fetch-parent-menu', [MenuPermissionController::class, 'getChildMenus'])->name('fetch-parent-menu');
        Route::post('/store-menu-permission', [MenuPermissionController::class, 'storeData'])->name('store-menu-permission');
        Route::post('/update-menu-permission', [MenuPermissionController::class, 'updateData'])->name('update-menu-permission');

        Route::get('users', [UserController::class,'index'])->name('users');
        Route::get('fetch-users', [UserController::class,'fetchUser'])->name('fetch-users');
        Route::get('fetch-roles', [UserController::class,'fetchRole'])->name('fetch-roles');
        
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
        Route::get('fetch-article-and-news', [NewsAndArticleController::class, 'fetch'])->name('fetch-article-and-news');
        Route::get('fetch-article-and-news-categories', [NewsAndArticleController::class, 'fetchCategories'])->name('fetch-article-and-news-categories');
        // News
        Route::get('get-article-and-news-id', [NewsAndArticleController::class, 'showNews'])->name('get-article-and-news-id');

        // News Category
        Route::get('get-article-and-news-category-id', [NewsAndArticleController::class, 'showNewsCategories'])->name('get-article-and-news-category-id');

        Route::post('store-article-and-news', [NewsAndArticleController::class, 'storeNews'])->name('store-article-and-news');
        Route::post('store-article-and-news-category', [NewsAndArticleController::class, 'storeCategories'])->name('store-article-and-news-category');
        Route::post('update-article-and-news', [NewsAndArticleController::class, 'updateNews'])->name('update-article-and-news');
        Route::post('update-article-and-news-category', [NewsAndArticleController::class, 'updateCategories'])->name('update-article-and-news-category');


        Route::get('gallery', [GalleryController::class,'index'])->name('gallery');
        Route::get('fetch-gallery-id', [GalleryController::class,'fetchById'])->name('fetch-gallery-id');
        Route::post('store-gallery', [GalleryController::class,'store'])->name('store-gallery');
        Route::post('update-gallery', [GalleryController::class,'update'])->name('update-gallery');
        
        Route::get('brochures', [BrochureController::class,'index'])->name('brochures');
        Route::get('fetch-brochures', [BrochureController::class,'fetch'])->name('fetch-brochures');
        Route::get('fetch-brochures-id', [BrochureController::class,'fetchById'])->name('fetch-brochures-id');
        Route::post('store-brochures', [BrochureController::class,'store'])->name('store-brochures');

        Route::get('career-list', [CareerController::class, 'index'])->name('career-list');
        Route::get('career-static', [CareerController::class, 'static'])->name('career-static');
        Route::get('career-enquire', [CareerController::class, 'enquire'])->name('career-enquire');
        Route::post('store-career-header', [CareerController::class, 'storeHeader'])->name('store-career-header');
        Route::post('store-career-section1', [CareerController::class, 'storeSection1'])->name('store-career-section1');

        Route::get('contact-overview', [ContactController::class,'index'])->name('contact-overview');
    });


});