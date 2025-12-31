<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen" dir="rtl">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-8">
                    <h1 class="text-3xl font-black text-gray-800 mb-2 text-center">تواصل معنا 📞</h1>
                    <p class="text-center text-gray-500 mb-8">عندك اقتراح؟ مشكلة؟ أو حابب تعلن عنا؟ إحنا بنسمعك.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- معلومات التواصل -->
                        <div class="space-y-6">
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl">💬</div>
                                <div>
                                    <p class="text-xs text-gray-400 font-bold">تواصل مباشر واتساب</p>
                                    <a href="https://wa.me/972590000000" class="font-bold text-gray-800 hover:text-green-600 dir-ltr">+970 59 000 0000</a>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl">📧</div>
                                <div>
                                    <p class="text-xs text-gray-400 font-bold">البريد الإلكتروني</p>
                                    <a href="mailto:support@ahsan-s3er.com" class="font-bold text-gray-800 hover:text-blue-600">support@ahsan-s3er.com</a>
                                </div>
                            </div>
                        </div>

                        <!-- فورم التواصل -->
                        <form class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">الاسم</label>
                                <input type="text" class="w-full border-gray-300 rounded-lg focus:ring-red-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">الرسالة</label>
                                <textarea rows="4" class="w-full border-gray-300 rounded-lg focus:ring-red-500 text-sm"></textarea>
                            </div>
                            <button type="button" class="w-full bg-black text-white py-2.5 rounded-lg font-bold hover:bg-gray-800 transition">إرسال الرسالة</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>