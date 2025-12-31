<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // لوحة التحكم الرئيسية
    public function dashboard()
    {
        // بنجيب كل المنتجات، الأحدث أولاً، مع تقسيم صفحات (Pagination)
        $products = Product::latest()->paginate(20);
        return view('dashboard', compact('products'));
    }

    // حذف منتج (صلاحية للمدير فقط)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'تم حذف المنتج المخالف بنجاح');
    }
    
    // ممكن نضيف دالة لتثبيت سعر في الأعلى (Featured) مستقبلاً
}