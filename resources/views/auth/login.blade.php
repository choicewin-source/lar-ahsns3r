<x-guest-layout>
    <!-- حالة الجلسة (للأخطاء أو الرسائل) -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div dir="rtl" class="text-right">
        <!-- رأس الصفحة -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-50 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">تسجيل الدخول 🔐</h1>
            <p class="text-gray-500 mt-2 text-sm font-medium">أهلاً بك مجدداً في منصة <span class="text-red-600 font-bold">أحسن سعر</span></p>
        </div>

        <!-- زر جوجل -->
        <div class="mb-6">
            <a href="{{ route('auth.google') }}" class="flex items-center justify-center w-full px-4 py-3 text-gray-700 transition-colors duration-200 transform bg-white border-2 border-gray-100 rounded-xl hover:bg-gray-50 hover:border-gray-200 focus:outline-none focus:ring focus:ring-gray-200 focus:ring-opacity-50 shadow-sm gap-3">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23.766 12.2764C23.766 11.4607 23.6999 10.6406 23.5588 9.83807H12.24V14.4591H18.7217C18.4528 15.9494 17.5885 17.2678 16.323 18.1056V21.1039H20.19C22.4608 19.0139 23.766 15.9274 23.766 12.2764Z" fill="#4285F4"/>
                    <path d="M12.2401 24.0008C15.4766 24.0008 18.2059 22.9382 20.1945 21.1039L16.3275 18.1055C15.2517 18.8375 13.8627 19.252 12.2445 19.252C9.11388 19.252 6.45946 17.1399 5.50705 14.3003H1.5166V17.3912C3.55371 21.4434 7.7029 24.0008 12.2401 24.0008Z" fill="#34A853"/>
                    <path d="M5.50253 14.3003C5.00236 12.8099 5.00236 11.1961 5.50253 9.70575V6.61481H1.51649C-0.18551 10.0056 -0.18551 14.0004 1.51649 17.3912L5.50253 14.3003Z" fill="#FBBC05"/>
                    <path d="M12.2401 4.74966C13.9509 4.7232 15.6044 5.36697 16.8434 6.54867L20.2695 3.12262C18.1001 1.0855 15.2208 -0.034466 12.2401 0.000808666C7.7029 0.000808666 3.55371 2.55822 1.5166 6.61481L5.50264 9.70575C6.45064 6.86173 9.10947 4.74966 12.2401 4.74966Z" fill="#EA4335"/>
                </svg>
                <span class="font-bold text-sm">الدخول باستخدام Google</span>
            </a>
        </div>

        <div class="relative flex items-center justify-center mb-6">
            <span class="absolute px-3 font-medium text-gray-500 bg-white">أو عبر البريد</span>
            <div class="w-full border-b border-gray-200"></div>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- البريد الإلكتروني -->
            <div class="group">
                <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-gray-700 font-bold" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                    </div>
                    <x-text-input id="email" class="block w-full pr-10 py-3 border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm transition-all" 
                                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="example@mail.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- كلمة المرور -->
            <div class="mt-5 group">
                <x-input-label for="password" :value="__('كلمة المرور')" class="text-gray-700 font-bold" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <x-text-input id="password" class="block w-full pr-10 py-3 border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm transition-all"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" 
                                    placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- تذكرني ونسيت كلمة المرور -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500 transition" name="remember">
                    <span class="ms-2 text-sm text-gray-600 font-medium">{{ __('تذكرني') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-red-600 hover:text-red-800 font-bold hover:underline transition" href="{{ route('password.request') }}">
                        {{ __('نسيت كلمة المرور؟') }}
                    </a>
                @endif
            </div>

            <!-- زر الدخول -->
            <div class="mt-8">
                <x-primary-button class="w-full justify-center py-3.5 text-lg font-bold bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:bg-red-800 active:bg-red-900 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 rounded-xl">
                    {{ __('تسجيل الدخول') }}
                </x-primary-button>
            </div>
            
            <!-- روابط التسجيل -->
            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500 mb-3">ليس لديك حساب في أحسن سعر؟</p>
                <div class="flex justify-center gap-4 text-sm">
                    <a href="{{ route('register') }}" class="flex items-center gap-1 font-bold text-gray-700 hover:text-red-600 transition bg-gray-50 hover:bg-red-50 px-3 py-2 rounded-lg border border-gray-200 hover:border-red-200">
                        👤 تسجيل زبون جديد
                    </a>
                    <a href="{{ route('shop.register') }}" class="flex items-center gap-1 font-bold text-gray-700 hover:text-blue-600 transition bg-gray-50 hover:bg-blue-50 px-3 py-2 rounded-lg border border-gray-200 hover:border-blue-200">
                        🏪 تسجيل متجر جديد
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>