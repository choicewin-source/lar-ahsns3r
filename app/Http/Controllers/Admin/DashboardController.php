<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * إنشاء Middleware للتأكد من صلاحيات المدير
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || !auth()->user()->isAdmin()) {
                abort(403, 'غير مصرح بالوصول');
            }
            return $next($request);
        });
    }

    /**
     * عرض لوحة التحكم الرئيسية مع الإحصائيات
     */
    public function index()
    {
        $stats = $this->getDashboardStats();
        $products = Product::with('user')->latest()->paginate(50);
        $pendingUsers = User::where('role', 'shop_owner')->where('is_approved', false)->paginate(10, ['*'], 'pending_users_page');

        return view('admin.dashboard', compact('products', 'stats', 'pendingUsers'));
    }

    /**
     * جلب إحصائيات لوحة التحكم
     */
    private function getDashboardStats(): array
    {
        return [
            'total_products' => Product::count(),
            'today_products' => Product::whereDate('created_at', today())->count(),
            'shops_count' => Product::distinct('shop_name')->count('shop_name'),
            'pending_products' => Product::where('is_approved', false)->count(),
            'pending_shops' => User::where('role', 'shop_owner')->where('is_approved', false)->count(),
        ];
    }

    /**
     * حذف منتج
     */
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        
        // حذف الصورة إذا كانت موجودة
        if ($product->image_path) {
            try {
                Storage::disk('public')->delete($product->image_path);
            } catch (\Throwable $e) {
                Log::error('Failed to delete product image: ' . $e->getMessage());
                // تجاهل الأخطاء في حذف الصور
            }
        }
        
        $product->delete();

        return redirect()->back()->with('success', 'تم حذف المنتج بنجاح');
    }

    /**
     * تبديل حالة الموافقة على المنتج
     */
    public function toggleProductApproval($id)
    {
        $product = Product::findOrFail($id);
        $product->is_approved = !$product->is_approved;
        $product->save();

        $status = $product->is_approved ? 'مفعل' : 'موقوف';
        return redirect()->back()->with('success', "تم $status المنتج بنجاح");
    }

    /**
     * الموافقة على تاجر
     */
    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->back()->with('success', 'تمت الموافقة على حساب التاجر بنجاح');
    }

    /**
     * رفض تاجر
     */
    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'تم رفض وحذف طلب التسجيل');
    }

    /**
     * تحديث بيانات منتج (للمدير فقط)
     */
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'price' => 'required|numeric|min:0|max:1000000',
            'name' => 'required|string|max:255',
            'shop_name' => 'nullable|string|max:255',
        ]);

        $product->update($validated);

        return redirect()->back()->with('success', 'تم تعديل البيانات بنجاح');
    }
    /**
 * إشعار المديرين بطلب تسجيل جديد (يمكن استدعاؤها من ShopRegisterController)
 */
private function notifyAdminsOfNewShop(User $shopOwner): void
{
    // يمكن إرسال إيميل للمديرين
    $admins = User::where('role', 'admin')->get();
    
    foreach ($admins as $admin) {
        // هنا يمكنك إرسال إيميل أو إشعار
        // مثال: Mail::to($admin->email)->send(new NewShopRegistration($shopOwner));
    }
    
    // أو يمكنك إضافة إشعار في قاعدة البيانات
    \App\Models\Notification::create([
        'user_id' => $admin->id,
        'title' => 'طلب تسجيل متجر جديد',
        'message' => "طلب تسجيل جديد من: {$shopOwner->shop_name}",
        'type' => 'shop_registration',
        'data' => ['shop_id' => $shopOwner->id],
    ]);
}
}