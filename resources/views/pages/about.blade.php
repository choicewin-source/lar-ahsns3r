<x-app-layout>
    <div class="py-12 bg-white" dir="rtl">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            
            <!-- اللوجو والعنوان -->
            <div class="mb-10 animate-fade-in-down">
                <span class="text-6xl">🇵🇸</span>
                <h1 class="text-4xl font-black text-gray-900 mt-4 mb-2">عن منصة <span class="text-red-600">أحسن سعر</span></h1>
                <p class="text-xl text-gray-500">دليلك الأول والذكي لمقارنة الأسعار في قطاع غزة.</p>
            </div>

            <!-- الكروت التعريفية -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:shadow-lg transition">
                    <div class="w-14 h-14 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">🚀</div>
                    <h3 class="font-bold text-lg mb-2">رسالتنا</h3>
                    <p class="text-gray-600 text-sm">توفير منصة سهلة وسريعة بتساعد الناس يلاقوا احتياجاتهم بأقل تكلفة، وبتدعم التجار بعرض بضاعتهم.</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:shadow-lg transition">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">🔍</div>
                    <h3 class="font-bold text-lg mb-2">كيف بنشتغل؟</h3>
                    <p class="text-gray-600 text-sm">بنجمع الأسعار من التجار والناس المجربة، وبنفرزلك إياها بذكاء عشان تختار الأرخص والأقرب إلك.</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:shadow-lg transition">
                    <div class="w-14 h-14 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">🤝</div>
                    <h3 class="font-bold text-lg mb-2">المصداقية</h3>
                    <p class="text-gray-600 text-sm">بنعتمد على تقييمات الناس الحقيقية، وبنحارب الاستغلال والأسعار الوهمية من خلال الرقابة المستمرة.</p>
                </div>
            </div>

            <!-- كلمة الختام -->
            <div class="bg-red-50 rounded-2xl p-8 border border-red-100">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">ليش عملنا "أحسن سعر"؟</h2>
                <p class="text-gray-700 leading-relaxed max-w-2xl mx-auto">
                    في ظل الظروف الصعبة وتفاوت الأسعار، كان لازم يكون في مكان واحد يجمعنا، يوفر علينا وقت وجهد الفلفتة في الأسواق، ويحمينا من الغلاء. هاد الموقع منكم وإلكم.
                </p>
                <div class="mt-6">
                    <a href="{{ route('products.create') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700 transition">شاركنا بإضافة سعر</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>