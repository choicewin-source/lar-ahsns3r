<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-red-600">
                
                <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">إضافة سعر جديد 🏷️</h2>

                <!-- عرض أخطاء التعبئة إن وجدت -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded relative text-sm">
                        <strong class="font-bold">يرجى تصحيح الأخطاء التالية:</strong>
                        <ul class="mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <!-- 1. اسم المنتج -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">اسم المنتج / الخدمة</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="مثلاً: ثلاجة LG 18 قدم، ايفون 15..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition">
                    </div>

                    <!-- 2. التصنيف (تم تحديث القائمة حسب طلبك) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">القسم</label>
                        <select name="category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent bg-white">
                            <option value="" disabled selected>-- اختر القسم المناسب --</option>
                            
                            <option value="جوالات وإلكترونيات">📱 جوالات وإلكترونيات</option>
                            
                            <option value="أجهزة كهربائية">🔌 أجهزة كهربائية (ثلاجات، غسالات، غواطس..)</option>
                            
                            <option value="طاقة شمسية">☀️ طاقة شمسية (ألواح، بطاريات)</option>
                            
                            <option value="أثاث ومفروشات">🛋️ أثاث ومفروشات</option>
                            
                            <option value="خيام وشوادر">⛺ خيام وشوادر</option>
                            
                            <option value="سيارات">🚗 سيارات وقطع غيار</option>
                            
                            <option value="دراجات">🚲 دراجات (نارية وهواءية)</option>
                            
                            <option value="عقارات">🏠 عقارات (إيجار/بيع)</option>
                            
                            <option value="ملابس">👕 ملابس وأحذية</option>
                            
                            <option value="أخرى">📦 أخرى</option>
                        </select>
                    </div>

                    <!-- 3. السعر -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">السعر (شيكل)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="0.00"
                                class="w-full px-4 py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-green-50 font-bold text-lg text-green-800">
                            <span class="absolute left-4 top-3.5 text-green-700 font-bold">₪</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- 4. المحل -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">اسم المحل</label>
                            <input type="text" name="shop_name" value="{{ old('shop_name') }}" placeholder="مثلاً: معرض القدس"
                                class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>

                        <!-- 5. المدينة -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">المنطقة</label>
                            <select name="city" class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-white">
                                <option value="شمال غزة">شمال غزة</option>
                                <option value="مدينة غزة">مدينة غزة</option>
                                <option value="المنطقة الوسطى">المنطقة الوسطى</option>
                                <option value="خانيونس">خانيونس</option>
                                <option value="رفح">رفح</option>
                            </select>
                        </div>
                    </div>

                    <!-- 6. تفاصيل العنوان -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">تفاصيل العنوان (اختياري)</label>
                        <textarea name="address_details" rows="2" placeholder="الشارع، المعلم القريب..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">{{ old('address_details') }}</textarea>
                    </div>

                    <!-- 7. من أنت؟ (الميزة المهمة) -->
                    <div class="mb-8 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <label class="block text-gray-800 text-sm font-bold mb-3">بصفتك مين بتنشر السعر؟</label>
                        <div class="flex gap-4">
                            <!-- خيار الزبون -->
                            <label class="flex items-center gap-2 cursor-pointer bg-white px-3 py-2 rounded border hover:bg-green-50 transition">
                                <input type="radio" name="added_by" value="customer" checked class="text-green-600 focus:ring-green-500">
                                <span class="text-sm font-medium">أنا زبون (عن تجربة)</span>
                            </label>
                            
                            <!-- خيار صاحب المحل -->
                            <label class="flex items-center gap-2 cursor-pointer bg-white px-3 py-2 rounded border hover:bg-gray-100 transition">
                                <input type="radio" name="added_by" value="shop_owner" class="text-black focus:ring-black">
                                <span class="text-sm font-medium">أنا صاحب المحل</span>
                            </label>
                        </div>
                    </div>

                    <!-- زر النشر -->
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition transform hover:scale-[1.02] flex justify-center items-center gap-2">
                        <span>نشر السعر الآن</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg>
                    </button>
                    
                    <a href="{{ route('home') }}" class="block text-center mt-4 text-gray-500 text-sm hover:text-red-600 transition">إلغاء وعودة للرئيسية</a>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>