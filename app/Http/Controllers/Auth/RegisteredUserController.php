<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['nullable', 'in:user,shop_owner'],
            'shop_name' => ['nullable', 'string', 'max:255'],
            'shop_city' => ['nullable', 'string', 'max:255'],
            'shop_phone' => ['nullable', 'string', 'max:50'],
        ]);

        $role = $request->input('role', 'user');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'shop_name' => $request->shop_name,
            'shop_city' => $request->shop_city,
            'shop_phone' => $request->shop_phone,
            // shop owners require admin approval
            'is_approved' => $role === 'shop_owner' ? false : true,
        ]);

        event(new Registered($user));

        if ($role === 'shop_owner') {
            // Do not auto-login shop owners until admin approves
            return redirect()->route('register.pending');
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
