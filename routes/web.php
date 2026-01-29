<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NewsFrontController;

// Frontend Routes
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactStore'])->name('contact.store');

// Yangiliklar (Frontend)
Route::get('/yangiliklar', [NewsFrontController::class, 'index'])->name('news.index');
Route::get('/yangiliklar/{slug}', [NewsFrontController::class, 'show'])->name('news.show');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes - Auth middleware bilan
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Features
    Route::resource('features', FeatureController::class)->except(['show']);
    
    // Testimonials
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    
    // Statistics
    Route::resource('statistics', StatisticController::class)->except(['show']);
    
    // Pages
    Route::resource('pages', AdminPageController::class)->except(['show']);
    
    // News (Yangiliklar) - BU MUHIM
    Route::resource('news', AdminNewsController::class);
    
    // Users
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
    
    // Contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::put('/contacts/{contact}/status', [ContactController::class, 'updateStatus'])->name('contacts.updateStatus');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('/contacts/export', [ContactController::class, 'export'])->name('contacts.export');
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

// Test uchun emergency route
Route::get('/test-save', function() {
    try {
        $news = new \App\Models\News();
        $news->title = 'Test from route';
        $news->slug = 'test-from-route-' . time();
        $news->content = 'Test content';
        $news->published_date = now();
        $news->is_published = true;
        $news->save();
        
        return 'Test saved! ID: ' . $news->id;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Agar yo'l topilmasa
Route::fallback(function () {
    return redirect('/');
});
