<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen" dir="rtl">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl shadow-lg border-t-8 border-red-600 p-8">
                
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">⚠️</div>
                    <h1 class="text-2xl font-black text-gray-900">إبلاغ عن مخالفة</h1>
                    <p class="text-gray-500 text-sm mt-2">ساعدنا نخلي المنصة نظيفة وصادقة. إبلاغك سري ومهم جداً.</p>
                </div>

                <form class="space-y-5">
                    
                    <!-- رابط أو اسم المنتج -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">رابط المنتج أو اسم المحل المخالف</label>
                        <input type="text" placeholder="انسخ الرابط هنا.." class="w-full border-gray-300 rounded-lg focus:ring-red-500">
                    </div>

                    <!-- نوع المخالفة -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">نوع المخالفة</label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition">
                                <input type="radio" name="reason" class="text-red-600 focus:ring-red-500">
                                <span class="text-sm">سعر وهمي / غير حقيقي</span>
                            </label>
                            <label class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition">
                                <input type="radio" name="reason" class="text-red-600 focus:ring-red-500">
                                <span class="text-sm">منتج ممنوع أو غير لائق</span>
                            </label>
                            <label class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition">
                                <input type="radio" name="reason" class="text-red-600 focus:ring-red-500">
                                <span class="text-sm">احتيال أو سوء معاملة</span>
                            </label>
                        </div>
                    </div>

                    <!-- تفاصيل -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">تفاصيل إضافية</label>
                        <textarea rows="3" placeholder="اشرح لنا المشكلة باختصار.." class="w-full border-gray-300 rounded-lg focus:ring-red-500"></textarea>
                    </div>

                    <button type="button" onclick="alert('شكراً لإبلاغك، سنراجع الأمر فوراً')" class="w-full bg-red-600 text-white py-3 rounded-lg font-bold hover:bg-red-700 transition shadow-md">
                        إرسال الإبلاغ
                    </button>

                    <p class="text-xs text-center text-gray-400 mt-4">
                        * سيقوم فريقنا بمراجعة البلاغ خلال 24 ساعة واتخاذ الإجراء اللازم.
                    </p>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>