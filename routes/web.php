<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\GalleryPageController;
use App\Http\Controllers\Admin\IndustriesPageController;
use App\Http\Controllers\Admin\CertificationsPageController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\ProductDetailPageController;

// Default login route redirect (Laravel expects this)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/home/inquiry', [HomeController::class, 'submitInquiry'])->name('home.inquiry');
Route::get('/about', [FrontendPageController::class, 'about'])->name('about');
Route::get('/gallery', [FrontendPageController::class, 'gallery'])->name('gallery');
Route::get('/industries', [FrontendPageController::class, 'industries'])->name('industries');
Route::get('/certifications', [FrontendPageController::class, 'certifications'])->name('certifications');
Route::get('/contact', [FrontendPageController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendPageController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/products', [FrontendProductController::class, 'index'])->name('products.index');
Route::get('/products/{category}', [FrontendProductController::class, 'category'])->name('products.category');
Route::get('/product/{product}', [FrontendProductController::class, 'show'])->name('products.show');
Route::post('/inquiry', [FrontendProductController::class, 'inquiry'])->name('products.inquiry');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Protected Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Products Management
        Route::resource('products', ProductController::class);
        Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
        Route::post('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('products.toggle-featured');
        
        // Categories Management
        Route::resource('categories', CategoryController::class);
        Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
        
        // Banners Management
        Route::resource('banners', BannerController::class);
        Route::post('banners/{banner}/toggle-status', [BannerController::class, 'toggleStatus'])->name('banners.toggle-status');
        
        // Inquiries Management
        Route::resource('inquiries', InquiryController::class)->except(['create', 'store', 'edit']);
        Route::post('inquiries/{inquiry}/update-status', [InquiryController::class, 'updateStatus'])->name('inquiries.update-status');
        Route::post('inquiries/bulk-action', [InquiryController::class, 'bulkAction'])->name('inquiries.bulk-action');
        
        // Industries Management
        Route::resource('industries', IndustryController::class);
        Route::post('industries/{industry}/toggle-status', [IndustryController::class, 'toggleStatus'])->name('industries.toggle-status');
        
        // Certifications Management
        Route::resource('certifications', CertificationController::class);
        Route::post('certifications/{certification}/toggle-status', [CertificationController::class, 'toggleStatus'])->name('certifications.toggle-status');
        
        // Clients Management
        Route::resource('clients', ClientController::class);
        Route::post('clients/{client}/toggle-status', [ClientController::class, 'toggleStatus'])->name('clients.toggle-status');
        Route::post('clients/{client}/toggle-featured', [ClientController::class, 'toggleFeatured'])->name('clients.toggle-featured');
        
        // Galleries Management
        Route::resource('galleries', GalleryController::class);
        Route::post('galleries/{gallery}/toggle-status', [GalleryController::class, 'toggleStatus'])->name('galleries.toggle-status');
        Route::post('galleries/{gallery}/toggle-featured', [GalleryController::class, 'toggleFeatured'])->name('galleries.toggle-featured');
        
        // Users Management (Super Admin only)
        Route::resource('users', UserController::class);
        Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
        
        // Settings Management
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::delete('settings/remove-file', [SettingsController::class, 'removeFile'])->name('settings.remove-file');

        // Homepage Management
        Route::get('homepage', [HomepageController::class, 'index'])->name('homepage.index');
        Route::put('homepage/section/{section}', [HomepageController::class, 'updateSection'])->name('homepage.section.update');

        // Individual Page Management
        Route::get('about-page', [AboutPageController::class, 'index'])->name('about-page.index');
        Route::put('about-page/section/{section}', [AboutPageController::class, 'updateSection'])->name('about-page.section.update');
        
        Route::get('gallery-page', [GalleryPageController::class, 'index'])->name('gallery-page.index');
        Route::put('gallery-page/section/{section}', [GalleryPageController::class, 'updateSection'])->name('gallery-page.section.update');
        
        Route::get('industries-page', [IndustriesPageController::class, 'index'])->name('industries-page.index');
        Route::put('industries-page/section/{section}', [IndustriesPageController::class, 'updateSection'])->name('industries-page.section.update');
        
        Route::get('certifications-page', [CertificationsPageController::class, 'index'])->name('certifications-page.index');
        Route::put('certifications-page/section/{section}', [CertificationsPageController::class, 'updateSection'])->name('certifications-page.section.update');
        
        Route::get('contact-page', [ContactPageController::class, 'index'])->name('contact-page.index');
        Route::put('contact-page/section/{section}', [ContactPageController::class, 'updateSection'])->name('contact-page.section.update');
        
        Route::get('product-detail-page', [ProductDetailPageController::class, 'index'])->name('product-detail-page.index');
        Route::put('product-detail-page/section/{section}', [ProductDetailPageController::class, 'updateSection'])->name('product-detail-page.section.update');
    });
});
