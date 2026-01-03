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
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // البحث عن المستخدم بواسطة البريد الإلكتروني
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // إنشاء مستخدم جديد إذا لم يكن موجوداً
                // في الدالة handleGoogleCallback، تحديث إنشاء المستخدم:
$user = User::create([
    'name' => $googleUser->getName(),
    'email' => $googleUser->getEmail(),
    'password' => Hash::make(Str::random(24)),
    'google_id' => $googleUser->getId(), // إضافة هذا
    'role' => 'user',
    'email_verified_at' => now(),
    'is_approved' => true,
]);
            } else {
                // إذا كان المستخدم موجوداً، نحدث حالة التفعيل إذا لم يكن مفعلاً
                if (is_null($user->email_verified_at)) {
                    $user->email_verified_at = now();
                    $user->save();
                }
            }

            Auth::login($user);

            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'حدث خطأ أثناء تسجيل الدخول عبر جوجل.');
        }
    }
}