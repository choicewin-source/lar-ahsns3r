<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * عرض صفحة التعديل باستخدام التوكن السري
     * هذا الكود بيشتغل لما المستخدم يضغط على الرابط اللي بيوصله بعد الإضافة
     */
    public function edit($token)
    {
        // 1. البحث عن المنتج اللي عنده هاد التوكن
        $product = Product::where('edit_token', $token)->first();

        // 2. إذا الرابط غلط أو قديم
        if (!$product) {
            return redirect()->route('home')->with('error', 'رابط التعديل هذا غير صالح أو منتهي الصلاحية.');
        }

        // 3. توجيه لصفحة التعديل (View)
        // ملاحظة: تأكد إن ملف العرض اسمه edit.blade.php موجود داخل مجلد products أو حسب ما سميته
        // حسب الملفات اللي بعثتها، رح نفترض إنه موجود مباشرة في resources/views/products/edit.blade.php
        // إذا كان الملف برا المجلد، غيرها لـ return view('edit', compact('product'));
        return view('products.edit', compact('product'));
    }

    /**
     * حفظ التعديلات في قاعدة البيانات
     */
    public function update(Request $request, $token)
    {
        // 1. جلب المنتج
        $product = Product::where('edit_token', $token)->firstOrFail();

        // 2. التحقق من صحة البيانات (بنسمح بتعديل السعر والمكان فقط للمصداقية)
        $request->validate([
            'price' => 'required|numeric|min:0',
            'shop_name' => 'required|string|max:255',
            'address_details' => 'nullable|string',
        ]);

        // 3. التحديث
        $product->update([
            'price' => $request->price,
            'shop_name' => $request->shop_name,
            'address_details' => $request->address_details,
            // بنحدث تاريخ التعديل تلقائياً عشان يبين للناس إنه السعر جديد
        ]);

        // 4. العودة للرئيسية مع رسالة نجاح
        return redirect()->route('products.show', $product->id)
                         ->with('success', 'تم تحديث السعر بنجاح! شكراً لأمانتك.');
    }
}