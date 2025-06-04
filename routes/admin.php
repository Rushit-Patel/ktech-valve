<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Product Categories Management
    Route::resource('product-categories', ProductCategoryController::class)->parameters([
        'product-categories' => 'productCategory'
    ]);
    Route::patch('product-categories/{productCategory}/toggle-status', [ProductCategoryController::class, 'toggleStatus'])
        ->name('product-categories.toggle-status');

    // Products Management
    Route::resource('products', ProductController::class);
    Route::patch('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])
        ->name('products.toggle-status');
    Route::patch('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])
        ->name('products.toggle-featured');

    // Industries Management
    Route::resource('industries', IndustryController::class);
    Route::patch('industries/{industry}/toggle-status', [IndustryController::class, 'toggleStatus'])
        ->name('industries.toggle-status');

    // Pages Management
    Route::resource('pages', PageController::class);
    Route::patch('pages/{page}/toggle-status', [PageController::class, 'toggleStatus'])
        ->name('pages.toggle-status');

    // Inquiries Management
    Route::prefix('inquiries')->name('inquiries.')->group(function () {
        Route::get('/', [InquiryController::class, 'index'])->name('index');
        Route::get('/{inquiry}', [InquiryController::class, 'show'])->name('show');
        Route::patch('/{inquiry}/status', [InquiryController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{inquiry}', [InquiryController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-action', [InquiryController::class, 'bulkAction'])->name('bulk-action');
        Route::get('/export/csv', [InquiryController::class, 'export'])->name('export');
    });

    // Gallery Management
    Route::resource('galleries', GalleryController::class);
    Route::patch('galleries/{gallery}/toggle-status', [GalleryController::class, 'toggleStatus'])
        ->name('galleries.toggle-status');
    Route::post('galleries/bulk-delete', [GalleryController::class, 'bulkDelete'])
        ->name('galleries.bulk-delete');

    // SEO Management
    Route::prefix('seo')->name('seo.')->group(function () {
        Route::get('/', [SeoController::class, 'index'])->name('index');
        Route::get('/create', [SeoController::class, 'create'])->name('create');
        Route::post('/', [SeoController::class, 'store'])->name('store');
        Route::get('/{seoSetting}/edit', [SeoController::class, 'edit'])->name('edit');
        Route::patch('/{seoSetting}', [SeoController::class, 'update'])->name('update');
        Route::delete('/{seoSetting}', [SeoController::class, 'destroy'])->name('destroy');
        Route::get('/items-by-page-type', [SeoController::class, 'getItemsByPageType'])->name('items-by-page-type');
    });

    // Certifications Management
    Route::resource('certifications', CertificationController::class);
    Route::patch('certifications/{certification}/toggle-status', [CertificationController::class, 'toggleStatus'])
        ->name('certifications.toggle-status');

    // Clients Management
    Route::resource('clients', ClientController::class);
    Route::patch('clients/{client}/toggle-status', [ClientController::class, 'toggleStatus'])
        ->name('clients.toggle-status');
    Route::patch('clients/{client}/toggle-featured', [ClientController::class, 'toggleFeatured'])
        ->name('clients.toggle-featured');

    // Testimonials Management
    Route::resource('testimonials', TestimonialController::class);
    Route::patch('testimonials/{testimonial}/toggle-status', [TestimonialController::class, 'toggleStatus'])
        ->name('testimonials.toggle-status');
    Route::patch('testimonials/{testimonial}/toggle-featured', [TestimonialController::class, 'toggleFeatured'])
        ->name('testimonials.toggle-featured');

    // Blog/News Management
    Route::resource('blog-posts', BlogPostController::class)->parameters([
        'blog-posts' => 'blogPost'
    ]);
    Route::patch('blog-posts/{blogPost}/toggle-status', [BlogPostController::class, 'toggleStatus'])
        ->name('blog-posts.toggle-status');

    // Downloads Management
    Route::resource('downloads', DownloadController::class);
    Route::patch('downloads/{download}/toggle-status', [DownloadController::class, 'toggleStatus'])
        ->name('downloads.toggle-status');
    Route::patch('downloads/{download}/toggle-public', [DownloadController::class, 'togglePublic'])
        ->name('downloads.toggle-public');

    // Website Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [WebsiteSettingController::class, 'index'])->name('index');
        Route::get('/general', [WebsiteSettingController::class, 'general'])->name('general');
        Route::get('/contact', [WebsiteSettingController::class, 'contact'])->name('contact');
        Route::get('/social', [WebsiteSettingController::class, 'social'])->name('social');
        Route::get('/seo', [WebsiteSettingController::class, 'seo'])->name('seo');
        Route::post('/update', [WebsiteSettingController::class, 'update'])->name('update');
        Route::post('/clear-cache', [WebsiteSettingController::class, 'clearCache'])->name('clear-cache');
    });

    // User Management (Super Admin only)
    Route::middleware(['can:manage-users'])->group(function () {
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('users.toggle-status');
        Route::patch('users/{user}/reset-password', [UserController::class, 'resetPassword'])
            ->name('users.reset-password');
    });

    // Reports & Analytics
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/inquiries', [ReportController::class, 'inquiries'])->name('inquiries');
        Route::get('/products', [ReportController::class, 'products'])->name('products');
        Route::get('/website-analytics', [ReportController::class, 'websiteAnalytics'])->name('website-analytics');
    });

    // File Manager
    Route::prefix('file-manager')->name('file-manager.')->group(function () {
        Route::get('/', [FileManagerController::class, 'index'])->name('index');
        Route::post('/upload', [FileManagerController::class, 'upload'])->name('upload');
        Route::delete('/delete', [FileManagerController::class, 'delete'])->name('delete');
        Route::post('/create-folder', [FileManagerController::class, 'createFolder'])->name('create-folder');
    });

    // System Tools
    Route::prefix('system')->name('system.')->middleware(['can:manage-system'])->group(function () {
        Route::get('/cache', [SystemController::class, 'cache'])->name('cache');
        Route::post('/clear-cache', [SystemController::class, 'clearCache'])->name('clear-cache');
        Route::get('/logs', [SystemController::class, 'logs'])->name('logs');
        Route::get('/backup', [SystemController::class, 'backup'])->name('backup');
        Route::post('/create-backup', [SystemController::class, 'createBackup'])->name('create-backup');
    });
});