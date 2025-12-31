<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as FacadeAuth;

class ShopRegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-shop');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'shop_name' => 'required|string|max:255',
            'shop_city' => 'nullable|string|max:255',
            'shop_phone' => 'nullable|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'shop_owner',
            'is_approved' => false,
            'shop_name' => $request->shop_name,
            'shop_city' => $request->shop_city,
            'shop_phone' => $request->shop_phone,
        ]);

        // Do not auto-login; send to pending page
        return redirect()->route('register.pending')->with('success', 'تم استلام طلب التسجيل. سيتم مراجعته من الإدارة.');
    }
}
