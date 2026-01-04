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
                <a href="{{ route('shop.register') }}" class="inline-flex items-center gap-1 font-bold text-gray-700 hover:text-blue-600 transition bg-gray-50 hover:bg-blue-50 px-4 py-2 rounded-lg border border-gray-200 hover:border-blue-200">
                    🏪 تسجيل متجر جديد
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>