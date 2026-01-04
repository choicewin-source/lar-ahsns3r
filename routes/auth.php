<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ShopRegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    
    // التسجيل متاح: نسمح بتسجيل مستخدمين وزوار ومتاجر (متاجر تحتاج موافقة الأدمن)
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    // Shop Registration
    Route::get('register-shop', [ShopRegisterController::class, 'create'])->name('shop.register');
    Route::post('register-shop', [ShopRegisterController::class, 'store'])->name('shop.register.store');
    Route::get('register-shop/complete', [ShopRegisterController::class, 'showCompleteForm'])->name('shop.register.complete');
    Route::post('register-shop/complete', [ShopRegisterController::class, 'completeRegistration'])->name('shop.register.complete.store');

    // تسجيل الدخول (Login)
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // نسيت كلمة المرور (Forgot Password)
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    // إعادة تعيين كلمة المرور (Reset Password)
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');

    // Social Login (Google)
    Route::get('auth/google', [SocialLoginController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/shop', [SocialLoginController::class, 'redirectToGoogleForShop'])->name('auth.google.shop');
    Route::get('auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);
});

Route::middleware('auth')->group(function () {
    
    // تأكيد البريد الإلكتروني (Verify Email)
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    // تأكيد كلمة المرور قبل العمليات الحساسة
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // تحديث كلمة المرور
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // تسجيل الخروج (Logout)
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
