<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\CreateProduct;
use App\Livewire\ProductDetails;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\DashboardController;

// 1. الرئيسية (وفيها نظام فلترة المتاجر ?shop=Name)
Route::get('/', HomePage::class)->name('home');

// Registration pending notice for shop owners
Route::view('/register/pending', 'auth.register-pending')->name('register.pending');

// Shop owner registration
Route::get('/shop/register', [\App\Http\Controllers\Auth\ShopRegisterController::class, 'create'])->name('shop.register');
Route::post('/shop/register', [\App\Http\Controllers\Auth\ShopRegisterController::class, 'store'])->name('shop.register.store');

// 2. إضافة منتج (Livewire الجديد الشامل للأقسام)
Route::get('/add-price', CreateProduct::class)->name('products.create');

// 3. تفاصيل المنتج
Route::get('/product/{id}', ProductDetails::class)->name('products.show');

// 4. الصفحات الثابتة
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/report', 'pages.report')->name('report');

// 5. التعديل (Controller)
Route::get('/edit-price/{token}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{token}', [ProductController::class, 'update'])->name('products.update');

// 6. الأدمن
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete('/product/{id}', [DashboardController::class, 'destroy'])->name('product.delete');
    Route::put('/product/{id}', [DashboardController::class, 'update'])->name('product.update');
    Route::post('/product/{id}/toggle-approve', [DashboardController::class, 'toggleProductApproval'])->name('product.toggleApprove');
    // Approve / reject shop owner registrations
    Route::post('/user/{id}/approve', [DashboardController::class, 'approveUser'])->name('user.approve');
    Route::delete('/user/{id}/reject', [DashboardController::class, 'rejectUser'])->name('user.reject');
});

// Shop public page
Route::get('/shop/{id}', [\App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');

// Shop owner dashboard (manage own products)
Route::middleware(['auth','verified'])->group(function(){
    Route::get('/shop/dashboard', [\App\Http\Controllers\ShopDashboardController::class, 'index'])->name('shop.dashboard');
    Route::delete('/shop/product/{id}', [\App\Http\Controllers\ShopDashboardController::class, 'destroy'])->name('shop.product.destroy');
});

// Admin: categories & ads
Route::middleware(['auth','verified'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/ads', [\App\Http\Controllers\Admin\AdController::class, 'index'])->name('ads.index');
    Route::post('/ads', [\App\Http\Controllers\Admin\AdController::class, 'store'])->name('ads.store');
    Route::post('/ads/{id}', [\App\Http\Controllers\Admin\AdController::class, 'update'])->name('ads.update');
    Route::delete('/ads/{id}', [\App\Http\Controllers\Admin\AdController::class, 'destroy'])->name('ads.destroy');
});

require __DIR__.'/auth.php';