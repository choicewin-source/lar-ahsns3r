<x-guest-layout>
    <div dir="rtl" class="text-right">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-yellow-50 mb-4">
                <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <h2 class="text-2xl font-black text-gray-800">تأكيد البريد الإلكتروني 📧</h2>
            <p class="text-gray-500 mt-2 text-sm">شكراً لتسجيلك في <span class="text-red-600 font-bold">أحسن سعر</span>!</p>
        </div>

        <div class="mb-6 text-sm text-gray-600 bg-gray-50 p-4 rounded-xl border border-gray-100">
            لقد أرسلنا رابط تفعيل إلى بريدك الإلكتروني. يرجى الضغط على الرابط في الرسالة لتفعيل حسابك والبدء في استخدام المنصة.
            <br><br>
            <strong>لم تصلك الرسالة؟</strong> يمكننا إرسالها مرة أخرى.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 font-bold text-sm text-green-600 bg-green-50 p-3 rounded-lg text-center">
                ✅ تم إرسال رابط تفعيل جديد إلى بريدك الإلكتروني.
            </div>
        @endif

        <div class="mt-6 flex items-center justify-between gap-4">
            <form method="POST" action="{{ route('verification.send') }}" class="flex-1">
                @csrf
                <button type="submit" class="w-full justify-center py-3 px-4 text-sm font-bold text-white bg-gray-800 hover:bg-gray-900 rounded-xl shadow-lg transition transform hover:-translate-y-0.5">
                    إعادة إرسال الرابط
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-red-600 font-bold underline decoration-2 decoration-transparent hover:decoration-red-600 transition-all">
                    تسجيل الخروج
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
