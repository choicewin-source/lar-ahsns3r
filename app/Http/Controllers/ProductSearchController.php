<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductSearchController extends Controller
{
    /**
     * البحث التلقائي مع اقتراحات
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $category = $request->get('category');
        $subCategory = $request->get('sub_category');
        $brand = $request->get('brand');

        if (!$query) {
            return response()->json([]);
        }

        $productsQuery = Product::where('is_approved', true);

        // البحث في الاسم والعلامة التجارية والفئة
        $productsQuery->where(function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
              ->orWhere('brand', 'like', '%' . $query . '%')
              ->orWhere('category', 'like', '%' . $query . '%');
        });

        // فلترة حسب القسم والنوع والشركة إذا وجدت
        if ($category) {
            $productsQuery->where('category', $category);
        }
        if ($subCategory) {
            $productsQuery->where('sub_category', $subCategory);
        }
        if ($brand) {
            $productsQuery->where('brand', $brand);
        }

        // جلب النتائج مرتبة حسب السعر الأقل
        $products = $productsQuery
            ->orderBy('price', 'asc')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get(['id', 'name', 'price', 'shop_name', 'city', 'created_at', 'reference_code', 'brand']);

        // تجهيز البيانات للرد
        $suggestions = $products->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'brand' => $product->brand,
                'price' => ProductHelper::formatPrice((float) $product->price),
                'shop_name' => $product->shop_name,
                'city' => $product->city,
                'date' => $product->created_at->format('Y-m-d H:i'),
                'reference_code' => $product->reference_code ?: ProductHelper::generateReferenceCode($product->id),
            ];
        });

        return response()->json($suggestions);
    }

    /**
     * جلب جميع منتجات موديل معين من الأقدم للأحدث
     */
    public function getModelProducts(Request $request, $model)
    {
        $category = $request->get('category');
        $subCategory = $request->get('sub_category');
        $brand = $request->get('brand');

        if (!$model || !$category || !$subCategory) {
            return response()->json(['error' => 'البيانات غير مكتملة']);
        }

        // جلب جميع منتجات نفس الموديل مرتبة حسب السعر الأقل
        $products = Product::where('is_approved', true)
            ->where('name', $model)
            ->where('category', $category)
            ->where('sub_category', $subCategory)
            ->when($brand, function($query) use ($brand) {
                $query->where('brand', $brand);
            })
            ->orderBy('price', 'asc')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name', 'price', 'shop_name', 'city', 'created_at', 'reference_code', 'brand']);

        // تجهيز شكل موحد للـ JSON
        $payload = $products->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'brand' => $p->brand,
                'shop_name' => $p->shop_name,
                'city' => $p->city,
                'created_at' => $p->created_at?->toISOString(),
                'reference_code' => $p->reference_code ?: ProductHelper::generateReferenceCode($p->id),
                'price' => ProductHelper::formatPrice((float) $p->price),
            ];
        });

        return response()->json($payload);
    }
}