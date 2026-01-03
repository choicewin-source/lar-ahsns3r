<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductComparisonController extends Controller
{
    /**
     * عرض مقارنة الأسعار للموديلات المختلفة
     */
    public function compare(Request $request)
    {
        $category = $request->get('category');
        $subCategory = $request->get('sub_category');
        
        if (!$category || !$subCategory) {
            return redirect()->route('home')->with('error', 'يرجى اختيار القسم والنوع أولاً');
        }

        // جلب المنتجات مرتبة حسب السعر (الأرخص أولاً)
        $products = Product::where('is_approved', true)
            ->where('category', $category)
            ->where('sub_category', $subCategory)
            ->orderBy('price', 'asc')
            ->get([
                'id',
                'name',
                'price',
                'shop_name',
                'city',
                'reference_code',
                'added_by',
                'contact_phone',
                'created_at'
            ]);

        // استخدام unique على المجموعة لأخذ أول عنصر (الأرخص) لكل اسم موديل
        $bestPrices = $products->unique('name')->map(function ($product) {
            return [
                'model' => $product->name,
                'best_price' => $product->price,
                'shop_name' => $product->shop_name,
                'city' => $product->city,
                'reference_code' => $product->reference_code ?: ProductHelper::generateReferenceCode($product->id),
                'added_by' => $product->added_by,
                'contact_phone' => $product->contact_phone,
                'created_at' => $product->created_at,
            ];
        })->values()->all();

        return view('products.compare', compact('bestPrices', 'category', 'subCategory'));
    }
}