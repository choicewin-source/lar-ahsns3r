<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;

class ShopController extends Controller
{
    public function show($id)
    {
        $shop = User::findOrFail($id);

        $products = Product::query()
            ->where('is_approved', true)
            ->when($shop->shop_name, function($q) use ($shop){
                $q->where('shop_name', $shop->shop_name);
            })
            ->when($shop->id, function($q) use ($shop){
                $q->orWhere('user_id', $shop->id);
            })
            ->orderBy('price', 'asc')
            ->paginate(24);

        return view('shop.show', compact('shop', 'products'));
    }
}
