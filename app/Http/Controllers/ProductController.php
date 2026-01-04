<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Helpers\ProductHelper;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * عرض صفحة التفاصيل
     */
    public function show($id)
    {
        $product = Product::with(['user', 'comments.user'])->findOrFail($id);
        
        // جلب المنتجات المشابهة (نفس القسم أو الفئة)
        $similarProducts = Product::with('user')
            ->where('is_approved', true)
            ->where('id', '!=', $product->id)
            ->where(function($query) use ($product) {
                $query->where('category', $product->category)
                      ->orWhere('sub_category', $product->sub_category);
            })
            ->orderBy('price', 'asc')
            ->limit(8)
            ->get();

        return view('products.show', compact('product', 'similarProducts'));
    }

    /**
     * عرض صفحة التعديل باستخدام التوكن السري
     */
    public function edit($token)
    {
        $product = Product::where('edit_token', $token)->first();

        if (!$product) {
            return redirect()->route('home')->with('error', 'رابط التعديل هذا غير صالح أو منتهي الصلاحية.');
        }

        return view('products.edit', compact('product'));
    }

    /**
     * حفظ التعديلات في قاعدة البيانات
     */
    public function update(UpdateProductRequest $request, $token)
    {
        $product = Product::where('edit_token', $token)->firstOrFail();

        // تحديث الصورة إذا تم رفع جديدة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
        }

        // تحديث البيانات
        $product->update($request->only([
            'name', 'price', 'city', 'address_details', 
            'shop_name', 'contact_phone', 'condition'
        ]));

        return redirect()->route('products.show', $product->id)
                         ->with('success', 'تم تحديث المنتج بنجاح!');
    }

    /**
     * عرض جميع المنتجات (جرد)
     */
    public function index(Request $request)
    {
        $query = Product::with('user:id,name,shop_name,is_approved')
            ->where('is_approved', true);

        // البحث
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // فلترة حسب القسم
        if ($request->category) {
            $query->where('category', $request->category);
        }

        // فلترة حسب المدينة
        if ($request->city) {
            $query->where('city', $request->city);
        }

        // الترتيب: الأحدث أولاً، ثم الأقل سعراً
        $products = $query->orderBy('created_at', 'desc')->orderBy('price', 'asc')->paginate(50);

        return view('products.index', compact('products'));
    }

    /**
     * عرض نموذج إضافة منتج جديد
     */
    public function create()
    {
        // نستخدم Livewire لواجهة إضافة سعر لأنها الأكثر سلاسة وهرمية
        // (Category -> SubCategory -> Brand -> Model) مع تحسين تجربة المستخدم.
        return redirect()->route('home', ['open' => 'add']);
    }

    /**
     * حفظ المنتج الجديد
     */
    public function store(StoreProductRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $productData = [
            'name' => $request->name,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'brand' => $request->brand,
            'price' => $request->price,
            'condition' => $request->condition ?? 'new',
            'city' => $request->city,
            'address_details' => $request->address_details,
            'shop_name' => $request->shop_name,
            'contact_phone' => $request->contact_phone,
            'added_by' => $request->added_by,
            'edit_token' => \Illuminate\Support\Str::random(40),
            'image_path' => $imagePath,
            'is_approved' => true,
        ];

        // إذا المستخدم مسجل ومالك متجر معتمد، اربط المنتج بحسابه
        if (auth()->check() && auth()->user()->isShopOwner() && auth()->user()->is_approved) {
            $productData['user_id'] = auth()->id();
            $productData['added_by'] = 'shop_owner';
            
            // استخدام اسم متجر المستخدم إذا كان فارغاً
            if (empty($productData['shop_name']) && auth()->user()->shop_name) {
                $productData['shop_name'] = auth()->user()->shop_name;
            }
        }

        $product = Product::create($productData);

        // ضمان توفر reference_code
        $ref = $product->reference_code ?: ProductHelper::generateReferenceCode($product->id);

        return redirect()->route('products.show', $product->id)
                         ->with('success', "تمت إضافة السعر بنجاح! كود العرض: {$ref}");
    }
}