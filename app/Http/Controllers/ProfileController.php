<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * عرض الملف الشخصي للمستخدم
     */
    public function show(Request $request): View
    {
        $user = $request->user();
        
        // إذا كان صاحب متجر، نعرض منتجاته
        if ($user->isShopOwner()) {
            $products = Product::where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere('shop_name', $user->shop_name);
            })
            ->where('is_approved', true)
            ->latest()
            ->paginate(12);
            
            $stats = [
                'total_products' => Product::where(function($query) use ($user) {
                    $query->where('user_id', $user->id)
                          ->orWhere('shop_name', $user->shop_name);
                })->count(),
                'approved_products' => Product::where(function($query) use ($user) {
                    $query->where('user_id', $user->id)
                          ->orWhere('shop_name', $user->shop_name);
                })->where('is_approved', true)->count(),
            ];
        } else {
            $products = collect();
            $stats = [];
        }
        
        return view('profile.show', compact('user', 'products', 'stats'));
    }

    /**
     * عرض صفحة تعديل الملف الشخصي (الإعدادات)
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * تحديث معلومات الملف الشخصي
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'تم تحديث المعلومات بنجاح');
    }

    /**
     * رفع شعار/صورة المتجر
     */
    public function uploadLogo(Request $request): RedirectResponse
    {
        $request->validate([
            'shop_logo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'shop_logo.required' => 'يرجى اختيار صورة',
            'shop_logo.image' => 'الملف يجب أن يكون صورة',
            'shop_logo.mimes' => 'يجب أن تكون الصورة بصيغة jpeg, png, jpg أو webp',
            'shop_logo.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت',
        ]);

        $user = $request->user();

        // حذف الشعار القديم
        if ($user->shop_logo) {
            Storage::disk('public')->delete($user->shop_logo);
        }

        // رفع الشعار الجديد
        $path = $request->file('shop_logo')->store('shop-logos', 'public');

        $user->update(['shop_logo' => $path]);

        return Redirect::back()->with('status', 'تم تحميل صورة المتجر بنجاح');
    }

    /**
     * حذف شعار المتجر
     */
    public function deleteLogo(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->shop_logo) {
            Storage::disk('public')->delete($user->shop_logo);
            $user->update(['shop_logo' => null]);
        }

        return Redirect::back()->with('status', 'تم حذف صورة المتجر');
    }

    /**
     * حذف حساب المستخدم
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
