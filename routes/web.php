<?php

use App\Http\Controllers\Settings;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\IndustryController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\DownloadController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product Routes
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/category/{category:slug}', [ProductController::class, 'category'])->name('category');
    Route::get('/{product:slug}', [ProductController::class, 'show'])->name('show');
});

// Industry Routes
Route::prefix('industries')->name('industries.')->group(function () {
    Route::get('/', [IndustryController::class, 'index'])->name('index');
    Route::get('/{industry:slug}', [IndustryController::class, 'show'])->name('show');
});

// Static Pages
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/certifications', [PageController::class, 'certifications'])->name('certifications');
Route::get('/quality-policy', [PageController::class, 'show'])->name('pages.show');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Blog/News
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{blogPost:slug}', [BlogController::class, 'show'])->name('show');
});

// Contact & Inquiry
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/inquiry', [ContactController::class, 'inquiry'])->name('inquiry.store');

// Downloads
Route::prefix('downloads')->name('downloads.')->group(function () {
    Route::get('/', [DownloadController::class, 'index'])->name('index');
    Route::get('/{download}/download', [DownloadController::class, 'download'])->name('download');
});

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Sitemap and SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');
Route::get('/products-by-category', [HomeController::class, 'getProductsByCategory'])->name('home.products-by-category');

Route::middleware(['auth'])->group(function () {
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
});

// Include admin routes
require __DIR__.'/admin.php';

// Authentication Routes
require __DIR__.'/auth.php';