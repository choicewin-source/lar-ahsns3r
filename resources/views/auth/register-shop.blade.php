<x-guest-layout>
    <div class="max-w-xl mx-auto py-12">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">سجل متجرك</h2>
            <form method="POST" action="{{ route('shop.register.store') }}">
                @csrf
                <div class="mb-3">
                    <x-input-label for="name" :value="__('اسم صاحب المتجر')" />
                    <x-text-input id="name" name="name" class="block mt-1 w-full" value="{{ old('name') }}" required autofocus />
                </div>

                <div class="mb-3">
                    <x-input-label for="shop_name" :value="__('اسم المتجر')" />
                    <x-text-input id="shop_name" name="shop_name" class="block mt-1 w-full" value="{{ old('shop_name') }}" required />
                </div>

                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <x-input-label for="shop_city" :value="__('مدينة المتجر')" />
                        <x-text-input id="shop_city" name="shop_city" class="block mt-1 w-full" value="{{ old('shop_city') }}" />
                    </div>
                    <div>
                        <x-input-label for="shop_phone" :value="__('رقم الجوال')" />
                        <x-text-input id="shop_phone" name="shop_phone" class="block mt-1 w-full" value="{{ old('shop_phone') }}" />
                    </div>
                </div>

                <div class="mb-3">
                    <x-input-label for="email" :value="__('البريد الإلكتروني')" />
                    <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" value="{{ old('email') }}" required />
                </div>

                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <x-input-label for="password" :value="__('كلمة المرور')" />
                        <x-text-input id="password" name="password" type="password" class="block mt-1 w-full" required />
                    </div>
                    <div>
                        <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block mt-1 w-full" required />
                    </div>
                </div>

                <div class="text-left">
                    <button class="bg-red-600 text-white px-4 py-2 rounded">إرسال طلب التسجيل</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
<x-guest-layout>
    <form method="POST" action="{{ route('shop.register') }}">
        @csrf

        <h2 class="text-2xl font-bold mb-4">سجل متجرك</h2>

        <div class="grid grid-cols-1 gap-4">
            <div>
                <x-input-label for="name" :value="__('اسم صاحب المتجر')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="shop_name" :value="__('اسم المتجر')" />
                <x-text-input id="shop_name" class="block mt-1 w-full" type="text" name="shop_name" :value="old('shop_name')" required />
                <x-input-error :messages="$errors->get('shop_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="shop_city" :value="__('مدينة المتجر')" />
                <x-text-input id="shop_city" class="block mt-1 w-full" type="text" name="shop_city" :value="old('shop_city')" />
                <x-input-error :messages="$errors->get('shop_city')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="shop_phone" :value="__('هاتف المتجر')" />
                <x-text-input id="shop_phone" class="block mt-1 w-full" type="text" name="shop_phone" :value="old('shop_phone')" />
                <x-input-error :messages="$errors->get('shop_phone')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('البريد الإلكتروني')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('كلمة المرور')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:underline">العودة</a>
            <x-primary-button class="ms-4">{{ __('سجل متجرك') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
