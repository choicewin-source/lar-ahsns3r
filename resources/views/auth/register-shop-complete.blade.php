<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
        <h2 class="text-2xl font-black text-gray-800">أكمل تسجيل متجرك 🏪</h2>
        <p class="text-gray-500 text-sm mt-2">تم تسجيل دخولك عبر Google بنجاح</p>
        
        <!-- معلومات المستخدم من Google -->
        <div class="mt-4 bg-green-50 border border-green-200 rounded-lg p-3 text-right">
            <div class="flex items-center justify-between">
                <div class="text-sm">
                    <p class="font-bold text-green-800">{{ $user->name }}</p>
                    <p class="text-green-600">{{ $user->email }}</p>
                </div>
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full border-2 border-green-300">
                @endif
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('shop.register.complete.store') }}">
        @csrf

        <!-- اسم المتجر -->
        <div class="mb-5">
            <x-input-label for="shop_name" :value="__('اسم المعرض / المتجر')" class="text-gray-700 font-bold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <x-text-input id="shop_name" class="block w-full pr-10 py-3 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm transition-all" 
                            type="text" name="shop_name" :value="old('shop_name')" required autofocus autocomplete="organization" placeholder="مثال: معرض القدس للأجهزة الكهربائية" />
            </div>
            <x-input-error :messages="$errors->get('shop_name')" class="mt-2" />
            <p class="text-xs text-gray-400 mt-1">سيظهر هذا الاسم بجانب جميع منتجاتك</p>
        </div>

        <!-- المدينة -->
        <div class="mb-5">
            <x-input-label for="shop_city" :value="__('المدينة')" class="text-gray-700 font-bold" />
            <select id="shop_city" name="shop_city" class="block w-full py-3 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm transition-all" required>
                <option value="">اختر المدينة</option>
                <option value="شمال غزة" {{ old('shop_city') == 'شمال غزة' ? 'selected' : '' }}>شمال غزة</option>
                <option value="مدينة غزة" {{ old('shop_city') == 'مدينة غزة' ? 'selected' : '' }}>مدينة غزة</option>
                <option value="المنطقة الوسطى" {{ old('shop_city') == 'المنطقة الوسطى' ? 'selected' : '' }}>المنطقة الوسطى</option>
                <option value="خانيونس" {{ old('shop_city') == 'خانيونس' ? 'selected' : '' }}>خانيونس</option>
                <option value="رفح" {{ old('shop_city') == 'رفح' ? 'selected' : '' }}>رفح</option>
            </select>
            <x-input-error :messages="$errors->get('shop_city')" class="mt-2" />
        </div>

        <!-- رقم الهاتف -->
        <div class="mb-5">
            <x-input-label for="shop_phone" :value="__('رقم الهاتف (اختياري)')" class="text-gray-700 font-bold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <x-text-input id="shop_phone" class="block w-full pr-10 py-3 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm transition-all" 
                            type="tel" name="shop_phone" :value="old('shop_phone')" placeholder="مثال: 0591234567" />
            </div>
            <x-input-error :messages="$errors->get('shop_phone')" class="mt-2" />
        </div>

        <!-- شروط التسجيل -->
        <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-100">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="mr-3">
                    <p class="text-sm text-blue-800 font-medium">ملاحظات هامة:</p>
                    <ul class="mt-1 text-xs text-blue-700 space-y-1">
                        <li>• سيتم مراجعة حسابك من قبل الإدارة قبل تفعيله</li>
                        <li>• سيتم إشعارك عبر البريد الإلكتروني عند الموافقة</li>
                        <li>• يمكنك إضافة منتجاتك فور تفعيل الحساب</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- زر إكمال التسجيل -->
        <div class="mt-8">
            <x-primary-button class="w-full justify-center py-3.5 text-lg font-bold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:bg-blue-800 active:bg-blue-900 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 rounded-xl">
                {{ __('إكمال تسجيل المتجر') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>