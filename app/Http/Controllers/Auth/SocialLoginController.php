<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /**
     * إعادة التوجيه إلى جوجل للمصادقة
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * إعادة التوجيه إلى جوجل لتسجيل متجر
     */
    public function redirectToGoogleForShop()
    {
        return Socialite::driver('google')
            ->with(['state' => 'shop_register'])
            ->redirect();
    }

    /**
     * معالجة رد جوجل بعد المصادقة
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $isShopRegister = request('state') === 'shop_register';
            
            // البحث عن المستخدم بواسطة Google ID أو البريد الإلكتروني
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if (!$user) {
                // إنشاء مستخدم جديد
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(24)),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'role' => $isShopRegister ? 'shop_owner' : 'user',
                    'email_verified_at' => now(),
                    'is_approved' => !$isShopRegister, // المستخدمون العاديون موافق عليهم تلقائياً
                ]);

                // إذا كان تسجيل متجر، نحتاج معلومات إضافية
                if ($isShopRegister) {
                    session(['google_shop_user_id' => $user->id]);
                    return redirect()->route('shop.register.complete');
                }
            } else {
                // تحديث Google ID إذا لم يكن موجوداً
                if (!$user->google_id) {
                    $user->google_id = $googleUser->getId();
                }
                
                // تحديث الصورة الشخصية
                if (!$user->avatar) {
                    $user->avatar = $googleUser->getAvatar();
                }

                // تفعيل البريد الإلكتروني إذا لم يكن مفعلاً
                if (is_null($user->email_verified_at)) {
                    $user->email_verified_at = now();
                }
                
                $user->save();
            }

            Auth::login($user);

            // إعادة التوجيه بناءً على نوع المستخدم
            if ($user->isShopOwner() && !$user->is_approved) {
                return redirect()->route('register.pending');
            }

            return redirect()->route('home');

        } catch (\Exception $e) {
            \Log::error('Google Login Error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'حدث خطأ أثناء تسجيل الدخول عبر جوجل: ' . $e->getMessage());
        }
    }
}