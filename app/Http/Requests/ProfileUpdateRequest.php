<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
        ];

        // إذا كان المستخدم صاحب متجر، أضف قواعد إضافية
        if ($this->user()->isShopOwner()) {
            $rules['shop_name'] = ['required', 'string', 'max:255'];
            $rules['shop_city'] = ['required', 'string', 'max:255'];
            $rules['shop_phone'] = ['nullable', 'string', 'max:20', 'regex:/^[\d\-\+\s\(\)]{8,20}$/'];
            $rules['shop_address'] = ['nullable', 'string', 'max:500'];
            $rules['shop_description'] = ['nullable', 'string', 'max:1000'];
        }

        return $rules;
    }
}
