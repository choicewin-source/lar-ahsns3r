<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductComparisonController extends Controller
{
    /**
     * عرض مقارنة الأسعار للموديلات المختلفة
     * يتم فلترة أفضل سعر لكل موديل على حدة
     */
    public function compare(Request $request)
    {
        $category = $request->get('category');
        $subCategory = $request->get('sub_category');
        
        if (!$category || !$subCategory) {
            return redirect()->route('home')->with('error', 'يرجى اختيار القسم والنوع أولاً');
        }

        // جلب المنتجات مع معلومات الناشر
        $products = Product::where('is_approved', true)
            ->where('category', $category)
            ->where('sub_category', $subCategory)
            ->with('user:id,name,shop_name,is_approved')
            ->orderBy('price', 'asc')
            ->get([
                'id',
                'name',
                'price',
                'shop_name',
                'city',
                'reference_code',
                'added_by',
                'user_id',
                'contact_phone',
                'created_at'
            ]);

        // تجميع حسب اسم الموديل فقط (بدون condition)
        // ثم أخذ أول عنصر (الأرخص) لكل موديل
        $bestPrices = $products->groupBy(function($product) {
                return trim($product->name);
            })
            ->map(function($group) {
                // أخذ الأرخص من كل مجموعة
                $product = $group->first();
                
                return [
                    'id' => $product->id, // إضافة معرف المنتج
                    'model' => $product->name,
                    'best_price' => $product->price,
                    'shop_name' => $product->shop_name,
                    'city' => $product->city,
                    'reference_code' => $product->reference_code ?: ProductHelper::generateReferenceCode($product->id),
                    'added_by' => $product->added_by,
                    'user_id' => $product->user_id,
                    'user' => $product->user,
                    'contact_phone' => $product->contact_phone,
                    'created_at' => $product->created_at,
                ];
            })
            ->values()
            ->all();

        return view('products.compare', compact('bestPrices', 'category', 'subCategory'));
    }
}