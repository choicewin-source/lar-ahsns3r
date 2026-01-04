<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen" dir="rtl">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-8 text-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                        📞
                    </div>
                    <h1 class="text-3xl font-black text-white mb-2">تواصل معنا</h1>
                    <p class="text-blue-100 font-medium">عندك اقتراح؟ مشكلة؟ أو حابب تعلن عنا؟ إحنا بنسمعك!</p>
                </div>

                <div class="p-8">
                    {{-- قسم تيليجرام الرئيسي --}}
                    <div class="mb-8">
                        <a href="https://t.me/shady2013" target="_blank" class="group flex items-center gap-6 p-8 bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 border-2 border-blue-200 hover:border-blue-400 rounded-3xl transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-2">
                            <div class="w-20 h-20 bg-blue-600 rounded-3xl flex items-center justify-center flex-shrink-0 shadow-xl group-hover:scale-110 transition-transform">
                                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 8.161c-.18 1.897-.962 6.502-1.359 8.627-.168.9-.5 1.201-.82 1.23-.697.064-1.226-.461-1.901-.903-1.056-.692-1.653-1.123-2.678-1.799-1.185-.781-.417-1.21.258-1.911.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.139-5.062 3.345-.479.329-.913.489-1.302.481-.428-.008-1.252-.242-1.865-.442-.752-.244-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.831-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635.099-.002.321.023.465.14.121.098.155.231.171.324.016.093.036.305.02.469z"/>
                                </svg>
                            </div>
                            <div class="flex-1 text-right">
                                <p class="text-base font-bold text-blue-600 mb-2">تواصل معنا عبر تيليجرام</p>
                                <p class="text-3xl font-black text-gray-900 group-hover:text-blue-600 transition-colors mb-2">@shady2013</p>
                                <p class="text-sm text-gray-600 font-medium">الطريقة المفضلة والأسرع للتواصل معنا</p>
                            </div>
                            <div class="flex-shrink-0 hidden md:block">
                                <svg class="w-8 h-8 text-blue-400 group-hover:text-blue-600 transform group-hover:translate-x-2 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </div>
                        </a>
                    </div>

                    <!-- معلومات إضافية -->
                    <div class="bg-gradient-to-r from-purple-50 to-blue-50 border border-purple-200 rounded-2xl p-6">
                        <h2 class="text-xl font-black text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            ليش تواصل معنا؟
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white rounded-xl p-4 border border-purple-100">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mb-3">
                                    💡
                                </div>
                                <h3 class="font-bold text-gray-900 mb-1">الاقتراحات</h3>
                                <p class="text-xs text-gray-600">عندك فكرة لتطوير المنصة؟ شاركنا!</p>
                            </div>

                            <div class="bg-white rounded-xl p-4 border border-blue-100">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                                    🤝
                                </div>
                                <h3 class="font-bold text-gray-900 mb-1">الشراكات</h3>
                                <p class="text-xs text-gray-600">حابب تعلن معنا أو تتعاون؟</p>
                            </div>

                            <div class="bg-white rounded-xl p-4 border border-green-100">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mb-3">
                                    🔧
                                </div>
                                <h3 class="font-bold text-gray-900 mb-1">الدعم الفني</h3>
                                <p class="text-xs text-gray-600">عندك مشكلة؟ بنساعدك فوراً!</p>
                            </div>
                        </div>
                    </div>

                    <!-- ملاحظة -->
                    <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="text-sm">
                            <p class="font-bold text-yellow-900 mb-1">ملاحظة هامة</p>
                            <p class="text-yellow-800">
                                للإبلاغ عن مخالفات في المنصة، يرجى استخدام <a href="{{ route('report') }}" class="underline font-bold hover:text-yellow-900">صفحة الإبلاغ</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>