<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
        <h2 class="text-2xl font-black text-gray-800">تسجيل متجر جديد 🏪</h2>
        <p class="text-gray-500 text-sm mt-2">انضم إلينا واعرض منتجاتك لآلاف الزبائن في غزة</p>
    </div>


    <form method="POST" action="{{ route('shop.register') }}">
        @csrf

        <!-- الاسم الشخصي -->
        <div class="mb-5">
            <x-input-label for="name" :value="__('الاسم الشخصي')" class="text-gray-700 font-bold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <x-text-input id="name" class="block w-full pr-10 py-3 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm transition-all" 
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="مثال: محمد أحمد" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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
                            type="text" name="shop_name" :value="old('shop_name')" required autocomplete="organization" placeholder="مثال: معرض القدس للأجهزة الكهربائية" />
            </div>
            <x-input-error :messages="$errors->get('shop_name')" class="mt-2" />
            <p class="text-xs text-gray-400 mt-1">سيظهر هذا الاسم بجانب جميع منتجاتك</p>
        </div>

        <!-- المدينة -->
        <div class="mb-5">
            <x-input-label for="shop_city" :value="__('المدينة')" class="text-gray-700 font-bold" />
            <select id="shop_city" name="shop_city" class="block w-full py-3 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm transition-all">
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
            <x-input-label for="shop_phone" :value="__('رقم الهاتف')" class="text-gray-700 font-bold" />
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

        <!-- البريد الإلكتروني -->
        <div class="mb-5">
            <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-gray-700 font-bold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
                <x-text-input id="email" class="block w-full pr-10 py-3 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm transition-all" 
                            type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="example@mail.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- كلمة المرور -->
        <div class="mb-5">
            <x-input-label for="password" :value="__('كلمة المرور')" class="text-gray-700 font-bold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <x-text-input id="password" class="block w-full pr-10 py-3 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm transition-all"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- تأكيد كلمة المرور -->
        <div class="mb-6">
            <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" class="text-gray-700 font-bold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <x-text-input id="password_confirmation" class="block w-full pr-10 py-3 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm transition-all"
                            type="password"
                            name="password_confirmation"
                            required autocomplete="new-password"
                            placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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

        <!-- زر التسجيل -->
        <div class="mt-8">
            <x-primary-button class="w-full justify-center py-3.5 text-lg font-bold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:bg-blue-800 active:bg-blue-900 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 rounded-xl">
                {{ __('تسجيل المتجر') }}
            </x-primary-button>
        </div>

        <!-- روابط أخرى -->
        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <p class="text-sm text-gray-500 mb-3">لديك حساب بالفعل؟</p>
            <a href="{{ route('login') }}" class="inline-flex items-center gap-1 font-bold text-gray-700 hover:text-blue-600 transition bg-gray-50 hover:bg-blue-50 px-4 py-2 rounded-lg border border-gray-200 hover:border-blue-200">
                🔐 تسجيل الدخول
            </a>
        </div>
    </form>
</x-guest-layout>