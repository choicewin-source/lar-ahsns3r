<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ShopRegisterController extends Controller
{
    /**
     * عرض صفحة تسجيل المتجر
     */
    public function create(): View
    {
        return view('auth.register-shop');
    }

    /**
     * معالجة طلب التسجيل
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'shop_name' => ['required', 'string', 'max:255', 'unique:users,shop_name'], // التأكد من تفرد اسم المتجر
            'shop_city' => ['required', 'string', 'max:255'],
            'shop_phone' => ['nullable', 'string', 'max:20', 'regex:/^[\d\-\+\s\(\)]{8,20}$/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'يرجى إدخال الاسم الشخصي.',
            'shop_name.required' => 'يرجى إدخال اسم المعرض/المتجر.',
            'shop_name.unique' => 'اسم المعرض هذا مسجل مسبقاً، يرجى اختيار اسم آخر.',
            'shop_city.required' => 'يرجى اختيار المدينة.',
            'shop_phone.regex' => 'رقم الهاتف غير صحيح.',
            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'email.email' => 'البريد الإلكتروني غير صحيح.',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً.',
            'password.required' => 'يرجى إدخال كلمة المرور.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'shop_name' => $request->shop_name,
            'shop_city' => $request->shop_city,
            'shop_phone' => $request->shop_phone,
            'password' => Hash::make($request->password),
            'role' => 'shop_owner',     // تحديد الدور كصاحب متجر
            'is_approved' => false,     // يتطلب موافقة الإدارة
        ]);

        event(new Registered($user));

        // إشعار المديرين بطلب تسجيل جديد (يمكن إضافة إشعار أو إيميل هنا)
        // $this->notifyAdmins($user);

        Auth::login($user);

        // توجيه المستخدم لصفحة انتظار الموافقة
        return redirect()->route('register.pending')->with('success', 
            'تم تسجيل متجرك بنجاح! حسابك قيد المراجعة من قبل الإدارة.');
    }

    /**
     * إشعار المديرين بطلب تسجيل متجر جديد
     * (وظيفة اختيارية يمكن تفعيلها لاحقاً)
     */
    private function notifyAdmins(User $shopOwner): void
    {
        // يمكن إرسال إيميل للمديرين
        // أو إضافة إشعار في لوحة التحكم
        // أو إرسال رسالة عبر تليجرام
        
        /*
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            // إرسال إيميل أو إشعار
        }
        */
    }
}