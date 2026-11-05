<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ConventionCenterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\InfrastructureController;
use App\Http\Controllers\Admin\OrganicFarmController;
use App\Http\Controllers\Admin\PageBannerController;
use App\Http\Controllers\Admin\ResortController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UpcomingProjectController;
use App\Http\Controllers\Admin\WhatWeOfferController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

// Public Root Route
Route::controller(WebsiteController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('about', 'about')->name('about');
    Route::get('services', 'service')->name('services');
    Route::get('convention-center', 'conventionCenter')->name('convention-center');
    Route::get('resort', 'resort')->name('resort');
    Route::get('gallery', 'gallery')->name('gallery');
    Route::get('contact', 'contact')->name('contact');
    Route::get('organic-farm', 'organicFarm')->name('organic-farm');
});

// Dynamic SEO Sitemaps & Search Engine Directives
Route::get('/sitemap.xml', [SitemapController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// Admin Panel Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Authentication
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

    // Authenticated Admin Routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard Overview
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Convention Centres (Basic Details & Photos)
        Route::resource('convention-centres', ConventionCenterController::class);
        Route::post('convention-centres/{conventionCentre}/images', [ConventionCenterController::class, 'storeImage'])->name('convention-centres.images.store');
        Route::delete('convention-centres/images/{image}', [ConventionCenterController::class, 'destroyImage'])->name('convention-centres.images.destroy');

        // Infrastructure Section (Title, Image, Description, Points, Order, Status)
        Route::resource('infrastructures', InfrastructureController::class);

        // What We Offer Section (Title, Image, Description, Order, Status)
        Route::resource('what-we-offers', WhatWeOfferController::class);

        // Resorts & Room Types
        Route::resource('resorts', ResortController::class);
        Route::post('resorts/{resort}/rooms', [ResortController::class, 'storeRoomType'])->name('resorts.rooms.store');
        Route::delete('resorts/rooms/{roomType}', [ResortController::class, 'destroyRoomType'])->name('resorts.rooms.destroy');
        Route::post('resorts/{resort}/images', [ResortController::class, 'storeImage'])->name('resorts.images.store');
        Route::delete('resorts/images/{image}', [ResortController::class, 'destroyImage'])->name('resorts.images.destroy');

        // Organic Farms
        Route::resource('organic-farms', OrganicFarmController::class);
        Route::post('organic-farms/{organicFarm}/images', [OrganicFarmController::class, 'storeImage'])->name('organic-farms.images.store');
        Route::delete('organic-farms/images/{image}', [OrganicFarmController::class, 'destroyImage'])->name('organic-farms.images.destroy');

        // Services
        Route::resource('services', ServiceController::class);

        // Gallery & Categories
        Route::get('gallery/categories', [GalleryController::class, 'categories'])->name('gallery.categories');
        Route::post('gallery/categories', [GalleryController::class, 'storeCategory'])->name('gallery.categories.store');
        Route::delete('gallery/categories/{category}', [GalleryController::class, 'destroyCategory'])->name('gallery.categories.destroy');
        Route::resource('gallery', GalleryController::class);

        // Testimonials
        Route::resource('testimonials', TestimonialController::class);

        // Page Banners
        Route::resource('banners', PageBannerController::class);

        // FAQs
        Route::resource('faqs', FaqController::class);

        // Upcoming Projects
        Route::resource('upcoming-projects', UpcomingProjectController::class);

        // Enquiries
        Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
        Route::get('/enquiries/{enquiry}', [EnquiryController::class, 'show'])->name('enquiries.show');
        Route::put('/enquiries/{enquiry}', [EnquiryController::class, 'update'])->name('enquiries.update');
        Route::delete('/enquiries/{enquiry}', [EnquiryController::class, 'destroy'])->name('enquiries.destroy');

        // Site Settings (including Simple SEO)
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        /*
        |--------------------------------------------------------------------------
        | Future Modules (Reserved - can be enabled when needed)
        |--------------------------------------------------------------------------
        | Route::resource('offers', \App\Http\Controllers\Admin\OfferController::class);
        | Route::resource('sliders', \App\Http\Controllers\Admin\SliderController::class);
        | Route::get('/seo', [\App\Http\Controllers\Admin\PageSeoController::class, 'index'])->name('seo.index');
        | Route::get('/seo/tools', [\App\Http\Controllers\Admin\PageSeoController::class, 'tools'])->name('seo.tools');
        | Route::get('/seo/{seo}/edit', [\App\Http\Controllers\Admin\PageSeoController::class, 'edit'])->name('seo.edit');
        | Route::put('/seo/{seo}', [\App\Http\Controllers\Admin\PageSeoController::class, 'update'])->name('seo.update');
        */
    });
});
