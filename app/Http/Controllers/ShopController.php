<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ShopController extends Controller
{
    public function index()
    {
        $shops = User::where('role', 'shop_owner')
            ->where('is_approved', true)
            ->withCount('products')
            ->orderBy('name')
            ->paginate(20);

        return view('shop.index', compact('shops'));
    }

    public function show($id)
    {
        $shop = User::where('role', 'shop_owner')
            ->where('is_approved', true)
            ->findOrFail($id);

        // جلب منتجات المتجر - تحسين الاستعلام
        $products = Product::where('is_approved', true)
            ->where(function($query) use ($shop) {
                $query->where('shop_name', $shop->shop_name)
                      ->orWhere('user_id', $shop->id);
            })
            ->orderBy('price', 'asc')
            ->paginate(24);

        return view('shop.show', compact('shop', 'products'));
    }
}
