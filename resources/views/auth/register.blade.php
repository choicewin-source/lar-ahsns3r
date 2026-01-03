<x-guest-layout>
    <div dir="rtl" class="text-right">
        <!-- رأس الصفحة -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-50 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">إنشاء حساب جديد 🚀</h1>
            <p class="text-gray-500 mt-2 text-sm font-medium">سجل الآن في <span class="text-red-600 font-bold">أحسن سعر</span> وابدأ تجربتك</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- الاسم -->
            <div class="group mb-5">
                <x-input-label for="name" :value="__('الاسم الكامل')" class="text-gray-700 font-bold" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <x-text-input id="name" class="block w-full pr-10 py-3 border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm transition-all" 
                                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="الاسم الكريم" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- البريد الإلكتروني -->
            <div class="group mb-5">
                <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-gray-700 font-bold" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                    </div>
                    <x-text-input id="email" class="block w-full pr-10 py-3 border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm transition-all" 
                                type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="example@mail.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- كلمة المرور -->
            <div class="group mb-5">
                <x-input-label for="password" :value="__('كلمة المرور')" class="text-gray-700 font-bold" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <x-text-input id="password" class="block w-full pr-10 py-3 border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm transition-all"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password"
                                    placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- تأكيد كلمة المرور -->
            <div class="group mb-5">
                <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" class="text-gray-700 font-bold" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <x-text-input id="password_confirmation" class="block w-full pr-10 py-3 border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm transition-all"
                                    type="password"
                                    name="password_confirmation"
                                    required autocomplete="new-password"
                                    placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- زر التسجيل -->
            <div class="mt-8">
                <x-primary-button class="w-full justify-center py-3.5 text-lg font-bold bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:bg-red-800 active:bg-red-900 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 rounded-xl">
                    {{ __('تسجيل حساب جديد') }}
                </x-primary-button>
            </div>

            <!-- زر التسجيل عبر جوجل -->
            <div class="mt-4">
                <a href="{{ route('auth.google') }}" class="block w-full">
                    <x-secondary-button class="w-full justify-center py-3.5 text-lg font-bold bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 focus:ring-gray-200 shadow-sm hover:shadow-md transition-all duration-200 rounded-xl">
                        <svg class="h-6 w-6 ltr:mr-2 rtl:ml-2" viewBox="0 0 533.5 544.3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M533.5 272.1c0-18.7-1.5-36.8-4.7-54.3H272.1v102.7h146.9c-6.2 33.7-26.6 62.7-55.9 82.2v66.9h86.7c50.7-46.7 80-117.8 80-201.2z" fill="#4285F4"/>
                            <path d="M272.1 544.3c73.5 0 135.5-24.3 180.7-66.9l-86.7-66.9c-24 16-54.9 25.5-94 25.5-72.3 0-134-48.4-156.4-113.6H26.7v69.2c44.2 87.5 131.6 148 245.4 148z" fill="#34A853"/>
                            <path d="M115.7 325.2c-5.8-16-9.1-33.1-9.1-53.1s3.3-37.1 9.1-53.1V149.8H26.7C10.1 185.3 0 227.6 0 272.1s10.1 86.8 26.7 122.3l89-69.2z" fill="#FBBC04"/>
                            <path d="M272.1 107.5c40 0 75.8 13.9 103.9 40.5l76.7-76.7C407.6 24.3 342 0 272.1 0 158.4 0 71 60.5 26.7 148l89 69.2c22.4-65.2 84.1-113.6 156.4-113.6z" fill="#EA4335"/>
                        </svg>
                        {{ __('التسجيل باستخدام جوجل') }}
                    </x-secondary-button>
                </a>
            </div>

            <!-- روابط أخرى -->
            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500 mb-3">لديك حساب بالفعل؟</p>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-1 font-bold text-gray-700 hover:text-red-600 transition bg-gray-50 hover:bg-red-50 px-4 py-2 rounded-lg border border-gray-200 hover:border-red-200">
                    🔐 تسجيل الدخول
                </a>
                
                <div class="mt-4">
                    <a href="{{ route('shop.register') }}">
                        <x-secondary-button class="w-full justify-center py-3.5 text-lg font-bold bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 focus:ring-gray-200 shadow-sm hover:shadow-md transition-all duration-200 rounded-xl">
                            هل أنت صاحب محل؟ سجل متجرك هنا
                        </x-secondary-button>
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
