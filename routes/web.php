<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopDashboardController;
use App\Http\Controllers\ProductComparisonController;
use App\Http\Controllers\ProfileController;
use App\Livewire\CreateProduct;
use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;

// الصفحة الرئيسية
Route::get('/', HomePage::class)->name('home');

// توافق مع اختبارات Laravel الافتراضية (Breeze/Jetstream)
// بعض الاختبارات تتوقع وجود route باسم dashboard
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// المنتجات
Route::resource('products', ProductController::class)->only(['index', 'store', 'show']);
// صفحة إضافة سعر (Livewire) - واجهة تفاعلية/هرمية
Route::get('add-price', CreateProduct::class)->name('products.create');
Route::get('/products/edit/{token}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{token}', [ProductController::class, 'update'])->name('products.update');

// مقارنة الأسعار
Route::get('/compare', [ProductComparisonController::class, 'compare'])->name('products.compare');

// المتاجر
Route::get('/shops', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shop.show');

// لوحة تحكم صاحب المتجر
Route::middleware(['auth'])->group(function () {
    Route::get('/shop/dashboard', [ShopDashboardController::class, 'index'])->name('shop.dashboard');
    Route::put('/shop/profile', [ShopDashboardController::class, 'updateProfile'])->name('shop.profile.update');
    Route::post('/shop/logo', [ShopDashboardController::class, 'uploadLogo'])->name('shop.logo.upload');
    Route::delete('/shop/logo', [ShopDashboardController::class, 'deleteLogo'])->name('shop.logo.delete');
});

// لوحة تحكم المدير (محدثة)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete('/products/{id}', [DashboardController::class, 'destroyProduct'])->name('product.delete');
    Route::post('/products/{id}/toggle-approval', [DashboardController::class, 'toggleProductApproval'])->name('product.toggleApprove');
    Route::post('/users/{id}/approve', [DashboardController::class, 'approveUser'])->name('user.approve');
    Route::delete('/users/{id}/reject', [DashboardController::class, 'rejectUser'])->name('user.reject');
    Route::put('/products/{id}', [DashboardController::class, 'updateProduct'])->name('product.update');
    
    // إدارة الإعلانات
    Route::get('/announcements', [\App\Http\Controllers\Admin\AnnouncementController::class, 'index'])->name('announcements.index');
    Route::post('/announcements', [\App\Http\Controllers\Admin\AnnouncementController::class, 'store'])->name('announcements.store');
    Route::post('/announcements/{id}/toggle', [\App\Http\Controllers\Admin\AnnouncementController::class, 'toggle'])->name('announcements.toggle');
    Route::delete('/announcements/{id}', [\App\Http\Controllers\Admin\AnnouncementController::class, 'destroy'])->name('announcements.destroy');
});

// الملف الشخصي
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/logo', [ProfileController::class, 'uploadLogo'])->name('profile.logo.upload');
    Route::delete('/profile/logo', [ProfileController::class, 'deleteLogo'])->name('profile.logo.delete');
});

// صفحات ثابتة
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

// صفحة الإبلاغ
Route::get('/report', [App\Http\Controllers\ReportController::class, 'create'])->name('report');
Route::post('/report', [App\Http\Controllers\ReportController::class, 'store'])->name('report.store');

// إدارة البلاغات (للمدير فقط)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::patch('/reports/{id}/status', [App\Http\Controllers\ReportController::class, 'updateStatus'])->name('reports.update-status');
    Route::delete('/reports/{id}', [App\Http\Controllers\ReportController::class, 'destroy'])->name('reports.destroy');
});


Route::view('/register-pending', 'auth.register-pending')->name('register.pending');

require __DIR__.'/auth.php';