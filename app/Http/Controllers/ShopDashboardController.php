<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class ShopDashboardController extends Controller
{
    /**
     * لوحة تحكم صاحب المتجر (يعرض منتجاته فقط + إحصائيات بسيطة)
     */
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless($user && $user->isShopOwner(), 403);
        
        // إذا لم يتم قبول المتجر بعد، وجهه لصفحة الانتظار
        if (!$user->is_approved) {
            return redirect()->route('register.pending');
        }

        $products = Product::query()
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('shop_name', $user->shop_name);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $baseShopProductsQuery = Product::query()
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('shop_name', $user->shop_name);
            });

        $stats = [
            'total_products' => (clone $baseShopProductsQuery)->count(),
            'approved_products' => (clone $baseShopProductsQuery)->where('is_approved', true)->count(),
            'pending_products' => (clone $baseShopProductsQuery)->where('is_approved', false)->count(),
            'today_products' => (clone $baseShopProductsQuery)
                ->whereDate('created_at', today())
                ->count(),
        ];

        return view('shop.dashboard', compact('products', 'stats'));
    }

    /**
     * تحديث معلومات المتجر
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        abort_unless($user && $user->isShopOwner(), 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'shop_name' => ['required', 'string', 'max:255'],
            'shop_city' => ['required', 'string', 'max:255'],
            'shop_phone' => ['nullable', 'string', 'max:20'],
            'shop_address' => ['nullable', 'string', 'max:500'],
            'shop_description' => ['nullable', 'string', 'max:1000'],
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'تم تحديث معلومات المتجر بنجاح');
    }

    /**
     * رفع شعار المتجر
     */
    public function uploadLogo(Request $request)
    {
        $user = $request->user();

        abort_unless($user && $user->isShopOwner(), 403);

        $request->validate([
            'shop_logo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        // حذف الشعار القديم
        if ($user->shop_logo) {
            Storage::disk('public')->delete($user->shop_logo);
        }

        // رفع الشعار الجديد
        $path = $request->file('shop_logo')->store('shop-logos', 'public');

        $user->update(['shop_logo' => $path]);

        return redirect()->back()->with('success', 'تم رفع شعار المتجر بنجاح');
    }

    /**
     * حذف شعار المتجر
     */
    public function deleteLogo(Request $request)
    {
        $user = $request->user();

        abort_unless($user && $user->isShopOwner(), 403);

        if ($user->shop_logo) {
            Storage::disk('public')->delete($user->shop_logo);
            $user->update(['shop_logo' => null]);
        }

        return redirect()->back()->with('success', 'تم حذف شعار المتجر');
    }
}