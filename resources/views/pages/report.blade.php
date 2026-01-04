<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen" dir="rtl">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl shadow-lg border-t-8 border-red-600 p-8">
                
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-black text-gray-900">إبلاغ عن مخالفة</h1>
                    <p class="text-gray-600 text-sm mt-2 font-medium">ساعدنا نخلي المنصة نظيفة وصادقة. إبلاغك سري ومهم جداً.</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="font-bold">{{ session('success') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('report.store') }}" class="space-y-6">
                    @csrf
                    
                    <!-- رابط أو اسم المنتج -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">رابط المنتج أو اسم المحل المخالف</label>
                        <input 
                            type="text" 
                            name="product_link"
                            value="{{ old('product_link') }}"
                            placeholder="انسخ الرابط هنا أو اكتب اسم المنتج/المحل..." 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 font-medium">
                        @error('product_link')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">اسم المحل (إن وجد)</label>
                        <input 
                            type="text" 
                            name="shop_name"
                            value="{{ old('shop_name') }}"
                            placeholder="اسم المحل..." 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 font-medium">
                    </div>

                    <!-- نوع المخالفة -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">
                            نوع المخالفة
                            <span class="text-red-600">*</span>
                        </label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:bg-red-50 hover:border-red-300 transition-all">
                                <input 
                                    type="radio" 
                                    name="reason" 
                                    value="سعر وهمي / غير حقيقي"
                                    {{ old('reason') == 'سعر وهمي / غير حقيقي' ? 'checked' : '' }}
                                    class="text-red-600 focus:ring-red-500 w-5 h-5"
                                    required>
                                <div>
                                    <p class="font-bold text-gray-900">سعر وهمي / غير حقيقي</p>
                                    <p class="text-xs text-gray-500">السعر المعلن غير موجود في الواقع</p>
                                </div>
                            </label>
                            
                            <label class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:bg-red-50 hover:border-red-300 transition-all">
                                <input 
                                    type="radio" 
                                    name="reason" 
                                    value="منتج ممنوع أو غير لائق"
                                    {{ old('reason') == 'منتج ممنوع أو غير لائق' ? 'checked' : '' }}
                                    class="text-red-600 focus:ring-red-500 w-5 h-5"
                                    required>
                                <div>
                                    <p class="font-bold text-gray-900">منتج ممنوع أو غير لائق</p>
                                    <p class="text-xs text-gray-500">منتجات محظورة أو محتوى غير مناسب</p>
                                </div>
                            </label>
                            
                            <label class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:bg-red-50 hover:border-red-300 transition-all">
                                <input 
                                    type="radio" 
                                    name="reason" 
                                    value="احتيال أو سوء معاملة"
                                    {{ old('reason') == 'احتيال أو سوء معاملة' ? 'checked' : '' }}
                                    class="text-red-600 focus:ring-red-500 w-5 h-5"
                                    required>
                                <div>
                                    <p class="font-bold text-gray-900">احتيال أو سوء معاملة</p>
                                    <p class="text-xs text-gray-500">تجربة سيئة مع البائع</p>
                                </div>
                            </label>

                            <label class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:bg-red-50 hover:border-red-300 transition-all">
                                <input 
                                    type="radio" 
                                    name="reason" 
                                    value="محتوى مكرر أو سبام"
                                    {{ old('reason') == 'محتوى مكرر أو سبام' ? 'checked' : '' }}
                                    class="text-red-600 focus:ring-red-500 w-5 h-5"
                                    required>
                                <div>
                                    <p class="font-bold text-gray-900">محتوى مكرر أو سبام</p>
                                    <p class="text-xs text-gray-500">منتجات متكررة أو إعلانات مزعجة</p>
                                </div>
                            </label>

                            <label class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:bg-red-50 hover:border-red-300 transition-all">
                                <input 
                                    type="radio" 
                                    name="reason" 
                                    value="أخرى"
                                    {{ old('reason') == 'أخرى' ? 'checked' : '' }}
                                    class="text-red-600 focus:ring-red-500 w-5 h-5"
                                    required>
                                <div>
                                    <p class="font-bold text-gray-900">أخرى</p>
                                    <p class="text-xs text-gray-500">سبب آخر (يرجى التفصيل أدناه)</p>
                                </div>
                            </label>
                        </div>
                        @error('reason')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- تفاصيل -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">تفاصيل إضافية</label>
                        <textarea 
                            name="details"
                            rows="4" 
                            placeholder="اشرح لنا المشكلة بالتفصيل..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 font-medium resize-none">{{ old('details') }}</textarea>
                        @error('details')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- معلومات المبلغ (اختيارية) -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            معلومات الاتصال (اختيارية)
                        </h3>
                        <p class="text-xs text-gray-600 mb-4">يمكنك ترك معلوماتك للمتابعة (غير إجباري)</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">الاسم</label>
                                <input 
                                    type="text" 
                                    name="reporter_name"
                                    value="{{ old('reporter_name') }}"
                                    placeholder="اسمك..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">رقم الهاتف</label>
                                <input 
                                    type="tel" 
                                    name="reporter_phone"
                                    value="{{ old('reporter_phone') }}"
                                    placeholder="رقم هاتفك..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white py-4 rounded-xl font-black text-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        إرسال البلاغ
                    </button>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                        <p class="text-xs text-gray-600 mb-2">
                            <svg class="w-4 h-4 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <strong>سرية تامة:</strong> سيتم التعامل مع بلاغك بسرية كاملة
                        </p>
                        <p class="text-xs text-gray-500">
                            سيقوم فريقنا بمراجعة البلاغ خلال 24 ساعة واتخاذ الإجراء اللازم
                        </p>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>