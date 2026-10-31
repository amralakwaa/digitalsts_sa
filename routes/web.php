<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\QuoteController as AdminQuoteController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ServiceOfferController as AdminServiceOfferController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;

/*
|--------------------------------------------------------------------------
| Language Switcher Route
|--------------------------------------------------------------------------
*/
Route::get('/lang/{locale}', [LocaleController::class, 'switch'])->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/sectors', [PageController::class, 'sectors'])->name('sectors');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offers/{slug}', [OfferController::class, 'show'])->name('offers.show');
Route::get('/quote', [QuoteController::class, 'create'])->name('quote.create');
Route::post('/quote', [QuoteController::class, 'store'])->name('quote.store');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->as('admin.')->group(function () {
    Route::redirect('/', '/admin/dashboard');

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Quote Requests & Offers
    Route::get('/quotes', [AdminQuoteController::class, 'index'])->name('quotes.index');
    Route::get('/quotes/create', [AdminQuoteController::class, 'create'])->name('quotes.create');
    Route::post('/quotes', [AdminQuoteController::class, 'store'])->name('quotes.store');
    Route::get('/quotes/export', [AdminQuoteController::class, 'export'])->name('quotes.export');
    Route::post('/quotes/bulk-delete', [AdminQuoteController::class, 'bulkDelete'])->name('quotes.bulkDelete');
    Route::post('/quotes/bulk-status', [AdminQuoteController::class, 'bulkStatus'])->name('quotes.bulkStatus');
    Route::post('/quotes/{id}/quick-status', [AdminQuoteController::class, 'quickStatus'])->name('quotes.quick_status');
    Route::get('/quotes/{id}', [AdminQuoteController::class, 'show'])->name('quotes.show');
    Route::get('/quotes/{id}/edit', [AdminQuoteController::class, 'edit'])->name('quotes.edit');
    Route::put('/quotes/{id}', [AdminQuoteController::class, 'update'])->name('quotes.update');
    Route::post('/quotes/{id}/status', [AdminQuoteController::class, 'updateStatus'])->name('quotes.update_status');
    Route::get('/quotes/{id}/download', [AdminQuoteController::class, 'downloadAttachment'])->name('quotes.download');
    Route::delete('/quotes/{id}', [AdminQuoteController::class, 'destroy'])->name('quotes.destroy');

    // Services
    Route::get('/services', [AdminServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [AdminServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [AdminServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}', [AdminServiceController::class, 'show'])->name('services.show');
    Route::get('/services/{id}/edit', [AdminServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{id}', [AdminServiceController::class, 'update'])->name('services.update');
    Route::post('/services/{id}/toggle', [AdminServiceController::class, 'toggle'])->name('services.toggle');
    Route::delete('/services/{id}', [AdminServiceController::class, 'destroy'])->name('services.destroy');

    // Service Packages & Promotional Offers (باقات وعروض الخدمات)
    Route::get('/service-offers', [AdminServiceOfferController::class, 'index'])->name('service-offers.index');
    Route::get('/service-offers/create', [AdminServiceOfferController::class, 'create'])->name('service-offers.create');
    Route::post('/service-offers', [AdminServiceOfferController::class, 'store'])->name('service-offers.store');
    Route::get('/service-offers/{id}', [AdminServiceOfferController::class, 'show'])->name('service-offers.show');
    Route::get('/service-offers/{id}/edit', [AdminServiceOfferController::class, 'edit'])->name('service-offers.edit');
    Route::put('/service-offers/{id}', [AdminServiceOfferController::class, 'update'])->name('service-offers.update');
    Route::post('/service-offers/{id}/toggle', [AdminServiceOfferController::class, 'toggle'])->name('service-offers.toggle');
    Route::post('/service-offers/{id}/featured', [AdminServiceOfferController::class, 'toggleFeatured'])->name('service-offers.featured');
    Route::delete('/service-offers/{id}', [AdminServiceOfferController::class, 'destroy'])->name('service-offers.destroy');

    // Projects
    Route::get('/projects', [AdminProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [AdminProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [AdminProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}/edit', [AdminProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{id}', [AdminProjectController::class, 'update'])->name('projects.update');
    Route::post('/projects/{id}/toggle', [AdminProjectController::class, 'toggle'])->name('projects.toggle');
    Route::delete('/projects/{id}', [AdminProjectController::class, 'destroy'])->name('projects.destroy');
    Route::delete('/projects/{id}/images/{imageId}', [AdminProjectController::class, 'destroyImage'])->name('projects.images.destroy');

    // Articles & Blog
    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}', [AdminArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{id}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [AdminArticleController::class, 'update'])->name('articles.update');
    Route::post('/articles/{id}/toggle', [AdminArticleController::class, 'toggle'])->name('articles.toggle');
    Route::post('/articles/{id}/duplicate', [AdminArticleController::class, 'duplicate'])->name('articles.duplicate');
    Route::post('/articles/bulk-delete', [AdminArticleController::class, 'bulkDelete'])->name('articles.bulkDelete');
    Route::post('/articles/update-order', [AdminArticleController::class, 'updateOrder'])->name('articles.updateOrder');
    Route::delete('/articles/{id}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');

    // Messages
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/bulk-delete', [AdminMessageController::class, 'bulkDelete'])->name('messages.bulkDelete');
    Route::post('/messages/bulk-read', [AdminMessageController::class, 'bulkRead'])->name('messages.bulkRead');
    Route::post('/messages/{id}/toggle-read', [AdminMessageController::class, 'toggleRead'])->name('messages.toggleRead');
    Route::get('/messages/{id}', [AdminMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{id}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

    // Testimonials & Client Reviews (شهادات وآراء العملاء)
    Route::get('/testimonials', [AdminTestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/create', [AdminTestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [AdminTestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('/testimonials/{id}/edit', [AdminTestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::put('/testimonials/{id}', [AdminTestimonialController::class, 'update'])->name('testimonials.update');
    Route::post('/testimonials/{id}/toggle', [AdminTestimonialController::class, 'toggle'])->name('testimonials.toggle');
    Route::post('/testimonials/{id}/featured', [AdminTestimonialController::class, 'toggleFeatured'])->name('testimonials.featured');
    Route::delete('/testimonials/{id}', [AdminTestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Site Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

    // Users & Administrators
    Route::resource('users', AdminUserController::class)->except(['show']);
});

