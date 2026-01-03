<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreProductRequest extends FormRequest
{
    /**
     * تحديد ما إذا كان المستخدم مصرحاً لإجراء الطلب
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قواعد التحقق للبيانات
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'sub_category' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0.01|max:1000000',
            'city' => 'required|string|max:255',
            'address_details' => 'nullable|string|max:500',
            'shop_name' => 'required|string|max:255',
            'contact_phone' => 'nullable|string|max:25|regex:/^[\d\-\+\s\(\)]{8,25}$/',
            'added_by' => 'required|in:customer,shop_owner',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ];
    }

    /**
     * رسائل التحقق المخصصة
     */
    public function messages(): array
    {
        return [
            'name.required' => 'اسم المنتج مطلوب',
            'name.max' => 'اسم المنتج يجب أن لا يتجاوز 255 حرفاً',
            'category.required' => 'فئة المنتج مطلوبة',
            'price.required' => 'السعر مطلوب',
            'price.numeric' => 'السعر يجب أن يكون رقماً',
            'price.min' => 'السعر يجب أن يكون أكبر من الصفر',
            'price.max' => 'السعر كبير جداً',
            'city.required' => 'المدينة مطلوبة',
            'shop_name.required' => 'اسم المتجر مطلوب',
            'contact_phone.regex' => 'رقم الهاتف غير صحيح',
            'image.image' => 'الملف المرفق يجب أن يكون صورة',
            'image.mimes' => 'الصورة يجب أن تكون من نوع: jpeg, png, jpg, gif, webp',
            'image.max' => 'حجم الصورة يجب أن لا يتجاوز 5 ميجابايت',
            'added_by.required' => 'نوع المُضيف مطلوب',
            'added_by.in' => 'نوع المُضيف غير صحيح',
        ];
    }

    /**
     * تحويل الأسماء إلى العربية لرسائل الخطأ
     */
    public function attributes(): array
    {
        return [
            'name' => 'اسم المنتج',
            'category' => 'الفئة',
            'price' => 'السعر',
            'city' => 'المدينة',
            'shop_name' => 'اسم المتجر',
            'contact_phone' => 'رقم الهاتف',
            'image' => 'الصورة',
        ];
    }
}