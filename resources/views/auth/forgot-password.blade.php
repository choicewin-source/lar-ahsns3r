<x-guest-layout>
    <div dir="rtl" class="text-right">
        <!-- رأس الصفحة -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-yellow-50 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">نسيت كلمة المرور؟ 🔑</h1>
            <p class="text-gray-500 mt-3 text-sm font-medium max-w-md mx-auto">لا مشكلة! أدخل بريدك الإلكتروني وسنرسل لك رابط لإعادة تعيين كلمة المرور</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- نموذج إعادة التعيين -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- البريد الإلكتروني -->
            <div class="group">
                <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-gray-700 font-bold" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-yellow-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <x-text-input id="email" 
                                class="block w-full pr-10 py-3 border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-xl shadow-sm transition-all" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autofocus 
                                placeholder="example@mail.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- معلومات إضافية -->
            <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-100">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-blue-800 font-bold mb-1">ملاحظة هامة:</p>
                        <ul class="text-xs text-blue-700 space-y-1">
                            <li>• سنرسل رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني</li>
                            <li>• الرابط صالح لمدة 60 دقيقة فقط</li>
                            <li>• تحقق من صندوق البريد الوارد والرسائل غير المرغوبة</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- زر الإرسال -->
            <div class="mt-8">
                <x-primary-button class="w-full justify-center py-3.5 text-lg font-bold bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 focus:bg-yellow-700 active:bg-yellow-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 rounded-xl">
                    {{ __('إرسال رابط إعادة التعيين') }}
                </x-primary-button>
            </div>

            <!-- رابط العودة -->
            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500 mb-3">تذكرت كلمة المرور؟</p>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 font-bold text-gray-700 hover:text-red-600 transition bg-gray-50 hover:bg-red-50 px-4 py-2 rounded-lg border border-gray-200 hover:border-red-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    العودة لتسجيل الدخول
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>