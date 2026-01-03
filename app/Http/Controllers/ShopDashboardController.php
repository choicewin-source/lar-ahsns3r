<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopDashboardController extends Controller
{
    /**
     * لوحة تحكم صاحب المتجر (يعرض منتجاته فقط + إحصائيات بسيطة)
     */
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless($user && $user->isShopOwner(), 403);
        abort_unless($user->is_approved, 403, 'حساب المتجر يحتاج موافقة الإدارة');

        $products = Product::query()
            ->where('is_approved', true)
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
            'today_products' => (clone $baseShopProductsQuery)
                ->whereDate('created_at', today())
                ->count(),
        ];

        return view('shop.dashboard', compact('products', 'stats'));
    }
}