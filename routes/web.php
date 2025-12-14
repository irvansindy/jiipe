<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
// client side
use App\Http\Controllers\Client\HomeController as HomeClient;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\IndustrialEstateController;
use App\Http\Controllers\Client\SezController;
use App\Http\Controllers\Client\NewsBlogController;
use App\Http\Controllers\Client\InternationalDeskController;
use App\Http\Controllers\Client\ContactController as ContactClient;
use App\Http\Controllers\Client\CareerController as CareerClient;
use App\Http\Controllers\Client\GalleryController as GalleryClient;
use App\Http\Controllers\Client\AppointmentController as AppointmentClient;
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
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\Video360Controller;
use App\Http\Controllers\Admin\ReviewUserController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\SubDevelopmentController;
use App\Http\Controllers\Admin\SubRegionalAdvantagesController;
use App\Http\Controllers\Admin\ZoneClusterController;
use App\Http\Controllers\Admin\SubResourceEnergyController;
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
    Route::get('profile', [ProfileController::class,'index'])->name('profile');
    Route::get('industrial-estate', [IndustrialEstateController::class,'index'])->name('industrial-estate');
    Route::get('/industrial-estate/id/{id}', [IndustrialEstateController::class, 'zoneDetail'])->name('area.detail');

    Route::get('economic-zone', [SezController::class,'index'])->name('economic-zone');
    Route::get('economic-zone/{id}', [SezController::class,'detail'])->name('economic-zone-detail');

    Route::get('/news', [NewsBlogController::class, 'index'])->name('blog.index');
    Route::get('/news/type/{type}', [NewsBlogController::class, 'type'])->name('blog.type');

    // Blog by category
    // Di dalam group localization, tambahkan ini:
    // Route::get('/blog/category/id/{categoryId}', [NewsBlogController::class, 'categoryById'])->name('blog.category.id');
    // Route::get('/blog/category/{categorySlug}', [NewsBlogController::class, 'category'])->name('blog.category');

    // Blog detail
    // Route::get('/blog/{id}', [NewsBlogController::class, 'detail'])->name('blog.detail');
    Route::get('/blog/{id}', [NewsBlogController::class, 'detail'])->name('blog.detail');

    // Gallery routes
    Route::get('/galleries', [GalleryClient::class, 'index'])->name('gallery.index');
    Route::get('/gallery/video', [GalleryClient::class, 'video'])->name('gallery.video');
    Route::get('/gallery/photo', [GalleryClient::class, 'photo'])->name('gallery.photo');


    Route::get('/international-desk', [InternationalDeskController::class, 'index'])->name('international-desk');

    Route::get('/contact', [ContactClient::class,'index'])->name('contact');
    Route::get('/career', [CareerClient::class,'index'])->name('career');
    Route::get('/career/{id}', [CareerClient::class, 'detail'])->name('client.career.detail');
    Route::post('/career/{id}', [CareerClient::class, 'apply'])->name('client.career.apply');

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
    Route::post('/appointment/store', [AppointmentClient::class, 'storeQuickAppointment'])->name('store-quick-appointment');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('home-page', [HomeController::class,'index'])->name('home-page');
        Route::get('fetch-home-slider', [SliderController::class, 'fetch'])->name('fetch-home-slider');
        Route::get('fetch-home-slider-id', [SliderController::class, 'fetchById'])->name('fetch-home-slider-id');
        Route::post('store-home-slider', [SliderController::class,'store'])->name('store-home-slider');
        Route::post('update-home-slider', [SliderController::class,'update'])->name('update-home-slider');
        Route::delete('delete-home-slider/{id}', [SliderController::class,'destroy'])->name('delete-home-slider');

        Route::get('/menu-permission', [MenuPermissionController::class, 'index'])->name('menu-permission');
        // Tambahkan route ini di web.php atau routes admin Anda
        Route::prefix('admin/menu-permission')->middleware(['auth'])->group(function () {
            Route::get('/', [MenuPermissionController::class, 'index'])->name('menu-permission.index');
            Route::get('/fetch', [MenuPermissionController::class, 'fetchMenu'])->name('fetch-menu-permission-v2');
            Route::get('/fetch-data', [MenuPermissionController::class, 'fetchData'])->name('fetch-menu-permission');
            Route::post('/store', [MenuPermissionController::class, 'storeData'])->name('store-menu-permission');
            Route::get('/detail', [MenuPermissionController::class, 'showData'])->name('fetch-detail-menu');
            Route::post('/update', [MenuPermissionController::class, 'updateData'])->name('update-menu-permission');
            Route::get('/child-menus', [MenuPermissionController::class, 'getChildMenus'])->name('fetch-child-menu');
            Route::post('/toggle-status', [MenuPermissionController::class, 'toggleStatus'])->name('toggle-menu-status');
        });

        // Route::get('/fetch-menu-permission', [MenuPermissionController::class, 'fetchData'])->name('fetch-menu-permission');
        // Route::get('/fetch-menu-permission-v2', [MenuPermissionController::class, 'fetchMenu'])->name('fetch-menu-permission-v2');
        // Route::get('/fetch-detail-menu', [MenuPermissionController::class, 'showData'])->name('fetch-detail-menu');
        // Route::get('/fetch-child-menu', [MenuPermissionController::class, 'getChildMenus'])->name('fetch-child-menu');
        // Route::get('/fetch-parent-menu', [MenuPermissionController::class, 'getChildMenus'])->name('fetch-parent-menu');
        // Route::post('/store-menu-permission', [MenuPermissionController::class, 'storeData'])->name('store-menu-permission');
        // Route::post('/update-menu-permission', [MenuPermissionController::class, 'updateData'])->name('update-menu-permission');

        Route::get('users', [UserController::class,'index'])->name('users');
        Route::get('fetch-users', [UserController::class,'fetchUser'])->name('fetch-users');
        Route::get('/admin/users/detail/{id}', [UserController::class, 'detailUser'])->name('detail-user');
        Route::get('fetch-roles', [UserController::class,'fetchRole'])->name('fetch-roles');
        Route::get('/roles/detail/{id}', [UserController::class, 'detailRole'])->name('detail-role');
        Route::post('/admin/users/store', [UserController::class, 'storeUser'])->name('store-users');
        Route::post('/roles/{id}/permissions', [UserController::class, 'updateRolePermissions'])->name('update-role-permissions');
        Route::delete('/admin/users/delete/{id}', [UserController::class, 'deleteUser'])->name('delete-user');

        Route::get('/list-appointment', [FormAppointment::class, 'index'])->name('list-appointment');
        Route::get('/form-appointment', [FormAppointment::class, 'formView'])->name('form-appointment');
        Route::get('/fetch-appointment', [FormAppointment::class, 'fetchAppointment'])->name('fetch-appointment');
        // Route::post('/store-quick-appointment', [FormAppointment::class, 'store'])->name('store-quick-appointment');
        Route::post('/store-basic-information', [FormAppointment::class, 'storeBasicInformation'])->name('store-basic-information');
        Route::post('/store-reason', [FormAppointment::class, 'storeReason'])->name('store-reason');

        Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
        Route::get('/about-us-fetch-content-detail', [AboutUsController::class, 'fetchContentDetail'])->name('about-us-fetch-content-detail');
        Route::post('/store-about-us-header', [AboutUsController::class, 'storeHeader'])->name('store-about-us-header');
        Route::post('/store-about-us-content', [AboutUsController::class, 'storeContent'])->name('store-about-us-content');
        Route::post('/store-about-us-vision-mission', [AboutUsController::class, 'storeVisionMission'])->name('store-about-us-vision-mission');
        Route::post('/store-about-us-content-detail', [AboutUsController::class, 'storeContentDetail'])->name('store-about-us-content-detail');
        // Content Detail
        Route::delete('/delete-content-detail', [AboutUsController::class, 'deleteContentDetail'])->name('delete-about-us-content-detail');

        Route::get('special-economic-zone', [ZoneController::class, 'index'])->name('special-economic-zone');
        Route::get('fetch-zone', [ZoneController::class, 'fetchZone'])->name('fetch-zone');
        Route::get('fetch-special-zone', [ZoneController::class, 'fetchSpecialZone'])->name('fetch-special-zone');
        Route::get('fetch-zone-class', [ZoneController::class, 'fetchZoneClass'])->name('fetch-zone-class');
        Route::get('zone/{id}/detail', [ZoneController::class, 'getZoneDetail'])->name('zone-detail');
        Route::post('store-zone', [ZoneController::class, 'storeZone'])->name('store-zone');
        Route::post('zone/{id}/update', [ZoneController::class, 'updateZone'])->name('zone-update');

        Route::get('/language', [LanguageController::class, 'index'])->name('language');
        Route::get('/fetch-language', [LanguageController::class, 'fetch'])->name('fetch-language');
        Route::get('/fetch-id', [LanguageController::class, 'fetchById'])->name('fetch-language-id');
        Route::post('/store', [LanguageController::class, 'store'])->name('store-language');
        Route::post('/update', [LanguageController::class, 'update'])->name('update-language');
        Route::delete('/delete/{id}', [LanguageController::class, 'destroy'])->name('delete-language');
        Route::post('/sync-config', [LanguageController::class, 'syncFromConfig'])->name('sync-language-config');

        Route::prefix('admin')->middleware(['auth'])->group(function () {
            // Zone routes
            Route::get('/zone', [ZoneController::class, 'index'])->name('zone.index');
            Route::get('/zone/fetch', [ZoneController::class, 'fetchZone'])->name('fetch-zone');
            Route::get('/zone/fetch-special', [ZoneController::class, 'fetchSpecialZone'])->name('fetch-special-zone');
            Route::get('/zone/fetch-class', [ZoneController::class, 'fetchZoneClass'])->name('fetch-zone-class');
            Route::post('/zone/store', [ZoneController::class, 'storeZone'])->name('store-zone');
            Route::get('/zone/{id}/detail', [ZoneController::class, 'getZoneDetail']);
            Route::post('/zone/{id}/update', [ZoneController::class, 'updateZone']);
            Route::delete('/zone/{id}/delete', [ZoneController::class, 'deleteZone']);
        });

        /**
         * Zone Cluster Routes (only for zone_class_id = 1)
         */
        Route::prefix('admin/zone-clusters')->middleware(['auth'])->group(function () {
            // Fetch clusters by zone
            Route::get('zone/{zoneId}', [ZoneClusterController::class, 'fetchClusters']);

            // Get cluster detail
            Route::get('{id}', [ZoneClusterController::class, 'getClusterDetail']);

            // Create new cluster
            Route::post('store', [ZoneClusterController::class, 'storeCluster']);

            // Update cluster
            Route::post('update/{id}', [ZoneClusterController::class, 'updateCluster']);

            // Delete cluster
            Route::delete('delete/{id}', [ZoneClusterController::class, 'deleteCluster']);
        });

        /**
         * Sub Development Routes (only for zone_class_id = 1)
         */
        Route::prefix('admin/sub-developments')->middleware(['auth'])->group(function () {
            // Fetch developments by zone
            Route::get('zone/{zoneId}', [SubDevelopmentController::class, 'fetchDevelopments']);

            // Get development detail
            Route::get('{id}', [SubDevelopmentController::class, 'getDevelopmentDetail']);

            // Create new development
            Route::post('store', [SubDevelopmentController::class, 'storeDevelopment']);

            // Update development
            Route::post('update/{id}', [SubDevelopmentController::class, 'updateDevelopment']);

            // Delete development
            Route::delete('delete/{id}', [SubDevelopmentController::class, 'deleteDevelopment']);
        });

        /**
         * Sub Regional Advantages Routes (only for zone_class_id = 1)
         */
        Route::prefix('admin/regional-advantages')->middleware(['auth'])->group(function () {
            // Fetch advantages by zone
            Route::get('zone/{zoneId}', [SubRegionalAdvantagesController::class, 'fetchAdvantages']);

            // Get advantage detail
            Route::get('{id}', [SubRegionalAdvantagesController::class, 'getAdvantageDetail']);

            // Create new advantage
            Route::post('store', [SubRegionalAdvantagesController::class, 'storeAdvantage']);

            // Update advantage
            Route::post('update/{id}', [SubRegionalAdvantagesController::class, 'updateAdvantage']);

            // Delete advantage
            Route::delete('delete/{id}', [SubRegionalAdvantagesController::class, 'deleteAdvantage']);
        });

        /**
         * Sub Resource Energy Routes (only for zone_class_id = 1)
         */
        Route::prefix('admin/resource-energies')->middleware(['auth'])->group(function () {
            // Fetch energies by zone
            Route::get('zone/{zoneId}', [SubResourceEnergyController::class, 'fetchEnergies']);

            // Get energy detail
            Route::get('{id}', [SubResourceEnergyController::class, 'getEnergyDetail']);

            // Create new energy
            Route::post('store', [SubResourceEnergyController::class, 'storeEnergy']);

            // Update energy
            Route::post('update/{id}', [SubResourceEnergyController::class, 'updateEnergy']);

            // Delete energy
            Route::delete('delete/{id}', [SubResourceEnergyController::class, 'deleteEnergy']);
        });

        // tenant
        Route::get('fetch-tenant', [TenantController::class, 'fetch'])->name('fetch-tenant');
        Route::get('fetch-tenant-by-id/{id}', [TenantController::class, 'fetchById'])->name('fetch-tenant-by-id');
        Route::post('store-tenant', [TenantController::class, 'store'])->name('store-tenant');
        Route::post('update-tenant', [TenantController::class,'update'])->name('update-tenant');
        Route::delete('tenant/{id}', [TenantController::class, 'destroy']);

        // video 360
        Route::post('submit-video360', [Video360Controller::class,'store'])->name('submit-video360');

        // Route::get('/reviews', [ReviewUserController::class, 'index'])->name('admin.reviews.index');
        // Review routes
        Route::prefix('admin')->middleware(['auth'])->group(function () {
            // Review routes
            Route::get('/reviews/fetch', [ReviewUserController::class, 'fetch'])->name('fetch-reviews');
            Route::get('/reviews/{id}/edit', [ReviewUserController::class, 'edit']);
            Route::post('/reviews', [ReviewUserController::class, 'store']);
            Route::put('/reviews/{id}', [ReviewUserController::class, 'update']);
            Route::delete('/reviews/{id}', [ReviewUserController::class, 'destroy']);
            Route::post('/reviews/{id}/toggle-status', [ReviewUserController::class, 'toggleStatus']);
        });

        Route::prefix('admin')->middleware(['auth'])->group(function () {
            // FAQ routes
            Route::get('/faq/fetch', [FAQController::class, 'fetch'])->name('fetch-faq');
            Route::get('/faq/{id}/edit', [FAQController::class, 'edit']);
            Route::post('/faq', [FAQController::class, 'store']);
            Route::put('/faq/{id}', [FAQController::class, 'update']);
            Route::delete('/faq/{id}', [FAQController::class, 'destroy']);
            Route::post('/faq/{id}/toggle-status', [FAQController::class, 'toggleStatus']);
        });

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
        // Route::get('fetch-brochures', [BrochureController::class,'fetch'])->name('fetch-brochures');
        // Route::get('fetch-brochures-id', [BrochureController::class,'fetchById'])->name('fetch-brochures-id');
        // Route::post('store-brochures', [BrochureController::class,'store'])->name('store-brochures');
        /**
         * Brochure Routes
         */
        Route::prefix('admin/brochure')->middleware(['auth'])->group(function () {
            // Index page
            // Route::get('/', [BrochureController::class, 'index'])->name('brochure-index');

            // Fetch all brochures (AJAX)
            Route::get('/fetch', [BrochureController::class, 'fetch'])->name('fetch-brochure');

            // Fetch brochure by ID (AJAX)
            Route::get('/fetch-id', [BrochureController::class, 'fetchById'])->name('fetch-brochure-id');

            // Create new brochure
            Route::post('/store', [BrochureController::class, 'store'])->name('store-brochure');

            // Update brochure
            Route::post('/{id}/update', [BrochureController::class, 'update'])->name('update-brochure');

            // Delete brochure
            Route::delete('/{id}/delete', [BrochureController::class, 'delete'])->name('delete-brochure');
        });

        Route::get('career-list', [CareerController::class, 'index'])->name('career-list');
        Route::get('career-static', [CareerController::class, 'static'])->name('career-static');
        Route::get('career-enquire', [CareerController::class, 'enquire'])->name('career-enquire');
        // Career enquire (CareerEmail) routes
        Route::get('fetch-career-enquire', [CareerController::class, 'fetchCareerEnquire'])->name('fetch-career-enquire');
        Route::post('store-or-update-career-email', [CareerController::class, 'storeOrUpdateCareerEmail'])->name('store-or-update-career-email');
        Route::get('get-career-enquire-details', [CareerController::class, 'detailCareerEnquire'])->name('get-career-enquire-details');
        Route::delete('delete-career-enquire/{id}', [CareerController::class, 'deleteCareerEnquire'])->name('delete-career-enquire');
        Route::get('fetch-career-list', [CareerController::class, 'fetchCareer'])->name('fetch-career-list');
        Route::get('get-career-details', [CareerController::class, 'detailCareer'])->name('get-career-details');
        Route::post('store-career-header', [CareerController::class, 'storeHeader'])->name('store-career-header');
        Route::post('store-career-section1', [CareerController::class, 'storeSection1'])->name('store-career-section1');
        Route::post('store-or-update-career', [CareerController::class, 'storeOrUpdateCareer'])->name('store-or-update-career');

        Route::get('company-location', [CareerController::class,'fetchCareerLocation'])->name('company-location');
        Route::get('company-education', [CareerController::class,'fetchCareerEducation'])->name('company-education');
        Route::get('company-job-level', [CareerController::class,'fetchCareerJobLevel'])->name('company-job-level');
        Route::get('company', [CareerController::class,'fetchCareerCompany'])->name('company');

        Route::get('contact-overview', [ContactController::class,'index'])->name('contact-overview');
        Route::get('fetch-contact-overview', [ContactController::class,'fetchContactOverview'])->name('fetch-contact-overview');
        Route::post('store-contact-overview', [ContactController::class,'storeContactOverview'])->name('store-contact-overview');
    });
});
