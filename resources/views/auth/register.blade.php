<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role: user or shop_owner -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Account Type')" />
            <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded">
                <option value="user">مستخدم عادي</option>
                <option value="shop_owner">صاحب محل / متجر</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Shop details (optional) -->
        <div class="mt-4">
            <x-input-label for="shop_name" :value="__('Shop Name (if registering as shop)')" />
            <x-text-input id="shop_name" class="block mt-1 w-full" type="text" name="shop_name" :value="old('shop_name')" />
            <x-input-error :messages="$errors->get('shop_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="shop_city" :value="__('Shop City')" />
            <x-text-input id="shop_city" class="block mt-1 w-full" type="text" name="shop_city" :value="old('shop_city')" />
            <x-input-error :messages="$errors->get('shop_city')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="shop_phone" :value="__('Shop Phone')" />
            <x-text-input id="shop_phone" class="block mt-1 w-full" type="text" name="shop_phone" :value="old('shop_phone')" />
            <x-input-error :messages="$errors->get('shop_phone')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
