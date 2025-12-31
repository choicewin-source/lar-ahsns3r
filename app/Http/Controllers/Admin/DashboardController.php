<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User; // في حال كان في مستخدمين مستقبلاً
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // 1. الصفحة الرئيسية للوحة التحكم (الإحصائيات + جدول المنتجات)
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || !auth()->user()->isAdmin()) {
                abort(403);
            }

            return $next($request);
        });
    }

    public function index()
    {
        // إحصائيات سريعة تعرضها للمالك فوق
        $stats = [
            'total_products' => Product::count(), // عدد الأسعار الكلي
            'today_products' => Product::whereDate('created_at', today())->count(), // كم سعر انضاف اليوم
            'shops_count' => Product::distinct('shop_name')->count(), // كم محل مشارك معنا
        ];

        // جلب البيانات: الأحدث أولاً، مع ترقيم صفحات عشان لو صاروا آلاف ما يعلق الموقع
        $products = Product::latest()->paginate(50);

        // Pending shop owner registrations
        $pendingUsers = User::where('role', 'shop_owner')->where('is_approved', false)->get();

        return view('dashboard', compact('products', 'stats', 'pendingUsers'));
    }

    // 2. حذف منتج (سعر) مخالف فوراً
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'تم حذف السعر المخالف.');
    }

    // Toggle approval for a product
    public function toggleProductApproval($id)
    {
        $product = Product::findOrFail($id);
        $product->is_approved = !$product->is_approved;
        $product->save();

        return redirect()->back()->with('success', 'تم تحديث حالة الموافقة.');
    }

    // 3. تعديل سريع من المالك (لو حب يصلح اسم محل غلط أو سعر غير منطقي)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $product->update([
            'price' => $request->price,
            'name' => $request->name,
            // بنسمح للمالك يعدل أي حقل بيشوفه مناسب
        ]);

        return redirect()->back()->with('success', 'تم تعديل البيانات بنجاح.');
    }

    // Approve a pending shop owner
    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->back()->with('success', 'تمت الموافقة على حساب التاجر.');
    }

    // Reject (delete) a pending shop owner
    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'تم رفض وحذف طلب التسجيل.');
    }
}