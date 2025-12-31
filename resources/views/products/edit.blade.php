<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-yellow-50 border-r-4 border-yellow-400 p-4 mb-4 rounded shadow-sm">
                <div class="flex">
                    <div class="mr-3">
                        <h3 class="text-sm font-medium text-yellow-800">وضع التعديل</h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            أنت الآن تقوم بتعديل بيانات منتج باستخدام الرابط الخاص بك.
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold mb-6 text-gray-800">تعديل: {{ $product->name }}</h2>

                <form action="{{ route('products.update', $product->edit_token) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- السعر -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">تحديث السعر</label>
                        <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 border-green-200 bg-green-50 font-bold text-lg">
                    </div>

                    <!-- المحل -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">اسم المحل</label>
                        <input type="text" name="shop_name" value="{{ $product->shop_name }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- تفاصيل العنوان -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">تحديث العنوان</label>
                        <textarea name="address_details" rows="2"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $product->address_details }}</textarea>
                    </div>

                    <!-- زر الحفظ -->
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition">
                        حفظ التعديلات ✅
                    </button>
                    
                    <a href="{{ route('home') }}" class="block text-center mt-4 text-gray-500 text-sm hover:underline">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>